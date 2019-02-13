<?php

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Products extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Serial_model');
    }

    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {
            $with_serial = $this->input->get('with_serial');
            $category_id = $this->input->get('category_id');
            if (empty($with_serial) && empty($category_id)) {
                $data=$this->Product_model->find_all();
            }else if(!empty($with_serial)){
                $data=$this->Product_model->find_with_serial();
            }else if(!empty($category_id)){
                $data=$this->Product_model->find_with_category($id);
            }

            // $data = empty($with_serial) ? $this->Product_model->find_all() : $this->Product_model->find_with_serial();
        } else {
            $data = $this->Product_model->find($id);
            if (!empty($data)) {
                $fields = array('unit', 'category');

                foreach ($fields as $val) {
                    $data[$val]['value'] = $data[$val . '_id'];
                    $data[$val]['label'] = $data[$val . '_name'];
                }

                /* get all serial with product id */
                $data['serials'] = $this->Serial_model->find_by_product($data['id']);
            }
        }

        $this->response($data, 200);
    }

    public function index_post()
    {
        $this->db->trans_start();
        $post = $this->post();
        if (empty($post['id'])) {
            $row = $this->Product_model->data();
        }

        $row['id'] = $post['id'];
        $row['name'] = $post['name'];
        $row['code'] = $post['code'];
        // $row['model'] = $post['model'];
        // $row['price'] = $post['price'];
        // $row['fine'] = $post['fine'];
        $row['quantity'] = $post['quantity'];
        $row['category_id'] = $post['category']['value'];
        $row['unit_id'] = $post['unit']['value'];
        // $row['is_active'] = isset($post['is_active']) ? $post['is_active'] : 0;
        $row['is_return'] = isset($post['is_return']) ? $post['is_return'] : 0;
        $row['is_serial_number'] = isset($post['is_serial_number']) ? $post['is_serial_number'] : 0;

        /* response */
        $data = array('status' => true, 'message' => 'save successful.');

        /* condition save / update */
        if (empty($post['id'])) {
            $this->Product_model->save($row);
        } else {
            $row['modified_at'] = date('Y-m-d H:i:s');
            $row['modified_on'] = get_user_id();
            $this->Product_model->update($row);
        }

        $product_last_id = empty($post['id']) ? $this->db->insert_id() : $post['id'];

        // serial save
        if ($post['is_serial_number']) {
            // each delete list
            $delete_not_list = array();
            foreach ($post['serials'] as $serial) {
                $db_serials = $this->Serial_model->find_by_product($product_last_id);
                foreach ($db_serials as $db_serial) {
                    if ($db_serial['id'] == $serial['id']) {
                        array_push($delete_not_list, $serial['id']);
                    }
                }
            }

            if (count($delete_not_list) > 0) {
                $this->Serial_model->delete_not_list($product_last_id, $delete_not_list);
            }

            // each save or update by product
            foreach ($post['serials'] as $key => $serial) {
                $detail = $this->Serial_model->data();
                $detail['code'] = $serial['code'];
                $detail['quantity'] = $serial['quantity'];
                $detail['product_id'] = $product_last_id;

                // save or update
                if (empty($serial['id'])) {
                    $this->Serial_model->save($detail);
                } else {
                    $detail['id'] = $serial['id'];
                    $this->Serial_model->update($detail);
                }
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->response(array('status' => false, 'message' => 'save failed.'), 500);
        } else {
            $this->response($data, 200);
        }
    }

    public function index_delete()
    {
        $id = $this->get('id');
        $this->Serial_model->delete_by_product($id);
        $result = $this->Product_model->delete($id);
        $code = $result ? 200 : 403;
        $message = $result ? '' : get_line('not_delete_trans');
        $this->response([
            'status' => $result,
            'deleted' => $id,
            'message' => $message,
        ], $code);
    }
}

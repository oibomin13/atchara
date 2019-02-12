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
class Departments extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Department_model');        
    }

    public function index_get()
    {
        $id = $this->get('id');
        $data = ($id === null) ? $this->Department_model->find_all() : $this->Department_model->find($id);

        $this->response($data, 200);
    }

    public function index_post()
    {
        $post = $this->post();
        if(empty($post['id'])){
            $row = $this->Department_model->data();
        }

        $row['id'] = $post['id'];
        $row['name'] = $post['name'];
        // $row['is_active'] = isset($post['is_active']) ? $post['is_active'] : 0;

        /* response */
        $data = array('status'=>true,'message'=>'save successful.');

        /* condition save / update */
        if(empty($post['id'])){
            $this->Department_model->save($row);            
        } else {
            $this->Department_model->update($row);
        }

        $this->response($data, 200);
    }

    public function index_delete()
    {
        $id = $this->get('id');
        $result = $this->Department_model->delete($id);
        $code = $result ? 200 : 403;
        $message = $result ? '' : get_line('not_delete_trans');
        $this->response([
            'status' => $result,
            'deleted' => $id,
            'message' => $message
        ], $code);
    }
}

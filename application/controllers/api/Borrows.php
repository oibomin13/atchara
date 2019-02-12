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
class Borrows extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Borrow_model');
		$this->load->model('Borrowdetail_model');
		$this->load->model('Serial_model');
		$this->load->model('Product_model');
		$this->load->model('Member_model');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$data = $this->Borrow_model->find_all_orderby();
		} else {
			$data = $this->Borrow_model->find($id);
			$data['borrow_date'] = !empty($data['borrow_date']) ? str_date($data['borrow_date']) : null;
			$data['schedule_date'] = !empty($data['schedule_date']) ? str_date($data['schedule_date']) : null;
			//$data['return_date'] = !empty($data['return_date']) ? str_date($data['return_date']) : null;

			if (!empty($data)) {
				$fields = array('member');

				foreach ($fields as $val) {
					$data[$val . '_id'] = !empty($data[$val . '_id']) ? $data[$val . '_id'] : null;
					$data[$val] = !empty($data[$val . '_name']) ? $data[$val . '_name'] : null;
				}

				/* get all product with product id */
				$id = !empty($data['id']) ? $data['id'] : null;
				$data['products'] = $this->Borrowdetail_model->find_by_borrow($id);
				foreach ($data['products'] as &$product) {
					$product['id'] = $product['product_id'];
					$product['value'] = $product['product_id'];
					$product['is_return'] = $product['is_return'];
					$product['remain'] = ($product['is_serial_number']) ? $product['serial_quantity'] : $product['quantity'];
					$product['serial_code'] = ($product['is_serial_number']) ? $product['serial_code'] : '-';
					$product['return_old_quantity'] = $product['return_quantity'];
				}
			}
		}

		$this->response($data, 200);
	}

	public function index_post()
	{
		$this->db->trans_begin();
		$post = $this->post();
		if (empty($post['id'])) {
			$row = $this->Borrow_model->data();
		}

		$row['id'] = $post['id'];
		$row['borrow_date'] = db_date($post['borrow_date']);
		$row['schedule_date'] = empty($post['id']) ? null : db_date($post['schedule_date']);
		$row['member_id'] = $post['member_id'];
		//$row['member_id'] = $post['member']['value'];
		// $row['return_status'] = empty($post['id']) ? false : true;
		$row['return_status'] = empty($post['id']) ? 0 : 1;
		//$row['return_date'] = empty($post['id']) ? null : db_date($post['return_date']);

		/* response */
		$data = array('status' => true, 'message' => 'save successful.');

		/* condition save / update */
		if (empty($post['id'])) {
			$this->Borrow_model->save($row);
		} else {
			$row['modified_at'] = date('Y-m-d H:i:s');
			$row['modified_on'] = get_user_id();
			$this->Borrow_model->update($row);
		}

		$borrow_last_id = empty($post['id']) ? $this->db->insert_id() : $post['id'];
		/* สถานะการคืนถ้าหากคืนรายการครบแล้วทั้งหมดจะแจ้งว่าคืนครบแล้ว */
		// $header_status = true;
		$header_status = $row['return_status'];
		$checkreturn = true;
		/* สถานะกรณีสินค้าติดลบจะไม่สามารถบันทึกได้ */
		$positively = true;

		/* borrow detail save */
		$this->Borrowdetail_model->delete_by_borrow($borrow_last_id);
		$err_products = array();
		foreach ($post['products'] as $key => $product) {
			if(!empty($post['schedule_date'])){				
				
				if($product['is_return'] == 0){
					$header_status = 2;
					$return_status = 2;
				}
				else {
					$return_status = ($product['borrow_quantity'] - $product['return_quantity']) == 0 ? 2 : 1;
					$header_status = 1;
				}
				
			}
			else {
				$return_status = 0;
				$header_status = 0;
			}
			// $return_status = ($product['borrow_quantity'] - $product['return_quantity']) == 0 ? true : false;
			$serial_number_id = ($product['is_serial_number']) ? $product['serial_number_id'] : null;
			$product['serial_number_id'] = $serial_number_id;

			$detail = $this->Borrowdetail_model->data();
			$detail['id'] = ($key + 1);
			$detail['return_status'] = $return_status;
			$detail['borrow_quantity'] = $product['borrow_quantity'];
			$detail['return_quantity'] = $product['return_quantity'];
			//$detail['price'] = $product['price'];
			$detail['product_id'] = $product['value'];
			$detail['serial_number_id'] = $serial_number_id;
			$detail['borrow_id'] = $borrow_last_id;
			$this->Borrowdetail_model->save($detail);

			/* ถ้าคืนไม่ครบให้ header status เป็น FALSE ทันที */
			// if (!$return_status) {
			// 	$header_status = false;
			// }
			if ($return_status != 2) {
				$checkreturn = false;
			}

			/* ปรับปรุง STOCK */
			$quantity = empty($post['id']) ? ($product['borrow_quantity'] * -1) : ($product['return_quantity'] - $product['return_old_quantity']);
			if ($product['is_serial_number']) {
				$this->Serial_model->set_quantity($product['serial_number_id'], $product['value'], $quantity);
				$serial = $this->Serial_model->find_by_id_and_product($product['serial_number_id'], $product['value']);
				$remain = $product['borrow_quantity'] + $serial['quantity'];

				/* หากยอดติดลบให้เป็นเท็จ */
				if ($serial['quantity'] < 0) {
					$positively = false;
					array_push($err_products, $product);
				}

			} else {
				$this->Product_model->set_quantity($product['value'], $quantity);

				$prd = $this->Product_model->find($product['value']);
				$remain = $product['borrow_quantity'] + $prd['quantity'];

				/* หากยอดติดลบให้เป็นเท็จ */
				if ($prd['quantity'] < 0) {
					$positively = false;
					array_push($err_products, $product);
				}
			}

            // เพิ่มข้อมูลยอดคงเหลือไปกับ APi
			$product['remain'] = $remain;
		}

		/* ปรับปรุงสถานะการคืน */
		if (!empty($post['id'])) {
			$update['id'] = $post['id'];
			if($checkreturn){
				$header_status=2;
			}
			$update['return_status'] = $header_status;
			$this->Borrow_model->update($update);
		}

		if ($this->db->trans_status() === false or !$positively) {
			$msg = !$positively ? get_line('negative_stock') : get_line('system_error');
			$status_code = !$positively ? 403 : 500;
			$this->db->trans_rollback();
			$this->response(array('status' => false, 'message' => $msg, 'products' => $err_products), $status_code);
		} else {
			$this->db->trans_commit();
			$this->response($data, 200);
		}
	}

	public function index_delete()
	{
		$this->db->trans_start();
		$id = $this->get('id');

        // get data check before delete
		$borrow_detail = $this->Borrowdetail_model->find_by_borrow($id);
		foreach ($borrow_detail as $detail) {
            // increase quantity to stock        
			$quantity = $detail['borrow_quantity'] - $detail['return_quantity'];
			if (!empty($detail['serial_number_id'])) {
				$this->Serial_model->set_quantity($detail['serial_number_id'], $detail['product_id'], $quantity);
			} else {
				$this->Product_model->set_quantity($detail['product_id'], $quantity);
			}
		}

        // delete
		$this->Borrowdetail_model->delete_by_borrow($id);
		$result = $this->Borrow_model->delete($id);

		$this->db->trans_complete();

		$code = $result ? 200 : 403;
		$message = $result ? '' : get_line('not_delete_trans');
		$this->response([
			'status' => $result,
			'deleted' => $id,
			'message' => $message
			], $code);

	}
}

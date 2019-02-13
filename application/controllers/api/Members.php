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
class Members extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model');
		$this->load->model('Membertype_model');
		$this->load->model('Department_model');
		$this->load->model('User_model');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
            // query by keyword
			$keyword = $this->input->get('keyword');
			if (empty($keyword)) {
				$data = $this->Member_model->find_all();
			} elseif (!empty($keyword)) {
				$data = $this->Member_model->find_keyword($keyword);
			} 
			// elseif (!empty($uid)) {
			// 	$data = $this->Member_model->find_user_id($uid);
			// }
			//$data = (empty($keyword)) ? $this->Member_model->find_all() : $this->Member_model->find_keyword($keyword);
		} else {
			$data = $this->Member_model->find($id);
			if (!empty($data)) {
				// $fields = array('department', 'membertype', 'user');
				$fields = array('department', 'membertype');
				foreach ($fields as $val) {
					$data[$val]['value'] = $data[$val . '_id'];
					$data[$val]['label'] = $data[$val . '_name'];
				}
			}
		}

		$this->response($data, 200);
	}

	public function index_post()
	{
		$this->db->trans_start();
		$post = $this->post();
		if (empty($post['id'])) {
			$row = $this->Member_model->data();
		}

		$row['id'] = $post['id'];
		$row['fullname'] = $post['fullname'];
		//$post['name'];
		$row['code'] = $post['code'];
		$row['username'] = $post['username'];
		$row['password'] = $post['password'];
		$row['email'] = $post['email'];
		$row['tel'] = $post['tel'];
		$row['address'] = $post['address'];
		$row['department_id'] = $post['department']['value'];
		$row['membertype_id'] = $post['membertype']['value'];
		if ($row['membertype_id']==3) {
			$row['usertype']="ADMIN";
		}
		else{
			$row['usertype']="USER";
		}
		$row['idcard'] = $post['idcard'];
		if (empty($post['id']) or !empty($post['password'])) {
			$row['password'] = hashkey($post['password']);
		}
		// $row['user_id'] = $post['user']['value'];
		// $row['is_active'] = isset($post['is_active']) ? $post['is_active'] : 0;

        /* response */
		$data = array('status' => true, 'message' => 'save successful.');

        /* condition save / update */
		if (empty($post['id'])) {
			$this->Member_model->save($row);
		} else {
			$row['modified_at'] = date('Y-m-d H:i:s');
			$row['modified_on'] = get_user_id();
			$this->Member_model->update($row);
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
		$result = $this->Member_model->delete($id);
		$code = $result ? 200 : 403;
		$message = $result ? '' : get_line('not_delete_trans');
		$this->response([
			'status' => $result,
			'deleted' => $id,
			'message' => $message
		], $code);
	}
}

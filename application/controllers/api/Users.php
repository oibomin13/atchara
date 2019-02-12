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
class Users extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index_get()
	{
		$id = $this->get('id');
		if ($id === null) {
			$data = $this->User_model->find_all();
		} else {
			$data = $this->User_model->find($id);
			unset($data['password']);
		}

		$this->response($data, 200);
	}

	public function index_post()
	{
		$post = $this->post();
		if (empty($post['id'])) {
			$row = $this->User_model->data();
		}

		$row['id'] = $post['id'];
		$row['username'] = $post['username'];
		$row['fullname'] = $post['fullname'];
		$row['usertype'] = $post['usertype'];
		//$row['is_active'] = isset($post['is_active']) ? $post['is_active'] : 0;

        /* condition password */
		if (empty($post['id']) or !empty($post['password'])) {
			$row['password'] = hashkey($post['password']);
		}

        /* response */
		$data = array('status' => true, 'message' => 'save successful.');

        /* condition save / update */
		if (empty($post['id'])) {
			$this->User_model->save($row);
		} else {
			$this->User_model->update($row);
		}

		$this->response($data, 200);
	}

	public function index_delete()
	{
		$id = $this->get('id');
		$result = $this->User_model->delete($id);
		$code = $result ? 200 : 403;
		$message = $result ? '' : get_line('not_delete_trans');
		$this->response([
			'status' => $result,
			'deleted' => $id,
			'message' => $message
		], $code);
	}
}

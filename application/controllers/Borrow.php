<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Borrow extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Borrow_model');
		$this->load->library('session');
		$this->load->model('Member_model');
	}

	public function index()
	{
		$head['main_title'] = get_line('menu_borrow');
		$head['utype'] = get_usertype();
		$head['count_not_approve'] = $this->Borrow_model->count_not_approve();
		$this->load->view('layout/header', $head);
		$this->load->view('borrow/index');
		$this->load->view('layout/footer');
	}

	public function main_form($id = 0)
	{
		$data['id'] = $id;
		$data['mid'] = get_user_id();
		$data['mname'] = get_user_fullname();
		$data['uid'] = get_user_id();
		$data['utype'] = get_usertype();
		$data['categories'] = get_categorie();

		//echo $data['fullname'];die();
		$this->load->view('borrow/main_form', $data);
	}

	public function get_datatables()
	{
		if(get_usertype() == 'ADMIN'){
			$order_index = $this->input->get('order[0][column]');
			$param['page_size'] = $this->input->get('length');
			$param['start'] = $this->input->get('start');
			$param['draw'] = $this->input->get('draw');
			$param['keyword'] = trim($this->input->get('search[value]'));
			$param['column'] = $this->input->get("columns[{$order_index}][data]");
			$param['dir'] = $this->input->get('order[0][dir]');
			$param['only_borrow'] = false;
		}else{
			// $member = $this->Member_model->find_user_id(get_user_id());
			$order_index = $this->input->get('order[0][column]');
			$param['page_size'] = $this->input->get('length');
			$param['start'] = $this->input->get('start');
			$param['draw'] = $this->input->get('draw');
			// $param['keyword'] = trim($this->input->get('search[value]'));
			// $param['keyword'] = $member[0]['id'];
			$param['keyword'] = get_user_id();
			$param['column'] = $this->input->get("columns[{$order_index}][data]");
			$param['dir'] = $this->input->get('order[0][dir]');
			$param['only_borrow'] = false;
		}
		

		$results = $this->Borrow_model->find_with_page($param);

		$data['draw'] = $param['draw'];
		$data['recordsTotal'] = $results['count'];
		$data['recordsFiltered'] = $results['count_condition'];
		$data['data'] = $results['data'];
		$data['error'] = $results['error_message'];

		json_output($data);
	}
}

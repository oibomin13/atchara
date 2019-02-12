<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Borrow_model');
	}

    public function index()
    {
        $head['main_title'] = get_line('menu_user');

        $head['utype'] = get_usertype();
        $head['count_not_approve'] = $this->Borrow_model->count_not_approve();
        
        $this->load->view('layout/header', $head);
        $this->load->view('user/index');
        $this->load->view('layout/footer');
	}
	
	public function main_form($id=0){
        $data['id'] = $id;
        $data['usertypes'] = array(''=>'เลือกรายการ', 'ADMIN'=>'Admin', 'USER'=>'User');
		$this->load->view('user/main_form', $data);
	}

    public function get_datatables(){
        $order_index = $this->input->get('order[0][column]');
		$param['page_size'] = $this->input->get('length');
		$param['start'] = $this->input->get('start');
		$param['draw'] = $this->input->get('draw');
		$param['keyword'] = trim($this->input->get('search[value]'));
		$param['column'] = $this->input->get("columns[{$order_index}][data]");
		$param['dir'] = $this->input->get('order[0][dir]');

		$results = $this->User_model->find_with_page($param);

		$data['draw'] = $param['draw'];
		$data['recordsTotal'] = $results['count'];
		$data['recordsFiltered'] = $results['count_condition'];
		$data['data'] = (get_usertype() === 'ADMIN') ? $results['data'] : array();
		$data['error'] = $results['error_message'] ;

		json_output($data);
	}

	public function username_check(){
		$result = $this->User_model->find_username($this->input->post('username'));
		if(!empty($result)){
			echo ($this->input->post('id') == $result['id']) ? 'true' : 'false';
		}else{
			echo 'true';
		}
	}
}

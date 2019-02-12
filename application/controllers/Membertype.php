<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Membertype extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('Membertype_model');
		$this->load->model('Borrow_model');
	}

    public function index()
    {
        $head['main_title'] = get_line('menu_membertype');

        $head['utype'] = get_usertype();
        $head['count_not_approve'] = $this->Borrow_model->count_not_approve();
        
        $this->load->view('layout/header', $head);
        $this->load->view('membertype/index');
        $this->load->view('layout/footer');
	}
	
	public function main_form($id=0){
		$data['id'] = $id;
		$this->load->view('membertype/main_form', $data);
	}

    public function get_datatables(){
        $order_index = $this->input->get('order[0][column]');
		$param['page_size'] = $this->input->get('length');
		$param['start'] = $this->input->get('start');
		$param['draw'] = $this->input->get('draw');
		$param['keyword'] = trim($this->input->get('search[value]'));
		$param['column'] = $this->input->get("columns[{$order_index}][data]");
		$param['dir'] = $this->input->get('order[0][dir]');

		$results = $this->Membertype_model->find_with_page($param);

		$data['draw'] = $param['draw'];
		$data['recordsTotal'] = $results['count'];
		$data['recordsFiltered'] = $results['count_condition'];
		$data['data'] = $results['data'];
		$data['error'] = $results['error_message'] ;

		json_output($data);
	}

	public function name_check(){
		$result = $this->Membertype_model->find_name($this->input->post('name'));
		if(!empty($result)){
			echo ($this->input->post('id') == $result['id']) ? 'true' : 'false';
		}else{
			echo 'true';
		}
	}
}

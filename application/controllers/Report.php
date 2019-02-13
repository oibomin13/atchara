<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Serial_model');
        $this->load->model('Borrow_model');
        $this->load->model('Member_model');
    }

    public function stock()
    {
        $head['main_title'] = get_line('menu_rpt_stock');
        $data['categories'] = get_categorie();

        $head['utype'] = get_usertype();
        $head['count_not_approve'] = $this->Borrow_model->count_not_approve();
        
        $this->load->view('layout/header', $head);
        $this->load->view('report/stock', $data);
        $this->load->view('layout/footer');
    }

    public function get_stock_datatables()
    {
        $order_index = $this->input->get('order[0][column]');
        $param['page_size'] = $this->input->get('length');
        $param['start'] = $this->input->get('start');
        $param['draw'] = $this->input->get('draw');
        $param['keyword'] = trim($this->input->get('search[value]'));
        $param['column'] = $this->input->get("columns[{$order_index}][data]");
        $param['dir'] = $this->input->get('order[0][dir]');

        // search
        $param['category_id'] = $this->input->get('category_id');

        $results = $this->Product_model->find_with_page_stock($param);

        // transfrom data
        foreach ($results['data'] as &$item) {
            $item['quantity'] = ($item['is_serial_number']) ? $item['serial_quantity'] : $item['quantity'];
            $item['serial_code'] = ($item['is_serial_number']) ? $item['serial_code'] : '-';
        }

        $data['draw'] = $param['draw'];
        $data['recordsTotal'] = $results['count'];
        $data['recordsFiltered'] = $results['count_condition'];
        $data['data'] = $results['data'];
        $data['error'] = $results['error_message'];

        json_output($data);
    }

    public function borrow()
    {
        $head['main_title'] = get_line('menu_rpt_borrow');
        $data['categories'] = get_categorie();
        $head['utype'] = get_usertype();
        $head['count_not_approve'] = $this->Borrow_model->count_not_approve();
        
        $this->load->view('layout/header', $head);
        $this->load->view('report/borrow',$data);
        $this->load->view('layout/footer');
    }

    public function get_borrow_datatables(){
        // $member = $this->Member_model->find_user_id(get_user_id());
        // $mid = (string)$member[0]['id'];
        $mid =get_user_id();
        $dash_board = $this->input->get('dashboard');
        $order_index = $this->input->get('order[0][column]');
		$param['page_size'] = empty($dash_board) ? $this->input->get('length') : 5;
		$param['start'] = empty($dash_board) ? $this->input->get('start') : 0;
		$param['draw'] = $this->input->get('draw');
		$param['keyword'] = trim($this->input->get('search[value]'));
		$param['column'] = (empty($dash_board)) ? $this->input->get("columns[{$order_index}][data]") : 'created_at';
		$param['dir'] = (empty($dash_board)) ? $this->input->get('order[0][dir]') : 'DESC';
        $param['only_borrow'] = false;               
        $param['dash_board'] = $dash_board;
        // search
        $param['category_id'] = $this->input->get('category_id');
        
        $results = $this->Borrow_model->find_with_page_borrow($param,$mid);

		$data['draw'] = $param['draw'];
		$data['recordsTotal'] = $results['count'];
		$data['recordsFiltered'] = $results['count_condition'];
		$data['data'] = $results['data'];
		$data['error'] = $results['error_message'] ;

		json_output($data);
	}
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct(){
		parent::__construct();
        $this->load->model('Borrow_model');
        $this->load->model('Member_model');
        $this->load->model('Product_model');
        $this->load->model('User_model');
	}

    public function index()
    {
        $head['main_title'] = get_line('menu_dashboard');
        $data['count_borrow'] = $this->Borrow_model->count();
        $data['count_member'] = $this->Member_model->count_active();
        $data['count_product'] = $this->Product_model->count_active();
        $data['count_remain_return'] = $this->Borrow_model->count_not_return();
        $data['last_login'] = $this->User_model->find_last_login();

        $head['utype'] = get_usertype();
        $head['count_not_approve'] = $this->Borrow_model->count_not_approve();
        
        $this->load->view('layout/header', $head);
        $this->load->view('home/index', $data);
        $this->load->view('layout/footer');
    }
}

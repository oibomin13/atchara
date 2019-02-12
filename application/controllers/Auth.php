<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->load->view('auth/index');
    }

    public function login_process()
    {
        $username = $this->input->post('username');
        $password = hashkey($this->input->post('password'));
        $result = $this->User_model->login($username, $password);
        if (!empty($result)) {
            $key = hashkey(uniqid());
            // Add user data in session
            set_sess_data($result, $key);

            // Add user data in cookie when click remember
            if($this->input->post('stay_login')){
                set_cookie('token', $key, 86400*365);
                set_cookie('id', $result['id'], 86400*365);
            }

            redirect(site_url(), 'refresh');
        } else {
			$this->session->set_flashdata('err', array('type'=>'login', 'msg'=>get_line('err_invalid_login')));
			$this->load->view('auth/index');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(app_session());
        delete_cookie('token');
        delete_cookie('id');
        redirect(site_url('auth'), 'refresh');
    }
}

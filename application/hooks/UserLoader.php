<?php
defined('BASEPATH') or exit('No direct script access allowed');
class UserLoader
{
    public function __construct(){
		$this->CI = & get_instance();
	}
    public function auth()
    { 
        $class = $this->CI->router->fetch_class();

        if ($class != 'auth') {
            if (empty($this->CI->session->userdata(app_session()))) {

                $cookie_available = false;
                // retrive database to remember id
                if(!empty(get_cookie('id')) && !empty(get_cookie('token'))){
                    $this->CI->load->model('User_model');
                    $id = get_cookie('id');
                    $key = get_cookie('token');
                    $result = $this->CI->User_model->find_id_and_key($id, $key);
                    log_message('debug', 'id=> ' .$id);
                    log_message('debug', 'key=> ' .$key);
                    log_message('debug', print_r($result, true));
                    if(!empty($result)){
                        set_sess_data($result, $key);
                        $cookie_available = true;
                    }
                }

                if(!$cookie_available){
                    $this->CI->session->set_flashdata('err', array('type' => 'auth', 'msg' => get_line('err_auth')));
                    redirect('auth', 'refresh');
                    exit();
                }
            }
        }
    }

    public function permission()
    {
        $class = $this->CI->router->fetch_class();
        $inclass= array('auth', 'home', 'borrow', 'report', 'user', 'borrows', 'members', 'products', 'users');
        if(!in_array($class, $inclass) && get_usertype() !== 'ADMIN'){
            redirect('auth', 'refresh');
            exit();
        }
    }

}

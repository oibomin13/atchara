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
class Units extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Unit_model');        
    }

    public function index_get()
    {        
        $id = $this->get('id');
        $data = ($id === null) ? $this->Unit_model->find_all() : $this->Unit_model->find($id);

        $this->response($data, 200);
    }
}

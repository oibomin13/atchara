<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unit_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->_table = 'unit';
		$this->delete_db = TRUE;
		$this->delete_tbref = array('product');
	}

}
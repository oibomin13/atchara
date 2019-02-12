<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Borrowdetail_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->_table = 'borrow_detail';
		$this->delete_db = FALSE;
		$this->delete_tbref = array();
	}

	public function data(){
		$data = array(
            'id' => NULL,
            'return_status' => NULL,
			'borrow_quantity' => 0,
			'return_quantity' => 0,
            // 'price' => 0,
            'product_id' => NULL,
            'serial_number_id' => NULL,
            'borrow_id' => NULL
		);
		return $data;
    }
    
    public function delete_by_borrow($borrow_id){
        $this->db->where('borrow_id', $borrow_id);
        $this->db->delete($this->_table);
	}
	
	public function find_by_borrow($borrow_id){
		$this->db->select('d.*, p.name, p.quantity, p.code, p.is_serial_number,p.is_return, s.id as serial_id, s.code as serial_code, s.quantity as serial_quantity, u.name as unit_name');
		$this->db->from('borrow_detail d');
		$this->db->join('product p', 'd.product_id=p.id');
		$this->db->join('serial_number s', 'p.id=s.product_id and d.serial_number_id=s.id', 'left');
		$this->db->join('unit u', 'u.id=p.unit_id');
		$this->db->where('borrow_id', $borrow_id);
		$query = $this->db->get();
		return $query->result_array();
	}
}
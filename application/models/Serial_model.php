<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Serial_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->_table = 'serial_number';
		$this->delete_db = FALSE;
		$this->delete_tbref = array();
	}

	public function data(){
		$data = array(
            'id' => NULL,
            'code' => NULL,
			'quantity' => 0,
            //'is_active' => TRUE,
            'product_id' => NULL
		);
		return $data;
    }
    
    public function delete_by_product($product_id){
        $this->db->where('product_id', $product_id);
        $this->db->delete($this->_table);
	}

	public function delete_not_list($product_id, $not_list){
		$this->db->where('product_id', $product_id);
		$this->db->where_not_in('id', $not_list);
        $this->db->delete($this->_table);
	}
	
	public function find_by_product($product_id){
		$this->db->from($this->_table);
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function find_by_id_and_product($id, $product_id){
		$this->db->from($this->_table);
		$this->db->where(array('id' => $id, 'product_id' => $product_id));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function set_quantity($id, $product_id, $quantity){
		$this->db->set('quantity', 'quantity+'.$quantity, FALSE);
		$this->db->where(array('id' => $id, 'product_id' => $product_id));
		$this->db->update($this->_table);
	}
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'product';
        $this->delete_db = true;
        $this->delete_tbref = array('serial_number', 'borrow_detail');
    }

    public function data()
    {
        $data = array(
            'id' => null,
            'name' => null,
            'code' => null,
            //'model' => null,
            //'price' => 0,
            //'fine' => 0,
            //'detail' => null,
            //'image_name' => null,
            'quantity' => 0,
            //'remark' => null,
            'is_serial_number' => false,
            //'is_active' => true,
            'is_return' => true,
            'unit_id' => null,
            'category_id' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'modified_at' => null,
            'created_on' => get_user_id(),
            'modified_on' => null,
        );
        return $data;
    }

    public function find($id)
    {
		$this->db->select('p.*, c.name as category_name, u.name as unit_name');
		$this->db->from('product p');
		$this->db->join('category c', 'c.id=p.category_id');
		$this->db->join('unit u', 'u.id=p.unit_id');
		$this->db->where('p.id', $id);
		$query = $this->db->get();
		return $query->row_array();
    }

    public function find_with_page($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('p.*, c.name as category_name');

        $condition = "1=1";
        if (!empty($keyword)) {
            $condition .= " and (p.name like '%{$keyword}%' or p.code like '%{$keyword}%' or c.name like '%{$keyword}%')";
        }

        // search by category
        $condition .= !empty($param['category_id']) ? " and c.id='{$param['category_id']}'" : "";

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $this->db->from('product p');
        $this->db->join('category c', 'c.id=p.category_id');
        $query = $this->db->get();
        $data = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('product p')->join('category c', 'c.id=p.category_id')->where($condition)->count_all_results();
        $count = $this->db->from('product p')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        return $result;
    }

    public function find_with_serial()
    {        
        $this->db->select('p.*,s.id as serial_id, s.code as serial_code, s.quantity as serial_quantity, u.name as unit_name');
        $this->db->from('product p');
        $this->db->join('serial_number s', 'p.id=s.product_id', 'left'); 
        $this->db->join('unit u', 'u.id=p.unit_id');
        $query = $this->db->get();  
        return $query->result_array();
    }

    public function find_name($name)
    {
        $query = $this->db->select('id')->from('product')->where(array('name' => $name))->get();
        return $query->row_array();
    }
    public function find_code($code)
    {
        $query = $this->db->select('id')->from('product')->where(array('code' => $code))->get();
        return $query->row_array();
    }

    public function set_quantity($id, $quantity){
		$this->db->set('quantity', 'quantity+'.$quantity, FALSE);
		$this->db->where('id', $id);
		$this->db->update($this->_table);
    }
    
    // datatables รายการแบบมีสต๊อก
    public function find_with_page_stock($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('p.*, c.name as category_name, s.id as serial_id, s.code as serial_code, s.quantity as serial_quantity, u.name as unit_name');

        $condition = "1=1";
        if (!empty($keyword)) {
            $condition .= " and (p.name like '%{$keyword}%' or p.code like '%{$keyword}%' or c.name like '%{$keyword}%' or s.code like '%{$keyword}%')";
        }

        // search by category
        $condition .= !empty($param['category_id']) ? " and c.id='{$param['category_id']}'" : "";

        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        $this->db->order_by($param['column'], $param['dir']);

        $this->db->from('product p');
        $this->db->join('category c', 'c.id=p.category_id');
        $this->db->join('serial_number s', 'p.id=s.product_id', 'left'); 
        $this->db->join('unit u', 'p.unit_id=u.id');
        $query = $this->db->get();
        $data = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('product p')->join('category c', 'c.id=p.category_id')->join('serial_number s', 'p.id=s.product_id', 'left')->where($condition)->count_all_results();
        $count = $this->db->from('product p')->join('serial_number s', 'p.id=s.product_id', 'left')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        return $result;
    }
}

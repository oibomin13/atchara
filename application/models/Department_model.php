<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Department_model extends MY_Model {
	public function __construct(){
		parent::__construct();
		$this->_table = 'department';
		$this->delete_db = TRUE;
		$this->delete_tbref = array('member');
	}

	public function data(){
		$data = array(
			'id' => NULL,			
			'name' => NULL,
			// 'is_active' => TRUE
		);
		return $data;
	}

	public function find_with_page($param){
		$keyword = $param['keyword'];
		$this->db->select('*');

		$condition = "1=1";
		if(!empty($keyword)){
			$condition .= " and (name like '%{$keyword}%')";
		}

		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get($this->_table);
		$data = [];
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$data[] = $row;
			}
		}

		$count_condition = $this->db->from($this->_table)->where($condition)->count_all_results();
		$count = $this->db->from($this->_table)->count_all_results();
		$result = array('count'=>$count,'count_condition'=>$count_condition,'data'=>$data,'error_message'=>'');
		return $result;
	}

	public function find_name($name){
		$query = $this->db->select('id')->from('department')->where(array('name'=>$name))->get();
		return $query->row_array();
	}
}
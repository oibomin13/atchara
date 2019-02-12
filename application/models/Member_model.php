<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Member_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'member';
		$this->delete_db = true;
		$this->delete_tbref = array('borrow');
	}

	public function data()
	{
		$data = array(
			'id' => null,
			'name' => null,
			'code' => null,
			//'username' => null,
			//'password' => null,
			'email' => null,
			'tel' => null,
			'address' => null,
			//'image_name' => null,
			//'is_active' => true,
			'department_id' => null,
			'membertype_id' => null,
			'created_at' => date('Y-m-d H:i:s'),
			'modified_at' => null,
			'created_on' => get_user_id(),
			'modified_on' => null,
			'user_id' => null,
		);
		return $data;
	}

	public function find($id)
	{ 
		$this->db->select('m.*, d.name as department_name, t.name as membertype_name, u.fullname as user_name');
		$this->db->from('member m');
		$this->db->join('department d', 'd.id=m.department_id');
		$this->db->join('membertype t', 't.id=m.membertype_id');
		$this->db->join('user u', 'u.id=m.user_id');
		$this->db->where('m.id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function find_with_page($param)
	{
		$keyword = $param['keyword'];
		$this->db->select('m.*, d.name as department_name, t.name as membertype_name');

		$condition = "1=1";
		if (!empty($keyword)) {
			$condition .= " and (m.name like '%{$keyword}%' or m.code like '%{$keyword}%' or d.name like '%{$keyword}%' or t.name like '%{$keyword}%')";
		}

		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);

		$this->db->from('member m');
		$this->db->join('department d', 'd.id=m.department_id');
		$this->db->join('membertype t', 't.id=m.membertype_id');
		$query = $this->db->get();
		$data = [];
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		$count_condition = $this->db->from('member m')
			->join('department d', 'd.id=m.department_id')
			->join('membertype t', 't.id=m.membertype_id')
			->where($condition)->count_all_results();
		$count = $this->db->from('member m')->count_all_results();
		$result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
		return $result;
	}

	public function find_name($name)
	{
		$query = $this->db->select('id')->from('member')->where(array('name' => $name))->get();
		return $query->row_array();
	}
	public function find_code($code)
	{
		$query = $this->db->select('id')->from('member')->where(array('code' => $code))->get();
		return $query->row_array();
	}

	public function find_user_id($uid)
	{
		$query = $this->db->select('*')->from('member')->where(array('user_id' => $uid))->get();
		return $query->result_array();
	}

	public function find_keyword($keyword)
	{
		$query = $this->db->select('*')
			->from('member')
			->like('code', $keyword)
			->or_like('name', $keyword)
			->get();
		return $query->result_array();
	}
}

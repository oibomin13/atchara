<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_table = 'user';
		$this->delete_db = false;
		$this->delete_tbref = array('');
	}

	public function data()
	{
		$data = array(
			'id' => null,
			'username' => null,
			'password' => null,
			'fullname' => null,
			'usertype' => null,
			'last_login' => null,
			'key' => null,
			//'is_active' => true,
		);
		return $data;
	}

	public function find_with_page($param)
	{
		$curr_login = get_user_id();
		$keyword = $param['keyword'];
		$this->db->select('*');

		$condition = "id != '{$curr_login}'";
		if (!empty($keyword)) {
			$condition .= " and (username like '%{$keyword}%' or fullname like '%{$keyword}%' or usertype like '%{$keyword}%')";
		}

		$this->db->where($condition);
		$this->db->limit($param['page_size'], $param['start']);
		$this->db->order_by($param['column'], $param['dir']);

		$query = $this->db->get($this->_table);
		$data = [];
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		$count_condition = $this->db->from($this->_table)->where($condition)->count_all_results();
		$count = $this->db->from($this->_table)->count_all_results();
		$result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
		return $result;
	}
	// public function find_all()
	// {
	// 	$this->db->select('id,fullname');
	// 	$this->db->from('user');
	// 	// $this->db->join('department d', 'd.id=m.department_id');
	// 	// $this->db->join('membertype t', 't.id=m.membertype_id');
	// 	// $this->db->where('m.id', $id);
	// 	$query = $this->db->get();
	// 	return $query->row_array();
	// }
	public function find_username($username)
	{
		$query = $this->db->select('id')->from('user')->where(array('username' => $username))->get();
		return $query->row_array();
	}

	public function login($username, $password)
	{
		$query = $this->db->select('*')->from('user')->where(array('username' => $username, 'password' => $password))->get();
		return $query->row_array();
	}

	public function find_id_and_key($id, $key)
	{
		$query = $this->db->select('*')->from('user')->where(array('id' => $id, 'key' => $key))->get();
		return $query->row_array();
	}

	public function find_last_login()
	{
		$query = $this->db->from('user')
			->where('last_login !=', null)
			->limit(5)
			->order_by('last_login', 'DESC')
			->get();
		return $query->result_array();
	}
}

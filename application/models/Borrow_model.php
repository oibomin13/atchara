<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Borrow_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->_table = 'borrow';
        $this->delete_db = false;
        $this->delete_tbref = array();
    }

    public function data()
    {
        $data = array(
            'id' => null,
            'borrow_date' => null,
            'schedule_date' => null,
            //'return_date' => null,
            'return_status' => null,
            'member_id' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'modified_at' => null,
            'created_on' => get_user_id(),
            'modified_on' => null,
        );
        return $data;
    }

    public function find_all_orderby()
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->order_by('borrow_date', 'DESC')
            ->get();
        return $query->result_array();
    }

    public function find($id)
    {
        $this->db->select('b.*, m.fullname as member_name');
        $this->db->from('borrow b');
        $this->db->join('member m', 'm.id=b.member_id');
        $this->db->where('b.id', $id);
        $this->db->order_by('borrow_date', 'DESC');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function find_with_page($param)
    {
        $keyword = $param['keyword'];
        $this->db->select('b.*, m.fullname as member_name, m.code as member_code');

        $condition = "1=1";
        if (!empty($keyword)) {
            $id_num = "";
            if(is_numeric($keyword))$id_num = "or m.id like '%{$keyword}%'";
            $condition .= " and (m.code like '%{$keyword}%' or m.fullname like '%{$keyword}%' or m.email like '%{$keyword}%' or m.tel like '%{$keyword}%' ".$id_num.")";
        }

        // status filter
        $condition .= !empty($param['only_borrow']) ? " and return_status=0" : "";
        //$mb = get_member_id_fromuser(get_user_id());
        // user only see filter
        $current_user = get_user_id();
        $condition .= (get_usertype() !== 'ADMIN') ? " and b.created_on='{$current_user}'" : "";

        $this->db->from('borrow b');
        $this->db->join('member m', 'b.member_id=m.id');
        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);
        //$this->db->order_by($param['column'], $param['dir']);
        $this->db->order_by('borrow_date', 'DESC');
        $query = $this->db->get();
        $data = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('borrow b')->join('member m', 'b.member_id=m.id')->where($condition)->count_all_results();
        $count = $this->db->from('borrow')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        return $result;
    }

    public function find_with_page_borrow($param,$mid)
    {
        $keyword = $param['keyword'];
        $this->db->select('b.*, m.fullname as member_name, m.code as member_code, d.borrow_quantity, d.return_quantity, d.return_status as detail_status,
        p.name as product_name, p.code as product_code, s.code as serial_code');

        $condition = "1=1";
        if (!empty($keyword)) {
            $condition .= " and (m.code like '%{$keyword}%' or m.fullname like '%{$keyword}%' or p.code like '%{$keyword}%' or p.name like '%{$keyword}%' or s.code like '%{$keyword}%')";
        }
        // search by category
        $condition .= !empty($param['category_id']) ? " and c.id='{$param['category_id']}'" : "";
        // status filter
        $condition .= !empty($param['only_borrow']) ? " and return_status=0" : "";
        if(get_usertype() !== 'ADMIN')$condition .= " and m.id=".$mid;
        
        $this->db->from('borrow b');
        $this->db->join('borrow_detail d', 'b.id=d.borrow_id');
        $this->db->join('product p', 'd.product_id=p.id');
        $this->db->join('serial_number s', 'p.id=s.product_id and s.id=d.serial_number_id', 'left');
        $this->db->join('member m', 'b.member_id=m.id');
        $this->db->join('category c', 'p.category_id=c.id');
        $this->db->where($condition);
        $this->db->limit($param['page_size'], $param['start']);

        // ordering
        if(!empty($param['dash_board'])){
            $this->db->order_by('modified_at', 'desc');
            $this->db->order_by('created_at', 'desc');     
        }
        $this->db->order_by($param['column'], $param['dir']);        
        $this->db->order_by('borrow_date', 'DESC');
        $query = $this->db->get();
        $data = [];
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }

        $count_condition = $this->db->from('borrow b')
            ->join('member m', 'b.member_id=m.id')
            ->join('borrow_detail d', 'b.id=d.borrow_id')
            ->join('product p', 'd.product_id=p.id')
            ->join('category c', 'p.category_id=c.id')
            ->join('serial_number s', 'p.id=s.product_id and s.id=d.serial_number_id', 'left')
            ->where($condition)
            ->count_all_results();

        $count = $this->db->from('borrow b')->join('borrow_detail d', 'b.id=d.borrow_id')->count_all_results();
        $result = array('count' => $count, 'count_condition' => $count_condition, 'data' => $data, 'error_message' => '');
        return $result;
    }

    public function count_not_return(){
        $query = $this->db->from('borrow')
        ->where('return_status', false)
        ->count_all_results();
        return $query;
    }
    public function count_not_approve(){
        $query = $this->db->from('borrow')
        ->where('return_status', 0)
        ->count_all_results();
        return $query;
    }
}

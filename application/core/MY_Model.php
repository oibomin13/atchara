<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Model extends CI_Model
{
    /**
     * Variables
     **/
    protected $_table;
    protected $primary_key = 'id';

    protected $delete_db = false;
    protected $delete_tbref = array();

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * CRUD Interface
     **/
    public function find_all()
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->get();
        return $query->result_array();
    }

    public function count_all_refid($id, $table_ref)
    {
        $query = $this->db->select('*')
            ->from($table_ref)
            ->where($this->_table . '_id', $id);
        return $query->count_all_results();
    }

    public function find($id)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where(array($this->primary_key => $id))
            ->get();
        return $query->row_array();
    }

    public function find_all_active()
    {
        $query = $this->db->select('*')
            ->from($this->_table)            
            ->get();
        return $query->result_array();
        // ->where(array('is_active' => true))
    }

    public function find_active($id)
    {
        $query = $this->db->select('*')
            ->from($this->_table)
            ->where(array($this->primary_key => $id))
            ->get();
        return $query->row_array();
        // ->where(array('is_active' => true, $this->primary_key => $id))
    }

    public function save($data = null)
    {
        $this->db->insert($this->_table, $data);
    }

    public function update($data)
    {
        $this->db->where(array($this->primary_key => $data['id']));
        $this->db->update($this->_table, $data);
    }

    public function delete($id)
    {
        if ($this->delete_db) {
            if (!empty($this->delete_tbref)) {
                foreach ($this->delete_tbref as $item) {
                    $count = $this->count_all_refid($id, $item);
                    if ($count == 0) {
                        $this->db->where($this->primary_key, $id);
                        $this->db->delete($this->_table);
                        return true;
                    }
                    return false;
                }
            }
            return false;
        } else {
            $this->db->where($this->primary_key, $id);
            $this->db->delete($this->_table);
            return true;
        }

    }

    public function count()
    {
        $query = $this->db->from($this->_table)->count_all_results();
        return $query;
    }

    public function count_active()
    {
        $query = $this->db->from($this->_table)
            // ->where('is_active', true)
            ->count_all_results();
        return $query;
    }

}

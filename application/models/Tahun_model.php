<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun_model extends CI_Model
{

    public $table = 'tbl_tahun';
    public $id = 'tahun_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get id by status
    function get_id_by_status($status)
    {
        $this->db->where('tahun_status', $status);
        return $this->db->get($this->table)->row();
    }

    // get tahun aktif
    function get_tahun_aktif()
    {
        $this->db->where('tahun_status', '1');
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('tahun_id', $q);
	$this->db->or_like('tahun_id', $q);
	$this->db->or_like('tahun_nama', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('tahun_id', $q);
	$this->db->or_like('tahun_id', $q);
	$this->db->or_like('tahun_nama', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // update status data lain
    function update_status($status)
    {
        $this->db->set('tahun_status', $status);
        $this->db->update($this->table);
    }

    // update status data lain
    function update_status_lain($id,$status)
    {
        $this->db->set('tahun_status', $status);
        $this->db->where_not_in('tahun_id', $id);
        $this->db->update($this->table);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete bulkdata
    function deletebulk(){
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data); 
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
//check pk data is exists 

        function is_exist($id){
         $query = $this->db->get_where($this->table, array($this->id => $id));
         $count = $query->num_rows();
         if($count > 0){
            return true;
         }else{
            return false;
         }
        }


}

/* End of file Tahun_model.php */
/* Location: ./application/models/Tahun_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 17:41:23 */
/* http://harviacode.com */
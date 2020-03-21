<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'tbl_transaksi';
    public $id = 'trx_id';
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('trx_id', $q);
	$this->db->or_like('trx_id', $q);
	$this->db->or_like('trx_id_nomor_bukti', $q);
	$this->db->or_like('trx_mak', $q);
	$this->db->or_like('trx_penerima', $q);
	$this->db->or_like('trx_uraian', $q);
	$this->db->or_like('trx_jml_kotor', $q);
	$this->db->or_like('trx_ppn', $q);
	$this->db->or_like('trx_pph_21', $q);
	$this->db->or_like('trx_pph_22', $q);
	$this->db->or_like('trx_pph_23', $q);
	$this->db->or_like('trx_pph_4_2', $q);
	$this->db->or_like('trx_jml_bersih', $q);
	$this->db->or_like('trx_tanggal', $q);
	$this->db->or_like('trx_id_jenis_pembayaran', $q);
	$this->db->or_like('trx_id_metode_pembayaran', $q);
	$this->db->or_like('trx_id_unit', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL,$nb_id = NULL,$tahun) {
        if ($nb_id!=NULL){
            $this->db->where('trx_id_nomor_bukti', $nb_id);
        }
        $this->db->where('nb_id_tahun', $tahun);
        $this->db->order_by($this->id, $this->order);
        if ($q!=NULL){
            $this->db->like('trx_id', $q);
            $this->db->or_like('trx_id', $q);
            $this->db->or_like('trx_id_nomor_bukti', $q);
            $this->db->or_like('trx_mak', $q);
            $this->db->or_like('trx_penerima', $q);
            $this->db->or_like('trx_uraian', $q);
            $this->db->or_like('trx_jml_kotor', $q);
            $this->db->or_like('trx_ppn', $q);
            $this->db->or_like('trx_pph_21', $q);
            $this->db->or_like('trx_pph_22', $q);
            $this->db->or_like('trx_pph_23', $q);
            $this->db->or_like('trx_pph_4_2', $q);
            $this->db->or_like('trx_jml_bersih', $q);
            $this->db->or_like('trx_tanggal', $q);
            $this->db->or_like('trx_id_jenis_pembayaran', $q);
            $this->db->or_like('trx_id_metode_pembayaran', $q);
            $this->db->or_like('trx_id_unit', $q);
        }
        $this->db->join('tbl_nomor_bukti', 'trx_id_nomor_bukti=nb_id','left');
        $this->db->join('tbl_jenis_pembayaran', 'trx_id_jenis_pembayaran=jp_id','left');
        $this->db->join('tbl_metode_pembayaran', 'trx_id_metode_pembayaran=mp_id','left');
        $this->db->join('unit', 'trx_id_unit=id_unit','left');
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_limit_data_bku($limit, $start = 0, $q = NULL,$bulan,$tahun) {
        $this->db->where('MONTH(trx_tanggal)', $bulan);
        $this->db->where('nb_id_tahun', $tahun);
        $this->db->order_by($this->id, $this->order);
        if ($q!=NULL){
            $this->db->like('trx_id', $q);
            $this->db->or_like('trx_id', $q);
            $this->db->or_like('trx_id_nomor_bukti', $q);
            $this->db->or_like('trx_mak', $q);
            $this->db->or_like('trx_penerima', $q);
            $this->db->or_like('trx_uraian', $q);
            $this->db->or_like('trx_jml_kotor', $q);
            $this->db->or_like('trx_ppn', $q);
            $this->db->or_like('trx_pph_21', $q);
            $this->db->or_like('trx_pph_22', $q);
            $this->db->or_like('trx_pph_23', $q);
            $this->db->or_like('trx_pph_4_2', $q);
            $this->db->or_like('trx_jml_bersih', $q);
            $this->db->or_like('trx_tanggal', $q);
            $this->db->or_like('trx_id_jenis_pembayaran', $q);
            $this->db->or_like('trx_id_metode_pembayaran', $q);
            $this->db->or_like('trx_id_unit', $q);
        }
        $this->db->join('tbl_nomor_bukti', 'trx_id_nomor_bukti=nb_id','left');
        $this->db->join('tbl_jenis_pembayaran', 'trx_id_jenis_pembayaran=jp_id','left');
        $this->db->join('tbl_metode_pembayaran', 'trx_id_metode_pembayaran=mp_id','left');
        $this->db->join('unit', 'trx_id_unit=id_unit','left');
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

    // sum jumlah kotor pertahun
    function penerimaan($tahun_id)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('sum(trx_jml_kotor) as "total"');
        $this->db->from($this->table);
        $this->db->join('tbl_nomor_bukti', 'nb_id = trx_id_nomor_bukti');
        $this->db->where('nb_id_tahun', $tahun_id);
        return $this->db->get();
    }

    // sum jumlah bersih pertahun
    function pengeluaran($tahun_id,$nb_id)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('sum(trx_jml_bersih) as "total"');
        $this->db->from($this->table);
        $this->db->join('tbl_nomor_bukti', 'nb_id = trx_id_nomor_bukti');
        $this->db->where('nb_id_tahun', $tahun_id);
        if ($nb_id!=''){   
            $this->db->where('nb_id', $nb_id);
        }
        return $this->db->get();
    }

    // sum pajak pertahun
    function pajak($tahun_id)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('sum(trx_ppn) as "ppn",sum(trx_pph_21) as "pph21",sum(trx_pph_22) as "pph22",sum(trx_pph_23) as "pph23",sum(trx_pph_4_2) as "pph42"');
        $this->db->from($this->table);
        $this->db->join('tbl_nomor_bukti', 'nb_id = trx_id_nomor_bukti');
        $this->db->where('nb_id_tahun', $tahun_id);
        return $this->db->get();
    }
}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-14 14:30:11 */
/* http://harviacode.com */
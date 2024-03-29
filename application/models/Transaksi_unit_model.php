<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_unit_model extends CI_Model
{

    public $table = 'tbl_transaksi_unit';
    public $id = 'trxu_id';
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

     //bku unit
     function get_limit_data_bku_unit($limit, $start = 0, $q = NULL, $tahun,$bulan,$unit) {
        $this->db->order_by('trx_tanggal', $this->order);

	$this->db->limit($limit, $start);
	$this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
    $this->db->where('trx_id_tahun', $tahun);
    if($unit!=''){
        $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
    }
    if($bulan!=''){
        $this->db->where('month(trx_tanggal)', $bulan);
    }
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('trxu_id', $q);
	$this->db->or_like('trxu_id', $q);
	$this->db->or_like('trxu_nomor_bukti', $q);
	$this->db->or_like('trxu_mak', $q);
	$this->db->or_like('trxu_uraian', $q);
	$this->db->or_like('trxu_jml_kotor', $q);
	$this->db->or_like('trxu_ppn', $q);
	$this->db->or_like('trxu_pph_21', $q);
	$this->db->or_like('trxu_pph_22', $q);
	$this->db->or_like('trxu_pph_23', $q);
	$this->db->or_like('trxu_pph_4_2', $q);
	$this->db->or_like('trxu_jml_bersih', $q);
	$this->db->or_like('trxu_tanggal', $q);
	$this->db->or_like('trxu_id_jenis_pembayaran', $q);
	$this->db->or_like('trxu_id_metode_pembayaran', $q);
	$this->db->or_like('trxu_id_unit', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('trxu_id', $q);
	$this->db->or_like('trxu_id', $q);
	$this->db->or_like('trxu_nomor_bukti', $q);
	$this->db->or_like('trxu_mak', $q);
	$this->db->or_like('trxu_uraian', $q);
	$this->db->or_like('trxu_jml_kotor', $q);
	$this->db->or_like('trxu_ppn', $q);
	$this->db->or_like('trxu_pph_21', $q);
	$this->db->or_like('trxu_pph_22', $q);
	$this->db->or_like('trxu_pph_23', $q);
	$this->db->or_like('trxu_pph_4_2', $q);
	$this->db->or_like('trxu_jml_bersih', $q);
	$this->db->or_like('trxu_tanggal', $q);
	$this->db->or_like('trxu_id_jenis_pembayaran', $q);
	$this->db->or_like('trxu_id_metode_pembayaran', $q);
	$this->db->or_like('trxu_id_unit', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_data($nb) {
        $this->db->order_by($this->id, $this->order);
        $this->db->join('tbl_transaksi','tbl_transaksi.trx_id=tbl_transaksi_unit.trxu_nomor_bukti','left');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi_unit.trxu_id_jenis_pembayaran','left');
        $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi_unit.trxu_id_metode_pembayaran','left');
        $this->db->join('unit','unit.id=tbl_transaksi.trx_fk_unit','left');
        $this->db->where('trxu_nomor_bukti', $nb);
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_saldo_akhir($tahun,$bulan,$unit) {
        $this->db->select('sum(trx_penerimaan) - sum(trx_pengeluaran) as "saldo_akhir"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_jk($tahun,$bulan,$unit) {
        if ($bulan<0){
            $bulan='';
        }
        $this->db->select('sum(trx_pengeluaran) as "jmlh_kotor"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_jk_sd($tahun,$bulan,$unit) {
        $this->db->select('sum(trx_pengeluaran) as "jmlh_kotor"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $this->db->where('month(trx_tanggal) <= '.$bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_penerimaan($tahun,$bulan,$unit) {
        $this->db->select('sum(trx_penerimaan) as "penerimaan"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_penerimaan_sd($tahun,$bulan,$unit) {
        $this->db->select('sum(trx_penerimaan) as "penerimaan"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $this->db->where('month(trx_tanggal) <= '.$bulan);
        }
        return $this->db->get($this->table)->row();
    }

     // get data with limit and search
     function get_saldo_awal($tahun,$bulan,$unit) {
        $this->db->select('sum(trx_penerimaan) - sum(trx_pengeluaran) as "saldo_awal"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan-1);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_saldo_awal_sd($tahun,$bulan,$unit) {
        $this->db->select('sum(trx_penerimaan) - sum(trx_pengeluaran) as "saldo_awal"');
        $this->db->join('tbl_transaksi','tbl_transaksi_unit.trxu_nomor_bukti=tbl_transaksi.trx_id','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($unit!=''){
            $this->db->where('tbl_transaksi.trx_fk_unit', $unit);
        }
        if($bulan!=''){
            $bulan=$bulan-1;
            $this->db->where('month(trx_tanggal) <= '.$bulan);
        }
        return $this->db->get($this->table)->row();
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

        public function setBatchImport($batchImport) {
            $this->_batchImport = $batchImport;
        }
     
        public function importData() {
            $data = $this->_batchImport;
            $this->db->insert_batch('tbl_transaksi_unit', $data);
        }

        public function hapus_transaksi_unit() {
            $this->db->from('tbl_transaksi_unit');
            $this->db->truncate();
        }

}

/* End of file Transaksi_unit_model.php */
/* Location: ./application/models/Transaksi_unit_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-05 14:37:21 */
/* http://harviacode.com */
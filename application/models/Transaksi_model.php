<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{

    public $table = 'tbl_transaksi';
    public $id = 'trx_id';
    public $order = 'ASC';

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

    // get data by nb
    function get_by_no($nb)
    {
        $this->db->where('trx_nomor_bukti', $nb);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('trx_id', $q);
	$this->db->or_like('trx_id', $q);
	$this->db->or_like('trx_nomor_bukti', $q);
	$this->db->or_like('trx_mak', $q);
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
	$this->db->or_like('trx_jenis', $q);
	$this->db->or_like('trx_penerimaan', $q);
	$this->db->or_like('trx_pengeluaran', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $tahun,$bulan,$nb) {
        $this->db->order_by($this->id, $this->order);
    //     $this->db->like('trx_id', $q);
	// $this->db->or_like('trx_id', $q);
	// $this->db->or_like('trx_nomor_bukti', $q);
	// $this->db->or_like('trx_mak', $q);
	// $this->db->or_like('trx_uraian', $q);
	// $this->db->or_like('trx_jml_kotor', $q);
	// $this->db->or_like('trx_ppn', $q);
	// $this->db->or_like('trx_pph_21', $q);
	// $this->db->or_like('trx_pph_22', $q);
	// $this->db->or_like('trx_pph_23', $q);
	// $this->db->or_like('trx_pph_4_2', $q);
	// $this->db->or_like('trx_jml_bersih', $q);
	// $this->db->or_like('trx_tanggal', $q);
	// $this->db->or_like('trx_id_jenis_pembayaran', $q);
	// $this->db->or_like('trx_id_metode_pembayaran', $q);
	// $this->db->or_like('trx_id_unit', $q);
	// $this->db->or_like('trx_jenis', $q);
	// $this->db->or_like('trx_penerimaan', $q);
	// $this->db->or_like('trx_pengeluaran', $q);
	$this->db->limit($limit, $start);
	$this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	$this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
    $this->db->where('trx_id_tahun', $tahun);
    if($bulan!=''){
        $this->db->where('month(trx_tanggal)', $bulan);
    }
    if($nb!=''){
        $this->db->where('trx_id', $nb);
    }
        return $this->db->get($this->table)->result();
    }

    // get data with limit and search
    function get_saldo($tahun,$bulan,$nb) {
        $this->db->select('sum(trx_penerimaan) as "saldo_awal", sum(trx_pengeluaran) as "saldo_akhir"');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        if($nb!=''){
            $this->db->where('trx_id', $nb);
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

        function is_exist($no_bukti){
         $query = $this->db->get_where($this->table, array('trx_nomor_bukti' => $no_bukti));
         $count = $query->num_rows();
         if($count > 0){
            return true;
         }else{
            return false;
         }
        }

        // get data dropdown
    function dd()
    {
        // ambil data dari db
        $this->db->order_by($this->id, $this->order);
        $result = $this->db->get($this->table);
        // bikin array
        // please select berikut ini merupakan tambahan saja agar saat pertama
        // diload akan ditampilkan text please select.
        $dd[''] = '-- Pilih Nomor Bukti --';
        if ($result->num_rows() > 0) {
            foreach ($result->result() as $row) {
            // tentukan value (sebelah kiri) dan labelnya (sebelah kanan)
                $dd[$row->trx_id] = $row->trx_nomor_bukti;
            }
        }
        return $dd;
    }

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }
 
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('tbl_transaksi', $data);
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-04 05:47:04 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buku_pembantu2_model extends CI_Model
{

    public $table = 'tbl_transaksi';
    public $id = 'trx_id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get data with limit and search
    function get_saldo_akhir($tahun,$bulan,$mp) {
        $this->db->select('sum(trx_penerimaan) - sum(trx_pengeluaran) as "saldo_akhir"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_jk($tahun,$bulan,$mp) {
        if ($bulan<0){
            $bulan='';
        }
        $this->db->select('sum(trx_pengeluaran) as "jmlh_kotor"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_jk_sd($tahun,$bulan,$mp) {
        $this->db->select('sum(trx_pengeluaran) as "jmlh_kotor"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal) <= '.$bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_penerimaan($tahun,$bulan,$mp) {
        $this->db->select('sum(trx_penerimaan) as "penerimaan"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_penerimaan_sd($tahun,$bulan,$mp) {
        $this->db->select('sum(trx_penerimaan) as "penerimaan"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal) <= '.$bulan);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_saldo_awal($tahun,$bulan,$mp) {
        $this->db->select('sum(trx_penerimaan) - sum(trx_pengeluaran) as "saldo_awal"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $this->db->where('month(trx_tanggal)', $bulan-1);
        }
        return $this->db->get($this->table)->row();
    }

    // get data with limit and search
    function get_saldo_awal_sd($tahun,$bulan,$mp) {
        $this->db->select('sum(trx_penerimaan) - sum(trx_pengeluaran) as "saldo_awal"');
        $this->db->join('tbl_jenis_pembayaran','tbl_jenis_pembayaran.jp_id=tbl_transaksi.trx_id_jenis_pembayaran','left');
	    $this->db->join('tbl_metode_pembayaran','tbl_metode_pembayaran.mp_id=tbl_transaksi.trx_id_metode_pembayaran','left');
        $this->db->order_by($this->id, $this->order);
        $this->db->where('trx_id_tahun', $tahun);
        $this->db->where('trx_id_metode_pembayaran', $mp);
        if($bulan!=''){
            $bulan=$bulan-1;
            $this->db->where('month(trx_tanggal) <= '.$bulan);
        }
        return $this->db->get($this->table)->row();
    }

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-04 05:47:04 */
/* http://harviacode.com */
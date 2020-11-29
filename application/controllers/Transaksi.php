<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Transaksi_model');
        $this->load->model('Jenis_pembayaran_model');
        $this->load->model('Metode_pembayaran_model');
        $this->load->model('Tahun_model');
        $this->load->model('Bulan_model');
        $this->load->model('Unit_model');
        $this->load->model('Transaksi_unit_model');
        $this->load->model('Pajak_model');
        $this->load->library('form_validation');
        $this->id_tahun=$this->Tahun_model->get_id_by_status(1)->tahun_id;
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'transaksi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transaksi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transaksi';
            $config['first_url'] = base_url() . 'transaksi';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transaksi_model->total_rows($q);
        $tahun=$this->Tahun_model->get_by_id($this->session->userdata('tahun_aktif'))->tahun_nama;
        if($this->input->get('nb')){
            $nb = $this->input->get('nb'); 
        }else{
            $nb = '';   
        }
        if($this->input->get('bulan')){
            $bulan = $this->input->get('bulan'); 
        }else{
            $bulan = '';   
        }
        $transaksi = $this->Transaksi_model->get_limit_data($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$bulan,$nb);
        // var_dump($transaksi);
        $saldo_akhir_data = $this->Transaksi_model->get_saldo_akhirx($config['per_page']+($start-10), 0, $q,$this->session->userdata('tahun_aktif'),$bulan,$nb);
                // echo $this->db->last_query();

        $saldo_akhir=0; 
        foreach ($saldo_akhir_data as $saldo)
        { 
            $saldo_awal=$saldo->trx_penerimaan+$saldo_akhir;
            $saldo_akhir=$saldo_awal-$saldo->trx_pengeluaran;
        }

        $transaksi_unit=array();
        foreach ($transaksi as $key) {
            $transaksi_unit[] = $this->Transaksi_unit_model->get_data($key->trx_id);
        }
        $saldo = $this->Transaksi_model->get_saldo($this->session->userdata('tahun_aktif'),$bulan,$nb);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi_data' => $transaksi,
            'transaksi_unit' => $transaksi_unit,
            'saldo' => $saldo,
            'saldo_akhir' => $saldo_akhir,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kontrol Transaksi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Transaksi' => '',
        ];
        $data['tahun_aktif'] = $tahun;
        $data['no_bukti']=$this->Transaksi_model->dd();
        $data['bulan']=$this->Bulan_model->dd();
        $data['attribute'] = 'class="form-control" id="nb" required';
        $data['attribute2'] = 'class="form-control" id="bulan" required';
        $data['trx_nomor_bukti'] = $nb;
        $data['trx_bulan'] = $bulan;

        $data['code_js'] = 'transaksi/codejs';
        $data['page'] = 'transaksi/Transaksi_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'trx_id' => $row->trx_id,
		'trx_nomor_bukti' => $row->trx_nomor_bukti,
		'trx_mak' => $row->trx_mak,
		'trx_uraian' => $row->trx_uraian,
		'trx_jml_kotor' => $row->trx_jml_kotor,
		'trx_ppn' => $row->trx_ppn,
		'trx_pph_21' => $row->trx_pph_21,
		'trx_pph_22' => $row->trx_pph_22,
		'trx_pph_23' => $row->trx_pph_23,
		'trx_pph_4_2' => $row->trx_pph_4_2,
		'trx_jml_bersih' => $row->trx_jml_bersih,
		'trx_tanggal' => $row->trx_tanggal,
		'trx_id_jenis_pembayaran' => $row->trx_id_jenis_pembayaran,
		'trx_id_metode_pembayaran' => $row->trx_id_metode_pembayaran,
		'trx_id_unit' => $row->trx_id_unit,
		'trx_jenis' => $row->trx_jenis,
		'trx_penerimaan' => $row->trx_penerimaan,
		'trx_pengeluaran' => $row->trx_pengeluaran,
	    );
        $data['title'] = 'Transaksi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'transaksi/Transaksi_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/create_action'),
            'trx_id' => set_value('trx_id'),
	    'trx_nomor_bukti' => set_value('trx_nomor_bukti'),
	    'trx_mak' => set_value('trx_mak'),
	    'trx_uraian' => set_value('trx_uraian'),
	    'trx_jml_kotor' => set_value('trx_jml_kotor'),
	    'trx_ppn' => set_value('trx_ppn'),
	    'trx_pph_21' => set_value('trx_pph_21'),
	    'trx_pph_22' => set_value('trx_pph_22'),
	    'trx_pph_23' => set_value('trx_pph_23'),
	    'trx_pph_4_2' => set_value('trx_pph_4_2'),
	    'trx_jml_bersih' => set_value('trx_jml_bersih'),
	    'trx_tanggal' => set_value('trx_tanggal'),
	    'trx_id_jenis_pembayaran' => set_value('trx_id_jenis_pembayaran'),
	    'trx_id_metode_pembayaran' => set_value('trx_id_metode_pembayaran'),
	    'trx_id_unit' => set_value('trx_id_unit'),
	    'trx_jenis' => set_value('trx_jenis'),
	    'trx_penerimaan' => set_value('trx_penerimaan'),
	    'trx_pengeluaran' => set_value('trx_pengeluaran'),
	    'trx_fk_unit' => set_value('trx_fk_unit'),
	    'trx_id_pajak' => set_value('trx_id_pajak'),
    );
        $data['jp']=$this->Jenis_pembayaran_model->dd();
        $data['mp']=$this->Metode_pembayaran_model->dd();
        $data['unit']=$this->Unit_model->dd();
        $data['pajak']=$this->Pajak_model->dd();
        $data['jenis']=array(
            ""=>"--Pilih Jenis Transaksi--",
            "0"=>"Penerimaan",
            "1"=>"Pengeluaraan"
        );
        $data['attribute'] = 'class="form-control" required ';
        $data['attribute2'] = 'class="form-control" required id="trx_jenis"';
        $data['attribute3'] = 'class="form-control" id="unit" style="display:none"';
        $data['attribute4'] = 'class="form-control" id="id_pajak"';
        $data['title'] = 'Kontrol Transaksi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['code_js'] = 'transaksi/codejs';

        $data['page'] = 'transaksi/Transaksi_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
 
        } else {
            if ($this->input->post('unit',TRUE)==''){
                $fk_unit='0';
            }else{
                $fk_unit=$this->input->post('unit',TRUE);
            }
            if ($this->input->post('trx_id_pajak',TRUE)==''){
                $id_pajak='0';
            }else{
                $id_pajak=$this->input->post('trx_id_pajak',TRUE);
            }
            $data = array(
		'trx_nomor_bukti' => $this->input->post('trx_nomor_bukti',TRUE),
		'trx_mak' => $this->input->post('trx_mak',TRUE),
		'trx_uraian' => $this->input->post('trx_uraian',TRUE),
		'trx_jml_kotor' => $this->input->post('trx_jml_kotor',TRUE),
		'trx_ppn' => $this->input->post('trx_ppn',TRUE),
		'trx_pph_21' => $this->input->post('trx_pph_21',TRUE),      
		'trx_pph_22' => $this->input->post('trx_pph_22',TRUE),
		'trx_pph_23' => $this->input->post('trx_pph_23',TRUE),
		'trx_pph_4_2' => $this->input->post('trx_pph_4_2',TRUE),
		'trx_jml_bersih' => $this->input->post('trx_jml_bersih',TRUE),
		'trx_tanggal' => $this->input->post('trx_tanggal',TRUE),
		'trx_id_jenis_pembayaran' => $this->input->post('trx_id_jenis_pembayaran',TRUE),
		'trx_id_metode_pembayaran' => $this->input->post('trx_id_metode_pembayaran',TRUE),
		'trx_id_unit' => $this->input->post('trx_id_unit',TRUE),
		'trx_jenis' => $this->input->post('trx_jenis',TRUE),
		'trx_penerimaan' => $this->input->post('trx_penerimaan',TRUE),
		'trx_pengeluaran' => $this->input->post('trx_pengeluaran',TRUE),
		'trx_id_tahun' => $this->session->userdata('tahun_aktif'),
		'trx_fk_unit' => $fk_unit,
		'trx_id_pajak' => $id_pajak
        );
        
if(! $this->Transaksi_model->is_exist($this->input->post('trx_nomor_bukti'))){
                $this->Transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi'));
            }else{
                // echo $this->db->last_query();

                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, nomor bukti is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
		'trx_id' => set_value('trx_id', $row->trx_id),
		'trx_nomor_bukti' => set_value('trx_nomor_bukti', $row->trx_nomor_bukti),
		'trx_mak' => set_value('trx_mak', $row->trx_mak),
		'trx_uraian' => set_value('trx_uraian', $row->trx_uraian),
		'trx_jml_kotor' => set_value('trx_jml_kotor', $row->trx_jml_kotor),
		'trx_ppn' => set_value('trx_ppn', $row->trx_ppn),
		'trx_pph_21' => set_value('trx_pph_21', $row->trx_pph_21),
		'trx_pph_22' => set_value('trx_pph_22', $row->trx_pph_22),
		'trx_pph_23' => set_value('trx_pph_23', $row->trx_pph_23),
		'trx_pph_4_2' => set_value('trx_pph_4_2', $row->trx_pph_4_2),
		'trx_jml_bersih' => set_value('trx_jml_bersih', $row->trx_jml_bersih),
		'trx_tanggal' => set_value('trx_tanggal', $row->trx_tanggal),
		'trx_id_jenis_pembayaran' => set_value('trx_id_jenis_pembayaran', $row->trx_id_jenis_pembayaran),
		'trx_id_metode_pembayaran' => set_value('trx_id_metode_pembayaran', $row->trx_id_metode_pembayaran),
		'trx_id_unit' => set_value('trx_id_unit', $row->trx_id_unit),
		'trx_jenis' => set_value('trx_jenis', $row->trx_jenis),
		'trx_penerimaan' => set_value('trx_penerimaan', $row->trx_penerimaan),
		'trx_pengeluaran' => set_value('trx_pengeluaran', $row->trx_pengeluaran),
	    'trx_fk_unit' => set_value('trx_fk_unit', $row->trx_fk_unit),
	    'trx_id_pajak' => set_value('trx_id_pajak', $row->trx_id_pajak),
        );
        $data['jp']=$this->Jenis_pembayaran_model->dd();
        $data['mp']=$this->Metode_pembayaran_model->dd();
        $data['unit']=$this->Unit_model->dd();
        $data['pajak']=$this->Pajak_model->dd();
        $data['jenis']=array(
            ""=>"--Pilih Jenis Transaksi--",
            "0"=>"Penerimaan",
            "1"=>"Pengeluaraan"
        );
        $data['attribute'] = 'class="form-control" required ';
        if ($row->trx_fk_unit!='0'){
            $data['attribute3'] = 'class="form-control" id="unit"';
        }else{
            $data['attribute3'] = 'class="form-control" id="unit" style="display:none"';
        }
        $data['attribute2'] = 'class="form-control" required id="trx_jenis"';
        $data['attribute4'] = 'class="form-control" id="id_pajak"';
            $data['title'] = 'Transaksi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['code_js'] = 'transaksi/codejs';

        $data['page'] = 'transaksi/Transaksi_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('trx_id', TRUE));
        } else {
            if ($this->input->post('unit',TRUE)==''){
                $fk_unit='0';
            }else{
                $fk_unit=$this->input->post('unit',TRUE);
            }
            if ($this->input->post('trx_id_pajak',TRUE)==''){
                $id_pajak='0';
            }else{
                $id_pajak=$this->input->post('trx_id_pajak',TRUE);
            }
            $data = array(
		'trx_id' => $this->input->post('trx_id',TRUE),
		'trx_nomor_bukti' => $this->input->post('trx_nomor_bukti',TRUE),
		'trx_mak' => $this->input->post('trx_mak',TRUE),
		'trx_uraian' => $this->input->post('trx_uraian',TRUE),
		'trx_jml_kotor' => $this->input->post('trx_jml_kotor',TRUE),
		'trx_ppn' => $this->input->post('trx_ppn',TRUE),
		'trx_pph_21' => $this->input->post('trx_pph_21',TRUE),
		'trx_pph_22' => $this->input->post('trx_pph_22',TRUE),
		'trx_pph_23' => $this->input->post('trx_pph_23',TRUE),
		'trx_pph_4_2' => $this->input->post('trx_pph_4_2',TRUE),
		'trx_jml_bersih' => $this->input->post('trx_jml_bersih',TRUE),
		'trx_tanggal' => $this->input->post('trx_tanggal',TRUE),
		'trx_id_jenis_pembayaran' => $this->input->post('trx_id_jenis_pembayaran',TRUE),
		'trx_id_metode_pembayaran' => $this->input->post('trx_id_metode_pembayaran',TRUE),
		'trx_id_unit' => $this->input->post('trx_id_unit',TRUE),
		'trx_jenis' => $this->input->post('trx_jenis',TRUE),
		'trx_penerimaan' => $this->input->post('trx_penerimaan',TRUE),
		'trx_pengeluaran' => $this->input->post('trx_pengeluaran',TRUE),
		'trx_fk_unit' => $fk_unit,
		'trx_id_pajak' => $id_pajak,
	    );

            $this->Transaksi_model->update($this->input->post('trx_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function deletebulk(){
        $delete = $this->Transaksi_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('trx_nomor_bukti', 'trx nomor bukti', 'trim|required');
	// $this->form_validation->set_rules('trx_mak', 'trx mak', 'trim|required');
	$this->form_validation->set_rules('trx_uraian', 'trx uraian', 'trim|required');
	// $this->form_validation->set_rules('trx_jml_kotor', 'trx jml kotor', 'trim|required|numeric');
	$this->form_validation->set_rules('trx_tanggal', 'trx tanggal', 'trim|required');
	$this->form_validation->set_rules('trx_id_jenis_pembayaran', 'trx id jenis pembayaran', 'trim|required');
	$this->form_validation->set_rules('trx_id_metode_pembayaran', 'trx id metode pembayaran', 'trim|required');
	// $this->form_validation->set_rules('trx_id_unit', 'trx id unit', 'trim|required');
	$this->form_validation->set_rules('trx_jenis', 'trx jenis', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        // $this->Transaksi_model->get_all();
        // echo $this->db->last_query();

        $this->load->helper('exportexcel');
        $namaFile = "kontrol transaksi.xls";
        $judul = "Kontrol Transaksi BKU";
        $tablehead = 0;
        $tablebody = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Transaksi");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
        xlsWriteLabel($tablehead, $kolomhead++, "Nomor Bukti");
        xlsWriteLabel($tablehead, $kolomhead++, "MAK");
        xlsWriteLabel($tablehead, $kolomhead++, "Penerima");
        xlsWriteLabel($tablehead, $kolomhead++, "Uraian");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Kotor");
        xlsWriteLabel($tablehead, $kolomhead++, "PPn");
        xlsWriteLabel($tablehead, $kolomhead++, "PPh 21");
        xlsWriteLabel($tablehead, $kolomhead++, "PPh 22");
        xlsWriteLabel($tablehead, $kolomhead++, "PPh 23");
        xlsWriteLabel($tablehead, $kolomhead++, "PPh 4(2)");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Pajak");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Bersih");
        xlsWriteLabel($tablehead, $kolomhead++, "Penerimaan");
        xlsWriteLabel($tablehead, $kolomhead++, "Pengeluaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Saldo");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Pembayaran");
        xlsWriteLabel($tablehead, $kolomhead++, "Metode Pembayaran");

        $saldo_akhir=0;
        $transaksi=$this->Transaksi_model->get_all();
        $transaksi_unit=array();
        foreach ($transaksi as $key) {
            $transaksi_unit[] = $this->Transaksi_unit_model->get_data($key->trx_id);
        }
        $i=0;
	    foreach ($transaksi as $data) {
            $kolombody = 0;
            $saldo_akhir=$saldo_akhir+$data->trx_penerimaan-$data->trx_pengeluaran;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteLabel($tablebody, $kolombody++, 'Utama');
            xlsWriteLabel($tablebody, $kolombody++, $data->trx_tanggal);
            xlsWriteLabel($tablebody, $kolombody++, $data->trx_nomor_bukti);
            xlsWriteLabel($tablebody, $kolombody++, $data->trx_mak);
            if ($data->trx_fk_unit=='0'){ 
                xlsWriteLabel($tablebody, $kolombody++, $data->trx_id_unit);
            }else{ 
                xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            }
            xlsWriteLabel($tablebody, $kolombody++, $data->trx_uraian);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_jml_kotor);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_ppn);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_21);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_22);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_23);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_4_2);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_ppn+$data->trx_pph_21+$data->trx_pph_22+$data->trx_pph_23+$data->trx_pph_4_2);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_jml_bersih);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_penerimaan);
            xlsWriteNumber($tablebody, $kolombody++, $data->trx_pengeluaran);
            xlsWriteNumber($tablebody, $kolombody++, $saldo_akhir);
            xlsWriteNumber($tablebody, $kolombody++, $data->jp_nama);
            xlsWriteNumber($tablebody, $kolombody++, $data->mp_nama);
            $tablebody++;
                foreach ($transaksi_unit[$i++] as $transaksi2)
                { 
                    $kolombody = 0;
                    xlsWriteLabel($tablebody, $kolombody++, 'Unit');
                    xlsWriteLabel($tablebody, $kolombody++, $transaksi2->trxu_tanggal);
                    xlsWriteLabel($tablebody, $kolombody++, '');
                    xlsWriteLabel($tablebody, $kolombody++, $transaksi2->nama);
                    xlsWriteLabel($tablebody, $kolombody++, $transaksi2->trxu_uraian);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_jml_kotor);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_ppn);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_pph_21);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_pph_22);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_pph_23);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_pph_4_2);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_ppn+$transaksi2->trxu_pph_21+$transaksi2->trxu_pph_22+$transaksi2->trxu_pph_23+$transaksi2->trxu_pph_4_2);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->trxu_jml_bersih);
                    xlsWriteNumber($tablebody, $kolombody++, '');
                    xlsWriteNumber($tablebody, $kolombody++, '');
                    xlsWriteNumber($tablebody, $kolombody++, '');
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->jp_nama);
                    xlsWriteNumber($tablebody, $kolombody++, $transaksi2->mp_nama);
                    $tablebody++;
                }
        }

        xlsEOF();
        exit();
    }

    public function import(){
    if(!empty($_FILES['file']['name'])) { 
        // get file extension
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        if($extension == 'csv'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif($extension == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }
        // file path
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $dataNoTrx = $spreadsheet->getSheetByName('Kontrol Transaksi')->toArray(null, true, true, true);
        // var_dump($dataNoTrx);
    
        // array Count
        $arrayCount = count($dataNoTrx);
        $flag = 0;
        $createArray = array('Jenis','Tanggal', 'Nomor Bukti', 'MAK', 'Penerima', 'Uraian','Jumlah Kotor','PPn','PPh 21','PPh 22','PPh 23','PPh 4(2)','Jumlah Bersih','Penerimaan','Pengeluaran','Bank/Tunai','GU/LS','Nama Unit','Jenis Pajak');
        $makeArray = array('Jenis' => 'Jenis', 
                            'Tanggal' => 'Tanggal', 
                            'NomorBukti' => 'NomorBukti', 
                            'MAK' => 'MAK',
                            'Penerima' => 'Penerima', 
                            'Uraian' => 'Uraian', 
                            'JumlahKotor' => 'JumlahKotor', 
                            'PPn' => 'PPn', 
                            'PPh21' => 'PPh21', 
                            'PPh22' => 'PPh22', 
                            'PPh23' => 'PPh23', 
                            'PPh4(2)' => 'PPh4(2)', 
                            'JumlahBersih' => 'JumlahBersih', 
                            'Penerimaan' => 'Penerimaan', 
                            'Pengeluaran' => 'Pengeluaran', 
                            'Bank/Tunai' => 'Bank/Tunai', 
                            'GU/LS' => 'GU/LS', 
                            'NamaUnit' => 'NamaUnit',
                            'JenisPajak' => 'JenisPajak' );
        $SheetDataKey = array();
        foreach ($dataNoTrx as $dataInSheet) {
            foreach ($dataInSheet as $key => $value) {
                if (in_array(trim($value), $createArray)) {
                   $value = preg_replace('/\s+/', '', $value);
                    $SheetDataKey[trim($value)] = $key;
                } 
            }
        }
        $dataDiff = array_diff_key($makeArray, $SheetDataKey);
        // var_dump($SheetDataKey);

        if (empty($dataDiff)) {
            $flag = 1;
        }
        // match excel sheet column
        if ($flag == 1) {
            for ($i = 3; $i <= $arrayCount; $i++) {
                $jenis = $SheetDataKey['Jenis'];
                $no = $SheetDataKey['NomorBukti'];
                $tgl = $SheetDataKey['Tanggal'];
                $mak = $SheetDataKey['MAK'];
                $penerima = $SheetDataKey['Penerima'];
                $uraian = $SheetDataKey['Uraian'];
                $jml_kotor = $SheetDataKey['JumlahKotor'];
                $ppn = $SheetDataKey['PPn'];
                $pph21 = $SheetDataKey['PPh21'];
                $pph22 = $SheetDataKey['PPh22'];
                $pph23 = $SheetDataKey['PPh23'];
                $pph42 = $SheetDataKey['PPh4(2)'];
                $jml_bersih = $SheetDataKey['JumlahBersih'];
                $penerimaan = $SheetDataKey['Penerimaan'];
                $pengeluaran = $SheetDataKey['Pengeluaran'];
                $bt = $SheetDataKey['Bank/Tunai'];
                $guls = $SheetDataKey['GU/LS'];
                $unit = $SheetDataKey['NamaUnit'];
                $pajak = $SheetDataKey['JenisPajak'];

                $jenis_data = filter_var(trim($dataNoTrx[$i][$jenis]), FILTER_SANITIZE_STRING);
                $no = filter_var(trim($dataNoTrx[$i][$no]), FILTER_SANITIZE_STRING);
                $tgl = filter_var(trim($dataNoTrx[$i][$tgl]), FILTER_SANITIZE_STRING);
                $mak = filter_var(trim($dataNoTrx[$i][$mak]), FILTER_SANITIZE_STRING);
                $penerima = filter_var(trim($dataNoTrx[$i][$penerima]), FILTER_SANITIZE_STRING);
                $uraian = filter_var(trim($dataNoTrx[$i][$uraian]), FILTER_SANITIZE_STRING);
                $jml_kotor = filter_var(trim($dataNoTrx[$i][$jml_kotor]), FILTER_SANITIZE_NUMBER_FLOAT);
                $ppn = filter_var(trim($dataNoTrx[$i][$ppn]), FILTER_SANITIZE_NUMBER_FLOAT);
                $pph21 = filter_var(trim($dataNoTrx[$i][$pph21]), FILTER_SANITIZE_NUMBER_FLOAT);
                $pph22 = filter_var(trim($dataNoTrx[$i][$pph22]), FILTER_SANITIZE_NUMBER_FLOAT);
                $pph23 = filter_var(trim($dataNoTrx[$i][$pph23]), FILTER_SANITIZE_NUMBER_FLOAT);
                $pph42 = filter_var(trim($dataNoTrx[$i][$pph42]), FILTER_SANITIZE_NUMBER_FLOAT);
                $jml_bersih = filter_var(trim($dataNoTrx[$i][$jml_bersih]), FILTER_SANITIZE_NUMBER_FLOAT);
                $penerimaan = filter_var(trim($dataNoTrx[$i][$penerimaan]), FILTER_SANITIZE_NUMBER_FLOAT);
                $pengeluaran = filter_var(trim($dataNoTrx[$i][$pengeluaran]), FILTER_SANITIZE_NUMBER_FLOAT);
                $bt = $this->Jenis_pembayaran_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$bt]), FILTER_SANITIZE_STRING))->jp_id;
                $guls = $this->Metode_pembayaran_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$guls]), FILTER_SANITIZE_STRING))->mp_id;
                $unit = $this->Unit_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$unit]), FILTER_SANITIZE_STRING))->id;
                $pajak = $this->Pajak_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$pajak]), FILTER_SANITIZE_STRING))->id;
                // echo $this->db->last_query();

                $jenis=$penerimaan==''?'0':'1';
                if($jenis_data=='Utama'){
                    $fetchData=array();
                    if (count($fetchData)>0){
                        unset($fetchData);
                    }
                    $fetchData[] = array('trx_nomor_bukti' => $no, 
                                    'trx_mak' => $mak, 
                                    'trx_uraian' => $uraian,
                                    'trx_id_unit' => $penerima, 
                                    'trx_jml_kotor' => $jml_kotor, 
                                    'trx_ppn' => $ppn, 
                                    'trx_pph_21' => $pph21,
                                    'trx_pph_22' => $pph22,
                                    'trx_pph_23' => $pph23,
                                    'trx_pph_4_2' => $pph42,
                                    'trx_jml_bersih' => $jml_bersih,
                                    'trx_tanggal' => $tgl,
                                    'trx_id_jenis_pembayaran' => $bt,
                                    'trx_id_metode_pembayaran' => $guls,
                                    'trx_jenis' => $jenis,
                                    'trx_penerimaan' => $penerimaan,
                                    'trx_pengeluaran' => $pengeluaran, 
                                    'trx_id_tahun' => $this->session->userdata('tahun_aktif'),
                                    'trx_fk_unit' => $unit,
                                    'trx_id_pajak' => $pajak );
                    $this->Transaksi_model->setBatchImport($fetchData);
                    if(!$this->Transaksi_model->importData()){
                        $this->session->set_flashdata('message', 'Import Excel Success');
                    }
                }else{
                    $fetchData2=array();
                    if (count($fetchData2)>0){
                        unset($fetchData2);
                    }
                    $no=$this->Transaksi_model->get_by_no($no)->trx_id;
                    $fetchData2[] = array('trxu_nomor_bukti' => $no, 
                                    'trxu_mak' => $mak, 
                                    'trxu_uraian' => $uraian,
                                    'trxu_jml_kotor' => $jml_kotor, 
                                    'trxu_ppn' => $ppn, 
                                    'trxu_pph_21' => $pph21,
                                    'trxu_pph_22' => $pph22,
                                    'trxu_pph_23' => $pph23,
                                    'trxu_pph_4_2' => $pph42,
                                    'trxu_jml_bersih' => $jml_bersih,
                                    'trxu_tanggal' => $tgl,
                                    'trxu_id_jenis_pembayaran' => $bt,
                                    'trxu_id_metode_pembayaran' => $guls);
                                    var_dump($fetchData2);

                    $this->Transaksi_unit_model->setBatchImport($fetchData2);

                    // echo $this->db->last_query();

                    if(!$this->Transaksi_unit_model->importData()){
                        $this->session->set_flashdata('message', 'Import Excel Success');
                    }
                }
            }   
            $data['dataInfo'] = $fetchData;
            redirect('transaksi');

        } else {
            $this->session->set_flashdata('message_error', 'Maaf importlah file sesuai format yang diberikan, jumlah kolom tidak sesuai');
            // redirect('transaksi');
        }
    }    
    }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-04 05:47:04 */
/* http://harviacode.com */
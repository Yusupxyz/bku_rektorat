<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    // require('./vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Transaksi_model');
        $this->load->model('Transaksi_unit_model');
        $this->load->model('Jenis_pembayaran_model');
        $this->load->model('Metode_pembayaran_model');
        $this->load->model('Tahun_model');
        $this->load->model('Bulan_model');
        $this->load->model('Setting_laporan_model');
        $this->load->model('Saldo_awal_model');
        $this->load->model('Saldo_akhir_model');
        $this->load->library('form_validation');
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
        if($this->input->get('buku')=='bku'){
            $transaksi = $this->Transaksi_model->get_limit_data_bku($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'));
        }elseif($this->input->get('buku')=='bku_unit'){
            $transaksi = $this->Transaksi_unit_model->get_limit_data_bku_unit($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),$this->input->get('unit'));
        }elseif($this->input->get('buku')=='kas_bank'){
            $transaksi = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'1');
        }elseif($this->input->get('buku')=='kas_tunai'){
            $transaksi = $this->Transaksi_model->get_limit_data_bku_pembantu($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'2');
        }elseif($this->input->get('buku')=='bp_up'){
            $transaksi = $this->Transaksi_model->get_limit_data_bku_pembantu2($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'1');
        }elseif($this->input->get('buku')=='bp_lsb'){
            $transaksi = $this->Transaksi_model->get_limit_data_bku_pembantu2($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'),'2');
        }elseif($this->input->get('buku')=='bp_pajak'){
            $transaksi = $this->Transaksi_model->get_limit_data_bku_pajak($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'));
            $pajak_bulan_lalu = $this->Transaksi_model->get_limit_data_bku_pajak($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),(int)$this->input->get('bulan')-1);
            $pajak_tahun_ini = $this->Transaksi_model->get_limit_data_bku_pajak_tahun($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'));
        }else{
            $transaksi = $this->Transaksi_model->get_limit_data_bku($config['per_page'], $start, $q,$this->session->userdata('tahun_aktif'),$this->input->get('bulan'));
        }
        // var_dump($data['pajak_tahun_ini']);
            //   echo $this->db->last_query();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi_data' => $transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,

        );

        if ($this->input->get('buku')=='bp_pajak'){
            $data['pajak_tahun_ini'] = $pajak_tahun_ini;
            $data['pajak_bulan_lalu'] = $pajak_bulan_lalu;
        }

        $data['title'] = 'Buku';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Transaksi' => '',
        ];
        $data['attribute'] = 'class="form-control" id="buku" required';
        $data['attribute2'] = 'class="form-control" id="bulan" required';
        $data['attribute3'] = 'class="form-control" id="unit" required ';
        $data['value_buku'] = $this->input->get('buku');
        $data['value_bulan'] = $this->input->get('bulan');
        $data['value_unit'] = $this->input->get('unit');
        $data['tahun_aktif'] = $tahun;
        $data['buku'] = array(
			''     => '--Pilih Laporan--',
			'bku'     => 'Buku Kas Umum',
			'bku_unit'           => 'Buku Kas Umum Unit',
			'kas_bank'         => 'Buku Pembantu Kas (Bank)',
			'kas_tunai'        => 'Buku Pembantu Kas (Tunai)',
			'bp_up'        => 'Buku Pembantu Uang Persedian',
			'bp_lsb'        => 'Buku Pembantu LS Bendahara',
			'bp_pajak'        => 'Buku Pembantu Pajak',
        );
        $data['dd_bulan'] = array(
			''     => '--Pilih Bulan--',
			'3'         => 'Maret',
			'4'        => 'April',
			'5'        => 'Mei',
			'6'        => 'Juni',
			'7'        => 'Juli',
			'8'        => 'Agustus',
			'9'        => 'September',
			'10'        => 'Oktober',
			'11'        => 'Nopember',
			'12'        => 'Desember',
        );
        $data['dd_unit'] = $this->Transaksi_unit_model->dd();
        if($this->input->get('bulan')){
            $data['bulan'] = $this->Bulan_model->get_by_id($this->input->get('bulan'))->bulan_nama;
        }else{
            $data['bulan'] = '';
        }
        if($this->input->get('bulan') && $this->session->userdata('tahun_aktif')){
            $saldo_awal = $this->Transaksi_model->get_saldo_awal($this->session->userdata('tahun_aktif'),$this->input->get('bulan'))->saldo_awal;
        }else{
            $saldo_awal = '0';
        }
        $saldo_akhir = $this->Transaksi_model->get_saldo_akhir($this->session->userdata('tahun_aktif'),$this->input->get('bulan'))->saldo_akhir;
        $sum_jml_kotor = $this->Transaksi_model->get_jk($this->session->userdata('tahun_aktif'),$this->input->get('bulan'))->jmlh_kotor;
        $sum_penerimaan = $this->Transaksi_model->get_penerimaan($this->session->userdata('tahun_aktif'),$this->input->get('bulan'))->penerimaan;
        $saldo_total=$saldo_awal+$sum_penerimaan;
        // echo $this->db->last_query();

        $data['saldo_awal'] = $saldo_awal;
        $data['saldo_akhir'] = $saldo_akhir;
        $data['sum_penerimaan']=$sum_penerimaan;
        $data['sum_jml_kotor']=$sum_jml_kotor;
        $data['saldo_total']=$saldo_total;
        $data['set_lap'] = $this->Setting_laporan_model->get_all();
        $data['code_js'] = 'buku/codejs';
        if ($this->input->get('buku')=='bp_pajak'){
            $data['page'] = 'buku/Bku_pajak';
        }else{
            $data['page'] = 'buku/Bku_list';
        }
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Transaksi_model->get_by_id($id);
        if ($row) {
            $data = array(
		'trx_id' => $row->trx_id,
		'trx_id_nomor_bukti' => $row->trx_id_nomor_bukti,
		'trx_mak' => $row->trx_mak,
		'trx_penerima' => $row->trx_penerima,
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
	    'trx_id_nomor_bukti' => set_value('trx_id_nomor_bukti'),
	    'trx_mak' => set_value('trx_mak'),
	    'trx_penerima' => set_value('trx_penerima'),
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
    );
        $data['jp']=$this->Jenis_pembayaran_model->dd();
        $data['mp']=$this->Metode_pembayaran_model->dd();
        $data['unit']=$this->Unit_model->dd();
        $data['attribute'] = 'class="form-control" required';

        $data['title'] = 'Transaksi';
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
        $ppn=0;
        $pph21=0;
        $pph22=0;
        $pph23=0;
        $pph42=0;
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            if($this->input->post('trx_ppnc',TRUE)) $ppn=substr_replace(str_replace(',','',$this->input->post('trx_ppn',TRUE)),'',-3);
            if($this->input->post('trx_pph_21c',TRUE)) $pph21=substr_replace(str_replace(',','',$this->input->post('trx_pph_21',TRUE)),'',-3);
            if($this->input->post('trx_pph_22c',TRUE)) $pph22=substr_replace(str_replace(',','',$this->input->post('trx_pph_22',TRUE)),'',-3);
            if($this->input->post('trx_pph_23c',TRUE)) $pph23=substr_replace(str_replace(',','',$this->input->post('trx_pph_23',TRUE)),'',-3);
            if($this->input->post('trx_pph_4_2c',TRUE)) $pph42=substr_replace(str_replace(',','',$this->input->post('trx_pph_4_2',TRUE)),'',-3);
            $pajak_total=$ppn+$pph21+$pph22+$pph23+$pph42;
            $bersih=$this->input->post('trx_jml_kotor',TRUE)-$pajak_total;

            $data = array(
		'trx_id_nomor_bukti' => $this->input->post('trx_id_nomor_bukti',TRUE),
		'trx_mak' => $this->input->post('trx_mak',TRUE),
		'trx_penerima' => $this->input->post('trx_penerima',TRUE),
		'trx_uraian' => $this->input->post('trx_uraian',TRUE),
		'trx_jml_kotor' => $this->input->post('trx_jml_kotor',TRUE),
		'trx_ppn' => $ppn,
		'trx_pph_21' => $pph21,
		'trx_pph_22' => $pph22,
		'trx_pph_23' => $pph23,
		'trx_pph_4_2' => $pph42,
		'trx_jml_bersih' => $bersih,
		'trx_tanggal' => $this->input->post('trx_tanggal',TRUE),
		'trx_id_jenis_pembayaran' => $this->input->post('trx_id_jenis_pembayaran',TRUE),
		'trx_id_metode_pembayaran' => $this->input->post('trx_id_metode_pembayaran',TRUE),
		'trx_id_unit' => $this->input->post('trx_id_unit',TRUE),
        );
        var_dump($data);
if(! $this->Transaksi_model->is_exist($this->input->post('trx_id'))){
                $this->Transaksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, trx_id is exist');
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
		'trx_id_nomor_bukti' => set_value('trx_id_nomor_bukti', $row->trx_id_nomor_bukti),
		'trx_mak' => set_value('trx_mak', $row->trx_mak),
		'trx_penerima' => set_value('trx_penerima', $row->trx_penerima),
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
	    );
            $data['title'] = 'Transaksi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

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
            $data = array(
		'trx_id' => $this->input->post('trx_id',TRUE),
		'trx_id_nomor_bukti' => $this->input->post('trx_id_nomor_bukti',TRUE),
		'trx_mak' => $this->input->post('trx_mak',TRUE),
		'trx_penerima' => $this->input->post('trx_penerima',TRUE),
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
	// $this->form_validation->set_rules('trx_id', 'trx id', 'trim|required');
	$this->form_validation->set_rules('trx_id_nomor_bukti', 'trx id nomor bukti', 'trim|required');
	$this->form_validation->set_rules('trx_mak', 'trx mak', 'trim|required');
	$this->form_validation->set_rules('trx_penerima', 'trx penerima', 'trim|required');
	$this->form_validation->set_rules('trx_uraian', 'trx uraian', 'trim|required');
	$this->form_validation->set_rules('trx_jml_kotor', 'trx jml kotor', 'trim|required|numeric');
	// $this->form_validation->set_rules('trx_ppn', 'trx ppn', 'trim|required|numeric');
	// $this->form_validation->set_rules('trx_pph_21', 'trx pph 21', 'trim|required|numeric');
	// $this->form_validation->set_rules('trx_pph_22', 'trx pph 22', 'trim|required|numeric');
	// $this->form_validation->set_rules('trx_pph_23', 'trx pph 23', 'trim|required|numeric');
	// $this->form_validation->set_rules('trx_pph_4_2', 'trx pph 4 2', 'trim|required|numeric');
	// $this->form_validation->set_rules('trx_jml_bersih', 'trx jml bersih', 'trim|required|numeric');
	$this->form_validation->set_rules('trx_tanggal', 'trx tanggal', 'trim|required');
	$this->form_validation->set_rules('trx_id_jenis_pembayaran', 'trx id jenis pembayaran', 'trim|required');
	$this->form_validation->set_rules('trx_id_metode_pembayaran', 'trx id metode pembayaran', 'trim|required');
	$this->form_validation->set_rules('trx_id_unit', 'trx id unit', 'trim|required');

	// $this->form_validation->set_rules('trx_id', 'trx_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_transaksi.xls";
        $judul = "tbl_transaksi";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
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
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Id Nomor Bukti");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Mak");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Penerima");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Uraian");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Jml Kotor");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Ppn");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Pph 21");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Pph 22");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Pph 23");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Pph 4 2");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Jml Bersih");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Id Jenis Pembayaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Id Metode Pembayaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Trx Id Unit");

	foreach ($this->Transaksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_id_nomor_bukti);
	    xlsWriteLabel($tablebody, $kolombody++, $data->trx_mak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->trx_penerima);
	    xlsWriteLabel($tablebody, $kolombody++, $data->trx_uraian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_jml_kotor);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_ppn);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_21);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_22);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_23);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_pph_4_2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_jml_bersih);
	    xlsWriteLabel($tablebody, $kolombody++, $data->trx_tanggal);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_id_jenis_pembayaran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_id_metode_pembayaran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->trx_id_unit);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

  public function printdoc(){
        $data = array(
            'transaksi_data' => $this->Transaksi_model->get_all(),
            'start' => 0
        );
        $this->load->view('transaksi/transaksi_print', $data);
    }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-14 14:30:11 */
/* http://harviacode.com */
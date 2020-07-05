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
        $this->load->model('Nomor_bukti_model');
        $this->load->model('Jenis_pembayaran_model');
        $this->load->model('Metode_pembayaran_model');
        $this->load->model('Unit_model');
        $this->load->model('Tahun_model');
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
        if($this->input->get('nb_id')){
            $nb_id = $this->input->get('nb_id'); 
            $tgl = $this->Nomor_bukti_model->get_by_id($nb_id)->nb_tanggal;
        }else{
            $nb_id = '';   
            $tgl  ='-';      
        }
        $tahun=$this->Tahun_model->get_by_id($this->session->userdata('tahun_aktif'))->tahun_nama;
        $transaksi = $this->Transaksi_model->get_limit_data($config['per_page'], $start, $q,$nb_id,$this->session->userdata('tahun_aktif'));
        //    echo $this->db->last_query();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi_data' => $transaksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Transaksi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Transaksi' => '',
        ];
        $data['tgl']=$tgl;
        $data['no_bukti']=$this->Nomor_bukti_model->dd();
        $data['attribute'] = 'class="form-control" id="no_bukti" required';
        $data['trx_id_nomor_bukti'] = $nb_id;
        $data['penerimaan'] = $this->Transaksi_model->penerimaan($this->session->userdata('tahun_aktif'))->row()->total;
        $data['pengeluaran'] = $this->Transaksi_model->pengeluaran($this->session->userdata('tahun_aktif'),$nb_id)->row()->total;
        $data['ppn'] = $this->Transaksi_model->pajak($this->session->userdata('tahun_aktif'))->row()->ppn;
        $data['pph21'] = $this->Transaksi_model->pajak($this->session->userdata('tahun_aktif'))->row()->pph21;
        $data['pph22'] = $this->Transaksi_model->pajak($this->session->userdata('tahun_aktif'))->row()->pph22;
        $data['pph23'] = $this->Transaksi_model->pajak($this->session->userdata('tahun_aktif'))->row()->pph23;
        $data['pph42'] = $this->Transaksi_model->pajak($this->session->userdata('tahun_aktif'))->row()->pph42;
        $data['tahun_aktif'] = $tahun;

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
        $data['no_bukti']=$this->Nomor_bukti_model->dd();
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
        $dataNoTrx = $spreadsheet->getSheetByName('No Trx')->toArray(null, true, true, true);
        // var_dump($dataNoTrx);
    
        // array Count
        $arrayCount = count($dataNoTrx);
        $flag = 0;
        $createArray = array('Nomor Bukti', 'Tanggal', 'Uraian');
        $makeArray = array('NomorBukti' => 'NomorBukti', 'Tanggal' => 'Tanggal', 'Uraian' => 'Uraian');
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
        if (empty($dataDiff)) {
            $flag = 1;
        }
        // match excel sheet column
        if ($flag == 1) {
            for ($i = 2; $i <= $arrayCount; $i++) {
                $no = $SheetDataKey['NomorBukti'];
                $tgl = $SheetDataKey['Tanggal'];
                $uraian = $SheetDataKey['Uraian'];

                $no = filter_var(trim($dataNoTrx[$i][$no]), FILTER_SANITIZE_STRING);
                $tgl = filter_var(trim($dataNoTrx[$i][$tgl]), FILTER_SANITIZE_STRING);
                $uraian = filter_var(trim($dataNoTrx[$i][$uraian]), FILTER_SANITIZE_STRING);
                $fetchData[] = array('nb_no' => $no, 'nb_tanggal' => $tgl, 'uraian' => $uraian, 'nb_id_tahun' => $this->id_tahun);
            }   
            $data['dataInfo'] = $fetchData;
            $this->Nomor_bukti_model->setBatchImport($fetchData);
            if(!$this->Nomor_bukti_model->importData()){
                $dataNoTrx = $spreadsheet->getSheetByName('Trx')->toArray(null, true, true, true);
                // var_dump($dataNoTrx);
            
                // array Count
                $arrayCount = count($dataNoTrx);
                $flag = 0;
                $createArray = array('Nomor Bukti', 'Tanggal', 'MAK', 'Penerima', 'Uraian','Jumlah Kotor','PPn','PPh 21','PPh 22','PPh 23','PPh 4(2)','Bank/Tunai','GU/LS','Unit');
                $makeArray = array('NomorBukti' => 'NomorBukti', 
                                    'Tanggal' => 'Tanggal', 
                                    'MAK' => 'MAK',
                                    'Penerima' => 'Penerima', 
                                    'Uraian' => 'Uraian', 
                                    'JumlahKotor' => 'JumlahKotor', 
                                    'PPn' => 'PPn', 
                                    'PPh21' => 'PPh21', 
                                    'PPh22' => 'PPh22', 
                                    'PPh23' => 'PPh23', 
                                    'PPh4(2)' => 'PPh4(2)', 
                                    'Bank/Tunai' => 'Bank/Tunai', 
                                    'GU/LS' => 'GU/LS', 
                                    'Unit' => 'Unit' );
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
                if (empty($dataDiff)) {
                    $flag = 1;
                }
                // var_dump($dataDiff);
                // match excel sheet column
                if ($flag == 1) {
                    for ($i = 2; $i <= $arrayCount; $i++) {
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
                        $bt = $SheetDataKey['Bank/Tunai'];
                        $guls = $SheetDataKey['GU/LS'];
                        $unit = $SheetDataKey['Unit'];

                        $no = $this->Nomor_bukti_model->get_by_no(filter_var(trim($dataNoTrx[$i][$no]), FILTER_SANITIZE_STRING))->nb_id;
                        $tgl = filter_var(trim($dataNoTrx[$i][$tgl]), FILTER_SANITIZE_STRING);
                        $mak = filter_var(trim($dataNoTrx[$i][$mak]), FILTER_SANITIZE_STRING);
                        $uraian = filter_var(trim($dataNoTrx[$i][$uraian]), FILTER_SANITIZE_STRING);
                        $jml_kotor = filter_var(trim($dataNoTrx[$i][$jml_kotor]), FILTER_SANITIZE_NUMBER_FLOAT);
                        $ppn = filter_var(trim($dataNoTrx[$i][$ppn]), FILTER_SANITIZE_STRING);
                            $ppn = $ppn=='Ya'?($jml_kotor>1500000?round($jml_kotor/11):0):0;
                        $pph21 = filter_var(trim($dataNoTrx[$i][$pph21]), FILTER_SANITIZE_STRING);
                            $pph21 = $pph21=='Ya'?0:0;
                        $pph22 = filter_var(trim($dataNoTrx[$i][$pph22]), FILTER_SANITIZE_STRING);
                            $pph22 = $pph22=='Ya'?($jml_kotor>=2000000?round($ppn*0.15):0):0;
                        $pph23 = filter_var(trim($dataNoTrx[$i][$pph23]), FILTER_SANITIZE_STRING);
                            $pph23 = $pph23=='Ya'?round($jml_kotor*0.02):0;
                        $pph42 = filter_var(trim($dataNoTrx[$i][$pph42]), FILTER_SANITIZE_STRING);
                            $pph42 = $pph42=='Ya'?0:0;
                        $bt = $this->Jenis_pembayaran_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$bt]), FILTER_SANITIZE_STRING))->jp_id;
                        $guls = $this->Metode_pembayaran_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$guls]), FILTER_SANITIZE_STRING))->mp_id;
                        $unit = $this->Unit_model->get_by_nama(filter_var(trim($dataNoTrx[$i][$unit]), FILTER_SANITIZE_STRING))->id_unit;
                        $total_pajak=$ppn+$pph21+$pph22+$pph23+$pph42;
                        $jml_bersih=$jml_kotor-$total_pajak;

                        $fetchData2[] = array('trx_id_nomor_bukti' => $no, 
                                        'trx_mak' => $mak, 
                                        'trx_penerima' => $penerima, 
                                        'trx_uraian' => $uraian,
                                        'trx_penerima' => $penerima, 
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
                                        'trx_id_unit' => $unit );
                    }   
                    $data['dataInfo'] = $fetchData2;
                    // var_dump($fetchData2);
                    $this->Transaksi_model->setBatchImport($fetchData2);
                    if(!$this->Transaksi_model->importData()){
                        $this->session->set_flashdata('message', 'Import Excel Success');
                        redirect('transaksi');
                    }
                    // echo $this->db->last_query();
                } else {
                    $this->session->set_flashdata('message_error', 'Maaf importlah file sesuai format yang diberikan, jumlah kolom tidak sesuai');
                    redirect('transaksi');
                }
            }
        } else {
            $this->session->set_flashdata('message_error', 'Maaf importlah file sesuai format yang diberikan, jumlah kolom tidak sesuai');
            redirect('transaksi');
        }
    }    
  }

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-14 14:30:11 */
/* http://harviacode.com */
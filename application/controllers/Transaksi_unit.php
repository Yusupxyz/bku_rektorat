<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Transaksi_unit_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Jenis_pembayaran_model');
        $this->load->model('Metode_pembayaran_model');
        $this->load->model('Tahun_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'transaksi_unit?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'transaksi_unit?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'transaksi_unit';
            $config['first_url'] = base_url() . 'transaksi_unit';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Transaksi_unit_model->total_rows($q);
        $transaksi_unit = $this->Transaksi_unit_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'transaksi_unit_data' => $transaksi_unit,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Transaksi Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Transaksi Unit' => '',
        ];
        $data['code_js'] = 'transaksi_unit/codejs';
        $data['page'] = 'transaksi_unit/Transaksi_unit_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Transaksi_unit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'trxu_id' => $row->trxu_id,
		'trxu_nomor_bukti' => $row->trxu_nomor_bukti,
		'trxu_mak' => $row->trxu_mak,
		'trxu_uraian' => $row->trxu_uraian,
		'trxu_jml_kotor' => $row->trxu_jml_kotor,
		'trxu_ppn' => $row->trxu_ppn,
		'trxu_pph_21' => $row->trxu_pph_21,
		'trxu_pph_22' => $row->trxu_pph_22,
		'trxu_pph_23' => $row->trxu_pph_23,
		'trxu_pph_4_2' => $row->trxu_pph_4_2,
		'trxu_jml_bersih' => $row->trxu_jml_bersih,
		'trxu_tanggal' => $row->trxu_tanggal,
		'trxu_id_jenis_pembayaran' => $row->trxu_id_jenis_pembayaran,
		'trxu_id_metode_pembayaran' => $row->trxu_id_metode_pembayaran,
		'trxu_id_unit' => $row->trxu_id_unit,
	    );
        $data['title'] = 'Transaksi Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'transaksi_unit/Transaksi_unit_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_unit'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi_unit/create_action'),
	    'trxu_id' => set_value('trxu_id'),
	    'trxu_nomor_bukti' => set_value('trxu_nomor_bukti'),
	    'trxu_mak' => set_value('trxu_mak'),
	    'trxu_uraian' => set_value('trxu_uraian'),
	    'trxu_jml_kotor' => set_value('trxu_jml_kotor'),
	    'trxu_ppn' => set_value('trxu_ppn'),
	    'trxu_pph_21' => set_value('trxu_pph_21'),
	    'trxu_pph_22' => set_value('trxu_pph_22'),
	    'trxu_pph_23' => set_value('trxu_pph_23'),
	    'trxu_pph_4_2' => set_value('trxu_pph_4_2'),
	    'trxu_jml_bersih' => set_value('trxu_jml_bersih'),
	    'trxu_tanggal' => set_value('trxu_tanggal'),
	    'trxu_id_jenis_pembayaran' => set_value('trxu_id_jenis_pembayaran'),
	    'trxu_id_metode_pembayaran' => set_value('trxu_id_metode_pembayaran'),
    );
        $data['nb']=$this->Transaksi_model->dd();
        $data['jp']=$this->Jenis_pembayaran_model->dd();
        $data['mp']=$this->Metode_pembayaran_model->dd();
        $data['attribute'] = 'class="form-control" required ';
        $data['attribute2'] = 'class="form-control selectpicker" data-live-search="true" required ';
        
        $data['code_js'] = 'transaksi_unit/codejs';
        $data['title'] = 'Kontrol Transaksi Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'transaksi_unit/Transaksi_unit_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'trxu_nomor_bukti' => $this->input->post('trxu_nomor_bukti',TRUE),
		'trxu_mak' => $this->input->post('trxu_mak',TRUE),
		'trxu_uraian' => $this->input->post('trxu_uraian',TRUE),
		'trxu_jml_kotor' => $this->input->post('trxu_jml_kotor',TRUE),
		'trxu_ppn' => $this->input->post('trxu_ppn',TRUE),
		'trxu_pph_21' => $this->input->post('trxu_pph_21',TRUE),
		'trxu_pph_22' => $this->input->post('trxu_pph_22',TRUE),
		'trxu_pph_23' => $this->input->post('trxu_pph_23',TRUE),
		'trxu_pph_4_2' => $this->input->post('trxu_pph_4_2',TRUE),
		'trxu_jml_bersih' => $this->input->post('trxu_jml_bersih',TRUE),
		'trxu_tanggal' => $this->input->post('trxu_tanggal',TRUE),
		'trxu_id_jenis_pembayaran' => $this->input->post('trxu_id_jenis_pembayaran',TRUE),
		'trxu_id_metode_pembayaran' => $this->input->post('trxu_id_metode_pembayaran',TRUE),
	    );
                $this->Transaksi_unit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('transaksi'));
    }

    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_unit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi_unit/update_action'),
		'trxu_id' => set_value('trxu_id', $row->trxu_id),
		'trxu_nomor_bukti' => set_value('trxu_nomor_bukti', $row->trxu_nomor_bukti),
		'trxu_mak' => set_value('trxu_mak', $row->trxu_mak),
		'trxu_uraian' => set_value('trxu_uraian', $row->trxu_uraian),
		'trxu_jml_kotor' => set_value('trxu_jml_kotor', $row->trxu_jml_kotor),
		'trxu_ppn' => set_value('trxu_ppn', $row->trxu_ppn),
		'trxu_pph_21' => set_value('trxu_pph_21', $row->trxu_pph_21),
		'trxu_pph_22' => set_value('trxu_pph_22', $row->trxu_pph_22),
		'trxu_pph_23' => set_value('trxu_pph_23', $row->trxu_pph_23),
		'trxu_pph_4_2' => set_value('trxu_pph_4_2', $row->trxu_pph_4_2),
		'trxu_jml_bersih' => set_value('trxu_jml_bersih', $row->trxu_jml_bersih),
		'trxu_tanggal' => set_value('trxu_tanggal', $row->trxu_tanggal),
		'trxu_id_jenis_pembayaran' => set_value('trxu_id_jenis_pembayaran', $row->trxu_id_jenis_pembayaran),
		'trxu_id_metode_pembayaran' => set_value('trxu_id_metode_pembayaran', $row->trxu_id_metode_pembayaran),
        );
        $data['nb']=$this->Transaksi_model->dd();
        $data['jp']=$this->Jenis_pembayaran_model->dd();
        $data['mp']=$this->Metode_pembayaran_model->dd();
        $data['attribute'] = 'class="form-control" required ';
        $data['attribute2'] = 'class="form-control selectpicker" data-live-search="true" required ';
            $data['title'] = 'Transaksi Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'transaksi_unit/Transaksi_unit_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_unit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('trxu_id', TRUE));
        } else {
            $data = array(
		'trxu_id' => $this->input->post('trxu_id',TRUE),
		'trxu_nomor_bukti' => $this->input->post('trxu_nomor_bukti',TRUE),
		'trxu_mak' => $this->input->post('trxu_mak',TRUE),
		'trxu_uraian' => $this->input->post('trxu_uraian',TRUE),
		'trxu_jml_kotor' => $this->input->post('trxu_jml_kotor',TRUE),
		'trxu_ppn' => $this->input->post('trxu_ppn',TRUE),
		'trxu_pph_21' => $this->input->post('trxu_pph_21',TRUE),
		'trxu_pph_22' => $this->input->post('trxu_pph_22',TRUE),
		'trxu_pph_23' => $this->input->post('trxu_pph_23',TRUE),
		'trxu_pph_4_2' => $this->input->post('trxu_pph_4_2',TRUE),
		'trxu_jml_bersih' => $this->input->post('trxu_jml_bersih',TRUE),
		'trxu_tanggal' => $this->input->post('trxu_tanggal',TRUE),
		'trxu_id_jenis_pembayaran' => $this->input->post('trxu_id_jenis_pembayaran',TRUE),
		'trxu_id_metode_pembayaran' => $this->input->post('trxu_id_metode_pembayaran',TRUE),
	    );

            $this->Transaksi_unit_model->update($this->input->post('trxu_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_unit_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_unit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi'));
        }
    }

    public function deletebulk(){
        $delete = $this->Transaksi_unit_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	// $this->form_validation->set_rules('trxu_id', 'trxu id', 'trim|required');
	$this->form_validation->set_rules('trxu_nomor_bukti', 'trxu nomor bukti', 'trim|required');
	$this->form_validation->set_rules('trxu_mak', 'trxu mak', 'trim|required');
	$this->form_validation->set_rules('trxu_uraian', 'trxu uraian', 'trim|required');
	$this->form_validation->set_rules('trxu_jml_kotor', 'trxu jml kotor', 'trim|required|numeric');
	// $this->form_validation->set_rules('trxu_ppn', 'trxu ppn', 'trim|required|numeric');
	// $this->form_validation->set_rules('trxu_pph_21', 'trxu pph 21', 'trim|required|numeric');
	// $this->form_validation->set_rules('trxu_pph_22', 'trxu pph 22', 'trim|required|numeric');
	// $this->form_validation->set_rules('trxu_pph_23', 'trxu pph 23', 'trim|required|numeric');
	// $this->form_validation->set_rules('trxu_pph_4_2', 'trxu pph 4 2', 'trim|required|numeric');
	$this->form_validation->set_rules('trxu_jml_bersih', 'trxu jml bersih', 'trim|required|numeric');
	$this->form_validation->set_rules('trxu_tanggal', 'trxu tanggal', 'trim|required');
	$this->form_validation->set_rules('trxu_id_jenis_pembayaran', 'trxu id jenis pembayaran', 'trim|required');
	$this->form_validation->set_rules('trxu_id_metode_pembayaran', 'trxu id metode pembayaran', 'trim|required');

	// $this->form_validation->set_rules('trxu_id', 'trxu_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Transaksi_unit.php */
/* Location: ./application/controllers/Transaksi_unit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-05 14:37:21 */
/* http://harviacode.com */
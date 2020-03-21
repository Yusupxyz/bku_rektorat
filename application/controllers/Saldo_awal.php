<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saldo_awal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Saldo_awal_model');
        $this->load->library('form_validation');
        $this->load->model('Tahun_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'saldo_awal?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'saldo_awal?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'saldo_awal';
            $config['first_url'] = base_url() . 'saldo_awal';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Saldo_awal_model->total_rows($q);
        $saldo_awal = $this->Saldo_awal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'saldo_awal_data' => $saldo_awal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Saldo Awal';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Saldo Awal' => '',
        ];
       

        $data['code_js'] = 'saldo_awal/codejs';
        $data['page'] = 'saldo_awal/Saldo_awal_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Saldo_awal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'sa_id' => $row->sa_id,
		'sa_jumlah' => $row->sa_jumlah,
		'sa_id_bulan' => $row->sa_id_bulan,
		'sa_id_tahun' => $row->sa_id_tahun,
	    );
        $data['title'] = 'Saldo Awal';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'saldo_awal/Saldo_awal_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo_awal'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('saldo_awal/create_action'),
	    'sa_id' => set_value('sa_id'),
	    'sa_jumlah' => set_value('sa_jumlah'),
	    'sa_id_bulan' => set_value('sa_id_bulan'),
	    'sa_id_tahun' => set_value('sa_id_tahun'),
	);
        $data['title'] = 'Saldo Awal';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['bulan'] = array(
			''     => '--Pilih Bulan--',
			'1'     => 'Januari',
			'2'           => 'Februari',
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
        $data['attribute'] = 'class="form-control" required';
        $data['value_bulan'] = '';
        $data['page'] = 'saldo_awal/Saldo_awal_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'sa_id' => $this->input->post('sa_id',TRUE),
		'sa_jumlah' => $this->input->post('sa_jumlah',TRUE),
		'sa_id_bulan' => $this->input->post('sa_id_bulan',TRUE),
		'sa_id_tahun' => $this->input->post('sa_id_tahun',TRUE),
	    );
if(! $this->Saldo_awal_model->is_exist($this->input->post('sa_id'))){
                $this->Saldo_awal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('saldo_awal'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, sa_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Saldo_awal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('saldo_awal/update_action'),
		'sa_id' => set_value('sa_id', $row->sa_id),
		'sa_jumlah' => set_value('sa_jumlah', $row->sa_jumlah),
		'sa_id_bulan' => set_value('sa_id_bulan', $row->sa_id_bulan),
		'sa_id_tahun' => set_value('sa_id_tahun', $row->sa_id_tahun),
	    );
            $data['title'] = 'Saldo Awal';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'saldo_awal/Saldo_awal_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo_awal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('sa_id', TRUE));
        } else {
            $data = array(
		'sa_id' => $this->input->post('sa_id',TRUE),
		'sa_jumlah' => $this->input->post('sa_jumlah',TRUE),
		'sa_id_bulan' => $this->input->post('sa_id_bulan',TRUE),
		'sa_id_tahun' => $this->input->post('sa_id_tahun',TRUE),
	    );

            $this->Saldo_awal_model->update($this->input->post('sa_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('saldo_awal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Saldo_awal_model->get_by_id($id);

        if ($row) {
            $this->Saldo_awal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('saldo_awal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo_awal'));
        }
    }

    public function deletebulk(){
        $delete = $this->Saldo_awal_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('sa_id', 'sa id', 'trim|required');
	$this->form_validation->set_rules('sa_jumlah', 'sa jumlah', 'trim|required|numeric');
	$this->form_validation->set_rules('sa_id_bulan', 'sa id bulan', 'trim|required');
	$this->form_validation->set_rules('sa_id_tahun', 'sa id tahun', 'trim|required');

	$this->form_validation->set_rules('sa_id', 'sa_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Saldo_awal.php */
/* Location: ./application/controllers/Saldo_awal.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 17:45:47 */
/* http://harviacode.com */
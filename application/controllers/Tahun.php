<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tahun extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Tahun_model');
        $this->load->model('Saldo_awal_model');
        $this->load->model('Saldo_akhir_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tahun?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tahun?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tahun';
            $config['first_url'] = base_url() . 'tahun';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tahun_model->total_rows($q);
        $tahun = $this->Tahun_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tahun_data' => $tahun,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Tahun' => '',
        ];
        $data['code_js'] = 'tahun/codejs';
        $data['page'] = 'tahun/Tahun_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Tahun_model->get_by_id($id);
        if ($row) {
            $data = array(
		'tahun_id' => $row->tahun_id,
		'tahun_nama' => $row->tahun_nama,
	    );
        $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tahun/Tahun_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tahun/create_action'),
	    'tahun_id' => set_value('tahun_id'),
        'tahun_nama' => set_value('tahun_nama'),
        'tahun_status' => set_value('tahun_status'),
	);
        $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['status'] = array(
			''     => '--Pilih Status--',
			'1'    => 'Aktif',
			'0'    => 'Tidak Aktif',
        );
        $data['attribute'] = 'class="form-control" required';
        $data['page'] = 'tahun/Tahun_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tahun_nama' => $this->input->post('tahun_nama',TRUE),
		'tahun_status' => $this->input->post('tahun_status',TRUE),
	    );
if(! $this->Tahun_model->is_exist($this->input->post('tahun_id'))){
            if($this->input->post('tahun_status',TRUE)==1){
                $this->Tahun_model->update_status('0');
            }
            $this->Tahun_model->insert($data);
            $tahun_id=$this->Tahun_model->get_id_by_status($this->input->post('tahun_status',TRUE))->tahun_id;
            if($this->input->post('tahun_status',TRUE)==1){
				$this->session->set_userdata('tahun_aktif',$tahun_id);
            }
            for ($i=1; $i < 13; $i++) { 
                $data = array(
                    'sa_jumlah' => '0',
                    'sa_id_bulan' => $i,
                    'sa_id_tahun' => $tahun_id,
                    );
                $this->Saldo_awal_model->insert($data);
            }
            for ($i=1; $i < 13; $i++) { 
                $data = array(
                    'sak_jumlah' => '0',
                    'sak_id_bulan' => $i,
                    'sak_id_tahun' => $tahun_id,
                    );
                $this->Saldo_akhir_model->insert($data);
            }
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tahun'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, tahun_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Tahun_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tahun/update_action'),
		'tahun_id' => set_value('tahun_id', $row->tahun_id),
		'tahun_nama' => set_value('tahun_nama', $row->tahun_nama),
		'tahun_status' => set_value('tahun_status', $row->tahun_status),
	    );
            $data['title'] = 'Tahun';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['status'] = array(
			''     => '--Pilih Status--',
			'1'    => 'Aktif',
			'0'    => 'Tidak Aktif',
        );
        $data['attribute'] = 'class="form-control" required';
        $data['page'] = 'tahun/Tahun_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('tahun_id', TRUE));
        } else {
            $data = array(
		'tahun_id' => $this->input->post('tahun_id',TRUE),
		'tahun_nama' => $this->input->post('tahun_nama',TRUE),
		'tahun_status' => $this->input->post('tahun_status',TRUE),
	    );

            $this->Tahun_model->update($this->input->post('tahun_id', TRUE), $data);
            if($this->input->post('tahun_status',TRUE)==1){
                $this->Tahun_model->update_status_lain($this->input->post('tahun_id',TRUE),'0');
                $this->session->set_userdata('tahun_aktif',$this->input->post('tahun_id',TRUE));
            }else{
                $this->Tahun_model->update_status_lain($this->input->post('tahun_id',TRUE),'1');
            }
            // echo $this->db->last_query();
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tahun'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tahun_model->get_by_id($id);

        if ($row) {
            $this->Tahun_model->delete($id);
            $this->Saldo_awal_model->delete_bytahun($id);
            $this->Saldo_akhir_model->delete_bytahun($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tahun'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tahun'));
        }
    }

    public function deletebulk(){
        $delete = $this->Tahun_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('tahun_id', 'tahun id', 'trim|required');
	$this->form_validation->set_rules('tahun_nama', 'tahun nama', 'trim|required');

	$this->form_validation->set_rules('tahun_id', 'tahun_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tahun.php */
/* Location: ./application/controllers/Tahun.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 17:41:23 */
/* http://harviacode.com */
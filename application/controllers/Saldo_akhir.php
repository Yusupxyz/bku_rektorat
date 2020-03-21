<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Saldo_akhir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Saldo_akhir_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'saldo_akhir?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'saldo_akhir?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'saldo_akhir';
            $config['first_url'] = base_url() . 'saldo_akhir';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Saldo_akhir_model->total_rows($q);
        $saldo_akhir = $this->Saldo_akhir_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'saldo_akhir_data' => $saldo_akhir,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Saldo Akhir';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Saldo Akhir' => '',
        ];
        $data['code_js'] = 'saldo_akhir/codejs';
        $data['page'] = 'saldo_akhir/Saldo_akhir_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Saldo_akhir_model->get_by_id($id);
        if ($row) {
            $data = array(
		'sak_id' => $row->sak_id,
		'sak_jumlah' => $row->sak_jumlah,
		'sak_id_bulan' => $row->sak_id_bulan,
		'sak_id_tahun' => $row->sak_id_tahun,
	    );
        $data['title'] = 'Saldo Akhir';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'saldo_akhir/Saldo_akhir_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo_akhir'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('saldo_akhir/create_action'),
	    'sak_id' => set_value('sak_id'),
	    'sak_jumlah' => set_value('sak_jumlah'),
	    'sak_id_bulan' => set_value('sak_id_bulan'),
	    'sak_id_tahun' => set_value('sak_id_tahun'),
	);
        $data['title'] = 'Saldo Akhir';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'saldo_akhir/Saldo_akhir_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'sak_id' => $this->input->post('sak_id',TRUE),
		'sak_jumlah' => $this->input->post('sak_jumlah',TRUE),
		'sak_id_bulan' => $this->input->post('sak_id_bulan',TRUE),
		'sak_id_tahun' => $this->input->post('sak_id_tahun',TRUE),
	    );
if(! $this->Saldo_akhir_model->is_exist($this->input->post('sak_id'))){
                $this->Saldo_akhir_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('saldo_akhir'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, sak_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Saldo_akhir_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('saldo_akhir/update_action'),
		'sak_id' => set_value('sak_id', $row->sak_id),
		'sak_jumlah' => set_value('sak_jumlah', $row->sak_jumlah),
		'sak_id_bulan' => set_value('sak_id_bulan', $row->sak_id_bulan),
		'sak_id_tahun' => set_value('sak_id_tahun', $row->sak_id_tahun),
	    );
            $data['title'] = 'Saldo Akhir';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'saldo_akhir/Saldo_akhir_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo_akhir'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('sak_id', TRUE));
        } else {
            $data = array(
		'sak_id' => $this->input->post('sak_id',TRUE),
		'sak_jumlah' => $this->input->post('sak_jumlah',TRUE),
	    );

            $this->Saldo_akhir_model->update($this->input->post('sak_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('saldo_akhir'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Saldo_akhir_model->get_by_id($id);

        if ($row) {
            $this->Saldo_akhir_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('saldo_akhir'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('saldo_akhir'));
        }
    }

    public function deletebulk(){
        $delete = $this->Saldo_akhir_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('sak_id', 'sak id', 'trim|required');
	$this->form_validation->set_rules('sak_jumlah', 'sak jumlah', 'trim|required|numeric');

	$this->form_validation->set_rules('sak_id', 'sak_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Saldo_akhir.php */
/* Location: ./application/controllers/Saldo_akhir.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 17:45:55 */
/* http://harviacode.com */
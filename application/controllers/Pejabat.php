<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pejabat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pejabat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pejabat?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pejabat?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pejabat';
            $config['first_url'] = base_url() . 'pejabat';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pejabat_model->total_rows($q);
        $pejabat = $this->Pejabat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pejabat_data' => $pejabat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Pejabat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pejabat' => '',
        ];
        $data['code_js'] = 'pejabat/codejs';
        $data['page'] = 'pejabat/Pejabat_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Pejabat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'pejabat_id' => $row->pejabat_id,
		'pejabat_nama' => $row->pejabat_nama,
		'pejabat_jabatan' => $row->pejabat_jabatan,
		'pejabat_nip' => $row->pejabat_nip,
	    );
        $data['title'] = 'Pejabat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pejabat/Pejabat_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pejabat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pejabat/create_action'),
	    'pejabat_id' => set_value('pejabat_id'),
	    'pejabat_nama' => set_value('pejabat_nama'),
	    'pejabat_jabatan' => set_value('pejabat_jabatan'),
	    'pejabat_nip' => set_value('pejabat_nip'),
	);
        $data['title'] = 'Pejabat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pejabat/Pejabat_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pejabat_id' => $this->input->post('pejabat_id',TRUE),
		'pejabat_nama' => $this->input->post('pejabat_nama',TRUE),
		'pejabat_jabatan' => $this->input->post('pejabat_jabatan',TRUE),
		'pejabat_nip' => $this->input->post('pejabat_nip',TRUE),
	    );
if(! $this->Pejabat_model->is_exist($this->input->post('pejabat_id'))){
                $this->Pejabat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pejabat'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, pejabat_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Pejabat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pejabat/update_action'),
		'pejabat_id' => set_value('pejabat_id', $row->pejabat_id),
		'pejabat_nama' => set_value('pejabat_nama', $row->pejabat_nama),
		'pejabat_jabatan' => set_value('pejabat_jabatan', $row->pejabat_jabatan),
		'pejabat_nip' => set_value('pejabat_nip', $row->pejabat_nip),
	    );
            $data['title'] = 'Pejabat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pejabat/Pejabat_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pejabat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('pejabat_id', TRUE));
        } else {
            $data = array(
		'pejabat_id' => $this->input->post('pejabat_id',TRUE),
		'pejabat_nama' => $this->input->post('pejabat_nama',TRUE),
		'pejabat_jabatan' => $this->input->post('pejabat_jabatan',TRUE),
		'pejabat_nip' => $this->input->post('pejabat_nip',TRUE),
	    );

            $this->Pejabat_model->update($this->input->post('pejabat_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pejabat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pejabat_model->get_by_id($id);

        if ($row) {
            $this->Pejabat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pejabat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pejabat'));
        }
    }

    public function deletebulk(){
        $delete = $this->Pejabat_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('pejabat_id', 'pejabat id', 'trim|required');
	$this->form_validation->set_rules('pejabat_nama', 'pejabat nama', 'trim|required');
	$this->form_validation->set_rules('pejabat_jabatan', 'pejabat jabatan', 'trim|required');
	$this->form_validation->set_rules('pejabat_nip', 'pejabat nip', 'trim|required');

	$this->form_validation->set_rules('pejabat_id', 'pejabat_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pejabat.php */
/* Location: ./application/controllers/Pejabat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-19 15:07:26 */
/* http://harviacode.com */
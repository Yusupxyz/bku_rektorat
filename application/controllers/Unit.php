<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Unit_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'unit?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'unit?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'unit';
            $config['first_url'] = base_url() . 'unit';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Unit_model->total_rows($q);
        $unit = $this->Unit_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'unit_data' => $unit,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Unit' => '',
        ];
        $data['code_js'] = 'unit/codejs';
        $data['page'] = 'unit/Unit_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Unit_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
	    );
        $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unit/Unit_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('unit/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	);
        $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unit/Unit_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );
                $this->Unit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('unit'));
            }
    }
    
    public function update($id) 
    {
        $row = $this->Unit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('unit/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
	    );
            $data['title'] = 'Unit';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'unit/Unit_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Unit_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('unit'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Unit_model->get_by_id($id);

        if ($row) {
            $this->Unit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('unit'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('unit'));
        }
    }

    public function deletebulk(){
        $delete = $this->Unit_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	// $this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	// $this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Unit.php */
/* Location: ./application/controllers/Unit.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-17 13:43:29 */
/* http://harviacode.com */
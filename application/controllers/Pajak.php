<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pajak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pajak_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'pajak?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pajak?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pajak';
            $config['first_url'] = base_url() . 'pajak';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pajak_model->total_rows($q);
        $pajak = $this->Pajak_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pajak_data' => $pajak,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Pajak';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pajak' => '',
        ];
        $data['code_js'] = 'pajak/codejs';
        $data['page'] = 'pajak/Pajak_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Pajak_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'jenis' => $row->jenis,
	    );
        $data['title'] = 'Pajak';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pajak/Pajak_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pajak'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('pajak/create_action'),
	    'id' => set_value('id'),
	    'jenis' => set_value('jenis'),
	);
        $data['title'] = 'Pajak';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pajak/Pajak_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jenis' => $this->input->post('jenis',TRUE),
	    );
                $this->Pajak_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pajak'));
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id is exist');
            }
    }
    
    public function update($id) 
    {
        $row = $this->Pajak_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pajak/update_action'),
		'id' => set_value('id', $row->id),
		'jenis' => set_value('jenis', $row->jenis),
	    );
            $data['title'] = 'Pajak';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pajak/Pajak_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pajak'));
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
		'jenis' => $this->input->post('jenis',TRUE),
	    );

            $this->Pajak_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pajak'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pajak_model->get_by_id($id);

        if ($row) {
            $this->Pajak_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pajak'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pajak'));
        }
    }

    public function deletebulk(){
        $delete = $this->Pajak_model->deletebulk();
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
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

	// $this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pajak.php */
/* Location: ./application/controllers/Pajak.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-11-17 13:49:16 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Metode_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Metode_pembayaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'metode_pembayaran?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'metode_pembayaran?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'metode_pembayaran';
            $config['first_url'] = base_url() . 'metode_pembayaran';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Metode_pembayaran_model->total_rows($q);
        $metode_pembayaran = $this->Metode_pembayaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'metode_pembayaran_data' => $metode_pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Metode Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Metode Pembayaran' => '',
        ];
        $data['code_js'] = 'metode_pembayaran/codejs';
        $data['page'] = 'metode_pembayaran/Metode_pembayaran_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'mp_id' => $row->mp_id,
		'mp_nama' => $row->mp_nama,
	    );
        $data['title'] = 'Metode Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'metode_pembayaran/Metode_pembayaran_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('metode_pembayaran/create_action'),
	    'mp_id' => set_value('mp_id'),
	    'mp_nama' => set_value('mp_nama'),
	);
        $data['title'] = 'Metode Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'metode_pembayaran/Metode_pembayaran_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'mp_id' => $this->input->post('mp_id',TRUE),
		'mp_nama' => $this->input->post('mp_nama',TRUE),
	    );
if(! $this->Metode_pembayaran_model->is_exist($this->input->post('mp_id'))){
                $this->Metode_pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('metode_pembayaran'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, mp_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('metode_pembayaran/update_action'),
		'mp_id' => set_value('mp_id', $row->mp_id),
		'mp_nama' => set_value('mp_nama', $row->mp_nama),
	    );
            $data['title'] = 'Metode Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'metode_pembayaran/Metode_pembayaran_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('metode_pembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('mp_id', TRUE));
        } else {
            $data = array(
		'mp_id' => $this->input->post('mp_id',TRUE),
		'mp_nama' => $this->input->post('mp_nama',TRUE),
	    );

            $this->Metode_pembayaran_model->update($this->input->post('mp_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('metode_pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Metode_pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Metode_pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('metode_pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('metode_pembayaran'));
        }
    }

    public function deletebulk(){
        $delete = $this->Metode_pembayaran_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('mp_id', 'mp id', 'trim|required');
	$this->form_validation->set_rules('mp_nama', 'md nama', 'trim|required');

	$this->form_validation->set_rules('mp_id', 'mp_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Metode_pembayaran.php */
/* Location: ./application/controllers/Metode_pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 17:44:20 */
/* http://harviacode.com */
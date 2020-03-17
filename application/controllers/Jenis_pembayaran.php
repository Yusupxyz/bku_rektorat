<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Jenis_pembayaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis_pembayaran?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis_pembayaran?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenis_pembayaran';
            $config['first_url'] = base_url() . 'jenis_pembayaran';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_pembayaran_model->total_rows($q);
        $jenis_pembayaran = $this->Jenis_pembayaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_pembayaran_data' => $jenis_pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Jenis Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Jenis Pembayaran' => '',
        ];
        $data['code_js'] = 'jenis_pembayaran/codejs';
        $data['page'] = 'jenis_pembayaran/Jenis_pembayaran_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Jenis_pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
		'jp_id' => $row->jp_id,
		'jp_nama' => $row->jp_nama,
	    );
        $data['title'] = 'Jenis Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'jenis_pembayaran/Jenis_pembayaran_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_pembayaran'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_pembayaran/create_action'),
	    'jp_id' => set_value('jp_id'),
	    'jp_nama' => set_value('jp_nama'),
	);
        $data['title'] = 'Jenis Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'jenis_pembayaran/Jenis_pembayaran_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jp_id' => $this->input->post('jp_id',TRUE),
		'jp_nama' => $this->input->post('jp_nama',TRUE),
	    );
if(! $this->Jenis_pembayaran_model->is_exist($this->input->post('jp_id'))){
                $this->Jenis_pembayaran_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('jenis_pembayaran'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, jp_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Jenis_pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_pembayaran/update_action'),
		'jp_id' => set_value('jp_id', $row->jp_id),
		'jp_nama' => set_value('jp_nama', $row->jp_nama),
	    );
            $data['title'] = 'Jenis Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'jenis_pembayaran/Jenis_pembayaran_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_pembayaran'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('jp_id', TRUE));
        } else {
            $data = array(
		'jp_id' => $this->input->post('jp_id',TRUE),
		'jp_nama' => $this->input->post('jp_nama',TRUE),
	    );

            $this->Jenis_pembayaran_model->update($this->input->post('jp_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('jenis_pembayaran'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jenis_pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Jenis_pembayaran_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jenis_pembayaran'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_pembayaran'));
        }
    }

    public function deletebulk(){
        $delete = $this->Jenis_pembayaran_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('jp_id', 'jp id', 'trim|required');
	$this->form_validation->set_rules('jp_nama', 'jp nama', 'trim|required');

	$this->form_validation->set_rules('jp_id', 'jp_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jenis_pembayaran.php */
/* Location: ./application/controllers/Jenis_pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 17:43:24 */
/* http://harviacode.com */
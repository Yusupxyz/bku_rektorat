<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Bulan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'bulan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'bulan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'bulan';
            $config['first_url'] = base_url() . 'bulan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Bulan_model->total_rows($q);
        $bulan = $this->Bulan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'bulan_data' => $bulan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Bulan' => '',
        ];
        $data['code_js'] = 'bulan/codejs';
        $data['page'] = 'bulan/Bulan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Bulan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'bulan_id' => $row->bulan_id,
		'bulan_nama' => $row->bulan_nama,
	    );
        $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bulan/Bulan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bulan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('bulan/create_action'),
	    'bulan_id' => set_value('bulan_id'),
	    'bulan_nama' => set_value('bulan_nama'),
	);
        $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bulan/Bulan_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'bulan_id' => $this->input->post('bulan_id',TRUE),
		'bulan_nama' => $this->input->post('bulan_nama',TRUE),
	    );
if(! $this->Bulan_model->is_exist($this->input->post('bulan_id'))){
                $this->Bulan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('bulan'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, bulan_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Bulan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('bulan/update_action'),
		'bulan_id' => set_value('bulan_id', $row->bulan_id),
		'bulan_nama' => set_value('bulan_nama', $row->bulan_nama),
	    );
            $data['title'] = 'Bulan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'bulan/Bulan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bulan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('bulan_id', TRUE));
        } else {
            $data = array(
		'bulan_id' => $this->input->post('bulan_id',TRUE),
		'bulan_nama' => $this->input->post('bulan_nama',TRUE),
	    );

            $this->Bulan_model->update($this->input->post('bulan_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('bulan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Bulan_model->get_by_id($id);

        if ($row) {
            $this->Bulan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('bulan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('bulan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Bulan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('bulan_id', 'bulan id', 'trim|required');
	$this->form_validation->set_rules('bulan_nama', 'bulan nama', 'trim|required');

	$this->form_validation->set_rules('bulan_id', 'bulan_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Bulan.php */
/* Location: ./application/controllers/Bulan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-13 16:28:00 */
/* http://harviacode.com */
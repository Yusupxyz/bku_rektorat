<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Setting_laporan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'setting_laporan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'setting_laporan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'setting_laporan';
            $config['first_url'] = base_url() . 'setting_laporan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Setting_laporan_model->total_rows($q);
        $setting_laporan = $this->Setting_laporan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'setting_laporan_data' => $setting_laporan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Setting Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Setting Laporan' => '',
        ];
        $data['code_js'] = 'setting_laporan/codejs';
        $data['page'] = 'setting_laporan/Setting_laporan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Setting_laporan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'sl_id' => $row->sl_id,
		'sl_setting' => $row->sl_setting,
		'sl_data' => $row->sl_data,
	    );
        $data['title'] = 'Setting Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'setting_laporan/Setting_laporan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_laporan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('setting_laporan/create_action'),
	    'sl_id' => set_value('sl_id'),
	    'sl_setting' => set_value('sl_setting'),
	    'sl_data' => set_value('sl_data'),
	);
        $data['title'] = 'Setting Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'setting_laporan/Setting_laporan_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'sl_id' => $this->input->post('sl_id',TRUE),
		'sl_setting' => $this->input->post('sl_setting',TRUE),
		'sl_data' => $this->input->post('sl_data',TRUE),
	    );
if(! $this->Setting_laporan_model->is_exist($this->input->post('sl_id'))){
                $this->Setting_laporan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('setting_laporan'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, sl_id is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Setting_laporan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('setting_laporan/update_action'),
		'sl_id' => set_value('sl_id', $row->sl_id),
		'sl_setting' => set_value('sl_setting', $row->sl_setting),
		'sl_data' => set_value('sl_data', $row->sl_data),
	    );
            $data['title'] = 'Setting Laporan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'setting_laporan/Setting_laporan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_laporan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('sl_id', TRUE));
        } else {
            $data = array(
		'sl_id' => $this->input->post('sl_id',TRUE),
		'sl_setting' => $this->input->post('sl_setting',TRUE),
		'sl_data' => $this->input->post('sl_data',TRUE),
	    );

            $this->Setting_laporan_model->update($this->input->post('sl_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('setting_laporan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Setting_laporan_model->get_by_id($id);

        if ($row) {
            $this->Setting_laporan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('setting_laporan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_laporan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Setting_laporan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('sl_id', 'sl id', 'trim|required');
	$this->form_validation->set_rules('sl_setting', 'sl setting', 'trim|required');
	$this->form_validation->set_rules('sl_data', 'sl data', 'trim|required');

	$this->form_validation->set_rules('sl_id', 'sl_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Setting_laporan.php */
/* Location: ./application/controllers/Setting_laporan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-20 14:39:02 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan_sub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kegiatan_sub_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kegiatan_sub?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kegiatan_sub?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kegiatan_sub';
            $config['first_url'] = base_url() . 'kegiatan_sub';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kegiatan_sub_model->total_rows($q);
        $kegiatan_sub = $this->Kegiatan_sub_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kegiatan_sub_data' => $kegiatan_sub,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kegiatan Sub';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kegiatan Sub' => '',
        ];
        $data['code_js'] = 'kegiatan_sub/codejs';
        $data['page'] = 'kegiatan_sub/Kegiatan_sub_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Kegiatan_sub_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan_1' => $row->id_kegiatan_1,
		'id_kegiatan' => $row->id_kegiatan,
		'kode_kegiatan' => $row->kode_kegiatan,
		'nama_kegiatan' => $row->nama_kegiatan,
		'volume' => $row->volume,
		'satuan' => $row->satuan,
		'jumlah' => $row->jumlah,
	    );
        $data['title'] = 'Kegiatan Sub';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan_sub/Kegiatan_sub_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan_sub'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kegiatan_sub/create_action'),
	    'id_kegiatan_1' => set_value('id_kegiatan_1'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'nama_kegiatan' => set_value('nama_kegiatan'),
	    'volume' => set_value('volume'),
	    'satuan' => set_value('satuan'),
	    'jumlah' => set_value('jumlah'),
	);
        $data['title'] = 'Kegiatan Sub';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan_sub/Kegiatan_sub_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_kegiatan_1' => $this->input->post('id_kegiatan_1',TRUE),
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );
if(! $this->Kegiatan_sub_model->is_exist($this->input->post('id_kegiatan_1'))){
                $this->Kegiatan_sub_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan_sub'));
            }else{
                $this->create();
                $this->session->set_flashdata('message', 'Create Record Faild, id_kegiatan_1 is exist');
            }}
    }
    
    public function update($id) 
    {
        $row = $this->Kegiatan_sub_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan_sub/update_action'),
		'id_kegiatan_1' => set_value('id_kegiatan_1', $row->id_kegiatan_1),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
		'volume' => set_value('volume', $row->volume),
		'satuan' => set_value('satuan', $row->satuan),
		'jumlah' => set_value('jumlah', $row->jumlah),
	    );
            $data['title'] = 'Kegiatan Sub';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan_sub/Kegiatan_sub_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan_sub'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan_1', TRUE));
        } else {
            $data = array(
		'id_kegiatan_1' => $this->input->post('id_kegiatan_1',TRUE),
		'id_kegiatan' => $this->input->post('id_kegiatan',TRUE),
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );

            $this->Kegiatan_sub_model->update($this->input->post('id_kegiatan_1', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kegiatan_sub'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kegiatan_sub_model->get_by_id($id);

        if ($row) {
            $this->Kegiatan_sub_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kegiatan_sub'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan_sub'));
        }
    }

    public function deletebulk(){
        $delete = $this->Kegiatan_sub_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_kegiatan_1', 'id kegiatan 1', 'trim|required');
	$this->form_validation->set_rules('id_kegiatan', 'id kegiatan', 'trim|required');
	$this->form_validation->set_rules('kode_kegiatan', 'kode kegiatan', 'trim|required');
	$this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
	$this->form_validation->set_rules('volume', 'volume', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

	$this->form_validation->set_rules('id_kegiatan_1', 'id_kegiatan_1', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kegiatan_sub.php */
/* Location: ./application/controllers/Kegiatan_sub.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-30 22:33:19 */
/* http://harviacode.com */
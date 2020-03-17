<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Kegiatan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kegiatan' => '',
        ];
        $data['code_js'] = 'kegiatan/codejs';
        $data['page'] = 'kegiatan/Kegiatan_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Kegiatan_model->json();
    }

    public function json2($id) {
        header('Content-Type: application/json');
        echo $this->Kegiatan_model->json_sub1($id);
    }

    public function read($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kegiatan' => $row->id_kegiatan,
		'kode_kegiatan' => $row->kode_kegiatan,
		'nama_kegiatan' => $row->nama_kegiatan,
		'volume' => $row->volume,
		'satuan' => $row->satuan,
		'jumlah' => $row->jumlah,
	    );
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan/Kegiatan_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kegiatan/create_action'),
	    'id_kegiatan' => set_value('id_kegiatan'),
	    'kode_kegiatan' => set_value('kode_kegiatan'),
	    'nama_kegiatan' => set_value('nama_kegiatan'),
	    'volume' => set_value('volume'),
	    'satuan' => set_value('satuan'),
	    'jumlah' => set_value('jumlah'),
	);
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan/Kegiatan_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );$this->Kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kegiatan'));}
    }
    
    // sub kegiatan 1
    public function create_1() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kegiatan/create_action_1'),
        'id_kegiatan' => set_value('id_kegiatan'),
        'kode_kegiatan' => set_value('kode_kegiatan'),
        'nama_kegiatan' => set_value('nama_kegiatan'),
        'volume' => set_value('volume'),
        'satuan' => set_value('satuan'),
        'jumlah' => set_value('jumlah'),
    );
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data["kegiatan"] = $this->db->query("select * from kegiatan")->result();
        $data['page'] = 'kegiatan/Kegiatan_form_sub';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action_1() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create_1();
        } else {
        

        $data = array(
        'id_kegiatan'=>$this->input->post('kegiatan_id',TRUE),    
        'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
        'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
        'volume' => $this->input->post('volume',TRUE),
        'satuan' => $this->input->post('satuan',TRUE),
        'jumlah' => $this->input->post('jumlah',TRUE),
        );

        $this->Kegiatan_model->insert1($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('kegiatan'));}
    }

    // sub kegiatan 2
    public function create_2() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kegiatan/create_action_2'),
            'id_kegiatan' => set_value('id_kegiatan'),
            'kode_kegiatan' => set_value('kode_kegiatan'),
            'nama_kegiatan' => set_value('nama_kegiatan'),
            'volume' => set_value('volume'),
            'satuan' => set_value('satuan'),
            'jumlah' => set_value('jumlah'),
    );
        $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data["kegiatan"] = $this->db->query("select * from kegiatan_sub")->result();
        $data['page'] = 'kegiatan/Kegiatan_form_sub_2';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action_2() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create_2();
        } else {
        

        $data = array(
        'id_kegiatan_1'=>$this->input->post('kegiatan_id_1',TRUE),    
        'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
        'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
        'volume' => $this->input->post('volume',TRUE),
        'satuan' => $this->input->post('satuan',TRUE),
        'jumlah' => $this->input->post('jumlah',TRUE),
        );

        $this->Kegiatan_model->insert2($data);
        $this->session->set_flashdata('message', 'Create Record Success');
        redirect(site_url('kegiatan'));}
    }



    public function update($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kegiatan/update_action'),
		'id_kegiatan' => set_value('id_kegiatan', $row->id_kegiatan),
		'kode_kegiatan' => set_value('kode_kegiatan', $row->kode_kegiatan),
		'nama_kegiatan' => set_value('nama_kegiatan', $row->nama_kegiatan),
		'volume' => set_value('volume', $row->volume),
		'satuan' => set_value('satuan', $row->satuan),
		'jumlah' => set_value('jumlah', $row->jumlah),
	    );
            $data['title'] = 'Kegiatan';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kegiatan/Kegiatan_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kegiatan', TRUE));
        } else {
            $data = array(
		'kode_kegiatan' => $this->input->post('kode_kegiatan',TRUE),
		'nama_kegiatan' => $this->input->post('nama_kegiatan',TRUE),
		'volume' => $this->input->post('volume',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
	    );

            $this->Kegiatan_model->update($this->input->post('id_kegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kegiatan'));
        }
    }

    public function deletebulk(){
        $delete = $this->Kegiatan_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('kode_kegiatan', 'kode kegiatan', 'trim|required');
	$this->form_validation->set_rules('nama_kegiatan', 'nama kegiatan', 'trim|required');
	$this->form_validation->set_rules('volume', 'volume', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

	$this->form_validation->set_rules('id_kegiatan', 'id_kegiatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kegiatan.xls";
        $judul = "kegiatan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Volume");
	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");

	foreach ($this->Kegiatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->volume);
	    xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Kegiatan.php */
/* Location: ./application/controllers/Kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-29 19:13:55 */
/* http://harviacode.com */
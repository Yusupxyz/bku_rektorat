<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->layout->auth();
        $c_url = $this->router->fetch_class();
        $this->layout->auth_privilege($c_url); 
        $this->load->model('Groups_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Groups';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['code_js'] = 'groups/codejs';
        $data['page'] = 'groups/groups_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Groups_model->json();
    }

    public function read($id) 
    {
        $row = $this->Groups_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => $row->name,
		'description' => $row->description,
	    );
        $data['title'] = 'Groups';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'groups/groups_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('groups/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'description' => set_value('description'),
	);
        $data['title'] = 'Groups';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'groups/groups_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Groups_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('groups'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Groups_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('groups/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', $row->name),
		'description' => set_value('description', $row->description),
	    );
            $data['title'] = 'Groups';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'groups/groups_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'description' => $this->input->post('description',TRUE),
	    );

            $this->Groups_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('groups'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Groups_model->get_by_id($id);

        if ($row) {
            $this->Groups_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('groups'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('groups'));
        }
    }

    public function deletebulk(){
        $data = $_POST['msg_'];
        $dataid = explode(',', $data);
        foreach ($dataid as $key => $value) {
           $this->Groups_model->delete($value);
           $this->session->set_flashdata('message', 'Delete Record Success');
        }
        echo true;
    }
    public function printdoc(){
        $data = array(
            'groups_data' => $this->Groups_model->get_all(),
            'start' => 0
        );
        $this->load->view('groups/groups_print', $data);
    }
    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('description', 'description', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "groups.xls";
        $judul = "groups";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Description");

	foreach ($this->Groups_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->description);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=groups.doc");

        $data = array(
            'groups_data' => $this->Groups_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('groups/groups_doc',$data);
    }

}

/* End of file Groups.php */
/* Location: ./application/controllers/Groups.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-08 19:45:30 */
/* http://harviacode.com */
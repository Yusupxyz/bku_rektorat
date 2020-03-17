<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_type extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->layout->auth();
        $c_url = $this->router->fetch_class();
        $this->layout->auth_privilege($c_url); 
        $this->load->model('Menu_type_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }


    

    public function index()
    {
        $data['title'] = 'Menu Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['code_js'] = 'menu_type/codejs';
        $data['page'] = 'menu_type/menu_type_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Menu_type_model->json();
    }

    public function read($id) 
    {
        $row = $this->Menu_type_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_menu_type' => $row->id_menu_type,
		'type' => $row->type,
	    );
        $data['title'] = 'Menu Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'menu_type/menu_type_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_type'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu_type/create_action'),
	    'id_menu_type' => set_value('id_menu_type'),
	    'type' => set_value('type'),
	);
        $data['title'] = 'Menu Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'menu_type/menu_type_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'type' => $this->input->post('type',TRUE),
	    );

            $this->Menu_type_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu_type'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menu_type_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu_type/update_action'),
		'id_menu_type' => set_value('id_menu_type', $row->id_menu_type),
		'type' => set_value('type', $row->type),
	    );
            $data['title'] = 'Menu Type';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'menu_type/menu_type_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_type'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu_type', TRUE));
        } else {
            $data = array(
		'type' => $this->input->post('type',TRUE),
	    );

            $this->Menu_type_model->update($this->input->post('id_menu_type', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu_type'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menu_type_model->get_by_id($id);

        if ($row) {
            $this->Menu_type_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu_type'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_type'));
        }
    }

    public function deletebulk(){
        $data = $_POST['msg_'];
        $dataid = explode(',', $data);
        foreach ($dataid as $key => $value) {
           $this->Menu_type_model->delete($value);
           $this->session->set_flashdata('message', 'Delete Record Success');
        }
        echo true;
    }
    public function printdoc(){
        $data = array(
            'menu_type_data' => $this->Menu_type_model->get_all(),
            'start' => 0
        );
        $this->load->view('menu_type/menu_type_print', $data);
    }
    public function _rules() 
    {
	$this->form_validation->set_rules('type', 'type', 'trim|required');

	$this->form_validation->set_rules('id_menu_type', 'id_menu_type', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Menu_type.php */
/* Location: ./application/controllers/Menu_type.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-09 00:10:02 */
/* http://harviacode.com */
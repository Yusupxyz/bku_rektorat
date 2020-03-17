<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->layout->auth();
        $c_url = $this->router->fetch_class();
        $this->layout->auth_privilege($c_url); 
        $this->load->model('Menu_model');
        $this->load->library('form_validation');        
	   $this->load->library('datatables');
    }

    public function index()
    {
        // $data['title'] = 'Menu';
        // $data['subtitle'] = '';
        // $data['crumb'] = [
        //     'Dashboard' => '',
        // ];
        // $c_url = $this->router->fetch_class();
        // echo $this->layout->auth_privilege($c_url); 
        // echo "tes";
        // $data['page'] = 'menu/menu_list';
        // $this->load->view('template/backend', $data);
            redirect('dashboard', 'refresh');

    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Menu_model->json();
    }

    public function read($id) 
    {
        $row = $this->Menu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_menu' => $row->id_menu,
		'sort' => $row->sort,
		'level' => $row->level,
		'parent_id' => $row->parent_id,
		'icon' => $row->icon,
		'label' => $row->label,
		'link' => $row->link,
		'id' => $row->id,
		'id_menu_type' => $row->id_menu_type,
	    );
        $data['title'] = 'Menu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'menu/menu_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('menu/create_action'),
    	    'id_menu' => set_value('id_menu'),
    	    'sort' => set_value('sort'),
    	    'level' => set_value('level'),
    	    'parent_id' => set_value('parent_id'),
    	    'icon' => set_value('icon'),
    	    'label' => set_value('label'),
    	    'link' => set_value('link'),
    	    'id' => set_value('id'),
            'id_menu_type' => set_value('id_menu_type'),
    	    'id_groupss' => set_value('id_groupss'),
    	);
        $data["menu_type"] = $this->db->query("select * from menu_type")->result();
        $data['title'] = 'Menu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data["groups"] = $this->db->query("select * from groups")->result();
        $data['parent'] = $this->db->query("select id_menu, label from menu")->result();;
        $data['code_js'] = 'menu/codejsform';
        $data['page'] = 'menu/menu_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
         $this->_rules();

         if ($this->form_validation->run() == FALSE) {
             $this->create();
         } else {
            $data = array(
    		'sort' => $this->input->post('sort',TRUE),
    		'level' => $this->input->post('level',TRUE),
    		'parent_id' => preg_replace('/[^0-9]/', '', $this->input->post('parent_id',TRUE)),
    		'icon' => $this->input->post('icon',TRUE),
    		'label' => $this->input->post('label',TRUE),
    		'link' => $this->input->post('link',TRUE),
    		'id' => $this->input->post('id',TRUE),
            'id_menu_type' => $this->input->post('id_menu_type',TRUE),
	    );
            
            $this->Menu_model->insert($data);
            $data['id_groupss'] = $this->input->post('id_groupss',TRUE);
            $idmenu = $this->db->query("select max(id_menu) as idmenu from menu")->row()->idmenu;
            $id_groups = explode(",", $this->input->post('id_groupss',TRUE));
            foreach ($id_groups as $key => $value) {
                $this->db->query("insert into groups_menu values ('$value', '$idmenu')");
            }
            //echo $idmenu;
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cms/menu/side-menu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Menu_model->get_by_id($id);
        $id_groupss = $this->db->query("select GROUP_CONCAT(id_groups) as id_groups from groups_menu where id_menu = '$row->id_menu'")->row()->id_groups;
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('menu/update_action'),
        		'id_menu' => set_value('id_menu', $row->id_menu),
                'sort' => set_value('sort', $row->sort),
                'level' => set_value('level', $row->level),
        		'parent_id' => set_value('parent_id', $row->parent_id),
        		'icon' => set_value('icon', $row->icon),
        		'label' => set_value('label', $row->label),
        		'link' => set_value('link', $row->link),
        		'id' => set_value('id', $row->id),
                'id_menu_type' => set_value('id_menu_type', $row->id_menu_type),
        		'id_groupss' => set_value('id_menu_type', $id_groupss),
    	    );
            $data['title'] = 'Menu';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];
            $data["groups"] = $this->db->query("select * from groups")->result();

            $data["menu_type"] = $this->db->query("select * from menu_type")->result();
            $data['code_js'] = 'menu/codejsform';
            $data['page'] = 'menu/menu_form';
            $data['parent'] = $this->db->query("select id_menu, label from menu")->result();;

            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
            $data = array(
    		'sort' => $this->input->post('sort',TRUE),
    		'level' => $this->input->post('level',TRUE),
    		'parent_id' =>preg_replace('/[^0-9]/', '', $this->input->post('parent_id',TRUE)),
    		'icon' => $this->input->post('icon',TRUE),
    		'label' => $this->input->post('label',TRUE),
    		'link' => $this->input->post('link',TRUE),
    		'id' => $this->input->post('id',TRUE),
    		'id_menu_type' => $this->input->post('id_menu_type',TRUE),
    	    );
            $id_menu = $this->input->post('id_menu', TRUE);
            //echo $id_menu;
            $query = $this->db->query("delete from groups_menu where id_menu = '$id_menu'");
             $id_groups = explode(",", $this->input->post('id_groupss',TRUE));
            foreach ($id_groups as $key => $value) {

                $this->db->query("insert into groups_menu values ('$value', ' $id_menu')");
            }
            $this->Menu_model->update($this->input->post('id_menu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cms/menu/side-menu'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Menu_model->get_by_id($id);

        if ($row) {
            $this->Menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu'));
        }
    }

    

    public function deletebulk(){
        $data = $_POST['msg_'];
        $dataid = explode(',', $data);
        foreach ($dataid as $key => $value) {
           $this->Menu_model->delete($value);
           $this->session->set_flashdata('message', 'Delete Record Success');
        }
        echo true;
    }
    public function printdoc(){
        $data = array(
            'menu_data' => $this->Menu_model->get_all(),
            'start' => 0
        );
        $this->load->view('menu/menu_print', $data);
    }
    public function _rules() 
    {
	$this->form_validation->set_rules('sort', 'sort', 'trim|required');
	$this->form_validation->set_rules('level', 'level', 'trim|required');
	$this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('label', 'label', 'trim|required');
	$this->form_validation->set_rules('link', 'link', 'trim|required');
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('id_menu_type', 'id menu type', 'trim|required');

	$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-07 21:49:01 */
/* http://harviacode.com */
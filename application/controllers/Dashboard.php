<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
	}
	
	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        //$this->layout->set_privilege(1);
        $data['code_js'] = 'Dashboard/codejs';
        $data['page'] = 'Dashboard/Index';
		$this->load->view('template/backend', $data);
	}

}

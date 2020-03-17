<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
	}
	
	public function index()
	{
		$data['title'] = 'Profile';
		$data['subtitle'] = '';
        $data['crumb'] = [
            'Profile' => '',
        ];
        //$this->layout->set_privilege(1);
        $data['page'] = 'profile';
		$this->load->view('template/backend', $data);
	}

}

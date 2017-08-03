<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        if (!$this->session->userdata('is_logged_in')) {
            redirect('login', 'refresh');
        }
       
    }

    public function index() {
		$data['title'] = 'Kingdom Revelator';
        $data['menu'] = 'dashboard';
        $data['content'] = 'admin/dashboard';
        $this->load->view('admin/template', $data);
    }

}

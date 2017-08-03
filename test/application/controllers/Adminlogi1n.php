<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function login()
	{
		 if($this->input->post())
		 {
			$username  = $this->input->post('username');
			$password  = $this->input->post('password');
			$res	   = $this->db->query("SELECT * FROM  kr_users WHERE `Email_address`='$username' and Password='$password'");
			$res_array = $res->row_array();
			if($res->num_rows()>0)
			{
				$this->session->set_userdata('id',$res_array['id']);
				redirect('Distributer/subscribers');
			}
	     }
		
		 $data['content'] = 'Backend/login';
		 $data['menu']='';
		 $this->load->view('Backend/template',$data); 
	}
}

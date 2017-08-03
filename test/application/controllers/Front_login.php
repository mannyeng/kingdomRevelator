<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Front_login extends CI_Controller {



	/*

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

	 

	function __construct() {

	    parent::__construct();

	    $this->load->library('form_validation');

        $this->load->helper('form');

		$this->load->helper('url');  

    }

	 

	public function form()

	{

		if($this->input->post())

		{

			

			$username			 =	str_replace("'", "",$this->input->post('username'));

			$password		 	 =	str_replace("'", "",$this->input->post('password'));

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

            $this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE)

			{

				$res = $this->db->query("SELECT * FROM kr_subscribers WHERE Email_address='$username' and Password='$password'");

					

				if($res->num_rows()=='')

				{

				   $res = $this->db->query("SELECT * FROM kr_subscribers WHERE Subscriber_id='$username' and Password='$password'");

				}

				$row = $res->row_array();

				if($res->num_rows()>0)

				{

					$this->session->set_userdata('role','subscriber');

					$this->session->set_userdata('id',$row['id']);

					redirect('subscriber_profile/previous_edition');

				}

				else // incorrect username or password

				{

					$this->session->set_flashdata('error', 'User name or Password  mismatch.');

				}

			}



			

		}



		$data['content'] = 'front_login/form';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

	

	public function dist_login()

	{

		if($this->input->post())

		{

			

			$username			 =	str_replace("'", "",$this->input->post('username'));

			$password		 	 =	str_replace("'", "",$this->input->post('password'));

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

            $this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE)

			{

				$res = $this->db->query("SELECT * FROM kr_users WHERE Email_address='$username' and Password='$password' and (admin_type='Distributer')");

					

				if($res->num_rows()=='')

				{

				   $res = $this->db->query("SELECT * FROM kr_users WHERE login_id='$username' and Password='$password' and (admin_type='Distributer')");

				}

				$row = $res->row_array();

				if($res->num_rows()>0)

				{

					$this->session->set_userdata('role',$row['admin_type']);

					$this->session->set_userdata('id',$row['id']);

					if($row['admin_type']=='Distributer')

					{

						redirect('distributer');

					}

					if($row['admin_type']=='Article')

					{

						redirect('article');

					}



				}

				else // incorrect username or password

				{

					$this->session->set_flashdata('error', 'User name or Password  mismatch.');

				}

			}



			

		}



		$data['content'] = 'front_login/dist_login';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

	

	public function art_login()

	{

		if($this->input->post())

		{

			

			$username			 =	str_replace("'", "",$this->input->post('username'));

			$password		 	 =	str_replace("'", "",$this->input->post('password'));

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

            $this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE)

			{

				$res = $this->db->query("SELECT * FROM kr_users WHERE Email_address='$username' and Password='$password' and (admin_type='Article')");

					

				if($res->num_rows()=='')

				{

				   $res = $this->db->query("SELECT * FROM kr_users WHERE login_id='$username' and Password='$password' and (admin_type='Article')");

				}

				$row = $res->row_array();

				if($res->num_rows()>0)

				{

					$this->session->set_userdata('role',$row['admin_type']);

					$this->session->set_userdata('id',$row['id']);

					if($row['admin_type']=='Article')

					{

						redirect('article');

					}

					



				}

				else // incorrect username or password

				{

					$this->session->set_flashdata('error', 'User name or Password  mismatch.');

				}

			}



			

		}



		$data['content'] = 'front_login/art_login';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

	

	public function int_login()

	{

		if($this->input->post())

		{

			

			$username			 =	str_replace("'", "",$this->input->post('username'));

			$password		 	 =	str_replace("'", "",$this->input->post('password'));

			$this->form_validation->set_rules('username', 'Username', 'trim|required');

            $this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE)

			{

				$res = $this->db->query("SELECT * FROM kr_users WHERE Email_address='$username' and Password='$password' and (admin_type='Intercession')");

					

				if($res->num_rows()=='')

				{

				   $res = $this->db->query("SELECT * FROM kr_users WHERE login_id='$username' and Password='$password' and (admin_type='Intercession')");

				}

				$row = $res->row_array();

				if($res->num_rows()>0)

				{

					$this->session->set_userdata('role',$row['admin_type']);

					$this->session->set_userdata('id',$row['id']);

					if($row['admin_type']=='Intercession')

					{

						redirect('distributer');

					}

					



				}

				else // incorrect username or password

				{

					$this->session->set_flashdata('error', 'User name or Password  mismatch.');

				}

			}



			

		}



		$data['content'] = 'front_login/int_login';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

}


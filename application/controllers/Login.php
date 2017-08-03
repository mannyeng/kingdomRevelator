<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
     parent::__construct();
	  // $this->load->model('Settings_model','settings');
	   //$this->load->model('Users_model','users');
	    $this->load->library('form_validation');
        $this->load->helper('form');
		$this->load->helper('url');  
    }
	
	/**
    * encript the password 
    * @return mixed
    */	
	function __encrip_password($password) {
        return md5($password);
    }

    public function index() {
		
	    $this->session->set_flashdata('error', '');
		$user_name = str_replace("'", "",$this->input->post('user_name'));
		$password = str_replace("'", "",$this->input->post('password'));
		$security_a = $this->input->post('security_a');
		$role = $this->input->post('role');
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
				
		$is_valid='1';
			if($is_valid !==false)
			{	
				
				    $res = $this->db->query("SELECT a.id as user_id ,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,a.admin_type,b.* FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id  WHERE a.Email_address='$user_name' and a.Password='$password'  and admin_type='$role' and a.flag='0'");
					if($res->num_rows()=='')
					{
					  $res = $this->db->query("SELECT a.id as user_id ,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,a.admin_type,b.* FROM kr_users a inner join kr_distributers b on a.id=b.User_id  WHERE  a.login_id='$user_name' and a.Password='$password' and admin_type='$role' and a.flag='0'");
					}
				$row = $res->row_array();	
				if($res->num_rows()>0)
				{
					//$role = $row['admin_type'];
					$this->session->set_userdata('role',$row['admin_type']);
					$this->session->set_userdata('id',$row['user_id']);
					$this->session->set_userdata('name',$row['First_name']);
					$this->session->set_userdata('National_admin_id',$row['National_admin_id']);
					$this->session->set_userdata('Zonal_admin_id',$row['Zonal_admin_id']);
					$this->session->set_userdata('State_admin_id',$row['State_admin_id']);
					$this->session->set_userdata('State_zone_admin_id',$row['State_zone_admin_id']);
					//$this->session->set_userdata('County_admin_id',$row['County_admin_id']);
					//$this->session->set_userdata('Distributer_admin_id',$row['County_admin_id']);
					//$is_valid['is_logged_in'] = true;
					//$is_valid['role'] = $role;
					$this->session->set_userdata($is_valid);
					//if($role == 'admin')
					//redirect('dashboard/index');
					//else
					if($role == 'county')
					{
						redirect('county');
					}
					if($role == 'zone')
					{
						redirect('zone');
					}
					if($role == 'state')
					{
						redirect('state');
					}
					if($role == 'national')
					{
						redirect('national');
					}
					if($role == 'Distributer')
					{
						redirect('distributer');
					}
					if($role == 'webadmin')
					{
						redirect('webadmin');
					}
					if($role == 'state_zone')
					{
						redirect('state_zone');
					}
					if($role == 'finance')
					{
						redirect('finance');
					}
				}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'User name and Password  mismatch.');
				}
			}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'User name and Password  mismatch.');
				}
			}
			if($role == 'national')
			{
				
				redirect('national_login');
			}
if($role == 'zone' )
{

				redirect('zone_login');
}
			if($role == 'state_zone' || $role == 'state')
			{
				
				redirect('state_zone_login');
			}
        
    }
	
	
	
	
	
	public function admin() {		
			
	    $this->session->set_flashdata('error', '');
		$user_name = str_replace("'", "",$this->input->post('user_name'));
		$password = str_replace("'", "",$this->input->post('password'));
		$security_a = str_replace("'", "",$this->input->post('security_a'));
		
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('security_a', 'Security Key', 'required');
        if ($this->form_validation->run() == TRUE) {
				
		   
		$is_valid='1';
			if($is_valid !==false)
			{	
			
				$res = $this->db->query("SELECT * FROM kr_users  WHERE Email_address='$user_name' and Password='$password' and security_a='$security_a' and admin_type='webadmin' and flag='0'");
				
				$row = $res->row_array();	
				if($res->num_rows()>0)
				{
					//$role = $row['admin_type'];
					$this->session->set_userdata('role',$row['admin_type']);
					
					$this->session->set_userdata($is_valid);
					
						redirect('webadmin');
					
				}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'User name and Password or Security question mismatch.');
				}
			}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'User name and Password or Security question mismatch.');
				}
			}
            $data['title'] = 'Sehion USa';
            $this->load->view('backend/admin_login', $data);
        
    }
	
	public function national_login() {		
            $data['title'] = 'Sehion USa';
            $this->load->view('backend/national_login', $data);
    }
	
	public function zone_login() {		
            $data['title'] = 'Sehion USa';
            $this->load->view('backend/zone_login', $data);
    }

    public function finance_login() {		
            $data['title'] = 'Sehion USa';
            $this->load->view('backend/finance_login', $data);
    }


    public function state_zone_login() {		
            $data['title'] = 'Sehion USa';
            $this->load->view('backend/state_zone_login', $data);
    }

	public function forgotpass()
	{
		$this->session->set_flashdata('error', '');
	    $this->session->set_flashdata('success', '');
		$user_name = str_replace("'", "",$this->input->post('user_name'));
		$role = $this->input->post('role');
		if($role=='')
		{
			$role = $this->uri->segment(3);
		}
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
				
		$is_valid='1';
			if($is_valid !==false)
			{	
				$res = $this->db->query("SELECT * FROM kr_users  WHERE Email_address='$user_name' and admin_type='$role' and flag='0'");
				$row = $res->row_array();
				if($role=='Distributer' || $role=='Article' || $role=='Intercession' )
				{
					$this->db->select('kr_distributers.First_name');
					$this->db->join('kr_users','kr_users.id=kr_distributers.User_id');
					$member_data = $this->db->get_where('kr_distributers',array('kr_users.Email_address'=>$user_name,'kr_users.admin_type'=>$role))->row_array();

				}
				else
				{
					$this->db->select('kr_distributers.First_name');
					$this->db->join('kr_users','kr_users.Distributer_id=kr_distributers.id');
					$member_data = $this->db->get_where('kr_distributers',array('kr_users.Email_address'=>$user_name,'kr_users.admin_type'=>$role))->row_array();
				}
	
				if($res->num_rows()>0)
				{
					$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		
					$config['protocol']  = 'smtp';
					$config['charset']   = 'iso-8859-1';
					$config['smtp_host'] = $smtp['host'];
					$config['smtp_user'] = $smtp['username'];
					$config['smtp_pass'] = $smtp['password'];
					$config['smtp_port'] = $smtp['port'];
					$config['mailtype']  = 'html';
					
					@$this->load->library('email');
					@$this->email->initialize($config);

					$this->email->from($smtp['from_email'], $smtp['from_name']);
					$this->email->to($user_name);
					$this->email->bcc($smtp['notify_email']);

					$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';
					$mailContent.='<tr style="color:#fff;background:#C7532E">';
					$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Revelator USA" width="222" height="79"></td>';
					$mailContent.='<td width="90%" align="center">&nbsp;</td>';
					$mailContent.='</tr>';
					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
					$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';
					$mailContent.='</tr>';
					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
					$mailContent.='<td height="213" colspan="2" valign="top">';
					$mailContent.='<p>Hi '.$member_data['First_name'].',<br></p>';
					$mailContent.='<p>Use below credentials to update your details.<br><br>Username : <b>'.$user_name.'</b><br>Password : <b>'.$row['Password'].'</b> <br><br><p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
						  Kingdom Revelator USA</p>
						</td>
					  </tr>
					</table>';	
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();
					$this->session->set_flashdata('success', 'Password Send To Email Address');
					
				}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'Invalid Email address');
				}
			}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'Invalid Email address');
				}
			}
			if($role=='Distributer')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_dis', $data);
			}
			if($role=='Article')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_dis', $data);
			}
			if($role=='Intercession')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_dis', $data);
			}
			if($role=='state_zone')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_state_zone', $data);
			}
			if($role=='state')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_state', $data);
			}
			if($role=='zone')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_zone', $data);
			}
			if($role=='national')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_national', $data);
			}
			if($role=='finance')
			{
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_finance', $data);
			}
	}
	
	


	public function forgotpass_webadmin()
	{
		$this->session->set_flashdata('error', '');
	    $this->session->set_flashdata('success', '');
		$user_name = str_replace("'", "",$this->input->post('user_name'));
		
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
				
		$is_valid='1';
			if($is_valid !==false)
			{	
				$res = $this->db->query("SELECT * FROM smtp_config  WHERE notify_email='$user_name'");
				$row = $this->db->query("SELECT * FROM kr_users WHERE admin_type='webadmin'")->row_array();	
				if($res->num_rows()>0)
				{
					$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		
					$config['protocol']  = 'smtp';
					$config['charset']   = 'iso-8859-1';
					$config['smtp_host'] = $smtp['host'];
					$config['smtp_user'] = $smtp['username'];
					$config['smtp_pass'] = $smtp['password'];
					$config['smtp_port'] = $smtp['port'];
					$config['mailtype']  = 'html';
					
					@$this->load->library('email');
					@$this->email->initialize($config);

					$this->email->from($smtp['from_email'], $smtp['from_name']);
					$this->email->to($user_name);
					$this->email->bcc($smtp['notify_email']);

					$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';
					$mailContent.='<tr style="color:#fff;background:#C7532E">';
					$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Revelator USA" width="222" height="79"></td>';
					$mailContent.='<td width="90%" align="center">&nbsp;</td>';
					$mailContent.='</tr>';
					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
					$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';
					$mailContent.='</tr>';
					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
					$mailContent.='<td height="213" colspan="2" valign="top">';
					$mailContent.='<p>Hi Admin,<br></p>';
					$mailContent.='<p>Use below credentials to update your details.<br><br>Username : <b>'.$row['Email_address'].'</b><br>Password : <b>'.$row['Password'].'</b><br>Security answer : <b>'.$row['security_a'].'</b> <br><br><p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
				  Kingdom Revelator USA</p>
				</td>
			  </tr>
			</table>';	
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();
					$this->session->set_flashdata('success', 'Password Send To Email Address');
					
				}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'Invalid Email address');
				}
			}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'Invalid Email address');
				}
			}
			
			  $data['title'] = 'Sehion USa';
			  $this->load->view('backend/forgot/forgot_pass_web', $data);
	}
	
	public function sub_forgotpass()
	{
		$this->session->set_flashdata('error', '');
		$this->session->set_flashdata('success', '');
		$user_name = str_replace("'", "",$this->input->post('user_name'));
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
				
		$is_valid='1';
			if($is_valid !==false)
			{	
				$res = $this->db->query("SELECT * FROM kr_subscribers  WHERE Email_address='$user_name'");
				$row = $res->row_array();	
				$member_data = $this->db->get_where('kr_subscribers',array('kr_subscribers.Email_address'=>$user_name))->row_array();

				if($res->num_rows()>0)
				{
					$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		
					$config['protocol']  = 'smtp';
					$config['charset']   = 'iso-8859-1';
					$config['smtp_host'] = $smtp['host'];
					$config['smtp_user'] = $smtp['username'];
					$config['smtp_pass'] = $smtp['password'];
					$config['smtp_port'] = $smtp['port'];
					$config['mailtype']  = 'html';
					
					@$this->load->library('email');
					@$this->email->initialize($config);

					$this->email->from($smtp['from_email'], $smtp['from_name']);
					$this->email->to($user_name);
					$this->email->bcc($smtp['notify_email']);
					$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';
					$mailContent.='<tr style="color:#fff;background:#C7532E">';
					$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Revelator USA" width="222" height="79"></td>';
					$mailContent.='<td width="90%" align="center">&nbsp;</td>';
					$mailContent.='</tr>';
					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
					$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';
					$mailContent.='</tr>';
					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
					$mailContent.='<td height="213" colspan="2" valign="top">';
					$mailContent.='<p>Hi '.$member_data['First_name'].',<br></p>';
					$mailContent.='<p>Use below credentials to update your details.<br><br>Username : <b>'.$user_name.'</b><br>Password : <b>'.$row['Password'].'</b> <br><br><p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
				  Kingdom Revelator USA</p>
				</td>
			  </tr>
			</table>';	
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();
					$this->session->set_flashdata('success', 'Password Send To Email Address');
					
				}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'Invalid Email address');
				}
			}
				else // incorrect username or password
				{
					$this->session->set_flashdata('error', 'Invalid Email address');
				}
			}
		  $data['title'] = 'Sehion USa';
          $this->load->view('backend/sub_forgot_pass', $data);
	}

    public function logout() {
        $data = array();
		$type = $this->session->userdata('role');
        $data['is_logged_in'] = $this->session->userdata('is_logged_in');
         
        $this->session->unset_userdata($data);
	  
        $this->session->sess_destroy();
		if($type=='subscriber')
		{
			redirect('');
		}
		if($type=='national')
		{
			redirect('national_login');
		}
		if($type=='zone')
		{
			redirect('zone_login');
		}
		if($type=='state')
		{
			redirect('state_zone_login');
		}
		if($type=='state_zone')
		{
			redirect('state_zone_login');
		}
		if($type=='webadmin')
		{
			redirect('kradmin');
		}
		if($type=='financial')
		{
			redirect('national_zone_login');
		}
		if($type=='Distributer')
		{
			redirect('');
		}
        redirect('');
    }
	
}
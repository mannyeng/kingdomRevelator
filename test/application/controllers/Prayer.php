<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Prayer extends CI_Controller {



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

	public function form()

	{

		$this->session->set_flashdata("alert",'');

		

		if($this->input->post())

		{

			$this->session->set_flashdata("alert",'success');
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

				$this->email->from($this->input->post('Email'),$this->input->post('Name'));
				$this->email->bcc($smtp['notify_email']);
				$this->email->to('krprayerusa@gmail.com');
				//$this->email->to('harish@ksofttechnologies.com');
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
				$mailContent.='<p>Hi '.$this->input->post('Name').',<br></p>';
				$mailContent.='<p>>Name :'.$this->input->post('Name').'<br>Email :'.$this->input->post('Email').'<br>Location:'.$this->input->post('Location').'<br>Contact Number :'.$this->input->post('Contact').'<br>Details :'.$this->input->post('Details').'</p>';
				$mailContent.='</p>';	
				$mailContent.='<p>Administrator,<br>
				Kingdom Revelator USA</p>
				</td>
				</tr>
				</table>';
				
				$this->email->subject('Message from Kingdom Revelator USA');
				$this->email->message($mailContent);
				$this->email->send();

		}

		

		$data['content'] = 'prayer/form';

		$data['menu']='';

		$this->load->view('template',$data );

	}

}






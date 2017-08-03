<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Subscription_renew_cron extends CI_Controller {



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

	public function index()

	{

		$res     = $this->db->query("SELECT * FROM kr_subscribers");

		$res_row = $res->result_array();

		foreach($res_row as $row)

		{

			$future     = strtotime($row['expiry_date']); //Future date.

			$timefromdb = strtotime(date("Y-m-d"));

			$timeleft   = $future-$timefromdb;

			$daysleft = round((($timeleft/24)/60)/60); 

			

			if($daysleft<=30)

			{

				if($daysleft%7==0)

				{

					/*$config['protocol']  = 'smtp';

					$config['charset']   = 'iso-8859-1';

					$config['smtp_host'] = 'mail.smtp2go.com';

					$config['smtp_user'] = 'jithin@ksofttechnologies.com';

					$config['smtp_pass'] = 'iGhTsfkvcT3T';

					$config['smtp_port'] = '2525';

					$config['mailtype']  = 'html';

					

					$this->load->library('email');

					$this->email->initialize($config);

	

					$this->email->from('jithin@ksofttechnologies.com', 'Admin');

					$this->email->to($Email);

				

					

					$this->email->subject('Info');

					$this->email->message('<html><head></head><body>Your Subscription will End : '.date('Y-m-d',strtotime($row['expiry_date'])).'<br>Remaining Days: '.$daysleft.'<br></body></html>');

					$this->email->send();*/

					$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->result_array();
									
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
					$this->email->to($Email);
					//$this->email->bcc($smtp['notify_email']);

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
					$mailContent.='<p>Hi '.$detail['First_name'].',<br></p>';
					$mailContent.='<p>Your Subscription will End : '.date('Y-m-d',strtotime($row['expiry_date'])).'<br>Remaining Days: '.$daysleft.'<br>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
					Kingdom Revelator USA</p>
					</td>
					</tr>
					</table>';
					
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();

					/*$to       = $Email;

					$subject  = 'Message from Kingdom Revelator USA';

					$txt 	  = '<html><head></head><body>Your Subscription will End : '.date('Y-m-d',strtotime($row['expiry_date'])).'<br>Remaining Days: '.$daysleft.'<br></body></html>';

					$headers .= "MIME-Version: 1.0" . "\r\n";

					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



					$headers .= 'From: <jithin@ksofttechnologies.com.com>' . "\r\n";

					mail($to,$subject,$txt,$headers);*/

				}

			}



		}

	}

}






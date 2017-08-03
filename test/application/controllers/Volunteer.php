<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Volunteer extends CI_Controller {



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

		//unset($this->session->flashdata('alert'));

		$this->load->model('Distributer_model');

		 $this->session->set_flashdata('alert', '');



		if($this->input->post())

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

			$this->email->to('jithin@ksofttechnologies.com');

			$mailContent= "hai";

			foreach ($this->input->post(NULL,TRUE) as $key => $value)

			{

				$mailContent.= htmlspecialchars($key)."-".htmlspecialchars($value)."<br/>";

			}

			

		

			

			$this->email->subject('Message from Kingdom Revelator USA');

			$this->email->message($mailContent);

			$this->email->send();



			$First_name		=	str_replace("'", "",$this->input->post('First_name'));

			$Last_name		=	str_replace("'", "",$this->input->post('Last_name'));

			$Address1		=	str_replace("'", "",$this->input->post('Address1'));

			$Address2		=	str_replace("'", "",$this->input->post('Address2'));

			$City			=	str_replace("'", "",$this->input->post('City'));

			$State			=	str_replace("'", "",$this->input->post('State'));

			$Zipcode		=	str_replace("'", "",$this->input->post('Zipcode'));

			$Home_phone		=	str_replace("'", "",$this->input->post('Phone_Number_H'));

			$Cell_phone		=	str_replace("'", "",$this->input->post('Phone_Number_C'));

			$Email			=	str_replace("'", "",$this->input->post('Email'));

			$Password	  	=	str_replace("'", "",$this->input->post('password'));

			$amount  	  	=	str_replace("'", "",$this->input->post('amount'));

			$Volunteering 	=	'1';//@implode(",",$this->input->post('Volunteering'));

			$Copies_requested    =	str_replace("'", "",$this->input->post('Copies_requested'));

			$optionssubscription =  str_replace("'", "",$this->input->post('Request_month'));

			$optionspayment  =  str_replace("'", "",$this->input->post('optionspayment'));

			

			$price           = $this->db->query("SELECT * FROM kr_discount ")->row_array();

			//$amount         = $optionssubscription*$Copies_requested;

			$item_copy     = $Copies_requested." copies";

			$agent_name    = '';

			$cash_comments = '';

			$created	       = date('Y-m-d H:i:s');

			$subscription_date = date('Y-m-d',strtotime('+1 month',strtotime($created)));

			

			

			if($optionssubscription==1)

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d',strtotime('+1 month', $t));

				//echo $expiry_date = date('Y-m-d',strtotime($subscription_date)+strtotime('+5 years'));

			}

			else if($optionssubscription==3)

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d',strtotime('+3 month', $t));

				//echo $expiry_date = date('Y-m-d',strtotime($subscription_date)+strtotime('+5 years'));

			}

			else if($optionssubscription==6)

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d',strtotime('+6 month', $t));

				//echo $expiry_date = date('Y-m-d',strtotime($subscription_date)+strtotime('+5 years'));

			}

			else if($optionssubscription==9)

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d',strtotime('+9 month', $t));

				//echo $expiry_date = date('Y-m-d',strtotime($subscription_date)+strtotime('+5 years'));

			}

			else if($optionssubscription==12)

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d',strtotime('+1 years', $t));

				//echo $expiry_date = date('Y-m-d',strtotime($subscription_date)+strtotime('+5 years'));

			}

			

			if($price['price_cpy'])

			{

				$item_name= $optionssubscription.' Month subscription,$'.$price['price_cpy'].' per copy';

			

			}			

			

			if($optionspayment=='Cash')

			{

				$agent_name    = str_replace("'", "",$this->input->post('cash_agent_name'));

				$cash_comments = str_replace("'", "",$this->input->post('cash_comments'));

			}

			if($optionspayment=='Cheque')

			{

				$agent_name    = str_replace("'", "",$this->input->post('cheque_agent_name'));

				$cash_comments = str_replace("'", "",$this->input->post('cheque_comments'));

			}		



			$Exist_user		=   $this->db->query("SELECT * FROM kr_users WHERE `Email_address`='$Email' and admin_type='Distributer'");

			if($Exist_user->num_rows()>0)

			{ 

				$this->session->set_flashdata('alert','fails');

			}

			else

			{

				//$this->db->trans_start();

				$this->db->query("INSERT INTO `kr_users`(`Email_address`, `Password`, `National_admin_id`, `State_admin_id`, `County_admin_id`, `Zonal_admin_id`,`admin_type`) VALUES ('$Email','$Password','','','','','Distributer')");

				$user_id = $this->db->insert_id();



				$this->db->query("UPDATE `kr_users` SET `login_id`='".sprintf("DIS%05s",$user_id)."' WHERE id='$user_id'");



				$this->db->query("INSERT INTO `kr_distributers`(`First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `Home_phone`, `Cell_phone`, `Email_address`,`Volunteering`,`User_id`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$Home_phone','$Cell_phone','$Email','$Volunteering','$user_id')");



			    $dist_id = $this->db->insert_id();



			    $this->db->query("UPDATE `kr_distributers` SET `disributer_id`='".sprintf("DIS%05s",$user_id)."' WHERE id='$dist_id'");

			

				//$this->db->trans_complete();

				//if($this->db->trans_status() === TRUE)

				//{

					if($optionspayment=='online')

					{

						



                          $data['Distributer_id'] = sprintf("DIS%05s",$user_id);

				          $data['subscription_length'] = str_replace("'", "",$this->input->post('Request_month'));

				          $data['No_of_copies'] = str_replace("'", "",$this->input->post('Copies_requested'));  

				          $data['subscription_date'] = date('Y-m-d', strtotime('first day of next month'));

		                  $no_month = $data["subscription_length"];

						  $t = strtotime($data['subscription_date']);

						  $data['expiry_date'] = date('Y-m-d',strtotime('+'.$no_month.' month', $t));



						  $order_id = $this->Distributer_model->order_add($data);



						  $this->db->query("INSERT INTO `kr_dis_payment`(`Subscriber_id`,`order_id`,`Mode_of_pay`, `paypal_status`, `paid_amnt`) VALUES ('".sprintf("DIS%05s",$user_id)."','$order_id','".strtolower($optionspayment)."','pending','$amount')");



                          $paymentid = $this->db->insert_id();





						$this->load->library('paypal_lib');

						//Set variables for paypal form

						$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; //test PayPal api url

						//$paypalID = 'jithin@ksofttechnologies.com'; //business email

						$paypalID = 'krusappal@gmail.com'; //business email

						$returnURL = base_url().'paypal/success'; //payment success url

						$cancelURL = base_url().'paypal/cancel/'; //payment cancel url

						$notifyURL = base_url().'paypal/ipn'; //ipn url

						

						$this->paypal_lib->add_field('cmd','_cart');

						$this->paypal_lib->add_field('upload','1');

						$this->paypal_lib->add_field('business', $paypalID);

						$this->paypal_lib->add_field('return', $returnURL);

						$this->paypal_lib->add_field('cancel_return', $cancelURL);

						$this->paypal_lib->add_field('notify_url', $notifyURL);

						$this->paypal_lib->add_field('item_name_1', $item_name);

						$this->paypal_lib->add_field('custom', sprintf("DIS%05s",$user_id).'#'.$paymentid);

						$this->paypal_lib->add_field('item_number_1', $item_copy);							

						$this->paypal_lib->add_field('amount_1',$amount);  

						

						/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

						$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

						

						$this->paypal_lib->paypal_auto_form();



						$this->distributer_mail($First_name,$Email,$item_name,$amount,$optionspayment,$item_copy,$Password);





						exit;

					}

					else

					{

					  $data['Distributer_id'] = sprintf("DIS%05s",$user_id);

			          $data['subscription_length'] = str_replace("'", "",$this->input->post('Request_month'));

			          $data['No_of_copies'] = str_replace("'", "",$this->input->post('Copies_requested'));  

			          $data['subscription_date'] = date('Y-m-d', strtotime('first day of next month'));

	                  $no_month = $data["subscription_length"];

					  $t = strtotime($data['subscription_date']);

					  $data['expiry_date'] = date('Y-m-d',strtotime('+'.$no_month.' month', $t));

					  $data['Cash_Check_by'] = $agent_name;

					  $data['comments'] = $cash_comments;



					  $order_id = $this->Distributer_model->order_add($data);



					  $this->db->query("INSERT INTO `kr_dis_payment`(`Subscriber_id`,`order_id`,`Mode_of_pay`, `paypal_status`, `paid_amnt`) VALUES ('".sprintf("DIS%05s",$user_id)."','$order_id','".strtolower($optionspayment)."','pending','$amount')");



                     

						$this->distributer_mail($First_name,$Email,$item_name,$amount,$optionspayment,$item_copy,$Password);

						$this->session->set_flashdata('alert','success');





					}

										

				//}

			}

		}

		

		$data['content'] = 'volunteer/form';

		$data['menu']='';

		$this->load->view('template',$data );

	}

	

	public function article()

	{

	   $this->session->set_flashdata('alert', '');



		if($this->input->post())

		{

			$First_name		=	str_replace("'", "",$this->input->post('First_name'));

			$Last_name		=	str_replace("'", "",$this->input->post('Last_name'));

			$Address1		=	str_replace("'", "",$this->input->post('Address1'));

			$Address2		=	str_replace("'", "",$this->input->post('Address2'));

			$City			=	str_replace("'", "",$this->input->post('City'));

			$State			=	str_replace("'", "",$this->input->post('State'));

			$Zipcode		=	str_replace("'", "",$this->input->post('Zipcode'));

			$Home_phone		=	str_replace("'", "",$this->input->post('Phone_Number_H'));

			$Cell_phone		=	str_replace("'", "",$this->input->post('Phone_Number_C'));

			$Email			=	str_replace("'", "",$this->input->post('Email'));

			$Password	  	=	str_replace("'", "",$this->input->post('password'));

			$Memo      		=   strip_tags(str_replace("'", "",$this->input->post('memo')));

		

			$config['upload_path']          = './article_upload/';

			$config['allowed_types']        = 'doc|docx|pdf';

			$fname = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["article"]["name"]);

			$config['file_name']            = time().'-'.$fname;



			$this->load->library('upload', $config);

			//pr($this->upload->data());exit;

			$file_path= '' ;

			if(isset($_FILES))

			{

				$ext       = pathinfo($_FILES["article"]["name"], PATHINFO_EXTENSION);

				$file_path = $this->upload->data('file_name');

				/*$file_size = $_FILES['article']['size'];

				$handle = fopen($file_path, "r");

			    $content = fread($handle, $file_size);

			    fclose($handle);

			    $encoded_content = chunk_split(base64_encode($content));*/

			    $this->upload->do_upload('article');

			}

			$num=$this->db->get_where('kr_users',array('Email_address'=>$Email,'admin_type'=>'Article'))->num_rows();

			if($num==0)

			{

				$this->db->query("INSERT INTO `kr_users`(`Email_address`, `Password`, `National_admin_id`, `State_admin_id`, `County_admin_id`, `Zonal_admin_id`,`admin_type`) VALUES ('$Email','$Password','','','','','Article')");

				$user_id = $this->db->insert_id();

				$this->db->query("UPDATE `kr_users` SET `login_id`='".sprintf("ART%05s",$user_id)."' WHERE id='$user_id'");



				$this->db->query("INSERT INTO `kr_distributers`(`First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `Home_phone`, `Cell_phone`, `Email_address`,`Volunteering`,`User_id`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$Home_phone','$Cell_phone','$Email','3','$user_id')");

				$dist_id = $this->db->insert_id();

				$this->db->query("UPDATE `kr_distributers` SET `disributer_id`='".sprintf("ART%05s",$user_id)."' WHERE id='$dist_id'");



				if($user_id!='')

				{

					//$user_id = $this->db->insert_id();

					$this->db->query("INSERT INTO `kr_article`(`memo`, `file_path`, `user_id`) VALUES ('$Memo','$file_path','$user_id')");

					

					$this->session->set_flashdata('alert','success');

					

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

					$this->email->bcc($smtp['notify_email']);

					$this->email->to(array($Email,'krusaarticles@gmail.com'));

					

					$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';

					$mailContent.='<tr style="color:#fff;background:#C7532E">';

					$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Reveletor USA" width="222" height="79"></td>';

					$mailContent.='<td width="90%" align="center">&nbsp;</td>';

					$mailContent.='</tr>';

					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';

					$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';

					$mailContent.='</tr>';

					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';

					$mailContent.='<td height="213" colspan="2" valign="top">';

					$mailContent.='<p>Hi '.$First_name.',<br></p>';

					$mailContent.='<p><bold> Memo </bold><br>'.$Memo.'</p>';

					$mailContent.='<p><br></p>';

					$mailContent.='</p>';	

					$mailContent.='<p><br>

					</p>

					</td>

					</tr>

					</table>';

					

					$this->email->subject('Article');

					$this->email->message($mailContent);

					$uppath = base_url().'article_upload/'.$file_path;

					$this->email->attach($uppath);

					$this->email->send();

					

					@$this->email->initialize($config);



					$this->email->from($smtp['from_email'], $smtp['from_name']);

					$this->email->bcc($smtp['notify_email']);

					$this->email->to($Email);

					$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';

					$mailContent.='<tr style="color:#fff;background:#C7532E">';

					$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Reveletor USA" width="222" height="79"></td>';

					$mailContent.='<td width="90%" align="center">&nbsp;</td>';

					$mailContent.='</tr>';

					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';

					$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';

					$mailContent.='</tr>';

					$mailContent.='<tr style="background:#FBE697;color:#C7532E">';

					$mailContent.='<td height="213" colspan="2" valign="top">';

					$mailContent.='<p>Hi '.$First_name.',<br></p>';

					$mailContent.='<p>You are successfully<bold> Registered as Article writer </bold><br></p>';

					$mailContent.='<p>You can update data using the below credentials <br>Username : '.$Email.'<br>Password: '.$Password.'<br></p>';

					$mailContent.='</p>';	

					$mailContent.='<p>Administrator,<br>

					Kingdom Revelator USA</p>

					</td>

					</tr>

					</table>';

					

					$this->email->subject('Message from Kingdom Revelator USA');

					$this->email->message($mailContent);

					$this->email->attach('');

					$this->email->send();

				}

			}

			else

			{

				$this->session->set_flashdata('alert','fails');

			}



		}

		

		 $data['content'] = 'volunteer/article';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

	

	public function intercession()

	{

		 $this->session->set_flashdata('alert', '');

		if($this->input->post())

		{

			

			$First_name		=	str_replace("'", "",$this->input->post('First_name'));

			$Last_name		=	str_replace("'", "",$this->input->post('Last_name'));

			$Address1		=	str_replace("'", "",$this->input->post('Address1'));

			$Address2		=	str_replace("'", "",$this->input->post('Address2'));

			$City			=	str_replace("'", "",$this->input->post('City'));

			$State			=	str_replace("'", "",$this->input->post('State'));

			$Zipcode		=	str_replace("'", "",$this->input->post('Zipcode'));

			$Home_phone		=	str_replace("'", "",$this->input->post('Phone_Number_H'));

			$Cell_phone		=	str_replace("'", "",$this->input->post('Phone_Number_C'));

			$Email			=	str_replace("'", "",$this->input->post('Email'));

			$created 		=   date('Y-m-d H:i:s');

			$Password	  	=	str_replace("'", "",$this->input->post('password'));

			$Volunteering 	=	'1';//@implode(",",$this->input->post('Volunteering'));

			

			$days=$this->input->post('day');

			$hours=$this->input->post('hour');

			$mins=$this->input->post('min');			

			$Exist_user		=   $this->db->query("SELECT id FROM kr_users WHERE `Email_address`='$Email' and admin_type='Intercession'");

			if($Exist_user->num_rows()>0)

			{ 

				$this->session->set_flashdata('alert','fails');



			}

			else

			{

				$this->db->query("INSERT INTO `kr_users`(`Email_address`, `Password`, `National_admin_id`, `State_admin_id`, `County_admin_id`, `Zonal_admin_id`,`admin_type`) VALUES ('$Email','$Password','','','','','Intercession')");

				$user_id = $this->db->insert_id();

				$this->db->query("UPDATE `kr_users` SET `login_id`='".sprintf("INT%05s",$user_id)."' WHERE id='$user_id'");

				$this->db->query("INSERT INTO `kr_distributers`(`First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `Home_phone`, `Cell_phone`, `Email_address`,`Volunteering`,`User_id`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$Home_phone','$Cell_phone','$Email','$Volunteering','$user_id')");

				

				$dist_id = $this->db->insert_id();

				$this->db->query("UPDATE `kr_distributers` SET `disributer_id`='".sprintf("INT%05s",$user_id)."' WHERE id='$dist_id'");

				if($user_id!='')

				{

					if(!empty($days))

					{

						$timings=array();

						$days=array_unique($days);

						foreach($days as $k=>$day)

						{

							if($day !="" && $hours[$k] !="")

							{

								$time=$hours[$k]*60;

								if($mins[$k] !="")

								$time +=$mins[$k];

								$timings[]=array('user_id'=>$user_id,'day'=>$day,'tim'=>$time);

							}

						}

						if(!empty($timings))

						$this->db->insert_batch('kr_vol_times',$timings);						

					}

					

					$this->session->set_flashdata('alert','success');

					

				}



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

				$this->email->bcc($smtp['notify_email']);

				$this->email->to($Email);

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

				$mailContent.='<p>Hi '.$First_name.',<br></p>';

				$mailContent.='<p>You are successfully<bold> Registered as Intercession </bold><br></p>';

				$mailContent.='<p>You can update data using the below credentials <br>Username : '.$Email.'<br>Password: '.$Password.'<br></p>';

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

		}

		

		$data['content'] = 'volunteer/intercession';

		$data['menu']='';

		$this->load->view('template',$data );

	}

	

	public function before_write()

	{

		$data['content'] = 'volunteer/before_write';

		$data['menu']='';

		$this->load->view('template',$data );

	}



	public function distributer_mail($First_name,$Email,$item_name,$amount,$optionspayment,$item_copy,$Password)

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

		$this->email->bcc($smtp['notify_email']);

		$this->email->to($Email);

		$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';

		$mailContent.='<tr style="color:#fff;background:#C7532E">';

		$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Sehion USA" width="222" height="79"></td>';

		$mailContent.='<td width="90%" align="center">&nbsp;</td>';

		$mailContent.='</tr>';

		$mailContent.='<tr style="background:#FBE697;color:#C7532E">';

		$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';

		$mailContent.='</tr>';

		$mailContent.='<tr style="background:#FBE697;color:#C7532E">';

		$mailContent.='<td height="213" colspan="2" valign="top">';

		$mailContent.='<p>Hi '.$First_name.',<br></p>';

		$mailContent.='<p>You are successfully<bold> Registered </bold>. Your payment status is <bold> Pending </bold><br>Duration : '.$item_name.'<br>Amount: $'.$amount.'<br>Method of payment: '.$optionspayment.'<br>Number of copies: '.$item_copy .'</p>';

		$mailContent.='<p>You can update your payment and data using the below credentials <br>Username : '.$Email.'<br>Password: '.$Password.'<br></p>';

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

}


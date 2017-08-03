<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Subscription extends CI_Controller {



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

		$this->load->model('Subscriber_model');

		 $this->session->set_flashdata('alert', '');

		if($this->input->post())

		{

			//pr($this->input->post());exit;

			

			$First_name			 =	str_replace("'", "",$this->input->post('First_name'));

			$Last_name		 	 =	str_replace("'", "",$this->input->post('Last_name'));

			$Address1			 =	str_replace("'", "",$this->input->post('Address1'));

			$Address2			 =	str_replace("'", "",$this->input->post('Address2'));

			$City				 =	str_replace("'", "",$this->input->post('City'));

			$State				 =	str_replace("'", "",$this->input->post('State'));

			$Zipcode			 =	str_replace("'", "",$this->input->post('Zipcode'));

			$BAddress1			 =	str_replace("'", "",$this->input->post('BAddress1'));

			$BAddress2			 =	str_replace("'", "",$this->input->post('BAddress2'));

			$BCity				 =	str_replace("'", "",$this->input->post('BCity'));

			$BState				 =	str_replace("'", "",$this->input->post('BState'));

			$BZipcode			 =	str_replace("'", "",$this->input->post('BZipcode'));

			$Home_phone			 =	str_replace("'", "",$this->input->post('Home_phone'));

			$Cell_phone			 =	str_replace("'", "",$this->input->post('Cell_phone'));

			$Email				 =	str_replace("'", "",$this->input->post('Email'));

			$Password			 =	str_replace("'", "",$this->input->post('Password'));

			$Church_name		 =	str_replace("'", "",$this->input->post('Church_name'));

			

			$optionspayment      =  str_replace("'", "",$this->input->post('optionspayment'));

			$enter_by            =  str_replace("'", "",$this->input->post('Enter_by'));

			

			$no_month   		 =  str_replace("'", "",$this->input->post('Request_month'));



			$gift   		 =   str_replace("'", "",$this->input->post('gift'));

			$agent_name			 = '';

			$cash_comments		 = '';

			$price           = $this->db->query("SELECT * FROM  kr_book_price")->row_array();



            if($no_month == '')

            	$no_month = 12;



			if($no_month == '12')

				$tot_amnt = $price['1_yr_price'];

			if($no_month == '24')

				$tot_amnt = $price['2_yr_price'];



			$created_date 	   = date('Y-m-d H:i:s');		

			$data['subscription_date'] = date('Y-m-d', strtotime('first day of next month'));

			$data['subscription_length'] = str_replace("'", "",$no_month);

			$no_month                    = $data["subscription_length"];

			$t                           = strtotime($data['subscription_date']);

			$data['expiry_date']         = date('Y-m-d',strtotime('+'.$no_month.' month', $t));

			$data['No_of_copies']        = str_replace("'", "",$this->input->post('Copies_requested'));  



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



			// for paypal cart showing

			$item_name= $data['subscription_length'].' Month subscription, 1 Copy';

			

			

			

			$Exist_user		=   $this->db->query("SELECT * FROM kr_subscribers WHERE `Email_address`='$Email'");

			if($Exist_user->num_rows()>0)

			{ 

			 $this->session->set_flashdata('alert', 'fails');

			}

			else

			{
					if($optionspayment=='Cash' || $optionspayment=='Cheque')

					{

						$this->db->query("INSERT INTO `kr_subscribers`(`First_name`,`Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`,`BillingState`,`BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`,`Password` ,`Church_name`,`Enter_by`,`updated_date`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$BAddress1','$BAddress2','$BCity','$BState','$BZipcode','$Home_phone','$Cell_phone','$Email','$Password','$Church_name','$enter_by','$created_date')");

						if($this->db->insert_id())

						{

							$this->session->set_flashdata('alert', 'success');

							$user_id=$this->db->insert_id();

							$this->db->query("UPDATE `kr_subscribers` SET Subscriber_id='".sprintf("SUB%010s",$user_id)."' WHERE id='$user_id'");

		                    

		                     // add to gift subscriber table

							if($gift != '') {



							$this->db->query("INSERT INTO `kr_gift_subscribers`(`Subscriber_id`,`First_name`,`Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`,`BillingState`,`BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`,`Church_name`,`Enter_by`) VALUES ('".sprintf("SUB%010s",$user_id)."','$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$BAddress1','$BAddress2','$BCity','$BState','$BZipcode','$Home_phone','$Cell_phone','$Email','$Church_name','$enter_by')");

						    }

							

							if($user_id>0 && $optionspayment!='online')

							{

									$data['Subscriber_id']      = $user_id;

									$data['comments']      = $cash_comments;

									$data['Cash_Check_by'] = $agent_name;



									//pr($data);exit;

																		

									$order_id              = $this->Subscriber_model->order_add($data);

									$this->db->query("INSERT INTO `kr_payment`(`Subscriber_id`,`order_id`,`Mode_of_pay`, `paypal_status`, `paid_amnt`) VALUES ('".$user_id."','$order_id','".strtolower($optionspayment)."','pending','$tot_amnt')");







									

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

									$this->email->to($Email);

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

									$mailContent.='<p>Hi '.$First_name.',<br></p>';

									$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$data['subscription_length'].'<br>Number of copies : '.$data['No_of_copies'].'<br>Amount : $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</p>';

									$mailContent.='<p>You can update data using the below credentials <br>Username : '.$Email.'<br>Password : '.$Password.'<br></p>';

									$mailContent.='</p>';	

									$mailContent.='<p>Administrator,<br>

								  Kingdom Revelator USA</p>

								</td>

							  </tr>

							</table>';

							

								$this->email->subject('Message from Kingdom Revelator USA');

								$this->email->message($mailContent);

								$this->email->send();



								$this->session->set_flashdata('payment','success');

								redirect('subscription/form','refresh');

								

							}

						}

					}

					if($optionspayment=='online')

					{



						$this->db->query("INSERT INTO `kr_subscribers`(`First_name`,`Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`,`BillingState`,`BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`,`Password` ,`Church_name`,`Enter_by`,`updated_date`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$BAddress1','$BAddress2','$BCity','$BState','$BZipcode','$Home_phone','$Cell_phone','$Email','$Password','$Church_name','$enter_by','$created_date')");

						$user_id=$this->db->insert_id();

					    $this->db->query("UPDATE `kr_subscribers` SET Subscriber_id='".sprintf("SUB%010s",$user_id)."' WHERE id='$user_id'");

                        

                        if($gift != '') {



							$this->db->query("INSERT INTO `kr_gift_subscribers`(`Subscriber_id`,`First_name`,`Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`,`BillingState`,`BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`,`Church_name`,`Enter_by`) VALUES ('".sprintf("SUB%010s",$user_id)."','$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$BAddress1','$BAddress2','$BCity','$BState','$BZipcode','$Home_phone','$Cell_phone','$Email','$Church_name','$enter_by')");

						    }







						if($user_id)

						{



							$this->session->set_flashdata('alert', 'success');

							

	                            $data['Subscriber_id']       = $user_id;

								

								

								//pr($data);exit;

								$order_id                   = $this->Subscriber_model->order_add($data);

								$this->db->query("INSERT INTO `kr_payment`(`Subscriber_id`,`order_id`,`Mode_of_pay`, `paypal_status`, `paid_amnt`) VALUES ('".$user_id."','$order_id','".strtolower($optionspayment)."','pending','$tot_amnt')");



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

								$this->paypal_lib->add_field('custom', $user_id.'#'.$paymentid);

								$this->paypal_lib->add_field('item_number_1', $data['No_of_copies']);							

								$this->paypal_lib->add_field('amount_1',$tot_amnt);  

								

								/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

								$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

								

								$this->paypal_lib->paypal_auto_form();

								if($user_id>0)

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

									$this->email->to($Email);

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

									$mailContent.='<p>Hi '.$First_name.',<br></p>';

									$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$data['subscription_length'].'<br>Number of copies : '.$data['No_of_copies'].'<br>Amount: $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</p>';

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

								exit;							

					}

					

				     }

			}

		}



		$data['content'] = 'subscription/form';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

	

	public function news_letter()

	{

		if($this->input->post())

		{

			$duplicate = $this->db->get_where('kr_news_letter',array('Email'=>$this->input->post('Email')))->num_rows();

			if($duplicate==0)

			{

			 $this->db->insert('kr_news_letter',array('Email'=>$this->input->post('Email')));

			 $this->session->set_flashdata('alert','success');

			}

		}

		

		$data['content'] = 'welcome/index';

		$data['menu']='';

		$this->load->view('template',$data );

	}

	

	public function gift()

	{

		 $this->session->set_flashdata('alert', '');

		if($this->input->post())

		{

			

			$First_name			 =	str_replace("'", "",$this->input->post('First_name'));

			$Last_name		 	 =	str_replace("'", "",$this->input->post('Last_name'));

			$Address1			 =	str_replace("'", "",$this->input->post('Address1'));

			$Address2			 =	str_replace("'", "",$this->input->post('Address2'));

			$City				 =	str_replace("'", "",$this->input->post('City'));

			$State				 =	str_replace("'", "",$this->input->post('State'));

			$Zipcode			 =	str_replace("'", "",$this->input->post('Zipcode'));

			$BAddress1			 =	str_replace("'", "",$this->input->post('BAddress1'));

			$BAddress2			 =	str_replace("'", "",$this->input->post('BAddress2'));

			$BCity				 =	str_replace("'", "",$this->input->post('BCity'));

			$BState				 =	str_replace("'", "",$this->input->post('BState'));

			$BZipcode			 =	str_replace("'", "",$this->input->post('BZipcode'));

			$Home_phone			 =	str_replace("'", "",$this->input->post('Home_phone'));

			$Cell_phone			 =	str_replace("'", "",$this->input->post('Cell_phone'));

			$Email				 =	str_replace("'", "",$this->input->post('Email'));

			$Password			 =	str_replace("'", "",$this->input->post('Password'));

			$Church_name		 =	str_replace("'", "",$this->input->post('Church_name'));

			$optionssubscription =  $this->input->post('optionssubscription');

			$optionspayment      =  $this->input->post('optionspayment');

			$enter_by            =  str_replace("'", "",$this->input->post('Enter_by'));

			$copies				 =  $this->input->post('copies');

			$tot_amnt   		 =  $this->input->post('amount');

			$agent_name			 = '';

			$cash_comments		 = '';

			$price               = $this->db->query("SELECT * FROM kr_book_price ")->row_array();



			

			$created_date 	   = date('Y-m-d H:i:s');

			$subscription_date = date('Y-m-d',strtotime('+1 month',strtotime($created_date)));

			if($optionssubscription==$price['1_yr_price'])

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d H:i:s',strtotime('+1 years', $t));

				 $subscription_length = "1-year";

				//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));

			}

			if($optionssubscription==$price['2_yr_price'])

			{

				 $dateString = $subscription_date;

				 $t = strtotime($dateString);

				 $expiry_date = date('Y-m-d H:i:s',strtotime('+2 years', $t));

				 $subscription_length = "2-year";

				//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));

			}

			

			if($optionspayment=='Cash')

			{

				$agent_name    = $this->input->post('cash_agent_name');

				$cash_comments = $this->input->post('cash_comments');

			}

			if($optionspayment=='Cheque')

			{

				$agent_name    = $this->input->post('cheque_agent_name');

				$cash_comments = $this->input->post('cheque_comments');

			}

			

			$Exist_user		=   $this->db->query("SELECT * FROM kr_gift_subscribers WHERE `Email_address`='$Email'");

			if($Exist_user->num_rows()>0)

			{ 

			 $this->session->set_flashdata('alert', 'fails');

			}

			else

			{

				$this->db->query("INSERT INTO `kr_gift_subscribers`(`First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`,`BillingState`,`BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`,`Password` ,`Church_name`, `Subscriptions`,`No_of_copies`,`Total_amount`, `Mode_of_payment`,`Cash_Check_by`,`comments`,`subscription_date`,`expiry_date`,`Enter_by`,`updated_date`,`subscription_length`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$BAddress1','$BAddress2','$BCity','$BState','$BZipcode','$Home_phone','$Cell_phone','$Email','$Password','$Church_name','$optionssubscription','$copies','$tot_amnt','$optionspayment','$agent_name','$cash_comments','$subscription_date','$expiry_date','$enter_by','$created_date','$subscription_length')");

				$user_giftid=$this->db->insert_id();

				$this->db->query("INSERT INTO `kr_subscribers`(`First_name`, `Last_name`, `Mailing_address1`, `Mailing_address2`, `City`,`State`,`Zipcode`, `BillingAddress1`, `BillingAddress2`, `BillingCity`,`BillingState`,`BillingZip`, `Home_phone`, `Cell_phone`, `Email_address`,`Password` ,`Church_name`, `Subscriptions`,`No_of_copies`,`Total_amount`, `Mode_of_payment`,`Cash_Check_by`,`comments`,`subscription_date`,`expiry_date`,`Enter_by`,`updated_date`,`subscription_length`) VALUES ('$First_name','$Last_name','$Address1','$Address2','$City','$State','$Zipcode','$BAddress1','$BAddress2','$BCity','$BState','$BZipcode','$Home_phone','$Cell_phone','$Email','$Password','$Church_name','$optionssubscription','$copies','$tot_amnt','$optionspayment','$agent_name','$cash_comments','$subscription_date','$expiry_date','$enter_by','$created_date','$subscription_length')");

				if($this->db->insert_id())

				{

					$this->session->set_flashdata('alert', 'success');

					$user_id=$this->db->insert_id();

					$this->db->query("UPDATE `kr_gift_subscribers` SET Subscriber_id='".sprintf("SUB%010s",$user_id)."' WHERE id='$user_giftid'");

					$this->db->query("UPDATE `kr_subscribers` SET Subscriber_id='".sprintf("SUB%010s",$user_id)."' WHERE id='$user_id'");



					if($optionssubscription==$price['1_yr_price'])

					{

						$item_name='1 Year subscription';

					}

					if($optionssubscription==$price['2_yr_price'])

					{

						$item_name='2 Year subscription';

					}

					if($user_id>0 && $optionspayment!='online')

					{

					    $this->db->query("INSERT INTO `kr_payment`(`Subscriber_id`, `Mode_of_pay`, `paypal_status`, `paid_amnt`, `txn_id`,`payer_email`) VALUES ('$user_id','".strtolower($optionspayment)."','pending','','','')");



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

						$this->email->to($Email);

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

						$mailContent.='<p>Hi '.$First_name.',<br></p>';

						$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$item_name.'<br>Amount: $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</p>';

						$mailContent.='<p>You can update data using the below credentials <br>Username : '.$Email.'<br>Password: $'.$Password.'<br></p>';

						$mailContent.='</p>';	

						$mailContent.='<p>Administrator,<br>

					 Kingdom Revelator USA</p>

					</td>

				  </tr>

				</table>';	

						

						$this->email->subject('Message from Kingdom Revelator USA');

						$this->email->message($mailContent);

						$this->email->send();

						/*$headers  = '';

						$to       = $Email;

						$subject  = 'info';

						//$txt 	  = '<html><head></head><body>You are successfully<bold> Subacribed </bold><br>Duration : '.$item_name.'<br>Amount: $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</body></html>';

						$headers .= "MIME-Version: 1.0" . "\r\n";

						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	

						$headers .= 'From: <jithin@ksofttechnologies.com>' . "\r\n";

						mail($to,$subject,$txt,$headers);*/

					}

					

					if($optionspayment=='online')

					{

						 $this->db->query("INSERT INTO `kr_payment`(`Subscriber_id`, `Mode_of_pay`, `paypal_status`, `paid_amnt`, `txn_id`,`payer_email`) VALUES ('$user_id','".strtolower($optionspayment)."','pending','','','')");



						if($optionssubscription==$price['1_yr_price'])

						{

							$item_name='1 Year subscription';

						}

						if($optionssubscription==$price['2_yr_price'])

						{

							$item_name='2 Year subscription';

						}

						

						$this->load->library('paypal_lib');

							//Set variables for paypal form

							$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; //test PayPal api url

							//$paypalID = 'jithin@ksofttechnologies.com'; //business email

							$paypalID = 'krusasubp@gmail.com'; //business email

							$returnURL = base_url().'paypal/success'; //payment success url

							$cancelURL = base_url().'paypal/cancel/'; //payment cancel url

							$notifyURL = base_url().'paypal/ipn'; //ipn url

							$user_id   = 'g'.$user_id;

							$this->paypal_lib->add_field('cmd','_cart');

							$this->paypal_lib->add_field('upload','1');

							$this->paypal_lib->add_field('business', $paypalID);

							$this->paypal_lib->add_field('return', $returnURL);

							$this->paypal_lib->add_field('cancel_return', $cancelURL);

							$this->paypal_lib->add_field('notify_url', $notifyURL);

							$this->paypal_lib->add_field('item_name_1', $item_name);

							$this->paypal_lib->add_field('custom', $user_id);

							$this->paypal_lib->add_field('item_number_1', '1');							

							$this->paypal_lib->add_field('amount_1',$tot_amnt);  

							

							/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

							$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

							

							$this->paypal_lib->paypal_auto_form();

							if($user_id>0)

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

								$this->email->to($Email);

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

								$mailContent.='<p>Hi '.$First_name.',<br></p>';

								$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$item_name.'<br>Amount: $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</p>';

								$mailContent.='<p>You can update data using the below credentials <br>Username : '.$Email.'<br>Password: $'.$Password.'<br></p>';

								$mailContent.='</p>';	

								$mailContent.='<p>Administrator,<br>

							 Kingdom Revelator USA</p>

							</td>

						  </tr>

						</table>';	

								

								$this->email->subject('Message from Kingdom Revelator USA');

								$this->email->message($mailContent);

								$this->email->send();

								/*$headers  ='';

								$to       = $Email;

								$subject  = 'info';

								$txt 	  = '<html><head></head><body>You are successfully<bold> Subscribed </bold><br>Duration : '.$item_name.'<br>Amount: $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</body></html>';

								$headers .= "MIME-Version: 1.0" . "\r\n";

								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			

								$headers .= 'From: <jithin@ksofttechnologies.com>' . "\r\n";

								mail($to,$subject,$txt,$headers);*/

							}

							exit;							

					}

					

				}

			}

		}


		$data['content'] = 'subscription/gift';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}



	public function cancel()

	{

		$data['content'] = 'subscription/cancel';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}



	public function complete_payment()

	{

		$id   = $this->session->userdata('id');



		$dist = $this->db->query("select * from kr_subscribers where id='$id'")->row_array();

        $item_copy     = "1 copy";

        $item_name     = $dist['subscription_length'];

		if($this->input->post())

		{

			

			$amount  	  	 =	$this->input->post('amount');

			$optionspayment  =  $this->input->post('optionspayment');

			$agent_name    = '';

			$cash_comments = '';

			$created	       = date('Y-m-d H:i:s');

			$subscription_date = date('Y-m-d',strtotime('+1 month',strtotime($created)));

			$detail = $this->db->get_where('kr_subscribers',array('id'=>$id))->row_array();

			

			if($optionspayment=='Cash')

			{

				$agent_name    = $this->input->post('cash_agent_name');

				$cash_comments = $this->input->post('cash_comments');

			}

			if($optionspayment=='Cheque')

			{

				$agent_name    = $this->input->post('cheque_agent_name');

				$cash_comments = $this->input->post('cheque_comments');

			}		



				if($optionspayment=='online')

				{

					$num_rows1=$this->db->query("UPDATE `kr_subscribers` SET `Mode_of_payment`='$optionspayment',Cash_Check_by='$agent_name',comments='$cash_comments' WHERE `id`='".$id."' ");

					$this->session->set_flashdata('alert','success');

					$this->load->library('paypal_lib');

					//Set variables for paypal form

					$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; //test PayPal api url

					//$paypalID = 'jithin@ksofttechnologies.com'; //business email

					$paypalID = 'krusasubp@gmail.com'; //business email

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

					$this->paypal_lib->add_field('custom', $id);

					$this->paypal_lib->add_field('item_number_1', $item_copy);							

					$this->paypal_lib->add_field('amount_1',$amount);  

					

					/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

					$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

					

					$this->paypal_lib->paypal_auto_form();



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

					$this->email->to(@$detail['Email_address']);

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

					$mailContent.='<p>Hi '.$detail['First_name'].',<br></p>';

					$mailContent.='<p>You are <bold> Paid </bold> successfully.<br>Duration : '.$item_name.'<br>Amount: $'.$amount.'<br>Mode of payment: '.$optionspayment.'</p>';

					$mailContent.='</p>';	

					$mailContent.='<p>Administrator,<br>

					Kingdom Revelator USA</p>

					</td>

					</tr>

					</table>';

					

					$this->email->subject('Message from Kingdom Revelator USA');

					$this->email->message($mailContent);

					$this->email->send();



					exit;

				}

				else

				{

					$num_rows=$this->db->query("UPDATE `kr_payment` SET `Mode_of_pay`='$optionspayment', `paypal_status`='pending', `paid_amnt`='".$amount."', `txn_id`='',`payer_email`='',`date_of_pay`='".date('Y-m-d')."' WHERE `Subscriber_id`='".$id."' ");

					

					

				}

				

					$num_rows1=$this->db->query("UPDATE `kr_subscribers` SET `Mode_of_payment`='$optionspayment',Cash_Check_by='$agent_name',comments='$cash_comments' WHERE `id`='".$id."' ");

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

					$this->email->to($detail['Email_address']);

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

					$mailContent.='<p>Hi '.$detail['First_name'].',<br></p>';

					$mailContent.='<p>You are <bold> Paid </bold> successfully.<br>Duration : '.$item_name.'<br>Amount: $'.$amount.'<br>Mode of payment: '.$optionspayment.'</p>';

					$mailContent.='</p>';	

					$mailContent.='<p>Administrator,<br>

					Kingdom Revelator USA</p>

					</td>

					</tr>

					</table>';

					

					$this->email->subject('Message from Kingdom Revelator USA');

					$this->email->message($mailContent);

					$this->email->send();

                    

                    $this->session->set_flashdata('renew', 'success');

					redirect('Subscriber_profile/profile');

				

		}

		 $this->session->set_flashdata('alert', '');

		

		 $type = $this->session->userdata('role');

		 $data['amount'] = $this->db->query("select * from kr_subscribers where id='".$id."'")->row_array();

 

		 $data['title'] = 'Subscriber';

         $data['menu']  = 'distributer';

         $data['content'] = 'backend/subscriber_profile/payment';

         $this->load->view( 'backend/template', $data );

	}

}






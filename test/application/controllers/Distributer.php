<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Distributer extends CI_Controller {



	function __construct() {

     parent::__construct(); 

	  

	   $this->session->set_flashdata('alert', '');

	    if ( $this->session->userdata('role') == '')

     {

            redirect( '', 'refresh' );

           }

           $this->load->model('Distributer_model');

	}

	public function index()

	{

		 $this->session->set_flashdata('alert', '');

		 $id   = $this->session->userdata('id');

		 if($this->session->userdata('role')== 'Intercession')

		 {

			 $data['row']=$this->db->query("select * from kr_distributers where User_id='$id'")->row_array();

			 $data['title'] = 'Intercession';

			 $data['menu']  = 'distributer';

			 $data['content'] = 'backend/distributer/home';

			 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $data['row']=$this->db->query("select * from kr_distributers where User_id='$id'")->row_array();

			 $data['title'] = 'Distributer';

			 $data['menu']  = 'distributer';

			 $data['content'] = 'backend/distributer/home';

			 $this->load->view( 'backend/template', $data );



		 }

		 

	}

	public function subscribers_list()

	{

		 $this->session->set_flashdata('alert', '');

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['subscriber'] = $this->common->subscribers_list($id,$type); 

		 $data['title'] = 'Distributer';

         $data['menu']  = 'distributer';

         $data['content'] = 'backend/distributer/subscribers_list';

         $this->load->view( 'backend/template', $data );

	}



	

	public function complete_payment()

	{

		$id   = $this->session->userdata('id');



		$dist = $this->db->query("select * from kr_distributers where User_id='$id'")->row_array();

        $item_copy     = $dist['Copies_requested']." copies";

        $item_name     = $dist['Subscriptions'].' Month subscription';

		if($this->input->post())

		{

			

			$amount  	  	 =	$this->input->post('amount');

			$optionspayment  =  $this->input->post('optionspayment');

			$agent_name    = '';

			$cash_comments = '';

			$created	       = date('Y-m-d H:i:s');

			$subscription_date = date('Y-m-d',strtotime('+1 month',strtotime($created)));

			

			

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

					$num_rows1=$this->db->query("UPDATE `kr_distributers` SET `Mode_of_payment`='$optionspayment',Cash_Check_by='$agent_name',comments='$cash_comments' WHERE `disributer_id`='".sprintf("DIS%05s",$id)."' ");



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

					$this->paypal_lib->add_field('custom', sprintf("DIS%05s",$id));

					$this->paypal_lib->add_field('item_number_1', $item_copy);							

					$this->paypal_lib->add_field('amount_1',$amount);  

					

					/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

					$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

					

					$this->paypal_lib->paypal_auto_form();

					exit;

				}

				else

				{

					$num_rows=$this->db->query("UPDATE `kr_dis_payment` SET `Mode_of_pay`='$optionspayment', `paypal_status`='pending', `paid_amnt`='".$amount."', `txn_id`='',`payer_email`='',`date_of_pay`='".date('Y-m-d')."' WHERE `Subscriber_id`='".sprintf("DIS%05s",$id)."' ");

					

				}

				

					$num_rows1=$this->db->query("UPDATE `kr_distributers` SET `Mode_of_payment`='$optionspayment',Cash_Check_by='$agent_name',comments='$cash_comments' WHERE `disributer_id`='".sprintf("DIS%05s",$id)."' ");



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

					$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$item_name.'<br>Amount: $'.$amount.'<br>Mode of payment: '.$optionspayment.'</p>';

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

					redirect('distributer');

				

		}

		 $this->session->set_flashdata('alert', '');

		

		 $type = $this->session->userdata('role');

		 $data['amount'] = $this->db->query("select * from kr_dis_payment where Subscriber_id='".sprintf("DIS%05s",$id)."' order by id desc")->row_array();

 

		 $data['title'] = 'Distributer';

         $data['menu']  = 'distributer';

         $data['content'] = 'backend/distributer/payment';

         $this->load->view( 'backend/template', $data );

	}

	

	public function renew()

	{

		 $id1   = $this->session->userdata('id');

		 $row1  = $this->db->get_where('kr_users',array('id'=>$id1))->row_array();

		 $row   = $this->db->get_where('kr_distributers',array('disributer_id'=>$row1['login_id']))->row_array();

		 $id    = $row['id'];



		if($this->input->post())

		{

			$copies              =	$this->input->post('Copies_requested');

			$optionssubscription =  $this->input->post('Request_month');

			$optionspayment      =  $this->input->post('optionspayment');

			$tot_amnt   		 =  $this->input->post('amount');

			$Email				 =	$this->input->post('Email');

			$agent_name			 = '';

			$cash_comments		 = '';

			$price               = $this->db->query("SELECT * FROM kr_discount")->row_array();

			$Exist_user		     = $this->db->query("SELECT * FROM kr_distributers WHERE `Email_address`='$Email'");

			if($Exist_user->num_rows()>0)

			{ 

			    $result         =  $Exist_user->row_array();

				$current_expiry = $result['expiry_date'];

			}

			

			$subscription_date 	 = date('Y-m-d H:i:s');

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

				$subscription_length = '1-year';

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

			

			$Exist_user		=   $this->db->query("SELECT * FROM kr_distributers WHERE `Email_address`='$Email'");

			if($Exist_user->num_rows()>0)

			{ 

			    

				$this->db->query("UPDATE `kr_distributers` SET expiry_date='$expiry_date',updated_date='$subscription_date',Subscriptions='$optionssubscription',`Copies_requested`='$copies',`Total_amount`='$tot_amnt' where id='$id' ");

				$this->db->query("INSERT INTO `kr_dis_payment`(`Subscriber_id`, `Mode_of_pay`, `paypal_status`, `paid_amnt`, `txn_id`,`payer_email`) VALUES ('".sprintf("DIS%05s",$id1)."','".strtolower($optionspayment)."','pending','$tot_amnt','','')");





				if($this->db->affected_rows()>0)

				{

					$this->session->set_flashdata('alert', 'success');

					//$user_id=$this->db->insert_id();

					

				

					if($optionspayment!='online')

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

						$mailContent.='<p>Hi '.$row['First_name'].',<br></p>';

						$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$item_name.'<br>Amount : $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</p>';

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

					}

					

					if($optionspayment=='online')

					{

						

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

							$this->paypal_lib->add_field('custom', $id);

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

								$mailContent.='<p>Hi '.$row['First_name'].',<br></p>';

								$mailContent.='<p>You are successfully<bold> Subscribed </bold><br>Duration : '.$item_name.'<br>Amount : $'.$tot_amnt.'<br>Mode of payment: '.$optionspayment.'</p>';

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

							}

							exit;							

					}

					

				}

			}

		}

		 $data['row']     = $this->db->query("select * from kr_distributers where id='$id'")->row_array();

         $data['title']   = 'Distributer';

         $data['menu']    = 'distributer';

         $data['content'] = 'backend/distributer/renew_subscription';

         $this->load->view( 'backend/template', $data );

	}



	public function profile()

	{

		 $this->session->set_flashdata('alert', '');

		$id=$this->session->userdata('id');

		$type=  $this->session->userdata('role');

		if($this->input->post())

		{

			

			$First_name		=	$this->input->post('First_name');

			$Last_name		=	$this->input->post('Last_name');

			$Address1		=	$this->input->post('Address1');

			$Address2		=	$this->input->post('Address2');

			$City			=	$this->input->post('City');

			$State			=	$this->input->post('State');

			$Zipcode		=	$this->input->post('Zipcode');

			$Home_phone		=	$this->input->post('Phone_Number_H');

			$Cell_phone		=	$this->input->post('Phone_Number_C');

			$Email			=	$this->input->post('Email');

			$Password	  	=	$this->input->post('password');

			$user_id  		=   $this->input->post('user_id');

			$dist_id		=	$this->input->post('dist_id');

			

			$days=$this->input->post('day');

			$hours=$this->input->post('hour');

			$mins=$this->input->post('min');

			$Exist_user		=   $this->db->query("SELECT id FROM kr_users WHERE `Email_address`='$Email' and admin_type='$type' and id !=$id");

			if($Exist_user->num_rows()>0)

			{ 

				$this->session->set_flashdata('alert','already');

			}

			else

			{

				$this->db->update('kr_users',array('Email_address'=>$Email,'Password'=>$Password),array('id'=>$id));

				$this->db->update('kr_distributers',array('First_name'=>$First_name,'Last_name'=>$Last_name,'Mailing_address1'=>$Address1,'Mailing_address2'=>$Address2,'City'=>$City,'State'=>$State,'Zipcode'=>$Zipcode,'Home_phone'=>$Home_phone,'Cell_phone'=>$Cell_phone,'Email_address'=>$Email),array('id'=>$dist_id));

				

					if(!empty($days))

					{

						$this->db->delete('kr_vol_times',array('user_id'=>$id));

						$timings=array();

						$days=array_unique($days);

						foreach($days as $k=>$day)

						{

							if($day !="" && $hours[$k] !="")

							{

								$time=$hours[$k]*60;

								if($mins[$k] !="")

								$time +=$mins[$k];

								$timings[]=array('user_id'=>$id,'day'=>$day,'tim'=>$time);

							}

						}

						if(!empty($timings))

						$this->db->insert_batch('kr_vol_times',$timings);						

					}

					

					$this->session->set_flashdata('alert','updated');		

					$this->common->mail_send_profile_update($Email,$type,$Password);		

			}

			

			redirect('distributer/profile/'.$user_id);

			

		}

		 $dist_id = $this->uri->segment('3');

		// echo "select d.*,u.Password from kr_users u inner join kr_distributers d on(u.Distributer_id=d.id) where u.id=$dist_id and(u.National_admin_id='$id' or u.Zonal_admin_id='$id' or u.State_admin_id='$id' or u.State_zone_admin_id='$id')";

		 $data['row']=$this->db->query("select d.*,u.Password from kr_users u inner join kr_distributers d on(u.id=d.User_id) where d.User_id=$id")->row_array();

		 //$data['row']=$this->db->query("select d.*,u.Password from kr_users u inner join kr_distributers d on(u.Distributer_id=d.id) where  u.id=$dist_id and(u.National_admin_id='$id' or u.Zonal_admin_id='$id' or u.State_admin_id='$id' or u.State_zone_admin_id='$id')")->row_array();

		 if($this->db->query("select count(id) cnt from kr_vol_times where user_id=$id")->row()->cnt > 0)

		 $data['times']= $this->db->query("select * from kr_vol_times where user_id=$id")->result_array();

		 if($this->session->userdata('role')== 'Intercession')

		 {

			 $data['title'] = 'Intercession';

			 $data['menu']  = 'distributer';

			 $data['content'] = 'backend/distributer/profile';

			 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $data['title'] = 'Distributer';

			 $data['menu']  = 'distributer';

			 $data['content'] = 'backend/distributer/profile';

			 $this->load->view( 'backend/template', $data );

		 }

	}



	 // view previous orders

    public function orders()

	{

		if($this->session->userdata('role') !='Distributer')

			redirect('','refresh');

		          



         $data['orders'] = $this->Distributer_model->orders_get(sprintf("DIS%05s",$this->session->userdata('id')));

		 $data['title'] = 'Distributer';

         $data['menu']  = 'distributer';

         $data['content'] = 'backend/distributer/orders';

         $this->load->view( 'backend/template', $data );

	}





	 // to place a new order

    public function new_orders()

	{

		if($this->session->userdata('role') !='Distributer')

			redirect('','refresh');

		//echo date('Y-m-d H:i:s');

		 $this->load->library('paymentcalc');

		  

		 if($this->input->post('pbutton'))

		 {



                         

             $this->form_validation->set_rules('Copies_requested', 'Copies Requested', 'trim|xss_clean|required|is_natural|callback_mincopy_check');

             $this->form_validation->set_rules('Request_month', 'Number of Month','trim|xss_clean|required');

             $this->form_validation->set_rules('cash_agent_name', 'Agent Name','trim|xss_clean');

             $this->form_validation->set_rules('cash_comments', 'Comments','trim|xss_clean');

             $this->form_validation->set_rules('cheque_agent_name', 'Agent Name','trim|xss_clean');

             $this->form_validation->set_rules('cheque_comments', 'Comments','trim|xss_clean');

             $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>'); 

            

             if($this->form_validation->run())

	         {

	             $data['Distributer_id'] = sprintf("DIS%05s",$this->session->userdata('id'));

	             $data['subscription_length'] = $this->input->post('Request_month');

	             $data['No_of_copies'] = str_replace("'", "",$this->input->post('Copies_requested'));             

	             $optionspayment      =  $this->input->post('optionspayment');

	            

	             $price = $this->db->select("price_cpy")->get('kr_discount')->row()->price_cpy;



	             $amount = ($data['No_of_copies']*$data['subscription_length']*$price);// total amount based on number of copy

	             $total_amount = $this->paymentcalc->amount($data['No_of_copies'],$amount);// to calculate amount after discount

	             

	             // new subscription will start on next month of the registered month

                 $data['subscription_date'] = date('Y-m-d', strtotime('first day of next month'));



                 // calculate expiration date

                 $no_month = $data["subscription_length"];

				 $t = strtotime($data['subscription_date']);

				 $data['expiry_date'] = date('Y-m-d',strtotime('+'.$no_month.' month', $t));



                 if($optionspayment == 'Cash')

					{

						$data['Cash_Check_by'] = str_replace("'", "",$this->input->post('cash_agent_name'));

						$data['comments'] = str_replace("'", "",$this->input->post('cash_comments'));

					}

				if($optionspayment == 'Cheque')

					{

						$data['Cash_Check_by'] = str_replace("'", "",$this->input->post('cheque_agent_name'));

						$data['comments'] = str_replace("'", "",$this->input->post('cheque_comments'));

					}





                 if($optionspayment == 'Cash' || $optionspayment == 'Cheque')

					{

                        //insert to order table

                        $order_id = $this->Distributer_model->order_add($data);

                        if($order_id != false)

                        {

                               

							    unset($data['subscription_length']);

							    unset($data['No_of_copies']);

							    unset($data['subscription_date']);

							    unset($data['Cash_Check_by']);

							    unset($data['comments']);

							    unset($data['expiry_date']);

                                

                                $data['order_id'] = $order_id;

                                $data['Mode_of_pay'] = $optionspayment;

                                $data['paypal_status'] = 'pending';

                                $data['paid_amnt'] = $total_amount;

                               // $data['date_of_pay'] = date('Y-m-d');



                                // updating payment table

                                $payment_res = $this->Distributer_model->payment_add($data);

                                if($payment_res != false)

                                {

                                      // need to integrate email code here

                                	// send mail after edit

                                	  $this->send_mail($order_id,$payment_res,'neworder');

                                      $this->session->set_flashdata('order','added');

                                       redirect('distributer/orders','refresh');



                                }

                                else

                                {

                                	 $this->session->set_flashdata('order','error');

                                	 redirect('distributer/orders','refresh');

                                }

                               

                              





                        }



					}

                    // online payment start

					else

				    {

                      // paypal start

                            $item_name = $no_month.' Month subscription';

                            $item_copy     = $data['No_of_copies']." copies";

 							$order_id = $this->Distributer_model->order_add($data); // last insert id to order

                            

                            // inserting payment entry with pending status                            



                            if($order_id != false)

                        {

                               

							    unset($data['subscription_length']);

							    unset($data['No_of_copies']);

							    unset($data['subscription_date']);

							    unset($data['Cash_Check_by']);

							    unset($data['comments']);

							    unset($data['expiry_date']);

                                

                                $data['order_id'] = $order_id;

                                $data['Mode_of_pay'] = 'online';

                                $data['paypal_status'] = 'pending';

                                $data['paid_amnt'] = $total_amount;

                                $data['date_of_pay'] = date('Y-m-d');



                                // updating payment table

                                $payment_res = $this->Distributer_model->payment_add($data);

                                if($payment_res != false)

                                {



                                	 // send mail after edit

                                	  $this->send_mail($order_id,$payment_res,'neworder');



                            $this->load->library('paypal_lib');

							//Set variables for paypal form

							$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; //test PayPal api url

							//$paypalID = 'jithin@ksofttechnologies.com'; //business email

							$paypalID = 'krusappal@gmail.com'; //business email

							$returnURL = base_url().'distributer/success'; //payment success url

							$cancelURL = base_url().'distributer/cancel/'.$order_id.'/'.$payment_res; //payment cancel url

							$notifyURL = base_url().'paypal/ipn'; //ipn url

							

							$this->paypal_lib->add_field('cmd','_cart');

							$this->paypal_lib->add_field('upload','1');

							$this->paypal_lib->add_field('business', $paypalID);

							$this->paypal_lib->add_field('return', $returnURL);

							$this->paypal_lib->add_field('cancel_return', $cancelURL);

							$this->paypal_lib->add_field('notify_url', $notifyURL);

							$this->paypal_lib->add_field('item_name_1', $item_name);

							$this->paypal_lib->add_field('custom', $payment_res."#neworder#".$order_id);

							$this->paypal_lib->add_field('item_number_1', $item_copy);							

							$this->paypal_lib->add_field('amount_1',$total_amount);  

							

							/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

							$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

							

							$this->paypal_lib->paypal_auto_form();

							exit;

						}

					}



                      // paypal end

					}



	            

	          }



		}

          



         $data['orders'] = $this->Distributer_model->orders_get(sprintf("DIS%05s",$this->session->userdata('id')));

		 $data['title'] = 'Distributer';

         $data['menu']  = 'distributer';

         $data['content'] = 'backend/distributer/new_orders';

         $this->load->view( 'backend/template', $data );

	}



     // edit existing order

    public function order_edit($orderid)

	{

		if($this->session->userdata('role') !='Distributer')

			redirect('','refresh');

		//echo date('Y-m-d H:i:s');

		 $this->load->library('paymentcalc');

		  

		 if($this->input->post('pbutton'))

		 {



                     

             $this->form_validation->set_rules('Copies_requested', 'Copies Requested', 'trim|xss_clean|required|is_natural|callback_mincopy_check');

             $this->form_validation->set_rules('Request_month', 'Number of Month','trim|xss_clean|required');

             $this->form_validation->set_rules('cash_agent_name', 'Agent Name','trim|xss_clean');

             $this->form_validation->set_rules('cash_comments', 'Comments','trim|xss_clean');

             $this->form_validation->set_rules('cheque_agent_name', 'Agent Name','trim|xss_clean');

             $this->form_validation->set_rules('cheque_comments', 'Comments','trim|xss_clean');

             $this->form_validation->set_rules('oid', 'Order ID','trim|xss_clean|required');

             $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>'); 

            

             if($this->form_validation->run())

	         {

	             $data['Distributer_id'] = sprintf("DIS%05s",$this->session->userdata('id'));

	             $data['subscription_length'] = $this->input->post('Request_month');

	             $data['No_of_copies'] = str_replace("'", "",$this->input->post('Copies_requested')); 

	             $oid = str_replace("'", "",$this->input->post('oid'));  // sha1 encoded

	             // get order id in normal format, all others ara encoded to sha1

                 $order_details =  $this->Distributer_model->order_details($oid,$data['Distributer_id']);

                 //pr($order_details);

                 //exit();

                 $data['order_id'] =  $order_details['id'];

	             $optionspayment      =  $this->input->post('optionspayment');

	            

	             $price = $this->db->select("price_cpy")->get('kr_discount')->row()->price_cpy;

                   // total amount based on number of copy

	             $amount = ($data['No_of_copies']*$data['subscription_length']*$price);

	            // amount after discount

	             $after_discount = $this->paymentcalc->amount($data['No_of_copies'],$amount);

	                             

                 // amount need to pay after refund #for paypal too

	             $actual_amount = $this->Distributer_model->get_refund($data['No_of_copies'],$amount,$oid);

	             

	             

                 // calculate new expiration date based on subscription month

                 $no_month = $data["subscription_length"];

				 $t = strtotime($order_details['expiry_date']);



				 if($order_details['subscription_length'] < $no_month)

				 {

                     $diff = ($no_month-$order_details['subscription_length']);

				 	 $data['expiry_date'] = date('Y-m-d',strtotime('+'.$diff.' month', $t));



				 }

				 else

				 {

				 	 $diff = ($order_details['subscription_length']-$no_month);

				 	 $data['expiry_date'] = date('Y-m-d',strtotime('-'.$diff.' month', $t));

				 }

				



               

                 $data['updated_date'] = date('Y-m-d H:i:s');



                 if($optionspayment == 'Cash')

					{

						$data['Cash_Check_by'] = str_replace("'", "",$this->input->post('cash_agent_name'));

						$data['comments'] = str_replace("'", "",$this->input->post('cash_comments'));

					}

				if($optionspayment == 'Cheque')

					{

						$data['Cash_Check_by'] = str_replace("'", "",$this->input->post('cheque_agent_name'));

						$data['comments'] = str_replace("'", "",$this->input->post('cheque_comments'));

					}



              

                 if($optionspayment == 'Cash' || $optionspayment == 'Cheque')

					{

                        

                        $history = $this->Distributer_model->save_history($data['order_id']);

                        if($history == true) 

                        {

                        //update order table



                        $resp = $this->Distributer_model->order_update($data);

                        if($resp != false)

                        {

                               

							    unset($data['subscription_length']);

							    unset($data['No_of_copies']);

							    unset($data['subscription_date']);

							    unset($data['Cash_Check_by']);

							    unset($data['comments']);

							    unset($data['expiry_date']);

                                

                                

                                $data['Mode_of_pay'] = $optionspayment;

                                $data['paypal_status'] = 'pending';





                                $res = explode("#", $actual_amount);

                                if( $res[0]== 'extra')

				                {

				                	$data['paid_amnt'] = $after_discount;// total amount, but you need to pay only the extraamount

				                	$data['refund_amnt'] = '0';

				                  

				                }

				                if($res[0] == 'refund')

				                {

				                 

				                    $data['paid_amnt'] = ($after_discount);

				                	$data['refund_amnt'] = $res[1];

				                	$data['paypal_status'] = 'completed';

				                	$data['date_of_pay'] = date('Y-m-d');

				                }

                

				                if($res[0] == 'normal')

				                {

				                    $data['paid_amnt'] = $res[1];

				                	$data['refund_amnt'] = '0';

				                }





                               // $data['date_of_pay'] = date('Y-m-d');



                                // pr($data);exit;

                                // updating payment table

                                $payment_res = $this->Distributer_model->payment_add($data);

                                if($payment_res != false)

                                {

                                	  // send mail after edit

                                	 $this->send_mail($data['order_id'],$payment_res,'editorder');

                                      // need to integrate email code here

                                      $this->session->set_flashdata('order','updated');

                                       redirect('distributer/orders','refresh');



                                }

                                else

                                {

                                	 $this->session->set_flashdata('order','error');

                                	 redirect('distributer/orders','refresh');

                                }

                               

                              





                        }

                      }



					}

                    // online payment start

					else

				    {

                        

                      // paypal start

                            $item_name = $no_month.' Month subscription';

                            $item_copy     = $data['No_of_copies']." copies";

                            $data['Cash_Check_by'] = '';

						    $data['comments'] = '';



 							$history = $this->Distributer_model->save_history($data['order_id']);

                        if($history == true) 

                        {



 							$resp = $this->Distributer_model->order_update($data);

                            

                            // inserting payment entry with pending status                            



                           if($resp != false)

                        {

                               

							    unset($data['subscription_length']);

							    unset($data['No_of_copies']);

							    unset($data['subscription_date']);

							    unset($data['Cash_Check_by']);

							    unset($data['comments']);

							    unset($data['expiry_date']);

                                

                                

                                $data['Mode_of_pay'] = 'online';

                                $data['paypal_status'] = 'pending';





                                $res = explode("#", $actual_amount);

                               

                                if( $res[0]== 'extra')

				                {

				                	$data['paid_amnt'] = $after_discount;// total amount, but you need to pay only the extraamount

				                	$data['refund_amnt'] = '0';

				                  

				                }

				                if($res[0] == 'refund')

				                {

				                 

				                    $data['paid_amnt'] = ($after_discount);

				                	$data['refund_amnt'] = $res[1];

				                	$data['paypal_status'] = 'completed';

				                }

                

				                if($res[0] == 'normal')

				                {

				                    $data['paid_amnt'] = $res[1];

				                	$data['refund_amnt'] = '0';

				                }





                                $data['date_of_pay'] = date('Y-m-d');



                                

                                // updating payment table

                                $payment_res = $this->Distributer_model->payment_add($data);

                                if($payment_res != false)

                                {

                                   // send mail before go to paypal

                                	//$this->send_mail($data['order_id'],$payment_res,'edited');

                               // for extra payments only pass the extra amount to paypal

                                if( $res[0]== 'extra')

				                {

                                  $data['paid_amnt'] = $res[1];

				                }



                            $this->load->library('paypal_lib');

							//Set variables for paypal form

							$paypalURL = 'https://www.paypal.com/cgi-bin/webscr'; //test PayPal api url

							//$paypalID = 'jithin@ksofttechnologies.com'; //business email

							$paypalID = 'krusappal@gmail.com'; //business email

							$returnURL = base_url().'distributer/success'; //payment success url

							$cancelURL = base_url().'distributer/cancel/'.$data['order_id'].'/'.$payment_res; //payment cancel url

							$notifyURL = base_url().'paypal/ipn'; //ipn url

							

							$this->paypal_lib->add_field('cmd','_cart');

							$this->paypal_lib->add_field('upload','1');

							$this->paypal_lib->add_field('business', $paypalID);

							$this->paypal_lib->add_field('return', $returnURL);

							$this->paypal_lib->add_field('cancel_return', $cancelURL);

							$this->paypal_lib->add_field('notify_url', $notifyURL);

							$this->paypal_lib->add_field('item_name_1', $item_name);

							$this->paypal_lib->add_field('custom', $payment_res."#editorder#".$data['order_id']);

							$this->paypal_lib->add_field('item_number_1', $item_copy);							

							$this->paypal_lib->add_field('amount_1',$data['paid_amnt']);  

							

							/*$this->paypal_lib->add_field('item_name_3', 'Convenience charge');							

							$this->paypal_lib->add_field('amount_3', $team_pay['convenience_c']);	*/

							

							$this->paypal_lib->paypal_auto_form();

							exit;

						}

					}

                }

                      // paypal end



					}



	            

	          }



		}

          

         $id = sprintf("DIS%05s",$this->session->userdata('id'));

         $data['orders'] = $this->Distributer_model->order_details($orderid,$id);

         //pr($data);

		 $data['title'] = 'Distributer';

         $data['menu']  = 'distributer';

         $data['content'] = 'backend/distributer/order_edit';

         $this->load->view( 'backend/template', $data );

	}





	// view order detail page

	public function order_details($orderid)

	{

		if($this->session->userdata('role') !='Distributer')

			redirect('','refresh');



         $id = sprintf("DIS%05s",$this->session->userdata('id'));

         $data['title'] = 'Order Details';

         $data['menu']  = 'distributer';

//echo $orderid;

         $data['orders'] = $this->Distributer_model->order_details($orderid,$id); // to get individual order details

//pr($data);

         $data['content'] = 'backend/distributer/order_details';

         $this->load->view( 'backend/template', $data );  



	}



    /** calculate refund*/

	public function get_refund()

	{

       

      $copy = str_replace("'", "",$this->input->post('copy'));  

      $amount = str_replace("'", "",$this->input->post('amount'));  

      $orderid = str_replace("'", "",$this->input->post('oid'));  

      echo $res = $this->Distributer_model->get_refund($copy,$amount,$orderid);



	}



	function mincopy_check($copy)

	{



        $price  = $this->db->query("SELECT * FROM kr_discount ")->row_array();

		if ($copy < $price['min_cpy'])

		{

			$this->form_validation->set_message( 'mincopy_check', 'Minimum Copies '.$price['min_cpy'] );

			return false;

		}

		else

		{

			return true;

		}

	}



  // paypal success after new order

	public function success()

	{

        $this->load->library('paypal_lib');

        $paypalInfo = $this->input->post();	



         

        $data['txn_id']      = $paypalInfo["txn_id"];

        $data['paid_amnt'] = $paypalInfo["payment_gross"]; 

		$data['payer_email'] = $paypalInfo["payer_email"];       

        $data['paypal_status']      = strtolower($paypalInfo["payment_status"]);

        $custom              = $paypalInfo['custom'];

        

        //pr($data);

        //echo $custom;exit;

        if($data['txn_id'] != '')

        {

	        $res = explode("#", $custom);



	        if($res[1] == 'neworder')

	        {

                 $data['id'] = $res['0'];

                 $orderid = $res['2'];

	             $res = $this->Distributer_model->payment_update($data);

	             if($res != false)

                                {

                                	  $this->send_mail($orderid,$data['id'],'success');

                                      // need to integrate email code here

                                      $this->session->set_flashdata('order','added');

                                       redirect('distributer/orders','refresh');



                                }

                                else

                                {

                                	 $this->session->set_flashdata('order','error');

                                	 redirect('distributer/orders','refresh');

                                }



	        }

	        if($res[1] == 'editorder')

	        {

                 $data['id'] = $res['0'];

                 $orderid = $res['2'];

	             $res = $this->Distributer_model->payment_update($data);

	             if($res != false)

                                {

                                	  $this->send_mail($orderid,$data['id'],'success');

                                      // need to integrate email code here

                                      $this->session->set_flashdata('order','updated');

                                       redirect('distributer/orders','refresh');



                                }

                                else

                                {

                                	 $this->session->set_flashdata('order','error');

                                	 redirect('distributer/orders','refresh');

                                }

	        }



        }

        else

        	redirect('','refresh');





	}



	// paypal success after new order

	public function cancel($orderid = '',$paymentid='')

	{





               



                $id = sprintf("DIS%05s",$this->session->userdata('id'));

               $this->send_mail($orderid,$paymentid,'cancelled');

                $data['res'] = $this->Distributer_model->order_details(sha1($orderid),$id);

                $data['title'] = 'Order Cancel';

                $data['menu']  = 'distributer';



         $data['content'] = 'backend/distributer/order_cancel';

         $this->load->view( 'backend/template', $data ); 



	}



// view order history

	public function order_history($orderid)

	{

		if($this->session->userdata('role') !='Distributer')

			redirect('','refresh');



         $id = $this->session->userdata('id');

         $data['title'] = 'Order History';

         $data['menu']  = 'distributer';

//echo $orderid;

         $data['orders'] = $this->Distributer_model->order_history($orderid); // to get individual order details

//pr($data);

         $data['content'] = 'backend/distributer/order_history';

         $this->load->view( 'backend/template', $data );  



	}





	// request to cancel order 



	public function order_cancel($orderid)

	{



          

         $id = sprintf("DIS%05s",$this->session->userdata('id'));

          $user = $this->db->select('First_name,Last_name,disributer_id,Email_address')->get_where('kr_distributers',array('disributer_id'=>$id))->row_array();

          

        

          $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();

          $orders = $this->Distributer_model->order_details($orderid,$id);

        

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

					$this->email->to($smtp['notify_email']);

					$this->email->cc($user['Email_address']);

					

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

					$mailContent.='<p>Hi Administrator,<br></p>';

  //*******************************************************************************



					$mailContent .='<p>'.ucfirst($user['First_name']).' (<b>'.$user['disributer_id'].'</b>) want to cancel his order. The details are as follows : <br>Subscription start date: <b>'.$orders['subscription_date'].'</b><br>Expiry date : <b>'.$orders['expiry_date'].'</b><br>Subscription length: '.$orders['subscription_length'].' Months<br>No. of copies: '.$orders['No_of_copies'].'<br>Payment status: '.$orders['paypal_status'].'<p>';

					$mailContent.='</p>';	





//*********************************************************************************

					$mailContent.='<p>Administrator,<br>

			      Kingdom Revelator USA</p>

			    </td>

			  </tr>

			</table>';	

			//echo $mailContent;exit;

					$this->email->subject('Message from Kingdom Revelator USA');

					$this->email->message($mailContent);

					$this->email->send();



					$this->session->set_flashdata('order','cancelrequest');

                    redirect('distributer/orders','refresh');





	}





	// send order mails



	public function send_mail($orderid,$paymentid,$msg)

	{

          //echo $orderid.'-'.$paymentid.'-'.$msg;exit;

          $id = sprintf("DIS%05s",$this->session->userdata('id'));

          $user = $this->db->select('First_name,Last_name,disributer_id,Email_address')->get_where('kr_distributers',array('disributer_id'=>$id))->row_array();

        

          $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();

          

         

	          $orders = 	$this->Distributer_model->order_details(sha1($orderid),$id);

			  $payments = $this->Distributer_model->payment_details($paymentid); 

		 

         



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

					$this->email->to($user['Email_address']);

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

					$mailContent.='<p>Hi '.$user['First_name'].',<br></p>';

  //*******************************************************************************

                    

                         $mailContent .='Your order details are as follows :<br>';

                         $mailContent .='Subscription start date: <b>'.$orders['subscription_date'].'</b><br>';

                         $mailContent .='Subscription expiry date: <b>'.$orders['expiry_date'].'</b><br>';

                         $mailContent .='Number of months: <b>'.$orders['subscription_length'].'</b><br>';

                         $mailContent .='Number of copies: <b>'.$orders['No_of_copies'].'</b><br>';

                         $mailContent .='Payment status: <b>'.$payments['paypal_status'].'</b><br>';

                         $mailContent .='Payment mode: <b>'.$payments['Mode_of_pay'].'</b><br>';

                         $mailContent .='Amount: <b>'.$payments['paid_amnt'].'</b><br>';

                         $mailContent .='Refund Amount: <b>$'.$payments['refund_amnt'].'</b><br>';

                         $mailContent .='Order created date: <b>'.$payments['created_date'].'</b><br>';

                   



					





//*********************************************************************************

					$mailContent.='<p>Administrator,<br>

			      Kingdom Revelator USA</p>

			    </td>

			  </tr>

			</table>';

			//echo 	$mailContent;exit;

					$this->email->subject('Message from Kingdom Revelator USA');

					$this->email->message($mailContent);

					$this->email->send();







	}





}


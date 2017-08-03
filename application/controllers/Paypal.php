<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {

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
	function  __construct(){
        parent::__construct();
        $this->load->library('paypal_lib');        
     }
     
     function success(){
        //get the transaction data
        
        $paypalInfo = $this->input->post();		  
         
        $data['txn_id']      = $paypalInfo["txn_id"];
        $data['paid_amnt'] = $paypalInfo["payment_gross"]; 
		$data['payer_email'] = $paypalInfo["payer_email"];       
        $data['paypal_status']      = strtolower($paypalInfo["payment_status"]);
      
        $custom = explode("#", $paypalInfo['custom']);
        //pr($custom);
        if($paypalInfo["txn_id"]=='')
        {
        	redirect('welcome');
        }
		if(strcmp($custom[0],"DIS")==5)
		{
			
			     $data['id'] = $custom[1];
			    // pr($data);
				 $res = $this->Distributer_model->payment_update($data);
	             if($res != false)
                 {
					$row=$this->db->query("SELECT * FROM kr_distributers b inner join kr_users c on c.login_id=b.disributer_id Where b.disributer_id='$custom[0]' ")->row_array();
					$Email=$row['Email_address'];
					$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		
                    $payments = $this->Distributer_model->payment_details($data['id']); 
                    $orders = 	$this->Distributer_model->order_details(sha1($payments['order_id']),$payments['Subscriber_id']);
                   // pr($payments);
//pr($orders);
                    //exit;

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
					$mailContent.='<p>Hi '.$row['First_name'].',<br></p>';
					$mailContent.='<p>You are successfully<bold> Registered </bold>. <br>Duration : '.$orders['subscription_length'].' Months <br>Number of copies : '.$orders['No_of_copies'].'<br>Amount: $'.$payments['paid_amnt'].'<br>Method of payment: online <br>Payment status: '.$payments['paypal_status'] .'</p>';
					$mailContent.='<p>You can update data using the below credentials <br>Username : '.$row['Email_address'].'<br>Password: '.$row['Password'].'<br></p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
					Kingdom Revelator USA</p>
					</td>
					</tr>
					</table>';
					//echo $mailContent;exit;
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();
					$this->session->set_flashdata('paypal','success');
					redirect('volunteer/form','refresh');
				}
			
			
		}
		else
		{
			$data['id'] = $custom[1];
		//pr($data);exit;
				 $res = $this->Subscriber_model->payment_update($data);
				 if($res != false)
                                {
                                    $row=$this->db->query("SELECT * FROM kr_subscribers where id='$custom[0]' ")->row_array();
                                    $Email=$row['Email_address']; 
                                       $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
                                     

			                       $payments = $this->Subscriber_model->payment_details($data['id']); 
                                   $orders = 	$this->Subscriber_model->order_details(sha1($payments['order_id']),$payments['Subscriber_id']);
		// pr($orders);
		 //pr($payments);exit;
									
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
									$mailContent.='<p>You are successfully<bold> Registered </bold>. <br>Duration : '.$orders['subscription_length'].' Months <br>Number of copies : '.$orders['No_of_copies'].'<br>Amount: $'.$payments['paid_amnt'].'<br>Method of payment: online <br>Payment status: '.$payments['paypal_status'] .'</p>';
									$mailContent.='<p>You can update data using the below credentials <br>Username : '.$row['Email_address'].'<br>Password : '.$row['Password'].'<br></p>';
									$mailContent.='</p>';	
									$mailContent.='<p>Administrator,<br>
								  Kingdom Revelator USA</p>
								</td>
							  </tr>
							</table>';
							//echo $mailContent;exit;
								
								$this->email->subject('Message from Kingdom Revelator USA');
								$this->email->message($mailContent);
								$this->email->send();
                                $this->session->set_flashdata('paypal', 'success');
					            redirect('subscription/form','refresh');
				}
			
				
		}
	 }
	  function ipn(){
        //paypal return transaction details array
        $paypalInfo    = $this->input->post();
		$data=array();
        //$paypalInfo["item_number"];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['paid_amt'] = $paypalInfo["mc_gross_1"];        
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['paypal_status']    = $paypalInfo["payment_status"];
		if($paypalInfo["payment_status"]=="Completed")
		$data['paid_status'] =1;
		$custom =$paypalInfo['custom'];
		//$custom=explode("#$",$custom);
		//$team_pay_id=$data['id']=$custom[0];
		//$member_ids=($custom[1] !="")?explode(',',$custom[1]):array();
		
		

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
		if(strcmp($custom,"DIS")==5)
		{
			$this->db->query("UPDATE `kr_dis_payment` SET `Subscriber_id`='$custom', `Mode_of_pay`='online', `paypal_status`='".$data['paypal_status']."', `paid_amnt`='".$data['paid_amt']."', `txn_id`='".$data['txn_id']."' WHERE `Subscriber_id`='$custom'");
		}
		else
		{
			$this->db->query("UPDATE `kr_payment` SET `Subscriber_id`='$custom', `Mode_of_pay`='online', `paypal_status`='".$data['paypal_status']."', `paid_amnt`='".$data['paid_amt']."', `txn_id`='".$data['txn_id']."' WHERE `Subscriber_id`='$custom'");
		}
	  }
	  
	  function cancel()
	  {
	  	
		  redirect('subscription/cancel');
	  }
}

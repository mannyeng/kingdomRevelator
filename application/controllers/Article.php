<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	function __construct() {
     parent::__construct();
	  
	   $this->session->set_flashdata('alert', '');
	    if ( $this->session->userdata('role') == '')
     {
            redirect( '', 'refresh' );
           }
	}
	public function index()
	{
		 $this->session->set_flashdata('alert', '');
		 $id               = $this->session->userdata('id');
		 $data['row']      = $this->db->query("select * from kr_distributers where User_id='$id'")->row_array();
		 $data['articles'] = $this->db->get_where('kr_article','user_id='.$id)->result_array();
		 $data['title']    = 'Article';
         $data['menu']     = 'article';
         $data['content']  = 'backend/article/home';
         $this->load->view( 'backend/template', $data );
		 
	}
	public function submit_article()
	{
		 $this->session->set_flashdata('alert', '');
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');

		 $row  = $this->db->query("select * from kr_distributers where User_id='$id'")->row_array();

		 if($this->input->post())
		 {
			 $Memo      		=   str_replace("'", "",$this->input->post('memo'));
			
			 $config['upload_path']          = './article_upload/';
			 $config['allowed_types']        = 'doc|docx|pdf';
			$fname = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES["article"]["name"]);
			$config['file_name']            = time().'-'.$fname;
	        $this->load->library('upload', $config);
	
		    $file_path= '' ;
			if(isset($_FILES))
			{
				$file_path = $this->upload->data('file_name');
				$this->upload->do_upload('article');
				
			}
			//$user_id = $this->db->insert_id();
			$this->db->query("INSERT INTO `kr_article`(`memo`, `file_path`, `user_id`) VALUES ('$Memo','$file_path','$id')");
			
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
			$this->email->to(array($row['Email_address'],'krusaarticles@gmail.com'));
			
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
				
		}
			 
			 $data['subscriber'] = $this->common->subscribers_list($id,$type); 
			 $data['title'] = 'Article';
			 $data['menu']  = 'article';
			 $data['content'] = 'backend/article/submit_article';
			 $this->load->view( 'backend/template', $data );
	}
	
	public function profile()
	{
		//pr($this->input->post());exit;
		 $this->session->set_flashdata('alert', '');
		 $id=$this->session->userdata('id');
		if($this->input->post('Update'))
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
			$user_id  		=   str_replace("'", "",$this->input->post('user_id'));
			$dist_id		=	str_replace("'", "",$this->input->post('dist_id'));
			
			
			$Exist_user		=   $this->db->query("SELECT id FROM kr_users WHERE `Email_address`='$Email' and admin_type='Article' and id!=".$id);

			if($Exist_user->num_rows()>0)
			{ 
				$this->session->set_flashdata('alert','already');
			}
			else
			{
				$this->db->update('kr_users',array('Email_address'=>$Email,'Password'=>$Password),array('id'=>$id));
				$this->db->update('kr_distributers',array('First_name'=>$First_name,'Last_name'=>$Last_name,'Mailing_address1'=>$Address1,'Mailing_address2'=>$Address2,'City'=>$City,'State'=>$State,'Zipcode'=>$Zipcode,'Home_phone'=>$Home_phone,'Cell_phone'=>$Cell_phone,'Email_address'=>$Email),array('id'=>$dist_id));
				
					
					$this->session->set_flashdata('alert','updated');	
					$this->common->mail_send_profile_update($Email,'Article',$Password);
					//redirect('article/profile/'.$user_id);			
			}
			
			
			
		}
		 $dist_id = $this->uri->segment('3');
		// echo "select d.*,u.Password from kr_users u inner join kr_distributers d on(u.Distributer_id=d.id) where u.id=$dist_id and(u.National_admin_id='$id' or u.Zonal_admin_id='$id' or u.State_admin_id='$id' or u.State_zone_admin_id='$id')";
		 $data['row']=$this->db->query("select d.*,u.Password from kr_users u inner join kr_distributers d on(u.id=d.User_id) where d.User_id=$id")->row_array();
		 //$data['row']=$this->db->query("select d.*,u.Password from kr_users u inner join kr_distributers d on(u.Distributer_id=d.id) where  u.id=$dist_id and(u.National_admin_id='$id' or u.Zonal_admin_id='$id' or u.State_admin_id='$id' or u.State_zone_admin_id='$id')")->row_array();
		 if($this->db->query("select count(id) cnt from kr_vol_times where user_id=$id")->row()->cnt > 0)
		 $data['times']= $this->db->query("select * from kr_vol_times where user_id=$id")->result_array();
		 $data['title'] = 'Article';
         $data['menu']  = 'article';
         $data['content'] = 'backend/article/profile';
         $this->load->view( 'backend/template', $data );	
	}
}

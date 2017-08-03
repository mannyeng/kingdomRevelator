<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

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
	 function __construct()
	 {
		 parent::__construct();
		 $this->load->library('form_validation');
	 }
	 
	
	 
	public function index()
	{
		 //$id=$this->session->userdata('id');
		 $data['title'] = 'Finance';
         $data['menu']  = 'finance';
         $data['content'] = 'backend/finance/home';
         $this->load->view( 'backend/template', $data );
		 
	}
	
	public function subscribers_list_report()
	{
		 $filter 	= $this->input->post('filter');
		 $users  	= $this->input->post('users');
		 $from_date = $this->input->post('from_date');
		 $to_date	= $this->input->post('to_date');
		  if(isset($_POST['filter'])){
				   $data['filter'] = $filter;
				   $data['users']  = $users;
				   $this->session->set_userdata('filter',$filter);
				   $this->session->set_userdata('users',$users);
				}
				else{
					$filter = $this->session->userdata('filter');
				}
				if(isset($_POST['from_date'])){
				   $data['from_date_selected']  = $from_date;
				   $this->session->set_userdata('from_date_selected',$from_date);
				}
				if(isset($_POST['to_date'])){
				   $data['to_date_selected']  = $to_date;
				   $this->session->set_userdata('to_date_selected',$to_date);
				}
		 if($this->input->post())
		 {
			
				 $data['subscriber'] = $this->common->subscribers_filter_list($filter,$users,$from_date,$to_date);
				 $data['title'] = 'Finance';
				 $data['menu'] = 'finance';
				 $data['content'] = 'backend/finance/subscribers_list_report';
				 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['subscriber'] = $this->common->subscribers_list($id,$type);
			 $data['title'] = 'Finance';
			 $data['menu'] = 'finance';
			 $data['content'] = 'backend/finance/subscribers_list_report';
			 $this->load->view( 'backend/template', $data );
		 }
	}
	
	public function export()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		 $filter     = $this->session->userdata('filter');
		 $users      = $this->session->userdata('users');
		 $from_date  = $this->session->userdata('from_date_selected');
		 $to_date	 = $this->session->userdata('to_date_selected');
		$xcols=range('A','Z');
		if($filter !="")
		{
			$columns=array('ID','First Name','Last Name','Mailing Address','Billing Address','Email','Home Phone','Cell Phone','National Coordinator','Zone Coordinator','State Coordinator','State Zone Coordinator','Distributer','No.of Copy','Mode of payment','Subscriptions','Filter by');
			foreach($columns as $ind=>$col)
			{
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
			}
			$results = $this->common->subscribers_filter_list($filter,$users,$from_date,$to_date);
			$i=2;
			foreach($results as $result)
			{
				$res_data  = $this->db->query("SELECT * FROM kr_users Where id='".$result['Distributer_id']."'");
				$res_array = $res_data->result_array();
				foreach($res_array as $ind1=>$row1)
				{
					$distributer     			= $row1['First_name'];
					
					$res_state_zone  			= $this->db->query("SELECT First_name FROM kr_users Where id='".$row1['State_zone_admin_id']."'");
					$res_state_zone_array       = $res_state_zone->result_array();
					$state_zone					= $res_state_zone_array[0]['Name'];
					
					$res_state  			    = $this->db->query("SELECT First_name FROM kr_users Where id='".$row1['State_admin_id']."'");
					$res_state_array	        = $res_state->result_array();
					$state						= $res_state_array[0]['Name'];
					
					$res_zone  			        = $this->db->query("SELECT First_name FROM kr_users Where id='".$row1['Zonal_admin_id']."'");
					$res_zone_array	       		= $res_zone->result_array();
					$zone						= $res_zone_array[0]['Name'];
					
					$res_national		        = $this->db->query("SELECT First_name FROM kr_users Where id='".$row1['National_admin_id']."'");
					$res_national_array	      	= $res_national->result_array();
					$national					= $res_national_array[0]['First_name'];
				}
				
				$short_name = $result['First_name'];
				$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];
				$billing    = $result['BillingAddress1'].",".$result['BillingAddress2'].",".$result['BillingCity'].",".$result['BillingState'].",".$result['BillingZip'];
				$values     = array($result['id'],$result['First_name'],$result['Last_name'],$mailing,$billing,$result['Email_address'],$result['Home_phone'],$result['Cell_phone']);
				$values[]   = $national;
				$values[]   = $zone;
				$values[]   = $state;
				$values[]   = $state_zone;
				$values[]   = $distributer;
				$values[]   = $result['No_of_copies'];
				$values[]   = $result['Mode_of_payment'];
				$values[]   = ($result['Subscriptions']==25)?'1 year':'2 year';
				$values[]   = $filter;
				/*$values[]=($result['airport_pick']==1)?'Yes':'No';
				$values[]=$result['arrival_date'];
				$counts=explode("#$",$result['counts']);
				$values[]=$counts[0];
				$values[]=$result['request'];*/
					
				foreach($values as $ind=>$val)
				{
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);
				if(in_array($xcols[$ind],array('K')))
				  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	
				}
				
				$i++;
			}			
		}
		$filename=$short_name.'_'.date('Ymd_His'); //save our workbook as this file name
		$objWriter = new PHPExcel_Writer_Excel2007($this->excel);
		$objWriter->setPreCalculateFormulas(false);
		//ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"'); //tell browser what's the file name
		
		header('Cache-Control: max-age=0'); //no cache
		$objWriter->save('php://output');
		exit();
		//redirect('national/subscribers_list_report');
	}
	
	/* delete user*/
	public function user_delete()
	{
		 if($this->uri->segment(3))
		 {
			$Zone  = $this->uri->segment(3);
			
				//$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$State[$i]."' ");
				//	$national_id = $res_nat->row_array();
				$res=$this->db->query("UPDATE kr_users SET Email_address='',Password='' kr_users where id ='$Zone'");
				//$this->db->query("UPDATE kr_users SET $State_admin_id='".$State[$i]."' where County_admin_id='".$County."'");
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['users']   = $this->common->user_list($id,$type);
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/user_list';
         $this->load->view( 'backend/template', $data );
	}
	
	/* set deallocate subscriber*/
	public function deallocate_subscriber()
	{
		 if($this->input->post())
		 {
			$Distibuter  = $this->input->post('Distibuter');
			$Subscriber  = $this->input->post('Subscriber');
			
				//$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$State[$i]."' ");
				//	$national_id = $res_nat->row_array();
				$res=$this->db->query("UPDATE kr_subscribers SET Distributer_id='0' where id NOT IN ( '" . @implode($Subscriber, "', '") . "' ) ");
				//$this->db->query("UPDATE kr_users SET $State_admin_id='".$State[$i]."' where County_admin_id='".$County."'");
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['Distibuter']   = $this->common->distributer_list($id,$type);
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/deallocate_subscriber';
         $this->load->view( 'backend/template', $data );
	}
	
	/* set deallocate state*/
	public function deallocate_state()
	{
		 if($this->input->post())
		 {
			$Zone  = $this->input->post('Zone');
			$State = $this->input->post('State');
			
				//$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$State[$i]."' ");
				//	$national_id = $res_nat->row_array();
				//$res=$this->db->query("UPDATE kr_users SET Zonal_admin_id='0',flag='0' where id NOT IN ( '" . @implode($State, "', '") . "' ) and Zonal_admin_id='$Zone'");
				$this->db->query("UPDATE kr_state SET Zone_id='0' where id NOT IN ( '" . @implode($State, "', '") . "' ) and Zone_id='$Zone'");
				//$this->db->query("UPDATE kr_users SET $State_admin_id='".$State[$i]."' where County_admin_id='".$County."'");
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['Zone']   = $this->common->zone_list($id,$type);
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/deallocate_state';
         $this->load->view( 'backend/template', $data );
	}
	
	/* set deallocate distributer*/
	public function deallocate_distributer()
	{
		 if($this->input->post())
		 {
			$County  = $this->input->post('County');
			$Distibuters = $this->input->post('Distibuters');
			
				//$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$State[$i]."' ");
				//	$national_id = $res_nat->row_array();
				$res=$this->db->query("UPDATE kr_users SET State_zone_admin_id='0' where id NOT IN ( '" . @implode($Distibuters, "', '") . "' ) and State_zone_admin_id='$County'");
				//$this->db->query("UPDATE kr_users SET $State_admin_id='".$State[$i]."' where County_admin_id='".$County."'");
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['Zone']   = $this->common->county_list($id,$type);
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/deallocate_distributer';
         $this->load->view( 'backend/template', $data );
	}
	
	/* set discount*/
	public function discount()
	{
		if($this->input->post())
		{
		 $above10   = $this->input->post('above10');
		 $above20   = $this->input->post('above20');
		 $above30   = $this->input->post('above30');
		 
		 $this->db->query("UPDATE kr_discount SET above10='$above10',above20='$above20',above30='$above30' WHERE id='1'");
		 if($this->db->affected_rows()>0)
		 {
			 $this->session->set_flashdata('alert','success');
		 }
		}
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/discount';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of zone admin under state*/
	public function state_list_all()
	{
		 $id = $this->uri->segment(3);
		 $data['state'] = $this->common->state_list_all($id);
		 $data['title'] = 'National';
         $data['menu'] = 'national';
         $data['content'] = 'backend/national/state_list';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of zone admin under state*/
	public function state_list()
	{
		if($this->uri->segment(3)!='')
		 {
			 $id = $this->uri->segment(3);
			 $data['state']    = $this->common->state_list_all($id);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/state_list';
			 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['state']    = $this->common->state_list($id,$type);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/state_list';
			 $this->load->view( 'backend/template', $data );
		 }
	}
	
	
	/*Get List of zone admin under national*/
	public function zone_list_all()
	{
		 $id = $this->session->userdata('id');
		 $data['zone']    = $this->common->zone_list_all($id);
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/zone_list';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of zone admin under national*/
	public function zone_list()
	{
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['zone'] = $this->common->zone_list($id,$type);
		 $data['title']   = 'National';
		 $data['menu']    = 'national';
		 $data['content'] = 'backend/national/zone_list';
		 $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of county admin under national*/
	public function county_list()
	{
		 if($this->uri->segment(3)!='')
		 {
			 $id = $this->uri->segment(3);
			 $data['county']    = $this->common->county_list_all($id);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/county_list';
			 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['county'] = $this->common->county_list($id,$type);
			 $data['title'] = 'National';
			 $data['menu'] = 'national';
			 $data['content'] = 'backend/national/county_list';
			 $this->load->view( 'backend/template', $data );
		 }
	}
	
	/*Get List of state_zone admin under national*/
	public function state_zone_list()
	{
		 if($this->uri->segment(3)!='')
		 {
			 $id = $this->uri->segment(3);
			 $data['state_zone']    = $this->common->state_zone_list_all($id);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/state_zone_list';
			 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['state_zone'] = $this->common->state_zone_list($id,$type);
			 $data['title'] = 'National';
			 $data['menu'] = 'national';
			 $data['content'] = 'backend/national/state_zone_list';
			 $this->load->view( 'backend/template', $data );
		 }
	}
	
	/*Get List of distributers under county*/
	public function distributers_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id = $this->uri->segment(3);
			 $data['distributer']    = $this->common->distributer_list_all($id);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/distributer_list';
			 $this->load->view( 'backend/template', $data );
		}
	 	else
		{
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['distributer'] = $this->common->distributer_list($id,$type);
			 $data['title'] = 'National';
			 $data['menu'] = 'national';
			 $data['content'] = 'backend/national/distributer_list';
			 $this->load->view( 'backend/template', $data );
		}
	}
	
	/* Assign distributer to county */
	public function assign_distributers()
	{
		 if($this->input->post())
		 {
			$County = $this->input->post('County');
			$Distributers = $this->input->post('Distributers');
			for($i=0;$i<count($Distributers);$i++)
			{
				$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$County."' ");
				$national_id = $res_nat->row_array();
				$res=$this->db->query("UPDATE kr_users SET State_zone_admin_id='$County',National_admin_id='".$national_id['National_admin_id']."',State_admin_id='".$national_id['State_admin_id']."',Zonal_admin_id='".$national_id['Zonal_admin_id']."' where id='".$Distributers[$i]."'");
			}
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['County']        = $this->common->county_list($id,$type);
		 $data['distributer'] = $this->common->unassign_distributers();
		 $data['title']   = 'National';
		 $data['menu']    = 'national';
		 $data['content'] = 'backend/national/assign_distributer';
		 $this->load->view( 'backend/template', $data );
	}
	
	/* Assign state to zone */
	public function assign_state()
	{
		 if($this->input->post())
		 {
			$Zone  = $this->input->post('Zone');
			$State = $this->input->post('State');
			for($i=0;$i<count($State);$i++)
			{
				//$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$State[$i]."' ");
				//	$national_id = $res_nat->row_array();
				//$res=$this->db->query("UPDATE kr_users SET Zonal_admin_id='$Zone',flag='1' where id='".$State[$i]."'");
				$this->db->query("UPDATE kr_state SET Zone_id='$Zone' where id='".$State[$i]."'");
				//$this->db->query("UPDATE kr_users SET $State_admin_id='".$State[$i]."' where County_admin_id='".$County."'");
			}
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['Zone']    = $this->common->zone_list($id,$type);
		 $data['State']   = $this->common->unassign_state();
		 $data['title']   = 'National';
		 $data['menu']    = 'national';
		 $data['content'] = 'backend/national/assign_state';
		 $this->load->view( 'backend/template', $data );
	}
	
	/* Assign subscribers distributer */
	public function assign_subscribers()
	{
		 if($this->input->post())
		 {
			$distributer = $this->input->post('distributer');
			$Subscribers = $this->input->post('Subscribers');
			for($i=0;$i<count($Subscribers);$i++)
			{
				$res=$this->db->query("UPDATE kr_subscribers SET Distributer_id='$distributer' where id='".$Subscribers[$i]."'");
			}
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['distributer'] = $this->common->distributer_list($id,$type);
		 $data['subscribers'] = $this->common->unassign_subscribers();
		 $data['title']   = 'National';
		 $data['menu']    = 'national';
		 $data['content'] = 'backend/national/assign_subscribers';
		 $this->load->view( 'backend/template', $data );
	}
	
	
	/*Get List of Subscribers  */
	public function subscribers_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id = $this->uri->segment(3);
		 	$data['subscriber'] = $this->common->subscribers_list_all($id);
		 	$data['title'] = 'Finance';
        	$data['menu'] = 'finance';
         	$data['content'] = 'backend/finance/subscribers_list';
        	$this->load->view( 'backend/template', $data );
		}
	 	else
		{
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['subscriber'] = $this->common->subscribers_list($id,$type);
			 $data['title'] = 'Finance';
			 $data['menu'] = 'finance';
			 $data['content'] = 'backend/finance/subscribers_list';
			 $this->load->view( 'backend/template', $data );
		}
		 
	}
	
	/*Get List of Users */
	public function user_list()
	{
		 $id = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['users'] = $this->common->user_list($id,$type);
		 $data['title'] = 'National';
         $data['menu']  = 'national';
         $data['content'] = 'backend/national/user_list';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Add user */
	public function user_add()
	{
		$id   = $this->session->userdata('id');
		if($this->input->post())
		{
			$First_name = $this->input->post('first_name');
			$password   = $this->input->post('passwrd');
			$email      = $this->input->post('email');
			$admin_type = $this->input->post('role');
			$State		= $this->input->post('State');
			$Zone		= $this->input->post('Zone');
			$formtype	= $this->input->post('formtype');
			$edit_id	= $this->input->post('edit_id');
			$all_state	= $this->input->post('all_state');

			
			if($formtype=='Add')
			{
				$resulr_exist = $this->db->query("SELECT * FROM kr_users WHERE Email_address='$email' ");
				if($resulr_exist->num_rows()>0)
				{
					$this->session->set_flashdata('alert','Error');
				}
				else
				{
					$this->db->query("INSERT INTO kr_users( `First_name`, `Email_address`, `Password`, `National_admin_id`, `State_admin_id`, `Zonal_admin_id`,`admin_type`) VALUES('$First_name','$email','$password','$id','$State','$Zone','$admin_type') ");
					$this->common->mail_send($email,$admin_type,$password);
					if($this->db->insert_id()>0)
					{
						if($admin_type=='zone')
						{
							$Zone_id =$this->db->insert_id();
							for($i=0;$i<count($all_state);$i++)
							{
								$this->db->query("UPDATE kr_state SET `Zone_id`='$Zone_id' WHERE id='".$all_state[$i]."'");
							}
						}
						if($admin_type=='state')
						{
							$Zone_id =$this->db->insert_id();
							
								$this->db->query("UPDATE kr_state SET `State_admin_id`='$Zone_id' WHERE id='".$State."'");
						}
						if($admin_type=='Distributer')
						{
							$Zone_id =$this->db->insert_id();
							
								$this->db->query("UPDATE kr_users SET `Distributer_id`='".sprintf("DIS%05s", 10)."' WHERE id='".$Zone_id."'");
						}
						$this->session->set_flashdata('alert','success');
					}
				}
			}
			else
			{
				$this->db->query("UPDATE kr_users SET `First_name`='$First_name', `Email_address`='$email',`Password`='$password', `State_admin_id`='$State', `Zonal_admin_id`='$Zone',`admin_type`='$admin_type' WHERE id='$edit_id'");
				if($this->db->affected_rows()>0)
				{
					$this->session->set_flashdata('alert','updated');
				}
			}
		}
		
		 
		 $type = $this->session->userdata('role');
		 $data['county']  = $this->common->county_list($id,$type);
		 $data['zone']    = $this->common->zone_list($id,$type);
		 $data['state']   = $this->common->state_list($id,$type);
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/user_add';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Add new Subscribers under distributers/county */
	public function subscribers_save()
	{
		 $this->load->helper('form');
		 $data['title'] = 'National';
         $data['menu'] = 'national';
         $data['content'] = 'backend/national/subscribers_save';
         $this->load->view( 'backend/template', $data );
		 
		 if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('short_name', 'Short name', 'required');			
            $this->form_validation->set_rules('seats', 'seats', 'required|numeric');
			$this->form_validation->set_rules('wait', 'wait', 'required|numeric');			
			$this->form_validation->set_rules('adult_fee', 'Adult fee', 'required|numeric');
            $this->form_validation->set_rules('datFrom', 'From Date', 'required');
			$this->form_validation->set_rules('datTo', 'To Date', 'required');
			$this->form_validation->set_rules('datEnd', 'Reg. End Date', 'required');
			$this->form_validation->set_rules('by_whom', 'Retreat By', 'required');
			$this->form_validation->set_rules('bible', 'Bible Quote', 'required');
            $this->form_validation->set_rules('location', 'Venue', 'required');            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run()==true)
            {
				
                $data_to_store = array(
                    'name' => $this->input->post('name'),
					'short_name' => $this->input->post('short_name'),
					'seats' => $this->input->post('seats'),
					'wait' => $this->input->post('wait'),					
					'adult_fee' => $this->input->post('adult_fee'),
					'datFrom' => $this->input->post('datFrom'),
					'datTo' => $this->input->post('datTo'),
					'datEnd' => $this->input->post('datEnd'),
					'by_whom' => $this->input->post('by_whom'),
					'bible' => $this->input->post('bible'),
					'location' => $this->input->post('location'),
					'to_whom' => $this->input->post('to_whom'),
					'position' => $this->input->post('position'),
					'session' => implode(',',$this->input->post('session')),
					'description' => $this->input->post('description'),
					'disable_reg' => $this->input->post('disable_reg'),
					'paypalc' => $this->input->post('paypalc')/*,	
					'conv_percent' => $this->input->post('conv_percent')*/				
                );
				
			    //if the insert has returned true then we show the flash message
                if($this->retreat->store_retreat($data_to_store)){
                    $this->session->set_flashdata('flash_message', 'added');
					redirect('retreats/retreats_list');
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
	}
	
	public function profile()
	{
		 $res_subscribe = $this->db->query("SELECT * FROM kr_distributers WHERE User_id='1'");
		 $page_data['subscribers'] = $res_subscribe->result_array();
		 $page_data['account_type']   = 'Distributer';
		 $page_data['page_name']   = '../Distributer/profile';
	     $page_data['page_title'] = 'Profile';
		 $this->load->view('backend/index', $page_data);
	}
}

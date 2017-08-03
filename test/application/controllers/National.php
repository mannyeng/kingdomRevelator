<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class National extends CI_Controller {

	
	 function __construct()
	 {
		 parent::__construct();
		 $this->session->set_flashdata('alert', '');
	    if ( $this->session->userdata('role') == '')
     {
            redirect( '', 'refresh' );
           }
		 $this->load->library('form_validation');
	 }
	 
	
	 
	public function index()
	{
		 //$id=$this->session->userdata('id');
		 $data['title'] = 'National';
         $data['menu']  = 'national';
         $data['content'] = 'backend/national/home';
         $this->load->view( 'backend/template', $data );
		 
	}
	
	/*update payment status of subscriber*/
	public function subscribers_payment()
	{
		if($this->input->post())
		{
			$id     = $this->uri->segment(3);
			$Amount = $this->input->post('Amount');
		    $this->db->set('paypal_status','Completed');
			$this->db->set('paid_amnt',$Amount);
			$this->db->set('cheque_num',$this->input->post('Cheque_Number'));
			$this->db->set('bank_detail',$this->input->post('Bank_Detail'));
			$this->db->set('acc_num',$this->input->post('Account_Number'));
			$this->db->set('date_of_pay',$this->input->post('Issue_Date'));
			$this->db->set('notes',$this->input->post('Note'));
			$this->db->where('Subscriber_id',$id);
			$this->db->update('kr_payment');
			$this->send_confirmation_subscriber($id,$Amount);
		}
		 //$id=$this->session->userdata('id');
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/subscribers_payment';
         $this->load->view( 'backend/template', $data );
		 
	}
	
	/*update payment status of subscriber*/
	public function distributers_payment()
	{
		if($this->input->post())
		{
			$id     = $this->uri->segment(3);
			$Amount = $this->input->post('Amount');
			$this->db->set('paypal_status','Completed');
			$this->db->set('paid_amnt',$Amount);
			$this->db->set('cheque_num',$this->input->post('Cheque_Number'));
			$this->db->set('bank_detail',$this->input->post('Bank_Detail'));
			$this->db->set('acc_num',$this->input->post('Account_Number'));
			$this->db->set('date_of_pay',$this->input->post('Issue_Date'));
			$this->db->set('notes',$this->input->post('Note'));
			$this->db->where('Subscriber_id',$id);
			$this->db->update('kr_dis_payment');
			// to send email after successful payment confirmation*/
			$this->send_confirmation_distributor($id,$Amount);
		}
		 //$id=$this->session->userdata('id');
		 $data['title']   = 'National';
         $data['menu']    = 'national';
         $data['content'] = 'backend/national/distributers_payment';
         $this->load->view( 'backend/template', $data );
		 
	}
	
	/* get the list of subscribers based on filter*/
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
				 $data['title'] = 'National';
				 $data['menu'] = 'national';
				 $data['content'] = 'backend/national/subscribers_list_report';
				 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['subscriber'] = $this->common->subscribers_list($id,$type);
			 $data['title'] = 'National';
			 $data['menu'] = 'national';
			 $data['content'] = 'backend/national/subscribers_list_report';
			 $this->load->view( 'backend/template', $data );
		 }
	}
	
	/* export subscribers to excel*/
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
					
					$res_state_zone  			= $this->db->query("SELECT * FROM kr_users Where id='".$row1['State_zone_admin_id']."'");
					$res_state_zone_array       = $res_state_zone->result_array();
					$state_zone					= $res_state_zone_array[0]['Name'];
					
					$res_state  			    = $this->db->query("SELECT * FROM kr_users Where id='".$row1['State_admin_id']."'");
					$res_state_array	        = $res_state->result_array();
					$state						= $res_state_array[0]['Name'];
					
					$res_zone  			        = $this->db->query("SELECT * FROM kr_users Where id='".$row1['Zonal_admin_id']."'");
					$res_zone_array	       		= $res_zone->result_array();
					$zone						= $res_zone_array[0]['Name'];
					
					$res_national		        = $this->db->query("SELECT * FROM kr_users Where id='".$row1['National_admin_id']."'");
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
	public function deallocate_subscribers()
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
	public function deallocate_distributers()
	{
		 if($this->input->post())
		 {
			$County  = $this->input->post('state_zone');
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
		 $data['Zone']   = $this->common->state_zone_list($id,$type);
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
		if($this->uri->segment(3)!='')
		 {
			 $id = $this->uri->segment(3);
			 $data['zone']    = $this->common->zone_list_all($id);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/zone_list';
			 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['zone'] = $this->common->zone_list($id,$type);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/zone_list';
			 $this->load->view( 'backend/template', $data );
		 }
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
			$state_zone = $this->input->post('state_zone');
			$Distributers = $this->input->post('Distributers');
			for($i=0;$i<count($Distributers);$i++)
			{
				$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$state_zone."' ");
				$national_id = $res_nat->row_array();
				echo "UPDATE kr_users SET State_zone_admin_id='$state_zone',National_admin_id='".$national_id['National_admin_id']."',State_admin_id='".$national_id['State_admin_id']."',Zonal_admin_id='".$national_id['Zonal_admin_id']."' where id='".$Distributers[$i]."'";
				$res=$this->db->query("UPDATE kr_users SET State_zone_admin_id='$state_zone',National_admin_id='".$national_id['National_admin_id']."',State_admin_id='".$national_id['State_admin_id']."',Zonal_admin_id='".$national_id['Zonal_admin_id']."' where id='".$Distributers[$i]."'");
			}
			if($this->db->affected_rows()>0)
			{
				$this->session->set_flashdata('alert','success');
			}
		 }
		
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['state_zone']  = $this->common->state_zone_list($id,$type);
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
		 	$data['title'] = 'National';
        	$data['menu'] = 'national';
         	$data['content'] = 'backend/national/subscribers_list';
        	$this->load->view( 'backend/template', $data );
		}
	 	else
		{
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['subscriber'] = $this->common->subscribers_list($id,$type);
			 $data['title'] = 'National';
			 $data['menu'] = 'national';
			 $data['content'] = 'backend/national/subscribers_list';
			 $this->load->view( 'backend/template', $data );
		}
		 
	}
	
	
	
	/*Get List of Users */
	public function user_list()
	{
		 $filter 	= $this->input->post('filter');
		 $from_date = $this->input->post('from_date');
		 $to_date	= $this->input->post('to_date');
		  if(isset($_POST['filter'])){
				   $data['filter'] = $filter;
				   $this->session->set_userdata('filter',$filter);
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
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['users']   = $this->common->user_list_filter($type,$filter,$from_date,$to_date);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/user_list';
			 $this->load->view( 'backend/template', $data );

		 }
		 else
		 {
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['users']   = $this->common->user_list($id,$type);
			 $data['title']   = 'National';
			 $data['menu']    = 'national';
			 $data['content'] = 'backend/national/user_list';
			 $this->load->view( 'backend/template', $data );
		 }
	}
	
	/*Export Users */
	public function export_users()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$filter     = $this->session->userdata('filter');
		$from_date  = $this->session->userdata('from_date_selected');
		$to_date	= $this->session->userdata('to_date_selected');
		$type       = $this->session->userdata('role');

		$xcols=range('A','Z');
		if($filter !="")
		{
			$columns=array('ID','First Name','Address','Email','Home Phone','Cell Phone');
			foreach($columns as $ind=>$col)
			{
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
			}
			$results = $this->common->user_list_filter($type,$filter,$from_date,$to_date);
			$i=2;
			foreach($results as $result)
			{
				$res        = $this->db->query("SELECT * FROM kr_state WHERE id='".$result['State']."'");
				$res_array  = $res->result_array();
				$State      = @$res_array[0]['State_name'];
				$short_name = $result['First_name'];
				$mailing    = $result['Address1'].",".$result['Address2'].",".$State.",".$result['Zip'];
				$userid     = $result['id'];
				if($filter=='distributer')
				{
					$userid = $result['Distributer_id'];
				}
				$values     = array($userid,$result['First_name'],$mailing,$result['Email_address'],$result['Phone_Home'],$result['Phone_Cell']);
				//$values[]   = ($result['Subscriptions']==25)?'1 year':'2 year';
				$values[]   = $filter;
				/*$values[]=($result['airport_pick']==1)?'Yes':'No';
				$values[]=$result['arrival_date'];
				$counts=explode("#$",$result['counts']);
				$values[]=$counts[0];
				$values[]=$result['request'];*/
					
				foreach($values as $ind=>$val)
				{
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);
					if(in_array($xcols[$ind],array('C')))
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
	}
	
	public function export_all_subscribers()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		 $filter     = 1;//$this->session->userdata('filter');
		 $users      = $this->uri->segment('3');
		 $from_date  = $this->session->userdata('from_date_selected');
		 $to_date	 = $this->session->userdata('to_date_selected');
		$xcols=range('A','Z');
		$cnt=0;
		if($filter !="")
		{
			$columns=array('ID','First Name','Last Name','Mailing Address1','Mailing_address2','City','State','Zipcode','Email','Home Phone','Cell Phone','National Coordinator','Zone Coordinator','State Coordinator','State Zone Coordinator');

			foreach($columns as $ind=>$col)
			{
				
				if($ind<=25)
				{
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
				}
				else
				{
					$xcols[$ind]="A".$xcols[$cnt];
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
					$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
					$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
					$cnt++;
				}

			}
			/*$subscriber = $this->db->get('kr_subscribers')->result_array();
			$i=2;
			$res_cnt=0;
			foreach($subscriber as $ind=>$row)
            {*/
                $i=2;
				$this->db->join('kr_subscribers','kr_subscribers.Distributer_id=kr_users.id','right');
				$results = $this->db->get_where('kr_users')->result_array();
				
				
				foreach($results as $result)
				{
					
					
	                if(isset($result['National_admin_id']))
					{
						$national_coord   = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['National_admin_id']." ")->row_array();
					}
					if(isset($result['Zonal_admin_id']))
					{
						$zone_coord       = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['Zonal_admin_id']." ")->row_array();						
					}
					if(isset($result['State_admin_id']))
					{
						$state_coord      = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_admin_id']." ")->row_array();
					}
					if(isset($result['State_zone_admin_id']))
					{
						$state_zone_coord = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_zone_admin_id']." ")->row_array();	
					}
				
					$res_pay=$this->db->get_where('kr_payment',array('Subscriber_id'=>$result['id']))->row_array();
		
					$short_name = $result['First_name'];
					//$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];
					//$billing    = $result['BillingAddress1'].",".$result['BillingAddress2'].",".$result['BillingCity'].",".$result['BillingState'].",".$result['BillingZip'];

				   $values     = array($result['Subscriber_id'],$result['First_name'],$result['Last_name'],$result['Mailing_address1'],$result['Mailing_address2'],$result['City'],$result['State'],$result['Zipcode'],$result['Email_address'],$result['Home_phone'],$result['Cell_phone']);
					 
					 if(isset($result['National_admin_id'])){ $values[]   =$national_coord['First_name'];}else{ $values[]   ='';}
					 if(isset($result['Zonal_admin_id'])){  $values[]   =$zone_coord['First_name']; }else{ $values[]   ='';}
					 if(isset($result['State_admin_id'])){ $values[]   = $state_coord['First_name']; }else{ $values[]   ='';}
					 if(isset($result['State_zone_admin_id'])){ $values[]   = $state_zone_coord['First_name']; }else{ $values[]   ='';}
					
						
					foreach($values as $ind=>$val)
					{
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);
					if(in_array($xcols[$ind],array('D')))
					  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	
					}
					
					$i++;
				}	
				/*$res_cnt++;
			}	*/	
		}
		$this->session->unset_userdata('filter_id',$this->session->userdata('id'));
		$this->session->set_userdata('filter_type','national');
		
		$filename=$short_name.'_'.date('Ymd_His'); //save our workbook as this file name
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->setPreCalculateFormulas(false);
		//ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		
		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell bresultser what's the file name
		
		header('Cache-Control: max-age=0'); //no cache
		$objWriter->save('php://output');
		exit();
		//redirect('national/subscribers_list_report');
		
	}

	public function export_all_gift_subscribers()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		
		$xcols=range('A','Z');
		$cnt=0;
		$filter = 1;
		if($filter !="")
		{
			$columns=array('Subscriber ID','First Name','Last Name','Mailing Address1','Mailing_address2','City','State','Zipcode','Billing Address1','Billing Address 2','Billing City','Billing State','Billing Zip','Email','Home Phone','Cell Phone','Church name','Enter By','Created');

			foreach($columns as $ind=>$col)
			{
				
				if($ind<=25)
				{
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
				}
				else
				{
					$xcols[$ind]="A".$xcols[$cnt];
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
					$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
					$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
					$cnt++;
				}

			}
			$subscriber = $this->db->query("SELECT * FROM kr_gift_subscribers")->result_array();
			$i=2;
			//$res_cnt=0;
			foreach($subscriber as $ind=>$result)
            {
               

				   $values     = array($result['Subscriber_id'],$result['First_name'],$result['Last_name'],$result['Mailing_address1'],$result['Mailing_address2'],$result['City'],$result['State'],$result['Zipcode'],$result['BillingAddress1'],$result['BillingAddress2'],$result['BillingCity'],$result['BillingState'],$result['BillingZip'],$result['Email_address'],$result['Home_phone'],$result['Cell_phone'],$result['Church_name'],$result['Enter_by'],$result['created_date']);
					 
					 
						
					foreach($values as $ind=>$val)
					{
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);
					if(in_array($xcols[$ind],array('D')))
					  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	
					}
					
					$i++;
				}	
				
		}
		
		
		$filename=date('Ymd_His'); //save our workbook as this file name
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->setPreCalculateFormulas(false);
		//ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		
		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell bresultser what's the file name
		
		header('Cache-Control: max-age=0'); //no cache
		$objWriter->save('php://output');
		exit();
		//redirect('national/subscribers_list_report');
		
	}

	public function export_all_distributers()
	{
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		 $filter     = 1;//$this->session->userdata('filter');
		 $users      = $this->uri->segment('3');
		 $from_date  = $this->session->userdata('from_date_selected');
		 $to_date	 = $this->session->userdata('to_date_selected');
		$xcols=range('A','Z');
		$cnt=0;
		if($filter !="")
		{
			$columns=array('ID','First Name','Last Name','Mailing Address1','Mailing_address2','City','State','Zipcode','Email','Home Phone','Cell Phone','National Coordinator','Zone Coordinator','State Coordinator','State Zone Coordinator');
			foreach($columns as $ind=>$col)
			{
				if($ind<=25)
				{
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
				}
				else
				{
					$xcols[$ind]="A".$xcols[$cnt];
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);
					$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);
					$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');
					$cnt++;
				}
			}
			/*$subscriber = $this->db->get('kr_subscribers')->result_array();
			$i=2;
			$res_cnt=0;
			foreach($subscriber as $ind=>$row)
            {*/
                $i=2;
				$this->db->join('kr_distributers','kr_distributers.User_id=kr_users.id','right');
			    $results = $this->db->get_where('kr_users')->result_array();
				
				
				foreach($results as $result)
				{
					
					
	                if(isset($result['National_admin_id']))
					{
						$national_coord   = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['National_admin_id']." ")->row_array();
					}
					if(isset($result['Zonal_admin_id']))
					{
						$zone_coord       = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['Zonal_admin_id']." ")->row_array();						
					}
					if(isset($result['State_admin_id']))
					{
						$state_coord      = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_admin_id']." ")->row_array();
					}
					if(isset($result['State_zone_admin_id']))
					{
						$state_zone_coord = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_zone_admin_id']." ")->row_array();	
					}
				
					$res_pay=$this->db->get_where('kr_dis_payment',array('Subscriber_id'=>$result['login_id']))->row_array();
		
					$short_name = $result['First_name'];
					//$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];
					//$billing    = $result['BillingAddress1'].",".$result['BillingAddress2'].",".$result['BillingCity'].",".$result['BillingState'].",".$result['BillingZip'];
					$values     = array($result['login_id'],$result['First_name'],$result['Last_name'],$result['Mailing_address1'],$result['Mailing_address2'],$result['City'],$result['State'],$result['Zipcode'],$result['Email_address'],$result['Home_phone'],$result['Cell_phone']);
					 if(isset($result['National_admin_id'])){ $values[]   =$national_coord['First_name'];}else{ $values[]   ='';}
					 if(isset($result['Zonal_admin_id'])){  $values[]   =$zone_coord['First_name']; }else{ $values[]   ='';}
					 if(isset($result['State_admin_id'])){ $values[]   = $state_coord['First_name']; }else{ $values[]   ='';}
					 if(isset($result['State_zone_admin_id'])){ $values[]   = $state_zone_coord['First_name']; }else{ $values[]   ='';}
					
					
						
					foreach($values as $ind=>$val)
					{
					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);
					if(in_array($xcols[$ind],array('D')))
					  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	
					}
					
					$i++;
				}	
				/*$res_cnt++;
			}	*/	
		}
		$this->session->unset_userdata('filter_id',$this->session->userdata('id'));
		$this->session->set_userdata('filter_type','national');
		
		$filename=$short_name.'_'.date('Ymd_His'); //save our workbook as this file name
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->setPreCalculateFormulas(false);
		//ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
		
		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell bresultser what's the file name
		
		header('Cache-Control: max-age=0'); //no cache
		$objWriter->save('php://output');
		exit();
		//redirect('national/subscribers_list_report');
		
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
			$all_county	= $this->input->post('all_county');
			
			$address1   = $this->input->post('address1');
			$address2   = $this->input->post('address2');
			$state		= $this->input->post('state');
			$zip		= $this->input->post('zip');
			$phone_home	= $this->input->post('phone_home');
			$phone_cell	= $this->input->post('phone_cell');
			
			if($formtype=='Add')
			{
				$resulr_exist = $this->db->query("SELECT * FROM kr_users WHERE Email_address='$email' ");
				if($resulr_exist->num_rows()>0)
				{
					$this->session->set_flashdata('alert','Error');
				}
				else
				{
					if($admin_type=='state')
					{
					    $resulr_exist_state = $this->db->query("SELECT * FROM kr_state WHERE State_admin_id!='0' ");
						if($resulr_exist_state->num_rows()>0)
						{
							$this->session->set_flashdata('alert1','Error');
						}
					}
					else
					{
						$this->db->query("INSERT INTO kr_users( `First_name`, `Email_address`, `Password`, `Address1`, `Address2`, `State`, `Zip`, `Phone_Home`, `Phone_Cell`, `National_admin_id`, `State_admin_id`, `Zonal_admin_id`,`admin_type`) VALUES('$First_name','$email','$password','$address1','$address2','$state','$zip','$phone_home','$phone_cell','$id','$State','$Zone','$admin_type') ");
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
								$State_id =$this->db->insert_id();
								$resZone    = $this->db->query("SELECT * FROM kr_state WHERE `id`='$state'");
								$zone_array = $resZone->result_array();
								$Zone_id 	= $zone_array['0']['Zone_id'];
								$this->db->query("UPDATE kr_users SET `Zonal_admin_id`='$Zone_id' WHERE id='".$State_id."'");
								$this->db->query("UPDATE kr_state SET `State_admin_id`='$State_id' WHERE id='".$Zone_id."'");
							}
							if($admin_type=='state_zone')
							{
								$State_id =$this->db->insert_id();
								$resZone    = $this->db->query("SELECT * FROM kr_state WHERE `id`='$state'");
								$zone_array = $resZone->result_array();
								$Zone_id 	= $zone_array['0']['Zone_id'];
								for($i=0;$i<count($all_county);$i++)
								{
									$this->db->query("UPDATE kr_users SET `State_zone_admin_id`='$State_id',Zonal_admin_id='$Zone_id' WHERE id='".$all_county[$i]."'");
								}
							}
							if($admin_type=='Distributer')
							{
								$Zone_id =$this->db->insert_id();
								
									$this->db->query("UPDATE kr_users SET `Distributer_id`='".sprintf("DIS%05s",$Zone_id)."' WHERE id='".$Zone_id."'");
							}
							$this->session->set_flashdata('alert','success');
						}
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
	

	/* to send confirmation email after successful payment updation*/
	function send_confirmation_distributor($id,$amount)
	{

         
					$row=$this->db->query("SELECT * FROM kr_distributers b inner join kr_users c on c.login_id=b.disributer_id Where b.disributer_id='".$id."'")->row_array();
					$Email=$row['Email_address'];
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
					$mailContent.='<p>Hi '.$row['First_name'].',<br></p>';
					$mailContent.='<p>Your Payment <bold> Verified </bold> successfully. <br>Duration : '.$row['Subscriptions'].'Months <br>Amount: $'.$amount.'<br>Method of payment: '.$row['Mode_of_payment'].' <br>Number of copies: '.$row['Copies_requested'] .'</p>';
					$mailContent.='<p>You can update data using the below credentials <br>Username : '.$row['Email_address'].'<br>Password: '.$row['Password'].'<br></p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
					Kingdom Revelator USA</p>
					</td>
					</tr>
					</table>';
					/*echo $mailContent;
					exit();*/
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();
					
	}	
	
	/* to send confirmation email after successful payment updation*/
	function send_confirmation_subscriber($id,$amount)
	{

         
					$row=$this->db->query("SELECT * FROM kr_subscribers where id='$id' ")->row_array();
					$Email=$row['Email_address'];
					$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
						
					//print_r($smtp);	
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
					$mailContent.='<p>Your Payment <bold> Verified </bold> successfully. <br>Duration : '.$row['subscription_length'].' <br>Amount: $'.$amount.'<br>Method of payment: '.$row['Mode_of_payment'].' <br></p>';
					$mailContent.='<p>You can update data using the below credentials <br>Username : '.$row['Email_address'].'<br>Password: '.$row['Password'].'<br></p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
					Kingdom Revelator USA</p>
					</td>
					</tr>
					</table>';
					/*echo "<pre>";
					print_r($this->email);
					echo "</pre>";
					echo $mailContent;
					exit();*/
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();
					
	}	

	// view order detail page
	public function subs_order_details($orderid,$id,$distrib)
	{
		if($this->session->userdata('role') !='webadmin')
			redirect('','refresh');
			

        
         $data['title'] = 'Order Details';
         $data['menu']  = 'webadmin';
         $data['distributer'] = $distrib;
//echo $orderid;
         $data['orders'] = $this->Subscriber_model->order_details($orderid,$id); // to get individual order details
//pr($data);
         $data['content'] = 'backend/national/subs_order_details';
         $this->load->view( 'backend/template', $data );  

	}
    
    // payment update popup - subscriber

    public function subs_modal_payment_update()
    {

          
         $paymentid = $this->input->post('paymentid');
         $data['orderid'] = $this->input->post('orderid');
         $data['subsid'] = $this->input->post('subsid');
         $data['distid'] = $this->input->post('distid');
         $data['paymentdetails'] = $this->Subscriber_model->payment_details($paymentid); // to get individual payment details
         $this->load->view('backend/national/subs_payment_update_form',$data);

    }

    // payment update process - subscriber

    public function subs_payment_update_process()
    {

          
         $data = $this->input->post(NULL,TRUE);
         $res = $this->Subscriber_model->payment_update_process($data);
         $vars = explode("#", $data['urlids']);
        
         if($res == true)
         {

           $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		   $row=$this->db->query("SELECT * FROM kr_subscribers where id='$vars[1]' ")->row_array();
		   $Email=$row['Email_address'];
		   $name = $row['First_name'];
		   $orders = 	$this->Subscriber_model->order_details(sha1($vars[0]),$vars[1]);
		   $payments = $this->Subscriber_model->payment_details($data['id']);
		  
					//print_r($smtp);	
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
					$mailContent.='<p>Hi '.$name .',<br></p>';
					$mailContent.='<p>Your Payment <bold> Verified </bold> successfully. <br>Payment status : '.$payments['paypal_status'].'<br>Subscription start date : '.$orders['subscription_date'].'<br>Expiry date : '.$orders['expiry_date'].' <br>Duration : '.$orders['subscription_length'].' <br>Number of copies: '.$orders['No_of_copies'].' <br><br>Amount: $'.$payments['paid_amnt'].'</p>';

					$mailContent.='<p>Please login to your account for more details.</p>';
					$mailContent.='</p>';	
					$mailContent.='<p>Administrator,<br>
					Kingdom Revelator USA</p>
					</td>
					</tr>
					</table>';
				
					$this->email->subject('Message from Kingdom Revelator USA');
					$this->email->message($mailContent);
					$this->email->send();


         	$this->session->set_flashdata('payment','updated');
             redirect('national/subs_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2],'refresh');
         }
         else
         {
         	$this->session->set_flashdata('payment','cancel');
             redirect('national/subs_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2],'refresh');
         }

    }



    // refund update popup - subscriber

    public function subs_modal_refund_update()
    {

          
         $paymentid = $this->input->post('paymentid');
         $data['orderid'] = $this->input->post('orderid');
         $data['subsid'] = $this->input->post('subsid');
         $data['distid'] = $this->input->post('distid');
         $data['paymentdetails'] = $this->Subscriber_model->payment_details($paymentid); // to get individual payment details
         $this->load->view('backend/national/subs_refund_update_form',$data);

    }

    // payment update process- subscriber

    public function subs_refund_update_process()
    {

          
         $data = $this->input->post(NULL,TRUE);
         $res = $this->Subscriber_model->refund_update_process($data);
         $vars = explode("#", $data['urlids']);
         if($res == true)
         {

            $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		   $row=$this->db->query("SELECT * FROM kr_subscribers where id='$vars[1]' ")->row_array();
		   $Email=$row['Email_address'];
		   $name = $row['First_name'];
		   $orders = 	$this->Subscriber_model->order_details(sha1($vars[0]),$vars[1]);
		   $payments = $this->Subscriber_model->payment_details($data['id']);
		 // pr($payments);
					//print_r($smtp);	
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
					$mailContent.='<p>Hi '.$name .',<br></p>';
					$mailContent.='<p>Your refund <bold> processed </bold> successfully for below order. <br>Payment status : '.$payments['paypal_status'].'<br>Subscription start date : '.$orders['subscription_date'].'<br>Expiry date : '.$orders['expiry_date'].' <br>Duration : '.$orders['subscription_length'].' <br>Number of copies: '.$orders['No_of_copies'].' <br><br>Refund Amount: $'.$payments['refund_amnt'].'<br>Refund date: '.$payments['refund_date'].'</p>';

					$mailContent.='<p>Please login to your account for more details.</p>';
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


         	$this->session->set_flashdata('payment','updated');
             redirect('national/subs_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2],'refresh');
         }
         else
         {
         	$this->session->set_flashdata('payment','cancel');
             redirect('national/subs_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2],'refresh');
         }

    }


 // order cancel subscriber
    public function subs_modal_cancel_form()
    {

          
        
         $data['orderid'] = $this->input->post('orderid');
         $data['subsid'] = $this->input->post('subsid');
         $data['distid'] = $this->input->post('distid');
         $this->load->view('backend/national/subs_order_cancel_form',$data);

    }

// order cancel process
    public function subs_modal_cancel_process()
    {

          
        
         $data = $this->input->post(NULL,TRUE);
         $res = $this->Subscriber_model->order_cancel_process($data);
         $vars = explode("#", $data['urlids']);
         if($res == true)
         {

            $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		   $row=$this->db->query("SELECT * FROM kr_subscribers where id='$vars[1]' ")->row_array();
		   $Email=$row['Email_address'];
		   $name = $row['First_name'];
		   $orders = 	$this->Subscriber_model->order_details(sha1($vars[0]),$vars[1]);
		 
					//print_r($smtp);	
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
					$mailContent.='<p>Hi '.$name .',<br></p>';
					$mailContent.='<p>Your order is <bold> cancelled</bold>. Order details are as follows : <br>Subscription start date : '.$orders['subscription_date'].'<br>Expiry date : '.$orders['expiry_date'].' <br>Duration : '.$orders['subscription_length'].' <br>Number of copies: '.$orders['No_of_copies'].'</p>';

					$mailContent.='<p>Please login to your account for more details.</p>';
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


         	$this->session->set_flashdata('order','cancelled');
             redirect('national/subscribers_payment/'.$vars[1].'/'.$vars[2],'refresh');
         }
         else
         {
         	$this->session->set_flashdata('order','error');
             redirect('national/subscribers_payment/'.$vars[1].'/'.$vars[2],'refresh');
         }

    }


// order history subscriber
    public function subs_modal_order_history()
    {

          
        
         $orderid = $this->input->post('orderid');
         $data['history'] = $this->Subscriber_model->order_history(sha1($orderid));
         
         $this->load->view('backend/national/subs_order_history',$data);

    }


    ////////////////////////////// distributer ///////////////////////////////

    // view order detail page
	public function dist_order_details($orderid,$distcode,$zoneid,$distid)
	{
		if($this->session->userdata('role') !='webadmin')
			redirect('','refresh');
			

        
         $data['title'] = 'Order Details';
         $data['menu']  = 'webadmin';
         $data['distributer'] = $distid;
//echo $orderid;
         $data['orders'] = $this->Distributer_model->order_details($orderid,$distcode); // to get individual order details
//pr($data);
         $data['content'] = 'backend/national/dist_order_details';
         $this->load->view( 'backend/template', $data );  

	}
    
    // payment update popup - distributer

    public function dist_modal_payment_update()
    {

          
         $paymentid = $this->input->post('paymentid');
         $data['orderid'] = $this->input->post('orderid');
         $data['distcode'] = $this->input->post('distcode');
          $data['zoneid'] = $this->input->post('zoneid');
         $data['distid'] = $this->input->post('distid');
         $data['paymentdetails'] = $this->Distributer_model->payment_details($paymentid); // to get individual payment details
         $this->load->view('backend/national/dist_payment_update_form',$data);

    }

    // payment update process - distributer

    public function dist_payment_update_process()
    {

          
         $data = $this->input->post(NULL,TRUE);
         $res = $this->Distributer_model->payment_update_process($data);
         $vars = explode("#", $data['urlids']);
       // pr($vars);exit;
         if($res == true)
         {

           $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		   $row=$this->db->query("SELECT * FROM kr_distributers where disributer_id='$vars[1]' ")->row_array();
		  // pr($row);exit;
		   $Email=$row['Email_address'];
		   $name = $row['First_name'];
		   $orders = 	$this->Distributer_model->order_details(sha1($vars[0]),$vars[1]);
		   $payments = $this->Distributer_model->payment_details($data['id']);
		  //pr($orders);
		  //pr($payments);exit;
					//print_r($smtp);	
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
					$mailContent.='<p>Hi '.$name .',<br></p>';
					$mailContent.='<p>Your Payment <bold> Verified </bold> successfully. <br>Payment status : '.$payments['paypal_status'].'<br>Subscription start date : '.$orders['subscription_date'].'<br>Expiry date : '.$orders['expiry_date'].' <br>Duration : '.$orders['subscription_length'].' <br>Number of copies: '.$orders['No_of_copies'].' <br><br>Amount: $'.$payments['paid_amnt'].'</p>';

					$mailContent.='<p>Please login to your account for more details.</p>';
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


         	$this->session->set_flashdata('payment','updated');
             redirect('national/dist_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2].'/'.$vars[3],'refresh');
         }
         else
         {
         	$this->session->set_flashdata('payment','cancel');
             redirect('national/dist_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2].'/'.$vars[3],'refresh');
         }

    }



    // refund update popup - distributer

    public function dist_modal_refund_update()
    {

          
         $paymentid = $this->input->post('paymentid');
         $data['orderid'] = $this->input->post('orderid');
         $data['distcode'] = $this->input->post('distcode');
          $data['zoneid'] = $this->input->post('zoneid');
         $data['distid'] = $this->input->post('distid');
         $data['paymentdetails'] = $this->Distributer_model->payment_details($paymentid); // to get individual payment details
         $this->load->view('backend/national/dist_refund_update_form',$data);

    }

    // payment update process- distributer

    public function dist_refund_update_process()
    {

          
         $data = $this->input->post(NULL,TRUE);
         $res = $this->Distributer_model->refund_update_process($data);
         $vars = explode("#", $data['urlids']);
         if($res == true)
         {

            $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		   $row=$this->db->query("SELECT * FROM kr_distributers where disributer_id='$vars[1]' ")->row_array();
		   $Email=$row['Email_address'];
		   $name = $row['First_name'];
		   $orders = 	$this->Distributer_model->order_details(sha1($vars[0]),$vars[1]);
		   $payments = $this->Distributer_model->payment_details($data['id']);
		 // pr($payments);
					//print_r($smtp);	
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
					$mailContent.='<p>Hi '.$name .',<br></p>';
					$mailContent.='<p>Your refund <bold> processed </bold> successfully for below order. <br>Payment status : '.$payments['paypal_status'].'<br>Subscription start date : '.$orders['subscription_date'].'<br>Expiry date : '.$orders['expiry_date'].' <br>Duration : '.$orders['subscription_length'].' <br>Number of copies: '.$orders['No_of_copies'].' <br><br>Refund Amount: $'.$payments['refund_amnt'].'<br>Refund date: '.$payments['refund_date'].'</p>';

					$mailContent.='<p>Please login to your account for more details.</p>';
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


         	$this->session->set_flashdata('payment','updated');
             redirect('national/dist_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2].'/'.$vars[3],'refresh');
         }
         else
         {
         	$this->session->set_flashdata('payment','cancel');
             redirect('national/dist_order_details/'.sha1($vars[0]).'/'.$vars[1].'/'.$vars[2].'/'.$vars[3],'refresh');
         }

    }


 // order cancel distributer
    public function dist_modal_cancel_form()
    {

          
        
         $data['orderid'] = $this->input->post('orderid');
         $data['distcode'] = $this->input->post('distcode');
          $data['zoneid'] = $this->input->post('zoneid');
         $data['distid'] = $this->input->post('distid');
         $this->load->view('backend/national/dist_order_cancel_form',$data);

    }

// order cancel process
    public function dist_modal_cancel_process()
    {

          
        
         $data = $this->input->post(NULL,TRUE);
         $res = $this->Distributer_model->order_cancel_process($data);
         $vars = explode("#", $data['urlids']);
         if($res == true)
         {

            $smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		   $row=$this->db->query("SELECT * FROM kr_distributers where disributer_id='$vars[1]' ")->row_array();
		   $Email=$row['Email_address'];
		   $name = $row['First_name'];
		   $orders = 	$this->Distributer_model->order_details(sha1($vars[0]),$vars[1]);
		 //pr($row);
		 //pr($orders);exit;
					//print_r($smtp);	
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
					$mailContent.='<p>Hi '.$name .',<br></p>';
					$mailContent.='<p>Your order is <bold> cancelled</bold>. Order details are as follows : <br>Subscription start date : '.$orders['subscription_date'].'<br>Expiry date : '.$orders['expiry_date'].' <br>Duration : '.$orders['subscription_length'].' <br>Number of copies: '.$orders['No_of_copies'].'</p>';

					$mailContent.='<p>Please login to your account for more details.</p>';
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


         	$this->session->set_flashdata('order','cancelled');
             redirect('national/distributers_payment/'.$vars[1].'/'.$vars[2].'/'.$vars[3],'refresh');
         }
         else
         {
         	$this->session->set_flashdata('order','error');
             redirect('national/distributers_payment/'.$vars[1].'/'.$vars[2].'/'.$vars[3],'refresh');
         }

    }


// order history distributer
    public function dist_modal_order_history()
    {

          
        
         $orderid = $this->input->post('orderid');
         $data['history'] = $this->Distributer_model->order_history(sha1($orderid));
         
         $this->load->view('backend/national/dist_order_history',$data);

    }
	
}

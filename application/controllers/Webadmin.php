<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Webadmin extends CI_Controller {



	/*

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

	function __construct() {

     parent::__construct();

	  // $this->load->model('Settings_model','settings');

	   //$this->load->model('Users_model','users');

	    $this->session->set_flashdata('alert', '');

	    if ( $this->session->userdata('role') == '')

     {

            redirect( '', 'refresh' );

           }

	    $this->load->library('form_validation');

        $this->load->helper('form');

		$this->load->helper('url');  

		$this->load->library('upload');

		$this->load->model('webadmin_model','webadmin');

    }

	public function index()

	{

		 //$id=$this->session->userdata('id');

		 $data['title'] = 'Web Admin';

         $data['menu']  = 'webadmin';

         $data['content'] = 'backend/webadmin/home';

         $this->load->view( 'backend/template', $data );

		 

	}

	

	/* list of nwes letter subscribers*/

	function subscribers_newsletters()

	{

		 $data['subscriber'] = $this->db->get('kr_news_letter')->result_array();

		 $data['title']      = 'Web Admin';

         $data['menu']       = 'webadmin';

         $data['content']    = 'backend/webadmin/subscribers_newsletters';

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

				 $data['title'] = 'Web Admin';

				 $data['menu'] = 'webadmin';

				 $data['content'] = 'backend/webadmin/subscribers_list_report';

				 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['subscriber'] = $this->common->subscribers_list($id,$type);

			 $data['title'] = 'Web Admin';

			 $data['menu'] = 'webadmin';

			 $data['content'] = 'backend/webadmin/subscribers_list_report';

			 $this->load->view( 'backend/template', $data );

		 }

	}

	public function subscribers_gift_list_report()

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

				 $data['title'] = 'Web Admin';

				 $data['menu'] = 'webadmin';

				 $data['content'] = 'backend/webadmin/subscribers_gift_list_report';

				 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');


			 $data['subscriber'] = $this->common->subscribers_gift_list($id,$type);

			 $data['title'] = 'Web Admin';

			 $data['menu'] = 'webadmin';

			 $data['content'] = 'backend/webadmin/subscribers_gift_list_report';

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

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/state_zone_list';

			 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['state_zone'] = $this->common->state_zone_list($id,$type);

			 $data['title']      = 'Web Admin';

			 $data['menu']       = 'webadmin';

			 $data['content']    = 'backend/webadmin/state_zone_list';

			 $this->load->view('backend/template',$data);

		 }

	}

	

	/*Get List of Subscribers  */

	public function subscribers_list()

	{

		if($this->uri->segment(3)!='')

		{

			$id = $this->uri->segment(3);

		 	$data['subscriber'] = $this->common->subscribers_list_all($id);

		 	$data['title'] = 'Web Admin';

        	$data['menu']  = 'webadmin';

         	$data['content'] = 'backend/webadmin/subscribers_list';

        	$this->load->view( 'backend/template', $data );

		}

	 	else

		{

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['subscriber'] = $this->common->subscribers_list($id,$type);

			 $data['title'] = 'Web Admin';

			 $data['menu']  = 'webadmin';

			 $data['content'] = 'backend/webadmin/subscribers_list';

			 $this->load->view( 'backend/template', $data );

		}

		 

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

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/user_list';

         $this->load->view( 'backend/template', $data );

	}

	

	/* set deallocate subscriber*/

	public function deallocate_subscribers()

	{

		$state_id = $this->uri->segment('3');



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

			redirect('national/state_zone_list/'.$state_id);

		 }

		

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['Distibuter']   = $this->common->distributer_list($id,$type,$state_id);

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/deallocate_subscriber';

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

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/deallocate_state';

         $this->load->view( 'backend/template', $data );

	}

	

	/* set deallocate distributer*/

	public function deallocate_distributers()

	{

		$state_id = $this->uri->segment('3');

		 if($this->input->post())

		 {

			$County  = $this->input->post('state_zone');

			$Distibuters = $this->input->post('Distibuters');

			//$state_id     = $this->input->post('state_zone_id');

			

				//$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$State[$i]."' ");

				//	$national_id = $res_nat->row_array();

				$res=$this->db->query("UPDATE kr_users SET State_zone_admin_id='0',flag='0' where id NOT IN ( '" . @implode($Distibuters, "', '") . "' ) and State_zone_admin_id='$County'");

				//$this->db->query("UPDATE kr_users SET $State_admin_id='".$State[$i]."' where County_admin_id='".$County."'");

			if($this->db->affected_rows()>0)

			{

				$this->session->set_flashdata('alert','success');

			}

			redirect('national/state_zone_list/'.$state_id);

		 }

		

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['Zone']   = $this->common->state_zone_list($id,$type,$state_id);

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/deallocate_distributer';

         $this->load->view( 'backend/template', $data );

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

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/user_list';

			 $this->load->view( 'backend/template', $data );

		}

		else

		{

			 $id = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['users']   = $this->common->user_list($id,$type);

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

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

	

	/* set discount*/

	public function discount()

	{

		if($this->input->post())

		{

		 $above10      = $this->input->post('above10');

		 $above20      = $this->input->post('above20');

		 $above30      = $this->input->post('above30');

		 $min_cpy      = $this->input->post('min_cpy');

		 $price_cpy    = $this->input->post('price_cpy');

		 $price_1_yr   = $this->input->post('price_1_yr');

		 $price_2_yr   = $this->input->post('price_2_yr');

		 $this->db->query("UPDATE kr_book_price SET 1_yr_price='$price_1_yr',2_yr_price='$price_2_yr' WHERE id='1'");

		 $this->db->query("UPDATE kr_discount SET above10='$above10',above20='$above20',above30='$above30',min_cpy='$min_cpy',price_cpy='$price_cpy'  WHERE id='1'");

		 if($this->db->affected_rows()>0)

		 {

			 $this->session->set_flashdata('alert','success');

		 }

		}

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/discount';

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

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/user_add';

         $this->load->view( 'backend/template', $data );

	}

	

	/* Assign distributer to county */

	public function assign_distributers()

	{

		$state_id = $this->uri->segment('3');

		 if($this->input->post())

		 {

			$state_zone   = $this->input->post('state_zone');

			$Distributers = $this->input->post('Distributers');

			$state_id     = $this->input->post('state_zone_id');

			for($i=0;$i<count($Distributers);$i++)

			{

				$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='".$state_zone."' ");

				$national_id = $res_nat->row_array();

				$res=$this->db->query("UPDATE kr_users SET State_zone_admin_id='$state_zone',National_admin_id='".$national_id['National_admin_id']."',State_admin_id='".$national_id['State_admin_id']."',Zonal_admin_id='".$national_id['Zonal_admin_id']."' where id='".$Distributers[$i]."'");

			}

			if($this->db->affected_rows()>0)

			{

				$this->session->set_flashdata('alert','success');

			}

			redirect('national/state_zone_list/'.$state_id);

		 }

		

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['state_zone']        = $this->common->state_zone_list($id,$type,$state_id);

		 $data['distributer'] = $this->common->unassign_distributers($state_id);

		 $data['title']   = 'Web Admin';

		 $data['menu']    = 'webadmin';

		 $data['content'] = 'backend/webadmin/assign_distributer';

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

				$this->db->query("UPDATE kr_state SET Zone_id='$Zone' where id='".$State[$i]."'");

				$res=$this->db->query("UPDATE kr_users SET Zonal_admin_id='$Zone' where id='".$State[$i]."'");

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

		 $data['title']   = 'Web Admin';

		 $data['menu']    = 'webadmin';

		 $data['content'] = 'backend/webadmin/assign_state';

		 $this->load->view( 'backend/template', $data );

	}

	

	/* Assign subscribers distributer */

	public function assign_subscribers()

	{

		 $state_id = $this->uri->segment('3');

		 if($this->input->post())

		 {

			$distributer = $this->input->post('distributer');

			$Subscribers = $this->input->post('Subscribers');

			//echo $state_id     = $this->input->post('state_zone_id');

			for($i=0;$i<count($Subscribers);$i++)

			{

				$res=$this->db->query("UPDATE kr_subscribers SET Distributer_id='$distributer' where id='".$Subscribers[$i]."'");

			}

			if($this->db->affected_rows()>0)

			{

				$this->session->set_flashdata('alert','success');

			}

			redirect('national/state_zone_list/'.$state_id);

		 }

		

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['distributer'] = $this->common->distributer_list($id,$type,$state_id);

		 $data['subscribers'] = $this->common->unassign_subscribers($state_id);

		 $data['title']   = 'Web Admin';

		 $data['menu']    = 'webadmin';

		 $data['content'] = 'backend/webadmin/assign_subscribers';

		 $this->load->view( 'backend/template', $data );

	}

	

	/*Get List of county admin under national*/

	public function county_list()

	{

		 if($this->uri->segment(3)!='')

		 {

			 $id = $this->uri->segment(3);

			 $data['county']    = $this->common->county_list_all($id);

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/county_list';

			 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['county'] = $this->common->county_list($id,$type);

			 $data['title'] = 'Web Admin';

			 $data['menu'] = 'webadmin';

			 $data['content'] = 'backend/webadmin/county_list';

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

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/distributer_list';

			 $this->load->view( 'backend/template', $data );

		}

	 	else

		{

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['distributer'] = $this->common->distributer_list($id,$type);

			 $data['title'] = 'Web Admin';

			 $data['menu'] = 'webadmin';

			 $data['content'] = 'backend/webadmin/distributer_list';

			 $this->load->view( 'backend/template', $data );

		}

	}

	

	/*Get List of zone admin under national*/

	public function zone_list_all()

	{

		 $id = $this->session->userdata('id');

		 $data['zone']    = $this->common->zone_list_all($id);

		 $data['title']   = 'Web Admin';

         $data['menu']    = 'webadmin';

         $data['content'] = 'backend/webadmin/zone_list';

         $this->load->view( 'backend/template', $data );

	}

	

	/*Get List of zone admin under national*/

	public function zone_list()

	{

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['zone'] = $this->common->zone_list($id,$type);

		 $data['title']   = 'Web Admin';

		 $data['menu']    = 'webadmin';

		 $data['content'] = 'backend/webadmin/zone_list';

		 $this->load->view( 'backend/template', $data );

	}

	

	

	/*Get List of national admin under national*/

	public function national_list()

	{

		 $id   = $this->session->userdata('id');

		 $type = $this->session->userdata('role');

		 $data['national'] = $this->common->national_list($id,$type);

		 $data['title']   = 'Web Admin';

		 $data['menu']    = 'webadmin';

		 $data['content'] = 'backend/webadmin/national_list';

		 $this->load->view( 'backend/template', $data );

	}

	

	

	/*Get List of zone admin under state*/

	public function state_list_all()

	{

		 $id = $this->uri->segment(3);

		 $data['state'] = $this->common->state_list_all($id);

		 $data['title'] = 'Web Admin';

         $data['menu'] = 'webadmin';

         $data['content'] = 'backend/webadmin/state_list';

         $this->load->view( 'backend/template', $data );

	}

	

	/*Get List of zone admin under state*/

	public function state_list()

	{

		if($this->uri->segment(3)!='')

		 {

			 $id = $this->uri->segment(3);

			 $data['state']    = $this->common->state_list_all($id);

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/state_list';

			 $this->load->view( 'backend/template', $data );

		 }

		 else

		 {

			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['state']    = $this->common->state_list($id,$type);

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/state_list';

			 $this->load->view( 'backend/template', $data );

		 }

	}

	

	/*Get List of zone admin under state*/

	public function mail_setting()

	{

		     $input = $this->input->post(NULL,TRUE);

			 //print_r($input);

			 if($this->input->post())

			 {

				$this->db->where('id',1);

				$this->db->update('smtp_config',$input);	

				$this->session->set_flashdata('alert','success');

			 }

			

			 $data['title']   = 'Web Admin';

			 $data['menu']    = 'webadmin';

			 $data['content'] = 'backend/webadmin/mail_setting';

			 $this->load->view( 'backend/template', $data );

	}

	

	public function changestyle()

	{



		 if($this->input->post())

		{

			$MenuBackground		=	$this->input->post('MenuBackground');

			$MenuColor		    =	$this->input->post('MenuColor');

			$HeaderText		    =	$this->input->post('HeaderText');

			$Bookurl	     	=	str_replace("'", "", $this->input->post('Bookurl'));

			$label_color		=	$this->input->post('label_color');

			$FooterColor		=	$this->input->post('FooterColor');
			
			$FooterFontColor	=	$this->input->post('Footerfontcolor');
			
			$AboutTitleColor    =	$this->input->post('Abouttitlecolor');
			
			$AboutDesColor    =	$this->input->post('Aboutdescolor');
			
			$PatronNameColor    =	$this->input->post('Patronnamecolor');
			
			/*$KsoftLinkColor    =	$this->input->post('Ksoftlinkcolor');*/
			
			$old_mimage			=   $this->input->post('old_mimage');

			$old_bookimage		=   $this->input->post('old_bookimage');

			$old_banner			=	$this->input->post('old_banner');

			

			if($_FILES['bannerimage']['name']!='')

			{

				

				 $config['upload_path']          = './img/';

				 $config['allowed_types']        = 'gif|jpg|png';

				 //$config['max_size']             = 2024;

				 $config['overwrite']			  = true;

				 $config['file_name']            = 'banner';

				

				 

				 $this->upload->initialize($config); 

				 if($this->upload->do_upload('bannerimage'))

				 {

					$banner='img/'.$this->upload->data('file_name');

				 }

				 else

				 {

				    $error = array('error' => $this->upload->display_errors());

					print_r($error);

				 }



			}

			else

			{

				$banner=$old_banner;

			}

			

			if($_FILES['mimage']['name']!='')

			{

				

				 $config['upload_path']          = './background/';

				 $config['allowed_types']        = 'gif|jpg|png';

				 //$config['max_size']             = 2024;

				 $config['overwrite']			  = true;

				 $config['file_name']            = 'backgroundimg';

				

				 

				 $this->upload->initialize($config); 

				 if($this->upload->do_upload('mimage'))

				 {

					$BackgroundImage='background/'.$this->upload->data('file_name');

				 }

				 else

				 {

				    $error = array('error' => $this->upload->display_errors());

					print_r($error);

				 }



			}

			else

			{

				$BackgroundImage=$old_mimage;

			}

			if($_FILES['bookimage']['name']!='')

			{

				

				 $config1['upload_path']          = './bookimage/';

				 $config1['allowed_types']        = 'gif|jpg|png';

				 $config1['max_size']             = 2024;

				 $config1['overwrite']			  = true;

				 $config1['file_name']            = 'bookimage';

				

				 $this->upload->initialize($config1); 

				 if($this->upload->do_upload('bookimage'))

				 {

						$file_pathBookImage='bookimage/'.$this->upload->data('file_name');

				 }

				 else

				 {

				    $error = array('error' => $this->upload->display_errors());

					//print_r($error);

				 }

			}

			else

			{

				$file_pathBookImage=$old_bookimage;

			}

			$this->db->query("UPDATE `kr_style` SET `BackgroundImage`='$BackgroundImage',`BookImage`='$file_pathBookImage',`MenuBackgorund`='$MenuBackground',`MenuColor`='$MenuColor',`label_color`='$label_color',`HeaderText`='$HeaderText',`FooterColor`='$FooterColor',`Footerfontcolor`='$FooterFontColor',`Abouttitlecolor`='$AboutTitleColor',`Aboutdescolor`='$AboutDesColor',`Patronnamecolor`='$PatronNameColor',banner='$banner',`Bookurl`='$Bookurl' WHERE id='1'");

			if($this->db->affected_rows()>0)

			{

				$this->session->set_flashdata('alert','success');

			}

		}

		 

		 $data['title'] = 'Web Admin';

         $data['menu']  = 'webadmin';

         $data['content'] = 'backend/webadmin/changestyle';

         $this->load->view( 'backend/template', $data );

	}

	

	public function export()

	{

		

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		$filter     = 1;//$this->session->userdata('filter');

		$users      = $this->session->userdata('filter_type');

		if($this->session->userdata('filter_type')=='')

		{

			$this->session->set_userdata('filter_type',$this->session->userdata('role'));

		}

		$xcols=range('A','Z');

		if($filter !="")

		{

			

			if(in_array($this->session->userdata('role'),array('webadmin','finance')))

			{

				$columns=array('ID','First Name','Last Name','Role','Mailing Address','Email','Home Phone','Cell Phone','National Coordinator','Zone Coordinator','State Coordinator','State Zone Coordinator');

			}

			if(in_array($this->session->userdata('role'),array('national')))

			{

				$columns=array('ID','First Name','Last Name','Role','Mailing Address','Email','Home Phone','Cell Phone','Zone Coordinator','State Coordinator','State Zone Coordinator');

			}

			if(in_array($this->session->userdata('role'),array('zone')))

			{

				$columns=array('ID','First Name','Last Name','Role','Mailing Address','Email','Home Phone','Cell Phone','State Coordinator','State Zone Coordinator');

			}

			if(in_array($this->session->userdata('role'),array('state')))

			{

				$columns=array('ID','First Name','Last Name','Role','Mailing Address','Email','Home Phone','Cell Phone','State Zone Coordinator');

			}

			if($this->session->userdata('filter_type')=='webadmin' || $this->session->userdata('filter_type')=='finance')

			 {

			 $data['national']  = $this->webadmin->get_by_type('national');

			 $data['details']  = $this->webadmin->filter_details();

			 }		 

			 elseif($this->session->userdata('filter_type')=='national')

			 {

				 $data['zone']  = $this->db->query("select a.id as user_id,b.disributer_id,a.admin_type,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.*  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.National_admin_id=".$this->session->userdata('filter_id')." and a.admin_type='zone'")->result_array();

				 $data['details']  = $this->webadmin->filter_details(array('national'=>$this->session->userdata('filter_id')));

				

			 }

			 elseif($this->session->userdata('filter_type')=='zone')

			 {

				 $data['state']  = $this->db->query("select a.id as user_id,b.disributer_id,a.admin_type,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where Zonal_admin_id=".$this->session->userdata('filter_id')." and admin_type='state'")->result_array();	

				 $data['details']  = $this->webadmin->filter_details(array('zone'=>$this->session->userdata('filter_id')));

			

			 }

			 elseif($this->session->userdata('filter_type')=='state')

			 {

				  $data['state_zone']  = $this->db->query("select a.id as user_id,b.disributer_id,a.admin_type,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where State_admin_id=".$this->session->userdata('filter_id')." and admin_type='state_zone'")->result_array();

				  $data['details']  = $this->webadmin->filter_details(array('state'=>$this->session->userdata('filter_id')));

			 }

			 elseif($this->session->userdata('filter_type')=='state_zone')

			 {

				 $data['county']  = $this->db->query("select a.id as user_id,b.disributer_id,a.admin_type,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where State_zone_admin_id=".$this->session->userdata('filter_id')." and admin_type='county'")->result_array();

				  $data['details']  = $this->webadmin->filter_details(array('state_zone'=>$this->session->userdata('filter_id')));

			 }

			foreach($data['details'] as $result)

			{

				if($result['admin_type']=="Distributer")

				{

					$columns=array('ID','First Name','Last Name','Role','Mailing Address','Email','Home Phone','Cell Phone','National Coordinator','Zone Coordinator','State Coordinator','State Zone Coordinator','Subscription length','Copies requested','Mode of payment','Transaction id','Amount Paid','Bank Details','Account Number','Date of pay','Cheque Number','Cash Cheque by','Comments','Total amount','Payment Status','subscription date','Expiry date');

				} 

			}

			foreach($columns as $ind=>$col)

			{

				

				if($ind>25)

				{

					$this->excel->getActiveSheet()->setCellValue('AA1',$col);

					$this->excel->getActiveSheet()->getStyle('AA1')->getFont()->setBold(true);

					$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

				}

				else

				{

					$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);

					$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);

					$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

				}

			}

			 

			//$results = $this->common->subscribers_filter_list($filter,$users,$from_date,$to_date);

			$i=2;

			foreach($data['details'] as $result)

			{

			

                $national_coord   = $this->db->query("select a.id as user_id,a.login_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['National_admin_id']." ")->row_array();

				$zone_coord       = $this->db->query("select a.id as user_id,a.login_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['Zonal_admin_id']." ")->row_array();	

				$state_coord      = $this->db->query("select a.id as user_id,a.login_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_admin_id']." ")->row_array();

				$state_zone_coord = $this->db->query("select a.id as user_id,a.login_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_zone_admin_id']." ")->row_array();	



					

				$short_name = $result['First_name'];

				$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];

			//	$billing    = $result['BillingAddress1'].",".$result['BillingAddress2'].",".$result['BillingCity'].",".$result['BillingState'].",".$result['BillingZip'];

				$id   = ($result['admin_type']=="Distributer")?$result['disributer_id']:$result['id'];

				$values     = array($id,$result['First_name'],$result['Last_name'],$result['admin_type'],$mailing,$result['Email_address'],$result['Home_phone'],$result['Cell_phone']);

				if(in_array($this->session->userdata('role'),array('webadmin','finance')))

				{

					$values[]   = $national_coord['First_name'];

				}

				if(in_array($this->session->userdata('role'),array('webadmin','national','finance')))

				{

					$values[]   = $zone_coord['First_name'];

				}

				if(in_array($this->session->userdata('role'),array('webadmin','national','zone','finance')))

				{

					$values[]   = $state_coord['First_name'];

				}

				if(in_array($this->session->userdata('role'),array('webadmin','national','zone','state','finance')))

				{

					$values[]   = $state_zone_coord['First_name'];

				}

				if($result['admin_type']=="Distributer")

				{

					$res_pay=$this->db->get_where('kr_dis_payment',array('Subscriber_id'=>$result['disributer_id']))->row_array();



				    $values[]	=	$result['subscription_length'];

					$values[]	=	$result['Copies_requested'];

					$values[]	=	$result['Mode_of_payment'];

					$values[]   =   $res_pay['txn_id'];

					$values[]   =   $res_pay['paid_amnt'];

					$values[]   =   $res_pay['bank_detail'];

					$values[]   =   $res_pay['acc_num'];

					$values[]   =   $res_pay['date_of_pay'];

					$values[]   =   $res_pay['cheque_num'];

					$values[]   =   $result['Cash_Check_by'];	

					$values[]   =   $result['comments'];	

					$values[]	=	$result['Total_amount'];

					$values[]	=	$res_pay['paypal_status'];

					$values[]	=	$result['subscription_date'];

					$values[]	=	$result['expiry_date'];

				}

				/*$values[]=($result['airport_pick']==1)?'Yes':'No';

				$values[]=$result['arrival_date'];

				$counts=explode("#$",$result['counts']);

				$values[]=$counts[0];

				$values[]=$result['request'];*/

					

				foreach($values as $ind=>$val)

				{

					if($ind>25)

					{

						$this->excel->getActiveSheet()->setCellValue('AA'.$i,$val);

						

						$this->excel->getActiveSheet()->getStyle('AA'.$i)->getAlignment()->setWrapText(true);	

					}

					else

					{

						$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);

						$this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	



					}

				}

				

				$i++;

			}			

		}

		 $this->session->unset_userdata('filter_id',$this->session->userdata('id'));

		 $this->session->set_userdata('filter_type',$this->session->userdata('role'));

		

		$filename=@$short_name.'_'.date('Ymd_His'); //save our workbook as this file name



		if($short_name=='')

		{

		  $filename='_'.date('Ymd_His'); //save our workbook as this file name

		}

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->setPreCalculateFormulas(false);

		

		//ob_end_clean();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type

		

		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell browser what's the file name

		

		header('Cache-Control: max-age=0'); //no cache

		

		

		$objWriter->save('php://output');

		exit();

		//redirect('national/subscribers_list_report');

	}

	

	

	public function export_subscribers()
	{

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		 $filter     = 1;//$this->session->userdata('filter');

		 $users      = $this->uri->segment('3');

		 $from_date  = $this->session->userdata('from_date_selected');

		 $to_date	 = $this->session->userdata('to_date_selected');

		$xcols=range('A','Z');

		if($filter !="")

		{

			$columns=array('ID','First Name','Last Name','Mailing Address','Email','Home Phone','Cell Phone','National Coordinator','Zone Coordinator','State Coordinator','State Zone Coordinator','Subscription time','Expiry time','Subscription length','Mode of payment','Transaction id','Paid Amount','Bank Details','Account Number','Date of pay','Cheque number','Cash/Cheque by','Comments','Amount','Payment Status');

			foreach($columns as $ind=>$col)

			{

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);

				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');

			}

			

			$this->db->join('kr_subscribers','kr_subscribers.Distributer_id=kr_users.id','innerjoin');

			$results = $this->db->get_where('kr_users',array('kr_users.id'=>$users))->result_array();

			$i=2;

			foreach($results as $result)

			{

				

                $national_coord   = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['National_admin_id']." ")->row_array();

				$zone_coord       = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['Zonal_admin_id']." ")->row_array();	

				$state_coord      = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_admin_id']." ")->row_array();

				$state_zone_coord = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$result['State_zone_admin_id']." ")->row_array();	



				$res_pay=$this->db->get_where('kr_payment',array('Subscriber_id'=>$result['id']))->row_array();

	

				$short_name = $result['First_name'];

				$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];

				//$billing    = $result['BillingAddress1'].",".$result['BillingAddress2'].",".$result['BillingCity'].",".$result['BillingState'].",".$result['BillingZip'];

				$values     = array($result['Subscriber_id'],$result['First_name'],$result['Last_name'],$mailing,$result['Email_address'],$result['Home_phone'],$result['Cell_phone']);

				$values[]   = $national_coord['First_name'];

				$values[]   = $zone_coord['First_name'];

				$values[]   = $state_coord['First_name'];

				$values[]   = $state_zone_coord['First_name'];

				$values[]   = date('Y-m-d',strtotime($result['subscription_date']));

				$values[]   = date('Y-m-d',strtotime($result['expiry_date']));

				$values[]   = ($result['Subscriptions']==1)?'1-year':'2-year';

				$values[]   = $result['Mode_of_payment'];

				$values[]   = $res_pay['txn_id'];

				$values[]   = $res_pay['paid_amnt'];

				$values[]   = $res_pay['bank_detail'];

				$values[]   = $res_pay['acc_num'];

				$values[]   = $res_pay['date_of_pay'];

				$values[]   = $res_pay['cheque_num'];

				$values[]   = $result['Cash_Check_by'];	

				$values[]   = $result['comments'];	

				$values[]   = $result['Total_amount'];

				$values[]   = $res_pay['paypal_status'];

				

				

				/*$values[]=($result['airport_pick']==1)?'Yes':'No';

				$values[]=$result['arrival_date'];

				$counts=explode("#$",$result['counts']);

				$values[]=$counts[0];

				$values[]=$result['request'];*/

					

				foreach($values as $ind=>$val)

				{

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);

				if(in_array($xcols[$ind],array('D')))

				  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	

				}

				

				$i++;

			}			

		}

		$this->session->unset_userdata('filter_id',$this->session->userdata('id'));

		$this->session->set_userdata('filter_type','national');

		

		$filename=$short_name.'_'.date('Ymd_His'); //save our workbook as this file name

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->setPreCalculateFormulas(false);

		//ob_end_clean();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type

		

		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell browser what's the file name

		

		header('Cache-Control: max-age=0'); //no cache

		$objWriter->save('php://output');

		exit();

		//redirect('national/subscribers_list_report');

	}

	

	

	/*** 12-6-16 harish **/

	/* to list all co-ordinators **/

	public function coordinators()

	{

		

		 $data['title'] = 'Co-ordinators';

         $data['menu'] = 'webadmin';

         $data['content'] = 'backend/webadmin/coordinators';

		 		

		 if($this->session->userdata('role')=='webadmin' || $this->session->userdata('role')=='finance')

		 {

		 $data['national']  = $this->webadmin->get_by_type('national');

		 $data['details']  = $this->webadmin->filter_details();

		// $this->session->set_userdata('filter_id',$this->session->userdata('id'));

		 }		 

		 elseif($this->session->userdata('role')=='national')

		 {

			 $data['zone']  = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.*  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.National_admin_id=".$this->session->userdata('id')." and a.admin_type='zone'")->result_array();

			 $data['details']  = $this->webadmin->filter_details(array('national'=>$this->session->userdata('id')));

			 $this->session->set_userdata('filter_id',$this->session->userdata('id'));

		 }

		 elseif($this->session->userdata('role')=='zone')

		 {

			 $data['state']  = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where Zonal_admin_id=".$this->session->userdata('id')." and admin_type='state'")->result_array();	

			 $data['details']  = $this->webadmin->filter_details(array('zone'=>$this->session->userdata('id')));

			 $this->session->set_userdata('filter_id',$this->session->userdata('id'));

		 }

		 elseif($this->session->userdata('role')=='state')

		 {

			  $data['state_zone']  = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where State_admin_id=".$this->session->userdata('id')." and admin_type='state_zone'")->result_array();

			  $data['details']  = $this->webadmin->filter_details(array('state'=>$this->session->userdata('id')));

			  $this->session->set_userdata('filter_id',$this->session->userdata('id'));

		 }

		 elseif($this->session->userdata('role')=='state_zone')

		 {

			 $data['county']  = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where State_zone_admin_id=".$this->session->userdata('id')." and admin_type='county'")->result_array();

			  $data['details']  = $this->webadmin->filter_details(array('state_zone'=>$this->session->userdata('id')));

			  $this->session->set_userdata('filter_id',$this->session->userdata('id'));

		 }

		 

		  if(!empty($_POST))

		  {

			 $inputs = $this->input->post(null,true);

			 $this->session->set_userdata('post',$inputs);

			 if(count($inputs) > 0)

			 $data['details']  = $this->webadmin->filter_details($inputs);

			 if(isset($inputs['national']) && $inputs['national'] !="")

			 {

				 $data['zone']  = $this->db->query("select  a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.National_admin_id=".$inputs['national']." and a.admin_type='zone'")->result_array();

				 $this->session->set_userdata('filter_type','national');

				 $this->session->set_userdata('filter_id',$inputs['national']);

			 }

			 if(isset($inputs['zone']) && $inputs['zone'] !="")

			 {

				 $data['state']  = $this->db->query("select  a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.Zonal_admin_id=".$inputs['zone']." and a.admin_type='state'")->result_array();

				 $this->session->set_userdata('filter_type','zone');

				 $this->session->set_userdata('filter_id',$inputs['zone']);

			 }

			 if(isset($inputs['state']) && $inputs['state'] !="")

			 {

				 $data['state_zone']  = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.State_admin_id=".$inputs['state']." and a.admin_type='state_zone'")->result_array();

				 $this->session->set_userdata('filter_id',$inputs['state']);

				 $this->session->set_userdata('filter_type','state');

			 }

			 if(isset($inputs['state_zone']) && $inputs['state_zone'] !="")

			 {

				 $data['county']  = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.* from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.State_zone_admin_id=".$inputs['state_zone']." and a.admin_type='county'")->result_array();

				 $this->session->set_userdata('filter_type','state_zone');

				 $this->session->set_userdata('filter_id',$inputs['state_zone']);

			 }

			 /*if($inputs['county'] !="")

			 $data['distributer']  = $this->db->query("select id,First_name from kr_users where County_admin_id=".$inputs['county']." and admin_type='distributer'")->result_array();*/

			

		  }

		

		 /*elseif($this->session->userdata('role')=='county')

		 $data['distributer']  = $this->db->query("select id,First_name from kr_users where County_admin_id=".$this->session->userdata('id')." and admin_type='distributer'")->result_array();	*/	 

		 //echo $this->db->last_query();

         $this->load->view( 'backend/template', $data );

	}

	

	public function get_by_type($parent,$parent_id,$child){

		$results=$this->db->query("select  a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where  $parent=$parent_id and a.admin_type='$child'")->result_array();

		//echo $this->db->last_query();

		

		if(!empty($results))

		{

			echo '<option value="">All</option>';

			foreach($results as $result)

			{

				echo '<option value="'.$result['user_id'].'">'.$result['First_name'].'</option>';				

			}			

		}

		else

		{

			echo '<option value="">All</option>';	

		}

		

	}

	

	public function books()

	{		

		 

		 $data['books'] = $this->db->query("select * from kr_books order by id desc")->result_array(); 

		 

		 $data['title'] = 'books';

         $data['menu'] = 'webadmin';

         $data['content'] = 'backend/webadmin/books';

		 

		 

		 $this->load->view( 'backend/template', $data );

	}

	

	public function addbook()

	{	 

		 if($this->input->post())

		 {
  
            $_FILES["thumbnail"]["name"];
			$name=$this->input->post('name');

			$edition=$this->input->post('edition');

			$file_name=$this->input->post('userfile');
			$thumbnail = str_replace(" ", "-", $_FILES["thumbnail"]["name"]);



			//$file_name=str_replace(" ","",$name).'_'.$edition.'.pdf';

			//$config=array('upload_path'=>'./pdf/','file_name'=>$file_name,'allowed_types'=>'pdf');			

			//print_r($config);

			

			//$this->load->library('upload');

			//$this->upload->initialize($config);

			if($this->db->query("select count(id) cnt from kr_books where name='$name' and edition ='$edition'")->row()->cnt < 1)

			{

				/*if($this->upload->do_upload('userfile'))

				{*/
				move_uploaded_file( $_FILES["thumbnail"]["tmp_name"], './thumbnail/'.$thumbnail);
                
					$this->db->insert('kr_books',array('name'=>$name,'edition'=>$edition,'file'=>$file_name,'thumbnail'=>$thumbnail));

					$this->session->set_flashdata('add_book','added');

					//redirect('webadmin/books');

				/*}

				else

				{		

				 //$errors = $this->upload->display_errors();		

				// $this->session->set_flashdata('error',	$errors);

					$this->session->set_flashdata('error','File could not upload');

					redirect('webadmin/addbook');

				}*/

			}

			else

			{

				$this->session->set_flashdata('error','Already exists');

				redirect('webadmin/addbook');

			}

		 }		 

		 $data['title'] = 'books';

         $data['menu'] = 'webadmin';

         $data['content'] = 'backend/webadmin/addbook';

		 

		 $this->load->view( 'backend/template', $data );

	}

	

	public function editbook($param1)

	{	 

		 if($this->input->post())

		 {

			$name=$this->input->post('name');

			$edition=$this->input->post('edition');

			$file_name=$this->input->post('userfile');

			$thumbnail= str_replace(" ", "-", $_FILES["thumbnail"]["name"]);

			//$data=array('name'=>$name,'edition'=>$edition);

			if($this->db->query("select count(id) cnt from kr_books where name='$name' and edition ='$edition' and id !=$param1")->row()->cnt < 1)

			{

				

				/*if($_FILES['userfile']['error']==0)

				{

					$file_name=$name.'_'.$edition.'.pdf';

					$config=array('upload_path'=>'./pdf/','file_name'=>$file_name,'allowed_types'=>'pdf');			

					$this->load->library('upload');

					$this->upload->initialize($config);

					if($this->upload->do_upload('userfile'))

					$data['file']=$file_name;

					else

					{					

						$this->session->set_flashdata('error','File could not upload');

						redirect('webadmin/editbook/'.$param1);

					}

				

				}*/

				$data['file']=$file_name;
				$data['name']=$name;
				$data['edition']=$edition;
				$data['thumbnail']=$thumbnail;
                move_uploaded_file( $_FILES["thumbnail"]["tmp_name"], './thumbnail/'.$thumbnail);
				$this->db->update('kr_books',$data,array('id'=>$param1));

				$this->session->set_flashdata('update_book','updated');

				redirect('webadmin/books');

				

				

			}

			else

			{

				$this->session->set_flashdata('error','Already exists');

				redirect('webadmin/editbook/'.$param1);

			}

		 }

		 

		 $data['book'] = $this->db->query("select * from kr_books where id =".$param1)->row_array();

		 

		 $data['title'] = 'books';

         $data['menu'] = 'webadmin';

         $data['content'] = 'backend/webadmin/editbook';

		 

		 $this->load->view( 'backend/template', $data );

	}

	

	public function book_delete($param1)

	{	 

		$this->db->query("delete from kr_books where id=$param1");

		

		if($this->db->affected_rows()>0)

		$this->session->set_flashdata('success','Deleted Successfully');

		else

		$this->session->set_flashdata('error','Please try again after some time.');

		redirect('webadmin/books');

	}

	

	public function delete_subscriber()

	{	 

		$param1=$this->uri->segment(3);

		$param2=$this->uri->segment(4);

		$this->db->query("delete from kr_subscribers where Subscriber_id='$param1'");

		

		if($this->db->affected_rows()>0)

		$this->session->set_flashdata('success','Deleted Successfully');

		else

		$this->session->set_flashdata('error','Please try again after some time.');

		redirect('national/subscribers_list/'.$param2);

	}

	

	public function delete_dist()

	{	 

		$param1=$this->uri->segment(3);

		$param2=$this->uri->segment(4);

		$this->db->query("delete from kr_distributers where disributer_id='$param1'");

		

		if($this->db->affected_rows()>0)

		$this->session->set_flashdata('success','Deleted Successfully');

		else

		$this->session->set_flashdata('error','Please try again after some time.');

		redirect('national/distributers_list/'.$param2);

	}

	public function subscriber_orders()
	{
		 $filter 	= $this->input->post('filter');

		 $users  	= $this->input->post('users');

		 $from_date = $this->input->post('from_date');
		  
		 $search_string = $this->input->post('search_string');


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

				if(isset($_POST['search_string'])){

				   $data['search_string']  = $search_string;

				   $this->session->set_userdata('search_string',$search_string);

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

				 $data['subscriber'] = $this->common->subscribers_orders_list(addslashes($search_string),$users,$from_date,$to_date);
				 $data['search_string']  = $search_string;
				 $data['to_date_selected']  = $to_date;
				 $data['from_date_selected']  = $from_date;
				 $data['title'] = 'Web Admin';

				 $data['menu'] = 'webadmin';

				 $data['content'] = 'backend/webadmin/subscribers_order_report';
				// print_r($data);exit();

				 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['subscriber'] = $this->common->subscribers_orders_list($id,$type,'','');

			 $data['title'] = 'Web Admin';

			 $data['menu'] = 'webadmin';

			 $data['content'] = 'backend/webadmin/subscribers_order_report';

			 $this->load->view( 'backend/template', $data );
		 }

	}
	public function subscriber_resetform()
	{
           
       $this->session->set_userdata('filter','');
           $this->session->set_userdata('search_string','');
           $this->session->set_userdata('from_date_selected','');
           $this->session->set_userdata('to_date_selected','');
           redirect('webadmin/subscriber_orders','refresh');

	}

	public function distributer_resetform()
	{
           
       $this->session->set_userdata('filter','');
           $this->session->set_userdata('search_string','');
           $this->session->set_userdata('from_date_selected','');
           $this->session->set_userdata('to_date_selected','');
           redirect('webadmin/distributer_orders','refresh');

	}


	public function export_subscribers_orders()
	{

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		 $filter     = 1;//$this->session->userdata('filter');

		 $users      = $this->uri->segment('3');

		 $from  = $this->session->userdata('from_date_selected');

		 $to	 = $this->session->userdata('to_date_selected');

		$string = $this->session->userdata('search_string');

		$xcols=range('A','Z');

		if($filter !="")

		{

			$columns=array('ID','First Name','Last Name','Mailing Address','Email','Home Phone','Distributer','Subscription Date','Expiry Date','No of Copies','Number of months','Total Days / Payment Status');

			foreach($columns as $ind=>$col)

			{

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);

				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');

			}

			

		if($string!='' && $from!='' && $to!='')
		{
			$res_subscribe = $this->db->query("SELECT s.`Subscriber_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`BillingAddress1`, s.`BillingAddress2`, s.`BillingCity`, s.`BillingState`, s.`BillingZip`, s.`Home_phone`, s.`Email_address`, s.`Distributer_id`,o.* FROM kr_orders o Left Join kr_subscribers s on s.id=o.Subscriber_id WHERE s.`Subscriber_id`='$string' and DATE_FORMAT(o.expiry_date,'%Y-%m-%d')<'$to' and  DATE_FORMAT(o.expiry_date,'%Y-%m-%d')>'$from'");
			 $results = $res_subscribe->result_array();
		}
		elseif($string!='')
		{
			$res_subscribe = $this->db->query("SELECT s.`Subscriber_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`BillingAddress1`, s.`BillingAddress2`, s.`BillingCity`, s.`BillingState`, s.`BillingZip`, s.`Home_phone`, s.`Email_address`, s.`Distributer_id`,o.* FROM kr_orders o Left Join kr_subscribers s on s.id=o.Subscriber_id WHERE s.`Subscriber_id`='$string'");
			
			if($res_subscribe->num_rows()>0)
			{
				$results = $res_subscribe->result_array();
			}
			 
		}
		else if($from!='' && $to!='')
		{
			// $zoneid   = $user;
			 $res_subscribe = $this->db->query("SELECT s.`Subscriber_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`BillingAddress1`, s.`BillingAddress2`, s.`BillingCity`, s.`BillingState`, s.`BillingZip`, s.`Home_phone`, s.`Email_address`, s.`Distributer_id`,o.* FROM kr_orders o Left Join kr_subscribers s on s.id=o.Subscriber_id WHERE DATE_FORMAT(o.expiry_date,'%Y-%m-%d')<'$to' and  DATE_FORMAT(o.expiry_date,'%Y-%m-%d')>'$from' ");
			 $results = $res_subscribe->result_array();
		}
		else
		{
			 //$zoneid   = $user;
			 $res_subscribe = $this->db->query("SELECT s.`Subscriber_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`BillingAddress1`, s.`BillingAddress2`, s.`BillingCity`, s.`BillingState`, s.`BillingZip`, s.`Home_phone`, s.`Email_address`, s.`Distributer_id`,o.* FROM kr_orders o Left Join kr_subscribers s on s.id=o.Subscriber_id  ");
			 $results = $res_subscribe->result_array();
		}

			$i=2;

			foreach($results as $result)

			{

				

               
				$this->db->join('kr_distributers','kr_distributers.User_id=kr_users.id','right');
			    $row = $this->db->get_where('kr_users',array('kr_users.id'=>$result['Distributer_id']))->row_array();

				$res_pay=$this->db->get_where('kr_payment',array('Subscriber_id'=>$result['id']))->row_array();

					

				$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];


				$values     = array($result['sub_id'],$result['First_name'],$result['Last_name'],$mailing,$result['Email_address'],$result['Home_phone']);
                
                $values[]   = $row['First_name'];

				$values[]   = date('Y-m-d',strtotime($result['subscription_date']));

				$values[]   = date('Y-m-d',strtotime($result['expiry_date']));

				
				$values[]   = $result['No_of_copies'];
                $values[]   = $result['subscription_length'];
			    $values[]   = strip_tags($this->Subscriber_model->subscription_status($result['id'])).' / '.ucfirst($this->Subscriber_model->validate_subscription($result['id']));

				
					

				foreach($values as $ind=>$val)

				{

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);

				if(in_array($xcols[$ind],array('D')))

				  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	

				}

				

				$i++;

			}			

		}

		$this->session->unset_userdata('filter_id',$this->session->userdata('id'));

		$this->session->set_userdata('filter_type','national');

		

		$filename=date('Ymd_His'); //save our workbook as this file name

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->setPreCalculateFormulas(false);

		//ob_end_clean();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type

		

		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell browser what's the file name

		

		header('Cache-Control: max-age=0'); //no cache

		$objWriter->save('php://output');

		exit();

		//redirect('national/subscribers_list_report');

	}
	public function distributer_orders()
	{
		 $filter 	= $this->input->post('filter');

		 $users  	= $this->input->post('users');

		 $from_date = $this->input->post('from_date');
		  
		 $search_string = $this->input->post('search_string');


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

				if(isset($_POST['search_string'])){

				   $data['search_string']  = $search_string;

				   $this->session->set_userdata('search_string',$search_string);

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

				 $data['subscriber'] = $this->common->distributer_orders_list(addslashes($search_string),$users,$from_date,$to_date);
				 $data['search_string']  = $search_string;
				 $data['to_date_selected']  = $to_date;
				 $data['from_date_selected']  = $from_date;
				 $data['title'] = 'Web Admin';

				 $data['menu'] = 'webadmin';

				 $data['content'] = 'backend/webadmin/distributer_order_report';
				 

				 $this->load->view( 'backend/template', $data );
		 }
		 else
		 {
			 $id   = $this->session->userdata('id');

			 $type = $this->session->userdata('role');

			 $data['subscriber'] = $this->common->distributer_orders_list($id,$type,'','');
			//print_r($data['subscriber']);exit();

			 $data['title'] = 'Web Admin';

			 $data['menu'] = 'webadmin';

			 $data['content'] = 'backend/webadmin/distributer_order_report';

			 $this->load->view( 'backend/template', $data );
		 }

	}

	public function export_distributers_orders()
	{

		$this->load->library('excel');

		$this->excel->setActiveSheetIndex(0);

		 $filter     = 1;//$this->session->userdata('filter');

		 $users      = $this->uri->segment('3');

		 $from  = $this->session->userdata('from_date_selected');

		 $to	 = $this->session->userdata('to_date_selected');

		 $string = $this->session->userdata('search_string');

		$xcols=range('A','Z');

		if($filter !="")

		{

			$columns=array('ID','First Name','Last Name','Mailing Address','Email','Home Phone','National admin','Zone admin','State admin','State Zone admin','Subscription Date','Expiry Date','No of Copies','Total Days / Payment Status');

			foreach($columns as $ind=>$col)

			{

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'1',$col);

				$this->excel->getActiveSheet()->getStyle($xcols[$ind].'1')->getFont()->setBold(true);

				$this->excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].'2','123');

			}

			

		if($string!='' && $from!='' && $to!='')
		{
			$res_subscribe = $this->db->query("SELECT s.`disributer_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`Email_address`,s.`Home_phone`, s.`User_id`,o.*, o.No_of_copies as Total_copies FROM kr_dis_orders o Left Join kr_distributers s on o.Distributer_id=s.disributer_id WHERE s.`disributer_id`='$string' and DATE_FORMAT(o.expiry_date,'%Y-%m-%d')<'$to' and  DATE_FORMAT(o.expiry_date,'%Y-%m-%d')>'$from' group by  o.Distributer_id");
			 $results = $res_subscribe->result_array();
		}
		elseif($string!='')
		{
			$res_subscribe = $this->db->query("SELECT s.`disributer_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`Email_address`,s.`Home_phone`, s.`User_id`,o.*,  o.No_of_copies as Total_copies FROM kr_dis_orders o Left Join kr_distributers s on o.Distributer_id=s.disributer_id WHERE s.`disributer_id`='$string'");
			//echo "SELECT s.`Subscriber_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`Email_address`, s.`Distributer_id`,o.*, SUM( o.No_of_copies ) as Total_copies FROM kr_orders o Left Join kr_subscribers s on s.id=o.Subscriber_id WHERE s.`Subscriber_id`='$string'";
			if($res_subscribe->num_rows()>0)
			{
				$results = $res_subscribe->result_array();
			}
			 
		}
		else if($from!='' && $to!='')
		{
			// $zoneid   = $user;
			 $res_subscribe = $this->db->query("SELECT s.`disributer_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`Email_address`,s.`Home_phone`, s.`User_id`,o.*, o.No_of_copies as Total_copies FROM kr_dis_orders o Left Join kr_distributers s on o.Distributer_id=s.disributer_id WHERE DATE_FORMAT(o.expiry_date,'%Y-%m-%d')<'$to' and  DATE_FORMAT(o.expiry_date,'%Y-%m-%d')>'$from' group by  o.Distributer_id");
			 $results = $res_subscribe->result_array();
		}
		else
		{
			//echo "SELECT s.`disributer_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`Email_address`, s.`User_id`,o.*, SUM( o.No_of_copies ) as Total_copies FROM kr_dis_orders o Left Join kr_distributers s on o.Distributer_id=s.User_id  group by o.Distributer_id";
			 //$zoneid   = $user;
			 $res_subscribe = $this->db->query("SELECT s.`disributer_id` as sub_id, s.`First_name`, s.`Last_name`, s.`Mailing_address1`, s.`Mailing_address2`, s.`City`,s.`State`, s.`Zipcode`, s.`Email_address`,s.`Home_phone`, s.`User_id`,o.*,  o.No_of_copies as Total_copies FROM kr_dis_orders o Left Join kr_distributers s on o.Distributer_id=s.disributer_id  group by o.Distributer_id");
			 $results = $res_subscribe->result_array();
		}
			$i=2;

			foreach($results as $result)

			{

				$this->db->join('kr_distributers','kr_distributers.User_id=kr_users.id','right');
			    $rows = $this->db->get_where('kr_users',array('kr_users.login_id'=>$result['Distributer_id']))->row_array();

                $national_coord   = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$rows['National_admin_id']." ")->row_array();

				$zone_coord       = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$rows['Zonal_admin_id']." ")->row_array();	

				$state_coord      = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$rows['State_admin_id']." ")->row_array();

				$state_zone_coord = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$rows['State_zone_admin_id']." ")->row_array();	

              
				

				$res_pay=$this->db->get_where('kr_payment',array('Subscriber_id'=>$result['id']))->row_array();

	

				$short_name = $result['First_name'];

				$mailing    = $result['Mailing_address1'].",".$result['Mailing_address2'].",".$result['City'].",".$result['State'].",".$result['Zipcode'];

				//$billing    = $result['BillingAddress1'].",".$result['BillingAddress2'].",".$result['BillingCity'].",".$result['BillingState'].",".$result['BillingZip'];

				$values     = array($result['sub_id'],$result['First_name'],$result['Last_name'],$mailing,$result['Email_address'],$result['Home_phone']);
                
                
				$values[]   = $national_coord['First_name'];

				$values[]   = $zone_coord['First_name'];

				$values[]   = $state_coord['First_name'];

				$values[]   = $state_zone_coord['First_name'];


				$values[]   = date('Y-m-d',strtotime($result['subscription_date']));

				$values[]   = date('Y-m-d',strtotime($result['expiry_date']));

				
				$values[]   = $result['Total_copies'];

				$values[]   = strip_tags($this->Distributer_model->subscription_status($result['id'])).' / '.ucfirst($this->Distributer_model->validate_subscription($result['id']));


			

				/*$values[]=($result['airport_pick']==1)?'Yes':'No';

				$values[]=$result['arrival_date'];

				$counts=explode("#$",$result['counts']);

				$values[]=$counts[0];

				$values[]=$result['request'];*/

					

				foreach($values as $ind=>$val)

				{

				$this->excel->getActiveSheet()->setCellValue($xcols[$ind].$i,$val);

				if(in_array($xcols[$ind],array('D')))

				  $this->excel->getActiveSheet()->getStyle($xcols[$ind].$i)->getAlignment()->setWrapText(true);	

				}

				

				$i++;

			}			

		}

		$this->session->unset_userdata('filter_id',$this->session->userdata('id'));

		$this->session->set_userdata('filter_type','national');

		

		$filename=$short_name.'_'.date('Ymd_His'); //save our workbook as this file name

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');

		$objWriter->setPreCalculateFormulas(false);

		//ob_end_clean();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type

		

		header('Content-Disposition: attachment;filename="'.$filename.'.xls"'); //tell browser what's the file name

		

		header('Cache-Control: max-age=0'); //no cache

		$objWriter->save('php://output');

		exit();

		//redirect('national/subscribers_list_report');

	}

	/*public function subscriber_orders()
	{
		    $data['subscriber'] = $this->db->get()->ord

		 	$data['title'] = 'Web Admin';

        	$data['menu']  = 'webadmin';

         	$data['content'] = 'backend/webadmin/subscribers_list';

        	$this->load->view( 'backend/template', $data );
	}*/

}

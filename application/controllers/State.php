<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Controller {

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
		 $data['title'] = 'State';
         $data['menu']  = 'state';
         $data['content'] = 'backend/state/home';
         $this->load->view( 'backend/template', $data );
		 
	}
	
	/*Get List of Users */
	public function user_list()
	{
		 $id = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['users'] = $this->common->user_list($id,$type); 
		 $data['title'] = 'State';
         $data['menu'] = 'state';
         $data['content'] = 'backend/state/user_list';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Add user */
	public function user_add()
	{
		$this->session->flashdata('alert');
		$id   = $this->session->userdata('id');
		if($this->input->post())
		{
			$First_name = $this->input->post('first_name');
			$password   = $this->input->post('passwrd');
			$email      = $this->input->post('email');
			$admin_type = $this->input->post('role');
			$State		= $this->input->post('State');
			$Zone		= $this->input->post('Zone');
			$county		= $this->input->post('county');
			$formtype	= $this->input->post('formtype');
			$edit_id	= $this->input->post('edit_id');

			
			if($formtype=='Add')
			{
				$resulr_exist = $this->db->query("SELECT * FROM kr_users WHERE Email_address='$email' ");
				if($resulr_exist->num_rows()>0)
				{
					$this->session->set_flashdata('alert','Error');
				}
				else
				{
					$res_nat = $this->db->query("SELECT * FROM kr_users WHERE id='$id' ");
					$national_id = $res_nat->row_array();
					$this->db->query("INSERT INTO kr_users( `First_name`, `Email_address`, `Password`, `National_admin_id`, `State_admin_id`, `Zonal_admin_id`,`admin_type`) VALUES('$First_name','$email','$password','".$national_id['National_admin_id']."','$id','".$national_id['Zonal_admin_id']."','$admin_type') ");
					$this->common->mail_send($email,$admin_type,$password);
					if($this->db->insert_id()>0)
					{ 
						if($admin_type=='state_zone')
						{
							$Zonal_admin_id = $this->db->insert_id();
							for($i=0;$i<count($county);$i++)
							{	
								$this->db->query("UPDATE kr_users SET `State_Zone_admin_id`='$Zonal_admin_id' WHERE id IN ( '" . @implode($county, "', '") . "' )");
								$this->db->query("UPDATE kr_users SET `State_Zone_admin_id`='$Zonal_admin_id' WHERE County_admin_id IN ( '" . @implode($county, "', '") . "' )");
							}
						}
						$this->session->set_flashdata('alert','success');
					}
				}
			}
			else
			{
				$this->db->query("UPDATE kr_users SET `First_name`='$First_name', `Email_address`='$email',`Password`='$password',`admin_type`='$admin_type' WHERE id='$edit_id'");
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
		 $data['title']   = 'State';
         $data['menu']    = 'state';
         $data['content'] = 'backend/state/user_add';
         $this->load->view( 'backend/template', $data );
	}
	
	/* Assign subscriber to distributer */
	public function assign_distributers()
	{
		$this->session->flashdata('alert');
		 if($this->input->post())
		 {
			$County = $this->input->post('state_zone');
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
		 $data['County']        = $this->common->state_zone_list($id,$type);
		 $data['distributer'] = $this->common->unassign_distributers();
		 $data['title']   = 'State';
		 $data['menu']    = 'state';
		 $data['content'] = 'backend/state/assign_distributer';
		 $this->load->view( 'backend/template', $data );
	}
	
	/* Assign distributer distributer */
	public function assign_subscribers()
	{
		$this->session->flashdata('alert');
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
		 $data['title']   = 'State';
		 $data['menu']    = 'state';
		 $data['content'] = 'backend/state/assign_subscribers';
		 $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of zone state*/
	public function zone_list_all()
	{
		 $id = $this->session->userdata('id');
		 $data['zone'] = $this->common->zone_list_all();
		 $data['title'] = 'State';
         $data['menu'] = 'state';
         $data['content'] = 'backend/state/zone_list';
         $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of zone admin under state*/
	public function zone_list()
	{
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['zone'] = $this->common->zone_list($id,$type);
			 $data['title'] = 'State';
			 $data['menu'] = 'state';
			 $data['content'] = 'backend/state/zone_list';
			 $this->load->view( 'backend/template', $data );
	}
	
	/*Get List of county admin under state*/
	public function county_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id   = $this->uri->segment(3);
			$data['county'] = $this->common->county_list_all($id);
			$data['title'] = 'State';
            $data['menu'] = 'state';
            $data['content'] = 'backend/state/county_list';
            $this->load->view( 'backend/template', $data );
		}
		else
		{
		   $id   = $this->session->userdata('id');
		   $type = $this->session->userdata('role');
		   $data['county'] = $this->common->county_list($id,$type);
		   $data['title'] = 'State';
           $data['menu'] = 'state';
           $data['content'] = 'backend/state/county_list';
           $this->load->view( 'backend/template', $data );
		}
	}
	
	/*Get List of county admin under state*/
	public function state_zone_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id   = $this->uri->segment(3);
			$data['state_zone'] = $this->common->state_zone_list($id);
			$data['title'] = 'State';
            $data['menu'] = 'state';
            $data['content'] = 'backend/state/state_zone';
            $this->load->view( 'backend/template', $data );
		}
		else
		{
		   $id   = $this->session->userdata('id');
		   $type = $this->session->userdata('role');
		   $data['state_zone'] = $this->common->state_zone_list($id,$type);
		   $data['title'] = 'State';
           $data['menu'] = 'state';
           $data['content'] = 'backend/state/state_zone';
           $this->load->view( 'backend/template', $data );
		}
	}
	
	/*Get List of distributers under county*/
	public function distributers_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id   = $this->uri->segment(3);
			$data['distributer'] = $this->common->distributer_list_all($id); 
		 	$data['title'] = 'State';
         	$data['menu'] = 'state';
         	$data['content'] = 'backend/state/distributer_list';
         	$this->load->view( 'backend/template', $data );
		}
		else
		{
		 $id   = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['distributer'] = $this->common->distributer_list($id,$type); 
		 $data['title'] = 'State';
         $data['menu'] = 'state';
         $data['content'] = 'backend/state/distributer_list';
         $this->load->view( 'backend/template', $data );
		}
	}
	
	/*Get List of Subscribers  */
	public function subscribers_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id = $this->uri->segment(3);
		 	$data['subscriber'] = $this->common->subscribers_list_all($id);
		 	$data['title'] = 'State';
        	$data['menu'] = 'state';
         	$data['content'] = 'backend/state/subscribers_list';
        	$this->load->view( 'backend/template', $data );
		}
	 	else
		{
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['subscriber'] = $this->common->subscribers_list($id,$type);
			 $data['title'] = 'State';
			 $data['menu'] = 'state';
			 $data['content'] = 'backend/state/subscribers_list';
			 $this->load->view( 'backend/template', $data );
		}
		 
	}
	
	/*Add new Subscribers under distributers/county */
	
	public function subscribers_save()
	{
		 $this->load->helper('form');
		 $data['title'] = 'State';
         $data['menu'] = 'state';
         $data['content'] = 'backend/state/subscribers_save';
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

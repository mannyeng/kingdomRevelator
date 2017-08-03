<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Common extends CI_model {



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

	

	/*Get List of all un assigned distributers*/

	public function unassign_state()

	{

		 	$res = $this->db->query("SELECT * FROM kr_state WHERE Zone_id='0'");

			//$res = $this->db->query("SELECT * FROM kr_users WHERE Zonal_admin_id='0' and admin_type='state'");

		 	return $res->result_array();

	}

	

	/*Get List of all un assigned distributers*/

	public function unassign_distributers($state_id)

	{

			$state = $this->db->get_where('kr_users',array('id'=>$state_id,'admin_type'=>'state'))->row_array();

		 	$res   = $this->db->query("SELECT a.id as userid,b.* FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.State_zone_admin_id='0' and b.State='".$state['Name']."' and a.admin_type='Distributer'");

		 	return $res->result_array();

	}

	

	/*Get List of all users by filter*/

	public function user_list_filter($type,$filter,$from_date,$to_date)

	{

		if($type=='national' || $type=='webadmin')

		{

			

			$res = $this->db->query("SELECT * FROM kr_users WHERE admin_type!='national' and admin_type='$filter' ");

			return $res->result_array();

		}

		if($type=='zone')

		{

			$res = $this->db->query("SELECT * FROM kr_users WHERE id!='$id' and admin_type!='national' and admin_type!='$filter' and Zonal_admin_id='$id'");

			return $res->result_array();

		}

		if($type=='state')

		{

			$res = $this->db->query("SELECT * FROM kr_users WHERE id!='$id' and admin_type!='national' and admin_type!='$filter' and State_admin_id='$id'");

			return $res->result_array();

		}

	}

	

	/*Get List of all users*/

	public function user_list($id,$type)

	{

		if($type=='national' || $type=='webadmin')

		{

			$res = $this->db->query("SELECT * FROM kr_users WHERE id!='$id' and admin_type!='national' ");

			return $res->result_array();

		}

		if($type=='zone')

		{

			$res = $this->db->query("SELECT * FROM kr_users WHERE id!='$id' and admin_type!='national' and admin_type!='$type' and Zonal_admin_id='$id'");

			return $res->result_array();

		}

		if($type=='state')

		{

			$res = $this->db->query("SELECT * FROM kr_users WHERE id!='$id' and admin_type!='national' and admin_type!='$type' and State_admin_id='$id'");

			return $res->result_array();

		}

	}

	

	/*Get List of all un assigned subscribers*/

	public function unassign_subscribers($state_id)

	{

					$state = $this->db->get_where('kr_users',array('id'=>$state_id,'admin_type'=>'state'))->row_array();



		 	$res = $this->db->query("SELECT * FROM kr_subscribers WHERE Distributer_id='0' and State='".$state['Name']."'");

		 	return $res->result_array();

	}

	

	/*Get List of all us state*/

	/*public function state_list_us($id)

	{

		

		 	$res_county = $this->db->query("SELECT * FROM kr_state WHERE admin_type='state' and Zonal_admin_id='$id'");

		 	return $res_county->result_array();

	}*/

	

	/*Get List of all state*/

	public function state_list_all($id)

	{

		

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state' and Zonal_admin_id='$id'");

		 	return $res_county->result_array();

	}

	

	/*Get List of state under national*/

	public function state_list($id,$type)

	{

		if($id=='')

		{

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state'");

		 	return $res_county->result_array();

		}

		else

		{

			if($type=='national' || $type=='webadmin')

			{

				 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state'");

			 	return $res_county->result_array();

			}

			if($type=='zone')

			{

		 		$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state' and Zonal_admin_id='$id'");

				 return $res_county->result_array();

			}

		}

		 

	}

	

	/*Get county  under a specific zone listing by click view button*/

	public function zone_list_all($id)

	{

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='zone' AND National_admin_id='$id' ");

		 	return $res_county->result_array();

	}

	

	/*Get county  under a specific state listing by click menu*/

	public function zone_list($id)

	{

		if($id=='')

		{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='zone' ");

			 return $res_county->result_array();

		}

		else

		{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='zone' AND National_admin_id='$id' ");

			 return $res_county->result_array();

				

		}

		 

	}

	

	/*Get national list*/

	public function national_list($id)

	{

		if($id=='')

		{

			 $res_county = $this->db->query("SELECT a.*,b.First_name FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id WHERE a.admin_type='national' ");

			 return $res_county->result_array();

		}

		else

		{

			 $res_county = $this->db->query("SELECT a.*,b.First_name FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id WHERE a.admin_type='national' ");

			 return $res_county->result_array();

				

		}

		 

	}

	

	/*Get state_zone  under a specific zone listing by click view button*/

	public function state_zone_list_all($id)

	{

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state_zone' and State_admin_id='$id'");

		 	return $res_county->result_array();

	}

	

	/*Get state_zone  under a specific state listing by click menu */

	public function state_zone_list($id,$type,$state_id) 

	{

		

		/*if($id=='')

		{

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state_zone'");

		 	return $res_county->result_array();

		}

		else

		{*/



			if($type=='zone')

			{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state_zone' and Zonal_admin_id='$id' and State_admin_id='$state_id'");

			 return $res_county->result_array();

			}

			if($type=='state')

			{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state_zone' and State_admin_id='$id' and State_admin_id='$state_id' ");

			 return $res_county->result_array();

			}

			

			if($type=='national')

			{

				$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state_zone' and National_admin_id='$id' and State_admin_id='$state_id' ");

			    return $res_county->result_array();

			}

			if($type=='webadmin')

			{

				$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='state_zone' and State_admin_id='$state_id' ");

			    return $res_county->result_array();

			}

		//}

		 

	}

	

	

	/*Get county  under a specific zone listing by click view button*/

	public function county_list_all($id)

	{

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county' and State_zone_admin_id='$id'");

		 	return $res_county->result_array();

	}

	

	/*Get county  under a specific zone listing by click menu */

	public function county_list($id,$type)

	{

		if($id!='' && $type=='')

		{

			 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county' and County_admin_id='$id' ");

			 return $res_distributer->result_array();

		}

		if($id=='')

		{

		 	$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county'");

		 	return $res_county->result_array();

		}

		else

		{

			if($type=='zone')

			{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county' and Zonal_admin_id='$id'");

			 return $res_county->result_array();

			}

			if($type=='state')

			{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county' and State_admin_id='$id'");

			 return $res_county->result_array();

			}

			if($type=='state_zone')

			{

			 $res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county' and State_zone_admin_id='$id'");

			 return $res_county->result_array();

			}

			if($type=='national' || $type=='webadmin')

			{

				$res_county = $this->db->query("SELECT * FROM kr_users WHERE admin_type='county'");

			    return $res_county->result_array();

			}

		}

		 

	}

	



	

	/*Get distributer  under a specific county listing by click view button*/

	public function distributer_list_all($id)

	{

		$res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.State_zone_admin_id='$id' ");

		return $res_distributer->result_array();

	}

	

	/*Get distributer  under a specific county listing by click menu */

	public function distributer_list($id,$type,$state_id)

	{

		$state = $this->db->get_where('kr_users',array('id'=>$state_id,'admin_type'=>'state'))->row_array();



		if($id!='' && $type=='')

		{

			

			 $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and b.State='".$state['Name']."' and a.State_zone_admin_id='$id' ");

			 return $res_distributer->result_array();

		}

		if($id=='')

		{

		

			 $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and b.State='".$state['Name']."' ");

			 return $res_distributer->result_array();

		}

		else

		{

			

			if($type=='zone')

			{

			// $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

			 $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.Zonal_admin_id='$id' and b.State='".$state['Name']."'");

			 return $res_distributer->result_array();

			}

			if($type=='county')

			{

			// $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

			 $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id' and b.State='".$state['Name']."'");

			 return $res_distributer->result_array();

			}

			if($type=='state')

			{

			// $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

			 $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.State_admin_id='$id' and b.State='".$state['Name']."'");

			 return $res_distributer->result_array();

			}

			if($type=='state_zone')

			{

			// $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

			 $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.State_zone_admin_id='$id' and b.State='".$state['Name']."'");

			 return $res_distributer->result_array();

			}

			if($type=='national' || $type=='webadmin')

			{

			  $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and b.State='".$state['Name']."'");

			  return $res_distributer->result_array();

			}

		}

		 

	}

	

	/*Get List of Subscribers under distributers */

	public function subscribers_list_all($id)

	{

			$res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='$id' ");

			return $res_subscribe->result_array();	

	}

	

	/*Get List of Subscribers */

	public function subscribers_list($id,$type)

	{

		   if($type=='Distributer')

			{

			     $zoneid   = $this->session->userdata('id');

				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$zoneid."'");

					 return $res_subscribe->result_array();

				 

			}

		    if($type=='zone')

			{

			     $zoneid   = $this->session->userdata('id');

				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and Zonal_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='state')

			{

				 				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='state_zone')

			{

				 				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_zone_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='county')

			{

				 				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and County_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='national' )

			{

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='national' and National_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='webadmin' || $type=='finance')

			{

				$res_subscribe = $this->db->query("SELECT * FROM kr_subscribers ");

				return $res_subscribe->result_array();	

			}

		 

	}

	/*List all gift subscribers*/
	public function subscribers_gift_list($id,$type)

	{

		   if($type=='Distributer')

			{

			     $zoneid   = $this->session->userdata('id');

				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$zoneid."'");

					 return $res_subscribe->result_array();

				 

			}

		    if($type=='zone')

			{

			     $zoneid   = $this->session->userdata('id');

				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and Zonal_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='state')

			{

				 				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='state_zone')

			{

				 				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_zone_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='county')

			{

				 				 // $res_distributer = $this->db->query("SELECT * FROM kr_users a inner join kr_distributers b on a.id=b.User_id WHERE a.admin_type='Distributer' and a.County_admin_id='$id'");

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and County_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='national' )

			{

				 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='national' and National_admin_id='$id'");

				 $res_array       = $res_distributer->result_array();

				 if($res_distributer->num_rows()>0)

				 {

					 $res_subscribe = $this->db->query("SELECT a . * FROM kr_subscribers a RIGHT JOIN kr_gift_subscribers b ON a.Subscriber_id = b.Subscriber_id  WHERE a.id !='' and a.Distributer_id='".$res_array[0]['id']."' ");

					 return $res_subscribe->result_array();

				 }

			}

			if($type=='webadmin' || $type=='finance')

			{

				$res_subscribe = $this->db->query("SELECT a . * FROM kr_subscribers a RIGHT JOIN kr_gift_subscribers b ON a.Subscriber_id = b.Subscriber_id WHERE a.id !=''");

				/*return*/ print_r($res_subscribe->result_array());	

			}

		 

	}


	/*Add new Subscribers under distributers/county */

	

	public function subscribers_save()

	{

		 $this->load->helper('form');

		 $data['title'] = 'Zone';

         $data['menu'] = 'zone';

         $data['content'] = 'backend/zone/subscribers_save';

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

	

	public function mail_send($mail_id,$roll,$Password)

	{

		/*$config['protocol']  = 'smtp';

		$config['charset']   = 'iso-8859-1';

		$config['smtp_host'] = 'mail.smtp2go.com';

		$config['smtp_user'] = 'jithin@ksofttechnologies.com';

		$config['smtp_pass'] = 'iGhTsfkvcT3T';

		$config['smtp_port'] = '2525';

		$config['mailtype']  = 'html';

		

		@$this->load->library('email');

		@$this->email->initialize($config);



		$this->email->from('jithin@ksofttechnologies.com', 'Admin');

		$this->email->to($mail_id);*/

		if($roll=='state_zone')

		{

			$rolltype='State Zone Cordinator ';

			$page="http://ksofttechnologies.com/krsite/state_zone_login";

		}

		if($roll=='zone')

		{

			$rolltype='Zone Cordinator ';

			$page="http://ksofttechnologies.com/krsite/zone_login";

		}

		if($roll=='state')

		{

			$rolltype='State Cordinator ';

		}

		if($roll=='county')

		{

			$rolltype='County Cordinator ';

		}

		if($roll=='national')

		{

			$rolltype='National Cordinator ';

			$page="http://ksofttechnologies.com/krsite/national_login";

		}

		if($roll=='Distributer')

		{

			$rolltype='Distributer ';

			$page="http://ksofttechnologies.com/krsite/front_login/dist_login";

		}

		if($roll=='finance')

		{

			$rolltype='Finance Admin ';

		}

		

		/*$this->email->subject('Info');

		$this->email->message('<html><head></head><body>You are registered as a <bold>'.$rolltype.'</bold><br>Username: '.$mail_id.'<br>Password: '.$Password.'</body></html>');

		$this->email->send();*/

		$this->db->select('kr_distributers.First_name');

		$this->db->join('kr_users','kr_users.Distributer_id=kr_distributers.id');

		$member_data = $this->db->get_where('kr_distributers',array('kr_users.Email_address'=>$mail_id,'kr_users.Password'=>$Password))->row_array();

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

		$this->email->to($mail_id);

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

		$mailContent.='<p>Hi '.$member_data['First_name'].',<br></p>';

		$mailContent.='<p>Thank you for registering as a <bold>'.$rolltype.'.  Please <a target="_blank"  href="'.$page.'">login here</a> with the below credentials to know status or update your details.<br><br>Username : <b>'.$mail_id.'</b><br>Password : <b>'.$Password.'</b> <br><br><p>';

		$mailContent.='</table></p>';	

		$mailContent.='<p>Administrator,<br>

      Kingdom Revelator USA</p>

    </td>

  </tr>

</table>';	

		$this->email->subject('Message from Kingdom Revelator USA');

		$this->email->message($mailContent);

		$this->email->send();

	}

	

	/* send mail when update profile of distributer, article writer,intercession*/

	public function mail_send_profile_update($mail_id,$roll,$Password)

	{

		

		$this->db->select('kr_distributers.First_name');

		$this->db->join('kr_users','kr_users.id=kr_distributers.User_id');

		$member_data = $this->db->get_where('kr_distributers',array('kr_users.Email_address'=>$mail_id,'kr_users.Password'=>$Password,'kr_users.admin_type'=>$roll))->row_array();

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

		$this->email->to($mail_id);

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

		$mailContent.='<p>Hi '.$member_data['First_name'].',<br></p>';

		$mailContent .='<p>You updated the Information as a <bold>'.$roll.'.Use below credentials to Login.<br><br>Username : <b>'.$mail_id.'</b><br>Password : <b>'.$Password.'</b> <br><br><p>';

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







	public function subscribers_filter_list($type,$user,$from,$to)

	{

		if($type=='distributer')

			{

				if($from!='' && $to!='')

				{

					 $zoneid   = $user;

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$zoneid."' AND DATE_FORMAT(subscription_date,'%m-%d-%Y') BETWEEN '$from' AND '$to' ");

					 return $res_subscribe->result_array();

				}

				else

				{

					 $zoneid   = $user;

					 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$zoneid."'");

					 return $res_subscribe->result_array();

				}

				 

			}

		    if($type=='zone')

			{

				if($from!='' && $to!='')

				{

					 $zoneid   = $user;

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and Zonal_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' AND DATE_FORMAT(subscription_date,'%m-%d-%Y') BETWEEN '$from' AND '$to' ");

						 return $res_subscribe->result_array();

					 }

				}

				else

				{

					 $zoneid   = $user;

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and Zonal_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

						 return $res_subscribe->result_array();

					 }

				}

			}

			if($type=='state')

			{

				if($from!='' && $to!='')

				{

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' AND DATE_FORMAT(subscription_date,'%m-%d-%Y') BETWEEN '$from' AND '$to' ");

						 return $res_subscribe->result_array();

					 }

				}

				else

				{

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

						 return $res_subscribe->result_array();

					 }

				}

			}

			if($type=='state_zone')

			{

				if($from!='' && $to!='')

				{

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_zone_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' AND DATE_FORMAT(subscription_date,'%m-%d-%Y') BETWEEN '$from' AND '$to' ");

						 return $res_subscribe->result_array();

					 }



				}

				else

				{

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and State_zone_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

						 return $res_subscribe->result_array();

					 }

				}

			}

			if($type=='county')

			{

				if($from!='' && $to!='')

				{

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and County_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' AND DATE_FORMAT(subscription_date,'%m-%d-%Y') BETWEEN '$from' AND '$to' ");

						 return $res_subscribe->result_array();

					 }

				}

				else

				{

					 $res_distributer = $this->db->query("SELECT * FROM kr_users WHERE admin_type='Distributer' and County_admin_id='$user'");

					 $res_array       = $res_distributer->result_array();

					 if($res_distributer->num_rows()>0)

					 {

						 $res_subscribe = $this->db->query("SELECT * FROM kr_subscribers  WHERE Distributer_id='".$res_array[0]['id']."' ");

						 return $res_subscribe->result_array();

					 }

				}

			}

	}

}


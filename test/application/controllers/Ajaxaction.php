<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ajaxaction extends CI_Controller {



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

	public function state()

	{

		$msg='';

		if($this->input->post())

		{

			$id  = $this->input->post('id');

			$res = $this->db->query("SELECT * FROM kr_state WHERE Zone_id='$id'");

			$State= $res->result_array();

			foreach($State as $row)

			{

			 $msg.='<option value='.$row['id'].' selected >'.$row['State_name'].'</option>';

			}

			echo $msg;

		}

	}

	

	public function discount()

	{

		$msg='';

		if($this->input->post())

		{

			$copy    = $this->input->post('copy');

			$amount  = $this->input->post('amount');

			

			$total   = $amount;

			$res     = $this->db->query("SELECT * FROM kr_discount");

			$State   = $res->result_array();

			

			if($copy>=30)

			{

				$per_discount = $State[0]['above30'];

				$discount     = ($State[0]['above30']/100)*$total;
				if($discount>0)
				{
				  $msg          = "<div class='alert alert-dismissible alert-success'>You got ".@$per_discount."% Discount and amount is $".($total-$discount)."</div>";
				}
				else
				{
					$msg          = "<div class='alert alert-dismissible alert-success'>Your total amount is $".($total)."</div>";

				}
			}

			elseif($copy>=20)

			{

				$per_discount = $State[0]['above20'];

				$discount 	  = ($State[0]['above20']/100)*$total;
				if($discount>0)
				{
					$msg          = "<div class='alert alert-dismissible alert-success'>You got ".@$per_discount."% Discount and amount is $".($total-$discount)."</div>";
				}
				else
				{
					$msg          = "<div class='alert alert-dismissible alert-success'>Your total amount is $".($total)."</div>";

				}
			}

			elseif($copy>=10)

			{

				$per_discount = $State[0]['above10'];

				$discount     = ($State[0]['above10']/100)*$total; 

				if($discount>0)
				{
					$msg          = "<div class='alert alert-dismissible alert-success'>You got ".@$per_discount."% Discount and amount is $".($total-$discount)."</div>";
				}
				else
				{
					$msg          = "<div class='alert alert-dismissible alert-success'>Your total amount is $".($total)."</div>";

				}


			}

			elseif($copy<10 || $copy!=0|| $copy!='')

			{

				$total=$copy*$amount;

				$msg          = "<div class='alert alert-dismissible alert-success'>Your total amount is $".($total)."</div>";

			}

			echo $msg;

		}

	}

	

	public function amount()

	{

		$msg='';

		if($this->input->post())

		{

			$copy    = $this->input->post('copy');

			$amount  = $this->input->post('amount');

			$total   = $amount;

			$res     = $this->db->query("SELECT * FROM kr_discount");

			$State   = $res->result_array();

			

			if($copy>=30)

			{

				$per_discount = $State[0]['above30'];

				$discount     = ($State[0]['above30']/100)*$total;

				$msg          = $total-$discount;

			}

			elseif($copy>=20)

			{

				$per_discount = $State[0]['above20'];

				$discount 	  = ($State[0]['above20']/100)*$total;

				$msg          = $total-$discount;

			}

			elseif($copy>=10)

			{

				$per_discount = $State[0]['above10'];

				$discount     = ($State[0]['above10']/100)*$total; 

				$msg          = $total-$discount;

			}

			echo $msg;

		}

		

	}

	

	public function distibuter()

	{

		$msg='';

		if($this->input->post())

		{

			$id  = $this->input->post('id');

			$res = $this->db->query("SELECT a.id as userid,b.* FROM kr_users a inner join kr_distributers b on a.id=b.User_id left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE a.State_zone_admin_id='".$id."' and a.admin_type='Distributer'");

			$distibuter = $res->result_array();

			foreach($distibuter as $row)

			{

			 $msg.='<option value='.$row['userid'].' selected >'.$row['First_name'].'</option>';

			}

			echo $msg;

		}

	}

	

	public function subscriber()

	{

		$msg='';

		if($this->input->post())

		{

			$id  = $this->input->post('id');

			$res = $this->db->query("SELECT * FROM kr_subscribers WHERE Distributer_id='$id'");

			$distibuter = $res->result_array();

			foreach($distibuter as $row)

			{

			 $msg.='<option value='.$row['id'].' selected >'.$row['First_name'].'</option>';

			}

			echo $msg;

		}

	}

	

	public function users()

	{

		$msg='';

		if($this->input->post())

		{

			$id  = $this->input->post('id');

			

			if($this->input->post('users'))

			{

				$users=$this->input->post('users');

			}

			//$users=$this->session->userdata('users');

			$res = $this->db->query("SELECT * FROM kr_users WHERE admin_type='$id'");

			$distibuter = $res->result_array();

			$msg.='<option value="0"> Select User </option>';

			foreach($distibuter as $row)

			{

			 $msg.='<option value='.$row['id']; if($row['id']==$users){ $msg.=' selected';} $msg.='>'.$row['First_name'].'</option>';

			}

			echo $msg;

		}

	}

	

	public function get_modal()

	{

		$msg='';

		if($this->input->post())

		{

			$id      = $this->input->post('id');

			$res     = $this->db->query("SELECT a.*,b.* FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id WHERE a.id='$id'");

			$results = $res->result_array();

			$msg.='<div class="widget-body">

						<table class="table table-striped table-bordered table-condensed" id="sample_1">

						<tbody>';

							  

							  if($results[0]['admin_type']=='zone')

							  {

								$msg.='<tr><th class="header">Zone Name</th>';

								$msg.='<th class="header">'.$results[0]['Name'].'</th>';

							  }

							  if($results[0]['admin_type']=='state')

							  {

								$msg.='<tr><th class="header">State Name</th>';

								$msg.='<th class="header">'.$results[0]['Name'].'</th>';

							  }

							  if($results[0]['admin_type']=='state_zone')

							  {

								$msg.='<tr><th class="header">State Zone Name</th>';

								$msg.='<th class="header">'.$results[0]['Name'].'</th>';

							  }

								$msg.='

							  </tr>

							  <tr>

								<th class="header">Coordinator Name</th>  

								<th class="header">'.$results[0]['First_name'].'</th>

							  </tr>

							  <tr>             

								<th class="header">Address1</th>

								<th class="header">'.$results[0]['Mailing_address1'].'</th>

							  </tr>

							   <tr>             

								<th class="header">Address2</th>

								<th class="header">'.$results[0]['Mailing_address2'].'</th>

							  </tr>

							  <tr>

								<th class="header">State</th>

								<th class="header">'.$results[0]['State'].'</th>

							  </tr>

							  <tr>

								<th class="header">Zip</th>

								<th class="header">'.$results[0]['Zipcode'].'</th>

							  </tr>

							  <tr>

								<th class="header">Email</th>

								<th class="header">'.$results[0]['Email_address'].'</th>

							  </tr>

							  <tr>

								<th class="header">Phone</th>

								<th class="header">'.$results[0]['Home_phone'].','.$results[0]['Cell_phone'].'</th>

							  </tr>

							  <tr>';

							  if($results[0]['admin_type']!='national' )

							   { 

								$msg.='<th class="header">National Coordinator</th>';

								$n_coord = $this->db->query("SELECT a.*,b.* FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id WHERE a.id='".$results[0]['National_admin_id']."'")->row_array();

							    $msg.='<th class="header">'.$n_coord['First_name'].'</th>';

							   }

							  $msg.='</tr>

					  		  <tr>';

							   if($results[0]['admin_type']=='state' || $results[0]['admin_type']=='state_zone' )

							   { 

								 $msg.='<th class="header">Zone Coordinator</th>';

								 $z_coord = $this->db->query("SELECT a.*,b.* FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id WHERE a.id='".$results[0]['Zonal_admin_id']."'")->row_array();

							     $msg.='<th class="header">'.$z_coord['First_name'].'</th>';

							   }

					   $msg.='</tr>

							  <tr>';

							  if($results[0]['admin_type']=='state_zone' )

							   { 

								 $msg.='<th class="header">State Coordinator</th>';

								 $z_coord = $this->db->query("SELECT a.*,b.* FROM kr_users a inner join kr_distributers b on a.Distributer_id=b.id WHERE a.id='".$results[0]['State_admin_id']."'")->row_array();

							     $msg.='<th class="header">'.$z_coord['First_name'].'</th>';

							   }

					   $msg.='</tr>

							  

						</tbody>

						</table>

					</div>';

			echo $msg;

		}

	}

	public function distributer_detail() 

	{

		$id     = $this->input->post('id'); 

		$result = $this->db->query("SELECT * FROM kr_distributers WHERE id='$id'")->row_array();

		echo json_encode($result);

	}

	

	public function email_check()

	{

		$msg='';

		if($this->input->post())

		{

			$Email  = str_replace("'", "",$this->input->post('email'));

			$type   = $this->input->post('type');

			$Exist_user		=   $this->db->query("SELECT * FROM kr_users WHERE `Email_address`='$Email' and admin_type='$type'");

			if($Exist_user->num_rows()>0)

			{ 

				$msg="Email address already exist.";

			}

			echo $msg;

		}

	}

	public function email_check_sub()

	{

		$msg='';

		if($this->input->post())

		{

			$Email  = str_replace("'", "",$this->input->post('email'));

			$Exist_user		=   $this->db->query("SELECT * FROM kr_subscribers WHERE `Email_address`='$Email'");

			if($Exist_user->num_rows()>0)

			{ 

				$msg="Email address already exist.";

			}

			echo $msg;

		}

	}

	

	public function duplicate_zone()

	{

		$msg='';

		if($this->input->post())

		{

			$value  = $this->input->post('value');

			$res    = $this->db->query("SELECT * FROM kr_users WHERE Name='$value' and admin_type='zone'");

			if($res->num_rows()>0)

			{ 

				$msg="Zone already exist.";

			}

			echo $msg;

		}

	}

	

	public function duplicate_state_zone()

	{

		$msg='';

		if($this->input->post())

		{

			$value  = $this->input->post('value');

			$res    = $this->db->query("SELECT * FROM kr_users WHERE Name='$value' and admin_type='state_zone'");

			if($res->num_rows()>0)

			{ 

				$msg="State zone already exist.";

			}

			echo $msg;

		}

	}



}


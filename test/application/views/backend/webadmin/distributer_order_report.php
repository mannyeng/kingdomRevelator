<style>

/*.row-fluid

{

min-width:1600px !important;	

	}

	#main-content

	{

	min-width:1700px !important;	

		}*/

</style>

<div id="main-content" >

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Bulk Subscriber Order List

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="webadmin">Dashboard</a>

						<span class="divider">/</span>

					</li>

                   

					<li class="active">

						Bulk Subscriber Order List

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		

        <div class="row-fluid">

       

          <div class="well" style="margin-bottom: 20px;">

           

            <?php

          

            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
            echo form_open('webadmin/distributer_orders/'.$this->uri->segment(3), $attributes);
           

           /*  //save the columns names in a array that we will use as filter         

            $options_retreats = array('t.group_id'=>'Group ID','m.first_name'=>'First Name','m.last_name'=>'Last Name','m.age'=>'Age','m.gender'=>'Gender','t.state'=>'State','t.country'=>'Country');    

			

			$filter_retreats = array(''=>'All','zone'=>'Zone','state'=>'State','state zone'=>'State zone','county'=>'County','distributer'=>'Distributer');    

            
*/


           

     

              echo 'Bulk Subscriber ID:';

              echo form_input('search_string', @$search_string, 'class="form-control" style="width:120px"');

			  

			/*  echo form_label('Filter by:', 'filter');

              echo form_dropdown('filter', $filter_retreats,@$filter, 'class="form-control span1" id="filter"  onchange="getData(this.value,0);"');

			  

			  echo form_label('Filter by:', 'users');

              echo form_dropdown('users','',@$users,'class="form-control span1" id="Users"');*/

			  

			  echo 'From:';

			  echo '<div data-form="datetimepicker" class="input-append date" style="display:inline;margin-right: 2%;">';

              echo form_input('from_date', @$from_date_selected, 'class="form-control" id="from_date" data-format="yyyy-MM-dd" readonly style="width:120px" ');

			  echo '<span class="add-on">

                <i data-time-icon="icon-time" data-date-icon="icon-calendar">

                  </i>

                </span></div>';

			  

			   echo 'To:';

			   echo '<div data-form="datetimepicker" class="input-append date" style="display:inline;margin-right: 2%;">';

              echo form_input('to_date', @$to_date_selected, 'class="form-control" id="to_date" data-format="yyyy-MM-dd" readonly style="width:120px" ');

			  echo '<span class="add-on">

                <i data-time-icon="icon-time" data-date-icon="icon-calendar">

                  </i>

                </span></div>';

			  

              /*echo form_label('Order by:', 'order');

              echo form_dropdown('order', $options_retreats, $order, 'class="form-control span1"');*/



             $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');



              /*$options_order_type = array('Asc' => 'Ascending', 'Desc' => 'Descending');

              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control span1"');*/



             echo form_submit($data_submit);

  echo '<a href="'.base_url().'webadmin/distributer_resetform" class="btn btn-danger" />Reset</a>';

            echo form_close();

			            ?>

       

          </div>

          </div>

          <?php if($this->session->flashdata('flash_message')){

        if($this->session->flashdata('flash_message') == 'updated')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Group updated successfully.';

          echo '</div>';       

        }

      }

	  ?>

          

		<!-- BEGIN ADVANCED TABLE widget-->

      <p><a href="webadmin/export_distributers_orders" class="btn btn-danger">Export</a></p>

        <div class="row-fluid">

			<div class="span12">

				<!-- BEGIN EXAMPLE TABLE widget-->

				<div class="widget blue">

					<div class="widget-title">

						<h4><i class="icon-reorder"></i> List All </h4>

						<span class="tools">

							<a href="javascript:;" class="icon-chevron-down"></a>

						</span>

					</div>

					<div class="widget-body">

						<table class="table table-striped table-bordered table-condensed" id="sample_1">

							<thead>

           

                <th class="header">ID</th>

                <th class="header">First Name</th>

                <th class="header">Last Name</th>                

                <th class="header">City</th>

                <th class="header">State</th>

                <th class="header">Zip</th>

                <th class="header">National Coordinator</th>

                <th class="header">Zone Coordinator</th>

                <th class="header">State Coordinator</th>

                <th class="header">State zone Coordinator</th>

                <th width="60" class="header">Subscription Date</th>  

                <th width="60" class="header">Expiration Date</th>  

                <th width="60" class="header">No of copies</th>  
                 <th width="60" class="header">No of Months</th> 

                <th  class="header">Total days/Payment status</th>  

              

               <?php  if( $this->session->userdata('role') =='webadmin'):           

                //echo '<td class="crud-actions" align="center">  Action</td>';

				endif;

				?>                                     

              </tr>

            </thead>

            <tbody>

              <?php

			  	$price  = $this->db->query("SELECT * FROM kr_book_price ")->row_array();

			  	$res_cnt=0;

if(!empty($subscriber)) {
              foreach($subscriber as $ind=>$result)

              {	

			 	if($result['sub_id']!='')
			 	{

				//$this->db->join('kr_subscribers','kr_subscribers.Distributer_id=kr_users.id','right');
                $this->db->join('kr_distributers','kr_distributers.User_id=kr_users.id','right');
			    $rows = $this->db->get_where('kr_users',array('kr_users.login_id'=>$result['Distributer_id']))->result_array();
			  // echo $this->db->last_query();
			    

				foreach($rows as $ind=>$row)

				{
					//print_r($rows);

				/*	if($result['Subscriptions']==$price['1_yr_price'])

					{

						 $dateString = $result['subscription_date'];

						 $t = strtotime($dateString);

						 $expiry_date = date('Y-m-d',strtotime('+1 years', $t));

						//echo $expiry_date = date('Y-m-d',strtotime($result['subscription_date'])+strtotime('+5 years'));

					}

					if($result['Subscriptions']==$price['2_yr_price'])

					{

						 $dateString = $result['subscription_date'];

						 $t = strtotime($dateString);

						 $expiry_date = date('Y-m-d',strtotime('+2 years', $t));

						//echo $expiry_date = date('Y-m-d',strtotime($result['subscription_date'])+strtotime('+5 years'));

					}*/

					if(isset($row['National_admin_id']))

					{

						$national_coord   = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['National_admin_id']." ")->row_array();

					}

					if(isset($row['Zonal_admin_id']))

					{

						$zone_coord       = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['Zonal_admin_id']." ")->row_array();						

					}

					if(isset($row['State_admin_id']))

					{

						$state_coord      = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['State_admin_id']." ")->row_array();

					}

					if(isset($row['State_zone_admin_id']))

					{

						$state_zone_coord = $this->db->query("select a.id as user_id,a.National_admin_id,a.Zonal_admin_id,a.State_admin_id,a.State_zone_admin_id,b.First_name as First_name from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.id=".$row['State_zone_admin_id']." ")->row_array();	

					}

				//}

				



				  $res_pay    = $this->db->get_where('kr_payment',array('Subscriber_id'=>$result['id']))->row_array();

				



				  	//$counts=explode("#$",$result['counts']);

					

					//$balance = $counts[3] - $result['paid_amt'];

					//$pending=(($counts[1]-$result['waitl']) < 0)? 0 :($counts[1]-$result['waitl']);		

	                echo '<tr>';

	                

					echo '<td>'.$result['sub_id'].'</td>';

	                echo '<td>'.$result['First_name'].'</td>';

					echo '<td>'.$result['Last_name'].'</td>';

					echo '<td>'.$result['City'].'</td>';

					echo '<td>'.$result['State'].'</td>';

					echo '<td>'.$result['Zipcode'].'</td>';

					/*echo '<td>'.$row['First_name'].'</td>';*/

					echo '<td>';if(isset($row['National_admin_id'])){ echo $national_coord['First_name'];} echo '</td>';

					echo '<td>';if(isset($row['Zonal_admin_id'])){ echo $zone_coord['First_name']; } echo'</td>';

					echo '<td>';if(isset($row['State_admin_id'])){ echo $state_coord['First_name']; } echo'</td>';

					echo '<td>';if(isset($row['State_zone_admin_id'])){ echo $state_zone_coord['First_name']; } echo'</td>';

					//echo '<td>'. number_format($balance,2).'</td>';

					if($result['subscription_date']!=''){ echo '<td>'.date('Y-m-d',strtotime($result['subscription_date'])).'</td>';	}

					if($result['expiry_date']!=''){ echo '<td>'.date('Y-m-d',strtotime($result['expiry_date'])).'</td>';}

					echo '<td>'.@$result['Total_copies'].'</td>';
					echo '<td>'.@$result['subscription_length'].'</td>';

					echo '<td>'.$this->Distributer_model->subscription_status($result['id']).' / '.ucfirst($this->Distributer_model->validate_subscription($result['id'])).'</td>';


					

							

	                if( $this->session->userdata('role') =='webadmin'):           

	               

	               		  				//else:

					   /*echo '<td class="crud-actions" align="center">

	                 <a href="County/subscribers_list/'.$result['id'].'" class="btn btn-info">view subscribers</a>&nbsp;';*/

					endif;

					if($res_pay['Mode_of_pay']=='cash' || $res_pay['Mode_of_pay']=='cheque'  )

					{

					//echo '<a href="national/subscribers_payment/'.$result['id'].'/'.$this->uri->segment(3).'" class="btn btn-info">Update</a>&nbsp;</td>';

					}

	                echo '</tr>';

	                $row['National_admin_id']='';



	               //  break;

               // $res_cnt++;

               }



	               }
	           }

              }

              ?>  

          	  </tbody>

						</table>

					</div>

				</div>

				<!-- END EXAMPLE TABLE widget-->

			</div>

		</div>



		<!-- END ADVANCED TABLE widget-->

	</div>

	<!-- END PAGE CONTAINER-->

</div>

<script>





$(document).ready(function(){

var id=$('#filter').val();

<?php

if(!isset($users)) 

{

?>

	var user='0';

<?php

}

else

{

?>

	var user='<?php echo $users ?>';

<?php

}

?>

getData(id,user);

})

function getData(id,user)

{

	$.ajax({

		method:'POST',

		data:"id="+id+"&users="+user,

		url:"Ajaxaction/users",

		success:function getstate($msg)

		{

			$('#Users').html('');

			$('#Users').append($msg);

		}

		

		})

}

</script>

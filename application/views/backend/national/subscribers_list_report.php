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
<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->   
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Subscribers List
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="national">Dashboard</a>
						<span class="divider">/</span>
					</li>
                    <li>
						<a href="national">National</a>
						<span class="divider">/</span>
					</li>
                    <li>
						<a href="national/zone_list">Zone List</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="national/state_list">State List</a>
						<span class="divider">/</span>
					</li>
                    <li>
						<a href="national/state_zone_list">State Zone</a>
						<span class="divider">/</span>
					</li>
                    <li>
						<a href="national/county_list">County List</a>
						<span class="divider">/</span>
					</li>
                    <li>
						<a href="national/distributers_list">Distributers List</a>
						<span class="divider">/</span>
					</li>
					<li class="active">
						Subscribers List
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		
        <div class="row-fluid">
       
          <div class="well">
           
            <?php
           
            $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_retreats = array('t.group_id'=>'Group ID','m.first_name'=>'First Name','m.last_name'=>'Last Name','m.age'=>'Age','m.gender'=>'Gender','t.state'=>'State','t.country'=>'Country');    
			
			$filter_retreats = array(''=>'All','zone'=>'Zone','state'=>'State','state zone'=>'State zone','county'=>'County','distributer'=>'Distributer');    
            

            echo form_open('national/subscribers_list_report/'.$this->uri->segment(3), $attributes);
     
             /* echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'class="form-control" style="width:120px"');*/
			  
			  echo form_label('Filter by:', 'filter');
              echo form_dropdown('filter', $filter_retreats,@$filter, 'class="form-control span1" id="filter"  onchange="getData(this.value,0);"');
			  
			  echo form_label('Filter by:', 'users');
              echo form_dropdown('users','',@$users,'class="form-control span1" id="Users"');
			  
			  echo form_label('From:', 'from_date');
			  echo '<div data-form="datetimepicker" class="input-append date" style="display:inline">';
              echo form_input('from_date', @$from_date_selected, 'class="form-control" id="from_date" data-format="MM-dd-yyyy" style="width:120px" ');
			  echo '<span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                  </i>
                </span></div>';
			  
			   echo form_label('To:', 'to_date');
			   echo '<div data-form="datetimepicker" class="input-append date" style="display:inline">';
              echo form_input('to_date', @$to_date_selected, 'class="form-control" id="to_date" data-format="MM-dd-yyyy" style="width:120px" ');
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
      <p><a href="national/export/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">Export</a></p>
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
              <tr>
                <th class="header">#</th>
                <th class="header">ID</th>
                <th class="header">First Name</th>
                <th class="header">Last Name</th>                
                <th class="header">City</th>
                <th class="header">State</th>
                <th class="header">Zip</th>
                <th class="header">National Coordinator</th>
                <th class="header">Zone Coordinator</th>
                <th class="header">State Coordinator</th>
                <th class="header">State Zone Coordinator</th>
                <th class="header">Distributer</th>
                <th class="header">No .of copies</th>
                <th width="60" class="header">Subscription Time</th>  
                <th width="60" class="header">Expiration Time</th>                                          
              </tr>
            </thead>
            <tbody>
              <?php
			  if(isset($subscriber))
			  {
				  foreach($subscriber as $ind=>$row)
				  {	
					if($row['Subscriptions']==25)
					{
						 $dateString = $row['subscription_date'];
						 $t = strtotime($dateString);
						 $expiry_date = date('Y-m-d',strtotime('+1 years', $t));
						//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));
					}
					if($row['Subscriptions']==45)
					{
						 $dateString = $row['subscription_date'];
						 $t = strtotime($dateString);
						 $expiry_date = date('Y-m-d',strtotime('+2 years', $t));
						//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));
					}
					$res_data  = $this->db->query("SELECT * FROM kr_users Where id='".$row['Distributer_id']."'");
					$res_array = $res_data->result_array();
					$national='';
					$zone='';
					$state='';
					$state_zone='';
					$distributer='';
					foreach($res_array as $ind1=>$row1)
				    {
						$distributer     			= $row1['First_name'];
						
						$res_state_zone  			= $this->db->query("SELECT * FROM kr_users Where id='".$row1['State_zone_admin_id']."'");
						$res_state_zone_array       = $res_state_zone->result_array();
						if($res_state_zone->num_rows()>0)
						{
							$state_zone					= $res_state_zone_array[0]['Name'];
						}
						
						$res_state  			    = $this->db->query("SELECT * FROM kr_users Where id='".$row1['State_admin_id']."'");
						$res_state_array	        = $res_state->result_array();
						if($res_state->num_rows()>0)
						{
							$state						= $res_state_array[0]['Name'];
						}
						
						$res_zone  			        = $this->db->query("SELECT * FROM kr_users Where id='".$row1['Zonal_admin_id']."'");
						$res_zone_array	       		= $res_zone->result_array();
						if($res_zone->num_rows()>0)
						{
							$zone						= $res_zone_array[0]['Name'];
						}
						
						$res_national		        = $this->db->query("SELECT * FROM kr_users Where id='".$row1['National_admin_id']."'");
						$res_national_array	      	= $res_national->result_array();
						if($res_zone->num_rows()>0)
						{
							$national					= $res_national_array[0]['First_name'];
						}
					}
					//$counts=explode("#$",$row['counts']);
					
					//$balance = $counts[3] - $row['paid_amt'];
					//$pending=(($counts[1]-$row['waitl']) < 0)? 0 :($counts[1]-$row['waitl']);		
					echo '<tr>';
					echo '<td>'.($ind+1).'</td>';
					echo '<td>'.$row['id'].'</td>';
					echo '<td>'.$row['First_name'].'</td>';
					echo '<td>'.$row['Last_name'].'</td>';
					echo '<td>'.$row['City'].'</td>';
					echo '<td>'.$row['State'].'</td>';
					echo '<td>'.$row['Zipcode'].'</td>';
					echo '<td>'.$national.'</td>';
					echo '<td>'.$zone.'</td>';
					echo '<td>'.$state.'</td>';
					echo '<td>'.$state_zone.'</td>';
					echo '<td>'.$distributer.'</td>';
					echo '<td>'.$row['No_of_copies'].'</td>';
					//echo '<td>'. number_format($balance,2).'</td>';
					echo '<td>'.date('Y-m-d',strtotime($row['subscription_date'])).'</td>';	
					echo '<td>'.$expiry_date.'</td>';			
					// if( $this->session->userdata('role') !='coordinator'):           
				//    echo '<td class="crud-actions" align="center">
					//  <a href="groups/update/'.$row['retreat_id'].'/'.$row['group_id'].'" class="btn btn-info">Edit</a>&nbsp;';				  				//else:
					   /*echo '<td class="crud-actions" align="center">
					 <a href="County/subscribers_list/'.$row['id'].'" class="btn btn-info">view subscribers</a>&nbsp;';*/
					//endif;
					echo '</td></tr>';
					$national='';
					$zone='';
					$state='';
					$state_zone='';
					$distributer='';
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
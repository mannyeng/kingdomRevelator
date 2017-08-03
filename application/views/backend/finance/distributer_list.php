
<?php

$this->db->where('kr_users.admin_type','state_zone');  
$this->db->where('kr_users.id',$this->uri->segment('3'));
$res_state_zone = $this->db->get_where('kr_users')->row_array();

$this->db->where('kr_users.admin_type','state');  
$this->db->where('kr_users.id',$res_state_zone['State_admin_id']);
$res_state = $this->db->get_where('kr_users')->row_array();


$this->db->where('kr_users.admin_type','zone');  
$this->db->where('kr_users.id',$res_state['Zonal_admin_id']);
$res_zone = $this->db->get_where('kr_users')->row_array();

$this->db->where('kr_users.admin_type','national');  
$this->db->where('kr_users.id',$res_zone['National_admin_id']);
$this->db->select('kr_users.id as user_id,kr_distributers.*');
$this->db->join('kr_distributers','kr_distributers.id=kr_users.Distributer_id','Inner');  
$res_national = $this->db->get_where('kr_users')->row_array();



?>


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
<div id="main-content" style="width:120%;">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->   
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Distributers List
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo $this->session->userdata('role');?>">Dashboard</a>
						<span class="divider">/</span>
					</li>
                    <?php if(in_array($this->session->userdata('role'),array('webadmin'))):	?>
                    <li>
						<a href="webadmin/national_list"><?php echo $res_national['First_name'];?></a>
						<span class="divider">/</span>
					</li>
                    <?php endif;?>
                    <?php if(in_array($this->session->userdata('role'),array('national','webadmin'))):	?>
                    <li>
						<a href="national/zone_list/<?php echo $res_national['user_id'];?>"><?php echo $res_zone['Name'];?></a>
						<span class="divider">/</span>
					</li>
                    <?php endif;?>
                    <?php if(in_array($this->session->userdata('role'),array('zone','national','webadmin'))):	?>
					<li>
						<a href="national/state_list/<?php echo $res_zone['id'];?>"><?php echo $res_state['Name'];?></a>
						<span class="divider">/</span>
					</li>
                    <?php endif;?>
                    <?php if(in_array($this->session->userdata('role'),array('state','zone','national','webadmin'))):	?>
                    <li>
						<a href="national/state_zone_list/<?php echo $res_state['id'];?>"><?php echo $res_state_zone['Name'];?></a>
						<span class="divider">/</span>
					</li>
                    <?php endif;?>
					<li class="active">
						Distributers List
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		
        <div class="row-fluid">
       
          <div class="well">
           
            <?php
           
           /* $attributes = array('class' => 'form-inline reset-margin', 'id' => 'myform');
           
            //save the columns names in a array that we will use as filter         
            $options_retreats = array('t.group_id'=>'Group ID','m.first_name'=>'First Name','m.last_name'=>'Last Name','m.age'=>'Age','m.gender'=>'Gender','t.state'=>'State','t.country'=>'Country');    
			
			$filter_retreats = array(''=>'All','t_lead'=>'Team Leads','air_p_yes'=>'Airport Pickup','air_d_yes'=>'Airport Dropoff','t_special'=>'Special Request','r_paid'=>'Paid','r_unpaid'=>'Unpaid','m_pen'=>'Pending','m_cnfrm'=>'Confirmed','m_wait'=>'Waiting','m_can'=>'Cancelled','t_bal'=>'Balance');    
            

            echo form_open('groups/index/'.$this->uri->segment(3), $attributes);
     
              echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'class="form-control" style="width:120px"');
			  
			  echo form_label('Filter by:', 'filter');
              echo form_dropdown('filter', $filter_retreats, $filter, 'class="form-control span1"');
			  
			  echo form_label('From:', 'from_date');
			  echo '<div data-form="datetimepicker" class="input-append date" style="display:inline">';
              echo form_input('from_date', $from_date_selected, 'class="form-control" id="from_date" data-format="MM-dd-yyyy" style="width:120px" ');
			  echo '<span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                  </i>
                </span></div>';
			  
			   echo form_label('To:', 'to_date');
			   echo '<div data-form="datetimepicker" class="input-append date" style="display:inline">';
              echo form_input('to_date', $to_date_selected, 'class="form-control" id="to_date" data-format="MM-dd-yyyy" style="width:120px" ');
			  echo '<span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                  </i>
                </span></div>';
			  
              echo form_label('Order by:', 'order');
              echo form_dropdown('order', $options_retreats, $order, 'class="form-control span1"');

              $data_submit = array('name' => 'mysubmit', 'class' => 'btn btn-primary', 'value' => 'Go');

              $options_order_type = array('Asc' => 'Ascending', 'Desc' => 'Descending');
              echo form_dropdown('order_type', $options_order_type, $order_type_selected, 'class="form-control span1"');

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
      }*/
	  ?>
          
		<!-- BEGIN ADVANCED TABLE widget-->
<!--      <p><a href="groups/export/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">Export</a></p>
-->        <div class="row-fluid">
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
                <th class="header">Email</th>                
                <th class="header">City</th>
                <th class="header">State</th>
                <th class="header">Zip</th>
                <th width="60" class="header">Reg. Time</th>  
                <th width="60" class="header">Subscription Time</th>  
                <th width="60" class="header">Expiration Time</th>  
                <th width="60" class="header">Subscription length</th> 
                <th width="60" class="header">Mode of payment</th>
                <th width="60" class="header">Transaction id</th> 
                <th width="60" class="header">Cash/Cheque by</th> 
                <th width="60" class="header">Comments</th> 
                <th width="60" class="header">Amount</th> 
                <th width="60" class="header">Amount Paid</th> 
                <th width="60" class="header">Payment Status</th>  
                                        
                <th width="120" class="red header" align="center">Subscribers</th>
               <?php
			    if(in_array($this->session->userdata('role'),array('webadmin','national')))
				{
					?>
                <th class="header">Action</th> 
                <?php
				} 
				?>
              </tr>
            </thead>
            <tbody>
              <?php
			  			  	$price  = $this->db->query("SELECT * FROM kr_book_price ")->row_array();

              foreach($distributer as $ind=>$row)
              {	
			 
				$res_pay    = $this->db->get_where('kr_dis_payment',array('Subscriber_id'=>$row['disributer_id']))->row_array();
			  	//$counts=explode("#$",$row['counts']);
				
				//$balance = $counts[3] - $row['paid_amt'];
				//$pending=(($counts[1]-$row['waitl']) < 0)? 0 :($counts[1]-$row['waitl']);		
                echo '<tr>';
                echo '<td>'.($ind+1).'</td>';
				echo '<td>'.$row['disributer_id'].'</td>';
                echo '<td>'.$row['First_name'].'</td>';
				echo '<td>'.$row['Last_name'].'</td>';
				echo '<td>'.$row['Email_address'].'</td>';
				echo '<td>'.$row['City'].'</td>';
				echo '<td>'.$row['State'].'</td>';
				echo '<td>'.$row['Zipcode'].'</td>';
				
				//echo '<td>'. number_format($balance,2).'</td>';
				echo '<td>'.$row['created'].'</td>';	
				echo '<td>'.$row['subscription_date'].'</td>';	
				echo '<td>'.$row['expiry_date'].'</td>';
				if($row['Subscriptions']==$price['1_yr_price']){echo '<td>1-year</td>';}else{echo '<td>2-year</td>';}		
				echo '<td>'.$res_pay['Mode_of_pay'].'</td>';
				echo '<td>'.$res_pay['txn_id'].'</td>';	
				echo '<td>'.$row['Cash_Check_by'].'</td>';	
				echo '<td>'.$row['comments'].'</td>';
				echo '<td>'.$row['Total_amount'].'</td>';
				echo '<td>'.$res_pay['paid_amnt'].'</td>';
				echo '<td>'.$res_pay['paypal_status'].'</td>';			
                // if( $this->session->userdata('role') !='coordinator'):           
            //    echo '<td class="crud-actions" align="center">
                //  <a href="groups/update/'.$row['retreat_id'].'/'.$row['group_id'].'" class="btn btn-info">Edit</a>&nbsp;';				  				//else:
				   echo '<td class="crud-actions" align="center">
                 <a href="national/subscribers_list/'.$row['User_id'].'" class="btn btn-info">view </a>&nbsp;';
				//endif;
				if($row['flag']==0)
				{
					//echo '<a href="javascript:;" class="btn btn-error">Not allocated  </a>&nbsp;';
				}
                echo '</td>';
				if(in_array($this->session->userdata('role'),array('webadmin','national')))
				{
					echo '<td>';
					 $dist_cnt = $this->db->query("SELECT * FROM kr_users WHERE Distributer_id='".$row['id']."' ")->num_rows();
					 $sub_cnt  = $this->db->query("SELECT * FROM kr_subscribers WHERE Distributer_id='".$row['User_id']."' ")->num_rows();
					 if($dist_cnt==0 && $sub_cnt==0)
					 {
					   echo '<a href="webadmin/delete_dist/'.$row['disributer_id'].'/'.$this->uri->segment(3).'" class="btn btn-danger">Delete </a> &nbsp;&nbsp;';
					 }
					 echo '<a href="national/distributers_payment/'.$row['disributer_id'].'/'.$this->uri->segment(3).'/'.$row['User_id'].'" class="btn btn-info">Update Payment </a> &nbsp;&nbsp;';

					echo '</td>';
				 }
				echo '</tr>';
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
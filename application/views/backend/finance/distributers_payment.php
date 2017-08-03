

<?php

$this->db->where('kr_users.admin_type','Distributer');  
$this->db->where('kr_users.id',$this->uri->segment('5'));
$this->db->select('kr_users.id as user_id,kr_users.State_zone_admin_id,kr_distributers.*');
$this->db->join('kr_distributers','kr_distributers.User_id=kr_users.id','Inner');  
$res_distributers = $this->db->get_where('kr_users')->row_array();

$this->db->where('kr_users.admin_type','state_zone');  
$this->db->where('kr_users.id',$res_distributers['State_zone_admin_id']);
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
$res_subscriber = $this->db->get_where('kr_subscribers',array('id'=>$this->uri->segment(3)))->row_array();


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
<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->   
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Update Payment Status
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
                    <?php endif; ?>
                    <?php if(in_array($this->session->userdata('role'),array('state','zone','national','webadmin'))):	?>
                    <li>
						<a href="national/state_zone_list/<?php echo $res_state['id'];?>"><?php echo $res_state_zone['Name'];?></a>
						<span class="divider">/</span>
					</li>
                    <?php endif;?>
                    <li>
						<a href="national/distributers_list/<?php echo $res_state_zone['id'];?>"><?php echo $res_distributers['First_name'];?></a>
						<span class="divider">/</span>
					</li>
                    
					<li class="active">
						update status
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
<?php /*?>      <p><a href="webadmin/export_subscribers/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">Export</a></p>
<?php */?>        <div class="row-fluid">
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
                    <form method="post" action="national/distributers_payment/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>/<?php echo $this->uri->segment(5);?>">
						<table class="table table-striped table-bordered table-condensed" id="sample_1">
							<thead>
              <tr>
                <th class="header">Payment Method</th>
                <th class="header">Total Amount</th>
                <th class="header">Paid Amount</th>                
                <th class="header">Txn Details</th>
              </tr>
            </thead>
            <tbody>
              <?php
			  	$row        = $this->db->get_where('kr_distributers',array('disributer_id'=>$this->uri->segment(3)))->row_array();
				$res_pay    = $this->db->get_where('kr_dis_payment',array('Subscriber_id'=>$this->uri->segment(3)))->row_array();
				

			  	//$counts=explode("#$",$row['counts']);
				
				//$balance = $counts[3] - $row['paid_amt'];
				//$pending=(($counts[1]-$row['waitl']) < 0)? 0 :($counts[1]-$row['waitl']);		
                echo '<tr>';
				echo '<td>'.$res_pay['Mode_of_pay'].'</td>';
                echo '<td>'.$row['Total_amount'].'</td>';
				echo '<td><input name="Amount" value="'.$res_pay['paid_amnt'].'" placeholder="Amount" type="text" class="span6"></td>';
				echo '<td><input name="Cheque_Number" value="'.$res_pay['cheque_num'].'" placeholder="Cheque Number" type="text" class="span6">&nbsp;<input name="Account_Number" value="'.$res_pay['acc_num'].'" placeholder="Account Number" type="text" class="span6">&nbsp;<br><br><input name="Issue_Date" value="'.$res_pay['date_of_pay'].'" placeholder="Issue Date" type="date" class="span6">&nbsp;<input name="Bank_Detail" value="'.$res_pay['bank_detail'].'" placeholder="Bank Detail" type="text" class="span6">&nbsp;<br><br><input name="Note" value="'.$res_pay['notes'].'" placeholder="Note" type="text" class="span12"></td>';
				echo '</tr>';
              ?>      
            </tbody>
						</table>
                        
                        <input name="submit" value="Submit" placeholder="" type="submit" class=""></td>
                        </form>
					</div>
				</div>
				<!-- END EXAMPLE TABLE widget-->
			</div>
		</div>

		<!-- END ADVANCED TABLE widget-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>
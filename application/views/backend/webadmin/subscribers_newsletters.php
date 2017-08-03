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
						<a href="webadmin">Dashboard</a>
						<span class="divider">/</span>
					</li>
                   
                    <!--<li>
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
					</li>-->
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
          <?php if($this->session->flashdata('alert')=='success'){
		  ?>
          <script>
		  	alert('You Successfully Subscribed News letter');
		  </script>
          <?php
		  }
			?>
		<!-- BEGIN ADVANCED TABLE widget-->
<!--      <p><a href="webadmin/export_subscribers/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">Export</a></p>
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
                <th class="header">Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($subscriber as $ind=>$row)
              {	
			 	
			  	//$counts=explode("#$",$row['counts']);
				
				//$balance = $counts[3] - $row['paid_amt'];
				//$pending=(($counts[1]-$row['waitl']) < 0)? 0 :($counts[1]-$row['waitl']);		
                echo '<tr>';
                echo '<td>'.($ind+1).'</td>';
				echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['Email'].'</td>';
			
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
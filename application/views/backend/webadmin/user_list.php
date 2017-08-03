<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->   
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Users List
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="webadmin">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="webadmin">Web Admin</a>
						<span class="divider">/</span>
					</li>
					<li class="active">
						List
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
            

            echo form_open('webadmin/user_list/'.$this->uri->segment(3), $attributes);
     
             /* echo form_label('Search:', 'search_string');
              echo form_input('search_string', $search_string_selected, 'class="form-control" style="width:120px"');*/
			  
			  echo form_label('Filter by:', 'filter');
              echo form_dropdown('filter', $filter_retreats,@$filter, 'class="form-control span1" id="filter"  onchange="getData(this.value,0);"');
			  
			 /* echo form_label('Filter by:', 'users');
              echo form_dropdown('users','',@$users,'class="form-control span1" id="Users"');*/
			  
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
		<!-- END PAGE HEADER-->
		<?php if($this->session->flashdata('success') || $this->session->flashdata('info') || $this->session->flashdata('error')) { ?>
		<!-- BEGIN Alert widget-->
		<div class="row-fluid">
			<div class="span12">
				<?php if($this->session->flashdata('success')) { ?>
				<div class="alert alert-success">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php } ?>
				<?php if($this->session->flashdata('info')) { ?>
				<div class="alert alert-info">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Info!</strong> <?php echo $this->session->flashdata('info'); ?>
				</div>
				<?php } ?>
				<?php if($this->session->flashdata('error')) { ?>
				<div class="alert alert-error">
					<button class="close" data-dismiss="alert">×</button>
					<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<!-- END Alert widget-->
		<?php } ?>
		<!-- BEGIN ADVANCED TABLE widget-->
       <p><a href="webadmin/export_users/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">Export</a></p>

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
						<table class="table table-striped table-bordered" id="sample_1">
							<thead>
								<tr>
                                    <th>Id</th>
									<th>Username</th>
                                    <th>Email</th>
									<th>Role</th>									
									<th class="center span3">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$roles=array('coordinator'=>'Local Coordinator','officer'=>'Office Admin','manager'=>'Retreat Admin');
								foreach ($users as $user) {
									?>
									<tr>
										 <?php
										if($user['admin_type']=='Distributer')
										{
									?>
                                   		<td><?php echo $user['Distributer_id']; ?></td>	
                                     <?php
										}
										else
										{
									 ?>
                                     	<td><?php echo $user['id']; ?></td>	
                                     <?php
										}
									?>
										<td><?php echo $user['First_name']; ?></td>
                                        <th><?php echo $user['Email_address']; ?></th>
										<td><?php echo $user['admin_type']; ?></td>									
										<td class="actions center">
											<a class="btn btn-edit" href="webadmin/user_add/<?php echo $user['id']; ?>"><i class="icon-edit icon-white"></i> Edit</a>
											<a class="btn btn-danger del" href="webadmin/user_delete/<?php echo $user['id']; ?>"><i class="icon-trash icon-white"></i> Delete</a>
										</td>
									</tr>
									<?php
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
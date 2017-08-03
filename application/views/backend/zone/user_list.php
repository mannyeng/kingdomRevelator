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
						<a href="zone">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="zone">Zone</a>
						<span class="divider">/</span>
					</li>
					<li class="active">
						List
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
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
										<td><?php echo $user['First_name']; ?></td>
                                        <th><?php echo $user['Email_address']; ?></th>
										<td><?php echo $user['admin_type']; ?></td>									
										<td class="actions center">
											<a class="btn btn-edit" href="zone/user_add/<?php echo $user['id']; ?>"><i class="icon-edit icon-white"></i> Edit</a>
											<a class="btn btn-danger del" href="zone/user_delete/<?php echo $user['id']; ?>"><i class="icon-trash icon-white"></i> Delete</a>
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
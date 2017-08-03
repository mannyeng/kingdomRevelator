<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->   
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Books List
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="webadmin">Dashboard</a>
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
		<?php if($this->session->flashdata('success') || $this->session->flashdata('info') || $this->session->flashdata('error') || $this->session->flashdata('update_book') || $this->session->flashdata('add_book')) { ?>
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
                <?php if($this->session->flashdata('add_book')){
				  echo '<div class="alert alert-success">';
					echo '<a class="close" data-dismiss="alert">×</a>';
					echo 'New book created successfully.';
				  echo '</div>';          
				}
				elseif($this->session->flashdata('update_book'))
				{
				  echo '<div class="alert alert-success">';
					echo '<a class="close" data-dismiss="alert">×</a>';
					echo 'Book updated successfully.';
				  echo '</div>';       
				}
			  ?>
			</div>
		</div>
		<!-- END Alert widget-->
		<?php } ?>
		<!-- BEGIN ADVANCED TABLE widget-->
       <p><a href="webadmin/addbook/" class="btn btn-danger">Add Book</a></p>

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
									<th>Name</th>
                                    <th>Edition</th>
									<th>File</th>
                                    <th>Created</th>									
									<th class="center span3">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php								
								foreach ($books as $book) {
									?>
									<tr>
										<td><?php echo $book['name']; ?></td>
										<td><?php echo $book['edition']; ?> Edition</td>
                                        <th><?php echo $book['file']; ?></th>
										<td><?php echo $book['created']; ?></td>									
										<td class="actions center">
											<a class="btn btn-edit" href="webadmin/editbook/<?php echo $book['id']; ?>"><i class="icon-edit icon-white"></i> Edit</a>
											<a class="btn btn-danger del" href="webadmin/book_delete/<?php echo $book['id']; ?>"><i class="icon-trash icon-white"></i> Delete</a>
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
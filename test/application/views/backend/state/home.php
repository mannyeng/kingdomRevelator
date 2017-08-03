<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					State Management
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="state">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="state">State</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<!--BEGIN METRO STATES-->
			<div class="metro-nav">
				 <div class="metro-nav-block nav-block-blue">
					<a data-original-title="" href="user">
						<i class="icon-list"></i>
						<div class="info">Add</div>
						<div class="status">Users</div>
					</a>
				</div>
                <div class="metro-nav-block nav-olive">
					<a data-original-title="" href="national/state_zone_list/<?php echo $this->session->userdata('id'); ?>">
						<i class="icon-group"></i>
						<div class="info">My State Zone </div>
						<div class="status">List</div>
					</a>
			   </div>
				<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="webadmin/coordinators">
						<i class="icon-heart"></i>
						<div class="info">Coordinators</div>
						<div class="status">Report</div>
					</a>
				</div>
                <!-- <div class="metro-nav-block nav-block-red">
					<a data-original-title="" href="state/subscribers_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">Subscribers</div>
					</a>
				</div>-->
				
               <!-- <div class="metro-nav-block nav-block-orange">
					<a data-original-title="" href="state/county_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">County Admin</div>
					</a>
				</div>-->
              <!--  <div class="metro-nav-block nav-block-green">
					<a data-original-title="" href="state/distributers_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">Distributers </div>
					</a>
				</div>-->
               
              <!-- <div class="metro-nav-block nav-block-red">
					<a data-original-title="" href="state/assign_distributers">
						<i class="icon-group"></i>
						<div class="info">Assign </div>
						<div class="status">Distributers</div>
					</a>
			   </div>-->
					
			</div>
		
			<!--END METRO STATES-->
		</div>

		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>
<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					User Management
				</h3>
				<ul class="breadcrumb">
					<li class="active">
						Dashboard
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
				<?php if($permissions['create_finance'] == 1 ){?>
                <div class="metro-nav-block nav-olive">
					<a data-original-title="" href="user/create_finance">
						<i class="icon-group"></i>
						<div class="info">Financial</div>
						<div class="status">Create</div>
					</a>
				</div>
                <?php }
				if($permissions['create_national'] == 1 ){
				?>
                <div class="metro-nav-block nav-olive">
					<a data-original-title="" href="user/create_national">
						<i class="icon-group"></i>
						<div class="info">National</div>
						<div class="status">Create</div>
					</a>
				</div>
                <?php }
				if($permissions['create_zone'] == 1 ){
				?>
				<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="user/create_zone">
						<i class="icon-group"></i>
						<div class="info">Zonal</div>
						<div class="status">Create</div>
					</a>
				</div>
                <?php }
				if($permissions['create_state'] == 1 ){
				?>
              <div class="metro-nav-block nav-olive">
					<a data-original-title="" href="user/create_state">
						<i class="icon-group"></i>
						<div class="info">State</div>
						<div class="status">Create</div>
					</a>
				</div>
                <?php }
				if($permissions['create_state_zone'] == 1 ){
				?>
                <div class="metro-nav-block nav-olive">
					<a data-original-title="" href="user/create_state_zone">
						<i class="icon-group"></i>
						<div class="info">State Zone</div>
						<div class="status">Create</div>
					</a>
				</div>
                <?php }
				if($permissions['create_distributor'] == 1 ){
				?>
				<?php /*?><div class="metro-nav-block nav-olive">
					<a data-original-title="" href="user/create_distributor">
						<i class="icon-group"></i>
						<div class="info">Distributor</div>
						<div class="status">Create</div>
					</a>
				</div>	<?php */?>
                <?php }?>
			</div>
		
			<!--END METRO STATES-->
		</div>

		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>
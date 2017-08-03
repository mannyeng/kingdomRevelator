

<div id="main-content" style=" background-image: url('./assets/images/krbg.jpg');">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					<?php 
					if($this->session->userdata('role')== 'Distributer')
					{?>Bulk Subscriber Management<?php } else{ ?>Intercession Management<?php } ?>
				</h3>
				<ul class="breadcrumb" style="background-color:rgba(0, 150, 136, 0.11)";>
					<li>
						<a href="distributer" style="color:#B44B2B">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="distributer" style="color:#B44B2B">Bulk Subscriber</a>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
        
        <?php
      //flash messages
//print_r($this->session->flashdata());
      if($this->session->flashdata('renew')){
        if($this->session->flashdata('renew')=='success')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Mode of payment updated successfully.';
          echo '</div>';       
        }
      }
      ?>




        <!-- END PAGE HEADER-->
        <?php
        $id     = $this->session->userdata('id');
       
        
		?>
		<!-- BEGIN PAGE CONTENT-->
		
				
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid" >
        <div class="widget blue" style="background-color:rgba(0, 150, 136, 0.11)";>
					<div class="widget-title" >
						<span class="tools">
							<a href="javascript:;" class="icon-chevron-down"></a>
						</span>
					</div>
                    </div>
			<!--BEGIN METRO STATES-->
			<div class="metro-nav">
				
				<!--<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="county/subscribers_save">
						<i class="icon-heart"></i>
						<div class="info">Add New</div>
						<div class="status">Subscriber</div>
					</a>
				</div>-->
                <?php
                if($this->session->userdata('role')== 'Distributer')
		 		{
		 			
					?>
				<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="distributer/subscribers_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">Subscribers</div>
					</a>
				</div>
                <?php
          		 
				}
				else
				{
				?>
                <div class="metro-nav-block nav-olive">
					<a data-original-title="" href="distributer/profile">
						<i class="icon-list"></i>
						<div class="info"></div>
						<div class="status">Profile</div>
					</a>
				</div>
                <?php
				}
				?>
					
			</div>
		
			<!--END METRO STATES-->
		</div>

		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>

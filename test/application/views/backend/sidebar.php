<div class="sidebar-scroll">
	<div id="sidebar" class="nav-collapse collapse">

		
		<!-- BEGIN SIDEBAR MENU -->
		<ul class="sidebar-menu">
        	<?php
			
			$role=$this->session->userdata('role');
			if($role =='admin') :
			?>
			<li class="sub-menu <?php if($menu == 'dashboard'){ ?>active<?php } ?>">
				<a class="" href="dashboard">
					<i class="icon-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<?php endif;?>
            <?php 
			if($role =='county') : 
			?>
			<li class="sub-menu <?php if($menu == 'county'){ ?>active<?php } ?>">
				<a href="county" class="">
					<i class="icon-group"></i>
					<span>County</span>
				</a>
               
                 <ul class="sub">               
                    <!--<li><a data-original-title="" href="county/subscribers_save">Add New</a></li>-->
                    <li><a href="county/distributer_list" data-original-title="">List All Bulk Subscribers</a></li>
                </ul>
			</li>
             <?php endif;  ?>
             <?php if($role =='zone') : ?>
            <li class="sub-menu <?php if($menu == 'zone'){ ?>active<?php } ?>">
				<a href="zone" class="">
					<i class="icon-group"></i>
					<span>Zone</span>
				</a>
                
                    <!--<li><a data-original-title="" href="zone/subscribers_save">Add New</a></li>-->
           <!--    
                    <li><a href="zone/state_zone_list" data-original-title="">List All State Zone</a></li>
                    <li><a href="zone/county_list" data-original-title="">List All County Admin</a></li>
                    <li><a href="zone/distributers_list" data-original-title="">List All Distributer Admin</a></li>-->
<!--                    <li><a href="zone/subscribers_list" data-original-title="">List All Subscribers </a></li>
-->                 <li><a href="user" data-original-title="">Add User</a></li>
     				<li><a href="zone/state_list" data-original-title="">My States </a></li>
                    <li><a href="webadmin/coordinators" data-original-title="">Report</a></li>
                    <!--<li><a href="webadmin/coordinators" data-original-title="">List Coordinators</a></li>
                    <li><a href="zone/assign_subscribers" data-original-title="">Assign Subscribers</a></li>
                    <li><a href="zone/assign_distributers" data-original-title="">Assign Distributers</a></li>-->
                    <li><a href="user/profile" data-original-title="">Profile</a></li>
              
			</li>
             <?php endif;  ?>
             <?php if($role =='state') : ?>
            <li class="sub-menu <?php if($menu == 'state'){ ?>active<?php } ?>">
				<a href="state" class="">
					<i class="icon-dashboard"></i>
					<span>State</span>
				</a>
                    <!--<li><a data-original-title="" href="state/subscribers_save">Add New</a></li>-->
                    <!--<li><a href="state/zone_list" data-original-title="">List All Zone Admin</a></li>-->
                   <!-- <li><a href="state/county_list" data-original-title="">List All County Admin</a></li>
                    <li><a href="state/distributers_list" data-original-title="">List All Distributer Admin</a></li>-->
                    <li><a href="user" data-original-title="">Add User</a></li>
                    <li><a href="national/state_zone_list/<?php echo $this->session->userdata('id'); ?>" data-original-title="">My State Zones</a></li>
                    <li><a href="webadmin/coordinators" data-original-title="">Report</a></li>
                    <!--<li><a href="state/subscribers_list" data-original-title="">List All Subscribers </a></li>
                    <li><a href="webadmin/coordinators" data-original-title="">List Coordinators</a></li>
                    <li><a href="state/assign_subscribers" data-original-title="">Assign Subscribers</a></li>
                    <li><a href="state/assign_distributers" data-original-title="">Assign Distributers</a></li>
                    <li><a href="national/deallocate_subscribers" data-original-title="">Deallocate Subscribers</a></li>
                    <li><a href="national/deallocate_distributers" data-original-title="">Deallocate Distributers</a></li>-->
                     <li><a href="user/profile" data-original-title="">Profile</a></li>
			</li>
             <?php endif;  ?>
			 <?php if($role =='state_zone') : ?>
                <li class="sub-menu <?php if($menu == 'state'){ ?>active<?php } ?>">
                    <a href="state_zone" class="">
                        <i class="icon-dashboard"></i>
                        <span>State Zone</span>
                    </a>
                        <!--<li><a data-original-title="" href="state/subscribers_save">Add New</a></li>-->
                        <!--<li><a href="state/zone_list" data-original-title="">List All Zone Admin</a></li>-->
                      <!--  <li><a href="state_zone/county_list" data-original-title="">List All County Admin</a></li>
                        <li><a href="state_zone/distributers_list" data-original-title="">List All Distributer Admin</a></li>-->
                        
                         <li><a href="national/distributers_list/<?php echo $this->session->userdata('id'); ?>" data-original-title="">My Bulk Subscribers</a></li>
<!--                         <li><a href="webadmin/coordinators" data-original-title="">List Coordinators</a></li>
                         <li><a href="state_zone/subscribers_list" data-original-title="">List All Subscribers</a></li>
-->                      <li><a href="user/profile" data-original-title="">Profile</a></li>

                       
                </li>
             <?php endif;  ?>
             <?php if($role =='national') : ?>
             <li class="sub-menu <?php if($menu == 'national'){ ?>active<?php } ?>">
            		<a href="national"><i class="icon-dashboard"></i><span>National</span></a>
                    <li><a href="user" data-original-title="">Add User</a></li>
                    <li><a href="national/zone_list" data-original-title="">My Zone</a></li>
                    <li><a href="webadmin/coordinators" data-original-title="">Report</a></li>
                   <!-- <li><a href="national/state_list" data-original-title="">List All State Admin</a></li>
                    <li><a href="national/state_zone_list" data-original-title="">List All State Zone Admin</a></li>
                    <li><a href="national/county_list" data-original-title="">List All County Admin</a></li>
                    <li><a href="national/distributers_list" data-original-title="">List All Distributer Admin</a></li>-->
                    <!--<li><a href="national/subscribers_list" data-original-title="">List All Subscribers </a></li>-->
                   <!-- <li><a href="national/subscribers_list_report" data-original-title="">Report Subscribers </a></li>
                    <li><a href="webadmin/coordinators" data-original-title="">List Coordinators</a></li>-->
                   <!-- <li><a href="national/user_list" data-original-title="">List Users</a></li>-->
                   <!-- <li><a href="national/assign_subscribers" data-original-title="">Assign Subscribers</a></li>
                    <li><a href="national/assign_distributers" data-original-title="">Assign Distributers</a></li>-->
                   <!-- <li><a href="national/assign_state" data-original-title="">Assign State</a></li>-->
                  <!--  <li><a href="national/deallocate_subscribers" data-original-title="">Deallocate Subscribers</a></li>
                    <li><a href="national/deallocate_distributers" data-original-title="">Deallocate Distributers</a></li>-->
                   <!-- <li><a href="national/deallocate_state" data-original-title="">Deallocate State</a></li>-->
                   <li><a href="webadmin/user_list" data-original-title="">List Bulk Subscribers </a></li>
                   <li><a href="webadmin/subscribers_list_report" data-original-title="">List Subscribers </a></li>
                   <li><a href="webadmin/subscribers_gift_list_report" data-original-title="">List Gift Subscribers </a></li>
                    <li><a href="national/discount" data-original-title="">Discount</a></li>
                     <li><a href="user/profile" data-original-title="">Profile</a></li>

			</li>
           		
             <?php endif;  ?>
             <?php if($role =='Distributer' || $role =='Intercession') : ?>
            <li class="sub-menu <?php if($menu == 'distributer'){ ?>active<?php } ?>">
                <a href="distributer" class="">
                    <i class="icon-group"></i>
                    <span><?php if($role =='Intercession'){?> Intercession<?php } else{ ?>Bulk Subscriber<?php } ?></span>
                </a>
                 <ul class="sub"> 
                    <li><a href="distributer/profile" data-original-title="">Profile</a></li> 
                           
                    <?php if($role =='Distributer'){ ?><li><a href="distributer/subscribers_list" data-original-title="">List All Subscribers</a></li><li><a href="distributer/orders" data-original-title="">Previous Orders</a></li><li><a href="distributer/new_orders" data-original-title="">New Order</a></li><?php } ?>
                </ul>
            </li>
             <?php endif;  ?>
             
              <?php if($role =='Article') : ?>
            <li class="sub-menu <?php if($menu == 'article'){ ?>active<?php } ?>">
                <a href="article" class="">
                    <i class="icon-group"></i>
                    <span>Article</span>
                </a>
                 <ul class="sub"> 
                    <li><a href="article/profile" data-original-title="">Profile</a></li>              
                    <li><a href="article/submit_article" data-original-title="">Submit Article</a></li>
                    <li><a href="article" data-original-title="">List Article</a></li>
                </ul>
            </li>
             <?php endif;  ?>
             
             <?php if($role =='finance') :?>
            <li class="sub-menu <?php if($menu == 'finance'){ ?>active<?php } ?>">
                <a href="finance" class="">
                    <i class="icon-group"></i>
                    <span>Finance</span>
                </a>
                    <li><a href="webadmin/coordinators" data-original-title="">Co-ordinators</a></li>
                    <li><a href="webadmin/national_list" data-original-title="">My Nationals</a></li>
                    <li><a href="user/profile" data-original-title="">Profile</a></li>

            </li>
             <?php endif;  ?>
               <?php if($role =='webadmin') : ?>
            <li class="sub-menu <?php if($menu == 'webadmin'){ ?>active<?php } ?>">
                <a href="webadmin" class="">
                    <i class="icon-group"></i>
                    <span>Web Admin</span>
                </a>
                    <li><a href="webadmin/changestyle" data-original-title="">Change Style</a></li>
                    <li><a href="webadmin/mail_setting" data-original-title="">Mail Settings</a></li>
                    <li><a href="webadmin/national_list" data-original-title="">My Nationals</a></li>
                   <!-- <li><a href="webadmin/state_list" data-original-title="">List All State Admin</a></li>
                    <li><a href="webadmin/state_zone_list" data-original-title="">List All State Zone Admin</a></li>
                    <li><a href="webadmin/county_list" data-original-title="">List All County Admin</a></li>
                    <li><a href="webadmin/distributers_list" data-original-title="">List All Distributer Admin</a></li>-->
                    <li><a href="webadmin/books" data-original-title="">List Books </a></li>
                <!--    <li><a href="webadmin/subscribers_list_report" data-original-title="">Report Subscribers </a></li>-->
                    <li><a href="user" data-original-title="">Add User</a></li>
                    <li><a href="webadmin/coordinators" data-original-title="">Report</a></li>
                   <!-- <li><a href="webadmin/assign_subscribers" data-original-title="">Assign Subscribers</a></li>
                    <li><a href="webadmin/assign_distributers" data-original-title="">Assign Distributers</a></li>-->
<!--                    <li><a href="webadmin/assign_state" data-original-title="">Assign State</a></li>
-->                 <!--<li><a href="webadmin/deallocate_subscribers" data-original-title="">Deallocate Subscribers</a></li>
                    <li><a href="webadmin/deallocate_distributers" data-original-title="">Deallocate Distributers</a></li>-->
<!--                    <li><a href="webadmin/deallocate_state" data-original-title="">Deallocate State</a></li>
-->                    <li><a href="webadmin/discount" data-original-title="">Discount</a></li>
                       <li><a href="webadmin/distributer_orders" data-original-title="">Bulk Subscriber Orders</a></li>
                       <li><a href="webadmin/subscriber_orders" data-original-title="">Subscriber Orders</a></li>
                       <li><a href="webadmin/subscribers_newsletters" data-original-title="">News letter subscribers</a></li>
                       <li><a href="webadmin/user_list" data-original-title="">List Bulk Subscribers</a></li>
                       <li><a href="webadmin/subscribers_list_report" data-original-title="">List Subscribers </a></li>
                       <li><a href="webadmin/subscribers_gift_list_report" data-original-title="">List Gift Subscribers </a></li>
                       <li><a href="testimony/addTestimony" data-original-title="">Testimony</a></li>
                       <li><a href="user/profile" data-original-title="">Profile</a></li>
            </li>
             <?php endif;  ?>
			 <?php if($role =='subscriber') : ?>
             <li class="sub-menu <?php if($menu == 'Subscriber'){ ?>active<?php } ?>">
            		<a href="subscriber_profile/previous_edition" data-original-title=""> <i class="icon-dashboard"></i></i><span>Subscriber</span></a>
                    
                    <li><a href="subscriber_profile/profile"><span>Profile</span></a></li>
                    <li><a href="subscriber_profile/previous_edition" data-original-title="">Books</a></li>
                    <li><a href="subscriber_profile/orders" data-original-title="">Previous Orders</a></li>
                <!--   <li><a href="subscriber_profile/new_order" data-original-title="">New Order</a></li> -->
                   

			</li>
           		
             <?php endif;  ?>
			
					
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>

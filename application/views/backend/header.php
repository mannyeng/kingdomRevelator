<?php
$role=$this->session->userdata('role');
?>
<div id="header" class="navbar navbar-inverse navbar-fixed-top">

	<!-- BEGIN TOP NAVIGATION BAR -->

	<div class="navbar-inner">

		<div class="container-fluid">

			<!--BEGIN SIDEBAR TOGGLE-->

			<div class="sidebar-toggle-box">

				<div class="icon-reorder tooltips" data-placement="right"></div>

			</div>

			<!--END SIDEBAR TOGGLE-->

			<!-- BEGIN LOGO -->

			<img class="brand" src="assets/backend/img/logo2.png" alt="KINGDOM REVELATOR USA" />

			<!-- END LOGO -->

			<!-- BEGIN RESPONSIVE MENU TOGGLER -->

						<div class="space6 pull-left quote">" And know that i am with you always; yes to the end of time. " - Jesus Christ</div>

			<div class="top-nav ">

				<ul class="nav pull-right top-menu" >

					<!-- BEGIN SUPPORT -->

					<li class="dropdown mtop5">

						<a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="javascript:;" data-original-title="Help">

							<i class="icon-question-sign"></i>

						</a>

					</li>

					<!-- END SUPPORT -->

					<!-- BEGIN USER LOGIN DROPDOWN -->

					<li class="dropdown">

						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

							<img src="assets/backend/img/avatar-mini.png" alt="">

							<span class="username"><?php echo $this->session->userdata('user_name'); ?></span>

							<b class="caret"></b>

						</a>

						<ul class="dropdown-menu extended logout">

							<?php if($role =='subscriber') : ?>
                            <li><a href="subscriber_profile/previous_edition"><i class="icon-dashboard"></i> Dashboard</a></li>
                            <?php
		                    $id     = $this->session->userdata('id');
		                    $result = $this->db->query("select * from kr_payment where Subscriber_id='".$id."' order by id desc")->row_array();
		                    if($result['paypal_status']!='pending'){ ?>
                            <li><a href="subscriber_profile/renew_subscription"><i class="icon-money"></i> Renew</a></li>
                            <?php }?>
                            <li><a href="subscriber_profile/profile"><i class="icon-user"></i> Profile</a></li>
                            <?php endif;?>

                            <?php if($role =='Distributer') : ?>
                            <li><a href="distributer"><i class="icon-dashboard"></i> Dashboard</a></li>
                            <?php
		                    $id     = $this->session->userdata('id');
                            $result = $this->db->query("select * from kr_dis_payment where Subscriber_id='".sprintf("DIS%05s",$id)."' order by id desc")->row_array();
		                    if($result['paypal_status']!='pending'){ ?>
                            <li><a href="distributer/subscribers_list"><i class="icon-group"></i> List All Subscribers</a></li>
                            <li><a href="distributer/renew"><i class="icon-money"></i> Renew</a></li>
                            <?php }?>
                            <li><a href="distributer/profile"><i class="icon-user"></i> Profile</a></li>
                            <?php endif;?>	

							<li><a href="login/logout"><i class="icon-key"></i> Log Out</a></li>

						</ul>

					</li>

					<!-- END USER LOGIN DROPDOWN -->

				</ul>

				<!-- END TOP NAVIGATION MENU -->

			</div>

		</div>

	</div>

	<!-- END TOP NAVIGATION BAR -->

</div>

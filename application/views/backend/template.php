<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<?php $this->load->view('backend/head'); ?>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="fixed-top">
	<!-- BEGIN HEADER -->
	<?php $this->load->view('backend/header'); ?>
	<!-- END HEADER -->
	
	<!-- BEGIN CONTAINER -->
	<div id="container" class="row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php $this->load->view('backend/sidebar'); ?>
		<!-- END SIDEBAR -->
		
		<!-- BEGIN PAGE -->  
		<?php $this->load->view($content); ?>
		<!-- END PAGE -->  
	</div>
	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->
	<?php $this->load->view('backend/footer'); ?>
	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS -->
	<?php $this->load->view('backend/js'); ?>
	<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->

</html>
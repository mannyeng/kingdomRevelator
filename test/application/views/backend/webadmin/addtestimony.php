<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Add Testimony

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="webadmin">Dashboard</a>

						<span class="divider">/</span>

					</li>

					<li class="active">

						Add Testimony

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<!-- END PAGE HEADER-->        



		<?php 

		if($this->session->flashdata('error')){

				  echo '<div class="alert alert-error">';

					echo '<a class="close" data-dismiss="alert">×</a>';

					echo $this->session->flashdata('error');

				  echo '</div>';          

				}

		?>

		<!-- BEGIN PAGE CONTENT-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN SAMPLE FORM PORTLET-->

				<div class="widget blue">

					<div class="widget-title">

						<h4><i class="icon-reorder"></i> Entry Form </h4>

						<span class="tools">

							<a href="javascript:;" class="icon-chevron-down"></a>

						</span>

					</div>

					<div class="widget-body">

						<!-- BEGIN FORM-->

						<form action="" method="post" class="form-horizontal" id="form-validate" enctype="multipart/form-data">

							<fieldset>                              

								<div class="span6">

									

								<div class="control-group">

										<label class="control-label" for="code">Name</label>

										<div class="controls">

											<div class="input-append span10" >

											<input type="text" class="span10" id="name" name="name" value="" required="required" >											

										</div>

										</div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">Testimony</label>

										<div class="controls">

											<div class="input-append span10" >

											<textarea class="span10" id="testimony" name="testimony"  required="required" ></textarea>											

										</div>

									  </div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">Photo</label>

										<div class="controls">

											<div class="input-append span10" >

											<input type="file" class="span10" id="userfile" name="userfile"  />

											<!-- <input type="url" class="span10" id="userfile" name="userfile" required="required"  /> -->

										</div>

										</div>

									</div>

                                    



								</div>

								

							</fieldset>                            

							<div style="clear: both;"></div>

							<div class="center">

								<input type="submit" class="btn btn-success"  tabindex="8" value="Submit" />

							</div>

						</form>

						<!-- END FORM-->

					</div>

				</div>

				<!-- END SAMPLE FORM PORTLET-->

			</div>

		</div>



		



		<!-- END PAGE CONTAINER-->

	</div>

	<!-- END PAGE -->

</div>

<script type="text/javascript">

$(function(){

	$("#form-validate").validate();	

});

</script>

<?php

 

  function addOrdinalNumberSuffix($num) {

    if (!in_array(($num % 100),array(11,12,13))){

      switch ($num % 10) {

        // Handle 1st, 2nd, 3rd

        case 1:  return $num.'st';

        case 2:  return $num.'nd';

        case 3:  return $num.'rd';

      }

    }

    return $num.'th';

  }

 

?>
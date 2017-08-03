<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Add Book

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="webadmin">Dashboard</a>

						<span class="divider">/</span>

					</li>

					<li>

						<a href="webadmin/books">Book List</a>

						<span class="divider">/</span>

					</li>

					<li class="active">

						Add Book

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

					

					<div class="widget-body">

						<!-- BEGIN FORM-->

						<form action="" method="post" class="form-horizontal" id="form-validate" enctype="multipart/form-data" >

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

										<label class="control-label" for="code">Edition</label>

										<div class="controls">

											<div class="input-append span10" >

											<select class="span10" id="edition" name="edition"  required="required" place holder="Select month">

                                            <option value="">Select Month</option>

                                            <?php //foreach(range(1,12) as $num){

												echo '<option value="january"> January</option>';
												echo '<option value="february"> February</option>';
												echo '<option value="march"> March</option>';
												echo '<option value="april"> April</option>';
												echo '<option value="may"> May</option>';
												echo '<option value="june"> June</option>';
												echo '<option value="july"> July</option>';
												echo '<option value="august"> August</option>';
												echo '<option value="september"> September</option>';
												echo '<option value="october"> October</option>';
												echo '<option value="november"> November</option>';
												echo '<option value="december"> December</option>';


											//}?>

                                            </select>											

										</div>

									  </div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">File Url</label>

										<div class="controls">

											<div class="input-append span10" >

<!-- 											<input type="file" class="span10" id="userfile" name="userfile" required="required" accept="application/pdf" />

 -->											<input type="url" class="span10" id="userfile" name="userfile" required="required"  />

										</div>

										</div>

									</div>
									<div class="control-group">

										<label class="control-label" for="code">Thumbnail </label>

										<div class="controls">

											


											<input type="file" name="thumbnail" id="thumbnail" accept="image/*" 
											required="required">

										

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
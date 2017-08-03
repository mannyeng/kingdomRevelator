<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Edit Book

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

						Edit Book

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
<!--
					<div class="widget-title">

						<h4><i class="icon-reorder"></i> Entry Form </h4>

						<span class="tools">

							<a href="javascript:;" class="icon-chevron-down"></a>

						</span>

					</div>
-->
					<div class="widget-body">

						<!-- BEGIN FORM-->

						<form action="" method="post" class="form-horizontal" id="form-validate" enctype="multipart/form-data">

							<fieldset>                              

								<div class="span6">

									

								<div class="control-group">

										<label class="control-label" for="code">Name</label>

										<div class="controls">

											<div class="input-append span10" >

											<input type="text" class="span10" id="name" name="name" value="<?php echo $book['name'];?>" required="required" >											

										</div>

										</div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">Edition</label>

										<div class="controls">

											<div class="input-append span10" >

											<select class="span10" id="edition" name="edition"  required="required" place holder="Select Month">

                                            <option value="" >Select Month</option>
                         <option value="january" <?php if($book['edition']=='january') { ?> selected="selected" <?php } ?> > January</option>
                         <option value="february" <?php if($book['edition']=='february') { ?> selected="selected" <?php } ?> >  February</option>
						 <option value="march" <?php if($book['edition']=='march'){ ?> selected="selected"<?php } ?> > March </option>
						 <option value="april" <?php if($book['edition']=='april'){ ?> selected="selected" <?php } ?> > April</option>
						 <option value="may" <?php if($book['edition']=='may'){ ?> selected="selected"<?php } ?> > May</option>
			             <option value="june" <?php if($book['edition']=='june'){ ?> selected="selected"<?php } ?> > June</option>
						 <option value="july" <?php if($book['edition']=='july'){ ?> selected="selected"<?php } ?> > July</option>
						 <option value="august" <?php if($book['edition']=='august'){ ?> selected="selected"<?php } ?> > August</option>
						 <option value="september" <?php if($book['edition']=='september'){ ?> selected="selected" <?php }?> > September</option>
						 <option value="october" <?php if($book['edition']=='october'){ ?> selected="selected" <?php }?> > October</option>
			             <option value="november" <?php if($book['edition']=='november'){ ?> selected="selected"<?php } ?> >  November</option>
						 <option value="december" <?php if($book['edition']=='december'){ ?> selected="selected" <?php } ?> > December</option>
                                            

                                            </select>											

										</div>

									  </div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">File</label>

										<div class="controls">

											<div class="input-append span10" >

<!-- 											<input type="file" class="span10" id="userfile" name="userfile" accept="application/pdf" />

 -->					

 								           <input type="url" class="span10" id="userfile" name="userfile" required="required" value="<?php echo $book['file'];?>"  />	

 											

											

										</div>

										</div>

									</div>
									<div class="control-group">

										<label class="control-label" for="code">Thumbnail </label>

										<div class="controls">

											


											<input type="file" name="thumbnail" id="thumbnail" accept="image/*" 
											required="required" >

										

										</div>

									</div>
                                    



								</div>

								

							</fieldset>                            

							<div style="clear: both;"></div>

							<div class="center">

								<input type="submit" class="btn btn-success"  tabindex="8" value="Update" />

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
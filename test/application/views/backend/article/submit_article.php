<?php

if($this->uri->segment(3))

{

	$article_id = $this->uri->segment(3);

	$res = $this->db->get_where('kr_article',array('id'=>$article_id,'user_id'=>$this->session->userdata('id')) )->row_array();

}

?>

<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Profile

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="article">Dashboard</a>

						<span class="divider">/</span>

					</li>					

					<li class="active">

						Submit article

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<!-- END PAGE HEADER-->

<?php

      //flash messages

      if($this->session->flashdata('alert')){

        if($this->session->flashdata('alert') == 'success')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Added successfully.';

          echo '</div>';       

        }

		elseif($this->session->flashdata('alert') == 'already')

        {

          echo '<div class="alert alert-failure">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Already exists.';

          echo '</div>';       

        }

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

                        <form class="form-horizontal" id='volunteer_form' method="POST"  enctype="multipart/form-data">

						

							<fieldset>                            

								<div class="span6">

									   <div class="form-group">

                                          <div class="col-lg-10 col-md-10 col-lg-offset-1">

                                             <textarea class="form-control" rows="8" name='memo'  maxlength="300" id="memo" placeholder=" Write article here... (maximum 300 words)" required="required" <?php if($this->uri->segment(3)){?> disabled="disabled"  <?php } ?>><?php if($this->uri->segment(3)){ echo $res['memo']; } ?></textarea>

                                          </div>

                                      </div>

                                      <div class="form-group is-empty is-fileinput">

                                       		<?php

                                            if($this->uri->segment(3)!='' )

											{

												//echo "<a href=".$res['file_path']." >Download File</a>";

											}

											else

											{

											echo "<input type='file' id='inputFile4' name='article'>";

											}



											?>

                                         

                                         <span class="material-input"></span>

                                      </div>

                                </div>

                              </fieldset>

                              <?php /*?><fieldset>  

                              <legend>Other ways you can help</legend>

                                <div class="span9">

                                 <div class="control-group">

										<label class="control-label" >Copies requested for distribution</label>

										<div class="controls">

											<input type="number" class="span6" id="name" name="Copies_requested"  min='50' value="<?php echo $row['Copies_requested'] ?>" required >

										</div>

									</div>

                                    <?php if(isset($times)): ?>

                                   <div class="col-lg-10 col-md-10 col-lg-offset-1">

                                      <b >Time Commitment (Time / Day)</b>

                                    </div>

                                   <div id="multiday" >

                                   <?php $i=0; $first_key=true; foreach($times as $ky=>$time): $min=($time['tim']%60);?>

             	 <div class="control-group">

                  <div class="span3">

                    <input type="text" class="form-control dat" value="<?php echo $time['day'] ?>"   name='day[<?php echo $i; ?>]' placeholder="Select Date" />

                  </div>

                  <div class="span3">

                    <select class="form-control hour"  name='hour[<?php echo $i; ?>]' >

                    <option value="">Select Hour</option>

                    <?php foreach(range(1,20) as $hr){

						if($hr==floor($time['tim']/60))

						 echo "<option selected='selected'>$hr</option>"; 

						 else

						 echo "<option>$hr</option>"; 

					}?>

                    </select>

                  </div>

                  <div class="span3">

                    <select class="form-control min"  name='min[<?php echo $i; ?>]' >

                    <option value="">Select Minute</option>

                    <option <?php if ($min==15) echo 'selected'; ?> >15</option>

                    <option <?php if ($min==30) echo 'selected'; ?> >30</option>

                    <option <?php if ($min==45) echo 'selected'; ?> >45</option>

                    </select>

                  </div>

                  <div class="span3" align="center">

                    <?php if($first_key):  ?>

                    <b style="font-size:32px;cursor:pointer" id="addmore" title="Add More">+</b>

                    <?php else : ?>

                    <b style="font-size:50px;cursor:pointer;line-height:50px" class="removeme" title="Remove">-</b>

                    <?php endif;  ?>

                  </div>

                  </div>

              

              <?php $i++; $first_key=false; endforeach; ?>

              </div>

                                    <?php endif;  ?>

								</div>

								

							</fieldset><?php */?>

							

							<div style="clear: both;"></div>

							<div class="center">

                            	<input type="hidden" name='user_id' value='<?php echo $this->uri->segment('3');?>' />

                                <input type="hidden" name='dist_id' value='<?php //echo $row['id'];?>' />

                                <?php

								if($this->uri->segment(3)=='')

								{

									?>

								<input type="submit" id="submit" class="btn btn-success" tabindex="8" value="Submit" />

                                <?php

								}

								

								?>

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

<div class="control-group" id="copier">

          <div class="span3">

            <input type="text" class="form-control dat"   name='day[dyn_id]' placeholder="Select Date" />

          </div>

          <div class="span3">

            <select class="form-control hour"  name='hour[dyn_id]' >

            <option value="">Select Hour</option>

            <?php foreach(range(1,20) as $hr) echo "<option>$hr</option>"; ?>

            </select>

          </div>

          <div class="span3">

            <select class="form-control min"  name='min[dyn_id]' >

            <option value="">Select Minute</option>

            <option >15</option>

            <option >30</option>

            <option >45</option>

            </select>

          </div>

          <div class="span3" align="center">

            <b style="font-size:50px;cursor:pointer;line-height:50px" class="removeme" title="Remove">-</b>

        </div>

   </div>

   

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css">

    <script type="application/javascript" >

 $("#inputFile4").change(function () {

       var fileExtension = ['doc', 'docx'];
        if($(this).val()=="")
        {

           $('#submit').removeAttr('disabled');

        }
        

        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {

            alert("Only formats are allowed : "+fileExtension.join(', '));

            $('#submit').prop('disabled','true');
              if($(this).val()=="")
              {

                 $('#submit').removeAttr('disabled');

              }
        }
        else
        {
          $('#submit').removeAttr('disabled');

        }

    });

	$(document).ready(function(e) {

    $("#volunteer_form").validate();

	dp();

	

	$("#addmore").on('click',function(){

			var i=$("#multiday .dat").length;

			$("#copier").clone().appendTo('#multiday').addClass("dyn_added").attr("id","copier"+i);	

				var htm=$("#copier"+i).html();

				htm=htm.replace(/dyn_id/g,i);						

				$("#copier"+i).html(htm);

				dp();

		});

		

		$("#multiday").on('click','.removeme',function(){			

			$(this).parents(".dyn_added").remove();

			$("#multiday .dat").each(function(index, element) {

                $(this).attr('name','day['+index+']');

				$("#multiday .hour").eq(index).attr('name','hour['+index+']');

				$("#multiday .min").eq(index).attr('name','min['+index+']');

				$(this).parents(".dyn_added").attr("id","copier"+index);

            });

		});

	

});

function dp()

{

	$('.dat').datepicker();

}

	</script>

    <style>

	#copier{display:none}

	</style>
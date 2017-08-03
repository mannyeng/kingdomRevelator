<?php

$Res_old_style_arr  =   $this->db->query("SELECT * FROM smtp_config where id='1'");

$Res_old_style      =   $Res_old_style_arr->row_array();

$host		        =   @$Res_old_style['host'];

$port			    =   @$Res_old_style['port'];

$username	        =   @$Res_old_style['username'];

$password		    =   @$Res_old_style['password'];

$from_name		    =   @$Res_old_style['from_name'];

$from_email 	    =   @$Res_old_style['from_email'];

$notify_email		=   @$Res_old_style['notify_email'];

?>

<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Mail Settings

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="webadmin">Dashboard</a>

						<span class="divider">/</span>

					</li>

					<li>

						<a href="webadmin/mail_settings">Mail Settings</a>

					</li>

					

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<!-- END PAGE HEADER-->

<?php

      //flash messages

      if($this->session->flashdata('flash_message')){

        if($this->session->flashdata('flash_message') == 'updated')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Retreat updated successfully.';

          echo '</div>';       

        }elseif($this->session->flashdata('flash_message') == 'added'){

          echo '<div class="alert alert-error">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'New retreat created successfully.';

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

						<?php

      //form dataecho 

      $attributes = array('class'=>'form-horizontal','id' => 'form-validate','enctype'=>'multipart/form-data');



      //form validation

      echo validation_errors();

      

      echo form_open('webadmin/mail_setting', $attributes);

      ?>

							 <fieldset>

                              <div id='message'><?php if($this->session->flashdata('alert')=='success'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Updated settings</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?></div>

                             

                               <div class="control-group">

                                <label class="control-label" for="purchase_no">Host</label>

                                <div class="controls">

                                    <input type="text" class="noquote" value='<?php echo $host; ?>' id="inputFile4" name='host'>

                                </div>

                               </div>

                                <div class="control-group">

                                <label class="control-label" for="purchase_no">Port</label>

                                <div class="controls">

                                    <input type="text"  class="noquote" value='<?php echo $port; ?>' id="inputFile4" name='port'>

                                </div>

                               </div>

                              <div class="control-group">

                                <label class="control-label" for="purchase_no">username</label>

                                <div class="controls">

                                    <input type="text"  class="form-control noquote" id="username" name="username" value='<?php echo $username; ?>' placeholder="username">

                                  </div>

                              </div>

                              <div class="control-group">

                                <label class="control-label" for="purchase_no">password</label>

                                <div class="controls">

                                    <input type="text" class="form-control noquote" id="password" name="password" value='<?php echo $password; ?>' placeholder="password">

                                </div>

                              </div>

                              <div class="control-group">

                                <label class="control-label" for="purchase_no">From Name</label>

                                <div class="controls">

                                    <input type="text" class="form-control noquote" id="from_name" name="from_name" value='<?php echo $from_name; ?>' placeholder="From Name">

                                </div>

                              </div>

                              <div class="control-group">

                                <label class="control-label" for="purchase_no">From Email</label>

                                <div class="controls">

                                    <input type="text" class="form-control noquote" id="from_email" name="from_email" value='<?php echo $from_email; ?>' placeholder="From Email">

                                  </div>

                              </div>

                             <div class="control-group">

                                <label class="control-label" for="purchase_no">Notification mail id</label>

                                <div class="controls">

                                    <input type="text" class="form-control noquote" id="notify_email" name='notify_email' value='<?php echo $notify_email; ?>' placeholder="Notification mail id">

                                  </div>

                              </div>

                            </fieldset>

							

							<div style="clear: both;"></div>

							<div class="center">

								<input type="submit" class="btn btn-success" tabindex="8" value="SAVE" />

							</div>

						 <?php echo form_close(); ?>

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

<div id="child_age_fields">

<select class="select span10" name="c_age[dyn_id]">

           <option value="">Select age</option>

           <?php 

		   foreach(range(1,25) as $age)

		   echo '<option>'.$age.'</option>';

		   ?>

           </select> Below

              <input type="text" placeholder="Fee"  name="c_fee[dyn_id]"   class="span10"> 

              <strong style="font-size:18px;font-weight:bold;cursor:pointer" class="removeme">-</strong>

            </div>

    <script type="application/javascript" >

	$(function(){

		

		$("#addMore").on('click',function(){

			var i=$("#c_ageDiv select").length;

			$("#child_age_fields").clone().appendTo('#c_ageDiv').addClass('child_age').attr("id","copier"+i);	

				var htm=$("#copier"+i).html();

				htm=htm.replace(/dyn_id/g,i);						

				$("#copier"+i).html(htm);

		});

		$("#c_ageDiv").on('click','.removeme',function(){			

			$(this).parents(".child_age").remove();

			$("#c_ageDiv select").each(function(index, element) {

                $(this).attr('name','c_age['+index+']');

				$("#c_ageDiv input").eq(index).attr('name','c_fee['+index+']');

				$(this).parents(".child_age").attr("id","copier"+index);

            });

		});

	});

	</script>

    <style>

	#child_age_fields{display:none}

	</style>
<script type="text/javascript">
$(function(){

	$("#form-validate").validate();
	

});
</script>
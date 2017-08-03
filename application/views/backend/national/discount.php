<?php

	$id     = $this->uri->segment(3);

	$result = $this->db->query("SELECT * FROM kr_discount ");

	$user   = $result->row_array();

?>

<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					<?php if ($this->uri->segment(3)) { ?>Edit<?php } else { ?>Add<?php } ?> Discount

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="national">Dashboard</a>

						<span class="divider">/</span>

					</li>

					<li>

						<a href="national">National</a>

						<span class="divider">/</span>

					</li>

					<li class="active">

						<?php if ($this->uri->segment(3)) { ?>Edit<?php } else { ?>Add<?php } ?> Discount

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<!-- END PAGE HEADER-->

		<?php if( $this->session->flashdata('error')) { ?>

		<!-- BEGIN Alert widget-->

		<div class="row-fluid">

			<div class="span12">				

				<?php if($this->session->flashdata('error')) { ?>

				<div class="alert alert-error">

					<button class="close" data-dismiss="alert">×</button>

					<strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>

				</div>

				<?php } ?>

			</div>

		</div>

		<!-- END Alert widget-->

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

            echo 'New user created successfully.';

          echo '</div>';          

        }

      }

      ?>



		<?php } 

		echo validation_errors();

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

						<form action="" method="post" class="form-horizontal" id="form-validate">

							<fieldset>

                              <div id='message'><?php if($this->session->flashdata('alert')=='success'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Added Discount</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?><?php if($this->session->flashdata('alert')=='updated'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Updated User</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?><?php if($this->session->flashdata('alert')=='Error'){?><div class="alert alert-dismissible alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Email</strong> already exist <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?></div>

								<div class="span6">

									

								<div class="control-group">

										<label class="control-label" for="code">Above 10 Copies</label>

										<div class="controls">

											<div class="input-append span10" >

											<input type="text" class="span10 noquote" id="above10" name="above10" maxlength="2"  pattern="[0-9]+" value="<?php echo @$user['above10']; ?>" required="required" >

											

										</div>

										</div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">Above 20 Copies</label>

										<div class="controls">

											<div class="input-append span10" >

											<input type="text" class="span10 noquote" id="above20" name="above20" maxlength="2"  pattern="[0-9]+" value="<?php echo @$user['above20']; ?>" required="required" >

											

										</div>

										</div>

									</div>

                                    

                                    <div class="control-group">

										<label class="control-label" for="code">Above 30 Copies</label>

										<div class="controls">

											<div class="input-append span10" >

											<input type="text" class="span10 noquote" id="above30" pattern="[0-9]+" maxlength="2" name="above30" value="<?php echo @$user['above30']; ?>" required="required" >

											

										</div>

										</div>

									</div>

								</div>

								

							</fieldset>

                            <input type='hidden' value="<?php if ($this->uri->segment(3)) { ?>Edit<?php } else { ?>Add<?php } ?>" name='formtype' />

                            <input type='hidden' value="<?php if ($this->uri->segment(3)) { echo $this->uri->segment(3); } ?>" name='edit_id' />

                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />

							<div style="clear: both;"></div>

							<div class="center">

								<input type="submit" class="btn btn-success"  tabindex="8" value="<?php if ($this->uri->segment(3)) { ?>Update<?php } else { ?>Add<?php } ?> Discount" />

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

var role="<?php echo @$user['role'] ?>";

if(role !="" && role !="coordinator")

{

	$("#retreat_ids").hide();

	$('#retreats').attr('disabled','disabled');

}

$(function(){

	$("#roles").on('change',function(){

		var valu=$(this).val();

		if(valu =="state")

		{

			$("#state").hide();

			$("#zone").hide();

			$("#county").hide();

		}

		if(valu =="zone")

		{

			$("#state").show();

			$("#State").prop('required',true);

			$("#zone").hide();

			$("#county").hide();

		}

		if(valu =="county")

		{

			$("#state").show();

			$("#zone").show();

			$("#State").prop('required',true);

			$("#Zone").prop('required',true);

			$("#county").hide();

		}

		

	});

	

});
$(function(){

	$("#form-validate").validate();
	

});
</script>
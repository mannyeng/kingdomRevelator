<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Create a Subscriber
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="dashboard">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="county">County</a>
						<span class="divider">/</span>
					</li>
					<li class="active">
						Create a Subscriber
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
      //form data
      $attributes = array('class'=>'form-horizontal','id' => '');

      //form validation
      echo validation_errors();
      
      echo form_open('county/subscribers_save', $attributes);
      ?>
							<fieldset>
								<div class="span6">
									<div class="control-group">
										<label class="control-label" for="purchase_no"> First Name</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="First_name" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Last Name</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Last_name" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Mailing address1</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Mailing address1" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Mailing address2</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Mailing address2" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> City</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="City" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> State</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="State" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Zip Code</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Zip_Code" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Phone(Home)</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Phone_Home" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Phone(Cell)</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Phone_Cell" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                </div>
                                <div class="span6">
                                 <div class="control-group">
										<label class="control-label" for="purchase_no"> Billing address1</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Billing address1" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Billing address2</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Billing address2" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> City</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Billing_City" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> State</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Billing_State" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Zip Code</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Billing_Zip_Code" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Email</label>
										<div class="controls">
											<input type="email" class="span10" id="name" name="Email" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> Church</label>
										<div class="controls">
											<input type="text" class="span10" id="name" name="Church" required="required" value="<?php echo set_value('name'); ?>" >
										</div>
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
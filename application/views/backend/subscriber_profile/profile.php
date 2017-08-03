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
						<a href="subscriber_profile/profile">Dashboard</a>
						<span class="divider">/</span>
					</li>					
					<li class="active">
						Profile
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
		  -webkit-appearance: none; 
		  margin: 0; 
		}
		</style>
		<!-- END PAGE HEADER-->
<?php
      //flash messages
//print_r($this->session->flashdata());
      if($this->session->flashdata('alert') || $this->session->flashdata('renew')){
        if($this->session->flashdata('alert') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Updated successfully.';
          echo '</div>';       
        }
		elseif($this->session->flashdata('alert') == 'already')
        {
          echo '<div class="alert alert-failure">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Already exists.';
          echo '</div>';       
        }
        elseif($this->session->flashdata('renew')=='success')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Mode of payment updated successfully.';
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
<!--                    <a href='subscriber_profile/renew_subscription' class="btn btn-success" style="float: right;margin-top: 1%;">Renew Subscription</a>
-->					<div class="widget-body">
						<!-- BEGIN FORM-->
                        <form class="form-horizontal" id='volunteer_form' method="POST" >
						
							<fieldset>                            
								<div class="span6">
									<div class="control-group">
										<label class="control-label" >First Name</label>
										<div class="controls">
											<input type="text" class="span10"  name="First_name" required="required" value="<?php echo $row['First_name'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" >Last Name</label>
										<div class="controls">
											<input type="text" class="span10" name="Last_name" required="required" value="<?php echo $row['Last_name'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" >Address1</label>
										<div class="controls">
											<input type="text" class="span10"  name="Address1" required="required" value="<?php echo $row['Mailing_address1'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" >Address2</label>
										<div class="controls">
											<input type="text" class="span10" name="Address2"  value="<?php echo $row['Mailing_address2'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" > City</label>
										<div class="controls">
											<input type="text" class="span10"  name="City" required="required" value="<?php echo $row['City'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" > State</label>
										<div class="controls">
                                         <select id="State" name='State' class="form-control">
										  <?php
                                          $res_state = $this->db->query("SELECT * FROM kr_state");
                                          $res_array = $res_state->result_array();
                                          ?>
                                            <option value=''>State</option>
                                            <?php
                                            foreach($res_array as $row1)
                                            {
                                            ?>
                                            <option value="<?php echo  $row1['State_name'];?>" <?php if($row['State']==$row1['State_name']){?> selected="selected" <?php } ?>><?php echo  $row1['State_name'];?></option>
                                            <?php
                                            }
                                            ?>
                                          </select>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" > Zip Code</label>
										<div class="controls">
											<input type="number" class="span10" name="Zipcode" required="required" maxlength="5" minlength="5" title="Enter 5 digit Zipcode"  value="<?php echo $row['Zipcode'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" > Phone(Home)</label>
										<div class="controls">
											<input type="number" class="span10"  name="Phone_Number_H" required="required" maxlength="10" minlength="10" title="Enter 10 digit Phone Number"  value="<?php echo $row['Home_phone'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" > Phone(Cell)</label>
										<div class="controls">
											<input type="number" class="span10"  name="Phone_Number_C" required="required" maxlength="10" minlength="10" title="Enter 10 digit Phone Number"  value="<?php echo $row['Cell_phone'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" >Email</label>
										<div class="controls">
											<input type="text" class="span10 required email" name="Email" required="required" value="<?php echo $row['Email_address'] ?>" >
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" >Password</label>
										<div class="controls">
											<input type="text" class="span10" name="password" required="required" value="<?php echo $row['Password'] ?>" >
										</div>
									</div>
                                </div>
                              </fieldset>
                              
							
							<div style="clear: both;"></div>
							<div class="center">
								<input type="submit" class="btn btn-success" tabindex="8" value="Update" />
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
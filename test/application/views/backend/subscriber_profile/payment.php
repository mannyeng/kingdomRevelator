<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Payment
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="subscriber_profile/profile">Dashboard</a>
						<span class="divider">/</span>
					</li>					
					<li class="active">
						Payment
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
      if($this->session->flashdata('alert')){
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
							Total Amount : $ <?php echo $amount['Total_amount'];?>
								  <div class="control-group">
                    <label class="col-lg-4 col-md-2 control-label label-style" style="margin-top:5px;">Mode of Payment </label>
     					<input type="hidden" class="span10" name="amount" id="" value="<?php echo $amount['Total_amount'];?>">
                    <div class="col-lg-8 col-md-10" style="display: inline-flex;">
                      <div class=" radio-primary">
                          <input type="radio" class="span10" name="optionspayment" id="optionspayment1" value="online" <?php echo "checked";?>>
                          Pay online
                      </div>
                      <div class="radio-primary">
                          <input type="radio" class="span10" name="optionspayment" id="optionspayment2" value="Cash" >
                          Cash
                      </div>
                      <div class=" radio-primary">
                          <input type="radio" class="span10" name="optionspayment" id="optionspayment3" value="Cheque" >
                          Cheque
                      </div>
                    </div>
                  </div>
                  <div id='payment_type_cash' style="display:none">
                  <div class="control-group">
						<div class="col-lg-10 col-md-10 col-lg-offset-1">
                            <input type="text" class="span10" id="cash_agent_name" name='cash_agent_name' value="" placeholder=" Please enter the agent name" >
                          </div>
					</div>
	                <div class="control-group">
						 <div class="col-lg-10 col-md-10 col-lg-offset-1">
                            <input type="text" class="span10" id="cash_comments" name='cash_comments' value="" placeholder=" Comments">
                          </div>
					</div>
                  </div>
                  <div id='payment_type_cheque' style="display:none">
                      <div class="control-group">
                          <div class="col-lg-10 col-md-10 col-lg-offset-1">
                            <input type="text" class="span10" id="cheque_agent_name" name='cheque_agent_name' value=""  placeholder=" Please enter the agent name,Cheque number" >
                          </div>
                      </div>
                      <div class="control-group">
                          <div class="col-lg-10 col-md-10 col-lg-offset-1">
                            <input type="text" class="span10" id="cheque_comments" name='cheque_comments' value="" placeholder=" Comments">
                          </div>
                      </div>
                  </div>

							</fieldset>
							
							<div style="clear: both;"></div>
							<div class="center">
                            	<input type="hidden" name='user_id' value='<?php echo $this->uri->segment('3');?>' />
                                <input type="hidden" name='dist_id' value='<?php echo $row['id'];?>' />
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
$(document).ready(function()
{
	$("#optionspayment2").click(function(){
	$('#payment_type_cash').show();
	$('#payment_type_cheque').hide();
	})
	
	$("#optionspayment3").click(function(){
	$('#payment_type_cash').hide();
	$('#payment_type_cheque').show();
	})
	
	$("#optionspayment1").click(function(){
	$('#payment_type_cash').hide();
	$('#payment_type_cheque').hide();
	})
})
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
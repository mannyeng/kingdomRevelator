<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Deallocate State
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
						Deallocate State
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
      
      echo form_open('national/deallocate_state', $attributes);
      ?>
							<fieldset>
                              <div id='message'><?php if($this->session->flashdata('alert')=='success'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Deallocated the State</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?></div>
								<div class="span6">
									<div class="control-group">
										<label class="control-label" for="purchase_no"> Zone</label>
										<div class="controls">
                                        	<select name='Zone' id='zone' required onchange="states(this.value);" >
                                             <option value=''>Select Zone</option>
                                            	<?php
												foreach($Zone as $key)
												{
												?>
                                                <option value='<?php echo $key['id']; ?>'><?php echo $key['First_name']; ?></option>
                                                <?php
												}
												?>
                                            </select>
										</div>
									</div>
                                    <div class="control-group">
										<label class="control-label" for="purchase_no"> State</label>
										<div class="controls">
                                        	<select name='State[]' id='State' multiple="multiple" >
                                            	
                                            </select>
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
	function states(id)
	{
		$.ajax({
			method:'POST',
			data:"id="+id,
			url:"Ajaxaction/state",
			success:function getstate($msg)
			{
				$('#State').html('');
				$('#State').append($msg);
			}
			
			})
	}
	
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
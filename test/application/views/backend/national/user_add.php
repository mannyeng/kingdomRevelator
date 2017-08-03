<?php
if ($this->uri->segment(3))
{
	$id     = $this->uri->segment(3);
	$result = $this->db->query("SELECT * FROM kr_users WHERE id='$id'");
	$user   = $result->row_array();
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
					<?php if ($this->uri->segment(3)) { ?>Edit<?php } else { ?>Add<?php } ?> User
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
						<?php if ($this->uri->segment(3)) { ?>Edit<?php } else { ?>Add<?php } ?> User
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
                              <div id='message'><?php if($this->session->flashdata('alert')=='success'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Created New User</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?><?php if($this->session->flashdata('alert')=='updated'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Updated User</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?><?php if($this->session->flashdata('alert')=='Error'){?><div class="alert alert-dismissible alert-error"><button type="button" class="close" data-dismiss="alert">×</button><strong>Email</strong> already exist <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?></div>
								<div class='span12'> 
                                    <div class="span6">
                                        
                                      <div class="control-group">
                                            <label class="control-label" for="code">First Name</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="text" class="span10" id="first_name" name="first_name" value="<?php echo @$user['First_name']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="code">Password</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="text" class="span10" id="passwrd" name="passwrd" value="<?php echo @$user['Password']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="code">Email</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="email" class="span10" id="email" name="email" value="<?php echo @$user['Email_address']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="code">Address1</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10" id="address1" name="address1" value="<?php echo @$user['address1']; ?>" required="required" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="code">Address2</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10" id="address2" name="address2" value="<?php echo @$user['address2']; ?>" required="required" >
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label" for="code">State</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                	<?php
													$res_state = $this->db->query("SELECT * FROM kr_state ");
													$all_state = $res_state->result_array();
													?>
                                                <select name='state' id='state'>
                                                <option vlaue=''>Select State</option> 
                                                    <?php
                                                    foreach($all_state as $key)
                                                    {
                                                    ?>
                                                    <option value='<?php echo $key['id']; ?>' <?php if(@$user['Zonal_admin_id']==$key['id']){ echo "selected"; } ?>><?php echo $key['State_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                 </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="control-group">
                                            <label class="control-label" for="code">Zip Code</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10" id="zip" name="zip" pattern="[0-9]+" maxlength="6" value="<?php echo @$user['zip']; ?>" required="required" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Phone Home</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10" id="phone_home" name="phone_home" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['phone_home']; ?>" required="required" >
                                                </div>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label" for="code">Phone Cell</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10" id="phone_cell" name="phone_cell" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['phone_cell']; ?>" required="required" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="code">Role</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <?php  
                                                echo form_dropdown('role', array('finance'=>'Finance Admin','zone'=>'Zone Coordinator','state'=>'State Coordinator','state_zone'=>'State Zone Coordinator','county'=>'County Coordinator','Distributer'=>'Distributer'), @$user['admin_type'],array('id'=>'roles','required'=>'required'));
                                                ?>
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <div class="control-group" id='all_stateDiv' style="display:none;">
                                            <label class="control-label" for="code">States</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <?php
                                                $res_state = $this->db->query("SELECT * FROM kr_state where Zone_id='0'");
                                                $all_state = $res_state->result_array();
                                                ?>
                                               <select name='all_state[]' id='all_state' multiple="multiple" >
                                                    <?php
                                                    foreach($all_state as $key)
                                                    {
                                                    ?>
                                                    <option value='<?php echo $key['id']; ?>' <?php if(@$user['Zonal_admin_id']==$key['id']){ echo "selected"; } ?>><?php echo $key['State_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                 </select>
                                                
                                                </div>
                                            </div>
                                        </div>
                                         <div class="control-group" id='all_countyDiv' style="display:none;">
                                            <label class="control-label" for="code">County</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <?php
                                                $res_state = $this->db->query("SELECT * FROM kr_users where State_zone_admin_id='0' and admin_type='county'");
                                                $all_county = $res_state->result_array();
                                                ?>
                                               <select name='all_county[]' id='all_county' multiple="multiple" >
                                                    <?php
                                                    foreach($all_county as $key)
                                                    {
                                                    ?>
                                                    <option value='<?php echo $key['id']; ?>'><?php echo $key['First_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                 </select>
                                                
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group" id='zone'  <?php if(@$user['Zonal_admin_id']!="" ){ if(@$user['Zonal_admin_id']!=0 ){ echo "style='display:block;'"; }} else{ echo "style='display:none;'"; } ?>>
                                            <label class="control-label" for="code">Zone</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                 <select name='Zone' id='Zone' onchange="zone_states(this.value);" >
                                                  <option value=''>Select Zone </option>
                                                    <?php
                                                    foreach($zone as $key)
                                                    {
                                                    ?>
                                                    <option value='<?php echo $key['id']; ?>' <?php if(@$user['Zonal_admin_id']==$key['id']){ echo "selected"; } ?>><?php echo $key['First_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                 </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group" id='state' <?php if(@$user['State_admin_id']!="" ){ if(@$user['State_admin_id']!="0" ){ echo "style='display:block;'"; }} else{ echo "style='display:none;'"; } ?>>
                                            <label class="control-label" for="code">State</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <select name='State' id='State'  >
                                                     <option value=''>Select State </option>
                                                    <?php
                                                    /*foreach($state as $key)
                                                    {
                                                    ?>
                                                    <option value='<?php echo $key['id']; ?>' <?php if(@$user['State_admin_id']==$key['id']){ echo "selected"; } ?>><?php echo $key['First_name']; ?></option>
                                                    <?php
                                                    }*/
                                                    ?>
                                                </select>
                                                </div>
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
								<input type="submit" class="btn btn-success"  tabindex="8" value="<?php if ($this->uri->segment(3)) { ?>Update<?php } else { ?>Add<?php } ?> User" />
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
function zone_states(id)
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
var role="<?php echo @$user['role'] ?>";
if(role !="" && role !="coordinator")
{
	$("#retreat_ids").hide();
	$('#retreats').attr('disabled','disabled');
}
$(function(){
	$("#roles").on('change',function(){
		var valu=$(this).val();
		if(valu =="zone")
		{
			$("#state").hide();
			$("#zone").hide();
			$("#county").hide();
			$("#all_stateDiv").show();
			$("#State").prop('required',false);
			$("#Zone").prop('required',false);
		}
		if(valu =="state")
		{
			$("#zone").hide();//.show();
			$("#zone").prop('required',false);
			$("#state").show();
			$("#county").hide();
			$("#State").prop('required',false);
			$("#all_stateDiv").hide();
		}
		if(valu =="state_zone")
		{
			$("#zone").hide();//.show();
			$("#zone").prop('required',false);
			$("#state").hide();
			$("#county").hide();
			$("#State").prop('required',false);
			$("#all_countyDiv").show();
			$("#all_county").prop('required',true);
		}
		if(valu =="county")
		{
			$("#state").show();
			$("#zone").show();
			$("#all_stateDiv").hide();
			$("#State").prop('required',true);
			$("#Zone").prop('required',true);
			$("#county").hide();
		}
		if(valu =="Distributer" || valu =="finance" )
		{
			$("#state").hide();
			$("#zone").hide();
			$("#all_stateDiv").hide();
			$("#State").prop('required',false);
			$("#Zone").prop('required',false);
			$("#county").hide();
		}
		
	});
	
});
</script>
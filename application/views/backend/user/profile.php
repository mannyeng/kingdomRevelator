<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Create / Edit Profile 
				</h3>
				<ul class="breadcrumb">
					<li class="active">
						Dashboard
						<span class="divider">/</span>
					</li>
					<li class="active">
						Profile
						
					</li>
					
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
		<?php if( $this->session->flashdata('flash_message')) {
		 ?>
		<!-- BEGIN Alert widget-->
		<div class="row-fluid">
			<div class="span12">				
				<?php if($this->session->flashdata('flash_message')) { ?>
				<div class="alert alert-info">
					<button class="close" data-dismiss="alert">×</button>
					<?php echo $this->session->flashdata('flash_message'); ?>
				</div>
				<?php } ?>
			</div>
		</div>
        <?php } ?>
		<!-- END Alert widget-->
       	
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
                              	<div class='span12'> 
                                    <div class="span6">
                                       <?php
										if($this->session->userdata('role')!="webadmin")
										{
											?> 
                                      <div class="control-group">
                                            <label class="control-label" for="code">Name</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <?php if(($this->session->userdata('role') == 'zone' ) || ($this->session->userdata('role') == 'state' ) || ($this->session->userdata('role') == 'state_zone' )) { //print_r($user);
												//echo @$user['Name'];
echo @$user['First_name'];
												}
												else
												echo @$user['First_name']; ?>
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <?php
										 }
										?>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Password</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="text" class="span10 noquote" id="Password" name="Password" value="<?php echo @$user['Password']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <?php
										if($this->session->userdata('role')=="webadmin")
										{
//print_r($user);
											?>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Username</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="text" class="span10 noquote" id="Email_address" name="Email_address" value="<?php echo @$user['Email_address']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Security Key</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="text" class="span10 noquote" id="security_a" name="security_a" value="<?php echo @$user['security_a']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <?php
										}
										if($this->session->userdata('role')!="webadmin")
										{
											?>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Email</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                <input type="email" class="span10 noquote" id="Email_address" name="Email_address" value="<?php echo @$user['Email']; ?>" required="required" >
                                                
                                            </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Address1</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10 noquote" id="Address1" name="Mailing_address1" value="<?php echo @$user['Mailing_address1']; ?>" required="required" disabled >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="control-group">
                                            <label class="control-label" for="code">Address2</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10 noquote" id="Address2" name="Mailing_address2" value="<?php echo @$user['Mailing_address2']; ?>" required="required" disabled >
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                    <div class="span6">
                                        <div class="control-group">
                                            <label class="control-label" for="code">State</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                	
                                                <select name='State' id='State' class="span10 required" required="required" disabled>
                                                <option value="">Select State</option> 
                                                    <?php
                                                    foreach($state as $key)
                                                    {
                                                    ?>
                                                    <option value='<?php echo $key['State_name']; ?>' <?php if(@$user['State']==$key['State_name']){ echo "selected"; } ?>><?php echo $key['State_name']; ?></option>
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
                                                    <input type="text" class="span10 noquote" id="Zip" name="Zipcode" pattern="[0-9]+" maxlength="6" value="<?php echo @$user['Zipcode']; ?>" required="required" disabled >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="code">Phone Home</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10 noquote" id="Phone_Home" name="Home_phone" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Home_phone']; ?>" required="required" disabled >
                                                </div>
                                            </div>
                                        </div>
                                         <div class="control-group">
                                            <label class="control-label" for="code">Phone Cell</label>
                                            <div class="controls">
                                                <div class="input-append span10" >
                                                    <input type="text" class="span10" id="Phone_Cell" name="Cell_phone" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Cell_phone']; ?>" required="required" disabled >
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php
										}
										?>
								</div>
							</fieldset>
                            <input type='hidden' name='dist_id' value='<?php echo @$user['Distributer_id']; ?>' />
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
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
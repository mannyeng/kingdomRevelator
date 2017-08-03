<?php

if ($this->uri->segment(3))

{

	$id     = $this->uri->segment(3);

	$result = $this->db->query("SELECT b.id,b.First_name,b.Last_name FROM kr_users WHERE id='$id' and admin_type='finance'");

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

					Create / Edit Financial 

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="<?php echo $this->session->userdata('role');?>">Dashboard</a>

						<span class="divider">/</span>

					</li>

                    <li>

						<a href="user">User</a>

						<span class="divider">/</span>

					</li>

					<li class="active">

						Finance

						

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

                                        

                                      <div class="control-group">

                                            <label class="control-label" for="code">Coordinator Name</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                 <select name='Distributer_id' id='distributer' class="span10 required" required="required" onchange="distributer_detail($(this).val());">

                                                    <option value="">Select Bulk Subscriber</option> 

                                                        <?php

                                                        $distributer = $this->db->query("SELECT * FROM kr_distributers")->result_array();

                                                        foreach($distributer as $key)

                                                        {
                                                                //if($key['id']==@$user['Distributer_id']){

                                                        ?>

                                                        <option value='<?php echo $key['id']?>' ><?php echo $key['First_name']." ".$key['Last_name']; ?></option>

                                                        <?php
                                                          // }

                                                        }

                                                        ?>

                                                 </select>                                                

                                            </div>

                                            </div>

                                        </div>

                                        

                                        <div class="control-group">

                                            <label class="control-label" for="code">Password</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <input type="text" class="span10 noquote" id="Password" name="Password" value="<?php echo @$user['Password']; ?>" required="required" >

                                                

                                            </div>

                                            </div>

                                        </div>

                                        

                                        <div class="control-group">

                                            <label class="control-label" for="code">Email</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <input type="email" class="span10" id="Email_address" name="" disabled="disabled" value="<?php echo @$user['Email_address']; ?>" required="required" >

                                                <input type="hidden" class="span10" id="Email_address_hdn" name="Email_address"  value="<?php echo @$user['Email_address']; ?>" required="required" >

                                            </div>

                                            </div>

                                        </div>

                                        

                                        <div class="control-group">

                                            <label class="control-label" for="code">Address1</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Address1" name="Address1" disabled="disabled" value="<?php echo @$user['Address1']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="code">Address2</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Address2" name="Address2" disabled="disabled" value="<?php echo @$user['Address2']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        

                                     </div>

                                    <div class="span6">

                                    

                                        <div class="control-group">

                                            <label class="control-label" for="code">State</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                	

                                                <select name='State' id='State' class="span10" disabled="disabled" required="required">

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

                                                    <input type="text" class="span10" id="Zip" name="Zip" disabled="disabled" pattern="[0-9]+" maxlength="6" value="<?php echo @$user['Zip']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="code">Phone Home</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Phone_Home" name="Phone_Home" disabled="disabled" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Phone_Home']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                         <div class="control-group">

                                            <label class="control-label" for="code">Phone Cell</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Phone_Cell" name="Phone_Cell" disabled="disabled" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Phone_Cell']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        <?php  if($this->session->userdata('role') == 'webadmin') {

											?>

                                        <div class="control-group">

                                            <label class="control-label" for="code">Status</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <?php 

											    if(@$user['flag']==0)

											    {

												$r1 = 'checked="checked"';

												$r2 = '';

												}

												else

												{

													$r2 = 'checked="checked"';

												$r1 = '';

													}	

												?>

                                                    <p>

                                                        <input type="radio" name="flag" value="0" id="r1" <?php echo $r1; ?>/>

                                                        Active&nbsp;&nbsp;

                                                        

                                                        <input type="radio" name="flag" value="1" id="r2" <?php echo $r2; ?> />

                                                        Disable

                                                   </p> 

                                                </div>

                                            </div>

                                            

                                        </div><?php }?>

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

function distributer_detail(id)

{

	$.ajax({

		method:'POST',

		data:"id="+id,

		url:"Ajaxaction/distributer_detail",

		success:function getstate($msg)

		{

			var array = JSON.parse($msg);

			$('#Email_address').val(array['Email_address']);

			$('#Email_address_hdn').val(array['Email_address']);

			$('#Address1').val(array['Mailing_address1']);

			$('#Address2').val(array['Mailing_address2']);

			$('#State').val(array['State']);

			$('#Zip').val(array['Zipcode']);

			$('#Phone_Home').val(array['Home_phone']);	

			$('#Phone_Cell').val(array['Cell_phone']);

		}

		

		})

}



$(function(){

	$("#form-validate").validate();

		

});

</script>
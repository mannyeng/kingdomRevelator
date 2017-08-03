<?php

if ($this->uri->segment(3))

{

	

	$id     = $this->uri->segment(3);

	$this->db->join('kr_distributers','kr_distributers.id=kr_users.Distributer_id','Inner');

	$user = $this->db->get_where('kr_users',array('kr_users.id'=>$id,'kr_users.admin_type'=>'national'))->row_array();

	$distributer = $this->db->query("SELECT * FROM kr_distributers b left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE c.paypal_status!='pending' and b.id not in (select Distributer_id from kr_users where id!='$id') ")->result_array();

	



}

else

{

	$distributer = $this->db->query("SELECT * FROM kr_distributers b left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE c.paypal_status!='pending' and b.id not in (select Distributer_id from kr_users) ")->result_array();

}?>

<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Create / Edit National 

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

						National

						

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

                                            <label class="control-label" for="code">State</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

<!--                                                <input type="text" class="span10" id="First_name" name="First_name" value="<?php echo @$user['First_name']; ?>" required="required" >

-->                                               <select id='state' class="span10 required" required="required" <?php if ($this->uri->segment(3)){?> onchange="state_select_update($(this).val(),<?php echo $this->uri->segment(3); ?>);" <?php }else{?> onchange="state_select($(this).val());" <?php } ?> >

                                                    <option vlaue="">Select State</option> 

                                                        <?php

														foreach($state as $key)

														{

														?>

														<option value='<?php echo $key['State_name']; ?>' <?php if(@$user['State']==$key['State_name']){ echo "selected"; }?>><?php echo $key['State_name']; ?></option>

														<?php

														}

														?>

                                                 </select>  

                                                </div>

                                            </div>

                                        </div>

                                        

                                      <div class="control-group">

                                            <label class="control-label" for="code">Coordinator Name</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

<!--                                                <input type="text" class="span10" id="First_name" name="First_name" value="<?php echo @$user['First_name']; ?>" required="required" >

-->                                               <select name='Distributer_id' id='distributer' class="span10 required" disabled required="required" onchange="distributer_detail($(this).val());">

                                                    <option vlaue="">Select Bulk Subscriber</option> 

                                                        <?php

                                                        foreach($distributer as $key)

                                                        {

                                                        ?>

                                                        <option value='<?php echo $key['id']?>'  <?php if(@$user['Distributer_id']==$key['id']){ echo "selected"; } ?> ><?php echo $key['First_name']." ".$key['Last_name']; ?></option>

                                                        <?php

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

                                                <input type="text" class="span10" id="Password" name="Password"  value="<?php echo @$user['Password']; ?>" required="required" >

                                                

                                            </div>

                                            </div>

                                        </div>

                                        

                                        <div class="control-group">

                                            <label class="control-label" for="code">Email</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <input type="email" class="span10" id="Email_address" name="" disabled="disabled" value="<?php echo @$user['Email_address']; ?>" required="required" >

                                                <input type="hidden" class="span10" id="Email_address_hdn" name="Email_address" value="<?php echo @$user['Email_address']; ?>" required="required" >

                                            </div>

                                            </div>

                                        </div>

                                        

                                        <div class="control-group">

                                            <label class="control-label" for="code">Address1</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Address1" name="Address1" disabled="disabled" value="<?php echo @$user['Mailing_address1']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        

                                        <div class="control-group">

                                            <label class="control-label" for="code">Address2</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Address2" name="Address2" disabled="disabled" value="<?php echo @$user['Mailing_address2']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                     </div>

                                    <div class="span6">

                                        <div class="control-group">

                                            <label class="control-label" for="code">State</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                	

                                                <select name='State' id='State' class="span10 required" disabled="disabled" required="required">

                                                <option vlaue="">Select State</option> 

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

                                                    <input type="text" class="span10" id="Zip" name="Zip" pattern="[0-9]+" disabled="disabled" maxlength="6" value="<?php echo @$user['Zipcode']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="code">Phone Home</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Phone_Home" name="Phone_Home" disabled="disabled" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Home_phone']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                         <div class="control-group">

                                            <label class="control-label" for="code">Phone Cell</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Phone_Cell" name="Phone_Cell" disabled="disabled" pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Cell_phone']; ?>" required="required" >

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

function state_select(id)

{

	$('#distributer').prop('disabled');

	$.ajax({

		method:'POST',

		data:"id="+id,

		url:"user/get_by_type1",

		success:function getstate($msg)

		{

			$('#distributer').html($msg);

			$('#distributer').removeAttr('disabled');

		}

		

		})

}



function state_select_update(id,url)

{

	$('#distributer').prop('disabled');

	$.ajax({

		method:'POST',

		data:"id="+id+"&url="+url,

		url:"user/get_by_type1_update",

		success:function getstate($msg)

		{

			$('#distributer').html($msg);

			$('#distributer').removeAttr('disabled');

		}

		

		})

}





$(function(){

	$("#form-validate").validate();

		

});

</script>
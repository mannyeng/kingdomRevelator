<?php

if ($this->uri->segment(3))

{

	$id     = $this->uri->segment(3);

	if($this->session->userdata('role') == 'national')

	$this->db->where('National_admin_id',$this->session->userdata('id'));

	if($this->session->userdata('role') == 'zone')

	$this->db->where('Zonal_admin_id',$this->session->userdata('id'));

	$this->db->join('kr_distributers','kr_distributers.id=kr_users.Distributer_id','Inner join');

	$user = $this->db->get_where('kr_users',array('kr_users.id'=>$id,'kr_users.admin_type'=>'state'))->row_array();

	$non_allotted = $this->db->query("select State_name from kr_state where State_name not in (select Name from kr_users where admin_type='state' and Name != '".$user['Name']."') ")->result_array();

	$distributer = $this->db->query("SELECT * FROM kr_distributers b left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE c.paypal_status!='pending' and b.id not in (select Distributer_id from kr_users where id!='$id') ")->result_array();

}

else

{

	$non_allotted = $this->db->query("select State_name from kr_state where State_name not in (select Name from kr_users where admin_type='state')")->result_array();

	$distributer = $this->db->query("SELECT * FROM kr_distributers b left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE c.paypal_status!='pending' and b.id not in (select Distributer_id from kr_users)  ")->result_array();



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

					Create / Edit State

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

						State

						

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

                                            <label class="control-label" for="code">National Coordinator</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <?php if($this->session->userdata('role') == 'webadmin') {?>

                                                                                        

                                                <select name='National_admin_id' id='National_admin_id' class="span10" required="required" onchange="get_zone($(this).val())"> 

                                                <option value="">Select</option> 

                                                    <?php

												

                                                    foreach($national as $key)

                                                    {

                                                    ?>

                                                    <option value='<?php echo $key['id']; ?>' <?php if(@$user['National_admin_id']==$key['id']){ echo "selected"; } ?>><?php echo $key['First_name']; ?></option>

                                                    <?php

                                                    }

                                                    ?>

                                                 </select>

                                               <?php } 

											   if(($this->session->userdata('role') == 'national') || ($this->session->userdata('role') == 'zone')) {?>

												  <label class="control-label" for="name"><?php echo ucfirst($national['First_name']); ?></label>

                                                  <input type="hidden" name="National_admin_id" value="<?php echo $national['id'];?>"> 

												  <?php }

											   ?>

                                                </div>

                                            </div>

                                        </div> 

                                        

                                           <div class="control-group">

                                            <label class="control-label" for="code">Zone Name</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <?php

                                                 if(($this->session->userdata('role') == 'national') || ($this->session->userdata('role') == 'webadmin')) {

													

											   ?>

                                                

                                                <select name='Zonal_admin_id' id='Zonal_admin_id' class="span10" required="required"> 

                                                <option value="">Select</option> 

                                                    <?php

                                                    foreach($zone as $key)

                                                    {

                                                    ?>

                                                    <option value='<?php echo $key['id']; ?>' <?php if(@$user['Zonal_admin_id']==$key['id']){ echo "selected"; } ?>><?php echo $key['Name']; ?></option>

                                                    <?php

                                                    }

                                                    ?>

                                                 </select>

                                                 <?php

												 }

												 else

												 {?>

												 

												  <label class="control-label" for="name"><?php echo ucfirst($zone['Name']); ?></label>

                                                  <input type="hidden" name="Zonal_admin_id" value="<?php echo $zone['id'];?>"> 

												  <?php 

												  }

												 ?>

                                                 

                                                

                                            </div>

                                            </div>

                                        </div>

                                        

                                      <div class="control-group">

                                            <label class="control-label" for="code">State Name</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                <select name='Name' id='First_name' class="span10" required="required" <?php if ($this->uri->segment(3)){?> onchange="state_select_update($(this).val(),<?php echo $this->uri->segment(3); ?>);" <?php }else{?> onchange="state_select($(this).val());" <?php } ?>>

                                                <option value="">Select State</option> 

                                                    <?php

                                                    foreach($non_allotted as $key)

                                                    {

                                                    ?>

                                                    <option value='<?php echo $key['State_name']; ?>' <?php if(@$user['Name']==$key['State_name']){ echo "selected"; } ?>><?php echo $key['State_name']; ?></option>

                                                    <?php

                                                    }

                                                    ?>

                                                 </select>

                                                

                                            </div>

                                            </div>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="code">Coordinator name</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                 <select name='Distributer_id' id='distributer' class="span10 required" disabled required="required" onchange="distributer_detail($(this).val());">

                                                    <option vlaue="">Select Bulk Subscriber</option> 

                                                        <?php

                                                        foreach($distributer as $key)

                                                        {

                                                        ?>

                                                        <option value='<?php echo $key['id']?>'  <?php if($key['id']==@$user['Distributer_id']){ echo "selected";}?> ><?php echo $key['First_name']." ".$key['Last_name']; ?></option>

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

                                                <input type="text" class="span10" id="Password" name="Password" value="<?php echo @$user['Password']; ?>" required="required" >

                                                

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

                                        

                                     </div>

                                    <div class="span6">

                                    <div class="control-group">

                                            <label class="control-label" for="code">Address1</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Address1" name="Address1" disabled="disabled"  value="<?php echo @$user['Mailing_address1']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                    <div class="control-group">

                                            <label class="control-label" for="code">Address2</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Address2" name="Address2" disabled="disabled"  value="<?php echo @$user['Mailing_address2']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="code">State</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                	

                                                <select name='State' id='State' class="span10" disabled="disabled"  required="required">

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

                                                    <input type="text" class="span10" id="Zip" name="Zip" disabled="disabled"  pattern="[0-9]+" maxlength="6" value="<?php echo @$user['Zipcode']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="code">Phone Home</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Phone_Home" name="Phone_Home" disabled="disabled"  pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Home_phone']; ?>" required="required" >

                                                </div>

                                            </div>

                                        </div>

                                         <div class="control-group">

                                            <label class="control-label" for="code">Phone Cell</label>

                                            <div class="controls">

                                                <div class="input-append span10" >

                                                    <input type="text" class="span10" id="Phone_Cell" name="Phone_Cell" disabled="disabled"  pattern="[0-9]+" maxlength="10" value="<?php echo @$user['Cell_phone']; ?>" required="required" >

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



function get_zone(id)

{

	$.ajax({

		method:'POST',

		data:"id="+id,

		url:"user/get_zone",

		success:function getstate($msg)

		{

			console.log($msg);

			$('#Zonal_admin_id').html($msg);

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

	$('#National_admin_id').on('change',function(){

		var field='National_admin_id';

		var value=$(this).val();

		var type='zone';

        $.get("<?php echo site_url('user/get_by_type'); ?>/"+field+'/'+value+'/'+type,function(retun){

				$("#Zonal_admin_id").html(retun);

			});





		});

		

});

</script>
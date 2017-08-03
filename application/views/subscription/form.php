<style>

    #banner {

      border-bottom: none

    }



    .page-header h1 {

      font-size: 4em

    }



    .bs-docs-section {

      margin-top: 8em

    }



    .bs-component {

      position: relative;

    }

	.well

	{

	  background:url('<?php echo base_url() ?>img/formback.png')!important;

	}

    .bs-component .modal {

      position: relative;

      top: auto;

      right: auto;

      left: auto;

      bottom: auto;

      z-index: 1;

      display: block

    }



    .bs-component .modal-dialog {

      width: 90%

    }



    .bs-component .popover {

      position: relative;

      display: inline-block;

      width: 220px;

      margin: 20px

    }



    #source-button {

      position: absolute;

      top: 0;

      right: 0;

      z-index: 100;

      font-weight: bold;

      padding: 5px 10px;

    }



    .progress {

      margin-bottom: 10px

    }



    footer {

      margin: 5em 0

    }



    footer li {

      float: left;

      margin-right: 1.5em;

      margin-bottom: 1.5em

    }



    footer p {

      clear: left;

      margin-bottom: 0

    }



    .splash {

      padding: 4em 0 0;

      background-color: #141d27;

      color: #fff;

      text-align: center

    }



    .splash h1 {

      font-size: 4em

    }



    .splash #social {

      margin: 2em 0

    }



    .splash .alert {

      margin: 2em 0

    }



    .section-tout {

      padding: 4em 0 3em;

      border-bottom: 1px solid rgba(0, 0, 0, 0.05);

      background-color: #eaf1f1

    }



    .section-tout .fa {

      margin-right: .5em

    }



    .section-tout p {

      margin-bottom: 3em

    }



    .section-preview {

      padding: 4em 0 4em

    }



    .section-preview .preview {

      margin-bottom: 4em;

      background-color: #eaf1f1

    }



    .section-preview .preview .image {

      position: relative

    }



    .section-preview .preview .image:before {

      box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1);

      position: absolute;

      top: 0;

      left: 0;

      width: 100%;

      height: 100%;

      content: "";

      pointer-events: none

    }



    .section-preview .preview .options {

      padding: 1em 2em 2em;

      border: 1px solid rgba(0, 0, 0, 0.05);

      border-top: none;

      text-align: center

    }



    .section-preview .preview .options p {

      margin-bottom: 2em

    }



    .section-preview .dropdown-menu {

      text-align: left

    }



    .section-preview .lead {

      margin-bottom: 2em

    }



    @media (max-width: 767px) {

      .section-preview .image img {

        width: 100%

      }

    }



    .sponsor {

      text-align: center

    }



    .sponsor a:hover {

      text-decoration: none

    }



    @media (max-width: 767px) {

      #banner {

        margin-bottom: 2em;

        text-align: center

      }

    }



    .infobox .btn-sup {

      color: rgba(0, 0, 0, 0.5);

      font-weight: bold;

      font-size: 15px;

      line-height: 30px;

    }



    .infobox .btn-sup img {

      opacity: 0.5;

      height: 30px;

    }



    .infobox .btn-sup span {

      padding-left: 10px;

      position: relative;

      top: 2px;

    }



    .icons-material .row {

      margin-bottom: 20px;

    }



    .icons-material .col-xs-2 {

      text-align: center;

    }



    .icons-material i {

      font-size: 34pt;

    }



    .icon-preview {

      display: inline-block;

      padding: 10px;

      margin: 10px;

      background: #D5D5D5;

      border-radius: 3px;

      cursor: pointer;

    }



    .icon-preview span {

      display: none;

      position: absolute;

      background: black;

      color: #EEE;

      padding: 5px 8px;

      font-size: 15px;

      border-radius: 2px;

      z-index: 10;

    }



    .icon-preview:hover i {

      color: #4285f4;

    }



    .icon-preview:hover span {

      display: block;

      cursor: text;

    }



  </style>

<?php 
if(isset($_GET['gift']))
$gift = $_GET['gift'];
else
$gift = '';
?>

<div class="col-lg-12 col-md-12 padding-zero">

        <div class="well bs-component">

        	<div class="row">

            	<img src="<?php echo base_url(); ?>img/banner.jpg" style="width:100%;"/>

            </div>	

            <br />

          	<form class="form-horizontal" id="subscriber_form" name="f1" method="post" onsubmit="return subscribe();">

            <fieldset>

              <legend><center> <?php if(sha1('gift')==$gift){echo 'GIFT ';} ?>SUBSCRIBER'S INFORMATION</center></legend>

             <div id='message'>
             <?php if($this->session->flashdata('alert')=='fails')
             { 
              ?><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>Email already exist.  <a href="javascript:void(0)" class="alert-link"></a></div>
              <?php
               } 
              if($this->session->flashdata('alert')=='success')
              { 
                ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Subscribed</strong> successfully.  <a href="javascript:void(0)" class="alert-link"></a></div>
                <?php 
                } 
                if($this->session->flashdata('payment')=='success')
              { 
                ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Subscribed</strong> successfully.  <a href="javascript:void(0)" class="alert-link"></a></div>
                <?php 
                } 
                 if($this->session->flashdata('paypal')=='success')
              { 
                ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Subscribed</strong> successfully.  <a href="javascript:void(0)" class="alert-link"></a></div>
                <?php 
                } 
                ?></div>

              <div class="col-lg-12" style="margin-left: 0%;z-index:1;">

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Enter_by" name='Enter_by' value="" placeholder=" Enter by">
                        <input type="hidden" name="gift" value="<?php echo $gift;?>" />
                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="First_name" name='First_name' value="" placeholder="<?php echo (sha1('gift')==$gift)?'Gift To (First Name)':' Subscriber First Name'; ?>">

                      </div>

                  </div>

                  <div class="form-group ">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Last_name" name='Last_name' value="" placeholder="<?php echo (sha1('gift')==$gift)?'Gift To (Last Name)':' Subscriber Last Name'; ?>">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Address1" name='Address1' value="" placeholder="<?php echo (sha1('gift')==$gift)?' Gift Mailing Address1 example : 766 Mary st':'  Mailing Address1 example : 766 Mary st'; ?>">

                      </div>

                  </div>

              </div>

              <!--<div class='col-lg-6  hidden-sm hidden-xs ' style='z-index:1;'>

                    <div><iframe width="500" height="315" src="https://www.youtube.com/embed/IfxTdk5-OWA" frameborder="0" allowfullscreen></iframe></div>

              </div>-->

              <div class='col-lg-12' style="z-index:1;">

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Address2" name='Address2' value="" placeholder="<?php echo (sha1('gift')==$gift)?' Gift Mailing Address2 example : 766 Mary st':'  Mailing Address2 example : unit 2Bt'; ?> ">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="City" name='City' value="" placeholder=" City">

                      </div>

                  </div>

                 <div class="form-group">

                    <div class="col-md-10 col-lg-offset-1">

                      <select id="State" name='State' class="form-control" onchange="color_change();">

                      <?php

                      $res_state = $this->db->query("SELECT * FROM kr_state");

                      $res_array = $res_state->result_array();

                      ?>

                        <option value=''>State</option>

                        <?php

                        foreach($res_array as $row)

                        {

                        ?>

                        <option value="<?php echo  $row['State_name'];?>"><?php echo  $row['State_name'];?></option>

                        <?php

                        }

                        ?>

                      </select>

                    </div>

                    <span class="material-input"></span>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Zipcode" name='Zipcode' maxlength='5' pattern='[0-9]{5}' title="Enter 5 digit Zipcode" value="" placeholder=" Zipcode">

                      </div>

                  </div>

                  <div class="form-group" style="display:none;">

                    <div class="col-md-10 col-lg-offset-1">

                      <select id="Contry" name='Contry' class="form-control">

                        <option value=''>Contry</option>

                        <option>1</option>

                        <option>2</option>

                        <option>3</option>

                        <option>4</option>

                        <option>5</option>

                      </select>

                    </div>

                    <span class="material-input"></span>

                  </div>

                  <div class="form-group">

                     <div class="checkbox col-lg-offset-1">

                       <label style="color:#000!important;">

                        <input type="checkbox" name='same' id='same' value='1' onclick='same_billing();' > Same As Above

                       </label>

                      </div>

                   </div>

                   <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="BAddress1" name='BAddress1' value="" placeholder=" Billing Address1 example : 766 Mary st">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="BAddress2" name='BAddress2' value="" placeholder=" Billing Address2 example : unit 2Bt">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="BCity" name='BCity' value="" placeholder=" City">

                      </div>

                  </div>

                  <div class="form-group">

                    <div class="col-md-10 col-lg-offset-1">

                      <select id="BState" name='BState' class="form-control" onchange="color_change1();">

                      <?php

                      $res_state = $this->db->query("SELECT * FROM kr_state");

                      $res_array = $res_state->result_array();

                      ?>

                        <option value=''>State</option>

                        <?php

                        foreach($res_array as $row)

                        {

                        ?>

                        <option value="<?php echo  $row['State_name'];?>"><?php echo  $row['State_name'];?></option>

                        <?php

                        }

                        ?>

                      </select>

                    </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="BZipcode" name='BZipcode' value="" maxlength='5' pattern='[0-9]{5}' title="Enter 5 digit Zipcode" placeholder=" Zipcode">

                      </div>

                  </div>

                  <div class="form-group" style="display:none;">

                    <div class="col-md-10 col-lg-offset-1">

                      <select id="Contry" name='Contry' class="form-control">

                        <option value=''>Contry</option>

                        <option>1</option>

                        <option>2</option>

                        <option>3</option>

                        <option>4</option>

                        <option>5</option>

                      </select>

                    </div>

                    <span class="material-input"></span>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Home_phone" name='Home_phone' minlength='10'  maxlength='10' pattern='[0-9]{10}' title="Enter 10 digit number" value="" placeholder=" Home Phone">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Cell_phone" name='Cell_phone' minlength='10'  maxlength='10' pattern='[0-9]{10}' title="Enter 10 digit number" value="" placeholder=" Cell Phone">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="email" class="form-control" id="Email" name='Email' value="" autocomplete="off"  placeholder=" Email Address" onblur="email_check();">

                        <input type='hidden' id='valid_email' value='' />

                     </div>

                  </div>

                  <span id='email_validate' style='color:red;margin-left: 9%;'></span>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="password" class="form-control" id="Password" name='Password' value=""  placeholder=" Password">

                      </div>

                  </div>

                  <div class="form-group">

                      <div class="col-lg-10 col-md-10 col-lg-offset-1">

                        <input type="text" class="form-control" id="Church_name" name='Church_name' value="" placeholder=" Church Name">

                      </div>

                  </div>

                   

                   <?php

          $price  = $this->db->query("SELECT * FROM kr_book_price ")->row_array();

        ?>

              <?php /*?><div class="form-group">

                    <label class="col-lg-4 col-md-2 control-label label-style">Subscription Options (Subscription will always start from the following month.) </label>

    

                    <div class="col-lg-8 col-md-10">

                      <div class="radio radio-primary">

                        <label>

                          <input type="radio" name="optionssubscription" id="optionssubscription1" value="<?php echo @$price['1_yr_price']; ?>" <?php  echo "checked"; ?> onclick="getDiscount($('#copies').val());">

                         1-Year ($ <?php echo @$price['1_yr_price']; ?>)

                        </label>

                      </div>

                      <div class="radio radio-primary">

                        <label>

                          <input type="radio" name="optionssubscription" id="optionssubscription2" value="<?php echo @$price['2_yr_price']; ?>" onclick="getDiscount($('#copies').val());">

                          2-Years ($ <?php echo @$price['2_yr_price']; ?>)

                        </label>

                      </div>

                    </div>

                  </div><?php */?>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                   <label style="color: #17b3e5;">Subscription Price : <span style="background: #17b3e5;color: #fff;padding: 8px 14px;">$ <?php echo $price['1_yr_price'];?> For 1 Year</span>&nbsp;<span style="background: #17b3e5;color: #fff;padding: 8px 14px;">$ <?php echo $price['2_yr_price'];?> For 2 Year</span> </label>

                  </div>

               </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Copies_requested" maxlength="3" name='Copies_requested' value='1'  placeholder="Please enter number copies" style="display: none;">

                  </div>

              </div>

              <span id="nocopies" style="color:#F00;margin-left: 9%;"></span>

              <div class="form-group">

                <div class="col-md-10 col-lg-offset-1">

                  <select id="request_month" name='Request_month' class="form-control" onchange="getDiscount($('#Copies_requested').val(),$(this).val())">

                    <option value="">Select number of Year</option>

                    <option value="12">1</option>

                    <option value="24">2</option>

                    
                  </select>

                </div>

                <span class="material-input"></span>

              </div>

              <div class="form-group">

                 <div class="col-lg-10 col-md-10 col-lg-offset-1">

                 <span id="month" style="color:#F00;"></span>

                 </div>

              </div>

              <div class="form-group" >

                      <div class="col-lg-10 col-md-10 col-lg-offset-1" id='message_discount'>

                      </div>

                  </div>

                  

              <!--<span style="margin-left: 9%;color: #F00;">* $<?php //echo @$price['1_yr_price']; ?> Per Copy</span>-->

               <div class="form-group">

                    <label class="col-lg-4 col-md-2 control-label label-style" style="margin-top:5px;">Mode of Payment </label>

    

                    <div class="col-lg-8 col-md-10" style="display: inline-flex;">

                      <div class="radio radio-primary">

                        <label>

                          <input type="radio" name="optionspayment" id="optionspayment1" value="online" <?php echo "checked";?>>

                          Pay online

                        </label>

                      </div>

                      <div class="radio radio-primary">

                        <label>

                          <input type="radio" name="optionspayment" id="optionspayment2" value="Cash" >

                          Cash

                        </label>

                      </div>

                      <div class="radio radio-primary">

                        <label>

                          <input type="radio" name="optionspayment" id="optionspayment3" value="Cheque" >

                          Cheque

                        </label>

                      </div>

                    </div>

                  </div>

                  <div id='payment_type_cash' style="display:none">

                      <div class="form-group">

                          <div class="col-lg-10 col-md-10 col-lg-offset-1">

                            <input type="text" class="form-control" id="cash_agent_name" name='cash_agent_name' value="" placeholder=" Please enter the agent name" >

                          </div>

                      </div>

                      <div class="form-group">

                          <div class="col-lg-10 col-md-10 col-lg-offset-1">

                            <input type="text" class="form-control" id="cash_comments" name='cash_comments' value="" placeholder=" Comments">

                          </div>

                      </div>

                  </div>

                  <div id='payment_type_cheque' style="display:none">

                      <div class="form-group">

                          <div class="col-lg-10 col-md-10 col-lg-offset-1">

                            <input type="text" class="form-control" id="cheque_agent_name" name='cheque_agent_name' value=""  placeholder=" Please enter the agent name,Cheque number" >

                          </div>

                      </div>

                      <div class="form-group">

                          <div class="col-lg-10 col-md-10 col-lg-offset-1">

                            <input type="text" class="form-control" id="cheque_comments" name='cheque_comments' value="" placeholder=" Comments">

                          </div>

                      </div>

                  </div>


              <div class="form-group">

              <input type='hidden' name='amount' id='amount' />

                <div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">

                  <button type="button" class="btn btn-default" onclick="document.getElementById('subscriber_form').reset();">Cancel</button>

                  <input type="submit" id="ADD" name='Subscribe' class="btn btn-primary" value='Submit'/>

                </div>

              </div>

            </fieldset>

          </form>

        </div>

      </div>

<script src="<?php echo base_url() ?>js/ripples.min.js"></script>

<script src="<?php echo base_url() ?>js/material.min.js"></script>

<script type="text/javascript">

function color_change()

{

	$('#State').attr('style', 'color: black !important;font-weight: 200 !important');    

}

function color_change1()

{

	$('#BState').attr('style', 'color: black !important;font-weight: 200 !important');    

}

function same_billing()

{

	if($('#Address1').val()=='')

	{

		$('#Address1').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#Address1').css('color','red');

		$('#Address1').focus();

		$('#same').removeAttr('checked');

	}

	/*else if($('#Address2').val()=='')

	{

		$('#Address2').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#Address2').css('color','red');

		$('#Address2').focus();

		$('#same').removeAttr('checked');

	}*/

	else if($('#City').val()=='')

	{

		$('#City').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#City').css('color','red');

		$('#City').focus();

		$('#same').removeAttr('checked');

	}

	else if($('#State').val()=='')

	{

		$('#State').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#State').css('color','red');

		$('#State').focus();

		$('#same').removeAttr('checked');

	}

	else if($('#Zipcode').val()=='')

	{

		$('#Zipcode').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#Zipcode').css('color','red');

		$('#Zipcode').focus();

		$('#same').removeAttr('checked');

	}

	else

	{

		$('#BState').attr('style', 'color: black !important;font-weight: 200 !important');

		$('#BAddress1').val($('#Address1').val());

		$('#BAddress2').val($('#Address2').val());

		$('#BCity').val($('#City').val());

		$('#BState').val($('#State').val());

		$('#BZipcode').val($('#Zipcode').val());

		$('#same').addAttr('checked');

		

	}

	

	

}

function subscribe()

{



	if($('#First_name').val()=='' || $('#Password').val()=='' || $('#Last_name').val()=='' || $('#Address1').val()=='' || $("#valid_email").val()=='Email address already exist.'|| $('#City').val()=='' || $('#State').val()=='' || $('#Zipcode').val()=='' || $('#Home_phone').val()=='' || $('#Cell_phone').val()=='' || $('#Email').val()=='' || ($('#payment_type_cash').css('display') != 'none' && $('#cash_agent_name').val()=='') || ($('#payment_type_cheque').css('display') != 'none' && $('#cheque_agent_name').val()==''))

	{

		

		if($('#First_name').val()=='')

		{

			$('#First_name').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#First_name').css('color','red');

			$('#First_name').focus();

		}

		else if($('#Last_name').val()=='')

		{

			$('#Last_name').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Last_name').css('color','red');

			$('#Last_name').focus();

		}

		else if($('#Address1').val()=='')

		{

			$('#Address1').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Address1').css('color','red');

			$('#Address1').focus();

		}

		

		else if($('#City').val()=='')

		{

			$('#City').parents('.col-lg-10').parent().addClass('has-error is-focused');

	    	$('#City').css('color','red');

			$('#City').focus();

		}

		else if($('#State').val()=='')

		{

			$('#State').parents('.col-lg-10').parent().addClass('has-error is-focused');

	   		$('#State').css('color','red');

			$('#State').focus();

		}

		else if($('#Zipcode').val()=='')

		{

			$('#Zipcode').parents('.col-lg-10').parent().addClass('has-error is-focused');

	    	$('#Zipcode').css('color','red');

			$('#Zipcode').focus();

		}

		

		else if($('#BAddress1').val()=='')

		{

			$('#BAddress1').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#BAddress1').css('color','red');

			$('#BAddress1').focus();

		}

		

		else if($('#BCity').val()=='')

		{

			$('#BCity').parents('.col-lg-10').parent().addClass('has-error is-focused');

	    	$('#BCity').css('color','red');

			$('#BCity').focus();

		}

		else if($('#BState').val()=='')

		{

			$('#BState').parents('.col-lg-10').parent().addClass('has-error is-focused');

	   		$('#BState').css('color','red');

			$('#BState').focus();

		}

		else if($('#BZipcode').val()=='')

		{

			$('#BZipcode').parents('.col-lg-10').parent().addClass('has-error is-focused');

	    	$('#BZipcode').css('color','red');

			$('#BZipcode').focus();

		}

		else if($('#Home_phone').val()=='')

		{

			$('#Home_phone').parents('.col-lg-10').parent().addClass('has-error is-focused');

	 	    $('#Home_phone').css('color','red');

			$('#Home_phone').focus();

		}

		else if($('#Cell_phone').val()=='')

		{

		   	$('#Cell_phone').parents('.col-lg-10').parent().addClass('has-error is-focused');

	   		$('#Cell_phone').css('color','red');

			$('#Cell_phone').focus();

		}

		else if($('#Email').val()=='')

		{

			$('#Email').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Email').css('color','red');

			$('#Email').focus();

		}

		else if($('#Password').val()=='')

		{

			$('#Password').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Password').css('color','red');

			$('#Password').focus();

		}

		else if($('#Address1').val()=='')

		{

			$('#Church_name').parents('.col-lg-10').parent().addClass('has-error is-focused');

	    	$('#Church_name').css('color','red');

			$('#Church_name').focus();

		}

		else if($('#Enter_by').val()=='')

		{

			$('#Enter_by').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Enter_by').css('color','red');

			$('#Enter_by').focus();

		}

		else if($('#copies').val()=='')

		{

			$('#copies').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#copies').css('color','red');

			$('#copies').focus();

		}

		else if($("#valid_email").val()=='Email address already exist.')

		{

			$('#Email').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Email').css('color','red');

			$('#Email').focus();

		}

		else if($('#payment_type_cash').css('display') != 'none' && $('#cash_agent_name').val()=='')

		{

		    $('#cash_agent_name').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#cash_agent_name').css('color','red');

			$('#cash_agent_name').focus();

			}

			else if($('#payment_type_cheque').css('display') != 'none' && $('#cheque_agent_name').val()=='')

		    {

		    $('#cheque_agent_name').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#cheque_agent_name').css('color','red');

			$('#cheque_agent_name').focus();

			}

		return false;

	}

	else

	{

		$("#subscriber_form").submit();

	}

}

function email_check()

{

	$.ajax({

		method:'POST',

		data:'email='+$("#Email").val(),

		url:'<?php echo base_url();?>/Ajaxaction/email_check_sub',

		success:function(msg){

			$("#email_validate").html(msg);

			$('#valid_email').val(msg);

			}

		})

}





$(document).ready(function() {

	$('.form-group').on("click",function(){

		if($(this).hasClass('has-error'))

		{

			$(this).removeClass('has-error');

			//$(this).removeClass('is-focused');

			$(this).children('.col-lg-10').children().css('color','black');

		}

	});

		

	$('.form-group').on("keypress",function(){

		if($(this).hasClass('has-error'))

		{

			$(this).removeClass('has-error');

			//$(this).removeClass('is-focused');

			$(this).children('.col-lg-10').children().css('color','black');

		}

	});

    

});

</script>

<script>


$(document).ready(function()

{
  $('#ADD').attr('disabled',true);

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



function getDiscount(copy,mnth)

{

  $('#month').html(" ");

  if(mnth=='')

  {

    var month = $("#request_month").val();

  }

  else

  {

    var month = mnth;

  }

  if(month=='')

  {

    $('#month').html("Please select number of Year");

  }

  else

  {

    $(document).ready(function(){

      if(mnth == '12')
      var amount = parseInt(<?php echo $price['1_yr_price'];?>);
      if(mnth == '24')
      var amount = parseInt(<?php echo $price['2_yr_price'];?>);

      $('#nocopies').html('');

      $('#message_discount').html('');

      if($.isNumeric($('#Copies_requested').val()) )

      {

      
         
            if(amount==0)

            {

              $('#nocopies').html('');

              $('#nocopies').html('0 Not allowed');

              $('#ADD').attr('disabled',true);

            }

            else

            {

              $('#message_discount').html('');

              $('#message_discount').html("<div class='alert alert-dismissible alert-success'>Total amount is $"+(amount)+"</div>");

              $('#amount').val(amount);

              $('#ADD').removeAttr('disabled');

            }

         

       

      }

      else

      {

         $('#nocopies').html('');

         //$('#nocopies').html('Please Enter number.');

         $('#ADD').attr('disabled',true);

      }

    })

  }

}


  $(function () {

    $.material.init();

  

  });

</script>

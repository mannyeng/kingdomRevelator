<script>

function same_billing()

{

	if($('#Address1').val()=='')

	{

		$('#Address1').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#Address1').css('color','red');

		$('#Address1').focus();

		$('#same').removeAttr('checked');

	}

	else if($('#Address2').val()=='')

	{

		$('#Address2').parents('.col-lg-10').parent().addClass('has-error is-focused');

		$('#Address2').css('color','red');

		$('#Address2').focus();

		$('#same').removeAttr('checked');

	}

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

	if($('#username').val()=='' || $('#password').val()=='' )

	{

		if($('#username').val()=='')

		{

			$('#username').parents('.col-lg-6').parent().removeClass('has-success');

			$('#username').parents('.col-lg-6').parent().addClass('has-error is-focused');

			$('#username').css('color','red');

			$('#username').focus();

		}

		else if($('#password').val()=='')

		{

			$('#password').parents('.col-lg-6').parent().removeClass('has-success');

			$('#password').parents('.col-lg-6').parent().addClass('has-error is-focused');

			$('#password').css('color','red');

			$('#password').focus();

		}

		

		return false;

	}

	else

	{

		$("form").submit();

	}

}



$(document).ready(function() {

	$('.form-group').on("click",function(){

		if($(this).hasClass('has-error'))

		{

			$(this).removeClass('has-error');

			$(this).addClass('has-success');

			//$(this).removeClass('is-focused');

			$(this).children('.col-lg-6').children().css('color','black');

		}

	})

		

	$('.form-group').on("keypress",function(){

		if($(this).hasClass('has-error'))

		{

			$(this).removeClass('has-error');

			$(this).addClass('has-success');

			//$(this).removeClass('is-focused');

			$(this).children('.col-lg-6').children().css('color','black');

		}

	})

    

});

</script>



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

.form-group.label-static label.control-label, .form-group.label-floating.is-focused label.control-label, .form-group.label-floating:not(.is-empty) label.control-label {

    top: -40px;

    left: 15px;

    font-size: 12px;

    line-height: 1.07142857;

}

.control-label {

    font-size: 18px!important;

    color: rgba(5, 154, 37, 0.98)!important;

}

  </style>

<div class="col-lg-12 col-md-12 padding-zero">

        <div class="well bs-component">

        	<div class="row">

            	<img src="<?php echo base_url(); ?>img/banner.jpg" style="width:100%;"/>

            </div>	

            <br />

          	<form class="form-horizontal" id='subscriber_form' action='dist_login' method="POST" onSubmit="return subscribe();">

            <fieldset>

              <legend style="background: #3e0921;"><center>LOG IN FOR BULK SUBSCRIBER</center></legend>

             <div id='message'><?php if($this->session->flashdata('error')){ ?><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $this->session->flashdata('error'); ?> <a href="javascript:void(0)" class="alert-link"></a></div><?php } ?></div>

              <div class="form-group has-success label-floating is-empty">

              	<div class="col-lg-6 col-md-6 col-lg-offset-3">

                    <label for="Username" class="control-label" style="color: #3e0921 !important;">Email</label>

                    <input type="text" class="form-control" name='username' id="username" vk_16387="subscribed">

                </div>

              </div>

             <div class="form-group has-success label-floating is-empty">

              	<div class="col-lg-6 col-md-6 col-lg-offset-3">

                    <label for="password" class="control-label" style="color: #3e0921 !important;">Password</label>

                    <input type="password" class="form-control" name='password' id="password" vk_16387="subscribed">

                </div>

              </div>

              <div class="form-group has-success label-floating is-empty">

              	<div class="col-lg-6 col-md-6 col-lg-offset-3">

                    Forgot Password?<a href="../login/forgotpass/Distributer">Click here</a>

                </div>

              </div>

              <center>

                  <div class="form-group">

                  <input type='hidden' name='amount' id='amount' />

                    <div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">

                      <input type="submit" name='Subscribe' class="btn btn-primary" value='Log In' >

                    </div>

                  </div>

              </center>

            </fieldset>

          </form>

        </div>

      </div>

<script src="<?php echo base_url() ?>js/ripples.min.js"></script>

<script src="<?php echo base_url() ?>js/material.min.js"></script>



<script>

function getDiscount(copy)

{

	$(document).ready(function(){

		if ($("input[name='optionssubscription']").is(':checked')) {

		

			var amount = $("input[name='optionssubscription']:checked").val();

		}

		if(copy>=10)

		{

			$.ajax({

				method:"POST",

				data:"copy="+copy+"&amount="+amount,

				url:"../Ajaxaction/discount",

				success:function getstate($msg)

				{

					$('#message_discount').html('');

					$('#message_discount').html($msg);

				}

				

				})

				

				$.ajax({

				method:"POST",

				data:"copy="+copy+"&amount="+amount,

				url:"../Ajaxaction/amount",

				success:function getstate($msg)

				{

					

					$('#amount').val('');

					$('#amount').val($msg);

				}

				

				})

		}

		if(copy<10)

		{

			$('#message_discount').html('');

			$('#amount').val(copy*amount);

		}

	})

}

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



  $(function () {

    $.material.init();

  

  });

</script>
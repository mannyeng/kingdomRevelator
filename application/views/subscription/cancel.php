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
<div class="col-lg-12 col-md-12 padding-zero">
        <div class="well bs-component">
        	<div class="row">
            	<img src="<?php echo base_url(); ?>img/banner.jpg" style="width:100%;"/>
            </div>	
            <br />
          	<form class="form-horizontal" id="subscriber_form" name="f1" method="post" onsubmit="return subscribe();">
            <fieldset>
               <legend><center>PAYMENT INFO</center></legend>
                <div style="text-align:center;border: 1px solid #cc6f6f;background: #daa670;font-size: 22px;">You have cancelled online payment. Please check email for more information.</div>
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
		url:'../Ajaxaction/email_check_sub',
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
getDiscount('1');
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
	});
	
	$("#optionspayment3").click(function(){
	$('#payment_type_cash').hide();
	$('#payment_type_cheque').show();
	});
	
	$("#optionspayment1").click(function(){
	$('#payment_type_cash').hide();
	$('#payment_type_cheque').hide();
	});
});

  $(function () {
    $.material.init();
  
  });
</script>
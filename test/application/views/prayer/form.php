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
             <legend> <center>PRAYER REQUEST</center></legend>
			 <div id='message'><?php if($this->session->flashdata('alert')=='fails'){ ?><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>.  <a href="javascript:void(0)" class="alert-link"></a></div><?php } if($this->session->flashdata('alert')=='success'){ ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Requested the prayer</strong> successfully.  <a href="javascript:void(0)" class="alert-link"></a></div><?php } ?></div>
            	 <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="Name" name='Name' value="" placeholder="Name">
                      </div>
                  </div>
                   <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="Email" name='Email' value="" placeholder="Email">
                      </div>
                  </div>
                   <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="Location" name='Location' value="" placeholder=" Location">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="Contact Number" name='Contact' value="" placeholder=" Contact Number">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                         <textarea class="form-control" rows="8" name='Details'  maxlength="800" id="Details" placeholder=" Details"></textarea>
                      </div>
             	 </div>
                 <div class="form-group">
                 	 <input type='hidden' name='amount' id='amount' />
                    	<div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">
                    	  <button type="button" class="btn btn-default">Cancel</button>
                    	  <input type="submit" name='Subscribe' class="btn btn-primary" value='Submit' >
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

	if($('#Name').val()=='' || $('#Email').val()=='' || $('#Location').val()=='' || $("#Contact").val()==''|| $('#Detail').html()=='')
	{
		
		if($('#Name').val()=='')
		{
			$('#Name').parents('.col-lg-10').parent().addClass('has-error is-focused');
			$('#Name').css('color','red');
			$('#Name').focus();
		}
		else if($('#Email').val()=='')
		{
			$('#Email').parents('.col-lg-10').parent().addClass('has-error is-focused');
			$('#Email').css('color','red');
			$('#Email').focus();
		}
		else if($('#Location').val()=='')
		{
			$('#Location').parents('.col-lg-10').parent().addClass('has-error is-focused');
			$('#Location').css('color','red');
			$('#Location').focus();
		}
		
		else if($('#Contact').val()=='')
		{
			$('#Contact').parents('.col-lg-10').parent().addClass('has-error is-focused');
	    	$('#Contact').css('color','red');
			$('#Contact').focus();
		}
		else if($('#Detail').val()=='')
		{
			$('#Detail').parents('.col-lg-10').parent().addClass('has-error is-focused');
	   		$('#Detail').css('color','red');
			$('#Detail').focus();
		}
		
		return false;
	}
	else
	{
		$("#subscriber_form").submit();
	}
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
<script>

function color_change()

{

	$('#State').attr('style', 'color: black !important;font-weight: 200 !important');    

}



function validate_volunteer()

{

	if($('#First_name').val()=='' || $('#password').val()=='' || $('#Phone_Number_H').val()=='' || $('#Last_name').val()=='' || $("#valid_email").val()=='Email address already exist.' || $('#Address1').val()=='' || $('#City').val()=='' || $('#State').val()=='' || $('#Zipcode').val()=='' || $('#Home_phone').val()=='' || $('#Cell_phone').val()=='' || $('#Email').val()=='' || $('#memo').val()=='')

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

		/*else if($('#Address2').val()=='')

		{

			$('#Address2').parents('.col-lg-10').parent().addClass('has-error is-focused');

	   		$('#Address2').css('color','red');

			$('#Address2').focus();

		}*/

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

		else if($('#Phone_Number_H').val()=='')

		{

			$('#Phone_Number_H').parents('.col-lg-10').parent().addClass('has-error is-focused');

	 	    $('#Phone_Number_H').css('color','red');

			$('#Phone_Number_H').focus();

		}

		else if($('#Phone_Number_C').val()=='')

		{

		   	$('#Phone_Number_C').parents('.col-lg-10').parent().addClass('has-error is-focused');

	   		$('#Phone_Number_C').css('color','red');

			$('#Phone_Number_C').focus();

		}

		else if($('#Email').val()=='')

		{

			$('#Email').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Email').css('color','red');

			$('#Email').focus();

		}

		else if($('#password').val()=='')

		{

			$('#password').parents('.col-lg-10').parent().addClass('has-error is-focused');

	    	$('#password').css('color','red');

			$('#password').focus();

		}

		else if($('#memo').val()=='')

		{

			$('#memo').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#memo').css('color','red');

			$('#memo').focus();

		}

		else if($("#valid_email").val()=='Email address already exist.')

		{

			$('#Email').parents('.col-lg-10').parent().addClass('has-error is-focused');

			$('#Email').css('color','red');

			$('#Email').focus();

		}

		

		return false;

	}

	else

	{

		if ($("#volunteer_form input[type=checkbox]:checked"))

		{

			 $("form").submit();

		}

		else

		{

		 $("#Volunteering ").parent('label').css('color','red');

		 return false;

		}

	}

}

function email_check()

{

	$.ajax({

		method:'POST',

		data:'email='+$("#Email").val()+'&type=Article',

		url:'../Ajaxaction/email_check',

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

	})

		

	$('.form-group').on("keypress",function(){

		if($(this).hasClass('has-error'))

		{

			$(this).removeClass('has-error');

			//$(this).removeClass('is-focused');

			$(this).children('.col-lg-10').children().css('color','black');

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



  </style>

<div class="col-lg-12 col-md-12 padding-zero">

        <div class="well bs-component">

            <div class="row">

            	<img src="<?php echo base_url(); ?>img/banner.jpg" style="width:100%;"/>

            </div>	

            <br />

          	<form class="form-horizontal" id='volunteer_form' method="POST" onSubmit="return validate_volunteer();" enctype="multipart/form-data">

            <fieldset>

              <legend style="background: #6b675d;"> <center>SUBMIT AN ARTICLE</center></legend>

              <div id='message'><?php if($this->session->flashdata('alert')=='success'){ ?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Added article</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php }if($this->session->flashdata('alert')=='fails'){  ?><div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>Email already exist.  <a href="javascript:void(0)" class="alert-link"></a></div><?php }?></div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="First_name" name="First_name" value='' placeholder=" First Name">

                  </div>

              </div>

              <div class="form-group ">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Last_name" name="Last_name" value='' placeholder=" Last Name">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Address1" name="Address1" value='' placeholder=" Address1">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Address2" name="Address2" value='' placeholder=" Address2">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="City" name='City' value='' placeholder=" City">

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

                    <input type="text" class="form-control" id="Zipcode" name='Zipcode' value='' maxlength='5' pattern='[0-9]{5}' placeholder=" Zipcode">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Phone_Number_H" name='Phone_Number_H' value='' minlength='10'  maxlength='10' pattern='[0-9]{10}' placeholder=" Phone Number(Home)">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Phone_number_C" name='Phone_Number_C' value='' minlength='10'  maxlength='10' pattern='[0-9]{10}' placeholder=" Phone number (Cell)">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="email" class="form-control" id="Email" name='Email' value='' autocomplete="off" placeholder=" Email" onblur="email_check();">

                    <input type='hidden' id='valid_email' value='' />

                  </div>

              </div>

              <span id='email_validate' style='color:red;margin-left: 9%;'></span>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="password" class="form-control" id="password" name='password' placeholder=" Password">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

             		 <textarea class="form-control" rows="8" name='memo'  maxlength="800" id="memo" placeholder=" Write article here... (maximum 800 words)"></textarea>

                  </div>

              </div>

              <div class="form-group is-empty is-fileinput">

                <input type="file" id="inputFile4" name='article' multiple>

           		 <div class="col-lg-8 col-md-10 col-lg-offset-1">

             		<input type="text" readonly class="form-control" placeholder="file chooser...(.doc,.docx)">

           		 </div>

                 <span class="col-lg-2 input-group-btn">

                	<button type="button" class="btn btn-fab btn-fab-mini">

                  		<span class="glyphicons glyphicons-file-plus"></span>

                		</button>

              	 </span>

         		 <span class="material-input"></span>

              </div>

             <?php /*?> <div class="form-group">

                  <label class="col-lg-4 col-md-2 control-label label-style " style="margin:0px;">VOLUNTEERING: Interested in volunteering? Please check which area you wish to help with </label>

                  <div class="checkbox">

                   <label>

                    <input type="checkbox" name='Volunteering[]' id='Volunteering' value='1' <?php if(@in_array('1',$_REQUEST['Volunteering'])){ echo "checked"; }?>> Distribution

                   </label>

                   <label>

                    <input type="checkbox" name='Volunteering[]' id='Volunteering' value="2" <?php if(@in_array('2',$_REQUEST['Volunteering'])){ echo "checked"; }?>> Intercessory Prayer

                   </label>

                   <label>

                    <input type="checkbox" name='Volunteering[]' id='Volunteering' value="3" <?php if(@in_array('3',$_REQUEST['Volunteering'])){ echo "checked"; }?>> Article Writing

                   </label>

                  </div>

              </div>

              <br>

              <legend><center>Other ways you can help</center></legend>

			   <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Copies_requested" name='Copies_requested' value='<?php echo $Copies_requested; ?>'  placeholder="Copies requested for distribution">

                  </div>

              </div>

              <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Time_commitment" name='Time_commitment' value='<?php echo $Time_commitment; ?>' placeholder=" Time commitment minutes/day">

                  </div>

              </div><?php */?>

              <div class="form-group" style="text-align: -webkit-center;">

                  <div class="checkbox">

                   <label>

                    <input type="checkbox" name='policy' id='policy' value='1' required="required"> 

                    <a href="before_write" target="_blank" style="border: 1px solid;padding: 8px;">Read & accept article guideline</a> 



                   </label>

              </div>

              <div class="form-group">

                <div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">

                  <button type="button" class="btn btn-default" onclick="document.getElementById('volunteer_form').reset();">Cancel</button>

                  <button type="submit" class="btn btn-primary" id='submit' name='ADD'>Submit</button>

                </div>

              </div>

            </fieldset>

          </form>

        </div>

      </div>

<script src="<?php echo base_url() ?>js/ripples.min.js"></script>

<script src="<?php echo base_url() ?>js/material.min.js"></script>



<script>

 $("#inputFile4").change(function () {

       var fileExtension = ['doc', 'docx'];
        if($(this).val()=="")
        {

           $('#submit').removeAttr('disabled');

        }
        

        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {

            alert("Only formats are allowed : "+fileExtension.join(', '));

            $('#submit').prop('disabled','true');
             if($(this).val()=="")
            {

               $('#submit').removeAttr('disabled');

            }

        }
        else
        {
          $('#submit').removeAttr('disabled');

        }

    });

  $(function () {

    $.material.init();

  });

</script>
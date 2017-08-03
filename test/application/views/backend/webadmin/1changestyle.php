<?php
$Res_old_style_arr  =   $this->db->query("SELECT * FROM kr_style where id='1'");
$Res_old_style      =   $Res_old_style_arr->row_array();
$MenuBackground		=   @$Res_old_style['MenuBackgorund'];
$file_path			=   @$Res_old_style['BackgroundImage'];
$file_pathBookImage	=   @$Res_old_style['BookImage'];
$MenuColor		    =   @$Res_old_style['MenuColor'];
$HeaderText		    =   @$Res_old_style['HeaderText'];
$FooterColor	    =   @$Res_old_style['FooterColor'];
?>

<script>
function validate_volunteer()
{
	 $("form").submit();
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
    body {
      padding-top: 50px
    }

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
	  background:url('<?php echo base_url(); ?>img/formback.png')!important;
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
          	<form class="form-horizontal" id='volunteer_form' method="POST" onSubmit="return validate_volunteer();" enctype="multipart/form-data">
            <fieldset>
              <legend> <center>STYLE CHANGE FORM</center></legend>
              <div id='message'><?php if($this->session->flashdata('alert')=='success'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Updated the style</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?></div>
              <div class="form-group is-empty is-fileinput">
              <input type='hidden' name='old_mimage' value=<?php echo $file_path; ?> />
              <input type='hidden' name='old_bookimage' value=<?php echo $file_pathBookImage; ?> />
                <input type="file" id="inputFile4" name='mimage'>
           		 <div class="col-lg-8 col-md-10 col-lg-offset-1">
             		<input type="text" readonly class="form-control" placeholder="Background file chooser...">
           		 </div>
                 <span class="col-lg-2 input-group-btn">
                	<button type="button" class="btn btn-fab btn-fab-mini">
                  		<span class="glyphicons glyphicons-file-plus"></span>
                		</button>
              	 </span>
         		 <span class="material-input"></span>
              </div>
              <div class="form-group is-empty is-fileinput">
                <input type="file" id="inputFile4" name='bookimage'>
           		 <div class="col-lg-8 col-md-10 col-lg-offset-1">
             		<input type="text" readonly class="form-control" placeholder="Book image file chooser...">
           		 </div>
                 <span class="col-lg-2 input-group-btn">
                	<button type="button" class="btn btn-fab btn-fab-mini">
                  		<span class="glyphicons glyphicons-file-plus"></span>
                		</button>
              	 </span>
         		 <span class="material-input"></span>
              </div>
              <div class="form-group ">
                  <div class="col-lg-10 col-md-10 col-lg-offset-1">
                    <input type="text" class="form-control" title="Menu Background" id="MenuBackground" name="MenuBackground" value='<?php echo $MenuBackground; ?>' placeholder=" Menu Background">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-10 col-md-10 col-lg-offset-1">
                    <input type="text" class="form-control" id="MenuColor" title="Menu Color" name="MenuColor" value='<?php echo $MenuColor; ?>' placeholder=" Menu Color">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-10 col-md-10 col-lg-offset-1">
                    <input type="text" class="form-control" id="HeaderText" title='Header Text' name="HeaderText" value='<?php echo $HeaderText; ?>' placeholder=" Header Text">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-lg-10 col-md-10 col-lg-offset-1">
                    <input type="text" class="form-control" id="FooterColor" title='Footer Color' name='FooterColor' value='<?php echo $FooterColor; ?>' placeholder=" Footer Color">
                  </div>
              </div>
              <div class="form-group">
                <div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">
                  <button type="button" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-primary" name='ADD'>Submit</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>

<script src="<?php echo base_url(); ?>js/ripples.min.js"></script>
<script src="<?php echo base_url(); ?>js/material.min.js"></script>

<script>
  $(function () {
    $.material.init();
  });
</script>
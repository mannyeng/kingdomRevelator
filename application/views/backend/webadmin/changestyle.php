<?php
$Res_old_style_arr  =   $this->db->query("SELECT * FROM kr_style where id='1'");
$Res_old_style      =   $Res_old_style_arr->row_array();
$MenuBackground		=   @$Res_old_style['MenuBackgorund'];
$file_path			=   @$Res_old_style['BackgroundImage'];
$file_pathBookImage	=   @$Res_old_style['BookImage'];
$MenuColor		    =   @$Res_old_style['MenuColor'];
$Bookurl            =   @$Res_old_style['Bookurl'];
$HeaderText		    =   @$Res_old_style['HeaderText'];
$FooterColor	    =   @$Res_old_style['FooterColor'];
$FooterFontColor    =   @$Res_old_style['Footerfontcolor'];
$AboutTitleColor    =   @$Res_old_style['Abouttitlecolor'];
$AboutDesColor      =   @$Res_old_style['Aboutdescolor'];
$PatronNameColor      =   @$Res_old_style['Patronnamecolor'];
/*$KsoftLinkColor      =   @$Res_old_style['Ksoftlinkcolor'];*/
$banner				=   @$Res_old_style['banner'];
$label_color        =   @$Res_old_style['label_color'];
?>
<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					Change style
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="webadmin">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li>
						<a href="webadmin/changestyle">Change style</a>
					</li>
					
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
<?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Retreat updated successfully.';
          echo '</div>';       
        }elseif($this->session->flashdata('flash_message') == 'added'){
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'New retreat created successfully.';
          echo '</div>';          
        }
      }
      ?>
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
						<?php
      //form dataecho 
      $attributes = array('class'=>'form-horizontal validate','id' => 'form-validate','enctype'=>'multipart/form-data');

      //form validation
      echo validation_errors();
      
      echo form_open('webadmin/changestyle', $attributes);
      ?>
							 <fieldset>
                              <div id='message'><?php if($this->session->flashdata('alert')=='success'){?><div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">×</button>You have <strong>Updated the style</strong> successfully  <a href="javascript:void(0)" class="alert-link"></a></div> <?php } ?></div>
                              <div class="control-group">
                                <label class="control-label" for="purchase_no">Background Image</label>
                                <div class="controls">
                                  <input type='hidden' name='old_mimage' value=<?php echo $file_path; ?> />
                                  <input type='hidden' name='old_bookimage' value=<?php echo $file_pathBookImage; ?> />
                                  <input type='hidden' name='old_banner' value=<?php echo $banner; ?> />
                                  <input type="file" id="inputFile4" name='mimage'>
                                 </div>
                               </div>
                               <div class="control-group">
                                <label class="control-label" for="purchase_no">Book Image</label>
                                <div class="controls">
                                    <input type="file" id="inputFile4" name='bookimage'>
                                </div>
                               </div>
                               <div class="control-group">
                                <label class="control-label" for="purchase_no">Book URL</label>
                                <div class="controls">
                                    <input type="url" class="form-control " id="Bookurl"  name="Bookurl" value='<?php echo $Bookurl; ?>' placeholder="Book URL">
                                  </div>
                              </div>
                                <div class="control-group">
                                <label class="control-label" for="purchase_no">Banner Image</label>
                                <div class="controls">
                                    <input type="file" id="inputFile4" name='bannerimage'>
                                </div>
                               </div>
                              <div class="control-group">
                                <label class="control-label" for="purchase_no">Menu Background</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote required" id="MenuBackground" name="MenuBackground" value='<?php echo $MenuBackground; ?>' placeholder=" Menu Background">
                                  </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label" for="purchase_no">Menu Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="MenuColor"  name="MenuColor" value='<?php echo $MenuColor; ?>' placeholder=" Menu Color">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label" for="purchase_no">Label Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="label_color"  name="label_color" value='<?php echo $label_color; ?>' placeholder=" Label Color">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label" for="purchase_no">Header Text</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="HeaderText"  name="HeaderText" value='<?php echo $HeaderText; ?>' placeholder=" Header Text">
                                  </div>
                              </div>
                             <div class="control-group">
                                <label class="control-label" for="purchase_no">Footer background Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="FooterColor" name='FooterColor' value='<?php echo $FooterColor; ?>' placeholder=" Footer Color">
                                  </div>
                              </div>
                               <div class="control-group">
                                <label class="control-label" for="purchase_no">Footer Font Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="Footerfontcolor" name='Footerfontcolor' value='<?php echo $FooterFontColor; ?>' placeholder=" Footer Font Color">
                                  </div>
                              </div>
                              
                               <div class="control-group">
                                <label class="control-label" for="purchase_no">About Us Title Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="Abouttitlecolor" name='Abouttitlecolor' value='<?php echo $AboutTitleColor; ?>' placeholder=" About Us Title Color">
                                  </div>
                              </div>
                              
                               <div class="control-group">
                                <label class="control-label" for="purchase_no">About Us Description Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="Aboutdescolor" name='Aboutdescolor' value='<?php echo $AboutDesColor; ?>' placeholder=" About Us Description Color">
                                  </div>
                              </div>
                              
                               <div class="control-group">
                                <label class="control-label" for="purchase_no">Patron Name Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="Patronnamecolor" name='Patronnamecolor' value='<?php echo $PatronNameColor; ?>' placeholder=" Patron Name Color">
                                  </div>
                              </div>
                              
                             <?php /*?>  <div class="control-group">
                                <label class="control-label" for="purchase_no">Ksoft Font Color</label>
                                <div class="controls">
                                    <input type="text" class="form-control noquote" id="Ksoftlinkcolor" name='Ksoftlinkcolor' value='<?php echo $KsoftLinkColor; ?>' placeholder="Ksoft Font Color">
                                  </div>
                              </div><?php */?>
                              
                            </fieldset>
							
							<div style="clear: both;"></div>
							<div class="center">
								<input type="submit" class="btn btn-success" tabindex="8" value="SAVE" />
							</div>
						 <?php echo form_close(); ?>
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
<div id="child_age_fields">
<select class="select span10" name="c_age[dyn_id]">
           <option value="">Select age</option>
           <?php 
		   foreach(range(1,25) as $age)
		   echo '<option>'.$age.'</option>';
		   ?>
           </select> Below
              <input type="text" placeholder="Fee"  name="c_fee[dyn_id]"   class="span10"> 
              <strong style="font-size:18px;font-weight:bold;cursor:pointer" class="removeme">-</strong>
            </div>
    <script type="application/javascript" >
	$(function(){
		
		$("#addMore").on('click',function(){
			var i=$("#c_ageDiv select").length;
			$("#child_age_fields").clone().appendTo('#c_ageDiv').addClass('child_age').attr("id","copier"+i);	
				var htm=$("#copier"+i).html();
				htm=htm.replace(/dyn_id/g,i);						
				$("#copier"+i).html(htm);
		});
		$("#c_ageDiv").on('click','.removeme',function(){			
			$(this).parents(".child_age").remove();
			$("#c_ageDiv select").each(function(index, element) {
                $(this).attr('name','c_age['+index+']');
				$("#c_ageDiv input").eq(index).attr('name','c_fee['+index+']');
				$(this).parents(".child_age").attr("id","copier"+index);
            });
		});
	});
	</script>
    <style>
	#child_age_fields{display:none}
	</style>
<script type="text/javascript">
$(function(){

	$("#form-validate").validate();
	

});
</script>
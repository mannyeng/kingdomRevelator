<style type="text/css">
	@media (min-width: 1200px)
	{
   .row-fluid .span2 {
    margin-left: 52px;
    margin: 0;
    margin-right: 21px;
    width: 14.52991452991453%;
    width: 14.52991452991453%;
    text-align:center;
    }
}
.book {
padding: 15px 0 0 0;
margin:auto;
}
.book-img>.book-link:before {
content: '';
display: block;
width: 80%;
height: 1em;
background: rgba(0,0,0,.85);
border-radius: 50%;
position: absolute;
bottom:-10px;
-webkit-filter: blur(5px);
filter: blur(5px);
z-index:-5;
}
.shelf {
border-bottom: 30px solid #a5a5a5;
border-left: 20px solid transparent;
border-right: 20px solid transparent;
top: -15px;
z-index: -10;
}
.shelf:after {
content: '';
background: #333333;
height: 20px;
width: calc(100% + 40px);
position: absolute;
top: 30px;
left: 0;
right: 0;
z-index: 1;
margin: 0 -20px;
}

</style>


<div id="main-content" style=" background-image: url('./assets/images/krbg.jpg');">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid"  >

		<!-- BEGIN PAGE HEADER-->

		<div class="row-fluid">

			<div class="span12" >

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					Books

				</h3>

				<ul class="breadcrumb" style="background-color:rgba(0, 150, 136, 0.11);">

					<li>

						<a  style="color:#B44B2B" href="subscriber_profile/profile">Dashboard</a>

						<span class="divider">/</span>

					</li>					

					<li class="active" ><div style="color:#B44B2B;">

						Books
                 </div>
					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<!-- END PAGE HEADER-->

<?php

      //flash messages

      if($this->session->flashdata('alert')){

        if($this->session->flashdata('alert') == 'updated')

        {

          echo '<div class="alert alert-success">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Updated successfully.';

          echo '</div>';       

        }

		elseif($this->session->flashdata('alert') == 'already')

        {

          echo '<div class="alert alert-failure">';

            echo '<a class="close" data-dismiss="alert">×</a>';

            echo 'Already exists.';

          echo '</div>';       

        }

      }

      ?>

<?php

	/*if($row['Subscriptions']==25)

	{

		 $dateString = $row['subscription_date'];

		 $t = strtotime($dateString);

		 $expiry_date = date('Y-m-d',strtotime('+1 years', $t));

		//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));

	}

	if($row['Subscriptions']==45)

	{

		 $dateString = $row['subscription_date'];

		 $t = strtotime($dateString);

		 $expiry_date = date('Y-m-d',strtotime('+2 years', $t));

		//echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));

	}*/

	

	

	?>

    

		<!-- BEGIN PAGE CONTENT-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN SAMPLE FORM PORTLET-->

				<div class="widget blue">


				<!--	<div class="widget-title">

						<h4><i class="icon-reorder"></i> Entry Form </h4>

						<span class="tools">

							<a href="javascript:;" class="icon-chevron-down"></a>

						</span>

					</div> -->

					<div >

						<!-- BEGIN FORM-->

                        <?php
$c=1;

						foreach($books as $row)

						{
							if($c==7) 
							{
								$c=1;  ?> 

								<div class='span12 shelf' style="padding-right:20px;margin-left:2px"> </div>
								</div> <?php
							}
							$c++;
						?>
						
                         <div class="span2">
                           <br/>

                          
                            	  
                                   <img style=" height:250px; width:150px " class="book-link img-responsive book" src=<?php echo "./thumbnail/". $row['thumbnail']; ?> />
                             	
                          <!-- <p style="font-size:21px;  color:#E00E01;text-align:center;font-family: 'lemon'" >
                                    <?php //echo $row['name'];?> <br/>
                                <!-- </p>
                              <p style="font-size:13px;color:#000;font-family: 'Kaushan Script', cursive;text-align:center" >
                                  <?php// echo ucfirst($row['edition']); echo "  ". date('Y',strtotime($row['created'])); ?><br/>
                             <!--    </p>
                                     <?php //echo date('Y-m-d',strtotime($row['created']));?> 
                           <!--    	<a data-original-title="" style="text-align:center" class="btn btn-info" target="_blank" href="full-edition/?s=<?php echo md5($row['id']);?>">
                               <!--   Read Online </a> -->
                               

                            </div>

                        

                         <?php

                         }

                         ?>

						<!-- END FORM-->

					</div>

				</div>

				<!-- END SAMPLE FORM PORTLET-->
			</div>


		</div>

<div class=' shelf' style="margin-left:0px"> </div>

<br/>
		
<br/>
		


		<!-- END PAGE CONTAINER-->

	</div>

	<!-- END PAGE -->

</div>

<div class="control-group" id="copier">

          <div class="span3">

            <input type="text" class="form-control dat"   name='day[dyn_id]' placeholder="Select Date" />

          </div>

          <div class="span3">

            <select class="form-control hour"  name='hour[dyn_id]' >

            <option value="">Select Hour</option>

            <?php foreach(range(1,20) as $hr) echo "<option>$hr</option>"; ?>

            </select>

          </div>

          <div class="span3">

            <select class="form-control min"  name='min[dyn_id]' >

            <option value="">Select Minute</option>

            <option >15</option>

            <option >30</option>

            <option >45</option>

            </select>

          </div>

          <div class="span3" align="center">

            <b style="font-size:50px;cursor:pointer;line-height:50px" class="removeme" title="Remove">-</b>

        </div>

   </div>

   

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css">

    <script type="application/javascript" >

	$(document).ready(function(e) {

    $("#volunteer_form").validate();

	dp();

	

	$("#addmore").on('click',function(){

			var i=$("#multiday .dat").length;

			$("#copier").clone().appendTo('#multiday').addClass("dyn_added").attr("id","copier"+i);	

				var htm=$("#copier"+i).html();

				htm=htm.replace(/dyn_id/g,i);						

				$("#copier"+i).html(htm);

				dp();

		});

		

		$("#multiday").on('click','.removeme',function(){			

			$(this).parents(".dyn_added").remove();

			$("#multiday .dat").each(function(index, element) {

                $(this).attr('name','day['+index+']');

				$("#multiday .hour").eq(index).attr('name','hour['+index+']');

				$("#multiday .min").eq(index).attr('name','min['+index+']');

				$(this).parents(".dyn_added").attr("id","copier"+index);

            });

		});

	

});

function dp()

{

	$('.dat').datepicker();

}

	</script>

    

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

				url:"Ajaxaction/discount",

				success:function getstate($msg)

				{

					$('#message_discount').html('');

					$('#message_discount').html($msg);

				}

				

				})

				

				$.ajax({

				method:"POST",

				data:"copy="+copy+"&amount="+amount,

				url:"Ajaxaction/amount",

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



</script>

    <style>

	#copier{display:none}

	</style>

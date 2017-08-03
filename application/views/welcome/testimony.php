<style>
.cbg1 {
	background: rgba(255,255,255,.5);
	padding: 10px 10px 10px 10px;
	display: inline-block;
	
	margin-bottom: 10px;
	box-shadow: inset 0 0 5px #100f0f;
	border-radius: 5px;
}
</style>
<p>&nbsp;</p>
<div class="row">
<div class="col-md-12">
<h3 style="color:#fff;">TESTIMONIALS</h3>&nbsp;



	<div class="col-md-4" style="padding: 0px;margin-bottom: 30px;"> 
		<a href="mailto:kingrevusa@gmail.com" ><img src=<?php echo "./img/Testimonials.png" ?> /> </a> 
	</div>
	<div class="cbg1 col-md-8" style="min-height: 107px;">
     <h5 style="line-height: 25px;font-size: 16px;"><center>Please include a brief message and your contact information. If required Sehion USA Ministries will contact you by email or phone before publishing. Not all testimonials are published. </center>  </h5>
   </a>
   </div>
 

<br/>
<?php 
foreach($member as $row)
	{ 
		?>
		
	<div class="cbg col-md-12" > 
	
	<div class="col-md-2 "><br/> 
 <?php if(!empty($row['photo']))
 {
 	?>
	<img style="border-radius:50px; height:105px; width:100px"src=<?php echo "./testimony_img/". $row['photo']; ?> /> 
	<?php }else 
	{ ?>
	<img style="border-radius:50px; height:105px; width:100px"src=<?php echo "./img/images.jpg" ?> />
	<?php } ?>
	</div>
	<div class="col-md-10" >
	<br/>
	<p style="text-align:justify">
	<?php echo $row['testimony']; ?>  </p>
	<br/>
   <p style="color:#E00E01"> 
	<?php echo $row['name']; ?>
	</b> </p>
	<b>
	<?php echo $row['created_date'];?>
	</b>

</div>
	</div>
</p>
<?php } ?>




</div>
</div>
</div>





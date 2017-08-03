<style type="text/css">

a, a:hover, a:focus, a:visited
{

	text-decoration: none;

}	

.box {
    background-color: #fff;
    border-top: 1px solid #f0f0f0;
   
    box-shadow: 0 0px 16px rgb(152, 152, 152);
    padding: 3px 3px 3px 3px;
    
    border-radius: 4px !important;
    margin: 0px 16px 20px 16px !important;
    transition: all .5s ease-in-out;
    text-align: center;
}
.box:hover{
transition: all .5s ease-in-out;
 box-shadow: 0 0px 2px 0 rgba(0,0,0,0.1);
	}
	.readmore {
	padding: 5px 0px !important;
	width: 122px;
	font-family: 'Kaushan Script', cursive;
	color: #fff;
	font-size: 16px;
	border-bottom: 5px solid #06AEBA;
	border-radius: 0px !important;
	margin: auto;
	display: block;
	transition: all .5s ease-in-out;
}
.readmore:hover {
	
	border-bottom: 5px solid #31A6B1;
	transition: all .5s ease-in-out;
}
.widget{
	background: none;
}
@media screen and (min-width:480px) and (max-width: 768px)
{
.box {
	margin: 16px 5px 20px 5px !important;
	width: 47% !important;
	float: left !important;
}
}

@media screen and (max-width: 479px)

{
.box {
 margin: 16px 0px 20px 0px !important;
 width: 99% !important;

}

}

@media screen and (min-width: 769px) and (max-width: 1024px)
{
	.row-fluid .span2 {
	width: 30%;
	
}
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





    
<!-- BEGIN PAGE CONTENT-->

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN SAMPLE FORM PORTLET-->

				<div class="widget blue">


				

					

						<!-- BEGIN FORM-->

                        <?php


						foreach($books as $row)

						{
						?>
						
                         <div class="span2 box">
                                                
                            	  
                                   <a target="_blank" title="Read Online"  href="full-edition/?s=<?php echo md5($row['id']);?>"><img style=" height:auto; width:auto" src=<?php echo "./thumbnail/". $row['thumbnail']; ?> />
                             	

                           <p style="font-size:18px;margin-top:15px;margin-bottom: 5px;  color:#E00E01;text-align:center;font-family: 'Fredericka the Great'" >
                                    <?php echo $row['name'];?>
                              </p>
                              <p style="font-size:15px;color:#000;font-family: 'Fredericka the Great', cursive;text-align:center" >
                                    <?php echo ucfirst($row['edition']); echo " ". date('Y',strtotime($row['created'])); ?><br/>
                               </p>
                                 </a>   
                            </div>

                        

                         <?php

                         }

                         ?>

						<!-- END FORM-->

					
				</div>

				<!-- END SAMPLE FORM PORTLET-->

			</div>

		</div>



		



		<!-- END PAGE CONTAINER-->

	</div>

	<!-- END PAGE -->

</div>


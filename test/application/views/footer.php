<?php

$res_style = $this->db->query("Select * from kr_style where id='1'");

if($res_style->num_rows()>0)

{

	$style_arr=$res_style->row_array();

	if($style_arr['FooterColor']!='')

	{	

		echo "<style> #footer {background-color:".$style_arr['FooterColor']." } </style>";

	}
	
	if($style_arr['Footerfontcolor']!='')

	{	

		echo "<style> .footer-links {color:".$style_arr['Footerfontcolor']." } </style>";

	}
	
	if($style_arr['Footerfontcolor']!='')

	{	

		echo "<style> .footer-text {color:".$style_arr['Footerfontcolor']." } </style>";

	}
	
	if($style_arr['Footerfontcolor']!='')

	{	

		echo "<style> .login-menu {color:".$style_arr['Footerfontcolor']." } </style>";

	}
	
	
	if($style_arr['Abouttitlecolor']!='')

	{	

		echo "<style> .about-title {color:".$style_arr['Abouttitlecolor']." } </style>";

	}
	
	
	if($style_arr['Aboutdescolor']!='')

	{	

		echo "<style> .about-des {color:".$style_arr['Aboutdescolor']." } </style>";

	}
	
	if($style_arr['Patronnamecolor']!='')

	{	

		echo "<style> .bcontainer .col-md-3 h4 {color:".$style_arr['Patronnamecolor']." } </style>";

	}
	
	


}

?>



<div class="container ftop">



            <div class="row">



                <div class="col-lg-3 col-md-6">



                    <div class="col-lg-12 footer-links">



                        ABOUT KINGDOM REVELATOR



                    </div>



                    <div class="col-lg-12 footer-text padding-zero text-justify">



                    Fr. Soji Olikkal, a priest of the Birmingham Archdiocese and Director of Sehion Ministries in the UK, was inspired by the Holy Spirit in March 2014 to start producing a Catholic evangelistic magazine for young people and gathered some volunteers together. With the advice of a few people who had worked in this field before, the first issue was produced at ...  



                   &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('about-us');?>" class="rmore">Read More</a>



                    </div>



                </div>



                <div class="col-lg-3 col-md-6">



                    <div class="col-lg-12 footer-links">



                        PRAYER REQUEST



                    </div>



                    <div class="col-lg-12 padding-zero text-center">



                        <a href="<?php echo base_url('prayer/form');?>"><img src="<?php echo base_url() ?>img/prayer.png" class="img-responsive"></a>



                    </div>



                </div>



                <div class="col-lg-3 col-md-6" style="text-align:center">



                    <div class="col-lg-12 footer-links">



                        LIVE RADIO



                    </div>



                    <div class="col-lg-12 text-center">



                   		<img src="<?php echo base_url() ?>img/radio.png" class="img-responsive">



                        <!-- BEGINS: AUTO-GENERATED MUSES RADIO PLAYER CODE -->



<script type="text/javascript" src="https://hosted.muses.org/mrp.js"></script>



<script type="text/javascript">



MRP.insert({



'url':'http://199.195.194.140:8012/stream',



'lang':'en',



'codec':'mp3',



'volume':100,



'autoplay':false,



'buffering':5,



'title':'Sehion Radio',



'wmode':'transparent',



'skin':'compact',



'width':191,



'height':46



});



</script>



<!-- ENDS: AUTO-GENERATED MUSES RADIO PLAYER CODE -->



                    </div>



                </div>



                <div class="col-lg-3 col-md-6" align="center">

					<form method="post" action="<?php echo base_url('Subscription/news_letter');?>">

                    <div class="col-lg-12 footer-links">



                        NEWS LETTER



                    </div>



                    <div class="col-lg-12 footer-text padding-zero text-justify" style="margin-bottom: 5%;">



                        By subscribing to our mailing list you



                        will always be update with the latest 



                        news from us. We never spam.

						

                        

                       <br /> <input type="text" name="Email" placeholder="Email Address" style="width: 100%;padding: 7px;margin-top: 10px;border: 0px;color: #bc2c36;" /><br> 

                    </div>



                   

						

                           



                        	<input type="submit" href="javascript:;"  style="background: rgb(188, 44, 54) none repeat scroll 0% 0%;font-family: 'Oswald', sans-serif;color: rgb(255, 255, 255);margin: auto;padding: 5px 20px;text-align: center;display: inline-table;border: 2px solid #ffffff;" value="SUBSCRIBE">



                       



                    



                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="margin-top:5%;border-top:solid 1px #fff">



                        <span class="footer-text" style="margin: 6px 0px; display: inherit;">Sehion Mobile Applications : </span>



                        <div class="col-lg-12">



                            <a href="javascript:;"><img src="<?php echo base_url() ?>img/apple.png" width="32"></a>



                            <a href="javascript:;"><img src="<?php echo base_url() ?>img/android.png" width="32"></a>



                            <a href="javascript:;"><img src="<?php echo base_url() ?>img/windows.png" width="32"></a>



                            <a href="javascript:;"><img src="<?php echo base_url() ?>img/blackberry.png" width="32"></a>



                            <a href="javascript:;"><img src="<?php echo base_url() ?>img/symbian.png" width="32"></a>



                        </div>



                    </div>



                </div>



            </div>



        </div>



        <div id="footer">



            



                <div class="container" style="padding:20px 20px 10px 20px;">



                    <p class="right login-menu">Copyright &copy; <?php echo date("Y"); ?> Kingdom Revelator USA



                    <span class="text-left login-menu"  style="float:right">Powered by <a href="https://ksofttechnologies.com" target="_blank" > Ksoft Technologies</a></span>



                	</p>



                </div>



           



        </div>	



</body>



</html>

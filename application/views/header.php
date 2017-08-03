<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>KINGDOM REVELATOR USA</title>
<link rel="shortcut icon" href="<?php echo base_url() ?>img/favicon.png" />

<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-material-design.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/ripples.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/custom_style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-submenu.min.css">
<link href='https://fonts.googleapis.com/css?family=Lobster|Oswald|Fjalla+One|Lobster+Two|Courgette|Oleo+Script|Anton|Bangers|Righteous|Dancing+Script|Kaushan+Scrip|Noto+Sans|Great+Vibes|Fjalla+One|Shrikhand|Playfair+Display+SC|Lemonada' rel='stylesheet' type='text/css'>
<noscript><meta http-equiv="refresh" content="0; url=<?php echo site_url('noscript');?>" /></noscript>
<script src="<?php echo base_url() ?>js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap-submenu.js"></script>
<script src="<?php echo base_url() ?>assets/backend/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jscroll.min.js"></script>

<script type="application/javascript">
$(function(){
	
	$('[data-submenu]').submenupicker();




   var $scrollingDiv = $("#scrollingDiv");
 
   $scrollingDiv.css("marginTop",$(window).height()-240);

    $(window).scroll(function(){      
      $scrollingDiv
        .stop()
        .animate({"marginTop": ($(window).scrollTop() + ($(window).height()-240)) + "px"}, "fast" );      
    });

  //$scrollingDiv.delay(3000).fadeIn(500);
  

  $('#clse').on("click",function(){

   $("#scrollingDiv").remove();

  });

	});

$(window).on('load',function(){
setTimeout(function(){
          $("#scrollingDiv").show('fast');
    }, 3000);
});

window.history.forward(1);
$(document).on("keydown", my_onkeydown_handler);
function my_onkeydown_handler(event) {
    switch (event.keyCode) {
        case 116 : // 'F5'
            event.returnValue = false;
            event.keyCode = 0;
            window.status = "We have disabled F5";
            break;
    }
} 
</script>

<?php
$res_style = $this->db->query("Select * from kr_style where id='1'");
if($res_style->num_rows()>0)
{
	echo "<style type='text/css'>";
	
   $style_arr=$res_style->row_array();

	if($style_arr['BackgroundImage']!='' && $style_arr['BackgroundImage']!='/')
	{
		echo "body { background: url(".base_url($style_arr['BackgroundImage']).") no-repeat;background-size:cover;}";
	}
	if($style_arr['MenuBackgorund']!='')
	{	
		echo " .navcolor{ background:".$style_arr['MenuBackgorund']." !important; }
		  ul .dropdown-menu{ background:".$style_arr['MenuBackgorund']." !important; }";
	}
	if($style_arr['BookImage']!='' && $style_arr['BookImage']!='/')
	{	
		$BookImage = $style_arr['BookImage'];
	}
	if($style_arr['MenuColor']!='')
	{	
		echo ".navbar, .navbar.navbar-default,.navbar-nav > li > a:hover, .navbar-nav > li.active > a, .navbar-nav > li > a:focus, .dropdown-menu a {color:".$style_arr['MenuColor']." !important; }";
	}
	if($style_arr['HeaderText']!='')
	{	
		$headertext=$style_arr['HeaderText'];
	}
	if($style_arr['FooterColor']!='')
	{	
		echo "#footer {background-color:".$style_arr['FooterColor']." }";
	}
	if($style_arr['label_color']!='')
	{	
		echo "::-webkit-input-placeholder { /* WebKit, Blink, Edge */
					color:    ".$style_arr['label_color']."!important;
				    font-weight: 400; 
				}
				:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
				   color:    ".$style_arr['label_color']."!important;
				   opacity:  1;
				   font-weight: 400;  
				}
				::-moz-placeholder { /* Mozilla Firefox 19+ */
				   color:    ".$style_arr['label_color']."!important;
				   opacity:  1;
				   font-weight: 400;  
				}
				:-ms-input-placeholder { /* Internet Explorer 10-11 */
				   color:    ".$style_arr['label_color']."!important;
				   font-weight: 400;
				}";
		echo "#State,#BState,#request_month,.hour,.min,#time {color:".$style_arr['label_color']." !important;font-weight: 400 !important; }";	
			
	}


	echo "</style>";
	
}
?> 
<style>

.navbar-fixed-bottom .navbar-collapse, .navbar-fixed-top .navbar-collapse {
    max-height:none!important;
}
</style>         
<body>
<?php /*
if (!$this->uri->segment(1)) {?>
<div id="scrollingDiv" style="overflow:hidden;display:none;width: auto; height: auto; position: absolute; z-index: 999; right: 10px; background: rgba(225,0,0,1) none repeat scroll 0% 0%; padding: 5px;"><div id="clse" style="position:absolute;z-index: 100;top: 0px;right: 0px;cursor: pointer;background:rgba(225,0,0,1);color: #fff;padding: 6px 9px 4px 8px;font-weight: bold;font-family: 'Oswald', sans-serif;border-bottom-left-radius: 5px;">CLOSE</div><iframe height="230" style="width:100%;" src="https://www.youtube.com/embed/bgVHqmQbX08?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div>
<?php } */?>
       <div class="hLogo">
        <div class="container">
            
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-zero ">
                    <div class="col-lg-3 col-md-3 col-sm-4 padding-zero logo">
                        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>img/sehion.png" alt="KINGDOM REVELATOR USA" title="KINGDOM REVELATOR USA" style="width:116px;height: auto;"/></a>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-5 padding-zero bQuote">
                       <?php if(isset($headertext) && $headertext!='')
					   {
						   echo $headertext;
					   }
					   else
					   {
						   ?>
                         Praise the LORD! Sing a new song to the LORD; praise him in the assembly of his faithful people!
                       <div class="sub">Psalms 149 : 1</div>
                       <?php
					   }?>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 padding-zero hLink">
                       
                          
                            <ul class="psocial">
            <li><a href="javascript:;" class="social"><img src="<?php echo base_url() ?>img/facebook.png" width="22"></a></li>
            <li><a href="javascript:;" class="social"><img src="<?php echo base_url() ?>img/twitter.png"  width="22"></a></li>
            <li><a href="javascript:;"  class="social"><img src="<?php echo base_url() ?>img/linkedIn.png" width="22"></a></li>
            <li><a href="javascript:;"  class="social"><img src="<?php echo base_url() ?>img/youtube.png"  width="22"></a></li>
          </ul>
                          
                       
                        </div>
                </div>
             </div>
             </div>
             <nav class="navbar  navbar-fixed-top tNav">
      <div class="container"><div class="navcolor">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" >
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         <a class="navbar-brand hidden-md hidden-lg" href="#">MENU</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           <li class="active"><a href="<?php echo base_url() ?>">HOME</a></li>
                                                    <li><a href="http://sehionusa.org/" target="_blank">RETREATS</a></li>
                                                   
        

      <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" data-submenu="">VOLUNTEER<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('volunteer/intercession') ?>" target="_self">INTERCESSION</a></li>
                    <li class="dropdown-submenu">
                      <a href="javascript:;" target="_self">ARTICLE WRITING</a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url('volunteer/before_write'); ?>" target="_self">GUIDELINES</a></li>
                          <li><a href="<?php echo site_url('volunteer/article'); ?>" target="_self">SUBMIT AN ARTICLE</a></li>
                        </ul>
                    </li>
                     
                    <li><a href="<?php echo site_url('volunteer/form') ?>" target="_self">KR BULK SUBSCRIBER</a></li>
                      
                    </ul>
           </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" >SUBSCRIPTION<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url('subscription/form') ?>" target="_self">SUBSCRIBE NOW</a>

          <!--   <li><a href="<?php echo site_url()."subscription/form/?gift=".sha1('gift');?>" target="_self">GIFT SUBSCRIPTION</a></li> -->
<!--          <li><a href="javascript:;" target="_self">BULK PRICING</a></li>
-->           
        </ul>
      </li>
                                                    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">DONATE<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url('donate-now') ?>" target="_self">DONATE NOW</a></li>
          </ul>
      </li>
            <li><a href="<?php echo site_url('testimony') ?>" target="_self">TESTIMONIALS</a></li>
           
            <li><a href="<?php echo site_url('contact-us') ?>" target="_self">CONTACT US</a></li>
             <!-- <li><a href="javascript:;">STORE</a></li>
            <li><a href="javascript:;"> CUSTOMER SERVICE</a></li> -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" data-submenu="">LOGIN<span class="caret"></span></a>
                    <ul class="dropdown-menu">

                    <li class="dropdown-submenu">
                      <a href="javascript:;">VOLUNTEER</a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo site_url('front_login/dist_login'); ?>" target="_self">KR BULK SUBSCRIBER</a></li>
                          <li><a href="<?php echo site_url('front_login/art_login'); ?>" target="_self">ARTICLE WRITING</a></li>
                          <li><a href="<?php echo site_url('front_login/int_login'); ?>" target="_self">INTERCESSION</a></li>
                        </ul>
                    </li>
                     
                    <li><a href="<?php echo site_url('front_login/form') ?>" target="_self">SUBSCRIBER</a></li>
                      
                    </ul>
           </li>
  
          </ul>
         
        </div>
        </div>
      </div>
    </nav>
            
        
   
        <div class="sMenu">
                  <div class="container">
                  
                	<a href="http://sehionusa.org/" target="_blank" class="uMenu">Sehion USA</a>
                    <a href="http://www.sehionyouthministry.org"  target="_blank" class="uMenu">Sehion USA Youth Ministry</a>
                    <a href="http://www.sehion.org/" target="_blank" class="uMenu">Sehion India</a>
              </div>
            </div>
<script>
$('.dropdown-submenu').submenupicker();
</script>

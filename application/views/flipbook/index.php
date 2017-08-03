<?php
if($id)
{
	$this->db->get_where('kr_books',array('id'=>'$id'));
}
?>

<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width,initial-scale=1" name="viewport">
    <title>PDF to Flip Book Converter</title>        
    <link type="text/css" href="<?php echo base_url();?>flipbook/assets/css/style.css" rel="stylesheet">
    <link type="text/css" href="<?php echo base_url();?>flipbook/assets/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>flipbook/assets/js/compatibility.js"></script>   
    <script src="<?php echo base_url();?>flipbook/assets/js/jquery.js"></script>
  </head> 
<body>
  

<div id="myPDFF" data-cat="PDF" data-template="true"> 			

	<div class="PDFF-bcg-book"></div>     
    <div class="PDFF" id="PDFF">      
      
        <section id="config">
          <ul>
           
            <!-- DEFINE PDF URL BELOW-->
            <li key="pdf_url">flipbook/PDF.pdf</li>		     
	    <!-- DEFINE PDF URL ABOVE-->
           
            <li key="d_click_zoom">true</li> 	            
            <li key="d_click_zoom_intensity">1</li>        
            <li key="zoom_intensity">0.06</li>			
            <li key="toolbar_menu">true</li>			
            <li key="tooltips">true</li>		
            <li key="deeplinking">true</li>   	
            <li key="righttoleft">false</li>					
            <li key="PDFScaleLevel">3</li>
         </ul> 
        </section>
        
        <div class="PDFF-loader"></div>
        <div id="PDFF-container-book">
            <section id="PDFF-DL"><ul></ul></section>
            <div id="PDFF-book">    
            </div>
        </div>

        <div id="PDFF-footer">
        
            <div class="PDFF-logo"></div>
            <a id="PDFF-logo" target="_blank" href="http://www.pdf-flip.com">
                <img alt="Client Logo" src="logo.png">
            </a>
            
            <div class="PDFF-menu" id="PDFF-center">
                <ul>
                    <li><a title="First Page" class="PDFF-home"><i class="fa fa-backward"></i></a></li>
                    <li><a title="Previous Page" class="PDFF-arrow-left"><i class="fa fa-chevron-left"></i></a></li>
                    <li class="PDFF-goto"><label for="PDFF-page-number" id="PDFF-label-page-number"></label><input type="text" id="PDFF-page-number"><span id="PDFF-page-number-two"></span></li>
                    <li><a title="Next Page" class="PDFF-arrow-right"><i class="fa fa-chevron-right"></i></a></li>
                    <li><a title="Last Page" class="PDFF-bcover"><i class="fa fa-forward"></i></a></li>
                </ul>
            </div>
            
            <div class="PDFF-menu" id="PDFF-right">
                <ul>              
                    <li><a title="Zoom In" class="PDFF-zoom-in"><i class="fa fa-search-plus"></i></a></li>
                    <li><a title="Zoom Out" class="PDFF-zoom-out"><i class="fa fa-search-minus"></i></a></li>
                    <li><a title="Fit Page" class="PDFF-zoom-auto"><i class="fa fa-search"></i></a></li>
                    <li><a title="Full Screen" class="PDFF-fullscreen"><i class="fa fa-expand"></i></a></li>
                    <li>&nbsp;</li>
                    <li><a title="Pages Thumbs" class="PDFF-show-all"><i class="fa fa-th"></i></a></li>
                    <li><a title="Download PDF" class="PDFF-download" href="flipbook/PDF.pdf"><i class="fa fa-file-pdf-o"></i></a></li>               
                </ul>
            </div>
        
        </div>
     
        <div id="PDFF-all-pages" class="PDFF-overlay">
          <section class="PDFF-container-pages">
            <div id="PDFF-menu-holder">
                <ul id="PDFF-thumbs">  	 
                </ul>
            </div>
        </section>
       </div>
    </div>
</div>


</body>
</html>
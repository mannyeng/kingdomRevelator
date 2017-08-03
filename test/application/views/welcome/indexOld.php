<?php
$res_style = $this->db->query("Select * from kr_style where id='1'");
if($res_style->num_rows()>0)
{
	$style_arr=$res_style->row_array();
	if($style_arr['BookImage']!='' && $style_arr['BookImage']!='/')
	{	
		$BookImage = $style_arr['BookImage'];
	}
}
$this->db->order_by('id','desc');
$result = $this->db->get_where('kr_books')->row_array();
?>
<p>&nbsp;</p>

  <div  style="margin:auto;float:none;"> <img src="<?php  if(isset($BookImage) && $BookImage!=''){echo base_url().$BookImage; }else{ echo "flip/images/book4/1.jpg";}?>" width="100%" class="bPreview"> <a href="<?php echo $result['file'];?>" class="blink" target="_blank">READ MORE >></a> <a href="<?php echo site_url('subscription/form') ?>" class="blink1">SUBSCRIBE >></a><br /><br /><div class="col-lg-2"></div><div class="col-lg-8" style="text-align: -webkit-center;" ><iframe width="560" height="315" style="width:100%;" src="https://www.youtube.com/embed/IfxTdk5-OWA?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></div><div class="col-lg-2"></div></div>
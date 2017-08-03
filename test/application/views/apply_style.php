<?php
$res_style = $this->db->query("Select * from kr_style where id='1'");
if($res_style->num_rows()>0)
{
	echo "<style>";
	$style_arr=$res_style->row_array();


	if($style_arr['BackgroundImage']!='')
	{
		echo "body { background: url(".$style_arr['BackgroundImage'].") no-repeat;";
	}
	if($style_arr['MenuBackgorund']!='')
	{	
		echo ".navcolor {background:".$style_arr['MenuBackgorund']." }";
	}
	if($style_arr['BookImage']!='')
	{	
		$BookImage = $style_arr['BookImage'];
	}
	if($style_arr['MenuColor']!='')
	{	
		echo ".navbar, .navbar.navbar-default {color:".$style_arr['MenuColor']." }";
	}
	if($style_arr['HeaderText']!='')
	{	
		$headertext=$style_arr['HeaderText'];
	}
	if($style_arr['FooterColor']!='')
	{	
		echo "#footer {background-color:".$style_arr['FooterColor']." }";
	}


	echo "</style>";
}
?>
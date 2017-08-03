<html>
<title>KINGDOM REVELATOR USA</title>
<link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.png" />
<script src="<?php echo base_url() ?>js/jquery.min.js"></script>
<?php
$bookurl = $this->db->query("Select Bookurl from kr_style where id='1'")->row()->Bookurl;
echo '<iframe width="100%" src="'.$bookurl.'" frameborder="0" allowfullscreen allowtransparency></iframe>';
?>
</html>
<style>
body, html
{
	padding: 0px;
	margin: 0px;
}
</style>
<script type="text/javascript">
$(function(){

$('iframe').height($(document).height());
});
</script>

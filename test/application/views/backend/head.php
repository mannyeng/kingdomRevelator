<base href="<?php echo base_url(); ?>" />
<meta charset="utf-8" />
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="Ksoft  Technologies" />
<link rel="shortcut icon" href="assets/backend/img/favicon.ico" type="image/x-icon" />

<link href="assets/backend/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/backend/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="assets/backend/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />

<link href="assets/backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href="assets/backend/css/style.css" rel="stylesheet" />
<link href="assets/backend/css/style-responsive.css" rel="stylesheet" />
<link href="assets/backend/css/style-default.css" rel="stylesheet" id="style_color" />
<link href="assets/backend/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

<link href="assets/plugin/uniform/themes/default/css/uniform.default.css" rel="stylesheet" type="text/css" />

<!--<link href="assets/plugin/chosen_v1.4.2/chosen.min.css" rel="stylesheet" type="text/css" />-->
<link href="assets/plugin/select2_v4.0.0/css/select2.min.css" rel="stylesheet" type="text/css" />

<link href="assets/backend/assets/datepicker/datepicker.css" rel="stylesheet">
<link href="assets/backend/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="assets/backend/css/bootstrap-alert.css" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great|Playball|Aclonica|Codystar|Kaushan+Script" rel="stylesheet">  

<noscript><meta http-equiv="refresh" content="0; url=<?php echo site_url('noscript');?>" /></noscript>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/backend/js/jquery.validate.min.js"></script>
<script src="assets/backend/js/additional-methods.js"></script>
<script type="application/javascript">

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

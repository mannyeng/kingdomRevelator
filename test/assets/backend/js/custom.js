$(document).ready(function() {
	$('#datatables').dataTable({
		"iDisplayLength": 50,
		"bStateSave": true,
		"iCookieDuration": 60 * 60 * 24 * 30, // 30 days
		"bSort": false,
		"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ records per page"
		}
	});

	// datepicker
	$('[data-form=datepicker]').datepicker({autoclose: true, format: 'dd/mm/yyyy'});
	$('[data-form=datetimepicker]').datetimepicker();
	
	//delete confirmation
	$(".del").click(function() {
		if (!confirm("Are you sure you want to delete this item?")) {
			return false;
		}
	});

});
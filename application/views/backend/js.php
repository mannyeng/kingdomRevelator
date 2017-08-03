<!-- Load javascripts at bottom, this will reduce page load time -->
<script type="text/javascript" src="assets/backend/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="assets/backend/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="assets/backend/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="assets/backend/assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="assets/plugin/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="assets/backend/assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/backend/assets/data-tables/DT_bootstrap.js"></script>
<!--common script for all pages-->
<script type="text/javascript" src="assets/backend/js/common-scripts.js"></script>

<!-- required  for form Date Picker -->
<script type="text/javascript" src="assets/backend/assets/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="assets/backend/js/datetimepicker.min.js"></script>
<!--<script type="text/javascript" src="assets/plugin/chosen_v1.4.2/chosen.jquery.min.js"></script>-->

<script type="text/javascript" src="assets/plugin/select2_v4.0.0/js/select2.min.js"></script>
<script type="text/javascript" src="assets/plugin/jquery-popup-overlay/jquery.popupoverlay.js"></script>
<script type="text/javascript" src="assets/backend/js/dynamic-table.js"></script>
<script type="text/javascript" src="assets/backend/js/form-component.js"></script>
<script src="assets/backend/js/fileinput.js"></script>
<script type="text/javascript">
	$(function($) {
    // this script needs to be loaded on every page where an ajax POST may happen
    $.ajaxSetup({
    	data: {
    		'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    	}
    });
});
</script>
<script type="text/javascript" src="assets/backend/js/custom.js"></script>
<script src="assets/backend/js/bootstrap-alert.js"></script>
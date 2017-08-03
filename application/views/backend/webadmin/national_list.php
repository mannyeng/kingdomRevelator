<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					My National
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo $this->session->userdata('role')?>">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li class="active">
						My National
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
        <a href="user/create_national" class="btn btn-success" >Create National</a><br><br>
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<!--BEGIN METRO STATES-->
			<div class="metro-nav">
            <?php
				foreach($national as $ind=>$row)
              {	
                ?>
               <div class="metro-nav-block nav-olive">
                    <a href="javascript:;" class="btn-detail" onclick="get_modal('<?php echo $row['id'];?>')" >Click <span style="color:#1217D8;">Here</span> To view Details</a><br /><br />
					<a data-original-title="" href="national/zone_list/<?php echo $row['id'];?>">
						<i class="icon-heart"></i>
						<div class="info"><?php echo $row['First_name']; ?></div>
						<div class="status">List</div>
					</a>
				</div>
                <?php
			  }
			  ?>
									
			</div>
		
			<!--END METRO STATES-->
		</div>

		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER-->
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Details</h4>
      </div>
      <div class="modal-body" id='modal_target'>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
 function get_modal(id){
        $.ajax({
            type    : 'POST', 
			data	: 'role=<?php echo $this->session->userdata('role');?>&id='+id, 	
            url     : '<?php base_url() ?>Ajaxaction/get_modal',
            cache   : false,
            success : function(msg){ 
               if(msg){
                    $('#modal_target').html(msg);
					$('.modal-footer').html('');
					$('.modal-footer').append('<a href="user/create_national/'+id+'" class="btn btn-success" >Edit </a>');
                    //This shows the modal
                    $('#myModal').modal();
               }
            }
        });
    }
</script>	
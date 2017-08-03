<div id="main-content">
	<!-- BEGIN PAGE CONTAINER-->
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid">
			<div class="span12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
					My State Zones
				</h3>
				<ul class="breadcrumb">
					<li>
						<a href="zone">Dashboard</a>
						<span class="divider">/</span>
					</li>
					<li class="active">
						My States Zones
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
		</div>
		<!-- END PAGE HEADER-->
         <a href="user/create_state_zone" class="btn btn-success" >Create State Zone</a><br><br>
		<!-- BEGIN PAGE CONTENT-->
		<div class="row-fluid">
			<!--BEGIN METRO STATES-->
			<div class="metro-nav">
				<?php
				 foreach($state_zone as $ind=>$row)
                {	
				?>
				<!--<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="webadmin/coordinators">
						<i class="icon-heart"></i>
						<div class="info">Coordinators</div>
						<div class="status">List</div>
					</a>
				</div>
                 <div class="metro-nav-block nav-block-red">
					<a data-original-title="" href="state/subscribers_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">Subscribers</div>
					</a>
				</div>-->
				
               <!-- <div class="metro-nav-block nav-block-orange">
					<a data-original-title="" href="state/county_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">County Admin</div>
					</a>
				</div>-->
              <!--  <div class="metro-nav-block nav-block-green">
					<a data-original-title="" href="state/distributers_list">
						<i class="icon-list"></i>
						<div class="info">List All</div>
						<div class="status">Distributers </div>
					</a>
				</div>-->
                <div class="metro-nav-block nav-block-blue">
                    <a href="javascript:;" class="btn-detail" onclick="get_modal('<?php echo $row['id'];?>')" >Click <span style="color:#1217D8;">Here</span> To view Details</a><br /><br />
					<a data-original-title="" href="zone/distributers_list/<?php echo $row['id']; ?>">
						<i class="icon-list"></i>
						<div class="info"><?php echo $row['Name']; ?></div>
						<div class="status">List</div>
					</a>
				</div>
                <!--<div class="metro-nav-block nav-olive">
					<a data-original-title="" href="state/assign_subscribers">
						<i class="icon-group"></i>
						<div class="info">Assign </div>
						<div class="status">Subscribers</div>
					</a>
			   </div>
               <div class="metro-nav-block nav-block-red">
					<a data-original-title="" href="state/assign_distributers">
						<i class="icon-group"></i>
						<div class="info">Assign </div>
						<div class="status">Distributers</div>
					</a>
			   </div>-->
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
					$('.modal-footer').append('<a href="user/create_state_zone/'+id+'" class="btn btn-success" >Edit </a>');
                    //This shows the modal
                    $('#myModal').modal();
               }
            }
        });
    }
</script>	
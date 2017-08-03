<?php

$this->db->where('kr_users.admin_type','Distributer');  

$this->db->where('kr_users.id',$this->uri->segment('4'));

$this->db->select('kr_users.id as user_id,kr_users.State_zone_admin_id,kr_distributers.*');

$this->db->join('kr_distributers','kr_distributers.User_id=kr_users.id','Inner');  

$res_distributers = $this->db->get_where('kr_users')->row_array();



$this->db->where('kr_users.admin_type','state_zone');  

$this->db->where('kr_users.id',$res_distributers['State_zone_admin_id']);

$res_state_zone = $this->db->get_where('kr_users')->row_array();



$this->db->where('kr_users.admin_type','state');  

$this->db->where('kr_users.id',$res_state_zone['State_admin_id']);

$res_state = $this->db->get_where('kr_users')->row_array();





$this->db->where('kr_users.admin_type','zone');  

$this->db->where('kr_users.id',$res_state['Zonal_admin_id']);

$res_zone = $this->db->get_where('kr_users')->row_array();



$this->db->where('kr_users.admin_type','national');  

$this->db->where('kr_users.id',$res_zone['National_admin_id']);

$this->db->select('kr_users.id as user_id,kr_distributers.*');

$this->db->join('kr_distributers','kr_distributers.id=kr_users.Distributer_id','Inner');  

$res_national = $this->db->get_where('kr_users')->row_array();

$res_subscriber = $this->db->get_where('kr_subscribers',array('id'=>$this->uri->segment(3)))->row_array();





?>









<style>

/*.row-fluid

{

min-width:1600px !important;	

	}

	#main-content

	{

	min-width:1700px !important;	

		}*/

</style>

<div id="main-content">

	<!-- BEGIN PAGE CONTAINER-->

	<div class="container-fluid">

		<!-- BEGIN PAGE HEADER-->   

		<div class="row-fluid">

			<div class="span12">

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->

				<h3 class="page-title">

					All Orders

				</h3>

				<ul class="breadcrumb">

					<li>

						<a href="<?php echo $this->session->userdata('role');?>">Dashboard</a>

						<span class="divider">/</span>

					</li>

                    <?php if(in_array($this->session->userdata('role'),array('webadmin'))):	?>

                    <li>

						<a href="webadmin/national_list"><?php echo $res_national['First_name'];?></a>

						<span class="divider">/</span>

					</li>

                    <?php endif;?>

                    <?php if(in_array($this->session->userdata('role'),array('national','webadmin'))):	?>

                    <li>

						<a href="national/zone_list/<?php echo $res_national['user_id'];?>"><?php echo $res_zone['Name'];?></a>

						<span class="divider">/</span>

					</li>

                    <?php endif;?>

                    <?php if(in_array($this->session->userdata('role'),array('zone','national','webadmin'))):	?>

					<li>

						<a href="national/state_list/<?php echo $res_zone['id'];?>"><?php echo $res_state['Name'];?></a>

						<span class="divider">/</span>

					</li>

                    <?php endif; ?>

                    <?php if(in_array($this->session->userdata('role'),array('state','zone','national','webadmin'))):	?>

                    <li>

						<a href="national/state_zone_list/<?php echo $res_state['id'];?>"><?php echo $res_state_zone['Name'];?></a>

						<span class="divider">/</span>

					</li>

                    <?php endif;?>

                    <li>

						<a href="national/distributers_list/<?php echo $res_state_zone['id'];?>"><?php echo $res_distributers['First_name'];?></a>

						<span class="divider">/</span>

					</li>

                    <li>

						<a href="national/subscribers_list/<?php echo $this->uri->segment(4);?>"><?php echo $res_subscriber['First_name'];?></a>

						<span class="divider">/</span>

					</li>

					<li class="active">

						Subscribers List

					</li>

				</ul>

				<!-- END PAGE TITLE & BREADCRUMB-->

			</div>

		</div>

		<?php

    //flash messages

    if($this->session->flashdata('order')){
    if($this->session->flashdata('order') == 'cancelled')
    {
    echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Cancelled successfully.';
    echo '</div>';
    }
    
     elseif($this->session->flashdata('order') == 'error')
    {
    echo '<div class="alert alert-failure">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Something went wrong.';
    echo '</div>';
    }
       
    }

    ?>

        <div class="row-fluid">

       

          <div class="well">

           

           

          

		<!-- BEGIN ADVANCED TABLE widget-->

 <div class="row-fluid">

			<div class="span12">

				<!-- BEGIN EXAMPLE TABLE widget-->

				<div class="widget blue">

					<div class="widget-title">

						<h4><i class="icon-reorder"></i>All Orders </h4>

						<span class="tools">

							<a href="javascript:;" class="icon-chevron-down"></a>

						</span>

					</div>

					<div class="widget-body">

                    <table class="table table-striped table-bordered table-condensed" id="sample_1">

              <thead>

              <tr>

                <th class="header">#</th>

               

                <th  class="header">Subscription Date</th>  

                <th  class="header">Expiry Date</th> 

                <th  class="header">No. of Copies</th> 
                <th  class="header">No. of Months</th> 
                <th  class="header">Total days</th> 
<th colspan="3"  class="header" style="text-align: center !important;">Action</th> 
 
                                                         

              </tr>

            </thead>

            <tbody>

              <?php
$orders = $this->Subscriber_model->orders_get($this->uri->segment('3'));

if(count($orders) > 0) {
  //pr($orders);
  $i = 1;
              foreach($orders as $row)

             { 

       

          

        echo '<tr>';

        echo '<td>'.$i.'</td>';


       

        echo '<td>'.$row['subscription_date'].'</td>';

        echo '<td>'.$row['expiry_date'].'</td>';    

      

        echo '<td>'.$row['No_of_copies'].'</td>';
         echo '<td>'.$row['subscription_length'].'</td>';
if($this->Subscriber_model->order_status($row['id']) == 1) {
        echo '<td>'.$this->Subscriber_model->subscription_status($row['id']).'</td>';
      }
      else
      {
        echo '<td>--</td>';
      }
        
          echo '<td width="350" style="text-align: center">';

          echo '<a href="'.base_url().'national/subs_order_details/'.sha1($row['id']).'/'.$row['Subscriber_id'].'/'.$this->uri->segment('4').'" class="btn btn-danger">Detail & Payment Approval</a>';
          if($this->Subscriber_model->order_status($row['id']) == 1) { ?>

        &nbsp;<a href="javascript:;" onclick="get_modal('<?php echo $row['id'];?>','<?php echo $this->uri->segment('3'); ?>','<?php echo $this->uri->segment('4'); ?>')" class="btn btn-warning">Cancel</a>
          <?php }
           else
          {
            echo '&nbsp;&nbsp;<b style="text-align: center !important;color:red;">Cancelled</b>';
          }
          ?>
          <a href="javascript:;" onclick="get_modal1('<?php echo $row['id'];?>')" class="btn btn-success">History</a>
         <?php
          echo '</td>';
     
          
         
                echo '</tr>';
$i++;
           }
         }
         

              ?>      

            </tbody>

            </table>

					</div>

				</div>

				<!-- END EXAMPLE TABLE widget-->

			</div>

		</div>



		<!-- END ADVANCED TABLE widget-->

	</div>

	<!-- END PAGE CONTAINER-->

</div>

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

<div id="myModal1" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Details</h4>

      </div>

      <div class="modal-body" id='modal_target1'>

        

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>

<script>
	$(document).ready(function(e) {

    $("#volunteer_form").validate();
  });


  function get_modal(orderid,subsid,distid){

        $.ajax({

            type    : 'POST', 

            data  : 'orderid='+orderid+'&subsid='+subsid+'&distid='+distid,   

            url     : '<?php base_url() ?>national/subs_modal_cancel_form',

            cache   : false,

            success : function(msg){ 

               if(msg){

                    $('#modal_target').html(msg);

                    $('#myModal').modal();

               }

            }

        });

    }
    function get_modal1(orderid){

        $.ajax({

            type    : 'POST', 

            data  : 'orderid='+orderid,   

            url     : '<?php base_url() ?>national/subs_modal_order_history',

            cache   : false,

            success : function(msg){ 

               if(msg){

                    $('#modal_target1').html(msg);

                    $('#myModal1').modal();

               }

            }

        });

    }
    </script>

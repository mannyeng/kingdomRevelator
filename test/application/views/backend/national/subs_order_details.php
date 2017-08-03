
<?php

$this->db->where('kr_users.admin_type','Distributer');  

$this->db->where('kr_users.id',$distributer);

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

$res_subscriber = $this->db->get_where('kr_subscribers',array('id'=>$this->uri->segment(4)))->row_array();





?>

<div id="main-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
       View Order Details
        </h3>
        <ul class="breadcrumb">

          <li>

            <a href="<?php echo $this->session->userdata('role');?>">Dashboard</a>

            <span class="divider">/</span>

          </li>

                    <?php if(in_array($this->session->userdata('role'),array('webadmin'))): ?>

                    <li>

            <a href="webadmin/national_list"><?php echo $res_national['First_name'];?></a>

            <span class="divider">/</span>

          </li>

                    <?php endif;?>

                    <?php if(in_array($this->session->userdata('role'),array('national','webadmin'))):  ?>

                    <li>

            <a href="national/zone_list/<?php echo $res_national['user_id'];?>"><?php echo $res_zone['Name'];?></a>

            <span class="divider">/</span>

          </li>

                    <?php endif;?>

                    <?php if(in_array($this->session->userdata('role'),array('zone','national','webadmin'))): ?>

          <li>

            <a href="national/state_list/<?php echo $res_zone['id'];?>"><?php echo $res_state['Name'];?></a>

            <span class="divider">/</span>

          </li>

                    <?php endif; ?>

                    <?php if(in_array($this->session->userdata('role'),array('state','zone','national','webadmin'))): ?>

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

            <a href="national/subscribers_list/<?php echo $distributer;?>"><?php echo $res_subscriber['First_name'];?></a>

            <span class="divider">/</span>

          </li>
           <li>

            <a href="national/subscribers_payment/<?php echo $this->uri->segment(4).'/'.$distributer;?>">Orders</a>

            <span class="divider">/</span>

          </li>

          <li class="active">

            Order Details

          </li>

        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
      </div>
    </div>

    <?php

    //flash messages

    if($this->session->flashdata('payment')){
    if($this->session->flashdata('payment') == 'updated')
    {
    echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Updated successfully.';
    echo '</div>';
    }
    
     elseif($this->session->flashdata('payment') == 'cancel')
    {
    echo '<div class="alert alert-failure">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Something went wrong.';
    echo '</div>';
    }
       
    }

    ?>
    <!-- END PAGE HEADER-->
       <div class="metro-nav">
               <div class="metro-nav-block nav-block-green">
             
                <div class="info"><?php echo $orders['subscription_date'];?></div>
              Subscription Start Date
           
        </div>
        <div class="metro-nav-block nav-block-red">
            
                <div class="info"><?php echo $orders['expiry_date'];?></div>
              Subscription End Date
           
        </div>
        <div class="metro-nav-block nav-block-blue">
            
                <div class="info"><?php echo $orders['No_of_copies'];?></div>
              Number of copies subscribed
           
        </div>
        <div class="metro-nav-block nav-block-yellow">
            
                <div class="info"><?php echo $orders['subscription_length'];?> Months</div>
              Duration
           
        </div>
        <div class="metro-nav-block nav-block-green">
            
                <div class="info">$<?php echo round($orders['totamnt'],2);?></div>
              Total amount received
           
        </div>
        <div class="metro-nav-block nav-block-orange">
            
                <div class="info">$<?php echo round($orders['refundamnt'],2);?></div>
              Total refund
           
        </div>
        <div class="metro-nav-block nav-block-blue">
           
                <div class="info"><?php echo $orders['Cash_Check_by'];?></div>
             Agent Name
           
        </div>
        <div class="metro-nav-block nav-block-yellow">
            
             
             Comments :  <?php echo nl2br($orders['comments']);?>
          
        </div>
        
         

        
       
        </div>                
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="widget blue">
          
          <div class="widget-title">
            <h4><i class="icon-reorder"></i> Payment Details</h4>
            <span class="tools">
              <a href="javascript:;" class="icon-chevron-down"></a>
            </span>
          </div>
          <div class="widget-body">
            <!-- BEGIN FORM-->
          


            <table class="table table-striped table-bordered table-condensed" id="sample_1">

              <thead>

              <tr>

                <th class="header">#</th>

               

                <th  class="header">Payment Date</th>  

                <th  class="header">Payment Mode</th> 

                <th  class="header">Payment Status</th> 
                <th  class="header">Payment Accepted Date</th> 
                <th  class="header">Amount Paid</th> 
                <th  class="header">Refund Amount</th> 
<th  class="header">Refund Status</th> 
<th  class="header">Refund Date</th> 
                <th  class="header">Transaction ID</th> 
               
                
                <th  class="header">Cheque No.</th> 
<th  class="header">Account No.</th> 
<th  class="header">Bank Details</th> 

<th  class="header">Notes</th> 
 <?php if($orders['status']=='1'){ ?>
<th  class="header">Action</th> 
<?php }?>
 
                                                         

              </tr>

            </thead>

            <tbody>

              <?php
              $resp =  $this->db->query("SELECT * from kr_payment where order_id=".$orders['id']." order by id DESC")->result_array();
              //pr($resp);
if(count($resp) > 0) {
 
  $i = 1;
              foreach($resp as $row)

             { 

       

          

        echo '<tr>';

        echo '<td>'.$i.'</td>';


       

        echo '<td>'.$row['created_date'].'</td>';

        echo '<td>'.$row['Mode_of_pay'].'</td>';    

      

        echo '<td>';

        
if($row['paypal_status']=='completed')
 echo '<b style="color:green">Completed</b>';
else
  echo '<b style="color:red">Pending</b>';

        echo '</td>';

echo '<td>'.$row['date_of_pay'].'</td>'; 

         echo '<td>'.$row['paid_amnt'].'</td>';
 echo '<td>'.$row['refund_amnt'].'</td>';
 echo '<td>';
if($row['refund_status']==1)
 echo '<b style="color:green">Success</b>';
else {
  if($row['refund_amnt'] > 0)
  echo '<b style="color:red">Pending</b>';
}

 echo '</td>';
 echo '<td>'.$row['refund_date'].'</td>';
        echo '<td>'.$row['txn_id'].'</td>';

       
        
          echo '<td>'.$row['cheque_num'].'</td>';
           echo '<td>'.$row['acc_num'].'</td>';
            echo '<td>'.$row['bank_detail'].'</td>';
            echo '<td>'.$row['notes'].'</td>';
         
          if($orders['status']=='1'){
             echo '<td width="220">';
          ?>
  <?php if(($row['Mode_of_pay'] == 'cash') || ($row['Mode_of_pay'] == 'cheque') || ($row['Mode_of_pay'] == 'Cash') || ($row['Mode_of_pay'] == 'Cheque')) {?>
         <a href="javascript:;" onclick="get_modal('<?php echo $row['id'];?>','<?php echo $orders['id'];?>','<?php echo $this->uri->segment(4);?>','<?php echo $distributer;?>')" class="btn btn-danger">Payment Update</a>&nbsp;
         <?php }?>

         <a href="javascript:;" onclick="get_modal1('<?php echo $row['id'];?>','<?php echo $orders['id'];?>','<?php echo $this->uri->segment(4);?>','<?php echo $distributer;?>')" class="btn btn-danger">Refunds</a>
         <?php

          echo '</td>';
          } 
         
                echo '</tr>';
$i++;
           }
         }
        

              ?>      

            </tbody>

            </table>

          
            <!-- END FORM-->
          </div>
          
        </div>
        <!-- END SAMPLE FORM PORTLET-->
      </div>
    </div>
    
    <!-- END PAGE CONTAINER-->
  </div>
  <!-- END PAGE -->
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

<script>

 function get_modal(paymentid,orderid,subsid,distid){

        $.ajax({

            type    : 'POST', 

            data  : 'paymentid='+paymentid+'&orderid='+orderid+'&subsid='+subsid+'&distid='+distid,   

            url     : '<?php base_url() ?>national/subs_modal_payment_update',

            cache   : false,

            success : function(msg){ 

               if(msg){

                    $('#modal_target').html(msg);

                    $('#myModal').modal();

               }

            }

        });

    }

    function get_modal1(paymentid,orderid,subsid,distid){

        $.ajax({

            type    : 'POST', 

            data  : 'paymentid='+paymentid+'&orderid='+orderid+'&subsid='+subsid+'&distid='+distid,   

            url     : '<?php base_url() ?>national/subs_modal_refund_update',

            cache   : false,

            success : function(msg){ 

               if(msg){

                    $('#modal_target').html(msg);

                    $('#myModal').modal();

               }

            }

        });

    }

</script>

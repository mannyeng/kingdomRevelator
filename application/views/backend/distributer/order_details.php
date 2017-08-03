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
            <a href="distributer/profile">Dashboard</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
           View Order Details
          </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
      </div>
    </div>
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
            
                <div class="info">$<?php echo $orders['totamnt'];?></div>
              Total amount received
           
        </div>
        <div class="metro-nav-block nav-block-orange">
            
                <div class="info">$<?php echo $orders['refundamnt'];?></div>
              Total refund
           
        </div>
        <div class="metro-nav-block nav-block-blue">
           
                <div class="info"><?php echo $orders['Cash_Check_by'];?></div>
             Agent Name
           
        </div>
        <div class="metro-nav-block nav-block-yellow">
            
             
             Comments :  <?php echo nl2br($orders['comments']);?>
          
        </div>
        <?php if($this->Distributer_model->expire_status($orders['id'])=='1') { ?>
        <div class="metro-nav-block nav-block-red">
            <a href="<?php base_url();?>distributer/order_edit/<?php echo sha1($orders['id']);?>">
                <div class="info">EDIT</div>
              Edit Order
              </a>
           
        </div>
        <?php } ?>
       
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
                 <th  class="header">Payment Accepted date</th> 
                <th  class="header">Amount Paid</th> 
                <th  class="header">Refund Amount</th> 
<th  class="header">Refund Status</th> 
                <th  class="header">Transaction ID</th> 
                <th  class="header">Payer Email</th> 
                
                <th  class="header">Cheque No.</th> 
<th  class="header">Account No.</th> 
<th  class="header">Bank Details</th> 

<th  class="header">Notes</th> 

 
                                                         

              </tr>

            </thead>

            <tbody>

              <?php
              $resp =  $this->db->query("SELECT * from kr_dis_payment where order_id=".$orders['id']." order by id DESC")->result_array();
              // pr($resp);
if(count($resp) > 0) {
 
  $i = 1;
              foreach($resp as $row)

             { 

       

          

        echo '<tr>';

        echo '<td>'.$i.'</td>';


       

        echo '<td>'.date("Y-m-d",strtotime($row['created_date'])).'</td>';

        echo '<td>'.$row['Mode_of_pay'].'</td>';    

      

        echo '<td>';

        
if($row['paypal_status']=='completed')
 echo '<b style="color:green">Completed</b>';
else
  echo '<b style="color:red">Pending</b>';

        echo '</td>';
if($row['date_of_pay']!="0000-00-00")
{
  echo '<td>'.$row['date_of_pay'].'</td>';
}
else
{
    echo '<td></td>';

}

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
        echo '<td>'.$row['txn_id'].'</td>';

       
         echo '<td>'.$row['payer_email'].'</td>';
          echo '<td>'.$row['cheque_num'].'</td>';
           echo '<td>'.$row['acc_num'].'</td>';
            echo '<td>'.$row['bank_detail'].'</td>';
            echo '<td>'.$row['notes'].'</td>';
          
          
         
                echo '</tr>';
$i++;
           }
         }
         else
         {

          echo 'No orders yet';
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

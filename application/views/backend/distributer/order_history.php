<div id="main-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
       View Order History
        </h3>
        <ul class="breadcrumb">
          <li>
            <a href="distributer/profile">Dashboard</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
           View Order  History
          </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
      </div>
    </div>
    <!-- END PAGE HEADER-->
                    
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="widget blue">
          
          <div class="widget-title">
            <h4><i class="icon-reorder"></i> Order Details</h4>
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

               

                <th  class="header">Subscription Date</th>  

                <th  class="header">Expiry Date</th> 

                <th  class="header">Subscription Length ( Months )</th> 
                <th  class="header">Number of Copies</th> 
                <th  class="header">Payment Mode</th> 
                <th  class="header">Order Created Date</th> 


 
                                                         

              </tr>

            </thead>

            <tbody>

              <?php
            // pr($orders);
if(count($orders) > 0) {
 
  $i = 1;
              foreach($orders as $row)

             { 

       

          

        echo '<tr>';

        echo '<td>'.$i.'</td>';


       

        echo '<td>'.$row['subscription_date'].'</td>';

        echo '<td>'.$row['expiry_date'].'</td>';    

       echo '<td>'.$row['subscription_length'].'</td>'; 
        echo '<td>'.$row['No_of_copies'].'</td>'; 
         echo '<td>'.$row['Mode_of_pay'].'</td>'; 
         echo '<td>'.$row['order_date'].'</td>'; 
        
          
          
         
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

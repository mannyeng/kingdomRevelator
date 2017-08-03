<div id="main-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
       Previous Orders
        </h3>
        <ul class="breadcrumb">
          <li>
            <a href="distributer/profile">Dashboard</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
            Previous Orders
          </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
      </div>
    </div>
    <!-- END PAGE HEADER-->
                
<?php
    //flash messages

    if($this->session->flashdata('alert') || $this->session->flashdata('order')){
    if($this->session->flashdata('order') == 'updated')
    {
    echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Updated successfully.';
    echo '</div>';
    }
    elseif($this->session->flashdata('order') == 'added')
    {
    echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'New order added successfully.';
    echo '</div>';
    }
     elseif($this->session->flashdata('order') == 'error')
    {
    echo '<div class="alert alert-failure">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Something went wrong.';
    echo '</div>';
    }
    elseif($this->session->flashdata('order') == 'cancelrequest')
    {
    echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="aler">×</a>';
      echo 'Your request for cancel the order send successfully.';
    echo '</div>';
    }
        elseif($this->session->flashdata('alert') == 'already')
    {
    echo '<div class="alert alert-failure">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Already exists.';
    echo '</div>';
    }
    }

    ?>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="widget blue">
          
          <div class="widget-title">
            <h4><i class="icon-reorder"></i> Orders</h4>
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

                <th  class="header">No. of Copies</th> 
                <th  class="header">No. of Months</th> 
                <th  class="header">Total days / Payment Status</th> 
<th colspan="3"  class="header" style="text-align: center !important;">Action</th> 
 
                                                         

              </tr>

            </thead>

            <tbody>

              <?php
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
if($this->Distributer_model->order_status($row['id']) == 1) {
        echo '<td>'.$this->Distributer_model->subscription_status($row['id']).' / '.ucfirst($this->Distributer_model->validate_subscription($row['id'])).'</td>';
      }
      else
      {
        echo '<td>--</td>';
      }
        if($this->Distributer_model->order_status($row['id']) == 1) {
          echo '<td width="350" style="text-align: center">';
if($this->Distributer_model->expire_status($row['id'])=='1') { 
         echo ' <a href="'.base_url().'distributer/order_edit/'.sha1($row['id']).'" class="btn btn-success">MODIFY</a>';
}
          echo '&nbsp;<a href="'.base_url().'distributer/order_details/'.sha1($row['id']).'" class="btn btn-danger">DETAILS</a>';
          echo '&nbsp;<a href="'.base_url().'distributer/order_history/'.sha1($row['id']).'" class="btn btn-danger">HISTORY</a>';
if($this->Distributer_model->expire_status($row['id'])=='1') { 
          echo '&nbsp;<a href="'.base_url().'distributer/order_cancel/'.sha1($row['id']).'" class="btn btn-success">CANCEL</a>';
}
          echo '</td>';
        }
          else
          {
            echo '<td colspan="2" style="text-align: center !important;color:red;"><b>Cancelled</b></td>';
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

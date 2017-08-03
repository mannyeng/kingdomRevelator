<div id="main-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
      Order Cancel
        </h3>
        <ul class="breadcrumb">
          <li>
            <a href="subscriber_profile/profile">Dashboard</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
            Order Cancel
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
          
          
          <div class="widget-body">
            <!-- BEGIN FORM-->
          
 Hi,
 Your payment is cancelled. Please update the payment option for the corresponding order. <a href="<?php echo base_url().'subscriber_profile/order_details/'.sha1($this->uri->segment(3));?>" class="btn btn-success">View and update payment</a>

          
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


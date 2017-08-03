<div id="main-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
        Renew Subscription
        </h3>
        <ul class="breadcrumb">
          <li>
            <a href="subscriber_profile/profile">Dashboard</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
            Renew Subscription
          </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
      </div>
    </div>
    <!-- END PAGE HEADER-->
    <?php
    //flash messages
    if($this->session->flashdata('alert')){
    if($this->session->flashdata('alert') == 'updated')
    {
    echo '<div class="alert alert-success">';
      echo '<a class="close" data-dismiss="alert">×</a>';
      echo 'Updated successfully.';
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
    <?php
      /*if($row['Subscriptions']==25)
      {
        $dateString = $row['subscription_date'];
        $t = strtotime($dateString);
        $expiry_date = date('Y-m-d',strtotime('+1 years', $t));
        //echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));
      }
      if($row['Subscriptions']==45)
      {
        $dateString = $row['subscription_date'];
        $t = strtotime($dateString);
        $expiry_date = date('Y-m-d',strtotime('+2 years', $t));
        //echo $expiry_date = date('Y-m-d',strtotime($row['subscription_date'])+strtotime('+5 years'));
      }*/
      
      $future = strtotime($row['expiry_date']); //Future date.
      $timefromdb =strtotime(date("Y-m-d"));
      $timeleft = $future-$timefromdb;
      $daysleft = round((($timeleft/24)/60)/60);
    ?>
    <div class="metro-nav">
      <div class="metro-nav-block nav-olive">
        <a data-original-title="" href="javascript:;">
          <div class="info"><?php echo  date('Y-m-d',strtotime($row['subscription_date'])); ?></div>
          Subscription Start at
        </a>
      </div>
      <div class="metro-nav-block nav-block-blue">
        <a data-original-title="" href="javascript:;">
          <div class="info"><?php echo date('Y-m-d',strtotime($row['expiry_date'])); ?></div>
          Subscription End at
        </a>
      </div>
      <div class="metro-nav-block nav-block-green">
        <a data-original-title="" href="javascript:;">
          <div class="info"><?php echo $daysleft;?> Days</div>
          Remaining
        </a>
      </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="widget blue">
          <?php if($daysleft<=0){?>
          <div class="widget-title">
            <h4><i class="icon-reorder"></i> Entry Form </h4>
            <span class="tools">
              <a href="javascript:;" class="icon-chevron-down"></a>
            </span>
          </div>
          <div class="widget-body">
            <!-- BEGIN FORM-->
            <form class="" action="distributer/renew" id='volunteer_form' method="POST" >
              <fieldset>
                
               <?php
          $price  = $this->db->query("SELECT * FROM kr_discount ")->row_array();
        ?>
              <?php /*?><div class="form-group">
                    <label class="col-lg-4 col-md-2 control-label label-style">Subscription Options (Subscription will always start from the following month.) </label>
    
                    <div class="col-lg-8 col-md-10">
                      <div class="radio radio-primary">
                        <label>
                          <input type="radio" name="optionssubscription" id="optionssubscription1" value="<?php echo @$price['1_yr_price']; ?>" <?php  echo "checked"; ?> onclick="getDiscount($('#copies').val());">
                         1-Year ($ <?php echo @$price['1_yr_price']; ?>)
                        </label>
                      </div>
                      <div class="radio radio-primary">
                        <label>
                          <input type="radio" name="optionssubscription" id="optionssubscription2" value="<?php echo @$price['2_yr_price']; ?>" onclick="getDiscount($('#copies').val());">
                          2-Years ($ <?php echo @$price['2_yr_price']; ?>)
                        </label>
                      </div>
                    </div>
                  </div><?php */?>
              <div class="form-group">
                  <div class="col-lg-10 col-md-10 col-lg-offset-1">
                   <label style="color: #17b3e5;"> Price Per copy :$ <?php echo $price['price_cpy'];?> </label>
                  </div>
               </div>
              <div class="form-group">
                  <div class="col-lg-10 col-md-10 col-lg-offset-1">
                    <input type="text" class="form-control" id="Copies_requested" required="required" name='Copies_requested' value='' onkeyup="getDiscount($(this).val(),'')"  placeholder="Please enter number copies">
                  </div>
              </div>
              <span id="nocopies" style="color:#F00;margin-left: 9%;"></span>
              <div class="form-group">
                <div class="col-md-10 col-lg-offset-1">
                  <select id="request_month" name='Request_month' required="required" class="form-control" onchange="getDiscount($('#Copies_requested').val(),$(this).val())">
                    <option value="">Select number of month</option>
                    <option value="1">1</option>
                    <option value="3">3</option>
                    <option value="6">6</option>
                    <option value="9">9</option>
                    <option value="12">12</option>
                  </select>
                </div>
                <span class="material-input"></span>
              </div>
              <div class="form-group">
                 <div class="col-lg-10 col-md-10 col-lg-offset-1">
                 <span id="month" style="color:#F00;"></span>
                 </div>
              </div>
              <div class="form-group" >
                      <div class="col-lg-10 col-md-10 col-lg-offset-1" id='message_discount'>
                      </div>
                  </div>
                  <br />
                  <div class="form-group">
                    <label class="col-lg-4 col-md-2 control-label label-style">Mode of Payment </label>
                    
                    <div class="col-lg-8 col-md-10">
                      <div class="radio radio-primary" style="width: 10%;">
                        <label style="text-align: center;">
                          <input type="radio" name="optionspayment" id="optionspayment1" value="online" <?php echo "checked";?>  style="margin: 0;opacity: 1;width: 96%!important;">
                          Pay online
                        </label>
                      </div>
                      <div class="radio radio-primary" style="width: 10%;">
                        <label style="text-align: center;">
                          <input type="radio" name="optionspayment" id="optionspayment2" value="Cash" style="margin: 0;opacity: 1;width: 96%!important;">
                          Cash
                        </label>
                      </div>
                      <div class="radio radio-primary" style="width: 10%;">
                        <label style="text-align: center;">
                          <input type="radio" name="optionspayment" id="optionspayment3" value="Cheque" style="margin: 0;opacity: 1;width: 96%!important;">
                          Cheque
                        </label>
                      </div>
                    </div>
                  </div>
                  <br /><br/>
                  <div id='payment_type_cash' style="display:none">
                    <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="cash_agent_name" name='cash_agent_name' value="" placeholder=" Please enter the agent name" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="cash_comments" name='cash_comments' value="" placeholder=" Comments" required="required">
                      </div>
                    </div>
                  </div>
                  <div id='payment_type_cheque' style="display:none">
                    <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="cheque_agent_name" name='cheque_agent_name' value=""  placeholder=" Please enter the agent name,Cheque number" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-10 col-md-10 col-lg-offset-1">
                        <input type="text" class="form-control" id="cheque_comments" name='cheque_comments' value="" placeholder=" Comments" required="required">
                      </div>
                    </div>
                  </div>
                  <input type='hidden' name='amount' id='amount' />
                  <input type='hidden' name='Email' id='Email' value='<?php echo $row['Email_address']; ?>' />
                  <div style="clear: both;"></div>
                  <div class="center">
                    <input type="submit" class="btn btn-success" tabindex="8" value="Update" />
                  </div>
                </div>
              </fieldset>
            </form>
            <!-- END FORM-->
          </div>
          <?php
        }
        ?>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
      </div>
    </div>
    
    <!-- END PAGE CONTAINER-->
  </div>
  <!-- END PAGE -->
</div>
<div class="control-group" id="copier">
  <div class="span3">
    <input type="text" class="form-control dat"   name='day[dyn_id]' placeholder="Select Date" />
  </div>
  <div class="span3">
    <select class="form-control hour"  name='hour[dyn_id]' >
      <option value="">Select Hour</option>
      <?php foreach(range(1,20) as $hr) echo "<option>$hr</option>"; ?>
    </select>
  </div>
  <div class="span3">
    <select class="form-control min"  name='min[dyn_id]' >
      <option value="">Select Minute</option>
      <option >15</option>
      <option >30</option>
      <option >45</option>
    </select>
  </div>
  <div class="span3" align="center">
    <b style="font-size:50px;cursor:pointer;line-height:50px" class="removeme" title="Remove">-</b>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-datetimepicker.min.css"> -->
<script type="application/javascript" >

$(document).ready(function()
{
  $("#optionspayment2").click(function(){
  $('#payment_type_cash').show();
  $('#payment_type_cheque').hide();
  })
  
  $("#optionspayment3").click(function(){
  $('#payment_type_cash').hide();
  $('#payment_type_cheque').show();
  })
  
  $("#optionspayment1").click(function(){
  $('#payment_type_cash').hide();
  $('#payment_type_cheque').hide();
  })
})

function getDiscount(copy,mnth)
{
  $('#month').html(" ");
  if(mnth=='')
  {
    var month = $("#request_month").val();
  }
  else
  {
    var month = mnth;
  }
  if(month=='')
  {
    $('#month').html("Please select number of months");
  }
  else
  {
    $(document).ready(function(){
      var amount = parseInt(<?php echo $price['price_cpy'];?>)*parseInt(month)*parseInt(copy);
      $('#nocopies').html('');
      $('#message_discount').html('');
      if($.isNumeric($('#Copies_requested').val()) )
      {
         if($('#Copies_requested').val()<<?php echo $price['min_cpy'];?>)
         {
              $('#nocopies').html('');
              $('#nocopies').html("Minimum Copies <?php echo $price['min_cpy'];?>");
              $('#ADD').attr('disabled',true);
         }
         else
         {
          if(copy>=10)
          {
            $.ajax({
              method:"POST",
              data:"copy="+copy+"&amount="+amount,
              url:"Ajaxaction/discount",
              success:function getstate($msg)
              {
                
                $('#message_discount').html('');
                $('#message_discount').html($msg);
              }
              
              })
              
              $.ajax({
              method:"POST",
              data:"copy="+copy+"&amount="+amount,
              url:"Ajaxaction/amount",
              success:function getstate($msg)
              {
                $('#amount').val('');
                $('#amount').val($msg);
                $('#ADD').removeAttr('disabled');
              }
              
              })
          }
          if(copy<10)
          {
            if(amount==0)
            {
              $('#nocopies').html('');
              $('#nocopies').html('0 Not allowed');
              $('#ADD').attr('disabled',true);
            }
            else
            {
              $('#message_discount').html('');
              $('#message_discount').html("<div class='alert alert-dismissible alert-success'>Total amount is $"+(amount)+"</div>");
              $('#amount').val(amount);
            }
          }
        }
      }
      else
      {
         $('#nocopies').html('');
         $('#nocopies').html('Please Enter number.');
         $('#ADD').attr('disabled',true);
      }
    })
  }
}


  $(document).ready(function(e) {
$("#volunteer_form").validate();
  dp();
  

  $("#addmore").on('click',function(){
      var i=$("#multiday .dat").length;
        $("#copier").clone().appendTo('#multiday').addClass("dyn_added").attr("id","copier"+i);
        var htm=$("#copier"+i).html();
                    htm=htm.replace(/dyn_id/g,i);
        $("#copier"+i).html(htm);
        dp();
    });
    
          $("#multiday").on('click','.removeme',function(){
      $(this).parents(".dyn_added").remove();
      $("#multiday .dat").each(function(index, element) {
$(this).attr('name','day['+index+']');
        $("#multiday .hour").eq(index).attr('name','hour['+index+']');
        $("#multiday .min").eq(index).attr('name','min['+index+']');
        $(this).parents(".dyn_added").attr("id","copier"+index);
});
    });
  
});
function dp()
{
  $('.dat').datepicker();
}
</script>

<script>
 
$(document).ready(function()
{
  $("#optionspayment2").click(function(){
  $('#payment_type_cash').show();
  $('#payment_type_cheque').hide();
  })
  
  $("#optionspayment3").click(function(){
  $('#payment_type_cash').hide();
  $('#payment_type_cheque').show();
  })
  
  $("#optionspayment1").click(function(){
  $('#payment_type_cash').hide();
  $('#payment_type_cheque').hide();
  })
})
</script>
<style>
  #copier{display:none}
</style>
<div id="main-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
       New Order
        </h3>
        <ul class="breadcrumb">
          <li>
            <a href="subscriber_profile/profile">Dashboard</a>
            <span class="divider">/</span>
          </li>
          <li class="active">
            New Order
          </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
      </div>
    </div>
    <!-- END PAGE HEADER-->
    <?php echo validation_errors(); ?>    
    <?php

                  $price  = $this->db->query("SELECT * FROM kr_discount ")->row_array();
                  ?>
                  <style type="text/css">
                     div.radio {
                          margin-right: 30px;
                          width:auto;
                      }
                      .radio input[type="radio"]
                      {
                        margin:0;
                      }

                    div.radio input {
                      opacity:1;
                    }
                    input, textarea, .uneditable-input, select {
                        width: 335px;
                    }
                    .alert-success {
    
    width: 298px;
}
                  </style>

                  <form name="order-form" method="post" action="">
                    <div class="form-group">

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                   <label class="control-label" style="background: #009688;color: #fff; padding: 10px; font-size: 20px; width: 331px;"> Price Per copy : $<?php echo $price['price_cpy'];?> </label>

                  </div>

               </div>

              <div class="form-group">

                <label class="control-label" >Copies Requested</label>

                  <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="text" class="form-control" id="Copies_requested" maxlength="3" name='Copies_requested' value='' onkeyup="getDiscount($(this).val(),'')"  placeholder="Please enter number copies" autocomplete="off">

                  </div>

              </div>

              <span id="nocopies" style="color:#F00;"></span>

              <div class="form-group">

                <label class="control-label" >Select number of month</label>


                <div class="col-md-10 col-lg-offset-1">

                  <select id="request_month" name='Request_month' class="form-control" onchange="getDiscount($('#Copies_requested').val(),$(this).val())">

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

                      <div class="col-lg-10 col-md-10 col-lg-offset-1" id='message_discount' style="margin-top: 15px;">

                      </div>

                  </div>



              <!--<span style="margin-left: 9%;color: #F00;">* $<?php //echo @$price['1_yr_price']; ?> Per Copy</span>-->

               <div class="form-group">

                    <label class="col-lg-4 col-md-2 control-label label-style" style="margin-top:5px;">Mode of Payment </label>

    

                    <div class="col-lg-8 col-md-10" style="display: inline-flex;margin-top: 15px;margin-bottom: 15px;">

                      <div class="radio radio-primary">

                       

                          <input type="radio" name="optionspayment" id="optionspayment1" value="online" <?php echo "checked";?>>

                          Pay online

                     

                      </div>

                      <div class="radio radio-primary">

                        

                          <input type="radio" name="optionspayment" id="optionspayment2" value="Cash" >

                          Cash

                       

                      </div>

                      <div class="radio radio-primary">

                       

                          <input type="radio" name="optionspayment" id="optionspayment3" value="Cheque" >

                          Cheque

                        

                      </div>

                    </div>

                  </div>

                  <div id='payment_type_cash' style="display:none">

                      <div class="form-group">


                            <input type="text"  class="form-control" id="cash_agent_name" name='cash_agent_name'  value="" placeholder=" Please enter the agent name" >


                      </div>

                      <div class="form-group">

                        

                            <input type="text"  class="form-control" id="cash_comments" name='cash_comments' value="" placeholder=" Comments">

                        

                      </div>

                  </div>

                  <div id='payment_type_cheque' style="display:none">

                      <div class="form-group">

                         

                            <input type="text"  class="form-control" id="cheque_agent_name" name='cheque_agent_name' value=""  placeholder=" Please enter the agent name,Cheque number" >

                        

                      </div>

                      <div class="form-group">

                         

                            <input type="text"  class="form-control" id="cheque_comments" name='cheque_comments' value="" placeholder=" Comments">

                        

                      </div>

                  </div>
            <div class="form-group">

                   <div class="col-lg-10 col-md-10 col-lg-offset-1">

                    <input type="submit" class="form-control btn btn-success" name='pbutton' id="ADD" value='SUBMIT' />

                  </div>

              </div>

                  </form>
  
  </div>
  <!-- END PAGE -->
</div>



<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
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

              $('#ADD').removeAttr('disabled');

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

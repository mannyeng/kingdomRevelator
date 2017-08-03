<div class="span12">

					
							
								<form method="post" action="national/dist_payment_update_process">
									<table class="table table-striped table-bordered table-condensed" id="sample_1">

									<tr>
										<td><b>Payment Method</b></td>
										<td><?php echo $paymentdetails['Mode_of_pay'];?><input type="hidden"  name="id" value="<?php echo $paymentdetails['id'];?>"/><input type="hidden"  name="urlids" value="<?php echo $orderid.'#'.$distcode.'#'.$zoneid.'#'.$distid;?>"/></td>
									</tr>
									<tr>
										<td><b>Payment Status</b></td>
										<td><select class="form-control" name="paypal_status">
										<option value="completed" <?php echo ($paymentdetails['paypal_status']=='completed')?'selected':'';?>>Completed</option>	
										<option value="pending" <?php echo ($paymentdetails['paypal_status']=='pending')?'selected':'';?>>Pending</option>
										</select></td>
									</tr>
									<tr>
										<td><b>Paid Amount</b></td>
										<td><input type="text" class="form-control" name="paid_amnt" value="<?php echo $paymentdetails['paid_amnt'];?>"/></td>
									</tr>
									<?php if($paymentdetails['refund_amnt']>0){?>
									<tr>
										<td><b>Refund Amount</b></td>
										<td>$<?php echo $paymentdetails['refund_amnt'];?></td>
									</tr>
									<tr>
										<td><b>Refund Status</b></td>
										<td><?php echo ($paymentdetails['refund_status']=='0')?'Pending':'Completed';?></td>
									</tr>
									<?php }?>
									<tr>
										<td><b>Cheque Number</b></td>
										<td><input type="text" class="form-control" name="cheque_num" value="<?php echo $paymentdetails['cheque_num'];?>"/></td>
									</tr>
									<tr>
										<td><b>Account Number</b></td>
										<td><input type="text" class="form-control" name="acc_num" value="<?php echo $paymentdetails['acc_num'];?>"/></td>
									</tr>
										<tr>
										<td><b>Bank Details</b></td>
										<td><input type="text" class="form-control" name="bank_detail" value="<?php echo $paymentdetails['bank_detail'];?>"/></td>
									</tr>
									<tr>
										<td><b>Payment Accepted Date</b></td>
										<td><input type="text" class="form-control dp" name="date_of_pay" value="<?php echo $paymentdetails['date_of_pay'];?>"/>&nbsp;(yyyy-mm-dd)</td>
									</tr>
									<tr>
										<td><b>Notes</b></td>
										<td><input type="text" class="form-control" name="notes" value="<?php echo $paymentdetails['notes'];?>"/></td>
									</tr>
									</table>
									
									<input name="submit" value="Submit" placeholder="" type="submit" class="btn btn-success"></td>
								</form>
							
					
			
			
		</div>

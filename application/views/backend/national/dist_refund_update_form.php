<div class="span12">

					
							
								<form method="post" action="national/dist_refund_update_process">
									<table class="table table-striped table-bordered table-condensed" id="sample_1">

									
									<tr>
										<td><b>Refund Amount</b></td>
										<td><input type="text" class="form-control" name="refund_amnt" value="<?php echo $paymentdetails['refund_amnt'];?>"/><input type="hidden"  name="id" value="<?php echo $paymentdetails['id'];?>"/><input type="hidden"  name="urlids" value="<?php echo $orderid.'#'.$distcode.'#'.$zoneid.'#'.$distid;?>"/></td>
									</tr>
									<tr>
										<td><b>Refund Status</b></td>
										<td><select class="form-control" name="refund_status">
										<option value="1" <?php echo ($paymentdetails['refund_status']=='1')?'selected':'';?>>Completed</option>	
										<option value="0" <?php echo ($paymentdetails['refund_status']=='0')?'selected':'';?>>Pending</option>
										</select></td>
									</tr>
									
									</table>
									
									<input name="submit" value="Submit" placeholder="" type="submit" class="btn btn-success"></td>
								</form>
							
					
			
			
		</div>

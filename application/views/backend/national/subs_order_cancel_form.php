<div class="span12">

					
							
								<form method="post" action="national/subs_modal_cancel_process">
									<table class="table table-striped table-bordered table-condensed" id="sample_1">

									
									
									<tr>
										<td><b>Order Status</b></td>
										<td><select class="form-control" name="status">
										<option value="0">Cancel</option>
										</select>
                                        <input type="hidden"  name="id" value="<?php echo $orderid;?>"/><input type="hidden"  name="Subscriber_id" value="<?php echo $subsid;?>"/><input type="hidden"  name="urlids" value="<?php echo $orderid.'#'.$subsid.'#'.$distid;?>"/>
										</td>
									</tr>
									
									</table>
									
									<input name="submit" value="Submit" placeholder="" type="submit" class="btn btn-success"></td>
								</form>
							
					
			
			
		</div>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriber_model extends CI_model {

	
    // to insert subscriber order details in cash or cheque model

    public function order_add($data = "")
    {

             $this->db->trans_start();
             $this->db->insert("kr_orders",$data);
             $id = $this->db->insert_id();
             $this->db->trans_complete();

             if ($this->db->trans_status() === FALSE)
				{
					return false;
				}
				else
				{
                    return $id;
				}
         

    }



    // insert payment table

     public function payment_add($data = "")
    {
           $this->db->trans_start();
             $this->db->insert("kr_payment",$data);
             $id = $this->db->insert_id();
             $this->db->trans_complete();

             if ($this->db->trans_status() === FALSE)
				{
					return false;
				}
				else
				{
                    return $id;
				}
    }
// update order details on order edit
  public function order_update($data = "")
    {

             $this->db->trans_start();
            $param = array(
              'subscription_length' => $data['subscription_length'],
              'No_of_copies' => $data['No_of_copies'],
              'expiry_date' => $data['expiry_date'],
              'Cash_Check_by' => $data['Cash_Check_by'],
              'comments' => $data['comments'],
              'updated_date' => $data['updated_date']
              );

			$this->db->where('id', $data['order_id']);
			$this->db->where('Subscriber_id', $data['Subscriber_id']);
			$this->db->update('kr_orders', $param);
			$this->db->trans_complete();
             if ($this->db->trans_status() === FALSE)
				{
					return false;
				}
				else
				{
                    return true;
				}
         

    }
// update payment details after success
  public function payment_update($data = "")
    {

             $this->db->trans_start();
            $param = array(
              'txn_id' => $data['txn_id'],
              'paid_amnt' => $data['paid_amnt'],
              'payer_email' => $data['payer_email'],
              'paypal_status' => $data['paypal_status']
             
              );

			$this->db->where('id', $data['id']);
			$this->db->update('kr_payment', $param);
			$this->db->trans_complete();
             if ($this->db->trans_status() === FALSE)
				{
					return false;
				}
				else
				{
                    return true;
				}
         

    }

    // update payment details from admin for cash/cheque
  public function payment_update_process($data = "")
    {

             $this->db->trans_start();
            $param = array(
              'paypal_status' => $data['paypal_status'],
              'paid_amnt' => $data['paid_amnt'],
              'cheque_num' => $data['cheque_num'],
              'acc_num' => $data['acc_num'],
              'bank_detail' =>$data['bank_detail'],
              'date_of_pay' => $data['date_of_pay'],
              'notes' => $data['notes'] 
             
              );

      $this->db->where('id', $data['id']);
      $this->db->update('kr_payment', $param);
      $this->db->trans_complete();
             if ($this->db->trans_status() === FALSE)
        {
          return false;
        }
        else
        {
                    return true;
        }
         

    }

     // update payment details from admin for cash/cheque
  public function refund_update_process($data = "")
    {

             $this->db->trans_start();
            $param = array(
              'refund_status' => $data['refund_status'],
              'refund_amnt' => $data['refund_amnt'],
              'refund_date' => date('Y-m-d')
             
              );

      $this->db->where('id', $data['id']);
      $this->db->update('kr_payment', $param);
      $this->db->trans_complete();
             if ($this->db->trans_status() === FALSE)
        {
          return false;
        }
        else
        {
                    return true;
        }
         

    }

  // to get all orders
    public function orders_get($id)
    {
        //echo $id;
       $resp =  $this->db->query("SELECT o.id,o.Subscriber_id,o.subscription_length,o.No_of_copies,o.Cash_Check_by,o.comments,o.subscription_date,o.expiry_date FROM `kr_orders` o where o.Subscriber_id=$id order by o.id DESC")->result_array();
      // echo $this->db->last_query();
     return $resp;
    }
// to get detail order
    public function order_details($orderid,$id)
    {
       //echo $orderid;
       $resp =  $this->db->query("SELECT o.id,o.subscription_length,o.No_of_copies,o.Cash_Check_by,p.paypal_status,o.comments,o.subscription_date,o.expiry_date,o.status,SUM(CASE WHEN p.paypal_status='completed' THEN p.paid_amnt ELSE 0 END) totamnt,SUM(CASE WHEN p.refund_status = '1' THEN p.refund_amnt ELSE 0 END) refundamnt FROM `kr_orders` o left join kr_payment p on(o.id=p.order_id) where o.Subscriber_id=$id and p.Subscriber_id=$id and sha1(o.id) ='".$orderid."' group by p.order_id")->row_array();
       //echo $this->db->last_query();
     return $resp;

    }

   // get payment details
    public function payment_details($paymentid)
    {

      $resp =  $this->db->query("SELECT * FROM `kr_payment`  where id=$paymentid")->row_array();
      // echo $this->db->last_query();
     return $resp;
    }



    public function order_status($orderid)
    {

       $res = $this->db->select('status')->get_where("kr_orders",array('id'=>$orderid))->row()->status;
     return $res;
    }

    /** calculat refund */
    public function get_refund($copy,$amount,$orderid)
    {
       
        /** to calculate current amount paid - amount of latest completed order, no refund*/
        $resp = $this->db->query("SELECT o.*, p.paid_amnt FROM `kr_payment` p left join kr_orders o on (o.id=p.order_id) where p.id=(select max(id) from kr_payment where paypal_status='completed' and sha1(order_id)='".$orderid."') and o.status=1 ")->row_array();
        //echo $this->db->last_query();
//pr($resp);
        $old_amount = round($resp['paid_amnt'],2);

        // calculating the new amount based on the changed value
        $new_amount = round($this->paymentcalc->amount($copy,$amount),2);
        
        $cur = date('Y-m-d');
        $datetime1 = new DateTime($resp['expiry_date']);
        $datetime2 = new DateTime($resp['subscription_date']);
        $datetime3 = new DateTime($cur);
        $substart = $datetime3->diff($datetime1);
        
               
      
        if($substart->format('%R%a') >=30)
        {
            if($new_amount < $old_amount)
            { // refund eligible


            	// calculating how many books already issued if the subscription already start
                // checking already subscription started
                $substartstaus = $datetime3->diff($datetime2);
                // total amount for used copies
                $price_for_used = 0;
		        if($substartstaus->format('%R%a') < 0)
		        {
		        	// subscription started
		        	// find next month from current date
		        	$nxtmnth = date('Y-m-d', strtotime('first day of next month'));
		        	$datetime4 = new DateTime($nxtmnth);
		            // total difference in month between subscription start and current date : neeed to reduce this amount while refunding
		            $newdifference = $datetime4->diff($datetime2)->m;
                
                // To get price of one book based on the old order duration

                $price = $this->db->get('kr_book_price')->row_array();
                if($resp['subscription_length'] == '12')
                {
                  $price_per_copy = ($price['1_yr_price']/12);
                }
                if($resp['subscription_length'] == '24')
                {
                  $price_per_copy = ($price['1_yr_price']/24);
                }
		            
		            $price_for_used  = ($newdifference*$price_per_copy);
		            
		        }

            	$refund = ($old_amount-$new_amount-$price_for_used);
            	return ('refund#'.$refund.'#'.$old_amount);
            	//refund#refund amount#previous amount
            }
            else
            {

                
            	$extra = ($new_amount - $old_amount);
            	return ('extra#'.$extra.'#'.$old_amount);
            	//extra#extra amount#previous amount
            }
        }
        else
        {
        	return ('normal#'.$new_amount);
        	//normal#extra amount#previous amount
        }

    }



    public function subscription_status($orderid)
    {

       $dte = $this->db->select('expiry_date,subscription_date')->get_where("kr_orders",array('id'=>$orderid,'status'=>'1'))->row_array();
       $cur = date('Y-m-d');
       
       
       $datetime1 = new DateTime($dte['expiry_date']);
       $datetime2 = new DateTime($dte['subscription_date']);
       $datetime3 = new DateTime($cur);
       
       $substart = $datetime3->diff($datetime2);
       //echo $orderid.' * '.$substart->format('%R%a').'<br>';
       if($substart->format('%R%a') <= 0)
       {

            $interval = $datetime3->diff($datetime1);
           
       }

       else
       {
       
           
           $interval = $datetime2->diff($datetime1);


       }

     
      
       if($interval->format('%R%a') <= 0)
       {
       	return '<b style="color:red;">Expired</b>';
       }

       else
       {
           
       	$x = '<b>'.$interval->format('%a days').'</b>';
return $x;
       }
     
    }

    public function expire_status($orderid)
    {

       $dte = $this->db->select('expiry_date,subscription_date')->get_where("kr_orders",array('id'=>$orderid,'status'=>'1'))->row_array();
       $cur = date('Y-m-d');
       
       
       $datetime1 = new DateTime($dte['expiry_date']);
       $datetime2 = new DateTime($dte['subscription_date']);
       $datetime3 = new DateTime($cur);
       
       $substart = $datetime3->diff($datetime2);
       //echo $orderid.' * '.$substart->format('%R%a').'<br>';
       if($substart->format('%R%a') <= 0)
       {

            $interval = $datetime3->diff($datetime1);
           
       }

       else
       {
       
           
           $interval = $datetime2->diff($datetime1);


       }

     
      
       if($interval->format('%R%a') <= 0)
       {
       	// expired
       	return '0';
       }

       else
       {
           //active
       	
      return '1';
       }
     
    }

    // function to save order history

    public function save_history($orderid)
    {
   
       $data =  $this->db->query("SELECT o.id order_id,o.No_of_copies,o.subscription_length,o.subscription_date,o.expiry_date,o.created_date order_date,p.Mode_of_pay FROM `kr_orders` o left join kr_payment p on (p.order_id = o.id) where p.id = (select max(id) from kr_payment where order_id=$orderid) and o.id=$orderid")->row_array(); 
 
       $this->db->trans_start();
             $this->db->insert("kr_order_history",$data);
              $this->db->trans_complete();

             if ($this->db->trans_status() === FALSE)
        {
          return false;
        }
        else
        {
                    return true;
        }

    }

    // order history list
    public function order_history($orderid)
    {
   
       $data =  $this->db->query("SELECT * FROM kr_order_history where sha1(order_id)='".$orderid."' order by id DESC")->result_array(); 
 
       return $data;

    }

    // cancel order of subscriber
    public function order_cancel_process($data)
    {

        $this->db->trans_start();
            $param = array(
              'status' => $data['status']
             
              );

      $this->db->where('id', $data['id']);
      $this->db->where('Subscriber_id', $data['Subscriber_id']);
      $this->db->update('kr_orders', $param);
      $this->db->trans_complete();
             if ($this->db->trans_status() === FALSE)
        {
          return false;
        }
        else
        {
                    return true;
        }

    }


    /// to check he has any valid subscription with orderid

    public function validate_subscription($orderid)
    {

      $dte = $this->db->select('expiry_date,subscription_date')->get_where("kr_orders",array('id'=>$orderid,'status'=>'1'))->row_array();

      if(count($dte)>0)
      {

       $cur = date('Y-m-d');
       $datetime1 = new DateTime($dte['expiry_date']);
       $datetime2 = new DateTime($dte['subscription_date']);
       $datetime3 = new DateTime($cur);
       
       $substart = $datetime3->diff($datetime2);
       //echo $orderid.' * '.$substart->format('%R%a').'<br>';
       if($substart->format('%R%a') <= 0)
       {

            $interval = $datetime3->diff($datetime1);
           
       }

       else
       {
       
           
           $interval = $datetime2->diff($datetime1);


       }

     
      
       if($interval->format('%R%a') <= 0)
       {
        // expired
        return 'expired';
       }

       else
       {
           //active
          $resp =  $this->db->query("SELECT paypal_status from kr_payment where id = (select max(id) from kr_payment where order_id=$orderid) and order_id=".$orderid)->row()->paypal_status;
          //pr($resp);
        //echo $this->db->last_query();
          //echo $orderid.'-'.$resp.'<br>';

          
     return $resp;  
            
       }
     }
     else
     {
        
        return 'cancelled';

     }
            
    }

	
}

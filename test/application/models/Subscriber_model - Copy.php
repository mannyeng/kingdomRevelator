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

    // update payment table

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
                    return true;
				}
    }
  // to get all orders
    public function orders_get($id)
    {
        //echo $id;
       $resp =  $this->db->query("SELECT o.id,o.subscription_length,o.No_of_copies,o.Cash_Check_by,o.comments,o.subscription_date,o.expiry_date FROM `kr_orders` o where o.Subscriber_id=$id order by o.id DESC")->result_array();
      // echo $this->db->last_query();
     return $resp;
    }
// to get detail order
    public function order_details($orderid,$id)
    {
       
       $resp =  $this->db->query("SELECT o.id,o.subscription_length,o.No_of_copies,o.Cash_Check_by,o.comments,o.subscription_date,o.expiry_date,SUM(p.paid_amnt) totamnt,SUM(p.refund_amnt) refundamnt FROM `kr_orders` o left join kr_payment p on(o.id=p.order_id) where o.Subscriber_id=$id and p.Subscriber_id=$id and sha1(o.id) ='".$orderid."' and o.status = 1  group by p.order_id")->row_array();
      // echo $this->db->last_query();
     return $resp;

    }

    public function order_status($orderid)
    {

       $res = $this->db->select('status')->get_where("kr_orders",array('id'=>$orderid))->row()->status;
     return $res;
    }

    public function subscription_status($orderid)
    {

       $dte = $this->db->select('expiry_date,subscription_date')->get_where("kr_orders",array('id'=>$orderid))->row_array();
       $cur = date('Y-m-d');
       
       
       $datetime1 = new DateTime($dte['expiry_date']);
       $datetime2 = new DateTime($dte['subscription_date']);
       $datetime3 = new DateTime($cur);
       
       $substart = $datetime3->diff($datetime2);
       //echo $orderid.' * '.$substart->format('%R%a').'<br>';
       if($substart->format('%R%a') <= 0)
       {

            $interval = $datetime3->diff($datetime1);
            echo $orderid.' * '.$interval->format('%R%a').'<br>';
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
           
       	$x = '<b style="color:green;">Active</b> ('.$interval->format('%a days').')';
return $x;
       }
     
    }

	
}

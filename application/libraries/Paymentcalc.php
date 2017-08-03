<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Paymentcalc {

   	public function amount($copy,$amount)

	{
        $CI =& get_instance();
		$msg = '';
       // echo $copy.'-'.$amount;
		if($copy !="" && $amount !="")

		{

			

			$total   = $amount;

			$res     = $CI->db->query("SELECT * FROM kr_discount");

			$State   = $res->row_array();

			//print_r($State);

			if($copy>=30)

			{

				$per_discount = $State['above30'];

				$discount     = ($State['above30']/100)*$total;

				$msg          = $total-$discount;

			}

			elseif($copy>=20)

			{

				$per_discount = $State['above20'];

				$discount 	  = ($State['above20']/100)*$total;

				$msg          = $total-$discount;

			}

			elseif($copy>=10)

			{

				$per_discount = $State['above10'];

				$discount     = ($State['above10']/100)*$total; 

				$msg          = $total-$discount;

			}

			else
			{

				$msg          = $total;
			}

			return round($msg,2);

		}

		

	}
}

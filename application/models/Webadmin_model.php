<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webadmin_model extends CI_model {
	
	
	public function get_by_type($type)
	{
		$this->db->join('kr_distributers', 'kr_distributers.id = kr_users.Distributer_id','Inner');
	$this->db->select('kr_users.id as user_id,kr_users.National_admin_id,kr_users.Zonal_admin_id,kr_users.State_admin_id,kr_users.State_zone_admin_id,kr_users.admin_type,kr_distributers.*');
	$result = $this->db->get_where('kr_users',array('kr_users.admin_type'=>$type))->result_array();	
	return $result;
	 	}
		
		
    public function filter_details($inputs='')
	{	
	
	if(!empty($inputs)):
	if(isset($inputs['national']) && $inputs['national'] != '')
	$this->db->where('National_admin_id',$inputs['national']);
	if(isset($inputs['zone']) && $inputs['zone'] != '')
	$this->db->where('Zonal_admin_id',$inputs['zone']);
	if(isset($inputs['state']) && $inputs['state'] !="")
	$this->db->where('State_admin_id',$inputs['state']);
	if(isset($inputs['state_zone']) && $inputs['state_zone'] !="")
	{
		$this->db->where('State_zone_admin_id',$inputs['state_zone']);  
		$this->db->where('Distributer_id','');  
	}
	if(isset($inputs['county']) && $inputs['county'] !="")
	$this->db->where('County_admin_id',$inputs['county']);
	/*if($inputs['distributer'] !="")
	$this->db->where('id',$inputs['distributer']);*/
	endif;
	if(isset($inputs['state_zone']) && $inputs['state_zone'] !="")
	{
		$this->db->join('kr_distributers', 'kr_distributers.User_id = kr_users.id','Inner');
		$this->db->select('kr_users.id as user_id,kr_users.National_admin_id,kr_users.Zonal_admin_id,kr_users.State_admin_id,kr_users.State_zone_admin_id,kr_users.admin_type,kr_distributers.*');
		$result = $this->db->get('kr_users')->result_array();
		//echo $this->db->last_query();	
		return $result;
	}
	$this->db->join('kr_distributers', 'kr_distributers.id = kr_users.Distributer_id','Inner');
	$this->db->select('kr_users.id as user_id,kr_users.National_admin_id,kr_users.Zonal_admin_id,kr_users.State_admin_id,kr_users.State_zone_admin_id,kr_users.admin_type,kr_distributers.*');
	$result = $this->db->get('kr_users')->result_array();
	//echo $this->db->last_query();	
	return $result;
	 	}
	
	
	
	}

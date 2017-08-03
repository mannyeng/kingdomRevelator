<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class User_model extends CI_model {

	

	

	public function get_states()

	{

    $res = $this->db->get('kr_state')->result_array();

	return $res;

	}

	public function get_user_by_type($type)

	{

	   $this->db->select('kr_users.id as user_id,kr_distributers.*');

	   $this->db->join('kr_distributers','kr_distributers.id=kr_users.Distributer_id','Inner');

       $res = $this->db->get_where('kr_users',array('admin_type'=>$type,"flag='0'"))->result_array();

	return $res;

	}

	

	public function create($inputs)

	{

		

		$this->db->insert('kr_users', $inputs);

		if($this->db->insert_id())

		return true;

		else

		return false;

		

		}

	public function update($inputs,$edit_id,$type)

	{


/*print_r($inputs);
exit();*/
	    $this->db->where(array('id'=>$edit_id,'admin_type'=>$type));

		$this->db->update('kr_users', $inputs);



		//$this->db->update('kr_distributers', $inputs);	

		return true;

		}

	public function duplicate($email,$roll,$id='')// to chech duplicate email base don role

	{

		

		if($id != '')

		$this->db->where('id !=',$id);

		$res = $this->db->select('id')->get_where('kr_users',array('Email_address'=>$email,'admin_type'=>$roll))->row_array();

		

		if($res)

		return false;

		else

		return true;

		

		}

	public function get_permission($role,$action='')

	{

		if($action != '')

		$this->db->select($action);

		$res = $this->db->get_where('kr_permissions',array('type'=>$role))->row_array();

		

		if($res) {

		  if($action != '')

		   return $res[$action];

		  else

		  return $res;

		}

		else

		return false;

		

		}

		public function get_details($id)

		{

			

			if($this->session->userdata('role')=='webadmin')

			{

				$res = $this->db->get_where('kr_users',array('kr_users.admin_type'=>'webadmin'))->row_array();

			}

			else

			{

				 $this->db->select('kr_distributers.*');

				 $this->db->select('kr_users.Email_address as Email');

				 $this->db->select('kr_users.Password');

				 

				$this->db->join('kr_distributers','kr_distributers.id=kr_users.Distributer_id','inner join');

				$res = $this->db->get_where('kr_users',array('kr_users.id'=>$id))->row_array();

			}

			

			if($res)

			return $res;

			else

			return false;

			

		}	

		

		

	

}


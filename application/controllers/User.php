
<?php

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */
	
	 public function __construct() {
     parent::__construct();
       	
		$this->load->model('user_model','user');
        if ( $this->session->userdata('role') == '')
		   {
            redirect( '', 'refresh' );
           }
		
        }	
        public function no_script()
   {
	  echo '<div style="width:100%;text-align:center;">Please enable javascript in your browser.</div>'; exit;
	   }
	public function index()
	{
		
	     $data['title'] = 'Create User';
         $data['menu']  = '';
         $data['content'] = 'backend/user/home';
		 $data['permissions'] = $this->user->get_permission($this->session->userdata('role'));
		 $this->load->view( 'backend/template', $data );	
	}
	
	public function get_state(){
		
		$id = $this->input->post('id');
		$results=$this->db->query("SELECT * FROM kr_users WHERE  Zonal_admin_id='$id' and admin_type='state'")->result_array();
		//echo $this->db->last_query();
		
		if(!empty($results))
		{
			//echo '<option value="">All</option>';
			echo '<option value="">Select  State co-ordinators</option>';
			foreach($results as $result)
			{
				echo '<option value="'.$result['Name'].'">'.$result['Name'].'</option>';				
			}			
		}
		else
		{
			echo '<option value="">NO States</option>';	
		}
		
	}
	
	public function get_national(){
		
		$id = $this->input->post('id');
		$results=$this->db->query("SELECT kr_users.id as userid,kr_distributers.* FROM kr_users inner join kr_distributers on (kr_distributers.id= kr_users.Distributer_id) WHERE  kr_distributers.State='$id' and admin_type='national'")->result_array();
		//echo $this->db->last_query();
		
		if(!empty($results))
		{
			echo '<option value="">Select  National co-ordinators</option>';
			foreach($results as $result)
			{
				echo '<option value="'.$result['userid'].'">'.$result['First_name'].'</option>';				
			}			
		}
		else
		{
			echo '<option value="">NO National co-ordinators</option>';	
		}
		
	}
	
	
	public function get_zone(){
		
		$id = $this->input->post('id');
		$results=$this->db->query("SELECT * FROM kr_users  WHERE  National_admin_id='$id' and admin_type='zone'")->result_array();
		//echo $this->db->last_query();
		
		if(!empty($results))
		{
			echo '<option value="">Select  zone co-ordinators</option>';
			foreach($results as $result)
			{
				echo '<option value="'.$result['id'].'">'.$result['Name'].'</option>';				
			}			
		}
		else
		{
			echo '<option value="">NO zone co-ordinators</option>';	
		}
		
	  }


	
	public function get_by_type1(){
		
		$id = $this->input->post('id');
		$results=$this->db->query("SELECT DISTINCT(b.id),b.* FROM kr_distributers b left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE b.id not in (select Distributer_id from kr_users) and State='$id'")->result_array();
		//echo $this->db->last_query();
		
		if(!empty($results))
		{
			//print_r($results);
			//echo '<option value="">All</option>';
			echo '<option vlaue="">Select Bulk Subscriber</option>'; 
			foreach($results as $result)
			{
				echo '<option value="'.$result['id'].'">'.$result['First_name'].'</option>';				
			}			
		}
		else
		{
			echo '<option value="">NO Bulk Subscriber</option>';	
		}
		
	}
	
	public function get_by_type1_update(){
		
		$id = $this->input->post('id');
		$url = $this->input->post('url');
		$results=$this->db->query("SELECT DISTINCT(b.id),b.* FROM kr_distributers b left join kr_dis_payment c on b.disributer_id=c.Subscriber_id WHERE b.id not in (select Distributer_id from kr_users where id!='$url') and State='$id'")->result_array();
		//echo $this->db->last_query();
		
		if(!empty($results))
		{
			echo '<option value="">Select Bulk Subscriber</option>';
			foreach($results as $result)
			{
				echo '<option value="'.$result['id'].'">'.$result['First_name'].'</option>';				
			}			
		}
		else
		{
			echo '<option value="">NO Bulk Subscriber</option>';	
		}
		
	}
	
	
	/* creating national coordinator */
	public function create_national()
	{
		 if($this->user->get_permission($this->session->userdata('role'),'create_national') == 0)
		 redirect('user','refresh');
		 $data['title'] = 'Create National';
         $data['menu']  = '';
         $data['content'] = 'backend/user/create_national';
		 
		 if($this->input->post())
		 {
			 $inputs = $this->input->post(NULL,TRUE); 
			 $formtype = $inputs['formtype'];
			 $edit_id = $inputs['edit_id'];
			 
			  unset($inputs['formtype']);
			  unset($inputs['edit_id']);
			  unset($inputs['ci_csrf_token']);
			 
			 if($formtype == 'Add')
			 {
				 $inputs['admin_type'] = 'national';
				 
				 if($this->user->duplicate($inputs['Email_address'],'national')== true){
				 $res = $this->user->create($inputs);
				
				 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly added');
					$this->mail_send($inputs['Email_address'],'National Coordinator',$inputs['Password'],'new'); 
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'error');
				 }
				 else
				 $this->session->set_flashdata('flash_message', 'Email already exists');
				 
				 }
				 else
				 {
					 if($this->user->duplicate($inputs['Email_address'],'national',$edit_id)== true){
					 $res = $this->user->update($inputs,$edit_id,'national'); 
					 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],'National Coordinator',$inputs['Password'],'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Email already exists');
				 }
			
		 }
		 
		 $data['state'] = $this->user->get_states();
         $this->load->view( 'backend/template', $data );
		}
	
	/* creating national coordinator */
	public function create_finance()
	{
		 if($this->user->get_permission($this->session->userdata('role'),'create_finance') == 0)
		 redirect('user','refresh');
		 $data['title'] = 'Create Finance';
         $data['menu']  = '';
         $data['content'] = 'backend/user/create_finance';
		 
		 if($this->input->post())
		 {
			 $inputs = $this->input->post(NULL,TRUE); 
			 $formtype = $inputs['formtype'];
			 $edit_id = $inputs['edit_id'];
			 
			  unset($inputs['formtype']);
			  unset($inputs['edit_id']);
			  unset($inputs['ci_csrf_token']);
			 
			 if($formtype == 'Add')
			 {
				 $inputs['admin_type'] = 'finance';
				 
				 if($this->user->duplicate($inputs['Email_address'],'finance')== true){
				 $res = $this->user->create($inputs);
				
				 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly added');
					$this->mail_send($inputs['Email_address'],'Finance Coordinator',$inputs['Password'],'new'); 
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'error');
				 }
				 else
				 $this->session->set_flashdata('flash_message', 'Email already exists');
				 
				 }
				 else
				 {
					 if($this->user->duplicate($inputs['Email_address'],'finance',$edit_id)== true){
					 $res = $this->user->update($inputs,$edit_id,'finance'); 
					 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],'Finance Coordinator',$inputs['Password'],'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Email already exists');
				 }
			
		 }
		 
		 $data['state'] = $this->user->get_states();
		 $data['national'] = $this->user->get_user_by_type('national');
         $this->load->view( 'backend/template', $data );
		}
	
	/* creating zone and zone admin */
	public function create_zone()
	{ 
	
	    if($this->user->get_permission($this->session->userdata('role'),'create_zone') == 0)
		 redirect('user','refresh');
		 
		 $data['title'] = 'Create Zone';
         $data['menu']  = '';
         $data['content'] = 'backend/user/create_zone';
		
		 if($this->input->post())
		 {
			 $inputs = $this->input->post(NULL,TRUE); 
			 $formtype = $inputs['formtype'];
			 $edit_id = $inputs['edit_id'];
			 
			  unset($inputs['formtype']);
			  unset($inputs['edit_id']);
			  unset($inputs['ci_csrf_token']);
			 
			 if($formtype == 'Add')
			 {
				 $inputs['admin_type'] = 'zone';
				 
				 if($this->user->duplicate($inputs['Email_address'],'zone')== true){
				 $res = $this->user->create($inputs);
				
				 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly added');
					$this->mail_send($inputs['Email_address'],'Zonal Coordinator',$inputs['Password'],'new'); 
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'error');
				 }
				 else
				 $this->session->set_flashdata('flash_message', 'Email already exists');
				 
				 }
				 else
				 {
					 if($this->user->duplicate($inputs['Email_address'],'zone',$edit_id)== true){
					 $res = $this->user->update($inputs,$edit_id,'zone'); 
					 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],'Zonal Coordinator',$inputs['Password'],'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Email already exists');
				 }
			
		 }
		 
		 $data['state'] = $this->user->get_states();
		 $data['national'] = $this->user->get_user_by_type('national');
         $this->load->view( 'backend/template', $data );
		}
		
		
	/* creating state co ordinator */
	public function create_state()
	{ 
	 
	     if($this->user->get_permission($this->session->userdata('role'),'create_state') == 0)
		 redirect('user','refresh');
		 
		 $data['title'] = 'Create State';
         $data['menu']  = '';
         $data['content'] = 'backend/user/create_state';
		
		 if($this->input->post())
		 {
			 $inputs = $this->input->post(NULL,TRUE); 
			 $formtype = $inputs['formtype'];
			 $edit_id = $inputs['edit_id'];
			  unset($inputs['formtype']);
			  unset($inputs['edit_id']);
			  unset($inputs['ci_csrf_token']);
			 
			 if($formtype == 'Add')
			 {
				 $inputs['admin_type'] = 'state';
				 
				 if($this->user->duplicate($inputs['Email_address'],'state')== true){
					 
				 $res = $this->user->create($inputs);
				
				 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly added');
					$this->mail_send($inputs['Email_address'],'State Coordinator',$inputs['Password'],'new'); 
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'error');
				 }
				 else
				 $this->session->set_flashdata('flash_message', 'Email already exists');
				 
				 }
				 else
				 {
					 if($this->user->duplicate($inputs['Email_address'],'state',$edit_id)== true){
					 $res = $this->user->update($inputs,$edit_id,'state'); 
					 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],'State Coordinator',$inputs['Password'],'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Email already exists');
				 }
			
		 }
		 
		 $data['state'] = $this->user->get_states();
		 if($this->session->userdata('role')=='webadmin')
		 {
		 $data['national']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.admin_type='national' and a.flag='0'")->result_array();
		 $data['zone']  = $this->db->query("select  a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.admin_type='zone' and a.flag='0'")->result_array();
		 }		 
		 elseif($this->session->userdata('role')=='national')
		 {
			 $data['national'] = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id=".$this->session->userdata('id')." and a.admin_type='national' and a.flag='0'")->row_array();
			 $data['zone']  = $this->db->query("select  a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id where a.National_admin_id=".$this->session->userdata('id')." and a.admin_type='zone' and a.flag='0'")->result_array();
			
		 }
		 elseif($this->session->userdata('role')=='zone')
		 {
			
			 $data['national'] = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id = ".$this->session->userdata('National_admin_id')." and a.admin_type='national' and a.flag='0'")->row_array();
			 $data['zone']  = $this->db->query("select  a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id=".$this->session->userdata('id')." and a.admin_type='zone' and a.flag='0'")->row_array();
			
		 }
		
         $this->load->view( 'backend/template', $data );
		}	
		
	public function profile()
	{
		//print_r($this->session->userdata());
		 $id = $this->session->userdata('id');
		 $data['title'] = 'User Profile';
         $data['menu']  = '';
         $data['content'] = 'backend/user/profile';
		 
		 if($this->input->post())
		 {
			 $inputs = $this->input->post(NULL,TRUE); 
			  unset($inputs['ci_csrf_token']);
			  if($this->session->userdata('role')=="webadmin")
			  {
				  $password = $inputs['Password'];
					$dist_id  = $inputs['dist_id'];
					$security_a  = $inputs['security_a'];
				     unset($inputs['Password']);
					 unset($inputs['dist_id']);
					 $res = $this->user->update($inputs,$dist_id); 
					 $this->db->where('admin_type','webadmin');
					 $this->db->update('kr_users',array('Email_address'=>$inputs['Email_address'],'Password'=>$password,'security_a'=>$security_a));
					 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],'Web admin',$password,'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
			  }
			  else
			  {
			 if($this->user->duplicate($inputs['Email_address'],$this->session->userdata('role'),$this->session->userdata('id'))== true){
				    
					$password = $inputs['Password'];
					$dist_id  = $inputs['dist_id'];
				     unset($inputs['Password']);
					 unset($inputs['dist_id']);
					// $res = $this->user->update($inputs,$dist_id,$this->session->userdata('role')); 
					 $this->db->where('id', $this->session->userdata('id'));
					 $res=$this->db->update('kr_users',array('Email_address'=>$inputs['Email_address'],'Password'=>$password));
					 if($res == true){
					$role_type=ucfirst($this->session->userdata('role')).' Coordinator ';
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],$role_type,$password,'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Email already exists');
			 
		 		}
		   }
		 
		 $data['state'] = $this->user->get_states();
		 $data['user'] = $this->user->get_details($id);
		 $this->load->view( 'backend/template', $data );
		
		}	
		
		/* creating state zone co ordinator */
	public function create_state_zone()
	{ 
	 
	     if($this->user->get_permission($this->session->userdata('role'),'create_state_zone') == 0)
		 redirect('user','refresh');
		 
		 $data['title'] = 'Create State Zone';
         $data['menu']  = '';
         $data['content'] = 'backend/user/create_state_zone';
		
		 if($this->input->post())
		 {
			 $inputs = $this->input->post(NULL,TRUE); 
			 $formtype = $inputs['formtype'];
			 $edit_id = $inputs['edit_id'];
			 
			  unset($inputs['formtype']);
			  unset($inputs['edit_id']);
			  unset($inputs['ci_csrf_token']);
			 
			 if($formtype == 'Add')
			 {
				 $inputs['admin_type'] = 'state_zone';
				 if(($this->session->userdata('role') == 'national') || ($this->session->userdata('role') == 'webadmin') || ($this->session->userdata('role') == 'zone') ) {
				 $state_cord = $this->db->query("SELECT id FROM kr_users WHERE Name='".$inputs['State_admin_id']."'")->row_array();
				 $inputs['State_admin_id'] = $state_cord['id'] ;
				}
				 if($this->user->duplicate($inputs['Email_address'],'state_zone')== true){
				 $res = $this->user->create($inputs);
				
				 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly added');
					$this->mail_send($inputs['Email_address'],'State Zone Coordinator',$inputs['Password'],'new'); 
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'error');
				 }
				 else
				 $this->session->set_flashdata('flash_message', 'Email already exists');
				 
				 }
				 else
				 {
					
					 if($this->user->duplicate($inputs['Email_address'],'state_zone',$edit_id)== true){
					 $res = $this->user->update($inputs,$edit_id,'state_zone'); 
					 if($res == true){
					
					$this->session->set_flashdata('flash_message', 'Successfuly updated');
					$this->mail_send($inputs['Email_address'],'State Zone Coordinator',$inputs['Password'],'edit');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Not updated');
					 }
					 else
					 $this->session->set_flashdata('flash_message', 'Email already exists');
				 }
			
		 }
		 
		 $data['state1'] = $this->user->get_states();
		 
		 if($this->session->userdata('role')=='webadmin')
		 {
		 $data['national']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.admin_type='national' and a.flag='0'")->result_array();
		 $data['zone']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.admin_type='zone' and a.flag='0'")->result_array();
		 $data['state']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.admin_type='state' and a.flag='0'")->result_array();
		 
		 }		 
		 elseif($this->session->userdata('role')=='national')
		 {
			 $data['national'] = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id=".$this->session->userdata('id')." and a.admin_type='national' and a.flag='0'")->row_array();
			 $data['zone']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.National_admin_id=".$this->session->userdata('id')." and a.admin_type='zone' and a.flag='0'")->result_array();
			 $data['state']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.National_admin_id=".$this->session->userdata('id')." and a.admin_type='state' and a.flag='0'")->result_array();
			
		 }
		 elseif($this->session->userdata('role')=='zone')
		 {
			
			 $data['national'] = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id = ".$this->session->userdata('National_admin_id')." and a.admin_type='national' and a.flag='0'")->row_array();
			 $data['zone']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id=".$this->session->userdata('id')." and a.admin_type='zone' and a.flag='0'")->row_array();
			 $data['state']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.Zonal_admin_id=".$this->session->userdata('id')." and a.admin_type='state' and a.flag='0'")->result_array();
			
		 }
		 elseif($this->session->userdata('role')=='state')
		 {
			
			 $data['national'] = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id = ".$this->session->userdata('National_admin_id')." and a.admin_type='national' and a.flag='0'")->row_array();
			 $data['zone']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id=".$this->session->userdata('Zonal_admin_id')." and a.admin_type='zone' and a.flag='0'")->row_array();
			 $data['state']  = $this->db->query("select a.*,b.First_name  from kr_users a inner join kr_distributers b on a.Distributer_id=b.id  where a.id=".$this->session->userdata('id')." and a.admin_type='state' and a.flag='0'")->row_array();
			
		 }
		
         $this->load->view( 'backend/template', $data );
		}
		
		
	
	   /* get ajax function*/
	
	    public function get_by_type($field,$value,$type){
		$results=$this->db->query("select id,First_name from kr_users where flag='0' and $field=$value and admin_type='$type'")->result_array();
		
		if(!empty($results))
		{
			echo '<option value="">Select</option>';
			foreach($results as $result)
			{
				echo '<option value="'.$result['id'].'">'.$result['First_name'].'</option>';				
			}			
		}
		else
		{
			echo '<option value="">Select</option>';	
		}
		
	}
		
	/* to send email to user when roll assigned*/	
	public function mail_send($mail_id,$roll,$Password,$type)
	{
		$smtp = $this->db->select('from_email,from_name,host,port,username,password,notify_email')->get('smtp_config')->row_array();
		
		$type1 =$this->session->userdata('role');

		$config['protocol']  = 'smtp';
		$config['charset']   = 'iso-8859-1';
		$config['smtp_host'] = $smtp['host'];
		$config['smtp_user'] = $smtp['username'];
		$config['smtp_pass'] = $smtp['password'];
		$config['smtp_port'] = $smtp['port'];
		$config['mailtype']  = 'html';
		
		@$this->load->library('email');
		@$this->email->initialize($config);

		$this->email->from($smtp['from_email'], $smtp['from_name']);
		$this->email->to($mail_id);
		$this->email->bcc($smtp['notify_email']);
		
		$this->db->select('kr_distributers.First_name');
		$this->db->join('kr_users','kr_users.Distributer_id=kr_distributers.id');
		$member_data = $this->db->get_where('kr_distributers',array('kr_users.Email_address'=>$mail_id,'kr_users.Password'=>$Password,'kr_users.admin_type'=>$type1))->row_array();
		
		$mailContent='<table width="100%" border="0" cellpadding="10" cellspacing="0">';
  		$mailContent.='<tr style="color:#fff;background:#C7532E">';
   		$mailContent.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Revelator USA" width="222" height="79"></td>';
  		$mailContent.='<td width="90%" align="center">&nbsp;</td>';
  		$mailContent.='</tr>';
  		$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
  		$mailContent.='<td height="19" colspan="2" valign="top">&nbsp;</td>';
 		$mailContent.='</tr>';
		$mailContent.='<tr style="background:#FBE697;color:#C7532E">';
		$mailContent.='<td height="213" colspan="2" valign="top">';
		$mailContent.='<p>Hi '.$member_data['First_name'].',<br></p>';
		$mailContent .='<p>Thank you for registering as a <bold>'.$roll.'.Use below credentials to update your details.<br><br>Username : <b>'.$mail_id.'</b><br>Password : <b>'.$Password.'</b> <br><br><p>';
		$mailContent.='</p>';	
		$mailContent.='<p>Administrator,<br>
      Kingdom Revelator USA</p>
    </td>
  </tr>
</table>';	
		$mailContent1='<table width="100%" border="0" cellpadding="10" cellspacing="0">';
  		$mailContent1.='<tr style="color:#fff;background:#C7532E">';
   		$mailContent1.='<td width="10%" height="93"><img src="'.site_url('assets/backend/img/logo1.png').'" alt="Kingdom Revelator USA" width="222" height="79"></td>';
  		$mailContent1.='<td width="90%" align="center">&nbsp;</td>';
  		$mailContent1.='</tr>';
  		$mailContent1.='<tr style="background:#FBE697;color:#C7532E">';
  		$mailContent1.='<td height="19" colspan="2" valign="top">&nbsp;</td>';
 		$mailContent1.='</tr>';
		$mailContent1.='<tr style="background:#FBE697;color:#C7532E">';
		$mailContent1.='<td height="213" colspan="2" valign="top">';
		$mailContent1.='<p>Hi '.$member_data['First_name'].',<br></p>';
		$mailContent1 .='<p>You updated the Information as a <bold>'.$roll.'.Use below credentials to Login.<br><br>Username : <b>'.$mail_id.'</b><br>Password : <b>'.$Password.'</b> <br><br><p>';
		$mailContent1.='</p>';	
		$mailContent1.='<p>Administrator,<br>
      Kingdom Revelator USA</p>
    </td>
  </tr>
</table>';	

		$this->email->subject('Message from Kingdom Revelator USA');
		if($type == 'new')
		$this->email->message($mailContent);
		if($type == 'edit')
		$this->email->message($mailContent1);
		$this->email->send();
	}	

}

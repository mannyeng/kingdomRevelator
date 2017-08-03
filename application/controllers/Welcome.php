<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Welcome extends CI_Controller {



	

	public function index()

	{

		$data['content'] = 'welcome/index';

		 $data['menu']='';

		 $this->load->view('template',$data );

	}

	public function about()

	{

		

		$data['content'] = 'welcome/about';

		 $data['menu']='';

		 $this->load->view('template',$data );

		}

		public function contact()

	{

		

		$data['content'] = 'welcome/contact';

		 $data['menu']='';

		 $this->load->view('template',$data );

		}
		public function notfound()

	{

		

		$data['content'] = 'welcome/notfound';

		 $data['menu']='';

		 $this->load->view('template',$data );

		}
		public function donatenow()

	{

		

		$data['content'] = 'welcome/donatenow';

		 $data['menu']='';

		 $this->load->view('template',$data );

		}

		public function flipbook()

	{

 
		 $this->load->view('welcome/book');

		}
// only subscription not ended persons can view the full editions
    public function fulledition()

	{
       $this->load->library('session');
       //md5 encrypted
       $bookid = $_GET['s'];
       if($this->session->userdata('role') != 'subscriber')
       {
        redirect(base_url()); 
       }

        $userid = $this->session->userdata('id');
        
        
        
        		$page_data['file'] = $this->db->select('file')->get_where('kr_books',array('md5(id)'=>$bookid))->row()->file;
                if($page_data['file'] !="")

		 $this->load->view('welcome/fulledition',$page_data);
		else
			//echo 'd';exit;
			redirect(base_url());
		
		}

        // to check subscription date is end or not
		function subscription_expiry($date)
		{

		  $future = strtotime($date); //Future date.

	      $timefromdb =strtotime(date("Y-m-d"));

	      $timeleft = $future-$timefromdb;

	      $daysleft = round((($timeleft/24)/60)/60);
	      return $daysleft;

		}



}


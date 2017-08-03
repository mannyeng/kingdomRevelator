
<?php

class Testimony extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */
	
	 public function __construct() {
     parent::__construct();
       	
		$this->load->model('user_model','user');
       
		
        }	
    
	public function index()
	{
		 $data['member']	=	$this->db->get('kr_testimony')->result_array();
	     $data['title'] = 'Testmony';
         $data['content'] = 'welcome/testimony';
		 $this->load->view( 'template', $data );	
	}
	public function addTestimony()
	{
		if($this->input->post())

		 {

			$name=$this->input->post('name');

			$testimony=$this->input->post('testimony');

			$file_name=$_FILES['userfile']['name'];



			//$file_name=str_replace(" ","",$name).'_'.$edition.'.pdf';

			$config=array('upload_path'=>'./testimony_img/','file_name'=>$file_name,'allowed_types'=>'*');			

		  

			

			$this->load->library('upload');

			$this->upload->initialize($config);

			//print_r($this->upload->do_upload('userfile'));

			/*if($this->db->query("select count(id) cnt from kr_books where name='$name' and edition ='$edition'")->row()->cnt < 1)

			{*/

				//if($this->upload->do_upload('userfile'))

				//{

					$this->db->insert('kr_testimony',array('name'=>$name,'testimony'=>$testimony,'photo'=>$file_name));

					//$this->session->set_flashdata('add_book','added');

					//redirect('webadmin/books');

				//}

				//else

			//	{		

				//echo  $errors = $this->upload->display_errors();		

				// $this->session->set_flashdata('error',	$errors);
//
					//$this->session->set_flashdata('error','File could not upload');

					//redirect('webadmin/addbook');

			//	}

			}

		
	     $data['title'] = 'National';
         $data['menu']  = 'national';
         $data['content'] = 'backend/webadmin/addtestimony';
         $this->load->view( 'backend/template', $data );
	}
	

}

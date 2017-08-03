<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class County extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		 //$id=$this->session->userdata('id');
		 $data['title'] = 'County';
         $data['menu'] = 'county';
         $data['content'] = 'backend/county/home';
         $this->load->view( 'backend/template', $data );
		 
	}
	
	/*Get List of distributers under county*/
	public function distributer_list()
	{
		 $id = $this->session->userdata('id');
		 $type = $this->session->userdata('role');
		 $data['distributer'] = $this->common->distributer_list($id,$type);
		 //$id=$this->session->userdata('id');
		 $data['title'] = 'County';
         $data['menu'] = 'county';
         $data['content'] = 'backend/county/distributer_list';
         $this->load->view( 'backend/template', $data );
	}
	
	
	
	/*Get List of Subscribers  */
	public function subscribers_list()
	{
		if($this->uri->segment(3)!='')
		{
			$id = $this->uri->segment(3);
		 	$data['subscriber'] = $this->common->subscribers_list_all($id);
		 	$data['title'] = 'County';
        	$data['menu'] = 'county';
         	$data['content'] = 'backend/county/subscribers_list';
        	$this->load->view( 'backend/template', $data );
		}
	 	else
		{
			 $id   = $this->session->userdata('id');
			 $type = $this->session->userdata('role');
			 $data['subscriber'] = $this->common->subscribers_list($id,$type);
			 $data['title'] = 'County';
			 $data['menu'] = 'county';
			 $data['content'] = 'backend/county/subscribers_list';
			 $this->load->view( 'backend/template', $data );
		}
		 
	}
	/*Add new Subscribers under distributers/county */
	
	public function subscribers_save()
	{
		 $this->load->helper('form');
		 $data['title'] = 'County';
         $data['menu'] = 'county';
         $data['content'] = 'backend/county/subscribers_save';
         $this->load->view( 'backend/template', $data );
		 
		 if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('short_name', 'Short name', 'required');			
            $this->form_validation->set_rules('seats', 'seats', 'required|numeric');
			$this->form_validation->set_rules('wait', 'wait', 'required|numeric');			
			$this->form_validation->set_rules('adult_fee', 'Adult fee', 'required|numeric');
            $this->form_validation->set_rules('datFrom', 'From Date', 'required');
			$this->form_validation->set_rules('datTo', 'To Date', 'required');
			$this->form_validation->set_rules('datEnd', 'Reg. End Date', 'required');
			$this->form_validation->set_rules('by_whom', 'Retreat By', 'required');
			$this->form_validation->set_rules('bible', 'Bible Quote', 'required');
            $this->form_validation->set_rules('location', 'Venue', 'required');            
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run()==true)
            {
				
                $data_to_store = array(
                    'name' => $this->input->post('name'),
					'short_name' => $this->input->post('short_name'),
					'seats' => $this->input->post('seats'),
					'wait' => $this->input->post('wait'),					
					'adult_fee' => $this->input->post('adult_fee'),
					'datFrom' => $this->input->post('datFrom'),
					'datTo' => $this->input->post('datTo'),
					'datEnd' => $this->input->post('datEnd'),
					'by_whom' => $this->input->post('by_whom'),
					'bible' => $this->input->post('bible'),
					'location' => $this->input->post('location'),
					'to_whom' => $this->input->post('to_whom'),
					'position' => $this->input->post('position'),
					'session' => implode(',',$this->input->post('session')),
					'description' => $this->input->post('description'),
					'disable_reg' => $this->input->post('disable_reg'),
					'paypalc' => $this->input->post('paypalc')/*,	
					'conv_percent' => $this->input->post('conv_percent')*/				
                );
				
			    //if the insert has returned true then we show the flash message
                if($this->retreat->store_retreat($data_to_store)){
                    $this->session->set_flashdata('flash_message', 'added');
					redirect('retreats/retreats_list');
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
	}
	
	public function profile()
	{
		 $res_subscribe = $this->db->query("SELECT * FROM kr_distributers WHERE User_id='1'");
		 $page_data['subscribers'] = $res_subscribe->result_array();
		 $page_data['account_type']   = 'Distributer';
		 $page_data['page_name']   = '../Distributer/profile';
	     $page_data['page_title'] = 'Profile';
		 $this->load->view('backend/index', $page_data);
	}
}

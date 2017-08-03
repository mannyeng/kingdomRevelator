<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stylechange extends CI_Controller {



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

	 function __construct()

	{

		parent::__construct();

		$this->session->set_flashdata('alert', '');

	    if ( $this->session->userdata('role') == '')

     {

            redirect( '', 'refresh' );

           }

		$this->load->helper(array('form', 'url'));

		$this->load->library('upload');

	}



	public function form()

	{

		if($this->input->post())

		{

			$MenuBackground		=	str_replace("'", "",$this->input->post('MenuBackground'));

			$MenuColor		    =	str_replace("'", "",$this->input->post('MenuColor'));

			$HeaderText		    =	str_replace("'", "",$this->input->post('HeaderText'));

			$FooterColor		=	str_replace("'", "",$this->input->post('FooterColor'));

			$old_mimage			=   str_replace("'", "",$this->input->post('old_mimage'));

			$old_bookimage		=   str_replace("'", "",$this->input->post('old_bookimage'));

			

			if($_FILES['mimage']['name']!='')

			{

				

				 $config['upload_path']          = './background/';

				 $config['allowed_types']        = 'gif|jpg|png';

				 $config['max_size']             = 2024;

				 $config['overwrite']			  = true;

				 $config['file_name']            = 'backgroundimg';

				

				 

				 $this->upload->initialize($config); 

				 if($this->upload->do_upload('mimage'))

				 {

					$BackgroundImage='background/'.$this->upload->data('file_name');

				 }

				 else

				 {

				    $error = array('error' => $this->upload->display_errors());

					print_r($error);

				 }



			}

			else

			{

				$BackgroundImage=$old_mimage;

			}

			if($_FILES['bookimage']['name']!='')

			{

				

				 $config1['upload_path']          = './bookimage/';

				 $config1['allowed_types']        = 'gif|jpg|png';

				 $config1['max_size']             = 2024;

				 $config1['overwrite']			  = true;

				 $config1['file_name']            = 'bookimage';

				

				 $this->upload->initialize($config1); 

				 if($this->upload->do_upload('bookimage'))

				 {

						$file_pathBookImage='bookimage/'.$this->upload->data('file_name');

				 }

				 else

				 {

				    $error = array('error' => $this->upload->display_errors());

					print_r($error);

				 }

			}

			else

			{

				$file_pathBookImage=$old_bookimage;

			}

			$this->db->query("UPDATE `kr_style` SET `BackgroundImage`='$BackgroundImage',`BookImage`='$file_pathBookImage',`MenuBackgorund`='$MenuBackground',`MenuColor`='$MenuColor',`HeaderText`='$HeaderText',`FooterColor`='$FooterColor' WHERE id='1'");

			if($this->db->affected_rows()>0)

			{

				$this->session->set_flashdata('alert','success');

			}

		}

		

		$data['content'] = 'stylechange/form';

		$data['menu']='';

		$this->load->view('template',$data );

	}

	

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginRegister extends CI_Controller{
 function __construct()
  {
   parent::__construct();
    $this->load->helper(array('form', 'url'));
  }
 function index($msg = NULL)
 {

  $this->template
        ->title('Login','Login Page')      
        ->set_layout('access')
        ->build('login_form');
 } 
 function validate_credentials()
 {  
	$this->load->model('Login_validate'); 
	$query = $this->Login_validate->validate();
	echo $query;
	if($query=="Go to home page!") // if the user's credentials validated...
	{
		redirect('Home'); 
	}
	else // incorrect username or password
	{
		$msg = '<p class=error>'.$query.'</p>';
		$data = array('messages' => $msg);
		$this->session->set_userdata($data);
		$this->load->view('login_form');
		$this->session->unset_userdata('messages');
	}
 }
 
}

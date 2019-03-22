<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobQueue extends CI_Controller {
	function __construct()
	{
	parent::__construct();
		$this->load->library('template');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->template
				->title('Job Queue','My App')
				->build('jobqueue/index');
	}
}

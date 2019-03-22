<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffing extends CI_Controller {
	function __construct()
	{
	parent::__construct();
		$this->load->library('template');
		$this->load->helper('url');
	}
	
	public function index()
	{		
		$this->template
				->title('Staffing','Create Roster')
				->build('staffing/create_roster');
	}
	public function create()
	{		
		$this->template
				->title('Staffing','Create Roster')
				->build('staffing/create_roster');
	}
	public function update()
	{		
		$this->template
				->title('Staffing','Update Roster')
				->build('staffing/update_roster');
	}
	public function display()
	{		
		$this->template
				->title('Staffing','Display Roster')
				->build('staffing/display_roster');
	}
}

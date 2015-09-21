<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Structure extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->show();
	}
	
	function show()
	{
		$view_data = array();
		return $this->load->view('structure', $view_data, true);
	}
	
	function preview()
	{
		$view_data = array();
		return $this->load->view('structure_preview', $view_data, true);
	}
}

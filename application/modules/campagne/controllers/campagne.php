<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campagne extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$view_data['page_title'] = lang('dashboard.title3');
		$this->load->view('campagne.php');
	}
	
	function detail($id = null)
	{
		if (!$id) redirect('campagne');
		$view_data['page_title'] = lang('dashboard.title3');
		$this->load->view('campagne_detail.php');
	}
}

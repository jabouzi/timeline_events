<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller
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
		$view_data['page_title'] = lang('dashboard.title3');
		//$view_data['admin_widgets']['analytic_preview'] = modules::run('analytic/preview');
		$view_data['admin_widgets']['structure_preview'] = modules::run('structure/preview');
		echo modules::run('template', $view_data);
	}
}

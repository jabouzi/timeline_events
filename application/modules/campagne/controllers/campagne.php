<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campagne extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_campagne');
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
	
	function generate_campagne()
	{
		$campaigns = $this->mdl_campagne->get_where(array('campaign_active' => 1));
		foreach($campaigns->result() as $campaign)
		{
			var_dump($campaign);
		}
		$json = utf8_encode(file_get_contents('/home/skander/www/metro.toolbox/assets/json/data.json'));
		$constants = get_defined_constants(true);
		$json_errors = array();
		foreach ($constants["json"] as $name => $value) {
			if (!strncmp($name, "JSON_ERROR_", 11)) {
				$json_errors[$value] = $name;
			}
		}

		// Show the errors for different depths.
		foreach (range(4, 3, -1) as $depth) {
			var_dump(json_decode($json, true, $depth));
			echo 'Last error: ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
		}
	}
	
	function generate_campagne_detail($id)
	{
		$campaigns = $this->mdl_campagne->get_id($id);
		var_dump($campaigns->row());
	}
}

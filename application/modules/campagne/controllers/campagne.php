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
		$this->mdl_campagne->set_table('campaigns_banners');
		$banners = $this->mdl_campagne->get();
		$view_data['banners'] = $banners->result();
		$this->load->view('campagne.php', $view_data);
	}
	
	function edit()
	{
		$view_data['page_title'] = lang('dashboard.title3');
		$this->load->view('campagne_edition.php');
	}
	
	function detail($id = null)
	{
		if (!$id) redirect('campagne');
		$view_data['page_title'] = lang('dashboard.title3');
		$view_data['campaign_id'] = $id;
		$this->mdl_campagne->set_table('campaigns');
		$campaign = $this->mdl_campagne->get_where(array('campaign_id' => $id));
		$view_data['campaign_name'] = $campaign->row()->campaign_title;
		$this->load->view('campagne_detail.php', $view_data);
	}
	
	function generate_campagne()
	{
		$json = array();
		$this->mdl_campagne->set_table('campaigns');
		$campaigns = $this->mdl_campagne->get_where(array('campaign_active' => 1));
		$colors = array('red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta');
		foreach($campaigns->result() as $key => $campaign)
		{
			$this->mdl_campagne->set_table('campaigns_banners');
			$banners = $this->mdl_campagne->get_where(array('campaign_banner_id' => $campaign->campaign_banner_id));
            $json[$banners->row()->campaign_banner_name][] = array(
					'start' =>  '__'.strtotime($campaign->campaign_date_start),
					'end' =>  '__'.strtotime($campaign->campaign_date_end),
					'content' =>  $campaign->campaign_title,
					'group' =>  $campaign->campaign_title,
					'id' =>  $campaign->campaign_id,
					'className' =>  $colors[$key],
					'editable' => false
				);
		}

		$json_data = json_encode($json);
		$json_data = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
			return 'new Date(' . ($e[1] * 1000) . ')';
		}, $json_data);

		file_put_contents(FCPATH.'/assets/json/data.json',  'var jsonData = '.$json_data);
	}
	
	function generate_campagne_detail($id)
	{
		$json = array();
		$this->mdl_campagne->set_table('campaigns_steps');
		$campaigns = $this->mdl_campagne->get_where(array('campaign_id' => $id));
		foreach($campaigns->result() as $key => $campaign)
		{
			$this->mdl_campagne->set_table('campaigns_types');
			$campaign_step = $this->mdl_campagne->get_where(array('campaign_type_id' => $campaign->campaigns_step_type));
            $json[] = array(
					'start' =>  '__'.strtotime($campaign->campaigns_step_date_start),
					'end' =>  '__'.strtotime($campaign->campaigns_step_date_end),
					'content' =>  $campaign_step->row()->campaign_type_name,
					'group' =>  $campaign_step->row()->campaign_type_name,
					'id' =>  $campaign->campaigns_step_id,
					'className' =>  'default',
					'editable' => false
				);
		}

		$json_data = json_encode($json);
		$json_data = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
			return 'new Date(' . ($e[1] * 1000) . ')';
		}, $json_data);

		file_put_contents(FCPATH.'/assets/json/data_'.$id.'.json',  'var jsonData = '.$json_data);
	}
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_campaign');
		$this->load->helper('form');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('dashboard.title3');
		$this->mdl_campaign->set_table('campaigns_banners');

		$banners = $this->mdl_campaign->get();
		$campaign_data['banners'] = $banners->result();
		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign.php', $campaign_data, true);
		$view_data['javascript'] = array('timeline.js');
		$view_data['stylesheet'] = array('timeline.css', 'campaign.css');
		$view_data['json'] = array('data.json');
		echo modules::run('template/campaign', $view_data);
	}
	
	function add()
	{
		$this->mdl_campaign->set_table('campaigns_banners');
		$campaign_banners = $this->mdl_campaign->get()->result();
		
		$campaign_types = $this->mdl_campaign->set_table('campaigns_types');
		$campaign_types = $this->mdl_campaign->get()->result();

		$this->mdl_campaign->set_table('campaigns_steps_types');
		$campaign_steps_types = $this->mdl_campaign->get()->result();
		
		$this->mdl_campaign->set_table('campaigns_project_managers');
		$campaign_managers_tgi = $this->mdl_campaign->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_managers_client = $this->mdl_campaign->get_where(array('campaign_manager_tgi' => 0))->result();
		
		$campaign_data['campaign_banners'] = array_for_dropdown($campaign_banners, 'campaign_banner_id', 'campaign_banner_name');
		$campaign_data['campaign_types'] = array_for_dropdown($campaign_types, 'campaign_type_id', 'campaign_type_name');
		
		$campaign_data['campaign_managers_tgi'] = array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', 'campaign_manager_name');
		$campaign_data['campaign_managers_client'] = array_for_dropdown($campaign_managers_client, 'campaign_manager_id', 'campaign_manager_name');
		
		$campaign_data['campaign_steps_types'] = array_for_dropdown($campaign_steps_types, 'campaign_step_type_id', 'campaign_step_type_name');
		
		//$view_data['page_title'] = lang('dashboard.title3');
		$view_data['campaign_widgets']['edit'] = $this->load->view('campaign_add.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function edit($id = null)
	{
		if (!$id) redirect('campaign');
		
		$this->mdl_campaign->set_table('campaigns');
		$campaign_data['campaign'] = $this->mdl_campaign->get_id('campaign_id', $id)->row();
		
		$this->mdl_campaign->set_table('campaigns_banners');
		$campaign_data['campaign_banner'] = $this->mdl_campaign->get_id('campaign_banner_id', $campaign_data['campaign']->campaign_banner_id)->row();
		$campaign_banners = $this->mdl_campaign->get()->result();
		
		$campaign_types = $this->mdl_campaign->set_table('campaigns_types');
		$campaign_data['campaign_type'] = $this->mdl_campaign->get_id('campaign_type_id', $campaign_data['campaign']->campaign_type_id)->row();
		$campaign_types = $this->mdl_campaign->get()->result();
		
		$this->mdl_campaign->set_table('campaigns_steps');
		$campaign_steps = $this->mdl_campaign->get_id('campaign_id', $campaign_data['campaign']->campaign_id)->result();
		
		$this->mdl_campaign->set_table('campaigns_steps_types');
		$campaign_steps_types = $this->mdl_campaign->get()->result();
		
		$this->mdl_campaign->set_table('campaigns_project_managers');
		$campaign_data['campaign_manager_client'] = $this->mdl_campaign->get_id('campaign_manager_id', $campaign_data['campaign']->campaign_manager_client)->row();
		$campaign_data['campaign_manager_tgi'] = $this->mdl_campaign->get_id('campaign_manager_id', $campaign_data['campaign']->campaign_manager_tgi)->row();
		$campaign_managers_tgi = $this->mdl_campaign->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_managers_client = $this->mdl_campaign->get_where(array('campaign_manager_tgi' => 0))->result();
		
		$campaign_data['campaign_banners'] = array_for_dropdown($campaign_banners, 'campaign_banner_id', 'campaign_banner_name');
		$campaign_data['campaign_types'] = array_for_dropdown($campaign_types, 'campaign_type_id', 'campaign_type_name');
		
		$campaign_data['campaign_managers_tgi'] = array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', 'campaign_manager_name');
		$campaign_data['campaign_managers_client'] = array_for_dropdown($campaign_managers_client, 'campaign_manager_id', 'campaign_manager_name');
		
		$campaign_data['campaign_steps_types'] = array_for_dropdown($campaign_steps_types, 'campaign_step_type_id', 'campaign_step_type_name');
		$campaign_data['campaign_steps'] = array_for_dropdown($campaign_steps, 'campaign_step_type');
		
		//$view_data['page_title'] = lang('dashboard.title3');
		$view_data['campaign_widgets']['edit'] = $this->load->view('campaign_edit.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function detail($id = null)
	{
		if (!$id) redirect('campaign');
		$campaign_data['page_title'] = lang('dashboard.title3');
		$campaign_data['campaign_id'] = $id;
		$this->mdl_campaign->set_table('campaigns');
		$campaign = $this->mdl_campaign->get_where(array('campaign_id' => $id));
		
		$campaign_data['campaign_name'] = $campaign->row()->campaign_title;
		$campaign_data['campaign_id'] = $id;
		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_detail.php', $campaign_data, true);
		
		$view_data['javascript'] = array('timeline.js');
		$view_data['stylesheet'] = array('timeline.css', 'campaign.css');
		$view_data['json'] = array('data_'.$id.'.json');
		echo modules::run('template/campaign', $view_data);
	}
	
	function process_add_campaign()
	{
		$this->process_add_campaign_steps();
		$campaign_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => $this->input->post('campaign_date_start'),
			'campaign_date_end' => $this->input->post('campaign_date_end'),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address'),
			'campaign_manager_client'=> $this->input->post('campaign_manager_client'),
			'campaign_manager_tgi'=> $this->input->post('campaign_manager_tgi'),
			'campaign_active' => $this->input->post('campaign_active'),
		);
		$this->add_campaign($campaign_data);
	}
	
	function process_edit_campaign()
	{
		var_dump($this->input->post());
		$this->process_edit_campaign_steps();
		$campaign_id = $this->input->post('campaign_id');
		$campaign_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => $this->input->post('campaign_date_start'),
			'campaign_date_end' => $this->input->post('campaign_date_end'),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address'),
			'campaign_manager_client'=> $this->input->post('campaign_manager_client'),
			'campaign_manager_tgi'=> $this->input->post('campaign_manager_tgi'),
			'campaign_active' => $this->input->post('campaign_active'),
		);
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$campaign_old_data = array(
			'client_id' => $campaign->client_id,
			'campaign_banner_id' => $campaign->campaign_banner_id,
			'campaign_project_number' => $campaign->campaign_project_number,
			'campaign_store_number' => $campaign->campaign_store_number,
			'campaign_title' => $campaign->campaign_title ,
			'campaign_date_start' => $campaign->campaign_date_start,
			'campaign_date_end' => $campaign->campaign_date_end,
			'campaign_branch' => $campaign->campaign_branch,
			'campaign_address'=> $campaign->campaign_address,
			'campaign_manager_client'=> $campaign->campaign_manager_client,
			'campaign_manager_tgi'=> $campaign->campaign_manager_tgi,
			'campaign_active' => $campaign->campaign_active,
		);

		if (count(compare_profile($campaign_old_data, $campaign_data)))
		{
			$this->update_campaign($campaign_id, $campaign_data);
		}
		
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	function process_add_campaign_steps()
	{
		$campaign_step_data = array(
			'campaign_id' => $this->input->post('campaign_id'),
			'campaigns_step_type' => $this->input->post('campaigns_step_type'),
			'campaigns_step_date_start' => $this->input->post('campaigns_step_date_start') ,
			'campaigns_step_date_end' => $this->input->post('campaigns_step_date_end')
		);
		$this->add_campaign($campaign_step_data);
	}
	
	function process_edit_campaign_steps()
	{
		$campaigns_step_id = $this->input->post('campaigns_step_id');
		$campaign_step_data = array(
			'campaign_id' => $this->input->post('campaign_id'),
			'campaigns_step_type' => $this->input->post('campaigns_step_type'),
			'campaigns_step_date_start' => $this->input->post('campaigns_step_date_start') ,
			'campaigns_step_date_end' => $this->input->post('campaigns_step_date_end')
		);
		$campaign_step = $this->mdl_campaign->get_id('campaign_step_id', $campaign_step_id);
		$campaign_step_old_data = array(
			'client_id' => $campaign->client_id,
			'campaign_project_number' => $campaign_step->campaign_project_number,
			'campaign_store_number' => $campaign_step->campaign_store_number,
			'campaign_title' => $campaign_step->campaign_title ,
			'campaign_date_start' => $campaign_step->campaign_date_start,
			'campaign_date_end' => $campaign_step->campaign_date_end,
			'campaign_branch' => $campaign_step->campaign_branch,
			'campaign_address'=> $campaign_step->campaign_address ,
			'campaign_active' => $campaign_step->campaign_active,
		);

		if (count(compare_profile($campaign_step_old_data, $campaign_step_data)))
		{
			$this->update_campaign($campaign_step_id, $campaign_step_data);
		}
		
		redirect('campaign/editcampaign/'.$campaign_step_id);
	}
	
	private function add_campaign($campaign_data)
	{
		$campaign_id = $this->mdl_campaign->insert($campaign_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	private function update_campaign($campaign_id, $campaign_data)
	{
		$this->mdl_campaign->update('campaign_id', $campaign_id, $campaign_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	private function add_campaign_step($campaign_step_data)
	{
		$campaign_step_id = $this->mdl_campaign->insert($campaign_step_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
	}
	
	private function update_campaign_step($campaign_step_id, $campaign_step_data)
	{
		$this->mdl_campaign->update('campaign_step_id', $campaign_step_id, $campaign_step_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
	}
	
	function generate_campaign()
	{
		$json = array();
		$this->mdl_campaign->set_table('campaigns');
		$campaigns = $this->mdl_campaign->get_where(array('campaign_active' => 1));
		$colors = array('red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta');
		foreach($campaigns->result() as $key => $campaign)
		{
			$this->mdl_campaign->set_table('campaigns_banners');
			$banners = $this->mdl_campaign->get_where(array('campaign_banner_id' => $campaign->campaign_banner_id));
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
	
	function generate_campaign_detail($id)
	{
		$json = array();
		$this->mdl_campaign->set_table('campaigns_steps');
		$campaigns = $this->mdl_campaign->get_where(array('campaign_id' => $id));
		foreach($campaigns->result() as $key => $campaign)
		{
			$this->mdl_campaign->set_table('campaigns_types');
			$campaign_step = $this->mdl_campaign->get_where(array('campaign_type_id' => $campaign->campaign_step_type));
            $json[] = array(
					'start' =>  '__'.strtotime($campaign->campaign_step_date_start),
					'end' =>  '__'.strtotime($campaign->campaign_step_date_end),
					'content' =>  ' ',
					'group' =>  $campaign_step->row()->campaign_type_name,
					'id' =>  $campaign->campaign_step_id,
					'className' =>  'red',
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

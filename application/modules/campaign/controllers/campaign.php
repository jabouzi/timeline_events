<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_campaigns');
		$this->load->model('mdl_campaigns_banners');
		$this->load->model('mdl_campaigns_project_managers');
		$this->load->model('mdl_campaigns_steps');
		$this->load->model('mdl_campaigns_steps_types');
		$this->load->model('mdl_campaigns_types');
		$this->load->helper('form');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('dashboard.title3');

		$banners = $this->mdl_campaigns_banners->get();
		$campaign_data['banners'] = $banners->result();
		$campaing_steps_count = array();

		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign.php', $campaign_data, true);
		$view_data['javascript'] = array('timeline.js');
		$view_data['json'] = array('data.json');
		echo modules::run('template/campaign', $view_data);
	}
	
	function add()
	{
		$campaign_banners = $this->mdl_campaigns_banners->get()->result();
		$campaign_types = $this->mdl_campaigns_types->get()->result();
		
		$campaign_steps_types = $this->mdl_campaigns_steps_types->get()->result();
		$campaign_managers_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_managers_client = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 0))->result();
		
		$campaign_data['campaign_banners'] = array_for_dropdown($campaign_banners, 'campaign_banner_id', 'campaign_banner_name');
		array_unshift($campaign_data['campaign_banners'], '');
		
		$campaign_data['campaign_types'] = array_for_dropdown($campaign_types, 'campaign_type_id', 'campaign_type_name');
		array_unshift($campaign_data['campaign_types'], '');
		
		$campaign_data['campaign_managers_tgi'] = array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));
		array_unshift($campaign_data['campaign_managers_tgi'], '');

		$campaign_data['campaign_managers_client'] = array_for_dropdown($campaign_managers_client, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));
		array_unshift($campaign_data['campaign_managers_client'], '');
		
		$campaign_data['campaign_steps_types'] = array_for_dropdown($campaign_steps_types, 'campaign_step_type_id', 'campaign_step_type_name');
		
		//$view_data['page_title'] = lang('dashboard.title3');
		$view_data['campaign_widgets']['edit'] = $this->load->view('campaign_add.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function edit($id = null)
	{
		if (!$id) redirect('campaign');
		
		$campaign_data['campaign'] = $this->mdl_campaigns->get_id('campaign_id', $id)->row();
		
		$campaign_data['campaign_banner'] = $this->mdl_campaigns_banners->get_id('campaign_banner_id', $campaign_data['campaign']->campaign_banner_id)->row();
		$campaign_banners = $this->mdl_campaigns_banners->get()->result();
		
		$campaign_data['campaign_type'] = $this->mdl_campaigns_types->get_id('campaign_type_id', $campaign_data['campaign']->campaign_type_id)->row();
		$campaign_types = $this->mdl_campaigns_types->get()->result();
		
		$campaign_steps = $this->mdl_campaigns_steps->get_id('campaign_id', $campaign_data['campaign']->campaign_id)->result();
		$campaign_steps_types = $this->mdl_campaigns_steps_types->get()->result();
		
		$campaign_type = $this->mdl_campaigns_types->get_where(array('campaign_type_id' => $campaign_data['campaign']->campaign_type_id))->row();
		$campaign_data['campaign_type'] = @$campaign_type->campaign_type_name;
		
		$campaign_data['campaign_manager_client'] = $this->mdl_campaigns_project_managers->get_id('campaign_manager_id', $campaign_data['campaign']->campaign_manager_client)->row();
		$campaign_data['campaign_manager_tgi'] = $this->mdl_campaigns_project_managers->get_id('campaign_manager_id', $campaign_data['campaign']->campaign_manager_tgi)->row();
		$campaign_managers_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_managers_client = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 0))->result();
		
		$campaign_data['campaign_banners'] = array_for_dropdown($campaign_banners, 'campaign_banner_id', 'campaign_banner_name');
		array_unshift($campaign_data['campaign_banners'], '');
		
		$campaign_data['campaign_types'] = array_for_dropdown($campaign_types, 'campaign_type_id', 'campaign_type_name');
		array_unshift($campaign_data['campaign_types'], '');

		$campaign_data['campaign_managers_tgi'] = array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));
		array_unshift($campaign_data['campaign_managers_tgi'], '');

		$campaign_data['campaign_managers_client'] = array_for_dropdown($campaign_managers_client, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));
		array_unshift($campaign_data['campaign_managers_client'], '');
		
		$campaign_data['campaign_steps_types'] = array_for_dropdown($campaign_steps_types, 'campaign_step_type_id', 'campaign_step_type_name');
		$campaign_data['campaign_steps'] = array_for_dropdown($campaign_steps, 'campaign_step_type');
		
		$this->session->userdata['campaign_banner_id'] = $campaign_data['campaign']->campaign_banner_id;
		
		//$view_data['page_title'] = lang('dashboard.title3');
		$view_data['campaign_widgets']['edit'] = $this->load->view('campaign_edit.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function detail($id = null)
	{
		if (!$id) redirect('campaign');
		$campaign_data['page_title'] = lang('dashboard.title3');
		$campaign = $this->mdl_campaigns->get_where(array('campaign_id' => $id))->row();
		$campaign_data['campaign_name'] = $campaign->campaign_title;
		$campaign_data['campaign_id'] = $id;
		
		$campaign_type = $this->mdl_campaigns_types->get_where(array('campaign_type_id' => $campaign->campaign_type_id))->row();
		$campaign_data['campaign_type'] = @$campaign_type->campaign_type_name;
		
		$this->session->userdata['campaign_banner_id'] = $campaign->campaign_banner_id;
		
		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_detail.php', $campaign_data, true);
		$view_data['javascript'] = array('timeline.js');
		$view_data['json'] = array('data_'.$id.'.json');
		echo modules::run('template/campaign', $view_data);
	}
	
	function process_add_campaign()
	{
		$campaign_data = array(
			'client_id' => $this->session->userdata('client_id'),
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => date('Y-m-d', strtotime($this->input->post('campaign_date_start'))),
			'campaign_date_end' => date('Y-m-d', strtotime($this->input->post('campaign_date_end'))),
			'campaign_date_evenement' => date('Y-m-d', strtotime($this->input->post('campaign_date_evenement'))),
			'campaign_date_media' => date('Y-m-d', strtotime($this->input->post('campaign_date_media'))),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address'),
			'campaign_manager_client'=> $this->input->post('campaign_manager_client'),
			'campaign_manager_tgi'=> $this->input->post('campaign_manager_tgi'),
			'campaign_active' => 1,
		);
		$this->add_campaign($campaign_data);
	}
	
	function process_edit_campaign()
	{
		$campaign_id = $this->input->post('campaign_id');
		$campaign_data = array(
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => date('Y-m-d', strtotime($this->input->post('campaign_date_start'))),
			'campaign_date_end' => date('Y-m-d', strtotime($this->input->post('campaign_date_end'))),
			'campaign_date_evenement' => date('Y-m-d', strtotime($this->input->post('campaign_date_evenement'))),
			'campaign_date_media' => date('Y-m-d', strtotime($this->input->post('campaign_date_media'))),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address'),
			'campaign_manager_client'=> $this->input->post('campaign_manager_client'),
			'campaign_manager_tgi'=> $this->input->post('campaign_manager_tgi'),
			'campaign_type_id'=> $this->input->post('campaign_type_id')
		);
		
		$this->update_campaign($campaign_id, $campaign_data);
	}
	
	function process_add_campaign_steps($update = 0)
	{
		$campaign_steps_types = array_for_dropdown($this->mdl_campaigns_steps_types->get()->result(), 'campaign_step_type_id');
		foreach($campaign_steps_types as $campaign_step_type_id => $campaign_step_type)
		{
			if ($update)
			{
				$where = array('campaign_id' => $this->input->post('campaign_id'), 'campaign_step_type' => $campaign_step_type_id);
				$this->mdl_campaigns_steps->delete($where);
			}

			if (!isempty(item($this->input->post('campaign_step_date_start'), $campaign_step_type_id)) && !isempty(item($this->input->post('campaign_step_date_end'), $campaign_step_type_id)))
			{
				$campaign_step_data = array(
					'campaign_id' => $this->input->post('campaign_id'),
					'campaign_step_type' => $campaign_step_type_id,
					'campaign_step_date_start' => date('Y-m-d', strtotime(item($this->input->post('campaign_step_date_start'), $campaign_step_type_id))),
					'campaign_step_date_end' => date('Y-m-d', strtotime(item($this->input->post('campaign_step_date_end'), $campaign_step_type_id)))
				);
				$this->add_campaign_step($campaign_step_data);
			}
		}
	}
	
	private function add_campaign($campaign_data)
	{
		$campaign_id = $this->mdl_campaigns->insert($campaign_data);
		$this->process_add_campaign_steps($campaign_id);
		$this->generate_campaign();
		$this->generate_campaign_detail($campaign_id);
		$this->session->set_userdata('success_message', lang('campaign.add.success'));
		redirect('campaign/detail/'.$campaign_id);
	}
	
	private function update_campaign($campaign_id, $campaign_data)
	{
		$this->mdl_campaigns->update('campaign_id', $campaign_id, $campaign_data);
		$this->process_add_campaign_steps(1);
		$this->generate_campaign();
		$this->generate_campaign_detail($campaign_id);
		$this->session->set_userdata('success_message', lang('campaign.edit.success'));
		redirect('campaign/detail/'.$campaign_id);
	}
	
	private function add_campaign_step($campaign_step_data)
	{
		$campaign_step_id = $this->mdl_campaigns_steps->insert($campaign_step_data);
	}
	
	private function update_campaign_step($campaign_step_id, $campaign_step_data)
	{
		$this->mdl_campaigns_steps->update('campaign_step_id', $campaign_step_id, $campaign_step_data);
	}
	
	function generate_campaign()
	{
		$json = array();
		$campaign_types = array_for_dropdown($this->mdl_campaigns_types->get()->result(), 'campaign_type_id');
		$campaigns = $this->mdl_campaigns->get_where(array('campaign_active' => 1))->result();
		$colors = array('red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta','red', 'blue', 'green', 'orange', 'magenta');
		foreach($campaigns as $key => $campaign)
		{
			$banners = $this->mdl_campaigns_banners->get_where(array('campaign_banner_id' => $campaign->campaign_banner_id));
            $json[$banners->row()->campaign_banner_name][] = array(
					'start' =>  '__'.strtotime($campaign->campaign_date_start),
					'end' =>  '__'.strtotime($campaign->campaign_date_end),
					'content' =>  '<input type="hidden" onclick=pop("'.$campaign->campaign_id.'") id="campaing_'.$campaign->campaign_id.'" value="'.$campaign->campaign_id.'">',
					'group' =>  $campaign->campaign_title,
					'id' =>  $campaign->campaign_id,
					'className' =>  ($campaign->campaign_type_id == 0) ? 'default' : friendly_url($campaign_types[$campaign->campaign_type_id]->campaign_type_name),
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
		$campaigns_steps = $this->mdl_campaigns_steps->get_where_order(array('campaign_id' => $id), 'campaign_step_type')->result();
		$campaigns_steps_types = array_for_dropdown($this->mdl_campaigns_steps_types->get()->result(), 'campaign_step_type_id');
		foreach($campaigns_steps as $key => $campaign_step)
		{
            $json[] = array(
					'start' =>  '__'.strtotime($campaign_step->campaign_step_date_start),
					'end' =>  '__'.strtotime($campaign_step->campaign_step_date_end),
					'content' =>  ' ',
					'group' =>  ($key+1).'. '.$campaigns_steps_types[$campaign_step->campaign_step_type]->campaign_step_type_name,
					'id' =>  $campaign_step->campaign_step_id,
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

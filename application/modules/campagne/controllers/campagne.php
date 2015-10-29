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
	
	function process_add_compaing()
	{
		$campaign_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => $this->input->post('campaign_date_start'),
			'campaign_date_end' => $this->input->post('campaign_date_end'),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address') ,
			'campaign_active' => $this->input->post('campaign_active'),
		);
		$this->add_campaign($campaign_data);
	}
	
	function process_edit_compaing()
	{
		$campaign_id = $this->input->post('campaign_id');
		$campaign_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => $this->input->post('campaign_date_start'),
			'campaign_date_end' => $this->input->post('campaign_date_end'),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address') ,
			'campaign_active' => $this->input->post('campaign_active'),
		);
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$campaign_old_data = array(
			'client_id' => $campaign->client_id,
			'campaign_project_number' => $campaign->campaign_project_number,
			'campaign_store_number' => $campaign->campaign_store_number,
			'campaign_title' => $campaign->campaign_title ,
			'campaign_date_start' => $campaign->campaign_date_start,
			'campaign_date_end' => $campaign->campaign_date_end,
			'campaign_branch' => $campaign->campaign_branch,
			'campaign_address'=> $campaign->campaign_address ,
			'campaign_active' => $campaign->campaign_active,
		);

		if (count(compare_profile($campaign_old_data, $campaign_data)))
		{
			$campaign_data['campaign_password'] = $this->encrypt->encode($campaign_data['campaign_password']);
			$this->update_campaign($campaign_id, $campaign_data);
		}
		
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	function process_add_compaing_steps()
	{
		$campaign_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => $this->input->post('campaign_date_start'),
			'campaign_date_end' => $this->input->post('campaign_date_end'),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address') ,
			'campaign_active' => $this->input->post('campaign_active'),
		);
		$this->add_campaign($campaign_data);
	}
	
	function process_edit_compaing_steps()
	{
		$campaign_id = $this->input->post('campaign_id');
		$campaign_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title') ,
			'campaign_date_start' => $this->input->post('campaign_date_start'),
			'campaign_date_end' => $this->input->post('campaign_date_end'),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address') ,
			'campaign_active' => $this->input->post('campaign_active'),
		);
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$campaign_old_data = array(
			'client_id' => $campaign->client_id,
			'campaign_project_number' => $campaign->campaign_project_number,
			'campaign_store_number' => $campaign->campaign_store_number,
			'campaign_title' => $campaign->campaign_title ,
			'campaign_date_start' => $campaign->campaign_date_start,
			'campaign_date_end' => $campaign->campaign_date_end,
			'campaign_branch' => $campaign->campaign_branch,
			'campaign_address'=> $campaign->campaign_address ,
			'campaign_active' => $campaign->campaign_active,
		);

		if (count(compare_profile($campaign_old_data, $campaign_data)))
		{
			$campaign_data['campaign_password'] = $this->encrypt->encode($campaign_data['campaign_password']);
			$this->update_campaign($campaign_id, $campaign_data);
		}
		
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	private function add_campaign($campaign_data)
	{
		$campaign_id = $this->mdl_campaign->insert($campaign_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$messagedata = array($campaign->campaign_firstname, $campaign->campaign_lastname, site_url(), $campaign->campaign_email, $this->encrypt->decode($campaign->campaign_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox',$campaign->campaign_email, lang('campaign.add'));
		$this->maildecorator->decorate($messagedata, lang('mail.createcampaign'));
		$this->maildecorator->sendmail($maildata);
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	private function update_campaign($campaign_id, $campaign_data)
	{
		$this->mdl_campaign->update('campaign_id', $campaign_id, $campaign_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$messagedata = array($campaign->campaign_firstname, $campaign->campaign_lastname, $campaign->campaign_email, $this->encrypt->decode($campaign->campaign_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $campaign->campaign_email, lang('campaign.update'));
		$this->maildecorator->decorate($messagedata, lang('mail.updatecampaign'));
		$this->maildecorator->sendmail($maildata);
		$this->session->unset_campaigndata('campaign_'.$campaign_id);
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	private function add_campaign_step($campaign_data)
	{
		$campaign_id = $this->mdl_campaign->insert($campaign_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$messagedata = array($campaign->campaign_firstname, $campaign->campaign_lastname, site_url(), $campaign->campaign_email, $this->encrypt->decode($campaign->campaign_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox',$campaign->campaign_email, lang('campaign.add'));
		$this->maildecorator->decorate($messagedata, lang('mail.createcampaign'));
		$this->maildecorator->sendmail($maildata);
		redirect('campaign/editcampaign/'.$campaign_id);
	}
	
	private function update_campaign_step($campaign_id, $campaign_data)
	{
		$this->mdl_campaign->update('campaign_id', $campaign_id, $campaign_data);
		$this->session->set_campaigndata('success_message', lang('campaign.success'));
		$campaign = $this->mdl_campaign->get_id('campaign_id', $campaign_id);
		$messagedata = array($campaign->campaign_firstname, $campaign->campaign_lastname, $campaign->campaign_email, $this->encrypt->decode($campaign->campaign_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $campaign->campaign_email, lang('campaign.update'));
		$this->maildecorator->decorate($messagedata, lang('mail.updatecampaign'));
		$this->maildecorator->sendmail($maildata);
		$this->session->unset_campaigndata('campaign_'.$campaign_id);
		redirect('campaign/editcampaign/'.$campaign_id);
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

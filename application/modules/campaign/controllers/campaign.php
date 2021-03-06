<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		include APPPATH . 'helpers/DatabaseTrait.php';
		$this->load->model('mdl_campaigns');
		$this->load->model('mdl_campaigns_banners');
		$this->load->model('mdl_campaigns_project_managers');
		$this->load->model('mdl_campaigns_steps');
		$this->load->model('mdl_campaigns_steps_data');
		$this->load->model('mdl_campaigns_types');
		$this->load->model('mdl_campaigns_status');
		$this->load->model('mdl_campaigns_documents');
		$this->load->model('mdl_campaigns_i18n');
		$this->load->model('language/mdl_language');
		$this->load->model('client/mdl_client');
		$this->load->helper(array('form', 'url'));
		if (!$this->session->userdata('site_client_id'))
		{
			$client_name = $this->config->item('client_name'); 
			$client = $this->mdl_client->get_where("client_name = '{$client_name}'")->row();
			modules::run('user/add_session_data', 'site_client_id' , $client->client_id);
		}
	}

	function index()
	{
		$languages = array_for_dropdown($this->mdl_language->get()->result(), 'language_code', 'language_name');
		$default_lang = $this->mdl_language->get_where("language_default = '1'")->row();
		modules::run('user/add_session_data', 'default_lang' , $default_lang->language_code);
		if (!$this->session->userdata('current_site_lang'))
		{
			modules::run('user/add_session_data', 'current_site_lang' , $default_lang->language_code);
			modules::run('user/add_session_data', 'current_site_lang_id' , $default_lang->language_id);
		}

		$view_data['page_title'] = lang('dashboard.title3');
		$banners = $this->mdl_campaigns_banners->i18n_client_query($this->session->userdata('current_site_lang'),$this->session->userdata('site_client_id'));
		$campaign_data['banners'] = $banners->result();
		$campaign_types = $this->mdl_campaigns_types->i18n_site_query($this->session->userdata('current_site_lang'))->result();
		$campaign_data['campaign_types'] = $campaign_types;
		$campaign_status = $this->mdl_campaigns_status->i18n_site_query($this->session->userdata('current_site_lang'))->result();
		$campaign_data['campaigns_status'] = $campaign_status;
		$view_data['stylesheet'] = array('campaign_custom_'.$this->session->userdata('current_site_lang').'.css', 'campaign_types_'.$this->session->userdata('current_site_lang').'.css', 'jquery.qtip.min.css');
		$view_data['javascript'] = array('moment-with-locales.min.js','vis.js','jquery.qtip.min.js');
		$view_data['json'] = array('data_'.$this->session->userdata('current_site_lang').'.json', 'group_'.$this->session->userdata('current_site_lang').'.json', 'holidays_'.$this->session->userdata('current_site_lang').'.json');
		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function steps()
	{
		$view_data['page_title'] = lang('campaign.steps');
		$campaign_data['steps'] = $this->mdl_campaigns_steps->i18n_query($this->session->userdata('current_lang'))->result();
		$view_data['admin_widgets']['steps'] = $this->show('campaign_steps', $campaign_data);
		echo modules::run('template', $view_data);
	}
	
	function types()
	{
		$view_data['page_title'] = lang('campaign.types');
		$campaign_data['types'] = $this->mdl_campaigns_types->i18n_query($this->session->userdata('current_lang'))->result();
		$view_data['admin_widgets']['types'] = $this->show('campaign_types', $campaign_data);
		echo modules::run('template', $view_data);
	}
	
	function status()
	{
		$view_data['page_title'] = lang('campaign.status');
		$campaign_data['status'] = $this->mdl_campaigns_status->i18n_query($this->session->userdata('current_lang'))->result();
		$view_data['admin_widgets']['status'] = $this->show('campaign_status', $campaign_data);
		echo modules::run('template', $view_data);
	}
	
	private function show($view, $banner_data)
	{
		$this->load->helper('form');
		$view_data = $banner_data;

		return $this->load->view($view.'.php', $view_data, true);
	}

	function add()
	{
		$campaign_banners = $this->mdl_campaigns_banners->i18n_client_query($this->session->userdata('current_site_lang'),$this->session->userdata('site_client_id'))->result();

		$campaign_types = $this->mdl_campaigns_types->i18n_site_query($this->session->userdata('current_site_lang'))->result();
		$campaign_steps_data = $this->mdl_campaigns_steps_data->get()->result();
		$campaign_managers_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_managers_client = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 0))->result();
		$campaign_status = $this->mdl_campaigns_status->i18n_site_query($this->session->userdata('current_site_lang'))->result();
		
		$campaign_data['campaign_banners'] = array(0  => '') + array_for_dropdown($campaign_banners, 'campaign_banner_id', 'campaign_banner_name');

		$campaign_data['campaign_types'] = array(0  => '') + array_for_dropdown($campaign_types, 'campaign_type_id', 'campaign_type_name');

		$campaign_data['campaign_managers_tgi'] = array(0  => '') + array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));

		$campaign_data['campaign_managers_client'] = array(0  => '') + array_for_dropdown($campaign_managers_client, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));

		$campaign_data['campaign_steps_data'] = array_for_dropdown($campaign_steps_data, 'campaign_step_id');
		
		$campaign_data['campaign_status'] = array(0  => '') + array_for_dropdown($campaign_status, 'campaign_status_id', 'campaign_status_name');
		
		$view_data['javascript'] = array('datepicker-'.$this->session->userdata('current_site_lang').'.js');
		$view_data['campaign_widgets']['edit'] = $this->load->view('campaign_add.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}

	function edit($id = null)
	{
		if (!$id) redirect('campaign');

		$campaign_data['campaign'] = $this->mdl_campaigns->get_id('campaign_id', $id)->row();

		$campaign_data['campaign_banner'] = $this->mdl_campaigns_banners->i18n_id_query($this->session->userdata('current_site_lang'), $campaign_data['campaign']->campaign_banner_id)->row();
		$campaign_banners = $this->mdl_campaigns_banners->i18n_client_query($this->session->userdata('current_site_lang'), $this->session->userdata('site_client_id'))->result();

		$campaign_type = $this->mdl_campaigns_types->i18n_id_query($this->session->userdata('current_site_lang'), $campaign_data['campaign']->campaign_type_id)->row();
		if($campaign_type)	$campaign_data['campaign_type'] = $campaign_type->campaign_type_name;
		else $campaign_data['campaign_type'] = '';

		$campaign_types = $this->mdl_campaigns_types->i18n_site_query($this->session->userdata('current_site_lang'))->result();

		$campaign_steps = $this->mdl_campaigns_steps->i18n_site_query($this->session->userdata('current_site_lang'))->result();
		
		$campaign_steps_data = $this->mdl_campaigns_steps_data->get_id('campaign_id', $campaign_data['campaign']->campaign_id)->result();

		$campaign_status = $this->mdl_campaigns_status->i18n_site_query($this->session->userdata('current_site_lang'))->result();

		$campaign_data['campaign_manager_client'] = $this->mdl_campaigns_project_managers->get_id('campaign_manager_id', $campaign_data['campaign']->campaign_manager_client)->row();
		$campaign_data['campaign_manager_tgi'] = $this->mdl_campaigns_project_managers->get_id('campaign_manager_id', $campaign_data['campaign']->campaign_manager_tgi)->row();
		$campaign_managers_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_managers_client = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 0))->result();

		$campaign_data['campaign_banners'] = array(0  => '') + array_for_dropdown($campaign_banners, 'campaign_banner_id', 'campaign_banner_name');

		$campaign_data['campaign_types'] = array(0  => '') + array_for_dropdown($campaign_types, 'campaign_type_id', 'campaign_type_name');
		
		$campaign_data['campaign_status'] = array(0  => '') + array_for_dropdown($campaign_status, 'campaign_status_id', 'campaign_status_name');

		$campaign_data['campaign_managers_tgi'] = array(0  => '') + array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));

		$campaign_data['campaign_managers_client'] = array(0  => '') + array_for_dropdown($campaign_managers_client, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));

		$campaign_data['campaign_steps_data'] = array_for_dropdown($campaign_steps_data, 'campaign_step_id');
		$campaign_data['campaign_steps'] = array_for_dropdown($campaign_steps, 'campaign_step_id', 'campaign_step_name');

		$this->session->userdata['campaign_banner_id'] = $campaign_data['campaign']->campaign_banner_id;
		
		$view_data['javascript'] = array('datepicker-'.$this->session->userdata('current_site_lang').'.js');
		$view_data['campaign_widgets']['edit'] = $this->load->view('campaign_edit.php', $campaign_data, true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function editstep($step_id)
	{
		$view_data['page_title'] = lang('campaign.step');
		$step = $this->mdl_campaigns_steps->get_id('campaign_step_id', $step_id);
		$campaign_data['step'] = $step->row();
		$campaigns_i18n = $this->mdl_campaigns_i18n->get_where(array('table_name' => 'campaigns_steps', 'table_id' => $step_id, 'language_id' => $this->session->userdata('current_lang_id')))->row();
		if ($campaigns_i18n) $campaign_data['step']->campaign_step_name = $campaigns_i18n->i18n_name;
		else $campaign_data['step']->campaign_step_name =  '';
		$campaign_data['status'] = array('0' => lang('user.inactive'), '1' => lang('user.active'));
		$view_data['admin_widgets']['step'] = $this->show('campaign_editstep', $campaign_data);
		echo modules::run('template', $view_data);
	}
	
	function edittype($type_id)
	{
		$view_data['page_title'] = lang('campaign.type');
		$type = $this->mdl_campaigns_types->get_id('campaign_type_id', $type_id);
		$campaign_data['type'] = $type->row();
		$campaigns_i18n = $this->mdl_campaigns_i18n->get_where(array('table_name' => 'campaigns_types', 'table_id' => $type_id, 'language_id' => $this->session->userdata('current_lang_id')))->row();
		if ($campaigns_i18n) $campaign_data['type']->campaign_type_name = $campaigns_i18n->i18n_name;
		else $campaign_data['type']->campaign_type_name =  '';
		$campaign_data['status'] = array('0' => lang('user.inactive'), '1' => lang('user.active'));
		$view_data['admin_widgets']['type'] = $this->show('campaign_edittype', $campaign_data);
		echo modules::run('template', $view_data);
	}
	
	function editstatus($status_id)
	{
		$view_data['page_title'] = lang('campaign.status');
		$status = $this->mdl_campaigns_status->get_id('campaign_status_id', $status_id);
		$campaign_data['campaign_status'] = $status->row();
		$campaigns_i18n = $this->mdl_campaigns_i18n->get_where(array('table_name' => 'campaigns_status', 'table_id' => $status_id, 'language_id' => $this->session->userdata('current_lang_id')))->row();
		if ($campaigns_i18n) $campaign_data['campaign_status']->campaign_status_name = $campaigns_i18n->i18n_name;
		else $campaign_data['campaign_status']->campaign_status_name =  '';
		$campaign_data['status'] = array('0' => lang('user.inactive'), '1' => lang('user.active'));
		$view_data['admin_widgets']['status'] = $this->show('campaign_editstatus', $campaign_data);
		echo modules::run('template', $view_data);
	}

	function detail($id = null)
	{
		if (!$id) redirect('campaign');
		$campaign_data['page_title'] = lang('dashboard.title3');
		$campaign = $this->mdl_campaigns->get_where(array('campaign_id' => $id))->row();
		$campaign_data['campaign_name'] = $campaign->campaign_title;
		$campaign_data['campaign_budget'] = $campaign->campaign_budget;
		$campaign_data['campaign_id'] = $id;

		$campaign_data['money_format'] = $this->session->userdata('current_site_lang')."_CA.UTF-8";

		$campaign_type = $this->mdl_campaigns_types->get_where(array('campaign_type_id' => $campaign->campaign_type_id))->row();
		$campaign_data['campaign_type'] = @$campaign_type->campaign_type_name;

		$this->session->userdata['campaign_banner_id'] = $campaign->campaign_banner_id;

		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_detail.php', $campaign_data, true);
		$view_data['javascript'] = array('datepicker-'.$this->session->userdata('current_site_lang').'.js', 'moment-with-locales.min.js', 'vis.js', 'moment-with-locales.min.js');
		$view_data['json'] = array('data_'.$id.'.json', 'data_group_'.$id.'.json');
		echo modules::run('template/campaign', $view_data);
	}

	function documents($id = null)
	{
		if (!$id) redirect('campaign');

		$campaign_data['campaign'] = $this->mdl_campaigns->get_id('campaign_id', $id)->row();

		$campaign_data['campaign_banner'] = $this->mdl_campaigns_banners->get_id('campaign_banner_id', $campaign_data['campaign']->campaign_banner_id)->row();
		$campaign_banners = $this->mdl_campaigns_banners->get()->result();

		$campaign_steps = $this->mdl_campaigns_steps->get_id('campaign_id', $campaign_data['campaign']->campaign_id)->result();
		$campaign_steps_data = $this->mdl_campaigns_steps_data->get()->result();

		$campaign_type = $this->mdl_campaigns_types->get_where(array('campaign_type_id' => $campaign_data['campaign']->campaign_type_id))->row();
		$campaign_data['campaign_type'] = @$campaign_type->campaign_type_name;

		$campaign_data['campaign_documents'] = $this->mdl_campaigns_documents->get_where(array('campaign_id' => $campaign_data['campaign']->campaign_id))->result();

		$campaign_managers_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 1))->result();
		$campaign_data['campaign_managers_tgi'] = array_for_dropdown($campaign_managers_tgi, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));

		$campaign_managers_client = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_tgi' => 0))->result();
		$campaign_data['campaign_managers_client'] = array_for_dropdown($campaign_managers_client, 'campaign_manager_id', array('campaign_manager_name', 'campaign_manager_lastname'));

		$campaign_data['campaign_managers_is_tgi'] = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_email' => $this->session->userdata('user_email')))->row();

		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_documents.php', $campaign_data, true);
		$view_data['javascript'] = array('timeline.js');
		$view_data['json'] = array('data_'.$id.'.json');
		echo modules::run('template/campaign', $view_data);
	}
	
	function campaign_print($lang)
	{
		$view_data['page_title'] = lang('dashboard.title3');
		$banners = $this->mdl_campaigns_banners->i18n_client_query($lang,$this->session->userdata('site_client_id'));
		$view_data['banners'] = $banners->result();
		$campaign_types = $this->mdl_campaigns_types->i18n_site_query($lang)->result();
		$view_data['campaign_types'] = $campaign_types;
		$campaign_status = $this->mdl_campaigns_status->i18n_site_query($lang)->result();
		$view_data['campaigns_status'] = $campaign_status;
		$view_data['javascript'] = array('moment-with-locales.min.js','vis.js','jquery.qtip.min.js');
		$view_data['json'] = array('data_'.$lang.'_print.json', 'group_'.$lang.'_print.json', 'dates.json');
		$view_data['lang'] = $lang;
		$this->load->view('campaign_print.php', $view_data);
	}
	
	function campaign_detail_print($id, $lang)
	{
		$campaign = $this->mdl_campaigns->get_where(array('campaign_id' => $id))->row();
		$view_data['campaign_name'] = $campaign->campaign_title;
		$view_data['campaign_budget'] = $campaign->campaign_budget;
		$view_data['campaign_id'] = $id;

		$view_data['money_format'] = $lang."_CA.UTF-8";

		$campaign_type = $this->mdl_campaigns_types->get_where(array('campaign_type_id' => $campaign->campaign_type_id))->row();
		$view_data['campaign_type'] = @$campaign_type->campaign_type_name;

		$this->session->userdata['campaign_banner_id'] = $campaign->campaign_banner_id;

		$view_data['campaign_banner_name'] = $this->mdl_campaigns_banners->i18n_id_query($lang, $campaign->campaign_banner_id)->row();

		$view_data['javascript'] = array('datepicker-'.$lang.'.js', 'moment-with-locales.min.js', 'vis.js', 'moment-with-locales.min.js');
		$view_data['json'] = array('data_'.$id.'.json', 'data_group_'.$id.'.json', 'dates.json');
		$view_data['lang'] = $lang;
		$this->load->view('campaign_detail_print.php', $view_data);
	}

	function process_add_campaign()
	{
		$campaign_date_end = ((isempty($this->input->post('campaign_date_start'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_start'))->add(new DateInterval('P56D'))->format('Y-m-d'));
		$campaign_data = array(
			'client_id' => $this->session->userdata('site_client_id'),
			'campaign_type_id'=> $this->input->post('campaign_type_id'),
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title'),
			'campaign_city' => $this->input->post('campaign_city'),
			'campaign_date_start' => ((isempty($this->input->post('campaign_date_start'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_start'))->format('Y-m-d')),
			'campaign_date_evenement' => ((isempty($this->input->post('campaign_date_evenement'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_evenement'))->format('Y-m-d')),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address'),
			'campaign_manager_client'=> $this->input->post('campaign_manager_client'),
			'campaign_manager_tgi'=> $this->input->post('campaign_manager_tgi'),
			'campaign_budget'=> floatval($this->input->post('campaign_budget')),
			'campaign_active' => 1,
			'campaign_status' => $this->input->post('campaign_status')
		);
		$this->add_campaign($campaign_data);
	}

	function process_edit_campaign()
	{
		if (isempty($this->input->post('campaign_date_media_end')) && isempty(item($this->input->post('campaign_step_date_end'), 6)))
		{
			if (isempty($this->input->post('campaign_date_start'))) $campaign_date_end = null;
			else $campaign_date_end = DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_start'))->add(new DateInterval('P56D'))->format('Y-m-d');
		}
		else
		{
			if (DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_media_end')) > DateTime::createFromFormat('d/m/Y', item($this->input->post('campaign_step_date_end'), 6)))
			{
				$campaign_date_end = DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_media_end'))->format('Y-m-d');
			}
			else
			{
				$campaign_date_end = DateTime::createFromFormat('d/m/Y', item($this->input->post('campaign_step_date_end'), 6))->format('Y-m-d');
			}
		}

		$campaign_id = $this->input->post('campaign_id');
		$campaign_data = array(
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_project_number' => $this->input->post('campaign_project_number'),
			'campaign_store_number' => $this->input->post('campaign_store_number'),
			'campaign_title' => $this->input->post('campaign_title'),
			'campaign_city' => $this->input->post('campaign_city'),
			'campaign_date_start' => ((isempty($this->input->post('campaign_date_start'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_start'))->format('Y-m-d')),
			'campaign_date_end' => $campaign_date_end,
			'campaign_date_evenement' => ((isempty($this->input->post('campaign_date_evenement'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_evenement'))->format('Y-m-d')),
			'campaign_date_media_start' => ((isempty($this->input->post('campaign_date_media_start'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_media_start'))->format('Y-m-d')),
			'campaign_date_media_end' => ((isempty($this->input->post('campaign_date_media_end'))) ? null : DateTime::createFromFormat('d/m/Y', $this->input->post('campaign_date_media_end'))->format('Y-m-d')),
			'campaign_branch' => $this->input->post('campaign_branch'),
			'campaign_address'=> $this->input->post('campaign_address'),
			'campaign_manager_client'=> $this->input->post('campaign_manager_client'),
			'campaign_manager_tgi'=> $this->input->post('campaign_manager_tgi'),
			'campaign_budget'=> $this->input->post('campaign_budget'),
			'campaign_type_id'=> $this->input->post('campaign_type_id'),
			'campaign_status' => $this->input->post('campaign_status')
		);

		$this->update_campaign($campaign_id, $campaign_data);
	}

	function process_add_campaign_steps_data($update = 0)
	{
		$campaign_steps = array_for_dropdown($this->mdl_campaigns_steps->i18n_site_query($this->session->userdata('current_site_lang'))->result(), 'campaign_step_id');
		//var_dump($campaign_steps);
		foreach($campaign_steps as $campaign_step_id => $campaign_step)
		{
			if ($update)
			{
				$where = array('campaign_id' => $this->input->post('campaign_id'), 'campaign_step_id' => $campaign_step_id);
				$this->mdl_campaigns_steps_data->delete($where);
			}

			if (!isempty(item($this->input->post('campaign_step_date_start'), $campaign_step_id)) && !isempty(item($this->input->post('campaign_step_date_end'), $campaign_step_id)))
			{
				$campaign_step_data = array(
					'campaign_id' => $this->input->post('campaign_id'),
					'campaign_step_id' => $campaign_step_id,
					'campaign_step_date_start' => DateTime::createFromFormat('d/m/Y', item($this->input->post('campaign_step_date_start'), $campaign_step_id))->format('Y-m-d'),
					'campaign_step_date_end' => DateTime::createFromFormat('d/m/Y', item($this->input->post('campaign_step_date_end'), $campaign_step_id))->format('Y-m-d')
				);
				//var_dump($campaign_step_data);
				$this->add_campaign_step_data($campaign_step_data);
			}
		}
	}

	function process_document()
	{
		$campaign_manager = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_email' => $this->session->userdata('user_email')))->row();
		$campaign_id = $this->input->post('campaign_id');

		$config['upload_path'] = FCPATH.'assets/docs/';
		$config['upload_url'] = base_url().'assets/docs/';
		$config['allowed_types'] = 'pdf|doc|docx|ppt|pptx|xls|xlsx';
		$config['max_size']	= '100000';
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('upload_file'))
		{
			$this->session->set_userdata('error_message', $this->upload->display_errors());
			redirect('campaign/documents/'.$campaign_id);
		}
		else
		{
			$document = array('upload_data' => $this->upload->data());
			$campaign_document = array(
				'campaign_id' => $campaign_id,
				'campaign_document_name' => $document['upload_data']['file_name'],
				'campaign_document_date' => date('Y-m-d'),
				'campaign_document_size' => sizeFilter($document['upload_data']['file_size']),
				'campaign_document_type' => str_replace('.', '', $document['upload_data']['file_ext']),
				'campaign_document_user' => $campaign_manager->campaign_manager_id
			);

			$db_document = $this->mdl_campaigns_documents->get_where(array('campaign_document_name' => $document['upload_data']['file_name']))->row();

			if (empty($db_document))
			{
				$this->mdl_campaigns_documents->insert($campaign_document);
			}
			else
			{
				$this->mdl_campaigns_documents->update('campaign_document_id', $db_document->campaign_document_id, $campaign_document);
			}
			$this->session->set_userdata('success_message', lang('campaign.document.add.success'));
			redirect('campaign/documents/'.$campaign_id);
		}
	}
	
	function process_step()
	{
		$campaign_step_data = array(
			'campaign_step_active' => $this->input->post('campaign_step_active')
		);
		$this->update_campaign_step($this->input->post('campaign_step_id'),  $campaign_step_data);
		$this->update_campaign_i18n('campaigns_steps', $this->input->post('campaign_step_id'), $this->session->userdata('current_lang_id'), $this->input->post('campaign_step_name'));
		redirect('campaign/editstep/'.$this->input->post('campaign_step_id'));
	}
	
	function process_type()
	{
		$campaign_type_data = array(
			'campaign_type_active' => $this->input->post('campaign_type_active'),
			'campaign_type_color' => $this->input->post('campaign_type_color')
		);
		$this->update_campaign_type($this->input->post('campaign_type_id'),  $campaign_type_data);
		$this->update_campaign_i18n('campaigns_types', $this->input->post('campaign_type_id'), $this->session->userdata('current_lang_id'), $this->input->post('campaign_type_name'));
		$this->create_types_css_file();
		redirect('campaign/edittype/'.$this->input->post('campaign_type_id'));
	}
	
	function process_status()
	{
		$campaign_status_data = array(
			'campaign_status_active' => $this->input->post('campaign_status_active'),
			'campaign_status_color' => $this->input->post('campaign_status_color')
		);
		$this->update_campaign_status($this->input->post('campaign_status_id'),  $campaign_status_data);
		$this->update_campaign_i18n('campaigns_status', $this->input->post('campaign_status_id'), $this->session->userdata('current_lang_id'), $this->input->post('campaign_status_name'));
		$this->create_types_css_file();
		redirect('campaign/editstatus/'.$this->input->post('campaign_status_id'));
	}

	function process_new_step()
	{

		foreach ($this->input->post('new') as $new)
		{
			$new = trim($new);
			if (!empty($new))
			{
				$data = array('campaign_step_active' => 0);
				$data_i18n = array('table_name' => 'campaigns_steps',
								'table_id' => $this->mdl_campaigns_steps->insert($data),
								'language_id' => $this->session->userdata('current_lang_id'),
								'i18n_name' => $new);
				$this->mdl_campaigns_i18n->insert($data_i18n);
			}
		}
		$this->session->set_userdata('success_message', lang('language.success'));
		redirect('campaign/steps');
	}

	function process_new_type()
	{
		foreach ($this->input->post('new') as $new)
		{
			$new = trim($new);
			if (!empty($new))
			{
				$data = array('campaign_type_active' => 0);
				$data_i18n = array('table_name' => 'campaigns_types',
								'table_id' => $this->mdl_campaigns_types->insert($data),
								'language_id' => $this->session->userdata('current_lang_id'),
								'i18n_name' => $new);
				$this->mdl_campaigns_i18n->insert($data_i18n);
			}
		}

		$this->session->set_userdata('success_message', lang('language.success'));
		redirect('campaign/types');
	}
	
	function process_new_status()
	{
		foreach ($this->input->post('new') as $new)
		{
			$new = trim($new);
			if (!empty($new))
			{
				$data = array('campaign_status_active' => 0);
				$data_i18n = array('table_name' => 'campaigns_status',
								'table_id' => $this->mdl_campaigns_status->insert($data),
								'language_id' => $this->session->userdata('current_lang_id'),
								'i18n_name' => $new);
				$this->mdl_campaigns_i18n->insert($data_i18n);
			}
		}

		$this->session->set_userdata('success_message', lang('language.success'));
		redirect('campaign/status');
	}
	
	function delete_step($step_id)
	{
		$data_i18n = array('table_name' => 'campaigns_steps',
						'table_id' => $step_id,
						'language_id' => $this->session->userdata('current_lang_id'));
		$this->mdl_campaigns_i18n->delete($data_i18n);
		$this->session->set_userdata('success_message', lang('language.success'));
		redirect('campaign/steps');
	}
	
	function delete_type($type_id)
	{
		$data_i18n = array('table_name' => 'campaigns_types',
						'table_id' => $type_id,
						'language_id' => $this->session->userdata('current_lang_id'));
		$this->mdl_campaigns_i18n->delete($data_i18n);
		$this->session->set_userdata('success_message', lang('language.success'));
		$this->create_types_css_file();
		redirect('campaign/types');
	}
	
	function delete_status($status_id)
	{
		$data_i18n = array('table_name' => 'campaigns_status',
						'table_id' => $status_id,
						'language_id' => $this->session->userdata('current_lang_id'));
		$this->mdl_campaigns_i18n->delete($data_i18n);
		$this->session->set_userdata('success_message', lang('language.success'));
		$this->create_types_css_file();
		redirect('campaign/status');
	}

	function delete_document($campaign_id, $document_id)
	{
		$this->mdl_campaigns_documents->delete(array('campaign_document_id' => $document_id));

		$this->session->set_userdata('success_message', lang('campaign.document.delete.success'));
		redirect('campaign/documents/'.$campaign_id);
	}

	function file($file = null)
	{
		if (!$file) redirect('campaign');
		if (!$this->session->userdata('user_email')) redirect('login');

		set_time_limit(0);
		$file = FCPATH.'/assets/docs/'.$file;
		ob_end_flush();
		header('Content-type: application/octet-stream');
		$this->readfile_chunked($file);
	}

	function generate_campaign()
	{
		$holidays_i18n = array('fr' => 'Jours fériés', 'en' => 'Holidays');
		$languages = array_for_dropdown($this->mdl_language->get()->result(), 'language_code', 'language_name');
		//var_dump($languages);
		foreach($languages as $lang => $value)
		{
			$json = array();
			$json2 = array();
			$json_print = array();
			$json2_print = array();
			$campaign_groups = array();
			$campaign_ids = array();
			$campaign_names_flipped = array();
			$campaign_types = array_for_dropdown($this->mdl_campaigns_types->i18n_site_query($lang)->result(), 'campaign_type_id');
			$campaign_status = array_for_dropdown($this->mdl_campaigns_status->i18n_site_query($lang)->result(), 'campaign_status_id');
			$campaigns = $this->mdl_campaigns->get_where(array('campaign_active' => 1))->result();
			//var_dump($campaigns);
			$longest_campaing = $this->mdl_campaigns->custom_query("select campaign_city from campaigns where 1 ORDER BY LENGTH(campaign_city) DESC LIMIT 1")->row();
			$width = strlen($longest_campaing->campaign_city)*8;
			
			$css_text = ".vis-timeline .vis-labelset .vis-label .vis-inner {
				min-width: {$width}px!important;
				max-width: {$width}px!important;
				word-break:break-word!important;
			}";
			
			file_put_contents(FCPATH.'/assets/css/campaign_custom_'.$lang.'.css', $css_text);


			foreach($campaigns as $key => $campaign)
			{
				if ($campaign->campaign_status > 0)
				{
					$classname = friendly_url($campaign_status[$campaign->campaign_status]->campaign_status_name);
				}
				else 
				{
					if ($campaign->campaign_type_id == 0) $classname = '';
					else $classname = friendly_url($campaign_types[$campaign->campaign_type_id]->campaign_type_name);
				}
				//var_dump($campaign->campaign_banner_id);
				$banners = $this->mdl_campaigns_banners->i18n_id_query($lang, $campaign->campaign_banner_id);
				if ($banners->row())
				{
					$campaign_groups[$banners->row()->campaign_banner_name][] = $campaign->campaign_city;
					$campaign_ids[$banners->row()->campaign_banner_name][$campaign->campaign_city] = $campaign->campaign_id;
					
					$date_start = $this->mdl_campaigns->custom_query("select campaign_date_start from campaigns where campaign_banner_id = {$campaign->campaign_banner_id} order by campaign_date_start asc limit 1")->row();
					$date_end = $this->mdl_campaigns->custom_query("select campaign_date_end from campaigns where campaign_banner_id = {$campaign->campaign_banner_id} order by campaign_date_start desc limit 1")->row();
					
					$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
				
					$json_dates[$banners->row()->campaign_banner_name] = array(
						'start' =>  '__'.strtotime($date_start->campaign_date_start),
						'end' =>  '__'.strtotime($date_end->campaign_date_end)
					);
					
					$json[$lang][$banners->row()->campaign_banner_name][] = array(
							'start' =>  '__'.strtotime($campaign->campaign_date_start),
							'end' =>  '__'.strtotime($campaign->campaign_date_end),
							'content' =>  '<a href="/'.$lang.'/campaign/detail/'.$campaign->campaign_id.'" style="color:#555;font-weight:bold;" data-id="a_'.$campaign->campaign_id.'" class="popups" data-content="Campagne : '.$campaign->campaign_title.'<br />Date évènement : '.date('d/m/Y', strtotime($campaign->campaign_date_evenement)).'">'.$campaign->campaign_title.'</a>',
							'group' =>  (count($campaign_groups[$banners->row()->campaign_banner_name]) - 1),
							'id' =>  $campaign->campaign_id,
							'className' => $classname,
							'editable' => false
						);
						
					$json_print[$lang][$banners->row()->campaign_banner_name][] = array(
							'start' =>  '__'.strtotime($campaign->campaign_date_start),
							'end' =>  '__'.strtotime($campaign->campaign_date_end),
							'content' =>  $campaign->campaign_title,
							'group' =>  (count($campaign_groups[$banners->row()->campaign_banner_name]) - 1),
							'id' =>  $campaign->campaign_id,
							'className' => $classname,
							'editable' => false
						);
					
					if (!$campaign->campaign_date_evenement) $campaign->campaign_date_evenement = $campaign->campaign_date_end;
					$json[$lang][$banners->row()->campaign_banner_name][] = array(
						'start' =>  '__'.strtotime($campaign->campaign_date_evenement),
						'content' =>  ' ',
						'id' =>  'event_'.$key,
						'group' =>  (count($campaign_groups[$banners->row()->campaign_banner_name]) - 1),
						'className' => 'event',
					);
					$json_print[$lang][$banners->row()->campaign_banner_name][] = array(
						'start' =>  '__'.strtotime($campaign->campaign_date_evenement),
						'content' =>  ' ',
						'id' =>  'event_'.$key,
						'group' =>  (count($campaign_groups[$banners->row()->campaign_banner_name]) - 1),
						'className' => 'event',
					);
				}
			}
			
			

			foreach($campaign_groups as $key1 => $campaign_group)
			{
				$groups = array();
				$groups_print = array();
				foreach($campaign_group as $key2 => $campaign_name)
				{
					$groups[$key2] = '<a href="/'.$lang.'/campaign/detail/'.$campaign_ids[$key1][$campaign_name].'">'.$campaign_name.'</a>';
					$groups_print[$key2] = $campaign_name;
				}

				$groups[count($campaigns)] = '<a>'.$holidays_i18n[$lang].'</a>';
				$json2[$lang][$key1] = $groups;
				$json2_print[$lang][$key1] = $groups_print;
			}

			$json_names = json_encode($json2[$lang]);
			$json_names_print = json_encode($json2_print[$lang]);

			$json_data = json_encode($json[$lang]);
			$json_data_print = json_encode($json_print[$lang]);
			
			$json_data = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
				return 'new Date(' . ($e[1] * 1000) . ')';
			}, $json_data);
			
			$json_data_print = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
				return 'new Date(' . ($e[1] * 1000) . ')';
			}, $json_data_print);
			
			$json_names = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
				return 'new Date(' . ($e[1] * 1000) . ')';
			}, $json_names);
			
			$json_names_print = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
				return 'new Date(' . ($e[1] * 1000) . ')';
			}, $json_names_print);

			file_put_contents(FCPATH.'/assets/json/data_'.$lang.'.json',  'var jsonData = '.$json_data);
			file_put_contents(FCPATH.'/assets/json/data_'.$lang.'_print.json',  'var jsonData = '.$json_data_print);
			file_put_contents(FCPATH.'/assets/json/group_'.$lang.'.json',  'var groupData = '.$json_names);
			file_put_contents(FCPATH.'/assets/json/group_'.$lang.'_print.json',  'var groupData = '.$json_names_print);
			
			$this->generate_holidays($lang, count($campaigns));
		}
		
		$json_dates = json_encode($json_dates);
		$json_dates = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
			return 'new Date(' . ($e[1] * 1000) . ')';
		}, $json_dates);
		file_put_contents(FCPATH.'/assets/json/dates.json',  'var dates = '.$json_dates);
		
		
	}

	function generate_campaign_detail($id)
	{
		$json = array();
		$campaigns_steps_data = array_for_dropdown($this->mdl_campaigns_steps_data->get_where_order(array('campaign_id' => $id), 'campaign_step_id')->result(), 'campaign_step_id');
		$campaigns_steps = array_for_dropdown($this->mdl_campaigns_steps->i18n_site_query($this->session->userdata('current_site_lang'))->result(), 'campaign_step_id');

		$campaigns_steps_group = array();
		$i = 0;
		foreach($campaigns_steps as $key => $campaign_step)
		{
			$campaigns_steps_group [] = $campaign_step->campaign_step_name;
			if (isset($campaigns_steps_data[$key]))
			{
				$json[] = array(
					'start' =>  '__'.strtotime($campaigns_steps_data[$key]->campaign_step_date_start),
					'end' =>  '__'.strtotime($campaigns_steps_data[$key]->campaign_step_date_end),
					'content' =>  ' ',
					'group' =>  $i++,
					'id' =>  $campaigns_steps_data[$key]->campaign_step_data_id,
					'className' =>  'red',
					'editable' => false
				);
			}
		}

		$campaign = $this->mdl_campaigns->get_id('campaign_id', $id)->row();
		$campaigns_steps_group [] = 'Média';
		if ($campaign->campaign_date_media_start > 0 ||  $campaign->campaign_date_media_end > 0)
		{
			$json[] = array(
				'start' =>  '__'.strtotime($campaign->campaign_date_media_start),
				'end' =>  '__'.strtotime($campaign->campaign_date_media_end),
				'content' =>  ' ',
				'group' =>  $i++,
				'id' =>  'M'.$campaign->campaign_id,
				'className' => 'red',
				'editable' => false
			);
		}

		$json_names = json_encode($campaigns_steps_group);
		$json_data = json_encode($json);
		$json_data = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
			return 'new Date(' . ($e[1] * 1000) . ')';
		}, $json_data);

		file_put_contents(FCPATH.'/assets/json/data_'.$id.'.json',  'var jsonData = '.$json_data);
		file_put_contents(FCPATH.'/assets/json/data_group_'.$id.'.json',  'var groupData = '.$json_names);
	}

	function generate_holidays($lang, $group_id)
	{
		$json = array();
		$year = date('Y');
		$id = 0;
		
		$lang_holidays = array(
			'en' => array(
				'easter_monday' => "Easter Monday",
				'good_friday' => "Good Friday",
				'queen_patriots' => "Victoria Day",
				'labor_day' => "Labor Day",
				'thanks_giving' => "Thanksgiving",
				'saint_jean' => "Saint-Jean",
				'new_year' => "New Year",
				'christmas' => "Christmas",
				'canada_day' => "Canada Day"
			),
			'fr' => array(
				'easter_monday' => "Lundi de Pâques",
				'good_friday' => "Vendredi saint",
				'queen_patriots' => "Journée des patriotes",
				'labor_day' => "Fête du travail",
				'thanks_giving' => "Action de grâce",
				'saint_jean' => "Saint-Jean",
				'new_year' => "Jour de l'an",
				'christmas' => "Noël",
				'canada_day' => "Fête du Canada"
			)
		);
			
		for($y = $year - 5; $y <= $year + 5; $y++)
		{
			$holidays = get_holidays($y);
			foreach($holidays as $key => $holiday)
			{
				$json[] = array(
					'start' =>  $holiday,
					'content' =>  '<span class="holidays" data-id="'.$y.'_'.$key.'"data-content="'.$y.'_'.$key.'" title="'.$lang_holidays[$lang][$key].' '.$year.'"><img src="/assets/images/croix.png" style="width:10px; height:10px;"></span> ',
					'id' =>  $y.'_'.$key,
					'group' => $group_id,
					'className' => 'default',
				);
			}
		}
		$json_data = json_encode($json);
		file_put_contents(FCPATH.'/assets/json/holidays_'.$lang.'.json',  'var holidaysData = '.$json_data);
	}

	private function add_campaign($campaign_data)
	{
		$this->load->library('maildecorator');

		$campaign_id = $this->mdl_campaigns->insert($campaign_data);
		$this->process_add_campaign_steps_data($campaign_id);
		$this->generate_campaign();
		$this->generate_campaign_detail($campaign_id);
		//$this->generate_holidays();
		$this->session->set_userdata('success_message', lang('campaign.add.success'));

		$campaign_manager_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_id' => $campaign_data['campaign_manager_tgi']))->row();
		$messagedata = array($campaign_manager_tgi->campaign_manager_lastname, $campaign_manager_tgi->campaign_manager_name, $campaign_data['campaign_title'], site_url('campaign/detail/'.$campaign_id));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', 'skander.jabouzi@tonikgroupimage.com,hugo.carranza@tonikgroupimage.com'/*$campaign_manager_tgi->campaign_manager_email*/, lang('campaign.add'));
		$this->maildecorator->decorate($messagedata, lang('campaign.add.notification'));
		$this->maildecorator->sendmail($maildata);

		redirect('campaign/detail/'.$campaign_id);
	}

	private function update_campaign($campaign_id, $campaign_data)
	{
		$this->load->library('maildecorator');

		$this->mdl_campaigns->update('campaign_id', $campaign_id, $campaign_data);
		$this->process_add_campaign_steps_data(1);
		$this->generate_campaign();
		$this->generate_campaign_detail($campaign_id);
		$this->session->set_userdata('success_message', lang('campaign.edit.success'));

		$campaign_manager_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_id' => $campaign_data['campaign_manager_tgi']))->row();
		$messagedata = array($campaign_manager_tgi->campaign_manager_lastname, $campaign_manager_tgi->campaign_manager_name, $campaign_data['campaign_title'], site_url('campaign/detail/'.$campaign_id));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', 'skander.jabouzi@tonikgroupimage.com,hugo.carranza@tonikgroupimage.com'/*$campaign_manager_tgi->campaign_manager_email*/, lang('campaign.edit'));
		$this->maildecorator->decorate($messagedata, lang('campaign.edit.notification'));
		$this->maildecorator->sendmail($maildata);

		redirect('campaign/edit/'.$campaign_id);
	}

	private function add_campaign_step_data($campaign_step_data)
	{
		$campaign_step_data_id = $this->mdl_campaigns_steps_data->insert($campaign_step_data);
	}

	private function update_campaign_step($campaign_step_id, $campaign_step_data)
	{
		$this->mdl_campaigns_steps->update('campaign_step_id', $campaign_step_id, $campaign_step_data);
	}
	
	private function update_campaign_type($campaign_type_id, $campaign_type_data)
	{
		$this->mdl_campaigns_types->update('campaign_type_id', $campaign_type_id, $campaign_type_data);
	}
	
	private function update_campaign_status($campaign_status_id, $campaign_status_data)
	{
		$this->mdl_campaigns_status->update('campaign_status_id', $campaign_status_id, $campaign_status_data);
	}

	private function update_campaign_i18n($table_name, $table_id, $language_id, $i18n_name)
	{
		$campain_step_data = array('table_name' => $table_name, 'table_id' => $table_id, 'language_id' => $language_id);
		$this->mdl_campaigns_i18n->delete($campain_step_data);
		$campain_step_data['i18n_name'] = $i18n_name;
		$this->mdl_campaigns_i18n->insert($campain_step_data);
	}

	private function readfile_chunked($filename,$retbytes=true)
	{
		$chunksize = 1*(1024*1024);
		$buffer = '';
		$cnt =0;

		$handle = fopen($filename, 'rb');
		if ($handle === false) {
			return false;
		}
		while (!feof($handle)) {
			$buffer = fread($handle, $chunksize);
			echo $buffer;
			if ($retbytes) {
				$cnt += strlen($buffer);
			}
		}
			$status = fclose($handle);
		if ($retbytes && $status) {
			return $cnt;
		}
		return $status;

	}
	
	private function create_types_css_file()
	{
		$css_text = '';
		$campaign_types = $this->mdl_campaigns_types->i18n_query($this->session->userdata('current_lang'))->result();
		$campaign_status = $this->mdl_campaigns_status->i18n_query($this->session->userdata('current_lang'))->result();
		foreach($campaign_types as $campaign_type)
		{
			$classname = friendly_url($campaign_type->campaign_type_name);
			$classcolor = $campaign_type->campaign_type_color;
			$css_text .= "div.{$classname} {\n background-color: {$classcolor};\n border-color: {$classcolor};\n cursor:pointer;\n }\n";
		}
		
		foreach($campaign_status as $campaign_status)
		{
			$classname = friendly_url($campaign_status->campaign_status_name);
			$classcolor = $campaign_status->campaign_status_color;
			$css_text .= "div.{$classname} {\n background-color: {$classcolor};\n border-color: {$classcolor};\n cursor:pointer;\n }\n\n";
		}
		file_put_contents(FCPATH.'/assets/css/campaign_types_'.$this->session->userdata('current_lang').'.css', $css_text);
	}
}

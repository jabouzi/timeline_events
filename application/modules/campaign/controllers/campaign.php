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
		$this->load->model('mdl_campaigns_steps_types');
		$this->load->model('mdl_campaigns_types');
		$this->load->model('mdl_campaigns_documents');
		$this->load->helper(array('form', 'url'));
	}
	
	function index()
	{
		$view_data['page_title'] = lang('dashboard.title3');

		$banners = $this->mdl_campaigns_banners->get();
		$campaign_data['banners'] = $banners->result();
		$view_data['javascript'] = array('vis.js','moment-with-locales.min.js');
		$view_data['json'] = array('data.json', 'group.json', 'holidays.json');
		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign.php', $campaign_data, true);
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
		
		$campaign_documents = 
		
		$this->session->userdata['campaign_banner_id'] = $campaign->campaign_banner_id;
		
		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_detail.php', $campaign_data, true);
		$view_data['javascript'] = array('vis.js','moment-with-locales.min.js');
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
		$campaign_steps_types = $this->mdl_campaigns_steps_types->get()->result();
		
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
			'campaign_date_media_start' => date('Y-m-d', strtotime($this->input->post('campaign_date_media_start'))),
			'campaign_date_media_end' => date('Y-m-d', strtotime($this->input->post('campaign_date_media_end'))),
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
			'campaign_date_media_start' => date('Y-m-d', strtotime($this->input->post('campaign_date_media_start'))),
			'campaign_date_media_end' => date('Y-m-d', strtotime($this->input->post('campaign_date_media_end'))),
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
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_userdata('error_message', $error);
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
	
	private function add_campaign($campaign_data)
	{
		$this->load->library('maildecorator');

		$campaign_id = $this->mdl_campaigns->insert($campaign_data);
		$this->process_add_campaign_steps($campaign_id);
		$this->generate_campaign();
		$this->generate_campaign_detail($campaign_id);
		$this->generate_holidays();
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
		$this->process_add_campaign_steps(1);
		$this->generate_campaign();
		$this->generate_campaign_detail($campaign_id);
		$this->generate_holidays();
		$this->session->set_userdata('success_message', lang('campaign.edit.success'));
		
		$campaign_manager_tgi = $this->mdl_campaigns_project_managers->get_where(array('campaign_manager_id' => $campaign_data['campaign_manager_tgi']))->row();
		$messagedata = array($campaign_manager_tgi->campaign_manager_lastname, $campaign_manager_tgi->campaign_manager_name, $campaign_data['campaign_title'], site_url('campaign/detail/'.$campaign_id));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', 'skander.jabouzi@tonikgroupimage.com,hugo.carranza@tonikgroupimage.com'/*$campaign_manager_tgi->campaign_manager_email*/, lang('campaign.edit'));
		$this->maildecorator->decorate($messagedata, lang('campaign.edit.notification'));
		$this->maildecorator->sendmail($maildata);

		redirect('campaign/edit/'.$campaign_id);
	}
	
	private function add_campaign_step($campaign_step_data)
	{
		$campaign_step_id = $this->mdl_campaigns_steps->insert($campaign_step_data);
	}
	
	private function update_campaign_step($campaign_step_id, $campaign_step_data)
	{
		$this->mdl_campaigns_steps->update('campaign_step_id', $campaign_step_id, $campaign_step_data);
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
	
	function generate_campaign()
	{
		$json = array();
		
		$campaign_types = array_for_dropdown($this->mdl_campaigns_types->get()->result(), 'campaign_type_id');
		$campaigns = $this->mdl_campaigns->get_where(array('campaign_active' => 1))->result();
		foreach($campaigns as $key => $campaign)
		{
			$campaign_names = $this->mdl_campaigns->get_distinct('campaign_title', 'campaign_banner_id', $campaign->campaign_banner_id, 'campaign_title asc')->result();
			$campaign_names = $this->mdl_campaigns->get_group('campaign_title', 'campaign_banner_id', $campaign->campaign_banner_id, 'campaign_title asc')->result();
			//var_dump($campaign_names);exit;
			foreach($campaign_names as $key => $campaign_name)
			{
				$campaign_groups[$key] = $campaign_name->campaign_title;
			}
			
			$campaign_names_flipped = array_flip($campaign_groups);
			$banners = $this->mdl_campaigns_banners->get_where(array('campaign_banner_id' => $campaign->campaign_banner_id));
            $json[$banners->row()->campaign_banner_name][] = array(
					'start' =>  '__'.strtotime($campaign->campaign_date_start),
					'end' =>  '__'.strtotime($campaign->campaign_date_end),
					'content' =>  '<a href="'.site_url('campaign/detail/'.$campaign->campaign_id).'" style="color:#555;font-weight:bold;" id="a_'.$campaign->campaign_id.'" class="popups" data-content="'.$campaign->campaign_title.'">'.date('m/d/Y', strtotime($campaign->campaign_date_evenement)).'</a>',
					'group' =>  $campaign_names_flipped[$campaign->campaign_title],
					'id' =>  $campaign->campaign_id,
					'className' =>  ($campaign->campaign_type_id == 0) ? 'default' : friendly_url($campaign_types[$campaign->campaign_type_id]->campaign_type_name),
					'editable' => false
				);
			foreach($campaign_names as $key => $campaign_name)
			{
				$campaign_groups[$key] = '<a href="'.site_url('campaign/detail/'.$campaign_name->campaign_id).'">'.$campaign_name->campaign_title.'</a>';
			}
			$campaign_groups[9] = 'Holidays';
			$json2[$banners->row()->campaign_banner_name] = $campaign_groups;
		}
		
		
		$json_names = json_encode($json2);
		$json_data = json_encode($json);
		$json_data = preg_replace_callback('/"__([0-9]{10})"/u', function ($e) {
			return 'new Date(' . ($e[1] * 1000) . ')';
		}, $json_data);

		file_put_contents(FCPATH.'/assets/json/data.json',  'var jsonData = '.$json_data);
		file_put_contents(FCPATH.'/assets/json/group.json',  'var groupData = '.$json_names);
	}
	
	function generate_campaign_detail($id)
	{
		$json = array();
		$campaigns_steps = $this->mdl_campaigns_steps->get_where_order(array('campaign_id' => $id), 'campaign_step_type')->result();
		$campaigns_steps_types = array_for_dropdown($this->mdl_campaigns_steps_types->get()->result(), 'campaign_step_type_id');
		$campaigns_steps_group = array();
		$i = 0;
		foreach($campaigns_steps as $key => $campaign_step)
		{
			$campaigns_steps_group [] = $campaigns_steps_types[$campaign_step->campaign_step_type]->campaign_step_type_name;
            $json[] = array(
					'start' =>  '__'.strtotime($campaign_step->campaign_step_date_start),
					'end' =>  '__'.strtotime($campaign_step->campaign_step_date_end),
					'content' =>  ' ',
					'group' =>  $i++,
					'id' =>  $campaign_step->campaign_step_id,
					'className' =>  'red',
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
	
	function generate_holidays()
	{
		$json = array();
		$year = date('Y');
		$id = 0;
		for($y = $year - 2; $y <= $year + 2; $y++)
		{
			$holidays = get_holidays($y);
			foreach($holidays as $key => $holiday)
			{
				$json[] = array(
					'start' =>  $holiday,
					'content' =>  $key,
					'id' =>  (1000+($id++)),
					'group' => 9
				);
			}
		}
		$json_data = json_encode($json);
		file_put_contents(FCPATH.'/assets/json/holidays.json',  'var holidaysData = '.$json_data);
	}
	
	
	
	function test()
	{
		$view_data['page_title'] = lang('dashboard.title3');

		$banners = $this->mdl_campaigns_banners->get();
		$campaign_data['banners'] = $banners->result();

		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_test.php', array(), true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function test2()
	{
		$view_data['page_title'] = lang('dashboard.title3');

		$banners = $this->mdl_campaigns_banners->get();
		$campaign_data['banners'] = $banners->result();

		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_test2.php', array(), true);
		echo modules::run('template/campaign', $view_data);
	}
	
	function test3()
	{
		$view_data['page_title'] = lang('dashboard.title3');

		$banners = $this->mdl_campaigns_banners->get();
		$campaign_data['banners'] = $banners->result();

		$view_data['campaign_widgets']['campaign'] = $this->load->view('campaign_test3.php', array(), true);
		echo modules::run('template/campaign', $view_data);
	}
}

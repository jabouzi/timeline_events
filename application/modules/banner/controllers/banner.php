<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		include APPPATH . 'helpers/DatabaseTrait.php';
		$this->load->model('campaign/mdl_campaigns_banners');
		$this->load->model('campaign/mdl_campaigns_i18n');
		$this->load->model('client/mdl_client');
		$this->load->model('language/mdl_language');
		$this->load->library('encrypt');
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{

	}

	function banners($lang = 'fr')
	{
		$view_data['page_title'] = lang('banner.list');
		$query = "SELECT campaigns_banners.campaign_banner_id, campaigns_i18n.i18n_name as campaign_banner_name, toolbox_clients.client_name 
		FROM campaigns_banners, toolbox_clients, campaigns_i18n, toolbox_languages
		WHERE campaigns_banners.client_id = toolbox_clients.client_id
		AND campaigns_i18n.table_name = 'campaigns_banners'
		AND campaigns_i18n.table_id = campaigns_banners.campaign_banner_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		$data['banners'] = $this->mdl_campaigns_banners->custom_query($query);
		$languages = $this->mdl_language->get()->result();
		$data['languages'] = array_for_dropdown($languages, 'language_code', 'language_name');
		$data['language_code'] = $lang;
		$view_data['admin_widgets']['banner'] = $this->show('banners_list', $data);
		echo modules::run('template', $view_data);
	}

	function newbanner()
	{
		if ($this->session->userdata('user_permission') > 2) redirect('dashboard');
		$view_data['page_title'] = lang('banner.new');
		$data['clients'] = array_for_dropdown($this->mdl_client->get(), 'client_id', 'client_name');
		$languages = $this->mdl_language->get()->result();
		$data['languages'] = array_for_dropdown($languages, 'language_id', 'language_name');
		$view_data['admin_widgets']['user'] = $this->show('newbanner', $data);
		echo modules::run('template', $view_data);
	}

	function editbanner($banner_id = 0, $lang = 'fr')
	{
		if (!$banner_id) redirect('dashboard');
		$data['banner'] = $this->mdl_campaigns_banners->get_id('campaign_banner_id', $banner_id)->row();
		$data['clients'] = array_for_dropdown($this->mdl_client->get(), 'client_id', 'client_name');
		$languages = $this->mdl_language->get()->result();
		$data['languages'] = array_for_dropdown($languages, 'language_code', 'language_name');
		$data['language_code'] = $lang;
		$view_data['page_title'] = lang('banner.edit');
		$view_data['admin_widgets']['banner'] = $this->show('editbanner', $data);
		echo modules::run('template', $view_data);
	}

	function delete_banner($banner_id)
	{
		if (!$banner_id) redirect('dashboard');
		$where = array('campaign_banner_id' => $banner_id);
		$this->mdl_campaigns_banners->delete($where);
		$this->session->set_userdata('success_message', lang('banner.delete.success'));
		redirect('banner/banners');
	}

	function get_bannerlist_dropdown()
	{
		$banners = array();
		$where = array('banner_active = ' => 1 );
		$results = $this->mdl_banner->get_where($where);
		foreach($results->result() as $banner)
		{
			$banners[$banner->banner_id] = $banner->banner_name;
		}

		return $banners;
	}

	private function show($view, $banner_data)
	{
		$this->load->helper('form');
		$view_data = $banner_data;
		return $this->load->view($view.'.php', $view_data, true);
	}

	function process_newbanner()
	{
		$banner_data = array(
			'client_id' => $this->input->post('client_id')
		);
		
		$banner_i18n_data = array(
			'table_name' => 'campaigns_banners',
			'i18n_name' => $this->input->post('campaign_banner_name'),
			'language_id' => $this->input->post('language_id')
		);

		$this->add_banner($banner_data, $banner_i18n_data);
	}

	function process_editbanner()
	{
		$banner_data = array(
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
			'campaign_banner_name' => $this->input->post('campaign_banner_name'),
			'client_id' => $this->input->post('client_id')
		);

		$this->edit_banner($banner_data);
	}

	private function add_banner($banner_data, $banner_i18n_data)
	{
		$banner_i18n_data['table_id'] = $this->mdl_campaigns_banners->insert($banner_data);
		var_dump($banner_i18n_data['table_id']);
		$this->mdl_campaigns_i18n->insert($banner_i18n_data);
		$this->session->set_userdata('success_message', lang('banner.success'));
		redirect('banner/editbanner/'.$banner_i18n_data['table_id']);
	}
	
	private function edit_banner($banner_data)
	{
		$this->mdl_campaigns_banners->update('campaign_banner_id', $banner_data['campaign_banner_id'], $banner_data);
		$this->session->set_userdata('success_message', lang('banner.success'));
		redirect('banner/editbanner/'.$banner_data['campaign_banner_id']);
	}
	
	function banner_exists($banner_name, $banner_id = 0)
	{
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_campaigns_banners->count(array('campaign_banner_name' => urldecode($banner_name), 'campaign_banner_id != ' => $banner_id))) echo lang('banner.exists');
			else echo 0;
		}
	}
}

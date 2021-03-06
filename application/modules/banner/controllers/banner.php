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

	function banners()
	{
		$view_data['page_title'] = lang('banner.list');
		$data['banners'] = $this->mdl_campaigns_banners->i18n_query($this->session->userdata('current_lang'));
		$view_data['admin_widgets']['banner'] = $this->show('banners_list', $data);
		echo modules::run('template', $view_data);
	}

	function newbanner()
	{
		if ($this->session->userdata('user_permission') > 2) redirect('dashboard');
		$view_data['page_title'] = lang('banner.new');
		$data['clients'] = array_for_dropdown($this->mdl_client->get(), 'client_id', 'client_name');
		$languages = $this->mdl_language->get()->result();
		$view_data['admin_widgets']['user'] = $this->show('newbanner', $data);
		echo modules::run('template', $view_data);
	}

	function editbanner($banner_id = 0)
	{
		if (!$banner_id) redirect('dashboard');
		$data['banner'] = $this->mdl_campaigns_banners->get_id('campaign_banner_id', $banner_id)->row();
		$banner_i18n = $this->mdl_campaigns_i18n->get_where(array('table_name' => 'campaigns_banners', 'table_id' => $banner_id, 'language_id' => $this->session->userdata('current_lang_id')))->row();
		if ($banner_i18n)
		{
			$data['banner']->campaign_banner_name = $banner_i18n->i18n_name;
		}
		else
		{
			$data['banner']->campaign_banner_name = '';
		}
		$data['clients'] = array_for_dropdown($this->mdl_client->get(), 'client_id', 'client_name');
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
			'language_id' => $this->session->userdata('current_lang_id')
		);

		$this->add_banner($banner_data, $banner_i18n_data);
	}

	function process_editbanner($lang)
	{
		$banner_data = array(
			'client_id' => $this->input->post('client_id'),
			'campaign_banner_id' => $this->input->post('campaign_banner_id'),
		);
		
		$banner_i18n_data = array(
			'table_name' => 'campaigns_banners',
			'table_id' => $this->input->post('campaign_banner_id'),
			'language_id' => $this->session->userdata('current_lang_id')
		);

		$this->edit_banner($banner_data, $banner_i18n_data, $this->input->post('campaign_banner_name'), $lang);
	}

	private function add_banner($banner_data, $banner_i18n_data)
	{
		$banner_i18n_data['table_id'] = $this->mdl_campaigns_banners->insert($banner_data);
		$this->mdl_campaigns_i18n->insert($banner_i18n_data);
		$this->session->set_userdata('success_message', lang('banner.success'));
		redirect('banner/editbanner/'.$banner_i18n_data['table_id']);
	}
	
	private function edit_banner($banner_data, $banner_i18n_data, $i18n_name, $lang)
	{
		$this->mdl_campaigns_banners->update('campaign_banner_id', $banner_data['campaign_banner_id'], $banner_data);
		$this->update_campaign_i18n($banner_i18n_data, $i18n_name);
		$this->session->set_userdata('success_message', lang('banner.success'));
		redirect('banner/editbanner/'.$banner_data['campaign_banner_id'].'/'.$lang);
	}
	
	function banner_exists($banner_name, $banner_id = 0)
	{
		echo 0;
		return;
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_campaigns_banners->count(array('campaign_banner_name' => urldecode($banner_name), 'campaign_banner_id != ' => $banner_id))) echo lang('banner.exists');
			else echo 0;
		}
	}
	
	private function update_campaign_i18n($banner_i18n_data, $i18n_name)
	{
		$this->mdl_campaigns_i18n->delete($banner_i18n_data);
		$banner_i18n_data['i18n_name'] = $i18n_name;
		$this->mdl_campaigns_i18n->insert($banner_i18n_data);
	}
}

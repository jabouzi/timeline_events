<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		include APPPATH . 'helpers/DatabaseTrait.php';
		$this->load->model('campaign/mdl_campaigns_banners');
		$this->load->model('client/mdl_client');
		$this->load->library('encrypt');
	}

	function index()
	{

	}

	function banners()
	{
		$view_data['page_title'] = lang('banner.list');
		$query = "SELECT campaigns_banners.*, toolbox_clients.client_name FROM campaigns_banners, toolbox_clients WHERE campaigns_banners.client_id = toolbox_clients.client_id";
		$data['banners'] = $this->mdl_campaigns_banners->custom_query($query);
		$view_data['admin_widgets']['banner'] = $this->show('banners_list', $data);
		echo modules::run('template', $view_data);
	}

	function newbanner()
	{
		if ($this->session->userdata('user_permission') > 2) redirect('dashboard');
		$view_data['page_title'] = lang('banner.new');
		$data['clients'] = array_for_dropdown($this->mdl_client->get(), 'client_id', 'client_name');
		$view_data['admin_widgets']['user'] = $this->show('newbanner', $data);
		echo modules::run('template', $view_data);
	}

	function editbanner($banner_id = 0)
	{
		if (!$banner_id) redirect('dashboard');
		$data['banner'] = $this->mdl_campaigns_banners->get_id('campaign_banner_id', $banner_id)->row();
		$data['clients'] = array_for_dropdown($this->mdl_client->get(), 'client_id', 'client_name');
		$view_data['page_title'] = lang('banner.edit');
		$view_data['admin_widgets']['banner'] = $this->show('editbanner', $data);
		echo modules::run('template', $view_data);
	}

	function delete_banner($banner_id)
	{
		if (!$banner_id) redirect('dashboard');
		$this->mdl_banner->delete($banner_id);
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
			'campaign_banner_name' => $this->input->post('campaign_banner_name'),
			'client_id' => $this->input->post('client_id')
		);

		$this->add_banner($banner_data);
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

	private function add_banner($banner_data)
	{
		$banner_id = $this->mdl_campaigns_banners->insert($banner_data);
		$this->session->set_userdata('success_message', lang('banner.success'));
		redirect('banner/editbanner/'.$banner_id);
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

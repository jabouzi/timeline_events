<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('language/mdl_language');
	}
	
	function index($view_data = array())
	{
		if ($this->session->userdata('user_email'))
		{
			if ($this->session->userdata['user_permission'] > 1) redirect('campaign');
			
			$this->load->helper('form');
			$this->load->helper('array');
			
			$view_data['info_message'] = $this->session->userdata('info_message');
			$view_data['warning_message'] = $this->session->userdata('warning_message');
			$view_data['error_message'] = $this->session->userdata('error_message');
			$view_data['success_message'] = $this->session->userdata('success_message');

			$languages = array_for_dropdown($this->mdl_language->get()->result(), 'language_code', 'language_name');
			$default_lang = $this->mdl_language->get_where("language_default = '1'")->row();
			modules::run('user/add_session_data', 'default_lang' , $default_lang->language_code);
			if (!$this->session->userdata('current_lang'))
			{
				modules::run('user/add_session_data', 'current_lang' , $default_lang->language_code);
				modules::run('user/add_session_data', 'current_lang_id' , $default_lang->language_id);
			}

			$view_data['current_lang'] = $this->session->userdata('current_lang');
			$view_data['site_languages'] = $languages;
			$view_data['default_lang'] = $this->session->userdata('default_lang');

			foreach($this->lang->languages as $key => $value)
			{
				$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
			}
			$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
			$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
			$view_data['submit'] = 'onChange="$(\'#change_lang\').submit();"';
			$this->load->view('template', $view_data);
			$this->session->unset_userdata('warning_message');
			$this->session->unset_userdata('info_message');
			$this->session->unset_userdata('error_message');
			$this->session->unset_userdata('success_message');
		}
		else
		{
			redirect('login');
		}
	}
	
	function campaign($view_data = array())
	{
		if ($this->session->userdata('user_email'))
		{
			$view_data['info_message'] = $this->session->userdata('info_message');
			$view_data['warning_message'] = $this->session->userdata('warning_message');
			$view_data['error_message'] = $this->session->userdata('error_message');
			$view_data['success_message'] = $this->session->userdata('success_message');
			
			$languages = array_for_dropdown($this->mdl_language->get()->result(), 'language_code', 'language_name');
			$default_lang = $this->mdl_language->get_where("language_default = '1'")->row();
			modules::run('user/add_session_data', 'default_lang' , $default_lang->language_code);
			if (!$this->session->userdata('current_lang'))
			{
				modules::run('user/add_session_data', 'current_site_lang' , $default_lang->language_code);
				modules::run('user/add_session_data', 'current_site_lang_id' , $default_lang->language_id);
			}
			
			//foreach($languages as $key => $value)
			//{
				//$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
			//}
			
			$view_data['current_lang'] = $this->session->userdata('current_site_lang');
			$view_data['site_languages'] = $languages;
			
			$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
			$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
			$view_data['submit'] = 'onChange="$(\'#change_site_lang\').submit();"';
			$this->load->view('campaign', $view_data);
			$this->session->unset_userdata('warning_message');
			$this->session->unset_userdata('info_message');
			$this->session->unset_userdata('error_message');
			$this->session->unset_userdata('success_message');
		}
		else
		{
			redirect('login');
		}
	}
	
	function change_language()
	{
		$language = $this->mdl_language->get_where("language_code = '".$this->input->post('site_language')."'")->row();
		modules::run('user/add_session_data', 'current_lang' , $language->language_code);
		modules::run('user/add_session_data', 'current_lang_id' , $language->language_id);
		redirect($this->input->post('current_uri'));
	}
	
	function change_site_language()
	{
		$redirect = site_url().str_replace($this->session->userdata('current_site_lang'), $this->input->post('site_language'), $this->input->post('current_site_uri'));
		$language = $this->mdl_language->get_where("language_code = '".$this->input->post('site_language')."'")->row();
		modules::run('user/add_session_data', 'current_site_lang' , $language->language_code);
		modules::run('user/add_session_data', 'current_site_lang_id' , $language->language_id);
		redirect($redirect);
	}
}

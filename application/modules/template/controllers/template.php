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
			$this->load->helper('form');
			$this->load->helper('array');
			
			$view_data['info_message'] = $this->session->userdata('info_message');
			$view_data['warning_message'] = $this->session->userdata('warning_message');
			$view_data['error_message'] = $this->session->userdata('error_message');
			$view_data['success_message'] = $this->session->userdata('success_message');

			if (!in_array(item($this->uri->segment_array(), 2), array('language','user','manager','client')))
			{
				$languages = array_for_dropdown($this->mdl_language->get()->result(), 'language_code', 'language_name');
				if (!$this->session->userdata('current_lang'))  modules::run('user/add_session_data', 'current_lang', 'fr');
			}

			$view_data['current_lang'] = $this->session->userdata('current_lang');

			foreach($this->lang->languages as $key => $value)
			{
				$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
			}
			$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
			$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
			$view_data['submit'] = 'onChange="$(\'#change_site_lang\').submit();"';
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
			
			foreach($this->lang->languages as $key => $value)
			{
				$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
			}
			$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
			$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
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
	
	function change_site_language()
	{
		modules::run('user/add_session_data', 'current_lang' , $this->input->post('site_language'));
		redirect($this->input->post('current_uri'));
	}
}

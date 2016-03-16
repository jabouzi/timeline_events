<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_language');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('language.title');
		$view_data['admin_widgets']['languages'] = $this->show();
		echo modules::run('template', $view_data);
	}
	
	private function show()
	{
		$this->load->helper('form');
		$results = $this->mdl_language->get();
		$view_data['languages'] = $results;
		return $this->load->view('language', $view_data, true);
	}
	
	function process()
	{
		$this->load->helper('array');
		foreach($this->input->post('language_name') as $id => $name)
		{
			$data = array('language_name' => $name, 'language_code' => element($id, $this->input->post('language_code')), 'language_default' => (int)(intval($this->input->post('language_default')) == $id));
			$this->update_language($id, $data);
		}
		
		foreach ($this->input->post('new') as $new)
		{
			$new = trim($new);
			if (!empty($new))
			{
				$data = array('language_name' => $new);
				$this->add_language($data);
			}
		}
		
		$this->session->set_userdata('success_message', lang('language.success'));
		redirect('language');
	}
	
	function get_languages()
	{
		if ($this->cache->memcached->get('site_languages')) return $this->cache->memcached->get('site_languages');
		$languages = $this->mdl_language->get('language_default DESC, language_name ASC');
		$this->cache->memcached->save('site_languages', $languages->result());
		return $languages->result();
	}
	
	
	function get_default_language()
	{
		$where = array('language_default = ' => (int)'1');
		$language = $this->mdl_language->get_where($where)->row();		
		return $language->language_id;
	}
	
	function delete_language($language_id)
	{
		$this->mdl_language->delete($language_id);
		$this->session->set_userdata('success_message', lang('language.success'));
		redirect('language');
	}
	
	private function add_language($language_data)
	{
		$language_id = $this->mdl_language->insert($language_data);
	}
	
	private function update_language($language_id, $language_data)
	{
		$this->mdl_language->update($language_id, $language_data);
	}
}

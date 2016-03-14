<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		include APPPATH . 'helpers/DatabaseTrait.php';
		$this->load->model('mdl_manager');
		$this->load->library('encrypt');
		$this->load->library('maildecorator');
	}

	function index()
	{
		$view_data['page_title'] = lang('manager.profile');
		$user_profile = $this->mdl_manager->get_id($this->session->userdata('user_id'));
		$view_data['admin_widgets']['user'] = $this->show('projectmanagers', $user_profile);
		echo modules::run('template', $view_data);
	}

	function projectmanagers()
	{
		$view_data['page_title'] = lang('manager.users');
		$users = $this->mdl_manager->get();
		$view_data['admin_widgets']['user'] = $this->show('projectmanagers', $users);
		echo modules::run('template', $view_data);
	}

	function newprojectmanager()
	{
		if ($this->session->userdata('user_permission') > 1) redirect('dashboard');
		$view_data['page_title'] = lang('manager.new');
		$view_data['admin_widgets']['user'] = $this->show('newprojectmanager', array());
		echo modules::run('template', $view_data);
	}

	function editprojectmanager($pm_id = 0)
	{
		if (!$pm_id) redirect('dashboard');
		$pm_id_profile = $this->mdl_manager->get_id('campaign_manager_id', $pm_id)->row();
		$view_data['page_title'] = lang('manager.edit');
		$view_data['admin_widgets']['user'] = $this->show('projectmanager', $pm_id_profile);
		echo modules::run('template', $view_data);
	}

	function delete_manager($pm_id)
	{
		if (!$pm_id) redirect('dashboard');
		$where = array('campaign_manager_id' => $pm_id);
		$this->mdl_manager->delete($where);
		$this->session->set_userdata('success_message', lang('manager.delete.success'));
		redirect('manager/projectmanagers');
	}

	function get_clientlist_dropdown()
	{
		$clients = array();
		$where = array('client_active = ' => 1 );
		$results = $this->mdl_manager->get_where($where);
		foreach($results->result() as $client)
		{
			$clients[$client->client_id] = $client->client_name;
		}

		return $clients;
	}

	private function show($view, $user_data)
	{
		$this->load->helper('form');
		$view_data['user'] = $user_data;
		$view_data['status'] = array(0 => lang('manager.inactive'), 1 => lang('manager.active'));
		$view_data['tgi'] = array(0 => lang('general.no'), 1 => lang('general.yes'));
		$view_data['permissions'] = modules::run('permission/get_permissions_dropdown');
		return $this->load->view($view.'.php', $view_data, true);
	}

	function process_newprojectmanager()
	{

		$pm_id_data = array(
			'campaign_manager_name' => $this->input->post('campaign_manager_name'),
			'campaign_manager_lastname' => $this->input->post('campaign_manager_lastname'),
			'campaign_manager_email' => $this->input->post('campaign_manager_email'),
			'campaign_manager_tgi' => (int)$this->session->userdata('campaign_manager_tgi'),
			'campaign_manager_active' => (int)($this->input->post('campaign_manager_active'))
		);

		$this->add_projectmanager($pm_id_data);
	}

	function process_projectmanager()
	{
		$pm_id = $this->input->post('campaign_manager_id');
		$profile_data = array(
			'campaign_manager_name' => $this->session->userdata('campaign_manager_name'), 
			'campaign_manager_lastname' => $this->session->userdata('campaign_manager_lastname'), 
			'campaign_manager_email' => $this->session->userdata('campaign_manager_email'), 
			'campaign_manager_tgi' => (int)$this->session->userdata('campaign_manager_tgi'),
			'campaign_manager_active' => (int)$this->session->userdata('campaign_manager_active')
		);
		$pm_id_data = array(
			'campaign_manager_name' => $this->input->post('campaign_manager_name'), 
			'campaign_manager_lastname' => $this->input->post('campaign_manager_lastname'), 
			'campaign_manager_email' => $this->input->post('campaign_manager_email'),
			'campaign_manager_tgi' => (int)$this->input->post('campaign_manager_tgi'),
			'campaign_manager_active' => (int)$this->input->post('campaign_manager_active')
		);
		
		if (count(compare_profile($profile_data, $pm_id_data)))
		{
			$this->update_projectmanager($pm_id, $pm_id_data);
		}
		redirect('manager');
	}

	private function add_projectmanager($pm_id_data)
	{
		$pm_id = $this->mdl_manager->insert($pm_id_data);
		$this->session->set_userdata('success_message', lang('manager.success'));
		$client = $this->mdl_manager->get_id($pm_id);
		$messagedata = array($client->client_name, $client->client_logo, site_url(), $client->client_primary_color,$client->client_secondary_color,$client->client_font_primary_color,$client->client_font_secondary_color );
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox',$user->user_email, lang('manager.add'));
		$this->maildecorator->decorate($messagedata, lang('mail.createuser'));
		$this->maildecorator->sendmail($maildata);
		redirect('manager/editprojectmanager/'.$pm_id);
	}

	private function update_projectmanager($pm_id, $pm_id_data)
	{
		$this->mdl_manager->update('campaign_manager_id', $pm_id, $pm_id_data);
		$this->session->set_userdata('success_message', lang('manager.success'));
		$manager = $this->mdl_manager->get_id('campaign_manager_id', $pm_id)->row();
		$messagedata = array($manager->campaign_manager_name, $manager->campaign_manager_lastname);
		if (isset($pm_id_data['user_password']))
		{
			$this->maildecorator->decorate($messagedata, lang('mail.updatepassword'));
			$subject = lang('profile.password.update');
		}
		else
		{
			$this->maildecorator->decorate($messagedata, lang('mail.updateprofile'));
			$subject = lang('profile.update');
		}
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $manager->campaign_manager_email, $subject);
		//$this->maildecorator->sendmail($maildata);

		redirect('manager/editprojectmanager/'.$pm_id);
	}

	function email_exists($email, $user_id = 0)
	{
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_manager->count_where(array('user_email' => urldecode($email), 'user_id != ' => $user_id))) echo lang('manager.exists');
			else echo 0;
		}
	}

	function good_password($password, $user_id)
	{
		if ($this->input->is_ajax_request())
		{
			if ($user_id == $this->session->userdata('user_id'))
			{
				$user = $this->mdl_manager->get_id($user_id);
				if ($this->encrypt->decode($user->user_password) == $password) echo 1;
				else echo lang('manager.error');
			}
		}
	}
}

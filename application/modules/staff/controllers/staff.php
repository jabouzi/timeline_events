<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
			
		$this->load->model('mdl_tonik');
		$this->load->library('encrypt');
		$this->load->library('maildecorator');
		
	}
	
	function index()
	{
		
		$view_data['page_title'] = lang('tonik.profile');
		$user_profile = $this->mdl_tonik->get_id($this->session->userdata('user_id'));				
		$view_data['admin_widgets']['user'] = $this->show('projectmanagers', $user_profile);
		echo modules::run('template', $view_data);
		
	}
	
	function projectmanagers()
	{
		$view_data['page_title'] = lang('tonik.users');
		$users = $this->mdl_tonik->get_where(array());
		
		

		$view_data['admin_widgets']['user'] = $this->show('projectmanagers', $users);
		echo modules::run('template', $view_data);
	}
	
	function newprojectmanager()
	{
		if ($this->session->userdata('user_permission') > 1) redirect('dashboard');
		$view_data['page_title'] = lang('tonik.new');
		$view_data['admin_widgets']['user'] = $this->show('newprojectmanager', array());
		echo modules::run('template', $view_data);
	}
	
	function editprojectmanager($pm_id = 0)
	{
		if (!$pm_id) redirect('dashboard');
		$pm_id_profile = $this->mdl_tonik->get_id($pm_id);
		$view_data['page_title'] = lang('tonik.edit');
		$view_data['admin_widgets']['user'] = $this->show('projectmanager', $pm_id_profile);
		echo modules::run('template', $view_data);
	}
	
	function delete_client($pm_id)
	{
		if (!$pm_id) redirect('dashboard');
		$this->mdl_tonik->delete($pm_id);
		$this->session->set_userdata('success_message', lang('tonik.delete.success'));
		redirect('client/clients');
	}
	
	
	function get_clientlist_dropdown()
	{
		$clients = array();
		$where = array('client_active = ' => 1 );
		$results = $this->mdl_tonik->get_where($where);		
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
		$view_data['status'] = array(0 => lang('tonik.inactive'), 1 => lang('tonik.active'));
		$view_data['permissions'] = modules::run('permission/get_permissions_dropdown');
		return $this->load->view($view.'.php', $view_data, true);
	}
	
	function save_session_data($db_result)
	{
		$this->load->library('user_agent');
		$user_data = array(
			'user_id' => $db_result->user_id,
			'user_firstname' => $db_result->user_firstname,
			'user_lastname' => $db_result->user_lastname,
			'user_email' => $db_result->user_email,
			'user_permission' => $db_result->user_permission,
			'browser' => $this->agent->browser(),
			'validated' => true
			);
		$this->session->set_userdata($user_data);
	}
	
	function save_user_activity($db_result)
	{
		$this->load->library('user_agent');
		$activity_data = array(
			'user_id' => $db_result->user_id,
			'ip_address' => $this->session->userdata('ip_address'), 
			'user_agent' => $this->session->userdata('user_agent'), 
			'browser' => $this->agent->browser(), 
			'session_id' => $this->session->userdata('session_id'), 
			'activity_date' => date('Y-m-d H:i:s', $this->session->userdata('last_activity')));
		$this->mdl_tonik->insert_activity($activity_data);
	}
	
	function process_edituser()
	{
		$user_id = $this->input->post('user_id');
		$user_data = array(
			'user_firstname' => $this->input->post('user_firstname'), 
			'user_lastname' => $this->input->post('user_lastname'), 
			'user_email' => $this->input->post('user_email'),
			'user_permission' => $this->input->post('user_permission'),
			'user_active' => (int)($this->input->post('user_active'))
		);
		$user = $this->mdl_tonik->get_id($user_id);
		$user_old_data = array(
			'user_firstname' => $user->user_firstname, 
			'user_lastname' => $user->user_lastname, 
			'user_email' => $user->user_email,
			'user_permission' => $user->user_permission,
			'user_active' => (int)(ord($user->user_active))
		);
		
		if (trim($this->input->post('user_password')) != '')
		{
			$user_data['user_password'] = $this->input->post('user_password');
			$user_old_data['user_password'] = $this->encrypt->decode($user->user_password);
		}

		if (count(compare_profile($user_old_data, $user_data)))
		{
			$user_data['user_password'] = $this->encrypt->encode($user_data['user_password']);
			$this->update_user($user_id, $user_data);
		}
		
		redirect('user/edituser/'.$user_id);
	}
	
	function process_newprojectmanager()
	{

		$pm_id_data = array(
			'campaign_manager_name' => $this->input->post('campaign_manager_name'), 
			'campaign_manager_lastname' => $this->input->post('campaign_manager_lastname'),
			'campaign_manager_email' => $this->input->post('campaign_manager_email'),		
			'campaign_manager_active' => (int)($this->input->post('campaign_manager_active')),
			'campaign_manager_tgi' => (int)('1'),
		);
		
		
		$this->add_projectmanager($pm_id_data);
	}
	
	function process_projectmanager()
	{
		$pm_id = $this->input->post('campaign_manager_id');
		$profile_data = array('campaign_manager_name' => $this->session->userdata('campaign_manager_name'), 'campaign_manager_lastname' => $this->session->userdata('campaign_manager_lastname'), 'campaign_manager_email' => $this->session->userdata('campaign_manager_email'),  'campaign_manager_active' => (int)$this->session->userdata('campaign_manager_active'));
		$pm_id_data = array('campaign_manager_name' => $this->input->post('campaign_manager_name'), 'campaign_manager_lastname' => $this->input->post('campaign_manager_lastname'), 'campaign_manager_email' => $this->input->post('campaign_manager_email'),'campaign_manager_active' => (int)$this->input->post('campaign_manager_active'));
		if (count(compare_profile($profile_data, $pm_id_data)))
		{
			$this->update_projectmanager($pm_id, $pm_id_data);
		}
		redirect('tonik');
	}
	
	function process_password()
	{
		if ($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			$user = $this->mdl_tonik->get_id($this->session->userdata('user_id'));
			if ($this->encrypt->decode($user->user_password) != $this->input->post('user_newpassword'))
			{
				$user_id = $this->session->userdata('user_id');
				$user_data = array('user_password' => $this->encrypt->encode($this->input->post('user_newpassword')));
				$this->update_projectmanager($user_id, $user_data);
			}
			redirect('user');
		}
		else
		{
			$this->session->set_userdata('warning_message', lang('tonik.error'));
			redirect('user');
		}
	}
	
	private function add_projectmanager($pm_id_data)
	{
		$pm_id = $this->mdl_tonik->insert($pm_id_data);
		$this->session->set_userdata('success_message', lang('tonik.success'));
		$client = $this->mdl_tonik->get_id($pm_id);
		$messagedata = array($client->client_name, $client->client_logo, site_url(), $client->client_primary_color,$client->client_secondary_color,$client->client_font_primary_color,$client->client_font_secondary_color );
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox',$user->user_email, lang('tonik.add'));
		$this->maildecorator->decorate($messagedata, lang('mail.createuser'));
		$this->maildecorator->sendmail($maildata);
		redirect('tonik/editprojectmanager/'.$pm_id);
	}
	
	private function update_user($user_id, $user_data)
	{
		$this->mdl_tonik->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('tonik.success'));
		$user = $this->mdl_tonik->get_id($user_id);
		$messagedata = array($user->user_firstname, $user->user_lastname, $user->user_email, $this->encrypt->decode($user->user_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $user->user_email, lang('tonik.update'));
		$this->maildecorator->decorate($messagedata, lang('mail.updateuser'));
		$this->maildecorator->sendmail($maildata);
		$this->session->unset_userdata('user_'.$user_id);
		redirect('user/edituser/'.$user_id);
	}
	
	private function update_projectmanager($pm_id, $pm_id_data)
	{
		$this->mdl_tonik->update($pm_id, $pm_id_data);
		$this->session->set_userdata('success_message', lang('tonik.success'));
		$client = $this->mdl_tonik->get_id($pm_id);
		$this->save_session_data($client);
		$messagedata = array($this->session->userdata('user_firstname'), $this->session->userdata('user_lastname'));
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
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $this->session->userdata('user_email'), $subject);
		$this->maildecorator->sendmail($maildata);

		redirect('tonik/editprojectmanager/'.$pm_id);
	}
	
	function email_exists($email, $user_id = 0)
	{
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_tonik->count_where(array('user_email' => urldecode($email), 'user_id != ' => $user_id))) echo lang('tonik.exists');
			else echo 0;
		}
	}
	
	function good_password($password, $user_id)
	{
		if ($this->input->is_ajax_request())
		{
			if ($user_id == $this->session->userdata('user_id'))
			{
				$user = $this->mdl_tonik->get_id($user_id);
				if ($this->encrypt->decode($user->user_password) == $password) echo 1;
				else echo lang('tonik.error');
			}
		}
	}
}

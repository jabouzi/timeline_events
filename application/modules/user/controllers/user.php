<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_user');
		$this->load->library('encrypt');
		$this->load->library('maildecorator');
	}
	
	function index()
	{
		$view_data['page_title'] = lang('user.profile');
		$user_profile = $this->mdl_user->get_id($this->session->userdata('user_id'));
		$view_data['admin_widgets']['user'] = $this->show('profile', $user_profile);
		echo modules::run('template', $view_data);
	}
	
	function users()
	{
		$view_data['page_title'] = lang('user.users');
		$users = $this->mdl_user->get_where(array('user_permission >= ' => $this->session->userdata('user_permission')));
		$view_data['admin_widgets']['user'] = $this->show('users', $users);
		echo modules::run('template', $view_data);
	}
	
	function newuser()
	{
		if ($this->session->userdata('user_permission') > 2) redirect('dashboard');
		$view_data['page_title'] = lang('user.new');
		$view_data['admin_widgets']['user'] = $this->show('newuser', array());
		echo modules::run('template', $view_data);
	}
	
	function edituser($user_id = 0)
	{
		if ($this->session->userdata('user_permission') > 2) redirect('dashboard');
		if (!$user_id) redirect('dashboard');
		$user_profile = $this->mdl_user->get_id($user_id);
		$view_data['page_title'] = lang('user.edit');
		if ($user_profile->user_id == $this->session->userdata('user_id'))  redirect('user');
		if ($user_profile->user_permission <= $this->session->userdata('user_permission')) redirect('dashboard');
		$view_data['admin_widgets']['user'] = $this->show('profile', $user_profile);
		echo modules::run('template', $view_data);
	}
	
	function delete_user($user_id)
	{
		if (!$user_id) redirect('dashboard');
		$this->mdl_user->delete($user_id);
		$this->session->set_userdata('success_message', lang('user.delete.success'));
		redirect('user/users');
	}
	
	private function show($view, $user_data)
	{
		$this->load->helper('form');
		$view_data['user'] = $user_data;
		$view_data['status'] = array('0' => lang('user.inactive'), '1' => lang('user.active'));
		$view_data['clients'] = modules::run('client/get_clientlist_dropdown');
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
			'validated' => true,
			'client_id' => $db_result->client_id,
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
		$this->mdl_user->insert_activity($activity_data);
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
		$user = $this->mdl_user->get_id($user_id);
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
	
	function process_newuser()
	{
		$user_data = array(
			'client_id' => $this->input->post('client_id'), 
			'user_firstname' => $this->input->post('user_firstname'), 
			'user_lastname' => $this->input->post('user_lastname'), 
			'user_email' => $this->input->post('user_email'),
			'user_permission' => $this->input->post('user_permission'),
			'user_active' => (int)($this->input->post('user_active')),
			'user_password' => $this->encrypt->encode($this->input->post('user_password')),
			'user_created' => date('Y-m-d H:i:s')
		);
		$this->add_user($user_data);
	}
	
	function process_profile()
	{
		if ($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			$user_id = $this->input->post('user_id');
			$profile_data = array('user_active' => $this->session->userdata('user_active'), 'client_id' => $this->session->userdata('client_id'),'user_firstname' => $this->session->userdata('user_firstname'), 'user_lastname' => $this->session->userdata('user_lastname'), 'user_email' => $this->session->userdata('user_email'));
			$user_data = array('user_active' => $this->input->post('user_active'), 'client_id' => $this->input->post('client_id'),'user_firstname' => $this->input->post('user_firstname'), 'user_lastname' => $this->input->post('user_lastname'), 'user_email' => $this->input->post('user_email'));
			if (count(compare_profile($profile_data, $user_data)))
			{
				$this->update_profile($user_id, $user_data);
			}
			redirect('user');
		}
		else
		{
			$this->session->set_userdata('warning_message', lang('user.error'));
			redirect('user/edituser/'.$this->input->post('user_id'));
		}
	}
	
	function process_password()
	{
		if ($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			$user = $this->mdl_user->get_id($this->session->userdata('user_id'));
			if ($this->encrypt->decode($user->user_password) != $this->input->post('user_newpassword'))
			{
				$user_id = $this->session->userdata('user_id');
				$user_data = array('user_password' => $this->encrypt->encode($this->input->post('user_newpassword')));
				$this->update_profile($user_id, $user_data);
			}
			redirect('user');
		}
		else
		{
			$this->session->set_userdata('warning_message', lang('user.error'));
			redirect('user');
		}
	}
	
	private function add_user($user_data)
	{
		$user_id = $this->mdl_user->insert($user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		$user = $this->mdl_user->get_id($user_id);
		$messagedata = array($user->client_id,$user->user_firstname, $user->user_lastname, site_url(), $user->user_email, $this->encrypt->decode($user->user_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox',$user->user_email, lang('user.add'));
		$this->maildecorator->decorate($messagedata, lang('mail.createuser'));
		$this->maildecorator->sendmail($maildata);
		redirect('user/edituser/'.$user_id);
	}
	
	private function update_user($user_id, $user_data)
	{
		$this->mdl_user->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		$user = $this->mdl_user->get_id($user_id);
		$messagedata = array($user->user_firstname, $user->user_lastname, $user->user_email, $this->encrypt->decode($user->user_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $user->user_email, lang('user.update'));
		$this->maildecorator->decorate($messagedata, lang('mail.updateuser'));
		$this->maildecorator->sendmail($maildata);
		$this->session->unset_userdata('user_'.$user_id);
		redirect('user/edituser/'.$user_id);
	}
	
	private function update_profile($user_id, $user_data)
	{
		$this->mdl_user->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('user.success'));
		$user = $this->mdl_user->get_id($user_id);
		$this->save_session_data($user);
		$messagedata = array($this->session->userdata('user_firstname'), $this->session->userdata('user_lastname'));
		if (isset($user_data['user_password']))
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
		redirect('user');
	}
	
	function email_exists($email, $user_id = 0)
	{
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_user->count_where(array('user_email' => urldecode($email), 'user_id != ' => $user_id))) echo lang('user.exists');
			else echo 0;
		}
	}
	
	function good_password($password, $user_id)
	{
		if ($this->input->is_ajax_request())
		{
			if ($user_id == $this->session->userdata('user_id'))
			{
				$user = $this->mdl_user->get_id($user_id);
				if ($this->encrypt->decode($user->user_password) == $password) echo 1;
				else echo lang('user.error');
			}
		}
	}
}

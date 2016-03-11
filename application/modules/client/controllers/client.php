<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('mdl_client');
		$this->load->library('encrypt');
		$this->load->library('maildecorator');

		$config['upload_path'] = './uploads';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';

		$this->load->library('upload',$config);

	}

	function index()
	{

		$view_data['page_title'] = lang('client.profile');
		$user_profile = $this->mdl_client->get_id($this->session->userdata('user_id'));
		$view_data['admin_widgets']['user'] = $this->show('profile', $user_profile);
		echo modules::run('template', $view_data);

	}

	function clients()
	{
		$view_data['page_title'] = lang('client.users');
		$users = $this->mdl_client->get_where(array());
		$view_data['admin_widgets']['user'] = $this->show('clients', $users);
		echo modules::run('template', $view_data);
	}

	function newclient()
	{
		if ($this->session->userdata('user_permission') > 2) redirect('dashboard');
		$view_data['page_title'] = lang('client.new');
		$view_data['admin_widgets']['user'] = $this->show('newclient', array());
		echo modules::run('template', $view_data);
	}

	function editclient($client_id = 0)
	{
		if (!$client_id) redirect('dashboard');
		$client_profile = $this->mdl_client->get_id($client_id);
		$view_data['page_title'] = lang('client.edit');
		$view_data['admin_widgets']['client'] = $this->show('profile', $client_profile);
		echo modules::run('template', $view_data);
	}

	function delete_client($client_id)
	{
		if (!$client_id) redirect('dashboard');
		$this->mdl_client->delete($client_id);
		$this->session->set_userdata('success_message', lang('client.delete.success'));
		redirect('client/clients');
	}


	function get_clientlist_dropdown()
	{
		$clients = array();
		$where = array('client_active = ' => 1 );
		$results = $this->mdl_client->get_where($where);
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
		$view_data['status'] = array(0 => lang('client.inactive'), 1 => lang('client.active'));
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
		$this->mdl_client->insert_activity($activity_data);
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
		$user = $this->mdl_client->get_id($user_id);
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

	function process_newclient()
	{
		$this->upload->do_upload('client_logo');
		$data_upload_files = $this->upload->data();
		$image = $data_upload_files[full_path];
		$client_data = array(
			'client_name' => $this->input->post('client_name'),
			'client_logo' => $image,
			'client_primary_color' => $this->input->post('client_primary_color'),
			'client_secondary_color' => $this->input->post('client_secondary_color'),
			'client_font_primary_color' => $this->input->post('client_font_primary_color'),
			'client_font_secondary_color' => $this->input->post('client_font_secondary_color'),
			'client_active' => (int)($this->input->post('client_active')),
			'client_created' => date('Y-m-d H:i:s')
		);

		$this->add_client($client_data);
	}

	function process_profile()
	{
		$client_id = $this->input->post('client_id');
		$profile_data = array('client_name' => $this->session->userdata('client_name'), 'client_logo' => $this->session->userdata('client_logo'), 'client_primary_color' => $this->session->userdata('client_primary_color'), 'client_secondary_color' => $this->session->userdata('client_secondary_color'), 'client_font_primary_color' => $this->session->userdata('client_font_primary_color'), 'client_font_secondary_color' => $this->session->userdata('client_font_secondary_color'), 'client_active' => (int)$this->session->userdata('client_active'));
		$client_data = array('client_name' => $this->input->post('client_name'), 'client_logo' => $this->input->post('client_logo'), 'client_primary_color' => $this->input->post('client_primary_color'), 'client_secondary_color' => $this->input->post('client_secondary_color'), 'client_font_primary_color' => $this->input->post('client_font_primary_color'), 'client_font_secondary_color' => $this->input->post('client_font_secondary_color'), 'client_active' => (int)$this->input->post('client_active'));
		if (count(compare_profile($profile_data, $client_data)))
		{
			$this->update_profile($client_id, $client_data);
		}
		redirect('client');
	}

	function process_password()
	{
		if ($this->input->post('user_id') == $this->session->userdata('user_id'))
		{
			$user = $this->mdl_client->get_id($this->session->userdata('user_id'));
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
			$this->session->set_userdata('warning_message', lang('client.error'));
			redirect('user');
		}
	}

	private function add_client($client_data)
	{
		$client_id = $this->mdl_client->insert($client_data);
		$this->session->set_userdata('success_message', lang('client.success'));
		$client = $this->mdl_client->get_id($client_id);
		$messagedata = array($client->client_name, $client->client_logo, site_url(), $client->client_primary_color,$client->client_secondary_color,$client->client_font_primary_color,$client->client_font_secondary_color );
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox',$user->user_email, lang('client.add'));
		$this->maildecorator->decorate($messagedata, lang('mail.createuser'));
		$this->maildecorator->sendmail($maildata);
		redirect('client/editclient/'.$client_id);
	}

	private function update_user($user_id, $user_data)
	{
		$this->mdl_client->update($user_id, $user_data);
		$this->session->set_userdata('success_message', lang('client.success'));
		$user = $this->mdl_client->get_id($user_id);
		$messagedata = array($user->user_firstname, $user->user_lastname, $user->user_email, $this->encrypt->decode($user->user_password));
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $user->user_email, lang('client.update'));
		$this->maildecorator->decorate($messagedata, lang('mail.updateuser'));
		$this->maildecorator->sendmail($maildata);
		$this->session->unset_userdata('user_'.$user_id);
		redirect('user/edituser/'.$user_id);
	}

	private function update_profile($client_id, $client_data)
	{
		$this->mdl_client->update($client_id, $client_data);
		$this->session->set_userdata('success_message', lang('client.success'));
		$client = $this->mdl_client->get_id($client_id);
		$this->save_session_data($client);
		$messagedata = array($this->session->userdata('user_firstname'), $this->session->userdata('user_lastname'));
		if (isset($client_data['user_password']))
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

		redirect('client/editclient/'.$client_id);
	}

	function email_exists($email, $user_id = 0)
	{
		if ($this->input->is_ajax_request())
		{
			if ($this->mdl_client->count_where(array('user_email' => urldecode($email), 'user_id != ' => $user_id))) echo lang('client.exists');
			else echo 0;
		}
	}

	function good_password($password, $user_id)
	{
		if ($this->input->is_ajax_request())
		{
			if ($user_id == $this->session->userdata('user_id'))
			{
				$user = $this->mdl_client->get_id($user_id);
				if ($this->encrypt->decode($user->user_password) == $password) echo 1;
				else echo lang('client.error');
			}
		}
	}
}

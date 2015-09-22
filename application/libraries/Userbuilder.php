<?php

class Userbuilder
{
	protected $user = NULL;

	public function __construct()
	{
		$this->api = & get_instance();
		$this->api->load->library('Userdata');
	}

	public function build($user_data)
	{
		if (isset($user_data->user_id)) $this->user->set_id($user_data->user_id);
		$this->api->user->set_password($user_data->user_password);
		$this->api->user->set_email($user_data->user_email);
		$this->api->user->set_firstname($user_data->user_firstname);
		$this->api->user->set_lastname($user_data->user_lastname);
		$this->api->user->set_permission($user_data->user_permission);
		$this->api->user->set_active($user_data->user_active);
		$this->api->user->set_deleted($user_data->user_deleted);
	}

	public function getUser()
	{
		return $this->user;
	}
}

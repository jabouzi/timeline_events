<?php

class Userbuilder
{
	protected $user = NULL;
	protected $user_data = array();

	public function __construct($user_data)
	{
		$this->user_data = $user_data;
		$this->api = & get_instance();
		$this->api->load->library('User');
	}

	public function build()
	{
		if (isset($this->user_data['id'])) $this->user->set_id($this->user_data['user_id']);
		$this->user->set_password($this->user_data['user_password']);
		$this->user->set_email($this->user_data['user_email']);
		$this->user->set_firstname($this->user_data['user_firstname']);
		$this->user->set_lastname($this->user_data['user_lastname']);
		$this->user->set_permission($this->user_data['user_permission']);
		$this->user->set_active($this->user_data['user_active']);
		$this->user->set_deleted($this->user_data['user_deleted']);
	}

	public function getUser()
	{
		return $this->user;
	}
}

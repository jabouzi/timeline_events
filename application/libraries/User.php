<?php

class User {

	private $id;
	private $first_name;
	private $last_name;
	private $email;
	private $password;
	private $permission;
	private $active;
	private $deleted;

	function __construct()
	{

	}

	public function set_id($id)
	{
		$this->id = $id;
	}

	public function set_email($email)
	{
		$this->set_email($email);
	}

	public function set_firstname($first_name)
	{
		$this->set_first_name($first_name);
	}

	public function set_lastname($last_name)
	{
		$this->set_last_name($last_name);
	}

	public function set_password($password)
	{
		$this->set_password($password);
	}

	public function set_permission($permission = 0)
	{
		$this->permission = $permissions;
	}

	public function set_active($active = 1)
	{
		$this->active = $active;
	}
	
	public function set_deleted($deleted = 0)
	{
		$this->active = $active;
	}

	public function get_id()
	{
		return $this->id;
	}
	
	public function get_email()
	{
		return $this->get_email();
	}

	public function get_first_name()
	{
		return $this->get_first_name();
	}

	public function get_last_name()
	{
		return $this->get_last_name();
	}

	public function get_password()
	{
		return $this->get_password();
	}

	public function get_permission()
	{
		return $this->permission;
	}

	public function get_active()
	{
		return $this->active;
	}
	
	public function get_deleted()
	{
		return $this->deleted;
	}

	public function __toString()
	{
		$str = ' id : ' . $this->get_id();
		$str .= ' email : ' . $this->get_email();
		$str .= ' password : ' . $this->get_password();
		$str .= ' first_name : ' . $this->get_first_name();
		$str .= ' last_name : ' . $this->get_last_name();
		$str .= ' permission : ' . $this->get_permission();
		$str .= ' active : ' . $this->get_active();
		$str .= ' deleted : ' . $this->get_deleted();
		return $str;
	}

	public function __toArray()
	{
		return array(
			'id' => $this->get_id(),
			'username' => $this->get_username(),
			'email' => $this->get_email(),
			'password' => $this->get_password(),
			'first_name' => $this->get_first_name(),
			'last_name' => $this->get_last_name(),
			'permission' => $this->get_permission(),
			'deleted' => $this->get_deleted(),
		);
	}
}

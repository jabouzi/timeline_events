<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index($logout = null)
	{
		$this->islogin();
		
		if ($this->islogout())
		{
			$this->show();
		}
		else
		{ 
			$this->autologin();
		}
	}
	
	function show($message = null)
	{
		$this ->islogin();
		
		$this->load->helper('form');
		$this->load->helper('cookie');
		
		foreach($this->lang->languages as $key => $value)
		{
			$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
		}
		$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
		$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
		$view_data['message'] = $message;
		$view_data['checked'] = '';
		if ($this->getcookie()) $view_data['checked'] = 'checked';
		$this->load->view('login', $view_data);
	}
	
	function password($message = null)
	{
		$this->load->helper('form');
		foreach($this->lang->languages as $key => $value)
		{
			$view_data['languages'][site_url().$this->lang->switch_uri($key)] = ucfirst(strtolower($value));
		}
		$view_data['lang'] = site_url().$this->lang->switch_uri($this->lang->lang());
		$view_data['redirect'] = 'onChange="window.document.location.href=this.options[this.selectedIndex].value;"';
		$view_data['message'] = $message;
		$this->load->view('password', $view_data);
	}
	
	function process()
	{
		$this->islogin();

		$this->load->model('mdl_login');
		
		$username = $this->security->xss_clean($this->input->post('email'));
		$password = $this->security->xss_clean($this->input->post('password'));
		$result = $this->mdl_login->validate_user($username, $password);
		if(!$result)
		{
			$this->show('login.failed');
		}
		else if(!ord($result->user_active))
		{
			$this->show('user.nonactive');
		}
		else
		{
			modules::run('user/save_session_data', $result);
			modules::run('user/save_user_activity', $result);
			$cookie = $this->getcookie();
			if ($cookie)
			{
				$username = $cookie[0];
				$old_hash = $cookie[1];
				$this->deletecookie($username, $old_hash);
			}
			
			$remember_me = $this->input->post('remember_me');
			if ($remember_me)
			{
				$hash = generate_random_string(26);
				$this->setcookie($username, $hash);
			}
			redirect('dashboard');
		}
	}
	
	function processpwd()
	{
		$maildata = array();
		$this->load->library('encrypt');
		$this->load->library('maildecorator');
		$this->load->model('user/mdl_user');
		
		$email = $this->security->xss_clean($this->input->post('email'));
		$newpassword = generate_random_string(10);
		$user_data['user_password'] = $this->encrypt->encode($newpassword);
		$this->mdl_user->update_email($email, $user_data);
		$user = $this->mdl_user->get_email($email);
		$messagedata = array($user->user_firstname, $user->user_lastname, $user->user_email, $newpassword);
		$maildata = set_maildata('toolbox@tonikgroupimage.com', 'Toolbox', $user->user_email, lang('login.retrieve.password'));
		$this->maildecorator->decorate($messagedata, '/assets/templates/'.$this->lang->lang().'/retriveemail.txt');
		$this->maildecorator->sendmail($maildata);
		$this->password('login.password.send');
	}
	
	function autologin()
	{
		$this->load->model('mdl_login');
		
		$result = false;
		$cookie = $this->getcookie();
		if ($cookie)
		{
			$username = $cookie[0];
			$old_hash = $cookie[1];
			$result = $this->mdl_login->validate_cookie($username, $old_hash);
		}
		
		if(!$result)
		{
			$this->show();
		}
		else
		{	
			$hash = generate_random_string(26);
			$result = $this->mdl_login->get_where('toolbox_users', 'user_email', $username);
			modules::run('user/save_session_data', $result);
			modules::run('user/save_user_activity', $result);
			$this->deletecookie($username, $old_hash);
			$this->setcookie($username, $hash);
			redirect('dashboard');
		}
	}

	function logout()
	{
		$this->load->model('mdl_login');
		
		$cookie = $this->getcookie();
		if ($cookie)
		{
			$hash = $this->db->escape($cookie[1]);
			$query = "UPDATE toolbox_cookies SET cookie_user_active = b'1' WHERE cookie_hash = {$hash}";
			$result = $this->mdl_login->custom_query($query);
		}
		$this->session->sess_destroy();
		redirect('login');
	}
	
	function islogin()
	{
		if ($this->session->userdata('user_email'))
		{
			redirect('dashboard');
		}
	}
	
	function islogout()
	{
		$this->load->model('mdl_login');
		
		$cookie = $this->getcookie();
		if ($cookie)
		{
			$hash = $cookie[1];
			$result = $this->mdl_login->get_where('toolbox_cookies', 'cookie_hash', $hash);
			if ($result) return ord($result->cookie_user_active);
		}
		
		return false;
	}
	
	private function getcookie()
	{		
		$this->load->helper('cookie');
		$cookie = get_cookie('toolbox_cms');

		if ($cookie)
		{
			$cookie_data = explode('||',$cookie);
			return $cookie_data;
		}
		
		return false;
	}
	
	private function setcookie($value, $hash)
	{
		$this->load->helper('cookie');
		
		$cookie = array(
			'name'   => 'toolbox_cms',
			'value'  => $value.'||'.$hash,
			'expire' => 31536000,
			'domain' => '.'.$_SERVER['HTTP_HOST'],
			'path'   => '/',
		);
		
		set_cookie($cookie);
		$this->mdl_login->insert_cookie(array('cookie_email' => $value, 'cookie_hash' => $hash));
	}

	private function deletecookie($value, $hash)
	{
		$this->load->helper('cookie');
		
		$cookie = array(
			'name'   => 'toolbox_cms',
			'value'  => $value.'||'.$hash,
			'domain' => '.'.$_SERVER['HTTP_HOST'],
			'path'   => '/',
		);

		delete_cookie($cookie['name'], $cookie['domain'], $cookie['path']);
		$this->mdl_login->delete_cookie($hash);
	}
}

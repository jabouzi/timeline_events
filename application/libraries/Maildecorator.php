<?php

class Maildecorator
{
	private $message;
	private $mailer;

	function __construct()
	{
		$this->api = & get_instance();
		$this->api->load->library('email');
	}

	public function decorate($messagedata, $message)
	{
		$this->message = vsprintf($message, $messagedata);
	}

	public function sendmail($maildata)
	{
		$this->api->email->from($maildata['from'], $maildata['name']);
		$this->api->email->to($maildata['to']);
		if (isset($maildata['cc'])) $this->api->email->cc($maildata['cc']);
		if (isset($maildata['bcc'])) $this->api->email->bcc($maildata['bcc']);

		if (isset($maildata['subject'])) $this->api->email->subject($maildata['subject']);
		$this->api->email->message($this->message);

		$this->api->email->send();
	}
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_steps_data extends CI_Model
{
	use DatabaseTrait;
	
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_steps_data';
	}
}

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_project_managers extends CI_Model
{
	use DatabaseTrait;
	
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_project_managers';
	}
}

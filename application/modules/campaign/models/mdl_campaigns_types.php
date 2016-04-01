<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_types extends CI_Model
{
	use DatabaseTrait;
	
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_types';
	}
	
	function i18n_query($lang)
	{
		$query = "SELECT campaigns_types.campaign_type_id, campaigns_types.campaign_type_active, 
		campaigns_types.campaign_type_color, campaigns_i18n.i18n_name as campaign_type_name 
		FROM campaigns_types, campaigns_i18n, toolbox_languages
		WHERE campaigns_i18n.table_name = 'campaigns_types'
		AND campaigns_i18n.table_id = campaigns_types.campaign_type_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		return $this->custom_query($query);
	}
}

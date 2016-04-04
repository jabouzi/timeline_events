<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_types_status extends CI_Model
{
	use DatabaseTrait;
	
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_types_status';
	}
	
	function i18n_query($lang)
	{
		$query = "SELECT campaigns_types_status.campaign_type_status_id, campaigns_types_status.campaign_type_status_active, 
		campaigns_types_status.campaign_type_status_color, campaigns_i18n.i18n_name as campaign_type_status_name 
		FROM campaigns_types_status, campaigns_i18n, toolbox_languages
		WHERE campaigns_i18n.table_name = 'campaigns_types_status'
		AND campaigns_i18n.table_id = campaigns_types_status.campaign_type_status_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		return $this->custom_query($query);
	}
	
	function i18n_site_query($lang)
	{
		$query = "SELECT campaigns_types_status.campaign_type_status_id, campaigns_types_status.campaign_type_status_active,
		campaigns_types_status.campaign_type_status_color, campaigns_i18n.i18n_name as campaign_type_status_name 
		FROM campaigns_types_status, campaigns_i18n, toolbox_languages
		WHERE campaigns_types_status.campaign_type_status_active = '1'
		AND campaigns_i18n.table_name = 'campaigns_types_status'
		AND campaigns_i18n.table_id = campaigns_types_status.campaign_type_status_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		return $this->custom_query($query);
	}
	
	function i18n_id_query($lang, $type_id)
	{
		$query = "SELECT campaigns_types_status.campaign_type_status_id, campaigns_types_status.campaigns_type_status_active, 
		campaigns_types_status.campaign_type_status_color, campaigns_i18n.i18n_name as campaign_type_status_name 
		FROM campaigns_types_status, campaigns_i18n, toolbox_languages
		WHERE campaigns_types_status.campaign_type_status_active = '1'
		AND campaigns_i18n.table_name = 'campaigns_types_status'
		AND campaigns_i18n.table_id = campaigns_types_status.campaign_type_status_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'
		AND campaigns_types_status.campaign_type_status_id = '{$type_id}'";
		return $this->custom_query($query);
	}
}

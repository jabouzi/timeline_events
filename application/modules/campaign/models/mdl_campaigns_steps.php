<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_steps extends CI_Model
{
	use DatabaseTrait;
	
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_steps';
	}
	
	function i18n_query($lang)
	{
		$query = "SELECT campaigns_steps.campaign_step_id, campaigns_steps.campaign_step_active, campaigns_i18n.i18n_name as campaign_step_name 
		FROM campaigns_steps, campaigns_i18n, toolbox_languages
		WHERE campaigns_i18n.table_name = 'campaigns_steps'
		AND campaigns_i18n.table_id = campaigns_steps.campaign_step_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		return $this->custom_query($query);
	}
	
	function i18n_site_query($lang)
	{
		$query = "SELECT campaigns_steps.campaign_step_id, campaigns_steps.campaign_step_active, campaigns_i18n.i18n_name as campaign_step_name 
		FROM campaigns_steps, campaigns_i18n, toolbox_languages
		WHERE campaigns_i18n.table_name = 'campaigns_steps'
		AND campaigns_steps.campaign_step_active = '1'
		AND campaigns_i18n.table_id = campaigns_steps.campaign_step_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		return $this->custom_query($query);
	}
	
	function i18n_id_query($lang, $step_id)
	{
		$query = "SELECT campaigns_steps.campaign_step_id, campaigns_steps.campaign_step_active, campaigns_i18n.i18n_name as campaign_step_name 
		FROM campaigns_steps, campaigns_i18n, toolbox_languages
		WHERE campaigns_i18n.table_name = 'campaigns_steps'
		AND campaigns_steps.campaign_step_active = '1'
		AND campaigns_i18n.table_id = campaigns_steps.campaign_step_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'
		AND campaigns_steps.campaign_step_id = '{$step_id}'";
		return $this->custom_query($query);
	}
}

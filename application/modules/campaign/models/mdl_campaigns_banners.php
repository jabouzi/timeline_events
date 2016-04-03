<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_banners extends CI_Model
{
	use DatabaseTrait;
	
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_banners';
	}
	
	function i18n_query($lang)
	{
		$query = "SELECT campaigns_banners.campaign_banner_id, campaigns_i18n.i18n_name as campaign_banner_name, toolbox_clients.client_name 
		FROM campaigns_banners, toolbox_clients, campaigns_i18n, toolbox_languages
		WHERE campaigns_banners.client_id = toolbox_clients.client_id
		AND campaigns_i18n.table_name = 'campaigns_banners'
		AND campaigns_i18n.table_id = campaigns_banners.campaign_banner_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'";
		return $this->custom_query($query);
	}
	
	function i18n_client_query($lang, $client_id)
	{
		$query = "SELECT campaigns_banners.campaign_banner_id, campaigns_i18n.i18n_name as campaign_banner_name, toolbox_clients.client_name 
		FROM campaigns_banners, toolbox_clients, campaigns_i18n, toolbox_languages
		WHERE campaigns_banners.client_id = toolbox_clients.client_id
		AND campaigns_i18n.table_name = 'campaigns_banners'
		AND campaigns_i18n.table_id = campaigns_banners.campaign_banner_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'
		AND toolbox_clients.client_id = '{$client_id}'";
		return $this->custom_query($query);
	}
	
	function i18n_id_query($lang, $banner_id)
	{
		$query = "SELECT campaigns_banners.campaign_banner_id, campaigns_i18n.i18n_name as campaign_banner_name, toolbox_clients.client_name 
		FROM campaigns_banners, toolbox_clients, campaigns_i18n, toolbox_languages
		WHERE campaigns_banners.client_id = toolbox_clients.client_id
		AND campaigns_i18n.table_name = 'campaigns_banners'
		AND campaigns_i18n.table_id = campaigns_banners.campaign_banner_id
		AND campaigns_i18n.language_id = toolbox_languages.language_id
		AND toolbox_languages.language_code = '{$lang}'
		AND campaigns_banners.campaign_banner_id = '{$banner_id}'";
		return $this->custom_query($query);
	}
}

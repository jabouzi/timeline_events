<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_tonik extends CI_Model
{
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = "campaigns_project_managers";
		$this->cache->memcached->clean();
	}

	function get()
	{
		//if ($this->cache->memcached->get('mdl_client_get')) return $this->cache->memcached->get('mdl_client_get');
		$this->db->order_by('campaign_manager_id');
		$query = $this->db->get($this->table);
		//$this->cache->memcached->save('mdl_client_get', $query->row());
		return $query->row();
	}

	function get_order($order_by)
	{
		$this->db->order_by($order_by);
		$query = $this->db->get($this->table);
		return $query;
	}

	function get_with_limit($limit, $offset, $order_by)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($this->table);
		return $query;
	}

	function get_id($id)
	{
		//if ($this->cache->memcached->get('mdl_client_get_'.$id)) return $this->cache->memcached->get('mdl_client_get_'.$id);
		$this->db->where('campaign_manager_id', $id);
		$query = $this->db->get($this->table);
		//$this->cache->memcached->save('mdl_client_get_'.$id, $query->row());
		return $query->row();
	}

	function get_email($email)
	{
		$this->db->where('client_email', $email);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	function get_where($where)
	{
		$query = $this->db->get_where($this->table, $where);
		//var_dump($query);
		
		return $query;
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
		$last_id = $this->db->insert_id();
		//$this->cache->memcached->delete('mdl_client_get');
		$this->get();
		return $last_id;
	}

	function insert_activity($data)
	{
		$this->table = "toolbox_clients_activities";
		$this->db->insert($this->table, $data);
	}

	function update($id, $data)
	{
		$this->db->where('campaign_manager_id', $id);
		$this->db->update($this->table, $data);
		//$this->cache->memcached->delete('mdl_client_get');
		$this->get();
		//$this->cache->memcached->delete('mdl_client_get_'.$id);
		$this->get_id($id);
	}

	function update_email($email, $data)
	{
		$this->db->where('client_email', $email);
		$this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where('campaign_manager_id', $id);
		$this->db->delete($this->table);
		//$this->cache->memcached->delete('mdl_client_get_'.$id);
	}

	function count_where($where)
	{
		$query = $this->db->get_where($this->table, $where);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function count_all()
	{
		$query	= $this->db->get($this->table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function get_max()
	{
		$this->db->select_max('id');
		$query = $this->db->get($this->table);
		$row = $query->row();
		$id	= $row->id;
		return $id;
	}

	function custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}
}

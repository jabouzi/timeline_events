<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaigns_types extends CI_Model
{
	private $table;
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'campaigns_types';
	}
	
	function get()
	{
		$query = $this->db->get($this->table);
		return $query;
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
	
	function get_id($field_id, $id)
	{
		$this->db->where($field_id, $id);
		$query = $this->db->get($this->table);
		return $query;
	}
	
	function get_where($where)
	{
		$query = $this->db->get_where($this->table, $where);
		return $query;
	}
	
	function get_where_order($where, $order_by)
	{
		$this->db->order_by($order_by);
		$query = $this->db->get_where($this->table, $where);
		return $query;
	}
	
	function insert($data)
	{
		$this->db->insert($this->table, $data);
		$last_id = $this->db->insert_id();
	}
	
	function update($field_id, $id, $data)
	{
		$this->db->where($field_id, $id);
		$this->db->update($this->table, $data);
	}
	
	function delete($where)
	{
		$this->db->delete($where);
	}
	
	function count_where($column, $value)
	{
		$this->db->where($column, $value);
		$query	= $this->db->get($this->table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all()
	{
		$query	= $this->db->get($this->table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max($field_id)
	{
		$this->db->select_max($field_id);
		$query = $this->db->get($this->table);
		$row   = $query->row();
		$id	= $row->id;
		return $id;
	}
	
	function custom_query($mysql_query)
	{
		$query = $this->db->query($mysql_query);
		return $query;
	}
}

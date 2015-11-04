<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campaign extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get($table)
	{
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_order($table, $order_by)
	{
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_with_limit($table, $limit, $offset, $order_by)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_id($table, $field_id, $id)
	{
		$this->db->where($field_id, $id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where($table, $where)
	{
		$query = $this->db->get_where($table, $where);
		return $query;
	}
	
	function get_where_order($table, $where, $order_by)
	{
		$this->db->order_by($order_by);
		$query = $this->db->get_where($table, $where);
		return $query;
	}
	
	function insert($table, $data)
	{
		$this->db->insert($table, $data);
		$last_id = $this->db->insert_id();
	}
	
	function update($table, $field_id, $id, $data)
	{
		$this->db->where($field_id, $id);
		$this->db->update($table, $data);
	}
	
	function delete($table, $where)
	{
		$this->db->delete($table, $where);
	}
	
	function count_where($table, $column, $value)
	{
		$this->db->where($column, $value);
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all($table)
	{
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max($table, $field_id)
	{
		$this->db->select_max($field_id);
		$query = $this->db->get($table);
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

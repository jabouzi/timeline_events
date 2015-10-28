<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_campagne extends CI_Model
{
	private $table;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function set_table($table)
	{
		$this->table = $table;
	}
	
	function get_table()
	{
		return $this->table;
	}
	
	function get()
	{
		$query = $this->db->get($this->get_table());
		return $query;
	}
	
	function get_order($order_by)
	{
		$this->db->order_by($order_by);
		$query = $this->db->get($this->get_table());
		return $query;
	}
	
	function get_with_limit($limit, $offset, $order_by)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($this->get_table());
		return $query;
	}
	
	function get_id($field_id, $id)
	{
		$this->db->where($field_id, $id);
		$query = $this->db->get($this->get_table());
		return $query;
	}
	
	function get_where($where)
	{
		$query = $this->db->get_where($this->get_table(), $where);
		return $query;
	}
	
	function insert($data)
	{
		$this->db->insert($this->get_table(), $data);
	}
	
	function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->get_table(), $data);
	}
	
	function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->get_table());
	}
	
	function count_where($column, $value)
	{
		$this->db->where($column, $value);
		$query	= $this->db->get($this->get_table());
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all()
	{
		$query	= $this->db->get($this->get_table());
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max()
	{
		$this->db->select_max('id');
		$query = $this->db->get($this->get_table());
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

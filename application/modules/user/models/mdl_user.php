<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_user extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get($order_by = 'user_id')
	{
		$table = "toolbox_users";
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_with_limit($limit, $offset, $order_by)
	{
		$table = "toolbox_users";
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where($id)
	{
		$table = "toolbox_users";
		$this->db->where('user_id', $id);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where_email($email)
	{
		$table = "toolbox_users";
		$this->db->where('user_email', $email);
		$query = $this->db->get($table);
		return $query;
	}
	
	function get_where_custom($where)
	{
		$table = "toolbox_users";
		$query = $this->db->get_where($table, $where);
		return $query;
	}
	
	function insert($data)
	{
		$table = "toolbox_users";
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	function insert_activity($data)
	{
		$table = "toolbox_users_activities";
		$this->db->insert($table, $data);
	}
	
	function update($id, $data)
	{
		$table = "toolbox_users";
		$this->db->where('user_id', $id);
		$this->db->update($table, $data);
	}
	
	function update_by_email($email, $data)
	{
		$table = "toolbox_users";
		$this->db->where('user_email', $email);
		$this->db->update($table, $data);
	}
	
	function delete($id)
	{
		$table = "toolbox_users";
		$this->db->where('user_id', $id);
		$this->db->delete($table);
	}
	
	function count_where($where)
	{
		$table = "toolbox_users";
		$query = $this->db->get_where($table, $where);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function count_all()
	{
		$table	= "toolbox_users";
		$query	= $this->db->get($table);
		$num_rows = $query->num_rows();
		return $num_rows;
	}
	
	function get_max()
	{
		$table = "toolbox_users";
		$this->db->select_max('id');
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

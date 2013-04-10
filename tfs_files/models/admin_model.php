<?php
class Admin_model extends CI_Model
{
 
 
 
 function level_of_cat($id)
 {
	
	 $this->db->select("");
	$this->db->from('acf_news_categories');
	$this->db->where("id",$id);
	$dd=$this->db->get();
	return $dd->result_array();
 }
 
 function get_all($table_name)

	{
		$this->db->select('*');
		$this->db->from("$table_name");
		$data=$this->db->get();
		return $data->result_array();
	}
	
	
	function insert($table_name,$data)
	{
	
	if($this->db->insert($table_name,$data))
	{
		return true;
	}
	else
	{
		return false;
	}
	
	}


	function check_callback($table_name,$check,$field_name)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($field_name,$check);
		return $this->db->get();
	}
	
	
	
	
	function update($table_name,$data,$where_clause)
	{
		$this->db->where('id',$where_clause);
	
	
		if($this->db->update($table_name,$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	function delete($id,$table_name)
	{
		$this->db->where('id',$id);
		$this->db->delete($table_name);
	}	
	
	function get_all_where($table_name,$where_value,$where_field)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where_field,$where_value);
		return $this->db->get();
	}
	
}



?>
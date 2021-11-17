<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------- MY Model -------------------//

class MY_Model extends CI_Model {
	use DatatableTrait,RequestTrait;
	
	protected $table;
	
	protected $timestamp = true;
	
	public function __call($method,$arguments) 
	{
	
		if(substr($method,0,7) == 'get_by_'){
			$field  = substr($method,7);
			$search = $arguments[0];
			$query  = $this->db->where($field,$search)->get($this->table);
			if ($query->num_rows() > 0)
			{
				return $query->row();
			}
			return false;
		}
		
		if(substr($method,0,6) == 'where_'){
			$field  = substr($method,6);
			$search = $arguments[0];
			$this->db->where($field,$search);
			return $this;
			
		}
		
		if(substr($method,0,6) == 'order_'){
			$field  = substr($method,6);
			$order = $arguments[0];
			$this->db->order_by($field,$order);
			return $this;
		}

		if(substr($method,0,4) == 'get_'){
			$result  = substr($method,4);
			$where = isset($arguments[0]) ? $arguments[0] : false; 
			$order = isset($arguments[1]) ? $arguments[1] : false; 
			$limit = isset($arguments[2]) ? $arguments[2] : false;
			
			$this->db->select('*');
			if ($where != false) {
				$this->db->where($where);
			}
			if ($order != false) {
				$this->db->order_by(key($order),$order[key($order)]);
			}
			
			if ($limit != false) {
				$this->db->offset($limit[0])->limit($limit[1]);
			}
			
			$query = $this->db->get($this->table);
			
			if ($query->num_rows() > 0)
			{
				if ($result == 'row'){
					return $query->row();
				} else if ($result == 'result') {
					return $query->result();
				} else if ($result == 'count') {
					return $query->num_rows();
				}
				
			}
			return false;
		}
		
	}
	
	
	
	function limit($limit)
	{
		$this->db->limit($limit);
		return $this;
	}
	
	function offset($offset)
	{
		$this->db->offset($offset);
		return $this;
	}
	
	function join($table,$on,$type="left")
	{
		$this->db->join($table,$on,$type);
		return $this;
	}
	
	function select($select)
	{
		$this->db->select($select);
		return $this;
	}
	
	function result()
	{
		return $this->db->get($this->table)->result();
	}
	
	function result_array()
	{
		return $this->db->get($this->table)->result_array();
	}
	
	function where($where)
	{
		$this->db->where($where);
		return $this;
	}
	
	function like($like)
	{
		$this->db->like($like);
		return $this;
	}
	
	function row()
	{
		return $this->db->get($this->table)->row();
	}
	
	function update($data,$id=null)
	{
		if ($this->timestamp){
			$data['updated_at'] = date('Y-m-d H:i:s');
		}
		if ($id != null){
			$this->db->where('id',$id);
		}
		return $this->db->update($this->table,$data);
	}
	
	function insert($data)
	{
		if ($this->timestamp){
			$data['created_at'] = date('Y-m-d H:i:s');
		}
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
	
	function delete($id=null)
	{
		if ($id != null){
			$this->db->where('id',$id);
		}
		return $this->db->delete($this->table);
	}
	
	function as_dropdown($value,$text)
	{
		$result = $this->result();
		$data   = array();
		if ($result){
			foreach ($result as $row){
				$data[] = array('value'=>$row->$value,'text'=>$row->$text);
			}
		}
		return $data;
	}
	
	function dropdown($value,$text,$opt=null)
	{
		$result = $this->result();
		$data   = array();
		if ($result){
			foreach ($result as $row){
				$optional = $opt != null ? ", ".$row->$opt : "";
				$data[$row->$value] = $row->$text.$optional;
			}
		}
		return $data;
	}
	
	function upsert($data,$id)
	{
		if ($this->get_by_id($id)){
			$this->update($data,$id);
			return $id;
		} else {
			$this->insert($data);
			return $this->db->insert_id();
		}
	}
	
}
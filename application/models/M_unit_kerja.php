<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_unit_kerja extends MY_Model
{
	
	private $unit_kerja = ['jpt_madya','jpt_pratama','administrator','pengawas','pelaksana'];
	function __construct()
	{
		parent::__construct();
		$this->table = 'master_unit_kerja';
		
	}
	
	
	function get_unit_kerja($parent_category_id,&$parents = []){
		if(empty($parent_category_id)) {
			return [];
		}

		$parents[] = $parent_category_id;
		

		$parent_category = $this->get_by_id($parent_category_id);

		if(!empty($parent_category->parent)) {
			$this->get_unit_kerja($parent_category->parent,$parents);
		}

		return array_reverse($parents);
			
	}
	
	function unit_kerja($id)
	{
		$ids = $this->get_unit_kerja($id);
		for ($i = count($ids); $i < 5; $i++){
			$ids[$i] = 0;
		}
		$result = array();
		foreach ($ids as $key=>$val)
		{
			$result[$this->unit_kerja[$key]] = $val;
		}
		return $result;	
	}
	
	function unit_kerja_select($value,$text,$opt=null)
	{
		$result =  $this->db->query('SELECT * FROM master_unit_kerja WHERE parent IN (SELECT id FROM master_unit_kerja WHERE parent = 0) UNION ALL SELECT * FROM master_unit_kerja WHERE parent=0 ORDER BY unit_kerja')->result();
		$data   = array();
		if ($result){
			foreach ($result as $row){
				$optional = $opt != null ? ", ".$row->$opt : "";
				$data[$row->$value] = $row->$text.$optional;
			}
		}
		return $data;
	}
	
	function get_data()
	{
		return $this->db->query('SELECT * FROM master_unit_kerja WHERE parent IN (SELECT id FROM master_unit_kerja WHERE parent = 0) UNION ALL SELECT * FROM master_unit_kerja WHERE parent=0 ORDER BY unit_kerja')->result_array();
	}
	
	function get_detail_unit_kerja($id,&$result=array())
	{
		$rows = $this->where_parent($id)->result_array();
		
		if ($rows){
			foreach($rows as $row){
				$result[] = $row;
				$this->get_detail_unit_kerja($row['id'],$result);
			}
		} 
		return $result;
	}
	
	function detail_unit_kerja($id,&$result=array())
	{
		$result[] = (array)$this->get_by_id($id);
		$rows = $this->where_parent($id)->result_array();
		
		if ($rows){
			foreach($rows as $row){
				//$result[] = $row;
				$this->detail_unit_kerja($row['id'],$result);
			}
		} 
		return $result;
	}
	
	function last_tree_unit_kerja($id)
	{
		$row = $this->get_by_id($id);
		$rows = array();
		if ($row){
			$rows = $this->db->select('A.*,C.nama_jabatan,C.eselon,B.jumlah_kebutuhan,B.jumlah_saat_ini,B.id as id_anjab')->from('master_unit_kerja A')
							 ->join('anjab B','A.id=B.id_unit_kerja','left')
							 ->join('master_jabatan C','B.id_jabatan=C.id','left')
							 ->where('A.parent',$row->parent)->limit(3)->get()->result_array();
			
			$parent1 = $this->db->select('A.*,C.nama_jabatan,C.eselon,B.jumlah_kebutuhan,B.jumlah_saat_ini,B.id as id_anjab')->from('master_unit_kerja A')
							 ->join('anjab B','A.id=B.id_unit_kerja','left')
							 ->join('master_jabatan C','B.id_jabatan=C.id','left')
							 ->where('A.id',$row->parent)->get()->row_array();
			$rows[] = $parent1;
			if ($parent1){
				$rows[] = $this->db->select('A.*,C.nama_jabatan,C.eselon,B.jumlah_kebutuhan,B.jumlah_saat_ini,B.id as id_anjab')->from('master_unit_kerja A')
							 ->join('anjab B','A.id=B.id_unit_kerja','left')
							 ->join('master_jabatan C','B.id_jabatan=C.id','left')
							 ->where('A.id',$parent1['parent'])->get()->row_array();
			}
		}
		return array_reverse($rows);
	}
	
	
	
}
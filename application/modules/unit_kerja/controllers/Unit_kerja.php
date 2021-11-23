<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_kerja extends ADMIN_Controller {
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function index()
	{
		//print_r($this->m_unit_kerja->detail_unit_kerja(session('unit_id'),session('unit_id')));
		$data['unit_kerja'] = $this->m_unit_kerja->where_parent(0)->dropdown('id','unit_kerja');
		$this->load_admin('index',$data);
	}
	
	function data()
	{
		if (session('role') == 1){
			tableTree(buildTree($this->m_unit_kerja->get_data()));
		} else {
			$row = $this->m_unit_kerja->get_by_id(session('unit_id'));
			tableTree(buildTree($this->m_unit_kerja->detail_unit_kerja(session('unit_id')),$row->parent),$row->parent,true);
		}
		
		
	}
	
	function cek_kode()
	{
		if ($this->m_master_jabatan->get_by_kode_jabatan($this->_post('kode_jabatan'))){
			echo json_encode("Kode Jabatan sudah Ada");
		} else {
			echo json_encode(true);
		}
	}
	
	function form()
	{
		$id = $this->_post('id','int');
		$data['id'] = $id;
		if ($row = $this->m_unit_kerja->get_by_id($id)){
			$data['row'] = $row;
		}
		$data['parent'] = $this->db->select('A.*,B.eselon,B.urutan')->from('master_unit_kerja A')->join('master_eselon B','A.id_eselon=B.id','left')
							->where(['A.id !='=>$id])->order_by('A.id')->get()->result_array();
		$data['eselon'] = $this->m_eselon->result();
		$this->load->view('form',$data);
	}
	
	function save()
	{
		
		if ($this->m_unit_kerja->cek_eselon($this->_post('id_eselon'),$this->_post('parent'))) {
			exit("Induk Unit Kerja yg diinput dibawah eselon yang diinput");
		}
		
		$id   = $this->_post('id');
		$data = ['unit_kerja'=>$this->_post('unit_kerja'),
				'parent' => $this->_post('parent'),
				'status_madya'=> $this->_post('status_madya','int',0),
				'id_eselon' => $this->_post('id_eselon','int',0)];
		if ($this->m_unit_kerja->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		$id = $this->_post('id','int');
		if ($this->m_unit_kerja->get_by_parent($id)){
			echo 'Silakan Hapus data \"child\" terlebih dulu';
			exit();
		}
		if ($this->m_unit_kerja->delete($id)){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
	
	function select()
	{
		$id = $this->_post('id','int');
		if ($id == 0){
			$id = null;
		}
		$sql = $this->m_unit_kerja->where_parent($id)->as_dropdown('id','unit_kerja');
		echo json_encode($sql);
	}
	
	function detail($id)
	{
		$parent = 0;
		$row = $this->m_unit_kerja->get_by_id($id);
		if ($row) {
			$parent = $row->parent;
		}
		tableTree(buildTree($this->m_unit_kerja->detail_unit_kerja($id),$parent),$parent,true);
		/*
		$id = $this->_post('id');
		$data['rows'] = $this->m_unit_kerja->get_detail_unit_kerja($id);
		$data['id'] = $id;
		$this->load->view('detail',$data);
		*/
	}
}
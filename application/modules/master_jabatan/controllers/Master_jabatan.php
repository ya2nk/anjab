<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jabatan extends ADMIN_Controller {
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function index()
	{
		$this->load_admin('index');
	}
	
	function data()
	{
		echo json_encode($this->m_master_jabatan->generate_datatable());
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
		$id = $this->_post('id');
		$data['id'] = $id;
		if ($row = $this->m_master_jabatan->get_by_id($id)){
			$data['row'] = $row;
		}
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['kode_jabatan'=>$this->_post('kode_jabatan'),
				'nama_jabatan' => $this->_post('nama_jabatan'),
				'deskripsi_jabatan'=> $this->_post('deskripsi_jabatan'),
				'eselon'=>$this->_post('eselon')];
		if ($this->m_master_jabatan->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		if ($this->m_master_jabatan->delete($this->_post('id','int'))){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
	
	function get_detail()
	{
		echo json_encode($this->m_master_jabatan->get_by_id($this->_post('id','int')));
	}
	
	function autocomplete()
	{
		$result = array();
		$term = $this->_get('term');
		$sql  = $this->m_master_jabatan->where("nama_jabatan LIKE '$term%'")->limit(30)->result();
		if ($sql){
			foreach ($sql as $row){
				$result[] = array('id'=>$row->id,'value'=>$row->nama_jabatan);
			}
		}
		echo json_encode($result);
	}
	
	function select()
	{
		$result = array();
		$term = $this->_get('term');
		$sql  = $this->m_master_jabatan->where("nama_jabatan LIKE '$term%' OR kode_jabatan LIKE '%$term%'")->limit(60)->result();
		if ($sql){
			foreach ($sql as $row){
				$result['results'][] = array('id'=>$row->id,'text'=>"[$row->kode_jabatan] $row->nama_jabatan");
			}
		}
		echo json_encode($result);
	}
}
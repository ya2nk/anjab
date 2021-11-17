<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keterampilan extends ADMIN_Controller {
	
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
		echo json_encode($this->m_keterampilan->generate_datatable());
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
		if ($row = $this->m_keterampilan->get_by_id($id)){
			$data['row'] = $row;
		}
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['keterampilan'=>$this->_post('keterampilan')];
		if ($this->m_keterampilan->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		if ($this->m_keterampilan->delete($this->_post('id','int'))){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
}
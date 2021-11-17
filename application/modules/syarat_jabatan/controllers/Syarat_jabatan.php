<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syarat_jabatan extends ADMIN_Controller {
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function index()
	{
		$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
		$this->load_admin('index',$data);
	}
	
	function data()
	{
		echo json_encode($this->m_syarat_jabatan->generate_datatable());
	}
	
	function form()
	{
		$id = $this->_post('id','int');
		$data['id'] = $id;
		if ($row = $this->m_syarat_jabatan->get_by_id($id)){
			$data['row'] = $row;
		}
		$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['jenis'=> $this->_post('jenis'),
				 'id_jabatan'=> $this->_post('id_jabatan','int'),
				'syarat_jabatan' => $this->_post('syarat_jabatan')];
		if ($this->m_syarat_jabatan->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		$id = $this->_post('id','int');
		
		if ($this->m_syarat_jabatan->delete($id)){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
}
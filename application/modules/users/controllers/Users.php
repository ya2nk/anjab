<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends ADMIN_Controller {
	
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
		echo json_encode($this->m_users->generate_datatable());
	}
	
	
	
	function form()
	{
		$id = $this->_post('id');
		$data['id'] = $id;
		if ($row = $this->m_users->get_by_id($id)){
			$data['row'] = $row;
		}
		$data['unit_kerja'] = $this->m_unit_kerja->unit_kerja_select('id','unit_kerja');
		
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['username'=>$this->_post('username'),
		         'nama'=>$this->_post('nama'),
				 'role'=>$this->_post('role','int'),
				 'id_unit_kerja'=>$this->_post('id_unit_kerja','int',0)];
				 
		if ($this->_post('password') != ''){
			$data['password'] = sha1($this->_post('password'));
		}
		if ($this->m_users->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		if ($this->m_users->delete($this->_post('id','int'))){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
}
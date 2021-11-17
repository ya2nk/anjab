<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lingkungan_kerja extends ADMIN_Controller {
	
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
		echo json_encode($this->m_lingkungan_kerja->generate_datatable());
	}
	
	
	
	function form()
	{
		$id = $this->_post('id');
		$data['id'] = $id;
		if ($row = $this->m_lingkungan_kerja->get_by_id($id)){
			$data['row'] = $row;
		}
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['aspek'=>$this->_post('aspek'),
				'faktor' => $this->_post('faktor'),
				'eselon'=>$this->_post('eselon')];
		if ($this->m_lingkungan_kerja->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		if ($this->m_lingkungan_kerja->delete($this->_post('id','int'))){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
	
	
}
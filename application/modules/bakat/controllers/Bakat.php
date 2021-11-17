<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bakat extends ADMIN_Controller {
	
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
		echo json_encode($this->m_bakat->generate_datatable());
	}
	
	function cek_kode()
	{
		if ($this->m_bakat->get_by_kode($this->_post('kode','upper'))){
			echo json_encode("Kode sudah Ada");
		} else {
			echo json_encode(true);
		}
	}
	
	function form()
	{
		$id = $this->_post('id');
		$data['id'] = $id;
		if ($row = $this->m_bakat->get_by_id($id)){
			$data['row'] = $row;
		}
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['kode'=>$this->_post('kode','upper'),
		         'bakat'=>$this->_post('bakat'),
				 'keterangan'=>$this->_post('keterangan')];
		if ($this->m_bakat->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		if ($this->m_bakat->delete($this->_post('id','int'))){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
}
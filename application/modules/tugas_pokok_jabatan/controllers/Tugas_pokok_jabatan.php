<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas_pokok_jabatan extends ADMIN_Controller {
	
	function __construct()
	{
		parent::__construct();
	}	
	
	function index()
	{
		$data['jabatan'] = $this->m_master_jabatan->dropdown('id','kode_jabatan');
		$this->load_admin('index',$data);
	}
	
	function data()
	{
		echo json_encode($this->m_tugas_pokok->generate_datatable());
	}
	
	function form()
	{
		$id = $this->_post('id','int');
		$data['id'] = $id;
		if ($row = $this->m_tugas_pokok->get_by_id($id)){
			$data['row'] = $row;
		}
		$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
		$this->load->view('form',$data);
	}
	
	function save()
	{
		$id   = $this->_post('id');
		$data = ['tugas_pokok'=> $this->_post('tugas_pokok'),
				 'id_jabatan'=> $this->_post('id_jabatan','int'),
				
				'hasil_kerja_asli' => $this->_post('hasil_kerja_asli'),
				'jumlah_beban' => $this->_post('jumlah_beban'),
				'waktu_penyelesaian' => $this->_post('waktu_penyelesaian'),
				'tahapan_kerja' => json_encode($this->_post('tahapan_kerja',null))];
				
		if ($this->m_tugas_pokok->upsert($data,$id)){
			echo 'success';
		} else {
			echo 'Data Gagal disimpan';
		}
	}
	
	function delete()
	{
		$id = $this->_post('id','int');
		
		if ($this->m_tugas_pokok->delete($id)){
			echo 'success';
			exit();
		}
		echo 'Data Gagal dihapus';
	}
}
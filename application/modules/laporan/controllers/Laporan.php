<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends ADMIN_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function peta()
	{
		$where_unit = [];
		if (session('role') == 2){
			$where_unit['id'] = session('unit_id');
		}
		$data['unit_kerja'] = $this->m_unit_kerja->where_parent(0)->where($where_unit)->dropdown('id','unit_kerja');
		$this->load_admin('index',$data);
	}
	
	function peta_jabatan($unit_kerja,$jpt='')
	{
		if ($jpt != ''){
			$unit_kerja = $jpt;
		}
		$row = $this->m_unit_kerja->get_by_id($unit_kerja);
		$data['tree'] = buildTree($this->m_anjab->get_parent_child($unit_kerja),$row->parent);
		$this->load->view('map',$data);
	}
	
	function formulir_jabatan()
	{
		$this->load_admin('formulir_jabatan_view');
	}
	
	function jabatan()
	{
		$id = $this->_get('id_jabatan');
		$data = array();
		if ($row = $this->m_anjab->get_full_jabatan($id)){
			$data['row'] = $row;
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
			$data['syarat'] = $this->m_syarat_jabatan->where_id_jabatan($row->id_jabatan)->order_jenis('asc')->result();
			$data['abjad']  = ['a','b','c','d','e','f','g','h','i','j','k','l'];
			$data['tugas_pokok'] = $this->m_anjab->get_tugas_pokok_detail($id);
			$data['unit_kerja'] = $this->m_unit_kerja->dropdown('id','unit_kerja');
			$data['jabatan'] = $this->m_master_jabatan->dropdown('id','nama_jabatan');
			$data['lingkungan'] = $this->m_lingkungan_kerja->where_eselon($row->eselon)->result();
			$data['keterampilan_kerja'] = $this->m_keterampilan->dropdown('id','keterampilan');
			$data['bakat_kerja'] = $this->m_bakat->dropdown('id','kode','bakat');
			$data['temperamen_kerja'] = $this->m_temperamen->dropdown('id','kode','nama');
			$data['minat_kerja'] = $this->m_minat->dropdown('id','kode','keterangan');
			$data['upaya_fisik'] = $this->m_upaya_fisik->dropdown('id','keterangan');
			$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
			$data['kondisi'] = json_decode($row->kondisi_fisik);
			$data['fungsi'] = json_decode($row->fungsi_pekerjaan);
			$data['fungsi_kerja'] = $this->m_fungsi_fisik->dropdown('id','kode','nama');
		}
		$this->load->view('jabatan_cetak',$data);
	}
}
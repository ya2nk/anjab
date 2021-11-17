<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_syarat_jabatan extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'master_syarat_jabatan';
		$this->column_order = ['nama_jabatan','jenis','nama_syarat'];
		$this->order = ['kode_jabatan'=>'asc'];
		$this->column_search = ['master_jabatan.nama_jabatan'];
	}
	
	function generate_datatable()
	{
		$join = [['master_jabatan','master_jabatan.id = master_syarat_jabatan.id_jabatan']];
		$id_jabatan = $this->_post('id_jabatan','int');
		$where = [];
		if ($id_jabatan != ''){
			$where['id_jabatan'] = $id_jabatan;
		}
		$result = $this->get_datatables($this->table.".*,master_jabatan.nama_jabatan",$join,$where);
		
		$rows = $result['data'];
		if ($rows){
			$no = $_POST['start'] + 1;
			foreach ($rows as $key=>$row){
				$rows[$key]->action = $rows[$key]->action = "<a href='javascript:void(0)' class='btn btn-info btn-sm' data-toggle='tooltip' data-placement='top' title='Ubah Data' onclick='loadForm(".$row->id.")'><i class='fa fa-pencil'></i></a>
									   <button class='btn btn-danger btn-sm' data-container='table' data-toggle='tooltip' data-placement='top' title='Hapus Data' onclick='deleteData(".$row->id.")'><i class='fa fa-trash'></i></button>";
				$rows[$key]->no     = $no;
				$no++;
			}
		}
		$result['data'] = $rows;
		return $result;
	}
}
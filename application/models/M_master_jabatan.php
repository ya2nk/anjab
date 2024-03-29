<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master_jabatan extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'master_jabatan';
		$this->column_order = ['kode_jabatan','nama_jabatan','deskripsi_jabatan','eselon'];
		$this->order = ['kode_jabatan'=>'asc'];
		$this->column_search = ['nama_jabatan','kode_jabatan'];
	}
	
	function generate_datatable()
	{
		$result = $this->get_datatables();
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
	
	function generate_datatable_picker()
	{
		$select = "id,kode_jabatan as value,nama_jabatan as text";
		$where  = array('UPPER(nama_jabatan) LIKE' =>"%".strtoupper($_POST['search_param'])."%");
		$result = $this->get_datatables($select,[],$where);
		return $result;
	}
}
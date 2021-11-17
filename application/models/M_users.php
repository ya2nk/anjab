<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'users';
		$this->column_order = ['nama','username','role'];
		$this->order = ['nama'=>'asc'];
	}
	
	function generate_datatable()
	{
		$select = "users.*,master_unit_kerja.unit_kerja";
		$join   = [["master_unit_kerja","users.id_unit_kerja=master_unit_kerja.id"]];
		$result = $this->get_datatables($select,$join);
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
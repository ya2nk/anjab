<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_eselon extends MY_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->table = 'master_eselon';
		$this->column_order = ['nama','keterangan'];
		$this->order = ['nama'=>'asc'];
	}
	
	
}
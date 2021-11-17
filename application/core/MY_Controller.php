<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	use ViewTrait,RequestTrait;
	protected $koefisien = 1250;
	
	function calculate_kebutuhan($id_jabatan)
	{
		$kebutuhan = 0;
		$rows = $this->m_anjab->get_tugas_pokok_detail($id_jabatan);
		if ($rows){
			foreach ($rows as $row){
				$waktu_efektif = $row->jumlah_beban * $row->waktu_penyelesaian;
				$kebutuhan += $waktu_efektif/$this->koefisien;
			}
		}
		if ($kebutuhan > 0 && $kebutuhan < 1){
			$kebutuhan = 1;
		}
		return $kebutuhan;
	}
}

class ADMIN_Controller extends MY_Controller{
	
	function __construct()
	{
		parent::__construct();
		if (!session('islogged')){
			redirect('index');
		}
	}
}
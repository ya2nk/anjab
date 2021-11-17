<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		if(!session('islogged')){
			$this->load->view('login');
		} else {
			//print_r($this->m_unit_kerja->detail_unit_kerja(session('unit_id')));
			$this->load_admin('index');
		}
		
	}
	
	function login()
	{
		$user = $this->_post('username');
		$pass = $this->_post('password');
		$login = $this->m_users->where_username($user)->where_password(sha1($pass))->row();
		if ($login){
			session_set('nama',$login->nama);
			session_set('role',$login->role);
			session_set('id',$login->id);
			session_set('islogged',true);
			session_set('unit_id',$login->id_unit_kerja);
			echo 'success';
		} else {
			echo 'Username atau Password salah';
		}
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('index');
	}
}
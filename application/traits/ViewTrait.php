<?php  defined('BASEPATH') OR exit('No direct script access allowed');

trait ViewTrait {
	
	function load_admin($view,$data=array())
	{
		$data['header']  = $this->load->view('header',$data,true);
		$data['content'] = $this->load->view($view,$data,true);
		$this->load->view('template',$data);
	}
	
	function load_front($view,$data=array())
	{
		
		$data['content'] = $this->load->view($view,$data,true);
		$this->load->view('front/default/template',$data);
	}
}
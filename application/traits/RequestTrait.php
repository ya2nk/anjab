<?php
defined('BASEPATH') OR exit('No direct script access allowed');

trait RequestTrait {
	
	function _post($key,$filter='string',$default='')
	{
		$input = isset($_POST[$key]) ? $this->input->post($key,true) : $default;
		return $this->filterx($input,$filter);
	}
	
	function _get($key,$filter='string',$default='')
	{
		$input = isset($_GET[$key]) ? $this->input->get($key,true) : $default;
		return $this->filterx($input,$filter);
	}
	
	function post_all()
	{
		return isset($_POST) ? $this->input->post : false;
	}
	
	function _has($index)
	{
		return isset($_REQUEST[$index]) ? true : false;
	}
	
	private function filterx($var,$filter)
	{
		if ($filter == 'int')
		{
			return filter_var($var,FILTER_SANITIZE_NUMBER_INT);
		}
			
		else if ($filter == 'float')
		{
			return filter_var($var,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
		}
		
		else if ($filter == 'string')
		{
			return filter_var($var,FILTER_SANITIZE_STRING);
		}
		
		else if ($filter == 'email')
		{
			return filter_var($var,FILTER_SANITIZE_EMAIL);
		}
		
		else if ($filter == 'url')
		{
			return filter_var($var,FILTER_SANITIZE_URL);
		}
		
		else if ($filter == 'upper')
		{
			return strtoupper($this->filterx($var,'string'));
		}
		
		else if ($filter == 'lower')
		{
			return strtolower($this->filterx($var,'string'));
		}
		
		else if ($filter == 'ucfirst')
		{
			return ucfirst($this->filterx($var,'lower'));
		}
		
		else if ($filter == null)
		{
			return $var;
		}
	}
	
	static function encrypt($text)
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5('Q1w2E3r4T5'), $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    static function decrypt($text)
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5('Q1w2E3r4T5'), base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }
}
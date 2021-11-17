<?php

trait MailTrait {
	function send_mail($to,$subject,$message){
		$this->load->library('email');

		$config['mailtype'] = 'html';
		$config['wordwrap'] = TRUE;

		$config['protocol'] = 'smtp';
		$config['smtp_host'] =  'mail.smtp2go.com';
		$config['smtp_user'] = 'jajang.umara@gmail.com';
		$config['smtp_pass'] = 'tetran12345';
		$config['smtp_port'] = '587';
		$config['charset']='utf-8';
		$config['newline']="\r\n";
		$config['crlf'] = "\r\n";


		$this->email->initialize($config);

		$this->email->from('verifikator@siul.com', 'Tim Verifikator');
		$this->email->to($to);

		$this->email->subject($subject);
		$this->email->message($message);


		$this->email->send();
		return $this->email->print_debugger();
	}
	
	function kirim_email($to,$subject,$message)
	{
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <webmaster@example.com>' . "\r\n";
		

		mail($to,$subject,$message,$headers);
	}
}
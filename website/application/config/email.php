<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

		$config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_user'] = 'noreply@synergyteletech.com';
		$config['smtp_pass'] = 'synergy1026';
		$config['smtp_port'] = '587';
		$config['smtp_crypto'] = 'tls';
		//$config['charset']   ='utf-8';  // Default should be utf-8 (this should be a text field)
		$config['newline']   ="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n"
		$config['crlf']     = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n"
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
        //$this->email->initialize($config);       

?>
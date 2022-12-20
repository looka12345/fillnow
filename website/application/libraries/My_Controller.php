<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class My_Controller extends CI_Controller
{
	function myControllerClass()
	{ 
		parent::__construct();

		$this->load->database();
		$this->load->library("email");
		$this->load->library("session");
		$this->load->helper("url");
		$this->load->config("prop");
		if (! file_exists($file_path = APPPATH . 'hooks/menu.php'))
		{
			exit('The hook file does not exist.');
		}
		require $file_path;
		$this->hook = new menu();
		$this->data['menuhtml']=$this->hook->createmenu();
	}
}
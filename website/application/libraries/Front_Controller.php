<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Front_Controller extends My_Controller
{
		public function frontControllerClass(){
			parent::myControllerClass();

			$this->load->model("homepage_management","FHM");

			$site_info=$this->FHM->getSiteInfo();
			$this->data['site_info']=$site_info[0];
			$social_info=$this->FHM->getSocialInfo();
			$this->data['social_info']=$social_info[0];
			$this->data['counter_list']=$this->FHM->getModuleData('counters');
		}
		function clearcache()
		{
			$this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
			$this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
			$this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
			$this->output->set_header('Pragma: no-cache');
		}
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Index extends Front_Controller {
	public function __construct(){
		parent::frontControllerClass();
		$this->clearcache();
	}
	public function index(){
		$page_info=$this->FHM->getPageInfo('home');
		$this->data['page_info']=$page_info[0];
		$this->data['app_feat']=$this->FHM->getModuleData('home_slider');
		$this->data['testi_list']=$this->FHM->getModuleData('testimonial');
		$this->data['home_feat']=$this->FHM->getModuleData('client_slider');
		$home_video=$this->FHM->getHomeVideo();
		$this->data['home_video']=$home_video[0];
		$about_info=$this->FHM->getModuleData('aboutusmanagement');
		$this->data['about_info'] = $about_info[0];
		$this->load->view("theme/index",$this->data);
	}
}
<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Admin_Controller extends My_Controller
{
	function Admin_ControllerClass()
	{
		parent::My_ControllerClass();
		$this->_admin_container = $this->config->item("kritid_template_admin") . "admin_container.php";
		$this->_login_container = $this->config->item("kritid_template_admin") . "login.php";
		//Start Model
		$this->load->model("catalog/login_model","LM");
		$this->load->model("catalog/menu_design","MD");
		$this->load->model("catalog/front_menu_design","FM");
		$this->load->model("catalog/catalog_module_type","CMT");
        $this->load->model("catalog/manage_site_configuration","MASC");
		$this->load->model("comanajex/ajex_function_model","AJF");
		$this->load->model("catalog/user_manage","UM");
		$this->load->model("catalog/user_group","UG"); 
		$this->load->model("catalog/manage_page","MACP");
		$this->load->model("catalog/catalog_layout","CL");
		$this->load->model("catalog/manage_socialmedia","MASMC");	
		$this->load->model("catalog/manage_content_page","MCAP");
		$this->load->model("catalog/homeslider_management","MAHSA"); 	
		$this->load->model("catalog/clientslider_management","CSM"); 
		$this->load->model("catalog/team_management","TMM"); 	
		$this->load->model("catalog/video_management","VDO"); 
		$this->load->model("catalog/counter_management","CTM"); 
		$this->load->model("catalog/counselling_management","COM");
		$this->load->model("catalog/test_preparation_management","TPM");
		$this->load->model("catalog/placement_management","PLM");
		$this->load->model("catalog/aboutus_management","AHC");
		$this->load->model("catalog/testimonial_management","MAHCTM");
		$this->load->model("catalog/sat_management","SAM");
		$this->load->model("catalog/act_management","ACM");
		$this->load->model("catalog/subject_test_management","STM");
		$this->load->model("catalog/blogpost_manage","BPM");
		$this->load->model("catalog/manage_product","MGPT");
		$this->load->model("catalog/gallery_service","GAL");
		$this->load->model("catalog/faq_management","FAQM");
	}
	function clearcache()
	{
	 	$this->output->set_header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        $this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', FALSE);
        $this->output->set_header('Pragma: no-cache');
	}
	function checkloginsession()
	{
		if(!($this->session->userdata("emp_login_id")))
		{
			redirect("admin/");
	    }		
	}
	function checklogoutsession()
	{
		if($this->session->userdata("emp_login_id"))
		{
			redirect("admin/welcome"); 
	    }	
	}
}

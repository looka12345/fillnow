<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Admin extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();		
	}
	public function index()
	{
		$this->checklogoutsession(); 
		$data["site_data"] =$this->MASC->getData();
	    $data["page"] = "catalog/center_view/form_login";
	    $this->load->view($this->_login_container,$data);			
	}	
  	function login_process() 
  	{
		$data["site_data"] =$this->MASC->getData();
   		if(!$this->validate_form()) 
   		{
			$data["page"] = "catalog/center_view/form_login";
			$errormessage= $this->uri->segment(3);
			if($errormessage!="")
			{
	   			$data["errormessage"] = "Username and password do not match";
			}		
			$this->load->view($this->_login_container,$data);
   		}
   		else 
   		{
			$this->LM->loginProcess();
   		}
  	}
  	function validate_form() 
  	{
   		$this->form_validation->set_rules("username", "Email", "trim|required|valid_email");
   		$this->form_validation->set_rules("password", "Password", "trim|required");
    	if($this->form_validation->run()==FALSE) 
    	{
	 		return FALSE;
    	} 
   		else 
    	{
	 		return TRUE;
    	}
  	}   
  	function admin_logout() 
  	{ 
       	$this->session->unset_userdata("emp_login_id");	
		$this->session->unset_userdata("admin_username");
		$this->session->unset_userdata("email_id");
		$this->session->unset_userdata("status");
		$this->session->sess_destroy();
		redirect("admin");
	}
    public function welcome()
	{
		$this->checkloginsession();
	    $data["page"]  = "welcome_view";
		$data["menup"] =$this->MD->getmenuelement();
		$data["site_data"] =$this->MASC->getData();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
	    $this->load->view($this->_admin_container,$data);
	}	
}

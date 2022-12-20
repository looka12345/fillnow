<?php
 class Login_model extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 
  
  
  //# Start Login Code 
  function loginProcess() 
  {
	
	$username = $this->input->post("username");
	$password = $this->input->post("password");
    $pwd = sha1($password); 

 
	
	$loginSql = $this->verifyLogin($username,$pwd);
		if($loginSql->num_rows()>0){
	 
	 $result = $loginSql->result();
	 //define session value
     $session_array = array("emp_login_id"=>$result[0]->admin_login_id,
							"admin_username"=>$result[0]->name,
							"email_id"=>$result[0]->email_id,
							"phone"=>$result[0]->contact_no,
							"image"=>$result[0]->image,
							"admin_role"=>$result[0]->designation,
							"status"=>$result[0]->active_status,
							);
	 

     $this->session->set_userdata($session_array);
	 redirect("admin/welcome");
	} 
	else 
	{
		
		 $error=urlencode(sha1("1"));
	     redirect("admin/login_process/$error","location", 301);
		
    }
  }
  
  //# End Login Code 
  function updateLoginuserpass($data,$login_user_id)
		{
			$this->db->where("admin_login_id",$login_user_id);
			if($this->db->update('admin_login',$data))
			{
				return 1;
		
			}else{
	
			return 0;
			}
		}
  function updateLoginuser($data,$login_user_id)
		{
			$this->db->where("admin_detail_id",$login_user_id);
			if($this->db->update('admin_details',$data))
			{
				return 1;
		
			}else{
	
			return 0;
			}
		}
    function verifyLogin($username,$pwd) 
  {
	  
	$this->db->select("pal.*,pad.name,pad.designation,pad.contact_no,pad.image");
	$this->db->from("admin_login pal");
	$this->db->join("admin_details AS pad", "pal.admin_login_id = pad.admin_login_id", "left");
	$this->db->where("email_id",$username);
	$this->db->where("password",$pwd);
	$checkQuery = $this->db->get();
	return $checkQuery;
  }
 }//End Of Class Model
?>
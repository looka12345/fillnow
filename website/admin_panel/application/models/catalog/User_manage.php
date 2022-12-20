<?php
 class User_Manage extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 

  # Define Function Get All country 
  
  
  
function getcount($searchuser=FALSE,$del_status=FALSE,$cundarr=FALSE) 
{
$this->db->select("al.*,ad.name");
    $this->db->from("admin_login al");
	$this->db->join("admin_details ad","al.admin_login_id = ad.admin_detail_id", "left");
	$this->db->order_by("al.priority", "ASC"); 
	if($searchuser!="")
	{
	  $this->db->like('ad.name', "$searchuser");	
	}
		$this->db->where("al.delete_status","1");

	 $query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$totalrow = $query->num_rows();
	   }
	   else
	   {
	   	$totalrow=0;
	   }
	   
return $totalrow;

}  
function getAllUser($page1=FALSE,$page2=FALSE,$searchuser=FALSE) 
{
	$this->db->select("al.*,ad.name");
    $this->db->from("admin_login as al");
	$this->db->join("admin_details as ad","al.admin_login_id = ad.admin_detail_id", "left");
	$this->db->order_by("al.priority", "ASC"); 
	if($searchuser!="")
	{
	  $this->db->like('ad.name', "$searchuser");	
	}
	$this->db->where("al.delete_status","1");
	if(!($page1===FALSE) && !($page2===FALSE)) 
	{
		$this->db->limit($page2,$page1);
	}
	$checkQuery=array();
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
return $checkQuery;

}


function getRefineUser($user_login_id=FALSE,$page1,$page2) 
{
	if($user_login_id!='0')
	{
		//echo $country_id;
		$this->db->select('al.*,ad.*');
		$this->db->from('admin_login AS al');
		$this->db->join("admin_details ad","ad.admin_login_id = al.admin_login_id", "left");
		$this->db->where('al.admin_login_id',$user_login_id);
		$this->db->where("al.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	else
	{
		$this->db->select('al.*,ad.*');
		$this->db->from('admin_login AS al');
			$this->db->join("admin_details ad","ad.admin_login_id = al.admin_login_id", "left");
		$this->db->where("al.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	    
		return $checkQuery;

}

 function insertAdminLogin($data) 
{
	if($this->db->insert('admin_login',$data['logindetail']))
	{
		$login_id=$this->db->insert_id();
	    $data['admindetails']['admin_login_id']= $login_id;
		$this->db->insert('admin_details',$data['admindetails']);
		return 1;
		
	}else{

		return 0;
	}
		
}

function getSingalUser($admin_login_id=FALSE) 
{
	$this->db->select('al.*,ad.*');
	$this->db->from('admin_login AS al');
	$this->db->join('admin_details AS ad','al.admin_login_id = ad.admin_detail_id','left');
	$this->db->where('al.admin_login_id',$admin_login_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}



function updateAdminLogin($data,$admin_login_id) 
{
	 $admin_login_id;

	$data['admindetails']['admin_login_id']= $admin_login_id;
	$this->db->where('admin_login_id', $admin_login_id);
	if($this->db->update('admin_login',$data['logindetail']))
	{
		$this->db->where('admin_detail_id', $admin_login_id);
	   $this->db->update('admin_details',$data['admindetails']);
		return 1;
		
	}else{
	
		return 0;
	}
		
}




}//End Of Class Model
 
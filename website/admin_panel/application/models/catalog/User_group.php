<?php
 class User_Group extends CI_Model
  {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 

  # Define Function Get All country 
  
function getcount($searchusergroup=FALSE,$del_status=FALSE,$cundarr=FALSE) 
{
	//$this->db->select("ps.*,pc.country_name");
	$this->db->select("*");
	$this->db->from("user_group");
	if($searchusergroup!="")
	{
	  $this->db->like('user_group_name', "$searchusergroup");	
	}
	$this->db->order_by("priority", "ASC");
	$this->db->where("delete_status","1");
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
  function getAllUserGroup($page1=FALSE,$page2=FALSE,$searchusergroup=FALSE) 
{
	
	$this->db->select("*");
	$this->db->from("user_group");
		if(!($page1===FALSE) && !($page2===FALSE)) 
	{
		$this->db->limit($page2,$page1);
	}
	if($searchusergroup!="")
	{
	  $this->db->like('user_group_name', "$searchusergroup");	
	}
	$this->db->order_by("priority", "ASC");
	$this->db->where("delete_status","1");
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
		}
	   else
	   {
		 $checkQuery =false;  
	   }
	   
return $checkQuery;

}



  function singleGroup($group_id=NULL) 
{
	
	$this->db->select("*");
	$this->db->from("user_group");
	$this->db->where("user_group_id",$group_id);
	$this->db->where("delete_status","1");
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
		}
	   else
	   {
		 $checkQuery =false;  
	   }
	   
return $checkQuery;

}



 function insertUserGroup($data) 
{
	
	if($this->db->insert('user_group',$data))
	{
		return 1;
		
	}else{
	
		
		return 0;
	}
		
}

 function updateUserGroup($data,$user_group_id) 
{
	$this->db->where('user_group_id', $user_group_id);
	if($this->db->update('user_group',$data))
	{
		return 1;
		
	}else{
	
		
		return 0;
	}
		
}

}//End Of Class Model
 
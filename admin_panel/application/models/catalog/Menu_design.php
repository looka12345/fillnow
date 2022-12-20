<?php
 class Menu_design extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	 
   parent :: __construct();
     
  }
  //# End Define Constructor 

  #Start Define Get menu Page for Super Admin
    function getmenuelement($page=FALSE) 
  {
	if($page===FALSE)
	{
		
		$this->db->select("spage.*,ppage.admin_page as parentpage");
	    $this->db->from("admin_page AS spage");
	    $this->db->join("admin_page AS ppage","spage.admin_parent_id = ppage.admin_page_id", "left");
	    $this->db->where("spage.admin_parent_id","0");
		$this->db->where("spage.delete_status","1");
		$this->db->order_by("priority", "ASC"); 
	    $query = $this->db->get();
		 if($query->num_rows()>0) 
		   {
			$checkQuery = $query->result();
		   }
		   
      return $checkQuery;
		
	}
	else
	{
		
	   //print_r($page);
	  // die()
	  $checkQuery=array();
		foreach ($page as $value)
		  {
			$parent_id=$value->admin_page_id;
			$this->db->select("spage.*,ppage.admin_page as parentpage");
			$this->db->from("admin_page AS spage");
			$this->db->join("admin_page AS ppage","spage.admin_parent_id = ppage.admin_page_id", "left");
			$this->db->where("spage.admin_parent_id","$parent_id");
			$this->db->where("spage.delete_status","1");
			$this->db->order_by("priority", "ASC"); 
			$query = $this->db->get();
		//	echo $query->num_rows();
			 if($query->num_rows()>0) 
			   {
				//echo $parent_id  ;  
				$checkQuery[$parent_id] = $query->result();
			   }
		}
	    return $checkQuery;
		
	}

  }
function getAllPageType()
	{
		 $checkQuery=array();
			$this->db->select("spage.*");
			$this->db->from("page_type AS spage");
			$query = $this->db->get();
		//	echo $query->num_rows();
			 if($query->num_rows()>0) 
			   {
				//echo $parent_id  ;  
				$checkQuery = $query->result();
			   }
		
	    return $checkQuery;
	}
  function getDataById($parent_id=NULL)
	{
		  $checkQuery=array();
		
			
			$this->db->select("spage.*");
			$this->db->from("admin_page AS spage");
			$this->db->where("spage.admin_page_id","$parent_id");
			$this->db->where("spage.delete_status","1");
			$this->db->order_by("priority", "ASC"); 
			$query = $this->db->get();
		//	echo $query->num_rows();
			 if($query->num_rows()>0) 
			   {
				//echo $parent_id  ;  
				$checkQuery = $query->result();
			   }
		
	    return $checkQuery;
	}
	
	function getDataByPageurl($page_url=NULL)
	{
		    $checkQuery=array();
			$this->db->select("spage.*");
			$this->db->from("admin_page AS spage");
			$this->db->where("spage.page_url","$page_url");
			$this->db->where("spage.delete_status","1");
			$this->db->order_by("priority", "ASC"); 
			$query = $this->db->get();
		//	echo $query->num_rows();
			 if($query->num_rows()>0) 
			   {
				//echo $parent_id  ;  
				$checkQuery = $query->result();
			   }
		
	    return $checkQuery;
	}
  
  function getDataByTaxonomy($taxonomy=NULL)
	{
		    $checkQuery=array();
			$this->db->select("spage.*");
			$this->db->from("admin_page AS spage");
			$this->db->where("spage.taxonomy","$taxonomy");
			$this->db->where("spage.delete_status","1");
			$this->db->order_by("priority", "ASC"); 
			$query = $this->db->get();
		//	echo $query->num_rows();
			 if($query->num_rows()>0) 
			   {
				//echo $parent_id  ;  
				$checkQuery = $query->result();
			   }
		
	    return $checkQuery;
	}
  function insertAdminPage($data) 
{
	if($this->db->insert('admin_page',$data))
	{
		return 1;
		
	}else{
		
		return 0;
	}
		
}



function updateAdminPage($data,$admin_page_id) 
{
	$this->db->where('admin_page_id', $admin_page_id);
	if($this->db->update('admin_page',$data))
	{
		return 1;
		
	}else{
		return 0;
	}
		
}
 
 
 }//End Of Class Model
?>
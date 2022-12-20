<?php
 class Catalog_Module_Type extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 

  # Define Function Get All country 
  
  
  
function getcount($searchmodule,$del_status=FALSE,$cundarr=FALSE) 
{
	
	
	
	$this->db->select("cmt.*");
    $this->db->from("module_type cmt");
	$this->db->order_by("cmt.priority", "ASC"); 
	if($searchmodule!="")
	{
	  $this->db->like("cmt.module_name",$searchmodule);	
	}

	  	$this->db->where("cmt.delete_status","$del_status");	
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

# Define Function Get All City
function getAllModuleType($page1=FALSE,$page2=FALSE,$searchmodule=FALSE) 
{
	$this->db->select("cmt.*");
    $this->db->from("module_type cmt");
	$this->db->order_by("cmt.priority", "ASC"); 
	if($searchmodule!="")
	{
	  $this->db->like("cmt.module_name",$searchmodule);	
	}
		$this->db->where("cmt.delete_status","1");
	if(!($page1===FALSE) && !($page2===FALSE)) 
	{
		$this->db->limit($page2,$page1);
	}
	
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	   else
	   {
		  $checkQuery=array(); 
	   }
	   
	   
return $checkQuery;

}


function getRefineModuleType($module_type_id=FALSE,$page1,$page2) 
{
	if($module_type_id!='0')
	{
		//echo $country_id;
		$this->db->select('mt.*');
		$this->db->from('module_type AS mt');
		$this->db->where('mt.module_type_id',$module_type_id);
		$this->db->where("mt.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	else
	{
		$this->db->select('mt.*');
		$this->db->from('module_type AS mt');
		$this->db->where("mt.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	    
		return $checkQuery;

}

 function insertModuleType($data) 
{
	if($data)
	{
		$this->db->insert('module_type',$data);
		return 1;
		
	}else{

		return 0;
	}
		
}

function getSingalModuleType($module_type_id=FALSE) 
{
	$this->db->select('mt.*');
	$this->db->from('module_type AS mt');
	$this->db->where('mt.module_type_id',$module_type_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}



function updateModuleType($data,$module_type_id) 
{
	
	$this->db->where('module_type_id', $module_type_id);
	if($this->db->update('module_type',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}




}//End Of Class Model
 
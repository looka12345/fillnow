<?php
 class Catalog_Layout extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 

  # Define Function Get All country 
  
  
  
function getcount($searchlayout,$del_status=FALSE,$cundarr=FALSE) 
{
	$this->db->select("cmt.*");
    $this->db->from("catalog_layout cmt");
	$this->db->order_by("cmt.priority", "ASC"); 
	if($searchlayout!="")
	{
	  $this->db->like("cmt.catalog_layout_title",$searchlayout);	
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
function getAllCatalog_layout($page1=FALSE,$page2=FALSE,$searchlayout=FALSE) 
{
	$this->db->select("cmt.*");
    $this->db->from("catalog_layout cmt");
	$this->db->order_by("cmt.priority", "ASC"); 
	if($searchlayout!="")
	{
	  $this->db->like("cmt.catalog_layout_title",$searchlayout);	
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


function getRefineCatalog_layout($catalog_layout_id=FALSE,$page1,$page2) 
{
	if($catalog_layout_id!='0')
	{
		//echo $country_id;
		$this->db->select('mt.*');
		$this->db->from('catalog_layout AS mt');
		$this->db->where('mt.catalog_layout_id',$catalog_layout_id);
		$this->db->where("mt.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	else
	{
		$this->db->select('mt.*');
		$this->db->from('catalog_layout AS mt');
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

 function insertCatalog_layout($data) 
{
	if($data)
	{
		$this->db->insert('catalog_layout',$data);
		return 1;
		
	}else{

		return 0;
	}
		
}

function getSingalCatalog_layout($catalog_layout_id=FALSE) 
{
	$this->db->select('mt.*');
	$this->db->from('catalog_layout AS mt');
	$this->db->where('mt.catalog_layout_id',$catalog_layout_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}



function updateCatalog_layout($data,$catalog_layout_id) 
{
	
	$this->db->where('catalog_layout_id', $catalog_layout_id);
	if($this->db->update('catalog_layout',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}




}//End Of Class Model
 
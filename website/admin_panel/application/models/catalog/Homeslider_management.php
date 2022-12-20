<?php
 class Homeslider_management extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 

  # Define Function Get All country 
  
  
  
function getcountdata($searchbmi,$del_status=FALSE,$cundarr=FALSE) 
{
	
	
	$this->db->select("upe.*");
    $this->db->from("home_slider upe");
	$this->db->order_by("upe.priority", "ASC"); 
	if($searchbmi!="")
	{
	  $this->db->like("upe.title1",$searchbmi);	
	}	
	  	$this->db->where("delete_status","$del_status");	
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


function getAllData($page1=FALSE,$page2=FALSE,$searchbmi=FALSE) 
{
	$this->db->select("upe.*");
    $this->db->from("home_slider upe");
	$this->db->order_by("upe.priority", "ASC"); 
	if($searchbmi!="")
	{
	  $this->db->like("upe.title1",$searchbmi);	
	}
		$this->db->where("upe.delete_status","1");
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




 function insertData($data) 
{
	if($data)
	{
		$this->db->insert('home_slider',$data);
		return 1;
		
	}else{

		return 0;
	}
		
}

function getSingalData($home_slider_id=FALSE) 
{
	$this->db->select('upe.*');
	$this->db->from('home_slider AS upe');
	$this->db->where('upe.home_slider_id',$home_slider_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}



function updateData($data,$bmi_id) 
{
	
	$this->db->where('home_slider_id', $bmi_id);
	if($this->db->update('home_slider',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}




}//End Of Class Model
 
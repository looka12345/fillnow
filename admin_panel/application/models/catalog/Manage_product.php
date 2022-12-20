<?php
class manage_product extends CI_Model
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
$this->db->from("products upe");
	//$this->db->join("productscategory as cat","cat.productscategory_id=upe.productscategory");
	$this->db->order_by("upe.priority", "ASC");
	if($searchbmi!="")
	{
		$this->db->like("upe.name",$searchbmi);
		}
			$this->db->where("upe.delete_status","$del_status");
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
$this->db->from("products upe");
	//$this->db->join("productscategory as cat","cat.productscategory_id=upe.productscategory");
	$this->db->order_by("upe.priority", "ASC");
	if($searchbmi!="")
	{
		$this->db->like("upe.name",$searchbmi);
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
		$this->db->insert('products',$data);
		$last_id=$this->db->insert_id();
		return array('last_id'=> $last_id,'msg'=>'1');
		
	}else{
		return 0;
	}
		
}
function insertData_gallery($data)
{
	if($data)
	{
		$this->db->insert('products_gallery',$data);
		// $last_id=$this->db->insert_id();
		return 1;
		
	}else{
		return 0;
	}
		
}
function insertData_floorplan($data)
{
	if($data)
	{
		$this->db->insert('floorplan',$data);
		// $last_id=$this->db->insert_id();
		return 1;
		
	}else{
		return 0;
	}
		
}
function insertData_locationplan($data)
{
	if($data)
	{
		$this->db->insert('locationplan',$data);
		// $last_id=$this->db->insert_id();
		return 1;
		
	}else{
		return 0;
	}
		
}
function getSingalData($products_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('products AS upe');
	$this->db->where('upe.products_id',$products_id);
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}
	return $checkQuery;
}
function getSingalDataFloor($products_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('floorplan AS upe');
	$this->db->where('upe.products_id',$products_id);
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}
		else
		{
		$checkQuery =array();
		}
	return $checkQuery;
}
function getSingalDataLocationplan($products_id=FALSE)
{
	$this->db->select('lps.*');
	$this->db->from('locationplan AS lps');
	$this->db->where('lps.products_id',$products_id);
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}
	else
	{
		$checkQuery = array();
	}
	
	return $checkQuery;
}
function getSingalDataGallery($products_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('products_gallery AS upe');
	$this->db->where('upe.products_id',$products_id);
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}
	return $checkQuery;
}
function getProductCategory()
{
	$this->db->select('upe.*');
	$this->db->from('productcategory AS upe');
	$this->db->where('upe.active_status','1');
	$this->db->where('upe.delete_status','1');
	$this->db->order_by('upe.name','ASC');
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}else{
		$checkQuery = array();
	}
	return $checkQuery;
}
function updateData($data,$bmi_id)
{
	
	$this->db->where('products_id', $bmi_id);
	if($this->db->update('products',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updateDataFloor($data,$bmi_id)
{
	
	$this->db->where('products_id', $bmi_id);
	if($this->db->update('products',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updateDataGallery($data,$bmi_id)
{
	
	$this->db->where('products_id', $bmi_id);
	if($this->db->update('products',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
}//End Of Class Model
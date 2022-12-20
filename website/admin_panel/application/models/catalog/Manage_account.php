<?php
class Manage_account extends CI_Model
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
$this->db->from("customer_detail upe");
	//$this->db->join("colleges as cat","cat.colleges_id=upe.colleges");
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
	$this->db->select("upe.*,cat.*");
        $this->db->from("customer_detail upe");
	$this->db->join("customer_login as cat","cat.customer_login_id=upe.customer_login_id");
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
function register_new_login($data)
	{

		if($data)
		{
			$this->db->insert('customer_login',$data);
			$id = $this->db->insert_id();

            if($id>0)
            {
            	return $id;
            }else{
            	return null;
            }
		}
		else
		{
			return null;
		}
	}
function insertData($data)
{
	if($data)
	{
		$this->db->insert('customer_detail',$data);
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
		$this->db->insert('customer_detail_gallery',$data);
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
function getSingalData($customer_detail_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('customer_detail AS upe');
	$this->db->where('upe.customer_detail_id',$customer_detail_id);
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}
	return $checkQuery;
}
function getSingalDataFloor($customer_detail_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('floorplan AS upe');
	$this->db->where('upe.customer_detail_id',$customer_detail_id);
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
function getSingalDataLocationplan($customer_detail_id=FALSE)
{
	$this->db->select('lps.*');
	$this->db->from('locationplan AS lps');
	$this->db->where('lps.customer_detail_id',$customer_detail_id);
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
function getSingalDataGallery($customer_detail_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('customer_detail_gallery AS upe');
	$this->db->where('upe.customer_detail_id',$customer_detail_id);
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
	$this->db->from('colleges AS upe');
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
function get_universities_list()
{
	$this->db->select('hs.*');
	$this->db->from('universities AS hs');
	$this->db->where('hs.delete_status','1');
	$this->db->where('hs.active_status','1');
	$this->db->order_by('hs.name','ASC');
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

function get_course_list()
{
	$this->db->select('hs.*');
	$this->db->from('courses AS hs');
	$this->db->where('hs.delete_status','1');
	$this->db->where('hs.active_status','1');
	$this->db->order_by('hs.name','ASC');
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
function get_branch_list()
{
	$this->db->select('hs.*');
	$this->db->from('branch AS hs');
	$this->db->where('hs.delete_status','1');
	$this->db->where('hs.active_status','1');
	$this->db->order_by('hs.name','ASC');
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
function register_update_login($login_data,$bmi_id)
{
	
	$this->db->where('customer_login_id', $bmi_id);
	if($this->db->update('customer_login',$login_data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updateData($data,$bmi_id)
{
	
	$this->db->where('customer_login_id', $bmi_id);
	if($this->db->update('customer_detail',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updateDataFloor($data,$bmi_id)
{
	
	$this->db->where('customer_detail_id', $bmi_id);
	if($this->db->update('customer_detail',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updateDataGallery($data,$bmi_id)
{
	
	$this->db->where('customer_detail_id', $bmi_id);
	if($this->db->update('customer_detail',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
}//End Of Class Modelcat.name
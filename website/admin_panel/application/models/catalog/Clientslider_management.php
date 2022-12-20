<?php
class Clientslider_management extends CI_Model
{
function __construct()
{
	
parent :: __construct();

}

function getcountdata($searchbmi,$del_status=FALSE,$cundarr=FALSE)
{
	
	
	$this->db->select("upe.*");
	$this->db->from("client_slider upe");
	$this->db->order_by("upe.priority", "ASC");
	if($searchbmi!="")
	{
		$this->db->like("upe.name",$searchbmi);
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
	$this->db->from("client_slider upe");
	$this->db->order_by("upe.client_slider_id", "DESC");
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
		$this->db->insert('client_slider',$data);
		return 1;
		
	}else{
		return 0;
	}
		
}
function getSingalData($client_slider_id=FALSE)
{
	$this->db->select('upe.*');
	$this->db->from('client_slider AS upe');
	$this->db->where('upe.client_slider_id',$client_slider_id);
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery = $query->result();
	}
	return $checkQuery;
}
function updateData($data,$bmi_id)
{
	
	$this->db->where('client_slider_id', $bmi_id);
	if($this->db->update('client_slider',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
}
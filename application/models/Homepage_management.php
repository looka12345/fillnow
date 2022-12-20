<?php
class Homepage_Management extends CI_Model
{
function __construct()
{
	parent :: __construct();
}
function getSiteInfo()
{
	$this->db->select("sc.*");
	$this->db->from("site_configuration as  sc");
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
function getPageInfo($page=FALSE)
{
	$this->db->select('pg.*');
	$this->db->from('content_page as pg');
	$this->db->where('pg.delete_status','1');
	$this->db->where('pg.active_status','1');
	$this->db->where('pg.taxonomy',$page);
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
function getSocialInfo()
{
	$this->db->select("sc.*");
	$this->db->from("socialmedia as sc");
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
function getModuleData($table=FALSE)
{
	$this->db->select("hs.*");
	$this->db->from("$table as hs");
	$this->db->where('hs.active_status','1');
	$this->db->where("hs.delete_status","1");
	$this->db->order_by("hs.priority","ASC");	
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
function getHomeVideo()
{
	$this->db->select("hs.*");
	$this->db->from("video as hs");
	$this->db->where('hs.active_status','1');
	$this->db->where("hs.delete_status","1");
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
function getUspList($value=FALSE)
{
	$this->db->select("hs.*");
	$this->db->from("counters as hs");
	$this->db->join("products as pr",'hs.product_id=pr.products_id','left');
	$this->db->where("pr.taxonomy",$value);
	$this->db->where('hs.active_status','1');
	$this->db->where("hs.delete_status","1");
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
function get_team_list()
{
	$this->db->select('hs.*');
	$this->db->from('team AS hs');
	$this->db->where('hs.delete_status','1');
	$this->db->where('hs.active_status','1');
	$this->db->order_by('hs.priority','ASC');
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
function getGalleryList($value=FALSE)
{
	$this->db->select("hs.*");
	$this->db->from("gallery as hs");
	$this->db->join("products as pr",'hs.packageid=pr.products_id','left');
	$this->db->where("pr.taxonomy",$value);
	$this->db->where('hs.active_status','1');
	$this->db->where("hs.delete_status","1");
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
function getFaqList($value=FALSE)
{
	$this->db->select("hs.*");
	$this->db->from("faq as hs");
	$this->db->join("products as pr",'hs.packageid=pr.products_id','left');
	$this->db->where("pr.taxonomy",$value);
	$this->db->where('hs.active_status','1');
	$this->db->where("hs.delete_status","1");
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
function getProductInfo($value=FALSE)
{
	$this->db->select("hs.*");
	$this->db->from("products as hs");
	$this->db->where('hs.taxonomy',$value);
	$this->db->where('hs.active_status','1');
	$this->db->where("hs.delete_status","1");
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
}
<?php
class Manage_content_page extends CI_Model
{
	//# Start Define Constuctor
function __construct()
{
	
parent :: __construct();

}


function getcountposts($searchcontentpage,$del_status=FALSE,$cundarr=FALSE)
	{
		
	$this->db->select("cp.*");
	
	$this->db->from("content_post cp");
	//$this->db->join("content_category cpj","cp.category_id =cpj.content_category_id","left");
	
	if($searchcontentpage!="")
	{
		$this->db->like('cp.title', "$searchcontentpage");
	}
	$this->db->where("cp.delete_status","$del_status");
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
function getcountpages($searchcontentpage,$del_status=FALSE,$cundarr=FALSE,$pareent_id=FALSE)
	{
	
	$this->db->select("cp.*");
	
	$this->db->from("content_page cp");
	$this->db->order_by("priority", "ASC");
$this->db->where("cp.page_for","0");
$this->db->where("cp.delete_status","$del_status");
	if($searchcontentpage!="")
	{
		
		$this->db->like('cp.title', "$searchcontentpage");
	}
	
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

function getAllcategory_post($page1=FALSE,$page2=FALSE,$searchcontentcat=FALSE,$taxonomy)
	{
		
	
	$this->db->select("cc.*");
	
	$this->db->from("content_category cc");
if($taxonomy<>'all')
	{
			$this->db->where('cc.taxonomy', "$taxonomy");
	}
	if($searchcontentcat!="")
	{
		$this->db->like('cc.title', "$searchcontentcat");
	}
	if(!($page1===FALSE) && !($page2===FALSE))
	{
		$this->db->limit($page2,$page1);
	}
	$this->db->order_by("priority", "ASC");
	
	$this->db->where("cc.delete_status","1");
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
function getAllPages($page1=FALSE,$page2=FALSE,$searchcontentpage=FALSE,$pareent_id=FALSE)
{
	
	$this->db->select("cp.*");
	
	$this->db->from("content_page cp");
	if($searchcontentpage!="")
	{
		$this->db->like('cp.title', "$searchcontentpage");
	}
	
	
		if(!($page1===FALSE) && !($page2===FALSE))
	{
		$this->db->limit($page2,$page1);
	}
	$this->db->order_by("cp.priority", "ASC");
	$this->db->where("cp.page_for","0");
	$this->db->where("cp.delete_status","1");
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
function getAllPages_backup($page1=FALSE,$page2=FALSE,$searchcontentpage=FALSE,$pareent_id=FALSE)
{
	if($pareent_id===FALSE)
	{
	$this->db->select("cp.*,cpj.title as parent_title");
	
	$this->db->from("content_page cp");
	$this->db->join("content_page cpj","cp.parent =cpj.content_page_id", "left");
	if($searchcontentpage!="")
	{
		$this->db->like('cp.title', "$searchcontentpage");
	}
	
	
		if(!($page1===FALSE) && !($page2===FALSE))
	{
		$this->db->limit($page2,$page1);
	}
	$this->db->order_by("priority", "ASC");
	$this->db->where("cp.parent","0");
	$this->db->where("cp.delete_status","1");
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
		else
		{
	
		$checkQuery=array();
		foreach ($pareent_id as $value)
			{
		$parent_id=$value->content_page_id;
	$this->db->select("cp.*,cpj.title as parent_title");
	
	$this->db->from("content_page cp");
	$this->db->join("content_page cpj","cp.parent =cpj.content_page_id", "left");
	if($searchcontentpage!="")
	{
		$this->db->like('cp.title', "$searchcontentpage");
	}
	
	
		if(!($page1===FALSE) && !($page2===FALSE))
	{
		$this->db->limit($page2,$page1);
	}
	$this->db->order_by("priority", "ASC");
	$this->db->where("cp.parent","$parent_id");
	$this->db->where("cp.delete_status","1");
	$query = $this->db->get();
	if($query->num_rows()>0)
	{
		$checkQuery[$parent_id] = $query->result();
		}
	else
	{
		$checkQuery =false;
	}
	}
return $checkQuery;
		
		}
}
	function getExpertName($ex_id)
	{
		$this->db->select("ex.f_name");
		$this->db->from("expert ex");
		$this->db->where('ex.expert_id', "$ex_id");
		#$this->db->where("ex.delete_status","1");
		$query = $this->db->get();
		return $query->result();
	}
function getAllPosts($page1=FALSE,$page2=FALSE,$searchcontentpage=FALSE)
		{
			
	$this->db->select("cp.*,cpj.title as category_name");
	
	$this->db->from("content_post cp");
	$this->db->join("content_category cpj","cp.category_id = cpj.content_category_id","left");
	
	if($searchcontentpage!="")
	{
		$this->db->like('cp.title', "$searchcontentpage");
	}
	
	
		if(!($page1===FALSE) && !($page2===FALSE))
	{
		$this->db->limit($page2,$page1);
	}
	$this->db->order_by("cp.content_post_id", "DESC");
	$this->db->where("cp.delete_status","1");
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
function getcountcategory($searchcontentcategory,$del_status=FALSE,$cundarr=FALSE,$taxonomy)
	{
	$this->db->select("cp.*,cpj.title as category_name");
	
	$this->db->from("content_category cp");
	$this->db->join("content_category cpj","cp.category_id =cpj.content_category_id","left");
	
	if($taxonomy<>'all')
	{
			$this->db->where('cp.taxonomy', "$taxonomy");
	}
	if($searchcontentcategory!="")
	{
		$this->db->like('cp.title', "$searchcontentcategory");
	}
	$this->db->where("cp.delete_status","$del_status");
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
function getAllCategory($page1=FALSE,$page2=FALSE,$searchcontentpage=FALSE,$taxonomy)
		{
			
	
	$this->db->select("cp.*,cpj.title as category_name");
	
	$this->db->from("content_category cp");
	$this->db->join("content_category cpj","cp.category_id =cpj.content_category_id","left");
	
	if($taxonomy<>'all')
	{
			$this->db->where('cp.taxonomy', "$taxonomy");
	}
	
	if($searchcontentpage!="")
	{
		$this->db->like('cp.title', "$searchcontentpage");
	}
	
	
		if(!($page1===FALSE) && !($page2===FALSE))
	{
		$this->db->limit($page2,$page1);
	}
	$this->db->order_by("cp.priority", "ASC");
	$this->db->where("cp.delete_status","1");
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
function getSinglePage($page_id=FALSE)
	{
	
		
	$this->db->select("cp.*");
	
	$this->db->from("content_page cp");
	$this->db->where("cp.content_page_id","$page_id");
	$this->db->order_by("priority", "ASC");
	$this->db->where("cp.delete_status","1");
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
function getSinglepost($post_id=FALSE)
	{
		
	$this->db->select("cp.*");
	$this->db->from("content_post cp");
	$this->db->where("cp.content_post_id","$post_id");
	$this->db->order_by("priority", "ASC");
	$this->db->where("cp.delete_status","1");
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
function getSinglecategory($category_id=FALSE)
	{
		
	$this->db->select("cc.*");
	$this->db->from("content_category cc");
	$this->db->where("cc.content_category_id","$category_id");
	$this->db->order_by("priority", "ASC");
	$this->db->where("cc.delete_status","1");
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
function insertPage($data)
{
	if($this->db->insert('content_page',$data))
	{
		return 1;
		
	}else{
	
		
		return 0;
	}
		
}
function insertPost($data)
{
	if($this->db->insert('content_post',$data))
	{
		return 1;
		
	}else{
	
		
		return 0;
	}
		
}
function insertCategory($data)
{
	if($this->db->insert('content_category',$data))
	{
		return 1;
		
	}else{
	
		
		return 0;
	}
		
}
function updatePage($data,$content_page_id)
{
	$this->db->where('content_page_id', $content_page_id);
	if($this->db->update('content_page',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updatePost($data,$post_id)
{
	$this->db->where('content_post_id', $post_id);
	if($this->db->update('content_post',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
function updateCategory($data,$category_id)
{
	$this->db->where('content_category_id', $category_id);
	if($this->db->update('content_category',$data))
	{
		return 1;
		
	}else{
	
		return 0;
	}
		
}
}//End Of Class Model
<?php
class Front_Menu_Design extends CI_Model
{
  //# Start Define Constuctor	 
	function __construct() 
	{

		parent :: __construct();

	}
  //# End Define Constructor 

  #Start Define Get menu Page for Super Admin
	function getSingaInfomationmenu($menu_id)
	{
		$this->db->select("smenu.*");
		$this->db->from("menu AS smenu");

		$this->db->where("smenu.module_type","4");
		$this->db->where("smenu.menu_id",$menu_id);
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

	function getAllInfomationmenu()
	{
		$this->db->select("smenu.*,pmenu.menu_title as parentmenu");
		$this->db->from("menu AS smenu");
		$this->db->join("menu AS pmenu","smenu.parent_id = pmenu.menu_id", "left");
		$this->db->join("contant AS con"," pmenu.menu_id = con.menu_id ", "left");
		$this->db->where("smenu.parent_id != ","0");
		$this->db->where("smenu.module_type","4");
		$this->db->where("smenu.delete_status","1");
	//$this->db->where("con.delete_status","1");
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

	function getInfoPage($menu=FALSE) 
	{
		if($menu===FALSE)
		{
			$this->db->select("smenu.*,pmenu.menu_title as parentmenu");
			$this->db->from("menu AS smenu");
			$this->db->join("menu AS pmenu","smenu.parent_id = pmenu.menu_id", "left");
			$this->db->join("contant AS con","con.menu_id = smenu.menu_id", "right");
			$this->db->where("smenu.parent_id != ","0");
			$this->db->where("smenu.module_type","4");
			$this->db->where("smenu.delete_status","1");

			$this->db->order_by("priority", "ASC"); 
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

	}

	function getSingleMenu($menu_id=FALSE)
	{
		$this->db->select("smenu.*");
		$this->db->from("menu AS smenu");

		$this->db->where("smenu.menu_id","$menu_id");

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


	function getMenuData($menu=FALSE) 
	{
		if($menu===FALSE)
		{

			$this->db->select("smenu.*,pmenu.menu_title as parentmenu");
			$this->db->from("menu AS smenu");
			$this->db->join("menu AS pmenu","smenu.parent_id = pmenu.menu_id", "left");
			$this->db->where("smenu.parent_id","0");
			$this->db->where("smenu.delete_status","1");
			$this->db->order_by("priority", "ASC"); 
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
		else
		{

			$checkQuery=array();
			foreach ($menu as $value)
			{
				$parent_id=$value->menu_id;
				$this->db->select("smenu.*,pmenu.menu_title as parentmenu");
				$this->db->from("menu AS smenu");
				$this->db->join("menu AS pmenu","smenu.parent_id = pmenu.menu_id", "left");
				$this->db->where("smenu.parent_id","$parent_id");
				$this->db->where("smenu.delete_status","1");
				$this->db->order_by("priority", "ASC"); 
				$query = $this->db->get();
		//	echo $query->num_rows();
				if($query->num_rows()>0) 
				{
				//echo $parent_id  ;  
					$checkQuery[$parent_id] = $query->result();
				}
				else
				{
					$checkQuery[$parent_id] = array();  
				}
			}

			return $checkQuery;

		}

	}

	function getMenuDataNew($menu='0') 
	{
		$this->db->select("smenu.*,pmenu.menu_title as parentmenu");
		$this->db->from("menu AS smenu");
		$this->db->join("menu AS pmenu","smenu.parent_id = pmenu.menu_id", "left");
		$this->db->where("smenu.parent_id",$menu);
		$this->db->where("smenu.delete_status","1");
		$this->db->order_by("priority", "ASC"); 
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

	function getMenuDataNewAll() 
	{
		$this->db->select("smenu.*,pmenu.menu_title as parentmenu");
		$this->db->from("menu AS smenu");
		$this->db->join("menu AS pmenu","smenu.parent_id = pmenu.menu_id", "left");
		#$this->db->where("smenu.parent_id",$menu);
		$this->db->where("smenu.delete_status","1");
		$this->db->order_by("priority", "ASC"); 
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

	function insertMenu($data) 
	{
		if($this->db->insert('menu',$data))
		{
			return 1;

		}else{

			return 0;
		}
		
	}



	function updateMenu($data,$menu_id) 
	{
		$this->db->where('menu_id', $menu_id);
		if($this->db->update('menu',$data))
		{
			return 1;

		}else{
			return 0;
		}
		
	}


 }//End Of Class Model
 ?>
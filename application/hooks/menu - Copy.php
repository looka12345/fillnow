<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu {
	private $_include_paths = array();
	function createmenu() {
		$ci = &get_instance();
		$uri=  $ci->uri->segment(1);
		if(empty($uri))
		{
			$uri='index' ;
		}
		$linksArray = $this ->getMenuDataInSingal(0);
	$this->menu='';
		foreach($linksArray as $key=>$val)
		{
			$sublinurl = '';
			$linkname=$val->menu_title;
			if($val->module_name=='index')
			{
				$site_url=  site_url();
			}
			elseif($val->module_name=='')
			{
				if($this->chacksubmenu($val->menu_id)>0)
				{
					$site_url= $this->createsubmenu($val->menu_id,1);
				}else{
					$site_url=  site_url($val->menu_url);
				}
			}
			else
			{
				$site_url=  site_url($val->module_name.'/'.$val->menu_url);
			}
			if($this->chacksubmenu($val->menu_id)<>0)
			{
				if($val->menu_url !='#' && $val->menu_url !='')
				{
				$this->menu.= " <li class='dropdown'><a href='".site_url($val->menu_url)."' data-toggle='dropdown' class='dropdown-toggle'>$linkname<b class='caret'></a> ";
				}else{
					$this->menu.= " <li class='dropdown'><a href='javascript:void(0)' data-toggle='dropdown' class='dropdown-toggle'>$linkname<b class='caret'></b></a> ";
				}
			}
			else{
				$this->menu.= " <li><a href='".$site_url."'>$linkname</a> ";
			}
			if($this->chacksubmenu($val->menu_id)<>0)
			{
				$this->menu.=$this->createsubmenu($val->menu_id,0 ,$linkname);
			}
			$this->menu.= "</li>";
		}
		return $this->menu;
	}
	function createsubmenu($mainmainuid,$valtype=0,$linkname='') {
				$linksSubArray	= $this ->getMenuDataInSingal($mainmainuid);
		$menu='<ul role="menu" class="dropdown-menu">';
		$sublinurl = '';
		foreach($linksSubArray as $key=>$subval)
	{
			if($subval->module_name=='index')
			{
				$site_url=  site_url();
			}
			elseif($subval->module_name=='')
			{
				$site_url=  site_url($subval->menu_url);
			}
			else
			{
				$site_url=  site_url($subval->module_name.'/'.$subval->menu_url);
			}
			$sublinkname=$subval->menu_title;
					if($valtype !=0 )
					{
						$menu2= $site_url;
						break;
					}
					if($subval->menu_url!='#' && $subval->menu_url!=''){
					$menu.= "<li class='dropdown-submenu'><a href='$site_url'  tabindex='-1'> $sublinkname</a>";
					}else{
						$menu.= "<li class='dropdown-submenu'><a href='javascript:void(0)'  tabindex='-1'> $sublinkname</a>";
					}
						if($this->chacksubmenu($subval->menu_id)<>0)
						{
							$menu.=$this->createsubmenu($subval->menu_id);
						}
				$menu.= "</li>";
		}
		$menu.='</ul>';
		if($valtype !=0 )
					{
					return $menu2;
					}else
					{
		return  $menu;
					}
	}
	function createresourcesmenu($mainmainuid,$currentmenu) {
				$linksSubArray	= $this ->getMenuDataInSingal($mainmainuid);
		$menu='<ul>';
		$sublinurl = '';
	
		foreach($linksSubArray as $key=>$subval)
	{
			if($subval->module_name=='index')
			{
				$site_url=  site_url();
			}
			elseif($subval->module_name=='')
			{
				$site_url=  site_url($subval->menu_url);
			}
			else
			{
				$site_url=  site_url($subval->module_name.'/'.$subval->menu_url);
			}
			$sublinkname=$subval->menu_title;
					$class='';
					
					if($currentmenu==$subval->menu_id)
					{
						$class='active';
					}
					else
					{
						$class='';
					}
					
					$menu.= "<li ><a class='$class' href='$site_url' title=''> $sublinkname</a>";
						if($this->chacksubmenu($subval->menu_id)<>0)
						{
							$menu.=$this->createsubmenu($subval->menu_id);
						}
				$menu.= "</li>";
		}
	$menu.='</ul>';
				return  $menu	 ;
	}
		// --------------------------------------------------------------------
		
		
	function getMenuDataInSingal($menu_id)
	{
			
			
			$ci = &get_instance();
			
			$ci->db->select("smenu.*,mt.module_name,lt.catalog_layout_type");
		$ci->db->from("menu AS smenu");
			$ci->db->join("module_type AS mt","smenu.module_type = mt.module_type_id", "left");
			$ci->db->join("catalog_layout AS lt","smenu.catalog_layout = lt.catalog_layout_id", "left");
		$ci->db->where("smenu.parent_id",$menu_id);
			$ci->db->where("smenu.delete_status","1");
			$ci->db->where("smenu.active_status","1");
			$ci->db->order_by("priority", "ASC");
		$query = $ci->db->get();
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
		
		
		function getMenuCountInSingal($menu_id)
	{
			
			
			$ci = &get_instance();
			
			$ci->db->select("smenu.*,mt.module_name,lt.catalog_layout_type");
			
		$ci->db->from("menu AS smenu");
			$ci->db->join("module_type AS mt","smenu.module_type = mt.module_type_id", "left");
			$ci->db->join("catalog_layout AS lt","smenu.catalog_layout = lt.catalog_layout_id", "left");
		$ci->db->where("smenu.parent_id",$menu_id);
			$ci->db->where("smenu.delete_status","1");
			$ci->db->where("smenu.active_status","1");
			$ci->db->order_by("priority", "ASC");
		$query = $ci->db->get();
			return $query->num_rows();
		}
		
		function chacksubmenu($submenuid) {
				
							$total		= $this ->getMenuCountInSingal($submenuid);
			
			return $total;
	}
	
	
} // end class MY_Autoloader
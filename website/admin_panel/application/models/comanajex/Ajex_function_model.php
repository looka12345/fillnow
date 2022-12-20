<?php
 class Ajex_function_model extends CI_Model
 {
  //# Start Define Constuctor	 
  function __construct() 
  {
	  
   parent :: __construct();
     
  }
  //# End Define Constructor 

  # Define  function ForGet menu Page for Super Admin
function getSingalPageData($page_id=FALSE) 
{
	$this->db->select('spage.*');
	$this->db->from('admin_page AS spage');
	$this->db->where('spage.admin_page_id',$page_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	   
return $checkQuery;

}

function getSingalMenuData($menu_id=FALSE) 
{
	$this->db->select('spage.*');
	$this->db->from('menu AS spage');
	$this->db->where('spage.menu_id',$menu_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
 
return $checkQuery;

}
#Define function  for Get Refine Country 
function getRefinecountry($country_id=FALSE,$page1,$page2) 
{
	if($country_id!='0')
	{
		//echo $country_id;
		$this->db->select('con.*');
		$this->db->from('country AS con');
		$this->db->where('con.country_id',$country_id);
		$this->db->where("con.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	else
	{
		$this->db->select('con.*');
		$this->db->from('country AS con');
		$this->db->where("con.delete_status","1");
		$this->db->limit($page2,$page1);
		$query = $this->db->get();
		
	}
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	    
		return $checkQuery;

}

# Define Function for  Get Refine State
function getRefineState($refine_id=FALSE,$search_by_id=FALSE,$country_id=FALSE,$page1,$page2) 
{
	if($refine_id!='0')
	{
		$this->db->select('st.*,coun.country_name');
		$this->db->from('state AS st');
		$this->db->join('country AS coun', 'st.country_id = coun.country_id', 'left');
		$this->db->where("st.delete_status","1");
		$this->db->limit($page2,$page1);
		$this->db->order_by("st.priority", "desc"); 
		if($country_id===FALSE)
		{
		$this->db->where('st.'.$search_by_id,$refine_id);
		}
		else
		{
		$this->db->where('st.country_id',$country_id);
		$this->db->where('st.'.$search_by_id,$refine_id);	
		}
		$query = $this->db->get();
	}
	else
	{
		$this->db->select('st.*,pc.country_name');
		$this->db->from('state AS st');
		$this->db->join('country AS pc','st.country_id = pc.country_id', 'left');
		$this->db->where("st.delete_status","1");
		$this->db->limit($page2,$page1);
		$this->db->order_by("st.priority", "desc"); 
		if($country_id===FALSE)
		{
		//$this->db->where('prop_st.'.$search_by_id,$refine_id);
		}
		else
		{
		$this->db->where('st.country_id',$country_id);
		//$this->db->where('prop_st.'.$search_by_id,$refine_id);	
		}
		$query = $this->db->get();
		
	}
	 if($query->num_rows()>0) 
	   {
		 $checkQuery = $query->result();
	   }
	   else
	   {
		$checkQuery="";   
	   }
	   return $checkQuery; 
		

}

# Define Function for  Get Refine City

function getRefineCity($arrcondition=FALSE,$page1,$page2) 
{

		$this->db->select('city.*,coun.country_name,st.state_name');
		$this->db->from('city AS city');
		$this->db->join('state AS st', 'city.state_id = st.state_id', 'left');
		$this->db->join('country AS coun', 'city.country_id = coun.country_id', 'left');
		$this->db->where("city.delete_status","1");
		$this->db->limit($page2,$page1);
		$this->db->order_by("city.priority", "desc"); 
		if(is_array($arrcondition))
		{
		    foreach($arrcondition as $key => $value)
			{
		     if($value !=0)
			 {		
			  $this->db->where('city.'.$key,$value);	
			 }
			}
		  
		}
		$query = $this->db->get();

	 if($query->num_rows()>0) 
	   {
		 $checkQuery = $query->result();
	   }
	   else
	   {
		$checkQuery="";   
	   }
	   return $checkQuery; 

}

function updateFeatured($all_id,$dbdata,$status) 



{



	$database=$dbdata;



    $data_id=$dbdata."_id";



	$this->db->where($data_id,$all_id); 



    $this->db->set('featured',"$status");



    $query = $this->db->update($database);



		 



}
function getRefineLocality($arrcondition=FALSE,$page1,$page2) 
{

		$this->db->select('locality.*,coun.country_name,st.state_name,city.city_name');
		$this->db->from('locality AS locality');
		$this->db->join('city AS city', 'locality.city_id = city.city_id', 'left');
		$this->db->join('state AS st', 'locality.state_id = st.state_id', 'left');
		$this->db->join('country AS coun', 'locality.country_id = coun.country_id', 'left');
		$this->db->where("locality.delete_status","1");
		$this->db->limit($page2,$page1);
		$this->db->order_by("locality.priority", "desc"); 
		if(is_array($arrcondition))
		{
		    foreach($arrcondition as $key => $value)
			{
		     if($value !=0)
			 {		
			  $this->db->where('locality.'.$key,$value);	
			 }
			}
		  
		}
		$query = $this->db->get();

	 if($query->num_rows()>0) 
	   {
		 $checkQuery = $query->result();
	   }
	   else
	   {
		$checkQuery="";   
	   }
	   return $checkQuery; 

}



function getSingalUserGroup($user_group_id=FALSE) 
{
	$this->db->select('ug.*');
	$this->db->from('user_group AS ug');
	$this->db->where('ug.user_group_id',$user_group_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}

# Define Function  Get singal country

function getSingalCountry($country_id=FALSE) 
{
	$this->db->select('con.*');
	$this->db->from('country AS con');
	$this->db->where('con.country_id',$country_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}
# Define Function  Get State

function getSingalState($state_id=FALSE) 
{
	$this->db->select('ps.*');
	$this->db->from('state AS ps');
	$this->db->join('country AS pc','ps.country_id = pc.country_id', 'left');
	$this->db->where('ps.state_id',$state_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}


function getSingalCity($city_id=FALSE) 
{
	$this->db->select('ct.*');
	$this->db->from('city AS ct');
	$this->db->join('state AS st','ct.country_id = st.country_id', 'left');
	$this->db->join('country AS con','ct.country_id = con.country_id', 'left');
	$this->db->where('ct.city_id',$city_id);
	$this->db->where("ct.delete_status","1");
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	  return $checkQuery;

}



# Define Function for  dropdown State

function getDropState($country_id) 
{
	$this->db->select('ps.*,pc.country_name');
	$this->db->from('state ps');
	$this->db->join('country AS pc','ps.country_id = pc.country_id', 'left');
	$this->db->where('ps.country_id',$country_id);
	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	   else
	   {
		 $checkQuery ='';  
	   }
	   
return $checkQuery;

}


# Define Function for  dropdown City

function getDropcity($state_id) 
{
	$this->db->select('city.*');
	$this->db->from('city city');
	$this->db->where('city.state_id',$state_id);
	$this->db->where("city.delete_status","1");

	$query = $this->db->get();
	 if($query->num_rows()>0) 
	   {
		$checkQuery = $query->result();
	   }
	   else
	   {
		 $checkQuery ='';  
	   }
	   
return $checkQuery;

}

# Define Function for  Update Status

function updateStatus($all_id,$dbdata,$status) 
{
	$database=$dbdata;
    $data_id=$dbdata."_id";
	$this->db->where($data_id,$all_id); 
    $this->db->set('active_status',"$status");
    $query = $this->db->update($database);
		 
}


function updateTrashStatus($all_id,$dbdata,$status) 
{
	$database= $dbdata;
    $data_id=$dbdata."_id";
	$this->db->where($data_id,$all_id); 
    $this->db->set('delete_status',"$status");
    $query = $this->db->update($database);
	
	if($query)
	{
		$val=1;
		return $val;	
	}
	else
	{
		
		$val=0;
		return $val;	
	}
	
		 
}


function setpriority($set_id,$dbdata,$value) 
{
	$database=$dbdata;
    $data_id=$dbdata."_id";
	$this->db->where($data_id,$set_id); 
    $this->db->set('priority',$value);
	
    if($query = $this->db->update($database))
	{
		return 1;
		
	}
	else
	{
		return 0;
	}
}

 }//End Of Class Model
 
 
 
 
 
?>
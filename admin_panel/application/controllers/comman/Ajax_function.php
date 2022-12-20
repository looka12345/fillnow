<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_Function extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index()
	{
			$this->checklogoutsession();
		$data['header']='Admin Login';
	$data['page'] = 'admin/center_view/form_login';
	$this->load->view($this->_login_container,$data);
	}
	//	Start Function for filing data in form for edit Page
		
		function editPage()
				{
					$page_id=$_POST['page_id'];
					$data_pagemanage = $this->AJF->getSingalPageData($page_id);
					//print_r($data_pagemanage);
					$return = array('page_id' => $data_pagemanage[0]->admin_page_id , 'parent_id' => $data_pagemanage[0]->admin_parent_id,'page_name'=>$data_pagemanage[0]->admin_page,'page_link'=>$data_pagemanage[0]->page_url);
					die(json_encode($return));
					
				}
				
				
				
				function editMenu()
				{
				$menu_id=$_POST['menu_id'];
					$data_menumanage = $this->AJF->getSingalMenuData($menu_id);
	
					$return = array('menu_id' => $data_menumanage[0]->menu_id , 'parent_id' => $data_menumanage[0]->parent_id,'menu_title'=>$data_menumanage[0]->menu_title,'menu_url'=>$data_menumanage[0]->menu_url,'catalog_layout'=>$data_menumanage[0]->catalog_layout,'module_type'=>$data_menumanage[0]->module_type);
				die(json_encode($return));
					
				}
		//	End Function for filing data in form for edit Page
	
	
	function editCountry()
				{
				
				$country_id=$_POST['country_id'];
					$data_country = $this->AJF->getSingalCountry($country_id);
					$return = array('country_id' =>$data_country[0]->country_id, 'country_name'=>$data_country[0]->country_name);
				die(json_encode($return));
				}
				
	function editUserGroup()
				{
				
				$user_group_id=$_POST['user_group_id'];
					$data_user_group= $this->AJF->getSingalUserGroup($user_group_id);
					$return = array('user_group_id' =>$data_user_group[0]->user_group_id, 'user_group_name'=>$data_user_group[0]->user_group_name,'access_permission'=>$data_user_group[0]->access_permission,'modify_permission'=>$data_user_group[0]->modify_permission);
die(json_encode($return));
							}
				
		
		function editState()
				{
				
					$state_id=$_POST['state_id'];
					$data_state = $this->AJF->getSingalState($state_id);
					$return = array('state_id' => $state_id, 'state_name'=>$data_state[0]->state_name,'country_id'=>$data_state[0]->country_id);
die(json_encode($return));
				}
				
			
			function editCity()
				{
				
					$city_id=$_POST['city_id'];
					$data_city= $this->AJF->getSingalCity($city_id);
					$drop_stat= $this->AJF->getDropState($data_city[0]->country_id);
					$option="<option value='' selected >Select State </option>";
						if(is_array($drop_stat))
							{
							foreach ($drop_stat  as $value)
								{
								$state_name=$value->state_name;
								$state_id=$value->state_id;
							$option.="<option value='$state_id'>$state_name</option>";
							}
							
											}
							
					$return = array('city_id' => $city_id, 'city_name'=>$data_city[0]->city_name,'state_id'=>$data_city[0]->state_id,'country_id'=>$data_city[0]->country_id,'meta_key'=>$data_city[0]->meta_key,'meta_des'=>$data_city[0]->meta_des,'contant_title'=>$data_city[0]->contant_title,'content'=>$data_city[0]->content,'statedrop'=>$option);
					
					//print_r($return);
					die(json_encode($return));
				}
				
						//Start Function for Get State Dropdown
	
		function getStateDrop()
				{
					$country_id=$_POST['country_id'];
					$state_data= $this->AJF->getDropState($country_id);
						if($country_id=='')
						{
						$option="<option value='' selected >Select First  Country</option>";
						}
						else{
								$option="<option value='' selected >Select State </option>";
							}
						if(is_array($state_data))
							{
							foreach ($state_data  as $value)
								{
								$state_name=$value->state_name;
								$state_id=$value->state_id;
							$option.="<option value='$state_id'>$state_name</option>";
							}
							
						}
						else
							{
							if($country_id != 0)
								{
								$option="<option value='not' selected > State Not Avilabel </option>";
							}
												}
							$return = array('option' => $option);
						die(json_encode($return));
					}
			
				//Start Function for Get City Dropdown
				
			function getCityDrop()
				{
					
						$state_id=$_POST['state_id'];
					$city_data= $this->AJF->getDropCity($state_id);
						if($state_id==0)
						{
						$option="<option value='' selected >Select First  Country</option>";
						}
						else{
								$option="<option value='' selected >Select State </option>";
							}
						if(is_array($city_data))
							{
							foreach ($city_data  as $value)
								{
								$city_name=$value->city_name;
								$city_id=$value->city_id;
							$option.="<option value='$city_id'>$city_name</option>";
							}
							
						}
						else
							{
							if($state_id != 0)
								{
								$option="<option value='not' selected > State Not Avilabel </option>";
							}
												}
							$return = array('option' => $option);
						die(json_encode($return));
			
				//Start Function for Get City Dropdown OLD function
					
					$state_id=$_POST['state_id'];
					$sql_city="select * from  medicos_city where state_id=$state_id";
					$option="<option value='0' selected >Select</option>";
					$query_city=$obj_city->query($sql_city);
					while($data_city=mysql_fetch_assoc($query_city))
					{
						$city_name=$data_city['city_name'];
						$city_id=$data_city['city_id'];
					$option.="<option value='$city_id'>$city_name</option>";
					}
					$return = array('option' => $option);
die(json_encode($return));
					}
				
				//StartRefine Country  And Country Wise State City Location
		
			function refineCountry()
			
				{
					$imgpath= site_url("assets/admin/images")."/" ;
					//$country_id=$_POST['country_id'];
					$refine_con='';
					$data['seatchcountry'] = '';
			$table='country';
						$page=1;
				try
				{
						$searchbycount=isset($_POST['country_id']) ? $_POST['country_id']: 0;
						$data['seatchcountry'] = $searchbycount;
						$type=1;
						if($searchbycount!=0)
						{
							$cunditionarr=array('country_id'=>$searchbycount);
							$totalrecord=$this->ATL->getcount($table,$type,$cunditionarr);
						}
						else
						{
							$cunditionarr=FALSE;
							$totalrecord=$this->ATL->getcount($table,$type,$cunditionarr);
								
						}
						
						
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/countrymanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_country  =$this->AJF->getRefinecountry($searchbycount,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
									
				}
				catch (Exception $err)
				{
					log_message("error", $err->getMessage());
					return show_error($err->getMessage());
				}
			
			
					foreach ($data_country  as $value)
							{
						$country_name= $value->country_name;
						$country_id= $value->country_id;
						$confilid= '"priority'.$value->country_id.'"';
						$dbname='"country"';
						
								$refine_con.="	<tr>
							<td><input type='checkbox' name='' /></td>
							<td>$country_name</td>
							<td width='20'><a href='#' onclick='javascript: editcountry($country_id)'><img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
							
							<td width='20' ><a href='#'  class='ask' primary_key='".$value->country_id."' type_tbl='country' status_del='".$value->delete_status."'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
							<td id='statushtml".$value->country_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($country_id,".'"country"'.",1)' /></a></td>
							<td width='20'><input type='text' name='priority[]' id='priority".$value->country_id."' size='3' value='".$value->priority."' /></td>
							<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$country_id,$dbname)' value='Update' /></td>
								</tr>";
							}
					
					$return = array('refine_con' => $refine_con,"pagination"=>$pagination);
die(json_encode($return));
					}
				//End this  Function
			
					//StartRefine Country  And Country Wise State City Location
				
				function refineWithCountry()
				{
					
					$imgpath= site_url("assets/admin/images")."/" ;
					$country_id=$_POST['country_id'];
					$onpage=$_POST['onpage'];
					$refine_data='';
					
					if($onpage=='state-manage')
					{
						
					try
					{
						$page=1;
						$table='state';
						$cruntpage=1;
						$cunditionarr=array('country_id'=>$country_id);
						
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/statemanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_country = $data['state_arr'] =$this->AJF->getRefineState($country_id,'country_id',FALSE,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
						
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
						// $data_country = $this->AJF->getRefineState($country_id,'country_id');
						if(is_array($data_country ))
						{
						foreach ($data_country  as $value)
								{
										$state_name= $value->state_name;
										$state_id= $value->state_id;
										$country_name= $value->country_name;
										$confilid= '"priority'.$value->state_id.'"';
										$dbname='"state"';
										$refine_data.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($state_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->state_id."' type_tbl='state' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->state_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($state_id,".'"state"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->state_id."' size='3' value='".$value->priority."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$state_id,$dbname)' value='Update' /></td>
								</tr>";

								}
						}
						else
						{
								$refine_data =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
						
						
					}
					
					
						if($onpage=='city-manage')
					{
						
					try
					{
						$page=1;
						$table='city';
						$cruntpage=1;
						$cunditionarr=array('country_id'=>$country_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/citymanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_city = $data['city_arr'] =$this->AJF->getRefineCity($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
						// $data_country = $this->AJF->getRefineState($country_id,'country_id');
						if(is_array($data_city ))
						{
						foreach ($data_city  as $value)
								{
									$city_name= $value->city_name;
										$state_name= $value->state_name;
										$city_id= $value->city_id;
										$country_name= $value->country_name;
										$confilid= '"priority'.$value->city_id.'"';
										$dbname='"city"';
										$refine_data.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->city_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->city_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->city_id."' size='3' value='".$value->city_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$city_id,$dbname)' value='Update' /></td>
								</tr>";

								}
						}
						else
						{
								$refine_data =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
						
						
					}
					
					
							if($onpage=='locality-managment')
					{
						
					try
					{
						$page=1;
						$table='locality';
						$cruntpage=1;
						$cunditionarr=array('country_id'=>$country_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/localitymanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_locality = $data['locality_arr'] =$this->AJF->getRefineLocality($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
						// $data_country = $this->AJF->getRefineState($country_id,'country_id');
						if(is_array($data_locality ))
						{
						foreach ($data_locality  as $value)
								{
									$locality_name= $value->locality_name;
									$city_name= $value->city_name;
										$state_name= $value->state_name;
										$city_id= $value->city_id;
										$country_name= $value->country_name;
										$locality_id=$value->locality_id;
										$confilid= '"priority'.$value->locality_id.'"';
										$dbname='"locality"';
										$refine_data.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$locality_name</td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->locality_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->locality_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->locality_id."' size='3' value='".$value->locality_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$locality_id,$dbname)' value='Update' /></td>
								</tr>";

								}
						}
						else
						{
								$refine_data =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
						
						
					}
					
					
					$return = array('refine_data' => $refine_data,"pagination"=>$pagination);
die(json_encode($return));
					}
				//End this  Function
			
							//StartRefine State  And State Wise City Location
				
				function refineWithState( )
				{
					$imgpath= site_url("assets/admin/images")."/" ;
					$country_id=$_POST['country_id'];
					$state_id=$_POST['state_id'];
					$onpage=$_POST['onpage'];
					$refine_data='';
					if($onpage=='city-manage')
					{
						
					try
					{
						$page=1;
						$table='city';
						$cruntpage=1;
						$cunditionarr=array('country_id'=>$country_id,'state_id'=>$state_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/citymanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_city = $data['citye_arr'] =$this->AJF->getRefineCity($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
						// $data_country = $this->AJF->getRefineState($country_id,'country_id');
						if(is_array($data_city ))
						{
						foreach ($data_city  as $value)
								{
										$city_name= $value->city_name;
										$state_name= $value->state_name;
										$city_id= $value->city_id;
										$country_name= $value->country_name;
										$confilid= '"priority'.$value->city_id.'"';
										$dbname='"city"';
										$refine_data.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->city_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->city_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->city_id."' size='3' value='".$value->city_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$city_id,$dbname)' value='Update' /></td>
								</tr>";

								}
						}
						else
						{
								$refine_data =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
						
						
					}
					
					
						if($onpage=='city-manage')
					{
						
					try
					{
						$page=1;
						$table='city';
						$cruntpage=1;
						$cunditionarr=array('country_id'=>$country_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/citymanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_city = $data['city_arr'] =$this->AJF->getRefineCity($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
						// $data_country = $this->AJF->getRefineState($country_id,'country_id');
						if(is_array($data_city ))
						{
						foreach ($data_city  as $value)
								{
									$city_name= $value->city_name;
										$state_name= $value->state_name;
										$city_id= $value->city_id;
										$country_name= $value->country_name;
										$confilid= '"priority'.$value->city_id.'"';
										$dbname='"city"';
										$refine_data.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->city_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->city_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->city_id."' size='3' value='".$value->city_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$city_id,$dbname)' value='Update' /></td>
								</tr>";

								}
						}
						else
						{
								$refine_data =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
						
						
					}
					
					
							if($onpage=='locality-managment')
					{
						
					try
					{
						$page=1;
						$table='locality';
						$cruntpage=1;
						$cunditionarr=array('state_id'=>$state_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/localitymanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_locality = $data['locality_arr'] =$this->AJF->getRefineLocality($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
						// $data_country = $this->AJF->getRefineState($country_id,'country_id');
						if(is_array($data_locality ))
						{
						foreach ($data_locality  as $value)
								{
									$locality_name= $value->locality_name;
									$city_name= $value->city_name;
										$state_name= $value->state_name;
										$city_id= $value->city_id;
										$country_name= $value->country_name;
										$locality_id=$value->locality_id;
										$confilid= '"priority'.$value->locality_id.'"';
										$dbname='"locality"';
										$refine_data.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$locality_name</td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->locality_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->locality_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->locality_id."' size='3' value='".$value->locality_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$locality_id,$dbname)' value='Update' /></td>
								</tr>";

								}
						}
						else
						{
								$refine_data =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
						
						
					}
					
					$return = array('refine_data' => $refine_data,"pagination"=>$pagination);
die(json_encode($return));
					}
				//End this  Function
				
		// End Refine Country  And Country Wise State City Location
	function refineState()
				{
									$imgpath= site_url("assets/admin/images")."/" ;
					$state_id=$_POST['state_id'];
					$country_id=$_POST['country_id'];
				
					try
					{
						$page=1;
						$table='state';
						$cunditionarr=array('state_id'=>$state_id,'country_id'=>$country_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catlog/alltypelocation/statemanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_state = $data['state_arr'] =$this->AJF->getRefineState($state_id,'state_id',$country_id,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
					
					//$data_state = $this->AJF->getRefineState($state_id,'state_id',$country_id,$page1,$page2);
					$refine_sta='';
					if(is_array($data_state ))
						{
					foreach ($data_state  as $value)
							{
								$state_name=$value->state_name;
								$state_id=$value->state_id;
								$country_name=$value->country_name;
								$confilid= '"priority'.$value->state_id.'"';
								$dbname='"state"';
								$refine_sta.="<tr>
										<td><input type='checkbox' name='' /></td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($state_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->state_id."' type_tbl='state' status_del='".$value->delete_status."'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->state_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($state_id,".'"state"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->state_id."' size='3' value='".$value->state_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$state_id,$dbname)' value='Update' /></td>
								</tr>";
							}
						}
						else{
								$refine_sta =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
					//$return = array('refine_sta' => $refine_sta);
					$return = array('refine_sta' => $refine_sta,"pagination"=>$pagination);
die(json_encode($return));
					}
						//End this  Function
			// Start function For  Refine City
			
			function refineCity()
			
				{
									$imgpath= site_url("assets/admin/images")."/" ;
					$state_id=$_POST['state_id'];
					$country_id=$_POST['country_id'];
					$city_id=$_POST['city_id'];
					try
					{
						$page=1;
						$table='city';
						$cunditionarr=array('state_id'=>$state_id,'country_id'=>$country_id,'city_id'=>$city_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/statemanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_city = $data['city_arr'] =$this->AJF->getRefinecity($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
					
					//$data_state = $this->AJF->getRefineState($state_id,'state_id',$country_id,$page1,$page2);
					$refine_sta='';
					if(is_array($data_city ))
						{
					foreach ($data_city  as $value)
							{
										$cruntpage=1;
								$city_name= $value->city_name;
										$state_name= $value->state_name;
										$city_id= $value->city_id;
										$country_name= $value->country_name;
										$confilid= '"priority'.$value->city_id.'"';
										$dbname='"city"';
										$refine_sta.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->city_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->city_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->city_id."' size='3' value='".$value->city_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$city_id,$dbname)' value='Update' /></td>
								</tr>";
							}
						}else{
								$refine_sta =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
						}
					//$return = array('refine_sta' => $refine_sta);
					$return = array('refine_sta' => $refine_sta,"pagination"=>$pagination);
die(json_encode($return));
						}
				
		//End this  Function
		
		
		
					function refineLocality()
			
				{
									$imgpath= site_url("assets/admin/images")."/" ;
					$state_id=$_POST['state_id'];
					$country_id=$_POST['country_id'];
					$city_id=$_POST['city_id'];
					$cruntpage=1;
					try
					{
						$page=1;
						$table='locality';
						$cunditionarr=array('state_id'=>$state_id,'country_id'=>$country_id,'city_id'=>$city_id);
					$totalrecord=$this->ATL->getcount($table,1,$cunditionarr);
						$pagingConfig   = $this->paginationlib->initPagination("catalog/alltypelocation/statemanage/",$totalrecord);
						$pagination = $this->pagination->create_links();
						$data_locality= $data['locality_arr'] =$this->AJF->getRefineLocality($cunditionarr,(($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page']);
					}
					catch (Exception $err)
					{
						log_message("error", $err->getMessage());
						return show_error($err->getMessage());
					}
					
					//$data_state = $this->AJF->getRefineState($state_id,'state_id',$country_id,$page1,$page2);
					$refine_sta='';
					if(is_array($data_locality ))
						{
					foreach ($data_locality as $value)
							{
								$locality_name= $value->locality_name;
								$city_name= $value->city_name;
										$state_name= $value->state_name;
										$locality_id= $value->locality_id;
										$country_name= $value->country_name;
										$confilid= '"priority'.$value->locality_id.'"';
										$dbname='"locality"';
										$refine_sta.=	"<tr>
										<td><input type='checkbox' name='' /></td>
										<td>$locality_name</td>
										<td>$city_name</td>
										<td> $state_name </td>
										<td> $country_name</td>
										<td width='20'> <a href='#' onclick='javascript: editstate($city_id)'> <img src='".$imgpath."user_edit.png' alt='' title='' border='0' /></a></td>
										<td width='20' ><a href='#'  class='ask' primary_key='".$value->locality_id."' type_tbl='city' status_del='".$value->delete_status."' current_page='$cruntpage'><img src='".$imgpath."trash.png' alt='' title='' border='0' /></a></td>
										<td id='statushtml".$value->locality_id."' width='20'><a href='#' class='ask'><img src='".$imgpath."active.png' alt='' title='' border='0' onclick='changeStatus($city_id,".'"city"'.",1)' /></a></td>
										<td width='20'><input type='text' name='priority[]' id='priority".$value->locality_id."' size='3' value='".$value->locality_id."' /></td>
										<td width='20'> <input type='button' id='save' name='save' onclick='setpriority($confilid,$locality_id,$dbname)' value='Update' /></td>
								</tr>";
							}
						}
						else{
								$refine_sta =	"<tr>
										<td>&nbsp;</td>
										<td> Recors Not Fount </td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</td>
										<td width='20' >&nbsp;</td>
										<td> &nbsp;</td>
										<td width='20'>&nbsp;</a></td>
										<td id='statushtml' width='20'>&nbsp;</td>
								</tr>";
							
							
						}
						
						
					//$return = array('refine_sta' => $refine_sta);
					$return = array('refine_sta' => $refine_sta,"pagination"=>$pagination);
die(json_encode($return));
				}
// Start function For Change Active status
			function changeStatus()
				{
						$imgpath= site_url("assets/admin/images")."/" ;
					$all_id=$_POST['all_id'];
					$dbdata=$_POST['typedata'];
					$status=$_POST['status'];
					
				$status = $status=='1'? 0:1;
				$image_name = $status=='0'? "deactive.png":"active.png";
					$data_state = $this->AJF->updateStatus($all_id,$dbdata,$status);
					
					$return = array('status' => $status);
					die(json_encode($return));
				}
				
				function changeFeatured()
				{
						$imgpath= site_url("assets/admin/images")."/" ;
					$all_id=$_POST['all_id'];
					$dbdata=$_POST['typedata'];
					$status=$_POST['status'];
					
				$status = $status=='1'? 0:1;
				$image_name = $status=='0'? "deactive.png":"active.png";
					$data_state = $this->AJF->updateFeatured($all_id,$dbdata,$status);
					
					$return = array('status' => $status);
					die(json_encode($return));
				}
	// Start function For Record Add To Trash
				function addToTrash()
				{
					
					
					$primary_key=$_POST['primary_key'];
					$dbname=$_POST['dbname'];
				$thispagerecord=$_POST['thispagerecord'];
					$delstatus=$_POST['delstatus'];
					$currentpage_no=$_POST['currentpage'];
					$page_no='';
				$delstatus = $delstatus=='1'? 0:1;
					$data_return = $this->AJF->updateTrashStatus($primary_key,$dbname,$delstatus);
				if($data_return==1)
					{
						$return = array('msg' => 1);
					}
					else
					{
					$return = array('msg' =>0);
					}
					die(json_encode($return));
				}
				
				
				
				function setpriority()
				{
				$this->lang->load('country','english/country');
						$imgpath= site_url("assets/admin/images")."/" ;
					$set_id=$_POST['set_id'];
					$newvalue=$_POST['value'];
					$dbdata=$_POST['page'];
				$data_state = $this->AJF->setpriority($set_id,$dbdata,$newvalue);
					if($data_state==1)
					{
						$return = array('update' => 'yes');
						$data = array('success_country_update' => $this->lang->line('success_country_update'));
						$this->session->set_userdata($data);
					}
					else
					{
						$return = array('update' => 'no');
						$data = array('error_country_update' => $this->lang->line('error_country_update'));
						$this->session->set_userdata($data);
					}
					die(json_encode($return));
				}
				
		
				//End this  Function
}
?>
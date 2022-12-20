<?php 

if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Teammanage extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'team/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchteam=isset($_POST['searchteam'])? $_POST['searchteam']:"";
			
				
					$data['searchteam']   = $searchteam;
					if($searchteam!="")
					{
						  
						  $totalrecord=$this->TMM->getcountdata($searchteam,1);	
					}
					else
					{
					  
					  $totalrecord=$this->TMM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/team",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['teammanage_arr'] =$this->TMM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchteam);
					
					$data['onpage']=$this->uri->segment($pagingConfig['uri_segment']);
					$this->load->view($this->_admin_container,$data);             
            }
			catch (Exception $err)
			{
				log_message("error", $err->getMessage());
				return show_error($err->getMessage());
			}
			
	
			
	}
	public function add()
	{
			$this->checkloginsession();
		   
	        $data["page"] = "team/add.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data['pages_arr'] =$this->MCAP->getAllPages();
			$data["site_data"] =$this->MASC->getData();	
		  
	        $this->load->view($this->_admin_container,$data);
	}
	
	
	public function adddata()
	{
		$this->checkloginsession();
				if($this->input->post())
			{
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="team_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/team/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'designation'=>$_POST['designation'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'designation'=>$_POST['designation'],
				        'description'=>$_POST['description'],
				      	);
						}
				
			 		$data_return = $this->TMM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Team Added Successfully');
						redirect("catalog/teammanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/teammanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/teammanage");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$team_id=$this->uri->segment(4);
			$data["header"]="Welcome in propBizz Admin ";
	        $data["page"] = "team/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->TMM->getSingalData($team_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$team_id=$_POST['team_id'];
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="team_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/team/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$single_data=$this->TMM->getSingalData($team_id);
				$data=array(
					        'name'=>$_POST['name'],
				        'designation'=>$_POST['designation'],
				        'description'=>$_POST['description'],
						'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'designation'=>$_POST['designation'],
				        'description'=>$_POST['description'],
				       	);
						}
			 $data_return = $this->TMM->updateData($data,$team_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Team Updated Successfully');
						redirect("catalog/teammanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/teammanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/teammanage");
			}
		}
	 
 
	
	
  
}

<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Counselling extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'counselling/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchcounselling=isset($_POST['searchcounselling'])? $_POST['searchcounselling']:"";
			
				
					$data['searchcounselling']   = $searchcounselling;
					if($searchcounselling!="")
					{
						  
						  $totalrecord=$this->COM->getcountdata($searchcounselling,1);	
					}
					else
					{
					  
					  $totalrecord=$this->COM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/counselling",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['counselling_arr'] =$this->COM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchcounselling);
					
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
		   
	        $data["page"] = "counselling/add.php";
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
					$img_name="counselling_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/counselling/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '960';
					$config['height']   = '485';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'strategies'=>$_POST['strategies'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'strategies'=>$_POST['strategies'],
				        'description'=>$_POST['description'],
						);
						}
				
			 		$data_return = $this->COM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Counselling Added Successfully');
						redirect("catalog/counselling");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/counselling");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/counselling");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$counselling_id=$this->uri->segment(4);
	        $data["page"] = "counselling/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->COM->getSingalData($counselling_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$counselling_id=$_POST['counselling_id'];
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="counselling_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/counselling/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '960';
					$config['height']   = '485';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$single_data=$this->COM->getSingalData($counselling_id);
				$data=array(
					        'name'=>$_POST['name'],
				        'strategies'=>$_POST['strategies'],
				        'description'=>$_POST['description'],
						'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'strategies'=>$_POST['strategies'],
				        'description'=>$_POST['description'],
						);
						}
			 $data_return = $this->COM->updateData($data,$counselling_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Counselling Updated Successfully');
						redirect("catalog/counselling");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/counselling");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/counselling");
			}
		}
	 
 
	
	
  
}

<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Test_Preparation extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'test_preparation/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchtest_preparation=isset($_POST['searchtest_preparation'])? $_POST['searchtest_preparation']:"";
			
				
					$data['searchtest_preparation']   = $searchtest_preparation;
					if($searchtest_preparation!="")
					{
						  
						  $totalrecord=$this->TPM->getcountdata($searchtest_preparation,1);	
					}
					else
					{
					  
					  $totalrecord=$this->TPM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/test_preparation",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['test_preparation_arr'] =$this->TPM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchtest_preparation);
					
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
		   
	        $data["page"] = "test_preparation/add.php";
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
					$img_name="test_preparation_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/test_preparation/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '960';
					$config['height']   = '485';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'sat'=>$_POST['sat'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'sat'=>$_POST['sat'],
				        'description'=>$_POST['description'],
						);
						}
				
			 		$data_return = $this->TPM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Test Preparation Added Successfully');
						redirect("catalog/test_preparation");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/test_preparation");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/test_preparation");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$test_preparation_id=$this->uri->segment(4);
	        $data["page"] = "test_preparation/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->TPM->getSingalData($test_preparation_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$test_preparation_id=$_POST['test_preparation_id'];
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="test_preparation_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/test_preparation/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '960';
					$config['height']   = '485';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$single_data=$this->TPM->getSingalData($test_preparation_id);
				$data=array(
					        'name'=>$_POST['name'],
				        'sat'=>$_POST['sat'],
				        'description'=>$_POST['description'],
						'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'sat'=>$_POST['sat'],
				        'description'=>$_POST['description'],
						);
						}
			 $data_return = $this->TPM->updateData($data,$test_preparation_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Test Preparation Updated Successfully');
						redirect("catalog/test_preparation");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/test_preparation");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/test_preparation");
			}
		}  
}

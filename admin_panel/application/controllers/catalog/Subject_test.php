<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Subject_test extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'subject_test/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchsubject_test=isset($_POST['searchsubject_test'])? $_POST['searchsubject_test']:"";
			
				
					$data['searchsubject_test']   = $searchsubject_test;
					if($searchsubject_test!="")
					{
						  
						  $totalrecord=$this->STM->getcountdata($searchsubject_test,1);	
					}
					else
					{
					  
					  $totalrecord=$this->STM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/subject_test",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['subject_test_arr'] =$this->STM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchsubject_test);
					
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
		   
	        $data["page"] = "subject_test/add.php";
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
					$img_name="subject_test_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/subject_test/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '960';
					$config['height']   = '485';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
						);
						}
				
			 		$data_return = $this->STM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('subject_testion_message', 'Subject Test Added Successfully');
						redirect("catalog/subject_test");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/subject_test");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/subject_test");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$subject_test_id=$this->uri->segment(4);
	        $data["page"] = "subject_test/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->STM->getSingalData($subject_test_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$subject_test_id=$_POST['subject_test_id'];
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="subject_test_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/subject_test/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '960';
					$config['height']   = '485';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$single_data=$this->STM->getSingalData($subject_test_id);
				$data=array(
					        'name'=>$_POST['name'],
					        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
						'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
						);
						}
			 $data_return = $this->STM->updateData($data,$subject_test_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('subject_testion_message', 'Subject Test Updated Successfully');
						redirect("catalog/subject_test");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/subject_test");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/subject_test");
			}
		}
	 
 
	
	
  
}

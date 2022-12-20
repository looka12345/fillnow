<?php 

if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Blogpost extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'blogpost/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchblogpost=isset($_POST['searchblogpost'])? $_POST['searchblogpost']:"";
			
				
					$data['searchblogpost']   = $searchblogpost;
					if($searchblogpost!="")
					{
						  
						  $totalrecord=$this->BPM->getcountdata($searchblogpost,1);	
					}
					else
					{
					  
					  $totalrecord=$this->BPM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/blogpost",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['blogpost_arr'] =$this->BPM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchblogpost);
					
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
		   
	        $data["page"] = "blogpost/add.php";
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
					$img_name="blogpost_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/blogpost/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'short_description'=>$_POST['s_desc'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'short_description'=>$_POST['s_desc'],
				        'description'=>$_POST['description'],
						);
						}
				
			 		$data_return = $this->BPM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Blog Added Successfully');
						redirect("catalog/blogpost");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/blogpost");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/blogpost");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$blogpost_id=$this->uri->segment(4);
			$data["header"]="Welcome in propBizz Admin ";
	        $data["page"] = "blogpost/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->BPM->getSingalData($blogpost_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$blogpost_id=$_POST['blogpost_id'];

					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="blogpost_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/blogpost/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'short_description'=>$_POST['s_desc'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'short_description'=>$_POST['s_desc'],
				        'description'=>$_POST['description'],
						);
						}
			 $data_return = $this->BPM->updateData($data,$blogpost_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Blog Updated Successfully');
						redirect("catalog/blogpost");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/blogpost");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/blogpost");
			}
		}
	 
 
	
	
  
}

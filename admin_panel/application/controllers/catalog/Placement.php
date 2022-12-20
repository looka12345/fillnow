<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Placement extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'placement/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchplacement=isset($_POST['searchplacement'])? $_POST['searchplacement']:"";
			
				
					$data['searchplacement']   = $searchplacement;
					if($searchplacement!="")
					{
						  
						  $totalrecord=$this->PLM->getcountdata($searchplacement,1);	
					}
					else
					{
					  
					  $totalrecord=$this->PLM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/placement",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['placement_arr'] =$this->PLM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchplacement);
					
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
		   
	        $data["page"] = "placement/add.php";
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
				$data=array(
				        'name'=>$_POST['name'],
						);
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="img_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/download/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
						$data['image']=$img_name;
					}
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					$file_name="file_".rand().".".$ext;
					$config['upload_path'] ='../assets/sitesfile/image/download';
					$config['allowed_types'] = 'doc|docx|pdf|xlsx|xls';
					$config['file_name'] = $file_name;
					$config['encrypt_name'] = FALSE;
					$config['overwrite'] = TRUE;
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('file'))
					{
						$data['file']=$this->upload->file_name;
					}
				
			 		$data_return = $this->PLM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'File Added Successfully');
						redirect("catalog/placement");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/placement");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/placement");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$placement_id=$this->uri->segment(4);
	        $data["page"] = "placement/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->PLM->getSingalData($placement_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$placement_id=$_POST['placement_id'];
					$data=array(
				        'name'=>$_POST['name'],
						);
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="img_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/download/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					if($ext)
					{
						$data['image']=$img_name;
					}
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					$file_name="file_".rand().".".$ext;
					$config['upload_path'] ='../assets/sitesfile/image/download';
					$config['allowed_types'] = 'doc|docx|pdf|xlsx|xls';
					$config['file_name'] = $file_name;
					$config['encrypt_name'] = FALSE;
					$config['overwrite'] = TRUE;
					$config['remove_spaces'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ($this->upload->do_upload('file'))
					{
						$data['file']=$this->upload->file_name;
					}
			 $data_return = $this->PLM->updateData($data,$placement_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'File Updated Successfully');
						redirect("catalog/placement");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/placement");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/placement");
			}
		}
	 
 
	
	
  
}

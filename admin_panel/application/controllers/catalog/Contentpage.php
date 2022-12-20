<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Contentpage extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	$data['page'] = 'contentpage/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
{
					$searchcontentpage=isset($_POST['searchcontentpage'])? $_POST['searchcontentpage']:"";
			
				
					$data['searchcontentpage']   = $searchcontentpage;
					if($searchcontentpage!="")
					{
						
							$totalrecord=$this->MCAP->getcountpages($searchcontentpage,1);
					}
					else
					{
					
					$totalrecord=$this->MCAP->getcountpages("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/contentpage",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;
					//$data['pages_d'] =$this->MCAP->getAllPages();
					
					$data['pages_arr'] =$this->MCAP->getAllPages((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchcontentpage);
					
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
		$data["header"]="Welcome in propBizz Admin ";
	$data["page"] = "contentpage/add.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data['pages_arr'] =$this->MCAP->getAllPages();
			$data['user_group_array']= $this->UG->getAllUserGroup();
			$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
			$data["site_data"] =$this->MASC->getData();
		
	$this->load->view($this->_admin_container,$data);
	}
	
	
	public function adddata()
	{
		$this->checkloginsession();
		if($this->input->post())
			{	
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$file_name="banner_".rand().".".$ext;
			$config['upload_path'] =$this->config->item("DIR_IMAGE_PATH")."page_img/";
			$config['allowed_types'] = 'jpg|jpeg|png|mp4';
			$config['file_name'] = $file_name;
			$config['encrypt_name'] = FALSE;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image'))
			{
				$data=array(
					'title'=>$_POST['title'],
					'image'=>$file_name,
				'content'=>$_POST['content'],
						'meta_key'=>$_POST['meta_key'],
						'front_content'=>$_POST['front_content'],
						'taxonomy'=>$_POST['taxonomy'],
				'meta_tag'=>$_POST['meta_des'],
							'content_title'=>$_POST['contant_title'],
						'next'=>$_POST['next'],
						'previous'=>$_POST['previous'],
				'canonical'=>$_POST['canonical'],
						'meta_description'=>$_POST['meta_description'],
						'slider'=>$_POST['slider']
						);
				}
				else
				{
				$data=array(
					'title'=>$_POST['title'],
				'content'=>$_POST['content'],
						'meta_key'=>$_POST['meta_key'],
						'taxonomy'=>$_POST['taxonomy'],
						'front_content'=>$_POST['front_content'],
				'meta_tag'=>$_POST['meta_des'],
							'content_title'=>$_POST['contant_title'],
						'next'=>$_POST['next'],
						'previous'=>$_POST['previous'],
				'canonical'=>$_POST['canonical'],
						'meta_description'=>$_POST['meta_description'],
						'slider'=>$_POST['slider']
						);
				}
				
			$data_return = $this->MCAP->insertPage($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Page Added Successfully');
						redirect("catalog/contentpage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/contentpage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/contentpage");
			}
		}
	
		public function edit()
		{
			
			$this->checkloginsession();
			$page_id=$this->uri->segment(4);
			$data['page_id']=$page_id;
		$data["header"]="Welcome in propBizz Admin ";
	$data["page"] = "contentpage/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_page_data"]=$this->MCAP->getSinglePage($page_id);
			$data['user_group_array']= $this->UG->getAllUserGroup();
			$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
			$data["site_data"] =$this->MASC->getData();
		
	$this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$page_id=$_POST['content_page_id'];
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$file_name="banner_".rand().".".$ext;
			$config['upload_path'] =$this->config->item("DIR_IMAGE_PATH")."page_img/";
			$config['allowed_types'] = 'jpg|jpeg|png|mp4';
			$config['file_name'] = $file_name;
			$config['encrypt_name'] = FALSE;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->upload->do_upload('image');
			if ($ext)
			{
				$data=array(
					'title'=>$_POST['title'],
					'image'=>$file_name,
				'content'=>$_POST['content'],
						'meta_key'=>$_POST['meta_key'],
						'front_content'=>$_POST['front_content'],
				'meta_tag'=>$_POST['meta_des'],
							'content_title'=>$_POST['contant_title'],
						'next'=>$_POST['next'],
						'taxonomy'=>$_POST['taxonomy'],
						'previous'=>$_POST['previous'],
				'canonical'=>$_POST['canonical'],
						'meta_description'=>$_POST['meta_description'],
						'slider'=>$_POST['slider']
						);
				}
				else
				{
				
				$data=array(
					'title'=>$_POST['title'],
				'content'=>$_POST['content'],
						'meta_key'=>$_POST['meta_key'],
						'front_content'=>$_POST['front_content'],
				'meta_tag'=>$_POST['meta_des'],
							'content_title'=>$_POST['contant_title'],
						'taxonomy'=>$_POST['taxonomy'],
						'next'=>$_POST['next'],
						'previous'=>$_POST['previous'],
				'canonical'=>$_POST['canonical'],
						'meta_description'=>$_POST['meta_description'],
						'slider'=>$_POST['slider']
						);
				}
			$data_return = $this->MCAP->updatePage($data,$page_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Page Updated Successfully');
						redirect("catalog/contentpage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/contentpage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/contentpage");
			}
		}
	

	
	

}
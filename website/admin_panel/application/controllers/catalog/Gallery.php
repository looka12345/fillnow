<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Gallery extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		$this->checkloginsession();
		$data['page'] = 'gallery/list.php';
		$data['menup'] =$this->MD->getmenuelement();
		$data['menuch']=$this->MD->getmenuelement($data['menup']);
		$data["site_data"] =$this->MASC->getData();
		try
		{
			$searchgallery=isset($_POST['searchgallery'])? $_POST['searchgallery']:"";
			
			$data['searchgallery']   = $searchgallery;
			if($searchgallery!="")
			{
					$totalrecord=$this->GAL->getcountdata($searchgallery,1);
			}
			else
			{
				$totalrecord=$this->GAL->getcountdata("",1);
			}
			$pagingConfig   = $this->paginationlib->initPagination("catalog/gallery",$totalrecord,3);
			$data["pagination_helper"] = $this->pagination;
			$data['gallery_arr'] =$this->GAL->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchgallery);
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
		$data["page"] = "gallery/add.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data['pack_list'] =$this->GAL->getPackagesList();
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function adddata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="gal_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] = $this->config->item("DIR_ROOT_IMAGE")."/gallery/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					if($ext)
					{
				$data=array(
						'name'=>$_POST['name'],
						'path'=>$_POST['path'],
						'packageid'=>$_POST['packageid'],
						'image'=>$img_name
						);
					}
					else
						{
				$data=array(
						'name'=>$_POST['name'],
						'path'=>$_POST['path'],
						'packageid'=>$_POST['packageid'],
						);
						}
				$data_return = $this->GAL->insertData($data);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'Image Added Successfully');
				redirect("catalog/gallery");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/gallery");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/gallery");
		}
		}
	public function edit()
	{
		
		$this->checkloginsession();
		$gallery_id=$this->uri->segment(4);
		$data["header"]="Welcome in reco Admin ";
		$data["page"] = "gallery/edit.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data["single_data"]=$this->GAL->getSingalData($gallery_id);
		$data['pack_list'] =$this->GAL->getPackagesList();
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function updatedata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$gallery_id=$_POST['gallery_id'];
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="gal_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] = $this->config->item("DIR_ROOT_IMAGE")."/gallery/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '';
					$config['height']   = '';
					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					if($ext)
					{
				$data=array(
						'name'=>$_POST['name'],
						'path'=>$_POST['path'],
						'packageid'=>$_POST['packageid'],
						'image'=>$img_name
						);
					}
					else
						{
				$data=array(
						'name'=>$_POST['name'],
						'path'=>$_POST['path'],
						'packageid'=>$_POST['packageid'],
						);
						}
				$data_return = $this->GAL->updateData($data,$gallery_id);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'Image Updated Successfully');
				redirect("catalog/gallery");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/gallery");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/gallery");
		}
	}
}
<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Video extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		
		$this->checkloginsession();
		$data['page'] = 'video/list.php';
		$data['menup'] =$this->MD->getmenuelement();
		$data['menuch']=$this->MD->getmenuelement($data['menup']);
		$data["site_data"] =$this->MASC->getData();		
		
		try
		{
			$searchvideo=isset($_POST['searchvideo'])? $_POST['searchvideo']:"";
			
			$data['searchvideo']   = $searchvideo;
			if($searchvideo!="")
			{
					$totalrecord=$this->VDO->getcountdata($searchvideo,1);
			}
			else
			{
				$totalrecord=$this->VDO->getcountdata("",1);
			}
			$pagingConfig   = $this->paginationlib->initPagination("catalog/video",$totalrecord,3);
			$data["pagination_helper"] = $this->pagination;
				//$data['pages_d'] =$this->MCAP->getAllPages();
			$data['video_arr'] =$this->VDO->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchvideo);
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
		$data["page"] = "video/add.php";
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
			$data=array(
				'name'=>$_POST['name'],
				'path'=>$_POST['path'],
				'category'=>$_POST['category'],
				);
			
			if ($_POST['path'])
			{
				$data_return = $this->VDO->insertData($data);
			}
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'Video Added Successfully');
				redirect("catalog/video");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/video");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/video");
		}
		}
	public function edit()
	{
		
		$this->checkloginsession();
		$video_id=$this->uri->segment(4);
		$data["header"]="Welcome in reco Admin ";
		$data["page"] = "video/edit.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data["single_data"]=$this->VDO->getSingalData($video_id);
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
			$data=array(
				'name'=>$_POST['name'],
				'path'=>$_POST['path'],
				'category'=>$_POST['category'],
				);
			
			if ($data)
			{
				$video_id=$_POST['video_id'];
				$data_return = $this->VDO->updateData($data,$video_id);
			}
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'Video Updated Successfully');
				redirect("catalog/video");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/video");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/video");
		}
	}
}
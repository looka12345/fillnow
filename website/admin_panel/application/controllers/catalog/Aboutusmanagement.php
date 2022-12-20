<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Aboutusmanagement extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		
		$this->checkloginsession();
		$data['page'] = 'aboutusmanagement/list.php';
		$data['menup'] =$this->MD->getmenuelement();
		$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
		
		try
		{
			$searchaboutusmanagement=isset($_POST['searchaboutusmanagement'])? $_POST['searchaboutusmanagement']:"";
			
			$data['searchaboutusmanagement']   = $searchaboutusmanagement;
			if($searchaboutusmanagement!="")
			{
					$totalrecord=$this->AHC->getcountdata($searchaboutusmanagement,1);
			}
			else
			{
				$totalrecord=$this->AHC->getcountdata("",1);
			}
			$pagingConfig   = $this->paginationlib->initPagination("catalog/aboutusmanagement",$totalrecord,3);
			$data["pagination_helper"] = $this->pagination;
			$data['aboutusmanagement_arr'] =$this->AHC->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchaboutusmanagement);
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
		$data["page"] = "aboutusmanagement/add.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function adddata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$data=array(
				'about1'=>$_POST['about1'],
				'about2'=>$_POST['about2'],
				'about3'=>$_POST['about3'],
				);
					

			$data_return = $this->AHC->insertData($data);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'About Us Added Successfully');
				redirect("catalog/aboutusmanagement");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/aboutusmanagement");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/aboutusmanagement");
		}
		}
	public function edit()
	{
		
		$this->checkloginsession();
		$aboutusmanagement_id=$this->uri->segment(4);
		$data["header"]="Welcome in propBizz Admin ";
		$data["page"] = "aboutusmanagement/edit.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data["single_data"]=$this->AHC->getSingalData($aboutusmanagement_id);
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function updatedata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$data=array(
				'about1'=>$_POST['about1'],
				'about2'=>$_POST['about2'],
				'about3'=>$_POST['about3'],
				);
					
			$aboutusmanagement_id=$_POST['aboutusmanagement_id'];
			$data_return = $this->AHC->updateData($data,$aboutusmanagement_id);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'About Us Updated Successfully');
				redirect("catalog/aboutusmanagement");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/aboutusmanagement");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/aboutusmanagement");
		}
	}
}
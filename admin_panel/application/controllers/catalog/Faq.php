<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Faq extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		
		$this->checkloginsession();
		$data['page'] = 'faq/list.php';
		$data['menup'] =$this->MD->getmenuelement();
		$data['menuch']=$this->MD->getmenuelement($data['menup']);
		$data["site_data"] =$this->MASC->getData();
		
		try
		{
			$searchservices=isset($_POST['searchservices'])? $_POST['searchservices']:"";
			
			$data['searchservices']   = $searchservices;
			if($searchservices!="")
			{
					$totalrecord=$this->FAQM->getcountdata($searchservices,1);
			}
			else
			{
				$totalrecord=$this->FAQM->getcountdata("",1);
			}
			$pagingConfig   = $this->paginationlib->initPagination("catalog/faq",$totalrecord,3);
			$data["pagination_helper"] = $this->pagination;
			$data['faq_arr'] =$this->FAQM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchservices);
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
		$data["page"] = "faq/add.php";
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
			$data=array(
				'question'=>$_POST['question'],
				'packageid'=>$_POST['packageid'],
				'answer'=>$_POST['answer'],
				);
			
			$data_return = $this->FAQM->insertData($data);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'FAQ Added Successfully');
				redirect("catalog/faq");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/faq");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/faq");
		}
		}
	public function edit()
	{
		
		$this->checkloginsession();
		$services_id=$this->uri->segment(4);
		$data["header"]="Welcome in PebbleCold Admin ";
		$data["page"] = "faq/edit.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data['pack_list'] =$this->GAL->getPackagesList();
		$data["single_data"]=$this->FAQM->getSingalData($services_id);
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function updatedata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$data=array(
				'question'=>$_POST['question'],
				'packageid'=>$_POST['packageid'],
				'answer'=>$_POST['answer'],
				);
			$faq_id=$_POST['faq_id'];
			$data_return = $this->FAQM->updateData($data,$faq_id);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'FAQ Updated Successfully');
				redirect("catalog/faq");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/faq");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/faq");
		}
	}
}
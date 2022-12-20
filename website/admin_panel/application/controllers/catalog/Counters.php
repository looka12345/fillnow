<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Counters extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		
		$this->checkloginsession();
		$data['page'] = 'counters/list.php';
		$data['menup'] =$this->MD->getmenuelement();
		$data['menuch']=$this->MD->getmenuelement($data['menup']);
		$data["site_data"] =$this->MASC->getData();
		
		try
		{
			$searchservices=isset($_POST['searchservices'])? $_POST['searchservices']:"";
			
			$data['searchservices']   = $searchservices;
			if($searchservices!="")
			{
					$totalrecord=$this->CTM->getcountdata($searchservices,1);
			}
			else
			{
				$totalrecord=$this->CTM->getcountdata("",1);
			}
			$pagingConfig   = $this->paginationlib->initPagination("catalog/counters",$totalrecord,3);
			$data["pagination_helper"] = $this->pagination;
			$data['counters_arr'] =$this->CTM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchservices);
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
		$data["page"] = "counters/add.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data['pages_arr'] =$this->MCAP->getAllPages();
		$data['pro_arr']= $this->CTM->getProductsList();
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function adddata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$img_name="counter_".rand().".".$ext;
			$config['source_image'] = $_FILES['image']['tmp_name'];
			$config['new_image'] = $this->config->item("DIR_ROOT_IMAGE")."counter/".$img_name;
			$config['maintain_ratio'] = FALSE;
			$config['width']    = '55';
			$config['height']   = '55';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			if($this->image_lib->resize())
			{
			$data=array(
				'name'=>$_POST['name'],
				'product_id'=>$_POST['product'],
				'value'=>$_POST['value'],
				'image'=>$img_name
				);
		}else{
			$data=array(
				'name'=>$_POST['name'],
				'product_id'=>$_POST['product'],
				'value'=>$_POST['value'],
				);
		}
			$data_return = $this->CTM->insertData($data);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'USP Added Successfully');
				redirect("catalog/counters");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/counters");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/counters");
		}
		}
	public function edit()
	{
		
		$this->checkloginsession();
		$services_id=$this->uri->segment(4);
		$data["header"]="Welcome in propBizz Admin ";
		$data["page"] = "counters/edit.php";
		$data["menup"] =$this->MD->getmenuelement();
		$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
		$data["single_data"]=$this->CTM->getSingalData($services_id);
		$data['pro_arr']= $this->CTM->getProductsList();
		$data["site_data"] =$this->MASC->getData();
		$this->load->view($this->_admin_container,$data);
	}
	public function updatedata()
	{
		$this->checkloginsession();
		if($this->input->post())
		{
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$img_name="counter_".rand().".".$ext;
			$config['source_image'] = $_FILES['image']['tmp_name'];
			$config['new_image'] = $this->config->item("DIR_ROOT_IMAGE")."counter/".$img_name;
			$config['maintain_ratio'] = FALSE;
			$config['width']    = '55';
			$config['height']   = '55';
			$this->load->library('image_lib', $config);
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			if($ext)
			{
			$data=array(
				'name'=>$_POST['name'],
				'product_id'=>$_POST['product'],
				'value'=>$_POST['value'],
				'image'=>$img_name
				);
		}else{
			$data=array(
				'name'=>$_POST['name'],
				'product_id'=>$_POST['product'],
				'value'=>$_POST['value'],
				);
		}
			$counters_id=$_POST['counters_id'];
			$data_return = $this->CTM->updateData($data,$counters_id);
			if($data_return==1)
			{
				$this->session->set_flashdata('action_message', 'USP Added Successfully');
				redirect("catalog/counters");
			}
			else
			{
				$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/counters");
			}
		}
		else
		{
			$this->session->set_flashdata('error_message', 'Undefine Request');
			redirect("catalog/counters");
		}
	}
}
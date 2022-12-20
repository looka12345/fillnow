<?php
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Products extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		$this->checkloginsession();
		$data['page'] = 'products/list.php';
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
			{
					$searchproducts=isset($_POST['searchproducts'])? $_POST['searchproducts']:"";
					$data['searchproducts']   = $searchproducts;
					if($searchproducts!="")
					{
							$totalrecord=$this->MGPT->getcountdata($searchproducts,1);
					}
					else
					{
					$totalrecord=$this->MGPT->getcountdata("",1);
					}
					$pagingConfig   = $this->paginationlib->initPagination("catalog/products",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;
					$data['products_arr'] =$this->MGPT->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchproducts);
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
			$data["page"] = "products/add.php";
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
							'name'=>$_POST['name'],
							'taxonomy'=>$_POST['taxonomy'],
							'overview'=>$_POST['overview'],
							'description'=>$_POST['description'],
							'feature_short'=>$_POST['feature_short'],
							'feature'=>$_POST['feature'],
							'benefit_short'=>$_POST['benefit_short'],
							'benefit'=>$_POST['benefit'],
							'application'=>$_POST['application'],
							);
					
					$data_return = $this->MGPT->insertData($data);
					$inserted_products_id=$data_return['last_id'];
					if($data_return['msg']==1)
					{
						$this->session->set_flashdata('action_message', 'Product & Service Added Successfully');
						redirect("catalog/products");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/products");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/products");
			}
		}
		public function edit()
		{
			$this->checkloginsession();
			$products_id=$this->uri->segment(4);
			$data["header"]="Welcome in Admin ";
			$data["page"] = "products/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->MGPT->getSingalData($products_id);
			$data["site_data"] =$this->MASC->getData();
			$this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$products_id=$_POST['products_id'];
				$data=array(
							'name'=>$_POST['name'],
							'taxonomy'=>$_POST['taxonomy'],
							'overview'=>$_POST['overview'],
							'description'=>$_POST['description'],
							'feature_short'=>$_POST['feature_short'],
							'feature'=>$_POST['feature'],
							'benefit_short'=>$_POST['benefit_short'],
							'benefit'=>$_POST['benefit'],
							'application'=>$_POST['application'],
							);
			
					$data_return = $this->MGPT->updateData($data,$products_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Product & Service Updated Successfully');
						redirect("catalog/products");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/products");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/products");
			}
		}
}
?>
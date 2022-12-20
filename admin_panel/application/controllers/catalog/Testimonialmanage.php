<?php
	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
							* 		http://plantyourtree.com/index.php/welcome
				*	- or -
							* 		http://plantyourtree.com/index.php/welcome/index
				*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it"s displayed at http://plantyourtree.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	*/
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Testimonialmanage extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
		$data['page'] = 'testimonial/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
{
					$searchtestimonial=isset($_POST['searchtestimonial'])? $_POST['searchtestimonial']:"";
			
				
					$data['searchtestimonial']   = $searchtestimonial;
					if($searchtestimonial!="")
					{
						
							$totalrecord=$this->MAHCTM->getcountdata($searchtestimonial,1);
					}
					else
					{
					
					$totalrecord=$this->MAHCTM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/testimonial",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;
					//$data['pages_d'] =$this->MCAP->getAllPages();
					
					$data['testimonial_arr'] =$this->MAHCTM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchtestimonial);
					
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
		
	$data["page"] = "testimonial/add.php";
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
				'description'=>$_POST['description']
						);
			$data_return = $this->MAHCTM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Testimonial Added Successfully');
						redirect("catalog/testimonialmanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/testimonialmanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/testimonialmanage");
			}
		}
	
		public function edit()
		{
			
			$this->checkloginsession();
			$testimonial_id=$this->uri->segment(4);
			$data["header"]="Welcome in propBizz Admin ";
	$data["page"] = "testimonial/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->MAHCTM->getSingalData($testimonial_id);
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
				$testimonial_id=$_POST['testimonial_id'];
				$data=array(
				'name'=>$_POST['name'],
				'description'=>$_POST['description']
						);
			$data_return = $this->MAHCTM->updateData($data,$testimonial_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Testimonial Updated Successfully');
						redirect("catalog/testimonialmanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/testimonialmanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/testimonialmanage");
			}
		}
	
	
	
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
<?php 
if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Pagemanage extends  Admin_Controller {
	public function __construct()	{		
		parent::Admin_ControllerClass();
		$this->clearcache();	
	}
	public function index()
	{
			$this->checkloginsession();
		    $data["header"]="Welcome in propBizz Admin ";
	        $data["page"] = "pagemanage/list.php";
			$data["menup"] =$this->MD->getmenuelement();
			
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data['user_group_array']= $this->UG->getAllUserGroup();
			$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
			$data["site_data"] =$this->MASC->getData();
			$data["page_data"] =$this->MACP->getData();
		    $data["header"]="Admin Login";
	        $this->load->view($this->_admin_container,$data);
			
	}
	public function add()
	{
			$this->checkloginsession();
		    $data["header"]="Welcome in propBizz Admin ";
	        $data["page"] = "pagemanage/add.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
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
					   'admin_page'=>$_POST['page_name'],
				       'page_url'=>$_POST['page_link'],
					   'icon_class'=>$_POST['icon_class'],
				       'admin_parent_id'=>$_POST['parent_id'],
					   'taxonomy'=>$_POST['taxonomy']	
						);
			 $data_return = $this->MD->insertAdminPage($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Page Added Successfully');
						redirect("catalog/pagemanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/pagemanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/pagemanage");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$page_id=$this->uri->segment(4);
			$data['page_id']=$page_id;
		    $data["header"]="Welcome in propBizz Admin ";
	        $data["page"] = "pagemanage/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["edit_data"]=$this->MD->getDataById($page_id);
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
				$page_id=$_POST['page_id'];
				$data=array(
					    'admin_page'=>$_POST['page_name'],
				        'page_url'=>$_POST['page_link'],
						'icon_class'=>$_POST['icon_class'],
				        'admin_parent_id'=>$_POST['parent_id'],	
						'taxonomy'=>$_POST['taxonomy']
						);
			 $data_return = $this->MD->updateAdminPage($data,$page_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Page Updated Successfully');
						redirect("catalog/pagemanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/pagemanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/pagemanage");
			}
		}
	 
 
	
	
  
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
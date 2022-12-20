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
class menuManage extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index()
	{
			$this->checkloginsession();
		    $data["header"]="Menu Management ";
	        $data["page"] = "menumanage/list.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["site_data"] =$this->MASC->getData();
			$data['button_delete_all']='Delete Multipal';
		    $data['button_add_new_menu']='Add New Menu';
			$data["pairent_menu"] =$this->FM->getMenuDataNew();
		    $this->load->view($this->_admin_container,$data);
			
	}
	public function edit()
		{
				$this->checkloginsession();
			$menu_id=$this->uri->segment(4);
		     $data["page"] = "menumanage/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["site_data"] =$this->MASC->getData();
		
			$data["pairent_menu"] =$this->FM->getMenuDataNewAll();
			$data["child_manu"]=$this->FM->getMenuData($data["pairent_menu"]);
			$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
			$data['module_type_arr'] =$this->CMT->getAllModuleType();
			$data['page_type_arr'] =$this->MD->getAllPageType();
			$data['pages_arr'] =$this->MCAP->getAllPages();
			$data['single_menu']=$this->FM->getSingleMenu($menu_id);
			
		    $this->load->view($this->_admin_container,$data);
		}
	public function add()
		{
			$this->checkloginsession();
		     $data["page"] = "menumanage/add.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["site_data"] =$this->MASC->getData();
			$data["pairent_menu"] =$this->FM->getMenuDataNewAll();
			$data["child_manu"]=$this->FM->getMenuData($data["pairent_menu"]);
			$data['catalog_layout_arr'] =$this->CL->getAllCatalog_layout();
			$data['module_type_arr'] =$this->CMT->getAllModuleType();
			$data['page_type_arr'] =$this->MD->getAllPageType();
			$data['pages_arr'] =$this->MCAP->getAllPages();
			
		    $this->load->view($this->_admin_container,$data);
		}
	public function insertMenu()
	{
			$this->checkloginsession();
		if($this->input->post())
			{
					if($_POST['page_type']==1)
						{
							$type_id=$_POST['type_category_id'];
						}
						else if($_POST['page_type']==2)
						{
							$type_id=$_POST['type_page_id'];
						}
						else
						{
							$type_id=0;
						}
					
		     		$data= array('menu_title'=>$_POST['menu_title'],'url_type'=>$_POST['url_type'],'page_type'=>'3','type_id'=>$type_id,'menu_url'=>$_POST['menu_link'],'parent_id'=>$_POST['parent_id'],'catalog_layout'=>$_POST['catalog_layout'],'module_type'=>$_POST['module_type']);	
					$data_return = $this->FM->insertMenu($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Menu Added Successfully');
						redirect("catalog/menumanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/menumanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/menumanage");
			}
		}
		
	 function updateMenu() 
{
			$this->checkloginsession();
		if($this->input->post())
			{
					if($_POST['page_type']==1)
						{
							$type_id=$_POST['type_category_id'];
						}
						else if($_POST['page_type']==2)
						{
							$type_id=$_POST['type_page_id'];
						}
						else
						{
							$type_id=0;
						}
					$data= array('menu_title'=>$_POST['menu_title'],'url_type'=>$_POST['url_type'],'page_type'=>$_POST['page_type'],'type_id'=>$type_id,'menu_url'=>$_POST['menu_link'],'parent_id'=>$_POST['parent_id'],'catalog_layout'=>$_POST['catalog_layout'],'module_type'=>$_POST['module_type']);	
					$menu_id = $this->input->post('edit_menu_id');	
					$data_return = $this->FM->updateMenu($data,$menu_id);
				if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Menu Updated Successfully');
						redirect("catalog/menumanage");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/menumanage");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/menumanage");
			}
				  }
 
	
	//#End Check Login Process  
	  
	//# Start For Validation Rule 
  function validate_form() 
  {
   $this->form_validation->set_rules("username", "Email", "trim|required|valid_email|xss_clean");
   $this->form_validation->set_rules("password", "Password", "trim|required");
    if($this->form_validation->run()==FALSE) 
    {
	 return FALSE;
    } 
   else 
    {
	 return TRUE;
    }
  }
 //# End For Validation Rule  
  
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
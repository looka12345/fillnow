<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class userManage extends  Admin_Controller {
	public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
	}
	public function index($page=1)
	{
		
		$this->checkloginsession();
			$data['entery_name']=$this->lang->line('entery_name');
				$data['entery_access_permission']=$this->lang->line('entery_access_permission');
				$data['entery_modify_permission']=$this->lang->line('entery_modify_permission');
				$data['header']=$this->lang->line('entery_header');
				$data['search_header']=$this->lang->line('entery_search_header');
				$data['page']= "user/list.php";
				$data['entery_search_txt']=$this->lang->line('entery_search_txt');
				
				$data['button_update']=$this->lang->line('button_update');
				$data['button_insert']=$this->lang->line('button_insert');
				$data['button_delete_all']=$this->lang->line('button_delete_all');
				$data['button_add_new_group']=$this->lang->line('button_add_new_group');
				
				$data['column_name']=$this->lang->line('column_name');
				$data['column_mail_id']=$this->lang->line('column_mail_id');
				$data['column_last_login']=$this->lang->line('column_last_login');
				$data['column_edit']=$this->lang->line('column_edit');
				$data['column_delete']=$this->lang->line('column_delete');
				$data['column_status']=$this->lang->line('column_status');
				$data['column_order']=$this->lang->line('column_order');
				$data['error_update']=$this->lang->line('error_update');
				$data['success_update']=$this->lang->line('success_update');
				
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data['user_group_array']= $this->UG->getAllUserGroup();
			$data["site_data"] =$this->MASC->getData();
			$data['seatchcountry'] = '';
			$data['seatchstate']   = '';
			$table='admin_login';
		try
		{
					$searchbyuser=isset($_POST['searchbyuser'])? $_POST['searchbyuser']:"";
					$data['searchbyuser'] = $searchbyuser;
					
					if($searchbyuser!="")
					{
						
						$totalrecord=$this->UM->getcount($searchbyuser,1);
					}
					else
					{
						
						$totalrecord=$this->UM->getcount('',1);
							
					}
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/usermanage/",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;
					$data['user_arr'] =$this->UM->getAllUser((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchbyuser);
					$data['onpage']=$this->uri->segment($pagingConfig['uri_segment']);
					$this->load->view($this->_admin_container,$data);
}
			catch (Exception $err)
			{
				log_message("error", $err->getMessage());
				return show_error($err->getMessage());
			}
	}
		public function profile()
			{
				$this->checkloginsession();
			$admin_login_id=$this->session->userdata("emp_login_id");
			$data["page"] = "user/profile.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data['edit_user_data']= $this->UM->getSingalUser($admin_login_id);
			$data["site_data"] =$this->MASC->getData();
			$this->load->view($this->_admin_container,$data);
			}
	
	
	public function add()
		{
		
		
		$this->checkloginsession($page=1);
				
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data['page']= "user/add.php";
			$data['user_group_array']= $this->UG->getAllUserGroup();
			$data["site_data"] =$this->MASC->getData();
			$data['seatchcountry'] = '';
			$data['seatchstate']   = '';
			$table='city';
		try
{
					$searchbyuser=isset($_POST['searchbyuser'])? $_POST['searchbyuser']:0;
					$data['searchbyuser'] = $searchbyuser;
					
					if($searchbyuser!=0)
					{
						$data['user_arr'] =$this->UM->getAllUser();
					}
					else
					{
						$table='admin_login';
						$totalrecord=$this->UM->getcount($table,1);
							
					}
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/usermanage/",$totalrecord);
					$data["pagination_helper"] = $this->pagination;
					$data['user_arr'] =$this->UM->getAllUser((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchbyuser);
					$data['onpage']=$this->uri->segment($pagingConfig['uri_segment']);
					$this->load->view($this->_admin_container,$data);
}
			catch (Exception $err)
			{
				log_message("error", $err->getMessage());
				return show_error($err->getMessage());
			}
		}
	public function updatelogininfo()
			{
					$this->checkloginsession();
					$ext=end(explode(".", $_FILES['image']['name']));
					$login_user_id=$_POST["login_user_id"];
					$img_name="user_".rand().".".$ext;
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] = "assets/images/user/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = 585;
					$config['height']   = 585;
					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
					$data=array(
								"name"=>$_POST["user_name"],
								"contact_no"=>$_POST["phone"],
								"image"=>$img_name,
								"designation"=>$_POST["designation"],
								"employer_Id"=>$_POST["emp_id"]
							);
					}
					else
						{
					$data=array(
								"name"=>$_POST["user_name"],
								"contact_no"=>$_POST["phone"],
								"designation"=>$_POST["designation"],
								"employer_Id"=>$_POST["emp_id"]
							);
						}
					$this->LM->updateLoginuser($data,$login_user_id);
					$this->session->set_flashdata('user_message', 'Your Information Updated Successsfully');
					redirect("catalog/usermanage/profile");
			}
		public function updateloginpassword()
			{
					$this->checkloginsession();
					$login_user_id=$_POST["login_user_id"];
					$pwd = $this->encrypt->sha1($_POST['password']);
					$data=array(
								"password"=>$pwd
							);
					$this->LM->updateLoginuserpass($data,$login_user_id);
					$this->session->set_flashdata('user_message', 'Your Password Updated Successsfully');
					redirect("catalog/usermanage/profile");
			}
	function edit()
				{
			$this->checkloginsession();
			$admin_login_id=$this->uri->segment(4);
			$page_id=$this->uri->segment(4);
			$data['page_id']=$page_id;
		$data["header"]="Welcome in propBizz Admin ";
	$data["page"] = "user/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data['edit_user_data']= $this->UM->getSingalUser($admin_login_id);
			$data["site_data"] =$this->MASC->getData();
		
		
	$this->load->view($this->_admin_container,$data);
					
				}
	
			function insertAdminLogin()
			{
				
					$this->checkloginsession();
		if($this->input->post())
					{
					$pwd = $this->encrypt->sha1($_POST['password']);
					$data= array( 'logindetail'=> array('email_id'=>$_POST['user_mail_id'],'user_group'=>$_POST['user_group'],'password'=>$pwd),'admindetails'=>array('name'=>$_POST['user_name'],'contact_no'=>$_POST['contact_no'],'designation'=>$_POST['designation'],'employer_Id'=>$_POST['employer_id']));
					$data_return = $this->UM->insertAdminLogin($data);
					if($data_return==1)
					{
							$this->session->set_flashdata('action_message', 'User Added Successsfully');
				redirect("catalog/usermanage");
					}
				
					else
				{
						$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/usermanage");
				}
					}
					else
					{
						$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/usermanage");
					}
								}
	function updateAdminLogin()
{
					$this->checkloginsession();
		if($this->input->post()){
				
					//$pwd = $this->encrypt->sha1($_POST['password']);
					$admin_login_id=$this->uri->segment(4);
					$data= array( 'logindetail'=> array('email_id'=>$_POST['user_mail_id'],'user_group'=>$_POST['user_group']),'admindetails'=>array('name'=>$_POST['user_name'],'contact_no'=>$_POST['contact_no'],'designation'=>$_POST['designation'],'employer_Id'=>$_POST['employer_id']));
						//	$data= array( 'logindetail'=> array('email_id'=>$_POST['user_mail_id'],'user_group'=>$_POST['user_group'],'password'=>$pwd),'admindetails'=>array('name'=>$_POST['user_name'],'contact_no'=>$_POST['contact_no'],'designation'=>$_POST['designation'],'employer_Id'=>$_POST['employer_id']));
					$data_return = $this->UM->updateAdminLogin($data,$admin_login_id);
					if($data_return==1)
					{
							$this->session->set_flashdata('action_message', 'User Updated Successsfully');
				redirect("catalog/usermanage");
					}
				
					else
				{
						$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/usermanage");
				} }
					else
					{
						$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/usermanage");
					}
						}
					
				
			public function updateAdminPassword()
			{
				
					$this->checkloginsession();
		if($this->input->post()){
				
					$pwd = $this->encrypt->sha1($_POST['password']);
					$admin_login_id=$_POST['admin_login_id'];
						$data= array( 'logindetail'=> array('password'=>$pwd),'admindetails'=>array());
					$data_return = $this->UM->updateAdminLogin($data,$admin_login_id);
					if($data_return==1)
					{
							$this->session->set_flashdata('action_message', 'Password Updated Successsfully');
				redirect("catalog/usermanage");
					}
				
					else
				{
						$this->session->set_flashdata('error_message', 'Please Try Again');
				redirect("catalog/usermanage");
				} }
					else
					{
						$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/usermanage");
					}
				
			}

//# Start For Validation Rule
function validate_form()
{
$this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required');
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
/* End of file All Locatoin .php */
/* Location: ./application/controllers/admin/alltypelocatoin.php */
<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Sat extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
	public function index($page=1)
	{
			
		
		$this->checkloginsession();
		
	        $data['page'] = 'sat/list.php';
		
			$data['menup'] =$this->MD->getmenuelement();
			$data['menuch']=$this->MD->getmenuelement($data['menup']);
			$data["site_data"] =$this->MASC->getData();
			try
            {
					$searchsat=isset($_POST['searchsat'])? $_POST['searchsat']:"";
			
				
					$data['searchsat']   = $searchsat;
					if($searchsat!="")
					{
						  
						  $totalrecord=$this->SAM->getcountdata($searchsat,1);	
					}
					else
					{
					  
					  $totalrecord=$this->SAM->getcountdata("",1);
							
					}
					
					
					$pagingConfig   = $this->paginationlib->initPagination("catalog/sat",$totalrecord,3);
					$data["pagination_helper"] = $this->pagination;

					$data['sat_arr'] =$this->SAM->getAllData((($page-1) * $pagingConfig['per_page']),$pagingConfig['per_page'],$searchsat);
					
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
		   
	        $data["page"] = "sat/add.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data['pages_arr'] =$this->MCAP->getAllPages();
			$data["site_data"] =$this->MASC->getData();	
		  
	        $this->load->view($this->_admin_container,$data);
	}
	
	
	public function adddata()
	{
		$this->checkloginsession();
				if($this->input->post())
			{
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="sat_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/sat/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '810';
					$config['height']   = '540';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$data=array(
				        'name'=>$_POST['name'],
				        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
     					'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
						);
						}
				
			 		$data_return = $this->SAM->insertData($data);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Sat Added Successfully');
						redirect("catalog/sat");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/sat");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/sat");
			}
	}	
	
		public function edit()
		{
			
			$this->checkloginsession();
			$sat_id=$this->uri->segment(4);
	        $data["page"] = "sat/edit.php";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
			$data["single_data"]=$this->SAM->getSingalData($sat_id);
			$data["site_data"] =$this->MASC->getData();
		
		  
	        $this->load->view($this->_admin_container,$data);
		}
		public function updatedata()
		{
			$this->checkloginsession();
		if($this->input->post())
			{
				$sat_id=$_POST['sat_id'];
					$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					$img_name="sat_".rand().".".$ext;
					$config['source_image'] = $_FILES['image']['tmp_name'];
					$config['new_image'] =$this->config->item("DIR_ROOT_IMAGE")."/sat/".$img_name;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '810';
					$config['height']   = '540';
					$this->load->library('image_lib', $config); 
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
				$single_data=$this->SAM->getSingalData($sat_id);
				$data=array(
					        'name'=>$_POST['name'],
					        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
						'image'=>$img_name,
						);
					}
					else
						{
				$data=array(
				        'name'=>$_POST['name'],
				        'about'=>$_POST['about'],
				        'description'=>$_POST['description'],
						);
						}
			 $data_return = $this->SAM->updateData($data,$sat_id);
					if($data_return==1)
					{
						$this->session->set_flashdata('action_message', 'Sat Updated Successfully');
						redirect("catalog/sat");
					}
					else
					{
					$this->session->set_flashdata('error_message', 'Please Try Again');
					redirect("catalog/sat");
					}
			}
		else
			{
				$this->session->set_flashdata('error_message', 'Undefine Request');
				redirect("catalog/sat");
			}
		}
	 
 
	
	
  
}

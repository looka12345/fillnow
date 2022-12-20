<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Siteconfiguration extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();		
	}
	public function index($page=1)
	{
		$this->checkloginsession();
			$this->lang->load('siteconfiguration', 'english/user');
		$data['page_title']=$this->lang->line('page_title');
						$data['heading_title']=$this->lang->line('heading_title');
			$data['heading_logo']=$this->lang->line('heading_logo');
			$data['heading_email']=$this->lang->line('heading_email');
			$data['heading_action']=$this->lang->line('heading_action');
	$data["page"]  = "siteconfiguration/list.php";
			$table="site_configuration";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
				$data["site_data"] =$this->MASC->getData();
			$this->load->view($this->_admin_container,$data);
	}
		
	public function edit($page=1)
	{
		$this->checkloginsession();
			$this->lang->load('siteconfiguration', 'english/user');
			$data['page_title']=$this->lang->line('page_title');
			$data['sub_page_title']=$this->lang->line('sub_page_title');
			$data['form_title']=$this->lang->line('form_title');
			$data['form_web_url']=$this->lang->line('form_web_url');
			$data['form_logo']=$this->lang->line('form_logo');
			$data['form_keyword']=$this->lang->line('form_keyword');
			$data['form_email']=$this->lang->line('form_email');
			$data['form_facebook']=$this->lang->line('form_facebook');
			$data['form_twitter']=$this->lang->line('form_twitter');
			$data['form_google']=$this->lang->line('form_google');
			$data['form_site_description']=$this->lang->line('form_site_description');
			$data['form_site_address']=$this->lang->line('form_site_address');
			$data['button_update']=$this->lang->line('button_update');
	$data["page"]  = "siteconfiguration/edit.php";
			$table="site_configuration";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
							$data["site_data"] =$this->MASC->getData();
			$totalrecord=$this->MASC->getcount($table,1,1);
			$uri_segment   = 3;
			$pagingConfig   = $this->paginationlib->initPagination("catalog/siteconfiguration/",$totalrecord,$uri_segment);
			$data["pagination_helper"] = $this->pagination;
	$this->load->view($this->_admin_container,$data);
	}
	public function update()
	{
		
		if($this->input->post())
		{
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$file_name="siteconfig_".rand().".".$ext;
			$config['upload_path'] =$this->config->item("DIR_ROOT_IMAGE")."/siteconfig/";
			$config['allowed_types'] = 'png|gif|jpg|jpeg';
			$config['file_name'] = $file_name;
			$config['encrypt_name'] = FALSE;
			$config['overwrite'] = TRUE;
			$config['remove_spaces'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image'))
			{
			$data=array('title'=>$_POST['title'],
						'weburl'=> $_POST['weburl'],
						'keyword'=> $_POST['keyword'],
						'site_email'=> $_POST['site_email'],
						'facebook'=> $_POST['facebook'],
						'twitter'=> $_POST['twitter'],
						'google'=> $_POST['google'],
						'site_description'=> $_POST['site_description'],
						'site_address'=> $_POST['site_address'],
						'logo'=>$this->upload->file_name
						);
			}else{
			$data=array('title'=>$_POST['title'],
						'weburl'=> $_POST['weburl'],
						'keyword'=> $_POST['keyword'],
						'site_email'=> $_POST['site_email'],
						'facebook'=> $_POST['facebook'],
						'twitter'=> $_POST['twitter'],
						'google'=> $_POST['google'],
						'site_description'=> $_POST['site_description'],
						'site_address'=> $_POST['site_address'],
						);
			}					
		$this->MASC->updateData($data);
		redirect(site_url('catalog/siteconfiguration'));
		}
		else
		{
			redirect(site_url('catalog/siteconfiguration'));
		}
	}
}
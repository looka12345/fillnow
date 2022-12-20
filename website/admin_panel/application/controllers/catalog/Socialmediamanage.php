<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Socialmediamanage extends  Admin_Controller {
public function __construct()
	{
		parent::Admin_ControllerClass();
		$this->clearcache();
		
	}
## FUNCTION FOR CONTROLLER AS CITY MANAGE iN ADMIN PANEL
	public function index($page=1)
	{
		$this->checkloginsession();
			$this->lang->load('siteconfiguration', 'english/user');
		$data['page_title']=$this->lang->line('page_title');
			// $data['page_title']=$this->lang->line('page_title');
			$data['heading_title']=$this->lang->line('heading_title');
			
			$data['heading_logo']=$this->lang->line('heading_logo');
			$data['heading_email']=$this->lang->line('heading_email');
			$data['heading_action']=$this->lang->line('heading_action');
			$data["page"]  = "socialmedia/list.php";
			$table="site_configuration";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
				$data["site_data"] =$this->MASC->getData();
			$data["socialmedia_data"] =$this->MASMC->getData();
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
			$data["page"]  = "socialmedia/edit.php";
			$table="site_configuration";
			$data["menup"] =$this->MD->getmenuelement();
			$data["menuch"]=$this->MD->getmenuelement($data["menup"]);
					$data["site_data"] =$this->MASC->getData();
				$data["site_edit_data"] =$this->MASMC->getData();
			
			$totalrecord=$this->MASMC->getcount($table,1,1);
			$uri_segment   = 3;
			$pagingConfig   = $this->paginationlib->initPagination("catalog/siteconfiguration/",$totalrecord,$uri_segment);
			$data["pagination_helper"] = $this->pagination;
	$this->load->view($this->_admin_container,$data);
	}
	public function update()
	{
		
		if($this->input->post())
		{
				
		
	$data=array('email1'=>$_POST['email1'],
						'email2'=> $_POST['email2'],
						'email3'=> $_POST['email3'],
						'phone1'=> $_POST['phone1'],
						'phone2'=> $_POST['phone2'],
						'phone3'=> $_POST['phone3'],
						'facebook'=> $_POST['facebook'],
						'twitter'=> $_POST['twitter'],
						'linkedin'=> $_POST['linkedin'],
						'google'=> $_POST['google'],
						'skype'=> $_POST['skype'],
						'youtube'=> $_POST['youtube'],
						'instagram'=> $_POST['instagram'],
						'flicker'=> $_POST['flicker']
						);
		

		$this->MASMC->updateData($data);
		redirect(site_url('catalog/socialmediamanage'));
		}
		else
		{
			redirect(site_url('catalog/socialmediamanage'));
		}
		}
		}
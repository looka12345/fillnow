<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends Front_Controller {
public function __construct(){
parent::frontControllerClass();
$this->clearcache();
}
public function DomailSet($to='', $tomail='', $from='', $frommail='', $subject='', $message='',$attachfile='')
{
$this->email->clear(TRUE);
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html';
$this->email->initialize($config);
$this->email->subject($subject);
$this->email->from($frommail, $from);
$this->email->to($tomail, $to);
$this->email->message($message);
$this->email->attach($attachfile);
$this->email->send();
return '1';
}
public function index($page_name=''){
$Page_info=$this->FHM->getPageInfo($page_name);
if(!empty($Page_info)){
$this->data['page_info']=$Page_info[0];
}else{
 $this->data['page_info']='';   
}

if($page_name=='contact')
{
if($this->input->post())
{
$this->contactmail();
}
$this->load->view("theme/contact",$this->data);
}
elseif($page_name=='company-profile')
{
$about_info=$this->FHM->getModuleData('aboutusmanagement'); 
$this->data['about_info']=$about_info[0];  
$this->load->view("theme/company-profile",$this->data);
}
elseif($page_name=='vision-and-mission')
{      
$this->load->view("theme/vision-and-mission",$this->data);
}
elseif($page_name=='downloads')
{   
$this->data['down_list']=$this->FHM->getModuleData('placement'); 
$this->load->view("theme/downloads",$this->data);
}
elseif($page_name=='careers')
{
$this->load->view("theme/careers",$this->data);
}
elseif($page_name=='customer-login')
{
$this->load->view("theme/customer-login",$this->data);
}
elseif($page_name=='intranet-login')
{
$this->load->view("theme/intranet-login",$this->data);
}
elseif($page_name=='synergy-drishti')
{
$this->data['app_feat']=$this->FHM->getModuleData('home_slider');
$this->data['testi_list']=$this->FHM->getModuleData('testimonial');
$this->data['home_feat']=$this->FHM->getModuleData('drishti_slider');  
$home_video=$this->FHM->getHomeVideo();
$this->data['home_video']=$home_video[0];
$about_info=$this->FHM->getModuleData('aboutusmanagement');
$this->data['about_info'] = $about_info[0];
$this->load->view("theme/synergy-drishti",$this->data);
}
elseif($page_name=='synergy-kawach')
{
$this->data['app_feat']=$this->FHM->getModuleData('home_slider');
$this->data['testi_list']=$this->FHM->getModuleData('testimonial');
$this->data['home_feat']=$this->FHM->getModuleData('kawach_slider');  
$home_video=$this->FHM->getHomeVideo();
$this->data['home_video']=$home_video[0];
$about_info=$this->FHM->getModuleData('aboutusmanagement');
$this->data['about_info'] = $about_info[0];
$this->load->view("theme/synergy_kawach",$this->data);
}
elseif($page_name=='leadership-team')
{
$this->data['team_list']=$this->FHM->get_team_list();
$this->load->view("theme/leadership-team",$this->data);
}
else
{
$this->load->view("theme/errors/error_404",$this->data);
}
}
public function privacy_policy()
{
    $this->load->view("theme/privacy_policy");
}
public function terms_conditions()
{
    $this->load->view("theme/terms_conditions");
}
public function shipping_policy()
{
    $this->load->view("theme/shipping_policy");
}
public function cancellation_policy()
{
    $this->load->view("theme/cancellation_policy");
}
public function products($value)
{
$Page_info=$this->FHM->getPageInfo($value);
$this->data['page_info']=$Page_info[0];
$pro_info=$this->FHM->getProductInfo($value);
$this->data['product']=$pro_info[0]; 
$this->data['usp_list']=$this->FHM->getUspList($value);
$this->data['gallery_list']=$this->FHM->getGalleryList($value);
$this->load->view("theme/products",$this->data);
}
public function faq($value)
{  
$Page_info=$this->FHM->getPageInfo("faq/$value");
$this->data['page_info']=$Page_info[0];
$this->data['faq_list']=$this->FHM->getFaqList($value);
$this->load->view("theme/faq",$this->data);
}
public function careermail()
{
    
if($this->input->post("name") !='' && $this->input->post("email") !='' && $this->input->post("message")!=''){   
$message_con="
<table border='0' cellpadding='0' cellspacing='10' width='100%'>
    <tr>
        <td colspan='2'>Thank you for submitting your query.</td>
    </tr>
    <tr>
        <td width='20%'><strong>Name:</strong></td>
        <td>".$this->input->post("name")."</td>
    </tr>
    <tr>
        <td><strong>Phone:</strong></td>
        <td>".$this->input->post("contact")."</td>
    </tr>
    <tr>
        <td><strong>Email:</strong></td>
        <td>".$this->input->post("email")."</td>
    </tr>
	 <tr>
        <td><strong>Applied for:</strong></td>
        <td>".$this->input->post("applied_for")."</td>
    </tr>
    <tr>
        <td><strong>Total Exp:</strong></td>
        <td>".$this->input->post("exp")."</td>
    </tr>
    <tr>
        <td><strong>Message:</strong></td>
        <td>".$this->input->post("message")."</td>
    </tr>
</table>
";

$ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
$file_name="resume_".rand().".".$ext;

$config['upload_path'] ='assets/sitesfile/resume';
$config['allowed_types'] = 'doc|docs|pdf';
$config['file_name'] = $file_name;
$config['encrypt_name'] = FALSE;
$config['overwrite'] = TRUE;
$config['remove_spaces'] = TRUE;
$this->load->library('upload', $config);
$this->upload->initialize($config);

if ($file=$this->upload->do_upload('resume'))
{
$resume_name=$this->upload->file_name;
}
$resume = site_url("assets/sitesfile/resume/$file_name");
$to=$this->input->post("name");
$tomail       =$this->input->post("email");
$message_conn = $this->input->post("message");
$from         ="hr@synergyteletech.com";
$frommail     ="hr@synergyteletech.com";
//$frommail=$this->config->item("admin_mail");
$subject='A Candidate wants to join us.';
$subject_cus='Thank you for submit your request.';

$this->DomailSet($to, $tomail, $from, $frommail, $subject_cus, $message_con,$resume);
$this->DomailSet($from,$frommail, $to, $tomail, $subject, $message_con,$resume);
/* $this->session->set_flashdata('action_message', 'Thank you for connect with us. We will get back to you soon.');
redirect('/contact-us/'); */
die();
}
}
public function contactmail()
{
if($this->input->post("name") !='' && $this->input->post("email") !='' && $this->input->post("message")!=''){    
$message_con="
<table border='0' cellpadding='0' cellspacing='10' width='100%'>
    <tr>
        <td colspan='2'>Thank you for submitting your query.</td>
    </tr>
    <tr>
        <td width='20%'><strong>Name:</strong></td>
        <td>".$this->input->post("name")."</td>
    </tr>
    <tr>
        <td><strong>Email:</strong></td>
        <td>".$this->input->post("email")."</td>
    </tr>
    <tr>
        <td><strong>Phone:</strong></td>
        <td>".$this->input->post("phone")."</td>
    </tr>
     <tr>
        <td><strong>Message:</strong></td>
        <td>".$this->input->post("message")."</td>
    </tr>
    <tr>
        <td><strong>Query Regarding:</strong></td>
        <td>".$this->input->post("flexRadioDefault")."</td>
    </tr>
</table>
";

$to           =$this->input->post("name");
$message_conn =$this->input->post("message");
$tomail       =$this->input->post("email");
$from         ="info@synergyteletech.com";
$frommail     ="info@synergyteletech.com";
$subject      ='A customer wants to connect with you.';
$subject_cus  ='Thank you for submit your request.';
$this->DomailSet($to, $tomail, $from, $frommail, $subject_cus, $message_con);
$this->DomailSet($from, $frommail, $to, $tomail, $subject, $message_con);

/* $this->session->set_flashdata('action_message', 'Thank you for connect with us. We will get back to you soon.');
redirect('/contact-us/'); */
}
echo 'successfully send';
die();
}
}
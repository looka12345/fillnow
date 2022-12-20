<?php
defined('BASEPATH') or exit('No direct script access allowed');
class TankController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/kolkata');
        //error_reporting(0);
        $this->load->model('DashboardModel');
        $this->load->helper('title_helper');
        $this->load->helper('common_function');
        $this->load->helper('custom1');
        $this->load->library('upload');
        $this->load->helper('download');
        $this->load->library('pdf');
        $this->load->library('Excel');
        $userdata = $this->session->userdata("admin_sess_data");
        if (!$userdata) {
            redirect(base_url('Login'));
        }
        $store_functions = array();
        if ($userdata['group_id'] > 0) {
            $group_id = $userdata['group_id'];
        } else {
            $login_mast_id = $userdata['username'];
            $group_id = getSingleTitle('login_mast', 'group_id', 'username', "$login_mast_id");
        }
        $this->data['top_menu'] = $this->DashboardModel->getMenu($group_id);
        if ($this->data['top_menu']) {
            foreach ($this->data['top_menu'] as $single) {
                $store_functions[] = $single['url'];
            }
            $store_functions[] = "Admin/NotFound";
            $store_functions[] = "Admin/";
        }
        $current_function = $this->uri->segment(2);

    }

    public function tank_list()
    {

        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $res = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc');

        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
        );
        $this->load->helper('custom1');
        $this->render("admin/tank_list");
    }
    public function editTankList()
    {
        $getData = $this->input->get();
        $edit_id = decryptor($getData['id']);
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $owner_data = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');
        $franchisee_data = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc');

        $this->data['franchisee_data']     = $franchisee_data;

        $this->data['productlist']     = $this->DashboardModel->getProductList('product_master','id','ASC'); 
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->data['page_list_data'] = $res;
        $this->data['owner_data'] = $owner_data;
        $this->data['edit_content'] = $this->DashboardModel->getAllEditDetails($edit_id, 'fill_franchisee_master', 'id');

        
        $this->data['edit_content_tank'] = $this->DashboardModel->getAllList('fill_tank_detail', 'id', 'asc','franchisee_id',$edit_id);
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->render('admin/edit_tank');
    }

    public function updateTankData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('capacity[]', 'capacity', 'trim|required');
        $this->form_validation->set_rules('product[]', 'product', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            $responce['datas'] = $err;
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );
            $responce['csrf'] = $csrf;
            echo json_encode($responce);
        } else {
            for($a=0; $a < count($pdata['capacity']); $a++)
            {

                if(!empty($_FILES['dip_chart']['name'][$a])){ 
                    $type = explode(".", $_FILES['dip_chart']['name'][$a]);
                    $type = end($type);
                    $name = "dip_chart_" . rand(0, 99999999); //changing the name of file
                    $url  = "uploads/" . $name . '.' . $type; //IMG_DIR is the contant in constants.php which holds the path of slider images
                    $slide_name = $name . '.' . $type;
                    move_uploaded_file($_FILES['dip_chart']['tmp_name'][$a], $url);
                    $image_path = "uploads/" . $slide_name;
                  
                    $inputFileType = PHPExcel_IOFactory::identify($image_path);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($image_path);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    
                    $json_allDataInSheet = json_encode($allDataInSheet);
                }else{
                    if(empty($pdata["uploded_dip_chart"][$a])){
                    $image_path ='';
                    $json_allDataInSheet = '';
                    }else{
                    $image_path = $pdata["uploded_dip_chart"][$a];
                    $json_allDataInSheet = $pdata["uploded_dip_data"][$a];   
                    }
                }
                       
                if(empty($pdata["tank_id"][$a])){
                $data = array(
                    "capacity"       => $pdata["capacity"][$a],
                    "franchisee_id"  => $pdata['owner_name'],
                    "product"        => $pdata["product"][$a],
                    "atg_type"       => $pdata["atg_type"][$a],
                    "make_of_atg"    => $pdata["make_of_atg"][$a],
                    "serial_no"      => $pdata["serial_no"][$a],
                    "dip_chart_name" => $image_path,
                    "dip_chart_data" => $json_allDataInSheet,
                     "ip_address"    => $pdata["ip_address"][$a],
                    "port_no"        => $pdata["port_no"][$a],
                    "product_name"   => getSingleTitle('product_master','name','id',$pdata["product"][$a])
                );
                $res = $this->DashboardModel->saveAllInsert($data,'fill_tank_detail'); 
                }else{
                $data = array(
                    "capacity"       => $pdata["capacity"][$a],
                    "franchisee_id"  => $pdata['owner_name'],
                    "product"        => $pdata["product"][$a],
                    "atg_type"       => $pdata["atg_type"][$a],
                    "make_of_atg"    => $pdata["make_of_atg"][$a],
                    "serial_no"      => $pdata["serial_no"][$a],
                    "dip_chart_name" => $image_path,
                    "dip_chart_data" => $json_allDataInSheet,
                    "ip_address"      => $pdata["ip_address"][$a],
                    "port_no"      => $pdata["port_no"][$a],
                    "product_name"   => getSingleTitle('product_master','name','id',$pdata["product"][$a])
                );
                    
                $res =  $this->DashboardModel->updateAll($data,$pdata["tank_id"][$a], 'fill_tank_detail', 'id');
                }
            }

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Tank Updated by " . getname($login_mast_id),
                );
                writelog($log_data);
                $responce['err'] = 0;
                $responce['msg'] = "The Data has been successfully saved.";
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                );
                $responce['csrf'] = $csrf;
                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Data couldnot be saved!";
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                );
                $responce['csrf'] = $csrf;
                echo json_encode($responce);
            }
        }
    }

    /* function used for delete record */
    public function deleteData()
    {
        $pdata = $this->input->post();
        $all_dispenser_data = $this->db->query("select GROUP_CONCAT(id) as dispenser_id from fill_dispenser_master where franchisee_id='$pdata[id]'")->row();
        $all_dispenser_data = $all_dispenser_data->dispenser_id;
        $res = $this->db->query("delete from fill_pump_nozzel where dispenser_id in($all_dispenser_data)");
        if ($res) {
            $this->DashboardModel->deleterecord('fill_dispenser_master',$pdata['id'], 'franchisee_id');
        
            $responce['err'] = 0;
            $responce['msg'] = "Success";
            echo json_encode($responce);
        }

    }

}

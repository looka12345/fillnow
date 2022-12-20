<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Controller extends MY_Controller
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

    public function controller_list()
    {

        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $res = $this->DashboardModel->getAllList('controller', 'id', 'asc');

        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
        );
        $this->load->helper('custom1');
        $this->render("admin/controller_list");
    }

    public function addController()
    {
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $this->data['page_list_data'] = $res;
        $this->render('admin/add_controller');
    }

    public function saveControllerData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('make', 'make', 'trim|required');
        $this->form_validation->set_rules('license_from', 'license from', 'trim|required');
        $this->form_validation->set_rules('license_to', 'license to', 'trim|required');
        $this->form_validation->set_rules('id_imei', 'id imei', 'trim|required');
        $this->form_validation->set_rules('router_make', 'router make', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = $this->form_validation->error_array();
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

            $user_data = array(
                "type" => trim($pdata['type']),
                "make" => trim($pdata['make']),
                "license_from" => trim($pdata['license_from']),
                "license_to" => trim($pdata['license_to']),
                "id_imei" => trim($pdata['id_imei']),
                "router_make" => trim($pdata['router_make']),
            );
            $res = $this->DashboardModel->saveAllInsert($user_data, 'controller');
            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Controller Added by " . getname($login_mast_id),
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

    public function editControllerList()
    {
        $getData = $this->input->get();
        $edit_id = decryptor($getData['id']);
        $this->data['edit_content'] = $this->DashboardModel->getAllEditDetails($edit_id, 'controller', 'id');
        $this->render('admin/edit_controller');
    }

    public function updateControllerData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('type', 'type', 'trim|required');
        $this->form_validation->set_rules('make', 'make', 'trim|required');
        $this->form_validation->set_rules('license_from', 'license from', 'trim|required');
        $this->form_validation->set_rules('license_to', 'license to', 'trim|required');
        $this->form_validation->set_rules('id_imei', 'id imei', 'trim|required');
        $this->form_validation->set_rules('router_make', 'router make', 'trim|required');

        if ($this->form_validation->run() == false) {
            $err = $this->form_validation->error_array();
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
            $edit_id = $pdata['edit_id'];

            $user_data = array(
                "type" => trim($pdata['type']),
                "make" => trim($pdata['make']),
                "license_from" => trim($pdata['license_from']),
                "license_to" => trim($pdata['license_to']),
                "id_imei" => trim($pdata['id_imei']),
                "router_make" => trim($pdata['router_make']),
            );
            $res = $this->DashboardModel->updateAll($user_data, $edit_id, 'controller', 'id');

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Controller Added by " . getname($login_mast_id),
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
        $res = $this->DashboardModel->deleterecord($pdata['table_name'], $pdata['id'], 'id');
        if ($res) {
            $responce['err'] = 0;
            $responce['msg'] = "Success";
            echo json_encode($responce);
        }

    }

}

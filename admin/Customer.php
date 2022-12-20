<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Customer extends MY_Controller
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

    public function customer_list()
    {

        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $res = $this->DashboardModel->getAllList('fill_customer_master', 'id', 'asc');

        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
        );
        $this->load->helper('custom1');
        $this->render("admin/customer_list");
    }

    public function addCustomer()
    {
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $owner_data = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');
        $this->data['page_list_data'] = $res;
        $this->data['owner_data']     = $owner_data;
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->render('admin/add_customer');
    }

    public function saveCustomerData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('province', 'province', 'trim|required');
        $this->form_validation->set_rules('cnumber', 'contact number', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[login_mast.username]', array('is_unique' => 'The %s is already exist'));
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
            $password = rand(11111, 99999999);
            $login_data = array(
                "group_id" => 4,
                "username" => $pdata['email'],
                "password" => md5($password),
            );
            $last_id = $this->DashboardModel->saveAllInsert($login_data, "login_mast");
            $user_data = array(
                "name"     => trim($pdata['name']),
                "login_mast_id" => $last_id,
                "address" => trim($pdata['address']),
                "state" => trim($pdata['country']),
                "province" => trim($pdata['province']),
                "city" => trim($pdata['city']),
                "pincode" => trim($pdata['zip']),
                "contact_person" => trim($pdata['contact_person']),
                "contact_num" => trim($pdata['cnumber']),
                "email_id" => trim($pdata['email']),
            );
            $res = $this->DashboardModel->saveAllInsert($user_data, 'fill_customer_master');
            $msg = "Your Drishti Login Credentials Email: " . $pdata['email'] . " Password: " . $password . "";
            $this->load->config('email');
            $this->email->from('noreply@synergyteletech.com', 'Drishti Registration Password');
            $this->email->to($pdata['email']);
            $this->email->subject('Drishti Registration');
            $this->email->message($msg);
            //$mail = $this->email->send();
            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Customer Added by " . getname($login_mast_id),
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

    public function editCustomerList()
    {
        $getData = $this->input->get();
        $edit_id = decryptor($getData['id']);
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $owner_data = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');
        $this->data['page_list_data'] = $res;
        $this->data['owner_data'] = $owner_data;
        $this->data['edit_content'] = $this->DashboardModel->getAllEditDetails($edit_id, 'fill_customer_master', 'id');
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->render('admin/edit_customer_list');
    }

    public function updateCustomerData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('province', 'province', 'trim|required');
        $this->form_validation->set_rules('cnumber', 'contact number', 'trim|required');
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
                "name"           => trim($pdata['name']),
                "address"        => trim($pdata['address']),
                "state"          => trim($pdata['country']),
                "province"       => trim($pdata['province']),
                "city"           => trim($pdata['city']),
                "pincode"        => trim($pdata['zip']),
                "contact_person" => trim($pdata['contact_person']),
                "contact_num"    => trim($pdata['cnumber']),
            );
            $res = $this->DashboardModel->updateAll($user_data, $edit_id, 'fill_customer_master', 'id');

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Customer Updated by " . getname($login_mast_id),
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

        $login_id = getSingleTitle($pdata['table_name'], 'login_mast_id', "id", $pdata['id']);
        $res = $this->DashboardModel->deleterecord($pdata['table_name'], $pdata['id'], 'id');
        if ($res) {
            if ($pdata['delete_type'] == 'email') {
                $this->DashboardModel->deleterecord('login_mast', $login_id, 'login_id');
            }
            $responce['err'] = 0;
            $responce['msg'] = "Success";
            echo json_encode($responce);
        }

    }

    public function asset_list()
    {
        $getData = $this->input->get();
        $login_id = decryptor($getData['user_id']);
        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $res = $this->DashboardModel->getAllList('fill_customer_asset', 'id', 'asc','customer_id',$login_id);

        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
            'login_id'=>$login_id,
        );
        $this->load->helper('custom1');
        $this->render("admin/asset_list");
    }

    public function addAsset()
    {
        $getData = $this->input->get();
        $login_id = decryptor($getData['user_id']);
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $owner_data = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');
        $this->data['page_list_data'] = $res;
        $this->data['owner_data']     = $owner_data;
        $this->data['login_id']       = $login_id;
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->render('admin/add_asset');
    }

    public function saveAssetData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('asset_type', 'asset type', 'trim|required');
        $this->form_validation->set_rules('asset_reg_no', 'Registration No', 'trim|required');
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
                "asset_name"     => trim($pdata['name']),
                "customer_id" => trim($pdata['login_id']),
                "asset_type" => trim($pdata['asset_type']),
                "asset_reg_no" => trim($pdata['asset_reg_no']),
            );
            $res = $this->DashboardModel->saveAllInsert($user_data, 'fill_customer_asset');
           
            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Asset Added by " . getname($login_mast_id),
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

    public function editAssetList()
    {
        $getData = $this->input->get();
        $edit_id = decryptor($getData['id']);
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $owner_data = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');
        $this->data['page_list_data'] = $res;
        $this->data['owner_data'] = $owner_data;
        $this->data['edit_content'] = $this->DashboardModel->getAllEditDetails($edit_id, 'fill_customer_asset', 'id');
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->render('admin/edit_asset');
    }

    public function updateAssetData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('asset_type', 'asset type', 'trim|required');
        $this->form_validation->set_rules('asset_reg_no', 'Registration No', 'trim|required');
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
                "asset_name"         => trim($pdata['name']),
                "asset_type"   => trim($pdata['asset_type']),
                "asset_reg_no" => trim($pdata['asset_reg_no']),
            );
            $res = $this->DashboardModel->updateAll($user_data, $edit_id, 'fill_customer_asset', 'id');

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Asset Updated by " . getname($login_mast_id),
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
    public function deleteAssetData()
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

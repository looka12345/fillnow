<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
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
    public function index()
    {
        $this->dashboard();
    }
    public function dashboard()
    {
        $this->load->helper('custom1');
        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $login_mast_id = $admin_sess_data['login_id'];
        $group_id = $admin_sess_data['group_id'];
        $username = $admin_sess_data['username'];
        //echo $login_mast_id;
        if ($group_id == 3 || $group_id == 5003) {
            $res = $this->DashboardModel->getAllWithArray('user_mast', 'enrolled_by', $group_id, 'enrolled_by_id', $login_mast_id);
        } else {
            $res = $this->DashboardModel->getAllWithArray('user_mast', 'is_flag', '1');
        }
        $this->data['page_list_data'] = $res;
        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $username = $admin_sess_data['username'];
        $user_id = getSingleTitle('fill_location_mast', 'user_id', 'contact_person_email', "'" . $username . "'");
        $gstn_no = getSingleTitle('user_mast', 'user_id', 'login_mast_id', $login_mast_id);
        $compleprofile = GetCustomerCompleteProfile($login_mast_id, $gstn_no);
        $this->data['chcek_complete_profile'] = $compleprofile;
        $this->data['content_edit'] = $this->DashboardModel->getAllEditDetails($user_id, 'user_mast', 'user_id');
        $res = $this->DashboardModel->getAllWithArray('fill_location_mast', 'contact_person_email', $username);
        $this->data['location_details'] = $res;
        $state = getSingleTitle("user_mast", "state", "user_id", $login_mast_id);
        $city = getSingleTitle("user_mast", "city", "user_id", $login_mast_id);
        $this->data['banners'] = $this->DashboardModel->getAllWithArray('banner_master', 'status', '1', 'state', $state, 'city', $city);

        $this->data['open_order'] = $this->db->query("SELECT * FROM `fill_vehicle_slot_transaction` WHERE staus IN ('1','2','3','4','11')")->result_array();

        $url = "https://fms.synergyteletech.com/smart_oms/bms/api/synergy/synergy_api.php";
        $fields_string = "function_name=ledgerBalance&user_id=$login_mast_id";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($ch);
        $res = json_decode($response, true);
        $this->data['wallet_list'] = $res;
        $this->render("admin/dashboard");
    }

    public function ownerList()
    {

        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $res = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');

        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
        );
        $this->load->helper('custom1');
        $this->render("admin/owner_list");
    }

    public function addOwner()
    {
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $this->data['page_list_data'] = $res;
        $this->render('admin/add_owner');
    }

    public function saveOwnerData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('province', 'province', 'trim|required');
        $this->form_validation->set_rules('city', 'city', 'trim|required');
        $this->form_validation->set_rules('zip', 'zip', 'trim|required');
        $this->form_validation->set_rules('nodal_person', 'nodal person', 'trim|required');
        $this->form_validation->set_rules('cnumber', 'contact number', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[login_mast.username]', array('is_unique' => 'The %s is already exist'));
        if (empty($_FILES['logo']['name'])) {
            $this->form_validation->set_rules('logo', 'Logo', 'trim|required');
        }
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
            if (!empty($_FILES['logo']['name'])) {
                $type = explode(".", $_FILES['logo']['name']);
                $type = end($type);
                $name = "owner_logo_" . rand(0, 99999999);
                $url = "uploads/" . $name . '.' . $type;
                $slide_name = $name . '.' . $type;
                move_uploaded_file($_FILES['logo']['tmp_name'], $url);
                $logo_path = "uploads/" . $slide_name;
            } else {
                $logo_path = "";
            }
            $password = rand(11111, 99999999);
            $login_data = array(
                "group_id" => 5,
                "username" => $pdata['email'],
                "password" => md5($password),
            );
            $last_id = $this->DashboardModel->saveAllInsert($login_data, "login_mast");
            $user_data = array(
                "name" => trim($pdata['name']),
                "login_id" => $last_id,
                "address" => trim($pdata['address']),
                "country" => trim($pdata['country']),
                "province" => trim($pdata['province']),
                "city" => trim($pdata['city']),
                "zip" => trim($pdata['zip']),
                "nodal_person" => trim($pdata['nodal_person']),
                "cnumber" => trim($pdata['cnumber']),
                "email" => trim($pdata['email']),
                "logo" => $logo_path,
            );
            $res = $this->DashboardModel->saveAllInsert($user_data, 'fill_owner_master');
            $msg = "Your Drishti Login Credentials Email: " . $pdata['email'] . " Password: " . $password . "";
            $this->load->config('email');
            $this->email->from('noreply@synergyteletech.com', 'Drishti Registration Password');
            $this->email->to($pdata['email']);
            $this->email->subject('Drishti Registration');
            $this->email->message($msg);
            $mail = $this->email->send();
            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Owner Added by " . getname($login_mast_id),
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

    public function editOwnerList()
    {
        $getData = $this->input->get();
        $edit_id = decryptor($getData['id']);
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');

        $this->data['edit_content'] = $this->DashboardModel->getAllEditDetails($edit_id, 'fill_owner_master', 'id');
        $this->data['page_list_data'] = $res;
        $this->render('admin/edit_owner');
    }

    public function editOwnerData()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('address', 'address', 'trim|required');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('province', 'province', 'trim|required');
        $this->form_validation->set_rules('city', 'city', 'trim|required');
        $this->form_validation->set_rules('zip', 'zip', 'trim|required');
        $this->form_validation->set_rules('nodal_person', 'nodal person', 'trim|required');
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
            if (!empty($_FILES['logo']['name'])) {
                $type = explode(".", $_FILES['logo']['name']);
                $type = end($type);
                $name = "owner_logo_" . rand(0, 99999999);
                $url = "uploads/" . $name . '.' . $type;
                $slide_name = $name . '.' . $type;
                move_uploaded_file($_FILES['logo']['tmp_name'], $url);
                $logo_path = "uploads/" . $slide_name;
            } else {
                $logo_path = $pdata['edit_logo'];
            }
            $user_data = array(
                "name" => trim($pdata['name']),
                "address" => trim($pdata['address']),
                "country" => trim($pdata['country']),
                "province" => trim($pdata['province']),
                "city" => trim($pdata['city']),
                "zip" => trim($pdata['zip']),
                "nodal_person" => trim($pdata['nodal_person']),
                "cnumber" => trim($pdata['cnumber']),
                "logo" => $logo_path,
            );
            $res = $this->DashboardModel->updateAll($user_data, $edit_id, 'fill_owner_master', 'id');

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Owner Added by " . getname($login_mast_id),
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

    public function menuList()
    {
        $this->data = array(
            "menu_list_data" => $this->DashboardModel->getAllList('menu_master', 'created_date', 'desc'),
            "status" => "add",
        );
        $this->render("admin/menu_list");
    }

    // Save Menu On 16 Jan 2016 mahadeb
    public function saveMenu()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $pdata = $this->input->post();
        $this->form_validation->set_rules('menu_title', 'Menu Title', 'required|trim');
        $this->form_validation->set_rules('menu_slug', 'Menu Slug', 'required|trim');
        $this->form_validation->set_rules('menu_type', 'Menu Type', 'required|trim');
        $this->form_validation->set_rules('menu_location', 'Menu location', 'required|trim', array(
            'required' => 'You have not provided menu location.',
        ));
        $this->form_validation->set_rules('menu_type', 'Menu Type', 'required|trim');
        $menu_type = $this->input->post('menu_type');
        $menu_link = $this->input->post('menu_link');
        if ($menu_type == 1 & $menu_link == "") {
            $this->form_validation->set_rules('menu_link', 'Menu Url', 'required|trim');
        }

        $this->form_validation->set_rules('sort_order', 'Menu Sort Order', 'required|trim|numeric');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {

            $form_data = array(
                "menu_title" => $pdata['menu_title'],
                "menu_slug" => $pdata['menu_slug'],
                "menu_type" => trim($pdata['menu_type']),
                "menu_location" => trim($pdata['menu_location']),
                "parent" => trim($pdata['parent_menu']),
                "url" => trim($pdata['menu_slug']),
                "sort_order" => $pdata['sort_order'],
                "status" => $pdata['status'],
                "created_date" => date("Y-m-d H:i:s"),
            );

//saveAllInsert  function we pass the $country_data as an Array & Table name mahadeb
            $res = $this->DashboardModel->saveAllInsert($form_data, 'menu_master');

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Menu Created by " . getname($login_mast_id),
                );
                writelog($log_data);
                $responce['err'] = 0;
                $responce['msg'] = "The Menu has been successfully saved";

                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Menu couldn't be saved!";

                echo json_encode($responce);
            }
        }
    }

    // Change Menu Status .For All Change Status we pass particularID,Current status,Table Name,AutoIncrementID(Table Column Name),status(Table Column Name) 17 Jan 2016 mahadeb

    public function changeMenuStatus()
    {
        $curr_status = $this->input->get("curr_status");
        $menu_id = $this->input->get("menu_id");
        if (empty($curr_status) || empty($menu_id)) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $new_status = $curr_status == 1 ? 2 : 1;
        $res = $this->DashboardModel->changeAllStatus($menu_id, $new_status, 'menu_master', 'menu_id', 'status');
        if ($res) {
            $admin_sess_data = $this->session->userdata('admin_sess_data');
            $login_mast_id = $admin_sess_data['login_id'];
            $log_data = array(
                "login_mast_id" => $login_mast_id,
                "ip" => $this->input->ip_address(),
                "message" => "Menu Status Changed by " . getname($login_mast_id),
            );
            writelog($log_data);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Edit Menu Get All data 17 Jan 2016 mahadeb
    public function editMenuList()
    {
        $menu_id = $this->input->get("menu_id");
        if (!empty($menu_id)) {
            $this->data['menu_edit'] = $this->DashboardModel->getAllEditDetails($menu_id, 'menu_master', 'menu_id');
            $this->data['menu_list_data'] = $this->DashboardModel->getAllList('menu_master', 'created_date', 'desc');
            $this->data['status'] = "edit";
            $this->render('admin/menu_list');
        } else {
            redirect("Admin/menuList#sample_1");
        }
    }

    // Update Menu  By Mahadeb On 17 Jan 2016
    public function updateMenu()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $pdata = $this->input->post();
        $menu_type = $this->input->post('menu_type');
        $menu_link = $this->input->post('menu_link');
        $menu_title = $this->input->post('menu_title');
        $menu_slug = $this->input->post('menu_slug');
        $menu_name = decryptor($this->input->post('menu_name'));
        if ($menu_title != $menu_name) {
            $this->form_validation->set_rules('menu_title', 'Menu Title', 'required|trim');
        }
        $this->form_validation->set_rules('menu_type', 'Menu Type', 'required|trim');
        $this->form_validation->set_rules('menu_location', 'Menu location', 'required|trim', array(
            'required' => 'You have not provided menu location.',
        ));
        if ($menu_type == 1 & $menu_link == "") {
            $this->form_validation->set_rules('menu_link', 'Menu Url', 'required|trim');
        }
        $this->form_validation->set_rules('sort_order', 'Menu Sort Order', 'required|trim|numeric');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $menu_id = $pdata['menu_id'];
            $form_data = array(
                "parent" => trim($pdata['parent_menu']),
                "menu_title" => $pdata['menu_title'],
                "url" => trim($pdata['menu_slug']),
                "menu_type" => trim($pdata['menu_type']),
                "menu_slug" => $pdata['menu_link'],
                "sort_order" => $pdata['sort_order'],
                "updated_date" => date("Y-m-d H:i:s"),
            );
            $res = $this->DashboardModel->updateAll($form_data, $menu_id, 'menu_master', 'menu_id');
            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Menu List Updated by " . getname($login_mast_id),
                );
                writelog($log_data);
                $responce['err'] = 0;
                $responce['msg'] = "The Menu has been successfully updated";
                echo json_encode($responce);
            } else {
                unlink($unlik_url);
                unlink($unlik_url1);
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Menu couldn't be updated!";
                echo json_encode($responce);
            }
        }
    }

    public function menuRightAssign()
    {
        $this->data['page_list'] = $this->DashboardModel->getAllList('fill_group_management', 'group_id', 'desc');
        $this->data['template_list'] = $this->DashboardModel->getAllList('template_master', 'template_id', 'desc');
        $this->render("admin/assign_menu_right");
    }
    public function ajaxGetMenuRightToAssign()
    {
        $menu = array();
        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $page_id = $admin_sess_data['group_id'];

        $pdata = $this->input->post();
        $page_id = decryptor($pdata['page_ids']);
        //$page_id ='1';
        $data['menu_list_data'] = $this->DashboardModel->getSingleProduct("fill_menu_right", "group_id", $page_id);
        if (!empty($data['menu_list_data'])) {
            foreach ($data['menu_list_data'] as $singlemenu) {
                $menu[] = $singlemenu['menu_id'];
            }
        }

        $data['assign_template_data'] = $this->DashboardModel->getSingleProduct("fill_assign_template", "group_id", $page_id);
        if (!empty($data['assign_template_data'])) {
            foreach ($data['assign_template_data'] as $singlemenu) {
                $assign_template[] = $singlemenu['template_id'];
            }
        }
        echo menus("menu_master", "parent", 0, "menu_id", "menu_title", $menu, $page_id);
    }

    public function saveSideAssignedMenu()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('parent[]', 'Menu', 'trim');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $pdata = $this->input->post();
            $page_id = decryptor($pdata['page_ids']);
            $menu_array = isset($pdata['parent']) ? $pdata['parent'] : "";
            if (!empty($menu_array)) {
                $delque = $this->DashboardModel->deleteSingleRow('fill_menu_right', 'group_id', $page_id);
                //$delque2 = $this->DashboardModel->deleteSingleRow('fill_assign_template','group_id',$page_id);
                if ($delque) {
                    $a = 0;
                    foreach ($menu_array as $value) {
                        if (!empty($pdata['button' . $value])) {
                            $buttons = implode(",", $pdata['button' . $value]);
                        } else {
                            $buttons = "";
                        }
                        $form_data = array(
                            "group_id" => $page_id,
                            "menu_id" => $value,
                            "menu_parent_id" => getSingleTitle('menu_master', 'parent', 'menu_id', $value),
                            "updated_date" => date("Y-m-d H:i:s"),
                            "menu_btn" => $buttons,
                            "menu_sort_order" => $pdata['sort_order' . $value],
                        );
                        if (!empty($pdata['template_name'][$a])) {
                            $array = array('group_id' => $page_id, 'template_id' => $pdata['template_name'][$a], 'menu_id' => $value);
                            $delque2 = $this->DashboardModel->deleteSingleRow('fill_assign_template', 'group_id', $page_id, 'template_id', $pdata['template_name'][$a], 'menu_id', $value);
                            $insert = $this->DashboardModel->saveAllInsert($array, 'fill_assign_template');
                        }
                        $res = $this->DashboardModel->saveAllInsert($form_data, 'fill_menu_right');
                        $a++;
                    }
                }
                if ($res) {
                    $admin_sess_data = $this->session->userdata('admin_sess_data');
                    $login_mast_id = $admin_sess_data['login_id'];
                    $log_data = array(
                        "login_mast_id" => $login_mast_id,
                        "ip" => $this->input->ip_address(),
                        "message" => "Menu Rights assigned by " . getname($login_mast_id),
                    );
                    writelog($log_data);
                    $responce['err'] = 0;
                    $responce['msg'] = "The menu(s) have been successfully assigned";
                    echo json_encode($responce);
                } else {
                    $responce['err'] = 1;
                    $responce['msg'] = "Sorry menu couldn't be assigned!";
                    echo json_encode($responce);
                }
            }
        }
    }

    public function groupManagement()
    {
        $res = $this->DashboardModel->getAllDetails('fill_group_management', 'group_id', 'desc');
        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
        );
        $this->render("admin/group_management_list");
    }
    public function addGroupManagement()
    {
        $this->data['franchisee_list'] = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc');

        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $this->data['page_list_data'] = $res;
        $this->render('admin/add_group_management');
    }
    public function saveGroupManagement()
    {
        $this->load->helper(array('form', 'url'));
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Group Name', 'required|trim|alpha_numeric_spaces');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            $csrf = array(
                'group_name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
            );
            $responce['csrf'] = $csrf;
            echo json_encode($responce);
        } else {
            if (isset($_POST['myCheck'])) {
                $myCheck = 1;
            } else {
                $myCheck = 0;
            }
            if ($pdata['group'] == '3') {
                $key = 'id';
                if (!empty($pdata['city'])) {
                    $all_data = $this->DashboardModel->getAllDetails('fill_franchisee_master', 'id', 'desc', 'city', $pdata['city']);
                    $linked_id = '';
                } elseif (!empty($pdata['state'])) {
                    $all_data = $this->DashboardModel->getAllDetails('fill_franchisee_master', 'id', 'desc', 'state', $pdata['state']);
                    $linked_id = '';
                } else {
                    $linked_id = $pdata['franchise_id'];
                    $linked_id = implode(',', $linked_id);
                }
            } else {
                $key = 'user_id';
                if (!empty($pdata['city'])) {
                    $all_data = $this->db->query("SELECT * FROM `user_mast` join login_mast on user_mast.login_mast_id=login_mast.login_id WHERE login_mast.group_id='4' and city='$pdata[city]'")->result_array();
                    $linked_id = '';
                } elseif (!empty($pdata['state'])) {
                    $all_data = $this->db->query("SELECT * FROM `user_mast` join login_mast on user_mast.login_mast_id=login_mast.login_id WHERE login_mast.group_id='4' and state='$pdata[state]'")->result_array();
                    $linked_id = '';
                } else {
                    $linked_id = $pdata['customer_id'];
                }

            }
            if (!empty($all_data)) {
                foreach ($all_data as $value) {
                    $array[] = $value[$key];

                }
                $linked_id = implode(',', $array);
            }
            $form_data = array(
                "group_name" => trim($pdata['name']),
                "group_status" => trim($pdata['status']),
                "group_id_linked" => trim($pdata['group']),
                "linked_id" => trim($linked_id),
                "configuration_status" => trim($myCheck),
            );
            $res = $this->DashboardModel->saveAllInsert($form_data, 'fill_group_management');
            if ($res != '') {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Group Created by " . getname($login_mast_id),
                );
                writelog($log_data);
                $responce['err'] = 0;
                $responce['msg'] = "The Data has been successfully saved";
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                );
                $responce['csrf'] = $csrf;
                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Data couldn't be saved!";
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash(),
                );
                $responce['csrf'] = $csrf;
                echo json_encode($responce);
            }
        }
    }
    public function editGroupManagement()
    {
        $event_id = decryptor($this->input->get('id'));
        $this->data['content_edit'] = $this->DashboardModel->getAllEditDetails($event_id, 'fill_group_management', 'group_id');
        $this->data['franchisee_list'] = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc');
        $res = $this->DashboardModel->getAllList('fill_group_management', 'group_id', 'desc');
        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $res1 = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $this->data['page_list_data1'] = $res1;
        $this->data['page_list_data'] = $res;
        $this->data['status'] = "edit";
        $this->render("admin/edit_group_management");
    }
    public function updateGroupManagement()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Group Name', 'required|trim|alpha_numeric_spaces');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $pdata = $this->input->post();
            $event_id = $pdata['event_id'];
            if ($pdata['group'] == '3') {
                $key = 'id';
                if (!empty($pdata['city'])) {
                    $all_data = $this->DashboardModel->getAllDetails('fill_franchisee_master', 'id', 'desc', 'city', $pdata['city']);
                    $linked_id = '';
                } elseif (!empty($pdata['state'])) {
                    $all_data = $this->DashboardModel->getAllDetails('fill_franchisee_master', 'id', 'desc', 'state', $pdata['state']);
                    $linked_id = '';
                } else {
                    $linked_id = $pdata['franchise_id'];
                    $linked_id = implode(',', $linked_id);
                }
            } else {
                $key = 'user_id';
                if (!empty($pdata['city'])) {
                    $all_data = $this->db->query("SELECT * FROM `user_mast` join login_mast on user_mast.login_mast_id=login_mast.login_id WHERE login_mast.group_id='4' and city='$pdata[city]'")->result_array();
                    $linked_id = '';
                } elseif (!empty($pdata['state'])) {
                    $all_data = $this->db->query("SELECT * FROM `user_mast` join login_mast on user_mast.login_mast_id=login_mast.login_id WHERE login_mast.group_id='4' and state='$pdata[state]'")->result_array();
                    $linked_id = '';
                } else {
                    $linked_id = $pdata['customer_id'];
                }

            }
            if (!empty($all_data)) {
                foreach ($all_data as $value) {
                    $array[] = $value[$key];

                }
                $linked_id = implode(',', $array);
            }
            if (isset($_POST['myCheck'])) {
                $myCheck = 1;
            } else {
                $myCheck = 0;
                $pdata['group'] = 0;
                $linked_id = 0;
            }
            $form_data = array(
                "group_name" => trim($pdata['name']),
                "group_id_linked" => trim($pdata['group']),
                "linked_id" => trim($linked_id),
                "configuration_status" => trim($myCheck),
            );
            $res = $this->DashboardModel->updateAll($form_data, $event_id, 'fill_group_management', 'group_id');
            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Group Details Updated by " . getname($login_mast_id),
                );
                writelog($log_data);
                $responce['err'] = 0;
                $responce['msg'] = "The Data has been successfully updated";
                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Data couldn't be updated!";
                echo json_encode($responce);
            }
        }
    }

    // for fetching city list...

    public function fetchCityList()
    {
        $id = $this->input->post('parent_id');
        $res = $this->DashboardModel->fetchCityList('fill_branch_master', 'bm_name', 'asc', $id);
        echo json_encode($res);
    }

    /* function used for delete record */
    public function deleteData()
    {
        $pdata = $this->input->post();
        $login_id = getSingleTitle($pdata['table_name'], 'login_id', "id", $pdata['id']);
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

}

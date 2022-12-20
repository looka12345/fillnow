<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dispenser extends MY_Controller
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

    public function dispenser_list()
    {

        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $login_mast_id   = $admin_sess_data['login_id'];
        $group_id   = $admin_sess_data['group_id'];
       
       
        $owner_id   = getSingleTitle('fill_owner_master', 'id', 'login_id', "$login_mast_id");
        if ($group_id== 3) {
          $res = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc','login_mast_id',$login_mast_id);
        }else
        {
          $res = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc','owner_name',$owner_id);
     
        }

       

        $page_arr = array();
        if (!empty($res)) {
            $page_arr = $res;
        }
        $this->data = array(
            "page_list_data" => $page_arr,
        );
        $this->load->helper('custom1');
        $this->render("admin/dispenser_list");
    }
    public function editDispenserList()
    {
        $getData = $this->input->get();
        $edit_id = decryptor($getData['id']);
        $this->data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $this->data['portnum'] = getservbyname("http", "tcp");
        $res = $this->DashboardModel->getAllStateList('fill_branch_master', 'bm_name', 'asc');
        $owner_data = $this->DashboardModel->getAllList('fill_owner_master', 'id', 'asc');
        $franchisee_data = $this->DashboardModel->getAllList('fill_franchisee_master', 'id', 'asc');

        $this->data['franchisee_data']     = $franchisee_data;

        $this->data['productlist']     = $this->DashboardModel->getProductList('product_master', 'id', 'ASC');
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');
        $this->data['page_list_data'] = $res;
        $this->data['owner_data'] = $owner_data;
        $this->data['edit_content'] = $this->DashboardModel->getAllEditDetails($edit_id, 'fill_franchisee_master', 'id');


        $this->data['edit_content_dispenser'] = $this->DashboardModel->getAllList('fill_dispenser_master', 'id', 'asc', 'franchisee_id', $edit_id);
        $this->data['omc_data']       = $this->DashboardModel->getAllList('fill_omc_master', 'id', 'asc');


        $this->render('admin/edit_dispenser');
    }

    public function updateDispenserData()
    {
        $pdata = $this->input->post();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('owner_name', 'owner name', 'trim|required');
        $this->form_validation->set_rules('ip_address[]', 'ip address', 'trim|required');
        $this->form_validation->set_rules('port_no[]', 'port no', 'trim|required');
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
            for ($a = 0; $a < count($pdata['display']); $a++) {
                $result = '';
                if (empty($pdata['display'][$a])) {
                    $form_data = array(
                        "franchisee_id"   => $pdata['owner_name'],
                        "ip_address"      => $pdata['ip_address'][$a],
                        "port_no"         => $pdata['port_no'][$a],
                        "dispenser"        => $pdata['dispenser'][$a],

                    );
                    $result = $this->DashboardModel->saveAllInsert($form_data, 'fill_dispenser_master');
                } else {
                    $form_data = array(
                        "franchisee_id"   => $pdata['owner_name'],
                        "ip_address"      => $pdata['ip_address'][$a],
                        "port_no"         => $pdata['port_no'][$a],
                        "dispenser"        => $pdata['dispenser'][$a],

                    );
                    $this->DashboardModel->updateAll($form_data, $pdata['display'][$a], 'fill_dispenser_master', 'id');
                }

                if (!empty($pdata["pump_id$a"])) {

                    for ($k = 0; $k < count($pdata["nozzle_id$a"]); $k++) {
                        if (!empty($pdata["pre_nozzle_id$a"])) {
                            $all_nozzle_id = implode(',', array_filter($pdata["pre_nozzle_id$a"]));
                            if (!empty($all_nozzle_id)) {

                                $dispenser_id  = $pdata["pre_dispenser_id$a"][0];
                                $this->db->query("delete from fill_pump_nozzel where id not in($all_nozzle_id) and dispenser_id='$dispenser_id'");
                            }
                        }
                        if (empty($pdata["pre_nozzle_id$a"][$k])) {
                            if ($pdata["pre_nozzle_id$a"][$k] != 0) {
                                $nozzel_data = array(
                                    "pump_id"       => $pdata["pump_id$a"][$k],
                                    "dispenser_id"  => $pdata["pre_dispenser_id$a"][$k],
                                    "nozzel"        => $pdata["nozzle_id$a"][$k],
                                    "type_of_preset"  => $pdata["type_of_preset$a"][$k],
                                    "product_id"    => $pdata["product$a"][$k],
                                    "product_name"  => getSingleTitle('product_master', 'name', 'id', $pdata["product$a"][$k])
                                );

                                $res =  $this->DashboardModel->updateAll($nozzel_data, $pdata["pre_nozzle_id$a"][$k], 'fill_pump_nozzel', 'id');
                            } else {
                                $nozzel_data = array(
                                    "pump_id"       => $pdata["pump_id$a"][$k],
                                    "dispenser_id"  => $result == '' ? $pdata["pre_dispenser_id$a"][0] : $result,
                                    "nozzel"        => $pdata["nozzle_id$a"][$k],
                                    "type_of_preset"  => $pdata["type_of_preset$a"][$k],
                                    "product_id"      => $pdata["product$a"][$k],
                                    "product_name"    => getSingleTitle('product_master', 'name', 'id', $pdata["product$a"][$k])
                                );
                                $res = $this->DashboardModel->saveAllInsert($nozzel_data, 'fill_pump_nozzel');
                            }
                        } else {

                            $nozzel_data = array(
                                "pump_id"       => $pdata["pump_id$a"][$k],
                                "dispenser_id"  => $pdata["pre_dispenser_id$a"][$k],
                                "nozzel"        => $pdata["nozzle_id$a"][$k],
                                "type_of_preset"  => $pdata["type_of_preset$a"][$k],
                                "product_id"    => $pdata["product$a"][$k],
                                "product_name"  => getSingleTitle('product_master', 'name', 'id', $pdata["product$a"][$k])
                            );

                            $res =  $this->DashboardModel->updateAll($nozzel_data, $pdata["pre_nozzle_id$a"][$k], 'fill_pump_nozzel', 'id');
                        }
                    }
                }
            }

            if ($res) {
                $admin_sess_data = $this->session->userdata('admin_sess_data');
                $login_mast_id = $admin_sess_data['login_id'];
                $log_data = array(
                    "login_mast_id" => $login_mast_id,
                    "ip" => $this->input->ip_address(),
                    "message" => "Dispenser Updated by " . getname($login_mast_id),
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
            $this->DashboardModel->deleterecord('fill_dispenser_master', $pdata['id'], 'franchisee_id');

            $responce['err'] = 0;
            $responce['msg'] = "Success";
            echo json_encode($responce);
        }
    }
}

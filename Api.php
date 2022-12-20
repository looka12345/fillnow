<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/kolkata');
        //error_reporting(0);
        $this->load->model('DashboardModel');
        $this->load->model("LoginModel");
        $this->load->library('form_validation');
        $this->load->helper('title_helper');
    }

    /** response standard formate **/
    private $json = array(
        'status_code'    => 404,
        'success'        => FALSE,
        'message'        => 'Default Message',
        'error_messages' => array(),
    );
    private $statusCodeArray = array('unauthorize' => 404, 'success' => 200, 'validation' => 102);
    public function writeJson()
    {
        echo json_encode(array('data' => $this->json));
        exit;
    }

    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method)) {
            return call_user_func_array(array($this, $method), $params);
        }
        $this->json['status_code']     =  $this->statusCodeArray['unauthorize'];
        $this->json['error_messages']  = array('The resources cannot be found');
        $this->writeJson();
    }

    /* Login authentication function */
    public function userLogin()
    {
        $pdata = $this->input->post();
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $err = $this->form_validation->error_array();
            $this->json['status_code']    =  $this->statusCodeArray['validation'];
            $this->json['error_messages'] = $err;
            $this->writeJson();
        } else {
            $pdata       = $this->input->post();
            $res         = $this->LoginModel->apiLogin($pdata); /* model check user is valid or not */
            $login_id    = $res['login_id'];
            $userDetails = $this->db->query("select login_mast.login_id,name,login_mast.username,contact_person,contact_num from fill_franchisee_master join login_mast on fill_franchisee_master.login_mast_id = login_mast.login_id where login_id='$login_id'")->row();
            if ($res) {

                $this->json['status_code'] = $this->statusCodeArray['success'];
                $this->json['success']     = TRUE;
                $this->json['message']     = "Success";
                $this->json['data']        = $userDetails;
                $this->writeJson();
            } else {
                $this->json['status_code']    = $this->statusCodeArray['unauthorize'];
                $this->json['error_messages'] = array("Incorrect details. Please try again.");
                $this->writeJson();
            }
        }
    }

    public function pumpHardwareInfo()
    {
        $pdata = $this->input->post();
        $this->form_validation->set_rules('login_id', 'login id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $err = $this->form_validation->error_array();
            $this->json['status_code']    = $this->statusCodeArray['validation'];
            $this->json['error_messages'] = $err;
            $this->writeJson();
        } else {
            $pdata         = $this->input->post();
            $login_id      = $pdata['login_id'];
            $franchisee_id = getSingleTitle('fill_franchisee_master', 'id', 'login_mast_id', "$login_id");
            if ($franchisee_id) {

                $dispenserDetails = $this->db->query("select id,GROUP_CONCAT(id) as all_dispenser_id from fill_dispenser_master where franchisee_id='$franchisee_id'")->result_array();
                $dispenserIds     = $this->db->query("select id,ip_address,port_no,dispenser from fill_dispenser_master where franchisee_id='$franchisee_id'")->result_array();
                $all_dispenser_id = $dispenserDetails[0]['all_dispenser_id'];

                $dispenserNozzleDetails = $this->db->query("select * from fill_pump_nozzel where dispenser_id in($all_dispenser_id)")->result();

                $tankDetails            = $this->db->query("select * from fill_tank_detail where franchisee_id in($franchisee_id)")->result();

                $this->json['status_code']         =  $this->statusCodeArray['success'];
                $this->json['success']             =  TRUE;
                $this->json['message']             =  "Success";
                $this->json['dispenser_id']        =  $dispenserIds;
                $this->json['dispenser_nozzle']    =  $dispenserNozzleDetails;
                $this->json['tank_data']           =  $tankDetails;
                $this->writeJson();
            } else {
                $this->json['status_code']    = $this->statusCodeArray['unauthorize'];
                $this->json['error_messages'] = array("Incorrect details. Please try again.");
                $this->writeJson();
            }
        }
    }

    public function getPreset()
    {
        $this->form_validation->set_rules('dispenser_id', 'dispenser id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $err = $this->form_validation->error_array();
            $this->json['status_code']    = $this->statusCodeArray['validation'];
            $this->json['error_messages'] = $err;
            $this->writeJson();
        } else {
            $postdata = $this->input->post();
            if($postdata['dispenser_id'] =='65'){
                $presetQty = '7.0';
            }else{
                $presetQty = '5.0';
            }
            if ($postdata) {
                $this->json['status_code']     = $this->statusCodeArray['success'];
                $this->json['success']         = TRUE;
                $this->json['message']         = "Success";
                $this->json['preset_quantity'] = $presetQty;
                $this->writeJson();
            } else {
                $this->json['status_code']    = $this->statusCodeArray['unauthorize'];
                $this->json['error_messages'] = array("Incorrect details. Please try again.");
                $this->writeJson();
            }
        }
    }

    public function postDispenseData()
    {
        $post = $this->input->post();
        $this->form_validation->set_rules('transaction_number', 'transaction number', 'trim|required');
        //$this->form_validation->set_rules('fueling_start_time', 'fueling start time', 'trim|required');
        //$this->form_validation->set_rules('fueling_end_time', 'fueling end time', 'trim|required');
        $this->form_validation->set_rules('amount', 'amount', 'trim|required');
        $this->form_validation->set_rules('qty', 'qty', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
        $this->form_validation->set_rules('totalizer', 'totalizer', 'trim|required');
        $this->form_validation->set_rules('dispenser_id', 'dispenser_id', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $err = $this->form_validation->error_array();
            $this->json['status_code']    = $this->statusCodeArray['validation'];
            $this->json['error_messages'] = $err;
            $this->writeJson();
        } else {
            $dataarray = array(
                'transaction_number' => $post['transaction_number'],
                'fueling_start_time' => $post['fueling_start_time'],
                'fueling_end_time'   => $post['fueling_end_time'],
                'qty'                => $post['qty'],
                'price'              => $post['price'],
                'amount'             => $post['amount'],
                'totalizer'          => $post['totalizer'],
                "dispenser_id"       => $post['dispenser_id'],
            );
            $res         = $this->DashboardModel->saveAllInsert($dataarray, 'dispenser_transaction'); /* model check user is valid or not */
            if ($res) {
                $this->json['status_code'] = $this->statusCodeArray['success'];
                $this->json['success']     = TRUE;
                $this->json['message']     = "Data save successfully.";
                $this->writeJson();
            } else {
                $this->json['status_code']    = $this->statusCodeArray['unauthorize'];
                $this->json['error_messages'] = array("Incorrect details. Please try again.");
                $this->writeJson();
            }
        }
    }
}

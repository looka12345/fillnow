<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
    private static $API_ACCESS_KEY = 'AIzaSyB_eWvhaDhtQVYyzflx9zKoG9sJ4_zkT14';
    public function __construct() {
        parent::__construct();
        $this->CI =& get_instance();
        $this->load->helper('url');
        $this->load->helper('sendsms_helper');
        $this->load->model('ApiModel');
        $this->load->model('SynergyModel');
        $this->load->library('ledger');
        //error_reporting(0);
        date_default_timezone_set('Asia/Kolkata');
    }
    private $env = 1;
    private $json = array(
        'succ' => FALSE,
        'type'=>'standard',
        'public_msg' => 'Default Message', // this info will help to user -- it should be very simple
        '_err_codes' =>array(), // this info will help to api impmenting person
        'db_errs' => array(),
    );
 public function Attendancelogin() {
      $this->isPost();
      $pdata = $this->input->post();
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'required|trim');

      if ($this->form_validation->run() == FALSE) {
           $err = $this->form_validation->error_array();
           $errors = array();
           foreach ($err as $key => $value) {
             $errors[] = $value;
           }

           $this->json['_err_codes'] = $errors;
          $this->writeJson();
    } else {
        $res = $this->SynergyModel->getData(array("*"),true,"fill_attendance_login","email='".$pdata['email']."'",true);
        if($res) {
            $results = $this->SynergyModel->attendanceLogin($pdata);
            if($results) {
              $this->json['succ'] = TRUE;			 
              $this->json['public_msg'] = 'User successfully logged in!';
              $this->json['data']=$res;			  
              $this->writeJson();
            }
            else{
              $this->json['_err_codes'] = array("Incorrect password!");
               $this->writeJson();
            }
        } else {
            $this->json['_err_codes'] = array("User not exist!");
            $this->writeJson();
        }
    }
}
public function insert_attendance(){
      $this->isPost();
      $pdata = $this->input->post();
      $this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->form_validation->set_rules('login_id', 'Login ID', 'required|trim');
      if ($this->form_validation->run() == FALSE) {
           $err = $this->form_validation->error_array();
           $errors = array();
           foreach ($err as $key => $value) {
             $errors[] = $value;
           }
          $this->json['_err_codes'] = $errors;
          $this->writeJson();
      } else {
		$curr_date = date('Y-m-d');
		$login_id  = $pdata['login_id'];
		$query = $this->db->query("SELECT * FROM fill_daily_attendance WHERE login_id='$login_id' and curr_date ='$curr_date'");
        if($query->num_rows() > 0){ 
         $user_data = array(
            "login_id"   => $pdata['login_id'],
            "end_time" => $pdata['end_time'],
            "end_lat"  => $pdata['end_lat'],
            "end_lon"  => $pdata['end_lon']
        );
        $query = $this->SynergyModel->updateAll($user_data,$pdata['login_id'], 'fill_daily_attendance','login_id');
        }else{		
		$user_data = array(
            "login_id"   => $pdata['login_id'],
            "start_time" => $pdata['start_time'],
            "start_lat"  => $pdata['start_lat'],
            "start_lon"  => $pdata['start_lon'],
			"curr_date"  => $curr_date
        );
        $query = $this->SynergyModel->insertData($user_data,"fill_daily_attendance");
		}
        if(isset($query)){
            $this->json['succ'] = TRUE;
    		$this->json['service'] = 1;
            $this->json['public_msg'] = 'User successfully registered!';
            $this->writeJson();
	    }
         else {
        $this->json['_err_codes'] = array("Something got wrong please try again!");
        $this->writeJson();
    }
}
}
}
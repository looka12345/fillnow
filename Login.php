<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("LoginModel");
        $this->load->model("DashboardModel");
        $this->load->library("email");
        $this->load->library('form_validation');
    }
    public function index($err = 0)
    {
        $this->adminLogin($err);
    }
    public function adminLogin($err = 0)
    {
        $this->session->unset_userdata('admin_sess_data');
        $this->load->model("FrontModel");
        $data['slider'] = $this->FrontModel->BelowHomeBanner();
        $data['err'] = $err;
        $data['page_list'] = $this->DashboardModel->getAllList('fill_group_management', 'group_id', 'desc');
        $this->load->view('login', $data);
    }
    public function register()
    {
        $data['state_list'] = $this->DashboardModel->getAllWithArray('branch_master', 'bm_parent_id', 0);
        $this->load->view('register', $data);
    }
    public function forgetpassword()
    {
        $this->load->view('forgotPassword');
    }

    public function userRegister()
    {
        $pdata = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user_mast.email_id]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $password = md5($pdata['password']);
            $login_data = array(
                "group_id" => 4,
                "username" => $pdata['email'],
                "password" => $password,
            );
            $last_id = $this->DashboardModel->saveAllInsert($login_data, "login_mast");
            if ($last_id) {
                $data = array(
                    "login_mast_id" => $last_id,
                    "fname" => trim($pdata['name']),
                    "password" => $password,
                    "mob_no" => trim($pdata['phone']),
                    "email_id" => trim($pdata['email']),
                    "phone_no" => trim($pdata['phone']),
                    "state" => trim($pdata['state']),
                    "city" => trim($pdata['city']),
                    "is_flag" => 1,
                    "cust_code" => $last_id,
                    "um_gl_code" => $last_id,
                    "branch_id" => $last_id,
                );
                $res = $this->DashboardModel->saveUser($data);

                $msg = "Your Fill Now Login Credentials Email: " . $pdata['email'] . " Password: " . $pdata['password'] . "";
                sendsms($pdata['phone'], $msg);
                $this->email->from('fillnow@gmail.com', 'Identification');
                $this->email->to($pdata['email']);
                $this->email->subject('Fillnow Registration.');
                $this->email->message($msg);
                $mail = $this->email->send();

                $url = "https://fms.synergyteletech.com/smart_oms/bms/api/synergy/synergy_api.php";
                $fields_string = "function_name=fill_insert_into_ledger&login_id=$last_id&ob_type='Cr'&opening_bal_remarks=0&ob=1";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                $response = curl_exec($ch);
                $code = json_decode($response);
                if ($res) {
                    $result = $this->DashboardModel->getAllWithArray('fill_dynamic_pricing', 'fill_pricing_city', $pdata['city']);
                    if ($result) {
                        $responce['msg'] = "The user has been successfully saved";
                    } else {
                        $responce['msg'] = "User successfully registered! But Service not Available this time in this City";
                    }
                    $responce['err'] = 0;
                    echo json_encode($responce);
                } else {
                    $responce['err'] = 1;
                    $responce['msg'] = "Sorry user couldn't be saved!";
                    echo json_encode($responce);
                }
            }
        }
    }
    public function userLogin()
    {
        $this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        //$this->form_validation->set_rules('role', 'Role', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $pdata = $this->input->post();
            $res = $this->LoginModel->adminAuth($pdata);

           
             if ($res) {
                $set_sess_data = array(
                    "admin_sess_data" => array("username" => trim($pdata['username']),
                        "login_id" => $res['login_id'],
                        "group_id" => $res['group_id'],
                        "role" => $res['group_id']),
                );
                $log_data = array(
                    "login_mast_id" => $res['login_id'],
                    "ip" => $this->input->ip_address(),
                    "message" => getname($res['login_id']) . "Login Into the system",
                );
                writelog($log_data);
                $login_sess_data = array("login_sess_data" => array("login_username" => $pdata['username'], "login_password" => $pdata['password']));
                $this->session->set_userdata($login_sess_data);
                $this->session->set_userdata($set_sess_data);
                $responce['err'] = 0;
                $responce['msg'] = "Success";
                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Wrong Creadentials Kindly try again";
                echo json_encode($responce);
            }
        }
    }
    public function custLogin()
    {
        $this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        //$this->form_validation->set_rules('role', 'Role', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $pdata = $this->input->post();
            $res = $this->LoginModel->custAuth($pdata);
            if ($res == 'error') {
                $responce['err'] = 1;
                $responce['msg'] = "Please Select Role Type";
                echo json_encode($responce);
            } elseif ($res) {
                $set_sess_data = array(
                    "admin_sess_data" => array("username" => trim($pdata['username']),
                        "login_id" => $res['login_id'],
                        "group_id" => $res['group_id'],
                        "role" => $res['group_id']),
                );
                $log_data = array(
                    "login_mast_id" => $res['login_id'],
                    "ip" => $this->input->ip_address(),
                    "message" => getname($res['login_id']) . " Login Into the system",
                );
                writelog($log_data);
                $login_sess_data = array("login_sess_data" => array("login_username" => $pdata['username'], "login_password" => $pdata['password']));
                $this->session->set_userdata($login_sess_data);
                $this->session->set_userdata($set_sess_data);
                $responce['err'] = 0;
                $responce['msg'] = "Success";
                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "Sorry Wrong Creadentials Kindly try again";
                echo json_encode($responce);
            }
        }
    }
    public function forgotPassword()
    {
        $this->load->view("forgotPassword");
    }

    public function checkotpforgotpassword()
    {
        $this->form_validation->set_rules('username', 'UserName', 'trim|required');
        $this->form_validation->set_rules('otp', 'OTP', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $email = $this->input->post('username');
            $otp_code = $this->input->post('otp');
            $result = $this->DashboardModel->getAllWithArray('forgot_password', 'otp_email', $email, 'otp_code', $otp_code, "otp_status", 0);
            if (empty($result)) {
                $responce['err'] = 1;
                $responce['msg'] = "OTP is wrong!";
                echo json_encode($responce);
                exit;
            } else {

                $responce['err'] = 0;
                $responce['msg'] = "Please enter new password and confirm password!";
                echo json_encode($responce);

            }
        }
    }

    public function resetpassword()
    {
        $this->load->view('reset_password');
    }

    public function updatePassword()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('key', 'Key', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $key = $this->input->post('key');
            $arr = explode("_", $key);
            $login = $arr[0];
            $result = $this->DashboardModel->getMailIdFromKey($key);
            $email = $result[0]['otp_email'];
            //$email = $this->input->post('username');
            $key = $this->input->post('key');
            $password = md5($this->input->post('password'));
            $result = $this->DashboardModel->getAllWithArray('forgot_password', 'otp_email', $email, 'otp_secret_key', $key, "otp_status", 0);
            if (empty($result)) {
                $responce['err'] = 1;
                $responce['msg'] = "Expired link!";
                echo json_encode($responce);
                exit;
            } else {
                $data = array('password' => $password);
                $result = $this->DashboardModel->updateData('login_mast', $data, "username", $email);
                $updateData = array('otp_status' => 1);
                $result = $this->DashboardModel->updateData('forgot_password', $updateData, "otp_email", $email);
                if ($result) {
                    $responce['err'] = 0;
                    $responce['msg'] = "Successfully Updated password.";
                    echo json_encode($responce);
                    exit;
                } else {
                    $responce['err'] = 1;
                    $responce['msg'] = "Password Not Update!";
                    echo json_encode($responce);
                    exit;
                }
            }
        }
    }

    public function sendmailforgotpassword()
    {
        $this->form_validation->set_rules('username', 'UserName', 'trim|required');
        if ($this->form_validation->run() == false) {
            $err = validation_errors();
            $responce['err'] = 1;
            $responce['msg'] = $err;
            echo json_encode($responce);
        } else {
            $rand = rand();
            $email = $this->input->post('username');
            $result = $this->DashboardModel->getAllWithArray('login_mast', 'username', $email);
            $login_id = $result[0]['login_id'];
            if (empty($result)) {
                $responce['err'] = 1;
                $responce['msg'] = "Email not match!";
                echo json_encode($responce);
                exit;
            }
            $this->email->from('fillnow@gmail.com', 'Identification');
            $this->email->to($email);
            $otp = md5($rand);
            $otp = $login_id . "_" . $otp;

            $this->email->subject('OTP for forgot password.');
            $html = "<p>Please click here for reset your password:- <a href='https://fms.synergyteletech.com/ofo/Login/resetpassword/" . $otp . "'>Click Here</a> URL:- https://fms.synergyteletech.com/ofo/Login/resetpassword/" . $otp . "</p>";
            $this->email->message($html);
            $mail = $this->email->send();
            $formdata = array(
                'otp_email' => $email,
                'otp_code' => $rand,
                'otp_status' => 0,
                'otp_secret_key' => $otp,
            );
            $res = $this->DashboardModel->saveAllInsert($formdata, 'forgot_password');
            if ($mail) {
                $responce['err'] = 0;
                $responce['msg'] = "Successfully sent email. Please check your email.";
                echo json_encode($responce);
            } else {
                $responce['err'] = 1;
                $responce['msg'] = "E-Mail Not sent. Try again.";
                echo json_encode($responce);
            }
        }
    }

    public function logOut()
    {
        $admin_sess_data = $this->session->userdata('admin_sess_data');
        $group_id = $admin_sess_data['group_id'];
        if ($group_id == '4' || $group_id == '5002') {
            $type = "CustomerLogin";
        } else {
            $type = "PartnerLogin";
        }
        if (!empty($admin_sess_data['login_id'])) {
            $log_data = array(
                "login_mast_id" => $admin_sess_data['login_id'],
                "ip" => $this->input->ip_address(),
                "message" => getname($admin_sess_data['login_id']) . " Logout from the system",
            );
            writelog($log_data);
        }
        $this->session->unset_userdata("admin_sess_data");
        $err = $this->input->get('err');
        if (!isset($err)) {
            redirect(base_url() . "Login?type=$type");
        } else {
            redirect(base_url() . "Login?err=" . $err);
        }
    }
    public function ajaxgetcity()
    {
        $id = $this->input->post('state');
        $res = $this->DashboardModel->fetchCityList('fill_branch_master', 'bm_name', 'asc', $id);
        $html = "<option value=''>Select</option>";
        if (!empty($res)) {
            foreach ($res as $single) {
                $html .= "<option value='" . $single['bm_id'] . "'>" . $single['bm_name'] . "</option>";
            }
        }
        echo $html;
    }
}

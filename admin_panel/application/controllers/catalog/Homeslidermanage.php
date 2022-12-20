<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");
class Homeslidermanage extends Admin_Controller {

    public function __construct() {
        parent::Admin_ControllerClass();
        $this->clearcache();
    }

    public function index($page = 1) {

        $this->checkloginsession();

        $data['page'] = 'homeslider/list.php';

        $data['menup'] = $this->MD->getmenuelement();
        $data['menuch'] = $this->MD->getmenuelement($data['menup']);
        $data["site_data"] = $this->MASC->getData();
        try {
            $searchhomeslider = isset($_POST['searchhomeslider']) ? $_POST['searchhomeslider'] : "";


            $data['searchhomeslider'] = $searchhomeslider;
            if ($searchhomeslider != "") {

                $totalrecord = $this->MAHSA->getcountdata($searchhomeslider, 1);
            } else {

                $totalrecord = $this->MAHSA->getcountdata("", 1);
            }


            $pagingConfig = $this->paginationlib->initPagination("catalog/homeslider", $totalrecord, 3);
            $data["pagination_helper"] = $this->pagination;

            $data['homeslider_arr'] = $this->MAHSA->getAllData((($page - 1) * $pagingConfig['per_page']), $pagingConfig['per_page'], $searchhomeslider);

            $data['onpage'] = $this->uri->segment($pagingConfig['uri_segment']);
            $this->load->view($this->_admin_container, $data);
        } catch (Exception $err) {
            log_message("error", $err->getMessage());
            return show_error($err->getMessage());
        }
    }

    public function add() {
        $this->checkloginsession();

        $data["page"] = "homeslider/add.php";
        $data["menup"] = $this->MD->getmenuelement();
        $data["menuch"] = $this->MD->getmenuelement($data["menup"]);
        $data["site_data"] = $this->MASC->getData();


        $this->load->view($this->_admin_container, $data);
    }

    public function adddata() {
        $this->checkloginsession();
        if ($this->input->post()) {
            
                $data = array(
                    'name' => $_POST['name'],
                    'content' => $_POST['content'],
                );
            $data_return = $this->MAHSA->insertData($data);
            if ($data_return == 1) {
                $this->session->set_flashdata('action_message', 'Feature Added Successfully');
                redirect("catalog/homeslidermanage");
            } else {
                $this->session->set_flashdata('error_message', 'Please Try Again');
                redirect("catalog/homeslidermanage");
            }
        } else {
            $this->session->set_flashdata('error_message', 'Undefine Request');
            redirect("catalog/homeslidermanage");
        }
    }

    public function edit() {

        $this->checkloginsession();
        $homeslider_id = $this->uri->segment(4);
        $data["header"] = "Welcome in propBizz Admin ";
        $data["page"] = "homeslider/edit.php";
        $data["menup"] = $this->MD->getmenuelement();
        $data["menuch"] = $this->MD->getmenuelement($data["menup"]);
        $data["single_data"] = $this->MAHSA->getSingalData($homeslider_id);
        $data["site_data"] = $this->MASC->getData();

        $this->load->view($this->_admin_container, $data);
    }

    public function updatedata() {
        $this->checkloginsession();
        if ($this->input->post()) {
            $homeslider_id = $_POST['home_slider_id'];
            $data = array(
                    'name' => $_POST['name'],
                    'content' => $_POST['content'],
                );
            $data_return = $this->MAHSA->updateData($data, $homeslider_id);
            if ($data_return == 1) {
                $this->session->set_flashdata('action_message', 'Feature Updated Successfully');
                redirect("catalog/homeslidermanage");
            } else {
                $this->session->set_flashdata('error_message', 'Please Try Again');
                redirect("catalog/homeslidermanage");
            }
        } else {
            $this->session->set_flashdata('error_message', 'Undefine Request');
            redirect("catalog/homeslidermanage");
        }
    }

}

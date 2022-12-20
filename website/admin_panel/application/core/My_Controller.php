<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class MY_Controller extends CI_Controller
{
function My_ControllerClass()
{
  parent::__construct();
  $this->load->database();
  $this->load->library("session");
  $this->load->library("pagination");
  $this->load->library("form_validation");
  $this->load->library("encryption");
  $this->load->library('app/paginationlib');
  $this->load->library('image_lib');
  $this->load->helper("url");
  $this->load->helper("array");
  $this->load->config("prop");
}
}
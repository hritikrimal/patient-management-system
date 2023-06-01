<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Home_mod");
    }
    // view page
    public function index()
    {
        $this->load->view('include/header');
        $this->load->view('homepage/home_index');
    }
    //to save the information of patient
    public function save_info()
    {
        $this->form_validation->set_rules('name', 'Username', 'required');
        $this->form_validation->set_rules('number', 'Number', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('province', 'Province', 'required');
        $this->form_validation->set_rules('district', 'District', 'required');
        $this->form_validation->set_rules('municipality', 'Municipality', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('languages[]', 'Languages', 'required');

        $response = array(); // Initialize response array

        if ($this->form_validation->run() == true) {
            $response['success'] = true;
            $this->Home_mod->insertinfo();
        } else {
            $response['success'] = false;
            $response['errors'] =  strip_tags(validation_errors());
        }

        echo json_encode($response);
    }

    public function fetch_info()
    {
        $userinfo = $this->Home_mod->getuser_info();
        if ($userinfo) {
            $response['success'] = true;
            $response['infodata'] = $userinfo;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }
        echo json_encode($response);
    }

    //view all data from table patient on click view
    public function fetch_all()
    {
        $fetch_all_info = $this->Home_mod->get_all_user_info();
        if ($fetch_all_info) {
            $response['success'] = true;
            $response['data'] = $fetch_all_info;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }

        echo json_encode($response);
    }
}

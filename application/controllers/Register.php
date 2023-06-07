<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Register_models");
    }
    // view page
    public function index()
    {
        $this->load->view('include/header');
        $this->load->view('homepage/home_index');
    }
    //to save the information of patient
    public function save_registration()
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
            $this->Register_models->insert_registration_data();
        } else {
            $response['success'] = false;
            $response['errors'] =  strip_tags(validation_errors());
        }

        echo json_encode($response);
    }

    public function fetch_registration()
    {
        $reg_data = $this->Register_models->get_registration_data();
        if ($reg_data) {
            $response['success'] = true;
            $response['infodata'] = $reg_data;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }
        echo json_encode($response);
    }

    //view all data from table patient on click view
    public function fetch_registration_Details()
    {
        $reg_detail = $this->Register_models->get_detail_registration_data();
        if ($reg_detail) {
            $response['success'] = true;
            $response['data'] = $reg_detail;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }

        echo json_encode($response);
    }

    public function View_invoice()
    {
        $this->load->view('include/header');
        $this->load->view('homepage/invoice');
    }

    public function save_billing_with_items()
    {
        $this->form_validation->set_rules('p_id', 'P ID', 'required');
        $this->form_validation->set_rules('sub_total', 'Sub Total', 'required|numeric');
        $this->form_validation->set_rules('dis_per', 'Discount Percentage', 'numeric');
        $this->form_validation->set_rules('dis_amnt', 'Discount Amount', 'numeric');
        $this->form_validation->set_rules('grand_total', 'Grand Total', 'required|numeric');
        $this->form_validation->set_rules('items[]', 'Items', 'required');

        $response = array(); // Initialize response array

        if ($this->form_validation->run() == true) {
            $response['success'] = true;

            $this->Register_models->insert_billings();
        } else {
            $response['success'] = false;
            $response['errors'] =  strip_tags(validation_errors());
        }

        echo json_encode($response);
    }
}

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

    public function save_billing()
    {
        $this->form_validation->set_rules('bill_date', 'Date', 'required');
        $this->form_validation->set_rules('p_id', 'Patient Id', 'required');
        $this->form_validation->set_rules('sub_total', 'Sub total', 'required');
        $this->form_validation->set_rules('dis_per', 'Discount percentage', 'required');
        $this->form_validation->set_rules('dis_amnt', 'discount amount', 'required');
        $this->form_validation->set_rules('grand_total', 'Grand Total', 'required');

        $response = array(); // Initialize response array

        if ($this->form_validation->run() == true) {
            $response['success'] = true;

            $last_sample = $this->Home_mod->insert_billing();
            $response['data'] = $last_sample;
        } else {
            $response['success'] = false;
            $response['errors'] =  strip_tags(validation_errors());
        }

        echo json_encode($response);
    }
    public function getdate()
    {
        date_default_timezone_set('Asia/Kathmandu');
        $dateTime = date('Y-m-d H:i:s');
        // var_dump($dateTime);
        if ($dateTime) {
            $response['success'] = true;
            $response['data'] = $dateTime;
        } else {
            $response['success'] = false;
            //     $response['errors'] = "No Data Available";
        }
        echo json_encode($response);
    }

    public function test_item()
    {
        $this->form_validation->set_rules('sample_id', 'Sample Id', 'required');
        $this->form_validation->set_rules('p_id', 'Patient Id', 'required');
        $this->form_validation->set_rules('testName', 'Test Item', 'required');
        $this->form_validation->set_rules('quantity', 'quantity', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');

        $response = array(); // Initialize response array

        if ($this->form_validation->run() == true) {
            $response['success'] = true;

            $this->Home_mod->insert_test_name();
        } else {
            $response['success'] = false;
            $response['errors'] =  strip_tags(validation_errors());
        }

        echo json_encode($response);
    }


    public function invoice_view()
    {
        $this->load->view('include/header');
        $this->load->view('homepage/invoice');
    }

    public function save_billing_with_items()
    {
        $this->form_validation->set_rules('p_id', 'P ID', 'required');
        // $this->form_validation->set_rules('bill_date', 'Billing Date', 'required');
        $this->form_validation->set_rules('sub_total', 'Sub Total', 'required|numeric');
        $this->form_validation->set_rules('dis_per', 'Discount Percentage', 'numeric');
        $this->form_validation->set_rules('dis_amnt', 'Discount Amount', 'numeric');
        $this->form_validation->set_rules('grand_total', 'Grand Total', 'required|numeric');
        $this->form_validation->set_rules('items[]', 'Items', 'required');

        $response = array(); // Initialize response array

        if ($this->form_validation->run() == true) {
            $response['success'] = true;

            $this->Home_mod->insert_billings();
        } else {
            $response['success'] = false;
            $response['errors'] =  strip_tags(validation_errors());
        }

        echo json_encode($response);
    }
}

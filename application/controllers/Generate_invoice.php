<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate_invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Invoice_models");
    }
    // view page

    public function fetch_billing()
    {

        $billinginfo = $this->Invoice_models->get_billing_info();
        // var_dump($billinginfo);
        if ($billinginfo) {
            $response['success'] = true;
            $response['data'] =  $billinginfo;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }

        echo json_encode($response);
    }

    public function fetch_invoice()
    {
        $get_all_info = $this->Invoice_models->get_datbase_info();
        // print_r($get_all_info);
        if ($get_all_info) {
            $response['success'] = true;
            $response['alldata'] =  $get_all_info;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }
        echo json_encode($response);
    }
}

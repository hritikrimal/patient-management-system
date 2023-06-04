<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Invoice_mod");
    }
    // view page

    public function billing_info()
    {

        $billinginfo = $this->Invoice_mod->get_billing_info();
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

    public function get_all()
    {
        $get_all_info = $this->Invoice_mod->get_datbase_info();
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

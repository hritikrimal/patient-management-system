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
        $detail_billinginfo = $this->Invoice_models->get_detail_billing_info();
        if ($detail_billinginfo) {
            $response['success'] = true;
            $response['alldata'] =  $detail_billinginfo;
        } else {
            $response['success'] = false;
            $response['errors'] = "No Data Available";
        }
        echo json_encode($response);
    }
}

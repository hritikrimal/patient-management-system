<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home_mod extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //for insert in database of patient informattion
    public function insertinfo()
    {
        $info = array();
        $info['Name'] = $this->input->post("name");
        $info['Age'] = $this->input->post("age");
        $info['Gender'] = $this->input->post("gender");
        $info['Language'] = json_encode($this->input->post("languages"));
        $info['Country'] = $this->input->post("country");
        $info['Province'] = $this->input->post("province");
        $info['District'] = $this->input->post("district");
        $info['Municipality'] = $this->input->post("municipality");
        $info['Address'] = $this->input->post("address");
        $info['MobileNumber'] = $this->input->post("number");
        date_default_timezone_set('Asia/Kathmandu');
        $info['DateTime'] = date('Y-m-d H:i:s');
        if ($info) {
            $this->db->insert('patients', $info);
        } else {
            return false;
        }
    }
    public function getuser_info()
    {
        $user_info = $this->db->get('patients');
        if ($user_info->num_rows() > 0) {
            $result = $user_info->result();
            return $result;
        } else {
            return false;
        }
    }

    public function get_all_user_info()
    {
        $patientid = $this->input->post('patientid');
        $all_user_info = $this->db->get_where('patients', array('Patientid' => $patientid));

        if ($all_user_info->num_rows() > 0) {
            $results = $all_user_info->result();
            return $results;
        } else {
            return false;
        }
    }

    public function insert_billing()
    {
        $bill = array();
        $bill['P_id'] = $this->input->post("p_id");
        $bill['billing_date'] = $this->input->post("bill_date");
        $bill['subtotal'] = $this->input->post("sub_total");
        $bill['discount_percent'] = $this->input->post("dis_per");
        $bill['discount_amount'] = $this->input->post("dis_amnt");
        $bill['net_total'] = $this->input->post("grand_total");
        if ($bill) {
            $this->db->insert('patient_billing', $bill);
        } else {
            return false;
        }
    }
}

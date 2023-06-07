<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register_models extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //for insert in database of patient informattion
    public function insert_registration_data()
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
    public function get_registration_data()
    {
        $this->db->order_by('Patientid', 'desc');
        $user_info = $this->db->get('patients');
        if ($user_info->num_rows() > 0) {
            $result = $user_info->result();
            return $result;
        } else {
            return false;
        }
    }

    public function get_detail_registration_data()
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


    public function insert_billings()
    {
        date_default_timezone_set('Asia/Kathmandu');
        $dateTime = date('Y-m-d H:i:s');
        $bill = array();
        $bill['P_id'] = $this->input->post("p_id");
        $bill['billing_date'] = $dateTime;
        $bill['subtotal'] = $this->input->post("sub_total");
        $bill['discount_percent'] = $this->input->post("dis_per");
        $bill['discount_amount'] = $this->input->post("dis_amnt");
        $bill['net_total'] = $this->input->post("grand_total");
        $items = $this->input->post('items');

        $this->db->trans_begin(); // Start transaction

        if ($bill) {
            $this->db->insert('patient_billing', $bill);
            $latest_sample_no = $this->db->insert_id();

            $test_records = array();

            foreach ($items as $item) {
                $this->form_validation->reset_validation();
                $this->form_validation->set_data($item);
                $this->form_validation->set_rules('testName', 'Test Name', 'required');
                $this->form_validation->set_rules('quantity', 'Quantity', 'required');
                $this->form_validation->set_rules('unit', 'Unit', 'required');
                $this->form_validation->set_rules('price', 'Price', 'required');

                if ($this->form_validation->run() == true) {
                    $test = array();
                    $test['sample_id'] = $latest_sample_no;
                    $test['p_id'] = $this->input->post("p_id");
                    $test['test_items'] = $item['testName'];
                    $test['qty'] = $item['quantity'];
                    $test['unit'] = $item['unit'];
                    $test['price'] = $item['price'];

                    $test_records[] = $test; // Add the test record to the array
                } else {
                    // Item validation failed
                    $this->db->trans_rollback(); // Rollback transaction
                    return false;
                }
            }

            if (!empty($test_records)) {
                $this->db->insert_batch('test_record', $test_records);
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback(); // Rollback transaction
                return false;
            } else {
                $this->db->trans_commit(); // Commit transaction
                return true;
            }
        } else {
            $this->db->trans_rollback(); // Rollback transaction
            return false;
        }
    }
}

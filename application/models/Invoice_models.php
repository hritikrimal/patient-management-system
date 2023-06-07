<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Invoice_models extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_billing_info()
    {
        $this->db->order_by('sample_no', 'desc');
        $bill_info = $this->db->get('patient_billing');
        if ($bill_info->num_rows() > 0) {
            $result = $bill_info->result();
            return $result;
        } else {
            return false;
        }
    }

    public function get_datbase_info()
    {
        $sampleNo = $this->input->post("sampleno_id");

        $this->db->select('p.Name,p.Patientid, pb.billing_date, pb.subtotal, pb.discount_percent, pb.discount_amount, pb.net_total, tr.test_items, tr.qty,tr.sample_id, tr.unit, tr.price');
        $this->db->from('patients AS p');
        $this->db->join('patient_billing AS pb', 'p.Patientid = pb.P_id');
        $this->db->join('test_record AS tr', 'pb.sample_no = tr.sample_id');
        $this->db->where('tr.sample_id',  $sampleNo);

        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
}

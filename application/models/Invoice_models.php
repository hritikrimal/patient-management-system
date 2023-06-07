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

    public function get_detail_billing_info()
    {
        $sampleNo = $this->input->post("sampleno_id");

        $this->db->select('p.Name, p.Patientid,pb.sample_no, pb.billing_date, pb.subtotal, pb.discount_percent, pb.discount_amount, pb.net_total');
        $this->db->from('patients AS p');
        $this->db->join('patient_billing AS pb', 'p.Patientid = pb.P_id');
        $this->db->where('pb.sample_no', $sampleNo);

        $row_query = $this->db->get();

        $this->db->select('tr.test_items, tr.qty, tr.unit, tr.price');
        $this->db->from('test_record AS tr');
        $this->db->where('tr.sample_id', $sampleNo);

        $array_query = $this->db->get();

        if ($row_query && $array_query) {
            $result['row'] = $row_query->row();
            $result['array'] = $array_query->result();
            return $result;
        } else {
            return false;
        }
    }
}

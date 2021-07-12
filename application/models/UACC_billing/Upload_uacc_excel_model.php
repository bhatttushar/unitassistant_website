<?php
class Upload_uacc_excel_model extends CI_Model{

	function update_uacc($name, $special_credit){
		$data = array('updated_by'=>'admin', 'special_credit'=>$special_credit, 'updated_at'=>date('Y-m-d H:i:s') );
		$this->db->set($data);
		$this->db->where('name', $name);
		return $this->db->update('cc_newsletters');
	}

	function getTotal($consultant_number){
		$this->db->select('id_cc_invoice,total,due_amount,payment_status,total_paid,id_cc_newsletter,last_paid');
		$this->db->from('cc_invoices');
		$this->db->where('consultant_number', $consultant_number);
		$this->db->order_by('id_cc_invoice', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function update_invoice($amount, $nFinalTotal, $fTotalpaid, $sPayStatus, $id_cc_invoice){
		$dDate=date('Y-m-d H:i:s');
		$data = array("last_paid"=>$amount, "due_amount"=>number_format($nFinalTotal, 2), "total_paid"=>$fTotalpaid, "updated_at"=>$dDate, "payment_status"=>$sPayStatus, "payment_date"=>$dDate);
		$this->db->set($data);
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->update('cc_invoices');
	}

	function get_invoice_count($id_cc_newsletter){
		$this->db->select("COUNT(id_cc_invoice) as cont");
		$this->db->from('cc_invoices');
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->get()->row_array();
	}

	function get_old_invoice($id_cc_newsletter){
		$this->db->select("id_cc_invoice, total, due_amount, payment_status, total_paid, id_cc_newsletter");
		$this->db->from('cc_invoices');
		$this->db->where(array('payment_status !='=>'S', 'id_cc_newsletter'=>$id_cc_newsletter));
		$this->db->order_by('created_at', 'ASC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}


}
<?php
class UACC_report_model extends CI_Model{

	function fetch_director_data($id_cc_newsletter){
		$date = date("m-d-y");
		if (isset($id_cc_newsletter) && !empty($id_cc_newsletter)) {
			$this->db->select('hg.*, hd.*, hp.*, ho.design_approve_status');
			$this->db->from('history_general_info AS hg');
			$this->db->join('history_design_info AS hd', 'hd.id_cc_newsletter=hg.id_cc_newsletter', 'left');
			$this->db->join('history_packaging AS hp', 'hp.id_cc_newsletter=hg.id_cc_newsletter', 'left');
			$this->db->join('history_other_details AS ho', 'ho.id_cc_newsletter=hg.id_cc_newsletter', 'left');
			$this->db->where(array('hg.deleted'=>'0', 'hg.id_cc_newsletter'=>$id_cc_newsletter, 'hd.consultant_two1 !='=>'X'));
			$this->db->group_by('hg.id_history');
			$this->db->order_by('hg.name', 'ASC');
		}else{
			$this->db->select('n.*, nd.*, np.*, no.design_approve_status');
			$this->db->from('newsletter_general_info AS ng');
			$this->db->join('newsletter_design_info AS nd', 'nd.id_cc_newsletter=n.id_cc_newsletter', 'left');
			$this->db->join('newsletter_packaging AS np', 'np.id_cc_newsletter=n.id_cc_newsletter', 'left');
			$this->db->join('newsletter_other_details AS no', 'no.id_cc_newsletter=n.id_cc_newsletter', 'left');
			$this->db->where(array('n.deleted'=>'0'));
	    	$this->db->where("(n.contract_update_date ='' OR n.contract_update_date >".$date.")", NULL, FALSE);	
	    	$this->db->order_by('n.name', 'ASC');
		}
		return $this->db->get()->result_array();
	}

	function get_yearly_report($id_cc_newsletter){

		$sAndWhere = " 1 = 1";
	    $sAndWhere .= " AND i.deleted = '0'";
	    $sAndWhere .= " AND i.id_cc_newsletter = '" . $id_cc_newsletter . "'";
	    $sAndWhere .= " AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE())";

		$this->db->select('i.data, i.invoice_date, i.total, i.total_paid, i.due_amount, i.payment_date, n.name, n.consultant_number, n.billing_alert, n.cc_newsletter, n.contract_update_date');
		$this->db->from('cc_invoices AS i');
		$this->db->join('cc_newsletters AS n', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
		$this->db->where($sAndWhere);
		$data =  $this->db->get()->result_array();
		
	    $this->db->select('SUM(total) AS total_amounts, SUM(total_paid) AS total_paids, SUM(due_amount) AS due_amounts');
	    $this->db->from('cc_invoices AS i');
	    $this->db->where($sAndWhere);
	    $dataTotal = $this->db->get()->result_array();

	    return array('data'=>$data, 'total'=>$dataTotal);
	}

	function get_all_invoice_report($time, $monthFrom, $monthTo, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND i.deleted = '0'";
    	/*$sAndWhere .= " AND n.contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";*/

    	if ($time == 'month') {
    		$sAndWhere .= "AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE()) AND MONTH(i.invoice_date) BETWEEN " . $monthFrom . " AND " . $monthTo . " GROUP BY i.id_cc_newsletter";
    	}elseif ($time == 'allYear') {
    		$sAndWhere .=" AND YEAR(i.invoice_date) = " . $selectedYear . " GROUP BY i.id_cc_newsletter";
    	}else{
    		$sAndWhere .="AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE()) GROUP BY i.id_cc_newsletter";
    	}

    	$sql = "SELECT i.id_cc_newsletter, SUM(i.total) as total, SUM(i.total_paid) as total_paid, SUM(i.due_amount) as total_due, GROUP_CONCAT(i.invoice_date ORDER BY i.invoice_date ASC SEPARATOR ', ') AS invoice_date, GROUP_CONCAT(YEAR(i.invoice_date) ORDER BY i.invoice_date ASC SEPARATOR ', ') AS invoice_year, n.name, n.consultant_number,n.cc_newsletter, n.contract_update_date FROM cc_invoices AS i LEFT JOIN cc_newsletters AS n ON n.id_cc_newsletter=i.id_cc_newsletter WHERE ".$sAndWhere;

    	$query = $this->db->query($sql);
    	return $query->result_array();
	}

	function get_total_bank_report(){
		$this->db->select('n.id_cc_newsletter, n.name, n.consultant_number, n.pmt_type, n.contract_update_date, n.cc_newsletter, i.total');
		$this->db->from('cc_invoices AS i');
		$this->db->join('cc_newsletters AS n', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
		$this->db->where('i.deleted', '0');
		return $this->db->get()->result_array();
	}

	function get_last_total($id_cc_newsletter){
		$sDate = date("m");   
		$this->db->select('total');
		$this->db->from('cc_invoices');
		$this->db->where(array("MONTH(created_at)"=>$sDate, "id_cc_newsletter"=>$id_cc_newsletter));
		$data = $this->db->get()->row_array();
	    $total = empty($data['total']) ? '' : $data['total'];
	    return $total;
	}

	function get_bank_report($time, $monthFrom, $monthTo, $year_month, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND n.deleted = '0' ";

		if ($time == 'month') {
			$sAndWhere.= " AND  n.cc = 'Y' AND cc_chargefree = '0'";
	        $sAndWhere.= " AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE())";
	        $sAndWhere.= " AND MONTH(i.invoice_date) BETWEEN " . $monthFrom . " AND " . $monthTo . "";
		}elseif ($time == 'allYear') {
    		$sAndWhere .= " AND YEAR(i.invoice_date) = ".$selectedYear;
		}

		$sql = "SELECT i.id_cc_newsletter, SUM(i.total) AS total, n.m_bill_date, SUM(i.total_paid) AS total_paid, SUM(i.due_amount) AS total_due, GROUP_CONCAT(i.invoice_date ORDER BY i.invoice_date ASC SEPARATOR ', ') AS invoice_date, GROUP_CONCAT(YEAR(i.invoice_date) ORDER BY i.invoice_date ASC SEPARATOR ', ') AS invoice_year, n.name, n.consultant_number, n.cc_newsletter, n.cu_routing, n.cv_account, n.contract_update_date, n.created_at AS date_created, n.pmt_type, n.billing_alert, n.month_mailing, n.cc_director_title, n.reffered_by, n.special_credit, n.misc_charge, n.cc_number, n.cc_code, n.cc_expir_date, n.cc_zip FROM cc_invoices AS i LEFT JOIN cc_newsletters AS n ON n.id_cc_newsletter = i.id_cc_newsletter WHERE ".$sAndWhere."  GROUP BY i.id_cc_newsletter";

		$query = $this->db->query($sql);
    	return $query->result_array();
	}

	function get_all_invoice_total($time, $monthFrom, $monthTo, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND deleted = '0'";
		if ($time == 'month') {
	        $sAndWhere .= " AND MONTH(invoice_date) BETWEEN $monthFrom AND $monthTo";
	        $sAndWhere .= " AND YEAR(invoice_date) = YEAR(CURRENT_DATE())";
		}elseif ($time == 'allYear') {
			$sAndWhere .= " AND YEAR(invoice_date) = ".$selectedYear;
		}

		$this->db->select('SUM(total) as total_amounts, SUM(total_paid) as total_paids, SUM(due_amount) as due_amounts');
		$this->db->from('cc_invoices');
		$this->db->where($sAndWhere);
		return $this->db->get()->result_array();
	}

	function get_billing_changes_report(){
		$date = date("m-d-y");
        $this->db->select('n.name, n.consultant_number, n.contract_update_date, n.first_bill_date, n.reffered_by, n.created_at, np.billing_alert, np.package_note, np.special_credit, np.special_creadit, np.credit_notes, np.misc_charge, np.misc_description');
        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('newsletter_packaging AS np', 'np.id_cc_newsletter=n.id_cc_newsletter', 'left');
        $this->db->where(array('n.deleted'=>'0'));
    	$this->db->where("(n.contract_update_date ='' OR n.contract_update_date >".$date.")", NULL, FALSE);
        $this->db->order_by('n.name', 'ASC');
    	return $this->db->get()->result_array();
	}

	function get_item_report($monthFrom, $monthTo, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND i.deleted = '0'";
		$sAndWhere .= " AND YEAR(i.created_at)=".$selectedYear;
		$sAndWhere .= " AND MONTH(i.created_at) BETWEEN " .$monthFrom. " AND " . $monthTo;

		$this->db->select('i.data, i.invoice_date, i.total, i.create_by, n.name, n.pmt_type');
		$this->db->from('cc_invoices AS i');
		$this->db->join('cc_newsletters AS n', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
		$this->db->where($sAndWhere);
		$this->db->order_by('n.name', 'ASC');
		return $this->db->get()->result_array();
	}

	function get_unsubcribed_invoice(){
		$sAndWhere  = " 1 = 1";
	    $sAndWhere .= " AND n.contract_update_date != ''";
	    $sAndWhere .= " AND n.deleted = '1'";
	    $sAndWhere .= " AND n.contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";

		$this->db->select('n.name, n.email, n.cell_number, i.total, i.total_paid');
		$this->db->from('cc_newsletters AS n');
		$this->db->join('cc_invoices AS i', 'i.id_cc_newsletter=n.id_cc_newsletter', 'inner');
		$this->db->where($sAndWhere);
		$this->db->order_by('n.created_at', 'DESC');
		return $this->db->get()->result_array();
	}


	
}
<?php
class Report_model extends CI_Model{

	function fetch_director_data($id_newsletter){
		$date = date("m-d-y");
		if (isset($id_newsletter) && !empty($id_newsletter)) {
			$this->db->select('hg.*, hd.*, hp.*, ho.design_approve_status');
			$this->db->from('history_general_info AS hg');
			$this->db->join('history_design_info AS hd', 'hd.id_history=hg.id_history', 'left');
			$this->db->join('history_packaging AS hp', 'hp.id_history=hg.id_history', 'left');
			$this->db->join('history_other_details AS ho', 'ho.id_history=hg.id_history', 'left');
			$this->db->where(array('hg.deleted'=>'0', 'hg.id_newsletter'=>$id_newsletter, 'hd.consultant_two1 !='=>'X'));
			$this->db->group_by('hg.id_history');
			$this->db->order_by('hg.name', 'ASC');
		}else{
			$this->db->select('ng.*, nd.*, np.*, no.design_approve_status');
			$this->db->from('newsletter_general_info AS ng');
			$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
			$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
			$this->db->join('newsletter_other_details AS no', 'no.id_newsletter=ng.id_newsletter', 'left');
			$this->db->where(array('ng.deleted'=>'0'));
	    	$this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date >".$date.")", NULL, FALSE);	
	    	$this->db->order_by('ng.name', 'ASC');
		}
		return $this->db->get()->result_array();
	}

	function get_yearly_report($id_newsletter){

		$sAndWhere = " 1 = 1";
	    $sAndWhere .= " AND i.deleted = '0'";
	    $sAndWhere .= " AND i.id_newsletter = '" . $id_newsletter . "'";
	    $sAndWhere .= " AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE())";

		$this->db->select('i.data, i.invoice_date, i.total, i.total_paid, i.due_amount, i.payment_date, ng.name, ng.consultant_number, np.billing_alert, ng.newsletters_design, ng.contract_update_date');
		$this->db->from('invoices as i');
		$this->db->join('newsletter_general_info as ng', 'ng.id_newsletter=i.id_newsletter', 'left');
		$this->db->join('newsletter_packaging as np', 'np.id_newsletter=i.id_newsletter', 'left');
		$this->db->where($sAndWhere);
		$data =  $this->db->get()->result_array();

	    $this->db->select('SUM(total) as total_amounts, SUM(total_paid) as total_paids, SUM(due_amount) as due_amounts');
	    $this->db->from('invoices as i');
	    $this->db->where($sAndWhere);
	    $dataTotal = $this->db->get()->result_array();

	    return array('data'=>$data, 'total'=>$dataTotal);
	}

	function get_all_invoice_report($time, $monthFrom, $monthTo, $selectedYear){
		$sAndWhere = " 1 = 1";
    	$sAndWhere .= " AND ng.contract_update_date < DATE_SUB(NOW(), INTERVAL 90 DAY)";

    	if ($time == 'month') {
    		$sAndWhere .= "AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE()) AND MONTH(i.invoice_date) BETWEEN " . $monthFrom . " AND " . $monthTo . " GROUP BY i.id_newsletter";
    	}elseif ($time == 'allYear') {
    		$sAndWhere .=" AND YEAR(i.invoice_date) = " . $selectedYear . " GROUP BY i.id_newsletter";
    	}else{
    		$sAndWhere .="AND YEAR(i.invoice_date) = YEAR(CURRENT_DATE()) GROUP BY i.id_newsletter";
    	}

    	$sql = "SELECT i.id_newsletter, SUM(i.total) as total, SUM(i.total_paid) as total_paid, SUM(i.due_amount) as total_due, GROUP_CONCAT(i.invoice_date ORDER BY i.invoice_date ASC SEPARATOR ', ') AS invoice_date, GROUP_CONCAT(YEAR(i.invoice_date) ORDER BY i.invoice_date ASC SEPARATOR ', ') AS invoice_year, np.billing_alert, np.package_note, ng.contract_update_date, ng.newsletters_design, ng.name, ng.consultant_number FROM invoices AS i LEFT JOIN newsletter_general_info AS ng ON ng.id_newsletter = i.id_newsletter LEFT JOIN newsletter_packaging AS np ON np.id_newsletter=i.id_newsletter WHERE ".$sAndWhere;

    	$query = $this->db->query($sql);
    	return $query->result_array();
	}

	function get_bank_report($time, $monthFrom, $monthTo, $year_month, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND ng.deleted = '0' ";

		if ($time == 'month') {
			 $sAndWhere .= " AND YEAR(i.invoice_date) = $year_month AND YEAR(i.created_at) = $year_month AND MONTH(i.created_at) BETWEEN " . $monthFrom . " AND " . $monthTo;
		}elseif ($time == 'allYear') {
			$sAndWhere .= " AND YEAR(i.created_at) = ".$selectedYear;
		}

		$sql = "SELECT i.id_newsletter, SUM(i.total) as total, SUM(i.total_paid) as total_paid, SUM(i.due_amount) as total_due, GROUP_CONCAT(i.created_at ORDER BY i.created_at ASC SEPARATOR ', ') AS invoice_date, GROUP_CONCAT(YEAR(i.created_at) ORDER BY i.created_at ASC SEPARATOR ', ') AS invoice_year, np.billing_alert, np.package_note, ng.contract_update_date, ng.newsletters_design, np.cu_routing, np.account_detail, np.cv_account, ng.name, ng.consultant_number, np.special_credit, ng.created_at as date_created, ng.first_bill_date, np.cc_number, np.cc_code, np.cc_expir_date, np.cc_zip, np.invoice_note, ng.director_title FROM invoices i LEFT JOIN newsletter_general_info AS ng ON ng.id_newsletter = i.id_newsletter LEFT JOIN newsletter_packaging AS np ON np.id_newsletter=i.id_newsletter WHERE ".$sAndWhere." GROUP BY i.id_newsletter";

		$query = $this->db->query($sql);
    	$invoice_data =  $query->result_array();

    	$id_newsletters = array();
    	foreach ($invoice_data as $key => $val) {
    		$id_newsletters[] = $val['id_newsletter'];
    	}

    	if(!empty($id_newsletters)) {
	       $id_newsletter = implode(',',$id_newsletters);
	    }else {
	        $id_newsletter ="''";
	    }

    	$sSqlQuery = "SELECT ng.id_newsletter, ng.contract_update_date, ng.newsletters_design, ng.name, ng.consultant_number, ng.created_at as date_created, ng.first_bill_date, ng.director_title, np.billing_alert, np.package_note, np.cu_routing, np.account_detail, np.cv_account, np.special_credit, np.cc_number, np.cc_code, np.cc_expir_date, np.cc_zip, np.invoice_note FROM newsletter_general_info AS ng LEFT JOIN newsletter_packaging AS np ON np.id_newsletter=ng.id_newsletter WHERE ng.deleted = 0 AND ng.id_newsletter NOT IN(".$id_newsletter.") GROUP BY ng.id_newsletter";

    	$sqlQuery = $this->db->query($sSqlQuery);
    	$news_data =  $sqlQuery->result_array();
    	
    	return array_merge($invoice_data, $news_data);

	}

	function get_all_invoice_total($time, $monthFrom, $monthTo, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND deleted = '0'";
		if ($time == 'month') {
	        $sAndWhere .= " AND MONTH(invoice_date) BETWEEN $monthFrom AND $monthTo";
	        $sAndWhere .= " AND YEAR(invoice_date) = YEAR(CURRENT_DATE())";
		}elseif ($time == 'allYear') {
			$sAndWhere .= " AND YEAR(invoice_date) = $selectedYear";
		}

		$this->db->select('SUM(total) as total_amounts, SUM(total_paid) as total_paids, SUM(due_amount) as due_amounts');
		$this->db->from('invoices');
		$this->db->where($sAndWhere);
		return $this->db->get()->result_array();
	}

	function get_billing_changes_report(){
		$date = date("m-d-y");
        $this->db->select('ng.name, ng.consultant_number, ng.contract_update_date, ng.first_bill_date, ng.reffered_by, ng.created_at, np.billing_alert, np.package_note, np.special_credit, np.special_creadit, np.credit_notes, np.misc_charge, np.misc_description, np.invoice_note');
        $this->db->from('newsletter_general_info AS ng');
        $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
        $this->db->where(array('ng.deleted'=>'0'));
    	$this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date >".$date.")", NULL, FALSE);
        $this->db->order_by('ng.name', 'ASC');
    	return $this->db->get()->result_array();
	}

	function get_item_report($monthFrom, $monthTo, $selectedYear){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND i.deleted = '0'";
		$sAndWhere .= " AND YEAR(i.created_at)=".$selectedYear;
		$sAndWhere .= " AND MONTH(i.created_at) BETWEEN " .$monthFrom. " AND " . $monthTo;

		$this->db->select('i.data, i.invoice_date, i.total, i.create_by, ng.name, np.account_detail, np.package_pricing');
		$this->db->from('invoices AS i');
		$this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=i.id_newsletter', 'left');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=i.id_newsletter', 'left');
		$this->db->where($sAndWhere);
		$this->db->order_by('ng.name', 'ASC');
		return $this->db->get()->result_array();
	}

	function get_unsubcribed_invoice(){
		$this->db->select('ng.name, ng.email, ng.cell_number, np.billing_alert, np.package_note, i.total, i.total_paid');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('invoices AS i', 'i.id_newsletter=ng.id_newsletter', 'inner');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where('ng.deleted', '1');
		$this->db->order_by('ng.created_at', 'DESC');
		return $this->db->get()->result_array();
	}


	
}
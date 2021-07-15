<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }
class Billing_Model extends CI_Model {

	function get_invoice_rows($payment_status){
		$this->db->select('id_invoice');
		$this->db->from('invoices');

		if (empty($payment_status)) {
			$this->db->where(array('deleted'=>'0', 'activated'=>'1'));
		}else{
			$this->db->where(array('deleted'=>'0', 'activated'=>'1', 'payment_status'=>$payment_status));
		}

		return $this->db->get()->num_rows();
	}

	function DataAjax($row='', $rowperpage='', $columnName='', $columnSortOrder='', $searchValue=''){
		$this->db->select('id_newsletter');
		$this->db->from('invoices');
		$this->db->where('deleted', '0');
		$id_newsletters = $this->db->get()->result_array();
		$searchQuery = " 1=1";
		if($searchValue != ''){
			if ($columnName == 'account_balance') {
				$searchQuery .= " AND (n.name like '%".$searchValue."%' or n.email like '%".$searchValue."%' or n.consultant_number like'%".$searchValue."%' or n.cell_number like'%".$searchValue."%') ";
			}else {
		    	$searchQuery .= " AND (name like '%".$searchValue."%' or email like '%".$searchValue."%' or consultant_number like'%".$searchValue."%' or cell_number like'%".$searchValue."%') ";
			}
		}
		$this->db->select('id_newsletter');
		$this->db->from('newsletter_general_info');
		$this->db->where('deleted', '0');
		$totalRecords = $this->db->get()->num_rows();

		$this->db->select('id_newsletter');
		$this->db->from('newsletter_general_info');
		$this->db->where($searchQuery);
		$this->db->where('deleted', '0');
		$totalRecordwithFilter = $this->db->get()->num_rows();


		if ($columnName == 'id_newsletter') {
			if ($columnSortOrder == 'asc') {
				$columnSortOrder = 'DESC';
			}
			$columnName = 'created_at';
			$this->db->select('contract_update_date, id_newsletter, first_bill_date, name, cell_number, email, consultant_number');
			$this->db->from('newsletter_general_info');
			$this->db->where($searchQuery);
			$this->db->where('deleted', '0');
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $row);
		}elseif ($columnName == 'account_balance') {
			$this->db->select('n.first_bill_date, n.name, n.cell_number,n.email, n.consultant_number, n.contract_update_date, (SUM(i.total) - SUM(i.total_paid)) as account_balance, n.id_newsletter');
			$this->db->from('newsletter_general_info AS n');
			$this->db->join('invoices AS i', 'n.id_newsletter=i.id_newsletter', 'left');
			$this->db->where($searchQuery);
			$this->db->where(array('n.deleted'=>'0', 'i.deleted'=>'0', 'i.total'=>'0'));
			$this->db->group_by('i.id_newsletter');
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $row);
		}else {
			$this->db->select('contract_update_date, id_newsletter, first_bill_date, name, cell_number, email, consultant_number');
			$this->db->from('newsletter_general_info');
			$this->db->where($searchQuery);
			$this->db->where('deleted', '0');
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $row);
		}
		
		$user_data = $this->db->get()->result_array();

		return array('user_data'=>$user_data, 'id_newsletters'=>$id_newsletters, 'totalRecordFilter'=>$totalRecordwithFilter, 'totalRecords'=>$totalRecords);
	}

	function getUAClients(){
		$date = date('m-d-y');
       	$this->db->select('n.id_newsletter, n.updated_by, n.first_bill_date, n.cell_number, n.email, n.consultant_number, n.name');
       	$this->db->from('newsletters as n');
       	$this->db->where('n.deleted','0');
       	$this->db->group_start();
       	$this->db->where('n.contract_update_date', '');
       	$this->db->or_where('n.contract_update_date >',$date);
       	$this->db->group_end();
       	$this->db->order_by('n.created_at', 'DESC');
       	$this->db->limit(50,50);
       	return $this->db->get()->result_array();
	}

	function delete_invoice_pdf($id_invoice){
		$this->db->select('id_newsletter, invoice_name');
		$this->db->from('invoices');
		$this->db->where('id_invoice', $id_invoice);
		$this->db->limit(1);
		$invoice = $this->db->get()->row_array();

		$this->db->select('SUM(due_amount) As due');
		$this->db->from('invoices');
		$this->db->where(array('id_newsletter'=>$invoice['id_newsletter'], 'id_invoice'=>$id_invoice));
		$this->db->limit(1);
		$due_balance = $this->db->get()->row()->due;

		if ($due_balance < 0) {
			SetBalance($invoice['id_newsletter'], abs($due_balance));
		}

		$filename = './assets/uploads/billing/'.$invoice['invoice_name'];
        @unlink($filename);

        $this->db->where('id_invoice', $id_invoice);
        $this->db->limit(1);
        return $this->db->delete('invoices');
	}

	function search_keyword($keyword) {
		$date = date('m-d-y');
	   	$this->db->select('n.name, n.id_newsletter, n.email');
       	$this->db->from('newsletter_general_info AS n');
       	$this->db->join('users as u', 'n.id_user = u.id_user', 'left');
       	$this->db->where('n.deleted','0');
       	$this->db->group_start();
       	$this->db->where('n.contract_update_date', '');
       	$this->db->or_where('n.contract_update_date >', ".$date.");
       	$this->db->group_end();
       	$this->db->like('n.name', $keyword,'both');
       	$this->db->order_by('n.name', 'ASC');
       	$this->db->limit(5);
       	return $this->db->get()->result_array();
	}

	function GetInvoices($id_newsletter) {
		if(!empty($id_newsletter)) {
			$this->db->select('i.*, n.name');
			$this->db->from('invoices AS i');
			$this->db->join('newsletter_general_info As n', 'i.id_newsletter=n.id_newsletter', 'left');
			$this->db->where( array('i.id_newsletter'=>$id_newsletter, 'i.deleted'=>'0'));
			$this->db->order_by('i.invoice_date', 'DESC');
		}else{
			$this->db->select('*');
			$this->db->from('invoices');
		}
		return $this->db->get()->result_array();
	}

	function Searchname($id_newsletter) {
		$this->db->select('ng.email, np.package_pricing, np.special_creadit, np.special_credit, np.credit_notes, np.package_note, np.account_detail');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where('ng.id_newsletter', $id_newsletter);
		$aClientsDetails = $this->db->get()->row_array();
		$Ttotal=number_format((float)$aClientsDetails['package_pricing']-(float)$aClientsDetails['special_credit'], 2);
		if ($aClientsDetails['account_detail'] == 'N') {
			$CCcharge = number_format(($Ttotal * 5) / 100, 2);
			$Ttotal = number_format($CCcharge + $Ttotal, 2);
		}
		$Puretotal = $Ttotal;
		$Credit = (GetTotalDue($id_newsletter) - GetBalance($id_newsletter));
		if($Credit < 0) {
			$Ttotal = $Ttotal - abs($Credit);
		}
		$var = array(
			'email' => $aClientsDetails['email'],
			'total' => number_format($Ttotal,2),
			'puretotal' => number_format($Puretotal,2),
			'special_creadit' => number_format($aClientsDetails['special_creadit'], 2),
			'special_creadit_name' => $aClientsDetails['package_note'],
		);
		return json_encode($var);
	}

	function GetInvoiceData($id_newsletter) {
		$this->db->select('ng.id_newsletter, ng.name, np.*, nd.hidden_newsletter, nd.economy');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where('ng.id_newsletter', $id_newsletter);
		$this->db->query('SET SQL_BIG_SELECTS=1');
		$aUserFormDetail = $this->db->get()->row_array();
		return GetInvoiceTable($aUserFormDetail);
	}

	function GetAllInvoiceData($id_newsletter) {
		$this->db->select('ng.id_newsletter, ng.name, np.*, nd.hidden_newsletter, nd.economy');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->join('newsletter_design_info AS nd', 'nd.id_newsletter=ng.id_newsletter', 'left');
		$this->db->query('SET SQL_BIG_SELECTS=1');
		$id_newsletters = implode(',', $id_newsletter);
		$this->db->where_in('ng.id_newsletter', $id_newsletters, FALSE);
		return $this->db->get()->result_array();
	}

	function get_single_invoice($id_invoice){
		$this->db->select('i.*, ng.name, ng.email, np.referral_credit, np.account_detail, np.credit_notes, np.package_note, np.special_creadit, np.package_pricing, np.special_credit');
		$this->db->from('invoices AS i');
		$this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=i.id_newsletter', 'left');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=i.id_newsletter', 'left');
		$this->db->where('i.id_invoice', $id_invoice);
		$this->db->query('SET SQL_BIG_SELECTS=1');
		return $this->db->get()->row_array();
	}

	function get_news_data($id_newsletter){
		$this->db->select('ng.consultant_number, np.account_detail, np.cc_number');
		$this->db->from('newsletter_general_info AS ng');
		$this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
		$this->db->where('ng.id_newsletter', $id_newsletter);
		return $this->db->get()->row_array();
	}

	function get_invoice_last_id($id_newsletter){
		$this->db->select('id_invoice');
		$this->db->from('invoices');
		$this->db->where('id_newsletter', $id_newsletter);
		return $this->db->get()->row_array();
	}

	function get_max_invoice_id(){
		$this->db->select('MAX(id_invoice) AS max_id_invoice');
		$this->db->from('invoices');
		return $this->db->get()->row()->max_id_invoice;
	}

	function get_pdf_date($alredInvoiced){
		$this->db->select('created_at');
		$this->db->from('invoices');
		$this->db->where('id_invoice', $alredInvoiced);
		return $this->db->get()->row()->created_at;
	}

	function get_invoice_name($id_newsletter){
		$this->db->select('invoice_name');
		$this->db->from('invoices');
		$this->db->where(array('id_newsletter'=>$id_newsletter, 'payment_status !='=>'S'));
		return $this->db->get()->row_array();
	}

	function get_current_date($id_newsletter){
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND YEAR(created_at) = YEAR(CURRENT_DATE()) ";
		$sAndWhere .= " AND MONTH(created_at) = MONTH(CURRENT_DATE()) ";
		$sAndWhere .= " AND id_newsletter=".$id_newsletter;
		$sAndWhere .= " AND payment_status != 'S' ";
		$sAndWhere .= " AND deleted ='0'";

		$this->db->select('id_invoice');
		$this->db->from('invoices');
		$this->db->where($sAndWhere);
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function CreatePdf($data){
		$nTotalKey = str_replace(",", "", $data['total_key']);
		$params = array();
		$sDate = date("Y-m-d");

		parse_str($data['form_serial'], $params);
		$params['name'] = addslashes($params['name']);
		extract($params);
		$sSerialData = serialize($params);
		$create_by='0';

		$aNewsData = $this->get_news_data($id_newsletter);
		$aInvoiceLastId = $this->get_invoice_last_id($id_newsletter);

		if (empty($aInvoiceLastId)) {
			$aLastInvoiceId = $this->get_max_invoice_id();
			$nLastInsertId = $aLastInvoiceId + 1;
		} else {
			$nLastInsertId = $aInvoiceLastId['id_invoice'];
			
		}

		include APPPATH."/libraries/pdf/invoice.php"; 
		$pdf = new PDF_Invoice('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->Image('./assets/images/logo.png', 5, 5, 140);
		//$pdf->addSociete('',"120 manhattan ave manhattan beach CA 30001");
		$pdf->fact_dev("INVOICE", '');
		$pdf->addDate($sDate);
		$pdf->addClient($nLastInsertId);
		//$pdf->addClientAdresse($aNewsData['nsd_address']);
		$pdf->addReglement($data['name']);
		$pdf->setAutoPageBreak(true);
		$cols = array("#" => 14,
			"Name" => 95,
			"Quantity" => 29,
			"Value($)" => 29,
			"Total($)" => 33,
		);
		$pdf->addCols($cols);
		$pdf->addLineFormat($cols);
		$l_num = 1;

		if (isset($package_value) && !empty($package_value)) {
			$y = 65;
			$line = pdf_format($l_num, $package, '1', $package_value, $package_value_total);
			$size = $pdf->addLine($y, $line);
			$y += 10;
			$l_num++;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($facebook) && !empty($facebook)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $facebook_name, $facebook, $facebook_val, $facebook_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($facebook_everything) && !empty($facebook_everything)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $facebook_everything_name, $facebook_everything, $facebook_everything_val, $facebook_everything_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($total_text_program) && !empty($total_text_program) == '1') {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $total_text_program_name, $total_text_program, $total_text_program_val, $total_text_program_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($total_text_program7) && !empty($total_text_program7) == '1') {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $total_text_program7_name, $total_text_program7, $total_text_program7_val, $total_text_program7_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($emailing) && !empty($emailing)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $emailing_name, $emailing, $emailing_val, $emailing_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($newsletter_formating) && !empty($newsletter_formating)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $newsletter_formating_name, $newsletter_formating, $newsletter_formating_val, $newsletter_formating_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($digital_biz_card) && !empty($digital_biz_card)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $digital_biz_card_name, $digital_biz_card, $digital_biz_card_val, $digital_biz_card_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($canada_service) && !empty($canada_service)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $canada_service_name, '1', $canada_service_val, $canada_service_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($email_newsletter) && !empty($email_newsletter)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $email_newsletter_name, $email_newsletter, $email_newsletter_val, $email_newsletter_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($text_email) && !empty($text_email)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $text_email_name, $text_email, $text_email_val, $text_email_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($prospect_system) && !empty($prospect_system)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $prospect_system_name, $prospect_system, $prospect_system_val, $prospect_system_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($magic_booker) && !empty($magic_booker)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $magic_booker_name, $magic_booker, $magic_booker_val, $magic_booker_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($other_language_newsletter) && !empty($other_language_newsletter)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $other_language_newsletter_name, $other_language_newsletter, $other_language_newsletter_val, $other_language_newsletter_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($personal_unit_app) && !empty($personal_unit_app)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $personal_unit_app_name, $personal_unit_app, $personal_unit_app_val, $personal_unit_app_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}
		
		if (isset($personal_website) && !empty($personal_website)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $personal_website_name, $personal_website, $personal_website_val, $personal_website_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}
		
		if (isset($personal_url) && !empty($personal_url)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $personal_url_name, $personal_url, $personal_url_val, $personal_url_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}
		
		if (isset($subscription_updates) && !empty($subscription_updates)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $subscription_updates_name, $subscription_updates, $subscription_updates_val, $subscription_updates_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($app_color) && !empty($app_color)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $app_color_name, $app_color, $app_color_val, $app_color_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}


		if (isset($newsletter_color) && !empty($newsletter_color)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $newsletter_color_name, $newsletter_color, $newsletter_color_val, $newsletter_color_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($newsletter_black_white) && !empty($newsletter_black_white)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $newsletter_black_white_name, $newsletter_black_white, $newsletter_black_white_val, $newsletter_black_white_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($month_packet_postage) && !empty($month_packet_postage)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $month_packet_postage_name, $month_packet_postage, $month_packet_postage_val, $month_packet_postage_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($consultant_packet_postage) && !empty($consultant_packet_postage)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $consultant_packet_postage_name, $consultant_packet_postage, $consultant_packet_postage_val, $consultant_packet_postage_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($consultant_bundles) && !empty($consultant_bundles)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $consultant_bundles_name, $consultant_bundles, $consultant_bundles_val, $consultant_bundles_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($consistency_gift) && !empty($consistency_gift)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $consistency_gift_name, $consistency_gift, $consistency_gift_val, $consistency_gift_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($reds_program_gift) && !empty($reds_program_gift)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $reds_program_gift_name, $reds_program_gift, $reds_program_gift_val, $reds_program_gift_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($stars_program_gift) && !empty($stars_program_gift)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $stars_program_gift_name, $stars_program_gift, $stars_program_gift_val, $stars_program_gift_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($gift_wrap_postpage) && !empty($gift_wrap_postpage)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $gift_wrap_postpage_name, $gift_wrap_postpage, $gift_wrap_postpage_val, $gift_wrap_postpage_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($one_rate_postpage) && !empty($one_rate_postpage)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $one_rate_postpage_name, $one_rate_postpage, $one_rate_postpage_val, $one_rate_postpage_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($month_blast_flyer) && !empty($month_blast_flyer)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $month_blast_flyer_name, $month_blast_flyer, $month_blast_flyer_val, $month_blast_flyer_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}
		
		if (isset($flyer_ecard_unit) && !empty($flyer_ecard_unit)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $flyer_ecard_unit_name, $flyer_ecard_unit, $flyer_ecard_unit_val, $flyer_ecard_unit_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($unit_challenge_flyer) && !empty($unit_challenge_flyer)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $unit_challenge_flyer_name, $unit_challenge_flyer, $unit_challenge_flyer_val, $unit_challenge_flyer_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($team_building_flyer) && !empty($team_building_flyer)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $team_building_flyer_name, $team_building_flyer, $team_building_flyer_val, $team_building_flyer_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($wholesale_promo_flyer) && !empty($wholesale_promo_flyer)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $wholesale_promo_flyer_name, $wholesale_promo_flyer, $wholesale_promo_flyer_val, $wholesale_promo_flyer_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($postcard_design) && !empty($postcard_design)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $postcard_design_name, $postcard_design, $postcard_design_val, $postcard_design_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($postcard_edit) && !empty($postcard_edit)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $postcard_edit_name, $postcard_edit, $postcard_edit_val, $postcard_edit_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($ecard_unit) && !empty($ecard_unit)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $ecard_unit_name, $ecard_unit, $ecard_unit_val, $ecard_unit_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($speciality_postcard) && !empty($speciality_postcard)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $speciality_postcard_name, $speciality_postcard, $speciality_postcard_val, $speciality_postcard_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($card_with_gift) && !empty($card_with_gift)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $card_with_gift_name, $card_with_gift, $card_with_gift_val, $card_with_gift_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($greeting_card) && !empty($greeting_card)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $greeting_card_name, $greeting_card, $greeting_card_val, $greeting_card_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($birthday_brownie) && !empty($birthday_brownie)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $birthday_brownie_name, $birthday_brownie, $birthday_brownie_val, $birthday_brownie_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($birthday_starbucks) && !empty($birthday_starbucks)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $birthday_starbucks_name, $birthday_starbucks, $birthday_starbucks_val, $birthday_starbucks_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($anniversary_starbucks) && !empty($anniversary_starbucks)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $anniversary_starbucks_name, $anniversary_starbucks, $anniversary_starbucks_val, $anniversary_starbucks_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($referral_credit) && !empty($referral_credit)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $referral_credit_name, $referral_credit, $referral_credit_val, $referral_credit_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($cc_billing) && !empty($cc_billing)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $cc_billing_name, $cc_billing, $cc_billing_val, $cc_billing_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($customer_newsletter) && !empty($customer_newsletter)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $customer_newsletter_name, $customer_newsletter, $customer_newsletter_val, $customer_newsletter_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($birthday_postcard) && !empty($birthday_postcard)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $birthday_postcard_name, $birthday_postcard, $birthday_postcard_val, $birthday_postcard_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($anniversary_postcard) && !empty($anniversary_postcard)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $anniversary_postcard_name, $anniversary_postcard, $anniversary_postcard_val, $anniversary_postcard_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($picture_texting) && !empty($picture_texting)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $picture_texting_name, $picture_texting, $picture_texting_val, $picture_texting_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($keyword) && !empty($keyword)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $keyword_name, $keyword, $keyword_val, $keyword_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($client_setup) && !empty($client_setup)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $client_setup_name, $client_setup, $client_setup_val, $client_setup_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
			
			if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (isset($nl_flyer) && !empty($nl_flyer)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $nl_flyer_name, $nl_flyer, $nl_flyer_val, $nl_flyer_val_total);
				$size = $pdf->addLine($y, $line);
				$l_num++;
				$y += 10;
				
				if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
			}

			if (isset($misc_charge_val_total) && !empty($misc_charge_val_total)) {
				$y = ($y == 65 ? $y = 65 : $y);
				$line = pdf_format($l_num, $misc_charge_name, '', $misc_charge, $misc_charge_val_total);
				$size = $pdf->addLine($y, $line);
				$l_num++;
				$y += 10;
				
				if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
			}

			if (isset($special_credit)) {
				$y = ($y == 65 ? $y = 65 : $y);
				$line = pdf_format($l_num, $special_credit_name, $special_credit, $special_credit_val, $special_credit_val_total);
				$size = $pdf->addLine($y, $line);
				$l_num++;
				if (strlen($special_credit_name) < 108) {
		            $y += 10;    
		        }elseif (strlen($special_credit_name) > 108) {
		            $y += 25;    
		        }elseif (strlen($special_credit_name) > 216) {
		            $y += 35;    
		        }elseif (strlen($special_credit_name) > 324) {
		            $y += 45;    
		        }
			}

			if (isset($invoice_note_name) && !empty($invoice_note_name)) {
				$y = ($y == 65 ? $y = 65 : $y);
				$line = pdf_format($l_num, $invoice_note_name, $invoice_note, $invoice_note_val, $invoice_note_val_total);
				$size = $pdf->addLine($y, $line);
				$l_num++;
				if (strlen($special_credit_name) < 108) {
		            $y += 10;    
		        }elseif (strlen($special_credit_name) > 108) {
		            $y += 25;    
		        }elseif (strlen($special_credit_name) > 216) {
		            $y += 35;    
		        }elseif (strlen($special_credit_name) > 324) {
		            $y += 45;    
		        }
			}

			if ( isset($extra_name) && !empty($extra_name)) {
				$lng = count($extra_name);
	            for ($i=0; $i < $lng; $i++) { 
	            	$y = ($y == 65 ? $y = 65 : $y);
	            	$line = pdf_format($l_num, $extra_name[$i], $extra[$i], $extra_val[$i], $extra_val_total[$i]);
	                $size = $pdf->addLine( $y, $line );
	                $l_num++;

	                if (strlen($extra_name[$i]) < 108) {
	                    $y += 10;    
	                }elseif (strlen($extra_name[$i]) > 108) {
	                    $y += 25;    
	                }elseif (strlen($extra_name[$i]) > 216) {
	                    $y += 35;    
	                }elseif (strlen($extra_name[$i]) > 324) {
	                    $y += 45;    
	                }

	                if ($l_num == 19) {
						$y = 65;
						$pdf->AddPage();
					}
	            }
			}

			if ($aNewsData['account_detail'] == 'N' && $cc_charge_val_total > 0) {
				$y = ($y == 65 ? $y = 65 : $y);
				$line = pdf_format($l_num, $cc_charge_name, '', $cc_charge_val, $cc_charge_val_total);
				$size = $pdf->addLine($y, $line);
				$l_num++;
				$y += 10;
				
				if ($l_num == 19) {
				$y=8;
				$pdf->AddPage();
				/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 33);
				$pdf->addCols($cols);
				$pdf->addLineFormat($cols);*/
			}
		}

		if (!empty($credit_roll_over_total)) {
			$y = ($y == 65 ? $y = 65 : $y);
			$line = pdf_format($l_num, $credit_roll_over_name, '', $credit_roll_over_val, $credit_roll_over_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
		}

		$alredInvoiced = empty($data['id_invoice']) ? '' : $data['id_invoice'];
		if ($alredInvoiced != '') {
			$created_at = $this->get_pdf_date($alredInvoiced);
			$sPdfDate = str_replace('-', '_', $created_at); // date("Y_m_d");
		} else {
			$sPdfDate = date("Y_m_d");
		}

		$pdf->total("$" . number_format($nTotalKey, 2));
		if (isset($special_creadit_val) && $special_creadit_val > 0) {
			$pdf->credit("-$" . $special_creadit_val);
		}
		

		$sPdfData = $aNewsData['consultant_number'] . "_" . $sPdfDate . ".pdf";
		$filename = "assets/uploads/billing/" . $sPdfData;
		$pdf->Output($filename, 'F');

		$invoice_name = $this->get_invoice_name($id_newsletter);

		if (!empty($invoice_name)) {
			$pdf_old = explode('_', $invoice_name['invoice_name']);
		}
		
		$aCurrentDate = $this->get_current_date($id_newsletter);
		$Pstatus = 'P';
		$BAL = (GetTotalDue($id_newsletter) - GetBalance($id_newsletter)); 

		if (empty($data['id_invoice'])) {
			if (empty($credit_roll_over_total)) {
				if ($nTotalKey > 0) {
					if ($BAL < 0) {
						if (abs($BAL) >= $nTotalKey) {
							$paid_amount = 0;
							$due = 0;
							$Rbal = $nTotalKey - abs($BAL);
							$Pstatus = 'P';
							SetBalance($id_newsletter, $Rbal);
						}else {
							$paid_amount = abs($BAL);
							$due = number_format(($nTotalKey - $paid_amount),2);
							$Pstatus = 'R';
							SetBalance($id_newsletter,0);
						}
					}else {
						$paid_amount = 0;
						$due = $nTotalKey;
						$Pstatus = 'P';
					}	
				} else {
					$paid_amount = $nTotalKey;
					$due = 0;
					$Pstatus = 'P';
					$Rbal = abs($nTotalKey) + $BAL;
					SetBalance($id_newsletter, $Rbal);
				}
			}else {
				$paid_amount = 0;
				$due = $nTotalKey;
				$Pstatus = 'P';
			}
		}
		
		
		if (!empty($aCurrentDate)) {
			$UpdateDUE = $nTotalKey;
		} else {
			if (isset($data['id_invoice']) && $data['id_invoice'] != '') {
				$aTotalPaidData = $this->get_total_paid($data['id_invoice']);
				$UpdateDUE = $aTotalPaidData['total'] -  $aTotalPaidData['total_paid'];	
			}else{
				$UpdateDUE = $nTotalKey;
			}
		}

		$Pstatus = ($UpdateDUE > 0) ? 'R' : 'S';
		
		$details = array('data'=>$sSerialData, 'total'=>$nTotalKey, 'invoice_date' =>$sDate,  'due_amount'=>$UpdateDUE, 'payment_status'=>$Pstatus, 'invoice_name'=>$sPdfData, 'create_by'=>$create_by, 'updated_at' =>$sDate);

		if (isset($data['id_invoice']) && $data['id_invoice'] != '') {		
			if ($pdf_old[0] == $aNewsData['consultant_number']) {
				$filename = './assets/uploads/billing/'.$invoice_name['invoice_name'];
        		@unlink($filename);
			}
			
			$pdf->Output($filename, 'F');
			return $this->update_pdf_invoice($details, $data['id_invoice']);
		} else {
			if (!empty($aCurrentDate)) {
				if ($pdf_old[0] == $aNewsData['consultant_number']) {
					$filename = './assets/uploads/billing/'.$sPdfData;
        			@unlink($filename);
				}
				$pdf->Output($filename, 'F');
				$details['total_paid'] = $paid_amount;
				$details['id_newsletter'] = $id_newsletter;
				$details['consultant_number'] = $aNewsData['consultant_number'];
				return $this->update_pdf_invoice($details, $aCurrentDate['id_invoice']);
			} else {
				$pdf->Output($filename, 'F');
				$details['total_paid'] = $paid_amount;
				$details['id_newsletter'] = $id_newsletter;
				$details['consultant_number'] = $aNewsData['consultant_number'];
				$details['created_at'] = $sDate;
				return $this->insert_pdf_invoice($details);
			}
		}
	}

	function get_total_paid($id_invoice){
		$this->db->select('total, total_paid');
		$this->db->from('invoices');
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->get()->row_array();
	}

	function update_pdf_invoice($data, $id_invoice){
		$this->db->set($data);
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->update('invoices');
	}

	function insert_pdf_invoice($details){
		return $this->db->insert('invoices', $details);
	}


	function getTotal($id_invoice){
		$this->db->select('total,due_amount,payment_status,total_paid,id_newsletter');
		$this->db->where('id_invoice', $id_invoice);
		$this->db->from('invoices');
		return $this->db->get()->row_array();
	}

	
	function update_invoice($nFinalTotal, $fTotalpaid, $sPayStatus, $amount="", $id_invoice){
		$data = array('due_amount'=>$nFinalTotal, 'total_paid'=>$fTotalpaid, 'payment_status'=>$sPayStatus, 'payment_date'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));

		if (!empty($amount)) {
			$data['last_paid']=$amount;
		}

		$this->db->where('id_invoice', $id_invoice);
		return $this->db->update('invoices',$data);
	}

	function get_invoice_count($id_newsletter){
		$this->db->select('COUNT(id_invoice) as cont');
		$this->db->where('id_newsletter', $id_newsletter);
		return $this->db->get('invoices')->row_array();
	}

	function get_old_invoice($id_newsletter){
		$this->db->select("id_invoice, total, due_amount, payment_status, total_paid, id_newsletter");
		$this->db->from('invoices');
		$this->db->where(array('payment_status !='=>'S', 'id_newsletter'=>$id_newsletter));
		$this->db->order_by('created_at', 'ASC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function update_due_amount($nDua, $fTotalpaid, $sPayStatus, $reaming, $id_invoice){
		$data = array('due_amount'=>number_format($nDua, 2), 'total_paid'=>$fTotalpaid, 'payment_status'=>$sPayStatus, 'paid_return'=>$reaming, 'return_date'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->update('invoices',$data);
	}

	function get_invoice_mail($id_newsletter, $id_invoice) {
		$this->db->select('i.invoice_name, i.created_at as create_invoice_at, n.name, n.email, n.newsletters_design');
		$this->db->from('invoices AS i');
		$this->db->join('newsletter_general_info AS n', 'i.id_newsletter = n.id_newsletter', 'left');
		$this->db->where(array('i.id_newsletter'=>$id_newsletter, 'i.id_invoice'=>$id_invoice));
		return $this->db->get()->row_array();
	}

	function save_invoice_mail($id_newsletter, $id_invoice, $e_data){
		$data = array('id_newsletter'=>$id_newsletter, 'id_invoice'=>$id_invoice, 'content'=>$e_data);
		return $this->db->insert('invoice_mail', $data);
	}

	function get_invoice_details($months){
		$this->db->select('id_invoice, id_newsletter, invoice_name');
		$this->db->from('invoices');
		$this->db->where_in('MONTH(invoice_date)', $months);
		return $this->db->get()->result_array();
	}

	function delete_invoice($months, $id_invoice){
		$this->db->where_in('MONTH(invoice_date)', $months);
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->delete('invoices');
	}

	function get_due_amount($id_newsletter){
		$this->db->select('due_amount');
		$this->db->from('invoices');
        $this->db->where('id_newsletter', $id_newsletter);
        $this->db->order_by('created_at','DESC');
        $this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function credit_payment_clients() {
		$this->db->select('ng.name, ng.email, ng.consultant_number, i.total, i.total_paid, np.billing_alert, np.cc_number, np.cc_code, np.cc_expir_date, np.cc_zip, i.id_invoice, i.created_at as increated_at');
	    $this->db->from('newsletter_general_info AS ng');
	    $this->db->join('newsletter_packaging AS np', 'np.id_newsletter=ng.id_newsletter', 'left');
	    $this->db->join('invoices AS i', 'i.id_newsletter = ng.id_newsletter', 'left');
	    $this->db->where(array('np.account_detail' => 'N', 'ng.deleted' => '0', 'i.total_paid <='=>'i.total', 'i.due_amount >'=>'0'));
	    $this->db->query('SET SQL_BIG_SELECTS=1');
	    return $this->db->get()->result_array();
	}

	function get_invoice_data($id_invoice){
		$this->db->select('id_newsletter, total, total_paid');
		$this->db->from('invoices');
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->get()->row_array();
	}

	function make_payment_invoice($id_invoice, $total_paid, $total_due, $status){
		$data = array();
	    $data['total_paid'] = $total_paid;
	    $data['due_amount'] = $total_due;     
    	$data['payment_status'] = $status;
       	$data['payment_date'] = date('Y-m-d');
       	$data['updated_at'] = date('Y-m-d');
       	$this->db->where('id_invoice', $id_invoice);
       	return $this->db->update('invoices', $data);
	}

	function edit_cancel_payment($id_invoice, $status){
		$data = array();
    	$data['payment_status'] = $status;
       	$data['payment_date'] = date('Y-m-d');
       	$data['updated_at'] = date('Y-m-d');
       	$this->db->where('id_invoice', $id_invoice);
       	return $this->db->update('invoices', $data);
	}

	function get_invoice_mail_data($id_newsletters){
		$date = date("m-d-y");

		$this->db->select('i.invoice_name, i.id_invoice, i.created_at, ng.name, ng.email, ng.newsletters_design');
		$this->db->from('invoices AS i');
		$this->db->join('newsletter_general_info AS ng', 'ng.id_newsletter=i.id_newsletter', 'left');
		$this->db->where(array('ng.deleted'=>'0', 'i.payment_status'=>'R', 'i.invoice_status'=>'0'));
		$this->db->where("(ng.contract_update_date ='' OR ng.contract_update_date >".$date.")", NULL, FALSE);

		if (!empty($id_newsletters)) {
			$this->db->where_in('i.id_newsletter', $id_newsletters, FALSE);
		}
		
		return $this->db->get()->result_array();
	}
	
	function update_invoice_status($invoice_status, $id_invoice){
		$data = array('invoice_status'=>$invoice_status, 'updated_at'=>date("Y-m-d"));
		$this->db->set($data);
		$this->db->where('id_invoice', $id_invoice);
		return $this->db->update('invoices');
	}

	function getUnsbClients(){
       	$this->db->select('n.id_newsletter, n.updated_by, n.first_bill_date, n.cell_number, n.email, n.consultant_number, n.name, i.total,i.total_paid');
       	$this->db->from('newsletter_general_info as n');
       	$this->db->join('invoices i', 'n.id_newsletter = i.id_newsletter', 'INNER');
       	$this->db->where('n.deleted', '1');
       	$this->db->order_by('n.created_at', 'DESC');
       	return $this->db->get()->result_array();
	}

}
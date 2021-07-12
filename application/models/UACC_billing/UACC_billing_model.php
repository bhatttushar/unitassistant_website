<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class UACC_billing_Model extends CI_Model {

	function get_invoice_status_rows($payment_status){
		return $this->db->get_where('cc_invoices', array('deleted'=>'0', 'activated'=>'1', 'payment_status'=>$payment_status))->num_rows();

		$this->db->select('id_cc_invoice');
		$this->db->from('cc_invoices');

		if (empty($payment_status)) {
			$this->db->where(array('deleted'=>'0', 'activated'=>'1'));
		}else{
			$this->db->where(array('deleted'=>'0', 'activated'=>'1', 'payment_status'=>$payment_status));
		}

		return $this->db->get()->num_rows();
	}

	function uacc_billing_clients($row='', $rowperpage='', $columnName='', $columnSortOrder='', $searchValue=''){
		$sAndWhere  = " 1 = 1";
	    $sAndWhere .= " AND deleted = '0'";
	    $sAndWhere .= " AND cc = 'Y'";
	    $sAndWhere .= " AND (digital_biz_card != '0' OR inc_tbc != '0')";
	    $sAndWhere .= " AND cc_chargefree = '0'";

		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_invoices');
		$this->db->where('deleted', '0');
		$id_cc_newsletters = $this->db->get()->result_array();

		$searchQuery = " 1=1";
		if($searchValue != ''){
		    $searchQuery .= " AND (name like '%".$searchValue."%' or email like '%".$searchValue."%' or consultant_number like'%".$searchValue."%' or cell_number like'%".$searchValue."%') ";
		}

		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_newsletters');
		$this->db->where($sAndWhere);
		$totalRecords = $this->db->get()->num_rows();

		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_newsletters');
		$this->db->where($searchQuery);
		$this->db->where($sAndWhere);
		$totalRecordwithFilter = $this->db->get()->num_rows();

		if ($columnName == 'id_cc_newsletter') {
			if ($columnSortOrder == 'asc') {
				$columnSortOrder = 'DESC';
			}
			$columnName = 'created_at';
		}

		if ($columnName == 'account_balance') {
			$this->db->select('(SUM(i.total) - SUM(i.total_paid)) as account_balance, n.id_cc_newsletter, n.m_bill_date, n.name, n.cell_number, n.email, n.consultant_number, n.contract_update_date');
			$this->db->from('cc_newsletters AS n');
			$this->db->join('cc_invoices AS i', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
			$this->db->where($searchQuery);
			$this->db->where(array('n.deleted'=>'0', 'i.deleted'=>'0', 'i.total'=>'0'));
			$this->db->group_by('i.id_cc_newsletter');
			$this->db->order_by($columnName, $columnSortOrder);
			//$this->db->limit($rowperpage, $row);
		}else {
			$this->db->select('contract_update_date,id_cc_newsletter, m_bill_date, name,cell_number,email,consultant_number');
			$this->db->from('cc_newsletters');			
			$this->db->where($searchQuery);
			$this->db->where('deleted', '0');
			$this->db->order_by($columnName, $columnSortOrder);
			//$this->db->limit($rowperpage, $row);
		}
		
		$user_data = $this->db->get()->result_array();
		return array('user_data'=>$user_data, 'id_cc_newsletters'=>$id_cc_newsletters, 'totalRecordFilter'=>$totalRecordwithFilter, 'totalRecords'=>$totalRecords);
	}

	function get_uacc_billing_history($row='', $rowperpage='', $columnName='', $columnSortOrder='', $searchValue=''){
		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_invoices');
		$this->db->where('deleted', '0');
		$id_cc_newsletters = $this->db->get()->result_array();

		$searchQuery = " 1 = 1";
		if($searchValue != ''){
		    $searchQuery .= " AND (name like '%".$searchValue."%' or email like '%".$searchValue."%' or consultant_number like'%".$searchValue."%' or cell_number like'%".$searchValue."%') ";
		}

		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_newsletters');
		$this->db->where('deleted', '0');
		$totalRecords = $this->db->get()->num_rows();

		$this->db->select('id_cc_newsletter');
		$this->db->from('cc_newsletters');
		$this->db->where($searchQuery);
		$this->db->where('deleted', '0');
		$totalRecordwithFilter = $this->db->get()->num_rows();

		if ($columnName == 'id_cc_newsletter') {
			if ($columnSortOrder == 'asc') {
				$columnSortOrder = 'DESC';
			}
			$columnName = 'created_at';
		}

		if ($columnName == 'account_balance') {
			$this->db->select('(SUM(i.total) - SUM(i.total_paid)) as account_balance, n.id_cc_newsletter, n.name, n.email, n.consultant_number');
			$this->db->from('cc_newsletters AS n');
			$this->db->join('cc_invoices AS i', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
			$this->db->where($searchQuery);
			$this->db->where('n.deleted', '0');
			$this->db->group_by('i.id_cc_newsletter');
			$this->db->order_by($columnName, $columnSortOrder);
			//$this->db->limit($rowperpage, $row);
		}else {
			$this->db->select('id_cc_newsletter, name, email, consultant_number');
			$this->db->from('cc_newsletters');
			$this->db->where($searchQuery);
			$this->db->where('deleted', '0');
			$this->db->order_by($columnName, $columnSortOrder);
			//$this->db->limit($rowperpage, $row);
		}
		$user_data = $this->db->get()->result_array();
		return array('user_data'=>$user_data, 'id_cc_newsletters'=>$id_cc_newsletters, 'totalRecordFilter'=>$totalRecordwithFilter, 'totalRecords'=>$totalRecords);
	}

	function get_single_invoice($id_cc_invoice){
		$this->db->select('i.*, n.name,n.email,n.misc_charge, n.digital_biz_card, n.special_credit');
		$this->db->from('cc_invoices AS i');
		$this->db->join('cc_newsletters AS n', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
		$this->db->where('i.id_cc_invoice', $id_cc_invoice);
		return $this->db->get()->row_array();
	}

	function search_keyword($keyword) {
	   	$this->db->select('n.name, n.id_cc_newsletter, n.email');
       	$this->db->from('cc_newsletters AS n');
       	$this->db->join('users as u', 'n.id_user = u.id_user', 'left');
       	$this->db->where(array('n.deleted'=>'0', 'n.cc_chargefree'=>'0'));
       	$this->db->group_start();
       	$this->db->where('n.digital_biz_card !=', '0');
       	$this->db->or_where('n.inc_tbc !=', '0');
       	$this->db->group_end();
       	$this->db->like('n.name', $keyword, 'both');
       	$this->db->order_by('n.name', 'ASC');
       	$this->db->limit(5);
       	return $this->db->get()->result_array();
	}

	function Searchname($id_cc_newsletter) {
		$this->db->select('email,pmt_type,misc_charge,prospect_system,digital_biz_card,inc_tbc,special_credit');
		$this->db->from('cc_newsletters');
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->get()->row_array();
	}

	function GetInvoiceData($id_cc_newsletter) {
		$this->db->select('id_cc_newsletter, name, digital_biz_card, prospect_system, cv_prospect, misc_charge, billing_alert, inc_tbc, special_credit');
		$this->db->from('cc_newsletters');
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		$invoiceData = $this->db->get()->row_array();
		return GetUACCInvoiceTable($invoiceData);
	}

	function GetAllInvoiceData($id_cc_newsletter) {
		$this->db->select('id_cc_newsletter, name, digital_biz_card, prospect_system, cv_prospect, misc_charge, billing_alert, inc_tbc, special_credit');
		$this->db->from('cc_newsletters');
		$id_cc_newsletters = implode(',', $id_cc_newsletter);
		$this->db->where_in('id_cc_newsletter', $id_cc_newsletters, FALSE);
		return $this->db->get()->result_array();
	}

	function get_news_data($id_cc_newsletter){
		$this->db->select('consultant_number');
		$this->db->from('cc_newsletters');
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->get()->row_array();
	}

	function get_invoice_last_id($id_cc_newsletter){
		$this->db->select('id_cc_invoice');
		$this->db->from('cc_invoices');
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->get()->row_array();
	}

	function get_max_invoice_id(){
		$this->db->select('MAX(id_cc_invoice) AS max_id_cc_invoice');
		$this->db->from('cc_invoices');
		return $this->db->get()->row()->max_id_cc_invoice;
	}

	function get_pdf_date($alredInvoiced){
		$this->db->select('created_at');
		$this->db->from('cc_invoices');
		$this->db->where('id_cc_invoice', $alredInvoiced);
		return $this->db->get()->row()->created_at;
	}

	function get_invoice_name($id_cc_newsletter){
		$this->db->select('invoice_name');
		$this->db->from('cc_invoices');
		$this->db->where(array('id_cc_newsletter'=>$id_cc_newsletter, 'payment_status !='=>'S'));
		return $this->db->get()->row_array();
	}

	function get_current_date($id_cc_newsletter){

		//NEEDED
		$sAndWhere = " 1 = 1";
		$sAndWhere .= " AND YEAR(created_at) = YEAR(CURRENT_DATE()) ";
		$sAndWhere .= " AND MONTH(created_at) = MONTH(CURRENT_DATE()) ";
		$sAndWhere .= " AND id_cc_newsletter=".$id_cc_newsletter;
		$sAndWhere .= " AND payment_status != 'S' ";
		$sAndWhere .= " AND deleted ='0'";

		$this->db->select('id_cc_invoice');
		$this->db->from('cc_invoices');
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
		$create_by = '0';

		$aNewsData = $this->get_news_data($id_cc_newsletter);
		$aInvoiceLastId = $this->get_invoice_last_id($id_cc_newsletter);

		if (empty($aInvoiceLastId)) {
			$aLastInvoiceId = $this->get_max_invoice_id();
			$nLastInsertId = $aLastInvoiceId + 1;
		} else {
			$nLastInsertId = $aInvoiceLastId['id_cc_invoice'];
			
		}

		include APPPATH."/libraries/pdf/invoice.php"; 
		$pdf = new PDF_Invoice('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->Image('./assets/images/UACC_logo.png', 4, 4, 100);
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
		$y = 65;

		if (isset($customer_comm_name) && !empty($customer_comm_name)) {
			$line = pdf_format($l_num, $customer_comm_name, $customer_communication, $customer_comm_val, $customer_comm_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
		}

		if (isset($prospect_system_name) && !empty($prospect_system_name)) {
			$line = pdf_format($l_num, $prospect_system_name, $prospect_system, $prospect_system_val, $prospect_system_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
		}

		if (isset($cv_prospect_name) && !empty($cv_prospect_name)) {
			$line = pdf_format($l_num, $cv_prospect_name, $cv_prospect, $cv_prospect_val, $cv_prospect_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
		}

		if (isset($misc_charge_name) && !empty($misc_charge_name)) {
			$line = pdf_format($l_num, $misc_charge_name, $misc_charge, $misc_charge_val, $misc_charge_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
		}

		if (isset($digital_biz_card_name) && !empty($digital_biz_card_name)) {
			$line=pdf_format($l_num, $digital_biz_card_name, $digital_biz_card, $digital_biz_card_val, $digital_biz_card_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;
		}

		if (isset($special_credit_name) && !empty($special_credit_name)) {
			$line=pdf_format($l_num, $special_credit_name, $special_credit, $special_credit_val, $special_credit_val_total);
			$size = $pdf->addLine($y, $line);
			$l_num++;
			$y += 10;

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
            }
		}

		$alredInvoiced = empty($data['id_cc_invoice']) ? '' : $data['id_cc_invoice'];
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
		$filename = "assets/uploads/uacc-billing/" . $sPdfData;
		$pdf->Output($filename, 'F');

		$invoice_name = $this->get_invoice_name($id_cc_newsletter);

		if (!empty($invoice_name)) {
			$pdf_old = explode('_', $invoice_name['invoice_name']);
		}
		
		
		$aCurrentDate = $this->get_current_date($id_cc_newsletter);
		$Pstatus = 'P';

		$BAL = (GetCCTotalDue($id_cc_newsletter) - GetCCBalance($id_cc_newsletter)); 
		
		if($nTotalKey > 0) {
            if($BAL >= $nTotalKey) {
               $paid_amount = $nTotalKey;
               $due = 0;
               $Rbal = $nTotalKey - $BAL;
               $Pstatus = 'S';
               /*set_UACC_balance($id_cc_newsletter, $Rbal);*/
            }elseif($BAL == 0){
                $paid_amount = 0;
                $due = $nTotalKey;
            }else {
                $paid_amount = $BAL;
                $due = $nTotalKey - $paid_amount;
                /*set_UACC_balance($id_cc_newsletter, 0);*/
            }    
        }else {
           $paid_amount = $nTotalKey;
           $due = 0;
           $Pstatus = 'S';
           $Rbal = abs($nTotalKey) + $BAL;
           /*set_UACC_balance($id_cc_newsletter, $Rbal);*/
        }

		if (empty($aCurrentDate)) {
			$UpdateDUE = $nTotalKey;
		} else {
			if (isset($data['id_cc_invoice']) && $data['id_cc_invoice'] != '') {
				$aTotalPaidData = $this->get_total_paid($data['id_cc_invoice']);
				$UpdateDUE = $aTotalPaidData['total'] -  $aTotalPaidData['total_paid'];	
			}else{
				$UpdateDUE = $nTotalKey;
			}
		}

		$details = array( 'data' => $sSerialData, 'total' => $nTotalKey, 'due_amount'=>$UpdateDUE,  'invoice_name' =>$sPdfData, 'create_by' => $create_by, 'updated_at' =>$sDate );

		if (isset($data['id_cc_invoice']) && $data['id_cc_invoice'] != '') {		
			if ($pdf_old[0] == $aNewsData['consultant_number']) {
				$filename = './assets/uploads/uacc-billing/'.$invoice_name['invoice_name'];
        		unlink($filename);
			}

			$Pstatus = ($UpdateDUE > 0) ? 'R' : 'S';
			$pdf->Output($filename, 'F');

			$this->update_pdf_invoice($details, $data['id_cc_invoice']);

		} else {
			if (!empty($aCurrentDate)) {
				if ($pdf_old[0] == $aNewsData['consultant_number']) {
					$filename = './assets/uploads/uacc-billing/'.$sPdfData;
        			unlink($filename);
				}
				$pdf->Output($filename, 'F');

				$details['id_cc_newsletter']=$id_cc_newsletter;
				$details['consultant_number']=$aNewsData['consultant_number'];
				$details['payment_status']=$Pstatus;
				$this->update_pdf_invoice($details, $aCurrentDate['id_cc_invoice']);
			} else {
				$pdf->Output($filename, 'F');
				$details['id_cc_newsletter']=$id_cc_newsletter;
				$details['consultant_number']=$aNewsData['consultant_number'];
				$details['invoice_date']=$sDate;
				$details['total_paid']=$paid_amount;
				$details['due_amount']=$due;
				$details['payment_status']=$Pstatus;
				$details['created_at']=$sDate;
				$this->insert_pdf_invoice($details);
			}

		}

	}

	function get_total_paid($id_cc_invoice){
		$this->db->select('total, total_paid');
		$this->db->from('cc_invoices');
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->get()->row_array();
	}

	function update_pdf_invoice($data, $id_cc_invoice){
		$this->db->set($data);
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->update('cc_invoices');
	}

	function insert_pdf_invoice($details){
		return $this->db->insert('cc_invoices', $details);
	}

	function GetInvoices($id_cc_newsletter) {
		if(!empty($id_cc_newsletter)) {
			$this->db->select('i.*, n.name');
			$this->db->from('cc_invoices AS i');
			$this->db->join('cc_newsletters As n', 'i.id_cc_newsletter=n.id_cc_newsletter', 'left');
			$this->db->where( array('i.id_cc_newsletter'=>$id_cc_newsletter, 'i.deleted'=>'0'));
			$this->db->order_by('i.invoice_date', 'DESC');
		}else{
			$this->db->select('*');
			$this->db->from('cc_invoices');
		}
		return $this->db->get()->result_array();
	}

	function GetInvoicesHistory($id_cc_newsletter) {
		if(!empty($id_cc_newsletter)) {
			$this->db->select('i.invoice_name, i.invoice_date, i.total, i.total_paid, i.invoice_status, i.payment_status, n.name');
			$this->db->from('cc_invoices AS i');
			$this->db->join('cc_newsletters As n', 'i.id_cc_newsletter=n.id_cc_newsletter', 'left');
			$this->db->where( array('i.id_cc_newsletter'=>$id_cc_newsletter, 'i.deleted'=>'0'));
			$this->db->order_by('i.invoice_date', 'DESC');
		}else{
			$this->db->select('*');
			$this->db->from('cc_invoices');
		}
		return $this->db->get()->result_array();
	}

	function getTotal($id_cc_invoice){
		$this->db->select('total,due_amount,payment_status,total_paid,id_cc_newsletter');
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		$this->db->from('cc_invoices');
		return $this->db->get()->row_array();
	}

	function get_invoice_count($id_cc_newsletter){
		$this->db->select('COUNT(id_cc_invoice) as cont');
		$this->db->where('id_cc_newsletter', $id_cc_newsletter);
		return $this->db->get('cc_invoices')->row_array();
	}

	function get_old_invoice($id_cc_newsletter){
		$this->db->select("id_cc_invoice, total, due_amount, payment_status, total_paid, id_cc_newsletter");
		$this->db->from('cc_invoices');
		$this->db->where(array('payment_status !='=>'S', 'id_cc_newsletter'=>$id_cc_newsletter));
		$this->db->order_by('created_at', 'ASC');
		$this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function update_invoice($nFinalTotal, $fTotalpaid, $sPayStatus, $amount="", $id_cc_invoice){
		$data = array('due_amount'=>$nFinalTotal, 'total_paid'=>$fTotalpaid, 'payment_status'=>$sPayStatus, 'payment_date'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));

		if (!empty($amount)) {
			$data['last_paid']=$amount;
		}

		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->update('cc_invoices',$data);
	}

	function update_due_amount($nDua, $fTotalpaid, $sPayStatus, $reaming, $id_cc_invoice){
		$data = array('due_amount'=>number_format($nDua, 2), 'total_paid'=>$fTotalpaid, 'payment_status'=>$sPayStatus, 'paid_return'=>$reaming, 'return_date'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d'));
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->update('cc_invoices',$data);
	}

	function delete_invoice_pdf($id_cc_invoice){
		$this->db->select('id_cc_newsletter, invoice_name');
		$this->db->from('cc_invoices');
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		$invoice = $this->db->get()->row_array();

		$this->db->select('SUM(due_amount) As due');
		$this->db->from('cc_invoices');
		$this->db->where(array('id_cc_newsletter'=>$invoice['id_cc_newsletter'], 'id_cc_invoice'=>$id_cc_invoice));
		$due_balance = $this->db->get()->row()->due;

		if ($due_balance < 0) {
			set_UACC_balance($invoice['id_cc_newsletter'], abs($due_balance));
		}

		$filename = './assets/uploads/uacc-billing/'.$invoice['invoice_name'];
        unlink($filename);

        $this->db->where('id_cc_invoice', $id_cc_invoice);
        return $this->db->delete('cc_invoices');
	}

	function get_invoice_mail($id_cc_newsletter, $id_cc_invoice) {
		$this->db->select('i.invoice_name, i.created_at as create_invoice_at, n.name, n.email, n.cc_newsletter');
		$this->db->from('cc_invoices AS i');
		$this->db->join('cc_newsletters AS n', 'i.id_cc_newsletter = n.id_cc_newsletter', 'left');
		$this->db->where(array('i.id_cc_newsletter'=>$id_cc_newsletter, 'i.id_cc_invoice'=>$id_cc_invoice));
		return $this->db->get()->row_array();
	}

	function save_invoice_mail($id_cc_newsletter, $id_cc_invoice, $e_data){
		$data = array('id_cc_newsletter'=>$id_cc_newsletter, 'id_cc_invoice'=>$id_cc_invoice, 'content'=>$e_data, 'created_at'=> date('Y-m-d H:i:s') );
		return $this->db->insert('cc_invoice_mail', $data);
	}

	function get_invoice_details($months){
		$this->db->select('id_cc_invoice, id_cc_newsletter, invoice_name');
		$this->db->from('cc_invoices');
		$this->db->where_in('MONTH(invoice_date)', $months);
		return $this->db->get()->result_array();
	}

	function delete_invoice($months, $id_cc_invoice){
		$this->db->where_in('MONTH(invoice_date)', $months);
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->delete('cc_invoices');
	}

	function get_due_amount($id_cc_newsletter){
		$this->db->select('due_amount');
		$this->db->from('cc_invoices');
        $this->db->where('id_cc_newsletter', $id_cc_newsletter);
        $this->db->order_by('created_at','DESC');
        $this->db->limit(1);
		return $this->db->get()->row_array();
	}

	function get_invoice_mail_data($id_cc_newsletters){
		$date = date("m-d-y");
		$this->db->select('i.invoice_name, i.id_cc_invoice, i.created_at, n.name, n.email, n.cc_newsletter');
		$this->db->from('cc_invoices AS i');
		$this->db->join('cc_newsletters AS n', 'n.id_cc_newsletter=i.id_cc_newsletter', 'left');
		$this->db->where(array('n.deleted'=>'0', 'i.payment_status'=>'P', 'i.invoice_status'=>'0'));
		$this->db->where("(n.contract_update_date ='' OR n.contract_update_date >".$date.")", NULL, FALSE);
		if (!empty($id_cc_newsletters)) {
			$this->db->where_in('i.id_cc_newsletter', $id_cc_newsletters, FALSE);
		}
		return $this->db->get()->result_array();
	}

	function update_invoice_status($invoice_status, $id_cc_invoice){
		$data = array('invoice_status'=>$invoice_status, 'updated_at'=>date("Y-m-d"));
		$this->db->set($data);
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->update('cc_invoices');
	}

	
	function credit_payment_clients() {
		$this->db->select('n.name, n.email, n.consultant_number, n.cc_number, n.cc_code, n.cc_expir_date, n.cc_zip, i.id_cc_invoice, i.total, i.total_paid, i.invoice_date');
	    $this->db->from('cc_newsletters AS n');
	    $this->db->join('cc_invoices AS i', 'i.id_cc_newsletter = n.id_cc_newsletter', 'left');
	    $this->db->where(array('n.pmt_type'=>'CC', 'n.deleted'=>'0', 'i.payment_status !='=>'S'));
	    return $this->db->get()->result_array();
	}

	function get_invoice_data($id_cc_invoice){
		$this->db->select('id_cc_newsletter, total, total_paid');
		$this->db->from('cc_invoices');
		$this->db->where('id_cc_invoice', $id_cc_invoice);
		return $this->db->get()->row_array();
	}

	function make_payment_invoice($id_cc_invoice, $total_paid, $total_due, $status){
		$data = array();
		$data['total_paid'] = $total_paid;
		$data['due_amount'] = $total_due;	           
    	$data['payment_status'] = $status;
       	$data['payment_date'] = date('Y-m-d');
       	$data['updated_at'] = date('Y-m-d');
       	$this->db->where('id_cc_invoice', $id_cc_invoice);
       	return $this->db->update('cc_invoices', $data);
	}

	function edit_cancel_payment($id_cc_invoice, $status){
		$data = array();
    	$data['payment_status'] = $status;
       	$data['payment_date'] = date('Y-m-d');
       	$data['updated_at'] = date('Y-m-d');
       	$this->db->where('id_cc_invoice', $id_cc_invoice);
       	return $this->db->update('cc_invoices', $data);
	}

	/*function getUnsbClients(){
       	$this->db->select('n.id_cc_newsletter, n.updated_by, n.first_bill_date, n.cell_number, n.email, n.consultant_number, n.name, i.total,i.total_paid');
       	$this->db->from('cc_newsletters as n');
       	$this->db->join('cc_invoices i', 'n.id_cc_newsletter = i.id_cc_newsletter', 'INNER');
       	$this->db->where('n.deleted', '1');
       	$this->db->order_by('n.created_at', 'DESC');
       	return $this->db->get()->result_array();
	}*/

}
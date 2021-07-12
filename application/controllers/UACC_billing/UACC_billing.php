<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class UACC_billing extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UACC_billing/UACC_billing_model');
		$this->load->helper('UACC/uacc_billing_helper');
		$this->load->library('excel');
		isAdminLoggedIn();
	}

	public function __destruct() {
	   $this->load->library('excel');
	}

	public function index() {
		$this->global['pageTitle'] = 'UACC Billing Dashboard';
		$data['invoices'] = $this->UACC_billing_model->get_invoice_status_rows('');
		$data['pending'] = $this->UACC_billing_model->get_invoice_status_rows('P');
		$data['paid'] = $this->UACC_billing_model->get_invoice_status_rows('S');
		$data['cancel'] = $this->UACC_billing_model->get_invoice_status_rows('C');
		$data['remaining'] = $this->UACC_billing_model->get_invoice_status_rows('R');
		UACC_billing_views("UACC_billing/dashboard", $this->global,$data, NULL);
	}

	function uacc_clients() {
		$this->global['pageTitle'] = 'UACC Clients List';
		$details['data']=$this->UACC_billing_model->uacc_billing_clients();

		$aNewsletterIdEx = array();
		foreach ($details['data']['id_cc_newsletters'] as $key => $value) {
			$aNewsletterIdEx[] = $value['id_cc_newsletter'];
		}
		$details['aNewsletterIdEx'] = $aNewsletterIdEx;
		UACC_billing_views("UACC_billing/clients", $this->global, $details, NULL);
	}

	/*function AjaxData(){
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value
		$val = $_POST['Records'];

		$details=$this->UACC_billing_model->$val($row, $rowperpage, $columnName, $columnSortOrder, $searchValue);

		$aNewsletterIdEx = array();
		foreach ($details['id_cc_newsletters'] as $key => $value) {
			$aNewsletterIdEx[] = $value['id_cc_newsletter'];
		}

		$data = array();
		$count = $row + 1;
		foreach ($details['user_data'] as $val) {
			$bal = GetCCBalance($val['id_cc_newsletter']);
			$due = GetCCTotalDue($val['id_cc_newsletter']);
			
			$class = in_array($val['id_cc_newsletter'],  $aNewsletterIdEx) ? 'btn-success' : 'btn-info disabled';

			$button = "<a class='btn ".$class."' href='".base_url('uacc-billing/invoices-list/'.$val['id_cc_newsletter'])."' title='View Invoices'>View Invoices</a>&nbsp;
					<a class='btn ".$class."' href='".base_url('uacc-billing/invoice-year-report/'.$val['id_cc_newsletter'])."' title='Year Report'>Year Report</a>&nbsp;
					<a href='".base_url('uacc-billing/reset-balance/'.$val['id_cc_newsletter'])."' class='btn btn-danger Sreset_bal'>Reset Balance</a>";

	        $b1 = '<input type="checkbox" name="create_all[]" value="'.$val['id_cc_newsletter'].'">';
			$data[] = array( 
		      "id_cc_newsletter"=>$count,
		      "create_all"=>$b1,
		      "m_bill_date"=>$val['m_bill_date'],
		      "name"=>$val['name'],
		      "cell_number"=>$val['cell_number'],
		      "email"=>$val['email'],
		      "consultant_number"=>$val['consultant_number'],
		      "account_balance"=>($due - $bal),
		      "button1"=>$button
		      
		   );
			$count++;
		}

		$response = array( "draw" => intval($draw), "query" => '', "iTotalRecords" => $details['totalRecordFilter'], "iTotalDisplayRecords" => $details['totalRecords'], "aaData" => $data);
		echo json_encode($response);
		exit();
	}*/

	function uacc_billing_history() {
		$this->global['pageTitle'] = 'UACC Billing History';
		$details['data']=$this->UACC_billing_model->get_uacc_billing_history();

		$aNewsletterIdEx = array();
		foreach ($details['data']['id_cc_newsletters'] as $key => $value) {
			$aNewsletterIdEx[] = $value['id_cc_newsletter'];
		}
		$details['aNewsletterIdEx'] = $aNewsletterIdEx;
		UACC_billing_views("UACC_billing/billing_history", $this->global, $details, NULL);
	}

	/*function billing_history_data(){
		$val = $this->input->post('Records');
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value

		$details=$this->UACC_billing_model->$val($row, $rowperpage, $columnName, $columnSortOrder, $searchValue);

		$aNewsletterIdEx = array();
		foreach ($details['id_cc_newsletters'] as $key => $value) {
			$aNewsletterIdEx[] = $value['id_cc_newsletter'];
		}

		$data = array();
		$count = $row + 1;
		foreach ($details['user_data'] as $val) {
			$bal = GetCCBalance($val['id_cc_newsletter']);
			$due = GetCCTotalDue($val['id_cc_newsletter']);
			
			$class = in_array($val['id_cc_newsletter'],  $aNewsletterIdEx) ? 'btn-success' : 'btn-info disabled';

			$button = "<a class='btn ".$class."' href='".base_url('uacc-billing/all-invoices-list/'.$val['id_cc_newsletter'])."' title='View Invoices'>View Invoices</a>";

	        $b1 = '<input type="checkbox" name="create_all[]" value="'.$val['id_cc_newsletter'].'">';
			$data[] = array( 
		      "id_cc_newsletter"=>$count,
	          "name"=>$val['name'],
	          "email"=>$val['email'],
	          "consultant_number"=>$val['consultant_number'],
	          "UACC_billing"=>UACC_BILLING,
	          "account_balance"=> ( $columnName == 'account_balance' ? number_format(($val['account_balance']), 2) : number_format(($due - $bal), 2)),
	          "action"=>$button
		   	);
			
			$count++;
		}

		$response = array( "draw" => intval($draw), "query" => '', "iTotalRecords" => $details['totalRecordFilter'], "iTotalDisplayRecords" => $details['totalRecords'], "aaData" => $data);
		echo json_encode($response);
		exit();
	}*/

	function create_UACC_invoice($id_cc_invoice="") {
		if (empty($id_cc_invoice)) {
			$data['invoice_data'] = "";
		}else{
			$data['invoice_data'] = $this->UACC_billing_model->get_single_invoice($id_cc_invoice);
		}
		
		$this->global['pageTitle'] = 'UACC Billing : Create Invoice';
		UACC_billing_views("UACC_billing/create_invoice", $this->global, $data, NULL);	
	}

	function search_UACC_keyword() {
		if ($this->input->post('keyword')) {
			$data = $this->UACC_billing_model->search_keyword($this->input->post('keyword'));
			if (!empty($data)) { ?>
	            <ul id="country-list">
	                <?php foreach ($data as $name) {?>
	                    <li onClick="nameSelect('<?php echo addslashes($name['name']); ?>',<?php echo $name['id_cc_newsletter']; ?>)"><?php echo $name['name']; ?></li>
	                <?php }?>
	            </ul>
	        <?php }
		}
	}

	function search_UACC_name($id_cc_newsletter = '') {
		if (!empty($id_cc_newsletter)) {
			$data=$this->UACC_billing_model->Searchname($id_cc_newsletter);
		}else{
			$data=$this->UACC_billing_model->Searchname($this->input->post('id_cc_newsletter'));
		}

		if ($data['digital_biz_card']=='1' && $data['inc_tbc'] == '1') {
            $Ttotal = UACC_BILLING + DIGITAL_BIZ_CARD;
        }elseif ($data['digital_biz_card']=='1' && $data['inc_tbc'] != '1') {
            $Ttotal = DIGITAL_BIZ_CARD;
        }elseif ($data['digital_biz_card'] !='1' && $data['inc_tbc'] == '1') {
            $Ttotal = UACC_BILLING;
        }elseif ($data['digital_biz_card'] !='1' && $data['inc_tbc'] != '1') {
            $Ttotal = UACC_BILLING;
        }else{
            $Ttotal = UACC_BILLING;    
        }

        if($data['misc_charge'] != '') {
            $Ttotal = number_format($Ttotal + $data['misc_charge'],2);
        }
        if($data['prospect_system'] == '1') {
            $Ttotal = number_format($Ttotal + PROSPECT_SYSTEM,2);   
        }
        if($data['special_credit'] != '0') {
            $Ttotal = number_format($Ttotal - $data['special_credit'],2);   
        }

        echo json_encode(array('email'=>$data['email'], 'total'=> $Ttotal));
        unset($_POST['keyword']);
        exit();
	}

	function get_UACC_invoice_data($id_cc_newsletter = '') {
		if (!empty($id_cc_newsletter)) {
			echo $this->UACC_billing_model->GetInvoiceData($id_cc_newsletter);
		}else{
			echo $this->UACC_billing_model->GetInvoiceData($this->input->post('id_cc_newsletter'));
		}
	}

	function save_UACC_invoice() {
		$this->UACC_billing_model->CreatePdf($this->input->post());
    }

    function UACC_invoices_list($id_cc_newsletter){
		$data['data'] = $this->UACC_billing_model->GetInvoices($id_cc_newsletter);
		$this->global['pageTitle'] = 'Invoice List';
		UACC_billing_views("UACC_billing/invoices_list", $this->global, $data, NULL);
	}

	function UACC_invoices_history_list($id_cc_newsletter){
		$data['data'] = $this->UACC_billing_model->GetInvoicesHistory($id_cc_newsletter);
		$this->global['pageTitle'] = 'Invoice History List';
		UACC_billing_views("UACC_billing/invoices_history_list", $this->global, $data, NULL);
	}

    function reset_UACC_balance($id_cc_newsletter){
		set_UACC_balance($id_cc_newsletter,0);
		redirect('uacc-billing/clients','refresh');
    }

    function reset_all_UACC_balance() {
		$ids = $this->input->post('ids');
		foreach ($ids as $key => $value) {
			set_UACC_balance($value, 0);
		}
		echo "Balance set successfully!!";
	}

	function UACC_make_payment(){
		$id_cc_invoice = $this->input->post('id_cc_invoice');
		$amount = $this->input->post('amount');
		$aTotal = $this->UACC_billing_model->getTotal($id_cc_invoice);

		if ($aTotal['due_amount'] > 0 || $aTotal['payment_status'] != 'S') {
			$fTotalpaid = (float) $aTotal['total_paid'] + (float) $amount + GetCCBalance($aTotal['id_cc_newsletter']);
			$nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;

			if ($aTotal['total'] <= $fTotalpaid) {
				$bal = abs($nFinalTotal);
				$sPayStatus = 'S';
				$fTotalpaid = $aTotal['total'];
				$nFinalTotal = 0;
			} else {
				$sPayStatus = 'R';
				$bal = 0;
			}
			
			$this->UACC_billing_model->update_invoice($nFinalTotal,$fTotalpaid,$sPayStatus,$amount,$id_cc_invoice);

			if ($bal > 0) {
				$Ocount = $this->UACC_billing_model->get_invoice_count($aTotal['id_cc_newsletter']);
				if ($Ocount['cont'] > 0) {
					for ($i = 1; $i <= $Ocount['cont']; $i++) {
						if ((float) $bal > 0) {
							$GetOld = $this->UACC_billing_model->get_old_invoice($aTotal['id_cc_newsletter']);
							if (count($GetOld) > 0) {
								$OTotalpaid = (float) $GetOld['total_paid'] + $bal;
								$OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;

								if ($GetOld['total'] <= $OTotalpaid) {
									$OPayStatus = 'S';
									if ($GetOld['total'] < $OTotalpaid) {
										$Odue = 0;
										$OTotalpaid = $GetOld['total'];
										$Obal = $bal - $GetOld['total'];
									}
								} else {
									$OTotalpaid = (float) $GetOld['total_paid'] + $bal;
									$OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
									$OPayStatus = 'R';
									$Obal = $bal - $GetOld['total'];
								}

								$this->UACC_billing_model->update_invoice($OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_cc_invoice']);
							} else {
								set_UACC_balance($aTotal['id_cc_newsletter'], ($bal));
								$bal = 0;
								$Obal = 0;
							}
							$bal = $Obal;
						}
					}
				} else {
					$bal = (float) $aTotal['total'] - $fTotalpaid;
					$TotBAL = abs($bal);
					set_UACC_balance($aTotal['id_cc_newsletter'], $TotBAL);
				}
			} else {
				set_UACC_balance($aTotal['id_cc_newsletter'], $bal);
			}
		} else {
			$GOLD = GetCCBalance($aTotal['id_cc_newsletter']);
			$bal = $amount + $GOLD;
			set_UACC_balance($aTotal['id_cc_newsletter'], $bal);
			if ($bal > 0) {
				$Ocount = $this->UACC_billing_model->get_invoice_count($aTotal['id_cc_newsletter']);
				if ($Ocount['cont'] > 0) {
					for ($i = 1; $i <= $Ocount['cont']; $i++) {
						if (GetCCBalance($aTotal['id_cc_newsletter']) > 0) {
							$GetOld = $this->UACC_billing_model->get_old_invoice($aTotal['id_cc_newsletter']);
							if (count($GetOld) > 0) {
								$OTotalpaid = (float) $GetOld['total_paid'] + $bal;
								$OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
								if ($GetOld['total'] <= $OTotalpaid) {
									$OPayStatus = 'S';
									$Obal = abs($OFinalTotal);
									$OFinalTotal = 0;
									$OTotalpaid = $GetOld['total'];
								} else {
									$OTotalpaid = (float) $GetOld['total_paid'] + $bal;
									$OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
									$OPayStatus = 'R';
									$Obal = $bal - $GetOld['total'];
								}

								$this->UACC_billing_model->update_invoice($OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_cc_invoice']);
								set_UACC_balance($aTotal['id_cc_newsletter'], $Obal);
							}
						}
					}
				} else {
					set_UACC_balance($aTotal['id_cc_newsletter'], $bal);
				}
			}
		}	
	}

	function UACC_unpaid($value='') {
		$id_cc_invoice = $this->input->post('id_cc_invoice');
		$amount = $this->input->post('amount');
		$aTotal = $this->UACC_billing_model->getTotal($id_cc_invoice);
		$Tbal = (GetCCTotalDue($aTotal['id_cc_newsletter']) - GetCCBalance($aTotal['id_cc_newsletter']));
		if ($Tbal <= 0) {
			if ($Tbal <= $amount) {
				$reaming = ((float)$amount - abs($Tbal));
				set_UACC_balance($aTotal['id_cc_newsletter'],0);
				if ($reaming > 0) {
					if ($aTotal['total_paid'] != 0) {
						$fTotalpaid = (float) $aTotal['total_paid'] - (float) $reaming;
						$nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;
						$nDua = (float) $aTotal['total'] - $fTotalpaid;
						$nDua = number_format($nDua, 2);
						$sPayStatus = ($nDua <= 0) ? 'S' : 'R';
						$this->UACC_billing_model->update_due_amount($nDua, $fTotalpaid, $sPayStatus, $reaming, $id_cc_invoice);
					}
				}
			}else {
				$reaming = ((float)$Tbal - (float)$amount);
				set_UACC_balance($aTotal['id_cc_newsletter'],$reaming);
			}
		}else {
			if ($aTotal['total_paid'] != 0) {
				$fTotalpaid = (float) $aTotal['total_paid'] - (float) $amount;
				$nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;
				$nDua = (float) $aTotal['total'] - $fTotalpaid;
				$nDua = number_format($nDua, 2);
				$sPayStatus = ($nDua <= 0) ? 'S' : 'R';
				$this->UACC_billing_model->update_due_amount($nDua, $fTotalpaid, $sPayStatus, $amount,$id_cc_invoice);
			}
		}
	}

	function delete_UACC_invoice_pdf(){
		$result = $this->UACC_billing_model->delete_invoice_pdf($this->input->post('id_cc_invoice'));
		if ($result) {
			$this->session->set_flashdata('success', 'Invoice deleted successfully!!');
			redirect('uacc-billing/clients');	
		}else{
			$this->session->set_flashdata('error', 'Somthing went wrong!!');
			redirect('uacc-billing/invoices-list');
		}
	}

	function get_UACC_mail_content() {
    	echo GetInvoiceMailContent($this->input->post('id_cc_newsletter'), $this->input->post('id_cc_invoice'));
    }

    function send_UACC_invoice_mail() {
		$id_cc_newsletter = $this->input->post('id_cc_newsletter');
		$id_cc_invoice = $this->input->post('id_cc_invoice');
		$e_data = $this->input->post('e_data');
		$Details = $this->UACC_billing_model->get_invoice_mail($id_cc_newsletter, $id_cc_invoice);
	    $date = strtotime($Details['create_invoice_at']);
	    $sMonth = date('F', $date);

	    $invoicepdf = base_url('assets/uploads/uacc-billing/').$Details['invoice_name'];
    
	    $Subject = "UACC Invoice for ".$sMonth;
	    if($Details['cc_newsletter'] == 'E'){
		    $sExtrasE = '<p>Your invoice is ready to download. Please click <a href="'.$invoicepdf.'">here</a> to download your invoice.</p><p>Please copy below url if you are unable to open a link.</p><p>'.$invoicepdf.'</p><p>Regards,</p><p>Unit Assistant</p>';
		    $sMessage = '<p>Hello '.$Details["name"].',</p>'.$e_data.$sExtrasE;
		}else {
	    	$sExtrasS = '<p>Su factura está lista para descargar. <a href="'.$invoicepdf.'">Haga clic aquí</a> para descargar su factura.</p><p>Copie la URL siguiente si no puede abrir un enlace.</p><p>'.$invoicepdf.'</p><p>Regards,</p><p>Unit Assistant</p>';
	    	$sMessage = '<p>Hola '.$Details["name"].',</p>'.$e_data.$sExtrasS;
	    }

		$this->email->set_mailtype("html");
	    $this->email->from('office@unitassistant.com', 'Unit Assistant Service');
	    $this->email->to($Details['email']);
	    $this->email->subject($Subject);
	    $this->email->message($sMessage);
	    $send = $this->email->send();

		if($send) {
			$result = $this->UACC_billing_model->save_invoice_mail($id_cc_newsletter, $id_cc_invoice, $e_data);
			if ($result) {
				echo '1';
			}else{
				echo '0';
			}
		}else {
			echo '0';	
		}
    }

    function get_all_UACC_invoice(){
		$ids =$this->input->post('ids');
		$data = $this->UACC_billing_model->GetAllInvoiceData($ids);

		include APPPATH."/libraries/pdf/invoice.php"; 
			
			if (!empty($data)) {
				foreach ($data as $key => $val) {
					

					$TBill = ($val['digital_biz_card'] =='1' && $val['inc_tbc'] != '1') ? 0 : UACC_BILLING;

					$total = 0;

					// Customer Communication
					$total = $total + $TBill;
					$val['customer_comm_name']='Customer Communication';
					$val['customer_communication']='1';
					$val['customer_comm_val']=$TBill;
					$val['customer_comm_val_total']=$TBill;

					if ($val['prospect_system'] == '1') {
						$total = number_format($total + PROSPECT_SYSTEM, 2);    
						$val['prospect_system_name']='Prospect System';
						$val['prospect_system_val']=PROSPECT_SYSTEM;
						$val['prospect_system_val_total']=PROSPECT_SYSTEM;    
					}

					if ($val['cv_prospect'] == 1) {
						$total = number_format($total + CV_PROSPESCT_VAL, 2);
						$val['cv_prospect_name']='Carona Virus Special - discounted by 29.99';
						$val['cv_prospect_val']=CV_PROSPESCT_VAL;
						$val['cv_prospect_val_total']=CV_PROSPESCT_VAL;
					}

					if ($val['misc_charge'] != 0) {
						$total = number_format($total + $val['misc_charge'], 2);
						$val['misc_charge_name']='Misc. Charges';
						$val['misc_charge_val']=$val['misc_charge'];
						$val['misc_charge_val_total']=$val['misc_charge'];
					}

					if ($val['digital_biz_card'] == '1') {
						$total = number_format($total + DIGITAL_BIZ_CARD, 2);
						$val['digital_biz_card_name']='Digital Biz Card';
						$val['digital_biz_card_val']=DIGITAL_BIZ_CARD;
						$val['digital_biz_card_val_total']=DIGITAL_BIZ_CARD;
					}

					if ($val['special_credit'] != 0) {
						$val['special_credit_name']='Digital Biz Card';
						$val['special_credit_val']=$val['special_credit'];
						$val['special_credit_val_total']=$val['special_credit'];
					}


					$total=number_format((float)$total-(float)$val['special_credit'], 2);

					$nTotalKey = str_replace(",", "", $total);
					$val['price']=$nTotalKey;
					$sDate = date("Y-m-d");
					$sSerialData = serialize($val);
					$create_by='1';

					$aNewsData = $this->UACC_billing_model->get_news_data($val['id_cc_newsletter']);
					$aInvoiceLastId = $this->UACC_billing_model->get_invoice_last_id($val['id_cc_newsletter']);

					if (empty($aInvoiceLastId)) {
						$aLastInvoiceId = $this->UACC_billing_model->get_max_invoice_id();
						$nLastInsertId = $aLastInvoiceId + 1;
					} else {
						$nLastInsertId = $aInvoiceLastId['id_invoice'];
					}

					$pdf = new PDF_Invoice('P', 'mm', 'A4');
					$pdf->AddPage();
					$pdf->Image('./assets/images/UACC_logo.png', 4, 4, 100);
					//$pdf->addSociete('',"120 manhattan ave manhattan beach CA 30001");
					$pdf->fact_dev("INVOICE", '');
					$pdf->addDate($sDate);
					$pdf->addClient($nLastInsertId);
					//$pdf->addClientAdresse($aNewsData['nsd_address']);
					$pdf->addReglement($val['name']);
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

					$line = pdf_format($l_num, 'Customer Communication', '1', $TBill, $TBill);
					$size = $pdf->addLine($y, $line);
					$l_num++;
					$y += 10;

					if ($val['prospect_system'] == '1') {
						$line = pdf_format($l_num, 'Prospect System', '1', PROSPECT_SYSTEM, PROSPECT_SYSTEM);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
					}

					if ($val['cv_prospect'] == 1) {
						$line = pdf_format($l_num, 'Carona Virus Special - discounted by 29.99', '1', CV_PROSPESCT_VAL, CV_PROSPESCT_VAL);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
					}

					if ($val['misc_charge'] != 0) {
						$line = pdf_format($l_num, 'Misc. Charges', '1', $val['misc_charge'], $val['misc_charge']);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
					}

					if ($val['digital_biz_card'] == '1') {
						$line=pdf_format($l_num, 'Digital Biz Card', '1', DIGITAL_BIZ_CARD, DIGITAL_BIZ_CARD);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
					}

					if ($val['special_credit'] != 0) {
						$line=pdf_format($l_num, 'Special Credit', '1', $val['special_credit'], $val['special_credit']);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
					}

					$alredInvoiced = empty($val['id_cc_invoice']) ? '' : $val['id_cc_invoice'];
					if ($alredInvoiced != '') {
						$created_at = $this->UACC_billing_model->get_pdf_date($alredInvoiced);
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

					$invoice_name = $this->UACC_billing_model->get_invoice_name($val['id_cc_newsletter']);

					if (!empty($invoice_name)) {
						$pdf_old = explode('_', $invoice_name['invoice_name']);
					}
					
					
					$aCurrentDate = $this->UACC_billing_model->get_current_date($val['id_cc_newsletter']);
					$Pstatus = 'P';

					$BAL = (GetCCTotalDue($val['id_cc_newsletter']) - GetCCBalance($val['id_cc_newsletter'])); 
					
					if($nTotalKey > 0) {
			            if($BAL >= $nTotalKey) {
			               $paid_amount = $nTotalKey;
			               $due = 0;
			               $Rbal = $nTotalKey - $BAL;
			               $Pstatus = 'S';
			               /*set_UACC_balance($val['id_cc_newsletter'], $Rbal);*/
			            }elseif($BAL == 0){
			                $paid_amount = 0;
			                $due = $nTotalKey;
			            }else {
			                $paid_amount = $BAL;
			                $due = $nTotalKey - $paid_amount;
			                /*set_UACC_balance($val['id_cc_newsletter'], 0);*/
			            }    
			        }else {
			           $paid_amount = $nTotalKey;
			           $due = 0;
			           $Pstatus = 'S';
			           $Rbal = abs($nTotalKey) + $BAL;
			           /*set_UACC_balance($val['id_cc_newsletter'], $Rbal);*/
			        }

					if (empty($aCurrentDate)) {
						$UpdateDUE = $nTotalKey;
					} else {
						if (isset($val['id_cc_invoice']) && $val['id_cc_invoice'] != '') {
							$aTotalPaidData = $this->UACC_billing_model->get_total_paid($val['id_cc_invoice']);
							$UpdateDUE = $aTotalPaidData['total'] -  $aTotalPaidData['total_paid'];	
						}else{
							$UpdateDUE = $nTotalKey;
						}
					}

					$details = array( 'data' => $sSerialData, 'total' => $nTotalKey, 'due_amount'=>$UpdateDUE,  'invoice_name' =>$sPdfData, 'create_by' => $create_by, 'updated_at' =>$sDate );

					if (isset($val['id_cc_invoice']) && $val['id_cc_invoice'] != '') {		
						if ($pdf_old[0] == $aNewsData['consultant_number']) {
							$filename = './assets/uploads/uacc-billing/'.$invoice_name['invoice_name'];
			        		unlink($filename);
						}

						$Pstatus = ($UpdateDUE > 0) ? 'R' : 'S';
						$pdf->Output($filename, 'F');

						$this->UACC_billing_model->update_pdf_invoice($details, $val['id_cc_invoice']);

					} else {
						if (!empty($aCurrentDate)) {
							if ($pdf_old[0] == $aNewsData['consultant_number']) {
								$filename = './assets/uploads/uacc-billing/'.$sPdfData;
			        			unlink($filename);
							}
							$pdf->Output($filename, 'F');

							$details['id_cc_newsletter']=$val['id_cc_newsletter'];
							$details['consultant_number']=$aNewsData['consultant_number'];
							$details['payment_status']=$Pstatus;
							$this->UACC_billing_model->update_pdf_invoice($details, $aCurrentDate['id_cc_invoice']);
						} else {
							$pdf->Output($filename, 'F');
							$details['id_cc_newsletter']=$val['id_cc_newsletter'];
							$details['consultant_number']=$aNewsData['consultant_number'];
							$details['invoice_date']=$sDate;
							$details['total_paid']=$paid_amount;
							$details['due_amount']=$due;
							$details['payment_status']=$Pstatus;
							$details['created_at']=$sDate;
							$this->UACC_billing_model->insert_pdf_invoice($details);
						}

					}


				}
				$return = array('status'=>1,'msg'=>'successfully');
        		echo json_encode($return);
			}else{
				$return = array('status'=>0,'msg'=>'unsuccessfully');
        		echo json_encode($return);
			}
   	}


    /*function save_all_UACC_invoice() {
		$res = $this->UACC_billing_model->CreatePdf($this->input->post(), 'all');
		if ($res) {
			$this->session->set_flashdata('success', 'Invoice created successfully!!');	
		}else{
			$this->session->set_flashdata('error', 'Somthing went wrong!!');
		}
		redirect('uacc-billing/clients');
    }*/

    function delete_all_UACC_invoice() {
		$months = substr($this->input->post('delete_all'), 0, -1);
		$invoiceDetails = $this->UACC_billing_model->get_invoice_details($months);
		if (!empty($invoiceDetails)) {
			foreach ($invoiceDetails as $key => $val) {
				$filename = './assets/uploads/uacc-billing/'.$val['invoice_name'];
    			unlink($filename);
    			$delete_invoice = $this->UACC_billing_model->delete_invoice($months, $val['id_cc_invoice']);
				$bal = $this->UACC_billing_model->get_due_amount($val['id_cc_newsletter']);
				if(empty($bal)) {
			       set_UACC_balance($val['id_cc_newsletter'], 0);
		        }else {
			        if($bal['due_amount'] < 0) {
			            set_UACC_balance($val['id_cc_newsletter'], abs($bal['due_amount']));
			        }
		        }
			}
			$response = "Invoices deleted successfully!!";
		}else {
			$response = "There are no invoices for selected month(s)!!";
		}

		echo $response;
		exit();
	}

	function send_selected_UACC_invoice_mail(){
		require_once APPPATH."/third_party/mailchimp-api-master/vendor/autoload.php"; 
		require_once APPPATH."/third_party/mailchimp-api-master/src/MailChimp.php";
		require_once APPPATH."/third_party/mailchimp-api-master/mcapi.php";
		require_once APPPATH."/third_party/mailchimp-api-master/examples/config/config.inc.php";
		
		$list_id = UACC_billing_list_id;
		$MailChimp = new \DrewM\MailChimp\MailChimp(mailchimp_key);

		if ($this->input->post('send_all')=='1') {
			$invoceData = $this->UACC_billing_model->get_invoice_mail_data(0);
		}else{
			$id_cc_newsletter = implode(',', $this->input->post('id_cc_newsletter'));
			$invoceData = $this->UACC_billing_model->get_invoice_mail_data($id_cc_newsletter);
		}

		if (!empty($invoceData)) {
			$aSubscribesEmails = array();
			$retval = $MailChimp->get('lists/'.$list_id.'/members?count=5000');
			if(!empty($retval['members'])) {
			    foreach ($retval['members'] as $key => $value) {
			        $aSubscribesEmails[] = $value['email_address'];
			        $memberId = $MailChimp->subscriberHash($value['email_address']);
			        $responseData = $MailChimp->patch("lists/$list_id/members/$memberId",[
			            'status'  => 'unsubscribed',
			        ]);
			    }
			}

			$aEmails = array();
			$sMonth = '';
			foreach ($invoceData as $key => $value) {
				$sMonth = date('F', strtotime($value['created_at']));
			    $aEmails[] = $value['email'];
			    $memberId = $MailChimp->subscriberHash($value['email']);
			    $attachment =  base_url("assets/uploads/uacc-billing/".$value['invoice_name']);
			    $attachment_encoded = base64_encode($attachment); 
			            
	            if(in_array($value['email'], $aSubscribesEmails)) {
	                $result = $MailChimp->patch("lists/$list_id/members/$memberId", [
	                    'status'        => 'subscribed',
	                    'merge_fields'  => ['FNAME' => $value['name'], 'MMLINKPDF' => $attachment,'LANGUAGE'=>$value['cc_newsletter']],
	                ]);
	            }else {
	                $result = $MailChimp->post("lists/$list_id/members", [
	                    'email_address' => $value['email'],
	                    'status'        => 'subscribed',
	                    'merge_fields'  => ['FNAME' => $value['name'], 'MMLINKPDF' => $attachment,'LANGUAGE'=>$value['cc_newsletter']],
	                ]);
	            }

	            if( isset($result['status']) && $result['status']=='subscribed') {
	            	$this->UACC_billing_model->update_invoice_status('1', $value['id_cc_invoice']); 
	            }else {
	            	$this->UACC_billing_model->update_invoice_status('2', $value['id_cc_invoice']);
	            }
			}

			$result = $MailChimp->post("campaigns", [
		    'type' => 'regular',
		    'recipients' => ['list_id' => $list_id],
		    'settings' => ['subject_line' => "Unit Assistant Invoice for ".$sMonth,
		       'reply_to' => "office@unitassistant.com",
		       'from_name' => "Unit Assistant Service"
		      ]
		    ]);
		    $response = $MailChimp->getLastResponse();
		    $responseObj = json_decode($response['body']);
		    $html = "asdasdasdlkajs  asdkj dlk as askldja 'ask aslk as slk asd";
		    $result = $MailChimp->put('campaigns/' . $responseObj->id . '/content', [
		      'template' => ['id' => UACC_billing_template_id, 
		        'sections' => ['body' => $html]
		        ]
		      ]);

		    $result = $MailChimp->post('campaigns/' . $responseObj->id . '/actions/send');
		    	
		    if ($result) {
		    	$return = array('status'=>1,'msg'=>'successfully');
		    }else{
		    	$return = array('status'=>0,'msg'=>'not successfully');
		    }
		    
		    echo json_encode($return);
		    exit();
		}
			
	}

	
	function UACC_credit_payment() {
		$data['data'] = $this->UACC_billing_model->credit_payment_clients();

		$this->global['pageTitle'] = 'UACC Billing : Credit Payment';
		UACC_billing_views("UACC_billing/credit_payment", $this->global, $data, NULL);
	}

	function UACC_payment_form(){
		if(!empty($this->input->post())) {
			$data['data'] = $this->input->post();
		}else {
			$data['data'] = '';
		}

		$this->global['pageTitle'] = 'UACC Billing : Payment';
		$this->load->view("UACC_billing/payment_form", $data);
	}

	function proccess_UACC_payment() {
		require APPPATH .'/libraries/connect-php-sdk-master/autoload.php';
		
		$id_cc_invoice = $this->input->post('id_cc_invoice');
		$aInvoiceData = $this->input->post('c_amount');
		$amount = round($aInvoiceData * 100);

		$aData = $this->UACC_billing_model->get_invoice_data($id_cc_invoice);
		
		$iTotal = $aData['total'];
		$iPaid = $aData['total_paid'];
		$iDue = ($iTotal - $iPaid);


		$access_token = 'sq0atp-aVN2diRwc2mEM_BVRBp-sA';

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		  error_log("Received a non-POST request");
		  echo "Request not allowed";
		  http_response_code(405);
		  return;
		}
		$nonce = $this->input->post('nonce');
		if (is_null($nonce)) {
		  echo "Invalid card data";
		  http_response_code(422);
		  return;
		}

		\SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
		$locations_api = new \SquareConnect\Api\LocationsApi();

		try {
	  	  $locations = $locations_api->listLocations();
		  # We look for a location that can process payments
		  $location = current(array_filter($locations->getLocations(), function($location) {
		    $capabilities = $location->getCapabilities();
		    return is_array($capabilities) &&
		      in_array('CREDIT_CARD_PROCESSING', $capabilities);
		  }));

		} catch (\SquareConnect\ApiException $e) {
		  echo "Caught exception!<br/>";
		  print_r("<strong>Response body:</strong><br/>");
		  echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
		  echo "<br/><strong>Response headers:</strong><br/>";
		  echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
		  exit(1);
		}

		$transactions_api = new \SquareConnect\Api\TransactionsApi();

		$request_body = array (
		  "card_nonce" => $nonce,
		  "amount_money" => array (
		    "amount" => $amount,
		    "currency" => "USD"
		  ),
		  "idempotency_key" => uniqid()
		);

		try {
		  	$result = $transactions_api->charge($location->getId(), $request_body);
		  	if(!empty($result)){  
		        $total_paid = $aInvoiceData + $iPaid;
		        $total_due = $iDue - $aInvoiceData;
		        $status = ($total_due <= 0) ? 'S' : 'R';
		        if($total_paid > $iTotal) {
		            $BAL = $total_paid - $iTotal; 
		            $CBAL = GetCCBalance($aData['id_cc_newsletter']);
		            set_UACC_balance($CBAL + $BAL);
		        }
		        
		        $this->UACC_billing_model->make_payment_invoice($id_cc_invoice, $total_paid, $total_due, $status);
				echo "<h1 style='text-align:center'>Payment Successful!! </h1>";
		  	}
		} catch (\SquareConnect\ApiException $e) {
		  	$this->UACC_billing_model->edit_cancel_payment($id_cc_invoice, 'D');
		 	echo "<h1 style='text-align:center'>Payment Failed Please Try Again</h1>";
		}		
	}

	

	/*function Unsbclients() {
		$data['clients'] = $this->UACC_billing_model->getUnsbClients();
		$this->global['pageTitle'] = 'Billing : Unsubscribed Client List';
		UACC_billing_views("UACC_billing/Unsbclients", $this->global, $data, NULL);
	}*/

}
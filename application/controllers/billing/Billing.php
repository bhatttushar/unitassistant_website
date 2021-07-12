<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Billing extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('billing/billing_model');
		$this->load->helper('directors/director_helper');
		$this->load->helper('directors/billing_helper');
		$this->load->library('excel');
		isAdminLoggedIn();
	}

	public function __destruct() {
	   $this->load->library('excel');
	}

	public function index() {
		$this->global['pageTitle'] = 'Billing Dashboard';
		$data['invoices'] = $this->billing_model->get_invoice_rows('');
		$data['pending'] = $this->billing_model->get_invoice_rows('P');
		$data['paid'] = $this->billing_model->get_invoice_rows('S');
		$data['cancel'] = $this->billing_model->get_invoice_rows('C');
		$data['remaining'] = $this->billing_model->get_invoice_rows('R');
		BillingViews("billing/dashboard", $this->global,$data, NULL);
	}

	/*function AjaxData(){
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value

		$details=$this->billing_model->DataAjax($row, $rowperpage, $columnName, $columnSortOrder, $searchValue);

		$aNewsletterIdEx = array();
		foreach ($details['id_newsletters'] as $key => $value) {
			$aNewsletterIdEx[] = $value['id_newsletter'];
		}
		

		$data = array();
		$count = $row + 1;
		foreach ($details['user_data'] as $val) {
			$bal = GetBalance($val['id_newsletter']);
			$due = GetTotalDue($val['id_newsletter']);
			
			$class = in_array($val['id_newsletter'],  $aNewsletterIdEx) ? 'btn-success' : 'btn-info disabled';

			$button = "<a class='btn ".$class."' href='".base_url('billing/invoices-list/'.$val['id_newsletter'])."' title='View Invoices'>View Invoices</a>&nbsp;
					<a class='btn ".$class."' href='".base_url('billing/invoice-year-report/'.$val['id_newsletter'])."' title='Year Report'>Year Report</a>&nbsp;
					<a href='".base_url('billing/reset-balance/'.$val['id_newsletter'])."' class='btn btn-danger Sreset_bal'>Reset Balance</a>";

	        $b1 = '<input type="checkbox" name="create_all[]" value="'.$val['id_newsletter'].'">';
			$data[] = array( 
		      "id_newsletter"=>$count,
		      "create_all"=>$b1,
		      "first_bill_date"=>$val['first_bill_date'],
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

	function clients() {
		//$data['clients'] = $this->billing_model->getUAClients();
		$details['data']=$this->billing_model->DataAjax();
		$aNewsletterIdEx = array();
		foreach ($details['data']['id_newsletters'] as $key => $value) {
			$aNewsletterIdEx[] = $value['id_newsletter'];
		}
		$details['aNewsletterIdEx'] = $aNewsletterIdEx;
		$this->global['pageTitle'] = 'Unit Assistant : Clients List';
		BillingViews("billing/clients", $this->global, $details, NULL);
	}

	function invoices_list($id_newsletter){
		$data['data'] = $this->billing_model->GetInvoices($id_newsletter);
		$data['account_balance'] = ((float)GetTotalDue($id_newsletter) - (float)GetBalance($id_newsletter));
		$this->global['pageTitle'] = 'Invoice List || '.@$data['data'][0]['name'];
		BillingViews("billing/invoices_list", $this->global, $data, NULL);
	}

	function delete_invoice_pdf(){
		$result = $this->billing_model->delete_invoice_pdf($this->input->post('id_invoice'));
		if ($result) {
			$this->session->set_flashdata('success', 'Invoice deleted successfully!!');
			redirect('billing/clients');	
		}else{
			$this->session->set_flashdata('error', 'Somthing went wrong!!');
			redirect('billing/invoices-list');
		}
	}

	function search_keyword() {
		if ($this->input->post('keyword')) {
			$data = $this->billing_model->search_keyword($this->input->post('keyword'));
			if (!empty($data)) { ?>
	            <ul id="country-list">
	                <?php foreach ($data as $name) {?>
	                    <li onClick="nameSelect('<?php echo addslashes($name['name']); ?>',<?php echo $name['id_newsletter']; ?>)"><?php echo $name['name']; ?></li>
	                <?php }?>
	            </ul>
	        <?php }
		}
	}

	function search_name($id_newsletter = '') {
		if (!empty($id_newsletter)) {
			echo $this->billing_model->Searchname($id_newsletter);
		}else{
			echo $this->billing_model->Searchname($this->input->post('id_newsletter'));
		}
	}
	function get_invoice_data($id_newsletter = '') {
		if (!empty($id_newsletter)) {
			echo $this->billing_model->GetInvoiceData($id_newsletter);
		}else{
			echo $this->billing_model->GetInvoiceData($this->input->post('id_newsletter'));
		}
	}	

	function create_invoice($id_invoice="") {
		if (empty($id_invoice)) {
			$data['invoice_data'] = "";
		}else{
			$data['invoice_data'] = $this->billing_model->get_single_invoice($id_invoice);
		}
		$this->global['pageTitle'] = 'Billing : Create Invoice';
		BillingViews("billing/create_invoice", $this->global, $data, NULL);	
	}
	
	function save_invoice() {
		if (!empty($this->input->post())) {
			$this->billing_model->CreatePdf($this->input->post());
		}
    }

   	function get_all_invoice(){
   		if (!empty($this->input->post())) {
			$ids =$this->input->post('ids');
			$data = $this->billing_model->GetAllInvoiceData($ids);

			include APPPATH."/libraries/pdf/invoice.php"; 
			
			if (!empty($data)) {
				foreach ($data as $key => $val) {
					$Credit = (GetTotalDue($val['id_newsletter']) - GetBalance($val['id_newsletter']));
					if ($val['account_detail'] == 'N') {
						$ttotal=number_format((float) $val['package_pricing'] - (float)$val['special_credit'], 2);
						$CCcharge = ($ttotal * 5) / 100;
					} else {
						$CCcharge = '';
					}

					extract($val);

					$package_value = ($val['package_value'] == '' ? '0.00' : $val['package_value']);
					$facebook = ($val['facebook'] == '1') ? facebook : '';
					$facebook_everything = ($val['facebook_everything'] == '1') ? facebook_everything : '';
					$emailing=(($val['emailing']=='1') ? emailing_0 : (($val['emailing'] == 2) ? emailing_1 : ''));
					$sNewsletterDesign = (($val['hidden_newsletter'] == 'SB' || $val['hidden_newsletter'] == 'AB') ? newsletter_design_constant_val : '$0');
					$email_newsletter = ($val['email_newsletter'] == '1') ? email_newsletter : '';
					$digital_biz_card = ($val['digital_biz_card'] == '1') ? DIGITAL_BIZ_CARD : '';
					$canada_service = ($val['canada_service'] == '1') ?  : '';
					$nsd_client = ($val['nsd_client'] == '1') ?  '1' : '';

					if ($val['canada_service'] == '1') {
						if ($val['package'] == 'N' || $val['package'] == '') {
							$canada_service =  canada_service + total_text_program7_n;
						}else{
							$canada_service = canada_service + total_text_program7_y;
						}
					}else{
						$canada_service = '';
					}

					$total_text_program=($val['total_text_program']=='1') ? Get_total_text_program($val['package'], $val['total_text_program']) : '';
					$total_text_program7=($val['total_text_program7']=='1') ? Get_total_text_program7($val['package'], $val['total_text_program7']) : '';




					//Director Access Texting System
					if ($val['nsd_client'] == '1') {
						$sDirectorAccess = '0';
					} elseif ($val['total_text_program'] == '1') {
						$sDirectorAccess = '0';
					} else {
						$sDirectorAccess = '';
					}
					$prospect_system = ($val['prospect_system'] == '1') ? PROSPECT_SYSTEM : '';
					$magic_booker = ($val['magic_booker'] == '1') ? MAGIC_BOOKER : '';
					$other_language_newsletter=($val['other_language_newsletter']=='1') ? other_language_newsletter : '';
					$personal_unit_app = ($val['personal_unit_app'] == '1') ? personal_unit_app_val : '';
					$personal_website = ($val['personal_website'] == '1') ? personal_website_val : '';
					$personal_url = ($val['personal_url'] == '1') ? personal_url_val : '';
					$subscription_updates = ($val['subscription_updates'] == '1') ? subscription_updates_val : '';
					$app_color = ($val['app_color'] == '1') ? app_color_val : '';
					$sPackageName =  GetPackageName($val['package']);
					$total=number_format((float)$val['package_pricing']-(float)$val['special_credit'], 2);
					$nTotalKey = str_replace(",", "", $total);
					$sDate = date("Y-m-d");
					$create_by='1';
					$aNewsData = $this->billing_model->get_news_data($val['id_newsletter']);
					$aInvoiceLastId = $this->billing_model->get_invoice_last_id($val['id_newsletter']);

					if (empty($aInvoiceLastId)) {
						$aLastInvoiceId = $this->billing_model->get_max_invoice_id();
						$nLastInsertId = $aLastInvoiceId + 1;
					} else {
						$nLastInsertId = $aInvoiceLastId['id_invoice'];
						
					}

					$pdf = new PDF_Invoice('P', 'mm', 'A4');
					$pdf->AddPage();
					$pdf->Image('./assets/images/logo.png', 5, 5, 140);
					//$pdf->addSociete('',"120 manhattan ave manhattan beach CA 30001");
					$pdf->fact_dev("INVOICE", '');
					$pdf->addDate($sDate);
					$pdf->addClient($nLastInsertId);
					//$pdf->addClientAdresse($aNewsData['nsd_address']);
					$pdf->addReglement($name);
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

						$val['package']="Package: ".$sPackageName." (Unit size - ".$unit_size.")";
						$val['package_value']=$package_value;
						$val['package_value_total']=$package_value;

						$y = 65;
						$line = pdf_format($l_num, "Package: ".$sPackageName." (Unit size - ".$unit_size.")", '1', $package_value, $package_value);
						$size = $pdf->addLine($y, $line);
						$y += 10;
						$l_num++;

						
					}


					if (isset($facebook) && !empty($facebook)) {
						$val['facebook_name']='Facebook Newsletters';
						$val['facebook_val']=$facebook;
						$val['facebook_val_total']=$facebook;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Facebook Newsletters', '1', number_format($facebook, 2), number_format($facebook,2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($facebook_everything) && !empty($facebook_everything)) {
						$val['facebook_everything_name']='Facebook Everything';
						$val['facebook_everything_val']=$facebook_everything;
						$val['ffacebook_everything_val_total']=$facebook_everything;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Facebook Everything', '1', number_format($facebook_everything, 2), number_format($facebook_everything, 2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($val['total_text_program']) && $val['total_text_program'] == '1') {
						$val['total_text_program_name']='Total text package';
						$val['total_text_program_val']=$total_text_program;
						$val['total_text_program_val_total']=$total_text_program;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Total text package', '1', $total_text_program, $total_text_program);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($val['total_text_program7']) && $val['total_text_program7'] == '1') {

						$val['total_text_program7_name']='7/2019 Total text package';
						$val['total_text_program7_val']=$total_text_program7;
						$val['total_text_program7_val_total']=$total_text_program7;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, '7/2019 Total text package', '1', $total_text_program7, $total_text_program7);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($emailing) && !empty($emailing)) {
						$val['emailing_name']='Newsletters';
						$val['emailing_val']=$emailing;
						$val['emailing_val_total']=$emailing;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Newsletters', '1', number_format($emailing, 2), number_format($emailing, 2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($newsletter_formating) && !empty($newsletter_formating)) {
						$val['newsletter_formating']='Newsletters Formating';
						$val['newsletter_formating_val']=newsletter_formating_val;
						$val['newsletter_formating_val_total']=newsletter_formating_val;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Newsletters Formating', '1', number_format(newsletter_formating_val,2), number_format(newsletter_formating_val, 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($digital_biz_card) && !empty($digital_biz_card)) {
						$val['digital_biz_card_name']='Digital Biz Card';
						$val['digital_biz_card_val']=$digital_biz_card;
						$val['digital_biz_card_val_total']=$digital_biz_card;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Digital Biz Card', '1', number_format($digital_biz_card, 2), number_format($digital_biz_card, 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($canada_service) && !empty($canada_service)) {
						$val['canada_service_name']='Canada Service';
						$val['canada_service_val']=$canada_service;
						$val['canada_service_val_total']=$canada_service;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Canada Service', '1', $canada_service, $canada_service);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($email_newsletter) && !empty($email_newsletter)) {
						$val['email_newsletter_name']='Email Newsletters';
						$val['email_newsletter_val']=$email_newsletter;
						$val['email_newsletter_val_total']=$email_newsletter;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Email Newsletters', '1', number_format($email_newsletter, 2), number_format($email_newsletter, 2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					/*if (isset($text_email) && !empty($text_email)) {
						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Text and Email', '1', number_format($text_email, 2), number_format($text_email, 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);
						}
					}*/

					if (isset($prospect_system) && !empty($prospect_system)) {
						$val['prospect_system_name']='Prospect System';
						$val['prospect_system_val']=$prospect_system;
						$val['prospect_system_val_total']=$prospect_system;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Prospect System', '1', number_format($prospect_system, 2), number_format($prospect_system, 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($magic_booker) && !empty($magic_booker)) {
						$val['magic_booker_name']='Magic Booker System';
						$val['magic_booker_val']=$magic_booker;
						$val['magic_booker_val_total']=$magic_booker;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Magic Booker System', '1', $magic_booker, $magic_booker);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($other_language_newsletter) && !empty($other_language_newsletter)) {
						$val['other_language_newsletter_name']='Other language newsletter';
						$val['other_language_newsletter_val']=$other_language_newsletter;
						$val['other_language_newsletter_val_total']=$other_language_newsletter;
						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Other language newsletter', '1', number_format($other_language_newsletter, 2), number_format($other_language_newsletter, 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($personal_unit_app) && !empty($personal_unit_app)) {
						$val['personal_unit_app_name']='Personal Unit App';

						$y = ($y == 65 ? $y = 65 : $y);

						if ($package != 'N') {

							$val['personal_unit_app_val']=personal_unit_app_val;
							$val['personal_unit_app_val_total']=personal_unit_app_val;

							$line = pdf_format($l_num, 'Personal Unit App', '1', number_format(personal_unit_app_val, 2), number_format(personal_unit_app_val, 2));
						} else {

							$val['personal_unit_app_val']=pack_personal_unit_app_val;
							$val['personal_unit_app_val_total']=pack_personal_unit_app_val;
							$line = pdf_format($l_num, 'Personal Unit App', '1', number_format(pack_personal_unit_app_val, 2), number_format(pack_personal_unit_app_val, 2));
						}

						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}
					
					if (isset($personal_website) && !empty($personal_website)) {
						$val['personal_website_name']='Personal Website';

						$y = ($y == 65 ? $y = 65 : $y);

						if ($package != 'N') {
							$val['personal_website_val']=personal_website_val;
							$val['personal_website_val_total']=personal_website_val;

							$line = pdf_format($l_num, 'Personal Website', '1', number_format(personal_website_val, 2), number_format(personal_website_val, 2));
						} else {
							$val['personal_website_val']=pack_personal_website_val;
							$val['personal_website_val_total']=pack_personal_website_val;

							$line = pdf_format($l_num, 'Personal Website', '1', number_format(pack_personal_website_val, 2), number_format(pack_personal_website_val, 2));
						}

						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}
					
					if (isset($personal_url) && !empty($personal_url)) {
						$val['personal_url_name']='Personal URL';
						$val['personal_url_val']=personal_url_val;
						$val['personal_url_val_total']=personal_url_val;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Personal URL', '1', number_format(personal_url_val, 2), number_format(personal_url_val,2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}
					
					if (isset($subscription_updates) && !empty($subscription_updates)) {
						$val['subscription_updates_name']='10 Updates on subscription';
						$val['subscription_updates_val']=subscription_updates_val;
						$val['subscription_updates_val_total']=subscription_updates_val;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, '10 Updates on subscription', '1', number_format(subscription_updates_val, 2), number_format(subscription_updates_val,2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($app_color) && !empty($app_color)) {
						$val['app_color_name']='App custom color';
						$val['app_color_val']=number_format(app_color_val, 2);
						$val['app_color_val_total']=number_format(app_color_val, 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'App custom color', '1', number_format(app_color_val, 2), number_format(app_color_val, 2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}


					if (isset($newsletter_color) && !empty($newsletter_color)) {
						$val['newsletter_color_name']='Newsletter-Color';
						$val['newsletter_color_val']=number_format(newsletter_color_constant_val, 2);
						$val['newsletter_color_val_total']=number_format((newsletter_color_constant_val * $newsletter_color), 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Newsletter-Color', $newsletter_color, number_format(newsletter_color_constant_val, 2), number_format((newsletter_color_constant_val * $newsletter_color), 2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($newsletter_black_white) && !empty($newsletter_black_white)) {
						$val['newsletter_black_white_name']='Newsletter-Black White';
						$val['newsletter_black_white_val']=number_format(newsletter_black_white_constant_val, 2);
						$val['newsletter_black_white_val_total']=number_format((newsletter_black_white_constant_val * $newsletter_black_white), 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Newsletter-Black White', $newsletter_black_white, number_format(newsletter_black_white_constant_val, 2), number_format((newsletter_black_white_constant_val * $newsletter_black_white), 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($month_packet_postage) && !empty($month_packet_postage)) {
						$val['month_packet_postage_name']='Last Month Packets Postage';
						$val['month_packet_postage_val']=number_format(month_packet_postage_constant_val, 2);
						$val['month_packet_postage_val_total']=number_format((month_packet_postage_constant_val * $month_packet_postage), 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Last Month Packets Postage', $month_packet_postage, number_format(month_packet_postage_constant_val, 2), number_format((month_packet_postage_constant_val * $month_packet_postage), 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($consultant_packet_postage) && !empty($consultant_packet_postage)) {
						$val['consultant_packet_postage_name']='New Consultant Packet Postage';
						$val['consultant_packet_postage_val']=number_format(consultant_packet_postage_constant_val, 2);
						$val['consultant_packet_postage_val_total']=number_format((consultant_packet_postage_constant_val * $consultant_packet_postage), 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'New Consultant Packet Postage', $consultant_packet_postage, number_format(consultant_packet_postage_constant_val, 2), number_format((consultant_packet_postage_constant_val * $consultant_packet_postage), 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($consultant_bundles) && !empty($consultant_bundles)) {
						$val['consultant_bundles_name']='New Consultant Bundles';
						$val['consultant_bundles_val']=number_format(consultant_bundles_constant_val,2);
						$val['consultant_bundles_val_total']=number_format((consultant_bundles_constant_val * $consultant_bundles),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'New Consultant Bundles', $consultant_bundles, number_format(consultant_bundles_constant_val,2), number_format((consultant_bundles_constant_val * $consultant_bundles),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($consistency_gift) && !empty($consistency_gift)) {
						$val['consistency_gift_name']='Consistency Gift';
						$val['consistency_gift_val']=number_format(consistency_gift_constant_val, 2);
						$val['consistency_gift_val_total']=number_format((consistency_gift_constant_val * $consistency_gift), 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Consistency Gift', $consistency_gift, number_format(consistency_gift_constant_val, 2), number_format((consistency_gift_constant_val * $consistency_gift), 2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($reds_program_gift) && !empty($reds_program_gift)) {
						$val['reds_program_gift_name']='Reds Program Gift';
						$val['reds_program_gift_val']=number_format(reds_program_gift_constant_val,2);
						$val['reds_program_gift_val_total']=number_format((reds_program_gift_constant_val * $reds_program_gift),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Reds Program Gift', $reds_program_gift, number_format(reds_program_gift_constant_val,2), number_format((reds_program_gift_constant_val * $reds_program_gift),2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($stars_program_gift) && !empty($stars_program_gift)) {
						$val['stars_program_gift_name']='Stars Program Gift';
						$val['stars_program_gift_val']=number_format(stars_program_gift_constant_val,2);
						$val['stars_program_gift_val_total']=number_format((stars_program_gift_constant_val * $stars_program_gift),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Stars Program Gift', $stars_program_gift, number_format(stars_program_gift_constant_val,2), number_format((stars_program_gift_constant_val * $stars_program_gift),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($gift_wrap_postpage) && !empty($gift_wrap_postpage)) {
						$val['gift_wrap_postpage_name']='Gift Wrap and Postage';
						$val['gift_wrap_postpage_val']=number_format(gift_wrap_postpage_constant_val,2);
						$val['gift_wrap_postpage_val_total']=number_format((gift_wrap_postpage_constant_val * $gift_wrap_postpage),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Gift Wrap and Postage', $gift_wrap_postpage, number_format(gift_wrap_postpage_constant_val,2), number_format((gift_wrap_postpage_constant_val * $gift_wrap_postpage),2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($one_rate_postpage) && !empty($one_rate_postpage)) {
						$val['one_rate_postpage_name']='One Rate Postage';
						$val['one_rate_postpage_val']=number_format(one_rate_postpage_constant_val,2);
						$val['one_rate_postpage_val_total']=number_format((one_rate_postpage_constant_val * $one_rate_postpage),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'One Rate Postage', $one_rate_postpage, number_format(one_rate_postpage_constant_val,2), number_format((one_rate_postpage_constant_val * $one_rate_postpage),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($month_blast_flyer) && !empty($month_blast_flyer)) {
						$val['month_blast_flyer_name']='Month End Blast Flyer';
						$val['month_blast_flyer_val']=number_format(month_blast_flyer_constant_val,2);
						$val['month_blast_flyer_val_total']=number_format((month_blast_flyer_constant_val * $month_blast_flyer),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Month End Blast Flyer', $month_blast_flyer, number_format(month_blast_flyer_constant_val,2), number_format((month_blast_flyer_constant_val * $month_blast_flyer),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}
					
					if (isset($flyer_ecard_unit) && !empty($flyer_ecard_unit)) {
						$val['flyer_ecard_unit_name']='Text and Email to Unit';
						$val['flyer_ecard_unit_val']=number_format(flyer_ecard_unit_constant_val,2);
						$val['flyer_ecard_unit_val_total']=number_format((flyer_ecard_unit_constant_val * $flyer_ecard_unit),2);


						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Text and Email to Unit', $flyer_ecard_unit, number_format(flyer_ecard_unit_constant_val,2), number_format((flyer_ecard_unit_constant_val * $flyer_ecard_unit),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($unit_challenge_flyer) && !empty($unit_challenge_flyer)) {

						$val['unit_challenge_flyer_name']='Unit Challenge Flyer';
						$val['unit_challenge_flyer_val']=number_format(unit_challenge_flyer_constant_val,2);
						$val['unit_challenge_flyer_val_total']=number_format((unit_challenge_flyer_constant_val * $unit_challenge_flyer),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Unit Challenge Flyer', $unit_challenge_flyer, number_format(unit_challenge_flyer_constant_val,2), number_format((unit_challenge_flyer_constant_val * $unit_challenge_flyer),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($team_building_flyer) && !empty($team_building_flyer)) {
						$val['team_building_flyer_name']='Team Building Flyer';
						$val['team_building_flyer_val']=number_format(team_building_flyer_constant_val,2);
						$val['team_building_flyer_val_total']=number_format((team_building_flyer_constant_val * $team_building_flyer),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Team Building Flyer', $team_building_flyer, number_format(team_building_flyer_constant_val,2), number_format((team_building_flyer_constant_val * $team_building_flyer),2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($wholesale_promo_flyer) && !empty($wholesale_promo_flyer)) {
						$val['wholesale_promo_flyer_name']='Wholesale Promo Flyer';
						$val['wholesale_promo_flyer_val']=number_format(wholesale_promo_flyer_constant_val,2);
						$val['wholesale_promo_flyer_val_total']=number_format((wholesale_promo_flyer_constant_val * $wholesale_promo_flyer),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Wholesale Promo Flyer', $wholesale_promo_flyer, number_format(wholesale_promo_flyer_constant_val,2), number_format((wholesale_promo_flyer_constant_val * $wholesale_promo_flyer),2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($postcard_design) && !empty($postcard_design)) {
						$val['postcard_design_name']='Design Fee';
						$val['postcard_design_val']=number_format(postcard_design_constant_val,2);
						$val['postcard_design_val_total']=number_format((postcard_design_constant_val * $postcard_design),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Design Fee', $postcard_design, number_format(postcard_design_constant_val,2), number_format((postcard_design_constant_val * $postcard_design),2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($postcard_edit) && !empty($postcard_edit)) {
						$val['postcard_edit_name']='Custom Changes';
						$val['postcard_edit_val']=number_format(postcard_edit_constant_val,2);
						$val['postcard_edit_val_total']=number_format((postcard_edit_constant_val * $postcard_edit),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Custom Changes', $postcard_edit, number_format(postcard_edit_constant_val,2), number_format((postcard_edit_constant_val * $postcard_edit),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($ecard_unit) && !empty($ecard_unit)) {
						$val['ecard_unit_name']='Small Edit';
						$val['ecard_unit_val']=number_format(ecard_unit_constant_val,2);
						$val['ecard_unit_val_total']=number_format((ecard_unit_constant_val * $ecard_unit),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Small Edit', $ecard_unit, number_format(ecard_unit_constant_val,2), number_format((ecard_unit_constant_val * $ecard_unit),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($speciality_postcard) && !empty($speciality_postcard)) {
						$val['speciality_postcard_name']='Specialty Postcard';
						$val['speciality_postcard_val']=number_format(speciality_postcard_constant_val,2);
						$val['speciality_postcard_val_total']=number_format((speciality_postcard_constant_val * $speciality_postcard),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Specialty Postcard', $speciality_postcard, number_format(speciality_postcard_constant_val,2), number_format((speciality_postcard_constant_val * $speciality_postcard),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($card_with_gift) && !empty($card_with_gift)) {
						$val['card_with_gift_name']='Greeting Card with gift';
						$val['card_with_gift_val']=number_format(card_with_gift_constant_val,2);
						$val['card_with_gift_val_total']=number_format((card_with_gift_constant_val * $card_with_gift),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Greeting Card with gift', $card_with_gift, number_format(card_with_gift_constant_val,2), number_format((card_with_gift_constant_val * $card_with_gift),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($greeting_card) && !empty($greeting_card)) {
						$val['greeting_card_name']='Greeting Card';
						$val['greeting_card_val']=number_format(greeting_card_constant_val,2);
						$val['greeting_card_val_total']=number_format((greeting_card_constant_val * $greeting_card),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Greeting Card', $greeting_card, number_format(greeting_card_constant_val,2), number_format((greeting_card_constant_val * $greeting_card),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($birthday_brownie) && !empty($birthday_brownie)) {
						$val['birthday_brownie_name']='Greeting Card';
						$val['birthday_brownie_val']=number_format(birthday_brownie_constant_val,2);
						$val['birthday_brownie_val_total']=number_format((birthday_brownie_constant_val * $birthday_brownie),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Greeting Post Card', $birthday_brownie, number_format(birthday_brownie_constant_val,2), number_format((birthday_brownie_constant_val * $birthday_brownie),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($birthday_starbucks) && !empty($birthday_starbucks)) {
						$val['birthday_starbucks_name']='Birthday Cards and Starbucks';
						$val['birthday_starbucks_val']=number_format(birthday_starbucks_constant_val,2);
						$val['birthday_starbucks_val_total']=number_format((birthday_starbucks_constant_val * $birthday_starbucks),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Birthday Cards and Starbucks', $birthday_starbucks, number_format(birthday_starbucks_constant_val,2), number_format((birthday_starbucks_constant_val * $birthday_starbucks),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($anniversary_starbucks) && !empty($anniversary_starbucks)) {
						$val['anniversary_starbucks_name']='Anniversary Card and Starbucks';
						$val['anniversary_starbucks_val']=number_format(anniversary_starbucks_constant_val,2);
						$val['anniversary_starbucks_val_total']=number_format((anniversary_starbucks_constant_val * $anniversary_starbucks),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Anniversary Card and Starbucks', $anniversary_starbucks, number_format(anniversary_starbucks_constant_val,2), number_format((anniversary_starbucks_constant_val * $anniversary_starbucks),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($referral_credit) && !empty($referral_credit)) {
						$val['referral_credit_name']='Referral Credit';
						$val['referral_credit_val']=number_format(referral_credit_constant_val,2);
						$val['referral_credit_val_total']=number_format((referral_credit_constant_val * $referral_credit),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Referral Credit', $referral_credit, number_format(referral_credit_constant_val,2), number_format((referral_credit_constant_val * $referral_credit),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($cc_billing) && !empty($cc_billing)) {
						$val['cc_billing_name']='Consultant Communication- billing';
						$val['cc_billing_val']=number_format(UACC_BILLING,2);
						$val['cc_billing_val_total']=number_format((UACC_BILLING * $cc_billing),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Consultant Communication- billing', $cc_billing, number_format(UACC_BILLING), number_format((UACC_BILLING * $cc_billing),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($customer_newsletter) && !empty($customer_newsletter)) {
						$val['customer_newsletter_name']='Customer Newsletter';
						$val['customer_newsletter_val']=number_format(customer_newsletter_constant_val,2);
						$val['customer_newsletter_val_total']=number_format((customer_newsletter_constant_val * $customer_newsletter),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Customer Newsletter', $customer_newsletter, number_format(customer_newsletter_constant_val,2), number_format((customer_newsletter_constant_val * $customer_newsletter),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($birthday_postcard) && !empty($birthday_postcard)) {

						$val['birthday_postcard_name']='Birthday Postcards';
						$val['birthday_postcard_val']=number_format(birthday_postcard_constant_val,2);
						$val['birthday_postcard_val_total']=number_format((birthday_postcard_constant_val * $birthday_postcard),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Birthday Postcards', $birthday_postcard, number_format(birthday_postcard_constant_val,2), number_format((birthday_postcard_constant_val * $birthday_postcard),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($anniversary_postcard) && !empty($anniversary_postcard)) {
						$val['anniversary_postcard_name']='Anniversary Postcards';
						$val['anniversary_postcard_val']=number_format(anniversary_postcard_constant_val,2);
						$val['anniversary_postcard_val_total']=number_format((anniversary_postcard_constant_val * $anniversary_postcard),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Anniversary Postcards', $anniversary_postcard, number_format(anniversary_postcard_constant_val,2), number_format((anniversary_postcard_constant_val * $anniversary_postcard),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($picture_texting) && !empty($picture_texting)) {
						$val['picture_texting_name']='Picture Texting';
						$val['picture_texting_val']=number_format(picture_texting_constant_val,2);
						$val['picture_texting_val_total']=number_format((picture_texting_constant_val * $picture_texting),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Picture Texting', $picture_texting, number_format(picture_texting_constant_val,2), number_format((picture_texting_constant_val * $picture_texting),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($keyword) && !empty($keyword)) {
						$val['keyword_name']='Keywords for texting system';
						$val['keyword_val']=number_format(keyword_constant_val,2);
						$val['keyword_val_total']=number_format((keyword_constant_val * $keyword),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Keywords for texting system', $keyword, number_format(keyword_constant_val,2), number_format((keyword_constant_val * $keyword),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($client_setup) && !empty($client_setup)) {
						$val['client_setup_name']='New Client Set up Fee';
						$val['client_setup_val']=number_format(client_setup_constant_val,2);
						$val['client_setup_val_total']=number_format((client_setup_constant_val * $client_setup),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'New Client Set up Fee', $client_setup, number_format(client_setup_constant_val,2), number_format((client_setup_constant_val * $client_setup),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($nl_flyer) && !empty($nl_flyer)) {
						$val['nl_flyer_name']='Graphic Insert';
						$val['nl_flyer_val']=number_format(nl_flyer_constant_val,2);
						$val['nl_flyer_val_total']=number_format((nl_flyer_constant_val * $nl_flyer),2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Graphic Insert', $nl_flyer, number_format(nl_flyer_constant_val,2), number_format((nl_flyer_constant_val * $nl_flyer),2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (isset($misc_charge) && !empty($misc_charge)) {
						$val['misc_charge_name']=$misc_description;
						$val['misc_charge_val']=number_format($misc_charge,2);
						$val['misc_charge_val_total']=number_format($misc_charge, 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, $misc_description, '', number_format($misc_charge,2), number_format($misc_charge,2) );
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if (!empty($special_credit) || !empty($package_note)) {
						$val['special_credit_name']=$package_note;
						$val['special_credit_val']=number_format($special_credit,2);
						$val['special_credit_val_total']=number_format($special_credit, 2);

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, $package_note, $special_credit, number_format($special_credit,2), number_format($special_credit,2));
						$size = $pdf->addLine($y, $line);
						$l_num++;
						if (strlen($package_note) < 108) {
				            $y += 10;    
				        }elseif (strlen($package_note) > 108) {
				            $y += 25;    
				        }elseif (strlen($package_note) > 216) {
				            $y += 35;    
				        }elseif (strlen($package_note) > 324) {
				            $y += 45;    
				        }
					}

					if (!empty($invoice_note)) {
						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, $invoice_note, '1', 0, 0);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						if (strlen($invoice_note) < 108) {
				            $y += 10;    
				        }elseif (strlen($invoice_note) > 108) {
				            $y += 25;    
				        }elseif (strlen($invoice_note) > 216) {
				            $y += 35;    
				        }elseif (strlen($invoice_note) > 324) {
				            $y += 45;    
				        }
					}

					if ($aNewsData['account_detail'] == 'N' && $CCcharge > 0) {
						$val['cc_charge_name']='Charges on credit card payment @ 5%';
						$val['cc_charge_val']=$CCcharge;
						$val['cc_charge_val_total']=$CCcharge;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Charges on credit card payment @ 5%', '', $CCcharge, $CCcharge);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					if ((float)$Credit < 0) {
						$val['credit_roll_over_name']='Account credit roll over';
						$val['credit_roll_over_val']=$Credit;
						$val['credit_roll_over_val_total']=$Credit;

						$y = ($y == 65 ? $y = 65 : $y);
						$line = pdf_format($l_num, 'Account credit roll over', '', $Credit, $Credit);
						$size = $pdf->addLine($y, $line);
						$l_num++;
						$y += 10;
						if ($l_num == 19) {
							$y=8;
							$pdf->AddPage();
							/*$cols = array("#" => 14, "Name" => 95, "Quantity" => 29, "Value($)" => 29, "Total($)" => 30);
							$pdf->addCols($cols);
							$pdf->addLineFormat($cols);*/
						}
					}

					$val['total'] = $nTotalKey;
					$sSerialData = serialize($val);

					$alredInvoiced = empty($val['id_invoice']) ? '' : $val['id_invoice'];

					if ($alredInvoiced != '') {
						$created_at = $this->billing_model->get_pdf_date($alredInvoiced);
						$sPdfDate = str_replace('-', '_', $created_at); // date("Y_m_d");
					} else {
						$sPdfDate = date("Y_m_d");
					}

					$pdf->total("$" . number_format($nTotalKey, 2));
					if (isset($special_creadit) && $special_creadit > 0) {
						$pdf->credit("-$" . $special_creadit);
					}
				
					$sPdfData = $aNewsData['consultant_number'] . "_" . $sPdfDate . ".pdf";
					$filename = "assets/uploads/billing/" . $sPdfData;
					//$pdf->Output($filename, 'F');
					$invoice_name = $this->billing_model->get_invoice_name($id_newsletter);

					if (!empty($invoice_name)) {
						$pdf_old = explode('_', $invoice_name['invoice_name']);
					}

					$aCurrentDate = $this->billing_model->get_current_date($id_newsletter);
					$Pstatus = 'P';
					$BAL = (GetTotalDue($id_newsletter) - GetBalance($id_newsletter)); 

					if (empty($val['id_invoice'])) {
						if (empty($Credit)) {
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
							$aTotalPaidData = $this->billing_model->get_total_paid($val['id_invoice']);
							$UpdateDUE = $aTotalPaidData['total'] -  $aTotalPaidData['total_paid'];	
						}else{
							$UpdateDUE = $nTotalKey;
						}
					}

					$Pstatus = ($UpdateDUE > 0) ? 'R' : 'S';



					$details = array('data'=>$sSerialData, 'total'=>$nTotalKey, 'invoice_date' =>$sDate,  'due_amount'=>$UpdateDUE, 'payment_status'=>$Pstatus, 'invoice_name'=>$sPdfData, 'create_by'=>$create_by, 'updated_at' =>$sDate);

					if (isset($val['id_invoice']) && $val['id_invoice'] != '') {		
						if ($pdf_old[0] == $aNewsData['consultant_number']) {
							$filename = './assets/uploads/billing/'.$invoice_name['invoice_name'];
			        		@unlink($filename);
						}
						
						$pdf->Output($filename, 'F');
						$this->billing_model->update_pdf_invoice($details, $val['id_invoice']);
						
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
							$this->billing_model->update_pdf_invoice($details, $aCurrentDate['id_invoice']);
						} else {
							$pdf->Output($filename, 'F');
							$details['total_paid'] = $paid_amount;
							$details['id_newsletter'] = $id_newsletter;
							$details['consultant_number'] = $aNewsData['consultant_number'];
							$details['created_at'] = $sDate;
							$this->billing_model->insert_pdf_invoice($details);
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
   	}

    /*function save_all_invoice() {
		if (!empty($this->input->post())) {
			$this->billing_model->CreatePdf($this->input->post(), 'all');
		}
    }*/
    
	function make_payment(){
		if (!empty($this->input->post())) {
			$dDate = date('Y-m-d');
			$id_invoice = $this->input->post('id_invoice');
			$amount = $this->input->post('amount');
			$aTotal = $this->billing_model->getTotal($id_invoice);

			if ($aTotal['due_amount'] > 0 || $aTotal['payment_status'] != 'S') {
				$fTotalpaid = (float) $aTotal['total_paid'] + (float) $amount + GetBalance($aTotal['id_newsletter']);
				$nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;

				if ($aTotal['total'] <= $fTotalpaid) {
					//bal
					$bal = abs($nFinalTotal);
					$sPayStatus = 'S';
					$fTotalpaid = $aTotal['total'];
					$nFinalTotal = 0;
				} else {
					$sPayStatus = 'R';
					$bal = 0;
				}
				
				$this->billing_model->update_invoice($nFinalTotal,$fTotalpaid,$sPayStatus,$amount,$id_invoice);

				if ($bal > 0) {
					$Ocount = $this->billing_model->get_invoice_count($aTotal['id_newsletter']);
					if ($Ocount['cont'] > 0) {
						for ($i = 1; $i <= $Ocount['cont']; $i++) {
							if ((float) $bal > 0) {
								$GetOld = $this->billing_model->get_old_invoice($aTotal['id_newsletter']);
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

									$this->billing_model->update_invoice($OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_invoice']);

								} else {
									SetBalance($aTotal['id_newsletter'], ($bal));
									$bal = 0;
									$Obal = 0;
								}
								$bal = $Obal;
							}
						}
					} else {
						$bal = (float) $aTotal['total'] - $fTotalpaid;
						$TotBAL = abs($bal);
						SetBalance($aTotal['id_newsletter'], $TotBAL);
					}
				} else {
					SetBalance($aTotal['id_newsletter'], $bal);
				}
			} else {
				$GOLD = GetBalance($aTotal['id_newsletter']);
				$bal = $amount + $GOLD;
				SetBalance($aTotal['id_newsletter'], $bal);
				if ($bal > 0) {
					$Ocount = $this->billing_model->get_invoice_count($aTotal['id_newsletter']);
					if ($Ocount['cont'] > 0) {
						for ($i = 1; $i <= $Ocount['cont']; $i++) {
							if (GetBalance($aTotal['id_newsletter']) > 0) {
								$GetOld = $this->billing_model->get_old_invoice($aTotal['id_newsletter']);
								// in
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

									$this->billing_model->update_invoice($OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_invoice']);
									SetBalance($aTotal['id_newsletter'], $Obal);
								}
							}
						}
					} else {
						SetBalance($aTotal['id_newsletter'], $bal);
					}
				}

			}
		}	
	}

	function credit_payment() {
		$data['data'] = $this->billing_model->credit_payment_clients();
		$this->global['pageTitle'] = 'Billing : Credit Payment';
		BillingViews("billing/credit_payment", $this->global, $data, NULL);
	}

	function payment_credit(){
		if(!empty($this->input->post())) {
			$data['data'] = $this->input->post();
		}else {
			$data['data'] = '';
		}

		$this->global['pageTitle'] = 'Billing : Payment';
		/*BillingViews("billing/payment", $this->global, $data, NULL);*/
		$this->load->view("billing/payment", $data);
	}

	function proccess_payment() {
		require APPPATH .'/libraries/connect-php-sdk-master/autoload.php';
		$id_invoice = $this->input->post('id_invoice');
		$aData = $this->billing_model->get_invoice_data($id_invoice);
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

		$aInvoiceData = $this->input->post('c_amount'); 
		$amount = round($aInvoiceData * 100);

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
		          if($total_due <= 0) {
		            $status = 'S';
		          }else {
		            $status = 'R';
		          }
		          if($total_paid > $iTotal) {
		              $BAL = $total_paid - $iTotal; 
		              $CBAL = GetBalance($aData['id_newsletter']);
		              SetBalance($CBAL + $BAL);
		          }

		           $this->billing_model->make_payment_invoice($id_invoice, $total_paid, $total_due, $status);
				   echo "<h1 style='text-align:center'>Payment Successful!! </h1>";
		  }
		  

		} catch (\SquareConnect\ApiException $e) {

		  $this->billing_model->edit_cancel_payment($id_invoice, 'D');

		 echo "<h1 style='text-align:center'>Payment Failed Please Try Again</h1>";
		 /*  echo "Caught exception!<br/>";
		  print_r("<strong>Response body:</strong><br/>");
		  echo "<pre>"; print_r($e->getResponseBody()); echo "</pre>";
		  echo "<br/><strong>Response headers:</strong><br/>";
		  echo "<pre>"; print_r($e->getResponseHeaders()); echo "</pre>";*/
		}
		
	}

	function unpaid($value='') {
		if (!empty($this->input->post('is_unpaid'))) {
			$id_invoice = $this->input->post('id_invoice');
			$amount = $this->input->post('amount');
			$aTotal = $this->billing_model->getTotal($id_invoice);
			$Tbal = (GetTotalDue($aTotal['id_newsletter']) - GetBalance($aTotal['id_newsletter']));
			if ($Tbal <= 0) {
				if ($Tbal <= $amount) {
					$reaming = ((float)$amount - abs($Tbal));
					SetBalance($aTotal['id_newsletter'],0);
					if ($reaming > 0) {
						if ($aTotal['total_paid'] != 0) {
							$fTotalpaid = (float) $aTotal['total_paid'] - (float) $reaming;
							$nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;
							$nDua = (float) $aTotal['total'] - $fTotalpaid;
							$nDua = number_format($nDua, 2);
							$sPayStatus = ($nDua <= 0) ? 'S' : 'R';
							$this->billing_model->update_due_amount($nDua, $fTotalpaid, $sPayStatus, $reaming, $id_invoice);
						}
					}
				}else {
					$reaming = ((float)$Tbal - (float)$amount);
					SetBalance($aTotal['id_newsletter'],$reaming);
				}
			}else {
				if ($aTotal['total_paid'] != 0) {
					$fTotalpaid = (float) $aTotal['total_paid'] - (float) $amount;
					$nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;
					$nDua = (float) $aTotal['total'] - $fTotalpaid;
					$nDua = number_format($nDua, 2);
					$sPayStatus = ($nDua <= 0) ? 'S' : 'R';
					$this->billing_model->update_due_amount($nDua, $fTotalpaid, $sPayStatus, $amount, $id_invoice);
				}
			}
		}
	}

	function get_mail_content() {
    	echo GetInvoiceMailContent($this->input->post('id_newsletter'), $this->input->post('id_invoice'));
    }

    function send_invoice_mail() {
    	if (!empty($this->input->post())) {
    		$id_newsletter = $this->input->post('id_newsletter');
    		$id_invoice = $this->input->post('id_invoice');
    		$e_data = $this->input->post('e_data');
			$Details = $this->billing_model->get_invoice_mail($id_newsletter, $id_invoice);
		    $date = strtotime($Details['create_invoice_at']);
		    $sMonth = date('F', $date);

		    $invoicepdf = base_url('assets/uploads/billing/').$Details['invoice_name'];
	    
		    $Subject = "Unit Assistant Invoice for ".$sMonth;
		    if($Details['newsletters_design'] == 'E'){
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
				$result = $this->billing_model->save_invoice_mail($id_newsletter, $id_invoice, $e_data);
				echo ($result) ? '1' : '0';
			}else {
				echo '0';	
			}
    	}
    }

    function reset_balance($id_newsletter){
    	if(!empty($id_newsletter)) {
			SetBalance($id_newsletter,0);
			redirect('billing/clients','refresh');
		}
    }

    function reset_all_balance() {
		if (!empty($this->input->post('ids'))) {
			$ids = $this->input->post('ids');
			foreach ($ids as $key => $value) {
				SetBalance($value, 0);
			}
			echo "Balance set successfully!!";
		}
	}

	function delete_all_invoice() {
		if (!empty($this->input->post())) {
			$months = substr($this->input->post('delete_all'), 0, -1);
			$invoiceDetails = $this->billing_model->get_invoice_details($months);
			if (!empty($invoiceDetails)) {
				foreach ($invoiceDetails as $key => $val) {
					$filename = './assets/uploads/billing/'.$val['invoice_name'];
        			unlink($filename);
        			$delete_invoice = $this->billing_model->delete_invoice($months, $val['id_invoice']);
					$bal = $this->billing_model->get_due_amount($val['id_newsletter']);
					if(empty($bal)) {
				       SetBalance($val['id_newsletter'], 0);
			        }else {
				        if($bal['due_amount'] < 0) {
				            SetBalance($val['id_newsletter'], abs($bal['due_amount']));
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
	}

	function send_selected_invoice_mail(){

		require_once APPPATH."/third_party/mailchimp-api-master/vendor/autoload.php"; 
		require_once APPPATH."/third_party/mailchimp-api-master/src/MailChimp.php";
		require_once APPPATH."/third_party/mailchimp-api-master/mcapi.php";
		require_once APPPATH."/third_party/mailchimp-api-master/examples/config/config.inc.php";
		
		$list_id = billing_list_id;
		$MailChimp = new \DrewM\MailChimp\MailChimp(mailchimp_key);

		if ($this->input->post('send_all')=='1') {
			$invoceData = $this->billing_model->get_invoice_mail_data(0);
		}else{
			$id_newsletters = implode(',', $this->input->post('id_newsletters'));
			$invoceData = $this->billing_model->get_invoice_mail_data($id_newsletters);
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
			    $attachment =  base_url("assets/uploads/billing/".$value['invoice_name']);
			    $attachment_encoded = base64_encode($attachment); 
			            
	            if(in_array($value['email'], $aSubscribesEmails)) {
	                $result = $MailChimp->patch("lists/$list_id/members/$memberId", [
	                    'status'        => 'subscribed',
	                    'merge_fields'  => ['FNAME' => $value['name'], 'MMLINKPDF' => $attachment,'LANGUAGE'=>$value['newsletters_design']],
	                ]);
	            }else {
	                $result = $MailChimp->post("lists/$list_id/members", [
	                    'email_address' => $value['email'],
	                    'status'        => 'subscribed',
	                    'merge_fields'  => ['FNAME' => $value['name'], 'MMLINKPDF' => $attachment,'LANGUAGE'=>$value['newsletters_design']],
	                ]);
	            }

	            if( isset($result['status']) && $result['status']=='subscribed') {
	            	$this->billing_model->update_invoice_status('1', $value['id_invoice']); 
	            }else {
	            	$this->billing_model->update_invoice_status('2', $value['id_invoice']);
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
		      'template' => ['id' => billing_template_id, 
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

	function Unsbclients() {
		$data['clients'] = $this->billing_model->getUnsbClients();
		$this->global['pageTitle'] = 'Billing : Unsubscribed Client List';
		BillingViews("billing/Unsbclients", $this->global, $data, NULL);
	}

}
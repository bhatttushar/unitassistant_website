<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_excel extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('billing/upload_excel_model');
        $this->load->helper('directors/director_helper');
        $this->load->helper('directors/billing_helper');
        $this->load->library('excel');
	}

	function upload_balance_excel(){
		if (!empty($_FILES['excelPrice']['name'])) {
            $config['upload_path'] = 'assets/uploads/upload_balance_excel/';
			$config['allowed_types'] = 'xlsx|xls';
			$this->load->library('upload', $config);
			$sInputFileName = '';
			if ($this->upload->do_upload('excelPrice')) {
				$data = $this->upload->data();
				$sInputFileName = $config['upload_path'].$data['file_name'];
			}
            try {
                $inputFileType = PHPExcel_IOFactory::identify($sInputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($sInputFileName);
            } catch(Exception $e) {
                die('Error loading file "'. pathinfo($sInputFileName, PATHINFO_BASENAME) . '": ' .$e->getMessage());
            }

            $objPHPExcel = $objReader->load($sInputFileName);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $nHighestRow = $objWorksheet->getHighestRow();
            $nHighestColumn = $objWorksheet->getHighestColumn();
            $nHighestColumnIndex = PHPExcel_Cell::columnIndexFromString($nHighestColumn);
            $sSheetName = $objWorksheet->getCellByColumnAndRow(0, 1)->getValue();

            if($sSheetName != 'Upload Payment Excel') {
               echo $this->file_not_match($sInputFileName);
               exit();
            }

            for ($nRow = 2; $nRow <= $nHighestRow; $nRow++) {
                $aRows = array();
                for ($nCol = 0; $nCol <= $nHighestColumnIndex; ++$nCol) {
                    $aRows[] = $objWorksheet->getCellByColumnAndRow($nCol, $nRow)->getValue();
                }

                $aTotal = $this->upload_excel_model->getTotal($aRows[1]);
                $amount = $aRows[2];

                if ($aTotal['last_paid'] != $amount || $aTotal['due_amount'] > 0) {
                    if (!empty($aTotal)) {
                        if ($aTotal['due_amount'] > 0 || $aTotal['payment_status'] != 'S') {
                            $fTotalpaid = (float) $aTotal['total_paid'] + (float) $amount;
                            $nFinalTotal = (float) $aTotal['total'] - $fTotalpaid;
                            if ($aTotal['total'] <= $fTotalpaid) {
                                $bal = $fTotalpaid - $aTotal['total'];
                                $sPayStatus = 'S';
                                $fTotalpaid = $aTotal['total'];
                                $nFinalTotal = 0;
                            } else {
                                $sPayStatus = 'R';
                                $bal = 0;
                            }
                            $sUpdate = $this->upload_excel_model->update_invoice($amount, $nFinalTotal, $fTotalpaid, $sPayStatus, $aTotal['id_invoice']);
                            if ($bal > 0) {
                                $Ocount = $this->upload_excel_model->get_invoice_count($aTotal['id_newsletter']);
                                if ($Ocount['cont'] > 0) {
                                    for ($i = 1; $i <= $Ocount['cont']; $i++) {
                                        if ((float) $bal > 0) {
                                            $GetOld=$this->upload_excel_model->get_old_invoice($aTotal['id_newsletter']);
                                            if (count($GetOld) > 0) {
                                                $OTotalpaid = (float) $GetOld['total_paid'] + $bal;
                                                $OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
                                                if ($GetOld['total'] <= $OTotalpaid) {
                                                    $OPayStatus = 'S';
                                                    if ($GetOld['due_amount'] < $OTotalpaid) {
                                                        $OFinalTotal = 0;
                                                        $OTotalpaid = $GetOld['total'];
                                                        $Obal = $bal - $GetOld['total'];
                                                    }
                                                } else {
                                                    $OTotalpaid = (float) $GetOld['total_paid'] + $bal;
                                                    $OFinalTotal = (float) $GetOld['total'] - $OTotalpaid;
                                                    $OPayStatus = 'R';
                                                    $Obal = $bal - $GetOld['total'];
                                                }
                                                $sUpdate = $this->upload_excel_model->update_invoice($amount, $OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_invoice']);
                                            } else {
                                                SetBalance($aTotal['id_newsletter'], $bal);
                                            }
                                            $bal = 0;
                                        }
                                    }
                                } else {
                                    $bal = (float) $aTotal['total'] - $fTotalpaid;
                                    $TotBAL = abs($bal);
                                    SetBalance($aTotal['id_newsletter'], $TotBAL);
                                }
                            }
                        } else {
                            //Paid and success
                            $GOLD = GetBalance($aTotal['id_newsletter']);
                            $bal = $amount + $GOLD;
                            SetBalance($aTotal['id_newsletter'], $bal);
                            if ($bal > 0) {
                                $Ocount = $this->upload_excel_model->get_invoice_count($aTotal['id_newsletter']);
                                if ($Ocount['cont'] > 0) {
                                    for ($i = 1; $i <= $Ocount['cont']; $i++) {
                                        if (GetBalance($aTotal['id_newsletter']) > 0) {
                                            $GetOld=$this->upload_excel_model->get_old_invoice($aTotal['id_newsletter']);
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
                                                $sUpdate = $this->upload_excel_model->update_invoice($amount, $OFinalTotal, $OTotalpaid, $OPayStatus, $GetOld['id_invoice']);
                                                SetBalance($aTotal['id_newsletter'], $Obal);
                                            }
                                        }
                                    }
                                } else {
                                    $bal = (float) $aTotal['total'] - $fTotalpaid;
                                    $TotBAL = abs($bal);
                                    SetBalance($aTotal['id_newsletter'], $TotBAL);
                                }
                            }
                        }
                    }
                }
            }
            //if (count($aTotal) > 0) {
                redirect('admin/directors');
            //}
            exit();
		}
	}

    function upload_unit_excel(){
        if (!empty($_FILES['excelUnit']['name'])) {

            $config['upload_path'] = 'assets/uploads/upload_unit_excel/';
            $config['allowed_types'] = 'xlsx|xls';

            $this->load->library('upload', $config);

            $sInputFileName = '';
            if ($this->upload->do_upload('excelUnit')) {
                $data = $this->upload->data();
                $sInputFileName = $config['upload_path'].$data['file_name'];
            }

            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($sInputFileName);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $nHighestRow = $objWorksheet->getHighestRow();
            $nHighestColumn = $objWorksheet->getHighestColumn();
            $nHighestColumnIndex = PHPExcel_Cell::columnIndexFromString($nHighestColumn);
            $sSheetName = $objWorksheet->getCellByColumnAndRow(0, 1)->getValue();

            if($sSheetName != 'Upload Unit Size Excel') {
               echo $this->file_not_match($sInputFileName);
               exit();
            }

            for ($nRow = 2; $nRow <= $nHighestRow; ++$nRow) {
                $aRows = array();
                for ($nCol = 0; $nCol <= $nHighestColumnIndex; ++$nCol) {
                    $aRows[] = $objWorksheet->getCellByColumnAndRow($nCol, $nRow)->getValue();
                }

                $aPriceDetail = $this->upload_excel_model->getPriceDetail($aRows[1]);
                if (!empty($aPriceDetail)) {
                    $sPackage = $aPriceDetail['package'];
                    $iGrandTotal = 0;
                    $iGrandSTotal = 0;
                    
                    if ($aPriceDetail['facebook'] != 0 && $aPriceDetail['facebook'] != '') {
                        $iGrandTotal = facebook;
                        $iGrandSTotal = facebook;
                    }
                    
                    if ($aPriceDetail['emailing'] == 1) {
                        $iGrandTotal += emailing_0;
                        $iGrandSTotal += emailing_0;
                    } elseif ($aPriceDetail['emailing'] == 2) {
                        $iGrandTotal += emailing_1;
                        $iGrandSTotal += emailing_1;
                    }
                    
                    if ($aPriceDetail['email_newsletter'] != 0 && $aPriceDetail['email_newsletter'] != '') {
                        $iGrandTotal += email_newsletter;
                        $iGrandSTotal += email_newsletter;
                    }
                    
                    if ($aPriceDetail['digital_biz_card'] != 0 && $aPriceDetail['digital_biz_card'] != '') {
                        $iGrandTotal += digital_biz_card;
                        $iGrandSTotal += digital_biz_card;
                    }
                    
                    if ($aPriceDetail['other_language_newsletter']!=0 && $aPriceDetail['other_language_newsletter']!='') {
                        $iGrandTotal += other_language_newsletter;
                        $iGrandSTotal += other_language_newsletter;
                    }
                    
                    if ($aPriceDetail['magic_booker'] != 0 && $aPriceDetail['magic_booker'] != '') {
                        $iGrandTotal += MAGIC_BOOKER;
                        $iGrandSTotal += MAGIC_BOOKER;
                    }
                    
                    if ($aPriceDetail['prospect_system'] != 0 && $aPriceDetail['prospect_system'] != '') {
                        $iGrandTotal += PROSPECT_SYSTEM;
                        $iGrandSTotal += PROSPECT_SYSTEM;
                    }
                    
                    if ($aPriceDetail['personal_website'] != 1) {
                        if ($aPriceDetail['personal_unit_app'] != 0 && $aPriceDetail['personal_unit_app'] != '') {
                            if ($sPackage == 'N') {
                                $iGrandTotal += pack_personal_unit_app_val;
                                $iGrandSTotal += pack_personal_unit_app_val;
                            } else {
                                $iGrandTotal += personal_unit_app_val;
                                $iGrandSTotal += personal_unit_app_val;
                            }
                        }
                    }
                    
                    if ($aPriceDetail['personal_unit_app'] != 1) {
                        if ($aPriceDetail['personal_website'] != 0 && $aPriceDetail['personal_website'] != '') {
                            if ($sPackage != 'N') {
                                $iGrandTotal += personal_website_val;
                                $iGrandSTotal += personal_website_val;
                            } else {
                                $iGrandTotal += pack_personal_website_val;
                                $iGrandSTotal += pack_personal_website_val;
                            }
                        }
                    }
                    
                    if ($aPriceDetail['personal_website'] == 1 && $aPriceDetail['personal_unit_app'] == 1) {
                        if ($sPackage == 'N') {
                            $iGrandTotal += pack_personal_website_val;
                            $iGrandSTotal += pack_personal_website_val;
                        } else {
                            $iGrandTotal += personal_website_val;
                            $iGrandSTotal += personal_website_val;
                        }
                    }
                    
                    if ($aPriceDetail['personal_unit_app_ca'] != 0 && $aPriceDetail['personal_unit_app_ca'] != '') {
                        $iGrandTotal += personal_unit_app_canada;
                        $iGrandSTotal += personal_unit_app_canada;
                    }
                    
                    if ($aPriceDetail['personal_url'] != 0 && $aPriceDetail['personal_url'] != '') {
                        $iGrandTotal += personal_url_val;
                        $iGrandSTotal += personal_url_val;
                    }
                    
                    if ($aPriceDetail['subscription_updates'] != 0 && $aPriceDetail['subscription_updates'] != '') {
                        $iGrandTotal += subscription_updates_val;
                        $iGrandSTotal += subscription_updates_val;
                    }
                    
                    if ($aPriceDetail['app_color'] != 0 && $aPriceDetail['app_color'] != '') {
                        $iGrandTotal += app_color_val;
                        $iGrandSTotal += app_color_val;
                    }
                    
                    if ($aPriceDetail['nsd_client'] != 1) {
                        if ($aPriceDetail['total_text_program'] == 1) {
                            if ($sPackage == 'S' || $sPackage == 'R' || $sPackage == 'E1' || $sPackage == 'S1' || $sPackage == 'D' || $sPackage == 'E') {
                                $iGrandTotal += total_text_program_s_e1_r;
                                $iGrandSTotal += total_text_program_s_e1_r;
                            } elseif ($sPackage == 'P') {
                                $iGrandTotal += total_text_program_d_e_p;
                                $iGrandSTotal += total_text_program_d_e_p;
                            } elseif ($sPackage == 'N' || $sPackage == '') {
                                $iGrandTotal += total_text_program_n;
                                $iGrandSTotal += total_text_program_n;
                            }
                        }
                    }
                     if($aPriceDetail['total_text_program7'] == 1) {
                        if ($sPackage == 'N' || $sPackage == '') {
                            $iGrandTotal += total_text_program7_n;
                            $iGrandSTotal += total_text_program7_n;
                        }elseif ($sPackage == 'P') {
                            $iGrandTotal += total_text_program7_p;
                            $iGrandSTotal += total_text_program7_p;
                        }else {
                            $iGrandTotal += total_text_program7_y;
                            $iGrandSTotal += total_text_program7_y;
                        }
                    }
                    
                    if ($aPriceDetail['newsletter_color'] != '' && $aPriceDetail['newsletter_color'] != 0) {
                        $iGrandTotal += $aPriceDetail['newsletter_color'] * newsletter_color_constant_val;
                    }
                    if ($aPriceDetail['newsletter_black_white'] != '' && $aPriceDetail['newsletter_black_white'] != 0) {
                        $iGrandTotal += $aPriceDetail['newsletter_black_white'] * newsletter_black_white_constant_val;
                    }
                    if ($aPriceDetail['month_packet_postage'] != '' && $aPriceDetail['month_packet_postage'] != 0) {
                        $iGrandTotal += $aPriceDetail['month_packet_postage'] * month_packet_postage_constant_val;
                    }
                    if ($aPriceDetail['consultant_packet_postage'] != '' && $aPriceDetail['consultant_packet_postage'] != 0) {
                        $iGrandTotal += $aPriceDetail['consultant_packet_postage'] * consultant_packet_postage_constant_val;
                    }
                    if ($aPriceDetail['consultant_bundles'] != '' && $aPriceDetail['consultant_bundles'] != 0) {
                        $iGrandTotal += $aPriceDetail['consultant_bundles'] * consultant_bundles_constant_val;
                    }
                    if ($aPriceDetail['consistency_gift'] != '' && $aPriceDetail['consistency_gift'] != 0) {
                        $iGrandTotal += $aPriceDetail['consistency_gift'] * consistency_gift_constant_val;
                    }
                    if ($aPriceDetail['reds_program_gift'] != '' && $aPriceDetail['reds_program_gift'] != 0) {
                        $iGrandTotal += $aPriceDetail['reds_program_gift'] * reds_program_gift_constant_val;
                    }
                    if ($aPriceDetail['stars_program_gift'] != '' && $aPriceDetail['stars_program_gift'] != 0) {
                        $iGrandTotal += $aPriceDetail['stars_program_gift'] * stars_program_gift_constant_val;
                    }
                    if ($aPriceDetail['gift_wrap_postpage'] != '' && $aPriceDetail['gift_wrap_postpage'] != 0) {
                        $iGrandTotal += $aPriceDetail['gift_wrap_postpage'] * gift_wrap_postpage_constant_val;
                    }
                    if ($aPriceDetail['one_rate_postpage'] != '' && $aPriceDetail['one_rate_postpage'] != 0) {
                        $iGrandTotal += $aPriceDetail['one_rate_postpage'] * one_rate_postpage_constant_val;
                    }
                    if ($aPriceDetail['month_blast_flyer'] != '' && $aPriceDetail['month_blast_flyer'] != 0) {
                        $iGrandTotal += $aPriceDetail['month_blast_flyer'] * month_blast_flyer_constant_val;
                    }
                    if ($aPriceDetail['flyer_ecard_unit'] != '' && $aPriceDetail['flyer_ecard_unit'] != 0) {
                        $iGrandTotal += $aPriceDetail['flyer_ecard_unit'] * flyer_ecard_unit_constant_val;
                    }
                    if ($aPriceDetail['unit_challenge_flyer'] != '' && $aPriceDetail['unit_challenge_flyer'] != 0) {
                        $iGrandTotal += $aPriceDetail['unit_challenge_flyer'] * unit_challenge_flyer_constant_val;
                    }
                    if ($aPriceDetail['team_building_flyer'] != '' && $aPriceDetail['team_building_flyer'] != 0) {
                        $iGrandTotal += $aPriceDetail['team_building_flyer'] * team_building_flyer_constant_val;
                    }
                    if ($aPriceDetail['wholesale_promo_flyer'] != '' && $aPriceDetail['wholesale_promo_flyer'] != 0) {
                        $iGrandTotal += $aPriceDetail['wholesale_promo_flyer'] * wholesale_promo_flyer_constant_val;
                    }
                    if ($aPriceDetail['postcard_design'] != '' && $aPriceDetail['postcard_design'] != 0) {
                        $iGrandTotal += $aPriceDetail['postcard_design'] * postcard_design_constant_val;
                    }
                    if ($aPriceDetail['postcard_edit'] != '' && $aPriceDetail['postcard_edit'] != 0) {
                        $iGrandTotal += $aPriceDetail['postcard_edit'] * postcard_edit_constant_val;
                    }
                    if ($aPriceDetail['ecard_unit'] != '' && $aPriceDetail['ecard_unit'] != 0) {
                        $iGrandTotal += $aPriceDetail['ecard_unit'] * ecard_unit_constant_val;
                    }
                    if ($aPriceDetail['speciality_postcard'] != '' && $aPriceDetail['speciality_postcard'] != 0) {
                        $iGrandTotal += $aPriceDetail['speciality_postcard'] * speciality_postcard_constant_val;
                    }
                    if ($aPriceDetail['card_with_gift'] != '' && $aPriceDetail['card_with_gift'] != 0) {
                        $iGrandTotal += $aPriceDetail['card_with_gift'] * card_with_gift_constant_val;
                    }
                    if ($aPriceDetail['greeting_card'] != '' && $aPriceDetail['greeting_card'] != 0) {
                        $iGrandTotal += $aPriceDetail['greeting_card'] * greeting_card_constant_val;
                    }
                    if ($aPriceDetail['birthday_brownie'] != '' && $aPriceDetail['birthday_brownie'] != 0) {
                        $iGrandTotal += $aPriceDetail['birthday_brownie'] * birthday_brownie_constant_val;
                    }
                    if ($aPriceDetail['birthday_starbucks'] != '' && $aPriceDetail['birthday_starbucks'] != 0) {
                        $iGrandTotal += $aPriceDetail['birthday_starbucks'] * birthday_starbucks_constant_val;
                    }
                    if ($aPriceDetail['anniversary_starbucks'] != '' && $aPriceDetail['anniversary_starbucks'] != 0) {
                        $iGrandTotal += $aPriceDetail['anniversary_starbucks'] * anniversary_starbucks_constant_val;
                    }
                    if ($aPriceDetail['referral_credit'] != '' && $aPriceDetail['referral_credit'] != 0) {
                        $iGrandTotal -= $aPriceDetail['referral_credit'] * referral_credit_constant_val;
                    }
                    if ($aPriceDetail['special_creadit'] != '' && $aPriceDetail['special_creadit'] != 0) {
                        $iGrandTotal -= $aPriceDetail['special_creadit'] * special_credit_constant_val;
                        $iGrandSTotal -= $aPriceDetail['special_creadit'] * special_credit_constant_val;
                    }
                    if ($aPriceDetail['cc_billing'] != '' && $aPriceDetail['cc_billing'] != 0) {
                        $iGrandTotal += $aPriceDetail['cc_billing'] * UACC_BILLING;
                    }
                    if ($aPriceDetail['customer_newsletter'] != '' && $aPriceDetail['customer_newsletter'] != 0) {
                        $iGrandTotal += $aPriceDetail['customer_newsletter'] * customer_newsletter_constant_val;
                    }
                    
                    if ($aPriceDetail['nl_flyer'] != '' && $aPriceDetail['nl_flyer'] != 0) {
                        $iGrandTotal += $aPriceDetail['nl_flyer'] * nl_flyer_constant_val;
                    }
                    if ($aPriceDetail['picture_texting'] != '' && $aPriceDetail['picture_texting'] != 0) {
                        $iGrandTotal += $aPriceDetail['picture_texting'] * picture_texting_constant_val;
                    }
                    if ($aPriceDetail['keyword'] != '' && $aPriceDetail['keyword'] != 0) {
                        $iGrandTotal += $aPriceDetail['keyword'] * keyword_constant_val;
                    }
                    if ($aPriceDetail['client_setup'] != '' && $aPriceDetail['client_setup'] != 0) {
                        $iGrandTotal += $aPriceDetail['client_setup'] * client_setup_constant_val;
                    }
                    
                    
                    $sPackageValue = empty($aPriceDetail['package_value']) ? 0 : $aPriceDetail['package_value'];
                    
                    $sTotalCharge = $aPriceDetail['package_pricing'];
                    $serializedData = $aPriceDetail['hidden_point_values'];
                    $nNewUnit = $aRows[2];
                    if ($sPackage != 'N' || $sPackage != '') {
                        $aPackageValue = GetPackageValue($sPackage, $nNewUnit);
                        if ($aPriceDetail['misc_charge'] != '' && $aPriceDetail['misc_charge'] != 0) {
                            $iGrandTotal += $aPriceDetail['misc_charge'];
                            $iGrandSTotal += $aPriceDetail['misc_charge'];
                        }
                        $sPackagePrice = $iGrandTotal + $aPackageValue;
                        $sPackageSUB = $iGrandSTotal + $aPackageValue;
                    } else {
                        if ($aPriceDetail['misc_charge'] != '' && $aPriceDetail['misc_charge'] != 0) {
                            $iGrandTotal += $aPriceDetail['misc_charge'];
                        }
                        $sPackagePrice = $iGrandTotal;
                        $aPackageValue = 0;
                    }
                    $this->upload_excel_model->update_newsletters($sPackagePrice, $sPackageSUB, $nNewUnit, $aPackageValue, $serializedData, $aPriceDetail['id_newsletter']);
                }
            }

            redirect('admin/directors');
            exit();
        }
    }

    function uploadExcel(){
        if(!empty($this->input->post())  || !empty($_FILES) ) {
            $files  = array();
            foreach ($_FILES as $key => $value) {
                if(!empty($value['name'])) {
                  $funtionName = 'Upload_'.$key;
                    if (!empty($_FILES[$key]['name'])) {
                        $sInputFileName = $this->SaveExelFiles($key);

                        try {
                            $inputFileType = PHPExcel_IOFactory::identify($sInputFileName);
                            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                            $objPHPExcel = $objReader->load($sInputFileName);
                        } catch(Exception $e) {
                            die('Error loading file "'.pathinfo($sInputFileName,PATHINFO_BASENAME).'":'.$e->getMessage());
                        }

                        $objPHPExcel = $objReader->load($sInputFileName);
                        $objWorksheet = $objPHPExcel->getActiveSheet();
                        $nHighestRow = $objWorksheet->getHighestRow();
                        $nHighestColumn = $objWorksheet->getHighestColumn();
                        $nHighestColumnIndex = PHPExcel_Cell::columnIndexFromString($nHighestColumn);
                        $sSheetName = $objWorksheet->getCellByColumnAndRow(0, 1)->getValue();
                        
                        if ($key=='newsletter_color') {
                            if($sSheetName != 'Newsletter-B/W Color') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'newsletter_color');
                        }

                        if ($key=='month_packet_postage') {
                            if($sSheetName != '13th Month Packet Postage') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'month_packet_postage');
                        }

                        if ($key=='consultant_packet_postage') {
                            if($sSheetName != 'New Consultant Packet Postage') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'consultant_packet_postage');
                        }

                        if ($key=='consultant_bundles') {
                            if($sSheetName != 'New Consultant Bundles') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'consultant_bundles');
                        }

                        if ($key=='consistency_gift') {
                            if($sSheetName != 'Consistency Gift') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'consistency_gift');
                        }

                        if ($key=='reds_program_gift') {
                            if($sSheetName != 'Reds Program Gift') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'reds_program_gift');
                        }

                        if ($key=='stars_program_gift') {
                            if($sSheetName != 'Stars Program Gift') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'stars_program_gift');
                        }

                        if ($key=='gift_wrap_postpage') {
                            if($sSheetName != 'Gift Wrap and Postage') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'gift_wrap_postpage');
                        }

                        if ($key=='one_rate_postpage') {
                            if($sSheetName != 'One Rate Postage') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'one_rate_postpage');
                        }

                        if ($key=='month_blast_flyer') {
                            if($sSheetName != 'Month End Blast Flyer') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'month_blast_flyer');
                        }

                        if ($key=='flyer_ecard_unit') {
                            if($sSheetName != 'All Flyers') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'flyer_ecard_unit');
                        }

                        if ($key=='speciality_postcard') {
                            if($sSheetName != 'Speciality Postcard') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'speciality_postcard');
                        }

                        if ($key=='greeting_card') {
                            if($sSheetName != 'Greeting Card') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'greeting_card');
                        }

                        if ($key=='card_with_gift') {
                            if($sSheetName != 'Card with gift') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'card_with_gift');
                        }

                        if ($key=='birthday_brownie') {
                            if($sSheetName != 'Greeting Post Card') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'birthday_brownie');
                        }

                        if ($key=='birthday_starbucks') {
                            if($sSheetName != 'Birthday Card and Starbucks') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'birthday_starbucks');
                        }

                        if ($key=='anniversary_starbucks') {
                            if($sSheetName != 'Anniversary Card and Starbucks') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'anniversary_starbucks');
                        }

                        if ($key=='referral_credit') {
                            if($sSheetName != 'Referral Credit') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'referral_credit');
                        }

                        if ($key=='special_credit') {
                            if($sSheetName != 'Special Credit') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'special_credit');
                        }

                        if ($key=='special_cr_note') {
                            if($sSheetName != 'Special Credit Notes') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'special_cr_note');
                        }

                        if ($key=='invoice_note') {
                            if($sSheetName != 'Invoice Note') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'invoice_note');
                        }

                        if ($key=='cc_billing') {
                            if($sSheetName != 'Consultant Communication- billing') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'cc_billing');
                        }

                        if ($key=='customer_newsletter') {
                            if($sSheetName != 'Customer Newsletter') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'customer_newsletter');
                        }

                        if ($key=='picture_texting') {
                            if($sSheetName != 'Picture Texting') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'picture_texting');
                        }

                        if ($key=='client_setup') {
                            if($sSheetName != 'New Client Set up Fee') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'client_setup');
                        }

                        if ($key=='beatly_url') {
                            if($sSheetName != 'English Bitley URL') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'beatly_url');
                        }

                        if ($key=='beatly_url_one') {
                            if($sSheetName != 'Spanish Bitley URL') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'beatly_url_one');
                        }

                        if ($key=='beatly_url_two') {
                            if($sSheetName != 'French Bitley URL') {
                               $this->file_not_match($sInputFileName);
                               exit();
                            }
                            $Return = $this->manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, 'beatly_url_two');
                        }
                    }

                  /*$Return = $this->upload_excel_model->$funtionName($_FILES);*/
                  
                  if ($Return == 'Updated' || $Return == 'SizeUpdated') {
                    $this->session->set_flashdata('success', 'Sheet uploaded successfully.');
                  } elseif($Return == 'FileNotMatch') {
                    $this->session->set_flashdata('error', 'Sheet name not match.');
                  } else {
                    $this->session->set_flashdata('error', 'Sheet not uploaded successfully.');
                  }

                  unset($_FILES);
                  unset($_POST);
                  redirect('billing/upload-excel');
                }
            }
        }
        $this->global['pageTitle'] = 'Unit Assistant : Upload Excels';
        loadAdminViews("billing/uploadExcel", $this->global, NULL, NULL);
    }

    function SaveExelFiles($name){
        $config['upload_path'] = './assets/uploads/upload_excel/';
        $config['allowed_types'] = 'xlsx|xls';
        $this->load->library('upload', $config);
        $sInputFileName = '';
        if ($this->upload->do_upload($name)) {
            $data = $this->upload->data();
            $sInputFileName = $config['upload_path'].$data['file_name'];
        }
        
        return $sInputFileName;
    }

    function file_not_match($sInputFileName){
        unlink($sInputFileName);
        echo 'You have selected a wrong template';
    }

    function manipulate_excel($nHighestRow, $nHighestColumnIndex, $objWorksheet, $sInputFileName, $field){
        $update = '';
        for ($nRow = 2; $nRow <= $nHighestRow; ++$nRow) {
            $aRows = array();
            for ($nCol = 0; $nCol <= $nHighestColumnIndex; ++$nCol) {
                $aRows[] = $objWorksheet->getCellByColumnAndRow($nCol, $nRow)->getValue();
            }

            if ($field == 'special_cr_note' || $field == 'invoice_note' ) {
                $update = $this->upload_excel_model->update_excel_field('', '', $aRows, $field);
            }elseif ($field == 'beatly_url' || $field == 'beatly_url_one' || $field == 'beatly_url_two') {
                $update = $this->upload_excel_model->update_excel_field('', '', $aRows, $field);
            }else{

                $aPrice = $this->upload_excel_model->get_excel_field($aRows[1], $field);

                if (!empty($aPrice)) {
                    $data = get_excel_field_price($aPrice, $aRows, $field);
                    $update = $this->upload_excel_model->update_excel_field($data[0], $data[1], $aRows, $field);
                    
                }
            }
        }



        if($update){
            unlink($sInputFileName);
        }

        return 'Updated';
    }

}
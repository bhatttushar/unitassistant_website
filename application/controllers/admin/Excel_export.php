<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_export extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/excel_export_model');
            $this->load->helper('directors/director');
	}
	
	function index(){
	}

	function downloadExcel($id_newsletter=""){
        $url = $this->uri->segment(2);

		$this->load->library("excel");
        $object = new PHPExcel();

		$object->setActiveSheetIndex(0)
            ->setCellValue('A1', "Do Not Contact Consultant")
            ->setCellValue('B1', "Client_Name\nBlue sticky is\n for cont/client list\n The yellow virt")
            ->setCellValue('C1', 'Consultant_ID')
            ->setCellValue('D1', 'PASSWORD')
            ->setCellValue('E1', 'UNIT NUMBER')
            ->setCellValue('F1', 'START MONTH')
            ->setCellValue('G1', 'START YEAR ')
            ->setCellValue('H1', 'Package for billing ')
            ->setCellValue('I1', 'Director Access $10  FREE WITH PEARL PACKAGE')
            ->setCellValue('J1', 'Total Texting')
            ->setCellValue('K1', 'START UNIT')
            ->setCellValue('L1', 'Newsletter Design ')
            ->setCellValue('M1', ' EMAIL  NL')
            ->setCellValue('N1', 'Package Price')
            ->setCellValue('O1', ' Facebook NL ')
            ->setCellValue('P1', 'Paint Stars  Please')
            ->setCellValue('Q1', ' Signiture ')
            ->setCellValue('R1', ' HS Happy B day')
            ->setCellValue('S1', ' PC- Happy B Day ')
            ->setCellValue('T1', ' HS  Anniversary  ')
            ->setCellValue('U1', ' PC- Anniversary  ')
            ->setCellValue('V1', ' A3 Post card')
            ->setCellValue('W1', ' I1 Post Card')
            ->setCellValue('X1', ' I2 Post Card')
            ->setCellValue('Y1', ' I3 Post Card')
            ->setCellValue('Z1', 'T1 Post Card')
            ->setCellValue('AA1', 'Thank You Post Card')
            ->setCellValue('AB1', 'Cons_Club_Post_ Card')
            ->setCellValue('AC1', 'send_to_director')
            ->setCellValue('AD1', '$750')
            ->setCellValue('AE1', 'Star_OT_Post_Card')
            ->setCellValue('AF1', ' IN STARS Y OR NO')
            ->setCellValue('AG1', ' Star_Gifts')
            ->setCellValue('AH1', ' Last_Mo_Pkts')
            ->setCellValue('AI1', '  Last_Mo_Post_Card')
            ->setCellValue('AJ1', '  Top_10_Mo_Gift_Club')
            ->setCellValue('AK1', ' mail to them')
            ->setCellValue('AL1', 'Top_10_YTD_Sales')
            ->setCellValue('AM1', 'Top_5_Recruiting')
            ->setCellValue('AN1', 'REDS PROGRAM')
            ->setCellValue('AO1', 'Husband_Post_card')
            ->setCellValue('AP1', 'New_Cons_PCs_6')
            ->setCellValue('AQ1', 'NCP_Y_OR_N_ON_7_DAY')
            ->setCellValue('AR1', 'Packet Bundle')
            ->setCellValue('AS1', 'NCPacket')
            ->setCellValue('AT1', 'New_Consultant_Mail_Out')
            ->setCellValue('AU1', 'NCP Notes')
            ->setCellValue('AV1', 'Recrutiner Ck List')
            ->setCellValue('AW1', 'Ala Carte Newsletter Design')
            ->setCellValue('AX1', 'Ala Carte Emailed Newsletter')
            ->setCellValue('AY1', 'Ala Carte Facebook Posting')
            ->setCellValue('AZ1', '  Full color')
            ->setCellValue('BA1', ' Auto send  ')
            ->setCellValue('BB1', 'who prints')
            ->setCellValue('BC1', 'What to print AUTO SEND SEAFOAM')
            ->setCellValue('BD1', 'NO EMAIL-NEWSLETTER')
            ->setCellValue('BE1', 'OC-NEWSLETTER')
            ->setCellValue('BF1', 'OB-NEWSLETTER')
            ->setCellValue('BG1', 'ENGLISH ONLY-NEWSLETTER')
            ->setCellValue('BH1', 'N0-NEWSLETTER')
            ->setCellValue('BI1', 'N1-NEWSLETTER')
            ->setCellValue('BJ1', 'N2-NEWSLETTER')
            ->setCellValue('BK1', 'N3-NEWSLETTER')
            ->setCellValue('BL1', 'A1-NEWSLETTER')
            ->setCellValue('BM1', 'A2-NEWSLETTER')
            ->setCellValue('BN1', 'A3-NEWSLETTER')
            ->setCellValue('BO1', 'I1-NEWSLETTER')
            ->setCellValue('BP1', 'I2-NEWSLETTER')
            ->setCellValue('BQ1', 'I3-NEWSLETTER')
            ->setCellValue('BR1', 'T1-NEWSLETTER')
            ->setCellValue('BS1', 'T-NEWSLETTER')
            ->setCellValue('BT1', 'TP-NEWSLETTER')
            ->setCellValue('BU1', 'TS-NEWSLETTER')
            ->setCellValue('BV1', '')
            ->setCellValue('BW1', 'STATS IN- I O- OUT')
            ->setCellValue('BX1', ' SPECIAL REQ SORT')
            ->setCellValue('BY1', 'SPECIAL NEWSLETTER REQUESTS')
            ->setCellValue('BZ1', 'Tammy special requests')
            ->setCellValue('CA1', 'New Consultant issues')
            ->setCellValue('CB1', 'DIRECTOR TITLE')
            ->setCellValue('CC1', 'Area')
            ->setCellValue('CD1', 'NSD ADDRESS')
            ->setCellValue('CE1', 'Seminar')
            ->setCellValue('CF1', 'Email')
            ->setCellValue('CG1', 'Phone')
            ->setCellValue('CH1', 'Anniversary Month')
            ->setCellValue('CI1', ' Anniversary Year')
            ->setCellValue('CJ1', 'NOTES')
            ->setCellValue('CK1', 'NSD address')
            ->setCellValue('CL1', 'NSD City')
            ->setCellValue('CM1', 'NSD State')
            ->setCellValue('CN1', 'NSD ZIP')
            ->setCellValue('CO1', 'DIRECTOR BIRTHDAY')
            ->setCellValue('CP1', 'Unit Name')
            ->setCellValue('CQ1', 'Unit Colors/Favorite')
            ->setCellValue('CR1', 'Unit Goal')
            ->setCellValue('CS1', 'Reffered By')
            ->setCellValue('CT1', 'First Time Bill Date')
            ->setCellValue('CU1', '')
            ->setCellValue('CV1', '')
            ->setCellValue('CW1', 'ACCOUNT NUMBER')
            ->setCellValue('CX1', 'ROUTING')
            ->setCellValue('CY1', 'ACCOUNT')
            ->setCellValue('CZ1', '')
            ->setCellValue('DA1', 'Wholesale -Show wholesale amounts ')
            ->setCellValue('DB1', 'Wholesale - Remove any amounts under this amount but leave names Amount')
            ->setCellValue('DC1', 'Wholesale - Remove any names under : ')
            ->setCellValue('DD1', 'wholesale section- Show Directors name')
            ->setCellValue('DE1', 'Court of Sales~Totals for consultant showing')
            ->setCellValue('DF1', 'CourT of Sales~Director out of stats')
            ->setCellValue('DG1', 'Court of Sharing~Commission showing for consultants')
            ->setCellValue('DH1', 'Court of Sharing - Show Director Name')
            ->setCellValue('DI1', 'Birthday Recognition- show them')
            ->setCellValue('DJ1', 'Total Charges')
            ->setCellValue('DK1', 'Director has Spanish consultants')
            ->setCellValue('DL1', 'Design Approval Status')
            ->setCellValue('DM1', 'Points Total')
            ->setCellValue('DN1', 'Text Package')
            ->setCellValue('DO1', 'Text Notes')
            ->setCellValue('DP1', 'Special Credit Reason')
            ->setCellValue('DQ1', 'Own Text Number')
            ->setCellValue('DR1', 'Text and Email')
            ->setCellValue('DS1', 'Consultant Communication')
            ->setCellValue('DT1', 'English Bitly Url')
            ->setCellValue('DU1', 'Spanish Bitly Url')
            ->setCellValue('DV1', 'Total Text Program')
            ->setCellValue('DW1', 'No Recognition')
            ->setCellValue('DX1', 'Language')
            ->setCellValue('DY1', 'Newsletter-Color')
            ->setCellValue('DZ1', 'Newsletter-Black White')
            ->setCellValue('EA1', '13th Month Packet Postage')
            ->setCellValue('EB1', 'New Consultant Packet Postage')
            ->setCellValue('EC1', 'New Consultant Bundles')
            ->setCellValue('ED1', 'Consistency Gift')
            ->setCellValue('EE1', 'Reds Program Gift')
            ->setCellValue('EF1', 'Stars Program Gift')
            ->setCellValue('EG1', 'Gift Wrap and Postage')
            ->setCellValue('EH1', 'One Rate Postage')
            ->setCellValue('EI1', 'Month End Blast Flyer')
            ->setCellValue('EJ1', 'Text and Email to Unit')
            ->setCellValue('EK1', 'Unit Challenge Flyer')
            ->setCellValue('EL1', 'Team Building Flyer')
            ->setCellValue('EM1', 'Wholesale Promo Flyer')
            ->setCellValue('EN1', 'Design Fee')
            ->setCellValue('EO1', 'Custom Changes')
            ->setCellValue('EP1', 'Small Edit')
            ->setCellValue('EQ1', 'Specialty Postcard ')
            ->setCellValue('ER1', 'Greeting Card with gift')
            ->setCellValue('ES1', 'Greeting Card')
            ->setCellValue('ET1', 'Greeting Post Card')
            //->setCellValue('EU1', 'Birthday Cards and Starbucks')
            ->setCellValue('EU1', 'Anniversary Card and Starbucks')
            ->setCellValue('EV1', 'Referral Credit')
            ->setCellValue('EW1', 'Account Credit')
            ->setCellValue('EX1', 'Text Blast Customers Billing')
            ->setCellValue('EY1', 'Customer Newsletter')
            ->setCellValue('EZ1', 'Birthday Postcards')
            ->setCellValue('FA1', 'Anniversary Postcards')
            ->setCellValue('FB1', 'Graphic Insert')
            ->setCellValue('FC1', 'Billing Alert Box')
            ->setCellValue('FD1', 'Newsletter Formating')
            ->setCellValue('FE1', 'Personal Unit App')
            ->setCellValue('FF1', 'Personal Website')
            ->setCellValue('FG1', 'Routing')
            ->setCellValue('FH1', 'Account')
            ->setCellValue('FI1', 'Card Number')
            ->setCellValue('FJ1', 'Security Code')
            ->setCellValue('FK1', 'Expiration Date')
            ->setCellValue('FL1', 'Postal Code')
            ->setCellValue('FM1', 'Website Link')
            ->setCellValue('FN1', 'Credit Notes')
            ->setCellValue('FO1', 'Point Credit')
            ->setCellValue('FP1', 'Picture Texting')
            ->setCellValue('FQ1', 'Unsubscribe Date')
            ->setCellValue('FR1', 'Prospect System')
            ->setCellValue('FS1', 'New Client Set up Fee')
            ->setCellValue('FT1', '7/2019 Total Text Package')
            ->setCellValue('FU1', 'Preferred Name')
            ->setCellValue('FV1', 'Preferred Address')
            ->setCellValue('FW1', 'Preferred Email')
            ->setCellValue('FX1', 'Preferred Phone Number')
            ->setCellValue('FY1', 'Preferred City')
            ->setCellValue('FZ1', 'Preferred State')
            ->setCellValue('GA1', 'Preferred Zip')
            ->setCellValue('GB1', 'Created At')
            ->setCellValue('GC1', 'Revert Date')
            ->setCellValue('GD1', 'Digitial Biz Card')
            ->setCellValue('GE1', 'Digitial Biz Card subscribers')
            ->setCellValue('GF1', 'T10WSL-NEWSLETTER')
            ->setCellValue('GG1', 'T20WSL-NEWSLETTER')
            ->setCellValue('GH1', 'T10YTD-NEWSLETTER')
            ->setCellValue('GI1', 'T20YTD-NEWSLETTER')
            ->setCellValue('GJ1', '600-NEWSLETTER')
            ->setCellValue('GK1', 'Digital Biz Card $20')
            ->setCellValue('GL1', 'Amount Box')
            ->setCellValue('GM1', 'Accumulative')
            ->setCellValue('GN1', 'Monthly')
            ->setCellValue('GO1', 'Invoice Note')
            ->setCellValue('GP1', 'Welcome box sent')
            ->setCellValue('GQ1', 'Birthday/Anniversary Dates')
            ->setCellValue('GR1', 'Video Fizz $10')
            ->setCellValue('GS1', 'French Bitly Url')
            ->setCellValue('GT1', 'New consultant packet link - English')
            ->setCellValue('GU1', 'New consultant packet link - Spanish');

		$data = $this->excel_export_model->fetch_director_data($id_newsletter);
            
		$row = 2;
		foreach($data as $val){
			$sConsultantCommunication = ($val['consultant_communication'] == 'Y') ? 'X' : '';
            $decrypted = empty($val['cv_account']) ? '' : decryptIt($val['cv_account']);
            $mask = maskCreditCard($decrypted);
            $sPackage = empty($val['package']) ? '' : $val['package'];
            $aPackageValue = GetPackageValue($val['package'], $val['unit_size']);
            $sPackagePricings = $val['package_pricing'] + Get_hidden_newsletter($val['hidden_newsletter']);
            $sPackagePricing = empty($sPackagePricings) ? 'N/C' : $sPackagePricings;
            /*$dt = $val['month_mailing'];
            $dateElements = explode('/', $dt);
            $sStartMonth = empty($dateElements[0]) ? '' : $dateElements[0];
            $sStartYear = empty($dateElements[1]) ? '' : $dateElements[1];*/
            $sTextEmail = empty($val['text_email']) ? '' : '$' . text_email;
            $dateElements = explode('-', $val['auto_send']);
            $sAutoSendMonth = empty($dateElements[0]) ? '' : $dateElements[0];
            $sDirectorState = (($val['design_two'] == 'Y') ? 'IN' : (($val['design_two'] == 'N') ? 'OUT' : ''));
            $nConsultant = ($val['consultant_number'] == '') ? '' : $val['consultant_number'];
            $nUnitNumber = ($val['unit_number'] == '') ? '' : $val['unit_number'];
            $sNewsLetterDesign = (($val['emailing'] == '1') ? '$' . emailing_0 : (($val['emailing'] == '2') ? '$' . emailing_1 : (($val['emailing'] == '0') || ($val['emailing'] == '') ? 'N' : '')));
            $sNewsletterFormating = ($val['email_newsletter'] == '' || $val['email_newsletter'] == '0') ? '' : 'X';
            $columnM = ($sNewsletterFormating == 'X') ? 'X' : '';
            $columnM2 = ($val['total_text_program']=='1' || $val['total_text_program7']=='1') ? 'X' : '';
            $columnM2 = $columnM.''.$columnM2;
            
            $sfaceboolNl = ((empty($val['facebook']) && empty($val['facebook_everything']) ) ? '' : ((!empty($val['facebook']) ? 'N' : ((!empty($val['facebook_everything']) ? 'E' : '' )))));
    
            $sFacebook = ((empty($val['facebook']) && empty($val['facebook_everything']) ) ? '' : ((!empty($val['facebook']) ? '$' . facebook : ((!empty($val['facebook_everything']) ? '$' . facebook_everything : '' )))));

            $sEmail = empty($val['email_newsletter']) ? '' : '$' . email_newsletter;
            $sHbirthday = ($val['birthday_one'] == '2') ? 'X' : '';
            $sPcBirthday = ($val['birthday_one'] == '1') ? 'X' : '';
            $sAnniversaryOne = ($val['anniversary_one'] == '2') ? 'X' : '';
            $sAnniversaryTwo = ($val['anniversary_one'] == '1') ? 'X' : '';
            $sStatusOne = empty($val['status_one']) ? '' : 'X';
            $sStatusTwo = empty($val['status_two']) ? '' : 'X';
            $sStatusThree = empty($val['status_three']) ? '' : 'X';
            $sStatusFour = empty($val['status_four']) ? '' : 'X';
            $sStatusFive = empty($val['status_five']) ? '' : 'X';
            $sStatusSix = empty($val['status_six']) ? '' : 'X';
            $sStatusSeven = empty($val['status_seven']) ? '' : 'X';
            $sAccumulative = empty($val['accumulative']) ? '' : 'X';
            $sMonthly = empty($val['monthly']) ? '' : 'X';
            $sStatusSeven0 = empty($val['status_seven0']) ? '' : 'X';
            $sStatusSeven1 = empty($val['status_seven1']) ? '' : 'X';
            $sStatusEight = ($val['status_eight'] != '0') ? 'X' : '';
            $sStatusNine = empty($val['status_nine']) ? '' : 'X';
            $sLastOne = ($val['last_one'] == '2') ? 'X ' : '';
            $sLastTwo = ($val['last_one'] == '1') ? 'X' : '';
            $sGiftOne = empty($val['gift_one']) ? '' : 'X';
            $sGiftTwo = empty($val['gift_two']) ? '' : 'X';
            $sGiftThree = empty($val['gift_three']) ? '' : 'X';
            $sGiftFour = empty($val['gift_four']) ? '' : 'X';
            $sGiftFive = empty($val['gift_five']) ? '' : 'X';
            $sConsultantOne = empty($val['consultant_one']) ? '' : 'X';
            $sConsultantTwo = empty($val['consultant_two']) ? '' : 'X';
            $sConsultantTwo1 = (($val['consultant_two1'] == 'Y') ? 'Y' : (($val['consultant_two1'] == 'N') ? 'N' : (($val['consultant_two1'] == 'X') ? 'X' : '')));
            $sConsultantThree = empty($val['consultant_three']) ? '' : 'X';
            $sConsultantFour = (($val['consultant_four'] == 'U') ? 'OUR' : (($val['consultant_four'] == 'P') ? 'OWNS' : (($val['consultant_four'] == 'A') ? 'OWN' : (($val['consultant_four'] == 'S') ? 'OWNO' : (($val['consultant_four'] == 'N') ? 'N' : '')))));
            $sConsultantFive = ($val['consultant_five'] == '1') ? 'X' : '';
            $sConsultantFive1 = ($val['consultant_five'] == '0') ? 'X' : '';
            $sConsultantSix = empty($val['consultant_six']) ? '' : 'X';
            $sNoEmailOption = empty($val['no_email_option']) ? '' : 'X';
            $sOverrideColor = empty($val['override_color']) ? '' : 'C';
            $sOverrideBlackWhite = empty($val['override_black_white']) ? '' : 'B';
            $sEnglishOnly = empty($val['english_only']) ? '' : 'B';
            $sPackageName = GetPackageName($val['package']);
            if ($val['nsd_client'] == '1') {
                $sTextSystem = '$0';
            } elseif ($val['total_text_program'] == '1') {
                $sTextSystem = '*';
            } else {
                $sTextSystem  = textSystem($val['package']);
            }
            if ($val['nsd_client'] == '1') {
                $sDirectorAccess = '$0';
            } else {
                $sDirectorAccess = (empty($val['director_access']) ? '' : (($val['director_access'] == '1') && $val['package'] == 'P' ? 'N/A' : '$' . director_access));
            }
            $sWholeSaleAmount = (($val['wholesale_amount'] == '') ? '' : (($val['wholesale_amount'] == 'Y') ? 'Y' : (($val['wholesale_amount'] == 'N') ? 'N' : '')));
            $sWholeSaleRemove = empty($val['wholesale_remove']) ? '' : $val['wholesale_remove'];
            $sWholeSaleRemoveName = empty($val['wholesale_remove_name']) ? '' : $val['wholesale_remove_name'];
            $sCourtSale = (($val['court_sale'] == '') ? '' : (($val['court_sale'] == 'Y') ? 'Y' : (($val['court_sale'] == 'N') ? 'N' : '')));
            $sWholeSaleSection = (($val['wholesale_section'] == '') ? '' : (($val['wholesale_section'] == 'Y') ? 'Y' : (($val['wholesale_section'] == 'N') ? 'N' : '')));
            $sCourtSaleDirector = (($val['court_sale_director'] == '') ? '' : (($val['court_sale_director'] == 'Y') ? 'Y' : (($val['court_sale_director'] == 'N') ? 'N' : '')));
            $sCourtSaleSharing = (($val['court_sharing'] == '') ? '' : (($val['court_sharing'] == 'Y') ? 'Y' : (($val['court_sharing'] == 'N') ? 'N' : '')));
            $sWholeSharingDirector = (($val['court_sharing_director'] == '') ? '' : (($val['court_sharing_director'] == 'Y') ? 'Y' : (($val['court_sharing_director'] == 'N') ? 'N' : '')));
            $sbirthdayRec = (($val['birthday_rec'] == '') ? '' : (($val['birthday_rec'] == 'Y') ? 'Y' : (($val['birthday_rec'] == 'N') ? 'N' : '')));
            $sBirthdayAnniversary = (($val['birthday_anniversary'] == '') ? '' : (($val['birthday_anniversary'] == 'T') ? 'TM' : (($val['birthday_anniversary'] == 'N') ? 'NM' : ''))); 
            $sSpanishConsultant = ($val['spanish_consultant'] == '1') ? 'X' : '';
            $sDesignStatus = getDesignStatus($val['design_approve_status']);
            
           /* $sTextingSystem = (($val['text_system'] == '1') ? 'T&E' : (($val['text_system'] == 2) ? 'EO' : (($val['text_system'] == 3) ? 'TO' : (($val['text_system'] == 4 || $val['text_system'] == '') ? 'NO T&E' : ''))));*/

            $sTotalTextProgram = Get_total_text_program($val['package'], $val['total_text_program']);
            $sStarProgram = ($val['star_program'] != '0') ? 'X' : '';
            $sLanguage =  get_newsletters_design($val['newsletters_design']);
            $sDigitalizCard20 = empty($val['digital_biz_card']) ? '' : 'X';
            
            $nProspectSystem = getProspectSystem($val['prospect_system'], $val['free']);
            $sPersonalWebsite = Get_personal_web($val['package'], $val['personal_website']);
            $sPersonalUnitApp = Get_personal_app($val['package'], $val['personal_unit_app']);
            $sAccount = isset($val['cv_account']) ? decryptIt($val['cv_account']) : '';
            $program7 = Get_total_text_program7($val['package'], $val['total_text_program7']);
            if(empty($sTotalTextProgram) && empty($program7)){
                $sTotalTextProgram = '';
            }else if(empty($sTotalTextProgram)){
                $sTotalTextProgram = $program7;
            }else if(empty($program7)){
                $sTotalTextProgram = $sTotalTextProgram;
            }else{
                $sTotalTextProgram = '';
            }
            $WhoPrint = '';
            $AllPrintO = array($val['n_zero'],$val['n_one'],$val['n_two'],$val['n_three'],$val['a_one'],$val['a_two'],$val['a_three'],$val['i_one'],$val['i_two'],$val['i_three'],$val['t_one'],$val['t_two'],$val['t_three'],$val['t_four'], $val['top_10_wsl'], $val['top_20_wsl'], $val['top_10_ytd'], $val['top_20_ytd'], $val['600_plus_oder']);

            foreach ($AllPrintO as $key => $value) {
                if($value == 'C' || $value == 'B') {
                    $WhoPrint = 'X';    
                }
            }
            if (!empty($sNoEmailOption) || !empty($sOverrideColor) || !empty($sOverrideBlackWhite) || !empty($sEnglishOnly)) {
                $WhoPrint = 'X';    
            }
            $ColumnGD = ($val['distribution_one'] != '0' ? 'x' : '');
            $hidden_newsletter = ($val['hidden_newsletter']=='no') ? '' : $val['hidden_newsletter'];

			$object->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, utf8_encode($val['contact']))
                        ->setCellValue('B' . $row, $val['name'])
                        ->setCellValue('C' . $row, $val['consultant_number'])
                        ->setCellValue('D' . $row, $val['intouch_password'])
                        ->setCellValue('E' . $row, $val['unit_number'])
                        ->setCellValue('F' . $row, ''/*$sStartMonth*/)
                        ->setCellValue('G' . $row, ''/*$sStartYear*/)
                        ->setCellValue('H' . $row, $sPackageName)
                        ->setCellValue('I' . $row, $sDirectorAccess)
                        ->setCellValue('J' . $row, $sTextSystem)
                        ->setCellValue('K' . $row, $val['unit_size'])
                        ->setCellValue('L' . $row, $hidden_newsletter)
                        ->setCellValue('M' . $row, $columnM2)
                        ->setCellValue('N' . $row, '$' . $aPackageValue)
                        ->setCellValue('O' . $row, $sfaceboolNl)
                        ->setCellValue('P' . $row, $sStarProgram)
                        ->setCellValue('Q' . $row, $val['closing_ecards'])
                        ->setCellValue('R' . $row, $sHbirthday)
                        ->setCellValue('S' . $row, $sPcBirthday)
                        ->setCellValue('T' . $row, $sAnniversaryOne)
                        ->setCellValue('U' . $row, $sAnniversaryTwo)
                        ->setCellValue('V' . $row, $sStatusOne)
                        ->setCellValue('W' . $row, $sStatusTwo)
                        ->setCellValue('X' . $row, $sStatusThree)
                        ->setCellValue('Y' . $row, $sStatusFour)
                        ->setCellValue('Z' . $row, $sStatusFive)
                        ->setCellValue('AA' . $row, $sStatusSix)
                        ->setCellValue('AB' . $row, $sStatusSeven)
                        ->setCellValue('AC' . $row, $sStatusSeven1)
                        ->setCellValue('AD' . $row, $sStatusSeven0)
                        ->setCellValue('AE' . $row, $sStatusEight)
                        ->setCellValue('AF' . $row, $val['status_eight1'])
                        ->setCellValue('AG' . $row, $sStatusNine)
                        ->setCellValue('AH' . $row, $sLastOne)
                        ->setCellValue('AI' . $row, $sLastTwo)
                        ->setCellValue('AJ' . $row, $sGiftOne)
                        ->setCellValue('AK' . $row, $sGiftFour)
                        ->setCellValue('AL' . $row, $sGiftTwo)
                        ->setCellValue('AM' . $row, $sGiftThree)
                        ->setCellValue('AN' . $row, $sGiftFive)
                        ->setCellValue('AO' . $row, $sConsultantOne)
                        ->setCellValue('AP' . $row, $sConsultantTwo)
                        ->setCellValue('AQ' . $row, $sConsultantTwo1)
                        ->setCellValue('AR' . $row, $sConsultantFive)
                        ->setCellValue('AS' . $row, $sConsultantThree)
                        ->setCellValue('AT' . $row, $sConsultantFour)
                        ->setCellValue('AU' . $row, $val['consultant_seven'])
                        ->setCellValue('AV' . $row, $sConsultantSix)
                        ->setCellValue('AW' . $row, $sNewsLetterDesign)
                        ->setCellValue('AX' . $row, $sEmail)
                        ->setCellValue('AY' . $row, $sFacebook)
                        ->setCellValue('AZ' . $row, '')
                        ->setCellValue('BA' . $row, $sAutoSendMonth)
                        ->setCellValue('BB' . $row, $WhoPrint)
                        ->setCellValue('BC' . $row, $val['newsletter_send_notes'])
                        ->setCellValue('BD' . $row, $sNoEmailOption)
                        ->setCellValue('BE' . $row, $sOverrideColor)
                        ->setCellValue('BF' . $row, $sOverrideBlackWhite)
                        ->setCellValue('BG' . $row, $sEnglishOnly)
                        ->setCellValue('BH' . $row, $val['n_zero'])
                        ->setCellValue('BI' . $row, $val['n_one'])
                        ->setCellValue('BJ' . $row, $val['n_two'])
                        ->setCellValue('BK' . $row, $val['n_three'])
                        ->setCellValue('BL' . $row, $val['a_one'])
                        ->setCellValue('BM' . $row, $val['a_two'])
                        ->setCellValue('BN' . $row, $val['a_three'])
                        ->setCellValue('BO' . $row, $val['i_one'])
                        ->setCellValue('BP' . $row, $val['i_two'])
                        ->setCellValue('BQ' . $row, $val['i_three'])
                        ->setCellValue('BR' . $row, $val['t_one'])
                        ->setCellValue('BS' . $row, $val['t_two'])
                        ->setCellValue('BT' . $row, $val['t_three'])
                        ->setCellValue('BU' . $row, $val['t_four'])
                        ->setCellValue('BV' . $row, '')
                        ->setCellValue('BW' . $row, $sDirectorState)
                        ->setCellValue('BX' . $row, '')
                        ->setCellValue('BY' . $row, $val['special_news_request'])
                        ->setCellValue('BZ' . $row, '')
                        ->setCellValue('CA' . $row, '')
                        ->setCellValue('CB' . $row, $val['director_title'])
                        ->setCellValue('CC' . $row, $val['national_area'])
                        ->setCellValue('CD' . $row, ''/*$val['nsd_address']*/)
                        ->setCellValue('CE' . $row, $val['seminar_affiliation'])
                        ->setCellValue('CF' . $row, $val['email'])
                        ->setCellValue('CG' . $row, $val['cell_number'])
                        ->setCellValue('CH' . $row, ''/*$val['anniversary_month']*/)
                        ->setCellValue('CI' . $row, ''/*$val['anniversary_year']*/)
                        ->setCellValue('CJ' . $row, $val['client_note'])
                        ->setCellValue('CK' . $row, ''/*$val['nsd_address']*/)
                        ->setCellValue('CL' . $row, ''/*$val['nsd_city']*/)
                        ->setCellValue('CM' . $row, ''/*$val['nsd_state']*/)
                        ->setCellValue('CN' . $row, ''/*$val['nsd_zip']*/)
                        ->setCellValue('CO' . $row, $val['dob'])
                        ->setCellValue('CP' . $row, $val['unit_name'])
                        ->setCellValue('CQ' . $row, $val['unit_color'])
                        ->setCellValue('CR' . $row, $val['unit_goal'])
                        ->setCellValue('CS' . $row, $val['reffered_by'])
                        ->setCellValue('CT' . $row, $val['first_bill_date'])
                        ->setCellValue('CU' . $row, '')
                        ->setCellValue('CV' . $row, '')
                        ->setCellValue('CW' . $row, '')
                        ->setCellValue('CX' . $row, '')
                        ->setCellValue('CY' . $row, '')
                        ->setCellValue('CZ' . $row, '')
                        ->setCellValue('DA' . $row, $sWholeSaleAmount)
                        ->setCellValue('DB' . $row, $val['wholesale_remove'])
                        ->setCellValue('DC' . $row, $val['wholesale_remove_name'])
                        ->setCellValue('DD' . $row, $sWholeSaleSection)
                        ->setCellValue('DE' . $row, $sCourtSale)
                        ->setCellValue('DF' . $row, $sCourtSaleDirector)
                        ->setCellValue('DG' . $row, $sCourtSaleSharing)
                        ->setCellValue('DH' . $row, $sWholeSharingDirector)
                        ->setCellValue('DI' . $row, $sbirthdayRec)
                        ->setCellValue('DJ' . $row, $sPackagePricing)
                        ->setCellValue('DK' . $row, $sSpanishConsultant)
                        ->setCellValue('DL' . $row, $sDesignStatus)
                        ->setCellValue('DM' . $row, $val['point_value'])
                        ->setCellValue('DN' . $row, ''/*$sTextingSystem*/)
                        ->setCellValue('DO' . $row, $val['note'])
                        ->setCellValue('DP' . $row, $val['package_note'])
                        ->setCellValue('DQ' . $row, "")
                        ->setCellValue('DR' . $row, $sTextEmail)
                        ->setCellValue('DS' . $row, $sConsultantCommunication)
                        ->setCellValue('DT' . $row, $val['beatly_url'])
                        ->setCellValue('DU' . $row, $val['beatly_url_one'])
                        ->setCellValue('DV' . $row, $sTotalTextProgram)
                        ->setCellValue('DW' . $row, $val['no_recognition'])
                        ->setCellValue('DX' . $row, $sLanguage)
                        ->setCellValue('DY' . $row, $val['newsletter_color'])
                        ->setCellValue('DZ' . $row, $val['newsletter_black_white'])
                        ->setCellValue('EA' . $row, $val['month_packet_postage'])
                        ->setCellValue('EB' . $row, $val['consultant_packet_postage'])
                        ->setCellValue('EC' . $row, $val['consultant_bundles'])
                        ->setCellValue('ED' . $row, $val['consistency_gift'])
                        ->setCellValue('EE' . $row, $val['reds_program_gift'])
                        ->setCellValue('EF' . $row, $val['stars_program_gift'])
                        ->setCellValue('EG' . $row, $val['gift_wrap_postpage'])
                        ->setCellValue('EH' . $row, $val['one_rate_postpage'])
                        ->setCellValue('EI' . $row, $val['month_blast_flyer'])
                        ->setCellValue('EJ' . $row, $val['flyer_ecard_unit'])
                        ->setCellValue('EK' . $row, $val['unit_challenge_flyer'])
                        ->setCellValue('EL' . $row, $val['team_building_flyer'])
                        ->setCellValue('EM' . $row, $val['wholesale_promo_flyer'])
                        ->setCellValue('EN' . $row, $val['postcard_design'])
                        ->setCellValue('EO' . $row, $val['postcard_edit'])
                        ->setCellValue('EP' . $row, $val['ecard_unit'])
                        ->setCellValue('EQ' . $row, $val['speciality_postcard'])
                        ->setCellValue('ER' . $row, $val['card_with_gift'])
                        ->setCellValue('ES' . $row, $val['birthday_brownie'])
                        ->setCellValue('ET' . $row, $val['birthday_starbucks'])
                        //->setCellValue('EU' . $row, $val[''])
                        ->setCellValue('EU' . $row, $val['anniversary_starbucks'])
                        ->setCellValue('EV' . $row, $val['referral_credit'])
                        ->setCellValue('EW' . $row, $val['special_creadit'])
                        ->setCellValue('EX' . $row, $val['cc_billing'])
                        ->setCellValue('EY' . $row, $val['customer_newsletter'])
                        ->setCellValue('EZ' . $row, '')
                        ->setCellValue('FA' . $row, '')
                        ->setCellValue('FB' . $row, $val['nl_flyer'])
                        ->setCellValue('FC' . $row, $val['billing_alert'])
                        ->setCellValue('FD' . $row, $sNewsletterFormating)
                        ->setCellValue('FE' . $row, $sPersonalUnitApp)
                        ->setCellValue('FF' . $row, $sPersonalWebsite)
                        ->setCellValue('FG' . $row, '')
                        ->setCellValue('FH' . $row, '')
                        ->setCellValue('FI' . $row, '')
                        ->setCellValue('FJ' . $row, '')
                        ->setCellValue('FK' . $row, '')
                        ->setCellValue('FL' . $row, '')
                        ->setCellValue('FM' . $row, $val['website_link'])
                        ->setCellValue('FN' . $row, $val['credit_notes'])
                        ->setCellValue('FO' . $row, $val['point_credit'])
                        ->setCellValue('FP' . $row, $val['picture_texting'])
                        ->setCellValue('FQ' . $row, $val['contract_update_date'])
                        ->setCellValue('FR' . $row, $nProspectSystem)
                        ->setCellValue('FS'.$row, $val['client_setup'])
                        ->setCellValue('FT'.$row, '')
                        ->setCellValue('FU'.$row, $val['p_name'])
                        ->setCellValue('FV'.$row, $val['p_address'])
                        ->setCellValue('FW'.$row, $val['p_email'])
                        ->setCellValue('FX'.$row, $val['p_phone'])
                        ->setCellValue('FY'.$row, $val['p_city'])
                        ->setCellValue('FZ'.$row, $val['p_state'])
                        ->setCellValue('GA'.$row, $val['p_zip'])
                        ->setCellValue('GB'.$row, $val['created_at'])
                        ->setCellValue('GC'.$row, $val['revert_date'])
                        ->setCellValue('GD'.$row, $ColumnGD)
                        ->setCellValue('GE'.$row, $val['digital_biz_link'])
                        ->setCellValue('GF' . $row, $val['top_10_wsl'])
                        ->setCellValue('GG' . $row, $val['top_20_wsl'])
                        ->setCellValue('GH' . $row, $val['top_10_ytd'])
                        ->setCellValue('GI' . $row, $val['top_20_ytd'])
                        ->setCellValue('GJ' . $row, $val['600_plus_oder'])
                        ->setCellValue('GK' . $row, $sDigitalizCard20)
                        ->setCellValue('GL' . $row, $val['amount_box'])
                        ->setCellValue('GM' . $row, $sAccumulative)
                        ->setCellValue('GN' . $row, $sMonthly)
                        ->setCellValue('GO' . $row, $val['invoice_note'])
                        ->setCellValue('GP' . $row, $val['box_sent'])
                        ->setCellValue('GQ' . $row, $sBirthdayAnniversary)
                        ->setCellValue('GR' . $row, '')
                        ->setCellValue('GS' . $row, $val['beatly_url_two'])
                        ->setCellValue('GT' . $row, $val['ncp_link_en'])
                        ->setCellValue('GU' . $row, $val['ncp_link_sp']);
			
            $object->getActiveSheet()->setCellValueExplicit('CW' . $row, ''/*$val['account_number']*/, PHPExcel_Cell_DataType::TYPE_STRING);
            $object->getActiveSheet()->setCellValueExplicit('FX' . $row, $val['p_phone'], PHPExcel_Cell_DataType::TYPE_STRING);
            $object->getActiveSheet()->setCellValueExplicit('GA' . $row, $val['p_zip'], PHPExcel_Cell_DataType::TYPE_STRING);
            $object->getActiveSheet()->setCellValueExplicit('CG' . $row, $val['cell_number'], PHPExcel_Cell_DataType::TYPE_STRING);
            $object->getActiveSheet()->setCellValueExplicit('GP' . $row, $val['box_sent'], PHPExcel_Cell_DataType::TYPE_STRING);

            $row++;
		}

		$object->getActiveSheet()->getColumnDimension('FG')->setWidth(12);
        $object->getActiveSheet()->getColumnDimension('FH')->setWidth(18);
        $object->getActiveSheet()->getColumnDimension('FI')->setWidth(18);
        $object->getActiveSheet()->getRowDimension(1)->setRowHeight(140);
        $object->getActiveSheet()->getStyle("A1:GZ1")->getFont()->setBold(true)
            ->setName('Verdana')
            ->setSize(10)
            ->getColor()->setRGB('6F6F6F');
        $object->getActiveSheet()->getStyle('A1:GZ1')->getAlignment()->setTextRotation(90);
        $object->getActiveSheet()->getColumnDimension('FM')->setWidth(34);
        $object->getActiveSheet()->getColumnDimension('FN')->setWidth(34);

        // Rename worksheet
        $object->getActiveSheet()->setTitle('Clients');
        $object->setActiveSheetIndex(0);
        $objWriter = new PHPExcel_Writer_Excel2007($object);
        
        if ($url == 'excel-save') {
            $objWriter->save('./assets/download_excel/UA_Client_'.date('m-d-y').'.xlsx');
        }else{
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
            header('Content-Disposition: attachment;filename="UA_Client.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        }
	}

}
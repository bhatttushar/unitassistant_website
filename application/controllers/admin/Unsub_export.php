<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unsub_export extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('admin/unsub_export_model');
            $this->load->helper('directors/director');
	}
	
	function index(){
	}

	function unsubscribed_excel(){
		$this->load->library("excel");
            $object = new PHPExcel();
		$object->setActiveSheetIndex(0);
		$table_columns = array(
			"Do Not Contact Consultant",
                   "Client_Name\nBlue sticky is\n for cont/client list\n The yellow virt",
                   'Consultant_ID',
                   'PASSWORD',
                   'UNIT NUMBER',
                   'START MONTH',
                   'START YEAR ',
                   'Package for billing ',
                   'Director Access $10  FREE WITH PEARL PACKAGE',
                   'Total Texting',
                   'START UNIT',
                   'Newsletter Design ',
                   ' EMAIL  NL',
                   'Package Price',
                   ' Facebook NL ',
                   'Paint Stars  Please',
                   ' Signiture ',
                   ' HS Happy B day',
                   ' PC- Happy B Day ',
                   ' HS  Anniversary  ',
                   ' PC- Anniversary  ',
                   ' A3 Post card',
                   ' I1 Post Card',
                   ' I2 Post Card',
                   ' I3 Post Card',
                   'T1 Post Card',
                   'Thank You Post Card',
                   'Cons_Club_Post_ Card',
                   'send_to_director',
                   '$750',
                   'Star_OT_Post_Card',
                   ' IN STARS Y OR NO',
                   ' Star_Gifts',
                   ' Last_Mo_Pkts',
                   '  Last_Mo_Post_Card',
                   '  Top_10_Mo_Gift_Club',
                   ' mail to them',
                   'Top_10_YTD_Sales',
                   'Top_5_Recruiting',
                   'REDS PROGRAM',
                   'Husband_Post_card',
                   'New_Cons_PCs_6',
                   'NCP_Y_OR_N_ON_7_DAY',
                   'Packet Bundle',
                   'NCPacket',
                   'New_Consultant_Mail_Out',
                   'NCP Notes',
                   'Recrutiner Ck List',
                   'Ala Carte Newsletter Design',
                   'Ala Carte Emailed Newsletter',
                   'Ala Carte Facebook Posting',
                   '  Full color',
                   ' Auto send  ',
                   'who prints',
                   'What to print AUTO SEND SEAFOAM',
                   'NO EMAIL-NEWSLETTER',
                   'OC-NEWSLETTER',
                   'OB-NEWSLETTER',
                   'ENGLISH ONLY-NEWSLETTER',
                   'N0-NEWSLETTER',
                   'N1-NEWSLETTER',
                   'N2-NEWSLETTER',
                   'N3-NEWSLETTER',
                   'A1-NEWSLETTER',
                   'A2-NEWSLETTER',
                   'A3-NEWSLETTER',
                   'I1-NEWSLETTER',
                   'I2-NEWSLETTER',
                   'I3-NEWSLETTER',
                   'T1-NEWSLETTER',
                   'T-NEWSLETTER',
                   'TP-NEWSLETTER',
                   'TS-NEWSLETTER',
                   '',
                   'STATS IN- I O- OUT',
                   ' SPECIAL REQ SORT',
                   'SPECIAL NEWSLETTER REQUESTS',
                   'Tammy special requests',
                   'New Consultant issues',
                   'DIRECTOR TITLE',
                   'Area',
                   'NSD ADDRESS',
                   'Seminar',
                   'Email',
                   'Phone',
                   'Anniversary Month',
                   ' Anniversary Year',
                   'NOTES',
                   'NSD address',
                   'NSD City',
                   'NSD State',
                   'NSD ZIP',
                   'DIRECTOR BIRTHDAY',
                   'Unit Name',
                   'Unit Colors/Favorite',
                   'Unit Goal',
                   'Reffered By',
                   'First Time Bill Date',
                   '',
                   '',
                   'ACCOUNT NUMBER',
                   'ROUTING',
                   'ACCOUNT',
                   '',
                   'Wholesale -Show wholesale amounts ',
                   'Wholesale - Remove any amounts under this amount but leave names     Amount',
                   'Wholesale - Remove any names under : ',
                   'wholesale section- Show Directors name',
                   'Court of Sales~Totals for consultant showing',
                   'CourT of Sales~Director out of stats',
                   'Court of Sharing~Commission showing for consultants',
                   'Court of Sharing - Show Director Name',
                   'Birthday Recognition- show them',
                   'Total Charges',
                   'Director has Spanish consultants',
                   'Design Approval Status',
                   'Points Total',
                   'Text Package',
                   'Text Notes',
                   'Special Credit Reason',
                   'Own Text Number',
                   'Text and Email',
                   'Consultant Communication',
                   'English Bitly Url',
                   'Spanish Bitly Url',
                   'Total Text Program',
                   'No Recognition',
                   'Language',
                   'Newsletter-Color',
                   'Newsletter-Black White',
                   '13th Month Packet Postage',
                   'New Consultant Packet Postage',
                   'New Consultant Bundles',
                   'Consistency Gift',
                   'Reds Program Gift',
                   'Stars Program Gift',
                   'Gift Wrap and Postage',
                   'One Rate Postage',
                   'Month End Blast Flyer',
                   'Text and Email to Unit',
                   'Unit Challenge Flyer',
                   'Team Building Flyer',
                   'Wholesale Promo Flyer',
                   'Design Fee',
                   'Custom Changes',
                   'Small Edit',
                   'Specialty Postcard ',
                   'Greeting Card with gift',
                   'Greeting Card',
                   'Greeting Post Card',
                   'Birthday Cards and Starbucks',
                   'Anniversary Card and Starbucks',
                   'Referral Credit',
                   'Account Credit',
                   'Text Blast Customers Billing',
                   'Customer Newsletter',
                   'Birthday Postcards',
                   'Anniversary Postcards',
                   'Graphic Insert',
                   'Billing Alert Box',
                   'Newsletter Formating',
                   'Personal Unit App',
                   'Personal Website',
                   'Routing',
                   'Account',
                   'Card Number',
                   'Security Code',
                   'Expiration Date',
                   'Postal Code',
                   'Website Link',
                   'Credit Notes',
                   'Point Credit',
                   'Picture Texting',
                   'Unsubscribe Date',
                   'Prospect System',
                   'New Client Set up Fee',
                   '7/2019 Total Text Package',
                   'Preferred Name',
                   'Preferred Address',
                   'Preferred Email',
                   'Preferred Phone Number',
                   'Preferred City',
                   'Preferred State',
                   'Preferred Zip',
                   'Created At',
                   'Revert Date',
                   'Digitial Biz Card',
                   'Digitial Biz Card subscribers',
                   'T10WSL-NEWSLETTER',
                   'T20WSL-NEWSLETTER',
                   'T10YTD-NEWSLETTER',
                   'T20YTD-NEWSLETTER',
                   '600-NEWSLETTER',
                   'Digital Biz Card $20',
                   'Amount Box',
                   'Accumulative',
                   'Monthly',
                   'Invoice Note',
                   'Welcome box sent',
                   'Birthday/Anniversary Dates',
                   'Video Fizz $10'
		);
		$column = 0;
		foreach($table_columns as $field){
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}
		$data = $this->unsub_export_model->get_unsub_director();
            
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
            $sNewsLetterDesign = (($val['emailing'] == 1) ? '$' . emailing_0 : (($val['emailing'] == 2) ? '$' . emailing_1 : (($val['emailing'] == 0) || ($val['emailing'] == '') ? 'N' : '')));
            $sNewsletterFormating = ($val['email_newsletter'] == '' || $val['email_newsletter'] == 0) ? '' : 'x';
            $columnM = ($sNewsletterFormating == 'x') ? 'X' : '';
            $columnM2 = ($val['total_text_program']==1 || $val['total_text_program7']==1) ? 'x' : '';
            $columnM2 = $columnM.''.$columnM2;
            $sfaceboolNl = empty($val['distribution_two']) ? '' : 'X';
            $sFacebook = empty($val['facebook']) ? '' : '$' . facebook;
            $sEmail = empty($val['email_newsletter']) ? '' : '$' . email_newsletter;
            $sHbirthday = ($val['birthday_one'] == 2) ? 'X' : '';
            $sPcBirthday = ($val['birthday_one'] == 1) ? 'X' : '';
            $sAnniversaryOne = ($val['anniversary_one'] == 2) ? 'X' : '';
            $sAnniversaryTwo = ($val['anniversary_one'] == 1) ? 'X' : '';
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
            $sStatusEight = ($val['status_eight'] != 0) ? 'X' : '';
            $sStatusNine = empty($val['status_nine']) ? '' : 'X';
            $sLastOne = ($val['last_one'] == 2) ? 'X ' : '';
            $sLastTwo = ($val['last_one'] == 1) ? 'X' : '';
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
            if ($val['nsd_client'] == 1) {
                $sTextSystem = '$0';
            } elseif ($val['total_text_program'] == 1) {
                $sTextSystem = '*';
            } else {
                $sTextSystem  = textSystem($val['package']);
            }
            if ($val['nsd_client'] == 1) {
                $sDirectorAccess = '$0';
            } else {
                $sDirectorAccess = (empty($val['director_access']) ? '' : (($val['director_access'] == 1) && $val['package'] == 'P' ? 'N/A' : '$' . director_access));
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
            $sSpanishConsultant = ($val['spanish_consultant'] == 1) ? 'X' : '';
            $sDesignStatus = getDesignStatus($val['design_approve_status']);
            
           /* $sTextingSystem = (($val['text_system'] == 1) ? 'T&E' : (($val['text_system'] == 2) ? 'EO' : (($val['text_system'] == 3) ? 'TO' : (($val['text_system'] == 4 || $val['text_system'] == '') ? 'NO T&E' : ''))));*/

            $sTotalTextProgram = Get_total_text_program($val['package'], $val['total_text_program']);
            $sStarProgram = ($val['star_program'] != 0) ? 'X' : '';
            $sLanguage =  get_newsletters_design($val['newsletters_design'] == 'S');
            $sDigitalizCard20 = empty($val['digital_biz_card']) ? '' : 'X';
            /*$sVideoFizz10 = ($val['videofizz']=='0') ? '' : 'X';*/
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
            $ColumnGD = ($val['distribution_one'] != 0 ? 'x' : '');

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $row, utf8_encode($val['contact']));
                  $object->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $val['name']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $val['consultant_number']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $val['intouch_password']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $val['unit_number']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(5, $row, ''/*$sStartMonth*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(6, $row, ''/*$sStartYear*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $sPackageName);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $sDirectorAccess);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $sTextSystem);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(10, $row, $val['unit_size']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(11, $row, $val['hidden_newsletter']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(12, $row, $columnM2) ;
                  $object->getActiveSheet()->setCellValueByColumnAndRow(13, $row,'$'.$aPackageValue);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(14, $row, $sfaceboolNl);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $sStarProgram);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(16, $row, $val['closing_ecards']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(17, $row, $sHbirthday);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $sPcBirthday);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $sAnniversaryOne);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(20, $row, $sAnniversaryTwo);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(21, $row, $sStatusOne);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(22, $row, $sStatusTwo);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(23, $row, $sStatusThree);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(24, $row, $sStatusFour);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(25, $row, $sStatusFive);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(26, $row, $sStatusSix);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(27, $row, $sStatusSeven);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(28, $row, $sStatusSeven1);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(29, $row, $sStatusSeven0);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(30, $row, $sStatusEight);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(31, $row, $val['status_eight1']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(32, $row, $sStatusNine);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(33, $row, $sLastOne);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(34, $row, $sLastTwo);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(35, $row, $sGiftOne);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(36, $row, $sGiftFour);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(37, $row, $sGiftTwo);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(38, $row, $sGiftThree);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(39, $row, $sGiftFive);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(40, $row, $sConsultantOne);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(41, $row, $sConsultantTwo);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(42, $row, $sConsultantTwo1);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(43, $row, $sConsultantFive);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(44, $row, $sConsultantThree);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(45, $row, $sConsultantFour);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(46, $row, $val['consultant_seven']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(47, $row, $sConsultantSix);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(48, $row, $sNewsLetterDesign);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(49, $row, $sEmail);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(50, $row, $sFacebook);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(51, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(52, $row, $sAutoSendMonth);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(53, $row, $WhoPrint);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(54, $row, $val['newsletter_send_notes']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(55, $row, $sNoEmailOption);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(56, $row, $sOverrideColor);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(57, $row, $sOverrideBlackWhite);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(58, $row, $sEnglishOnly);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(59, $row, $val['n_zero']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(60, $row, $val['n_one']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(61, $row, $val['n_two']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(62, $row, $val['n_three']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(63, $row, $val['a_one']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(64, $row, $val['a_two']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(65, $row, $val['a_three']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(66, $row, $val['i_one']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(67, $row, $val['i_two']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(68, $row, $val['i_three']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(69, $row, $val['t_one']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(70, $row, $val['t_two']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(71, $row, $val['t_three']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(72, $row, $val['t_four']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(73, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(74, $row, $sDirectorState);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(75, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(76, $row, $val['special_news_request']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(77, $row,'');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(78, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(79, $row, $val['director_title']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(80, $row, $val['national_area']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(81, $row, ''/*$val['nsd_address']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(82, $row, $val['seminar_affiliation']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(83, $row, $val['email']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(84, $row, $val['cell_number']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(85, $row, '', /*$val['anniversary_month']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(86, $row, '', /*$val['anniversary_year']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(87, $row, $val['client_note']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(88, $row, '', /*$val['nsd_address']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(89, $row, '', /*$val['nsd_city']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(90, $row, '', /*$val['nsd_state']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(91, $row, '', /*$val['nsd_zip']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(92, $row, $val['dob']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(93, $row, $val['unit_name']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(94, $row, $val['unit_color']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(95, $row, $val['unit_goal']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(96, $row, $val['reffered_by']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(97, $row, $val['first_bill_date']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(98, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(99, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(100, $row, '', /*$val['account_number']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(101, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(102, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(103, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(104, $row, $sWholeSaleAmount);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(105, $row, $val['wholesale_remove']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(106, $row, $val['wholesale_remove_name']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(107, $row, $sWholeSaleSection);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(108, $row, $sCourtSale);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(109, $row, $sCourtSaleDirector);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(110, $row, $sCourtSaleSharing);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(111, $row, $sWholeSharingDirector);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(112, $row, $sbirthdayRec);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(113, $row, $sPackagePricing);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(114, $row, $sSpanishConsultant);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(115, $row, $sDesignStatus);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(116, $row, $val['point_value']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(117, $row, ''/*$sTextingSystem*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(118, $row, $val['note']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(119, $row, $val['package_note']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(120, $row, "");
                  $object->getActiveSheet()->setCellValueByColumnAndRow(121, $row, $sTextEmail);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(122, $row, $sConsultantCommunication);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(123, $row, $val['beatly_url']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(124, $row, $val['beatly_url_one']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(125, $row, $sTotalTextProgram);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(126, $row, $val['no_recognition']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(127, $row, $sLanguage);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(128, $row, $val['newsletter_color']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(129, $row, $val['newsletter_black_white']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(130, $row, $val['month_packet_postage']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(131, $row, $val['consultant_packet_postage']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(132, $row, $val['consultant_bundles']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(133, $row, $val['consistency_gift']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(134, $row, $val['reds_program_gift']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(135, $row, $val['stars_program_gift']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(136, $row, $val['gift_wrap_postpage']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(137, $row, $val['one_rate_postpage']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(138, $row, $val['month_blast_flyer']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(139, $row, $val['flyer_ecard_unit']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(140, $row, $val['unit_challenge_flyer']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(141, $row, $val['team_building_flyer']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(142, $row, $val['wholesale_promo_flyer']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(143, $row, $val['postcard_design']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(144, $row, $val['postcard_edit']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(145, $row, $val['ecard_unit']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(146, $row, $val['speciality_postcard']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(147, $row, $val['card_with_gift']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(148, $row, $val['birthday_brownie']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(149, $row, $val['birthday_starbucks']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(150, $row, $val['anniversary_starbucks']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(151, $row, $val['referral_credit']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(152, $row, $val['special_creadit']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(153, $row, $val['cc_billing']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(154, $row, $val['customer_newsletter']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(155, $row, '', /*$val['birthday_postcard']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(156, $row, '', /*$val['anniversary_postcard']*/);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(157, $row, $val['nl_flyer']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(158, $row, $val['billing_alert']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(159, $row, $sNewsletterFormating);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(160, $row, $sPersonalUnitApp);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(161, $row, $sPersonalWebsite);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(162, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(163, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(164, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(165, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(166, $row, $val['website_link']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(167, $row, $val['credit_notes']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(168, $row, $val['point_credit']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(169, $row, $val['picture_texting']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(170, $row, $val['contract_update_date']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(171, $row, $nProspectSystem);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(172, $row, $val['client_setup']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(173, $row, '');
                  $object->getActiveSheet()->setCellValueByColumnAndRow(174, $row, $val['p_name']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(175, $row, $val['p_address']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(176, $row, $val['p_email']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(177, $row, $val['p_phone']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(178, $row, $val['p_city']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(179, $row, $val['p_state']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(180, $row, $val['p_zip']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(181, $row, $val['created_at']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(182, $row, $val['revert_date']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(183, $row, $val['digital_biz_link']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(184, $row, $val['top_10_wsl']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(185, $row, $val['top_20_wsl']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(186, $row, $val['top_10_ytd']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(187, $row, $val['top_20_ytd']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(188, $row, $val['600_plus_oder']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(189, $row, $sDigitalizCard20);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(190, $row, $val['amount_box']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(191, $row, $sAccumulative);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(192, $row, $sMonthly);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(193, $row, $val['invoice_note']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(194, $row, $val['box_sent']);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(195, $row, $sBirthdayAnniversary);
                  $object->getActiveSheet()->setCellValueByColumnAndRow(196, $row, '', /*$sVideoFizz10*/);
			$row++;
		}

		$object->getActiveSheet()->getRowDimension(1)->setRowHeight(140);
		$object->getActiveSheet()->getStyle("A1:GZ1")->getFont()->setBold(true)
		                                ->setName('Verdana')
		                                ->setSize(10)
		                                ->getColor()->setRGB('6F6F6F');
		$object->getActiveSheet()->getStyle('A1:GZ1')->getAlignment()->setTextRotation(90);
		$object->getActiveSheet()->getColumnDimension('FM')->setWidth(34);
		$object->getActiveSheet()->getColumnDimension('FN')->setWidth(34);

		$objWriter = new PHPExcel_Writer_Excel2007($object);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
            header('Content-Disposition: attachment;filename="Unsubscribe_Client_Excel.xlsx"');
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
	}

}
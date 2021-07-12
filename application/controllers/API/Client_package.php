<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Client_package extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('API/client_package_model');
		/*isSecuredApp();*/
	}


	//apiClientPackage.php
	function index(){
		if($this->input->post()) {
			$id_client = $this->input->post('id_client');
			$lg = $this->input->post('language');
			if(empty($id_client)){
	           $aMessage=array('status'=>0, 'message'=>lg('client_required', $lg));  
	        }else{
	        	$data = $this->client_package_model->get_client_data($id_client);
	        
				if(empty($data)){
					$aMessage=array('status'=>0, 'message'=>lg('client_may_be_deleted', $lg));  
				}else{
					$this->load->helper('directors/director_helper');
					$nStartUnit = $data['unit_size'] ? $data['unit_size'] : 'Unsubscribed' ;
					$sNewsLetterDesign = (($data['emailing'] == '1') ? '$38' : (($data['emailing'] == '2') ? '$55' : (($data['emailing'] == '0') || ($data['emailing'] =='') ? 'Unsubscribed' : '')));
					$sEmailNl = empty($data['distribution_one']) ? 'Unsubscribed' : 'X - '.$data['distribution_one'].'pt';
					$sfaceboolNl = empty($data['distribution_two']) ? 'Unsubscribed' : 'X - '.$data['distribution_two'].'pt';
					$sFacebook = empty($data['facebook']) ? 'Unsubscribed' : '$19.99';
					$sEmailNews = empty($data['email_newsletter']) ? 'Unsubscribed' : '$19.99';
					$sHbirthday = ($data['birthday_one'] == '2') ? 'X - '.$data['birthday_one'].'pt' : 'Unsubscribed';
					$sPcBirthday = ($data['birthday_one'] == '1') ? 'X - '.$data['birthday_one'].'pt' : 'Unsubscribed';
					$sAnniversaryOne = ($data['anniversary_one'] == '2') ? 'X - '.$data['anniversary_one'].'pt' : 'Unsubscribed';
					$sAnniversaryTwo = ($data['anniversary_one'] == '1') ? 'X - '.$data['anniversary_one'].'pt' : 'Unsubscribed';
					$sStatusOne = empty($data['status_one']) ? 'Unsubscribed' : 'X - '.$data['status_one'].'pt';
					$sStatusTwo = empty($data['status_two']) ? 'Unsubscribed' : 'X - '.$data['status_two'].'pt';
					$sStatusThree = empty($data['status_three']) ? 'Unsubscribed' : 'X - '.$data['status_three'].'pt';
					$sStatusFour = empty($data['status_four']) ? 'Unsubscribed' : 'X - '.$data['status_four'].'pt';
					$sStatusFive = empty($data['status_five']) ? 'Unsubscribed' : 'X - '.$data['status_five'].'pt';
					$sStatusSix = empty($data['status_six']) ? 'Unsubscribed' : 'X - '.$data['status_six'].'pt';
					$sStatusSeven = empty($data['status_seven']) ? 'Unsubscribed' : 'X - '.$data['status_seven'].'pt';
					$sStatusSeven1 = empty($data['status_seven1']) ? 'Unsubscribed' : 'X - '.$data['status_seven1'].'pt';
					$sStatusEight = ($data['status_eight'] !='0') ? 'X - '.$data['status_eight'].'pt' : 'Unsubscribed';
					$sStatusNine = empty($data['status_nine']) ? '' : 'X - '.$data['status_nine'].'pt';
					$sLastOne = ($data['last_one'] == '2') ? 'X - '.$data['last_one'].'pt' : 'Unsubscribed';
					$sLastTwo = ($data['last_one'] == '1') ? 'X - '.$data['last_one'].'pt' : 'Unsubscribed';
					$sGiftOne = empty($data['gift_one']) ? 'Unsubscribed' : 'X - '.$data['gift_one'].'pt';
					$sGiftTwo = empty($data['gift_two']) ? 'Unsubscribed' : 'X - '.$data['gift_two'].'pt';
					$sGiftThree = empty($data['gift_three']) ? 'Unsubscribed' : 'X - '.$data['gift_three'].'pt';
					$sGiftFive = empty($data['gift_five']) ? 'Unsubscribed' : 'X - '.$data['gift_five'].'pt';
					$sConsultantOne=empty($data['consultant_one']) ? 'Unsubscribed' : 'X - '.$data['consultant_one'].'pt';
					$sConsultantTwo=empty($data['consultant_two']) ? 'Unsubscribed' : 'X - '.$data['consultant_two'].'pt';
					$sConsultantTwo1 = ($data['consultant_two1']  == 'Y') ? 'Y' : 'Unsubscribed';
					$sConsultantThree=empty($data['consultant_three']) ? 'Unsubscribed' : 'X - '.$data['consultant_three'].'pt';
					$sConsultantFive = !empty($data['consultant_five']) ? 'X - '.$data['consultant_five'].'pt' : 'Unsubscribed';
					$sConsultantSix=empty($data['consultant_six']) ? 'Unsubscribed' : 'X - '.$data['consultant_six'].'pt';
					$sConsultantSeven = empty($data['consultant_seven']) ? 'Unsubscribed' : 'X - '.$data['consultant_seven'].'pt';
					
					$sPackageName = GetPackageName($data['package']);
					$DesignOne = ($data['design_one'] == 0 ? '' : ' - '.$data['design_one'].'pt');


				    if($data['total_text_program'] != '0' || $data['total_text_program7'] != '0') {
				    	$TextingBoth = 'X';
				    }else {
				    	$TextingBoth = '';
				    }

					$sHiddenNewsletterPrice = Get_hidden_newsletter($data['hidden_newsletter']);
					$sHiddenNewletter = GetDesignName($data['hidden_newsletter']);
					$sTotalCharges = $data['package_pricing'] + $sHiddenNewsletterPrice;
					$sTotalCharge = empty($sTotalCharges) ? 'N/C' : '$'.$sTotalCharges;

					$sPersonalUnitAppMsg = Get_personal_app($data['package'], $data['personal_unit_app']);
					$sPersonalUnitAppMsg = "$".$sPersonalUnitAppMsg;
					$sPersonalUnitWebMsg = Get_personal_web($data['package'], $data['personal_website']);	
					$sPersonalUnitWebMsg = "$".$sPersonalUnitWebMsg;
				    $sPersonalUnitAppCanadaMsg=($data['personal_unit_app_ca']=='1') ? '$'.personal_unit_app_canada : '$0';
				    $sPersonalUrlMsg = ($data['personal_url'] == '1') ? '$'.personal_url_val : '$0';
				    $sSubscriptionUpdatesMsg = ($data['subscription_updates']=='1') ? '$'.subscription_updates_val : '$0';
				    $sAppColorMsg = ($data['app_color'] == '1') ? '$'.app_color_val : '$0';
				  //  $sNewsletterFormatingMsg = ($data['newsletter_formating'] == '1') ? '$'.newsletter_formating_val : '$0';


					$printingT = newsletter_print_option($data);
					$StarProgram = (!empty($data['star_program']) ? 'X - '.$data['star_program'].'pt' : '');

					$aPackageDetail = 
					array(
						array('header'=>lg('client_name', $lg), 'value'=> $data['name']),
						array('header'=>lg('package', $lg), 'value'=> $sPackageName),	
						array('header'=>lg('newsletter_design', $lg), 'value'=> $sHiddenNewletter.$DesignOne),
						array('header'=>lg('digital_business_card', $lg), 'value'=> $sEmailNl),
						array('header'=>lg('facebook_nl', $lg), 'value'=> $sfaceboolNl),
						array('header'=>lg('signed_birth_cards', $lg), 'value'=> $sHbirthday),
						array('header'=>lg('birth_post_cards', $lg), 'value'=> $sPcBirthday),
						array('header'=>lg('signed_anniversary_cards', $lg), 'value'=> $sAnniversaryOne),
						array('header'=>lg('anniversary_post_cards', $lg), 'value'=> $sAnniversaryTwo),
						array('header'=>lg('a3_post_card', $lg), 'value'=> $sStatusOne),
						array('header'=>lg('i1_post_card', $lg), 'value'=> $sStatusTwo),
						array('header'=>lg('i2_post_card', $lg), 'value'=> $sStatusThree),
						array('header'=>lg('i3_post_card', $lg), 'value'=> $sStatusFour),
						array('header'=>lg('t1_post_card', $lg), 'value'=> $sStatusFive),
						array('header'=>lg('thank_post_card', $lg), 'value'=> $sStatusSix),
						array('header'=>lg('consistency_post_card', $lg), 'value'=> $sStatusSeven),
						array('header'=>lg('gifts_to_director', $lg), 'value'=> $sStatusSeven1),
						array('header'=>lg('target_post_card', $lg), 'value'=> $sStatusEight),
						array('header'=>lg('star_program', $lg), 'value'=> $StarProgram),
						array('header'=>lg('star_gifts', $lg), 'value'=> $sStatusNine),
						array('header'=>lg('last_month_packets', $lg), 'value'=> $sLastOne),
						array('header'=>lg('last_month_post_card', $lg), 'value'=> $sLastTwo),
						array('header'=>lg('top_month_gift', $lg), 'value'=> $sGiftOne),
						array('header'=>lg('top_ytd', $lg), 'value'=> $sGiftTwo),
						array('header'=>lg('top_recruiting', $lg), 'value'=> $sGiftThree),
						array('header'=>lg('reds_program', $lg), 'value'=> $sGiftFive),
						array('header'=>lg('hubby_post_card', $lg), 'value'=> $sConsultantOne),
						array('header'=>lg('new_consultant_week', $lg), 'value'=> $sConsultantTwo),
						array('header'=>lg('new_consultant_post_cards', $lg), 'value'=> $sConsultantTwo1),
						array('header'=>lg('new_consultant_packet', $lg), 'value'=> $sConsultantFive),
						array('header'=>lg('new_consultant_welcome_packet', $lg), 'value'=> $sConsultantThree),
						array('header'=>lg('new_consultant_notes', $lg), 'value'=> $sConsultantSeven),
						array('header'=>lg('recruiter_checklist', $lg), 'value'=> $sConsultantSix),
						array('header'=>lg('ala_carte_design', $lg), 'value'=> $sNewsLetterDesign),
						array('header'=>lg('formating_newsletter', $lg), 'value'=> $sEmailNews),
						array('header'=>lg('facebook_newsletter', $lg), 'value'=> $sFacebook),
						array('header'=>lg('newsletter_print_option', $lg), 'value'=> $printingT),
						array('header'=>lg('actual_unit_size', $lg), 'value'=> $nStartUnit),
						array('header'=>lg('personal_unit_app', $lg), 'value'=> $sPersonalUnitAppMsg),
						array('header'=>lg('personal_unit_app_canada', $lg), 'value'=> $sPersonalUnitAppCanadaMsg),
						array('header'=>lg('personal_website', $lg), 'value'=> $sPersonalUnitWebMsg),
						array('header'=>lg('personal_url', $lg), 'value'=> $sPersonalUrlMsg),
						array('header'=>lg('update_subscription', $lg), 'value'=> $sSubscriptionUpdatesMsg),
						array('header'=>lg('app_custom_color', $lg), 'value'=> $sAppColorMsg),
						/*array('header'=>lg('newsletter_formating', $lg), 'value'=> $sNewsletterFormatingMsg),*/
						array('header'=>lg('text_email_communication', $lg), 'value'=> $TextingBoth),
						array('header'=>lg('total_charges', $lg), 'value'=> $sTotalCharge),
        			);
					

					$NewPackageRes = array();
					foreach ($aPackageDetail as $key => $val) {
						if(trim($val['value']) == "Unsubscribed" || trim($val['value']) == "No Subscription" || $val['value'] == "" || $val['value'] == "$0") {
							unset($aPackageDetail[$key]);
						}else {
							$NewPackageRes[] = $val;
						}
					}
					
					$aMessage=array('status'=>1, 'data'=>$NewPackageRes);
		        }
			}	
		}

		echo SendResponse($aMessage);
		exit();	
	}
	//End of apiClientPackage.php

}
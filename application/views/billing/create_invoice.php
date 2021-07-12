<?php 
	if (!empty($invoice_data)) {
		$id_get_invoice = $this->uri->segment(3); 
		$var=unserialize($invoice_data['data']);
        extract($var);
	}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Create Invoice</h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i>  <a href="<?php echo base_url('admin/billing'); ?>">Dashboard</a></li>
            <li class="active">Create Invoice</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
                <?php 
                if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

        		<div class="box">
        			<div class="box-body">
                        <div class="main-invoice">
                        <form method="post" id="invoice_form">
                            <input type="hidden" name='id_newsletter' id="id_newsletter" value="<?php echo empty($invoice_data) ? '' : $invoice_data['id_newsletter'];  ?>" />

                            <input type="hidden" name='invoice_date' id="invoice_date" value="<?php echo empty($invoice_data) ? '' : $invoice_data['invoice_date'];  ?>" />

                            <input type="hidden" name='id_invoice' id="id_invoice" value="<?php echo empty($invoice_data) ? '' : $invoice_data['id_invoice'];  ?>" />

                        <div class="row clearfix add_sub_tab">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Name </th>
                                            <th class="text-center"> Email </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td>
                                                <input type="text" name='name' id="search-box"  placeholder='Client Name' class="form-control" value="<?php echo @$invoice_data['name']; ?>" autocomplete="off" required=""/>
                                                <div id="suggesstion-box"></div>

                                            </td>
                                            <td><input type="text" name='email' id="email" placeholder='Email' class="form-control" value="<?php echo @$invoice_data['email']; ?>" required=""/></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>

                            <?php                       
	        					if(!empty($id_get_invoice)){ ?>
	                            <div class="col-sm-12">
	                                <table class="table table-bordered table-hover table_common" id="tab_logic_sub">
	                                    <thead>
	                                        <tr>
	                                            <th class="text-center"> # </th>
	                                            <th class="text-center th-name"> Name </th>
	                                            <th class="text-center th-unit"> Quantity </th>
	                                            <th class="text-center th-value"> Value($) </th>
	                                            <th class="text-center th-total"> Total($) </th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php 
	                                        $l_num = 1;

	                                        if(@$unit_size >= 0 && !empty(@$package )) {
	                                        	echo table_format($l_num, 'package', @$package, 'unit_size', '', 'package_value', @$package_value, 'package_value_total', @$package_value_total);
	                                            $l_num++;
	                                        }


	                                        if(@$canada_service) {
	                                        	echo table_format($l_num, 'canada_service_name', 'Canada Service', 'canada_service', @$canada_service, 'canada_service_val', @$canada_service_val, 'canada_service_val_total', @$canada_service_val_total);
	                                            $l_num++;
	                                        }
	                                        
	                                        if(@$facebook) {
	                                        	echo table_format($l_num, 'facebook_name', 'Facebook Newsletters', 'facebook', '1', 'facebook_val', @$facebook_val, 'facebook_val_total', @$facebook_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$facebook_everything) {
	                                        	echo table_format($l_num, 'facebook_everything_name', 'Facebook Everything', 'facebook_everything', '1', 'facebook_everything_val', @$facebook_everything_val, 'facebook_everything_val_total', @$facebook_everything_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$emailing) {
	                                        	echo table_format($l_num, 'emailing_name', 'Newsletters', 'emailing', @$emailing, 'emailing_val', @$emailing_val, 'emailing_val_total', @$emailing_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$email_newsletter) {
	                                        	echo table_format($l_num, 'email_newsletter_name', 'Email Newsletter', 'email_newsletter', @$email_newsletter, 'email_newsletter_val', @$email_newsletter_val, 'email_newsletter_val_total', @$email_newsletter_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$nsd_client) {
	                                        	echo table_format($l_num, 'nsd_client_name', 'NSD text and email', 'nsd_client', @$nsd_client, 'nsd_client_val', @$nsd_client_val, 'nsd_client_val_total', @$nsd_client_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$digital_biz_card) {
	                                        	echo table_format($l_num, 'digital_biz_card_name', 'Digital Biz Card', 'digital_biz_card', @$digital_biz_card, 'digital_biz_card_val', @$digital_biz_card_val, 'digital_biz_card_val_total', @$digital_biz_card_val_total);
	                                            $l_num++;
	                                        }
	                                        
	                                        if(@$total_text_program) {
	                                        	echo table_format($l_num, 'total_text_program_name', 'Total text package', 'total_text_program', @$total_text_program, 'total_text_program_val', @$total_text_program_val, 'total_text_program_val_total', @$total_text_program_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$total_text_program7) {
	                                        	echo table_format($l_num, 'total_text_program7_name', '7/2019 Total text package', 'total_text_program7',@$total_text_program7, 'total_text_program7_val', @$total_text_program7_val, 'total_text_program7_val_total', @$total_text_program7_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$text_email) {
	                                        	echo table_format($l_num, 'text_email_name', 'Text and Email', 'text_email', @$text_email, 'text_email_val', @$text_email_val, 'text_email_val_total', @$text_email_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$prospect_system) {
	                                        	echo table_format($l_num, 'prospect_system_name', 'Prospect System', 'prospect_system', '1', 'prospect_system_val', @$prospect_system_val, 'prospect_system_val_total', @$prospect_system_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$magic_booker) {
	                                        	echo table_format($l_num, 'magic_booker_name', 'Magic Booker System', 'magic_booker', '1', 'magic_booker_val', @$magic_booker_val, 'magic_booker_val_total', @$magic_booker_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$other_language_newsletter) {
	                                        	echo table_format($l_num, 'other_language_newsletter_name', 'Other language newsletter', 'other_language_newsletter', '1', 'other_language_newsletter_val', @$other_language_newsletter_val, 'other_language_newsletter_val_total', @$other_language_newsletter_val_total);
	                                            $l_num++;
	                                        }
	                                        if(@$personal_unit_app) {
	                                        	echo table_format($l_num, 'personal_unit_app_name', 'Personal Unit App', 'personal_unit_app', '1', 'personal_unit_app_val', @$personal_unit_app_val, 'personal_unit_app_val_total', @$personal_unit_app_val_total);
	                                            $l_num++;
	                                        }
	                                        if(@$personal_website) {
	                                            echo table_format($l_num, 'personal_website_name', 'Personal Website', 'personal_website', '1', 'personal_website_val', @$personal_website_val, 'personal_website_val_total', @$personal_website_val_total);
	                                            $l_num++;
	                                        }
	                                        if(@$personal_url) {
	                                        	echo table_format($l_num, 'personal_url_name', 'Personal URL', 'personal_url', '1', 'personal_url_val', $personal_url_val, 'personal_url_val_total', $personal_url_val_total);
	                                            $l_num++;
	                                        }
	                                        if(@$subscription_updates) {
	                                        	echo table_format($l_num, 'subscription_updates_name', '10 Updates on subscription', 'subscription_updates', '1', 'subscription_updates_val', @$subscription_updates_val, 'subscription_updates_val_total', @$subscription_updates_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$app_color) {
	                                        	echo table_format($l_num, 'app_color_name', 'App custom color', 'app_color', '1', 'app_color_val', $app_color_val, 'app_color_val_total', $app_color_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$newsletter_color) {
	                                        	echo table_format($l_num, 'newsletter_color_name', 'Newsletter-Color', 'newsletter_color', @$newsletter_color, 'newsletter_color_val', @$newsletter_color_val, 'newsletter_color_val_total', @$newsletter_color_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$newsletter_black_white) {
	                                        	echo table_format($l_num, 'newsletter_black_white_name', 'Newsletter-Black White', 'newsletter_black_white', @$newsletter_black_white, 'newsletter_black_white_val', @$newsletter_black_white_val, 'newsletter_black_white_val_total', @$newsletter_black_white_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$month_packet_postage) {
	                                        	echo table_format($l_num, 'month_packet_postage_name', 'Last Month Packets Postage', 'month_packet_postage', @$month_packet_postage, 'month_packet_postage_val', @$month_packet_postage_val, 'month_packet_postage_val_total', @$month_packet_postage_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$consultant_packet_postage) {
	                                        	echo table_format($l_num, 'consultant_packet_postage_name', 'New Consultant Packet Postage', 'consultant_packet_postage', @$consultant_packet_postage, 'consultant_packet_postage_val', @$consultant_packet_postage_val, 'consultant_packet_postage_val_total', @$consultant_packet_postage_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$consultant_bundles) {
	                                            echo table_format($l_num, 'consultant_bundles_name', 'New Consultant Bundles', 'consultant_bundles', @$consultant_bundles, 'consultant_bundles_val', @$consultant_bundles_val, 'consultant_bundles_val_total', @$consultant_bundles_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$consistency_gift) {
	                                        	echo table_format($l_num, 'consistency_gift_name', 'Consistency Gift', 'consistency_gift', @$consistency_gift, 'consistency_gift_val', @$consistency_gift_val, 'consistency_gift_val_total', @$consistency_gift_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$reds_program_gift) {
	                                        	echo table_format($l_num, 'reds_program_gift_name', 'Reds Program Gift', 'reds_program_gift', @$reds_program_gift, 'reds_program_gift_val', @$reds_program_gift_val, 'reds_program_gift_val_total', @$reds_program_gift_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$stars_program_gift) {
	                                        	echo table_format($l_num, 'stars_program_gift_name', 'Stars Program Gift', 'stars_program_gift', @$stars_program_gift, 'stars_program_gift_val', @$stars_program_gift_val, 'stars_program_gift_val_total', @$stars_program_gift_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$gift_wrap_postpage) {
	                                        	echo table_format($l_num, 'gift_wrap_postpage_name', 'Gift Wrap and Postage', 'gift_wrap_postpage', @$gift_wrap_postpage, 'gift_wrap_postpage_val', @$gift_wrap_postpage_val, 'gift_wrap_postpage_val_total', @$gift_wrap_postpage_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$one_rate_postpage) {
	                                        	echo table_format($l_num, 'one_rate_postpage_name', 'One Rate Postage', 'one_rate_postpage', @$one_rate_postpage, 'one_rate_postpage_val', @$one_rate_postpage_val, 'one_rate_postpage_val_total', @$one_rate_postpage_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$month_blast_flyer) {
	                                        	echo table_format($l_num, 'month_blast_flyer_name', 'Month End Blast Flyer', 'month_blast_flyer', @$month_blast_flyer, 'month_blast_flyer_val', @$month_blast_flyer_val, 'month_blast_flyer_val_total', @$month_blast_flyer_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$flyer_ecard_unit) {
	                                        	echo table_format($l_num, 'flyer_ecard_unit_name', 'Flyer Ecard to Unit', 'flyer_ecard_unit', @$flyer_ecard_unit, 'flyer_ecard_unit_val', @$flyer_ecard_unit_val, 'flyer_ecard_unit_val_total', @$flyer_ecard_unit_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$unit_challenge_flyer) {
	                                        	echo table_format($l_num, 'unit_challenge_flyer_name', 'Unit Challenge Flyer', 'unit_challenge_flyer', @$unit_challenge_flyer, 'unit_challenge_flyer_val', @$unit_challenge_flyer_val, 'unit_challenge_flyer_val_total', @$unit_challenge_flyer_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$team_building_flyer) {
	                                        	echo table_format($l_num, 'team_building_flyer_name', 'Team Building Flyer', 'team_building_flyer', @$team_building_flyer, 'team_building_flyer_val', @$team_building_flyer_val, 'team_building_flyer_val_total', @$team_building_flyer_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$wholesale_promo_flyer) {
	                                        	echo table_format($l_num, 'wholesale_promo_flyer_name', 'Wholesale Promo Flyer', 'wholesale_promo_flyer', @$wholesale_promo_flyer, 'wholesale_promo_flyer_val', @$wholesale_promo_flyer_val, 'wholesale_promo_flyer_val_total', @$wholesale_promo_flyer_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$postcard_design) {
	                                        	echo table_format($l_num, 'postcard_design_name', 'Design Fee', 'postcard_design', @$postcard_design, 'postcard_design_val', @$postcard_design_val, 'postcard_design_val_total', @$postcard_design_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$postcard_edit) {
	                                        	echo table_format($l_num, 'postcard_edit_name', 'Custom Changes', 'postcard_edit', @$postcard_edit, 'postcard_edit_val', @$postcard_edit_val, 'postcard_edit_val_total', @$postcard_edit_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$ecard_unit) {
	                                        	echo table_format($l_num, 'ecard_unit_name', 'Small Edit', 'ecard_unit', @$ecard_unit, 'ecard_unit_val', @$ecard_unit_val, 'ecard_unit_val_total', @$ecard_unit_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$speciality_postcard) {
	                                        	echo table_format($l_num, 'speciality_postcard_name', 'Specialty Postcard', 'speciality_postcard', @$speciality_postcard, 'speciality_postcard_val', @$speciality_postcard_val, 'speciality_postcard_val_total', @$speciality_postcard_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$card_with_gift) {
	                                        	echo table_format($l_num, 'card_with_gift_name', 'Greeting Card with gift', 'card_with_gift', @$card_with_gift, 'card_with_gift_val', @$card_with_gift_val, 'card_with_gift_val_total', @$card_with_gift_val_total);
	                                            $l_num++;
	                                        }
	                                        if(@$greeting_card) {
	                                        	echo table_format($l_num, 'greeting_card_name', 'Greeting Card', 'greeting_card', @$greeting_card, 'greeting_card_val', @$greeting_card_val, 'greeting_card_val_total', @$greeting_card_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$birthday_brownie) {
	                                        	echo table_format($l_num, 'birthday_brownie_name', 'Greeting Post Card', 'birthday_brownie', @$birthday_brownie, 'birthday_brownie_val', @$birthday_brownie_val, 'birthday_brownie_val_total', @$birthday_brownie_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$birthday_starbucks) {
	                                        	echo table_format($l_num, 'birthday_starbucks_name', 'Birthday Cards and Starbucks', 'birthday_starbucks', @$birthday_starbucks, 'birthday_starbucks_val', @$birthday_starbucks_val, 'birthday_starbucks_val_total', @$birthday_starbucks_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$anniversary_starbucks) {
	                                        	echo table_format($l_num, 'anniversary_starbucks_name', 'Anniversary Card and Starbucks', 'anniversary_starbucks', @$anniversary_starbucks, 'anniversary_starbucks_val', @$anniversary_starbucks_val, 'anniversary_starbucks_val_total', @$anniversary_starbucks_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$referral_credit) {
	                                        	echo table_format($l_num, 'referral_credit_name', 'Referral Credit', 'referral_credit', @$referral_credit, 'referral_credit_val', @$referral_credit_val, 'referral_credit_val_total', @$referral_credit_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$special_credit_name) {
	                                        	echo table_format($l_num, 'special_credit_name', @$special_credit_name, 'special_credit', @$special_credit, 'special_credit_val', @$special_credit_val, 'special_credit_val_total', @$special_credit_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$invoice_note_name) {
	                                        	echo table_format($l_num, 'invoice_note_name', @$invoice_note_name, 'invoice_note', @$invoice_note, 'invoice_note_val', @$invoice_note_val, 'invoice_note_val_total', @$invoice_note_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$cc_billing) {
	                                        	echo table_format($l_num, 'cc_billing_name', 'Consultant Communication- billing', 'cc_billing', @$cc_billing, 'cc_billing_val', @$cc_billing_val, 'cc_billing_val_total', @$cc_billing_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$customer_newsletter) {
	                                        	echo table_format($l_num, 'customer_newsletter_name', 'Customer Newsletter', 'customer_newsletter', @$customer_newsletter, 'customer_newsletter_val', @$customer_newsletter_val, 'customer_newsletter_val_total', @$customer_newsletter_val_total);
	                                            $l_num++;
	                                        }


	                                        if(@$picture_texting) {
	                                        	echo table_format($l_num, 'picture_texting_name', 'Picture Texting', 'picture_texting', @$picture_texting, 'picture_texting_val', @$picture_texting_val, 'picture_texting_val_total', @$picture_texting_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$keyword) {
	                                        	echo table_format($l_num, 'keyword_name', 'Keywords for texting system', 'keyword', @$keyword, 'keyword_val', @$keyword_val, 'keyword_val_total', @$keyword_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$client_setup) {
	                                        	echo table_format($l_num, 'client_setup_name', 'New Client Set up Fee', 'client_setup', @$client_setup, 'client_setup_val', @$client_setup_val, 'client_setup_val_total', @$client_setup_val_total);
	                                            $l_num++;
	                                        }

	                                        if(@$nl_flyer) {
	                                        	echo table_format($l_num, 'nl_flyer_name', 'Graphic Insert', 'nl_flyer', @$nl_flyer, 'nl_flyer_val', @$nl_flyer_val, 'nl_flyer_val_total', @$nl_flyer_val_total);
	                                            $l_num++;
	                                        }
	                                        if(@$misc_charge) {
	                                        	echo table_format($l_num, 'misc_charge_name', @$misc_charge_name, '','', 'misc_charge', @$misc_charge, 'misc_charge_val_total', @$misc_charge_val_total);
	                                            $l_num++;
	                                        }
	                                        
	                                        if(@$cc_charge_val_total > 0) {
	                                        	echo table_format($l_num, 'cc_charge_name', @$cc_charge_name, '','', 'cc_charge_val', @$cc_charge_val, 'cc_charge_val_total', @$cc_charge_val_total);
	                                            $l_num++;

	                                        }

	                                        if(!empty($extra_name)) {
	                                        	$lng = count(@$extra_name);
	                                            $addExtraTT = 0;
	                                            for ($i=0; $i < $lng; $i++) { 
	                                            	echo table_format($l_num, 'extra_name[]', @$extra_name[$i], 'extra[]', @$extra[$i], 'extra_val[]', @$extra_val[$i], 'extra_val_total[]', @$extra_val_total[$i]);
	                                                $l_num++;   
	                                                $addExtraTT += @$extra_val_total[$i];
	                                            }
	                                        }

	                                        if(@$credit_roll_over_total != '') {
	                                        	echo table_format($l_num, 'credit_roll_over_name', @$credit_roll_over_name, '', '', 'credit_roll_over_val', @$credit_roll_over_val, 'credit_roll_over_total', @$credit_roll_over_total);
	                                            $l_num++;
	                                        }
	                                        echo '<input type="hidden" name="count_var" id="count_var" value="'.$l_num.'">';
	                                        ?>
	                                    </tbody>
	                                </table>
	                            </div>
							<?php } ?>
                        </div>
                        <div id="addNew"><i class="fa fa-plus"></i></div>
                        <div class="pull-right total-fields col-md-5">
                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                <tbody>
                                    <tr>
                                        <th class="text-left t1" id="special_creadit_name">Account Credit</th>
                                        <?php if(!empty($invoice_data) && $invoice_data['create_by'] == 1) { ?>

                                             <td class="text-center">
                                                <input type="text" id="special_creadit_val" name="special_creadit_val" value="<?php echo number_format(@$special_creadit,2); ?>" />
                                                <input hidden id="special_creadit_old" name="special_creadit_old" value="<?php echo number_format(@$special_creadit,2); ?>" />
                                            </td>
                                        <?php }else { ?>
                                        <td class="text-center">
                                            <input type="text" id="special_creadit_val" name="special_creadit_val" value="<?php echo number_format(@$special_creadit_val,2); ?>" />
                                            <input hidden id="special_creadit_old" name="special_creadit_old" value="<?php echo number_format(@$special_creadit_old,2); ?>" />
                                        </td>
                                        <?php }  ?>
                                    </tr>
                                    <tr>
                                        <th class="text-right t1">Grand Total $</th>
                                       
                                        <td class="text-center">
                                            <?php 
                                            
                                            if(!empty($invoice_data) && $invoice_data['create_by'] == 1 && isset($var['roll_over_total']) && $var['roll_over_total'] != '') { ?>
                                                <input type="text" id="total" name='price' class="form-control prisce" value="<?php echo number_format(@$invoice_data['total'] - abs($var['roll_over_total']) ,2); ?>" readonly=""/>    
                                            <?php }elseif(!empty($invoice_data) && $invoice_data['create_by'] == 0 && @$credit_roll_over_total != '') { ?>
                                                 <input type="text" id="total" name='price' class="form-control prisce" value="<?php echo number_format(@$invoice_data['total'] - abs($credit_roll_over_total),2); ?>" readonly=""/> 
                                            <?php }else { ?>
                                                <input type="text" id="total" name='price' class="form-control prisce" value="<?php echo isset($invoice_data['total']) ? number_format(@$invoice_data['total'],2) : ''; ?>" readonly=""/>
                                            <?php }  ?>
                                            
                                        </td>
                                       
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="pull-left col-md-7  add_cc">
                                <div id="displaysuccessMessage"></div>
                            </div>
                            <div class="pull-right col-md-4">
                                <div class="three-btn">
                                    <a href="<?php echo base_url('billing/clients'); ?>">
                                    	<input type="button" name="cancel" class="btn btn-info" value="Cancel"/>
                                    </a>
                                    <button type="button" name="save" class="btn btn-info" id="submit_form">Save</button>
                                </div>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/invoice.js'); ?>" type="text/javascript"></script>
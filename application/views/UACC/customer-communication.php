<?php 
	$url = $this->uri->segment(1);
	$id_cc_newsletter = $this->uri->segment(2);
	
	if (!empty($data)) {

		$mary_kay=($data['cc_director_title']=='Mary Kay Independent Beauty Consultant') ? 'selected' : '';
		$ind_sales=($data['cc_director_title']=='Independent Sales Director') ? 'selected' : '';
		$ind_snr_sales=($data['cc_director_title']=='Independent Senior Sales Director') ? 'selected' : '';
		$future_exec_snr=($data['cc_director_title']=='Future Executive Senior Sales Director') ? 'selected' : '';
		$exec_snr=($data['cc_director_title']=='Executive Senior Sales Director') ? 'selected' : '';
		$elite_exec_snr=($data['cc_director_title']=='Elite Executive Senior Sales Director') ? 'selected' : '';
		$ind_national_sales=($data['cc_director_title']=='Independent National Sales Director') ? 'selected' : '';
		$ind_snr_national=($data['cc_director_title']=='Independent Senior National Sales Director') ? 'selected' : '';
		$ind_exec_national=($data['cc_director_title']=='Independent Executive National Sales Director') ? 'selected' : '';
		$ind_exec_national=($data['cc_director_title']=='Independent Elite Executive National Sales Director')?'selected':'';
		$cc = ($data['pmt_type'] == 'CC') ? 'selected' : '';
		$ach = ($data['pmt_type'] == 'ACH') ? 'selected' : '';
		$english = ($data['cc_newsletter']=='E' || $data['cc_newsletter']=='') ? 'checked' : '';
		$canada_english =($data['cc_newsletter']=='CE'||$data['cc_newsletter']=='') ? 'checked' : '';
		$spanish = ($data['cc_newsletter'] == 'S') ? 'checked' : '';
		$french = ($data['cc_newsletter'] == 'F') ? 'checked' : '';
		$txt_email = ($data['cc_text_system']== 1 || $data['cc_text_system'] == '') ? 'checked' : '';
		$email_only = ($data['cc_text_system'] == 2) ? 'checked' : '';
		$txt_only = ($data['cc_text_system'] == 3) ? 'checked' : '';
		$no_txt_or_email = ($data['cc_text_system'] == 4) ? 'checked' : '';
		$prod_y = ($data['product_promotion'] == 'Y' || $data['product_promotion'] == '') ? 'checked' : '';
		$prod_n =($data['product_promotion'] == 'N') ? 'checked' : '';
		$anniv = ($data['cc_anniversary'] == 'X' || $data['cc_anniversary'] == '') ? 'checked' : '';
		$prospect_sys = ($data['prospect_system'] == '1') ? 'checked' : '';
		$free = ($data['free'] == '1') ? 'checked' : ''; 
		$cv_prospect = ($data['cv_prospect'] == '1') ? 'checked' : '';
		$cc_birthday = ($data['cc_birthday'] == 'X' || $data['cc_birthday'] == '') ? 'checked' : '';
		$send_mail = ($data['send_mail'] == 1) ? 'checked' : '';
		$no_charge = ($data['cc_chargefree'] == 1) ? 'checked' : '';
		$status_done = ($data['status_done'] == 1) ? 'checked' : '';
		$inc_tbc = ($data['inc_tbc'] == '1') ? 'checked' : '';
		$biz_card = ($data['digital_biz_card'] == '1') ? 'checked' : '';
		$decrypted = decryptIt($data['cv_account']);

	}
?>

<style type="text/css">

	form.uacc_form label {
    	width: 25%;
	}

	form.uacc_form .form-control, form.uacc_form .monthpicker {
	    width: 74%;
	    display: inline-block;
	}

	form.uacc_form input[name="digital_biz_link"]{
		width: 70%;
    	margin-left: 12px;
	}

</style>

<div class="row">
	<div class="col-sm-12 text-center">
		<h1 class="title">Customer Care Package Payment $29.99 per month</h1>
		<h3 class="title"><string>The auto communication will contain:</string></h3>
		<p>A customer Newletter E-mailed plus a link text to
		your customers to view on their cell phone 
		Birthday Video E-Cards plus Text Message
		Anniversary Video E-Cards plus Text Message
		Monthly Product Video E-Cards plus Text Message
		</p>
		<p>Plus the ability to send your own messages to your
		customers in one quick message!
		You will be able to select specific people or send a
		group text message
		</p>
		<p><i>Please complete the form below to get started-</i></p>

		<div class="profile_pic text-center">

			<?php
				
				$img = isset($data['consultant_number']) ? strtolower($data['consultant_number']).'.jpg' : '';
				$image = base_url('/assets/images/profile_img/'.$img);
				if (@getimagesize($image)) {
					$image = $image;
				}elseif (empty($data['photo'])) {
					$image = '/assets/images/profile_img/female.jpg';
				}else{
					$image = '/assets/images/profile_img/'.$data['photo'];
				}
			?>

			<img src="<?php echo $image; ?>" />	

			<h3><?php echo isset($data['name']) ? $data['name'] : '';?></h3>						
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-8">
		<form class="uacc_form" method="post" action="" enctype="multipart/form-data">
			<?php
				if ($url == 'edit-uacc' && is_ua($data['consultant_number']) ) { ?>
					<div class="notice notice-danger">
						<b> This client has taken Unit Assistant service.</b>
					</div>
			<?php } ?>
			<div class="login_aleart">
				<?php if(empty($data['app_login'])) { ?>
					<div class="notice notice-danger"> Client is not logged in yet. </div>
				<?php }else {
					if(!empty($MaData)) { ?>
						<div class="notice notice-success"> <?php echo $MaData['purpose']; ?> </div>
					<?php }
				} ?>

				<?php if(!empty($data['app_last_login'])){ ?>
					<div class="notice notice-success"> <?php echo 'Last login at: '.$data['app_last_login']; ?> </div>
				<?php } ?>
			</div>

			<div class="form-group">
				<label>Director Title </label>
				<select class="form-control" name="cc_director_title" required>
					<option value="">---Select Director Title--</option>
					<option value="Mary Kay Independent Beauty Consultant" <?php echo isset($mary_kay) ? $mary_kay : ''; ?> >Mary Kay Independent Beauty Consultant</option>
					<option value="Independent Sales Director" <?php echo isset($ind_sales) ? $ind_sales : ''; ?> >Independent Sales Director</option>
					<option value="Independent Senior Sales Director" <?php echo isset($ind_snr_sales) ? $ind_snr_sales : ''; ?> >Independent Senior Sales Director</option>
					<option value="Future Executive Senior Sales Director" <?php echo isset($future_exec_snr) ? $future_exec_snr : ''; ?>>Future Executive Senior Sales Director</option>
					<option value="Executive Senior Sales Director" <?php echo isset($exec_snr) ? $exec_snr : ''; ?>>Executive Senior Sales Director</option>
					<option value="Elite Executive Senior Sales Director" <?php echo isset($elite_exec_snr) ? $elite_exec_snr : ''; ?>>Elite Executive Senior Sales Director</option>
					<option value="Independent National Sales Director" <?php echo isset($ind_national_sales) ? $ind_national_sales : ''; ?>>Independent National Sales Director</option>
					<option value="Independent Senior National Sales Director" <?php echo isset($ind_snr_national) ? $ind_snr_national : ''; ?>>Independent Senior National Sales Director</option>
					<option value="Independent Executive National Sales Director" <?php echo isset($ind_exec_national) ? $ind_exec_national : ''; ?> >Independent Executive National Sales Director</option>
					<option value="Independent Elite Executive National Sales Director" <?php echo isset($ind_exec_national) ? $ind_exec_national : ''; ?>>Independent Elite Executive National Sales Director</option>
				</select>
			</div>

			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" value="<?php echo empty($data['name']) ? '' : $data['name'];?>" required>
			</div>

			<div class="form-group">
				<label>Email</label>
				<input type="text" class="form-control" name="email" value="<?php echo empty($data['email']) ? '' : $data['email'];?>" onblur="uniqueEmail(this.value, 'UACC');" required>
				<div id="resultImageProfile1"></div>
				<img src="<?php echo base_url('assets/images/load.gif'); ?>" class="img-responsive img-load">
				<input type="hidden" value="<?php echo empty($id_cc_newsletter) ? '' : $id_cc_newsletter; ?>" id="hidden_id">
				<span class="error" id="error-email"></span>
				<span id="note-email"></span>
			</div>
			<div class="form-group">
				<label>Phone Number</label>
				<input type="text" class="form-control" name="cell_number" value="<?php echo empty($data['cell_number']) ? '' : $data['cell_number'];?>" required>
			</div>
			<div class="form-group">
				<label>Consultant Id</label>
				<input type="text" class="form-control" name="consultant_number" id="consultant_number" required="" onblur="uniqueId(this.value, 'UACC');" value="<?php echo empty($data['consultant_number']) ? '' : $data['consultant_number'];?>" />
				<div id="resultImageProfile"></div>
				<img src="<?php echo base_url('assets/images/load.gif'); ?>" class="img-responsive img-load">
				<input type="hidden" value="<?php echo empty($id_cc_newsletter) ? '' : $id_cc_newsletter; ?>" id="hidden_id">
				<span class="error" id="error-consul"></span>
				<span id="note-consul"></span>

			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="text" class="form-control" name="intouch_password" value="<?php echo empty($data['intouch_password']) ? '' : $data['intouch_password'];?>"/>
			</div>
			<div class="form-group">
				<label>National Area</label>
				<input type="text" class="form-control" name="national_area"  value="<?php echo empty($data['national_area']) ? '' : $data['national_area'];?>"/>
			</div>
			<div class="form-group">
				<label>Address</label>
				<input type="text" class="form-control" name="address"  value="<?php echo empty($data['address']) ? '' : $data['address'];?>"/>
			</div>
			<div class="form-group">
				<label>City</label>
				<input type="text" class="form-control" name="city" value="<?php echo empty($data['city']) ? '' : $data['city'];?>"/>
			</div>
			<div class="form-group">
				<label>State</label>
				<input type="text" class="form-control" name="state" value="<?php echo empty($data['state']) ? '' : $data['state'];?>"/>
			</div>
			<div class="form-group">
				<label>Zip</label>
				<input type="text" class="form-control" name="zip"  value="<?php echo empty($data['zip']) ? '' : $data['zip'];?>"/>
			</div>
			<div class="form-group">
				<label>Seminar</label>
				<input type="text" class="form-control" name="seminar_affiliation" value="<?php echo empty($data['seminar_affiliation']) ? '' : $data['seminar_affiliation'];?>"/>
			</div>
			<div class="form-group">
				<label>Payment Type</label>
				<select name="pmt_type" id="pmt_type" class="form-control" required>
					<option value="">---Select Payment Type--</option>
					<option value="CC"<?php echo isset($cc) ? $cc : '';?>>CC</option>
					<option value="ACH" <?php echo isset($ach) ? $ach : ''; ?>>ACH</option>
				</select>
			</div>
			<div class="routing_cc">
				<div class="form-group">
					<label>Checking Account Number</label>
					<input type="text" class="form-control" name="cv_account" value="<?php echo empty($data['cv_account']) ? '' : $decrypted;?>"/>
				</div>
				<div class="form-group">
					<label>Routing Number</label>
					<input type="text" class="form-control" name="cu_routing" value="<?php echo empty($data['cu_routing']) ? '' : $data['cu_routing'];?>"/>
				</div>
			</div>
			
			<div class="account_detail_cc" style="display: none;">
				<div class="form-group">
					<label>Card Number</label>
					<input type="text" class="form-control" name="cc_number" value="<?php echo empty($data['cc_number']) ? '' : $data['cc_number'];?>" placeholder="**** **** **** ****">
				</div>

				<div class="form-group">
					<label>Security Code</label>
					<input type="text" class="form-control" placeholder="Security Code" name="cc_code" value="<?php echo empty($data['cc_code']) ? '' : $data['cc_code'];?>">
				</div>

				<div class="form-group">
					<label>Expiration Date</label>
					<input type="text" class="form-control" maxlength="5" name="cc_expir_date" placeholder="MM/YY" value="<?php echo empty($data['cc_expir_date']) ? '' : $data['cc_expir_date'];?>">
				</div>

				<div class="form-group">
					<label>Postal Code</label>
					<input type="text" class="form-control" name="cc_zip" placeholder="1001" value="<?php echo empty($data['cc_zip']) ? '' : $data['cc_zip'];?>">
				</div>
			</div>
			<div class="form-group">
				<label>Preferred Language: </label>
				<input type="radio" class="cols-md-6 radio-inline" name="cc_newsletter" value="E" <?php echo isset($english) ? $english : '';?>> English
				<input type="radio" class="cols-md-6 radio-inline" name="cc_newsletter" value="CE" <?php echo isset($canada_english) ? $canada_english : '';?> > Canada English
				<input type="radio" class="cols-md-6 radio-inline" name="cc_newsletter" value="S" <?php echo isset($spanish) ? $spanish : ''; ?>> Spanish
				<input type="radio" class="cols-md-6 radio-inline" name="cc_newsletter" value="F" <?php echo isset($french) ? $french : ''; ?> > French
			</div>
			<div class="form-group">
				<label>Client Notes:</label>
				<textarea class="form-control" name="client_note"><?php echo empty($data['client_note']) ? '' : $data['client_note']; ?></textarea>
			</div>
			<div class="form-group">
				<label>Text Note:</label>
				<textarea name="note" class="form-control"><?php echo empty($data['note']) ? '' : $data['note']; ?></textarea>
			</div>
			<div class="form-group"> 
				<label> Text Package : </label>
				<input type="radio" class="radio-inline" name="cc_text_system" value="1" <?php echo isset($txt_email) ? $txt_email : '';?> > Text and Email
				<input type="radio" name="cc_text_system" class="radio-inline" value="2" <?php echo isset($email_only) ? $email_only : ''; ?> > Email Only
				<input type="radio" name="cc_text_system" class="radio-inline" value="3" <?php echo isset($txt_only) ? $txt_only : ''; ?> > Text Only
				<input type="radio" name="cc_text_system" class="radio-inline" value="4" <?php echo isset($no_txt_or_email) ? $no_txt_or_email : ''; ?> > No Text or Email
			</div>

			<div class="form-group">
				<label>Product Promotion:</label>
				<input type="radio" name="product_promotion" class="radio-inline" value="Y" <?php echo isset($prod_y) ? $prod_y : ''; ?> > Yes
					<input type="radio" name="product_promotion" class="radio-inline" value="N" <?php echo isset($prod_n) ? $prod_n : '';?> > No
			</div>

			<div class="form-group">
				<label>Anniversary:</label>
				<input type="checkbox" name="cc_anniversary" class="radio-inline" value="X" <?php echo isset($anniv) ? $anniv : ''; ?> >
			</div>
			<div class="form-group">
				<label>Prospect System:</label>
				<input type="checkbox" name="prospect_system" class="radio-inline" value="1" <?php echo isset($prospect_sys) ? $prospect_sys : ''; ?> >
			</div>

			<div class="form-group">
				<label>Free:</label>
				<input type="checkbox" name="free" class="radio-inline" value="1" <?php echo isset($free)? $free : '';?> >
			</div>

			<div class="form-group">
				<label>Carona Virus special prospecting:</label>
				<input type="checkbox" name="cv_prospect" class="radio-inline" value="1" <?php echo isset($cv_prospect) ? $cv_prospect : ''; ?>>
			</div>
			<div class="form-group">
				<label>Birthday:</label>	
				<input type="checkbox" name="cc_birthday" value="X" <?php echo isset($cc_birthday) ? $cc_birthday : ''; ?> >
			</div>
			<div class="form-group">
		        <label>Photo</label>
		        <input type="file" class="form-control" name="photo" />
		        <input type="hidden" name="alt_photo" value="<?php echo empty($data['photo']) ? '' : $data['photo']; ?>" />
		    </div>
			<div class="form-group">
				<label>Client Birthday</label>
				<input type="text" class="form-control" name="dob" id="cc_dob" value="<?php echo empty($data['dob']) ? '' : $data['dob'];?>" >
					</div>
			<div class="form-group">
				<label>Client Birthday Notes:</label>
				<textarea class="form-control" name="birth_note"><?php echo empty($data['birth_note']) ? '' : $data['birth_note']; ?></textarea>
			</div>
			<div class="form-group month_mailing">
				<label>Month you want to start mailing :</label>
				<input type="text" class="form-control" name="month_mailing" id="cc_month_mailing" placeholder="click to show picker" value="<?php echo empty($data['month_mailing']) ? '' : $data['month_mailing'];?>" >
			</div>
			<div class="form-group">
				<label>Account Number</label>
				<input type="text" class="form-control" name="account_number" value="<?php echo empty($data['account_number']) ? '' : $data['account_number'];?>">
			</div>
			<div class="form-group">
				<label>Month bill date</label>
				<input type="text" class="form-control" name="m_bill_date" id="cc_m_bill_date"  value="<?php echo empty($data['m_bill_date'])  ? '' : $data['m_bill_date'];?>">
			</div>
			<div class="form-group">
				<label>Misc charge</label>
				<textarea class="form-control" name="misc_charge"><?php echo empty($data['misc_charge']) ? '' : $data['misc_charge'];?></textarea>
			</div>
			<div class="form-group">
				<label>Billing Alert box</label>
				<textarea class="form-control" name="billing_alert"><?php echo empty($data['billing_alert']) ? '' : $data['billing_alert'];?></textarea>
			</div>
			<div class="form-group">
				<label>Unsubscribe Date</label>
				<input type="text" class="form-control" name="contract_update_date" id="cc_contract_update_date" value="<?php echo empty($data['contract_update_date']) ? '' : $data['contract_update_date'];?>">
			</div>
			<div class="form-group">
				<label>Mary Kay Website:</label>
				<input type="text" class="form-control" name="mary_kay_website" value="<?php echo empty($data['mary_kay_website']) ? '' : $data['mary_kay_website'];?>">
			</div>
			<div class="form-group">
				<label> FB Link if applicable:</label>
				<input type="text" class="form-control" name="fb_link" value="<?php echo empty($data['fb_link']) ? '' : $data['fb_link'];?>">
			</div>
			
			<div class="form-group">
				<label>Who referred you?</label>
				<input type="text" class="form-control" name="reffered_by"  value="<?php echo empty($data['reffered_by']) ? '' : $data['reffered_by'];?>" />
			</div>
			<div class="form-group">
				<label>Questions/Comment</label>
				<textarea class="form-control" name="question_comment"><?php echo empty($data['question_comment']) ? '' : $data['question_comment'];?></textarea>
			</div>
			<div class="form-group">
				<label> If you want to send mail check the checkbox : </label>
				<input type="checkbox" name="send_mail"  value="1" <?php echo isset($send_mail) ? $send_mail : ''; ?> >
			</div>
			<div class="form-group">
				<label>No Charge:</label>
				<input type="checkbox" name="cc_chargefree" class="radio-inline" value="1" <?php echo isset($no_charge) ? $no_charge : ''; ?> >
			</div>
			<div class="form-group">
				<label>Setup Done:</label>
				<input type="checkbox" name="status_done" class="radio-inline" value="1" <?php echo isset($status_done) ? $status_done : ''; ?> >
			</div>

			<div class="form-group">
				<label>Include UACC:</label>
				<input type="checkbox" name="inc_tbc" value="1" <?php echo isset($inc_tbc) ? $inc_tbc : '';?> >
			</div>
			<div class="form-group">
				<label>Account Credit:</label>
				<input type="text" name="special_credit" class="form-control" value="<?php echo empty($data['special_credit']) ? '' : $data['special_credit'];?>">
			</div>
			<div class="form-group">
				<label>Digital BIZ Card:</label>
				<input type="checkbox" name="digital_biz_card" value="1" class="digital_biz_card" <?php echo isset($biz_card) ? $biz_card : '';?> >
				<input type="text" name="digital_biz_link" class="form-control" value="<?php echo empty($data['digital_biz_link']) ? '' : $data['digital_biz_link'];?>">
			</div>

			<div class="form-group">
				<label>Catalog Link:</label>
				<input type="text" name="catalog_link" class="form-control" value="<?php echo empty($data['catalog_link']) ? '' : $data['catalog_link'];?>">
			</div>
			<div class="form-group">
				<label>Shop Link:</label>
				<input type="text" name="shop_link" class="form-control" value="<?php echo empty($data['shop_link']) ? '' : $data['shop_link'];?>">
			</div>
			<div class="form-group">
				<label>Boss Babe Link:</label>
				<input type="text" name="boss_babe_link" class="form-control" value="<?php echo empty($data['boss_babe_link']) ? '' : $data['boss_babe_link'];?>">
			</div>
			<div class="form-group text-right">
				<input type="submit" class="btn btn-primary btn-lg login-button" value="Save">
			</div>
			<input type="hidden" name="hidden_newsletter">
		</form>		
	</div>

	<?php 
		if ($url == 'edit-uacc') { ?>
			<div class="col-sm-4">
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-success btn-md past-email" data-toggle="modal" data-target="#uacc_past_email">Past emails to client</button>
					</div>	
				</div>

				<?php include 'UACC-add-note.php'; ?>
				<?php include 'UACC-invoices.php'; ?>
				<?php include 'UACC-past-emails.php'; ?>
			</div>	
		<?php }
	?>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cc_month_mailing').Monthpicker();
	});
	
</script>
<?php  
	if (empty($id_newsletter)) {
		$getField = array_flip(getTableFields('general'));
		$data = array_fill_keys(array_keys($getField), '');
	}
?>

<div id="Details" class="tabcontent">
	<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
	<input type="hidden" name="updated_by" value="<?php echo $this->session->userdata('username'); ?>">

	<?php 

		if ( !empty($future_date)) { ?>
			<div class="notice notice-danger">
				<b>This client has future date copy in the future date list</b>
			</div>
	<?php }


		if ( isset($cc_exists) && $cc_exists > 0) { ?>
			<div class="notice notice-danger">
				<b>This client has taken Customer Communication Service.</b>
			</div>
	<?php } ?>

	<div class="login_aleart">
		<?php if(isset($data['app_login']) && $data['app_login'] == '0') { ?>
			<div class="notice notice-danger">
			  	Client is not logged in yet.
			</div>
		<?php }else {
			
			if(!empty($is_user_login)) { ?>
				<div class="notice notice-success">
				  	<?php echo $is_user_login['purpose']; ?>
				</div>
			<?php }
		} ?>
	</div>

	<?php if(isset($data['app_last_login']) && $data['app_last_login'] != ''){ ?>
		<div class="notice notice-success">
	  		<?php echo 'Last login at: '.$data['app_last_login']; ?>
		</div>
	<?php } ?>

	<div class="form-group">
		<label class="col-lg-3 control-label">Director Title:</label>
		<div class="col-lg-9">
			<select name="director_title" class="form-control">
				<option value="">---Select Director Title--</option>

				<option value="Mary Kay Independent Beauty Consultant" <?php echo ($data['director_title'] == 'Mary Kay Independent Beauty Consultant') ? 'selected="selected"' : ''; ?>>Mary Kay Independent Beauty Consultant</option>

				<option value="Independent Sales Director" <?php echo ($data['director_title'] == 'Independent Sales Director') ? 'selected= "selected"' : ''; ?>>Independent Sales Director</option>
				<option value="Independent Senior Sales Director" <?php echo ($data['director_title'] == 'Independent Senior Sales Director') ? 'selected= "selected"' : ''; ?>>Independent Senior Sales Director</option>
				<option value="Future Executive Senior Sales Director" <?php echo ($data['director_title'] == 'Future Executive Senior Sales Director') ? 'selected= "selected"' : ''; ?>>Future Executive Senior Sales Director</option>
				<option value="Executive Senior Sales Director" <?php echo ($data['director_title'] == 'Executive Senior Sales Director') ? 'selected= "selected"' : ''; ?>>Executive Senior Sales Director</option>
				<option value="Elite Executive Senior Sales Director" <?php echo ($data['director_title'] == 'Elite Executive Senior Sales Director') ? 'selected= "selected"' : ''; ?>>Elite Executive Senior Sales Director</option>
				<option value="Independent National Sales Director" <?php echo ($data['director_title'] == 'Independent National Sales Director') ? 'selected= "selected"' : ''; ?>>Independent National Sales Director</option>
				<option value="Independent Senior National Sales Director" <?php echo ($data['director_title'] == 'Independent Senior National Sales Director') ? 'selected= "selected"' : ''; ?>>Independent Senior National Sales Director</option>
				<option value="Independent Executive National Sales Director" <?php echo ($data['director_title'] == 'Independent Executive National Sales Director') ? 'selected= "selected"' : ''; ?>>Independent Executive National Sales Director</option>
				<option value="Independent Elite Executive National Sales Director" <?php echo ($data['director_title'] == 'Independent Elite Executive National Sales Director') ? 'selected="selected"' : ''; ?>>Independent Elite Executive National Sales Director</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Name:</label>
		<div class="col-lg-9">
			<input class="form-control" value ="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" type="text" name="name" id="client_name">
		</div>
		<span class="help-block"></span>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Welcome box sent:</label>
		<div class="col-lg-9">
			<input class="form-control" value ="<?php echo isset($data['box_sent']) ? $data['box_sent'] : ''; ?>" type="text" name="box_sent" id="box_sent">
		</div>
		<span class="help-block"></span>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Do Not Contact Consultants:</label>
		<div class="col-lg-9">
			<input class="form-control" value ="<?php echo isset($data['contact']) ? $data['contact'] : '' ?>" type="text" name="contact">
		</div>
		<span class="help-block"></span>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">No Recognition:</label>
		<div class="col-lg-9">
			<input class="form-control" value ="<?php echo isset($data['no_recognition']) ? $data['no_recognition'] : '' ?>" type="text" name="no_recognition">
		</div>
		<span class="help-block"></span>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Client Notes:</label>
		<div class="col-lg-9">
			<textarea class="form-control" name="client_note"><?php echo isset($data['client_note']) ? $data['client_note'] : '' ?></textarea>
		</div>
		<span class="help-block"></span>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Unit Number:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['unit_number']) ? $data['unit_number'] : '' ?>" type="text" name="unit_number">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Consultant Number:</label>
		<div class="col-lg-9 consultant">
			<input class="form-control consultant-input" value="<?php echo isset($data['consultant_number']) ? $data['consultant_number'] : ''; ?>" type="text" name="consultant_number" onblur="uniqueId(this.value);">
			<div id="resultImageProfile"></div>
			<input type="hidden" value="<?php echo isset($id_newsletter) ? $id_newsletter : '';?>" id="hidden_id">
			<span class="error" id="error-consul"></span>
			<span id="note-consul"></span>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">How long have you been a MK director?</label>
		<div class="col-lg-9 consultant">
			<input class="form-control consultant-input" value="<?php echo isset($data['mk_director']) ? $data['mk_director'] : ''; ?>" type="text" name="mk_director">
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">Intouch Password:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['intouch_password']) ? $data['intouch_password'] : ''; ?>" type="text" name="intouch_password">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Cell Phone number:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['cell_number']) ? $data['cell_number'] : ''; ?>" type="text" name="cell_number">
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">Closing for E cards</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['closing_ecards']) ? $data['closing_ecards'] : ''; ?>" type="text" name="closing_ecards">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Email address:</label>
		<div class="col-lg-9">
			<input  name="email" class="form-control consultant-input" value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" type="email" onblur="uniqueEmail(this.value);">
			<div id="resultImageProfile1"></div>
			<span class="error" id="error-email"></span>
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label dob">Your Birthday:</label>
		<div class="col-lg-9 b-date">
			<input type="text" name="dob" placeholder="click to show datepicker"  id="example1" value="<?php echo isset($data['dob']) ? $data['dob'] : ''; ?>" class="form-control dob">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Unit Web Site:</label>
		<div class="col-lg-9">
			<input type="text" name="unit_web_site" class="form-control" value="<?php echo isset($data['unit_web_site']) ? $data['unit_web_site'] : ''; ?>" >
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Unit Name:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['unit_name']) ? $data['unit_name'] : '' ?>" type="text" name="unit_name">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Unit Colors/Favorite:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['unit_color']) ? $data['unit_color'] : ''; ?>" type="text" name="unit_color">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Unit Goal:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['unit_goal']) ? $data['unit_goal'] : ''; ?>" type="text" name="unit_goal">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">National Area/Go give:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['national_area']) ? $data['national_area'] : ''; ?>" type="text" name="national_area">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Seminar Affiliation:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['seminar_affiliation']) ? $data['seminar_affiliation'] : ''; ?>" type="text" name="seminar_affiliation">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Primary Personality Style:</label>
		<div class="col-sm-9">
			<label class="radio-inline">
				<input type="radio" name="primary_personality" value="D" <?php echo (isset($data['primary_personality']) && ($data['primary_personality']=='D')) ? 'checked = "checked"' : '' ?>> D
			</label>
			<label class="radio-inline">
				<input name="primary_personality" value="I" type="radio"<?php echo (isset($data['primary_personality']) && ($data['primary_personality']=='I')) ? 'checked = "checked"' : '' ?>> I
			</label>
			<label class="radio-inline">
				<input name="primary_personality" value="S"  type="radio" <?php echo (isset($data['primary_personality']) && ($data['primary_personality']=='S')) ? 'checked = "checked"' : '' ?>> S
			</label>
			 <label class="radio-inline">
				<input name="primary_personality" value="C" type="radio" <?php echo (isset($data['primary_personality']) && $data['primary_personality']=='C') ? 'checked = "checked"' : '' ?>> C
			</label>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-3 control-label">Referred by:</label>
		<div class="col-lg-9">
			<input class="form-control" value="<?php echo isset($data['reffered_by']) ? $data['reffered_by'] : ''; ?>" type="text" name="reffered_by">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-3 control-label highlit">First time bill date:</label>
		<div class="col-lg-9 fbilld">
			<input class="form-control ftimebill" value="<?php echo isset($data['first_bill_date']) ?  $data['first_bill_date'] : ''; ?>" type="text" name="first_bill_date" placeholder="click to show datepicker"  id="example2">
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">Upload Image:</label>
		<div class="col-lg-9">
			<input class="form-control" type="file" name="image" id="user_profile_pic">
			<input type="hidden" name="user_image" value="<?php echo isset($data['image']) ? $data['image'] : ''; ?>">
			<span class="upload_error" style="color: red;"></span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-3"> <label class="lebal-third"> Language : </label> </div>
		<div class="col-md-2">
			<input type="radio" name="newsletters_design" value="E" <?php echo ( isset($data['newsletters_design']) && (($data['newsletters_design']=='E') || ($data['newsletters_design']=='')) ) ? 'checked = "checked"' : '' ?>> English
		</div>
		<div class="col-md-3">
			<input type="radio" name="newsletters_design" value="CE" <?php echo (isset($data['newsletters_design']) && $data['newsletters_design']=='CE') ? 'checked = "checked"' : '' ?>> Canada English
		</div>
		<div class="col-md-2">
			<input type="radio" name="newsletters_design" value="S" <?php echo (isset($data['newsletters_design']) && $data['newsletters_design'] == 'S') ? 'checked = "checked"' : '' ?>> Spanish
		</div>

		<div class="col-md-2">
			<input type="radio" name="newsletters_design" value="F" <?php echo (isset($data['newsletters_design']) && $data['newsletters_design'] == 'F')  ? 'checked = "checked"' : '' ?>> French
		</div>

		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<div class="col-lg-3"><label class="lebal-third">Select Email :</label></div>
		<div class="col-md-3">
			<input type="radio" name="select_email" value="W" <?php echo (isset($data['select_email']) && ( ($data['select_email']=='W') || ($data['select_email']=='')) ) ? 'checked = "checked"' : '' ?>> Welcome
		</div>
		<div class="col-md-3">
			<input type="radio" name="select_email" value="C" <?php echo (isset($data['select_email']) && $data['select_email'] == 'C') ? 'checked = "checked"' : '' ?> > Current
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">Unsubscribe Date:</label>
		<div class="col-lg-9 focus-g">
		<?php 
			if (isset($data['consultant_number']) || !empty($data['consultant_number'])) {
				if ( isset($cc_exists) && $cc_exists > 0) { ?>
					<input class="form-control" id="example4" value="<?php echo isset($data['contract_update_date']) ? $data['contract_update_date'] : ''; ?>" type="text" name="contract_update_date"  onblur="checkCC(<?php echo isset($id_newsletter) ? $id_newsletter : ''; ?>);">
					<?php 
				}else { ?>
					<input class="form-control example4-cal" id="" value="<?php echo isset($data['contract_update_date']) ? $data['contract_update_date'] : ''; ?>" type="text" name="contract_update_date"  onblur="checkCC(<?php echo isset($id_newsletter) ? $id_newsletter : ''; ?>);">
				<?php }
			}else { ?>
				<input class="form-control example4-cal" id="" value="<?php echo isset($data['contract_update_date']) ? $data['contract_update_date'] : ''; ?>" type="text" name="contract_update_date"  onblur="checkCC(<?php echo isset($id_newsletter) ? $id_newsletter : ''; ?>);">
			<?php } ?>
		</div>
	</div>
</div>
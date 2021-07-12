<?php 
	if (empty($id_newsletter)) {
		$getField = array_flip(getTableFields('emails'));
		$data = array_fill_keys(array_keys($getField), '');
	}
?>

<div id="WelcomeEmail" class="tabcontent">
	<h3 class="text-center">Welcome Email</h3>
	<div class="col-md-12 news-design">
		<h3>English</h3>
		
		<textarea class="ckeditor" rows="5" cols="40" id="welcome_email_english" name="welcome_email_english" onclick="abc()" ><?php echo(!empty($data['welcome_email_english']) ? $data['welcome_email_english'] : Get_email_content('welcome_english')); ?></textarea>
		<input type="hidden" name="hidden_welcome_english" id="hidden_welcome_english">
	</div>
	<div class="col-md-12 news-design">
		<h3>Canada English</h3>
		
		<textarea class="ckeditor" rows="5" cols="40" name="welcome_email_canada_english"><?php echo(!empty($data['welcome_email_canada_english']) ? $data['welcome_email_canada_english'] : Get_email_content('welcome_canada_english')); ?></textarea>
		<input type="hidden" name="hidden_welcome_canada" id="hidden_welcome_canada">
	</div>
	<div class="col-md-12 news-design">
		<h3>Spanish</h3>
		
		<textarea class="ckeditor" rows="5" cols="40" id="welcome_email_spanish" name="welcome_email_spanish"><?php echo Get_email_content('welcome_spanish') ? Get_email_content('welcome_spanish') : ''; ?></textarea>
		<input type="hidden" name="hidden_welcome_spanish" id="hidden_welcome_spanish">
	</div>

	<div class="col-md-12 news-design">
		<h3>French</h3>
		
		<textarea class="ckeditor" rows="5" cols="40" id="welcome_email_french" name="welcome_email_french"><?php echo(!empty($data['welcome_email_french']) ? $data['welcome_email_french'] : Get_email_content('welcome_french')); ?></textarea>
		<input type="hidden" name="hidden_welcome_french" id="hidden_welcome_french">
	</div>
</div>

<div id="CurrentClientEmail" class="tabcontent">
	<h3 class="text-center">Current Client Email</h3>
	<div class="col-md-12 news-design">
		<h3>English</h3>
		
			<textarea class="ckeditor" rows="5" cols="40" id="current_email_english" name="current_email_english"><?php echo (!empty($data['current_email_english']) ? $data['current_email_english'] : Get_email_content('current_english')); ?></textarea>
			<input type="hidden" name="hidden_current_english" id="hidden_current_english">
	</div>
	<div class="col-md-12 news-design">
		<h3>Canada English</h3>
		
			<textarea class="ckeditor" rows="5" cols="40" id="current_email_canada_english" name="current_email_canada_english"><?php echo (!empty($data['current_email_canada_english']) ? $data['current_email_canada_english'] : Get_email_content('current_canada_english')); ?></textarea>
			<input type="hidden" name="hidden_current_canada" id="hidden_current_canada">
	</div>
	<div class="col-md-12 news-design">
		<h3>Spanish</h3>
		
			<textarea class="ckeditor" rows="5" cols="40" id="current_email_spanish" name="current_email_spanish"><?php echo (!empty($data['current_email_spanish']) ? $data['current_email_spanish'] : Get_email_content('current_spanish')); ?></textarea>
			<input type="hidden" name="hidden_current_spanish" id="hidden_current_spanish">
	</div>
	<div class="col-md-12 news-design">
		<h3>French</h3>
		
			<textarea class="ckeditor" rows="5" cols="40" id="current_email_french" name="current_email_french"><?php echo (!empty($data['current_email_french']) ? $data['current_email_french'] : Get_email_content('current_french')); ?></textarea>
			<input type="hidden" name="hidden_current_french" id="hidden_current_french">
	</div>
</div>

<section class="clearfix UaAdd">
	<div class="container-fluid">
		<div class="sectionUA section_details">
			<div class="profile_pic text-center">
				<img src="<?php echo base_url('assets/images/profile_img/female.jpg'); ?>" />	
				<h3 class="client_name"></h3>						
			</div>

			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<form id="add-director" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="point_value" id="point" value="0"></button>
						<?php include 'director-general-info.php'; ?>
						<?php include 'director-design-info.php'; ?>
						<?php include 'director-emails.php'; ?>
						<?php include 'director-packaging.php'; ?>
					</form>
				</div>
				<div class="col-sm-3">
					<div class="tab">
						<button id="defaultOpen" class="tablinks" onclick="openCity(event, 'Details')" >Details</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'ReturnLabelDetails')">Return Label Details</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'NewsletterDesigns')">Newsletter Designs</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'DigitalOption')">Digital Option</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'WelcomeEmail')">Welcome Email</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'CurrentClientEmail')">Current Client Email</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'Birthday')">Birthday</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'Anniversary')">Anniversary</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'StatusPostCards')">Status Post Cards</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'GiftServices')">Gift Services</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'NewConsultantOptions')">New Consultant Options</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'NewsletterPrintingoptions')">Newsletter Printing options</button>
						
						<button class="tablinks" type="button" id="point_total">POINT TOTAL
						<input type="text" name="visible_point" id="output" disabled="">
						
						<button class="tablinks" type="button" onclick="openCity(event, 'PackagingBTN')">Packaging</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'TextingSystem')">Texting System</button>
						<button type="submit" class="btn btn-success save_director">Save</button>
					</div>
				</div>

			</div>
			
		</div>
	</div>
</section>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/monthpicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/director.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.save_director').click(function(){
			$('#add-director').submit();
		});
	});
</script>
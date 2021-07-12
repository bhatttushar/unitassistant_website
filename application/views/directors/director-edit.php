<?php  $id_newsletter = $this->uri->segment(2);  
	
	/*if (empty($notedata)) { ?>
		<input type="hidden" name="notedata" id="notedata" value="0">
	<?php }else{ ?>
		<input type="hidden" name="notedata" id="notedata" value="1">
	<?php }*/
?>
<section class="clearfix UaAdd">
	<div class="container-fluid">
		<div class="sectionUA section_details">
			<div class="row">
				<div class="col-sm-8">
					<div class="profile_pic text-center">
						<?php
							$img = strtolower($data['consultant_number']).'.jpg';
							$image = base_url('assets/images/profile_img/'.$img);
							if (@getimagesize($image)) {
								$image = $image;
							}elseif (empty($data['image'])) {
								$image = '/assets/images/profile_img/female.jpg';
							}else{
								$image = '/assets/images/profile_img/'.$data['image'];
							}
						?>

						<img src="<?php echo $image; ?>" />	
						<h3 id="name_val"><?php echo isset($data['name']) ? $data['name'] : ''; ?></h3>		
					</div>
				</div>
				<div class="col-sm-4"></div>
			</div>

			<div class="row">	
				<div class="col-sm-1"></div>			
				<div class="col-sm-5">
					<form id="edit-director" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" name="is_view_details_save" id="is_view_details_save" value="0">
						<input type="hidden" name="is_send_mail" id="is_send_mail" value="0">
						<input type="hidden" name="id_newsletter" value="<?php echo $id_newsletter; ?>">
						<input type="hidden" name="point_value" id="point" value="<?php echo empty($data['point_value']) ? '' : $data['point_value']; ?>">
						<?php include 'director-general-info.php'; ?>
						<?php include 'director-design-info.php'; ?>
						<?php include 'director-emails.php'; ?>
						<?php include 'director-packaging.php'; ?>
						<?php include 'director-view-details.php'; ?>
						<?php include 'director-past-emails.php'; ?>
					</form>
				</div>
					
				<div class="col-sm-2">
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
						
						<button class="tablinks" type="button" id="point_total">Point Total
						<input type="text" name="visible_point" id="output" disabled="" value="<?php echo empty($data['point_value']) ? '' : $data['point_value']; ?>">
						
						<button class="tablinks" type="button" onclick="openCity(event, 'PackagingBTN')">Packaging</button>
						<button class="tablinks" type="button" onclick="openCity(event, 'TextingSystem')">Texting System</button>
						<button type="submit" class="btn btn-success save_director">Save</button>
						<button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal" id="view_details">View Detail</button>
					</div>
				</div>

				<div class="col-sm-3">
					<div class="row">
						<div class="col-sm-12 text-right">
							<button type="button" class="btn btn-success btn-md past-email" data-toggle="modal" data-target="#pastemail">Past emails to client</button>
						</div>	
					</div>

					<?php include 'addNote.php'; ?>
					<?php include 'invoices.php'; ?>
				</div>
				<div class="col-sm-1"></div>			
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
</section>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myNoteModal" style="display:none" >Open Modal</button>


<div id="myNoteModal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title" id="myModalLabel">Please add note!!</h3>
            </div>
            <div class="modal-body">
                <h4>You must have to add your note before save. Thank you!!</h4>
            </div>    
        </div>
    </div>
</div>

</div>

<script type="text/javascript" src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/director.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript">

	$(document).ready(function(){

		window.history.pushState({page: 1}, "", "");
		window.onpopstate = function(event) {
		var isBackCookie = readCookie("flag");

		  	if(isBackCookie == 0){
			    $('#myNoteModal').modal('show');
			    document.location.href = '#';
			}
		}

		var isCookie = readCookie("flag");
		if (isCookie == 0) {
			$('#myNoteModal').modal('show');	
		}else{
			createCookie("flag", 0, 0);
		}

		var nIdNewsletter = "<?php echo $id_newsletter; ?>";
		if(nIdNewsletter){
			var isCookie = readCookie("flag");
			if(!isCookie){
				createCookie("flag", 0, 0);
			}
		}

		/*if ($('#notedata').val() == '0' ) {
			$('.note_modal_btn').trigger('click');
		}*/

		$('.save_director').click(function(){
			$('#edit-director').submit();
		});

		$('.view_details_save').click(function(){
			$('#is_view_details_save').val('1');
			$('#edit-director').submit();
		});

		$('.view_details_send').click(function(){
			$('#is_send_mail').val('1');
			$('#edit-director').submit();
		});
	});


</script>
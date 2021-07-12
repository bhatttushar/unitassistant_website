<?php  $id_newsletter = $this->uri->segment(2);  
	
	if (empty($notedata)) { ?>
		<input type="hidden" name="notedata" id="notedata" value="0">
	<?php }else{ ?>
		<input type="hidden" name="notedata" id="notedata" value="1">
	<?php }

?>
<div class="container">

	<div class="profile_pic text-center">
		<img src="<?php echo base_url('assets/images/profile_img/female.jpg'); ?>" />	
		<h3 class="client_name"><?php echo $data['name']; ?></h3>						
	</div>

	<div class="row">	
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12 text-right">
					<button type="button" class="btn btn-success btn-md past-email" data-toggle="modal" data-target="#pastemail">Past emails to client</button>
				</div>	
			</div>
			<?php include 'director-past-emails.php'; ?>
			<?php include 'addNote.php'; ?>
		</div>		
	</div>
</div>

<button type="button" class="btn btn-info btn-lg note_modal_btn" data-toggle="modal" data-target="#thankyouModal">Open Modal</button>

<div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog" aria-labelledby="thankyouLabel" aria-hidden="true">
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

<script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/monthpicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/director.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript">

	$(document).ready(function(){
		var isCookie = readCookie("flag");

		if (isCookie == 0) {
			$('#thankyouModal').modal('show');	
		}
		

		var nIdNewsletter = "<?php echo $id_newsletter; ?>";
		if(nIdNewsletter){
			var isCookie = readCookie("flag");
			if(!isCookie){
				createCookie("flag", 0, 0);
			}
		}

		if ($('#notedata').val() == '0' ) {
			$('.note_modal_btn').trigger('click');
		}
	});


</script>
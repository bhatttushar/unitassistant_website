<?php  $id_cc_newsletter = $this->uri->segment(2);  
	
	/*if (empty($notedata)) { ?>
		<input type="hidden" name="notedata" id="notedata" value="0">
	<?php }else{ ?>
		<input type="hidden" name="notedata" id="notedata" value="1">
	<?php }*/

?>

<section class="clearfix UaAdd">
	<div class="container-fluid">
		<div class="sectionUA section_details">
			<div class="container">
				<?php include 'customer-communication.php'; ?>						
			</div>
		</div>
	</div>
</section>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#uaccNoteModal" style="display: none;" >Open Modal</button>

<div id="uaccNoteModal" class="modal fade" role="dialog">
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

<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function(){

		window.history.pushState({page: 1}, "", "");
		window.onpopstate = function(event) {
		var isBackCookie = readUACCCookie("uacc-flag");

		  	if(isBackCookie == 0){
			    $('#uaccNoteModal').modal('show');
			    document.location.href = '#';
			}
		}

		var isCookie = readUACCCookie("uacc-flag");
		if (isCookie == 0) {
			$('#uaccNoteModal').modal('show');	
		}else{
			createUACCCookie("uacc-flag", 0, 0);
		}
		
		var id_cc_newsletter = "<?php echo $id_cc_newsletter; ?>";
		if(id_cc_newsletter){
			var isCookie = readUACCCookie("uacc-flag");
			if(!isCookie){
				createUACCCookie("uacc-flag", 0, 0);
			}
		}

		/*if ($('#notedata').val() == '0' ) {
			$('.note_modal_btn').trigger('click');
		}*/
	
		if($('select#pmt_type option:selected').val() == 'CC') {
        	$('.account_detail_cc').show();
        	$('.routing_cc').hide();
    	}else if ($('select#pmt_type option:selected').val() == 'ACH') {
    		$('.account_detail_cc').hide();
    		$('.routing_cc').show();
		}else{
			$('.account_detail_cc').hide();
    		$('.routing_cc').hide();
    	}

		$("select#pmt_type").change(function(){
        	if($('select#pmt_type option:selected').val() == 'CC') {
	        	$('.account_detail_cc').show();
	        	$('.routing_cc').hide();
	    	}else if ($('select#pmt_type option:selected').val() == 'ACH'){
	    		$('.routing_cc').show();
	    		$('.account_detail_cc').hide();
	    	}else {
	    		$('.routing_cc').hide();
	    		$('.account_detail_cc').hide();
	    	}
    	});

    	$(".js-example-basic-multiple").select2({
		  placeholder: "Click to select a user"
		});

		$(".js-example-basic-multiple").on("select2:select", function (e) { 
		    var select_val = $(e.currentTarget).val();
		    $(".hidden-user").val(select_val);
		});

		
	});
</script>
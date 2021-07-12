<style type="text/css">
	.form-control{
		display: inline-block;
    	width: 79%;
	}

	input[type=file]{
		display: inline-block !important;
	}

	label{
		width: 19%;
	}

	span#note-consul{
	   color: red;
	}

</style>

<section class="clearfix UaAdd">
	<div class="container-fluid">
		<div class="sectionUA section_details">
			<div class="container">
				<?php include 'customer-communication.php'; ?>						
			</div>
		</div>
	</div>
</section>

<script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/monthpicker.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
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
	});
</script>
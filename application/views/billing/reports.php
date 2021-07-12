<style type="text/css">
	.hborder{
		border-left: 2px solid #2f4254;
	}

	.rborder{
		border-right: 2px solid #2f4254;	
	}
</style>

<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-file"></i> Generate Reports </h1>
    </section>

    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
        		<?php 
	        	if($this->session->flashdata('error')){ ?>
		            <div class="alert alert-danger alert-dismissable">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                <?php echo $this->session->flashdata('error'); ?>                    
		            </div>
	        	<?php } ?>

        		<h3 class="text-center">Invoice Report</h3>
        		<hr style="border-color: #000;">
        		<div class="col-sm-6">
        			<h3 class="text-center">Monthly Report for all clients</h3>
        			<form action="<?php echo base_url('billing/all-invoice-report/month'); ?>" name="monthvice" method="post">
					  <div class="form-group col-sm-6 month">
					    <label for="email">Set Month From</label>
					    <select class="form-control" name="month_from">
	                        <option value="01">January</option>
					        <option value="02">February</option>
					        <option value="03">March</option>
					        <option value="04">April</option>
					        <option value="05">May</option>
					        <option value="06">June</option>
					        <option value="07">July</option>
					        <option value="08">August</option>
					        <option value="09">September</option>
					        <option value="10">October</option>
					        <option value="11">November</option>
					        <option value="12">December</option>
						</select>
					  </div>
					  <div class="form-group col-sm-6">
					    <label for="email">Set Month To</label>
					    <select class="form-control" name="month_to">
	                        <option value="01">January</option>
					        <option value="02">February</option>
					        <option value="03">March</option>
					        <option value="04">April</option>
					        <option value="05">May</option>
					        <option value="06">June</option>
					        <option value="07">July</option>
					        <option value="08">August</option>
					        <option value="09">September</option>
					        <option value="10">October</option>
					        <option value="11">November</option>
					        <option value="12">December</option>
						</select>
					  </div>
					  <div class="col-sm-12">

						  <input type="hidden" name="type" value="invoice_monthvice" />
						  <button type="submit" name="invoice_monthvice" class="btn btn-success">Generate</button>
						</div>
					</form>	
        		</div>
        		<div class="col-sm-6 hborder">
        			<h3 class="text-center">Yearly Report for all clients</h3>	
        			<form name="yearvice" method="post" action="<?php echo base_url('billing/all-invoice-report/allYear'); ?>">
					  <div class="form-group col-sm-6">
					    <label for="email">Select Year</label>
					    <select class="form-control" name="selectedYear">
					    	<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
					    	<?php for ($i = 1; $i <= 4; $i++) {
								echo '<option value="' . date('Y', strtotime('-' . $i . ' year')) . '" >' . date('Y', strtotime('-' . $i . ' year')) . '</option>';
								} ?>
					    </select>
					  </div>
					  <div class="col-sm-12">
						  <input type="hidden" name="type" value="invoice_yearvice" />
						  <button type="submit" name="invoice_yearvice" class="btn btn-success">Generate</button>
					</div>
					</form>
        		</div>

        		<div class="clearfix"></div>
        		<br><br>
        		<h3 class="text-center">Bank Report</h3>
        		<hr style="border-color: #000;">
        		<div class="col-sm-6">
        			<h3 class="text-center">Monthly Report for all clients </h3>
        			<form action="<?php echo base_url('billing/bank-report/month'); ?>" name="monthvice" method="post">
						 <div class="form-group col-sm-4 month">
						    <label for="email">Set Month From</label>
						    <select class="form-control" name="month_from">
		                        <option value="01">January</option>
						        <option value="02">February</option>
						        <option value="03">March</option>
						        <option value="04">April</option>
						        <option value="05">May</option>
						        <option value="06">June</option>
						        <option value="07">July</option>
						        <option value="08">August</option>
						        <option value="09">September</option>
						        <option value="10">October</option>
						        <option value="11">November</option>
						        <option value="12">December</option>
							</select>
						 </div>
						 <div class="form-group col-sm-4">
						    <label>Set Month To</label>
						    <select class="form-control" name="month_to">
		                        <option value="01">January</option>
						        <option value="02">February</option>
						        <option value="03">March</option>
						        <option value="04">April</option>
						        <option value="05">May</option>
						        <option value="06">June</option>
						        <option value="07">July</option>
						        <option value="08">August</option>
						        <option value="09">September</option>
						        <option value="10">October</option>
						        <option value="11">November</option>
						        <option value="12">December</option>
							</select>
						 </div>
						 <div class="form-group col-sm-4">
						 	<label>Select Year</label>
						 	<select name="year_month" class="form-control">
						 		<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
					    		<?php for ($i = 1; $i <= 4; $i++) {
									echo '<option value="' . date('Y', strtotime('-' . $i . ' year')) . '" >' . date('Y', strtotime('-' . $i . ' year')) . '</option>';
								} ?>
						 	</select>
						 </div>
						 <div class="form-group col-sm-12">
						    <input type="hidden" name="type" value="bank_monthvice" />
						    <button type="submit" name="bank_monthvice" class="btn btn-success">Generate</button>
						</div>
					</form>
        		</div>
        		<div class="col-sm-6 hborder">
        			<h3 class="text-center">Yearly Report for all clients </h3>
        			<form action="<?php echo base_url('billing/bank-report/allYear'); ?>" name="yearvice" method="post">
						  <div class="form-group col-sm-6">
						    <label for="email">Select Year</label>
						    <select class="form-control" name="selectedYear">
						    	<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
					    		<?php for ($i = 1; $i <= 4; $i++) {
									echo '<option value="' . date('Y', strtotime('-' . $i . ' year')) . '" >' . date('Y', strtotime('-' . $i . ' year')) . '</option>';
								} ?>
							    
						    </select>
						  </div>
						  	<div class="col-sm-12">
						  		<input type="hidden" name="type" value="bank_yearvice" />
						  		<button type="submit" name="bank_yearvice" class="btn btn-success">Generate</button>
							</div>
					</form>
        		</div>
        		
        		<div class="clearfix"></div>
        		<br><br>
        		<h3 class="text-center">Detailed Item Report</h3>
        		<hr style="border-color: #000;">
        		<div class="col-sm-12">
        			<form method="post" action="<?php echo base_url('billing/item-report'); ?>" name="item_report">
			        	<div class="col-sm-8">
						  	<div class="form-group col-sm-6 month">
							    <label for="email">Set Month From</label>
							    <select class="form-control" name="month_from">
			                        <option value="01">January</option>
							        <option value="02">February</option>
							        <option value="03">March</option>
							        <option value="04">April</option>
							        <option value="05">May</option>
							        <option value="06">June</option>
							        <option value="07">July</option>
							        <option value="08">August</option>
							        <option value="09">September</option>
							        <option value="10">October</option>
							        <option value="11">November</option>
							        <option value="12">December</option>
								</select>
						  	</div>
							<div class="form-group col-sm-6">
							    <label>Set Month To</label>
							    <select class="form-control" name="month_to">
			                        <option value="01">January</option>
							        <option value="02">February</option>
							        <option value="03">March</option>
							        <option value="04">April</option>
							        <option value="05">May</option>
							        <option value="06">June</option>
							        <option value="07">July</option>
							        <option value="08">August</option>
							        <option value="09">September</option>
							        <option value="10">October</option>
							        <option value="11">November</option>
							        <option value="12">December</option>
								</select>
							</div>
			        	</div>
			        	<div class="form-group col-sm-4">
						  	<label>Select Year</label>
			            	<select class="form-control" name="selectedYear">
						    	<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
							    <?php for ($i = 1; $i <= 4; $i++) {
									echo '<option value="' . date('Y', strtotime('-' . $i . ' year')) . '" >' . date('Y', strtotime('-' . $i . ' year')) . '</option>';
								}?>
						    </select>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-12">
								<input type="hidden" name="type" value="detailitem_report" />
								<input type="submit" name="detailitem_report" class="btn btn-success" value="Generate">
							</div>
						</div>
					</form>
        		</div>
        		<br><br>
        		<h3 class="text-center">Billing Changes Report</h3>
        		<hr style="border-color: #000;">
        		<div class="col-sm-6">
        			<h3 class="text-center">Monthly Report for all clients </h3>
        			<form action="<?php echo base_url('billing/billing-changes-report'); ?>" name="monthvice" method="post">
						 <div class="form-group col-sm-4 month">
						    <label for="email">Set Month From</label>
						    <select class="form-control" name="month_from">
		                        <option value="01">January</option>
						        <option value="02">February</option>
						        <option value="03">March</option>
						        <option value="04">April</option>
						        <option value="05">May</option>
						        <option value="06">June</option>
						        <option value="07">July</option>
						        <option value="08">August</option>
						        <option value="09">September</option>
						        <option value="10">October</option>
						        <option value="11">November</option>
						        <option value="12">December</option>
							</select>
						 </div>
						 <div class="form-group col-sm-4">
						    <label>Set Month To</label>
						    <select class="form-control" name="month_to">
		                        <option value="01">January</option>
						        <option value="02">February</option>
						        <option value="03">March</option>
						        <option value="04">April</option>
						        <option value="05">May</option>
						        <option value="06">June</option>
						        <option value="07">July</option>
						        <option value="08">August</option>
						        <option value="09">September</option>
						        <option value="10">October</option>
						        <option value="11">November</option>
						        <option value="12">December</option>
							</select>
						 </div>
						 <div class="form-group col-sm-4">
						 	<label>Select Year</label>
						 	<select name="current_year" class="form-control">
						 		<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
					    		<?php for ($i = 1; $i <= 4; $i++) {
									echo '<option value="' . date('Y', strtotime('-' . $i . ' year')) . '" >' . date('Y', strtotime('-' . $i . ' year')) . '</option>';
								} ?>
						 	</select>
						 </div>
						 <div class="form-group col-sm-12">
						    <input type="hidden" name="type" value="billchange_monthvice" />
						    <button type="submit" name="billchange_monthvice" class="btn btn-success">Generate</button>
						</div>
					</form>
        		</div>
        		<div class="col-sm-6 hborder">
        			<h3 class="text-center">Yearly Report for all clients </h3>
        			<form name="yearvice" method="post" action="<?php echo base_url('billing/billing-changes-report'); ?>">
						  <div class="form-group col-sm-6">
						    <label for="email">Select Year</label>
						    <select class="form-control" name="selectedYear">
						    	<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
					    		<?php for ($i = 1; $i <= 4; $i++) {
									echo '<option value="' . date('Y', strtotime('-' . $i . ' year')) . '" >' . date('Y', strtotime('-' . $i . ' year')) . '</option>';
								} ?>
							    
						    </select>
						  </div>
						  <div class="col-sm-12">
						  		
						  		<input type="hidden" name="type" value="billchange_yearvice" />
							  	<button type="submit" name="billchange_yearvice" class="btn btn-success">Generate</button>
						</div>
					</form>
        		</div>

        	</div>
        </div>
    </section>
</div>
<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-file"></i> Invoice List </h1>
    </section>
    
    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
        		<div class="row">
		            <div class="col-lg-12">
		                <?php  
		                    if($this->session->flashdata('success')){ ?>
		                        <div class="alert alert-danger alert-dismissable">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                            <?php echo $this->session->flashdata('success'); ?>
		                        </div>
		                <?php } ?>
		                <div class="success-msg"> <span id="display_msg"></span> </div>
		            </div>
		        </div>

        		<div class="box">
        			<div class="box-header">
        				<div class="row">
        					<div class="col-sm-7">
        						<div class="row">
        							<div class="col-sm-12">
        								<a class="btn btn-info mr5 mb7" href="#" id="send_to_all">Send to all</a>
			        					<a class="btn btn-info mr5 mb7" id="create_all">Create all Invoice</a>
			        					<a class="btn btn-info mr5 mb7" href="<?php echo base_url('billing/create-invoice')?>">Create Invoice</a>
			        					<a class="btn btn-info mb7" href="<?php echo base_url('billing/all-invoice-report')?>">Create Invoice Report</a>		
        							</div>
        						</div>

        						<div class="row">
        							<div class="col-sm-12">
        								<a class="btn btn-info mr5" href="<?php echo base_url('billing/unsubscribed-report')?>">Unsubscribed Reports</a>
			        					<a class="btn btn-info mr5" id="reset_all">Reset Balance</a>
				        				<a class="btn btn-info mr5" href="javascript:void(0)" id="send_selected">Send email</a>
				        				<a class="btn btn-info" href="javascript:void(0)" id="delet_all">Delete All</a>	
        							</div>
        						</div>
		        			</div>	

		        			<div class="col-sm-5 text-right">        						
	                            <form action="<?php echo base_url('billing/upload-balance-excel'); ?>" method="POST" enctype="multipart/form-data" id="upload_balance_excel" class="inline-block mr5">
                                    <div class="btn-group lists-btn">
                                        <label class="btn-bs-file btn btn-md btn-info"> Upload Payment Excel
                                            <input type="file" id="excelPrice" name="excelPrice">
                                        </label>
                                    </div>
                                </form>

                                <form action="<?php echo base_url('billing/upload-unit-excel'); ?>" method="POST" enctype="multipart/form-data" id="upload_unit_excel" class="inline-block mr5">
                                    <div class="btn-group lists-btn">
                                         <label class="btn-bs-file btn btn-md btn-info"> Upload Unit Size Excel
                                            <input type="file" id="excelUnit" name="excelUnit">
                                        </label>
                                    </div>
                                </form>

                                <a class="btn btn-info pay-btn" href="<?php echo base_url('billing/upload-excel')?>">Upload Excel</a>	
	        				</div>	
        				</div>
        				
	        			
        			</div>
        			<div class="box-body">
			        	<div class="table-inner table-responsive">
			        		<table id="ua_billing_table" class="table table-bordered table-hover">
			        			<thead>
			        				<tr>
			        					<th>#</th>
			                            <th class="nosort sorting_disabled">Select<br> <input type="checkbox" name="checkall" id="checkall"></th>
			                            <th class="startDate">Start Date</th>
			                            <th>Name</th>
			                            <th>Phone Number</th>
			                            <th>Email</th>
			                            <th>Consultant Number</th>
			                            <th>Account Balance</th>
			                            <th class="nosort action">Action</th>
			        				</tr>
			        			</thead>
			        			<tbody>
			        				<?php
			        					$count =1;
										foreach ($data['user_data'] as $val) {
											$bal = GetBalance($val['id_newsletter']);
											$due = GetTotalDue($val['id_newsletter']);
											
											$class = in_array($val['id_newsletter'],  $aNewsletterIdEx) ? 'btn-success' : 'btn-info disabled';

											$button = "<a class='btn ".$class."' href='".base_url('billing/invoices-list/'.$val['id_newsletter'])."' title='View Invoices'>View Invoices</a>&nbsp;
													<a class='btn ".$class."' href='".base_url('billing/invoice-year-report/'.$val['id_newsletter'])."' title='Year Report'>Year Report</a>&nbsp;
													<a href='".base_url('billing/reset-balance/'.$val['id_newsletter'])."' class='btn btn-danger Sreset_bal'>Reset Balance</a>";

									        $b1 = '<input type="checkbox" name="create_all[]" value="'.$val['id_newsletter'].'">';
									?>
											<tr>	
												<td><?php echo $count; ?></td>
												<td><?php echo $b1; ?></td>
												<td><?php echo $val['first_bill_date']; ?></td>
												<td><?php echo $val['name']; ?></td>
												<td><?php echo $val['cell_number']; ?></td>
												<td><?php echo $val['email']; ?></td>
												<td><?php echo $val['consultant_number']; ?></td>
												<td><?php echo ($due - $bal); ?></td>
												<td><?php echo $button; ?></td>
											</tr>
									<?php
											$count++;
										}
			        				?>
			        			</tbody>
			        		</table>
			        	</div>
			        </div>
		        </div>
	        </div>
        </div>
    </section>
</div>
<div id="del_all" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Delete Records</h4>
      </div>
      <div class="modal-body">
        <p>Please select month(s) to delete records</p>
        <div class="all_months">
        	<div class="check_month">
				<label> <input type="checkbox" name="month[]" value="1"> January </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="2"> February </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="3"> March </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="4"> April </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="5"> May </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="6"> June </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="7"> July </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="8"> August </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="9"> September </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="10"> October </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="11"> November </label>
	        </div>
        	<div class="check_month">
	        	<label> <input type="checkbox" name="month[]" value="12"> December </label>
	        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-success" id="send_delete">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="overlay_ajax">
    <p>Loading Please Wait...</p>
</div>

<div class="hide" id="hidden-form"></div>
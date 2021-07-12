<?php 
	if (!empty($invoice_data)) {
		$id_get_invoice = $this->uri->segment(3); 
		$var = unserialize($invoice_data['data']);
        /*echo pre($var);*/
        extract($var);
	}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>Create Invoice</h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="<?php echo base_url('admin/uacc-billing'); ?>">Dashboard</a></li>
            <li class="active">Create Invoice</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
                <?php 
                if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

        		<div class="box">
        			<div class="box-body">
                        <div class="main-invoice">
                        <form method="post" id="UACC_invoice_form">
                            <input type="hidden" name='id_cc_newsletter' id="id_cc_newsletter" value="<?php echo empty($invoice_data) ? '' : $invoice_data['id_cc_newsletter'];  ?>" />

                            <input type="hidden" name='invoice_date' id="invoice_date" value="<?php echo empty($invoice_data) ? '' : $invoice_data['invoice_date'];  ?>" />

                            <input type="hidden" name='id_cc_invoice' id="id_cc_invoice" value="<?php echo empty($invoice_data) ? '' : $invoice_data['id_cc_invoice'];  ?>" />

                        <div class="row clearfix add_sub_tab">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> # </th>
                                            <th class="text-center"> Name </th>
                                            <th class="text-center"> Email </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td>
                                                <input type="text" name='name' id="search-box"  placeholder='Client Name' class="form-control" value="<?php echo @$invoice_data['name']; ?>" autocomplete="off" required=""/>
                                                <div id="suggesstion-box"></div>

                                            </td>
                                            <td><input type="text" name='email' id="email" placeholder='Email' class="form-control" value="<?php echo @$invoice_data['email']; ?>" required=""/></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>

                            <?php                       
	        					if(!empty($id_get_invoice)){ ?>
	                            <div class="col-sm-12">
	                                <table class="table table-bordered table-hover table_common" id="tab_logic_sub">
	                                    <thead>
	                                        <tr>
	                                            <th class="text-center"> # </th>
	                                            <th class="text-center th-name"> Name </th>
	                                            <th class="text-center th-unit"> Quantity </th>
	                                            <th class="text-center th-value"> Value($) </th>
	                                            <th class="text-center th-total"> Total($) </th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php 
	                                        $l_num = 1;

                                        	echo table_format($l_num, 'customer_comm_name', 'Customer Communication', 'customer_communication', '1', 'customer_comm_val', @$customer_comm_val, 'customer_comm_val_total', @$customer_comm_val_total);
                                            $l_num++;

	                                        if (@$prospect_system) {
												echo table_format($l_num, 'prospect_system_name', 'Prospect System', 'prospect_system', @$prospect_system, 'prospect_system_val', @$prospect_system_val, 'prospect_system_val_total', @$prospect_system_val_total);
												$l_num++;
											}

											if (@$cv_prospect) {
												echo table_format($l_num, 'cv_prospect_name', 'Carona Virus Special - discounted by 29.99', 'cv_prospect', @$cv_prospect, 'cv_prospect_val', @$cv_prospect_val, 'cv_prospect_val_total', @$cv_prospect_val_total);
												$l_num++;
											}

											if (@$misc_charge) {
												echo table_format($l_num, 'misc_charge_name', @$misc_charge_name, 'misc_charge', @$misc_charge, 'misc_charge_val', @$misc_charge_val, 'misc_charge_val_total', @$misc_charge_val_total);
												$l_num++;
											}

	                                        if(@$digital_biz_card) {
	                                        	echo table_format($l_num, 'digital_biz_card_name', 'Digital Biz Card', 'digital_biz_card', @$digital_biz_card, 'digital_biz_card_val', @$digital_biz_card_val, 'digital_biz_card_val_total', @$digital_biz_card_val_total);
	                                            $l_num++;
	                                        }

	                                        if (@$special_credit) {
												echo table_format($l_num, 'special_credit_name', 'Special Credit', 'special_credit', @$special_credit, 'special_credit_val', @$special_credit_val, 'special_credit_val_total', @$special_credit_val_total);
												$l_num++;
											}
	                                        
	                                        if(@$extra_name && !empty($extra_name)) {
	                                        	$lng = count(@$extra_name);
	                                            $addExtraTT = 0;
	                                            for ($i=0; $i < $lng; $i++) { 
	                                            	echo table_format($l_num, 'extra_name[]', @$extra_name[$i], 'extra[]', $extra[$i], 'extra_val[]', @$extra_val[$i], 'extra_val_total[]', @$extra_val_total[$i]);
	                                                $l_num++;   
	                                                $addExtraTT += @$extra_val_total[$i];
	                                            }
	                                        }
	                                        echo '<input type="hidden" name="count_var" id="count_var" value="'.$l_num.'">';
	                                        ?>
	                                    </tbody>
	                                </table>
	                            </div>
							<?php } ?>
                        </div>
                        <div id="addNew"><i class="fa fa-plus"></i></div>
                        <div class="pull-right total-fields col-md-5">
                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                <tbody>
                                    <tr>
                                        <th class="text-right t1">Grand Total $</th>
                                        <td class="text-center"><input type="text" id="total" name='price' class="form-control price" value="<?php echo (isset($price) && $price !='') ? $price : ''; ?>" readonly=""/></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="pull-left col-md-7  add_cc">
                                <div id="displaysuccessMessage"></div>
                            </div>
                            <div class="pull-right col-md-4">
                                <div class="three-btn">
                                    <a href="<?php echo base_url('uacc-billing/clients'); ?>">
                                    	<input type="button" name="cancel" class="btn btn-info" value="Cancel"/>
                                    </a>
                                    <button type="button" name="save" class="btn btn-info" id="submit_form">Save</button>
                                </div>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url('assets/js/UACC_invoice.js'); ?>" type="text/javascript"></script>
<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-credit-card" aria-hidden="true"></i> Credit Payment </h1>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
        		<div class="box">
        			<div class="box-body">
			        	<div class="table-inner table-responsive">
			        		<table  class="table table-hover" id="credit_payment_table">
			        			<thead>
			        				<tr>
                                        <th>#</th>
                                        <th class="creted">Invoice Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Consultant Number</th>
                                        <th>Total</th>
                                        <th>Due Amount</th>
                                        <th class="billi">Billing Alert</th>
                                        <th class="nosort action">Action</th>
                                    </tr>   
			        			</thead>
			        			<tbody id="tblUsers" >
                                    <?php  $nCount=1; 

                                        foreach ($data as $val)  {  ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $nCount++;?></td>
                                                <td><?php echo $val['increated_at'];?></td>
                                                <td><?php echo $val['name'];?></td>
                                                <td><?php echo $val['email'];?></td>
                                                <td><?php echo $val['consultant_number'];?></td>
                                                <td><?php echo $val['total']; ?></td>
                                                <td><?php echo $val['total'] - $val['total_paid']; ?> </td>
                                                <td><?php echo $val['billing_alert']; ?> </td>
                                                <td>
                                                    <form method="post" action="<?php echo  base_url('billing/payment-credit');?>">
                                                        <input type="hidden" name="name" value="<?php echo $val['name']?>">
                                                        <input type="hidden" name="total" value="<?php echo $val['total']?>">
                                                        <input type="hidden" name="cc_number" value="<?php echo $val['cc_number']?>">
                                                        <input type="hidden" name="cc_code" value="<?php echo $val['cc_code']?>">
                                                        <input type="hidden" name="cc_expir_date" value="<?php echo $val['cc_expir_date']?>">
                                                        <input type="hidden" name="cc_zip" value="<?php echo $val['cc_zip']?>">
                                                        <input type="hidden" name="id_invoice" value="<?php echo $val['id_invoice']?>">
                                                        <input type="submit" value="Make Payment" class="btn btn-info"  title="Payment"></a>
                                                    </form>

                                                <!-- <a class="btn btn-info" href="payment/index.html?name=<?php echo $val['name']; ?>&total=<?php echo $val['total']; ?>&c_num=<?php echo $val['cc_number']; ?>&s_code=<?php echo $val['cc_code']; ?>&e_date=<?php echo $val['cc_expir_date']; ?>&c_zip=<?php echo $val['cc_zip']; ?>&id_invoice=<?php echo $val['id_invoice']; ?>" title="Payment" target="_blank" >Make Payment</a> -->
                                                </td>
                                            </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
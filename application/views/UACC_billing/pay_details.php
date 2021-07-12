<div class="content-wrapper">
  <section class="content-header"> <h1> <i class="fa fa-users"></i> Payment Details </h1></section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php
          if ($this->session->flashdata('error')) {?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php }?>

        <?php
          if ($this->session->flashdata('success')) {?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php }?>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"> 
            <div class="row">
              <div class="col-sm-12">
                  <!-- <h3 class="box-title">Payment Details</h3> -->
                  <p><b>Search By:</b></p>
              </div>

              <div class="col-sm-12">
                <form method="post" id="filter_form" action="<?php echo base_url('tbc_billing/pay_details'); ?>">


                  
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" name="from_date" class="form-control datepicker" placeholder="From Date" value="<?php echo set_value('from_date'); ?>"/>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="to_date" placeholder="To Date" value="<?php echo set_value('to_date'); ?>"/>    
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="invoice_date" placeholder="Invoice Date" value="<?php echo set_value('invoice_date'); ?>"/>    
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control datepicker" name="due_date" placeholder="Due Date" value="<?php echo set_value('due_date'); ?>"/> 
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="c_name" placeholder="Name" />    
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <select name="payment_status" class="form-control">

                                <option value="0">Payment Status</option>

                                <?php
                                    $completed = ($this->input->post('payment_status') == 'S') ? 'selected' : '';
                                    $pending = ($this->input->post('payment_status') == 'P') ? 'selected' : '';
                                    $remaining = ($this->input->post('payment_status') == 'R') ? 'selected' : '';
                                    $canceled = ($this->input->post('payment_status') == 'C') ? 'selected' : '';
                                    $failed = ($this->input->post('payment_status') == 'F') ? 'selected' : '';
                                ?>

                                <option value="S" <?=$completed;?> >Completed</option>
                                <option value="P" <?=$pending;?> >Pending</option>
                                <option value="R" <?=$remaining;?> >Remaining</option>
                                <option value="C" <?=$canceled;?> >Canceled</option>
                                <option value="F" <?=$failed;?> >Failed</option>
                            </select>    
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <!-- <input type="hidden" name="filter_submit"> -->
                    <div class="col-sm-12">
                        <input type="submit" name="submit_form_btn" class="btn btn-info" id="submit_form_btn" value="Search">
                    </div>
                </form>
              </div>

            </div>
           
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="table_id">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Invoice Date</th>
                        <th>Amount Due</th>
                        <th>Price</th>
                        <th>Invoice Status</th>
                        <th>Payment Status</th>
                        <th class="nosort action">Action</th>
                    </tr>
                </thead>

                <tbody id="tblUsers" >

                    <?php
                        $nCount = 1;

                    foreach ($aClientsDetails as $aClientsDetail) {?>
                        <tr class="odd gradeX">
                            <td><?=$nCount++;?></td>
                            <td><?=$aClientsDetail['name'];?></td>
                            <td><?=$aClientsDetail['email'];?></td>
                            <td><?=$aClientsDetail['invoice_date'];?></td>
                            <td><?php echo $aClientsDetail['total'] - $aClientsDetail['total_paid'];?></td>
                            <td><?=$aClientsDetail['total'];?></td>
                            <td>
                                <?php
                                    if ($aClientsDetail['invoice_status'] == "Send invoice") {
                                        echo '<span class="label label-success">Send invoice</span>';
                                    } else {
                                        /*echo '<a href="draftUpdate.php?id_invoice=' . $aClientsDetail['id_invoice'] . '"><span class="label label-danger">Save as draft</span></a>';*/
                                        echo '<a href="#"><span class="label label-danger">Save as draft</span></a>';
                                    }
                                ?>

                            </td>

                            <td> <?php echo payment_status($aClientsDetail['payment_status']); ?> </td>

                            <td><a class="btn btn-info" href="<?php echo base_url('assets/billing/tbc/uploads/'.$aClientsDetail['invoice_name']); ?>" title="Download As PDF" download>Generate PDF</a>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
        </div>
    </section>
</div>
<!-- <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });
</script>
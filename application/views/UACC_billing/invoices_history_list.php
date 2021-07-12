<?php $id_cc_newsletter = $this->uri->segment(3); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>UACC Invoice History List</h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> <a href="<?php echo base_url('admin/uacc-billing'); ?>">Dashboard</a></li>
            <li class="active">UACC Invoice History List</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <?php  
                    if($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="invoice_history_table" class="table">
                                <thead>
                                   <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Invoice date</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Invoice Status</th>
                                    <th>Payment Status</th>
                                    <th class="nosort action">Action</th>
                                </tr>   
                                </thead>
                                <tbody>
                                    <?php 
                                        $nCount=1 ; 
                                        foreach ($data as $val) { ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $nCount++;?></td>
                                                <td><?php echo $val['name'];?></td>
                                                <td><?php echo $val['invoice_date'];?></td>
                                                <td><?php echo $val['total'];?></td>
                                                <td><?php echo $val['total_paid']; ?> </td>   
                                                <td><?php invoiceSendStatus($val['invoice_status']); ?> </td>
                                                <td><?php invoicePaymentStatus($val['payment_status']); ?> </td>
                                                <td>
                                                    <a class="btn btn-info" href="<?php echo base_url('assets/uploads/uacc-billing/'.$val['invoice_name']); ?>" title="See Invoice">View Details</a>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="Abal">
                            <label>Account Balance: <?php echo '$'. (GetCCTotalDue($id_cc_newsletter) - GetCCBalance($id_cc_newsletter)); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
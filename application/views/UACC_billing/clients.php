<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Client Listing </h1>
    </section>
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
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info mr5 mb7" href="#" id="send_to_all_UACC">Send to all</a>

                                    <button type="button" class="btn btn-info mr5 mb7" id="create_all_UACC">Create all Invoice</button>

                                    <a href="<?php echo base_url('uacc-billing/create-invoice');?>" class="btn btn-info mr5 mb7">Create Invoice</a>

                                    <button type="button" class="btn btn-info mr5 mb7" data-toggle="modal" data-target="#del_all_UACC_invoice">Delete All</button>

                                    <button type="button" class="btn btn-info mr5 mb7" id="reset_all_UACC">Reset Balance</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info" href="<?php echo base_url('uacc-billing/all-invoice-report'); ?>">Create Invoice Report</a>

                                    <a class="btn btn-info mr5" href="<?php echo base_url('uacc-billing/total-bank-report'); ?>">Total Report for Bank Upload</a>

                                    <a class="btn btn-info" href="<?php echo base_url('uacc-billing/unsubscribed-report'); ?>">Unsubscribed Reports</a>  
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5 text-right">
                            <form action="<?php echo base_url('uacc-billing/upload-balance-excel');?>" method="post" enctype="multipart/form-data" id="upload_payment_excel" class="inline-block mr5">
                                <label class="btn-bs-file btn btn-md btn-info" for="excel_price">Upload Payment Excel</label>
                                <input type="file" id="excel_price" name="excel_price">
                            </form>

                            <form action="<?php echo base_url('uacc-billing/upload-credit-excel');?>" method="post" enctype="multipart/form-data" id="upload_credit_excel" class="inline-block">
                                <label class="btn-bs-file btn btn-md btn-info" for="credit_excel">Upload Credit Excel</label>
                                <input type="file" id="credit_excel" name="credit_excel">
                            </form>
                        </div>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive pt0" id="table">
                    <table class="table table-bordered table-hover" id="uacc_billing_table">
                        <thead>
                            <tr>
                                <th class="nosort">#</th>
                                <th class="nosort sorting_disabled">Select <br>
                                    <input type="checkbox" name="checkall" id="checkall">
                                </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Consultant Number</th>
                                <th>Months Amount</th>
                                <th>Account Balance</th>
                                <th class="nosort action">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $count = 1;
                                foreach ($data['user_data'] as $val) {
                                    $bal = GetCCBalance($val['id_cc_newsletter']);
                                    $due = GetCCTotalDue($val['id_cc_newsletter']);
                                    
                                    $class = in_array($val['id_cc_newsletter'],  $aNewsletterIdEx) ? 'btn-success' : 'btn-info disabled';

                                    $button = "<a class='btn ".$class."' href='".base_url('uacc-billing/invoices-list/'.$val['id_cc_newsletter'])."' title='View Invoices'>View Invoices</a>&nbsp;
                                            <a class='btn ".$class."' href='".base_url('uacc-billing/invoice-year-report/'.$val['id_cc_newsletter'])."' title='Year Report'>Year Report</a>&nbsp;
                                            <a href='".base_url('uacc-billing/reset-balance/'.$val['id_cc_newsletter'])."' class='btn btn-danger Sreset_bal'>Reset Balance</a>";

                                    $b1 = '<input type="checkbox" name="create_all[]" value="'.$val['id_cc_newsletter'].'">';
                            ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $b1; ?></td>
                                    <td><?php echo $val['name']; ?></td>
                                    <td><?php echo $val['email']; ?></td>
                                    <td><?php echo $val['consultant_number']; ?></td>
                                    <td><?php echo $due; ?></td>
                                    <td><?php echo ($due - $bal); ?></td>
                                    <td><?php echo $button; ?></td>
                                </tr>
                            <?php
                                    $count++;
                                }
                            ?>
                        </tbody>
                  </table>

                </div><!-- /.box-body -->
      </div><!-- /.box -->



            </div>
        </div>
    </section>
</div>

<div id="del_all_UACC_invoice" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
        <button type="button" class="btn btn-success" id="send_UACC_delete">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="loading_img"><img src="../assets/images/load.gif"></div>
<div class="overlay_ajax"> <p>Loading Please Wait...</p> </div>

<div class="hide" id="UACC-hidden-form"></div>
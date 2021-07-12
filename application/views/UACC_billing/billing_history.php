<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-history"></i> Client History Management </h1>
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
                        <div class="col-sm-12">
                            <h3 class="box-title">Client Listing</h3>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive" id="table">
                        <table class="table table-hover" id="uacc_billing_history_table">
                            <thead>
                                <tr>
                                    <th class="nosort">#</th>
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

                                        $button = "<a class='btn ".$class."' href='".base_url('uacc-billing/all-invoices-list/'.$val['id_cc_newsletter'])."' title='View Invoices'>View Invoices</a>";

                                        $b1 = '<input type="checkbox" name="create_all[]" value="'.$val['id_cc_newsletter'].'">';
                                ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $val['name']; ?></td>
                                            <td><?php echo $val['email']; ?></td>
                                            <td><?php echo $val['consultant_number']; ?></td>
                                            <td><?php echo UACC_BILLING; ?></td>
                                            <td><?php echo (number_format(($due - $bal), 2)); ?></td>
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

<div class="overlay_ajax"> <p>Loading Please Wait...</p> </div>
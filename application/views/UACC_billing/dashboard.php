<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <small>Control panel</small> </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $invoices; ?></h3>
                  <p>INVOICES</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo base_url('tbc_billing/pay_details'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $pending; ?></h3>
                  <p>PENDING INVOICES</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo base_url('tbc_billing/pay_details/pending'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $paid; ?></h3>
                  <p>PAID INVOICES</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo base_url('tbc_billing/pay_details/paid'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $cancel; ?></h3>
                  <p>CANCELED PAYMENT INVOICES</p>
                </div>
                <div class="icon"> <i class="fa fa-pencil-square-o"></i> </div>
                <a href="<?php echo base_url('tbc_billing/pay_details/cancel'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $remaining; ?></h3>
                  <p>REMAINING INVOICES</p>
                </div>
                <div class="icon">
                  <i class="fa fa-archive"></i>
                </div>
                <a href="<?php echo base_url('tbc_billing/pay_details/remaining'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            
          </div>
    </section>
</div>
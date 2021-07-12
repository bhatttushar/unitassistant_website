<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <small>Control panel</small> </h1>
    </section>
    
    <section class="content">
        <div class="row">
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $userCount; ?></h3>
                  <p>USERS</p>
                </div>
                <div class="icon"> <i class="fa fa-users"></i> </div>
                <a href="<?php echo base_url('admin/user-list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $historyCount; ?></h3>
                  <p>Directors</p>
                </div>
                <div class="icon"> <i class="fa fa-users"></i> </div>
                <a href="<?php echo base_url('admin/directors'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $cc_count; ?></h3>
                  <p>UACC CLIENTS</p>
                </div>
                <div class="icon"> <i class="fa fa-users"></i> </div>
                <a href="<?php echo base_url('admin/uacc'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $changesCount; ?></h3>
                  <p>REQUESTED CHANGES</p>
                </div>
                <div class="icon"> <i class="fa fa-pencil-square-o"></i> </div>
                <a href="<?php echo base_url('admin/requested-changes'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $archieveCount; ?></h3>
                  <p>ARCHIEVED</p>
                </div>
                <div class="icon"> <i class="fa fa-archive"></i> </div>
                <a href="<?php echo base_url('admin/archieved-clients'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $ua_unsubscribe_count; ?></h3>
                  <p>UNSUBSCRIBED UA CLIENTS</p>
                </div>
                <div class="icon"> <i class="fa fa-users"></i> </div>
                <a href="<?php echo base_url('admin/unsuscribed-clients'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $cc_unsubscribe_count; ?></h3>
                  <p>UNSUBSCRIBED UACC CLIENTS</p>
                </div>
                <div class="icon"> <i class="fa fa-users"></i> </div>
                <a href="<?php echo base_url('admin/archieved-UACC-clients'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $futureUpdateCount; ?></h3>
                  <p>FUTURE UPDATE LIST</p>
                </div>
                <div class="icon"> <i class="fa fa-history"></i> </div>
                <a href="<?php echo base_url('admin/future-update-list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $totalEmail; ?></h3>
                  <p>TOTAL EMAIL RECORDS</p>
                </div>
                <div class="icon"> <i class="fa fa-envelope"></i> </div>
                <a href="<?php echo base_url('admin/ua-user-emails'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $total_admin_emails; ?></h3>
                  <p>SEND BY ADMIN</p>
                </div>
                <div class="icon"> <i class="fa fa-send-o"></i> </div>
                <a href="<?php echo base_url('admin/ua-admin-emails'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $total_user_emails; ?></h3>
                  <p>SEND BY USERS</p>
                </div>
                <div class="icon"> <i class="fa fa-send-o"></i> </div>
                <a href="<?php echo base_url('admin/ua-user-emails'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $reportCount; ?></h3>
                  <p>REPORTS</p>
                </div>
                <div class="icon"> <i class="fa fa-file"></i> </div>
                <a href="<?php echo base_url('admin/texting-reports'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>
    </section>
</div>
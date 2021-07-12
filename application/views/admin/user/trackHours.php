<?php 
  $id_user = $this->uri->segment(3);
?>
<div class="content-wrapper">
  <section class="content-header">
    <h1> <i class="fa fa-users"></i> Hours Track </h1>
  </section>
  <section class="content">
    <div class="row">
        <div class="col-xs-12">
          <h4>Records per session</h4>
        </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="box-title">Time and Hours</h3>
              </div>

              <div class="col-sm-6 text-right">
                <button class="btn btn-info">Total Hours:<?php echo gmdate("H:i:s",$sumTotal);?></button>
                <a class="btn btn-info" href="<?php echo base_url('admin/download-whole-track/'.$id_user); ?>">Download Whole Report</a>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="table_id">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                    <th>Hours</th>
                  </tr>
              </thead>
              <tbody>
                <?php 
                  if (!empty($aLogsDetails)) {
                      $nCount = 1;
                      foreach ($aLogsDetails as $val) {
                          $nLoginTime = date('h:i:s a', strtotime($val['login_time']));  
                          $nLogoutTime = date('h:i:s a', strtotime($val['logout_time']));  
                          $total_time = strtotime($val['total_time']);
                          $hours = gmdate("H:i:s",($total_time/1000));

                      ?>
                          <tr class="odd gradeX">
                            <td><?php echo $nCount++;?></td>
                            <td><?php echo date("d-m-Y H:i:s", strtotime($val['created_at']));?></td>
                            <td><?php echo $nLoginTime;?></td>
                            <td><?php echo $nLogoutTime;?></td>
                            <td><?php echo $hours;?></td>
                          </tr>
                <?php }
                  } ?>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
        </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <h4>Records per day</h4>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="box-title">Time and Hours</h3>
              </div>

              <div class="col-sm-6 text-right">
                <button class="btn btn-info">Total Hours:<?php echo gmdate("H:i:s", $sumTotal);?></button>
                <a class="btn btn-info" href="<?php echo base_url('admin/download-daily-track/'.$id_user); ?>">Download Daily Report</a>
                <a class="btn btn-info" href="<?php echo base_url('admin/download-weekly-track/'.$id_user); ?>">Download Weekly Report</a>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="table_id">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Login Count</th>
                  <th>Logout Count</th>
                  <th>Hours</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if (!empty($aDayLogsDetails)) {
                    $nCount = 1;
                    foreach ($aDayLogsDetails as $val) {
                      $nLoginTime = date('h:i A', strtotime($val['login_time']));  
                      $nLogoutTime = date('h:i A', strtotime($val['logout_time']));  
                  ?>
                      <tr class="odd gradeX">
                        <td><?php echo $nCount++;?></td>
                        <td><?php echo date("d-m-Y H:i:s", strtotime($val['created_at']));?></td>
                        <td><?php echo $val['login_count'];?></td>
                        <td><?php echo empty($val['logout_count']) ? '' : $val['logout_count'];?></td>
                        <td>
                         <?php
                            $sumTotal1 = dayLogsTimeInfo($val['created_at'], $id_user);
                            echo gmdate("H:i:s", $sumTotal1);
                          ?>
                        </td>
                      </tr>
                  <?php } }?>
              </tbody>
            </table>

          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>

  </section>
</div>
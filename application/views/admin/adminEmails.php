<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-envelope"></i> Admin Email Management </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

  <div class="box">
    <div class="box-header">
        <h3 class="box-title">Email Listing</h3>
    </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="admin_email_table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Sent By</th>
                        <th>Sent To Client</th>
                        <th>Sent To User</th>
                        <th>Purpose</th>
                        <th>Created At</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                          $nCount=1 ; 
                          foreach ($data as $val) { ?>
                              <tr class="odd gradeX">
                                  <td><?php echo $nCount++;?></td>
                                  <td>Admin</td>
                                  <td> <?php echo getName($val['id_newsletter_client']);?> </td>
                                  <td>
                                    <?php 
                                      $userTo = getUserByName($val['userto']);

                                      if (!empty($userTo)) {
                                        echo $userTo['first_name']." ".$userTo['last_name'];
                                      }
                                    ?>
                                  </td>
                                  <td><?php echo isset($val['purpose']) ? $val['purpose'] : '';?></td>
                                  <td><?php echo isset($val['created_at']) ? $val['created_at'] : '';?></td>
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
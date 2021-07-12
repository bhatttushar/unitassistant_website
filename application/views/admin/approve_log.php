<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-check-circle"></i> Newsletters Approve Log </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

  <div class="box">
  
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="approve_log_table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Is Approve</th>
                        <th>Mail Sent</th>
                        <th>Log Message</th>
                        <th>Approve Using</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $nCounter=1 ; 
                            foreach ($data as $val) {  ?>
                            <tr class="odd gradeX">
                                <td><?php echo $nCounter++;?></td>
                                <td><?php echo $val['name'];?></td>
                                <td><?php echo $val['is_approve'];?></td>
                                <td><?php echo $val['is_send_mail'];?></td>
                                <td><?php echo $val['error_log'];?></td>
                                <td><?php echo $val['approve_using'];?></td>
                                <td><?php echo $val['approved_date'];?></td>
                                
                            </tr>
                                
                        <?php 
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
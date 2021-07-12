<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-trash"></i> Unsuscribed UACC Newsletter List </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

  <div class="box">
    <div class="box-header">
        <div class="row">
        <div class="col-sm-6">
          <h3 class="box-title">Client's Unsuscribed UACC Newsletter List</h3>
        </div>

        <div class="col-sm-6 text-right">
          <a href=" <?php echo base_url('admin/unsubscribed-UACC-export/unsub'); ?>" class="btn btn-info" title="Download History">Download Unsubscribed</a>
        </div>
      </div>
    </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="unsuscribed_uacc_clients_table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Unsubscribe Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $nCounter=1 ; 
                            foreach ($data as $val) { ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $nCounter++;?> </td>
                                <td><?php echo $val['name'];?></td>
                                <td><?php echo $val['contract_update_date'];?></td>
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
<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Client Reports Management </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Client Reports Listing</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover" id="newsletter_report_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Newsletter Design</th>
                                    <th>CV Account</th> 
                                    <th>CU Routing</th>
                                    <th>Last Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $nCounter=1 ; 
                                    foreach ($data as $val) { ?>
                                    <tr class="odd gradeX">
                                        <td> <?php echo $nCounter++;?> </td>
                                        <td> <?php echo $val['name'];?> </td>
                                        <td> <?php echo $val['hidden_newsletter']; ?> </td>
                                        <td> <?php echo decryptIt($val['cv_account']); ?> </td>
                                        <td> <?php echo $val['cu_routing']; ?> </td>
                                        <td> <?php echo $val['updated_at'];?> </td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->



            </div>
        </div>
    </section>
</div>
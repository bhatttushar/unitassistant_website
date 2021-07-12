<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-envelope"></i> Director Email Management </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header"> <h3 class="box-title">Email Listing</h3> </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="table table-hover" id="table_id">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Purpose</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tblUsers">
                                <?php 
                                    $nCount=1; 
                                    foreach ($email_details as $key => $value) {
                                        if($value['purpose']=='Approval mail' || $value['purpose']=='Update client'){ ?>
                                            <tr class="odd gradeX">
                                                <td><?=$nCount++;?></td>
                                                <td> <?php echo getName($value['id_newsletter_client']); ?> </td>
                                                <td><?php echo $value['purpose'];?></td>
                                                <td><?php echo $value['created_at'];?></td>
                                                <td><a href="<?php echo base_url('admin/view-email-detail/'.$value['id_newsletter'].'/'.$value['purpose']); ?>" title="Click to view client's email detail" class="btn btn-sm btn-info">View Detail</a>&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                <?php   } 
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-archive"></i> UA Archieved Records Management </h1>
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
        <h3 class="box-title">UA Archieved Records Listing</h3>
    </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="archieved_clients_table">
                    <thead>
                    <tr>
                      <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:70px;">
                      <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                      </th>
                      <th>#</th>
                      <th>User name</th>
                      <th>Update By</th>
                      <th>Name</th>
                      <th>Unit Number</th>
                      <th>Unit Size</th>
                      <th>Package Price</th>
                      <th>Point Value</th>
                      <th>CV Account</th>
                      <th>Approval Status</th>
                      <th>Archieved Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $nCount=1 ; 
                      foreach ($data as $val) { ?>
                          <tr class="odd gradeX">
                              <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" onClick="unckeckMaster()" value="<?php echo $val['id_newsletter']; ?>"  /></td>
                             
                              <td><?php echo $nCount++;?></td>
                              <td><?php echo $val['user_name'];?></td>
                              <td><?php echo $val['updated_by'];?></td>
                              <td><?php echo $val['name'];?></td>
                              <td><?php echo $val['unit_number'];?></td>
                              <td class="editable"><?php echo $val['unit_size'];?>
                                  <input type="hidden" value="<?php echo $val['id_newsletter'];?>" name="hidden_id" id="hidden_id">
                              </td>
                              <td>
                                <?php
                                    $nHiddenNewsLetter = Get_hidden_newsletter($val['hidden_newsletter']);
                                    echo  $val['package_pricing'] + $nHiddenNewsLetter;
                                ?>      
                              </td>
                              <td><?php echo $val['point_value'];?></td>
                              <td><?php echo empty($val['cv_account']) ? '' : decryptIt( $val['cv_account']); ?> </td>
                              <td>
                                  <strong>
                                  <?php echo Get_design_approve_status($val['design_one'],$val['design_approve_status']);?>
                                  </strong>
                              </td>
                              <td><?php echo $val['updated_at'];?></td>
                              <td>
                                  <a href="<?php echo base_url('admin/revert-client/'.$val["id_newsletter"]); ?>" title="Revert client" class="label label-success">Revert Client</a>

                                  <a href="<?php echo base_url('admin/revert-to-client-list/'.$val["id_newsletter"]); ?>" title="Revert to client list" class="label label-success">Revert to client list</a>
                              </td>
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
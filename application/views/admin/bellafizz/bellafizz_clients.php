<div class="content-wrapper">
  <section class="content-header"> <h1> <i class="fa fa-users"></i> BellaFizz Clients Management </h1></section>
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
            <div class="row">
              <div class="col-sm-6"> <h3 class="box-title">BellaFizz Clients Listing</h3> </div>

              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <a href="<?php echo base_url('admin/bellafizz-excel-export');?>" class="btn btn-info" >Download All</a>
                  </div>
                </div>
              </div>
            </div>
           
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="bellafizz_clients_table">
              <thead>
                 <tr>
                  <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;">
                      <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                  </th>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Login Id</th>
                  <th class="bigW">Updated Date</th>
                  <th class="nosort action">Action</th>
              </tr>
              </thead>
              <tbody id="tblUsers" >
                  <?php
                    $nCount = 1;
                    foreach ($bellafizz_clients as $val) { ?>
                      <tr class="odd gradeX">
                          <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" onClick="unckeckMaster()" value="<?php echo $val['id_bellafizz']; ?>"  /></td>
                          <td><?php echo $nCount++;?></td>
                          <td><?php echo $val['name'];?></td>
                          <td><?php echo $val['email'];?></td>
                          <td><?php echo $val['loginid'];?></td>
                          <td><?php echo $val['updated_at'];?></td>
                          <td>
                              <a href="<?php echo base_url('admin/bellafizz-excel-export/'.$val['id_bellafizz']);?>" title="Click to Download excel file"><i class="fa fa-download"></i></a>&nbsp;&nbsp;&nbsp;
                              <a href="<?php echo base_url('admin/delete-bellafizz/'.$val['id_bellafizz']);?>" title="Delete client" ><i class="fa fa-times" onclick="return confirm('Are you sure to delete this record ?');" ></i></a>
                          </td>
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
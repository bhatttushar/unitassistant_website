<style type="text/css">
  .dropdown{
    float: right;
  }

  table#table_id th{
    padding: 10px !important;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> User Management </h1>
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
                  <div class="col-sm-6">
                      <h3 class="box-title">Users List</h3>
                  </div>
                  <div class="col-sm-6">
                    <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">More Actions
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admin/add-user'); ?>">Add User</a></li>
                        <li><a href="javascript:void(0)" id="delete_all_user" title="Delete Client">Delete Clients</a></li>
                      </ul>
                    </div> 
                  </div>
                </div><!-- /.box-header -->

                <div class="box-body table-responsive">
                  <table class="table table-hover" id="table_id">
                    <thead>
                    <tr>
                      <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:80px;">
                          <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                      </th>
                      <th>#</th>
                      <th>User Name</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Created At</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

	$count = 1;
	foreach ($aUserDetails as $val) { ?>
                    <tr>
                      <td><input name="choices[]" type="checkbox" id="choices<?php echo $count; ?>" value="<?php echo $val['id_user']; ?>"  /></td>
                      <td><?php echo $count++; ?></td>
                      <td><?php echo $val['user_name'] ?></td>
                      <td><?php echo $val['first_name'] ?></td>
                      <td><?php echo $val['last_name'] ?></td>
                      <td><?php echo $val['email'] ?></td>
                      <td><?php echo $val['created_at'] ?></td>
                      <td class="text-center">
                          <a href="<?php echo base_url('admin/edit-user/'.$val['id_user']); ?>" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;&nbsp;

                          <a href="<?php echo base_url('admin/delete-user/'.$val['id_user']); ?>" title="Delete" onclick="return confirm('Are you sure to delete this user ?')" >
                            <i class="fa fa-times"></i>
                          </a>&nbsp;&nbsp;&nbsp;
                          
                          <?php 
                            if ($val['is_loggedin'] == '1'){?>
                              <a href="<?php echo base_url('admin/user-logout/'.$val['id_user']); ?>" title="Click to user logout"><i class="fa fa-sign-in"></i></a>&nbsp;&nbsp;&nbsp;
                            <?php }else{?>
                              <a href="#"><i class="fa fa-lock"></i></a> &nbsp;&nbsp;&nbsp;    
                            <?php }
                          ?>
                          
                          <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/re-send-mail/'.$val['id_user']); ?>" title="Resend Mail">Resend Mail</a> &nbsp;&nbsp;&nbsp; 

                          <a class="btn btn-info btn-sm" href="<?php echo base_url('admin/track-hours/'.$val['id_user']) ?>" title="View Tracked Hours">Track Hours</a>

                      </td>
                    </tr>
                    <?php }?>
</tbody>
                  </table>

                </div><!-- /.box-body -->
      </div><!-- /.box -->



            </div>
        </div>
    </section>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    var table = $('#table_id').DataTable();

    $('#delete_all_user').click(function(){

      var checkdata = table.$('input[name="choices[]"]');
      var all_ids=[];
        
      checkdata.each(function() {
        if ($(this).prop('checked')) {
          all_ids.push($(this).val());
        }
      });

      if(all_ids.length === 0){
          alert('Please select at least 1 and maximum 100 records!!');
          event.preventDefault();
      }else {
        $.ajax({
          type: "POST",
          url:  baseURL+'admin/delete-all-user',
          data: { id_users: all_ids },
          beforeSend: function() {
              $('.overlay_ajax').show();
          },
          success: function(response) {
              $('.overlay_ajax').hide();
              location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
              console.log(textStatus, errorThrown);
          }
        });
      }
    });

  });

</script>
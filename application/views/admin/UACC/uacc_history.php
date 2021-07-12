<?php $id_cc_newsletter = $this->uri->segment(3); ?>

<style type="text/css">
  .dropdown{
    float: right;
  }
</style>

<div class="content-wrapper">
  <section class="content-header"> <h1> <i class="fa fa-users"></i> UACC Clients History Management </h1> </section>
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
              <div class="col-sm-6"> <h3 class="box-title">UACC Clients History Listing</h3></div>
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-sm-9">
                    <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">More Actions
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)" id="delete_history">Delete Client History</a></li>
                        <li><a href="<?php echo base_url('admin/uacc-history-excel-export/'.$id_cc_newsletter); ?>">Download All History</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col-sm-3">
                    <a href="<?php echo base_url('admin/uacc'); ?>" class="btn btn-info btn-md">Go Back</a>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="table_id">
              <thead>
                <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:80px;">
                    <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                </th>
                <th>#</th>
                <th>User name</th>
                <th>Update By</th>
                <th>Name</th>
                <th>Director Title</th>
                <th>CV Account</th>
                <th>Updated At</th>
                <th class="nosort">Action</th>  
              </thead>
              <tbody>
                <?php 
                  $nCount=1 ; 
                  foreach ($uacc_history as $val) { ?>
                    <tr class="odd gradeX">
                      <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" onClick="unckeckMaster()" value="<?php echo $val['id_cc_history']; ?>"  /></td>
                      <td><?php echo $nCount++;?></td>
                      <td><?php echo $val['user_name'];?></td>
                      <td><?php echo $val['updated_by'];?></td>
                      <td><?php echo $val['name'];?></td>
                      <td><?php echo $val['cc_director_title'];?></td>
                      <td><?php echo empty($val['cv_account']) ? '' : decryptIt( $val['cv_account'] ); ?> </td>
                      <td><?php echo $val['updated_at'];?></td>
                      <td>
                        <a href="<?php echo base_url('admin/view-uacc-history/'.$val['id_cc_history']); ?>" title="View History"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                        <a onclick="return confirm('Are you sure to delete this record ?');" href="<?php echo base_url('admin/delete-uacc-history/'.$id_cc_newsletter.'/'.$val['id_cc_history']); ?>" title="Delete History" ><i class="fa fa-times" ></i></a>
                      </td>
                    </tr>
              <?php }  ?>
              </tbody>
            </table>
            <form method="post" id="delete_UACC_history" action="<?php echo base_url('admin/delete-selected-uacc-history');?>">
                <input type="hidden" name="id_cc_history" value="" id="input_hidden">
                <input type="hidden" name="id_cc_newsletter" id="user_id" value="<?php echo $id_cc_newsletter; ?>">
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
        
  $(document).ready(function() {
    $("#delete_history").click(function(){
       checked = $("input[type=checkbox]:checked").length;

        if(!checked){
           alert("You must check at least one checkbox.");
            return false;
        }else{
           var flag = confirm('Are you sure to delete this record ?');
           if(flag == 1){
                var favorite = [];
                $.each($("input[name='choices[]']:checked"), function(){            
                    favorite.push($(this).val());
                });
                $("#input_hidden").val(favorite.join(","));
                $("#delete_UACC_history").submit();
                
           }else{
                return false;
           }
        }      
      });
  });  

  function unckeckMaster(){ 
      $('input[name=choices]').attr('checked', false);
  }

  </script>
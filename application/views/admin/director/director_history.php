<?php
  $id_newsletter = $this->uri->segment(3);
?>
<div class="content-wrapper">
  <section class="content-header"> <h1> <i class="fa fa-users"></i> Director History Management </h1> </section>
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
              <div class="col-sm-6"> <h3 class="box-title">Director History Listing</h3></div>

              <div class="col-sm-3 text-right">
                
                <div class="dropdown">
                  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">More Actions
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#" id="delete_history">Delete Client History</a></li>
                    <li><a href="<?php echo base_url('admin/excel-export/'.$id_newsletter);?>">Download All History</a></li>
                  </ul>
                </div>
              </div>

              <div class="col-sm-3">
                <a href="<?php echo base_url('admin/directors'); ?>" class="btn btn-info btn-md">Go Back</a>
              </div>
            </div>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="table_id">
              <thead>
                <th title="Click to select all" class="nosort" style="background-image:none !important; cursor:default;width:80px;">
                  <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                </th>
                <th>#</th>
                <th>User name</th>
                <th>Update By</th>
                <th>Name</th>
                <th>Unit Number</th>
                <th>Director Title</th>
                <th>Point Value</th>
                <th>CV Account</th>
                <th>Updated At</th>
                <th class="nosort">Action</th>  
              </thead>
              <tbody>
                <?php 
                  $nCounter=1 ; 
                  foreach ($director_history as $val) { ?>
                    <tr class="odd gradeX">
                      <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCounter; ?>" onClick="unckeckMaster()" value="<?php echo $val['id_history']; ?>"  /></td>
                      <td> <?php echo $nCounter++;?> </td>
                      <td><?php echo $val['user_name'];?></td>
                      <td><?php echo $val['updated_by'];?></td>
                      <td><?php echo $val['name'];?></td>
                      <td><?php echo $val['unit_number'];?></td>
                      <td><?php echo $val['director_title'];?></td>
                      <td><?php echo $val['point_value'];?></td>
                      <td> <?php echo (empty($val['cv_account'])) ? '' : decryptIt($val['cv_account']); ?> </td>
                      <td><?php echo $val['updated_at'];?></td>
                      <td>
                        <a href=" <?php echo base_url('admin/view-history/'.$val['id_history']); ?>" title="View History"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                        <a onclick="return confirm('Are you sure want to delete this?');" href="<?php echo base_url('admin/delete-history/'.$id_newsletter.'/'.$val['id_history']); ?>" title="Delete History" ><i class="fa fa-times" ></i></a>
                      </td>
                    </tr>
                <?php } ?> 
              </tbody>
            </table>
            <form method="post" id="delete_record" action="<?php echo base_url('admin/delete-all-history'); ?>" >
                <input type="hidden" name="id_history" value="" id="input_hidden">
                <input type="hidden" name="id_newsletter" id="user_id" value="<?php echo isset($id_newsletter) ? $id_newsletter : ''; ?>">
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
          $("#delete_record").submit();
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
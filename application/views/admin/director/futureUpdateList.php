<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Client Management </h1>
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
      <div class="row">
        <div class="col-sm-6">
          <h3 class="box-title">Client Listing</h3> 
        </div>
        <div class="col-sm-6 text-right">
          <form action="<?php echo base_url('admin/delete-selected-future-client'); ?>" method="post" 
            id="delete_all_client" >
            <a href="javascript:void(0)" class="btn btn-info"  title="Delete Clients" id="delete_selected_client" >Delete Clients</a>
            <input type="hidden" name="id_newsletters" value="" id="input_hidden">
        </form>
        </div>

      </div>
        
    </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="future_update_table">
                    <thead>

                    <tr>
                      <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:35px;">
                          <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                      </th>
                      <th>#</th>
                      <th>User name</th>
                      <th>Update By</th>
                      <th>Name</th>
                      <th>Future Update Date</th>
                      <th>Consultant Number</th>
                      <th>Unit Size</th>
                      <th>Package Price</th>
                      <th>Point Value</th>
                      <th>Approval Status</th>
                      <th class="nosort action">Action</th>
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
                                <td><?php echo $val['future_package_date'];?></td>
                                <td><?php echo $val['consultant_number'];?></td>
                                <td><span class="underline"><?php echo $val['unit_size'];?></span></td>
                                <td>
                                <?php
                                    $nHiddenNewsLetter = Get_hidden_newsletter($val['hidden_newsletter']);
                                    echo  $val['package_pricing'] + $nHiddenNewsLetter;
                                ?>      
                                </td>
                                <td><?php echo $val['point_value'];?></td>                                
                                <td> <strong> <?php echo Get_design_approve_status($val['design_one'], $val['design_approve_status']);?> </strong> </td>
                                <td>
                                    <a href="<?php echo base_url('admin/future-history/'.$val['id_newsletter']);?>" title="Click to see history"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url('admin/delete-future-client/'.$val['id_newsletter']);?>"title="Delete User" onclick="return confirm('Are you sure want to delete this client ?')" ><i class="fa fa-times"></i></a>
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

<script type="text/javascript">
  $(document).ready(function(){

     $("#delete_selected_client").click(function(){
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
                $("#delete_all_client").submit();
                
           }else{
                return false;
           }
        }      
    });

   
});

</script>
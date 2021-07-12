<style type="text/css">
  .img-load {
    height: 7%;
    left: 45%;
    position: absolute;
    width: 7%;
    z-index: 1;
    top: 30%;
    display: none;
  }

  .dropdown{
    float: right;
  }  
</style>

<div class="content-wrapper">
  <section class="content-header"> <h1> <i class="fa fa-users"></i> UACC Clients Management </h1></section>
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
              <div class="col-sm-6"> <h3 class="box-title">UACC Clients Listing</h3> </div>

              <div class="col-sm-6">
                <form method="post" id="delete_selected_client" action="<?php echo base_url('admin/delete-selected-uacc'); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="id_cc_newsletter" id="id_cc_newsletter" value="">
                </form>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">More Actions
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('admin/uacc-excel-export'); ?>">Download All</a></li>
                        <li><a href="javascript:void(0)" id="delete_client" title="Delete Client">Delete Clients</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="UACC_clients_table">
              <thead>
                <tr>
                  <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:51px !important;">
                    <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                  </th>
                  <th>#</th>
                  <th>Name</th>
                  <th style="width:120px !important;">Email</th>
                  <th>Consultant Id</th>
                  <th>Password</th>
                  <th>Account Number</th>
                  <th>Routing Number</th>
                  <th>Action</th>
                </tr>   
              </thead>
              <tbody id="tblUsers">
                <?php 
                  $nCount=1 ; 
                  foreach ($consultant_clients as $val) { ?>
                    <tr class="odd gradeX">
                      <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" value="<?php echo $val['id_cc_newsletter']; ?>"  /></td>
                      <td><?php echo $nCount++;?></td>
                      <td><?php echo $val['name'];?></td>
                      <td><?php echo $val['email'];?></td>
                      <td><?php echo $val['consultant_number'];?></td>
                      <td><?php echo $val['intouch_password'];?></td>
                      <td>
                        <?php 
                          if(!empty($val['cv_account'])){
                                $decrypted = @decryptIt($val['cv_account']);
                                echo $mask = maskCreditCard($decrypted);
                            }
                        ?>
                      </td>
                      <td><?php echo $val['cu_routing']; ?></td>
                      <td>
                        <a href="<?php echo base_url('admin/uacc-history/'.$val['id_cc_newsletter']); ?>" title="Click to see history"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                        <!-- <a href="<?php echo base_url('excel_export/download_cc_excel/id_cc_newsletter/'.$val['id_cc_newsletter'].''); ?>" title="Click to Download excel file"><i class="fa fa-download"></i></a>&nbsp;&nbsp;&nbsp; -->
                        <a href="<?php echo base_url('admin/delete-uacc/'.$val['id_cc_newsletter']);?>" title="Delete User" ><i class="fa fa-times" onclick="return confirm('Are you sure to delete this record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
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
    $(document).ready(function() {

        $("#delete_client").click(function(){
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
                    $("#id_cc_newsletter").val(favorite.join(","));
                    $("#delete_selected_client").submit();
               }else{
                    return false;
               }
            }      
      });

    $(document).on('dblclick', 'td.editable', function(e){
        var OriginalContent = $(this).text();
        var hidden_id = $(this).find('input[type="hidden"]').val();
        $(this).addClass("cellEditing"); 
        $(this).html("<input type='text'  style='width:40px;' value='' />");
        $(this).children().first().focus();   
        $(this).children().first().keypress(function (e) { 
           if (e.which == 13) {
                var newContent = $(this).val();
                if(newContent>300){
                    alert("Please enter value between 0 to 300");
                }else{
                    $(".img-load").css('display','block');
                    var data = $(this).parent().text(newContent); 
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('admin/updateUnitSize/'); ?>",
                        data: {content : newContent,hidden_id : hidden_id},
                        cache: false,
                        success: function(data){  
                            console.log(data);
                           $("#table").html('');
                           $("#table").html(data);
                           $(".img-load").css('display','none');
                           $('#table_id').DataTable();
                        }
                    });

                }         
            }
            $(this).parent().removeClass("cellEditing");
        });   
        $(this).children().first().blur(function(){ 
            $(this).parent().text(OriginalContent); 
            $(this).parent().removeClass("cellEditing"); 
        }); 
    });
  }); 
</script>
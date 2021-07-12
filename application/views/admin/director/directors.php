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

    .underline {
        text-decoration: underline;
    }

    input#excelPrice, input#excelUnit{
        display: none;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Director Management </h1>
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
                                <h3 class="box-title">Director Listing</h3>   
                            </div>

                            <div class="col-sm-6">

                                <form method="post" id="delete_selected_client" action="<?php echo base_url('admin/delete-selected-director'); ?>" enctype="multipart/form-data">
                                    <input type="hidden" name="id_newsletter" value="" id="input_hidden">
                                </form>
                                    
                                <div class="col-sm-4">
                                   <div class="dropdown">
                                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">More Actions <span class="caret"></span></button>
                                      <ul class="dropdown-menu">
                                        <li><a href="#" id="delete_client" title="Delete Client">Delete Directors</a></li>
                                        <li><a href="<?php echo base_url('admin/excel-export'); ?>">Download Directors</a></li>
                                        <li><a href="<?php echo base_url('admin/upload-excel'); ?>">Upload Excels</a></li>
                                      </ul>
                                    </div> 
                                </div>

                                <div class="col-sm-4">
                                    <form id="upload_balance_excel" action="<?php echo base_url('admin/upload-balance-excel'); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="btn-group lists-btn">
                                            <label class="btn btn-info" for="excelPrice"> Upload Balance Excel</label>
                                            <input type="file" id="excelPrice" name="excelPrice">
                                        </div>
                                    </form>
                                </div>

                                <div class="col-sm-4">
                                    <form id="upload_unit_excel" action="<?php echo base_url('admin/upload-unit-excel'); ?>" method="POST" enctype="multipart/form-data">

                                        <div class="btn-group lists-btn">
                                            <label class="btn btn-info" for="excelUnit"> Upload Unit Size Excel</label>
                                            <input type="file" id="excelUnit" name="excelUnit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->

                    <div id="table">
                        <div class="box-body table-responsive">
                          <table class="table table-hover" id="directors_table">
                            <thead>
                                <tr>
                                    <th title="Click to select all" class="nosort" style="background-image:none !important;cursor:default;width:51px;">
                                        <input type="checkbox" name="choices" class="checkAll" id="checkuncheck_all" value="" onClick="checkUncheckAll()" data-sorter="false">&nbsp;&nbsp;All
                                    </th>
                                    <th>#</th>
                                    <th>User name</th>
                                    <th>Update By</th>
                                    <th>Name</th>
                                    <th>Consultant Number</th>
                                    <th>Unit Size</th>
                                    <th>Package Price</th>
                                    <th>Point Value</th>
                                    <th>Approval Status</th>
                                    <th>Updated Date</th>
                                    <th>Approved Date</th>
                                    <th>Last Email Date</th>
                                    <th class="nosort action">Action</th>
                                </tr>   
                                </thead>
                                <tbody id="tblUsers" >
                                    <?php 
                                        $nCount=1 ; 
                                        foreach ($directors as $val) { ?>
                                            <tr class="odd gradeX">
                                                <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" value="<?php echo $val['id_newsletter']; ?>"  /></td>
                                                <td><?php echo $nCount++;?></td>
                                                <td><?php echo $val['user_name'];?></td>
                                                <td><?php echo $val['updated_by'];?></td>
                                                <td><?php echo $val['name'];?></td>
                                                <td><?php echo $val['consultant_number'];?></td>
                                                <td class="editable"><span class="underline"><?php echo $val['unit_size'];?></span>
                                                    <input type="hidden" value="<?php echo $val['id_newsletter'];?>" name="hidden_id" id="hidden_id">
                                                    <img src="<?php echo base_url('assets/images/load.gif'); ?>" class="img-responsive img-load">
                                                </td>
                                                <td> <?php echo $val['package_pricing']; ?> </td>
                                                <td> <?php echo $val['point_value'];?></td>
                                                <td><strong>
                                                    <?php echo Get_design_approve_status($val['design_one'], $val['design_approve_status']); ?>
                                                    </strong>
                                                </td>
                                                <td><?php echo $val['updated_at'];?></td>
                                                <td><?php 
                                                    echo ($val['design_approve_status']==2 || $val['design_approve_status']==3 || $val['design_approve_status'] == 0) ? '' : $val['approved_date'];
                                                ?>
                                                </td>
                                                <td><?php echo $val['last_email_update_date'];?></td>
                                                <td>
                                                    <a href=" <?php echo base_url('admin/director-history/'.$val['id_newsletter'].''); ?>" title="Click to see history"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;

                                                    <a href="<?php echo base_url('admin/delete-director/'.$val['id_newsletter']);?>" title="Delete client" ><i class="fa fa-times" onclick="return confirm('Are you sure to delete this record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
                                                    <?php
                                                    if($val['design_approve_status'] == '1'){?>
                                                        <a href="<?php echo base_url('admin/dis-approve-director/'.$val['id_newsletter']); ?>" title="Disapprove client" ><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;

                                                    <?php } elseif($val['design_approve_status'] == '2' || $val['design_approve_status'] == '3') { ?>
                                                        <a href="<?php echo base_url('admin/approve-director/'.$val['id_newsletter']) ?>" title="Approve client" ><i class="fa fa-thumbs-up" aria-hidden="true" onclick="return confirm('Are you sure to aprrove record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
                                                    <?php } ?>
                                                        <a href="<?php echo base_url('admin/newsletter-message/'.$val['id_newsletter']); ?>" title="Send Mail" ><i class="fa fa-envelope" onclick="return confirm('Are you sure to send mail to this record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
                                                         <a href="<?php echo base_url('admin/director-emails/'.$val['id_newsletter'].''); ?>" title="View client emails"><i class="fa fa-list"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?> 
                              </tbody>
                          </table>
                        </div><!-- /.box-body -->    
                    </div>
                    

                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#excelPrice").change(function(){
            $("#upload_balance_excel").submit();
        });

        $("#excelUnit").change(function(){
            $("#upload_unit_excel").submit();
        });

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
                    $("#input_hidden").val(favorite.join(","));
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
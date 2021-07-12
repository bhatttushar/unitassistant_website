<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> TBP Clients Management </h1>
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
        <div class="col-sm-6"> <h3 class="box-title">TBP Clients Management</h3>  </div>

        <div class="col-sm-6 text-right">
          <a href="<?php echo base_url('excel_export/download_tbp_excel/all_tbp/'); ?>" class="btn btn-info" >Download All</a>  
        </div>

      </div>
        
    </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="table_id">
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
                          foreach ($aTBPClientDetails as $aTBPClientDetail) { ?>
                                <tr class="odd gradeX">
                                    <td><input name="choices[]" type="checkbox" id="choices<?php echo $nCount; ?>" onClick="unckeckMaster()" value="<?php echo $aTBPClientDetail['id_blastpro']; ?>"  /></td>
                                    <td><?=$nCount++;?></td>
                                    <td><?=$aTBPClientDetail['name'];?></td>
                                    <td><?=$aTBPClientDetail['email'];?></td>
                                    <td><?=$aTBPClientDetail['loginid'];?></td>
                                    <td><?=$aTBPClientDetail['updated_at'];?></td>
                                    <td>
                                        <a href="<?php echo base_url('excel_export/download_tbp_excel/id_blastpro/'.$aTBPClientDetail['id_blastpro']); ?>" title="Click to Download excel file"><i class="fa fa-download"></i></a>&nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo base_url('admin/deleteTBPClient/'.$aTBPClientDetail['id_blastpro'].''); ?> " title="Delete client" ><i class="fa fa-times" onclick="return confirm('Are you sure to delete this record ?');" ></i></a>&nbsp;&nbsp;&nbsp;
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

<div id="uploadUnit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Success</h4>
      </div>
      <div class="modal-body">
        <p>Unit size excel uploaded successfully! </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function param(name) {
      return (location.search.split(name + '=')[1] || '').split('&')[0];
  }
  $(document).ready(function(){
    if(param('unitupload') == 1) {
      $('#uploadUnit').modal('show');
    }
    $('#uploadUnit').on('hidden.bs.modal', function () {
      window.location.href='users.php';
    });
  });
$(function () {

    $(document).on('dblclick',"td.editable",function()
    {
        var OriginalContent = $(this).text();
        var hidden_id = $(this).find('input[type="hidden"]').val();
        $(this).addClass("cellEditing");
        $(this).html("<input type='text'  style='width:40px;' value='' />");
        $(this).children().first().focus();
        $(this).children().first().keypress(function (e)
        {
           if (e.which == 13)
           {
                var newContent = $(this).val();
                if(newContent>300)
                {
                    alert("Please enter value between 0 to 300");
                }
                else
                {
                    $(".img-load").css('display','block');
                    var data = $(this).parent().text(newContent);
                    $.ajax({
                        type: 'POST',
                        url: "updatePrice.php",
                        data: {content : newContent,hidden_id : hidden_id},
                        cache: false,
                        success: function(data){
                           $("#table").html(data);
                           $(".img-load").css('display','none');
                        }
                    });
                }
            }
            $(this).parent().removeClass("cellEditing");
        });
        $(this).children().first().blur(function()
        {
            $(this).parent().text(OriginalContent);
            $(this).parent().removeClass("cellEditing");
        });
    });
});
document.getElementById("file").onchange = function()
{
    document.getElementById("delete_form").submit();
};
document.getElementById("file1").onchange = function()
{
    document.getElementById("delete_form").submit();
};
</script>
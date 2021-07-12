<div class="content-wrapper">
    <section class="content-header">
      <h1> <i class="fa fa-users"></i> Client's Requested Changes</h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">

  <div class="box">
    <div class="box-header">
        <h3 class="box-title">Client's Requested Changes Listing</h3>
    </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="table table-hover" id="requested_changes_table">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Client Name</th>
                      <th>Requested Changes</th>
                      <th>Review Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $nCounter=1 ; 
                        foreach ($data as $val) { ?>
                        <tr class="odd gradeX">
                            <td> <?php echo $nCounter++;?></td>
                            <td><?php echo $val['name'];?></td>
                            <td><?php echo mb_strimwidth($val['names'], 0, 30, "..."); ?></td>
                            <td><?php echo $val['created_at']; ?></td>
                            <td>
                              <a href="#" class="viewDetail" data-changeid="<?php echo $val['id_change']; ?>" title="View Requested Changes" data-toggle="modal" data-target="#viewDetail"><i class="fa fa-eye" ></i></a>
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

<div class="modal fade" id="viewDetail" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cliente's Requested Changes</h4>
        </div>
        <div class="modal-body">
          <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                    <label for="textarea">Requested Changes:</label>
                    <textarea class="form-control" id="textArea" readonly="" ></textarea>      
                </div>
              </div>
              <div class="col-sm-12" id="imgFile"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <script type="text/javascript">
      $(document).ready(function(){
        $('.viewDetail').click(function(){
            var changeId = $(this).data("changeid"),
                hitURL = baseURL + "admin/view-changes-detail";
            
            $.ajax({
                type : "POST",
                dataType : "json",
                url : hitURL,
                data : { changeId : changeId } 
            }).done(function(data){
               if (data.result.names !='') {
                    $('#textArea').val(data.result.names);
                }else{
                    $('#textArea').val('');
                }

                if(data.imgFile != ''){
                    $('#imgFile').html('');
                    $('#imgFile').append('<label>Click on below link to download file</label><br/>');
                    $.each(data.imgFile, function(key, value) {
                        $('#imgFile').append('<a href="'+baseURL+'assets/images/admin/'+value.file+'" download>'+ value.file+'</a><br/>');
                    });
                }else{
                    $('#imgFile').attr('href', '#');
                    $('#imgFile').html('');
                }
            });
        });
      });
  </script>
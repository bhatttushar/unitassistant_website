<style type="text/css">
    .dataTables_filter {
        display: none;
    }    
</style>

<div class="container min-height">
    <div class="row">
        <h2>Serach by hashtag</h2>
        <div class="col-md-12 top-padding">
            <div class="col-md-3 date-from">
                <input type="text" class="form-control hasDatepickerSearch" placeholder="From date" name="from_date" id="todate">
            </div>
            <div class="col-md-3 date-to">
                <input type="text" class="form-control hasDatepickerSearch" placeholder="To date" name="to_date" id="fromdate">
            </div>
            <div class="col-md-6">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" id="input" class="form-control" placeholder="Serach your notes by hashtag...." />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" id="search" type="button" onclick="search();">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        	<div id="page-wrapper">
                <div class="page-content">
                <!-- begin PAGE TITLE ROW -->
                    <div class="page-title">
                        <h3>Notes Listing</h3>
                    </div>
                    <div class="portlet portlet-default">
                        <form method="post" id="delete_form">
                            <div class="portlet-body table-width">
                                <div class="table-responsive table-user">
                                    <table class="table table-striped table-bordered table-hover table-green" id="notes_table">
                                        <thead>
                                           <tr>
                                            <th>#</th>
                                            <th>Note Description</th>
                                            <th>Client Name</th>
                                            <th>Created At</th>
                                        </tr>   
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <img src="assets/images/load.gif" class="img-responsive image-load" style="display: none;">
                            </div>
                        </form>
                    </div>                    <!-- /.table-responsive -->
                </div>                   <!-- /.portlet-body -->
    		</div> 
        </div>       
    </div>
    <div class="clear-fix"></div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('#notes_table').DataTable({
            "iDisplayLength": 10,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                  'url':baseURL+'notes-listing',
                  "data": function ( d ) {
                      d.Records = "notes_listing"
                  }
            },
            'columns': [
               { data: 'number' },
               { data: 'note' },
               { data: 'name' },
               { data: 'created_date' }
            ],
            "iDisplayLength": 10,
            'aoColumnDefs': [{
                 'bSortable': false,
                 'aTargets': ['nosort']
            }],
        "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
      });

    });

    function search() {
        $('.image-load').css('display','block');
        var todate = $("#todate").val();
        var fromdate = $("#fromdate").val();
        var string = $("#input").val();
        var tags = string.split(' ');
        var lastTag = tags.pop();
        if (/#\S+\b/.test(lastTag)) {
            var strP = lastTag.match(/#\w+/g);   
        }else{
            var strP = '';
        }    

        $.ajax({
            url : baseURL+'search-notes-by-tags',
            type:'POST',
            data : {
                'string' : strP,
                'todate' : todate,
                'fromdate' : fromdate
            },
            success : function(response){
                $(".table-user").html(response);
                $('.image-load').css('display','none');
            },
        });
    }

    $(function(){
        $(".hasDatepickerSearch").datepicker({
            changeMonth: true,
            changeYear: true
        });
    });

</script>
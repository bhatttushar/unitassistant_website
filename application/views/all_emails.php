<div class="container min-height">
    <div class="row">
        <div class="col-md-12">
        	<div id="page-wrapper">
                <div class="page-content">
                    <div class="page-title">
                        <h3>Your Email Records</h3>
                    </div>
                    <div class="portlet portlet-default">
                        <form method="post" id="delete_form">
                            <div class="portlet-body table-width">
                                <div class="table-responsive table-user">
                                    <table class="table table-striped table-bordered table-hover table-green" id="emails_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sent By</th>
                                                <th>Sent To Client</th>
                                                <th>Sent To User</th>
                                                <th>Purpose</th>
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

        var table = $('#emails_table').DataTable({
            "iDisplayLength": 10,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                  'url':baseURL+'emails-listing',
                  "data": function ( d ) {
                      d.Records = "emails_listing"
                  }
            },
            'columns': [
               { data: 'number' },
               { data: 'sent_by' },
               { data: 'name' },
               { data: 'sent_to' },
               { data: 'purpose' },
               { data: 'created_at' }
            ],
            "iDisplayLength": 10,
            'aoColumnDefs': [{
                 'bSortable': false,
                 'aTargets': ['nosort']
            }],
        "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
      });

    });

</script>
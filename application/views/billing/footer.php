<footer class="main-footer">
    <div class="pull-right hidden-xs"> <b>Unit Assistant</b> Admin System | Version 1.0 </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>">Unit Assistant</a>.</strong> All rights reserved.
</footer>

</div>
    <script src="<?php echo base_url('assets/plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/dist/js/app.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/validation.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/billing.js'); ?>"></script>

    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');

            $(document).ready( function () {
               $('#table_id').DataTable();

               var table  = $('#table_idUA').DataTable({
                "iDisplayLength": 100,
                   'aoColumnDefs': [{
                       'bSortable': false,
                       'aTargets': ['nosort'],
                    }],
                    "dom": '<"top"<"clear">>rt<"bottom"<"clear">>'
                });
            });


            function checkUncheckAll(){
                if( $('#checkuncheck_all').is(":checked") ){  
                    $('input[name="choices[]"]').each(function(){
                        $(this).prop("checked",true);
                    }); 
                }else{
                    $('input[name="choices[]"]').each(function(){
                        $(this).prop("checked", false);
                    });  
                }
            }

            function deleteAll(formId){
                checked = $("input[type=checkbox]:checked").length;

                if(!checked) {
                     // <form:errors path="chk" cssClass="errors" element="div" />
                     //$(".form-error").text("* You must check at least one checkbox.").show();
                   alert("You must check at least one checkbox.");
                    return false;
                }else{
                   var flag = confirm('Are you sure to delete this record ?');
                   if(flag == 1){
                        $("#"+formId).submit();
                   }else{
                        return false;
                   }
                }
            }
    </script>
  </body>
</html>
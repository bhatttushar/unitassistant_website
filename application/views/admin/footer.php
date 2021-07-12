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
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');

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

        $(document).ready(function(){
             $('#report_table, #future_update_table, #newsletter_report_table, #news_design_status_table, #requested_changes_table, #archieved_clients_table, #archieved_uacc_clients_table, #unsuscribed_clients_table, #unsuscribed_uacc_clients_table, #admin_email_table, #user_email_table, #uacc_admin_email_table, #uacc_user_email_table, #approve_log_table, #UACC_clients_table, #directors_table, #bellafizz_clients_table').DataTable();
        });
    </script>
  </body>
</html>
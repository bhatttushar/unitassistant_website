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
    <script type="text/javascript" src="<?php echo base_url('assets/js/UACC_billing.js'); ?>"></script>
    
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
  </body>
</html>
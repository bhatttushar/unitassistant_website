    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" ></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/select2.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/monthpicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/functions.js'); ?>"></script>
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
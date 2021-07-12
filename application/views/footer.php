    <footer class="footer">
        <div class="container">
            <p class="pull-left paragraph"> Copyright &copy; Unit Assistant <?php echo date('Y'); ?> . All right reserved. </p>
            <div class="pull-right">
                <ul class="social">
                    <li> <a href="#"> <i class=" fa fa-facebook">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-twitter">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-google-plus">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-pinterest">   </i> </a> </li>
                    <li> <a href="#"> <i class="fa fa-youtube">   </i> </a> </li>
                </ul>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');

        $(document).ready(function(){

            $('#client_email_table, #uacc_client_email_table').DataTable();

            var Succ = "<?php echo $this->session->flashdata('UACCsuccess'); ?>";
            var ERR = "<?php echo $this->session->flashdata('UACCerror'); ?>";
            if (Succ != '' || ERR != '') {
                var Title = (Succ != '' ? 'Success' : 'Error'); 
                var color = (Succ != '' ? 'green' : 'red'); 
                var content = (Succ != '' ? Succ : ERR);
                var icon = (Succ != '' ? 'fa fa-check' : 'fa fa-times-circle'); 
                $.confirm({title:Title,icon:icon,type:color,content:content,buttons: { OK: function () { return;  }} });    
            }
            
            $('body').on('click','.add-in-uacc', function(event) {
                var id = $(this).attr('data-id');
                $.confirm({
                    title: 'Alert',
                    content: 'Do you really want to add this record into UACC client?',
                    icon:'fa fa-warning',
                    type:'orange',
                    buttons: {
                       YES: {
                            btnClass: 'btn-red',
                            text: 'YES',
                            action: function(){
                                var url = baseURL+'add-to-uacc/'+id;
                                window.location.href = url;
                            }
                        },
                        NO:{
                            btnClass: 'btn-green',
                            text: 'NO', 
                        }
                    }
                });
            });
        });
</script>


  </body>
</html>
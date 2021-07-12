<?php $id_cc_newsletter = $this->uri->segment(3); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/summernote/summernote.css'); ?>">    
<div class="content-wrapper">
    <section class="content-header">
        <h1>UACC Invoice List</h1>
        <ol class="breadcrumb">
            <li> <i class="fa fa-dashboard"></i> <a href="<?php echo base_url('admin/uacc-billing'); ?>">Dashboard</a> </li>
            <li class="active">UACC Invoice List</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <?php  
                    if($this->session->flashdata('error')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example-table1" class="table table-bordered table-hover">
                                <thead>
                                   <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="invoiceDate">Invoice date</th>
                                    <th>Month Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due</th>
                                    <th>Invoice Status</th>
                                    <th>Payment Status</th>
                                    <th class="w-100">Payment Date</th>
                                    <th class="nosort action">Action</th>
                                </tr>   
                                </thead>
                                <tbody id="tblUsers" >
                                    <?php 
                                        $nCount=1 ; 
                                        foreach ($data as $val) { ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $nCount++;?></td>
                                                <td><?php echo $val['name'];?></td>
                                                <td><?php echo $val['invoice_date'];?></td>
                                                <td><?php echo $val['total'];?></td>
                                                <td> <?php echo $val['total_paid']; ?> </td>   
                                                <td><?php echo $val['due_amount']; ?></td>
                                                <td><?php invoiceSendStatus($val['invoice_status']); ?> </td>
                                                <td> <?php invoicePaymentStatus($val['payment_status']); ?> </td>
                                                <td> <?php echo $val['payment_date']; ?> </td>
                                                <td class="action_col">
                                                    <a class="btn btn-info mb7" href="<?php echo base_url('assets/uploads/uacc-billing/'.$val['invoice_name']); ?>" title="See Invoice" download="<?php echo $val['invoice_name']; ?>">View Details</a>&nbsp;

                                                    <a class="btn btn-info mb7" href="<?php echo base_url('uacc-billing/edit-invoice/'.$val['id_cc_invoice']); ?>" title="Edit Invoice">Edit Invoice</a>&nbsp;

                                                    <form action="<?php echo base_url('uacc-billing/delete-invoice-pdf'); ?>" method="post">
                                                        <input type="hidden" name="id_cc_invoice" value="<?php echo $val['id_cc_invoice']; ?>">
                                                        <input class="btn btn-info mb7" onclick="return confirm('Are you sure you want to delete this invoice?')" data-id="<?php echo $val['id_cc_invoice']; ?>"  type="submit" name="pdf_delete" value="Delete">
                                                    </form>

                                                    <input class="btn btn-info custom-paid" data-id="<?php echo $val['id_cc_invoice']; ?>"  type="button" name="submit_paid" value="Make Payment">&nbsp;
                                                     
                                                    <input class="btn btn-info custom-unpaid" data-id="<?php echo $val['id_cc_invoice']; ?>"  type="button" name="submit_unpaid" value="Unpaid">&nbsp;
                                                    
                                                    <input class="btn btn-info custom-send" data-id="<?php echo $val['id_cc_invoice']; ?>" data-news="<?php echo $val['id_cc_newsletter']; ?>" type="button" name="send" value="Send">
                                                    
                                                </td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="Abal">
                            <label>Account Balance: <?php echo '$'. (GetCCTotalDue($id_cc_newsletter) - GetCCBalance($id_cc_newsletter)); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>


<div id="uaccInvoiceModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Details</h4>
      </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-4">Payment Amount:</label>
                <input type="text" class="col-sm-4" name="payment" id="amount" required>
                <input type="hidden" name="id_cc_invoice" id="id_cc_invoice" value="" >
          </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="send_data">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="unpaid" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Unpaid Details</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="col-sm-4">Unpaid Amount:</label>
                <input type="text" class="col-sm-4" name="unpaid" id="unpaid_amount" required>
                <input type="hidden" name="id_cc_invoice" id="unpaid_id_cc_invoice" value="" >
          </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="send_unpiad_data">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="send_mail" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Send Mail Details</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="" name="mail_details">
            <div class="form-group">
                <div class="summernote"></div>
                <input type="hidden" name="id_cc_invoice" id="send_id_cc_invoice" value="" >
                <input type="hidden" name="id_cc_newsletter" id="send_id_cc_newsletter" value="" >
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="send_mail_data">Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="overlay_ajax"> <p>Loading Please Wait...</p> </div>


<script src="<?php echo base_url('assets/plugins/summernote/summernote.min.js'); ?>"></script>

<script type="text/javascript">

$(document).ready(function() {
    var table = $('#example-table').DataTable({
        "sDom": "lfrt",   
       'aoColumnDefs': [{
           'bSortable': false,
           'aTargets': ['nosort']
        }]
    });
});

$(function () {

    $('body').on('click','.custom-paid',function(e){
        e.preventDefault();
         var id = $(this).data('id');
         var status = $(this).data('status');
         $('#id_cc_invoice').val(id);
         $('#uaccInvoiceModal').modal('show');
    });

    $('body').on('click','.custom-unpaid',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#unpaid_id_cc_invoice').val(id);
        $('#unpaid').modal('show');

    });

    $('#send_data').click(function(e){
        var id_cc_invoice =  $('#id_cc_invoice').val();
        var amount =  $('#amount').val();
        $.ajax({
            type: 'POST',
            url: baseURL + 'uacc-billing/make-payment',
            data: {is_paid:1, id_cc_invoice:id_cc_invoice, amount:amount},
            cache: false,
            success: function(data){  
                location.reload();
            }
        });
     });

    $('#send_unpiad_data').click(function(e){
        var id_cc_invoice =  $('#unpaid_id_cc_invoice').val();
        var amount =  $('#unpaid_amount').val();
        $.ajax({
            type: 'POST',
            url: baseURL + 'uacc-billing/unpaid',
            data: {is_unpaid:1, id_cc_invoice:id_cc_invoice, amount:amount},
            cache: false,
            success: function(data){  
                location.reload();
            }
        });
    });

    
    //Send mail
    $('body').on('click','.custom-send',function(e){
        e.preventDefault();
        $('.summernote').summernote({
            airMode: true
        });
        var id_cc_invoice = $(this).data('id');
        var id_cc_newsletter = $(this).data('news');

        $('#send_id_cc_invoice').val(id_cc_invoice);
        $('#send_id_cc_newsletter').val(id_cc_newsletter);

        $.ajax({
            type: 'POST',
            url: baseURL + 'uacc-billing/get-mail-content',
            data: {is_mail_get : 1, id_cc_newsletter:id_cc_newsletter, id_cc_invoice:id_cc_invoice},
            beforeSend: function(data){
                $('.overlay_ajax').show();
            },
            success: function(data){ 
                $('.overlay_ajax').hide(); 
                $('#send_mail').modal('show');
                if(data != '') {
                    $('body .note-editable').html(data);
                }
            }
        });


    });

    $('#send_mail_data').click(function(e){
        e.preventDefault();
        var id_cc_invoice =  $('#send_id_cc_invoice').val();
        var id_cc_newsletter =  $('#send_id_cc_newsletter').val();
        var markup = $('.note-editable').html();
        $('#send_mail').modal('hide');
        $.ajax({
            type: 'POST',
            url: baseURL + 'uacc-billing/send-invoice-mail',
            data: {is_mail_send : 1, id_cc_newsletter:id_cc_newsletter, id_cc_invoice:id_cc_invoice, e_data:markup},
            beforeSend: function(data){
                $('.overlay_ajax').show();
            },
            success: function(data){  
                $('.overlay_ajax').hide();
                if(data == 1) {
                    $('.page-title .alert').remove();
                    $('.page-title').append('<p class="alert alert-success">Email sent successfully!!</p>');
                }else {
                    $('.page-title .alert').remove();
                    $('.page-title').append('<p class="alert alert-danger">Email not sent please try again later!!</p>');
                }
            }
        });
    });

    $(document).on('dblclick',"td.editable",function(){ 
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

        $(this).children().first().blur(function(){ 
            $(this).parent().text(OriginalContent); 
            $(this).parent().removeClass("cellEditing"); 
        }); 
    });

    $('#example-table1').DataTable( {
        'aoColumnDefs': [{
           'bSortable': false,
           'aTargets': ['nosort']
        }]
    } );
});  

$('#file').on('change',function(){
    $('#delete_form').submit();
});

</script>
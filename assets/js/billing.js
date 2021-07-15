function checkUncheckAll() {
    if( $('#checkuncheck_all').is(":checked") ) {  
        $('input[name="choices[]"]').each(function() {
            $(this).prop("checked",true);
        }); 
    } else {
        $('input[name="choices[]"]').each(function() {
            $(this).prop("checked", false);
        });  
    }
}

jQuery(document).ready(function($) {

    $("#credit_payment_table, #unsub_table_id").DataTable();

    $("#excelPrice").change(function(){
        $("#upload_balance_excel").submit();
    });

    $("#excelUnit").change(function(){
        $("#upload_unit_excel").submit();
    });

	$('#unit_upload').change(function(){
		$('#delete_form').submit();
	});

	$('#file1').change(function(){
		$('#delete_form').submit();
	});

	var oldStart = 0;
    $('.overlay_ajax').show();
	var table = $('#ua_billing_table').DataTable({
      'processing': true,
      'serverSide': true,
      'fnDrawCallback': function (o) {
            if ( o._iDisplayStart != oldStart ) {
                var targetOffset = $('#ua_billing_table').offset().top;
                $('html,body').animate({scrollTop: targetOffset}, 500);
                oldStart = o._iDisplayStart;
            }
        },
        fnInitComplete : function() {
          $(".overlay_ajax").hide();
       },
      'serverMethod': 'post',
      'ajax': {
            'url':baseURL+'/billing/ajaxData',
            "data": function ( d ) {
                d.Records = "GetUaRecords"
            }
      },
      'columns': [
         { data: 'id_newsletter' },
         { data: 'create_all' },
         { data: 'first_bill_date' },
         { data: 'name' },
         { data: 'cell_number' },
         { data: 'email' },
         { data: 'consultant_number' },
         { data: 'account_balance' },
         { data: 'button1' },
      ],
      "iDisplayLength": 50,
      'aoColumnDefs': [{
           'bSortable': false,
           'aTargets': ['nosort']
      }],
      "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
    });

    // var table = $('#ua_billing_table').DataTable({
    //    "iDisplayLength": 100,
    //    "columnDefs": [ { "orderable": false, "targets": 1 } ]
    // });
    // check un check records
    $('#checkall').on('change',function(){
    	if($(this).prop('checked')) {
    		$('input[name="create_all[]"]').each(function() {
			    if ( $(this).is(':visible') && $(this).prop('checked',false) ) {
			        $(this).prop('checked',true);
			    }
			});
    	}else {
    		$('input[name="create_all[]"]').each(function() {
			    if ( $(this).is(':visible') && $(this).prop('checked',true) ) {
			        $(this).prop('checked',false);
			    }
			});
    	}
    });

    //delete ALl
    $('#delet_all').click(function(){
		$('#del_all').modal('show');
	});

	$('#send_delete').click(function(){
		var Tchecked = $('input[name="month[]"]:checked').length;
		if(Tchecked == 0) {
			$('.all_months').prepend('<p class="error">Please select at least one month</p>');
		}else {
			$('.all_months p.error').remove();
			var val = '';
			$('input[name="month[]"]:checked').each(function(){
				val += $(this).val()+ ',';
			});
			$.ajax({
				type: "POST",
                url: baseURL+'billing/delete-all-invoice',
                dataType: "text",
                data: {
                    delete_all:val
                },
                beforeSend: function() {
					$('.overlay_ajax').show();
                },
                success: function(response) {
                	console.log(response);
                    $('.overlay_ajax p').text(response);
                    setTimeout(function() {
					    $('.overlay_ajax').hide();
					    $('.overlay_ajax p').text('Loading Please Wait...');
					    $('#del_all').modal('hide');
					 }, 3000);
                }
			});
		}

	});

	// Create all Invoice with checkbox
    $('#create_all').click(function(event){
        var checkdata = table.$('input[name="create_all[]"]');
        var all_ids=[];
        var total_ids = 0;
        checkdata.each(function() {
            if ($(this).prop('checked')) {
                all_ids.push($(this).val());
                total_ids = total_ids + 1;
            }
        });
        if(all_ids.length === 0){
            alert('Please select at least 1 and maximum 100 records!!');
            event.preventDefault();
        }else if(all_ids.length > 100){
            alert('Please select maximum 100 records at a time!!');
            event.preventDefault();
        }else {
            $.ajax({
                type: "POST",
                url: baseURL + 'billing/get-all-invoice',
                datatype:'html',
                data: {
                    create_invoice:1,
                    ids:all_ids
                },
                beforeSend: function() {
                    $(".gif_image").css("display","block");
                    $(".gif_image").css("background", "url('img/LoaderIcon.gif') no-repeat");
                    $('.overlay_ajax').show();
                },
                success: function(response) {
                   console.log(response);
                    var data = $.parseJSON(response);
                    $('.overlay_ajax').hide();
                    $('.success-msg').addClass('display-invoice');
                    $("#display_msg").append("Invoice created successfully!!");
                    $(".gif_image").css("display","none");

                    setTimeout(function() {
                        $(".success-msg").hide();
                        window.location.href = baseURL + "billing/clients";
                    }, 2000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
        }
    });
    // Reset Balance with checkbox
    $('#reset_all').click(function(event){
        if(!confirm('Are you sure you want to reset balance to all clients?')) {
            event.preventDefault();
        }else {
            var checkdata = table.$('input[name="create_all[]"]');
            var all_ids=[];
            var total_ids = 0;
            checkdata.each(function() {
                if ($(this).prop('checked')) {
                    all_ids.push($(this).val());
                    total_ids = total_ids + 1;
                }
            });
            if(all_ids.length === 0){
                alert('Please select at least 1 and maximum 100 records!!');
                event.preventDefault();
            }else if(all_ids.length > 100){
                alert('Please select maximum 100 records at a time!!');
                event.preventDefault();
            }else {
                $.ajax({
                    type: "POST",
                    url:  baseURL + "billing/reset-all-balance",
                    data: { ids:all_ids },
                    beforeSend: function() {
                        $('.overlay_ajax').show();
                    },
                    success: function(response) {
                        console.log(response);
                        $('.overlay_ajax').hide();
                        $('.success-msg').addClass('display-invoice');
                        $("#display_msg").append(response);
                        $(".gif_image").css("display","none");
                        setTimeout(function() {
                            $(".success-msg").hide();
                            window.location.href = baseURL + "billing/clients";
                        }, 2000);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       console.log(textStatus, errorThrown);
                    }
                });
            }
        }
    });

    $('#send_selected').click(function(event){
        var checkdata = table.$('input[name="create_all[]"]');
        var all_ids=[];
        var total_ids = 0;
        checkdata.each(function() {
            if ($(this).prop('checked')) {
                all_ids.push($(this).val());
                total_ids = total_ids + 1;
            }
        });
        if(all_ids.length === 0){
            alert('Please select at least 1 and maximum 100 records!!');
            event.preventDefault();
        }else {
            $.ajax({
                type: "POST",
                url: baseURL + "billing/send-selected-invoice-mail",
                data: {id_newsletters:all_ids},
                beforeSend: function() {
                    $(".gif_image").css("display","block");
                    $(".gif_image").css("background", "url('../images/LoaderIcon.gif') no-repeat");
                    $('.overlay_ajax').show();
                },
                success: function(response) {
                    $('.overlay_ajax').hide();
                    $('.success-msg').addClass('display-invoice');
                    $("#display_msg").append("Invoice send successfully!!");
                    $(".gif_image").css("display","none");
                    setTimeout(function() {
                        $(".success-msg").hide();
                        window.location.href =  baseURL + "billing/clients";
                    }, 2000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
        }
    });

    $('#send_to_all').click(function(event){
        if(!confirm('Are you sure you want to send email to all clients?')) {
            event.preventDefault();
        }else {
            event.preventDefault();
             $('.send_all p').remove();
            $.ajax({
                type: "POST",
                url: baseURL + "billing/send-all-invoice-mail",
                data: { send_all:1 },
                beforeSend: function() {
                    $('#send_to_all').text('Sending...');
                    $('.overlay_ajax').show();
                },
                success: function(response) {
                    $('.overlay_ajax').hide();
                    if(response = '') {
                        $('#send_to_all').text('Send to all');
                        $('.send_all:nth-child(1) p').remove();
                        $('.send_all:nth-child(1)').append('<p class="alert alert-success col-sm-12">Mail Not Send Please try Again!! </p>');
                    }else {
                        $('#send_to_all').text('Send to all');
                        $('.send_all:nth-child(1) p').remove();
                        $('.send_all:nth-child(1)').append('<p class="alert alert-success col-sm-12">Invoices has been sent successfully. Please click <a href="send-mail.php"><strong>here</strong></a> to check any failed invoice.</p>');
                    }
                }
            });
        }
    });
});
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

    $("#credit_payment_table, #unsub_table_id, #invoice_history_table").DataTable();

    $("#excel_price").change(function(){
        $("#upload_payment_excel").submit();
    });
    
    $("#credit_excel").change(function(){
        $("#upload_credit_excel").submit();
    });

    var table = $('#uacc_billing_table').DataTable({
      "iDisplayLength": 100
      // 'processing': true,
      // 'serverSide': true,
      // 'serverMethod': 'post',
      // 'ajax': {
      //       'url':baseURL+'uacc-billing/ajaxData',
      //       "data": function ( d ) {
      //           d.Records = "uacc_billing_clients"
      //       }
      // },
      // 'columns': [
      //    { data: 'id_cc_newsletter' },
      //    { data: 'create_all' },
      //    { data: 'name' },
      //    { data: 'email' },
      //    { data: 'consultant_number' },
      //    { data: 'm_bill_date' },
      //    { data: 'account_balance' },
      //    { data: 'button1' },
      // ],
      // "iDisplayLength": 100,
      // 'aoColumnDefs': [{
      //      'bSortable': false,
      //      'aTargets': ['nosort']
      // }],
      // "dom": '<"top"f<"clear">>rt<"bottom"p<"clear">>'
    });
	

    var history_table = $('#uacc_billing_history_table').DataTable({
          "iDisplayLength": 100
          // 'processing': true,
          // 'serverSide': true,
          // 'serverMethod': 'post',
          // 'ajax': {
          //       'url':baseURL+'uacc-billing/billing-history-data',
          //       "data": function ( d ) {
          //           d.Records = "get_uacc_billing_history"
          //       }
          // },
          // 'columns': [
          //    { data: 'id_cc_newsletter' },
          //    { data: 'name' },
          //    { data: 'email' },
          //    { data: 'consultant_number' },
          //    { data: 'UACC_billing' },
          //    { data: 'account_balance' },
          //    { data: 'action' },
          // ],
          // "iDisplayLength": 100,
          //  'aoColumnDefs': [{
          //      'bSortable': false,
          //      'aTargets': ['nosort'],
          //   }],
          //   "dom": '<"top"lfip<"clear">>rt<"bottom"p<"clear">>'
        });
        

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

	$('#send_UACC_delete').click(function(){
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
                url: baseURL+'uacc-billing/delete-all-invoice',
                dataType: "text",
                data: {
                    delete_all:val
                },
                beforeSend: function() {
					$('.loading_img, .overlay_ajax').show();
                },
                success: function(response) {
                    $('.overlay_ajax p').text(response);
                    setTimeout(function() {
					    $('.loading_img, .overlay_ajax').hide();
					    $('.overlay_ajax p').text('Loading Please Wait...');
					    $('#del_all_UACC_invoice').modal('hide');
					 }, 3000);
                },
                
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
			});
		}

	});

	// Create all UACC Invoice with checkbox
    $('#create_all_UACC').click(function(event){
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
                url: baseURL + 'uacc-billing/get-all-invoice',
                datatype:'html',
                data: {
                    create_invoice:1,
                    ids:all_ids
                },
                beforeSend: function() {
                    $('.loading_img, .overlay_ajax').show();
                },
                success: function(response) {
                    $('.overlay_ajax').hide();
                    $('.success-msg').addClass('display-invoice');
                    $("#display_msg").append("Invoice send successfully!!");
                    $(".gif_image").css("display","none");
                    setTimeout(function() {
                        window.location.href = baseURL + "uacc-billing/clients";
                    }, 2000);
                },
                complete:function(data){
                  $('.loading_img, .overlay_ajax').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
        }
    });

    // Reset Balance with checkbox
    $('#reset_all_UACC').click(function(event){
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
                    url:  baseURL + "uacc-billing/reset-all-balance",
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
                            window.location.href = baseURL + "uacc-billing/clients";
                        }, 2000);
                    },
                    complete:function(data){
                      $(".overlay_ajax").hide();
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
                    $('.loading_img, .overlay_ajax').show();
                },
                success: function(response) {
                    $('.overlay_ajax').hide();
                    $('.success-msg').addClass('display-invoice');
                    $("#display_msg").append("Invoice send successfully!!");
                    $(".gif_image").css("display","none");
                    setTimeout(function() {
                        $(".success-msg").hide();
                        window.location.href =  baseURL + "uacc-billing/clients";
                    }, 2000);
                },
                complete:function(data){
                  $(".loading_img, .overlay_ajax").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
                }
            });
        }
    });

    $('#send_to_all_UACC').click(function(event){
        if(!confirm('Are you sure you want to send email to all clients?')) {
            event.preventDefault();
        }else {
            event.preventDefault();
             $('.send_all p').remove();
            $.ajax({
                type: "POST",
                url: baseURL + "uacc-billing/send-all-invoice-mail",
                data: { send_all:1 },
                beforeSend: function() {
                    $('#send_to_all_UACC').text('Sending...');
                    $('.overlay_ajax').show();
                },
                success: function(response) {
                    console.log(response);
                    $('.overlay_ajax').hide();
                    if(response = '') {
                        $('#send_to_all_UACC').text('Send to all');
                        $('.send_all:nth-child(1) p').remove();
                        $('.send_all:nth-child(1)').append('<p class="alert alert-success col-sm-12">Mail Not Send Please try Again!! </p>');
                    }else {
                        $('#send_to_all_UACC').text('Send to all');
                        $('.send_all:nth-child(1) p').remove();
                        $('.send_all:nth-child(1)').append('<p class="alert alert-success col-sm-12">Invoices has been sent successfully. Please click <a href="send-mail.php"><strong>here</strong></a> to check any failed invoice.</p>');
                    }
                }
            });
        }
    });

});
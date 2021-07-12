function nameSelect(val, i_id) {
    $("#search-box").val(val);
    $("#id_cc_newsletter").val(i_id);
    $("#suggesstion-box").hide();

    $.ajax({
        type: "POST",
        url: baseURL+"uacc-billing/search-name",
        data: 'id_cc_newsletter=' + i_id,
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $("#suggesstion-box").show();
            $("#email").val(data.email);
            $("#total").val(data.total);
            $("#special_creadit_val").val(data.special_creadit);
            $("#special_creadit_old").val(data.special_creadit);  
            $("#suggesstion-box").hide();
        }
    });

    $.ajax({
        type: "POST",
        url: baseURL+"uacc-billing/get-invoice-data",
        data: 'id_cc_newsletter=' + i_id,
        dataType: 'html',
        success: function(data) {
            jQuery('#tab_logic_sub').remove();
            jQuery('.add_sub_tab').append(data);
            
        }
    });
}

$(document).ready(function(){

    $('body').on('change', '#search-box', function(){
        var grandTotal = $('#total').val();
        var creditTotal = $('input[name="special_credit_val_total"]').val();
        var total = (parseFloat(grandTotal) - parseFloat(creditTotal));
        $('#special_creadit_val').val(creditTotal);
        $('#special_creadit_old').val(creditTotal);
        $('#total').val(total);
    });

    $("#search-box").keyup(function() {
        $.ajax({
            type: "POST",
            url:  baseURL+"uacc-billing/search-keyword",
            data: {keyword: $(this).val()},
            dataType: 'html',
            beforeSend: function() {
                $("#search-box").css("background", "#FFF url(../assets/images/LoaderIcon.gif) no-repeat 270px");
            },
            success: function(data) {
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#search-box").css("background", "#FFF");

            }
        });
    });

    $('#submit_form').click(function(event) {
        var total = $("#total").val();
        var id_cc_newsletter = $("#id_cc_newsletter").val();
        var clientname = $("#search-box").val();
        var email = $("#email").val();
        var In_date = $("#invoice_date").val();
        var IdInvoice = $('#id_cc_invoice').val();

        if (clientname == '') {
            $('#search-box').css("border", "2px solid red");
        } else{
            $('#search-box').css("border", "1px solid #ccc");
        }

        if (email == '') {
            $('#email').css("border", "2px solid red");
        } else{
            $('#email').css("border", "1px solid #ccc");
        }
       
        var form = $('#UACC_invoice_form');
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: baseURL+"uacc-billing/save-invoice",
            datatype:'html',
            data: {
                form_serial: form.serialize(),
                total_key: total,
                id_cc_newsletter: id_cc_newsletter,
                name: clientname,
                email: email,
                In_date:In_date,
                Id_Invoice: IdInvoice
            },
            beforeSend: function() {
                $('.overlay_ajax').show();
            },
            success: function(response) {
                $('.overlay_ajax').hide();
                $('.add_cc').addClass('display-msg');
                if(IdInvoice == ''){
                    $("#displaysuccessMessage").append("<p>Invoice created successfully!!</p>");
                }else{
                     $("#displaysuccessMessage").append("<p>Invoice updated successfully!!</p>");
                }
                setTimeout(function() {
                   window.location.href = baseURL+"uacc-billing/clients";
                }, 1000);
            }
        });
    });

        
   $('#addNew').click(function() {
        var count = $('#count_var').val();
        $('#tab_logic_sub tbody').append('<tr><td>'+count+'</td><td><input type="text" name="extra_name[]" value=""></td><td><input name="extra[]" type="text" value=""></td><td><input type="text" name="extra_val[]" value=""></td><td><input name="extra_val_total[]" type="text" value=""></td></tr>');
        count = Number(count) + Number(1);
        console.log(count);
        $('#count_var').val(count);
    });      

    $('body').on('change','input',function(){ 
        var total = 0; 
        if(typeof $('body input[name="customer_comm_val_total"]').val()  !== "undefined" ){
            total += parseFloat($('body input[name="customer_comm_val_total"]').val());
        }

        if(typeof $('body input[name="misc_charge_val_total"]').val()  !== "undefined" ){
            total += parseFloat($('body input[name="misc_charge_val_total"]').val());
        }

        if(typeof $('body input[name="prospect_system_val_total"]').val()  !== "undefined" ){
            total += parseFloat($('body input[name="prospect_system_val_total"]').val());
        }

        if(typeof $('body input[name="digital_biz_card_val_total"]').val()  !== "undefined" ){
            total += parseFloat($('body input[name="digital_biz_card_val_total"]').val());
        }

        if(typeof $('body input[name="extra_val_total[]"]').val()  !== "undefined" ){
            $('body input[name="extra_val_total[]"]').each(function( index ) {
                if($(this).val() == '') {
                    total += parseFloat(0); 
                }else {
                    total += parseFloat($(this).val());
                } 
            });
        }

        if(typeof $('body input[name="special_credit_val_total"]').val()  !== "undefined" ){
            total -= parseFloat($('body input[name="special_credit_val_total"]').val());
        }
        
        

        $('body input#total').val(parseFloat(total).toFixed(2));
    });
});
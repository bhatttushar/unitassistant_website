function nameSelect(val, i_id) {
    $("#search-box").val(val);
    $("#id_newsletter").val(i_id);
    $("#suggesstion-box").hide();

    $.ajax({
        type: "POST",
        url: baseURL+"billing/search-name",
        data: 'id_newsletter=' + i_id,
        dataType: 'json',
        success: function(data) {
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
        url: baseURL+"billing/get-invoice-data",
        data: 'id_newsletter=' + i_id,
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
            url:  baseURL+"billing/search-keyword",
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
        var id_newsletter = $("#id_newsletter").val();
        var clientname = $("#search-box").val();
        var email = $("#email").val();
        var In_date = $("#invoice_date").val();
        var IdInvoice = $('#id_invoice').val();

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
       
        var form = $('#invoice_form');
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: baseURL+"billing/save-invoice",
            datatype:'html',
            data: {
                form_serial: form.serialize(),
                total_key: total,
                id_newsletter: id_newsletter,
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
                   window.location.href = baseURL+"billing/clients";
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

    $('body').on('change', 'input[name="special_creadit_val"]', function(event){

        var unit = parseFloat($(this).val());
        if(isNaN(unit)) {
            unit = 0;
        }
        var old_val = $('body input[name="special_creadit_old"]').val();
        var total = parseFloat($('body input#total').val());
        
        $('body input[name="special_creadit_val"]').val(parseFloat(unit.toFixed(2)));

        $('body #total').val(parseFloat(total + old_val));
        $('body #total').val(parseFloat(total - unit));

        $('body input[name="special_creadit_old"]').val(unit);
    });

    $('body').on('change', 'input[name="package_value"]', function(event){
         var  unit_size = $(this).val();
         $('body input[name="package_value_total"]').val(unit_size);
    });

    $('body').on('change', 'input[name="facebook_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="facebook_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="facebook_everything_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="facebook_everything_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="emailing_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="emailing_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="email_newsletter_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="email_newsletter_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="digital_biz_card_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="digital_biz_card_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    
    $('body').on('change', 'input[name="canada_service_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="canada_service_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="total_text_program_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="total_text_program_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="total_text_program7_val"]', function(event){
        var unit = parseFloat($(this).val());
        $('body input[name="total_text_program7_val_total"]').val(parseFloat(unit.toFixed(2)));
            
    });

    $('body').on('change', 'input[name="text_email_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="text_email_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="other_language_newsletter_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="other_language_newsletter_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="prospect_system_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="prospect_system_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="magic_booker_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="magic_booker_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="personal_unit_app_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="personal_unit_app_val_total"]').val(parseFloat(unit.toFixed(2)));
    });
    $('body').on('change', 'input[name="personal_website_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="personal_website_val_total"]').val(parseFloat(unit.toFixed(2)));
    });
    $('body').on('change', 'input[name="personal_url_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="personal_url_val_total"]').val(parseFloat(unit.toFixed(2)));
    });
    $('body').on('change', 'input[name="subscription_updates_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="subscription_updates_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="app_color_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="app_color_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="own_text_number_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="own_text_number_val_total"]').val(parseFloat(unit.toFixed(2)));
            
    });

    $('body').on('change', 'input[name="director_access_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="director_access_val_total"]').val(parseFloat(unit.toFixed(2)));
    });

    $('body').on('change', 'input[name="texting_val"]', function(event){
            var unit = parseFloat($(this).val());
            $('body input[name="texting_val_total"]').val(parseFloat(unit.toFixed(2)));
    });
    
//------------------------------------------------------------------------------------------------------------------

    $('body').on('change', 'input[name="newsletter_color"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="newsletter_color_val"]').val());
            $('body input[name="newsletter_color_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="newsletter_black_white"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="newsletter_black_white_val"]').val());
            $('body input[name="newsletter_black_white_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="month_packet_postage"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="month_packet_postage_val"]').val());
            $('body input[name="month_packet_postage_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="consultant_packet_postage"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="consultant_packet_postage_val"]').val());
            $('body input[name="consultant_packet_postage_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="consultant_bundles"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="consultant_bundles_val"]').val());
            $('body input[name="consultant_bundles_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="consistency_gift"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="consistency_gift_val"]').val());
            $('body input[name="consistency_gift_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="reds_program_gift"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="reds_program_gift_val"]').val());
            $('body input[name="reds_program_gift_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="stars_program_gift"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="stars_program_gift_val"]').val());
            $('body input[name="stars_program_gift_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="gift_wrap_postpage"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="gift_wrap_postpage_val"]').val());
            $('body input[name="gift_wrap_postpage_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="one_rate_postpage"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="one_rate_postpage_val"]').val());
            $('body input[name="one_rate_postpage_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="month_blast_flyer"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="month_blast_flyer_val"]').val());
            $('body input[name="month_blast_flyer_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="flyer_ecard_unit"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="flyer_ecard_unit_val"]').val());
            $('body input[name="flyer_ecard_unit_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="unit_challenge_flyer"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="unit_challenge_flyer_val"]').val());
            $('body input[name="unit_challenge_flyer_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="team_building_flyer"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="team_building_flyer_val"]').val());
            $('body input[name="team_building_flyer_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="wholesale_promo_flyer"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="wholesale_promo_flyer_val"]').val());
            $('body input[name="wholesale_promo_flyer_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="postcard_design"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="postcard_design_val"]').val());
            $('body input[name="postcard_design_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="postcard_edit"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="postcard_edit_val"]').val());
            $('body input[name="postcard_edit_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="ecard_unit"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="ecard_unit_val"]').val());
            $('body input[name="ecard_unit_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="speciality_postcard"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="speciality_postcard_val"]').val());
            $('body input[name="speciality_postcard_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="card_with_gift"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="card_with_gift_val"]').val());
            $('body input[name="card_with_gift_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="greeting_card"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="greeting_card_val"]').val());
            $('body input[name="greeting_card_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="birthday_brownie"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="birthday_brownie_val"]').val());
            $('body input[name="birthday_brownie_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="birthday_starbucks"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="birthday_starbucks_val"]').val());
            $('body input[name="birthday_starbucks_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="anniversary_starbucks"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="anniversary_starbucks_val"]').val());
            $('body input[name="anniversary_starbucks_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="referral_credit"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="referral_credit_val"]').val());
            $('body input[name="referral_credit_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="cc_billing"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="cc_billing_val"]').val());
            $('body input[name="cc_billing_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="customer_newsletter"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="customer_newsletter_val"]').val());
            $('body input[name="customer_newsletter_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="birthday_postcard"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="birthday_postcard_val"]').val());
            $('body input[name="birthday_postcard_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="anniversary_postcard"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="anniversary_postcard_val"]').val());
            $('body input[name="anniversary_postcard_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="picture_texting"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="picture_texting_val"]').val());
            $('body input[name="picture_texting_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="keyword"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="keyword_val"]').val());
            $('body input[name="keyword_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="client_setup"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="client_setup_val"]').val());
            $('body input[name="client_setup_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="nl_flyer"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="nl_flyer_val"]').val());
            $('body input[name="nl_flyer_val_total"]').val(unit*val);
    });

    $('body').on('change', 'input[name="month_blast_flyer"]', function(event){
            var unit = parseInt($(this).val());
            var val = parseFloat($('body [name="month_blast_flyer_val"]').val());
            $('body input[name="month_blast_flyer_val_total"]').val(unit*val);
    });
        
    $('body').on('change','#tab_logic_sub input',function(){ 
        var total = 0;

        if(typeof $('body input[name="special_credit_val_total"]').val()  !== "undefined" && $('body input[name="special_credit_val_total"]').val() != ''){
            total -= parseFloat($('body input[name="special_credit_val_total"]').val());
        }
        if(typeof $('body input[name="facebook_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="facebook_val_total"]').val());                
        }

        if(typeof $('body input[name="facebook_everything_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="facebook_everything_val_total"]').val());                
        }

        if(typeof $('body input[name="emailing_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="emailing_val_total"]').val());                
        }
        if(typeof $('body input[name="email_newsletter_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="email_newsletter_val_total"]').val());                
        }

        if(typeof $('body input[name="digital_biz_card_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="digital_biz_card_val_total"]').val());                
        }

        
        if(typeof $('body input[name="canada_service_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="canada_service_val_total"]').val());                
        }
        
        if(typeof $('body input[name="text_email_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="text_email_val_total"]').val());                
        }
        if(typeof $('body input[name="other_language_newsletter_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="other_language_newsletter_val_total"]').val());                
        }
        if(typeof $('body input[name="magic_booker_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="magic_booker_val_total"]').val());                
        }
        if(typeof $('body input[name="prospect_system_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="prospect_system_val_total"]').val());                
        }
        
        if(typeof $('body input[name="own_text_number_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="own_text_number_val_total"]').val());                
        }
        if(typeof $('body input[name="package_value_total"]').val()  !== "undefined" && $('body input[name="package_value_total"]').val()  != ''){
            total += parseFloat($('body input[name="package_value_total"]').val());                
        }else {
            $('body input[name="package_value_total"]').val(0);
        }
        if(typeof $('body input[name="newsletter_color_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="newsletter_color_val_total"]').val());                
        }
        if(typeof $('body input[name="newsletter_black_white_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="newsletter_black_white_val_total"]').val());                
        }
        if(typeof $('body input[name="month_packet_postage_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="month_packet_postage_val_total"]').val());                
        }
        if(typeof $('body input[name="consultant_packet_postage_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="consultant_packet_postage_val_total"]').val());                
        }
        
        if(typeof $('body input[name="consultant_bundles_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="consultant_bundles_val_total"]').val());                
        }
        if(typeof $('body input[name="consistency_gift_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="consistency_gift_val_total"]').val());                
        }
        if(typeof $('body input[name="reds_program_gift_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="reds_program_gift_val_total"]').val());                
        }
        if(typeof $('body input[name="stars_program_gift_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="stars_program_gift_val_total"]').val());                
        }
        if(typeof $('body input[name="gift_wrap_postpage_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="gift_wrap_postpage_val_total"]').val());                
        }
        if(typeof $('body input[name="one_rate_postpage_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="one_rate_postpage_val_total"]').val());                
        }
        if(typeof $('body input[name="month_blast_flyer_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="month_blast_flyer_val_total"]').val());                
        }
        if(typeof $('body input[name="flyer_ecard_unit_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="flyer_ecard_unit_val_total"]').val());                
        }
        if(typeof $('body input[name="unit_challenge_flyer_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="unit_challenge_flyer_val_total"]').val());                
        }
        if(typeof $('body input[name="team_building_flyer_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="team_building_flyer_val_total"]').val());                
        }
        if(typeof $('body input[name="wholesale_promo_flyer_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="wholesale_promo_flyer_val_total"]').val());                
        }
        if(typeof $('body input[name="postcard_design_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="postcard_design_val_total"]').val());                
        }
        if(typeof $('body input[name="postcard_edit_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="postcard_edit_val_total"]').val());                
        }
        
        if(typeof $('body input[name="ecard_unit_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="ecard_unit_val_total"]').val());                
        }
        if(typeof $('body input[name="speciality_postcard_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="speciality_postcard_val_total"]').val());                
        }
        if(typeof $('body input[name="card_with_gift_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="card_with_gift_val_total"]').val());                
        }
        if(typeof $('body input[name="greeting_card_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="greeting_card_val_total"]').val());                
        }
        if(typeof $('body input[name="birthday_brownie_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="birthday_brownie_val_total"]').val());                
        }
        if(typeof $('body input[name="birthday_starbucks_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="birthday_starbucks_val_total"]').val());                
        }
        
        if(typeof $('body input[name="anniversary_starbucks_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="anniversary_starbucks_val_total"]').val());                
        }
        
        if(typeof $('body input[name="cc_billing_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="cc_billing_val_total"]').val());                
        }
        if(typeof $('body input[name="customer_newsletter_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="customer_newsletter_val_total"]').val());                
        }
        if(typeof $('body input[name="birthday_postcard_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="birthday_postcard_val_total"]').val());                
        }
        if(typeof $('body input[name="anniversary_postcard_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="anniversary_postcard_val_total"]').val());                
        }
        if(typeof $('body input[name="picture_texting_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="picture_texting_val_total"]').val());                
        }
        if(typeof $('body input[name="keyword_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="keyword_val_total"]').val());                
        }
        if(typeof $('body input[name="client_setup_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="client_setup_val_total"]').val());                
        }
        
        if(typeof $('body input[name="nl_flyer_val_total"]').val() !== "undefined"){
            total += parseFloat($('body input[name="nl_flyer_val_total"]').val());                
        }
        if(typeof $('body input[name="total_text_program_val_total"]').val() !== "undefined"){
            total += parseFloat($('body input[name="total_text_program_val_total"]').val());                
        }

        if(typeof $('body input[name="total_text_program7_val_total"]').val() !== "undefined"){
            total += parseFloat($('body input[name="total_text_program7_val_total"]').val());                
        }

        if(typeof $('body input[name="texting_val_total"]').val() !== "undefined"){
            total += parseFloat($('body input[name="texting_val_total"]').val());                
        }

        if(typeof $('body input[name="director_access_val_total"]').val() !== "undefined"){
            total += parseFloat($('body input[name="director_access_val_total"]').val());                
        }

        if(typeof $('body input[name="subscription_updates_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="subscription_updates_val_total"]').val()); 
        }

        if(typeof $('body input[name="app_color_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="app_color_val_total"]').val()); 
        }
        
        if(typeof $('body input[name="personal_url_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="personal_url_val_total"]').val());                
        }
        
        if(typeof $('body input[name="personal_unit_app_val_total"]').val()  !== "undefined"){  
            total += parseFloat($('body input[name="personal_unit_app_val_total"]').val());
        }
        
        if(typeof $('body input[name="personal_website_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="personal_website_val_total"]').val());
        }
        
        if(typeof $('body input[name="misc_charge_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="misc_charge_val_total"]').val());
        }

        if(typeof $('body input[name="cc_charge_val_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="cc_charge_val_total"]').val());
        }

        if(typeof $('body input[name="special_creadit_val"]').val()  !== "undefined" && $('body input[name="special_creadit_val"]').val() != ''){
            total -= parseFloat($('body input[name="special_creadit_val"]').val());
        }
        if(typeof $('body input[name="referral_credit_val_total"]').val()  !== "undefined"){
            total -= parseFloat($('body input[name="referral_credit_val_total"]').val());                
        }
        if(typeof $('body input[name="credit_roll_over_total"]').val()  !== "undefined"){
            total += parseFloat($('body input[name="credit_roll_over_total"]').val());                
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
        
        $('body input#total').val(parseFloat(total).toFixed(2));
    });
});
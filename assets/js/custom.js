$(document).ready(function(){ 
  $(".js-example-basic-multiple").select2({
    placeholder: "Click to select a user"
  });

  $(".js-example-basic-multiple").on("select2:select", function (e) { 
      var select_val = $(e.currentTarget).val();
      $(".hidden-user").val(select_val);
  });

});

$(document).ready(function() {  

  $("input[name=name]").change(function(){
    $("#name_val").text('');
    var name = $("#client_name").val();
    $("#name_val").text(name);
    $("#name_client").val(name);
    var Biz_link = 'www.unitassist.com/';
    var BIX = $(this).val().replace(/ /g,'')
    $('#buzz_link').val(Biz_link+BIX);
  });

  var total_text_program = $("#hidden_total_text").val();
  if(total_text_program == 1){
    $("input[name=texting]").attr('disabled',true);
    $("input[name=economy]").attr('disabled',true);
  }else{
    $("input[name=texting]").attr('disabled',false);
    $("input[name=economy]").attr('disabled',false);
  }
  var texting = $("input[name=texting]:checked").val();
  var data = $("input[name=package]:checked").val();
  if((data == 'E1') && (texting == 'Y')){
    $("#economy_div").show();
  }else{
    $("#economy_div").hide();
  }
  var unit = $("#unit_size").val();
  if(unit == ''){
    $("input[name=package]").attr("disabled",true);
    $('input[name=package][value=N]').attr("disabled",false);
    $('input[name=package][value=N]').attr("checked", "checked");;
  }

  $("input[type=checkbox]:not('.notget'),input[type=radio]:not(input[name=select_email])").change(function(){
    recalculate();
  });

  $("input[name=unit_size]").keyup(function(){
    var unit = $("#unit_size").val()
    if(unit == '') {
      $('#error').html("Please enter your actual unit size!!");
      $("input[name=package]").attr("disabled",true);
      $(".package_value").val('');
      var texting = $("input[name=texting]:checked").val();
      var data = $("input[name=package]:checked").val();
        var package = $(".package_value").val();
        var subpack = $(".sub_total").val();
        var emailing = $("input[name='emailing']:checked").val();
        var point = $("#unit_size").val();
        
        if(package != ''){
        $(".package_value").val('');
        $("#hidden_package").val('');
      }
      
      if($('[name="facebook"]').is(':checked')){
        facebook = facebook_val;
      }else{
        facebook = 0;
      }

      if($('[name="facebook_everything"]').is(':checked')){
        facebook_everything = facebook_everything_val;
      }else{
        facebook_everything = 0;
      }

      if($('[name="email_newsletter"]').is(':checked')){
        newsletter = newsletter_val;
      }else{
        newsletter = 0;
      }

      if($('[name="digital_biz_card"]').is(':checked')){
        digital_biz = biz_card_val;
      }else{
        digital_biz = 0;
      }

      
      if($('[name="canada_service"]').is(':checked')){
        canadaService = canada_service_val;
      }else{
        canadaService = 0;
      }

      if($('[name="other_language_newsletter"]').is(':checked')){
        other_language_newsletter = other_language_newsletter_val;
      }else{
        other_language_newsletter = 0;
      }

      if($('[name="prospect_system"]').is(':checked')){
        prospect_system = prospect_system_val;
      }else{
        prospect_system = 0;
      }

      if($('[name="magic_booker"]').is(':checked')){
        magic_booker = magic_booker_val;
      }else{
        magic_booker = 0;
      }

      newsletter_color = $('[name="newsletter_color"]').val();
      if(newsletter_color != ''){
        newsletter_color = newsletter_color * parseFloat(newsletter_color_constant_val);
      }else{
        newsletter_color = 0;
      }

      newsletter_black_white = $('[name="newsletter_black_white"]').val();
      if(newsletter_black_white != ''){
        newsletter_black_white = newsletter_black_white * parseFloat(newsletter_black_white_constant_val);
      }else{
        newsletter_black_white = 0;
      }

      month_packet_postage = $('[name="month_packet_postage"]').val();
      if(month_packet_postage != ''){
        month_packet_postage = month_packet_postage * parseFloat(month_packet_postage_constant_val);
      }else{
        month_packet_postage = 0;
      }

      consultant_packet_postage = $('[name="consultant_packet_postage"]').val();
      if(consultant_packet_postage != ''){
        consultant_packet_postage = consultant_packet_postage * parseFloat(consultant_packet_postage_constant_val);
      }else{
        consultant_packet_postage = 0;
      }
      
      consultant_bundles = $('[name="consultant_bundles"]').val();
      if(consultant_bundles != ''){
        consultant_bundles = consultant_bundles * parseFloat(consultant_bundles_constant_val);
      }else{
        consultant_bundles = 0;
      }

      consistency_gift = $('[name="consistency_gift"]').val();
      if(consistency_gift != ''){
        consistency_gift = consistency_gift * parseInt(consistency_gift_constant_val);
      }else{
        consistency_gift = 0;
      }

      reds_program_gift = $('[name="reds_program_gift"]').val();
      if(reds_program_gift != ''){
        reds_program_gift = reds_program_gift * parseInt(reds_program_gift_constant_val);
      }else{
        reds_program_gift = 0;
      }

      stars_program_gift = $('[name="stars_program_gift"]').val();
      if(stars_program_gift != ''){
        stars_program_gift = stars_program_gift * parseInt(stars_program_gift_constant_val);
      }else{
        stars_program_gift = 0;
      }

      gift_wrap_postpage = $('[name="gift_wrap_postpage"]').val();
      if(gift_wrap_postpage != ''){
        gift_wrap_postpage = gift_wrap_postpage * parseFloat(gift_wrap_postpage_constant_val);
      }else{
        gift_wrap_postpage = 0;
      }

      one_rate_postpage = $('[name="one_rate_postpage"]').val();
      if(one_rate_postpage != ''){
        one_rate_postpage = one_rate_postpage * parseFloat(one_rate_postpage_constant_val);
      }else{
        one_rate_postpage = 0;
      }

      month_blast_flyer = $('[name="month_blast_flyer"]').val();
      if(month_blast_flyer != ''){
        month_blast_flyer = month_blast_flyer * parseFloat(month_blast_flyer_constant_val);
      }else{
        month_blast_flyer = 0;
      }

      nl_flyer = $('[name="nl_flyer"]').val();
      if(nl_flyer != ''){
        nl_flyer = nl_flyer * parseFloat(nl_flyer_constant_val);
      }else{
        nl_flyer = 0;
      }         

      flyer_ecard_unit = $('[name="flyer_ecard_unit"]').val();
      if(flyer_ecard_unit != ''){
        flyer_ecard_unit = flyer_ecard_unit * parseFloat(flyer_ecard_unit_constant_val);
      }else{
        flyer_ecard_unit = 0;
      }

      unit_challenge_flyer = $('[name="unit_challenge_flyer"]').val();
      if(unit_challenge_flyer != ''){
        unit_challenge_flyer = unit_challenge_flyer * parseFloat(unit_challenge_flyer_constant_val);
      }else{
        unit_challenge_flyer = 0;
      }

      team_building_flyer = $('[name="team_building_flyer"]').val();
      if(team_building_flyer != ''){
        team_building_flyer = team_building_flyer * parseFloat(team_building_flyer_constant_val);
      }else{
        team_building_flyer = 0;
      }

      wholesale_promo_flyer = $('[name="wholesale_promo_flyer"]').val();
      if(wholesale_promo_flyer != ''){
        wholesale_promo_flyer = wholesale_promo_flyer * parseFloat(wholesale_promo_flyer_constant_val);
      }else{
        wholesale_promo_flyer = 0;
      }

      postcard_design = $('[name="postcard_design"]').val();
      if(postcard_design != ''){
        postcard_design = postcard_design * parseFloat(postcard_design_constant_val);
      }else{
        postcard_design = 0;
      }

      postcard_edit = $('[name="postcard_edit"]').val();
      if(postcard_edit != ''){
        postcard_edit = postcard_edit * parseFloat(postcard_edit_constant_val);
      }else{
        postcard_edit = 0;
      }

      ecard_unit = $('[name="ecard_unit"]').val();
      if(ecard_unit != ''){
        ecard_unit = ecard_unit * parseFloat(ecard_unit_constant_val);
      }else{
        ecard_unit = 0;
      }

      speciality_postcard = $('[name="speciality_postcard"]').val();
      if(speciality_postcard != ''){
        speciality_postcard = speciality_postcard * parseFloat(speciality_postcard_constant_val);
      }else{
        speciality_postcard = 0;
      }

      card_with_gift = $('[name="card_with_gift"]').val();
      if(card_with_gift != ''){
        card_with_gift = card_with_gift * parseFloat(card_with_gift_constant_val);
      }else{
        card_with_gift = 0;
      }

      greeting_card = $('[name="greeting_card"]').val();
      if(greeting_card != ''){
        greeting_card = greeting_card * parseFloat(greeting_card_constant_val);
      }else{
        greeting_card = 0;
      }

      birthday_brownie = $('[name="birthday_brownie"]').val();
      if(birthday_brownie != ''){
        birthday_brownie = birthday_brownie * parseFloat(birthday_brownie_constant_val);
      }else{
        birthday_brownie = 0;
      }

      birthday_starbucks = $('[name="birthday_starbucks"]').val();
      if(birthday_starbucks != ''){
        birthday_starbucks = birthday_starbucks * parseFloat(birthday_starbucks_constant_val);
      }else{
        birthday_starbucks = 0;
      }

      anniversary_starbucks = $('[name="anniversary_starbucks"]').val();
      if(anniversary_starbucks != ''){
        anniversary_starbucks = anniversary_starbucks  * parseFloat(anniversary_starbucks_constant_val);
      }else{
        anniversary_starbucks = 0;
      }

      referral_credit = $('[name="referral_credit"]').val();
      if(referral_credit != ''){
        referral_credit = referral_credit * parseFloat(referral_credit_constant_val);
      }else{
        referral_credit = 0;
      }
      
      cc_billing = $('[name="cc_billing"]').val();
      if(cc_billing != ''){
        cc_billing = cc_billing * parseFloat(cc_billing_constant_val);
      }else{
        cc_billing = 0;
      }

      customer_newsletter = $('[name="customer_newsletter"]').val();
      if(customer_newsletter != ''){
        customer_newsletter = customer_newsletter * parseFloat(customer_newsletter_constant_val);
      }else{
        customer_newsletter = 0;
      }

      picture_texting = $('[name="picture_texting"]').val();
      if(picture_texting != ''){
        picture_texting = picture_texting * parseFloat(picture_texting_constant_val);
      }else{
        picture_texting = 0;
      }

      keyword = $('[name="keyword"]').val();
      if(keyword != ''){
        keyword = keyword * parseFloat(keyword_constant_val);
      }else{
        keyword = 0;
      }

      client_setup = $('[name="client_setup"]').val();
      if(client_setup != ''){
        client_setup = client_setup * parseFloat(client_setup_constant_val);
      }else{
        client_setup = 0;
      }

      if(emailing == '1'){
        email = email_val_1;
      }else if(emailing == '2'){
        email = email_val_2;
      }else{
        email=0;
      }
      var sumemailPearl = Number(email) + Number(newsletter)+ Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(other_language_newsletter)+ Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles)+ Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage)+ Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit)+ Number(cc_billing)+ Number(customer_newsletter)+Number(picture_texting)+Number(keyword)+Number(client_setup)+ Number(nl_flyer);
      var sumemail = Number(email) + Number(newsletter) + Number(digital_biz)+ Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker) + Number(other_language_newsletter) + Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles) + Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage)+ Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit)+ Number(cc_billing)+ Number(customer_newsletter)+Number(picture_texting)+Number(keyword)+Number(client_setup)+ Number(nl_flyer);
      
      var subPearl = Number(email) + Number(newsletter) + Number(digital_biz) + Number(canadaService)  + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker) + Number(other_language_newsletter);
      var submail = Number(email) + Number(newsletter) + Number(digital_biz) +  Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker) + Number(other_language_newsletter);
      
      if($('[name="total_text_program7"]').is(':checked')) {
        var package = $(".package_value").val();
        if(packageval == 'N' || packageval == undefined) {
          packagedata = Number(package.toFixed(2)) + Number(total_text_program7_N);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            subpackval = Number(subpack.toFixed(2)) + Number(total_text_program7_N);
            $(".sub_total").val(subpackval.toFixed(2));
            $("input.sub_total").val(subpackval.toFixed(2));

        }else if(packageval == 'P') {
          var packagedata = Number(package.toFixed(2)) + Number(total_text_program7_P);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var subpackval = Number(subpack.toFixed(2)) + Number(total_text_program7_P);
            $(".sub_total").val(subpackval.toFixed(2));
            $("input.sub_total").val(subpackval.toFixed(2));

        }else {
            var packagedata = Number(total_text_program7_Y) +  Number(package.toFixed(2));
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var subpackval = Number(total_text_program7_Y) +  Number(subpack.toFixed(2));
            $(".sub_total").val(subpackval.toFixed(2));
            $("input.sub_total").val(subpackval.toFixed(2));
          }
      }


      if($('[name="total_text_program"]').is(':checked')) {
        if(packageval == 'N' || packageval == undefined){
          packagedata = Number(package.toFixed(2));
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));
            subpackval = Number(subpack.toFixed(2));
            $(".sub_total").val(subpackval.toFixed(2));
            $("input.sub_total").val(subpackval.toFixed(2));
        }else if(packageval == 'D' || packageval == 'E' || packageval == 'P'){
          var packagedata = Number(total_text_program_D_E_P) +  Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2)); 
            var subpackval = Number(total_text_program_D_E_P) +  Number(subpack.toFixed(2));
            $(".sub_total").val(subpackval.toFixed(2));
            $("input.sub_total").val(subpackval.toFixed(2));
          }else{
            var packagedata = Number(total_text_program_other) +  Number(package.toFixed(2));
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var subpackval = Number(total_text_program_other) +  Number(subpack.toFixed(2));
            $(".sub_total").val(subpackval.toFixed(2));
            $("input.sub_total").val(subpackval.toFixed(2));
          }
      }else{
          package = $(".package_value").val();
          var packagedata = Number(package.toFixed(2)) + Number(sumemail);
          $(".package_value").val(packagedata.toFixed(2));
          $("#hidden_package").val(packagedata.toFixed(2));
        
          subpack = $(".sub_total").val();
          var packagedata2 = Number(subpack.toFixed(2)) + Number(submail);
          $(".sub_total").val(packagedata2.toFixed(2));
          $("input.sub_total").val(packagedata2.toFixed(2));
      }   
    }else {
      $('#error').html("");
      if(unit != "")  {
          var value = $('#unit_size').val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
          var intRegex = /^\d+$/;
          if(!intRegex.test(value)) {
              $('#error').html("Please enter numeric values between 0 to 300!!");
              $("input[name=package]").attr("disabled",true);
          } else if(unit>300){
          $('#error').html("Please enter value between 0-300!!");
          $("input[name=package]").attr("disabled",true);
        }else{
          $('#error').html("");
          $("input[name=package]").attr("disabled",false);
          var data = $("input[name=package]:checked").val();
            var package = $(".package_value").val();
            var subpack = $(".sub_total").val();
            var emailing = $("input[name=emailing]:checked").val();
            var point = $("#unit_size").val();
            if(package != ''){
            $(".package_value").val('');
            $("#hidden_package").val('');

            $(".sub_total").val('');
            $("input.sub_total").val('');
          }
          
          if($('[name="facebook"]').is(':checked')){
            facebook = facebook_val;
          }else{
            facebook = 0;
          }

          if($('[name="facebook_everything"]').is(':checked')){
            facebook_everything = facebook_everything_val;
          }else{
            facebook_everything = 0;
          }

          if($('[name="email_newsletter"]').is(':checked')){
            newsletter = newsletter_val;
          }else{
            newsletter = 0;
          }

          if($('[name="digital_biz_card"]').is(':checked')){
            digital_biz = biz_card_val;
          }else{
            digital_biz = 0;
          }

          if($('[name="canada_service"]').is(':checked')){
            canadaService = canada_service_val;
          }else{
            canadaService = 0;
          }

          if($('[name="other_language_newsletter"]').is(':checked')){
            other_language_newsletter = other_language_newsletter_val;
          }else{
            other_language_newsletter = 0;
          }

          if($('[name="prospect_system"]').is(':checked')){
            prospect_system = prospect_system_val;
          }else{
            prospect_system = 0;
          }

          if($('[name="magic_booker"]').is(':checked')){
            magic_booker = magic_booker_val;
          }else{
            magic_booker = 0;
          }

          newsletter_color = $('[name="newsletter_color"]').val();
          if(newsletter_color != ''){
            newsletter_color = newsletter_color * parseFloat(newsletter_color_constant_val);
          }else{
            newsletter_color = 0;
          }

          newsletter_black_white = $('[name="newsletter_black_white"]').val();
          if(newsletter_black_white != ''){
            newsletter_black_white = newsletter_black_white * parseFloat(newsletter_black_white_constant_val);
          }else{
            newsletter_black_white = 0;
          }

          month_packet_postage = $('[name="month_packet_postage"]').val();
          if(month_packet_postage != ''){
            month_packet_postage = month_packet_postage * parseFloat(month_packet_postage_constant_val);
          }else{
            month_packet_postage = 0;
          }

          consultant_packet_postage = $('[name="consultant_packet_postage"]').val();
          if(consultant_packet_postage != ''){
            consultant_packet_postage=consultant_packet_postage*parseFloat(consultant_packet_postage_constant_val);
          }else{
            consultant_packet_postage = 0;
          }

          consultant_bundles = $('[name="consultant_bundles"]').val();
          if(consultant_bundles != ''){
            consultant_bundles = consultant_bundles * parseFloat(consultant_bundles_constant_val);
          }else{
            consultant_bundles = 0;
          }

          consistency_gift = $('[name="consistency_gift"]').val();
          if(consistency_gift != ''){
            consistency_gift = consistency_gift * parseInt(consistency_gift_constant_val);
          }else{
            consistency_gift = 0;
          }

          reds_program_gift = $('[name="reds_program_gift"]').val();
          if(reds_program_gift != ''){
            reds_program_gift = reds_program_gift * parseInt(reds_program_gift_constant_val);
          }else{
            reds_program_gift = 0;
          }

          stars_program_gift = $('[name="stars_program_gift"]').val();
          if(stars_program_gift != ''){
            stars_program_gift = stars_program_gift * parseInt(stars_program_gift_constant_val);
          }else{
            stars_program_gift = 0;
          }

          gift_wrap_postpage = $('[name="gift_wrap_postpage"]').val();
          if(gift_wrap_postpage != ''){
            gift_wrap_postpage = gift_wrap_postpage * parseFloat(gift_wrap_postpage_constant_val);
          }else{
            gift_wrap_postpage = 0;
          }

          one_rate_postpage = $('[name="one_rate_postpage"]').val();
          if(one_rate_postpage != ''){
            one_rate_postpage = one_rate_postpage * parseFloat(one_rate_postpage_constant_val);
          }else{
            one_rate_postpage = 0;
          }

          month_blast_flyer = $('[name="month_blast_flyer"]').val();
          if(month_blast_flyer != ''){
            month_blast_flyer = month_blast_flyer * parseFloat(month_blast_flyer_constant_val);
          }else{
            month_blast_flyer = 0;
          }

          nl_flyer = $('[name="nl_flyer"]').val();
          if(nl_flyer != ''){
            nl_flyer = nl_flyer * parseFloat(nl_flyer_constant_val);
          }else{
            nl_flyer = 0;
          }

          flyer_ecard_unit = $('[name="flyer_ecard_unit"]').val();
          if(flyer_ecard_unit != ''){
            flyer_ecard_unit = flyer_ecard_unit * parseFloat(flyer_ecard_unit_constant_val);
          }else{
            flyer_ecard_unit = 0;
          }

          unit_challenge_flyer = $('[name="unit_challenge_flyer"]').val();
          if(unit_challenge_flyer != ''){
            unit_challenge_flyer = unit_challenge_flyer * parseFloat(unit_challenge_flyer_constant_val);
          }else{
            unit_challenge_flyer = 0;
          }

          team_building_flyer = $('[name="team_building_flyer"]').val();
          if(team_building_flyer != ''){
            team_building_flyer = team_building_flyer * parseFloat(team_building_flyer_constant_val);
          }else{
            team_building_flyer = 0;
          }

          wholesale_promo_flyer = $('[name="wholesale_promo_flyer"]').val();
          if(wholesale_promo_flyer != ''){
            wholesale_promo_flyer = wholesale_promo_flyer * parseFloat(wholesale_promo_flyer_constant_val);
          }else{
            wholesale_promo_flyer = 0;
          }

          postcard_design = $('[name="postcard_design"]').val();
          if(postcard_design != ''){
            postcard_design = postcard_design * parseFloat(postcard_design_constant_val);
          }else{
            postcard_design = 0;
          }

          postcard_edit = $('[name="postcard_edit"]').val();
          if(postcard_edit != ''){
            postcard_edit = postcard_edit * parseFloat(postcard_edit_constant_val);
          }else{
            postcard_edit = 0;
          }

          ecard_unit = $('[name="ecard_unit"]').val();
          if(ecard_unit != ''){
            ecard_unit = ecard_unit * parseFloat(ecard_unit_constant_val);
          }else{
            ecard_unit = 0;
          }

          speciality_postcard = $('[name="speciality_postcard"]').val();
          if(speciality_postcard != ''){
            speciality_postcard = speciality_postcard * parseFloat(speciality_postcard_constant_val);
          }else{
            speciality_postcard = 0;
          }

          card_with_gift = $('[name="card_with_gift"]').val();
          if(card_with_gift != ''){
            card_with_gift = card_with_gift * parseFloat(card_with_gift_constant_val);
          }else{
            card_with_gift = 0;
          }

          greeting_card = $('[name="greeting_card"]').val();
          if(greeting_card != ''){
            greeting_card = greeting_card * parseFloat(greeting_card_constant_val);
          }else{
            greeting_card = 0;
          }

          birthday_brownie = $('[name="birthday_brownie"]').val();
          if(birthday_brownie != ''){
            birthday_brownie = birthday_brownie * parseFloat(birthday_brownie_constant_val);
          }else{
            birthday_brownie = 0;
          }

          birthday_starbucks = $('[name="birthday_starbucks"]').val();
          if(birthday_starbucks != ''){
            birthday_starbucks = birthday_starbucks * parseFloat(birthday_starbucks_constant_val);
          }else{
            birthday_starbucks = 0;
          }

          anniversary_starbucks = $('[name="anniversary_starbucks"]').val();
          if(anniversary_starbucks != ''){
            anniversary_starbucks = anniversary_starbucks  * parseFloat(anniversary_starbucks_constant_val);
          }else{
            anniversary_starbucks = 0;
          }

          referral_credit = $('[name="referral_credit"]').val();
          if(referral_credit != ''){
            referral_credit = referral_credit * parseFloat(referral_credit_constant_val);
          }else{
            referral_credit = 0;
          }
          
          cc_billing = $('[name="cc_billing"]').val();
          if(cc_billing != ''){
            cc_billing = cc_billing * parseFloat(cc_billing_constant_val);
          }else{
            cc_billing = 0;
          }

          customer_newsletter = $('[name="customer_newsletter"]').val();
          if(customer_newsletter != ''){
            customer_newsletter = customer_newsletter * parseFloat(customer_newsletter_constant_val);
          }else{
            customer_newsletter = 0;
          }
          
          picture_texting = $('[name="picture_texting"]').val();
          if(picture_texting != ''){
            picture_texting = picture_texting * parseFloat(picture_texting_constant_val);
          }else{
            picture_texting = 0;
          }

          keyword = $('[name="keyword"]').val();
          if(keyword != ''){
            keyword = keyword * parseFloat(keyword_constant_val);
          }else{
            keyword = 0;
          }

          client_setup = $('[name="client_setup"]').val();
          if(client_setup != ''){
            client_setup = client_setup * parseFloat(client_setup_constant_val);
          }else{
            client_setup = 0;
          }
          
          
          if(emailing == '1'){
            email = email_val_1;
          }else if(emailing == '2'){
            email = email_val_2;
          }else{
            email=0;
          } 
          var sumemailPearl = Number(email) + Number(newsletter) + Number(digital_biz) +  Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker) + Number(other_language_newsletter)+ Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles)+ Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage)+ Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit)+ Number(cc_billing)+ Number(customer_newsletter)+ Number(picture_texting)+ Number(keyword)+ Number(client_setup) + Number(nl_flyer);
          var sumemail = Number(email) + Number(newsletter) + Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles)+ Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage)+ Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit)+ Number(cc_billing)+ Number(customer_newsletter)+ Number(picture_texting)+ Number(keyword)+ Number(client_setup)+ Number(nl_flyer);
            var subPearl = Number(email) + Number(newsletter) + Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(other_language_newsletter);
            var subemail = Number(email) + Number(newsletter)+ Number(digital_biz) + Number(canadaService) + Number(prospect_system)+ Number(magic_booker)+ Number(facebook) + Number(facebook_everything);
            if(data == 'S'){
              if(point>=0 && point <=29){
                var sum = Number(sumemail) + Sapphire0;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire0;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=30 && point <=54){
                var sum = Number(sumemail) + Sapphire30;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire30;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=55 && point <=79){
                var sum = Number(sumemail) + Sapphire55;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire55;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=80 && point <=104){
                var sum = Number(sumemail) + Sapphire80;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire80;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=105 && point <=124){
                var sum = Number(sumemail) + Sapphire105;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire105;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=125 && point <=154){
                var sum = Number(sumemail) + Sapphire125;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire125;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=155 && point <=174){
                var sum = Number(sumemail) + Sapphire155;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire155;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=175 && point <=199){
                var sum = Number(sumemail) + Sapphire175;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire175;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=200 && point <=224){
                var sum = Number(sumemail) + Sapphire200;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire200;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=225 && point <=249){
                var sum = Number(sumemail) + Sapphire225;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire255;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=250 && point <=300){
                var sum = Number(sumemail) + Sapphire250;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Sapphire250;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
            }
            if(data == 'P'){
              if(point>=0 && point <=29){
                var sum = Number(sumemailPearl) + Pearl0;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl0;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=30 && point <=54){
                var sum = Number(sumemailPearl) + Pearl30;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl130;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=55 && point <=79){
                var sum = Number(sumemailPearl) + Pearl55;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl55;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=80 && point <=104){
                var sum = Number(sumemailPearl) + Pearl80;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl80;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=105 && point <=124){
                var sum = Number(sumemailPearl) + Pearl105;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl105;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=125 && point <=154){
                var sum = Number(sumemailPearl) + Pearl125;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl125;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=155 && point <=174){
                var sum = Number(sumemailPearl) + Pearl155;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl155;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=175 && point <=199){
                var sum = Number(sumemailPearl) + Pearl175;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl175;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=200 && point <=224){
                var sum = Number(sumemailPearl) + Pearl200;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl200;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=225 && point <=249){
                var sum = Number(sumemailPearl) + Pearl225;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl255;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=250 && point <=300){
                var sum = Number(sumemailPearl) + Pearl250;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subPearl) + Pearl250;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
            }
            if(data == 'D'){
              if(point>=0 && point <=29){
                var sum = Number(sumemail) + Diamond0;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond0;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=30 && point <=54){
                var sum = Number(sumemail) + Diamond30;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond30;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=55 && point <=79){
                var sum = Number(sumemail) + Diamond55;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond55;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=80 && point <=104){
                var sum = Number(sumemail) + Diamond80;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond80;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=105 && point <=124){
                var sum = Number(sumemail) + Diamond105;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond105;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=125 && point <=154){
                var sum = Number(sumemail) + Diamond125;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond125;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=155 && point <=174){
                var sum = Number(sumemail) + Diamond155;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond155;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=175 && point <=199){
                var sum = Number(sumemail) + Diamond175;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond175;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=200 && point <=224){
                var sum = Number(sumemail) + Diamond200;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond200;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=225 && point <=249){
                var sum = Number(sumemail) + Diamond225;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond225;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=250 && point <=300){
                var sum = Number(sumemail) + Diamond250;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Diamond250;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }

            }
            if(data == 'E'){

              if(point>=0 && point <=29){
                var sum = Number(sumemail) + Emerald0;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald0;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=30 && point <=54){
                var sum = Number(sumemail) + Emerald30;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald30;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=55 && point <=79){
                var sum = Number(sumemail) + Emerald55;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald55;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=80 && point <=104){
                var sum = Number(sumemail) + Emerald80;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald80;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=105 && point <=124){
                var sum = Number(sumemail) + Emerald105;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald105;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=125 && point <=154){
                var sum = Number(sumemail) + Emerald125;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald125;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=155 && point <=174){
                var sum = Number(sumemail) + Emerald155;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald155;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=175 && point <=199){
                var sum = Number(sumemail) + Emerald175;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald175;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=200 && point <=224){
                var sum = Number(sumemail) + Emerald200;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald200;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=225 && point <=249){
                var sum = Number(sumemail) + Emerald225;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald225;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=250 && point <=300){
                var sum = Number(sumemail) + Emerald250;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Emerald250;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
            }
            if(data == 'R'){

              if(point>=0 && point <=29){
                var sum = Number(sumemail) + Ruby0;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby0;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=30 && point<=54){
                var sum = Number(sumemail) + Ruby30;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby30;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=55 && point <=79){
                var sum = Number(sumemail) + Ruby55;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby55;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=80 && point <=104){
                var sum = Number(sumemail) + Ruby80;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby80;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=105 && point <=124){
                var sum = Number(sumemail) + Ruby105;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby105;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=125 && point <=154){
                var sum = Number(sumemail) + Ruby125;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby125;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=155 && point <=174){
                var sum = Number(sumemail) + Ruby155;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby155;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=175 && point <=199){
                var sum = Number(sumemail) + Ruby175;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby175;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=200 && point <=224){
                var sum = Number(sumemail) + Ruby200;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby200;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=225 && point <=249){
                var sum = Number(sumemail) + Ruby225;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby225;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=250 && point <=300){
                var sum = Number(sumemail) + Ruby250;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Ruby250;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
            }
            if(data == 'E1'){

              var texting = $("input[name=texting]:checked").val();
            var data = $("input[name=package]:checked").val();
            var hiddenEconomys = $("#hidden_economy").val();
            
            hiddenEconomy = $("#hidden_economy").val();

            if((data == 'E1') && (texting == 'Y'))
            {
              $("#economy_div").show();
            }
            else
            {
              $("#economy_div").hide();
            }
              if(point>=0 && point <=29){
                var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy0;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy0;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=30 && point<=54){
                var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy30;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy30;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=55 && point <=79){
                var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy55;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy55;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=80 && point <=104){
                var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy80;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy80;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=105 && point <=124){
                var sum = Number(sumemail) + Number(hiddenEconomy) + Economy105;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy105;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=125 && point <=154){
                var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy125;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy125;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=155 && point <=174){
                var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy155;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy155;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=175 && point <=199){
                var sum = Number(sumemail) + Number(hiddenEconomy) + Economy175;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy175;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=200 && point <=224){
                var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy200;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy200;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=225 && point <=249){
                var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy225;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy225;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
              if(point>=250 && point <=300){
                var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy250;
                $(".package_value").val(sum.toFixed(2));
                $("#hidden_package").val(sum.toFixed(2));

                var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy250;
                $(".sub_total").val(sum2.toFixed(2));
                $("input.sub_total").val(sum2.toFixed(2));
              }
            }
            if(data == 'S1'){
              var sum = Number(sumemail) + SpecialALL;
              $(".package_value").val(sum.toFixed(2));
              $("#hidden_package").val(sum.toFixed(2));

              var sum2 = Number(subemail) + SpecialALL;
              $(".sub_total").val(sum2.toFixed(2));
              $("input.sub_total").val(sum2.toFixed(2));
            }
            var texting = $("input[name=texting]:checked").val();
            var packageval= $("input[name=package]:checked").val();
            var package = $(".package_value").val();
            var subpack = $(".sub_total").val();

            if($('[name="total_text_program7"]').is(':checked')) {
  
            if(packageval == 'N' || packageval == undefined)
            {
              packagedata = Number(package) + Number(total_text_program7_N);
                $(".package_value").val(packagedata.toFixed(2));
                $("#hidden_package").val(packagedata.toFixed(2));

                packagedata2 = Number(subpack) + Number(total_text_program7_N);
                $(".sub_total").val(packagedata2.toFixed(2));
                $("input.sub_total").val(packagedata2.toFixed(2));
            }else if(packageval == 'P'){
              packagedata = Number(package) + Number(total_text_program7_P);
                $(".package_value").val(packagedata.toFixed(2));
                $("#hidden_package").val(packagedata.toFixed(2));

                packagedata2 = Number(subpack) + Number(total_text_program7_P);
                $(".sub_total").val(packagedata2.toFixed(2));
                $("input.sub_total").val(packagedata2.toFixed(2));
            } else {
                var packagedata = Number(total_text_program7_Y) +  Number(package);
                $(".package_value").val(packagedata.toFixed(2));
                $("#hidden_package").val(packagedata.toFixed(2));

                var packagedata2 = Number(total_text_program7_Y) +  Number(subpack);
                $(".sub_total").val(packagedata2.toFixed(2));
                $("input.sub_total").val(packagedata2.toFixed(2));
              }
          }
          
            if(data == undefined || data == ''){
              if($('[name="total_text_program"]').is(':checked')){

              if(packageval == 'N' || packageval == undefined){
                packagedata = Number(package);
                  $(".package_value").val(packagedata.toFixed(2));
                  $("#hidden_package").val(packagedata.toFixed(2));

                  packagedata2 = Number(subpack);
                  $(".sub_total").val(packagedata2.toFixed(2));
                  $("input.sub_total").val(packagedata2.toFixed(2));
              }else if(packageval == 'D' || packageval == 'E' || packageval == 'P'){
                var packagedata = Number(total_text_program_D_E_P) +  Number(package);
                  $(".package_value").val(packagedata.toFixed(2));
                  $("#hidden_package").val(packagedata.toFixed(2));

                  var packagedata2 = Number(total_text_program_D_E_P) +  Number(subpack);
                  $(".sub_total").val(packagedata2.toFixed(2));
                  $("input.sub_total").val(packagedata2.toFixed(2));  
                } else{
                  var packagedata = Number(total_text_program_other) +  Number(package);
                  $(".package_value").val(packagedata.toFixed(2));
                  $("#hidden_package").val(packagedata.toFixed(2));

                  var packagedata2 = Number(total_text_program_other) +  Number(subpack);
                  $(".sub_total").val(packagedata2.toFixed(2));
                  $("input.sub_total").val(packagedata2.toFixed(2));
                }
            }
              else
              {
                if($('input[name="texting"]').is(':checked')){
                  if(texting == 'Y'){
                    var packagedata = Number(texting_val_yes) +  Number(package) + Number(sumemail);
                    $(".package_value").val(packagedata.toFixed(2));
                    $("#hidden_package").val(packagedata.toFixed(2));

                    var packagedata2 = Number(texting_val_yes) +  Number(subpack)+ Number(subemail);
                    $(".sub_total").val(packagedata2.toFixed(2));
                    $("input.sub_total").val(packagedata2.toFixed(2));
                  }
                }
                else
                {
                  $(".package_value").val(sumemail.toFixed(2));
                  $("#hidden_package").val(sumemail.toFixed(2));

                  $(".sub_total").val(subemail.toFixed(2));
                  $("input.sub_total").val(subemail.toFixed(2));
                }

                if ($('[name="total_text_program7"]').is(":checked")) {
                  $('[name="total_text_program"]').attr('disabled', true);
                }

              }
            }
            if(data != ''){
              
              if(data == 'N' || data == ''){
                var sumemail = Number(email) + Number(newsletter)+ Number(digital_biz)+ Number(canadaService) + Number(facebook)  + Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles)+ Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage) + Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit) + Number(cc_billing)+ Number(customer_newsletter)+ Number(picture_texting)+ Number(keyword)+ Number(client_setup);
                var subemail = Number(email) + Number(newsletter)+ Number(digital_biz)+ Number(canadaService) + Number(facebook) + Number(facebook_everything);
                if($('[name="total_text_program"]').is(':checked')){

                if(packageval == 'N' || packageval == undefined)
                {
                  packagedata = Number(package);
                    $(".package_value").val(packagedata.toFixed(2));
                    $("#hidden_package").val(packagedata.toFixed(2));

                    packagedata2 = Number(subpack);
                    $(".sub_total").val(packagedata2.toFixed(2));
                    $("input.sub_total").val(packagedata2.toFixed(2));

                }
                else if(packageval == 'D' || packageval == 'E' || packageval == 'P')
                {
                  var packagedata = Number(total_text_program_D_E_P) +  Number(package);
                    $(".package_value").val(packagedata.toFixed(2));
                    $("#hidden_package").val(packagedata.toFixed(2));

                    var packagedata2 =Number(total_text_program_D_E_P) + Number(subpack);
                    $(".sub_total").val(packagedata2.toFixed(2));
                    $("input.sub_total").val(packagedata2.toFixed(2));  
                  } 
                  else
                  {
                    var packagedata = Number(total_text_program_other) +  Number(package);
                    $(".package_value").val(packagedata.toFixed(2));
                    $("#hidden_package").val(packagedata.toFixed(2));

                    var packagedata2 = Number(total_text_program_other) +  Number(subpack);
                    $(".sub_total").val(packagedata2.toFixed(2));
                    $("input.sub_total").val(packagedata2.toFixed(2));
                  }
              }
                else
                {
                  if($('input[name="texting"]').is(':checked')){
                    if(texting == 'Y'){
                      var packagedata = texting_val_yes +  Number(package) + Number(sumemail);
                      $(".package_value").val(packagedata.toFixed(2));
                      $("#hidden_package").val(packagedata.toFixed(2));

                      var packagedata2 = texting_val_yes + Number(submail) +  Number(subpack);
                      $(".sub_total").val(packagedata2.toFixed(2));
                      $("input.sub_total").val(packagedata2.toFixed(2));
                    }
                    if(texting == '' || texting == 'X'){
                      $(".package_value").val(sumemail.toFixed(2));
                      $("#hidden_package").val(sumemail.toFixed(2));

                      $(".sub_total").val(submail.toFixed(2));
                      $("input.sub_total").val(submail.toFixed(2));

                    }
                  }

                  if ($('[name="total_text_program7"]').is(":checked")) {
                    $('[name="total_text_program"]').attr('disabled', true);
                  }
                }
              }
              
              if($('[name="total_text_program"]').is(':checked')){

              if(packageval == 'N' || packageval == undefined){
                packagedata = Number(package);
                  $(".package_value").val(packagedata.toFixed(2));
                  $("#hidden_package").val(packagedata.toFixed(2));

                  var packagedata2 = 0 +  Number(subpack);
                  $(".sub_total").val(packagedata2.toFixed(2));
                  $("input.sub_total").val(packagedata2.toFixed(2));
              }else if(packageval == 'D' || packageval == 'E' || packageval == 'P'){
                var packagedata = Number(total_text_program_D_E_P) +  Number(package);
                  $(".package_value").val(packagedata.toFixed(2));
                  $("#hidden_package").val(packagedata.toFixed(2)); 

                  var packagedata2 =Number(total_text_program_D_E_P) +  Number(subpack);
                  $(".sub_total").val(packagedata2.toFixed(2));
                  $("input.sub_total").val(packagedata2.toFixed(2));
                } else{
                  var packagedata = Number(total_text_program_other) +  Number(package);
                  $(".package_value").val(packagedata.toFixed(2));
                  $("#hidden_package").val(packagedata.toFixed(2));

                  var packagedata2 = Number(total_text_program_other) +  Number(subpack);
                  $(".sub_total").val(packagedata2.toFixed(2));
                  $("input.sub_total").val(packagedata2.toFixed(2));
                }
            }else{
                if(texting == 'Y'){
                  if ($('input[name="texting"]').is(':checked')){
                    if(packageval == 'R' || packageval == 'S' || packageval == 'E1'){
                      var packagedata = texting_Yes_S_R_E1 +  Number(package);
                      $(".package_value").val(packagedata.toFixed(2));
                      $("#hidden_package").val(packagedata.toFixed(2));

                      var packagedata2 = texting_Yes_S_R_E1 +  Number(subpack);
                      $(".sub_total").val(packagedata2.toFixed(2));
                      $("input.sub_total").val(packagedata2.toFixed(2));
                    }
                  }
                }
                if(texting == 'N'){
                  if ($('[name="texting"]').is(':checked')){
                    var packagevals = $("input[name=texting]:checked").val();
                    if(packagevals == 'R'){
                      var packagedata = Number(package);
                      $(".package_value").val(packagedata.toFixed(2));
                      $("#hidden_package").val(packagedata.toFixed(2));

                      var packagedata2 = Number(subpack);
                      $(".sub_total").val(packagedata2.toFixed(2));
                      $("input.sub_total").val(packagedata2.toFixed(2));
                    }
                    if(packagevals == 'S'){
                      var packagedata = Number(package);
                      $(".package_value").val(packagedata.toFixed(2));
                      $("#hidden_package").val(packagedata.toFixed(2));

                      var packagedata2 = Number(subpack);
                      $(".sub_total").val(packagedata2.toFixed(2));
                      $("input.sub_total").val(packagedata2.toFixed(2));
                    }
                    if(packagevals == 'E1'){
                      var packagedata = Number(package);
                      $(".package_value").val(packagedata.toFixed(2));
                      $("#hidden_package").val(packagedata.toFixed(2));

                      var packagedata2 = Number(subpack);
                      $(".sub_total").val(packagedata2.toFixed(2));
                      $("input.sub_total").val(packagedata2.toFixed(2));
                    }
                  }
                }

                if ($('[name="total_text_program7"]').is(":checked")) {
                  $('[name="total_text_program"]').attr('disabled', true);
                }
              }   
            }
        }
      }
    }
  
  });
  //package change
  $("input[name=package]").change(function(){
    var data = $("input[name=package]:checked").val();
    var package = $(".package_value").val();
    var subpack = $(".sub_total").val();

    var point = $("#unit_size").val();
    if(package != ''){
      $(".package_value").val('');
      $("#hidden_package").val('');

      $(".sub_total").val('');
      $("input.sub_total").val('');
    }
    var emailing = $("input[name=emailing]:checked").val();
    
    if($('[name="facebook"]').is(':checked')){
      facebook = facebook_val;
    }else{
      facebook = 0;
    }

    if($('[name="facebook_everything"]').is(':checked')){
      facebook_everything = facebook_everything_val;
    }else{
      facebook_everything = 0;
    }

    if($('[name="email_newsletter"]').is(':checked')){
      newsletter = newsletter_val;
    }else{
      newsletter = 0;
    }


    if($('[name="digital_biz_card"]').is(':checked')){
      digital_biz = biz_card_val;
    }else{
      digital_biz = 0;
    }

    if($('[name="canada_service"]').is(':checked')){
      canadaService = canada_service_val;
    }else{
      canadaService = 0;
    }

    if($('[name="other_language_newsletter"]').is(':checked'))
    {
      other_language_newsletter = other_language_newsletter_val;
    }
    else
    {
      other_language_newsletter = 0;
    }

    if($('[name="prospect_system"]').is(':checked')){
      prospect_system = prospect_system_val;
    }else{
      prospect_system = 0;
    }

    if($('[name="magic_booker"]').is(':checked')){
      magic_booker = magic_booker_val;
    }else{
      magic_booker = 0;
    }
    newsletter_color = $('[name="newsletter_color"]').val();
    if(newsletter_color != ''){
      newsletter_color = newsletter_color * parseFloat(newsletter_color_constant_val);
    }else{
      newsletter_color = 0;
    }

    newsletter_black_white = $('[name="newsletter_black_white"]').val();
    if(newsletter_black_white != ''){
      newsletter_black_white = newsletter_black_white * parseFloat(newsletter_black_white_constant_val);
    }else{
      newsletter_black_white = 0;
    }

    month_packet_postage = $('[name="month_packet_postage"]').val();
    if(month_packet_postage != ''){
      month_packet_postage = month_packet_postage * parseFloat(month_packet_postage_constant_val);
    }else{
      month_packet_postage = 0;
    }

    consultant_packet_postage = $('[name="consultant_packet_postage"]').val();
    if(consultant_packet_postage != ''){
      consultant_packet_postage = consultant_packet_postage * parseFloat(consultant_packet_postage_constant_val);
    }else{
      consultant_packet_postage = 0;
    }
    
    consultant_bundles = $('[name="consultant_bundles"]').val();
    if(consultant_bundles != ''){
      consultant_bundles = consultant_bundles * parseFloat(consultant_bundles_constant_val);
    }else{
      consultant_bundles = 0;
    }

    consultant_bundles = $('[name="consultant_bundles"]').val();
    if(consultant_bundles != ''){
      consultant_bundles = consultant_bundles * parseFloat(consultant_bundles_constant_val);
    }else{
      consultant_bundles = 0;
    }

    consistency_gift = $('[name="consistency_gift"]').val();
    if(consistency_gift != ''){
      consistency_gift = consistency_gift * parseInt(consistency_gift_constant_val);
    }else{
      consistency_gift = 0;
    }

    reds_program_gift = $('[name="reds_program_gift"]').val();
    if(reds_program_gift != ''){
      reds_program_gift = reds_program_gift * parseInt(reds_program_gift_constant_val);
    }else{
      reds_program_gift = 0;
    }

    stars_program_gift = $('[name="stars_program_gift"]').val();
    if(stars_program_gift != ''){
      stars_program_gift = stars_program_gift * parseInt(stars_program_gift_constant_val);
    }else{
      stars_program_gift = 0;
    }

    gift_wrap_postpage = $('[name="gift_wrap_postpage"]').val();
    if(gift_wrap_postpage != ''){
      gift_wrap_postpage = gift_wrap_postpage * parseFloat(gift_wrap_postpage_constant_val);
    }else{
      gift_wrap_postpage = 0;
    }

    one_rate_postpage = $('[name="one_rate_postpage"]').val();
    if(one_rate_postpage != ''){
      one_rate_postpage = one_rate_postpage * parseFloat(one_rate_postpage_constant_val);
    }else{
      one_rate_postpage = 0;
    }

    month_blast_flyer = $('[name="month_blast_flyer"]').val();
    if(month_blast_flyer != ''){
      month_blast_flyer = month_blast_flyer * parseFloat(month_blast_flyer_constant_val);
    }else{
      month_blast_flyer = 0;
    }

    nl_flyer = $('[name="nl_flyer"]').val();
    if(nl_flyer != ''){
      nl_flyer = nl_flyer * parseFloat(nl_flyer_constant_val);
    }else{
      nl_flyer = 0;
    }
      
    flyer_ecard_unit = $('[name="flyer_ecard_unit"]').val();
    if(flyer_ecard_unit != ''){
      flyer_ecard_unit = flyer_ecard_unit * parseFloat(flyer_ecard_unit_constant_val);
    }else{
      flyer_ecard_unit = 0;
    }

    unit_challenge_flyer = $('[name="unit_challenge_flyer"]').val();
    if(unit_challenge_flyer != ''){
      unit_challenge_flyer = unit_challenge_flyer * parseFloat(unit_challenge_flyer_constant_val);
    }else{
      unit_challenge_flyer = 0;
    }

    team_building_flyer = $('[name="team_building_flyer"]').val();
    if(team_building_flyer != ''){
      team_building_flyer = team_building_flyer * parseFloat(team_building_flyer_constant_val);
    }else{
      team_building_flyer = 0;
    }

    wholesale_promo_flyer = $('[name="wholesale_promo_flyer"]').val();
    if(wholesale_promo_flyer != ''){
      wholesale_promo_flyer = wholesale_promo_flyer * parseFloat(wholesale_promo_flyer_constant_val);
    }else{
      wholesale_promo_flyer = 0;
    }

    postcard_design = $('[name="postcard_design"]').val();
    if(postcard_design != ''){
      postcard_design = postcard_design * parseFloat(postcard_design_constant_val);
    }else{
      postcard_design = 0;
    }

    postcard_edit = $('[name="postcard_edit"]').val();
    if(postcard_edit != ''){
      postcard_edit = postcard_edit * parseFloat(postcard_edit_constant_val);
    }else{
      postcard_edit = 0;
    }

    ecard_unit = $('[name="ecard_unit"]').val();
    if(ecard_unit != ''){
      ecard_unit = ecard_unit * parseFloat(ecard_unit_constant_val);
    }else{
      ecard_unit = 0;
    }

    speciality_postcard = $('[name="speciality_postcard"]').val();
    if(speciality_postcard != ''){
      speciality_postcard = speciality_postcard * parseFloat(speciality_postcard_constant_val);
    }else{
      speciality_postcard = 0;
    }

    card_with_gift = $('[name="card_with_gift"]').val();
    if(card_with_gift != ''){
      card_with_gift = card_with_gift * parseFloat(card_with_gift_constant_val);
    }else{
      card_with_gift = 0;
    }

    greeting_card = $('[name="greeting_card"]').val();
    if(greeting_card != ''){
      greeting_card = greeting_card * parseFloat(greeting_card_constant_val);
    }else{
      greeting_card = 0;
    }

    birthday_brownie = $('[name="birthday_brownie"]').val();
    if(birthday_brownie != ''){
      birthday_brownie = birthday_brownie * parseFloat(birthday_brownie_constant_val);
    }else{
      birthday_brownie = 0;
    }

    birthday_starbucks = $('[name="birthday_starbucks"]').val();
    if(birthday_starbucks != ''){
      birthday_starbucks = birthday_starbucks * parseFloat(birthday_starbucks_constant_val);
    }else{
      birthday_starbucks = 0;
    }

    anniversary_starbucks = $('[name="anniversary_starbucks"]').val();
    if(anniversary_starbucks != ''){
      anniversary_starbucks = anniversary_starbucks  * parseFloat(anniversary_starbucks_constant_val);
    }else{
      anniversary_starbucks = 0;
    }

    referral_credit = $('[name="referral_credit"]').val();
    if(referral_credit != ''){
      referral_credit = referral_credit * parseInt(referral_credit_constant_val);
    }else{
      referral_credit = 0;
    }

    

    cc_billing = $('[name="cc_billing"]').val();
    if(cc_billing != ''){
      cc_billing = cc_billing * parseFloat(cc_billing_constant_val);
    }else{
      cc_billing = 0;
    }

    customer_newsletter = $('[name="customer_newsletter"]').val();
    if(customer_newsletter != ''){
      customer_newsletter = customer_newsletter * parseFloat(customer_newsletter_constant_val);
    }else{
      customer_newsletter = 0;
    }

    

    

    picture_texting = $('[name="picture_texting"]').val();
    if(picture_texting != ''){
      picture_texting = picture_texting * parseFloat(picture_texting_constant_val);
    }else{
      picture_texting = 0;
    }

    keyword = $('[name="keyword"]').val();
    if(keyword != ''){
      keyword = keyword * parseFloat(keyword_constant_val);
    }else{
      keyword = 0;
    }

    client_setup = $('[name="client_setup"]').val();
    if(client_setup != ''){
      client_setup = client_setup * parseFloat(client_setup_constant_val);
    }else{
      client_setup = 0;
    }
    
    if(emailing == '1'){
      email = email_val_1;
    }else if(emailing == '2'){
      email = email_val_2;
    }else{
      email=0;
    }
    
    var sumemailPearl = Number(email) + Number(newsletter)+ Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(other_language_newsletter)+ Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles)+ Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage)+ Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit)+ Number(cc_billing)+ Number(customer_newsletter)+ Number(picture_texting)+ Number(keyword)+ Number(client_setup)+ Number(nl_flyer);
    var sumemail = Number(email) + Number(newsletter) + Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(other_language_newsletter) + Number(newsletter_color)+ Number(newsletter_black_white)+ Number(month_packet_postage)+ Number(consultant_packet_postage)+ Number(consultant_bundles)+ Number(consistency_gift)+ Number(reds_program_gift)+ Number(stars_program_gift)+ Number(gift_wrap_postpage)+ Number(one_rate_postpage)+ Number(month_blast_flyer)+ Number(flyer_ecard_unit)+ Number(unit_challenge_flyer)+ Number(team_building_flyer)+ Number(wholesale_promo_flyer)+ Number(postcard_design)+ Number(postcard_edit)+ Number(ecard_unit)+ Number(speciality_postcard)+ Number(card_with_gift)+ Number(greeting_card)+ Number(birthday_brownie)+ Number(birthday_starbucks)+ Number(anniversary_starbucks)- Number(referral_credit)+ Number(cc_billing)+ Number(customer_newsletter)+ Number(picture_texting)+ Number(keyword)+ Number(client_setup)+ Number(nl_flyer);
    var subPearl = Number(email) + Number(newsletter)+ Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(other_language_newsletter);
    var subemail = Number(email) + Number(newsletter) + Number(digital_biz) + Number(canadaService) + Number(facebook) + Number(facebook_everything) + Number(prospect_system)+ Number(magic_booker)+ Number(other_language_newsletter);
    if(data == 'S'){
        if(point>=0 && point <=29){
          var sum = Number(sumemail) + Sapphire0;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire0;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));

        }
        if(point>=30 && point <=54)
        {
          var sum = Number(sumemail) + Sapphire30;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire30;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=55 && point <=79)
        {
          var sum = Number(sumemail) + Sapphire55;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire55;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=80 && point <=104)
        {
          var sum = Number(sumemail) + Sapphire80;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire80;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=105 && point <=124)
        {
          var sum = Number(sumemail) + Sapphire105;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire105;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=125 && point <=154)
        {
          var sum = Number(sumemail) + Sapphire125;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire125;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=155 && point <=174)
        {
          var sum = Number(sumemail) + Sapphire155;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire155;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=175 && point <=199)
        {
          var sum = Number(sumemail) + Sapphire175;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire175;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=200 && point <=224)
        {
          var sum = Number(sumemail) + Sapphire200;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire200;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=225 && point <=249)
        {
          var sum = Number(sumemail) + Sapphire225;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire225;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));

        }
        if(point>=250 && point <=300)
        {
          var sum = Number(sumemail) + Sapphire250;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Sapphire250;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
      }
      if(data == 'P'){
        if(point>=0 && point <=29)
        {
          var sum = Number(sumemailPearl) + Pearl0;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl0;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
      }
        if(point>=30 && point <=54)
        {
          var sum = Number(sumemailPearl) + Pearl30;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl30;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=55 && point <=79)
        {
          var sum = Number(sumemailPearl) + Pearl55;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl55;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=80 && point <=104)
        {
          var sum = Number(sumemailPearl) + Pearl80;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl80;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=105 && point <=124)
        {
          var sum = Number(sumemailPearl) + Pearl105;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl105;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=125 && point <=154)
        {
          var sum = Number(sumemailPearl) + Pearl125;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl125;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=155 && point <=174)
        {
          var sum = Number(sumemailPearl) + Pearl155;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl155;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=175 && point <=199)
        {
          var sum = Number(sumemailPearl) + Pearl175;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl175;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=200 && point <=224)
        {
          var sum = Number(sumemailPearl) + Pearl200;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl200;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=225 && point <=249)
        {
          var sum = Number(sumemailPearl) + Pearl225;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl225;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=250 && point <=300)
        {
          var sum = Number(sumemailPearl) + Pearl250;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subPearl) + Pearl250;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
      }
      if(data == 'D'){
        if(point>=0 && point <=29)
        {
          var sum =  Number(sumemail) + Diamond0;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond0;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
      }
        if(point>=30 && point <=54)
        {
          var sum =  Number(sumemail) + Diamond30;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond30;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=55 && point <=79)
        {
          var sum =  Number(sumemail) + Diamond55;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond55;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=80 && point <=104)
        {
          var sum =  Number(sumemail) + Diamond80;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond80;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=105 && point <=124)
        {
          var sum =  Number(sumemail) + Diamond105;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond105;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=125 && point <=154)
        {
          var sum =  Number(sumemail) + Diamond125;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond125;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=155 && point <=174)
        {
          var sum =  Number(sumemail) + Diamond155;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond155;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=175 && point <=199)
        {
          var sum =  Number(sumemail) + Diamond175;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond175;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=200 && point <=224)
        {
          var sum =  Number(sumemail) + Diamond200;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond200;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=225 && point <=249)
        {
          var sum =  Number(sumemail) + Diamond225;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond225;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=250 && point <=300)
        {
          var sum =  Number(sumemail) + Diamond250;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Diamond250;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
      }
      if(data == 'E'){
        if(point>=0 && point <=29)
        {
          var sum =  Number(sumemail) + Emerald0;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald0;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
      }
        if(point>=30 && point <=54)
        {
          var sum =  Number(sumemail) + Emerald30;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald30;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=55 && point <=79)
        {
          var sum =  Number(sumemail) + Emerald55;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald55;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=80 && point <=104)
        {
          var sum =  Number(sumemail) + Emerald80;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald80;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=105 && point <=124)
        {
          var sum =  Number(sumemail)+ Emerald105;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald105;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=125 && point <=154)
        {
          var sum =  Number(sumemail) + Emerald125;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald125;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=155 && point <=174)
        {
          var sum =  Number(sumemail) + Emerald155;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald155;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=175 && point <=199)
        {
          var sum =  Number(sumemail) + Emerald175;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald175;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=200 && point <=224)
        {
          var sum =  Number(sumemail) + Emerald200;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald200;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=225 && point <=249)
        {
          var sum =  Number(sumemail) + Emerald225;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald225;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=250 && point <=300)
        {
          var sum =  Number(sumemail) + Emerald250;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Emerald250;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
      }
      if(data == 'R'){
        if(point>=0 && point <=29)
        {
          var sum =  Number(sumemail) + Ruby0;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby0;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));

        }
        if(point>=30 && point<=54)
        {
          var sum =  Number(sumemail) + Ruby30;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby30;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=55 && point <=79)
        {
          var sum =  Number(sumemail) + Ruby55;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby55;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=80 && point <=104)
        {
          var sum =  Number(sumemail) + Ruby80;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby80;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=105 && point <=124)
        {
          var sum =  Number(sumemail)+ Ruby105;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby105;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=125 && point <=154)
        {
          var sum =  Number(sumemail) + Ruby125;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby125;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=155 && point <=174)
        {
          var sum =  Number(sumemail) + Ruby155;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby155;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=175 && point <=199)
        {
          var sum =  Number(sumemail) + Ruby175;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby175;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=200 && point <=224)
        {
          var sum =  Number(sumemail) + Ruby200;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby200;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=225 && point <=249)
        {
          var sum = Number(sumemail) + Ruby225;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));
          
          var sum2 = Number(subemail) + Ruby225;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=250 && point <=300)
        {
          var sum =  Number(sumemail) + Ruby250;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Ruby250;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
      }
      if(data == 'E1'){
        var texting = $("input[name=texting]:checked").val();
      var data = $("input[name=package]:checked").val();  
      if((data == 'E1') && (texting == 'Y')){
        $("#economy_div").show();
        var hiddenEconomy = $("#hidden_economy").val();
      }else{
        $("#economy_div").hide();
        var hiddenEconomy = 0;
      }
        if(point>=0 && point <=29)
        {
          var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy0;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy0;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
        }
        if(point>=30 && point<=54)
        {
          var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy30;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy30;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=55 && point <=79)
        {
          var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy55;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy55;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=80 && point <=104)
        {
          var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy80;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy80;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=105 && point <=124)
        {
          var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy105;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy105;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=125 && point <=154)
        {
          var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy125;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy125;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=155 && point <=174)
        {
          var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy155;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy155;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=175 && point <=199)
        {
          var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy175;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy175;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=200 && point <=224)
        {
          var sum = Number(sumemail) + Number(hiddenEconomy)+ Economy200;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy200;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=225 && point <=249)
        {
          var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy225;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy225;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
        if(point>=250 && point <=300)
        {
          var sum = Number(sumemail)+ Number(hiddenEconomy) + Economy250;
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail) + Number(hiddenEconomy)+ Economy250;
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
        }
      }
      if(data == 'S1'){
        var texting = $("input[name=texting]:checked").val();
      var data = $("input[name=package]:checked").val();  
      if((data == 'S1') && (texting == 'Y')){
        $("#economy_div").show();
        var hiddenEconomy = $("#hidden_economy").val();
      }else{
        $("#economy_div").hide();
        var hiddenEconomy = 0;
      }
        
        var sum = Number(sumemail) + Number(hiddenEconomy)+ SpecialALL;
        $(".package_value").val(sum.toFixed(2));
        $("#hidden_package").val(sum.toFixed(2));

        var sum2 = Number(subemail) + Number(hiddenEconomy)+ SpecialALL;
        $(".sub_total").val(sum2.toFixed(2));
        $("input.sub_total").val(sum2.toFixed(2));
        
        
      }
      if(data == 'N' || data == '' || data == undefined){ 
        //total_text_program7
        if($('[name="total_text_program7"]').is(':checked')) {

        if(packageval == 'N') {
          var packagedata = Number(total_text_program7_N) +  Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2)); 

            var sum2 = Number(total_text_program7_N) +  Number(subpack);
            $(".sub_total").val(sum2.toFixed(2));
            $("input.sub_total").val(sum2.toFixed(2));
          }else if(packageval == 'P') {
          var packagedata = Number(total_text_program7_P) +  Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2)); 

            var sum2 = Number(total_text_program7_P) +  Number(subpack);
            $(".sub_total").val(sum2.toFixed(2));
            $("input.sub_total").val(sum2.toFixed(2));
          } else {
            var packagedata = Number(total_text_program7_Y) +  Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var sum2 = Number(total_text_program7_Y) +  Number(subpack);
            $(".sub_total").val(sum2.toFixed(2));
            $("input.sub_total").val(sum2.toFixed(2));
          }
        }
        
          if($('[name="total_text_program"]').is(':checked')) {

          if(packageval == 'D' || packageval == 'E' || packageval == 'P') {
            var packagedata = Number(total_text_program_D_E_P) +  Number(package);
              $(".package_value").val(packagedata.toFixed(2));
              $("#hidden_package").val(packagedata.toFixed(2)); 

              var sum2 = Number(total_text_program_D_E_P) +  Number(subpack);
              $(".sub_total").val(sum2.toFixed(2));
              $("input.sub_total").val(sum2.toFixed(2));
            } else {
              var packagedata = Number(total_text_program_other) +  Number(package);
              $(".package_value").val(packagedata.toFixed(2));
              $("#hidden_package").val(packagedata.toFixed(2));

              var sum2 = Number(total_text_program_other) +  Number(subpack);
              $(".sub_total").val(sum2.toFixed(2));
              $("input.sub_total").val(sum2.toFixed(2));
            }
          }
          
          sum = Number(sumemail.toFixed(2));
          $(".package_value").val(sum.toFixed(2));
          $("#hidden_package").val(sum.toFixed(2));

          var sum2 = Number(subemail.toFixed(2));
          $(".sub_total").val(sum2.toFixed(2));
          $("input.sub_total").val(sum2.toFixed(2));
          
      }
      var packageval= $("input[name=package]:checked").val();
      var package = $(".package_value").val();
      var subpack = $(".sub_total").val();
      if(data != ''){
        if($('[name="total_text_program7"]').is(':checked')) {
        if(packageval == 'N') {
          $("#hidden_total_text_program7").val(total_text_program7_N);
          var value =  Number(package) + Number(total_text_program7_N); 
          $(".package_value").val(value.toFixed(2));  
          $("#hidden_package").val(value.toFixed(2));

          var value2 =  Number(subpack) + Number(total_text_program7_N); 
            $(".sub_total").val(value2.toFixed(2));
            $("input.sub_total").val(value2.toFixed(2));
          }else if(packageval == 'P') {
          $("#hidden_total_text_program7").val(total_text_program7_P);
          var value =  Number(package) + Number(total_text_program7_P); 
          $(".package_value").val(value.toFixed(2));  
          $("#hidden_package").val(value.toFixed(2));

          var value2 =  Number(subpack) + Number(total_text_program7_P); 
            $(".sub_total").val(value2.toFixed(2));
            $("input.sub_total").val(value2.toFixed(2));
          } else {
            $("#hidden_total_text_program7").val(total_text_program7_Y);
          var value =  Number(package) + Number(total_text_program7_Y); 
          $(".package_value").val(value.toFixed(2));  
          $("#hidden_package").val(value.toFixed(2));

          var value2 =  Number(subpack) + Number(total_text_program7_Y); 
            $(".sub_total").val(value2.toFixed(2));
            $("input.sub_total").val(value2.toFixed(2));
          }
        }

        var economy = $("input[name=economy]:checked").val();
        var packagevals = $("input[name=package]:checked").val();
        if($('[name="total_text_program"]').is(':checked')){
          if(packagevals == 'N' || packagevals == undefined){
            if($('[name="texting"]').is(':checked')){
              if(texting == 'N' || texting == 'X'){
                total_text = total_text_N;
              }
              if(texting == 'Y'){
                total_text = total_text_Y;
              }else{
                total_text = total_text_N;
              }
            }else{
              total_text = total_text_N;
            }
          }else if(packagevals == 'P'){
            total_text = total_text_program_D_E_P;
          }else{
            total_text = total_text_program_other;
          }
          var hidden_text = $("#hidden_total_text_program").val();
          //add total text program
          $("#hidden_total_text_program").val(total_text);
        var value =  Number(package) + Number(total_text); 
        $(".package_value").val(value.toFixed(2));  
        $("#hidden_package").val(value.toFixed(2));

        var value2 =  Number(subpack) + Number(total_text); 
          $(".sub_total").val(value2.toFixed(2));
          $("input.sub_total").val(value2.toFixed(2));
        }else{
        var packagevals = $("input[name=texting]:checked").val();
          if(packagevals == 'R'){
            var packagedata = Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var packagedata2 =  Number(subpack); 
            $(".sub_total").val(packagedata2.toFixed(2));
            $("input.sub_total").val(packagedata2.toFixed(2));
          }
          if(packagevals == 'S'){
            var packagedata = Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var packagedata2 =  Number(subpack); 
            $(".sub_total").val(packagedata2.toFixed(2));
            $("input.sub_total").val(packagedata2.toFixed(2));
          }
          if(packagevals == 'E1'){
            var packagedata = Number(package);
            $(".package_value").val(packagedata.toFixed(2));
            $("#hidden_package").val(packagedata.toFixed(2));

            var packagedata2 =  Number(subpack); 
            $(".sub_total").val(packagedata2.toFixed(2));
            $("input.sub_total").val(packagedata2.toFixed(2));
          }
          
        }
    }
  });
            
});
$('input[name="package_for"]').change(function(){
  var package_for = $('input[type=radio][name=package_for]:checked').val();
  if(package_for == 'C'){
    $(".future-date").hide();
  }
  else if(package_for == 'F'){
    $(".future-date").show();
  }
});

$('input[name="other_language_newsletter"]').on('click', function() { 
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();

  var data = $("input[name=package]:checked").val();
    if (this.checked) {
    var value =  Number(package) + other_language_newsletter_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 =  Number(subpack) + other_language_newsletter_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));       
    }else {
      if(data == 'P'){
        var value =  Number(package); 
      $(".package_value").val(value.toFixed(2));
        $("#hidden_package").val(value.toFixed(2));

        $(".sub_total").val(subpack.toFixed(2));
        $("input.sub_total").val(subpack.toFixed(2));
      }else{
        var value =  Number(package) - other_language_newsletter_val; 
      $(".package_value").val(value.toFixed(2));
        $("#hidden_package").val(value.toFixed(2));  

        var value2 =  Number(subpack) - other_language_newsletter_val; 
      $(".sub_total").val(value2.toFixed(2));
        $("input.sub_total").val(value2.toFixed(2));
      }
    }          
});

$('input[name="prospect_system"]').on('click', function(){ 
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();

  var data = $("input[name=package]:checked").val();
    if (this.checked){
    var value =  Number(package) + prospect_system_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 =  Number(subpack) + prospect_system_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));       
    }else {
    var value =  Number(package) - prospect_system_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));  

      var value2 =  Number(subpack) - prospect_system_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));
      
    }  

});

$('input[name="magic_booker"]').on('click', function(){ 
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();
  var data = $("input[name=package]:checked").val();
    
    if (this.checked){
    var value =  Number(package) + magic_booker_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 =  Number(subpack) + magic_booker_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));       
    }else {
    var value =  Number(package) - magic_booker_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));  

      var value2 =  Number(subpack) - magic_booker_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));
    }  
});

$('input[name="newsletter_color"]').on('change', function() { 
  $("#newsletter-color").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
  var newsletter_color = $(this).val();
  var newsletter_color_old =$("#newsletter_color").val();
  newsletter_color =  Number(newsletter_color) * parseFloat(newsletter_color_constant_val);
  var newsletter_color_val =  Number(newsletter_color) - Number(newsletter_color_old);
  $("#newsletter_color").val(newsletter_color); 
  var value =  Number(package) + Number(newsletter_color_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));             
});
$('input[name="newsletter_black_white"]').on('change', function() { 
  $("#newsletter-black-white").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var newsletter_black_white = $(this).val();
    var newsletter_black_white_old =$("#newsletter_black_white").val();
  newsletter_black_white =  Number(newsletter_black_white) * parseFloat(newsletter_black_white_constant_val);
  var newsletter_black_white_val =  Number(newsletter_black_white) - Number(newsletter_black_white_old);
  $("#newsletter_black_white").val(newsletter_black_white); 
  var value =  Number(package) + Number(newsletter_black_white_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));  
});
$('input[name="month_packet_postage"]').on('change', function(){ 
  $("#month-packet-postage").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var month_packet_postage = $(this).val();
    var month_packet_postage_old =$("#month_packet_postage").val();
  month_packet_postage =  Number(month_packet_postage) * parseFloat(month_packet_postage_constant_val);
  var month_packet_postage_val =  Number(month_packet_postage) - Number(month_packet_postage_old);
  $("#month_packet_postage").val(month_packet_postage); 
  var value =  Number(package) + Number(month_packet_postage_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));      
});
$('input[name="consultant_packet_postage"]').on('change', function(){ 
  $("#consultant-packet-postage").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var consultant_packet_postage = $(this).val();
    var consultant_packet_postage_old =$("#consultant_packet_postage").val();
  consultant_packet_postage =  Number(consultant_packet_postage) * parseFloat(consultant_packet_postage_constant_val);
  var consultant_packet_postage_val =  Number(consultant_packet_postage) - Number(consultant_packet_postage_old);
  $("#consultant_packet_postage").val(consultant_packet_postage); 
  var value =  Number(package) + Number(consultant_packet_postage_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));   
});
$('input[name="consultant_bundles"]').on('change', function(){ 
  $("#consultant-bundles").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var consultant_bundles = $(this).val();
    var consultant_bundles_old =$("#consultant_bundles").val();
  consultant_bundles =  Number(consultant_bundles) * parseFloat(consultant_bundles_constant_val);
  var consultant_bundles_val =  Number(consultant_bundles) - Number(consultant_bundles_old);
  $("#consultant_bundles").val(consultant_bundles); 
  var value =  Number(package) + Number(consultant_bundles_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));          
});
$('input[name="consistency_gift"]').on('change', function(){ 
  $("#consistency-gift").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var consistency_gift = $(this).val();
    var consistency_gift_old =$("#consistency_gift").val();
  consistency_gift =  Number(consistency_gift) * parseInt(consistency_gift_constant_val);
  var consistency_gift_val =  Number(consistency_gift) - Number(consistency_gift_old);
  $("#consistency_gift").val(consistency_gift); 
  var value =  Number(package) + Number(consistency_gift_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));          
});
$('input[name="reds_program_gift"]').on('change', function(){ 
  $("#reds-program-gift").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var reds_program_gift = $(this).val();
    var reds_program_gift_old =$("#reds_program_gift").val();
  reds_program_gift =  Number(reds_program_gift) * parseInt(reds_program_gift_constant_val);
  var reds_program_gift_val =  Number(reds_program_gift) - Number(reds_program_gift_old);
  $("#reds_program_gift").val(reds_program_gift); 
  var value =  Number(package) + Number(reds_program_gift_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="stars_program_gift"]').on('change', function(){ 
  $("#stars-program-gift").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var stars_program_gift = $(this).val();
    var stars_program_gift_old =$("#stars_program_gift").val();
  stars_program_gift =  Number(stars_program_gift) * parseInt(stars_program_gift_constant_val);
  var stars_program_gift_val =  Number(stars_program_gift) - Number(stars_program_gift_old);
  $("#stars_program_gift").val(stars_program_gift); 
  var value =  Number(package) + Number(stars_program_gift_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="gift_wrap_postpage"]').on('change', function(){ 
  $("#gift-wrap-postpage").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var gift_wrap_postpage = $(this).val();
    var gift_wrap_postpage_old =$("#gift_wrap_postpage").val();
  gift_wrap_postpage =  Number(gift_wrap_postpage) * parseFloat(gift_wrap_postpage_constant_val);
  var gift_wrap_postpage_val =  Number(gift_wrap_postpage) - Number(gift_wrap_postpage_old);
  $("#gift_wrap_postpage").val(gift_wrap_postpage); 
  var value =  Number(package) + Number(gift_wrap_postpage_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));         
});
$('input[name="one_rate_postpage"]').on('change', function(){ 
  $("#one-rate-postpage").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var one_rate_postpage = $(this).val();
    var one_rate_postpage_old =$("#one_rate_postpage").val();
  one_rate_postpage =  Number(one_rate_postpage) * parseFloat(one_rate_postpage_constant_val);
  var one_rate_postpage_val =  Number(one_rate_postpage) - Number(one_rate_postpage_old);
  $("#one_rate_postpage").val(one_rate_postpage); 
  var value =  Number(package) + Number(one_rate_postpage_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));          
});
$('input[name="month_blast_flyer"]').on('change', function() { 
  $("#month-blast-flyer").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var month_blast_flyer = $(this).val();
    var month_blast_flyer_old =$("#month_blast_flyer").val();
  month_blast_flyer =  Number(month_blast_flyer) * parseFloat(month_blast_flyer_constant_val);
  var month_blast_flyer_val =  Number(month_blast_flyer) - Number(month_blast_flyer_old);
  $("#month_blast_flyer").val(month_blast_flyer); 
  var value =  Number(package) + Number(month_blast_flyer_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});

$('input[name="nl_flyer"]').on('change', function() { 
  $("#nl-flyer").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var nl_flyer = $(this).val();
    var nl_flyer_old =$("#nl_flyer").val();
  nl_flyer =  Number(nl_flyer) * parseFloat(nl_flyer_constant_val);
  var nl_flyer_val =  Number(nl_flyer) - Number(nl_flyer_old);
  $("#nl_flyer").val(nl_flyer); 
  var value =  Number(package) + Number(nl_flyer_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="flyer_ecard_unit"]').on('change', function() { 
  $("#flyer-ecard-unit").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var flyer_ecard_unit = $(this).val();
    var flyer_ecard_unit_old =$("#flyer_ecard_unit").val();
    
  flyer_ecard_unit =  Number(flyer_ecard_unit) * parseFloat(flyer_ecard_unit_constant_val);
  var flyer_ecard_unit_val =  Number(flyer_ecard_unit) - Number(flyer_ecard_unit_old);
  $("#flyer_ecard_unit").val(flyer_ecard_unit); 
  var value =  Number(package) + Number(flyer_ecard_unit_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));         
});
$('input[name="unit_challenge_flyer"]').on('change', function(){ 
  $("#unit-challenge-flyer").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var unit_challenge_flyer = $(this).val();
    var unit_challenge_flyer_old =$("#unit_challenge_flyer").val();
  unit_challenge_flyer =  Number(unit_challenge_flyer) * parseFloat(unit_challenge_flyer_constant_val);
  var unit_challenge_flyer_val =  Number(unit_challenge_flyer) - Number(unit_challenge_flyer_old);
  $("#unit_challenge_flyer").val(unit_challenge_flyer); 
  var value =  Number(package) + Number(unit_challenge_flyer_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));         
});
$('input[name="team_building_flyer"]').on('change', function(){ 
  $("#team-building-flyer").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var team_building_flyer = $(this).val();
    var team_building_flyer_old =$("#team_building_flyer").val();
  team_building_flyer =  Number(team_building_flyer) * parseFloat(team_building_flyer_constant_val);
  var team_building_flyer_val =  Number(team_building_flyer) - Number(team_building_flyer_old);
  $("#team_building_flyer").val(team_building_flyer); 
  var value =  Number(package) + Number(team_building_flyer_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));          
});
$('input[name="wholesale_promo_flyer"]').on('change', function(){ 
  $("#wholesale-promo-flyer").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var wholesale_promo_flyer = $(this).val();
    var wholesale_promo_flyer_old =$("#wholesale_promo_flyer").val();
  wholesale_promo_flyer =  Number(wholesale_promo_flyer) * parseFloat(wholesale_promo_flyer_constant_val);
  var wholesale_promo_flyer_val =  Number(wholesale_promo_flyer) - Number(wholesale_promo_flyer_old);
  $("#wholesale_promo_flyer").val(wholesale_promo_flyer); 
  var value =  Number(package) + Number(wholesale_promo_flyer_val);    
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="postcard_design"]').on('change', function(){ 
  $("#postcard-design").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var postcard_design = $(this).val();
    var postcard_design_old =$("#postcard_design").val();
  postcard_design =  Number(postcard_design) * parseFloat(postcard_design_constant_val);
  var postcard_design_val =  Number(postcard_design) - Number(postcard_design_old);
  $("#postcard_design").val(postcard_design); 
  var value =  Number(package) + Number(postcard_design_val); 
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));       
});
$('input[name="postcard_edit"]').on('change', function(){ 
  $("#postcard-edit").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var postcard_edit = $(this).val();
    var postcard_edit_old =$("#postcard_edit").val();
   // $("#postcard-edit").html(postcard_edit);
  postcard_edit =  Number(postcard_edit) * parseFloat(postcard_edit_constant_val);
  var postcard_edit_val =  Number(postcard_edit) - Number(postcard_edit_old);
  $("#postcard_edit").val(postcard_edit); 
  var value =  Number(package) + Number(postcard_edit_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));       
});
$('input[name="ecard_unit"]').on('change', function(){ 
  $("#ecard-unit").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var ecard_unit = $(this).val();
    var ecard_unit_old =$("#ecard_unit").val();
  ecard_unit =  Number(ecard_unit) * parseFloat(ecard_unit_constant_val);
  var ecard_unit_val =  Number(ecard_unit) - Number(ecard_unit_old);
  $("#ecard_unit").val(ecard_unit); 
  var value =  Number(package) + Number(ecard_unit_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="speciality_postcard"]').on('change', function(){ 
  $("#speciality-postcard").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var speciality_postcard = $(this).val();
    var speciality_postcard_old =$("#speciality_postcard").val();
  speciality_postcard =  Number(speciality_postcard) * parseFloat(speciality_postcard_constant_val);
  var speciality_postcard_val =  Number(speciality_postcard) - Number(speciality_postcard_old);
  $("#speciality_postcard").val(speciality_postcard); 
  var value =  Number(package) + Number(speciality_postcard_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="card_with_gift"]').on('change', function(){
  $("#card-with-gift").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var card_with_gift = $(this).val();
    var card_with_gift_old =$("#card_with_gift").val();
  card_with_gift =  Number(card_with_gift) * parseFloat(card_with_gift_constant_val);
  var card_with_gift_val =  Number(card_with_gift) - Number(card_with_gift_old);
  $("#card_with_gift").val(card_with_gift); 
  var value =  Number(package) + Number(card_with_gift_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});


$('input[name="greeting_card"]').on('change', function(){
  $("#card-with-gift").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var greeting_card = $(this).val();
    var greeting_card_old =$("#greeting_card").val();
  greeting_card =  Number(greeting_card) * parseFloat(greeting_card_constant_val);
  var greeting_card_val =  Number(greeting_card) - Number(greeting_card_old);
  $("#greeting_card").val(greeting_card); 
  var value =  Number(package) + Number(greeting_card_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});



$('input[name="birthday_brownie"]').on('change', function() { 
  $("#birthday-brownie").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var birthday_brownie = $(this).val();
    var birthday_brownie_old =$("#birthday_brownie").val();
  birthday_brownie =  Number(birthday_brownie) * parseFloat(birthday_brownie_constant_val);
  var birthday_brownie_val =  Number(birthday_brownie) - Number(birthday_brownie_old);
  $("#birthday_brownie").val(birthday_brownie); 
  var value =  Number(package) + Number(birthday_brownie_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="birthday_starbucks"]').on('change', function(){ 
  $("#birthday-starbucks").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var birthday_starbucks = $(this).val();
    var birthday_starbucks_old =$("#birthday_starbucks").val();
  birthday_starbucks =  Number(birthday_starbucks) * parseFloat(birthday_starbucks_constant_val);
  var birthday_starbucks_val =  Number(birthday_starbucks) - Number(birthday_starbucks_old);
  $("#birthday_starbucks").val(birthday_starbucks); 
  var value =  Number(package) + Number(birthday_starbucks_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="anniversary_starbucks"]').on('change', function(){
  $("#anniversary-starbucks").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var anniversary_starbucks = $(this).val();
    var anniversary_starbucks_old =$("#anniversary_starbucks").val();
  anniversary_starbucks =  Number(anniversary_starbucks) * parseFloat(anniversary_starbucks_constant_val);
  var anniversary_starbucks_val =  Number(anniversary_starbucks) - Number(anniversary_starbucks_old);
  $("#anniversary_starbucks").val(anniversary_starbucks); 
  var value =  Number(package) + Number(anniversary_starbucks_val);

  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});
$('input[name="referral_credit"]').on('change', function(){ 
  $("#referral-credit").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var referral_credit = $(this).val();
    var referral_credit_old = $("#referral_credit").val();
  referral_credit =  Number(referral_credit) * parseInt(referral_credit_constant_val);
  var referral_credit_val =  Number(referral_credit) - Number(referral_credit_old);
  $("#referral_credit").val(referral_credit); 
  var value =  Number(package) - Number(referral_credit_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));          
});

$('input[name="cc_billing"]').on('change', function(){
  $("#cc-billing").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var cc_billing = $(this).val();
    var cc_billing_old = $("#cc_billing").val();
   
  package = Number(package) - parseFloat(cc_billing_old);
  cc_billing =  Number(cc_billing) * parseFloat(cc_billing_constant_val); 
  var value =  Number(package) + Number(cc_billing);  
    
    $("#cc_billing").val(cc_billing); 
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));   
});
$('input[name="customer_newsletter"]').on('change', function(){ 
  $("#customer-newsletter").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
  var customer_newsletter = $(this).val();
  var customer_newsletter_old = $("#customer_newsletter").val();
  customer_newsletter =  Number(customer_newsletter) * parseFloat(customer_newsletter_constant_val);
  var customer_newsletter_val =  Number(customer_newsletter) - Number(customer_newsletter_old);
  $("#customer_newsletter").val(customer_newsletter); 
  var value =  Number(package) + Number(customer_newsletter_val);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});




$('input[name="picture_texting"]').on('change', function(){
  $("#picture-texting").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var picture_texting = $(this).val();
   // $("#anniversary-postcard").html(picture_texting);
    var picture_texting_old = $("#picture_texting").val();
  var picture_texting =  Number(picture_texting) * parseFloat(picture_texting_constant_val);
  var picture_texting_val =  Number(picture_texting) - Number(picture_texting_old);
  var value =  Number(package) + Number(picture_texting_val);
  $("#picture_texting").val(picture_texting);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});

$('input[name="keyword"]').on('change', function(){
  $("#picture-texting").html('');
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var keyword = $(this).val();
    var keyword_old = $("#keyword").val();
  var keyword =  Number(keyword) * parseFloat(keyword_constant_val);
  var keyword_val =  Number(keyword) - Number(keyword_old);
  var value =  Number(package) + Number(keyword_val);
  $("#keyword").val(keyword);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});

$('input[name="client_setup"]').on('change', function(){
  var package = $(".package_value").val();
  var data = $("input[name=package]:checked").val();
    var client_setup = $(this).val();
    var client_setup_old = $("#client_setup").val();
  var client_setup =  Number(client_setup) * parseFloat(client_setup_constant_val);
  var client_setup_val =  Number(client_setup) - Number(client_setup_old);
  var value =  Number(package) + Number(client_setup_val);
  $("#client_setup").val(client_setup);
  $(".package_value").val(value.toFixed(2));
    $("#hidden_package").val(value.toFixed(2));           
});


$('input[name="total_text_program"]').on('click', function() { 
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();
  var data = $("input[name=package]:checked").val();
  var texting = $("input[name=texting]:checked").val();
  var economy = $("input[name=economy]:checked").val();
    if(this.checked) {
      if(data == 'S' || data == 'R' || data == 'E1'){
        $("#total-text-program").html("$29.99");
        $("#total-text-program7").html("");
        $("#main-design .row:nth-child(36)").removeClass('hidden'); 
      }else if(data == 'D' || data == 'E' || data == 'P'){
        $("#total-text-program").html("$9.99");
        $("#total-text-program7").html("");
        $("#main-design .row:nth-child(36)").removeClass('hidden');
      }else if(data == 'N' || data == ''){
        $("#total-text-program").html("$59.99");
        $("#total-text-program7").html("");
        $("#main-design .row:nth-child(36)").removeClass('hidden');
      }else{
        $("#total-text-program").html("");
        $("#main-design .row:nth-child(36)").addClass('hidden');
      }

      $("input[name=texting]").attr("disabled",true);
      $("input[name=economy]").attr("disabled",true);

    if($('[name="texting"]').is(':checked')){
      if(texting == 'Y'){
        if(texting == 'Y' && (data == 'N' || data == undefined)){
            texting = texting_val_yes;
          }else if(texting == 'Y' && (data == 'S' || data == 'R')){
            texting = texting_Yes_S_R_E1;
          }else if(texting == 'Y' &&  (data == 'E1') && economy == 'Y'){
            texting = texting_Yes_S_R_E1;
          }else if(texting == 'Y' &&  (data == 'E1') && economy == 'N'){
            texting = texting_Y_economy_N;
          }else if(texting == 'Y' && (data == 'D' || data == 'E' || data == 'P')){
            texting = 0;
          } 
      }
      if(texting == 'N' || texting == 'X'){
        texting = 0;
      }
    }else{
      texting = 0;
    }
    
      if(data == 'N' || data == undefined){
        total_text = total_text_N;
      }else if(data == 'P' ){
        total_text = total_text_program_D_E_P;
      }else if(data == 'D' || data == 'E') {
        total_text = total_text_program_other;
      }else{
        total_text = total_text_program_other;
      }
      var hidden_text = $("#hidden_total_text_program").val();
    var value =  Number(package) + Number(total_text) - Number(texting);
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));          
      $("#hidden_total_text_program").val(total_text);

      var value2 =  Number(subpack) + Number(total_text) - Number(texting);
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));

    }else {
      var hidden_total_text_program = $("#hidden_total_text_program").val();
      $("input[name=texting]").attr("disabled",false);
      $("input[name=economy]").attr("disabled",false);
      if($('[name="texting"]').is(':checked')){
        if(texting == 'Y'){
          if(texting == 'Y' && (data == 'N' || data == undefined)){
            texting_value = texting_val_yes;
          }else if(texting == 'Y' && (data == 'S' || data == 'R')){
            texting_value = texting_Yes_S_R_E1;
          }else if(texting == 'Y' && (data == 'E1') && (economy == 'Y')){
            texting_value = texting_Yes_S_R_E1;
          }else if(texting == 'Y' && (data == 'E1') && (economy == 'N')){
            texting_value = hidden_texting_val_N;
          }else if(texting == 'Y' && (data == 'D' || data == 'E' || data == 'P')){
            texting_value = 0;
          }
        }
        if(texting == 'N' || texting == 'X'){
          texting_value = 0;
        }
      }else{
        texting_value = 0;
      }
      
      if(data == 'N' || data == undefined){
        hidden_text = total_text_N;
      }else if(data == 'P' ){
        hidden_text = total_text_program_D_E_P;
      }else if(data == 'D' || data == 'E') {
      hidden_text = total_text_program_other;
      }else{
        hidden_text = total_text_program_other;
      }
      $("#total-text-program").html("");
    var value =  Number(package) + Number(texting_value) - Number(hidden_text);
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 =  Number(subpack) + Number(texting_value) - Number(hidden_text);
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));

      var hidden_total_text_program = Number(texting_value);
      $("#hidden_total_text_program").val(hidden_total_text_program);
      if(texting == 'Y' && (data == 'N' || data == undefined)){
      $("#hidden_texting").val(hidden_texting_val_N);
    }
    }          
});

$('input[name="total_text_program7"]').on('click', function() {
    var package = $(".package_value").val();
    var subpack = $(".sub_total").val();
    var data = $("input[name=package]:checked").val();

    if (this.checked) {
      if(data == 'N' || data == '') {
        $("span#total-text-program7").html("$69.99");
        $("span#total-text-program").html("");
        $("#main-design .row:nth-child(37)").removeClass('hidden');
      } else {
        $("span#total-text-program7").html("$39.99");
        $("span#total-text-program").html("");
        $("#main-design .row:nth-child(37)").removeClass('hidden');
      }

        if (data == 'N' || data == undefined) {
          total_text = total_text_program7_N;
        }else if (data == 'P') {
          total_text = total_text_program7_P;
        } else {
          total_text = total_text_program7_Y;
        }

        var value = Number(package) + Number(total_text);
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 = Number(subpack) + Number(total_text);
      
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));

      var hidden_total_text_program7 = Number(0);
      $("#hidden_total_text_program7").val(hidden_total_text_program7);

    } else {
      

      $("span#total-text-program7").html("");
      $("#main-design .row:nth-child(37)").addClass('hidden');
        var hidden_total_text_program7 = $("#hidden_total_text_program7").val();

        if (data == 'N' || data == undefined) {
          hidden_text = total_text_program7_N;
        }else if (data == 'P') {
          hidden_text = total_text_program7_P;
        } else {
          hidden_text = total_text_program7_Y;
        }
        var value = Number(package) - Number(hidden_text);
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 = Number(subpack) - Number(hidden_text);
      
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));

      var hidden_total_text_program7 = Number(0);
      $("#hidden_total_text_program7").val(hidden_total_text_program7);
        
        
    }
});
$('input[name="canada_service"]').on('click', function() {

  var package = $(".package_value").val();
    var subpack = $(".sub_total").val();
    var data = $("input[name=package]:checked").val();
  
  if (this.checked){
    console.log('checked');
    if(data == 'N' || data == '') {
        $("span#total-text-program7").html("$69.99");
        $("span#total-text-program").html("");
        $("#main-design .row:nth-child(37)").removeClass('hidden');
      } else {
        $("span#total-text-program7").html("$39.99");
        $("span#total-text-program").html("");
        $("#main-design .row:nth-child(37)").removeClass('hidden');
      }

        if (data == 'N' || data == undefined) {
          total_text = total_text_program7_N;
        }else if (data == 'P') {
          total_text = total_text_program7_P;
        } else {
          total_text = total_text_program7_Y;
        }
        if($('input[name="total_text_program7"]').is(':checked')){
          var value = Number(package) + Number(canada_service_val);
          var value2 = Number(subpack) + Number(canada_service_val);
        } else{
          var value = Number(package) + Number(canada_service_val) + Number(total_text);
          var value2 = Number(subpack) + Number(canada_service_val) + Number(total_text);
          $('input[name="total_text_program7"]').prop( "checked", true ); 
        }
    
    $('[name="total_text_program7"]').attr('disabled', true);

    
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));

      var hidden_total_text_program7 = Number(0);
  
  }else{
    console.log('unchecked');
    if(data == 'N' || data == '') {
        $("span#total-text-program7").html("$69.99");
        $("span#total-text-program").html("");
        $("#main-design .row:nth-child(37)").removeClass('hidden');
      } else {
        $("span#total-text-program7").html("$39.99");
        $("span#total-text-program").html("");
        $("#main-design .row:nth-child(37)").removeClass('hidden');
      }

        if (data == 'N' || data == undefined) {
          total_text = total_text_program7_N;
        }else if (data == 'P') {
          total_text = total_text_program7_P;
        } else {
          total_text = total_text_program7_Y;
        }

    $('[name="total_text_program7"]').removeAttr('disabled');
    var value = Number(package) - Number(canada_service_val);
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      var value2 = Number(subpack) - Number(canada_service_val);
      
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));

      var hidden_total_text_program7 = Number(0);
      $("#hidden_total_text_program7").val(hidden_total_text_program7);
  }
});

$('input[name="facebook"]').on('click', function() { 

  if ($('input[name="facebook_everything"]').prop("checked") == true) {
    var package = $(".package_value").val();
    var subpack = $(".sub_total").val();
    var package = Number(package) - facebook_everything_val;
    var subpack = Number(subpack) - facebook_everything_val;
    $('input[name="facebook_everything"]').prop('checked', false);
  }else{
    var package = $(".package_value").val();
    var subpack = $(".sub_total").val();         
  }

  if (this.checked) {
        var value =  Number(package) + facebook_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2)); 
      var value2 =  Number(subpack) + facebook_val;
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));     
    }else {
      var value =  Number(package) - facebook_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2)); 
      var value2 =  Number(subpack) - facebook_val;
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));   
    } 
  
});

$('input[name="facebook_everything"]').on('click', function() { 

  if ($('input[name="facebook"]').prop("checked") == true) {
    var package = $(".package_value").val();
    var subpack = $(".sub_total").val();

    var package = Number(package) - facebook_val;
    var subpack = Number(subpack) - facebook_val;

    $('input[name="facebook"]').prop('checked', false);
  }else{
    var package = $(".package_value").val();
    var subpack = $(".sub_total").val();
  }

    if (this.checked) {
        var value =  Number(package) + facebook_everything_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2)); 
      var value2 =  Number(subpack) + facebook_everything_val;
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));     
    }else {
      var value =  Number(package) - facebook_everything_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2)); 
      var value2 =  Number(subpack) - facebook_everything_val;
      $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));   
    }  

});

$('input[name="email_newsletter"]').on('click', function() { 
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();
    if(this.checked) {
      $(".package_value").val('');
        var value =  Number(package) + newsletter_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));      
      $(".sub_total").val('');
      var value2 =  Number(subpack) + newsletter_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));      
    }else{
      $(".package_value").val('');
        var value =  Number(package) - newsletter_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));
      $(".sub_total").val('');
      var value2 =  Number(subpack) - newsletter_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));      
    }
});

$('input[name="digital_biz_card"]').on('click', function() { 
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();
    if(this.checked) {
      $(".package_value").val('');
        var value =  Number(package) + biz_card_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));      
      $(".sub_total").val('');
      var value2 =  Number(subpack) + biz_card_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));      
    }else{
      $(".package_value").val('');
        var value =  Number(package) - biz_card_val; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));
      $(".sub_total").val('');
      var value2 =  Number(subpack) - biz_card_val; 
    $(".sub_total").val(value2.toFixed(2));
      $("input.sub_total").val(value2.toFixed(2));      
    }
});


$("input[name=design_one]").change(function(){
  $("#newsletters-design").html('');
  var radioId = $('input[type=radio][name=design_one]:checked').attr('id');
  $("#main-design .row:first-child").removeClass('hidden');
  if(radioId == 'SE'){
    var design_name = "Simple Newsletter English 2 pts";
  }else if(radioId == 'AE'){
    var design_name = " Advanced Newsletter English 4 pts";
  }else if(radioId == 'SS'){
    var design_name = "Simple Newsletter Spanish 2 pts";
  }else if(radioId == 'AS'){
    var design_name = "Advanced Newsletter Spanish 4 pts";
  }else if(radioId == 'SB'){
    var design_name = "Simple Newsletter Both 2 pts";
  }else if(radioId == 'no'){
    var design_name = "No Subscription";
    $("#main-design .row:first-child").addClass('hidden');
  }else if(radioId == 'AB'){
    var design_name = "Advanced Newsletter Both 4 pts";
  }

  $("#newsletters-design").html(design_name);
  var hidden_value = $("#hidden_newsletter").val();
  if(hidden_value != ''){
    $("#hidden_newsletter").val('');
    var radioId = $('input[type=radio][name=design_one]:checked').attr('id');
    $("#hidden_newsletter").val(radioId);
  }else{
    var radioId = $('input[type=radio][name=design_one]:checked').attr('id');
    $("#hidden_newsletter").val(radioId);
  }
});
$("input[name=design_two]").change(function(){
  $("#director-name-stars").html('');
  var design_two = $('input[type=radio][name=design_two]:checked').val();
  $("#director-name-stars").html(design_two);
});
$("input[name=wholesale_amount]").change(function(){
  $("#wholesale-one").html('');
  var wholesale_amount = $('input[type=radio][name=wholesale_amount]:checked').val();
  $("#wholesale-one").html(wholesale_amount);
});
$("input[name=wholesale_section]").change(function(){
  $("#wholesale-two").html('');
  var wholesale_section = $('input[type=radio][name=wholesale_section]:checked').val();
  $("#wholesale-two").html(wholesale_section);
});
$("input[name=court_sale]").change(function(){
  $("#court-sale-one").html('');
  var court_sale = $('input[type=radio][name=court_sale]:checked').val();
  $("#court-sale-one").html(court_sale);
});
$("input[name=court_sale_director]").change(function(){
  $("#court-sale-two").html('');
  var court_sale_director = $('input[type=radio][name=court_sale_director]:checked').val();
  $("#court-sale-two").html(court_sale_director);
});
$("input[name=court_sharing]").change(function(){
  $("#court-sale-three").html('');
  var court_sharing = $('input[type=radio][name=court_sharing]:checked').val();
  $("#court-sale-three").html(court_sharing);
});
$("input[name=court_sharing_director]").change(function(){
  $("#court-sale-four").html('');
  var court_sharing_director = $('input[type=radio][name=court_sharing_director]:checked').val();
  $("#court-sale-four").html(court_sharing_director);
});
$("input[name=birthday_rec]").change(function(){
  $("#celebrate-birthday").html('');
  var birthday_rec = $('input[type=radio][name=birthday_rec]:checked').val();
  $("#celebrate-birthday").html(birthday_rec);
});
$("input[name=wholesale_remove_name]").blur(function(){
  $("#wholesale-three").html('');
  var wholesale_remove_name = $('input[type="text"][name="wholesale_remove_name"]').val();
  $("#wholesale-three").html(wholesale_remove_name);
});
$("input[name=wholesale_remove]").blur(function(){
  $("#wholesale-four").html('');
  var wholesale_remove = $('input[type=text][name=wholesale_remove]').val();
  $("#wholesale-four").html(wholesale_remove);
});
$("input[name=special_news_request]").blur(function(){
  $("#spacial-request").html('');
  var special_news_request = $('input[type=text][name=special_news_request]').val();
  $("#spacial-request").html(special_news_request);
});
$("input[name=beatly_url]").blur(function(){
  $("#english-bitly").html('');
  var beatly_url = $('input[type=text][name=beatly_url]').val();
  $("#english-bitly").html(beatly_url);
});
$("input[name=beatly_url_one]").blur(function(){
  $("#spanish-bitly").html('');
  var beatly_url_one = $('input[type=text][name=beatly_url_one]').val();
  $("#spanish-bitly").html(beatly_url_one);
});

$("input[name=beatly_url_two]").blur(function(){
  $("#spanish-bitly").html('');
  var beatly_url_two = $('input[type=text][name=beatly_url_two]').val();
  $("#french-bitly").html(beatly_url_two);
});

$('input[name="distribution_two"]').on('click', function() { 
  $("#facebook-posting").html('');
    if (this.checked) {
      var distribution_two = "X - 2 pts";
      $("#facebook-posting").html(distribution_two);
      $("#main-design .row:nth-child(2)").removeClass('hidden');    
    }else {
      var distribution_two = "";
      $("#facebook-posting").html(distribution_two);
      $("#main-design .row:nth-child(2)").addClass('hidden');   
    }          
});

$('input[name="distribution_three"]').on('click', function() { 
  $("#front-color").html('');    
    if (this.checked) {
      var distribution_three = "Front page color option with 2 pts";
      $("#front-color").html(distribution_three);      
    }else {
      var distribution_three = "";
      $("#front-color").html(distribution_three);    
    }          
});

$('input[name="birthday_one"]').change(function() { 
  $("#birthday").html('');
  var birthday_value = $('input[type="radio"][name="birthday_one"]:checked').val();
  if(birthday_value == '2'){
    birthday_one =  'X - 2 pts';
    $("#main-design .row:nth-child(3)").removeClass('hidden'); 
  }else if(birthday_value == '1'){
    birthday_one = 'X - 1 pts';
    $("#main-design .row:nth-child(3)").removeClass('hidden'); 
  }else if(birthday_value == '0'){
    birthday_one = 'No Subscription';
    $("#main-design .row:nth-child(3)").addClass('hidden'); 
  }
  $("#birthday").html(birthday_one);
});

$('input[name="anniversary_one"]').change(function() { 
  $("#anniversary").html('');
  var anniversary_value = $('input[type="radio"][name="anniversary_one"]:checked').val();
  if(anniversary_value == '2'){
    anniversary_one =   'X - 2 pts';
    $("#main-design .row:nth-child(4)").removeClass('hidden'); 
  }else if(anniversary_value == '1'){
    anniversary_one = ' X - 1 pts';
    $("#main-design .row:nth-child(4)").removeClass('hidden'); 
  }else if(anniversary_value == '0'){
    anniversary_one = 'No Subscription';
    $("#main-design .row:nth-child(4)").addClass('hidden'); 
  }
  $("#anniversary").html(anniversary_one);
});

$('input[name="status_one"]').on('click', function() { 
  $("#A3-post-card").html('');   
    if (this.checked) {
      var status_one = "X - 1 pts";
      $("#A3-post-card").html(status_one);
      $("#main-design .row:nth-child(5)").removeClass('hidden');     
    }else {
      var status_one = "";
      $("#A3-post-card").html(status_one);
      $("#main-design .row:nth-child(5)").addClass('hidden'); 
    }          
});

$('input[name="status_two"]').on('click', function() { 
  $("#I1-post-card").html('');
    if (this.checked) {
      var status_two = "X - 1 pts";
      $("#I1-post-card").html(status_two);
      $("#main-design .row:nth-child(6)").removeClass('hidden');       
    }else {
      var status_two = "";
      $("#I1-post-card").html(status_two); 
      $("#main-design .row:nth-child(6)").addClass('hidden');   
    }          
});

$('input[name="status_three"]').on('click', function() { 
  $("#I2-post-card").html('');    
    if (this.checked) {
      var status_three = "X - 1 pts";
      $("#I2-post-card").html(status_three);
      $("#main-design .row:nth-child(7)").removeClass('hidden');    
    }else {
      var status_three = "";
      $("#I2-post-card").html(status_three);
      $("#main-design .row:nth-child(7)").removeClass('hidden'); 
    }          
});

$('input[name="status_four"]').on('click', function() { 
  $("#I3-post-card").html('');  
    if (this.checked) {
      var status_four = "X - 1 pts";
      $("#I3-post-card").html(status_four);
      $("#main-design .row:nth-child(8)").removeClass('hidden');   
    }else {
      var status_four = "";
      $("#I3-post-card").html(status_four);
      $("#main-design .row:nth-child(8)").addClass('hidden');
    }          
});

$('input[name="status_five"]').on('click', function() { 
  $("#T1-post-card").html('');    
    if (this.checked) {
      var status_five = "X - 1 pts";
      $("#T1-post-card").html(status_five);
      $("#main-design .row:nth-child(9)").removeClass('hidden');      
    }else {
      var status_five = "";
      $("#T1-post-card").html(status_five);
      $("#main-design .row:nth-child(9)").addClass('hidden');   
    }          
});

$('input[name="status_six"]').on('click', function() { 
  $("#ordering-post-card").html('');    
    if (this.checked) {
      var status_six = "X - 1 pts";
      $("#ordering-post-card").html(status_six);
      $("#main-design .row:nth-child(10)").removeClass('hidden');
    }else {
      var status_six = "";
      $("#ordering-post-card").html(status_six);
      $("#main-design .row:nth-child(10)").addClass('hidden');   
    }          
});

if ($('input[name="status_seven"]').is(":checked")) {
  $('input#but').removeClass('btn-red');
  $('input#but').addClass('btn-green');
}else {
  $('input#but').removeClass('btn-green');
  $('input#but').addClass('btn-red');
}   

$('input[name="status_seven"]').on('click', function() { 
  $("#consistency-club").html('');   
    if (this.checked) {
      $('input#but').removeClass('btn-red');
      $('input#but').addClass('btn-green');
      var status_seven = "X - 2 pts";
      $("#consistency-club").html(status_seven);
      $("#main-design .row:nth-child(11)").removeClass('hidden');
    }else {
      $('input#but').removeClass('btn-green');
      $('input#but').addClass('btn-red');
      var status_seven = "";
      $("#consistency-club").html(status_seven);
      $("#main-design .row:nth-child(11)").addClass('hidden');   
    }          
});

$('input[name="status_seven1"]').on('click', function() { 
  $("#send-to-director").html('');
    if (this.checked) {
      var status_seven1 = "send to director with 1 pts";
      $("#send-to-director").html(status_seven1);
      $("#main-design .row:nth-child(12)").removeClass('hidden');   
    }else {
      var status_seven1 = "";
      $("#send-to-director").html(status_seven1);  
      $("#main-design .row:nth-child(12)").addClass('hidden');  
    }          
});

$('input[name="status_eight"]').on('click', function() { 
  $("#star-on-target").html('');  
    if (this.checked) {
      var status_eight = "X - 1 pts";
      $("#star-on-target").html(status_eight);
      $("#main-design .row:nth-child(13)").removeClass('hidden');      
    }else {
      var status_eight = "";
      $("#star-on-target").html(status_eight);
      $("#main-design .row:nth-child(13)").addClass('hidden');   
    }          
});

$('input[name="status_eight1"]').change(function() { 
  $("#star-on-target-y-n").html('');
  var status_eight1 = $('input[type=radio][name=status_eight1]:checked').val();
  $("#star-on-target-y-n").html(status_eight1);
});

$('input[name="status_nine"]').on('click', function() { 
  $("#star-gift").html(''); 
    if (this.checked) {
      var status_nine = "X - 1 pts";
      $("#star-gift").html(status_nine); 
      $("#main-design .row:nth-child(14)").removeClass('hidden');     
    }else {
      var status_nine = "";
      $("#star-gift").html(status_nine);
      $("#main-design .row:nth-child(14)").addClass('hidden');    
    }          
});

$('input[name="last_one"]').change(function() { 
  $("#last-month").html('');
  var pointVal = $('input[type=radio][name=last_one]:checked').val();
  if(pointVal == '2'){
    var last_one = "X - 2 pts";
    $("#main-design .row:nth-child(15)").removeClass('hidden'); 
  }else if(pointVal == '1'){
    var last_one = "X - 1 pts";
    $("#main-design .row:nth-child(15)").removeClass('hidden'); 
  }else if(pointVal == '0'){
    var last_one = "No Subscription";
    $("#main-design .row:nth-child(15)").addClass('hidden'); 
  }
  $("#last-month").html(last_one);
});

$('input[name="gift_one"]').on('click', function() { 
  $("#monthly-post-card").html('');   
    if (this.checked) {
      var gift_one = "X - 3 pts";
      $("#monthly-post-card").html(gift_one);
      $("#main-design .row:nth-child(16)").removeClass('hidden');       
    }else {
      var gift_one = "";
      $("#monthly-post-card").html(gift_one);
      $("#main-design .row:nth-child(16)").addClass('hidden');   
    }          
});

$('input[name="gift_two"]').on('click', function() { 
  $("#ytd-post-card").html('');   
    if (this.checked) {
      var gift_two = "X - 3 pts";
      $("#ytd-post-card").html(gift_two);
      $("#main-design .row:nth-child(17)").removeClass('hidden');      
    }else {
      var gift_two = "";
      $("#ytd-post-card").html(gift_two);
      $("#main-design .row:nth-child(17)").addClass('hidden');    
    }          
});

$('input[name="gift_three"]').on('click', function() { 
  $("#recruiting-post-card").html('');      
    if (this.checked) {
      var gift_three = "X - 3 pts";
      $("#recruiting-post-card").html(gift_three);
      $("#main-design .row:nth-child(18)").removeClass('hidden');    
    }else {
      var gift_three = "";
      $("#star-gift").val(gift_three); 
      $("#main-design .row:nth-child(18)").addClass('hidden');   
    }          
});
$('input[name="gift_four"]').on('click', function() { 
  $("#star-gift").html('');
    if (this.checked) {
      var gift_four = "Send to director";
      $("#send-gift-card").html(gift_four);      
    }else {
      var gift_four = "";
      $("#star-gift").html(gift_four);    
    }          
});
$('input[name="gift_five"]').on('click', function() { 
  $("#reds").html('');   
    if (this.checked) {
      var gift_five = "X - 2 pts";
      $("#reds").html(gift_five);
      $("#main-design .row:nth-child(19)").removeClass('hidden');     
    }else {
      var gift_five = "";
      $("#reds").html(gift_five); 
      $("#main-design .row:nth-child(19)").addClass('hidden');    
    }          
});
$('input[name="star_program"]').on('click', function() { 
  $("#star").html('');   
    if (this.checked) {
      var star = "X - 2 pts";
      $("#star").html(star);
      $("#main-design .row:nth-child(20)").removeClass('hidden');       
    }else {
      var star = "";
      $("#star").html(star);
      $("#main-design .row:nth-child(20)").addClass('hidden');    
    }          
});
$('input[name="consultant_one"]').on('click', function() { 
  $("#consultant-one").html('');    
    if (this.checked) {
      var consultant_one = "X - 1 pts";
      $("#consultant-one").html(consultant_one);
      $("#main-design .row:nth-child(21)").removeClass('hidden');    
    }else {
      var consultant_one = "";
      $("#consultant-one").html(consultant_one);
      $("#main-design .row:nth-child(21)").addClass('hidden');     
    }          
});
$('input[name="consultant_two"]').on('click', function() { 
  $("#consultant-two").html('');
    if (this.checked) {
      var consultant_two = "X - 1 pts";
      $("#consultant-two").html(consultant_two);
      $("#cons_yes").prop("checked", true);
      $("#main-design .row:nth-child(22)").removeClass('hidden'); 
    }else {
      var consultant_two = "";
      $("#consultant-two").html(consultant_two);
      $("#cons_yes").prop("checked", false);   
      $("#cons_no").prop("checked", true); 
      $("#main-design .row:nth-child(22)").addClass('hidden');  
    }          
});
$('input[name="consultant_two1"]').change(function() { 
  $("#consultant-two1").html('');
  var pointVal = $('input[type=radio][name=consultant_two1]:checked').val();
  var consultant_two1 = pointVal;
  $("#consultant-two1").html(consultant_two1);
  $("#main-design .row:nth-child(23)").removeClass('hidden');
});
$('input[name="consultant_three"]').on('click', function() { 
  $("#consultant-three").html('');      
    if (this.checked) {
      var consultant_three = "X - 1 pts";
      $("#consultant-three").html(consultant_three);
      $("#main-design .row:nth-child(24)").removeClass('hidden');      
    }else {
      var consultant_three = "";
      $("#consultant-three").html(consultant_three);
      $("#main-design .row:nth-child(24)").addClass('hidden');   
    }          
});
$('input[name="consultant_four"]').change(function() { 
  $("#consultant-seven").html('');
  var consultantVal = $('input[type=radio][name=consultant_four]:checked').val()
  if(consultantVal == 'U'){
    var consultant_four = "Use UA Packet only";
  }
  else if(consultantVal == 'A'){
    var consultant_four = "Adding pages into UA Packet";
  }
  else if(consultantVal == 'P'){
    var consultant_four = "Own Spanish";
  }
  else if(consultantVal == 'S'){
    var consultant_four = "Own English";
  }
  else if(consultantVal == 'N'){
    var consultant_four = "No Subscription";
  }
  $("#consultant-seven").html(consultant_four);
});
$('input[name="consultant_five"]').on('click', function() { 
  $("#consultant-four").html('');
  if(this.checked) {
      var consultant_five = "X - 1 pts";
    $("#consultant-four").html(consultant_five);
    $("#main-design .row:nth-child(25)").removeClass('hidden'); 
  }else{
    var consultant_five = "";
    $("#consultant-four").html('No subscription');
    $("#main-design .row:nth-child(25)").addClass('hidden'); 
  }
});
$('input[name="consultant_six"]').on('click', function() { 
  $("#consultant-six").html('');     
    if (this.checked) {
      var consultant_six = "X - 1 pts";
      $("#consultant-six").html(consultant_six); 
      $("#main-design .row:nth-child(26)").removeClass('hidden');      
    }else {
      var consultant_six = "";
      $("#consultant-six").html(consultant_six); 
      $("#main-design .row:nth-child(26)").addClass('hidden');    
    }          
});
$('.new-con-text').change(function() { 
  $("#consultant-five").html('');
  var consultant_seven = $('.new-con-text').val();
  $("#consultant-five").html('X -' + consultant_seven);
  $("#main-design .row:nth-child(27)").removeClass('hidden');
});
$('input[name="no_email_option"]').on('click', function() { 
  $("#news-option-one").html('');      
    if (this.checked) {
      var no_email_option = "no email option";
      $("#news-option-one").html(no_email_option);      
    }else {
      var no_email_option = "";
      $("#news-option-one").html(no_email_option);    
    }          
});
$('input[name="override_color"]').on('click', function() { 
  $("#news-option-two").html('');  
    if (this.checked) {
      var override_color = "override color";
      $("#news-option-two").html(override_color);      
    }else {
      var override_color = "";
      $("#news-option-two").html(override_color);    
    }          
});
$('input[name="auto_send"]').blur(function() { 
  $("#news-option-three").html('');
  var val = $('input[type=text][name=auto_send]').val();
  $("#news-option-three").html(val);
});
$('input[name="override_black_white"]').on('click', function() { 
  $("#news-option-four").html('');  
    if (this.checked) {
      var override_black_white = "override b/w";
      $("#news-option-four").html(override_black_white);      
    }else {
      var override_black_white = "";
      $("#news-option-four").html(override_black_white);    
    }          
});
$('input[name="english_only"]').on('click', function() { 
  $("#news-option-five").html('');  
    if (this.checked) {
      var english_only = "english only newsletter";
      $("#news-option-five").html(english_only);      
    }else {
      var english_only = "";
      $("#news-option-five").html(english_only);    
    }          
});
$('#newsletter-note').change(function() { 
  $("#news-option-six").html('');
  var note = $('#newsletter-note').val();
  $("#news-option-six").html(note);
});

$('input[name="n_zero"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="n_one"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="n_two"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="n_three"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="a_one"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="a_two"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="a_three"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="i_one"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="i_two"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="i_three"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="t_one"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="t_two"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="t_three"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});
$('input[name="t_four"]').change(function() { 
  var n_zero = $('input[type=radio][name=n_zero]:checked').val();
  var n_one = $('input[type=radio][name=n_one]:checked').val();
  var n_two = $('input[type=radio][name=n_two]:checked').val();
  var n_three = $('input[type=radio][name=n_three]:checked').val();
  var a_one = $('input[type=radio][name=a_one]:checked').val();
  var a_two = $('input[type=radio][name=a_two]:checked').val();
  var a_three = $('input[type=radio][name=a_three]:checked').val();
  var i_one = $('input[type=radio][name=i_one]:checked').val();
  var i_two = $('input[type=radio][name=i_two]:checked').val();
  var i_three = $('input[type=radio][name=i_three]:checked').val();
  var t_one = $('input[type=radio][name=t_one]:checked').val();
  var t_two = $('input[type=radio][name=t_two]:checked').val();
  var t_three = $('input[type=radio][name=t_three]:checked').val();
  var t_four = $('input[type=radio][name=t_four]:checked').val();
  var final = '';
  if(n_zero != 'N'){
    final += 'N0';
  }
  if(n_one != 'N'){
    final += (final == '') ? 'N1' : ',N1';
  }
  if(n_two != 'N'){
    final += (final == '') ? 'N2' : ',N2';
  }
  if(n_three != 'N'){
    final += (final == '') ? 'N3' : ',N3';
  }
  if(a_one != 'N'){
    final += (final == '') ? 'A1' : ',A1';
  }
  if(a_two != 'N'){
    final += (final == '') ? 'A2' : ',A2';
  }
  if(a_three != 'N'){
    final += (final == '') ? 'A3' : ',A3';
  }
  if(i_one != 'N'){
    final += (final == '') ? 'I1' : ',I1';
  }
  if(i_two != 'N'){
    final += (final == '') ? 'I2' : ',I2';
  }
  if(i_three != 'N'){
    final += (final == '') ? 'I3' : ',I3';
  }
  if(t_one != 'N'){
    final += (final == '') ? 'T1' : ',T1';
  }
  if(t_two != 'N'){
    final += (final == '') ? 'T2' : ',T2';
  }
  if(t_three != 'N'){
    final += (final == '') ? 'TP' : ',TP';
  }
  if(t_four != 'N'){
    final += (final == '') ? 'TS' : ',TS';
  }

  $("#n0").html(final);
  $("#main-design .row:nth-child(28)").removeClass('hidden');
});


$('input[name="unit_size"]').change(function() { 
  $("#actual-unit").html('');
  var unit_size = $('input[name=unit_size]').val();
  $("#actual-unit").html(unit_size);
  $("#main-design .row:nth-child(29)").removeClass('hidden');
});

$('#point_credit').change(function() { 
  $("#point-credit").html('');
  var unit_size = $(this).val();
  $("#point-credit").html(unit_size);
  $("#main-design .row:nth-child(29)").removeClass('hidden');
});
$('input[name="cc_number"]').change(function() { 
  $("#cc_num").html('');
  var unit_size = $(this).val();
  $("#cc_num").html(unit_size.slice(unit_size.length - 4));
});

//package change
$('input[name="package"]').change(function() { 
  $("#package").html('');
  var package = $('input[type=radio][name=package]:checked').val();
  if(package == 'S' || package == 'R' || package == 'E1' || package == 'D' || package == 'E' || package == 'E1'){
    $("#total-text-program").html("$29.99");
  }else if(package == 'P'){
    $("#total-text-program").html("$9.99");
  }else if(package == 'N' || package == ''){
    $("#total-text-program").html("$59.99");
  }else{
    $("#total-text-program").html("");
  }

  if ($('input[name="total_text_program7"]').is(':checked')) {
    $('[name="total_text_program"]').attr('disabled', true);
    if(package == 'N' || package == ''){
      $("span#total-text-program7").html("$69.99");
    }else{
      $("span#total-text-program7").html("$39.99");
    }
  }

  $("#package").html(package);
  $("#main-design .row:nth-child(30)").removeClass('hidden');
  if(package !=''){
    $("#texting").html("*");
  }
});

$('input[name="facebook"]').on('click', function() { 
  $("#facebook-newsletter").html('');  
    if (this.checked) {
      var facebook = "Facebooking newsletter with $19.99";
      $("#facebook-newsletter").html(facebook);
      $("#main-design .row:nth-child(31)").removeClass('hidden');     
    }else {
      var facebook = "";
      $("#facebook-newsletter").html(facebook);
      $("#main-design .row:nth-child(31)").addClass('hidden');    
    }          
});

$('input[name="facebook_everything"]').on('click', function() { 
  $("#facebook-everything-newsletter").html('');  
    if (this.checked) {
      var facebook_everything = "Facebooking Everything with $49.99";
      $("#facebook-everything-newsletter").html(facebook_everything);
      $("#main-design .row:nth-child(31)").removeClass('hidden');     
    }else {
      var facebook_everything = "";
      $("#facebook-everything-newsletter").html(facebook_everything);
      $("#main-design .row:nth-child(31)").addClass('hidden');    
    }          
});


$('input[name="emailing"]').change(function() { 
  $("#newsletter").html('');
  var emailing_value = $('input[type=radio][name=emailing]:checked').val();
  if(emailing_value == '1'){
    var emailing = "Newsletter with $38";
    $("#main-design .row:nth-child(32)").removeClass('hidden');
  }
  else if(emailing_value == '2'){
    var emailing = "Newsletter with $55";
    $("#main-design .row:nth-child(32)").removeClass('hidden');
  }
  else if(emailing_value == '0'){
    var emailing = "Newsletter with no subscription with no pts";
    $("#main-design .row:nth-child(32)").addClass('hidden');
  }
  $("#newsletter").html(emailing);
});
$('input[name="email_newsletter"]').on('click', function() { 
  $("#email-newsletter").html('');    
    if (this.checked) {
      var email = "emailing of newsletter with $19.99";
      $("#email-newsletter").html(email);
      $("#main-design .row:nth-child(35)").removeClass('hidden');    
    }else {
      var email = "";
      $("#email-newsletter").html(email);
      $("#main-design .row:nth-child(35)").addClass('hidden');   
    }          
});

$('input[name="distribution_one"]').on('click', function() { 
  $("#digital_biz_card-v").html('');    
    if (this.checked) {
      var distribution_one = $("input[name='distribution_one']").val();
      var email = "X - "+ distribution_one;
      $("#digital_biz_card-v").html(email);
      $("#main-design .row:nth-child(33)").removeClass('hidden');    
    }else {
      var email = "";
      $("#digital_biz_card-v").html(email);
      $("#main-design .row:nth-child(33)").addClass('hidden');
    }          
});


$('input[name="canada_service"]').on('click', function() { 
  $("#canada-service-v").html('');    
    if (this.checked) {
      var email = "$99";
      $("#canada-service-v").html(email);
      $("#main-design .row:nth-child(34)").removeClass('hidden');      
    }else {
      var email = "";
      $("#canada-service-v").html(email);
      $("#main-design .row:nth-child(34)").addClass('hidden');   
    }          
});


$('input[name="spanish_consultant"]').on('click', function() { 
  $("#spanish-consultant").html('');
    if (this.checked) {
      var spanish_consultant  = 'Director has spanish consultants';
    }else {
      var spanish_consultant = "";
    }
    $("#spanish-consultant").html(spanish_consultant);              
});
$('input[name="cu_routing"]').blur(function() { 
  $("#routing").html('');
  var cu_routing = $('input[type=text][name=cu_routing]').val();
  $("#routing").html(cu_routing);
});
$('input[name="cv_account"]').blur(function() { 
  $("#account").html('');
  var cv_account = $('input[type=text][name=cv_account]').val();
  $("#account").html(cv_account);
});
$('.package-area-note').blur(function() { 
  $("#package-note").html('');
  var package_note = $('.package-area-note').val();
  $("#package-note").html(package_note);
});

$("textarea[name='invoice_note']").change(function() { 
  $("#invoice-note").html('');
  var invoice_note = $("textarea[name='invoice_note']").val();
  $("#invoice-note").html(invoice_note);
});

$('#text_note').blur(function() { 
  $("#text-note").html('');
  var text_note = $('#text_note').val();
  $("#text-note").html(text_note);
});

$('input[name="terms_condition"]').on('click', function() { 
  $("#term-con").html(''); 
    if (this.checked) {
      var terms_condition  = 'Agree';
    }else {
      var terms_condition = "";
    }
    $("#term-con").html(terms_condition);              
});
$('input[name="send_mail"]').on('click', function() { 
  $("#send-mail").html('');       
    if (this.checked) {
      var send_mail  = 'Yes';
    }else {
      var send_mail = "No";
    }
    $("#send-mail").html(send_mail);              
});
$('input[name="signature_date"]').blur(function() { 
  $("#date").html('');
  var signature_date = $('input[type=text][name=signature_date]').val();
  $("#date").html(signature_date);
});
$('input[name="text_system"]').change(function() { 
  $("#text-package").html('');
  var texting_val = $('input[type=radio][name=text_system]:checked').val();
  if(texting_val == '1'){
      var text_system = "Text and Email ";
  }
  else if(texting_val == '2'){
      var text_system = "Email Only"; 
  }
  else if(texting_val == '3'){
      var text_system = "Text Only";  
  }
  else if(texting_val == '4'){
      var text_system = "No Text or Email"; 
  }
  $("#text-package").html(text_system);
});
$(document).on('change', 'input[name="emailing"]', function() {
   checkValue();
});

$(document).on('change', 'input[name="economy"]', function() {
   checkEconomyValue();
});

$("input[name=name]").change(function(){
  $("#name_val").text('');
  var name = $("#client_name").val();
  $("#name_val").text(name);
  $("#name_client").val(name);
  var Biz_link = 'www.unitassist.com/';
  var BIX = $(this).val().replace(/ /g,'')
  $('#buzz_link').val(Biz_link+BIX);

});

$(document).ready(function(){
  var package_for = $('input[type=radio][name=package_for]:checked').val();
  if(package_for == 'C'){
    $(".future-date").hide();
  }
  else if(package_for =='F'){
    $(".future-date").show();
  }

  $("#next").click(function(){
    
    $("#name_val").text('');
      var name = $("#client_name").val();
      $("#name_val").text(name);
  });
});
$(document).ready(function(){
  var button = $("#hidden_val").val();
  if(button == ''){
    $("#but").addClass('btn-status');
  }else{
    $("#but").removeClass('btn-status');
  }
});

$("#user_profile_pic").change(function(){
    var val = $(this).val();   
    var file_size = this.files[0].size;
  switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
      case 'gif': case 'jpg': case 'png': case 'jpeg':
        $("#next").attr('disabled',false);
        $(".upload_error").html('');
          break;
      default:
          $(this).val('');
          $(".upload_error").html('Please upload valid image!!');
          $("#next").attr('disabled',true);
          break;
  } 
});


$('#save').click(function(event) { 
  var formdata = $("#form1").serialize();
  $("input[name=texting]").attr("disabled",false);
  $("input[name=economy]").attr("disabled",false);

  if($('input[name=first_bill_date]').val() == '') {
    event.preventDefault();
    $('.perror').remove();
    $('.fbilld').append('<p class="perror">Please Fill First Bill Date</p>');
  }else {
    $('.perror').remove();
    $('#save_hidden').val('saved');
    document.getElementById("form1").submit();
  }
});

$(document).ready(function(){
  
  var gbpk_val1 =  $('#hidden_package').val();
  var gbpk_val_main1 = $('input.package_value').val();
  var gbpk_val =  $('#hidden_package').val();
  var gbpk_val_main = $('input.package_value').val();

  var sub_val1 =  $('input.sub_total').val();
  var sub_val_main1 = $('input.sub_total').val();
  var sub_val =  $('input.sub_total').val();
  var sub_val_main = $('input.sub_total').val();

  $('input[name="package"]').bind("change",function(){
    
    if(isNaN(parseFloat($('#special_creadit_old').val()))) {
      $('#special_creadit_old').val(0);
    }

    var minus = parseFloat($('input#special_creadit').val());
    var spe_old = parseFloat($('#special_creadit_old').val());

    var gbpk_val1 =  $('#hidden_package').val();
    var gbpk_val_main1 = $('input.package_value').val();

    var sub_val1 =  $('.sub_total').val();
    var sub_val_main1 = $('input.sub_total').val();

    if(minus == 0 || minus == '0') {
      var gbpk_val1 =  $('#hidden_package').val();
      var gbpk_val_main1 = $('input.package_value').val();

      var sub_val1 =  $('input.sub_total').val();
      var sub_val_main1 = $('input.sub_total').val();
    }

    if(minus >= 0) {
      var total = parseFloat(gbpk_val1 - minus);
      var total2 = parseFloat(gbpk_val_main1 - minus);

      var total1 = parseFloat(sub_val1 - minus);
      var total21 = parseFloat(sub_val_main1 - minus);

      $('#hidden_package').val(total.toFixed(2));
      $('input.package_value').val(total2.toFixed(2));

      $('input.sub_total').val(total1.toFixed(2));
      $('input.sub_total').val(total21.toFixed(2));
    }

    $('#special_creadit_old').val(parseFloat(minus));
  });
  

  $('input#special_creadit').on("change",function(){

    if(isNaN(parseFloat($('#special_creadit_old').val()))) {
      $('#special_creadit_old').val(0);
    }

    var minus = parseFloat($('input#special_creadit').val());
    var spe_old = parseFloat($('#special_creadit_old').val());

    $('#hidden_package').val(parseFloat($('#hidden_package').val()) + spe_old);
    $('input.package_value').val(parseFloat($('input.package_value').val()) + spe_old);

    $('input.sub_total').val(parseFloat($('input.sub_total').val()) + spe_old);
    $('input.sub_total').val(parseFloat($('input.sub_total').val()) + spe_old);

    var gbpk_val1 =  $('#hidden_package').val();
    var gbpk_val_main1 = $('input.package_value').val();

    var sub_val1 =  $('input.sub_total').val();
    var sub_val_main1 = $('input.sub_total').val();

    if(minus == 0 || minus == '0') {
      var gbpk_val1 =  $('#hidden_package').val();
      var gbpk_val_main1 = $('input.package_value').val();

      var sub_val1 =  $('input.sub_total').val();
      var sub_val_main1 = $('input.sub_total').val();
    }

    if(minus >= 0) {
      var total = parseFloat(gbpk_val1 - minus);
      var total2 = parseFloat(gbpk_val_main1 - minus);
      $('#hidden_package').val(total.toFixed(2));
      $('input.package_value').val(total2.toFixed(2));

      var total1 = parseFloat(sub_val1 - minus);
      var total21 = parseFloat(sub_val_main1 - minus);
      $('input.sub_total').val(total1.toFixed(2));
      $('input.sub_total').val(total21.toFixed(2));
    }

    if(isNaN(minus)) {
      $('#special_creadit_old').val(0); 
    }else {
      $('#special_creadit_old').val(parseFloat(minus));
    }
  });
});

$(document).ready(function(){ 
  
  if($('input[name=account_detail]:checked').val() == 'Y') {
        $('.account_detail_routing').show();
        $('.account_detail_cc').hide();
    }else {
      $('.account_detail_routing').hide();
        $('.account_detail_cc').show();
    }

    $('input[name="cc_expir_date"]').keyup(function() {
      var leng = $(this).val().length;
      if(leng == 2) {
      var val = $('input[name="cc_expir_date"]').val();
      $('input[name="cc_expir_date"]').val(val+'/');      
        
      }
    });
    $('input[name="month_billing"]').keyup(function() {
      var leng = $(this).val().length;
      if(leng == 2) {
      var val = $('input[name="month_billing"]').val();
      $('input[name="month_billing"]').val(val+'/');      
        
      }
    });

  $('.account_detail').change(function() {
        if($(this).val() == 'Y') {
            $('.account_detail_routing').show();
            $('.account_detail_cc').hide();
        }else {
          $('.account_detail_routing').hide();
            $('.account_detail_cc').show();
        }
        
    });


  $('input[name="package"]').bind("change",function(){  
    if($('input[name="personal_unit_app"]').is(':checked') || $('input[name="personal_website"]').is(':checked')){  
      if($(this).val() == 'N') {
        var total1 = parseFloat($('input.package_value').val());
        $('input.package_value, input#hidden_package').val((total1 + parseFloat(59.99) ).toFixed(2));
        var total11 = parseFloat($('input.sub_total').val());
        $('input.sub_total, inputinput.sub_total').val((total11 + parseFloat(59.99) ).toFixed(2));
      }else if($(this).val() == 'S' || $(this).val() == 'R' || $(this).val() == 'E1' || $(this).val() == 'D' || $(this).val() == 'E' || $(this).val() == 'P'){
        var total1 = parseFloat($('input.package_value').val());
        $('input.package_value, input#hidden_package').val((total1 + parseFloat(29.99) ).toFixed(2));
        var total11 = parseFloat($('input.sub_total').val());
        $('input.sub_total, inputinput.sub_total').val((total11 + parseFloat(29.99) ).toFixed(2));
      }
    }

    if($('input[name="personal_url"]').is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total1 + personal_url_val).toFixed(2));
      var total11 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total11 + personal_url_val).toFixed(2));
    }

    if($('input[name="personal_unit_app_ca"]').is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total1 + personal_unit_app_ca_val).toFixed(2));
      var total11 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total11 + personal_unit_app_ca_val).toFixed(2));
    }
    
    if($('input[name="subscription_updates"]').is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total1 + subscription_updates_val).toFixed(2));
      var total11 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total11 + subscription_updates_val).toFixed(2));
    }

    if($('input[name="app_color"]').is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total1 + app_color_val).toFixed(2));
      var total11 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total11 + app_color_val).toFixed(2));
    }
  });

  $('input[name="personal_unit_app"]').on('change',function(){
    if($(this).is(':checked')){
      jQuery('input[name="personal_website"]').prop("disabled", true);
      if($('input[name="personal_website"]').is(':checked')){
        return false;
      }else {
        if($('input[name=package]:checked').val() == 'N'){
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + parseFloat(59.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + parseFloat(59.99) ).toFixed(2));

          $('#personal_unit_app').html(parseFloat(59.99).toFixed(2));

        }else if($('input[name=package]:checked').val() == 'S' || $('input[name=package]:checked').val() == 'R' || $('input[name=package]:checked').val() == 'E1' || $('input[name=package]:checked').val() == 'S1' || $('input[name=package]:checked').val() == 'D' || $('input[name=package]:checked').val() == 'E' || $('input[name=package]:checked').val() == 'P'){
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + parseFloat(29.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + parseFloat(29.99) ).toFixed(2));
          

          $('#personal_unit_app').html(parseFloat(29.99).toFixed(2));
        }
      }
    }else {
      jQuery('input[name="personal_website"]').prop("disabled", false);
      if($('input[name="personal_website"]').is(':checked')){
        return false;
      }else {

        if($('input[name=package]:checked').val() == 'N') {
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 - parseFloat(59.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 - parseFloat(59.99) ).toFixed(2));


          $('#personal_unit_app').html('0');
          
        }else if($('input[name=package]:checked').val() == 'S' || $('input[name=package]:checked').val() == 'R' || $('input[name=package]:checked').val() == 'E1' || $('input[name=package]:checked').val() == 'S1' || $('input[name=package]:checked').val() == 'D' || $('input[name=package]:checked').val() == 'E' || $('input[name=package]:checked').val() == 'P'){
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 - parseFloat(29.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 - parseFloat(29.99) ).toFixed(2));
          $('#personal_unit_app').html('0');
        }
        
      }
    }
  });

  $('input[name="personal_website"]').on('change',function(){
    
    if($(this).is(':checked')){
      jQuery('input[name="personal_unit_app"]').prop("disabled", true);

      if($('input[name="personal_unit_app"]').is(':checked')){
        return false;
      }else {
        if($('input[name=package]:checked').val() == 'N') {
          
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + parseFloat(59.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + parseFloat(59.99) ).toFixed(2));

          $('#personal_website').html(parseFloat(59.99).toFixed(2));

        }else if($('input[name=package]:checked').val() == 'S' || $('input[name=package]:checked').val() == 'R' || $('input[name=package]:checked').val() == 'E1' || $('input[name=package]:checked').val() == 'S1' || $('input[name=package]:checked').val() == 'D' || $('input[name=package]:checked').val() == 'E' || $('input[name=package]:checked').val() == 'P'){
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + parseFloat(29.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + parseFloat(29.99) ).toFixed(2));

          $('#personal_website').html(parseFloat(29.99).toFixed(2));
        }
      }
    }else {
      jQuery('input[name="personal_unit_app"]').prop("disabled", false);
      
      if($('input[name="personal_unit_app"]').is(':checked')){
        return false;
      }else {

        if($('input[name=package]:checked').val() == 'N') {
          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 - parseFloat(59.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 - parseFloat(59.99) ).toFixed(2));

          $('#personal_website').html('0');
        }else if($('input[name=package]:checked').val() == 'S' || $('input[name=package]:checked').val() == 'R' || $('input[name=package]:checked').val() == 'E1' || $('input[name=package]:checked').val() == 'S1' || $('input[name=package]:checked').val() == 'D' || $('input[name=package]:checked').val() == 'E' || $('input[name=package]:checked').val() == 'P'){

          var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 - parseFloat(29.99) ).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 - parseFloat(29.99) ).toFixed(2));

          $('#personal_website').html('0');       
        }
      }
    }
  });

  $('input[name="personal_url"]').on('change',function(){
    if($(this).is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + personal_url_val).toFixed(2));

          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + personal_url_val).toFixed(2));


          $('#personal_url').html(personal_url_val.toFixed(2));
    }else{
        var total2 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total2 - personal_url_val).toFixed(2));

      var total22 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total22 - personal_url_val).toFixed(2));


      $('#personal_url').html('0');
    }
  });

  $('input[name="personal_unit_app_ca"]').on('change',function(){
    if($(this).is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + personal_unit_app_ca_val).toFixed(2));
          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + personal_unit_app_ca_val).toFixed(2));
          $('#personal_unit_app_ca').html(personal_unit_app_ca_val.toFixed(2));
    }else{
        var total2 = parseFloat($('input.package_value').val());
        $('input.package_value, input#hidden_package').val((total2 - personal_unit_app_ca_val).toFixed(2));
        var total22 = parseFloat($('input.sub_total').val());
        $('input.sub_total, inputinput.sub_total').val((total22 - personal_unit_app_ca_val).toFixed(2));
      $('#personal_unit_app_ca').html('0');
    }
  });

  $('input[name="subscription_updates"]').on('change',function(){
    if($(this).is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + subscription_updates_val).toFixed(2));
          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + subscription_updates_val).toFixed(2));
          $('#subscription_updates').html(subscription_updates_val.toFixed(2));
    }else{
        var total2 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total2 - subscription_updates_val).toFixed(2));
      var total22 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total22 - subscription_updates_val).toFixed(2));
      $('#subscription_updates').html('0');
    }
  });

  $('input[name="app_color"]').on('change',function(){
    if($(this).is(':checked')){
      var total1 = parseFloat($('input.package_value').val());
          $('input.package_value, input#hidden_package').val((total1 + app_color_val).toFixed(2));
          var total11 = parseFloat($('input.sub_total').val());
          $('input.sub_total, inputinput.sub_total').val((total11 + app_color_val).toFixed(2));
          $('#app_color').html(app_color_val.toFixed(2));
    }else{
        var total2 = parseFloat($('input.package_value').val());
      $('input.package_value, input#hidden_package').val((total2 - app_color_val).toFixed(2));

      var total22 = parseFloat($('input.sub_total').val());
      $('input.sub_total, inputinput.sub_total').val((total22 - app_color_val).toFixed(2));
      $('#app_color').html('0');
    }
  });

  $('input[name="website_link"]').keyup(function(){
    var textValue = $(this).val();
    $("#website_link").html(textValue);
  });
  
});

//Misc Charges
$(document).ready(function(){
  
  var misc_val1 =  parseFloat($('#hidden_package').val());
  var misc_val_main1 = parseFloat($('input.package_value').val());
  var misc_val =  parseFloat($('#hidden_package').val());
  var misc_val_main = parseFloat($('input.package_value').val());

  var sub_val1 =  parseFloat($('input.sub_total').val());
  var sub_val_main1 = parseFloat($('input.sub_total').val());
  var sub_val =  parseFloat($('input.sub_total').val());
  var sub_val_main = parseFloat($('input.sub_total').val());
  
  var current_val = parseFloat($('input#misc_charge').val());
  var current_old = parseFloat($('input#misc_charge_old').val());


  $('input[name="package"]').bind("change",function(){

    if(isNaN(parseFloat($('#misc_charge_old').val()))) {
      $('#misc_charge_old').val(0);
    }

     var chanrge = parseFloat($('input#misc_charge').val());
     if(isNaN(chanrge)) {
      chanrge = 0;
     }

    var main_v = parseFloat($('#hidden_package').val()) + chanrge;
    var main_p = parseFloat($('input.package_value').val()) + chanrge
    $('#hidden_package').val(main_v.toFixed(2));
    $('input.package_value').val(main_p.toFixed(2));

    var main_vv = parseFloat($('input.sub_total').val()) + chanrge;
    var main_pp = parseFloat($('input.sub_total').val()) + chanrge
    $('input.sub_total').val(main_vv.toFixed(2));
    $('input.sub_total').val(main_pp.toFixed(2));
  });
  
  $('input#misc_charge').change(function(){
    var current  = parseFloat($(this).val());
    var old = parseFloat($('input#misc_charge_old').val());
    
    if(isNaN(current)) {
      current = 0;
    }
    
    if(isNaN(parseFloat($('#misc_charge_old').val()))) {
      $('#misc_charge_old').val(0);
    }

    var misc_val1 =  $('#hidden_package').val();
    var misc_val_main1 = $('input.package_value').val();

    var sub_val1 =  $('input.sub_total').val();
    var sub_val_main1 = $('input.sub_total').val();
    
    if(current == 0 || current == '0') {
      var misc_val1 =  $('#hidden_package').val();
      var misc_val_main1 = $('input.package_value').val();

      var sub_val1 =  $('input.sub_total').val();
      var sub_val_main1 = $('input.sub_total').val();
    }
    
    
    $('#hidden_package').val(parseFloat(misc_val1) - parseFloat(old));
    $('input.package_value').val(parseFloat(misc_val_main1) - parseFloat(old));

    $('input.sub_total').val(parseFloat(sub_val1) - parseFloat(old));
    $('input.sub_total').val(parseFloat(sub_val_main1) - parseFloat(old));

    
    var total = parseFloat($('#hidden_package').val()) + parseFloat(current);
    var total2 = parseFloat($('input.package_value').val()) + parseFloat(current);
    $('#hidden_package').val(total.toFixed(2));
    $('input.package_value').val(total2.toFixed(2));

    var total1 = parseFloat($('input.sub_total').val()) + parseFloat(current);
    var total21 = parseFloat($('input.sub_total').val()) + parseFloat(current);
    $('input.sub_total').val(total1.toFixed(2));
    $('input.sub_total').val(total21.toFixed(2));
    

    if(isNaN(current)) {
      $('#misc_charge_old').val(0); 
    }else {
      $('#misc_charge_old').val(parseFloat(current));
    }
  });

});

$(document).ready(function(){
  $('.SMcheck').change(function() {
     var name = $(this).attr('id');
     if($(this).is(":checked")) {
      $('#'+name+'-in').css('display','inline-block');
     }else {
      $('#'+name+'-in').hide();
     }

  });

  $(".SMcheck").each(function(){
        var name = $(this).attr('id');
         if($(this).is(":checked")) {
      $('#'+name+'-in').css('display','inline-block');
     }else {
      $('#'+name+'-in').hide();
     }
    });

    if ($('input[name="total_text_program"]').is(":checked")) {
      $('input[name="total_text_program7"]').attr("disabled", true);
      $('input[name="total_text_program7"]').prop( "checked", false );
      $('.text_email_both').prop( "checked", true );
    }else {
      $('input[name="total_text_program7"]').removeAttr("disabled");
      $('.text_email_both').prop( "checked", false );
    }

    if ($('input[name="total_text_program7"]').is(":checked")) {
      $('input[name="total_text_program"]').attr("disabled", true);
      $('input[name="total_text_program"]').prop( "checked", false );
      $('.text_email_both').prop( "checked", true );
    }else {
      $('input[name="total_text_program"]').removeAttr("disabled");
      $('.text_email_both').prop( "checked", false );
    }

   
    $('input[name="total_text_program"]').change(function(event) {
      if($(this).is(":checked") && $('input[name="email_newsletter"]').is(":checked")) {
      $('input[name="total_text_program7"]').attr("disabled", true);
      $('input[name="total_text_program7"]').prop( "checked", false );
      $('.text_email_both').prop( "checked", true);
    }else if($(this).is(":checked")){
        $('input[name="total_text_program7"]').attr("disabled", true);
      $('input[name="total_text_program7"]').prop( "checked", false );
      $('.text_email_both').prop( "checked", true );
    }else if($('input[name="email_newsletter"]').is(":checked")){
      $('input[name="total_text_program7"]').removeAttr("disabled");
      $('.text_email_both').prop( "checked", false);
      $('.email_onluc').prop( "checked", true );
    }else{
      $('input[name="total_text_program7"]').removeAttr("disabled");
      $('.text_email_both').prop( "checked", false);
      $('.email_onluc').prop( "checked", false );
    }
    });


   if ($('input[name="total_text_program7"]').is(":checked")) {
      $('input[name="total_text_program"]').prop( "checked", false );
      $('input[name="total_text_program"]').attr("disabled", true);
      $('.text_email_both').prop( "checked", true );
   }else {
      $('input[name="total_text_program"]').removeAttr("disabled");
   }

   if ($('input[name="canada_service"]').is(":checked")) {
      $('input[name="total_text_program7"]').prop( "checked", true );
      $('input[name="total_text_program7"]').attr("disabled", true);
   }else {
      $('input[name="total_text_program7"]').removeAttr("disabled");
   }

    $('input[name="total_text_program7"]').change(function(event) {
      if($(this).is(":checked") && $('input[name="email_newsletter"]').is(":checked")) {
        $('input[name="total_text_program"]').attr("disabled", true); 
      $('input[name="total_text_program"]').prop( "checked", false );
        $('.text_email_both').prop( "checked", true );
      }else if($(this).is(":checked")){
      $('input[name="total_text_program"]').attr("disabled", true); 
      $('input[name="total_text_program"]').prop( "checked", false );
      $('.text_email_both').prop( "checked", true );
    }else if($('input[name="email_newsletter"]').is(":checked")){
      $('input[name="total_text_program"]').removeAttr("disabled");
      $('.text_email_both').prop( "checked", false);
      $('.email_onluc').prop( "checked", true );
    }else{
      $('input[name="total_text_program"]').removeAttr("disabled");
      $('.text_email_both').prop( "checked", false);
      $('.email_onluc').prop( "checked", false );
    }

  });

  $('input[name="email_newsletter"]').change(function(event) {
      if($(this).is(":checked") && ($('input[name="total_text_program7"]').is(":checked") || $('input[name="total_text_program"]').is(":checked"))){
      $('.text_email_both').prop( "checked", true);
    }else if($(this).is(":checked")){
      $('.email_onluc').prop( "checked", true);
    }else{
      $('.email_onluc').prop( "checked", false);
    }
  });
});
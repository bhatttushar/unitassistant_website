var facebook_val = 19.99;
var facebook_everything_val = 49.99;
var newsletter_val = 19.99;
var biz_card_val = 20;
var video_fizz_val = 12.99;
var canada_service_val = 29.01;
var other_language_newsletter_val = 25;

var prospect_system_val = 29.99;
var magic_booker_val = 49.99;

var personal_unit_app_val = 59.99;
var personal_website_val = 59.99;


var personal_unit_app_ca_val = 49.99;
var personal_url_val = 5;
var subscription_updates_val = 35;
var app_color_val = 5;

var newsletter_color_constant_val = 1.29;
var newsletter_black_white_constant_val = 0.99;
//var month_packet_postage_constant_val = 1.42;
var month_packet_postage_constant_val = 1.45;
//var consultant_packet_postage_constant_val = 1.72;
var consultant_packet_postage_constant_val = 1.75;
//var consultant_bundles_constant_val = 6.8;
var consultant_bundles_constant_val = 7.15;
var consistency_gift_constant_val = 7;
var reds_program_gift_constant_val = 5;
var stars_program_gift_constant_val = 5;
var gift_wrap_postpage_constant_val = 3.5;
//var one_rate_postpage_constant_val = 6.8;
var one_rate_postpage_constant_val = 7.75;
var month_blast_flyer_constant_val = 7.99;
var flyer_ecard_unit_constant_val = 9.99;
var unit_challenge_flyer_constant_val = 11.99;
var team_building_flyer_constant_val = 11.99;
var wholesale_promo_flyer_constant_val = 11.99;
//var postcard_design_constant_val = 19.99;
var postcard_design_constant_val = 24.99;
var postcard_edit_constant_val = 9.99;
//var ecard_unit_constant_val = 24.99;
var ecard_unit_constant_val = 4.99;
//var speciality_postcard_constant_val = 0.65;
var speciality_postcard_constant_val = 0.69;
var card_with_gift_constant_val = 2.59;
var greeting_card_constant_val = 1.79;
var birthday_brownie_constant_val = 0.89;
var birthday_starbucks_constant_val = 9.99;
var anniversary_starbucks_constant_val = 9.99;
var referral_credit_constant_val = 50;
var cc_billing_constant_val = 29.99;
var customer_newsletter_constant_val = 1.25;
var birthday_postcard_constant_val = 0.65;
var anniversary_postcard_constant_val = 0.65;
var picture_texting_constant_val = 0.04;
var keyword_constant_val = 10;
var client_setup_constant_val = 25;
var nl_flyer_constant_val = 19.99;


var email_val_1 = 38;
var email_val_2 = 55;

//if total text program is checked and package val D,E,P

var total_text_program7_N = 69.99;
var total_text_program7_Y = 39.99;
var total_text_program7_P = 9.99;

var total_text_program_D_E_P = 9.99;
//else
var total_text_program_other = 29.99;
//else  texting is yes
var texting_val_yes = 49.99;
// if texting yes and package S,R,E1
var texting_Yes_S_R_E1 = 19.99;

// if package is S,R,E1
var hidden_texting_val_S_R_E1= 19.99;
// if package is No subcribe
var hidden_texting_val_N= 49.99;

// if Total text program is checked and package value no subscribe and director access is checked and texting is N or X
var total_text_N = 59.99;
//if Texting is Y 
var total_text_Y = 10;

// if pckage value is Economy and texting yes
var E_texting_Y = 19.99;

// if texting yes and economy N
var texting_Y_economy_N = 49.99;
// Hidden economy value
var hidden_economy_val = 30;

var ADDING_VAL = 29.99;
var WEBNOPACKGE = 59.99;
var Sapphire0 = 98;
var Sapphire30 = 128;
var Sapphire55 = 168;
var Sapphire80 = 218;
var Sapphire105 = 248;
var Sapphire125 = 268;
var Sapphire155= 278;
var Sapphire175 = 298;
var Sapphire200 = 338;
var Sapphire225 = 378;
var Sapphire250 = 398;
//Points value for Rubby

var Ruby0 = 128;
var Ruby30= 158;
var Ruby55 = 218;
var Ruby80 = 298;
var Ruby105= 328;
var Ruby125= 348;
var Ruby155 = 368;
var Ruby175 =388;
var Ruby200 =428;
var Ruby225= 468;
var Ruby250 =488;

//Points value for Diamond

var Diamond0 =168;
var Diamond30 =218;
var Diamond55 = 298;
var Diamond80 =378;
var Diamond105 = 408;
var Diamond125 =428;
var Diamond155 =458;
var Diamond175 = 478;
var Diamond200 = 518;
var Diamond225 = 558;
var Diamond250 = 578;

//Points value for Emerald

var Emerald0 = 228;
var Emerald30 = 298;
var Emerald55 = 378;
var Emerald80 = 458;
var Emerald105 = 488;
var Emerald125 = 508;
var Emerald155 = 538;
var Emerald175 = 558 ;
var Emerald200 = 588;
var Emerald225 = 638;
var Emerald250 = 658;

//Points value for Pearl

var Pearl0 = 258;
var Pearl30 = 328;
var Pearl55 = 408;
var Pearl80 =488;
var Pearl105 = 538;
var Pearl125 = 568;
var Pearl155 = 588;
var Pearl175 = 608;
var Pearl200 = 648;
var Pearl225 = 688;
var Pearl250 = 698;

//Points value for Economy

var Economy0 = 69;
var Economy30 = 79;
var Economy55 = 89;
var Economy80 = 99;
var Economy105 = 109;
var Economy125 = 119;
var Economy155 = 129;
var Economy175 = 139;
var Economy200 = 149;
var Economy225 = 159;
var Economy250 = 169;

var SpecialALL = 59.01;



$('#example1, #dob_date, #cc_dob, #birthday').datepicker({
  format: "mm-dd"
});

$('#example2, #cc_m_bill_date, #cc_contract_update_date').datepicker({
    format: "mm-dd-yy"
  });  

$('#example3, #example4, .example4-cal, #box_sent, #example2').datepicker({
  format: "mm-dd-yy"
});  

$('#example5').datepicker({
  format: "mm/dd/yy"
});  

$("#auto_send").datepicker( {
  format: "dd-mm"
});

$("#cc_expir_date").datepicker( {
  format: "mm/yy"
});  

function recalculate(){
    var sum = 0;
    $("input[type=checkbox]:not('.notget'):checked, input[name=design_one]:checked,input[name=birthday_one]:checked,input[name=anniversary_one]:checked,input[name=last_one]:checked,input[name=consultant_five]:checked").each(function(){
      var sums  = $("#output").val();
      var sumHidden  = $("#point").val();
       
      if(sums != ''){
        $("#output").val("");
      }

      if(sumHidden != ''){
        $("#point").val("");
      }

      sum = sum + parseInt($(this).attr("value"));
    });
    
    $("#output").val(sum);
    $('#point').val(sum);
}

function checkValue(evt){
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();
  var emailing = $('input[name="emailing"]:checked').val()
  var hiddenRadio = $("#hidden_radio").val();
    if(emailing == 1)
    {
    $(".package_value").val('');
      var value = (Number(package) -Number(hiddenRadio)) + email_val_1;
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));  

      $(".sub_total").val('');
      var value2 = (Number(subpack) -Number(hiddenRadio)) + email_val_1;
    $(".sub_total").val(value2.toFixed(2));
      $("#hidden_sub_total").val(value2.toFixed(2));  

      $("#hidden_radio").val(email_val_1);
    } 
    if(emailing == 2) 
    {
    $(".package_value").val('');
        var value = (Number(package) -Number(hiddenRadio)) + email_val_2; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      $(".sub_total").val('');
      var value2 = (Number(subpack) -Number(hiddenRadio)) + email_val_2;
    $(".sub_total").val(value2.toFixed(2));
      $("#hidden_sub_total").val(value2.toFixed(2)); 


      $("#hidden_radio").val(email_val_2);
    } 
    if(emailing == 0) 
    {
    $(".package_value").val('');
        var value = (Number(package)-Number(hiddenRadio)) + 0; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));
    
    $(".sub_total").val('');
      var value2 = (Number(subpack) - Number(hiddenRadio)) + 0;
    $(".sub_total").val(value2.toFixed(2));
      $("#hidden_sub_total").val(value2.toFixed(2)); 
    
    $("#hidden_radio").val(0);

    }
}

function checkEconomyValue(evt){
  var package = $(".package_value").val();
  var subpack = $(".sub_total").val();

  var economy = $('input[name="economy"]:checked').val()
  var hiddenEconomy = $("#hidden_economy").val();

    if(economy == 'Y' || economy == '')
    {
    $(".package_value").val('');
      var value = (Number(package) - hiddenEconomy) + 0;
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2)); 

      $(".sub_total").val('');
      var value2 = (Number(package) - hiddenEconomy) + 0;
    $(".sub_total").val(value2.toFixed(2));
      $("#hidden_sub_total").val(value2.toFixed(2));  

      $("#hidden_economy").val(0);
    } 
    if(economy == 'N') 
    { 
    $(".package_value").val('');
        var value = (Number(package) - hiddenEconomy) + 30; 
    $(".package_value").val(value.toFixed(2));
      $("#hidden_package").val(value.toFixed(2));

      $(".sub_total").val('');
      var value2 = (Number(package) - hiddenEconomy) + 30;
    $(".sub_total").val(value2.toFixed(2));
      $("#hidden_sub_total").val(value2.toFixed(2));

      $("#hidden_economy").val(30);
    }
}

function getVal(){
  $("#consistency-club1").html('');
  var val = $("#but").val()
  var button = $("#hidden_val").val();
  if(button == ''){
    $("#consistency-club1").html(val);
    $("#hidden_val").val(val);
    $("#but").removeClass('btn-status');
  }

  if(button != ''){
    $("#consistency-club1").html('');
    $("#hidden_val").val('');
    $("#but").addClass('btn-status');
  }
}

function loadNewNotes(id_newsletter, all=''){
  $.ajax({
      url: baseURL+'note-list',
      type: 'POST',
      data: {id_newsletter : id_newsletter, all:all},
      success: function(response) {
          if(response) {
            $('#addNoteForm').html(response);
          }
        }
  });
}

function saveNote(id_newsletter){
	var note = $("#note").val();
	var client_name = $("#name_client").val();
	var users_id = $(".hidden-user").val();
	if(note == ''){
		$("#note-error").html('Please add note!!');
	} else {
		
		$("#note-error").html('');
		$.ajax({
        url: baseURL+'add-note',
        type: 'POST',
        data: {id_newsletter : id_newsletter, note: note, users : users_id, client_name : client_name},
        beforeSend: function(){
          $("#img-load").show();
        },
        success: function(response) {
	        	if(response != 0) {
              createCookie("flag", 1, 0);
	        		$('#hidden_id_newsletter').val(response);
	        		$('#is_note').val('1');
	        		loadNewNotes(response);
	        	}
        },
        complete:function(data){
          $("#img-load").hide();
        },

        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }

		});
	}
}

function loadNewCCNotes(id_cc_newsletter, all=''){
  $.ajax({
      url: baseURL+'cc-note-list',
      type: 'POST',
      data: {id_cc_newsletter : id_cc_newsletter, all:all},
      success: function(response) {
          if(response) {
            $('#addUACCNoteForm').html(response);
          }
        }
  });
}

function saveCCNote(id_cc_newsletter){

  var note = $("#note").val();
  var client_name = $("#name_client").val();
  var users_id = $(".hidden-user").val();
  if(note == ''){
    $("#note-error").html('Please add note!!');
  } else {
    
    $("#note-error").html('');
    $.ajax({
        url: baseURL+'add-cc-note',
        type: 'POST',
        data: {id_cc_newsletter : id_cc_newsletter, note: note, users : users_id, client_name : client_name},
        beforeSend: function(){
          $("#img-load").show();
        },
        success: function(response) {
            if(response != 0) {
              createUACCCookie("uacc-flag", 1, 0);
              $('#hidden_id_newsletter').val(response);
              $('#is_note').val('1');
              loadNewCCNotes(response);
            }
        },
        complete:function(data){
          $("#img-load").hide();
        },

        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }

    });
  }
}


function createCookie(name, value, days){
      var expires;
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      } else {
          expires = "";
      }
      document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
  }

  function createUACCCookie(name, value, days){
      var expires;
      if (days) {
          var date = new Date();
          date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
          expires = "; expires=" + date.toGMTString();
      } else {
          expires = "";
      }
      document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
  }

  function readCookie(name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) === ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
      }
      return null;
  }

    function readUACCCookie(name) {
      var nameEQ = encodeURIComponent(name) + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) === ' ') c = c.substring(1, c.length);
          if (c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
      }
      return null;
  }

  function eraseCookie(name) {
      createCookie(name, "", -1);
  }

  function eraseUACCCookie(name) {
      createUACCCookie(name, "", -1);
  }
  
   function timerTick() {
        with (new Date()) {
          var h, m, s;
          h = 30 * ((getHours() % 12) + getMinutes() / 60);
          m = 6 * getMinutes();
          s = 6 * getSeconds();
          document.getElementById('h_pointer').setAttribute('transform', 'rotate(' + h + ', 50, 50)');
          document.getElementById('m_pointer').setAttribute('transform', 'rotate(' + m + ', 50, 50)'); 
          document.getElementById('s_pointer').setAttribute('transform', 'rotate(' + s + ', 50, 50)');
          setTimeout(timerTick, 1000);
        }
    }



function checkCC(id){
	$.ajax({
        url: baseURL+'check-cc',
        type: 'POST',
        data: {id_newsletter : id},
        success: function(response) {
        	if(response == "yes"){
        		$("#noticmodal").modal({
                    show : true
                });
        	} else {
        		$("#noticmodal").modal({
                    show : false
                });
        	}
        }
	});
}


function openCity(evt, cityName) {
  	var i, tabcontent, tablinks;
  	tabcontent = document.getElementsByClassName("tabcontent");
  	for (i = 0; i < tabcontent.length; i++) {
    	tabcontent[i].style.display = "none";
  	}
  	tablinks = document.getElementsByClassName("tablinks");
  	for (i = 0; i < tablinks.length; i++) {
    	tablinks[i].className = tablinks[i].className.replace(" active", "");
  	}
  	document.getElementById(cityName).style.display = "block";
  	evt.currentTarget.className += " active";
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function uniqueId(selectedValue, isUACC=""){
  var URL = (isUACC=='') ? baseURL+'check-consultant-exists' : baseURL+'check-uacc-consultant-exists';

  $("#resultImageProfile").html('<img src="'+baseURL+'/assets/images/load1.gif" alt="" />');
  $("#error-consul").html("");
  var id = $("#hidden_id").val();
  if(selectedValue == ''){
    $("#error-consul").html("Consultant Number is required!!");
    $("#next").attr('disabled',true);
    $("#save").attr('disabled',true);
    $("#resultImageProfile").html('');
  }else{
    $("#error-consul").html("");
    $.ajax({
      url: URL,
      type: 'POST',
      data: {consultant : selectedValue, user_id: id},
      success: function(response) {
        if(response == "1"){
          $("#error-consul").html("Consultant Number must be unique!!");
          $("#next").attr('disabled',true);
          $("#resultImageProfile").html('');
          $("#note-consul").html('');
          $("#save").attr('disabled',true);
        }else if(response == "2"){
          $("#consultant_id").html("<b>This client has taken Consultant Commucation Service.</b>");
          $("#note-consul").html("<b>Note : This client has taken Consultant Commucation Service.</b>");
          $("#next").attr('disabled',false);
          $("#error-consul").html("");
          $("#resultImageProfile").html('');
          $("#save").attr('disabled',false);
        }else{
          $("#consultant_id").html("");
          $(".consultant_id").html("");
          $("#error-consul").html("");
          $("#next").attr('disabled',false);
          $("#resultImageProfile").html('');
          $("#save").attr('disabled',false);
        }
      }
    });
  }
}

function reggieUniqueId(selectedValue, UA="", UACC=""){  
  var url = (UA=='' && UACC=='1') ? 'reggie-uacc-unique-id' : 'reggie-ua-unique-id';
  $("#resultImageProfile").html('<img src="'+baseURL+'/assets/images/load1.gif" alt="" />');
  $("#error-consul").html("");
  if(selectedValue == ''){
    $("#error-consul").html("Consultant Number is required!!");
    $("#submit").attr('disabled',true);
    $("#resultImageProfile").html('');
  }else{
    $("#error-consul").html("");
    $.ajax({
      url: baseURL + url,
      type: 'POST',
      data: {consultant : selectedValue},
      success: function(response) {
        if(response == "1"){
          $("#error-consul").html("Consultant Number must be unique!!");
          $("#submit").attr('disabled',true);
          $("#resultImageProfile").html('');
          $("#note-consul").html('');
        }else{
          $("#error-consul").html("");
          $("#submit").attr('disabled',false);
          $("#resultImageProfile").html('');
        }
      }
    });
  }
}



function getId(element){
  var val = $("#"+element).text();
  var note = $("#note").val();
  // var part = note.split('@')[0];
  //$("#note").val(part+""+'@'+val);
  $("#note").val(note);
  $(".hidden-user").val(element);
  //$(".member").html('');
}

function GetDesignName(name) {
	if(name == 'SE') {
		return 'Simple Newsletter English 2 pts';
	}else if (name == 'SS') {
		return 'Simple Newsletter Spanish 2 pts';
	}else if (name == 'SB') {
		return 'Simple Newsletter Both 4 pts';
	}else if (name == 'AE') {
		return 'Advanced Newsletter English 4 pts';
	}else if (name == 'AS') {
		return 'Advanced Newsletter Spanish 4 pts';
	}else if (name == 'AB') {
		return 'Advanced Newsletter Both 6 pts';
	}else {
		return 'No Subscription';
	}
}


function printPage(id) {
    var html="<html>";
    html+= document.getElementById(id).innerHTML;
    html+="</html>";
    var printWin = window.open('','','left=0,top=0,width=1,height=1,toolbar=0,scrollbars=0,status =0');
    printWin.document.write(html);
    printWin.document.close();
    printWin.focus();
    printWin.print();
    printWin.close();
}

function uniqueEmail(email, isUACC=""){
  var URL = (isUACC=='') ? baseURL+'check-email-exists' : baseURL+'check-uacc-email-exists';
  
	var id = $('#hidden_id').val();
	$("#resultImageProfile1").html('<img src="'+baseURL+'assets/images/load1.gif" alt="" />');
	$("#error-email").html("");
	if(email !== ''){
		if (!ValidateEmail(email)) {
            $("#error-email").html("Please Enter valid email address!!");
            $("#next").attr('disabled',true);
            $("#resultImageProfile1").html('');
        }else {
        	$.ajax({
		        url: URL,
		        type: 'POST',
		        data: {id : id, email: email},
		        success: function(response){
		        	$("#resultImageProfile1").html('');
		        	if(response != '0') {
			        	$("#error-email").html(response);
		        	}else {
		        		$("#error-email").html();
		        	}
	        	}
			});
        }
    }else {
    	$("#error-email").html("Please Enter email address!!");
    	$("#resultImageProfile1").html('');
    }
}

function reggieUniqueEmail(email, UA="", UACC=""){
  var url = (UA=='' && UACC=='1') ? 'reggie-uacc-unique-email' : 'reggie-ua-unique-email';
  
  $("#resultImageProfile1").html('<img src="'+baseURL+'assets/images/load1.gif" alt="" />');
  $("#error-email").html("");
  if(email !== ''){
    if (!ValidateEmail(email)) {
            $("#error-email").html("Please Enter valid email address!!");
            $("#submit").attr('disabled',true);
            $("#resultImageProfile1").html('');
        }else {
          $.ajax({
            url: baseURL+ url,
            type: 'POST',
            data: {email: email},
            success: function(response){
              $("#resultImageProfile1").html('');
              if(response != '0') {
                $("#error-email").html(response);
                $("#submit").attr('disabled',true);
              }else {
                $("#submit").attr('disabled',false);
                $("#error-email").html();
              }
            }
      });
        }
    }else {
      $("#error-email").html("Please Enter email address!!");
      $("#submit").attr('disabled',true);
      $("#resultImageProfile1").html('');
    }
}

function ValidateEmail(email) {
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    return expr.test(email);
}
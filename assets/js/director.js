CKEDITOR.replace('welcome_email_english', 'welcome_email_canada_english', 'welcome_email_spanish', 'welcome_email_french', 
	'current_email_english', 'current_email_canada_english', 'current_email_spanish', 'current_email_french', {
  	uiColor: '#CCEAEE'
});

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
$(".js-example-basic-multiple").select2({
  placeholder: "Click to select a user"
});

$(".js-example-basic-multiple").on("select2:select", function (e) { 
    var select_val = $(e.currentTarget).val();
    $(".hidden-user").val(select_val);
});

/*var welcome_email_english = CKEDITOR.replace('welcome_email_english');*/
var welcome_email_canada_english = CKEDITOR.replace('welcome_email_canada_english');
var welcome_email_spanish = CKEDITOR.replace('welcome_email_spanish');
var welcome_email_french = CKEDITOR.replace('welcome_email_french');
var current_email_english = CKEDITOR.replace('current_email_english');
var current_email_canada_english = CKEDITOR.replace('current_email_canada_english');
var current_email_spanish = CKEDITOR.replace('current_email_spanish');
var current_email_french = CKEDITOR.replace('current_email_french');

CKEDITOR.instances.welcome_email_english.on('change', function() { 
    $('#hidden_welcome_english').val('1');
});

CKEDITOR.instances.welcome_email_canada_english.on('change', function() { 
    $('#hidden_welcome_canada').val('1');
});

CKEDITOR.instances.welcome_email_spanish.on('change', function() { 
    $('#hidden_welcome_spanish').val('1');
});

CKEDITOR.instances.welcome_email_french.on('change', function() { 
    $('#hidden_welcome_french').val('1');
});

CKEDITOR.instances.current_email_english.on('change', function() { 
    $('#hidden_current_english').val('1');
});

CKEDITOR.instances.current_email_canada_english.on('change', function() { 
    $('#hidden_current_canada').val('1');
});

CKEDITOR.instances.current_email_spanish.on('change', function() { 
    $('#hidden_current_spanish').val('1');
});

CKEDITOR.instances.current_email_french.on('change', function() { 
    $('#hidden_current_french').val('1');
});


$(document).ready(function() {
    window.history.pushState({page: 1}, "", "");
    window.onpopstate = function(event) {
    var isCookie = readCookie("flag");
        if(isCookie == 0){
            $('#thankyouModal').modal('show');
            document.location.href = '#';
        }
    }

    $('.digital_biz_card').on('click', function(){
        if ($('.digital_biz_card').is(':checked')) {
            $('#digital-biz-link').text('X');
        }else{
            $('#digital-biz-link').text('');
        }
    });

    $('.canadaService').on('click', function(){
        if ($(this).is(':checked')) {
            $('#canada-service').text('X');
        }else{
            $('#canada-service').text('');
        }
    });

    $('#accumulative').click(function () {
        if ($('#accumulative').prop("checked") == true) {
            if ($('#monthly').prop("checked") == true) {
                $('#monthly').attr('checked', false)
            }
        }
    })

    $('#monthly').click(function () {
        if ($('#monthly').prop("checked") == true) {
            if ($('#accumulative').prop("checked") == true) {
                $('#accumulative').attr('checked', false);
            }
        }
    });

    $('#example4').focus(function(){
        $('.focus-g p').remove();
        $('.focus-g').append('<p><b>Note : This client has taken Consultant Commucation Service.</b></p>');
    });
});
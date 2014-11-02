var launchDateTime, txtMailTo;

$(document).ready(function () {

    $("a[href*='#']").click(function () {
        var hrefTarget = $(this).attr("href");
        var offsetTop = $(hrefTarget).offset().top-55;
        $("html, body").animate({ scrollTop: offsetTop }, 1000, 'swing')
        return false;
    });
	$("#instCheck input[type='checkbox']").change(function(){
		toggleTextReg("txtSchool","chkSchool",this);	
		toggleTextReg("txtUniv","chkUniv",this);
		toggleTextReg("txtInst","chkBoth",this);
	});
	
	$("#usertype").change(function(){
		
		if($(this).val()==="1"){
		
		$('#chkUniv').prop('disabled', true);
		$('#chkBoth').prop('disabled', true);
		$("#txtInst").hide("slide");
		$("#txtUniv").hide("slide");
		}
		else{
			$('#chkUniv').prop('disabled', false);
		$('#chkBoth').prop('disabled', false);
		
		if($("#chkUniv").attr("checked")){
			$("#txtUniv").show("slide");
		}
		if($("#chkBoth").attr("checked")){
			$("#txtInst").show("slide");
		}
		
		}
		if($(this).val()==="3"){
			$("#aprense").html("enseñanza:");
		}else{
			$("#aprense").html("ínteres:");
		}
		$(".areai").show("slide");
	});
    $.ajax({
        type: "GET",
        url: "webconfig.xml?" + Math.random(),
        dataType: "xml",
        success: loadConfig
    });

    init_FormValidator();
    CaptchaHandler();

    $("#btn_Send").click(function () {

        var txtName = $('#txtName').val();
        var txtEmail = $('#txtEmail').val();
        var txtMessage = $('#txtMessage').val();
		var type=$("#usertype").val();
		var col=$("#chkSchool").attr("checked")?$("#chkSchool").attr("checked"):"";
		var uni=$("#chkUniv").attr("checked")?$("#chkUniv").attr("checked"):"";
		var oth=$("#chkBoth").attr("checked")?$("#chkBoth").attr("checked"):"";
		var txtcol=$("#txtSchool").val();
		var txtuniv=$("#txtUniv").val();
		var txtoth=$("#txtInst").val();
		var mate=$("#chkMate").attr("checked")?$("#chkMate").attr("checked"):"";
		var quimi=$("#chkQuimi").attr("checked")?$("#chkQuimi").attr("checked"):"";
		var fisi=$("#chkFisi").attr("checked")?$("#chkFisi").attr("checked"):"";
		var lecto=$("#chkLecto").attr("checked")?$("#chkLecto").attr("checked"):"";
		var musi=$("#chkMusi").attr("checked")?$("#chkMusi").attr("checked"):"";
		var idio=$("#chkIdi").attr("checked")?$("#chkIdi").attr("checked"):"";
		var otro=$("#txtOpcion").val();
		
		if(val_txt(txtName)&&val_txt(txtEmail)&&val_txt(type)&&!$(".error").is(":visible")&&$(".chkgroup input").attr("checked")!==undefined&&$("#instCheck input").attr("checked")!==undefined){
			$("#form_contact_us").hide("slide");
			$("#load_gif").show("slide");
			//console.log(uni);
			$.ajax({url:"/Services/register.php",data:{
				name:txtName,
				email:txtEmail,
				suger:txtMessage,
				type:type,
				col:col,
				uni:uni,
				oth:oth,
				txtcol:txtcol,
				txtuniv:txtuniv,
				txtoth:txtoth,
				mate:mate,
				quimi:quimi,
				fisi:fisi,
				lecto:lecto,
				musi:musi,
				idio:idio,
				otro:otro
			},method:"POST",success:function(data){
			$("#load_gif").hide("slide");		
			
			$("#gracias").show("slide");
				
			}});
		}
		else{
			alert("Uno de los campos obligatorios (*) no ha sido ingresado correctamente.");
		}
        // if ($('#form_contact_us').valid()) {
            // $(document).ajaxStart(
                 // function () {
                     // $("#btn_Send").button('loading');
                 // }
             // );
// 
            // $(document).ajaxSuccess(
                // function () {
                    // $("#btn_Send").button('reset');
                    // $("#form_contact_us")[0].reset();
                // }
            // );
// 
            // var ajaxRequest = $.ajax({
                // url: "handlers/contact.php",
                // type: "POST",
                // data: { formType: 'contact', txtName: txtName.val(), txtEmail: txtEmail.val(), txtMessage: txtMessage.val(), txtMailTo: txtMailTo }
            // });
// 
            // ajaxRequest.done(
            // function (response) {
                // var $message = '<i class="icon-ok"></i> ' + response;
                // $("#contact_form_message").addClass("alert");
                // $("#contact_form_message").html($message);
            // });
// 
            // ajaxRequest.error(
            // function (data) {
                // var $message = '<i class="icon-remove"></i> ' + data.responseText;
                // $("#contact_form_message").addClass("alert");
                // $("#contact_form_message").html($message);
                // $("#btn_Send").button('reset');
            // });
        // }
    });

    $('input, textarea').placeholder();

    if (!$.browser.mobile) {
        $("html").niceScroll({ scrollspeed: 100 });
        $(window).scroll(function () {
            $("html").getNiceScroll().resize();
        });
    }

});
function toggleTextReg(sel,chk,th){
		if(th.id===chk&&$(th).attr("checked")){
	$("#"+sel).show("slide");
	}else if(!$(th).attr("checked")&&th.id===chk){
		$("#"+sel).hide("slide");
	}
}
function val_txt(txt){
	if(txt===""||txt===null||txt===undefined) return false;
	return true;
}
function loadConfig(data) {
  
    $(data).find('launch-date-time').each(function () { launchDateTime = $(this).text(); });
    $(data).find('progress-status-percentage').each(function () {
        $('#progress-status').html($(this).text());
    });
    $(data).find('email-for-queries').each(function () { txtMailTo = $(this).text(); });
    $(data).find('facebook-page').each(function () {
        var link = $(this).text();
        $('#facebook-page').click(function () {
            location.href = link;
        });
    });
    $(data).find('twitter-page').each(function () {
        var link = $(this).text();
        $('#twitter-page').click(function () {
            location.href = link;
        });
    });
    $(data).find('googleplus-page').each(function () {
        var link = $(this).text();
        $('#googleplus-page').click(function () {
            location.href = link;
        });
    });
    $(data).find('instagram-page').each(function () {
        var link = $(this).text();
        $('#instagram-page').click(function () {
            location.href = link;
        });
    });
    $(data).find('youtube-page').each(function () {
        var link = $(this).text();
        $('#youtube-page').click(function () {
            location.href = link;
        });
    });
    $(data).find('vimeo-page').each(function () {
        var link = $(this).text();
        $('#vimeo-page').click(function () {
            location.href = link;
        });
    });

    $('#counter').countdown({
        finalDate: launchDateTime // DD MMMM YYYY, hh:mm:ss //'30 June 2013, 11:00:00'
    });
}

$('#nav').scrollspy();

jQuery(function ($) {
    $.supersized({
        slide_interval: 5000,
        transition: 1,
        transition_speed: 700,
        slide_links: 'blank',
        slides: [
                    { image: 'assets/images/profesor.jpeg' },
                    { image: 'assets/images/music.jpg' },
                    { image: 'assets/images/apuntes.jpg' },
                    { image: 'assets/images/clase.jpg' },
                    { image: 'assets/images/guitar.jpg' },
                    { image: 'assets/images/universitarios.jpg' }
        ]
        
    });
});

function CaptchaHandler() {
    var array_vals = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    var array_operators = new Array('+', '+');
    var index = parseInt(Math.random() * 10);
    index = (index == 0) ? index : (index - 1);
    var hidden_val_1 = array_vals[index];
    index = parseInt(Math.random() * 10);
    index = (index == 0) ? index : (index - 1);
    var hidden_val_2 = array_vals[index];
    index = parseInt(Math.random() * 10) % 2;
    var hidden_operator = array_operators[index];
    var result = 0;
    switch (hidden_operator) {
        case '*':
            result = hidden_val_1 * hidden_val_2;
            break;
        default:
            result = hidden_val_1 + hidden_val_2;
            break;
    }

    jQuery('label[for="txtCaptcha"]').html('Cuanto es ' + hidden_val_1 + ' ' + hidden_operator + ' ' + hidden_val_2 + ' = ?');

    var txtCaptchaResult = '<input type="hidden" id="txtCaptchaResult" />';
    jQuery("body").append(txtCaptchaResult);
    jQuery("#txtCaptchaResult").val(result);
}


function init_FormValidator() {
    $('#form_contact_us').validate({
        rules: {
            txtCaptcha: {
                equalTo: '#txtCaptchaResult'
            },
            txtName: "required"
        },
        messages: {
            txtName: '<i class="icon-remove-sign"></i> Requerido.',
            txtEmail: {
                Requerido: '<i class="icon-remove-sign"></i> Requerido.',
                email: '<i class="icon-info-sign"></i> Invalido.</b>',
               
            },
            txtMessage: '<i class="icon-remove-sign"></i> Requerido.',
            txtCaptcha: {
                Requerido: '<i class="icon-remove-sign"></i> Requerido.',
                equalTo: '<i class="icon-remove-sign"></i> Error! ¿No eres humano?.'
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            $('<div class="clearfix"></div>').insertBefore(error);
            $('<div class="clearfix"></div>').insertAfter(error);
            error.css({ left: element.position().left + (element.width() - error.width()), top: element.position().top + 3, position: 'absolute', 'z-index': 1100 });
            $(window).resize(function () {
                error.remove();
            });
        },
        InvalidoHandler: function (event, validator) {
            // 'this' refers to the form
            var errors = validator.numberOfInvalidos();
            if (errors) {
            } else {
            }
        }
    });
}
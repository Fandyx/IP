/* =============================================================
 Smooth Scroll 1.1
 Animated scroll to anchor links.
 
 Script by Charlie Evans.
 http://www.sycha.com/jquery-smooth-scrolling-internal-anchor-links
 
 Rebounded by Chris Ferdinandi.
 http://gomakethings.com
 
 Free to use under the MIT License.
 http://gomakethings.com/mit/
 * ============================================================= */
////////////// DOCUMENT READY
$(document).ready(function() {
// SMOOTH-SCROLL
    $(".scroll-smooth").click(function(event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top - 50}, 700);
    });
// SLIDER-INTRO
    $('#slider-intro').bxSlider({
        speed: 250,
        nextSelector: '#n-intro',
        prevSelector: '#p-intro',
        nextText: '<i class="fa fa-chevron-right fa-n"></i>',
        prevText: '<i class="fa fa-chevron-left fa-p"></i>',
        auto: true,
        pager: false
    });
    $('#email,#password').keydown(function(event){    
    if(event.keyCode==13){
       $('.login_button').trigger('click');
    }
    });
    $(".login_button").click(function() {
     $("#lor").val("l");
     document.getElementById("register_form").submit();
    });
// SLIDER-IMAC
    $(".register_button").click(function() {
        if (!$("#selrol,#reppas,#termsycond").is(":visible")) {
            $("#selrol").css({display: "block"});
            $("#reppass").css({display: "block"});
            $("#termsycond").css({display: "block"});
        } else {
            var pass = $("#password").val();
            var pass2 = $("#password2").val();
            var rol = $("#rol").val();
            var email = $("#email").val();
            var sw = true;
            if (pass.length >= 5) {
               
                if (pass !== pass2) {

                    sw = false;
                    bootbox.alert({
                        message: "La contraseñas no coinciden.",
                        title: "¡Error!"
                    }
                    );
                }
            }
            else {
                sw = false;
                bootbox.alert({
                    message: "La contraseña no puede tener menos de 5 caracteres.",
                    title: "!Lo sentimos!"
                }
                );
            }
            if ($("#rol").val() == "") {
                sw = false;
                bootbox.alert({
                    message: "Especifica un rol.",
                    title: "!Error!"
                }
                );
            }
            if(!$("#agree").is(":checked")){
                sw = false;
                bootbox.alert({
                    message: "Acepta nuestros términos y condiciones.",
                    title: "!Error!"
                }
                );
            }
            if (sw) {
                $("#lor").val("r");
                document.getElementById("register_form").submit();
            }
        }
    });

    $('#slider-imac').bxSlider({
        speed: 200,
        nextSelector: '#n-imac',
        prevSelector: '#p-imac',
        nextText: '<i class="fa fa-chevron-right fa-n"></i>',
        prevText: '<i class="fa fa-chevron-left fa-p"></i>',
        auto: true,
        pager: false
    });
    $(".ingresa").click(function() {
        $("#signup-box").fadeIn("slow");
    });
// MIXITUP
    $('#Grid').mixitup();
// NIVO-LIGHTBOX  
    $('a.nivoz').nivoLightbox({
        effect: 'slideUp',
    });

    $('a.video').nivoLightbox({
        errorMessage: 'The requested content cannot be loaded. Please try again later.',
        effect: 'nonexisent'
    });

});
// END DOCUMENT READY



// CONTACT
$(document).ready(function() {

    $('form#ajax_form .submit').click(function() {

        $('#ajax_form .error').hide();  //if error visibile, hide on new click

        var name = $('input#name').val();
        if (name == "" || name == " " || name == "Name") {
            $('input#name').focus().before('<div class="error">Ingresa tu nombre.</div>');
            return false;
        }

        var email_test = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
        var email = $('input#email2').val();
        if (email == "" || email == " ") {
            $('input#email2').focus().before('<div class="error">Ingresa tu direccion de correo electronico.</div>');
            return false;
        } else if (!email_test.test(email)) {
            $('input#email2').select().before('<div class="error">Hay un error con la direccion de correo.</div>');
            return false;
        }

        var message = $('#message').val();
        if (message == "" || message == " " || message == "Message") {
            $('#message').focus().fadeIn('slow').before('<div class="error">Ingresa un mensaje</div>');
            return false;
        }

        var data_string = $('form#ajax_form').serialize();

        $.ajax({
            type: "POST",
            url: "email.php",
            data: data_string,
            success: function() {

                $('form#ajax_form').slideUp('fast').before('<div id="success"></div>');
                $('#success').html('<h3>¡Gracias!</h3><p>Tu mensaje ha sido enviado.</p>').slideDown(9000);

            }//end success function


        }) //end ajax call

        return false;


    }) //end click function

    var current_data = new Array();

    $('.clear').each(function(i) {
        $(this).removeClass('clear').addClass('clear' + i);
        current_data.push($(this).val());

        $(this).focus(function() {
            if ($(this).val() == current_data[i]) {
                $(this).val('');
            }
        });
        $(this).blur(function() {
            var stored_data = current_data[i];
            if ($(this).val() == '') {
                $(this).val(stored_data);
            }
        })
    })
});
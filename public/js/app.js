$(document).ready(function() {
    $('.navbar-toggler').click(function() {
        if(!$(".navbar-collapse.justify-content-right.collapse").hasClass("show")) {
            $('#headerSepBar').hide();
        } else {
            setTimeout(function() {
                $('#headerSepBar').show();
            }, 400);
        }
    });

    $("input:not(.btn), textarea, select").focus(function() {
        $(this).prev().css('transition-property', 'color');
        $(this).prev().css('transition-duration', '0.4s');
        $(this).prev().css('color', '#5cb85c');
    });

    $("input:not(.btn), textarea, select").blur(function() {
        $(this).prev().css('transition-property', 'color');
        $(this).prev().css('transition-duration', '0.4s');
        $(this).prev().css('color', 'antiquewhite');
    });

    $("input[type='radio']").focus(function() {
        $($(this).parent().parent().prev().find('label')[0]).css('transition-property', 'color');
        $($(this).parent().parent().prev().find('label')[0]).css('transition-duration', '0.4s');
        $($(this).parent().parent().prev().find('label')[0]).css('color', '#5cb85c');
    });

    $("input[type='radio']").blur(function() {
        $($(this).parent().parent().prev().find('label')[0]).css('transition-property', 'color');
        $($(this).parent().parent().prev().find('label')[0]).css('transition-duration', '0.4s');
        $($(this).parent().parent().prev().find('label')[0]).css('color', 'antiquewhite');
    });

});
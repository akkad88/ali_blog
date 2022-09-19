function validateEmail(email) {
    var re = /[^A-z0-9\.\-\@]/;
    var email = String(email).toLowerCase();
    var retrunResult = false;

    if( email.search(re) < 0 ){
        retrunResult = true;
    } else {
        retrunResult = false;
    }
    return retrunResult;
}

$(document).ready(function () {
    'use strict';

    var _logForm = $('#login');
    _logForm.on('submit', function (event) {
        event.preventDefault();
        var _form = $(this);

        var form_data = {
            email: $('input[name="email"]', _form).val(),
            password: $('input[name="password"]', _form).val(),
        };

        var checkEmail = form_data.email.length >= 11;
        var checkEmail = checkEmail ? validateEmail(form_data.email) : checkEmail;

        var checkPassword = form_data.password.length >= 8; // Official 8

        var error = false;
        switch(true) {
            case !checkEmail:
                error = ' Check Your E-mail';
                break;
            case !checkPassword:
                error = 'Password Must be at least 8 characters';
                break;
            default:
                error = false;
                break;
        }

        if( error !== false ){
            $('.error', _form).text(error);
        } else {
            $.ajax({
                url: _form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: form_data,
                async: true
            })
            .done(function ajaxDone(response) {
              if(response.error != undefined){
                $('.error', _form).text(response.message);
              }

              if(response.success != undefined){
                window.location.href = response.url;
              }
            })
            .fail(function ajaxFailed(response) {
                $('.error', _form).text("Connection Error");
            })
            .always(function ajaxAlways(response) {
                console.log(response);
            });
            
        }



        return false;

    });

});
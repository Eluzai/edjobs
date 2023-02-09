$(document).ready(function(){
    $('#btnSubmit').prop("disabled", true);
    // validate email
    function isValidEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $('#fname').focusout(function(){
        var fname = $('#fname').val();
        if(fname == ''){
            $('#fn-msg').html("Required: Field cannot be empty");
            $('#fn-msg').css('padding-top','.5em');
            $('#fname').css('border','thin solid #FF602F');
            $('#fname').focus();
        }else{
            $('#fn-msg').html('');
            $('#fn-msg').css('padding-top','0');
            $('#fname').css('border','thin solid #ced4da');
            $('#lname').focus();
        }
    });

    $('#lname').focusout(function(){
        var lname = $('#lname').val();
        if(lname == ''){
            $('#ln-msg').html("Required: Field cannot be empty");
            $('#ln-msg').css('padding-top','.5em');
            $('#lname').css('border','thin solid #FF602F');
            $('#lname').focus();
        }else{
            $('#ln-msg').html('');
            $('#ln-msg').css('padding-top','0');
            $('#lname').css('border','thin solid #ced4da');
            $('#email').focus();
        }
    });

    $('#email').focusout(function(){
        var email = $('#email').val();
        if(email == ''){
            $('#mail-msg').html("email address required");
            $('#mail-msg').css('padding-top','.5em');
             $('#email').css('border','thin solid #FF602F');
            $('#email').focus();
        }else if (!isValidEmail(email)) {
            $("#mail-msg").html("enter a valid email");
            $('#mail-msg').css('padding-top','.5em');
            $('#email').css('border','thin solid #FF602F');
            $("#mail-msg").focus();
            return false;
        }else{
            $('#mail-msg').html('');
            $('#mail-msg').css('padding-top','0');
            $('#email').css('border','thin solid #ced4da');
            $('#state').focus();
        }
    });

    $('#password').focusout(function(){
        var pword = $('#password').val();
        if (pword == '') {
            $('#pword-msg').html("Password required");
            $('#pword-msg').css('padding-top','1em');
            $('#password').css('border','thin solid #FF602F');
            $("#password").focus();
        } else if (pword.length < 6) {
            $('#pword-msg').html("Password less than 8 characters");
            $('#pword-msg').css('padding-top','.5em');
            $('#password').css('border','thin solid #FF602F');
            $("#password").focus();
        }else{
            $('#pword-msg').html('');
            $('#pword-msg').css('padding-top','0');
            $('#password').css('border','thin solid #ced4da');
            $("#rpassword").focus();
        }
    });

    $('#rpassword').focusout(function(){
        var rpword = $('#rpassword').val();
        if (rpword == '') {
            $('#pword-msg').html("Re-type password");
            $('#pword-msg').css('padding-top','1em');
            $('#rpassword').css('border','thin solid #FF602F');
        } else if ($('#password').val() != $('#rpassword').val()) {
            $('#pword-msg').html("Password mismatch");
            $('#pword-msg').css('padding-top','.5em');
            $('#rpassword').css('border','thin solid #FF602F');
            $("#password").focus();
        }else{
            $('#pword-msg').html('');
            $('#pword-msg').css('padding-top','0');
            $('#rpassword').css('border','thin solid #ced4da');
            $('#btnSubmit').prop("disabled", false);
        }
    });
    
    // $('input[type="checkbox"]').click(function(){
    //     if($(this).prop("checked") == true){
    //         $('#btnSubmit').prop("disabled", false);
    //     }else if($(this).prop("checked") == false){
    //         $('#btnSubmit').prop("disabled", true);
    //     }
    // });

    $("#sForm").on('submit',(function(e) {
        e.preventDefault();
        var fd = new FormData(this);
        fd.append('fname',$('#fname').val());
        fd.append('lname',$('#lname').val());
        fd.append('email',$('#email').val());
        fd.append('subscribe',$('#subscribe').val());
        fd.append('password',$('#password').val());

        $.ajax({
            url: "users", // form action
            type: "POST", // form method
            data: fd, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false, // To send DOM Document or non processed data file it is set to false
            success: function(data){ // A function to be called if request succeeds
                if (data==0) {
                    $('#suc-msg').css('display','none');
                    $('#mail-msg').html('Email address has been taken');
                    $('#email').css('border','thin solid #FF602F');
                    $("#mail-msg").focus();
                }else if (data==1) {
                    $('#mail-msg').css('display','none');
                    $('#email').css('border','thin solid #ced4da');
                    $('#suc-msg').css('display','block');
                    $("#suc-msg").html($('#fname').val() + ' verify your mail to complete registration');
                    $('#sForm').prop("disabled", true);
                    setInterval(function () {
                        window.location.href = "/dashboard";
                    },3000);
                }
            }
        });
        return false;
    }));
});
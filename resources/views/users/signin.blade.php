<x-layout>
    <style type="text/css">
        .has-err{
          border: thin solid #FF602F;
        }
        .err{
            color: #FF602F;
            font-size: .8em;
            padding-top: .5em;
        }
    </style>
    
    <div class="col-md-4" style="width: 50%; margin: 3em auto;">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Login</h1>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <div id="logmsg"></div>
            <form method="POST" action="userlogin" name="frm_login" id="frm_login" class="frm_login">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="xyz@mail.com"  autocomplete="email">
                            <label for="email">Your Email</label>
                        </div>
                        <div id="mail-msg"></div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password"  placeholder="**********" autocomplete="current-password">
                            <label for="subject">Password</label>
                        </div>
                        <div id="pword-msg"></div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="button" name="sub" id="sub">Login</button>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            Not registered? <a href="/signup">Sign up</a> | <a href="/signup">Forgot password</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>
<script>
    $(document).ready(function(){
        $("#sub").click(function(){
            if ($('#email').val()=='') {
                $('#email').addClass('has-err');
                $('#mail-msg').html('Enter your email address');
                $('#mail-msg').addClass('err');
                $('#email').focus();
                return false;
            } else if (!isValidEmail($('#email').val())) {
                $('#email').addClass('has-err');
                $("#mail-msg").html("enter a valid email xyz@mail.com");
                $('#mail-msg').addClass('err');
                $('#email').focus();
                return false;
            } else if($('#password').val()=='') {
                $('#password').addClass('has-err');
                $('#pword-msg').html('Enter your password');
                $('#pword-msg').addClass('err');
                $('#password').focus();
                return false;
            } else { 
                var fd = $("#frm_login").serialize();
                $.ajaxSetup({
                    headers:{ // to set the CSRF token
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    }
                });
                $.ajax({
                    type: "POST", // form method
                    url: "userlogin", // form action
                    data: fd,
                    success: function(response){ // A function to be called if request succeeds
                        if (response == 1) {
                            window.location.replace('/dashboard');
                        } else if (response == 0) {
                            $('#logmsg').hide().html('Invalid email or password').addClass('alert alert-warning').fadeIn(500);
                        }
                    }
                });
                
                $('#email').removeClass('has-err');
                $('#mail-msg').html('');
                $('#password').removeClass('has-err');
                $('#pword-msg').html(''); 
            }
        });
    });

    function isValidEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    
</script>


<style>
    .has-err{
      border: thin solid #FF602F;
    }
    .err{
        color: #FF602F;
        font-size: .8em;
        padding-top: .5em;
    }
</style>
<x-layout>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="mb-4"> Edit Profile {{ $user->firstname }} </h4>
                    
                    <div id="edBlock">
                        
                        <div id="logmsg"></div>
                        <form method="POST" action="/users/{{ $user->id }}" id="edForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="fname" id="fname" value={{ auth()->user()->firstname }}>
                                        <label for="fname">First Name</label>
                                    </div>
                                    <div id="fname-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="lname" id="lname" value={{ auth()->user()->lastname }}>
                                        <label for="lname">Last Name</label>
                                    </div>
                                    <div id="lname-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email" value={{ auth()->user()->email }}>
                                        <label for="email">Email</label>
                                    </div>
                                    <div id="mail-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" name="formFile" id="formFile" placeholder="profile photo">
                                    </div>
                                    <div id="pix-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="rpassword" id="password" placeholder="********">
                                        <label for="password">Password</label>
                                    </div>
                                    <div id="pword-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="rpassword" id="rpassword" placeholder="********">
                                        <label for="rpassword">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input class="form-check-input" type="checkbox" name="subscribe" id="flexCheckDefault"> Notify me on latest job posts
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" id="btnsave" name="btnsave"> <i class="fas fa-save"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<script>
    $(document).ready(function(){
        $("#btnsave").click(function(){
            // image preview
            $("#formFile").change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $("#image_preview_container").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            })

            if ($('#fname').val()=='') {
                $('#fname').addClass('has-err');
                $('#fname-msg').html('Firstname required');
                $('#fname-msg').addClass('err');
                $('#fname').focus();
                return false;
            } else if ($('#lname').val()=='') {
                $('#lname').addClass('has-err');
                $('#lname-msg').html('Lastname required');
                $('#lname-msg').addClass('err');
                $('#lname').focus();
                return false;
            } else if ($('#email').val()=='') {
                $('#email').addClass('has-err');
                $('#mail-msg').html('Email address required');
                $('#mail-msg').addClass('err');
                $('#email').focus();
                return false;
            } else if (!isValidEmail($('#email').val())) {
                $('#email').addClass('has-err');
                $("#mail-msg").html("Email invalid");
                $('#mail-msg').addClass('err');
                $('#email').focus();
                return false;
            } else if($('#password').val()=='') {
                $('#password').addClass('has-err');
                $('#pword-msg').html('Enter your password');
                $('#pword-msg').addClass('err');
                $('#password').focus();
                return false;
            } else if($('#password').val()!=$('#rpassword').val()) {
                $('#password').addClass('has-err');
                $('#pword-msg').html('Password does not match');
                $('#pword-msg').addClass('err');
                $('#password').focus();
                return false;
            } else { 
                var fd = $("#edForm").serialize();
                $.ajaxSetup({
                    headers:{ // to set the CSRF token
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    }
                });
                $.ajax({
                    type: "POST", // form method
                    url: "/users/{{ $user->id }}", // form action
                    data: fd, // form data
                    success: function(response){ // A function to be called if request succeeds
                        if (response == 1) {
                            // $(".profile").show();
                            // $("#edbtn").show();
                            // $("#edBlock").hide();
                            window.location.href = "/dashboard";
                        } 
                    }
                });
                $("#fname, #lname, #email, #password").removeClass('has-err');
                $('#fname-msg, #lname-msg, #mail-msg, #pword-msg').removeClass('err');
                $('#fname-msg, #lname-msg, #mail-msg, #pword-msg').html('');
            }
        });
    });

    function isValidEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>
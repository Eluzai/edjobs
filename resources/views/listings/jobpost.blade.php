<style>
    .has-err{
      border: thin solid #FF602F;
    }
    .err{
        color: #FF602F;
        font-size: .8em;
        padding-top: .5em;
    }
    #edblock .profile{
        width: 100%;
        padding: .2em 0;
    }
    #edblock .profile img{
        clip-path: circle();
        width: 20%;
        height: auto;
    }
</style>
<x-layout>
    <div class="col-md-4" style="width: 50%; margin: 3em auto;">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Update Account Info</h1>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <div id="edBlock">
                
                <div id="logmsg"></div>
                <form method="POST" action="/users/{{ $user->id }}" id="edForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="profile">
                        <center>
                            <img class="img-fluid" src="{{ asset(auth()->user()->image) }}" id="imgPreview">
                        </center>
                        <hr>
                    </div>
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
                                <input type="password" class="form-control" name="password" id="password" placeholder="********">
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
</x-layout>
<script>
    $(document).ready(function(){
        // image preview
        $("#formFile").change(function(){
            let reader = new FileReader();
            var file = this.files[0];
            var fileType = file["type"];
            var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                $('#pix-msg').html('image must be (jpg, png, gif)');
                $('#pix-msg').addClass('err');
            } else{ 
                reader.onload = (e) => {
                    $('#pix-msg').html('');
                    $("#imgPreview").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                var src = $('img').attr('src'); // "static/images/banner/blue.jpg"
                var tarr = src.split('/');      // ["static","images","banner","blue.jpg"]
                var file = tarr[tarr.length-1]; // "blue.jpg"
                var data = file.split('.')[0];  // "blue"
                console.log(data);
            }
        })
        
        $("#btnsave").click(function(){
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
                $('#fname-msg, #lname-msg, #mail-msg, #pix-msg, #pword-msg').removeClass('err');
                $('#fname-msg, #lname-msg, #mail-msg, #pix-msg, #pword-msg').html('');
            }
        });
    });

    function isValidEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>
<style>
    .profile{
        float: left;
        margin-right: 1em;
        width: 45%;
        line-height: 2em;
    }
    .profile img{
        width: 40%;
        float: right;
    }
    .pfoot{
        width: 100%;
        float: none;
        clear: both;
    }
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
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                Welcome, {{ auth()->user()->firstname }}
            </h1>
            <div class="row g-4">
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-home text-primary"></i>
                                </div>
                                <a href=""><div><strong>Dashboard</strong></div></a>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-gear text-primary"></i>
                                </div>
                                <a href=""><div><strong>Manage profile</strong></div></a>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-gear text-primary"></i>
                                </div>
                                <a href=""><div><strong>Manage job listing</strong></div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <h4 class="mb-4"> Post</h4>
                    <strong> Job listing </strong><hr>
                    <strong> Company </strong><hr>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="mb-4"> Profile</h4>
                    <div class="profile">
                        <ul style="list-style: none;" class="list-group" id="user-info">
                            <li><Strong><i class="fa-solid fa-user-circle text-success"></i> Name</Strong> {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</li>
                            <li><Strong><i class="fa fa-envelope text-success"></i> Email</Strong> {{ auth()->user()->email }}</li>
                            <li><Strong><i class="fas fa-newspaper text-success"></i> Newsletter</Strong> {{ auth()->user()->subscribe }}</li>
                        </ul>
                        
                    </div>
                    
                    <div class="profile">
                        @if (auth()->user()->image == 'default')
                            <img class="img-fluid w-10" src="img/placeholder.png">
                        @else
                            <img class="img-fluid w-10" src="{{ $list->logo ? asset('storage/'.$list->logo) : asset('images/placeholder.png') }}" alt="">
                        @endif
                    </div>
                    <div id="edBlock">
                        <div id="logmsg"></div>
                        <form method="POST" action="/dashboard" id="edForm">
                            @csrf
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
                                    <button class="btn btn-primary w-100 py-3" type="submit" id="btnsave" name="btnsave">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="pfoot">
                        <button class="btn btn-success" onclick="edit()" id="edbtn"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<script>
    $("#edBlock").hide();
    $("#edbtn").click(function(){
        $(".profile").hide();
        $("#edbtn").hide();
        $("#edBlock").show();
    });

    $(document).ready(function(){
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
                alert(fd);
                // $.ajaxSetup({
                //     headers:{ // to set the CSRF token
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                //     }
                // });
                // $.ajax({
                //     type: "POST", // form method
                //     url: "dashboard", // form action
                //     data: fd,
                //     success: function(response){ // A function to be called if request succeeds
                //         if (response == 1) {
                //             $(".profile").show();
                //             $("#edbtn").show();
                //             $("#edBlock").hide();
                //         } 
                //     }
                // });
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
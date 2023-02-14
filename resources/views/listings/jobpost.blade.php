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
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Information</h1>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <div id="edBlock">
                <a href="/company" class="btn btn-light">Add Company </a>
                <div id="logmsg"></div>
                <form method="POST" action="" id="jobForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="job_title" id="job_title" placeholder="Job Title">
                                <label for="job_title">Job Title</label>
                            </div>
                            <div id="title-msg"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="editor" id="editor" placeholder="Job Descrition"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>-Select company-</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                
                                <label for="fname">Company</label>
                            </div>
                            <div id="title-msg"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>-Choose Work type-</option>
                                    <option value="1">Full-time | Onsite</option>
                                    <option value="2">Full-time | Remote</option>
                                    <option value="1">Full-time | Hybrid</option>
                                    <option value="1">Part-time | Onsite</option>
                                    <option value="2">Part-time | Remote</option>
                                    <option value="1">Part-time | Hybrid</option>
                                </select>
                                <label for="fname">Work type</label>
                            </div>
                            <div id="title-msg"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>-Job City-</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                
                                <label for="fname">City</label>
                            </div>
                            <div id="title-msg"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>-Job State-</option>
                                    <option value="1">Full-time | Onsite</option>
                                    <option value="2">Full-time | Remote</option>
                                    <option value="1">Full-time | Hybrid</option>
                                    <option value="1">Part-time | Onsite</option>
                                    <option value="2">Part-time | Remote</option>
                                    <option value="1">Part-time | Hybrid</option>
                                </select>
                                <label for="fname">State</label>
                            </div>
                            <div id="title-msg"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="tag" id="tag" placeholder="job,category,tag">
                                <label for="tag">Listing Tags</label>
                            </div>
                            <div id="title-msg"></div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit" id="btnsave" name="btnsave"> <i class="fas fa-plus"></i> Create job post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
<script>
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
                $.ajaxSetup({
                    headers:{ // to set the CSRF token
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    }
                });
                $.ajax({
                    type: "POST", // form method
                    url: "", // form action
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
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script> 
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            }
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
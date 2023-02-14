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
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                Company Profile 
            </h1>
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h4 class="mb-4"> Create Company</h4>
                    <div id="edBlock">
                        <div id="logmsg"></div>
                        <form method="POST" action="/company" id="companyForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Job Title">
                                        <label for="company_name">Company name</label>
                                    </div>
                                    <div id="title-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="company_mail" id="company_mail" placeholder="Company Mail">
                                        <label for="company_mail">Company Mail</label>
                                    </div>
                                    <div id="title-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" name="logo" id="logo">
                                        <label for="tag">Company Logo</label>
                                    </div>
                                    <div id="title-msg"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea name="editor" id="editor" placeholder="Company Descrition"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="Company address">
                                        <label for="address">Company Address</label>
                                    </div>
                                    <div id="title-msg"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" aria-label="Default select example" name="city" id="city">
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
                                        <select class="form-select" aria-label="Default select example" name="state" id="state">
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
                                
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="website" id="website" placeholder="http://www.company.com">
                                        <label for="website">Website</label>
                                    </div>
                                    <div id="title-msg"></div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" id="btnsave" name="btnsave"> <i class="fas fa-plus"></i> Create Company Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <h4 class="mb-4"> Company List</h4><hr>
                </div>
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

    new FroalaEditor('textarea#froala-editor')
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
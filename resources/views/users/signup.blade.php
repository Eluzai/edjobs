<x-layout>
    <style type="text/css">
        .err-msg, .msg{
          color: #FF602F;
          font-size: .7em;
        }
        #err, #suc-msg{
          display:none;
          font-size: .8em;
          font-weight:900;
        }
    </style>
    <div class="col-md-4" style="width: 50%; margin: 3em auto;">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Register</h1>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <p class="mb-4 text-center"> Sign up to post and find your next teaching jobs </p>

            <div class="alert alert-success" role="alert" id="suc-msg"></div>
            <div class="alert alert-warning" role="alert" id="err"></div>

            <form method="POST" action="users" id="sForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Your First Name">
                            <label for="fname">First Name</label>
                        </div>
                        <div class="err-msg" id="fn-msg"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Your Last Name">
                            <label for="lname">Last Name</label>
                        </div>
                        <div class="err-msg" id="ln-msg"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="xyz@mail.com">
                            <label for="email">Email</label>
                        </div>
                        <div class="err-msg" id="mail-msg"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="********">
                            <label for="password">Password</label>
                        </div>
                        <div class="err-msg" id="pword-msg"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="rpassword" id="rpassword" placeholder="********">
                            <label for="rpassword">Re-type Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input class="form-check-input" type="checkbox" name="subscribe" id="flexCheckDefault"> Notify me on latest job posts
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit" id="btnSubmit">Register</button>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            Already registered? <a href="/login">Login</a> | <a href="/dashboard">Dashboard</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>
<script src="js/signup.js"></script>
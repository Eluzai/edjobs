<x-layout>
    
    <div class="col-md-4" style="width: 50%; margin: 3em auto;">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Register</h1>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <p class="mb-4 text-center"> Sign up to post and find your next teaching jobs </p>
            
            <form method="POST" action="/users">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="fname" id="fname" placeholder="Your First Name">
                            <label for="fname">First Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Your Last Name">
                            <label for="lname">Last Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" id="email" placeholder="xyz@mail.com">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="********">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="rpassword" id="rpassword" placeholder="********">
                            <label for="rpassword">Re-type Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="notify"> Notify me on latest job posts
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Register</button>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            Already registered? <a href="/login">Login</a> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>
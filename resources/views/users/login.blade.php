<x-layout>
    
    <div class="col-md-4" style="width: 50%; margin: 3em auto;">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Login</h1>
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <form>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="xyz@mail.com">
                            <label for="email">Your Email</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="subject" placeholder="Password">
                            <label for="subject">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
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
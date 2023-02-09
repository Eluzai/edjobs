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
                        <img class="img-fluid w-10" src="{{ asset(auth()->user()->image) }}" >
                    </div>
                    <hr>
                    <div class="pfoot">
                        <a class="btn btn-success" href="users/{{ auth()->user()->id }}/edit" id="edbtn"><i class="fas fa-edit"></i> Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<script>
    // $("#edBlock").hide();
    // $("#edbtn").click(function(){
    //     $(".profile").hide();
    //     $("#edbtn").hide();
    //     $("#edBlock").show();
    // });

    
</script>
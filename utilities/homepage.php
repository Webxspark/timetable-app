<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row text-center">
            <div class="col-xl-10 mx-auto">
                <h2 class="fs-15 text-uppercase text-muted mb-3">TimeTables</h2>
                <!-- <h3 class="display-4 mb-10 px-xxl-15">We’re always searching for amazing people to join our team. Take a look at our current openings.</h3> -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="job-list mb-10">
                    <h3 class="mb-4">Choose a class from this list</h3>
                    
                    <a href="#" class="card mb-4 lift">
                        <div class="card-body p-5">
                            <span class="row justify-content-between align-items-center">
                                <span class="col-md-5 mb-2 mb-md-0 d-flex align-items-center text-body">
                                    <span class="avatar <?php echo $App->randomize_bg() ?> text-white w-9 h-9 fs-17 me-3">C</span> {{CLASS-INFO}} </span>
                                <span class="col-5 col-md-3 text-body d-flex align-items-center">
                                    <i class="uil uil-clock me-1"></i> {{TIME-AGO}} </span>
                                <span class="col-7 col-md-4 col-lg-3 text-body d-flex align-items-center">
                                    <i class="uil uil-user-check"></i> {{CLASS-INCHARGE}} </span>
                                <span class="d-none d-lg-block col-1 text-center text-body">
                                    <i class="uil uil-angle-right-b"></i>
                                </span>
                            </span>
                        </div>
                        <!-- /.card-body -->
                    </a>
                    <!-- /.card -->
                    
                </div>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
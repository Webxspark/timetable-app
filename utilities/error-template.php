<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="job-list mb-10">
                    <h4 class="fs-15 text-uppercase text-muted mb-3">Something Went Wrong!</h4>

                    <?php
                    if (isset($errors)) {
                        if (count($errors) > 0) {
                            foreach ($errors as $key => $val) {
                                echo '<div class="alert alert-info alert-icon" role="alert">
                                    <i class="uil uil-exclamation-circle"></i> ' . $val . '
                                </div>';
                            }
                        }
                    }
                    ?>
                    <div class="text-center">
                        <button class="btn btn-primary" onclick="history.back()">Go Back</button>
                    </div>
                </div>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
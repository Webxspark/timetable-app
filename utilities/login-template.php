<?php include 'header.php'; ?>

<section class="wrapper bg-light">
    <div class="container py-md-16">
        <div class="row gx-lg-12 gx-xl-16 align-items-center">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Welcome Back</h2>
                        <p class="lead mb-6 text-start">Fill your email and password to sign in.</p>
                        <form autocomplete="off" wxpclid="login-form" action="<wxp-self>" class="text-start mb-3">
                            <wxp-alert></wxp-alert>
                            <div class="form-floating mb-4">
                                <input value="admin@user.com" type="email" class="form-control" placeholder="Email" id="loginEmail">
                                <label for="loginEmail">Email</label>
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" placeholder="Password" id="loginPassword">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="loginPassword">Password</label>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Sign In</button>
                        </form>
                        <!-- /form -->
                        <div class="alert alert-primary">
                            <h4>Email: admin@user.com<br>Pass: admin</h4>
                        </div>
                    </div>
                    <!--/.card-body -->
                </div>
                <!--/.card -->
            </div>

        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>

<?php 
if(isset($_REQUEST['redir'])){
    echo "<wxp-redir style=\"display:none;\">{$_REQUEST['redir']}</wxp-redir>";
}
include 'footer.php'; 
?>
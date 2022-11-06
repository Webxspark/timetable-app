<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Alan Christofer">
  <title><?php echo APP_TITLE; ?></title>
  <link rel="shortcut icon" href="./assets/img/favicon.png">
  <link rel="stylesheet" href="./assets/css/plugins.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/colors/sky.css">
  <link rel="preload" href="./assets/css/fonts/urbanist.css" as="style" onload="this.rel='stylesheet'">
</head>

<body>
  <div class="content-wrapper">
    <header class="wrapper bg-light">
      <nav class="navbar navbar-expand-lg classic transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="./">
              <img src="./assets/img/logo-dark.png" srcset="https://webxspark.com/assets/images/header_logo-2.png" alt="" />
            </a>
          </div>
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
              <h3 class="text-white fs-30 mb-0">Webxspark</h3>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link" href="mailto:alanchris@webxspark.com">Report an Issue</a>
                </li>
                <?php if($App->check_login_status()): ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="./admin">Admin</a>
                  </li>
                <?php endif; ?>
              </ul>
              <!-- /.navbar-nav -->
              <div class="offcanvas-footer d-lg-none">
                <div>
                  <a href="mailto:alanchris@webxspark.com" class="link-inverse">alanchris@webxspark.com</a>
                  <br /> <a href="tel:9176097404" class="link-inverse">+91 (917) 609-7404</a> <br />
                  <nav class="nav social social-white mt-4">
                    <a href="https://twitter.com/AlanChris06" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-twitter"></i></a>
                    <a href="https://soulof8d.webxspark.com/profile/facebook" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-facebook-f"></i></a>
                    <a href="https://soulof8d.webxspark.com/profile/instagram" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-instagram"></i></a>
                    <a href="https://soulof8d.webxspark.com/profile/youtube" rel="noopener noreferrer nofollow" target="_blank"><i class="uil uil-youtube"></i></a>
                  </nav>
                  <!-- /.social -->
                </div>
              </div>
              <!-- /.offcanvas-footer -->
            </div>
            <!-- /.offcanvas-body -->
          </div>
          <!-- /.navbar-collapse -->
          <div class="navbar-other ms-lg-4">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <li class="nav-item d-none d-md-block">
                <?php if(!$App->check_login_status()): ?>
                <a href="./admin?auth=login&redir=<?php echo $App->getLink(); ?>" class="btn btn-sm btn-primary rounded-pill">Login</a>
                <?php endif; ?>
                <?php if($App->check_login_status()): ?>
                <a wxpclid="logout" class="btn btn-sm btn-primary rounded-pill">Logout</a>
                <?php endif; ?>
              </li>
              <li class="nav-item d-lg-none">
                <button class="hamburger offcanvas-nav-btn"><span></span></button>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>
          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav>
      <!-- /.navbar -->
    </header>
    <!-- /header -->

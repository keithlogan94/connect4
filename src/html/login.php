<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vlava Bootstrap Template - Index</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/images/favicon.png" rel="icon">
  <link href="/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">

    <style>
        #hero {
            width: 100%;
            height: 17vh;
            background-size: cover;
            position: relative;
            margin-bottom: 5em;
        }

        .center {
            margin: 0 auto;
        }
    </style>

  <!-- =======================================================
  * Template Name: Vlava - v2.0.0
  * Template URL: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="/setup"><span>Connect4Friends</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="/images/logo.png" alt="" class="img-fluid"></a>-->
      </div>

        <?php
        include dirname(__FILE__) . '/links.php';
        ?>



    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <h1>Login</h1>
    </div>
  </section><!-- End Hero -->

  <main id="main">

      <!-- ======= Pricing Section ======= -->
      <section id="pricing" class="pricing">
          <div class="container">

              <div class="section-title">
                  <h2>Login</h2>

                  <?php if (isset($_GET['m'])): ?>
                    <div class="alert alert-success">
                        <p><?= urldecode(base64_decode($_GET['m'])) ?></p>
                    </div>
                  <?php else: ?>
                  <?php if (isset($_SESSION['invited'])): ?>
                    <div class="alert alert-success">
                        <p><?= '<strong>'.\Connect4\functions\utils\get_name_from_user_id(intval($_SESSION['invited']['setup_user_id']))  . '</strong> has invited you to play a game of Connect4, after you login you will automatically join their game of Connect4. Please <a href=\'/signup\'>signup</a> if you don\'t have an account.'?></p>
                    </div>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <p><?= base64_decode($_GET['error']) ?></p>
                    </div>
                  <?php endif; ?>

              </div>


                 <form action="/login_request" method="POST">

                     <div class="row mb-4">
                         <div class="col-lg-4 col-md-6 center">
                             <div class="box">
                                 <h3>Email</h3>
                                 <div class="form-group">
                                     <input id="email_input" type="email" name="email" placeholder="Email:" class="form-control">
                                 </div>
                             </div>
                         </div>
                     </div>


                     <div class="row mb-4">
                         <div class="col-lg-4 col-md-6 mt-4 mt-md-0 center">
                             <div class="box featured blue">
                                 <h3>Password</h3>
                                 <div class="form-group">
                                     <input id="password_input" type="password" name="password" placeholder="Password:" class="form-control">
                                 </div>
                             </div>
                         </div>
                     </div>


                     <div class="row">
                         <div class="col-lg-4 col-md-6 mt-4 mt-lg-0 center">
                             <div class="box gold">

                                 <div class="btn-wrap">
                                     <button class="btn-buy">Login</button>
                                 </div>
                             </div>
                         </div>
                     </div>


                 </form>


              </div>

      </section><!-- End Pricing Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row  justify-content-center">
          <div class="col-lg-6">
            <h3>Vlava</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
          </div>
        </div>

        <div class="row footer-newsletter justify-content-center">
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>

        <div class="social-links">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Vlava</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vlava-free-bootstrap-one-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/vendor/php-email-form/validate.js"></script>
  <script src="/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>

</body>

</html>
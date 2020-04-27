<!DOCTYPE html>
<html lang="en">

<head>
    <?php include dirname(__FILE__) . '/html-head.php'; ?>
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

              <div class="row">
                  <div class="col-md-5">
                      <div class="section-title">
                          <h2>Login  <small> to Play Connect4 Online with Friends</small></h2>
                          <h5>If you don't have an account then <a href="/signup">signup</a>.</h5>

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
                                  <p>If you do not have an account please <a href="/signup">signup</a>.</p>
                              </div>
                          <?php endif; ?>

                      </div>
                      <form action="/login_request" method="POST">

                          <div class="row mb-4">
                              <div class="col-lg-12 col-md-6 center section-title">
                                  <div class="box">
                                      <h3>Email</h3>
                                      <div class="form-group">
                                          <input id="email_input" type="email" name="email" placeholder="Email:" class="form-control">
                                      </div>
                                  </div>
                              </div>
                          </div>


                          <div class="row mb-4">
                              <div class="col-lg-12 col-md-6 mt-4 mt-md-0 center section-title">
                                  <div class="box featured blue">
                                      <h3>Password</h3>
                                      <div class="form-group">
                                          <input id="password_input" type="password" name="password" placeholder="Password:" class="form-control">
                                      </div>
                                  </div>
                              </div>
                          </div>


                          <div class="row">
                              <div class="col-lg-12 col-md-6 mt-4 mt-lg-0 center section-title">
                                  <div class="box gold">

                                      <div class="btn-wrap">
                                          <button class="btn-buy">Login</button>
                                      </div>
                                  </div>
                              </div>
                          </div>


                      </form>
                  </div>
                  <div class="col-md-7">
                      <?php include dirname(__FILE__) . '/connect4-carousel.php'; ?>
                  </div>

              </div>








              </div>

      </section><!-- End Pricing Section -->


  </main><!-- End #main -->

  <?php


  include dirname(__FILE__) . '/footer.php' ?>

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
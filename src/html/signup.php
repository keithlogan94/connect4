
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
      <h1>Signup</h1>
    </div>
  </section><!-- End Hero -->

  <main id="main">

      <!-- ======= Pricing Section ======= -->
      <section id="pricing" class="pricing">
          <div class="container">


              <div class="row">
                  <div class="col-md-5">


                      <div class="section-title">
                          <h2>Signup <small> to Play Connect4 Online with Friends</small></h2>
                          <?php if (isset($_SESSION['invited'])): ?>
                              <div class="alert alert-success">
                                  <p><strong><?= \Connect4\functions\utils\get_name_from_user_id(intval($_SESSION['invited']['setup_user_id']))  . '</strong> has invited you, and <strong>is currently waiting</strong> to play a game of Connect4 with you, <strong>after you signup you will automatically join</strong> their game of Connect4. If you already have an account, please <a href=\'/login\'>login</a>.'?></p>
                              </div>
                          <?php endif; ?>
                          <?php if (isset($_GET['error'])): ?>
                              <div class="alert alert-danger">
                                  <p><?= base64_decode($_GET['error']) ?></p>
                              </div>
                          <?php else: ?>
                              <p>Connect4 Awaits</p>
                          <?php endif; ?>
                      </div>


                      <form action="/register_user" method="post">
                          <div class="row">

                              <div class="col-lg-12 col-md-12">
                                  <div class="box form">
                                      <h3>Contact Info</h3>


                                      <div class="form-group">
                                          <label for="email_input" class="text-left">Email:</label>
                                          <input id="email_input" name="email_input" class="form-control" type="email" placeholder="Email:" value="<?= $_SESSION['email_input'] ?>">
                                      </div>

                                      <div class="form-group">
                                          <label for="first_name">First Name:</label>
                                          <input id="first_name" name="first_name" class="form-control" type="text" placeholder="First Name:" value="<?= $_SESSION['first_name_input'] ?>">
                                      </div>

                                      <div class="form-group">
                                          <label for="last_name">Last Name:</label>
                                          <input id="last_name" name="last_name" class="form-control" type="text" placeholder="Last Name:" value="<?= $_SESSION['last_name_input'] ?>">
                                      </div>

                                      <div class="form-group">
                                          <label for="favorite_color">Favorite Color:</label>
                                          <select id="favorite_color" name="favorite_color" class="form-control">
                                              <option value="">Select Favorite Color</option>
                                              <option value="red"<?php if ($_SESSION['favorite_color_input'] === 'red') echo "selected='selected'"; ?>>Red</option>
                                              <option value="yellow" <?php if ($_SESSION['favorite_color_input'] === 'yellow') echo "selected='selected'"; ?>>Yellow</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-lg-12 col-md-12 mt-4 mt-md-0">
                                  <div class="box featured blue form">
                                      <h3>Password</h3>
                                      <div class="form-group">
                                          <label for="password_input" class="text-left">Password:</label>
                                          <input id="password_input" name="password_input" class="form-control" type="password" placeholder="Password:">
                                      </div>

                                      <div class="form-group">
                                          <label for="confirm_password">Confirm Password:</label>
                                          <input id="confirm_password" name="confirm_password" class="form-control" type="password" placeholder="Confirm Password:">
                                      </div>

                                  </div>
                                  <div class="box gold mt-12">

                                      <div class="btn-wrap">
                                          <button class="btn-buy">Signup</button>
                                      </div>
                                  </div>
                              </div>

                              <div class="col-lg-12 col-md-6 mt-4 mt-lg-0">
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

  <?php include dirname(__FILE__) . '/footer.php' ?>

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
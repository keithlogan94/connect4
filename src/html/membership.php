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
      <h1>Membership</h1>
        <h2>Play with Exclusives</h2>
        <a href="#pricing" class="btn-get-started scrollto">Get Membership</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

      <!-- ======= Pricing Section ======= -->
      <section id="pricing" class="pricing">
          <div class="container">

              <div class="section-title">
                  <h2>Membership</h2>
                  <p>Exclusives for members</p>
              </div>

              <div class="row">

                  <div class="col-lg-4 col-md-6">
                      <div class="box">
                          <h3>Visitor</h3>
                          <h4><sup>$</sup>0<span> / month</span></h4>
                          <ul>
                              <li>Play 2 Games per day</li>
                              <li>Play with Any Online Visitor or Player</li>
                              <li class="na">Play Unlimited Games per day</li>
                              <li class="na">Anyone You Invite Plays for Free!</li>
                              <li class="na">Be Featured on the Global Scoreboard</li>
                          </ul>
                          <div class="btn-wrap">
                              <a href="#" class="btn-buy disabled">ACTIVE</a>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
                      <div class="box featured blue">
                          <h3>Player</h3>
                          <h4><sup>$</sup>2<span> / month</span></h4>
                          <ul>
                              <li>Play Unlimited Games per day</li>
                              <li>Play with Any Online Visitor or Player</li>
                              <li>Anyone You Invite Plays for Free!</li>
                              <li class="na">Be Featured on the Global Scoreboard</li>
                          </ul>
                          <div class="btn-wrap">
                              <a href="#" class="btn-buy">Buy Now</a>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
                      <div class="box gold">
                          <h3>Player Pro</h3>
                          <h4><sup>$</sup>10<span> / month</span></h4>
                          <ul>
                              <li>Play Unlimited Games per day</li>
                              <li>Play with Any Online Visitor or Player</li>
                              <li>Anyone You Invite Plays for Free!</li>
                              <li>Be Featured on the Global Scoreboard</li>
                          </ul>
                          <div class="btn-wrap">
                              <a href="#" class="btn-buy">Buy Now</a>
                          </div>
                      </div>
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
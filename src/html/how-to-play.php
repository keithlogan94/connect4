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
    </div>
  </section><!-- End Hero -->

  <main id="main">


      <!-- ======= Frequently Asked Questions Section ======= -->
      <section id="faq" class="faq">
          <div class="container">

              <div class="section-title">
                  <h2>How to Play Connect4</h2>
              </div>

              <div class="row  d-flex align-items-stretch">

                  <div class="col-lg-6 faq-item">
                      <h4 class="section-title">Yellow or Red player goes first.</h4>
                  </div>

                  <div class="col-lg-6 faq-item">
                      <h4 class="section-title">Players switch turns after placing a token.</h4>
                  </div>

                  <div class="col-lg-6 faq-item">
                      <h4 class="section-title">Be the first player player to connect 4 of your color horizontally, vertically, or diagonally.</h4>
                  </div>

                  <div class="col-lg-6 faq-item">
                      <h4 class="section-title">That's it. Your wins, and losses are tracked in your profile!</h4>
                  </div>


              </div>

          </div>
      </section><!-- End Frequently Asked Questions Section -->




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
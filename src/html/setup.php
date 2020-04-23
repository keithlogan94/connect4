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
            height: 34vh;
            background-size: cover;
            position: relative;
            margin-bottom: 5em;
        }

        option:hover, option:active, option {
            background: lightgreen;
            font-weight: bold;
        }

        .no-pointer-events {
            pointer-events: none;
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
      <h1>Setup A Game</h1>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">


          <?php




          $didCreateConnect4SetupRecord = false;


          if (!isset($_SESSION['invite_code'], $_SESSION['invite_link'])) {
              if (isset($_GET['game_mode'], $_GET['game_name'])) {
                  $inviteCode = md5(time());

                  $inviteLink = 'http://' . APPLICATION_HOSTNAME . '/invite/' . $inviteCode;

                  $_SESSION['invite_code'] = $inviteCode;
                  $_SESSION['invite_link'] = $inviteLink;


                  $database = new \Connect4\Database\Database();
                  $database->queryPrepared('CALL add_game_setup(?, ?, ?, ?, ?)', 'ssiis', $_GET['game_mode'], $_GET['game_name'], $_SESSION['user_id'], -1, $inviteCode);

                  $didCreateConnect4SetupRecord = true;
              }
          } else {
              $inviteCode = $_SESSION['invite_code'];
              $inviteLink = $_SESSION['invite_link'];
              $didCreateConnect4SetupRecord = true;
          }



          ?>



          <?php if ($didCreateConnect4SetupRecord): ?>

          <p>Waiting for other player.</p>
          <p>Please invite the other player by having them go to this link in their browser <?= $inviteLink ?></p>
          <p>After they go to that link then the game will start.</p>
          <script>

              window.onload = function () {
                  setInterval(function () {

                      $.ajax({
                          url: "/is_game_ready/<?= $inviteCode ?>",
                          type: 'GET',
                          success: function (response) {
                              const gameSetup = JSON.parse(response);
                              if (gameSetup.game_id != null) {
                                  window.location = '/' + gameSetup.game_id;
                              }
                          }
                      });


                  }, 1000);

              };


          </script>



          <?php else: ?>


              <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="get">

                  <div class="row content">
                      <div class="col-lg-12">
                          <div class="form-group">
                              <label for="game_mode">Game Mode:</label>
                              <select id="game_mode" class="form-control" name="game_mode">
                                  <option>Select Game Mode</option>
                                  <option value="1" selected="selected">Classic Connect4</option>
                                  <option value="2">Connect5 (Coming Soon)</option>
                                  <option value="3">Connect6 (Coming Soon)</option>
                                  <option value="4">Connect4 3D (Coming Soon)</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="game_name">Game Name:</label>
                              <input type="text" name="game_name" id="game_name" placeholder="What title do you want to give this game? e.g. 'Friends Competitive 1'" class="form-control">
                          </div>
                          <!--                  <div class="form-group">-->
                          <!--                      <label>Invite Other Player:</label><br>-->
                          <!--                      <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#invitePlayerModal">Invite Other Player</button>-->
                          <!--                  </div>-->

                      </div>
                      <!--              <div class="col-lg-6 pt-4 pt-lg-0">-->

                      <!--                  <div class="form-group">-->
                      <!--                      <label for="players">Players Ready:</label>-->
                      <!--                      <select multiple="multiple" name="players" id="players" class="form-control no-pointer-events">-->
                      <!--                          <option value="0">You</option>-->
                      <!--                      </select>-->
                      <!--                      <p value="1"><em id="other_player_status">(Waiting on other Player)...</em></p>-->
                      <!--                  </div>-->

                      <!--              </div>-->
                  </div>

                  <button class="btn btn-primary btn-lg">Play</button>

              </form>

              <div id="invitePlayerModal" class="modal" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Invite Other Player</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <p>Invite another player</p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                      </div>
                  </div>
              </div>

          <?php endif; ?>


      </div>
    </section><!-- End About Section -->




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
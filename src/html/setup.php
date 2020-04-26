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
<?php
    require_once('includes/connectBDD.php');
    $nompage = "Présentation association";
    require_once('includes/head.php');
?>

<body class="landing-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>


  <div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/bg1.jpg');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title">Présentation de l'Association</h1>
        </div>
      </div>
    </div>

    <?php
    $asso = $db->query("SELECT * FROM descriptionasso");
    while($association = $asso->fetch(PDO::FETCH_OBJ)){
      ?>

    <div class="section section-about-us">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto text-center">
            <h2 class="title">Qui sommes nous ?</h2>
            <h5 class="description"><?php echo $association->description1 ?></h5>
          </div>
        </div>
      </div>
    </div>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block" src="assets/img/bg1.jpg" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Nature, United States</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="assets/img/bg3.jpg" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Somewhere Beyond, United States</h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="assets/img/bg4.jpg" alt="Third slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5>Yellowstone National Park, United States</h5>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h5 class="description"><?php echo $association->description1 ?></h5>
            </div>
          </div>
        </div>
      </div>
      <?php
          }
          ?>
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

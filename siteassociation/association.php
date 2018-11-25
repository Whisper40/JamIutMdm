<?php
    require_once('includes/connectBDD.php');
    $nompage = "Présentation association";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');
?>
<style>
.page-header .page-header-image {
  position: absolute;
  background-size: cover;
  background-position: center center;
  width: 100%;
  height: 80%;
  z-index: -1;
}

.page-header .content-center {
  position: absolute;
  top: 38%;
  left: 50%;
  z-index: 2;
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
  color: #FFFFFF;
  padding: 0 15px;
  width: 100%;
  max-width: 880px;
}
.section {
  padding: 0px 0;
  position: relative;
  background: #FFFFFF;
}
</style>

<body class="landing-page sidebar-collapse">


<?php
    require_once('includes/navbar.php');

    $asso = $db->query("SELECT * FROM pageasso");
    $association = $asso->fetch(PDO::FETCH_OBJ);
    $head = $db->query("SELECT * FROM photopage WHERE nompage = '$nompage'");
    $pagehead = $head->fetch(PDO::FETCH_OBJ);
?>
<div class="wrapper">

    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/<?php echo $pagehead->image; ?>');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title"><?php echo $pagehead->pagetitre; ?></h1>
        </div>
      </div>
    </div>

    <div class="section section-about-us">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto text-center">
            <h2 class="title"><?php echo $association->titre1 ?></h2>
            <h5 class="description"><?php echo $association->description1 ?></h5>
          </div>
        </div>
      </div>
    </div>
    <br>

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
                  <img class="d-block" src="assets/img/<?php echo $association->img1 ?>" alt="First slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $association->titreimg1 ?></h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="assets/img/<?php echo $association->img2 ?>" alt="Second slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $association->titreimg2 ?></h5>
                  </div>
                </div>
                <div class="carousel-item">
                  <img class="d-block" src="assets/img/<?php echo $association->img3 ?>" alt="Third slide">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $association->titreimg3 ?></h5>
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
      <br><br>
      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h5 class="description"><?php echo $association->description1 ?></h5>
            </div>
          </div>
        </div>
      </div>
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

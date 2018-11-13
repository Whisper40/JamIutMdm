<?php
    require_once('includes/connectBDD.php');
    $nompage = "Index";
    require_once('includes/head.php');
?>

<body class="index-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');

    $index = $db->query("SELECT * FROM index");
    while($lindex = $index->fetch(PDO::FETCH_OBJ)){
    ?>

  <div class="wrapper">
    <div class="page-header clear-filter">
      <div class="page-header-image" data-parallax="true" style="background-image: url('assets/img/<?php echo $lindex->img1 ?>');">
      </div>
      <div class="container">
        <div class="content-center brand">
          <img class="n-logo" src="assets/img/<?php echo $lindex->logo1 ?>" alt="">
        </div>
      </div>
    </div>
    <div class="main">

      <div class="section section-nucleo-icons">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <h2 class="title"><?php echo $lindex->titre1 ?></h2>
              <h5 class="description">
                <?php echo $lindex->description1 ?>
              </h5>
              <a href="<?php echo $lindex->lienbt1 ?>" class="btn btn-primary btn-round btn-lg"><?php echo $lindex->bouton1 ?></a>
              <a href="<?php echo $lindex->lienbt2 ?>" class="btn btn-primary btn-simple btn-round btn-lg"><?php echo $lindex->bouton2 ?></a>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="container text-center">
                <br><br><br><br>
                <img src="assets/img/<?php echo $lindex->logo2 ?>" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="section section-download" id="#download-section" data-background-color="black">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="text-center col-md-12 col-lg-8">
              <h3 class="title"><?php echo $lindex->titre2 ?></h3>
              <h5 class="description"><?php echo $lindex->description2 ?></h5>
            </div>
          </div>
          <div class="row justify-content-md-center sharing-area text-center">
            <div class="text-center col-md-12 col-lg-8">
              <a target="_blank" href="#" class="btn btn-neutral btn-icon btn-twitter btn-round btn-lg" rel="tooltip" title="Follow us">
                <i class="fab fa-twitter"></i>
              </a>
              <a target="_blank" href="#" class="btn btn-neutral btn-icon btn-facebook btn-round btn-lg" rel="tooltip" title="Like us">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a target="_blank" href="#" class="btn btn-neutral btn-icon btn-linkedin btn-lg btn-round" rel="tooltip" title="Follow us">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
}
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

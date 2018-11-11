<?php
    require_once('includes/connectBDD.php');
    $nompage = "Activité / Voyage";
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
        <h1 class="title">Activitées et Voyages</h1>
      </div>
    </div>
  </div>


  <div class="section section-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto text-center">
          <h2 class="title">Who we are?</h2>
          <h5 class="description">According to the National Oceanic and Atmospheric Administration, Ted, Scambos, NSIDClead scentist, puts the potentially record low maximum sea ice extent tihs year down to low ice extent in the Pacific and a late drop in ice extent in the Barents Sea.</h5>
        </div>
      </div>
    </div>
  </div>



<div class="section section-tabs">
  <div class="container">
    <div class="row">
      <div class="col-md-10 ml-auto col-xl-6 mr-auto">
        <p class="category">Tabs with Icons on Card</p>
        <!-- Nav tabs -->
        <div class="card">
          <div class="card-header">
            <center>
            <div class="image-container" style="background-image: url('assets/img/assets/img/voyage-ski-2018.jpg')"></div>
            <img src="./assets/img/jam-logo.png" alt="">
          </center>
          </div>
          <div class="card-body">


          </div>
        </div>
      </div>
      <div class="col-md-10 ml-auto col-xl-6 mr-auto">
        <p class="category">Tabs with Background on Card</p>
        <!-- Tabs with Background on Card -->
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs nav-tabs-neutral justify-content-center" role="tablist" data-background-color="orange">
              <li class="nav-item">
                <a href="#"><h2>Coucou</h2></a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <center>
            <img src="assets/img/voyage-ski-2018.jpg" alt="">
            </br></br></br>
            <h5>ffffffffffffffffffffffffffffffffffff</h5>

          </center>


          </div>
        </div>
        <!-- End Tabs on plain Card -->
      </div>
    </div>
  </div>
</div>

<?php
require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

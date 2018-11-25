<?php
    require_once('includes/connectBDD.php');
    $nompage = "Activité / Voyage";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');
    $user_id = $_SESSION['user_id'];
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

<?php

  if(isset($_GET['showmethisactivity'])){
		$product = htmlentities($_GET['showmethisactivity']);
		$select = $db->prepare("SELECT * FROM activitesvoyages WHERE slug='$product'");
		$select->execute();
		$s = $select->fetch(PDO::FETCH_OBJ);

		$description = $s->description;
		$description2 = $s->description2;
		$description3 = $s->description3;
		$description_finale=wordwrap($description,100,'<br />', false); // False sert a dire si on découpe le mot ou non
		$description_finale2=wordwrap($description2,100,'<br />', false); // Le 100 sert au retour a la ligne
		$description_finale3=wordwrap($description3,100,'<br />', false);
		?>

      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h1 class="title"><?php echo $s->title; ?></h1>
              <h5 class="description"><?php echo $description_finale; ?></h5>
            </div>
          </div>
        </div>
      </div>
      <div class="section" id="carousel">
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
      </div>
      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h3 class="title"><?php echo $s->title2; ?></h3>
              <h5 class="description"><?php echo $description_finale2; ?></h5>
            </div>
          </div>
        </div>
      </div>
      <div class="section" id="carousel">
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
      </div>
      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h3 class="title"><?php echo $s->title3; ?></h3>
              <h5 class="description"><?php echo $description_finale3; ?></h5>
            </div>
          </div>
        </div>
      </div>
      <div class="section" id="carousel">
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
      </div>
      <br><br>
      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-6 ml-auto mr-auto text-center">
              <div class="pull-left">
                <h3>
                  Places restantes : <?php echo $s->stock; ?>
                </h3>
              </div>
              <div class="pull-right">
                <h3>
                  Prix : <?php echo $s->price; ?> €
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section section-contact-us text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
                  <?php if ($s->stock>0){ ?>
                    <?php
                    if (isset($user_id)){
                      ?>
                      <div class="send-button">
                        <a href="https://dashboard.jam-mdm.fr/activiteesencours.php?activityname=<?php echo $s->slug;?>" class="btn btn-primary btn-round btn-block btn-lg">Je Participe à l'évenement</a>
                      </div>
                      <?php
                    }else{
                      ?>
                      <div class="send-button">
                        <a href="https://jam-mdm.fr/connect.php" class="btn btn-primary btn-round btn-block btn-lg">Je me connecte pour participer</a>
                      </div>
                      <?php
                    }
                     ?>

                  <?php }else{ ?>
                    <h5 style="color:red;">Aucune place n\'est disponible !</h5>
                  <?php } ?>
                </div>
            </div>
        </div>
    </div>

		<?php

	}else{

	if(isset($_GET['category'])){
		$category_slug=$_GET['category'];
		$select = $db->query("SELECT surname FROM sitecat WHERE slug='$category_slug'");
		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->surname);
		$select = $db->prepare("SELECT * FROM activitesvoyages WHERE surname='$category' AND status='ACTIVE'");
		$select->execute();

      ?>

      <div class="section section-about-us">
        <div class="container">
          <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
              <h2 class="title"><?php echo $pagehead->titre; ?></h2>
              <h5 class="description"><?php echo $pagehead->description; ?></h5>
            </div>
          </div>
        </div>
      </div>
      <br><br>
      <div class="section section-tabs">
        <div class="container">
          <div class="row">
      <?php

      while($s=$select->fetch(PDO::FETCH_OBJ)){

        $lenght=75;
        $description = $s->description;
        $new_description=substr($description,0,$lenght)."...";
        $description_finale=wordwrap($new_description,50,'<br />', false);



  			?>

      <div class="col-md-10 ml-auto col-xl-6 mr-auto">
        <div class="card">
          <div class="card-header">
            <a href="?showmethisactivity=<?php echo $s->slug; ?>&amp;p=<?php echo $s->price; ?>">
              <img src="assets/img/<?php echo $s->slug; ?>.<?php echo $s->formatimg; ?>">
            </a>
          </div>
          <div class="card-body">
            <div class="card-content">
              <center>
              <a href="?showmethisactivity=<?php echo $s->slug; ?>&amp;p=<?php echo $s->price; ?>">
                <h2 class="card-title"><?php echo $s->title;?></h2>
              </a>
              <p class="card-description">
                <?php echo $description_finale; ?>
              </p>
              <br>
              <div class="pull-left">
                <h5>
                  <b>Prix : <?php echo $s->price; ?> €</b>
                </h5>
                <h5>
                  <b>Place disponible : <?php echo $s->stock; ?></b>
                </h5>
              </div>
              </center>
              <div class="pull-right">
                <?php if ($s->stock>0){ ?>
                <div class="button-container">
                  <a href="https://jam-mdm.fr/activitees.php?showmethisactivity=<?php echo $s->slug;?>" class="btn btn-primary btn-round btn-lg">Voir l'activité</a>
                </div>

                <?php }else{ ?>
                  <br>
                  <h5 style="color:red;">Aucune place n'est disponible !</h5>
                <?php } ?>
              </div>

              </div>
            </div>
          </div>
        </div>
<?php
}
?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
}else{
	header('Location: https://jam-mdm.fr/');
}
}


require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

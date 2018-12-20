<?php
    require_once('includes/connectBDD.php');
    $nompage = "Actualité";
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

    $head = $db->prepare("SELECT * FROM photopage WHERE nompage=:nompage");
    $head->execute(array(
        "nompage"=>$nompage
        )
    );
    $pagehead = $head->fetch(PDO::FETCH_OBJ);
?>
<div class="wrapper">

      <div class="page-header page-header-small">
        <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/<?php echo $pagehead->image; ?>');"></div>
        <div class="content-center">
          <div class="container">
            <h1 class="title"><?php echo $pagehead->pagetitre; ?></h1>
          </div>
        </div>
      </div>

      <?php

	if(isset($_GET['showmethisnews'])){
		$news = htmlentities($_GET['showmethisnews']);
		$select = $db->prepare("SELECT * FROM newsactus WHERE slug='$news'");
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

    <?php
    $titre1 = $s->title;

    $carousel1 = $db->prepare("SELECT * FROM carousel WHERE slug=:news AND titre=:titre1");
    $carousel1->execute(array(
        "news"=>$news,
        "titre1"=>$titre1
        )
    );

    $nbimage1 = $carousel1->rowCount();
    if($nbimage1 != 0){
    ?>

    <div class="section" id="carousel">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                  $indic = 0;
                  while($indic != $nbimage1){
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $indic ?>"></li>
                <?php
                  $indic++;
                  }
                ?>
              </ol>
              <div class="carousel-inner" role="listbox">
              <?php
                $indic = 0;
                while($uneimg = $carousel1->fetch(PDO::FETCH_OBJ)){
                  if($indic == 0){
              ?>
                <div class="carousel-item active">
              <?php }else{ ?>
                <div class="carousel-item">
              <?php } ?>
                  <img class="d-block" src="assets/img/<?php echo $uneimg->image ?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $uneimg->titreimage ?></h5>
                  </div>
                </div>
              <?php
              $indic = 1;
              }
              ?>
              </div>
              <?php
                if($nbimage1 != 1){
              ?>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>


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

    <?php
    $titre2 = $s->title2;

    $carousel2 = $db->prepare("SELECT * FROM carousel WHERE slug=:news AND titre=:titre2");
    $carousel2->execute(array(
        "news"=>$news,
        "titre2"=>$titre2
        )
    );

    $nbimage2 = $carousel2->rowCount();
    if($nbimage1 != 0){
    ?>

    <div class="section" id="carousel">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                  $indic = 0;
                  while($indic != $nbimage2){
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $indic ?>"></li>
                <?php
                  $indic++;
                  }
                ?>
              </ol>
              <div class="carousel-inner" role="listbox">
              <?php
                $indic = 0;
                while($uneimg = $carousel2->fetch(PDO::FETCH_OBJ)){
                  if($indic == 0){
              ?>
                <div class="carousel-item active">
              <?php }else{ ?>
                <div class="carousel-item">
              <?php } ?>
                  <img class="d-block" src="assets/img/<?php echo $uneimg->image ?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $uneimg->titreimage ?></h5>
                  </div>
                </div>
              <?php
              $indic = 1;
              }
              ?>
              </div>
              <?php
                if($nbimage2 != 1){
              ?>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>

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

    <?php
    $titre3 = $s->title3;

    $carousel3 = $db->prepare("SELECT * FROM carousel WHERE slug=:news AND titre=:titre3");
    $carousel3->execute(array(
        "news"=>$news,
        "titre3"=>$titre3,
        )
    );


    $nbimage3 = $carousel3->rowCount();
    if($nbimage3 != 0){
    ?>

    <div class="section" id="carousel">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                  $indic = 0;
                  while($indic != $nbimage3){
                ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $indic ?>"></li>
                <?php
                  $indic++;
                  }
                ?>
              </ol>
              <div class="carousel-inner" role="listbox">
              <?php
                $indic = 0;
                while($uneimg = $carousel3->fetch(PDO::FETCH_OBJ)){
                  if($indic == 0){
              ?>
                <div class="carousel-item active">
              <?php }else{ ?>
                <div class="carousel-item">
              <?php } ?>
                  <img class="d-block" src="assets/img/<?php echo $uneimg->image ?>">
                  <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $uneimg->titreimage ?></h5>
                  </div>
                </div>
              <?php
              $indic = 1;
              }
              ?>
              </div>
              <?php
                if($nbimage3 != 1){
              ?>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <i class="now-ui-icons arrows-1_minimal-left"></i>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <i class="now-ui-icons arrows-1_minimal-right"></i>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php } ?>

    <br>

		<?php

	}else{

	if(isset($_GET['category'])){
		$category_slug=$_GET['category'];

    $select = $db->prepare("SELECT surname FROM sitecat WHERE slug=:category_slug");
    $select->execute(array(
        "category_slug"=>$category_slug
        )
    );

		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->surname);

    $select = $db->prepare("SELECT * FROM newsactus WHERE surname=:category AND status=:status");
    $select->execute(array(
        "category"=>$category,
        "status"=>'ACTIVE'
        )
    );

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
            <img src="assets/img/<?php echo $s->slug; ?>.<?php echo $s->formatimg; ?>">
          </div>
          <div class="card-body">
            <div class="card-content">
              <center>
              <h2 class="card-title"><?php echo $s->title;?></h2>
              <p class="card-description">
                <?php echo $description_finale; ?>
              </p>
              <div class="pull-center">
                <h6>
                    <a href="?showmethisnews=<?php echo $s->slug; ?>" class="btn btn-primary btn-round btn-lg">Voir cette actualité</a>
                </h6>
              </div>
            </center>
            </div>
          </div>
        </div>
      </div>

			<?php	} ?>

        </div>
      </div>
    </div>

<?php
}else{
	header('Location: https://jam-mdm.fr/');
}
}

?>
  </div>
<?php

require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

<?php
    require_once('includes/connectBDD.php');
    $nompage = "Actualité";
    require_once('includes/head.php');
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
  top: 40%;
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

		<br/><div style="text-align:center;">
		<img src="assets/img/<?php echo $s->slug; ?>.<?php echo $s->formatimg; ?>"/>
		<h1><?php echo $s->title; ?></h1>
		<h5><?php echo $description_finale; ?></h5>

		<h1><?php echo $s->title2; ?></h1>
		<h5><?php echo $description_finale2; ?></h5>

		<h1><?php echo $s->title3; ?></h1>
		<h5><?php echo $description_finale3; ?></h5>


		</div><br/>

		<?php

	}else{

	if(isset($_GET['category'])){
		$category_slug=$_GET['category'];
		$select = $db->query("SELECT surname FROM sitecat WHERE slug='$category_slug'");
		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->surname);
		$select = $db->prepare("SELECT * FROM newsactus WHERE surname='$category' AND status='ACTIVE'");
		$select->execute();

    ?>
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
            <a href="?showmethisnews=<?php echo $s->slug; ?>">
              <img src="assets/img/<?php echo $s->slug; ?>.<?php echo $s->formatimg; ?>">
            </a>
          </div>
          <div class="card-body">
            <div class="card-content">
              <center>
              <a href="?showmethisnews=<?php echo $s->slug; ?>">
                <h2 class="card-title"><?php echo $s->title;?></h2>
              </a>
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


require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

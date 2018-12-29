<?php
    require_once('includes/connectBDD.php');
    $nompage = "Statuts";
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

    $head = $db->query("SELECT * FROM photopage WHERE nompage = '$nompage'");
    $pagehead = $head->fetch(PDO::FETCH_OBJ);
?>
  <div class="wrapper">

    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./JamFichiers/Img/ImagesDuSite/Original/<?php echo $pagehead->image; ?>');">
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
            <h2 class="title"><?php echo $pagehead->titre; ?></h2>
          </div>
        </div>
      </div>
    </div>

    <?php
    $asso = $db->query("SELECT * FROM status ORDER BY article");
    while($association = $asso->fetch(PDO::FETCH_OBJ)){
      ?>

      <div class="section">
          <div class="container">
              <h3 class="title">
                <ul>
                  <li>
                    Article <?php echo $association->article; ?> - <?php echo $association->titre; ?> - <?php echo $association->soustitre; ?>
                  </li>
                </ul>
              </h3>
              <div class="section section-about-us">
                <div class="container">
                  <div class="row">
                    <div class="col-md-10 ml-auto mr-auto text-center">
                      <h5 class="description"><?php echo $association->description; ?></h5>
                    </div>
                  </div>
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

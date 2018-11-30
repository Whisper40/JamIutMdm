<?php
    require_once('includes/connectBDD.php');
    $nompage = "Présentation des membres";
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
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/<?php echo $pagehead->image; ?>');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title"><?php echo $pagehead->pagetitre; ?></h1>
        </div>
      </div>
    </div>

    <div class="section section-team text-center">
      <div class="container">
        <h2 class="title"><?php echo $pagehead->titre; ?></h2>
        <div class="team">

          <div class="pull-left">
            <h3 class="title">
              <ul>
                <li>
                  La présidence
                </li>
              </ul>
            </h3>
          </div>
        <br><br><br><br><br>

        <div class="row">


            <?php
            $membres = $db->query("SELECT * FROM membres WHERE categorie = 'pres' ORDER BY importance");
            while($unmembre = $membres->fetch(PDO::FETCH_OBJ)){
              ?>
            <div class="col-md-4">
              <div class="team-player">
                <img src="assets/img/membres/<?php echo $unmembre->image ?>" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                <h4 class="title"><?php echo $unmembre->nom ?></h4>
                <p class="category text-primary"><?php echo $unmembre->fonction ?></p>
                <p class="description"><?php echo $unmembre->description ?></p><br>
              </div>
            </div>
            <?php
                }
                ?>

          </div>
          <div class="pull-left">
            <h3 class="title">
              <ul>
                <li>
                  Responsable Secrétaire
                </li>
              </ul>
            </h3>
          </div>
        <br><br><br><br><br>

        <div class="row">


            <?php
            $membres = $db->query("SELECT * FROM membres WHERE categorie = 'secr' ORDER BY importance");
            while($unmembre = $membres->fetch(PDO::FETCH_OBJ)){
              ?>
            <div class="col-md-4">
              <div class="team-player">
                <img src="assets/img/membres/<?php echo $unmembre->image ?>" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                <h4 class="title"><?php echo $unmembre->nom ?></h4>
                <p class="category text-primary"><?php echo $unmembre->fonction ?></p>
                <p class="description"><?php echo $unmembre->description ?></p><br>
              </div>
            </div>
            <?php
                }
                ?>

          </div>
          <div class="pull-left">
            <h3 class="title">
              <ul>
                <li>
                  Responsable Trésorier
                </li>
              </ul>
            </h3>
          </div>
        <br><br><br><br><br>

        <div class="row">


            <?php
            $membres = $db->query("SELECT * FROM membres WHERE categorie = 'tres' ORDER BY importance");
            while($unmembre = $membres->fetch(PDO::FETCH_OBJ)){
              ?>
            <div class="col-md-4">
              <div class="team-player">
                <img src="assets/img/membres/<?php echo $unmembre->image ?>" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                <h4 class="title"><?php echo $unmembre->nom ?></h4>
                <p class="category text-primary"><?php echo $unmembre->fonction ?></p>
                <p class="description"><?php echo $unmembre->description ?></p><br>
              </div>
            </div>
            <?php
                }
                ?>

          </div>
          <div class="pull-left">
            <h3 class="title">
              <ul>
                <li>
                  Responsable Communicartion
                </li>
              </ul>
            </h3>
          </div>
        <br><br><br><br><br>

        <div class="row">


            <?php
            $membres = $db->query("SELECT * FROM membres WHERE categorie = 'com' ORDER BY importance");
            while($unmembre = $membres->fetch(PDO::FETCH_OBJ)){
              ?>
            <div class="col-md-4">
              <div class="team-player">
                <img src="assets/img/membres/<?php echo $unmembre->image ?>" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                <h4 class="title"><?php echo $unmembre->nom ?></h4>
                <p class="category text-primary"><?php echo $unmembre->fonction ?></p>
                <p class="description"><?php echo $unmembre->description ?></p><br>
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
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

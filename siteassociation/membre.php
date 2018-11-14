<?php
    require_once('includes/connectBDD.php');
    $nompage = "Présentation des membres";
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
          <h1 class="title">Présentation des membres du bureau</h1>
        </div>
      </div>
    </div>

    <div class="section section-team text-center">
      <div class="container">
        <h2 class="title">Voici notre équipe</h2>
        <div class="team">

          <?php
          $cat = $db->query("SELECT DISTINCT categorie FROM membres");
          while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
          $lacat = $unecat->categorie
            ?>

          <div class="pull-left">
            <h3 class="title">
              <ul>
                <li>
                  <?php echo $lacat ?>
                </li>
              </ul>
            </h3>
          </div>
        <br><br><br>        <br><br>

          <div class="row">


            <?php
            $membres = $db->query("SELECT * FROM membres WHERE categorie = '$lacat'");
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

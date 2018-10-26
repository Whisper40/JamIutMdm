<!DOCTYPE html>
<html lang="fr">

<?php
  // Connexion à la BDD
   require_once('includes/head.php');
   ?>

<head>
  <meta charset="utf-8" />

  <meta name="Description" content="Association JAM ( Jeunesse Associative Montoise ) - Mont de Marsan">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr"> <!-- Mail Admin -->


  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Jam - Présentation des Membres</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <!-- Les CSS utilisés -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse">

  <?php
     require_once('includes/header.php');
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
          <div class="row">

            <?php
            $membres = $db->query("SELECT * FROM membres");
            while($unmembre = $membres->fetch(PDO::FETCH_OBJ)){
              ?>
            <div class="col-md-4">
              <div class="team-player">
                <img src="./assets/img/<?php echo $unmembre->image ?>" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
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

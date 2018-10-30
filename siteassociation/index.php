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

  <title>Jam - index</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <!-- Les CSS utilisés -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">

  <?php
     require_once('includes/header.php');
  ?>

  <div class="wrapper">
    <div class="page-header clear-filter">
      <div class="page-header-image" data-parallax="true" style="background-image:url(assets/img/IUTmdm.JPG)">
      </div>
      <div class="container">
        <div class="content-center brand">
          <img class="n-logo" src="assets/img/jam3.png" alt="">
        </div>
      </div>
    </div>
    <div class="main">

      <div class="section section-nucleo-icons">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <h2 class="title">INTRODUCTION</h2>
              <h5 class="description">
                Et te voilà maintenant en toute fierté devenu(e) étudiant(e) à l’Université, dans toute sa splendeur ! Tu te demandes peut-être beaucoup de questions sur ta nouvelle vie estudiantine. JAM (Jeunesse Associative Montoise) est là pour répondre à tes questions et faciliter ton intégration avec cette petite plaquette qui comporte les éléments essentiels sur ta nouvelle vie !
                Tu as forcément une idée sur ce que c’est un IUT. Mais saches que ce qu’on te dit manque toujours quelques précisions. Une petite information pour démarrer : Est-ce que tu sais déjà que tu puisses joindre une école d’ingénieur après avoir réussir ton DUT ? Oui oui, une école d’ingénieur et encore plus une parmi les meilleures en France ;-) C’est cool alors l’IUT !
                Et donc, pour atteindre tel objectif ou n’importe quel autre, il faut faire plus que TRAVAILLER, il faut développer une attitude propice à la réussite !
                Bienvenue à TOI !
              </h5>
              <a href="association.php" class="btn btn-primary btn-round btn-lg">Présentation Association</a>
              <a href="membre.php" class="btn btn-primary btn-simple btn-round btn-lg">Les membres</a>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="container text-center">
                <br><br><br><br>
                <img src="./assets/img/jam-logo.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="section section-download" id="#download-section" data-background-color="black">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="text-center col-md-12 col-lg-8">
              <h3 class="title">Do you love this Bootstrap 4 UI Kit?</h3>
              <h5 class="description">Cause if you do, it can be yours for FREE. Hit the button below to navigate to Creative Tim or Invision where you can find the kit in HTML or Sketch/PSD format. Start a new project or give an old Bootstrap project a new look!</h5>
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
    <!-- Sart Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h4 class="title title-up">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default">Nice Button</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--  End Modal -->
    <!-- Mini Modal -->
    <div class="modal fade modal-mini modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <div class="modal-profile">
              <i class="now-ui-icons users_circle-08"></i>
            </div>
          </div>
          <div class="modal-body">
            <p>Always have an access to your profile</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link btn-neutral">Back</button>
            <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

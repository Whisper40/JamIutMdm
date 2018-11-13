<?php
    require_once('includes/connectBDD.php');
    $nompage = "Index";
    require_once('includes/head.php');
?>

<body class="index-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
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
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

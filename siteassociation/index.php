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
          <img class="n-logo" src="./assets/img/now-logo.png" alt="">
          <h1 class="h1-seo">Now UI Kit.</h1>
          <h3>A beautiful Bootstrap 4 UI kit. Yours free.</h3>
        </div>
      </div>
    </div>
    <div class="main">

      <div class="section">
        <div class="container text-center">
          <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-8">
              <h2 class="title">INTRODUCTION</h2>
              <h5 class="description">Coucou ! Tu commences peut-être un peu à entrevoir ce que pourra être ton année à venir mais saches, ce n’est qu’un minuscule aperçu de ce qu’elle sera vraiment, c’est-à-dire 10 fois mieux que dans tes rêves les plus fous (au moins).
              Bon on ne va pas mentir, il va falloir travailler, travailler, TRAVAILLER (un concept qui auront du mal à saisir ceux qui ont passé le bac sans rien faire) mais ça tu le sais déjà, c’est ce qu’ont dû te dire tes parents, tes profs, tes amis, tes frères et sœurs et peut être toi-même si tu es réaliste...
              Grâce entre autres à des événements organisés par JAM qui fera en sorte que l’IUT soit pour toi une nouvelle famille et pour faciliter ton intégration, on t’a fait une petite plaquette avec les éléments essentiels de ta nouvelle vie !
              Bienvenue à TOI !</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="section section-nucleo-icons">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <h2 class="title">INTRODUCTION</h2>
              <h5 class="description">
                Coucou ! Tu commences peut-être un peu à entrevoir ce que pourra être ton année à venir mais saches, ce n’est qu’un minuscule aperçu de ce qu’elle sera vraiment, c’est-à-dire 10 fois mieux que dans tes rêves les plus fous (au moins).
                Bon on ne va pas mentir, il va falloir travailler, travailler, TRAVAILLER (un concept qui auront du mal à saisir ceux qui ont passé le bac sans rien faire) mais ça tu le sais déjà, c’est ce qu’ont dû te dire tes parents, tes profs, tes amis, tes frères et sœurs et peut être toi-même si tu es réaliste...
                Grâce entre autres à des événements organisés par JAM qui fera en sorte que l’IUT soit pour toi une nouvelle famille et pour faciliter ton intégration, on t’a fait une petite plaquette avec les éléments essentiels de ta nouvelle vie !
                Bienvenue à TOI !
              </h5>
              <a href="nucleo-icons.html" class="btn btn-primary btn-round btn-lg" target="_blank">View Demo Icons</a>
              <a href="https://nucleoapp.com/?ref=1712" class="btn btn-primary btn-simple btn-round btn-lg" target="_blank">View All Icons</a>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="hero-images-container">
                <img src="assets/img/jam-logo.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="section section-javascript" id="javascriptComponents">
        <div class="container">
          <h3 class="title">Javascript components</h3>
          <div class="row" id="modals">
            <div class="col-md-6">
              <h4>Modal</h4>
              <a href="#" class="link" data-toggle="modal" data-target="#myModal">Mot de passe oublié</a>

            </div>
            </div>
          </div>
        </div>
      </div>




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






      <div class="section" id="carousel">
        <div class="container">
          <div class="title">
            <h4>Carousel</h4>
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-9 col-md-13">
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

      <div class="section">
        <div class="container text-center">
          <div class="row justify-content-md-center">
            <div class="col-md-12 col-lg-8">
              <h2 class="title">Completed with examples</h2>
              <h5 class="description">The kit comes with three pre-built pages to help you get started faster. You can change the text and images and you're good to go. More importantly, looking at them will give you a picture of what you can built with this powerful Bootstrap 4 ui kit.</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="section section-signup" style="background-image: url('assets/img/bg11.jpg'); background-size: cover; background-position: top center; min-height: 700px;">
        <div class="container">
          <div class="row">
            <div class="card card-signup" data-background-color="orange">
              <form class="form" method="" action="">
                <div class="card-header text-center">
                  <h3 class="card-title title-up">Sign Up</h3>
                  <div class="social-line">
                    <a href="#pablo" class="btn btn-neutral btn-facebook btn-icon btn-round">
                      <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#pablo" class="btn btn-neutral btn-twitter btn-icon btn-lg btn-round">
                      <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#pablo" class="btn btn-neutral btn-google btn-icon btn-round">
                      <i class="fab fa-google-plus"></i>
                    </a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="input-group no-border">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="now-ui-icons users_circle-08"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="First Name...">
                  </div>
                  <div class="input-group no-border">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="now-ui-icons text_caps-small"></i>
                      </span>
                    </div>
                    <input type="text" placeholder="Last Name..." class="form-control" />
                  </div>
                  <div class="input-group no-border">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="now-ui-icons ui-1_email-85"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Email...">
                  </div>
                  <!-- If you want to add a checkbox to this form, uncomment this code -->
                  <!-- <div class="checkbox">
								<input id="checkboxSignup" type="checkbox">
									<label for="checkboxSignup">
									Unchecked
									</label>
								</div> -->
                </div>
                <div class="card-footer text-center">
                  <a href="#pablo" class="btn btn-neutral btn-round btn-lg">Get Started</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col text-center">
            <a href="examples/login-page.html" class="btn btn-simple btn-round btn-white btn-lg" target="_blank">View Login Page</a>
          </div>
        </div>
      </div>
      <div class="section section-examples" data-background-color="black">
        <div class="space-50"></div>
        <div class="container text-center">
          <div class="row">
            <div class="col">
              <a href="examples/landing-page.html" target="_blank">
                <img src="assets/img/landing.jpg" alt="Image" class="img-raised">
              </a>
              <a href="examples/landing-page.html" class="btn btn-simple btn-primary btn-round">View Landing Page</a>
            </div>
            <div class="col">
              <a href="examples/profile-page.html" target="_blank">
                <img src="assets/img/profile.jpg" alt="Image" class="img-raised">
              </a>
              <a href="examples/profile-page.html" class="btn btn-simple btn-primary btn-round">View Profile Page</a>
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
            <div class="text-center col-md-12 col-lg-8">
              <a href="https://www.creative-tim.com/product/now-ui-kit" class="btn btn-primary btn-lg btn-round" role="button">
                Download HTML
              </a>
              <a href="https://www.invisionapp.com/now" target="_blank" class="btn btn-primary btn-lg btn-simple btn-round" role="button">
                Download PSD/Sketch
              </a>
            </div>
          </div>
          <br>
          <br>
          <br>
          <div class="row text-center mt-5">
            <div class="col-md-8 ml-auto mr-auto">
              <h2>Want more?</h2>
              <h5 class="description">We've just launched
                <a href="http://demos.creative-tim.com/now-ui-kit-pro/presentation.html" target="_blank">Now UI Kit PRO</a>. It has a huge number of components, sections and example pages. Start Your Development With A Badass Bootstrap 4 UI Kit.</h5>
            </div>
            <div class="col-md-12">
              <a href="http://demos.creative-tim.com/now-ui-kit-pro/presentation.html" class="btn btn-neutral btn-round btn-lg" target="_blank">
                <i class="now-ui-icons arrows-1_share-66"></i> Upgrade to PRO
              </a>
            </div>
          </div>
          <br>
          <br>
          <div class="row justify-content-md-center sharing-area text-center">
            <div class="text-center col-md-12 col-lg-8">
              <h3>Thank you for supporting us!</h3>
            </div>
            <div class="text-center col-md-12 col-lg-8">
              <a target="_blank" href="https://www.twitter.com/creativetim" class="btn btn-neutral btn-icon btn-twitter btn-round btn-lg" rel="tooltip" title="Follow us">
                <i class="fab fa-twitter"></i>
              </a>
              <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-neutral btn-icon btn-facebook btn-round btn-lg" rel="tooltip" title="Like us">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a target="_blank" href="https://www.linkedin.com/company-beta/9430489/" class="btn btn-neutral btn-icon btn-linkedin btn-lg btn-round" rel="tooltip" title="Follow us">
                <i class="fab fa-linkedin"></i>
              </a>
              <a target="_blank" href="https://github.com/creativetimofficial/now-ui-kit" class="btn btn-neutral btn-icon btn-github btn-round btn-lg" rel="tooltip" title="Star on Github">
                <i class="fab fa-github"></i>
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

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

     <title>Jam - Contact</title>

     <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
     <!-- Les CSS utilisés -->
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
     <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />

     <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
     <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
   </head>

   <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
   <!-- Add mousewheel plugin (this is optional) -->
   <script type="text/javascript" src="includes/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
   <!-- Add fancyBox -->
   <link rel="stylesheet" href="includes/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
   <script type="text/javascript" src="includes/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
   <!-- Optionally add helpers - button, thumbnail and/or media -->
   <link rel="stylesheet" href="includes/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
   <script type="text/javascript" src="includes/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
   <script type="text/javascript" src="includes/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

   <link rel="stylesheet" href="includes/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
   <script type="text/javascript" src="includes/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

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
             <h1 class="title">Présentation de l'Association</h1>
           </div>
         </div>
       </div>

       <div class="container">
         <div class="row">
           <div class="col-md-6 ml-auto mr-auto">
             <h4 class="title text-center">My Portfolio</h4>
             <div class="nav-align-center">
               <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
                 <li class="nav-item">
                   <a class="nav-link" data-toggle="tab" href="#profile" role="tablist">
                     <i class="now-ui-icons design_image"></i>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" data-toggle="tab" href="#home" role="tablist">
                     <i class="now-ui-icons location_world"></i>
                   </a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link" data-toggle="tab" href="#messages" role="tablist">
                     <i class="now-ui-icons sport_user-run"></i>
                   </a>
                 </li>
               </ul>
             </div>
           </div>
           <!-- Tab panes -->
           <div class="tab-content gallery">
             <div class="tab-pane active" id="home" role="tabpanel">
               <div class="col-md-16 ml-auto mr-auto">
                 <div class="row collections">
                   <div class="col-md-4">
                     <img src="assets/img/bg1.jpg" alt="" class="img-raised">
                     <img src="assets/img/bg3.jpg" alt="" class="img-raised">
                   </div>
                   <div class="col-md-4">
                     <img src="assets/img/bg8.jpg" alt="" class="img-raised">
                     <img src="assets/img/bg7.jpg" alt="" class="img-raised">
                   </div>
                   <div class="col-md-4">
                     <img src="assets/img/bg8.jpg" alt="" class="img-raised">
                     <img src="assets/img/bg7.jpg" alt="" class="img-raised">
                   </div>
                 </div>
               </div>
             </div>
             <div class="tab-pane" id="profile" role="tabpanel">
               <div class="col-md-10 ml-auto mr-auto">
                 <div class="row collections">
                   <div class="col-md-6">
                     <img src="assets/img/bg6.jpg" class="img-raised">
                     <img src="assets/img/bg11.jpg" alt="" class="img-raised">
                   </div>
                   <div class="col-md-6">
                     <img src="assets/img/bg7.jpg" alt="" class="img-raised">
                     <img src="assets/img/bg8.jpg" alt="" class="img-raised">
                   </div>
                 </div>
               </div>
             </div>
             <div class="tab-pane" id="messages" role="tabpanel">
               <div class="col-md-10 ml-auto mr-auto">
                 <div class="row collections">
                   <div class="col-md-6">
                     <img src="assets/img/bg3.jpg" alt="" class="img-raised">
                     <img src="assets/img/bg8.jpg" alt="" class="img-raised">
                   </div>
                   <div class="col-md-6">
                     <img src="assets/img/bg7.jpg" alt="" class="img-raised">
                     <img src="assets/img/bg6.jpg" class="img-raised">
                   </div>
                 </div>
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

<?php
    require_once('includes/connectBDD.php');
    $nompage = "Galerie";
    require_once('includes/head.php');
?>

   <body class="profile-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>

     <div class="wrapper">
       <div class="page-header page-header-small">
         <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/bg1.jpg');">
         </div>
         <div class="content-center">
           <div class="container">
             <h1 class="title">Galerie Photo</h1>
           </div>
         </div>
       </div>

       <div class="section">
         <div class="container">
           <div class="button-container">
             <a href="#button" class="btn btn-primary btn-round btn-lg">Follow</a>
             <a href="#button" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Follow me on Twitter">
               <i class="fab fa-twitter"></i>
             </a>
             <a href="#button" class="btn btn-default btn-round btn-lg btn-icon" rel="tooltip" title="Follow me on Instagram">
               <i class="fab fa-instagram"></i>
             </a>
           </div>
           <h3 class="title">About me</h3>
           <h5 class="description">An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</h5>
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
                       <img src="../assets/img/bg1.jpg" alt="" class="img-raised">
                       <img src="../assets/img/bg3.jpg" alt="" class="img-raised">
                     </div>
                     <div class="col-md-4">
                       <img src="../assets/img/bg8.jpg" alt="" class="img-raised">
                       <img src="../assets/img/bg7.jpg" alt="" class="img-raised">
                     </div>
                     <div class="col-md-4">
                       <img src="../assets/img/bg8.jpg" alt="" class="img-raised">
                       <img src="../assets/img/bg7.jpg" alt="" class="img-raised">
                     </div>
                   </div>
                 </div>
               </div>
               <div class="tab-pane" id="profile" role="tabpanel">
                 <div class="col-md-10 ml-auto mr-auto">
                   <div class="row collections">
                     <div class="col-md-6">
                       <img src="../assets/img/bg6.jpg" class="img-raised">
                       <img src="../assets/img/bg11.jpg" alt="" class="img-raised">
                     </div>
                     <div class="col-md-6">
                       <img src="../assets/img/bg7.jpg" alt="" class="img-raised">
                       <img src="../assets/img/bg8.jpg" alt="" class="img-raised">
                     </div>
                   </div>
                 </div>
               </div>
               <div class="tab-pane" id="messages" role="tabpanel">
                 <div class="col-md-10 ml-auto mr-auto">
                   <div class="row collections">
                     <div class="col-md-6">
                       <img src="../assets/img/bg3.jpg" alt="" class="img-raised">
                       <img src="../assets/img/bg8.jpg" alt="" class="img-raised">
                     </div>
                     <div class="col-md-6">
                       <img src="../assets/img/bg7.jpg" alt="" class="img-raised">
                       <img src="../assets/img/bg6.jpg" class="img-raised">
                     </div>
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
?>

<!-- Tous les JSS sont nécessaires -->
 <!-- Add jQuery library -->
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

<?php
    require_once('includes/javascript.php');
?>

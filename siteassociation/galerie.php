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
                 </ul>
               </div>
             </div>
             <!-- Tab panes -->
             <div class="tab-content gallery">
               <div class="tab-pane active" id="home" role="tabpanel">
                 <div class="col-md-16 ml-auto mr-auto">
                   <div class="row collections">
                   <?php
                   $image = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");
                   while($uneimage = $image->fetch(PDO::FETCH_OBJ)){
                   ?>
                     <div class="col-md-4">
                       <a class="fancybox-thumb" rel="fancybox-thumb" href="assets/images/<?php echo $uneimage->file_name;?>" title="<?php echo $uneimage->title;?>">
                       <img class="img-raised" src="assets/images/thumb/<?php echo $uneimage->file_name;?>" alt="<?php echo $uneimage->title;?>" /></a>
                     </div>
                  <?php } ?>

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

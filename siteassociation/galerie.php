<?php
    require_once('includes/connectBDD.php');
    $nompage = "Galerie";
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
<meta http-equiv="cache-control" content="no-cache" />
<body class="profile-page sidebar-collapse">


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

         <div class="container">
           <div class="row">
             <div class="col-md-auto ml-auto mr-auto">
               <h2 class="title text-center"><?php echo $pagehead->titre; ?></h2>
               <div class="nav-align-center">
                 <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
                   <?php
                   $albums = $db->query("SELECT DISTINCT title, icon, albumactif FROM images WHERE status = 1");
                   while($unalbum = $albums->fetch(PDO::FETCH_OBJ)){
                     ?>
                   <li class="nav-item">
                     <?php
                     if($unalbum->albumactif == 1){
                     ?>
                     <a class="nav-link active" data-toggle="tab" href="#<?php echo $unalbum->title;?>" role="tablist">
                     <?php
                     }else{
                     ?>
                     <a class="nav-link" data-toggle="tab" href="#<?php echo $unalbum->title;?>" role="tablist">
                     <?php } ?>
                       <i class="now-ui-icons <?php echo $unalbum->icon;?>"></i>
                     </a>
                   </li>
                 <?php } ?>
                 </ul>
               </div>
             </div>
           </div>
             <!-- Tab panes -->
             <div class="tab-content gallery">
               <?php
               $folio = $db->query("SELECT DISTINCT title, albumactif FROM images WHERE status = 1");
               while($unfolio = $folio->fetch(PDO::FETCH_OBJ)){
                 $title = $unfolio->title;
                 if($unfolio->albumactif == 1){
                 ?>
               <div class="tab-pane active" id="<?php echo $unfolio->title;?>" role="tabpanel">
                 <?php
                 }else{
                 ?>
                 <div class="tab-pane" id="<?php echo $unfolio->title;?>" role="tabpanel">
                 <?php } ?>
                 <h3 class="title">Les images</h3>
                 <div class="col-md-16 ml-auto mr-auto">
                   <div class="row collections">
                   <?php
                   $image = $db->prepare("SELECT * FROM images WHERE title=:title and status=:status and file_name <> :file_name ORDER BY uploaded_on DESC");
                   $image->execute(array(
                     "title"=>$title,
                     "status"=>"1",
                     "file_name"=>""
                   ));
                   while($uneimage = $image->fetch(PDO::FETCH_OBJ)){

                    $nomfile = $uneimage->file_name;
                    $rest2 = explode('.', $nomfile);
                    $rest = $rest2[0];
                   ?>
                     <div class="col-md-4">
                       <center>
                         <a class="fancybox-thumb" rel="fancybox-thumb" href="JamFichiers/Photos/Original/<?php echo $uneimage->title;?>/<?php echo $uneimage->file_name;?>" title="<?php echo $rest;?>">
                         <img class="img-raised image-thumb" src="JamFichiers/Photos/Original/<?php echo $uneimage->title;?>/<?php echo $uneimage->file_name;?>" alt="<?php echo $rest;?>" /></a>
                       </center>
                     </div>
                  <?php } ?>

                </div>
              </div>
              <style>
              .image-thumb {
                height: 170px;
                width: 250px;
              }
              </style>
              <h3 class="title">Les Vidéos</h3>
              <div class="col-md-16 ml-auto mr-auto">
                <div class="row collections">

              <?php
                   $video0 = $db->prepare("SELECT * FROM videos WHERE title=:title and status=:status and file_namevideo <> ''");
                   $video0->execute(array(
                     "title"=>$title,
                     "status"=>"1"
                   ));
                   while($unevideo0 = $video0->fetch(PDO::FETCH_OBJ)){
                   ?>
                   <div class="col-md-4">
                     <center>
                       <a class="various fancybox.iframe" href="<?php echo $unevideo0->file_namevideo;?>">
                       <img class="img-raised image-thumb" src="JamFichiers/Photos/Original/<?php echo $unevideo0->title;?>/<?php echo $unevideo0->file_nameimage;?>" alt="" /></a>
                     </center>
                   </div>
                 <?php } ?>
                   </div>
                 </div>
               </div>
             <?php } ?>

             <script>
             $(document).ready(function() {
              $(".fancybox-thumb").fancybox({
                prevEffect	: 'none',
                nextEffect	: 'none',
                 helpers	: {
                  title	: {
                    type: 'outside'
                  },
                  thumbs	: {
                    width	: 50,
                    height	: 50
                  }
                }
              });
             });
             </script>


             <!-- AJAX vidéos -->
             <script>
             $(document).ready(function() {
              $(".various").fancybox({
                maxWidth	: 800,
                maxHeight	: 600,
                fitToView	: false,
                width		: '70%',
                height		: '70%',
                autoSize	: false,
                closeClick	: false,
                openEffect	: 'none',
                closeEffect	: 'none'
              });
             });
             </script>

             </div>
           </div>
         </div>


<?php
    require_once('includes/footer.php');
?>

<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    // the body of this function is in assets/js/now-ui-kit.js
    nowuiKit.initSliders();
  });

  function scrollToDownload() {

    if ($('.section-download').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-download').offset().top
      }, 1000);
    }
  }
</script>

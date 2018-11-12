<?php
    require_once('includes/connectBDD.php');
    $nompage = "Galerie";
    require_once('includes/head.php');
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
               <h3 class="title text-center">Mon Album Photos</h3>
               <div class="nav-align-center">
                 <ul class="nav nav-pills nav-pills-primary nav-pills-just-icons" role="tablist">
                   <?php
                   $albums = $db->query("SELECT DISTINCT title, icon FROM images WHERE status = 1");
                   while($unalbum = $albums->fetch(PDO::FETCH_OBJ)){
                     ?>
                   <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#<?php echo $unalbum->title;?>" role="tablist">
                       <i class="now-ui-icons <?php echo $unalbum->icon;?>"></i>
                     </a>
                   </li>
                 <?php } ?>
                 </ul>
               </div>
             </div>
             <!-- Tab panes -->
             <div class="tab-content gallery">
               <?php
               $albums = $db->query("SELECT DISTINCT title FROM images WHERE status = 1");
               while($unalbum = $albums->fetch(PDO::FETCH_OBJ)){
                 ?>
               <div class="tab-pane active" id="<?php echo $unalbum->title;?>" role="tabpanel">
                 <h3 class="title">Les images</h3>
                 <div class="col-md-16 ml-auto mr-auto">
                   <div class="row collections">
                   <?php
                   $image = $db->query("SELECT * FROM images WHERE status = 1, title = '<?php echo $unalbum->title;?>' ORDER BY uploaded_on DESC");
                   while($uneimage = $image->fetch(PDO::FETCH_OBJ)){
                   ?>
                     <div class="col-md-4">
                       <center>
                         <a class="fancybox-thumb" rel="fancybox-thumb" href="assets/images/<?php echo $uneimage->file_name;?>" title="<?php echo $uneimage->title;?>">
                         <img class="img-raised" src="assets/images/thumb/<?php echo $uneimage->file_name;?>" alt="<?php echo $uneimage->title;?>" /></a>
                       </center>
                     </div>
                  <?php } ?>

                </div>
              </div>
              <h3 class="title">Les Vidéos</h3>
              <div class="col-md-16 ml-auto mr-auto">
                <div class="row collections">

              <?php
                   $video = $db->query("SELECT * FROM videos WHERE status = 1, title = '<?php echo $unalbum->title;?>' ORDER BY uploaded_on DESC");
                   while($unevideo = $video->fetch(PDO::FETCH_OBJ)){
                   ?>
                   <div class="col-md-4">
                     <center>
                       <a class="various fancybox.iframe" href="<?php echo $unevideo->file_namevideo;?>">
                       <img class="img-raised" src="assets/videos/thumb/<?php echo $unevideo->file_nameimage;?>" alt="" /></a>
                     </center>
                   </div>
                 <?php } ?>
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
             </div>
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

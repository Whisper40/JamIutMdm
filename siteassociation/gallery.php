<?php
require_once('includes/head.php');
require_once('includes/header.php');
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

<!-- Code pour les images -->
<h1> Les images </h1>
<?php

 $image = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");
 while($uneimage = $image->fetch(PDO::FETCH_OBJ)){
   ?>
 <a class="fancybox-thumb" rel="fancybox-thumb" href="assets/images/<?php echo $uneimage->file_name;?>" title="<?php echo $uneimage->title;?>">
 	<img src="assets/images/thumb/<?php echo $uneimage->file_name;?>" alt="<?php echo $uneimage->title;?>" /></a>
<?php } ?>

<!-- Code pour les vidéos -->
<h1> Les vidéos </h1>
<?php
 $video = $db->query("SELECT * FROM videos WHERE status = 1 ORDER BY uploaded_on DESC");
 while($unevideo = $video->fetch(PDO::FETCH_OBJ)){
   ?>
		<a class="various fancybox.iframe" href="<?php echo $unevideo->file_namevideo;?>"><img src="assets/videos/thumb/<?php echo $unevideo->file_nameimage;?>" alt="" /></a>

<?php } ?>
<!-- AJAX pour images -->
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

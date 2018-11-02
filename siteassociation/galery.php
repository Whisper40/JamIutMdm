<?php
require_once('includes/head.php');
require_once('includes/header.php');
 ?>


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
 $souscat = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");
 while($unesouscat = $souscat->fetch(PDO::FETCH_OBJ)){
   ?>

 <a class="fancybox-thumb" rel="fancybox-thumb" href="assets/images/<?php echo $unesouscat->file_name;?>" title="Golden Manarola (Sanjeev Deo)">
 	<img src="assets/images/thumb/<?php echo $unesouscat->file_name;?>" alt="" />
 </a>

<?php } ?>




 <a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm6.staticflickr.com/5444/17679973232_568353a624_b.jpg" title="Golden Manarola (Sanjeev Deo)">
 	<img src="http://farm6.staticflickr.com/5444/17679973232_568353a624_m.jpg" alt="" />
 </a>
 <a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_b.jpg" title="Codirosso spazzacamino (Massimo Greco _Foligno)">
 	<img src="http://farm8.staticflickr.com/7367/16426879675_e32ac817a8_m.jpg" alt="" />
 </a>


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

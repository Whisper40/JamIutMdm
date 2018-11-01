<?php
require_once('includes/head.php');
require_once('includes/header.php');
 ?>


 <!-- Add jQuery library -->
 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

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

 <a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm6.staticflickr.com/5444/17679973232_568353a624_b.jpg" title="Golden Manarola (Sanjeev Deo)">
 	<img src="http://farm6.staticflickr.com/5444/17679973232_568353a624_m.jpg" alt="" />
 </a>
 <a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm6.staticflickr.com/5444/17679973232_568353a624_b.jpg" title="Golden Manarola (Sanjeev Deo)">
 	<img src="http://farm6.staticflickr.com/5444/17679973232_568353a624_m.jpg" alt="" />
 </a>


<?php
$images = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");
while($uneimage = $images->fetch(PDO::FETCH_OBJ)){
$a = echo $unesouscat->page;
$b = echo $unesouscat->page;
            $imageURL = 'assets/images/'.$a;
            $imageThumbURL = 'assets/images/thumb/'.$b;
            echo $imageURL;

    ?>

        <a class="fancybox-thumb" rel="fancybox-thumb" href="<?php echo $imageURL; ?>" title="<?php echo $uneimage->title; ?>">
        	<img src="<?php echo $imageThumbURL; ?>" alt="" />
        </a>


    <?php }
    } ?>


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

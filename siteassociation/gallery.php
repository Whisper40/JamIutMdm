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
 $image = $db->query("SELECT * FROM images WHERE status = 1 ORDER BY uploaded_on DESC");
 while($uneimage = $image->fetch(PDO::FETCH_OBJ)){
   ?>
 <a class="fancybox-thumb" rel="fancybox-thumb" href="assets/images/<?php echo $uneimage->file_name;?>" title="<?php echo $uneimage->title;?>">
 	<img src="assets/images/thumb/<?php echo $uneimage->file_name;?>" alt="<?php echo $uneimage->title;?>" />
 </a>
<?php } ?>


<div id="video">
  <a href="https://www.youtube.com/watch?v=npG_UUUnwjI&list=UU_aEa8K-EOJ3D6gOs7HcyNg&index=40"><img src="assets/images/thumb/bg1.jpg" alt="" /></a>
</div>

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

<script type="text/javascript">
        $(function () {
            $('#video a').fancybox({
                width: 640,
                height: 400,
                type: 'iframe'
            });
        });
    </script>

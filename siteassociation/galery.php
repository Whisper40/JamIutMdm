<?php
require_once('includes/head.php');
require_once('includes/header.php');
 ?>



<!-- Fancybox CSS library -->
<link rel="stylesheet" type="text/css" href="includes/fancybox/jquery.fancybox.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Fancybox JS library -->
<script src="includes/fancybox/jquery.fancybox.js"></script>

<a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm9.staticflickr.com/8507/8454547519_f8116520e1_b.jpg" title="Ayvalık, Turkey (Nejdet Düzen)">
	<img src="http://farm9.staticflickr.com/8507/8454547519_f8116520e1_m.jpg" alt="" />
</a>
<a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm8.staticflickr.com/7152/6394238505_c94fdd1d89_b.jpg" title="Sicilian Scratches   erice (italianoadoravel on/off coming back)">
	<img src="http://farm8.staticflickr.com/7152/6394238505_c94fdd1d89_m.jpg" alt="" />
</a>
<a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm9.staticflickr.com/8481/8215602321_69d9939b8b_b.jpg" title="The Trail (Msjunior-Check out my galleries)">
	<img src="http://farm9.staticflickr.com/8481/8215602321_69d9939b8b_m.jpg" alt="" />
</a>
<a class="fancybox-thumb" rel="fancybox-thumb" href="http://farm9.staticflickr.com/8200/8220393833_e52cabfe80_b.jpg" title="Trees (Joerg Marx)">
	<img src="http://farm9.staticflickr.com/8200/8220393833_e52cabfe80_m.jpg" alt="" />
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

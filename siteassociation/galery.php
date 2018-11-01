<?php
require_once('includes/head.php');
require_once('includes/header.php');
 ?>



 <!-- Add jQuery library -->
 <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

 <!-- Add mousewheel plugin (this is optional) -->
 <script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

 <!-- Add fancyBox -->
 <link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
 <script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>

 <!-- Optionally add helpers - button, thumbnail and/or media -->
 <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
 <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
 <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

 <link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
 <script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>



 <a class="fancybox-button" rel="fancybox-button" href="http://farm4.staticflickr.com/3826/18875570170_e20cf27a4d_b.jpg" title="Colorful Feldberg II (STEFFEN EGLY)">
 	<img src="http://farm4.staticflickr.com/3826/18875570170_e20cf27a4d_m.jpg" alt="" />
 </a>
 <a class="fancybox-button" rel="fancybox-button" href="http://farm1.staticflickr.com/471/19102574835_d5a7837217_b.jpg" title="Cannon Needles (JustinPoe)">
 	<img src="http://farm1.staticflickr.com/471/19102574835_d5a7837217_m.jpg" alt="" />
 </a>
 <a class="fancybox-button" rel="fancybox-button" href="http://farm1.staticflickr.com/288/19353466834_6be3600330_b.jpg" title="Making a summer # 3 :) ((Nikon woman))">
 	<img src="http://farm1.staticflickr.com/288/19353466834_6be3600330_m.jpg" alt="" />
 </a>
 <a class="fancybox-button" rel="fancybox-button" href="http://farm1.staticflickr.com/313/19831416459_5ddd26103e_b.jpg" title="Sgwd Ddwli Uchaf, Brecon Waterfalls (technodean2000)">
 	<img src="http://farm1.staticflickr.com/313/19831416459_5ddd26103e_m.jpg" alt="" />
 </a>


<script>
$(document).ready(function() {
	$(".fancybox-button").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: false,
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
});
</script>

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




<ul class="list">
	<li><a class="fancybox-media" href="http://www.youtube.com/watch?v=opj24KnzrWo">Youtube</a></li>
	<li><a class="fancybox-media" href="http://vimeo.com/36031564">Vimeo</a></li>
	<li><a class="fancybox-media" href="http://www.metacafe.com/watch/7635964/">Metacafe</a></li>
	<li><a class="fancybox-media" href="http://www.dailymotion.com/video/xoeylt_electric-guest-this-head-i-hold_music">Dailymotion</a></li>
	<li><a class="fancybox-media" href="http://twitvid.com/QY7MD">Twitvid</a></li>
	<li><a class="fancybox-media" href="http://twitpic.com/7p93st">Twitpic</a></li>
	<li><a class="fancybox-media" href="http://instagr.am/p/IejkuUGxQn">Instagram</a></li>
	<li>
		Google maps
		<ul>
			<li><a class="fancybox-media" href="http://maps.google.com/maps?q=Eiffel+Tower,+Avenue+Gustave+Eiffel,+Paris,+France&t=h&z=17">Search results</a></li>
			<li><a class="fancybox-media" href="http://maps.google.com/?ll=48.85796,2.295231&spn=0.003833,0.010568&t=h&z=17">Direct link</a></li>
			<li><a class="fancybox-media" href="http://maps.google.com/?ll=48.859463,2.292626&spn=0.000965,0.002642&t=m&z=19&layer=c&cbll=48.859524,2.292532&panoid=YJ0lq28OOy3VT2IqIuVY0g&cbp=12,151.58,,0,-15.56">Street view</a></li>
		</ul>
	</li>
</ul>
<script>
$(document).ready(function() {
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
});
</script>

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


<ul class="list">
	<li>
		<a class="various fancybox.ajax" href="/demo/ajax.php">Ajax</a>
	</li>
	<li>
		<a class="various" data-fancybox-type="iframe" href="/demo/iframe.html">Iframe</a>
	</li>
	<li>
		<a class="various" href="#inline">Inline</a>
	</li>
	<li>
		<a class="various" href="http://www.adobe.com/jp/events/cs3_web_edition_tour/swfs/perform.swf">SWF</a>
	</li>
</ul>

<ul class="list">
	<li>
		<a class="various fancybox.iframe" href="http://www.youtube.com/embed/L9szn1QQfas?autoplay=1">Youtube (iframe)</a>
	</li>
	<li>
		<a class="various fancybox.iframe" href="http://maps.google.com/?output=embed&f=q&source=s_q&hl=en&geocode=&q=London+Eye,+County+Hall,+Westminster+Bridge+Road,+London,+United+Kingdom&hl=lv&ll=51.504155,-0.117749&spn=0.00571,0.016512&sll=56.879635,24.603189&sspn=10.280244,33.815918&vpsrc=6&hq=London+Eye&radius=15000&t=h&z=17">Google maps (iframe)</a>
	</li>
	<li>
		<a class="various" href="/data/non_existing_image.jpg">Non-existing url</a>
	</li>
</ul>
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

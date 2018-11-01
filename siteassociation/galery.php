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

 <a id="iframe" href="http://www.google.com/">Lien vers une iframe</a>
<script>
$(document).ready(function() {
    $("#iframe").fancybox({
        'width'             : '75%',
        'height'            : '75%',
        'autoScale'         : false,
        'transitionIn'      : 'elastic',
        'transitionOut'     : 'elastic',
        'type'              : 'iframe'
    });
});
</script>

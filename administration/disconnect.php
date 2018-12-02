<?php
session_start();
session_unset();
session_destroy();

header('Location: https://administration.jam-mdm.fr/connect.php');

?>

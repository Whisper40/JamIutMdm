<?php
ini_set("session.cookie_domain", ".jam-mdm.fr");
session_start();

try{

	$db = new PDO('mysql:host=127.0.0.1;dbname=siteassociation', 'admin','ENTRERVOTREMDP');
	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
	$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
	$db->exec('SET NAMES utf8');
}

catch(Exception $e){

	die('Veuillez vérifier la connexion à la base de données');

}

?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124061805-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-124061805-1');
</script>


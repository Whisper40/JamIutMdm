<?php
ini_set("session.cookie_domain", ".jam-mdm.fr");
session_start();

try{
d
	$db = new PDO('mysql:host=127.0.0.1;dbname=siteassociation', 'admin','ENTRERVOTREMDP');
	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
	$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
	$db->exec('SET NAMES utf8');
}

catch(Exception $e){

	die('Veuillez vérifier la connexion à la base de données');

}

$temps_session = 30;
$temps_actuel = date("U");

// START - Récupération de l'ip de connexion de l'utilisateur, même à travers de proxy !
function get_ip() {
// IP si internet partagé
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
	return $_SERVER['HTTP_CLIENT_IP'];
}
// IP derrière un proxy
elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	return $_SERVER['HTTP_X_FORWARDED_FOR'];
}
// Sinon : IP normale
else {
	return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
}
}
// Fin - Récupération IP
$ip = get_ip();
$req_ip_exist = $db->prepare('SELECT * FROM visiteurs WHERE ip = ?');
$req_ip_exist->execute(array($ip));
$ip_existe = $req_ip_exist->rowCount();

if($ip_existe == 0){
  $add_ip = $db->prepare('INSERT INTO visiteurs (ip,time) VALUES (?,?)');
  $add_ip->execute(array($ip,$temps_actuel));
}
else{
  $update_ip = $db->prepare('UPDATE visiteurs SET time = ? WHERE ip = ?');
  $update_ip->execute(array($temps_actuel,$ip));
}

$session_delete_time = $temps_actuel - $temps_session;
$del_ip = $db->prepare('DELETE FROM visiteurs WHERE time < ?');
$del_ip->execute(array($session_delete_time));

$show_user_nbr = $db->query('SELECT * FROM visiteurs');
$user_nbr = $show_user_nbr->rowCount();


?>

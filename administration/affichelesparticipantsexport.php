<?php

require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date = strftime('%d:%m:%y %H:%M:%S');
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=Customers_Export.csv');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

$id = $_GET['id'];
$slug = 'voyage-ski-2018';
$title = 'Séjour Ski Cauteret';



$tableau = array();


// Création de la ligne d'en-tête




$selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
$selectid->execute(array(
  "name"=>$title
));
$nbr = $selectid->rowCount();

while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
  $iddelapersonne=$s0->user_id;

  $selectnom = $db->prepare("SELECT username FROM users WHERE id=:id");
  $selectnom->execute(array(
    "id"=>$iddelapersonne
  ));
  $snom=$selectnom->fetch(PDO::FETCH_OBJ);
  $nom=$snom->username;

  $selectinfos = $db->prepare("SELECT * FROM participe WHERE user_id=:id and activity_name=:name");
  $selectinfos->execute(array(
    "id"=>$iddelapersonne,
    "name"=>$slug
  ));

  while($s1=$selectinfos->fetch(PDO::FETCH_OBJ)){

    $optionmateriel=$s1->optionmateriel;
    $optionrepas=$s1->optionrepas;


    $selectinfospersonnelles = $db->prepare("SELECT * FROM formulaireski WHERE user_id=:id");
    $selectinfospersonnelles->execute(array(
      "id"=>$iddelapersonne
    ));

    while($s2=$selectinfospersonnelles->fetch(PDO::FETCH_OBJ)){
      $poids=$s2->poids;
      $taille=$s2->taille;
      $pointure=$s2->pointure;
      $allergie=$s2->allergie;
      $adresse=$s2->adresse;
      $codepostal=$s2->codepostal;
      $ville=$s2->ville;
      $telurgence=$s2->telurgence;



      $tableau[] = array($nom,$poids,$taille,$pointure,$allergie,$adresse,$codepostal,$ville,$telurgence);




    }
  }
}

$entete = array("Nom", "Poids", "Taille", "Pointure", "Allergie", "Adresse", "Code Postale", "Ville", "Teléphone Urgence");
$separateur = ";";
// Affichage de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete)."\r\n";

// Affichage du contenu du tableau
foreach ($tableau as $ligne) {
  echo implode($separateur, $ligne)."\r\n";
}

?>

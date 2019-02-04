<?php
//PAS DE CODE HTML
//PAS DE CODE HTML
//PAS DE CODE HTML
//PAS DE CODE HTML
//PAS DE CODE HTML
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');


$id = $_GET['id'];
$slug = $_GET['slug'];
$title = $_GET['title'];


if (stripos($title, 'ski') != FALSE){

header('Content-Type: text/csv; charset=utf-8');
header("Content-disposition: filename=Tableau-Ski-$date.csv");

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date = strftime('%d:%m:%y %H:%M:%S');

$tableau = array();






$selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
$selectid->execute(array(
  "name"=>$title
));
$nbr = $selectid->rowCount();

while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
  $iddelapersonne=$s0->user_id;

  $selectnom = $db->prepare("SELECT username, prenom, email FROM users WHERE id=:id");
  $selectnom->execute(array(
    "id"=>$iddelapersonne
  ));
  $snom=$selectnom->fetch(PDO::FETCH_OBJ);
  $nom=$snom->username;
  $email=$snom->email;
  $prenom=$snom->prenom;

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
      $tel=$s2->tel;
      $telurgence=$s2->telurgence;
      $regroupement = $codepostal.' '.$ville;

      $tableau[] = array($nom,$prenom,$email,$poids,$taille,$pointure,$allergie,$adresse,$regroupement,$tel,$telurgence,$optionmateriel,$optionrepas);


    }
  }
}


$entete = array("Nom", "Prenom", "Email", "Poids", "Taille", "Pointure", "Allergie", "Adresse", "CP", "Telephone", "Telephone Urgence", "Option Materiel", "Option Repas");


$separateur = ";";
// Affichage de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete)."\r\n";

// Affichage du contenu du tableau
foreach ($tableau as $ligne) {
  echo implode($separateur, $ligne)."\r\n";
}


}else if (stripos($title, 'rugby') != FALSE){








  header('Content-Type: text/csv; charset=utf-8');
  header("Content-disposition: filename=Tableau-Rugby-$date.csv");

  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $tableau = array();



  $selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
  $selectid->execute(array(
    "name"=>$title
  ));
  $nbr = $selectid->rowCount();

  while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
    $iddelapersonne=$s0->user_id;

    $selectnom = $db->prepare("SELECT username, prenom, email FROM users WHERE id=:id");
    $selectnom->execute(array(
      "id"=>$iddelapersonne
    ));
    $snom=$selectnom->fetch(PDO::FETCH_OBJ);
    $nom=$snom->username;
    $email=$snom->email;
    $prenom=$snom->prenom;

    $selectinfos = $db->prepare("SELECT * FROM participe WHERE user_id=:id and activity_name=:name");
    $selectinfos->execute(array(
      "id"=>$iddelapersonne,
      "name"=>$slug
    ));

    while($s1=$selectinfos->fetch(PDO::FETCH_OBJ)){

        $optionaccompagnement2=$s1->optionaccompagnement;
        $optionaccompagnement = utf8_decode($optionaccompagnement2);


      $selectinfospersonnelles = $db->prepare("SELECT * FROM formulairerugby WHERE user_id=:id");
      $selectinfospersonnelles->execute(array(
        "id"=>$iddelapersonne
      ));

      while($s2=$selectinfospersonnelles->fetch(PDO::FETCH_OBJ)){
        $adresse=$s2->adresse;
        $codepostal=$s2->codepostal;
        $ville=$s2->ville;
        $tel=$s2->tel;
        $telurgence=$s2->telurgence;
        $regroupement = $codepostal.' '.$ville;

        $tableau[] = array($nom,$prenom,$email,$adresse,$regroupement,$tel,$telurgence,$optionaccompagnement);


      }
    }
  }


  $entete = array("Nom", "Prenom", "Email", "Adresse", "CP", "Telephone", "Telephone Urgence", "Option Accompagnement");


  $separateur = ";";
  // Affichage de la ligne de titre, terminée par un retour chariot
  echo implode($separateur, $entete)."\r\n";

  // Affichage du contenu du tableau
  foreach ($tableau as $ligne) {
    echo implode($separateur, $ligne)."\r\n";
  }










}else if (stripos($title, 'cinema') != FALSE){





    header('Content-Type: text/csv; charset=utf-8');
    header("Content-disposition: filename=Tableau-Cinema-$date.csv");

    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d:%m:%y %H:%M:%S');

    $tableau = array();



    $selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
    $selectid->execute(array(
      "name"=>$title
    ));
    $nbr = $selectid->rowCount();

    while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
      $iddelapersonne=$s0->user_id;

      $selectnom = $db->prepare("SELECT username, prenom, email FROM users WHERE id=:id");
      $selectnom->execute(array(
        "id"=>$iddelapersonne
      ));
      $snom=$selectnom->fetch(PDO::FETCH_OBJ);
      $nom=$snom->username;
      $email=$snom->email;
      $prenom=$snom->prenom;



      $tableau[] = array($nom,$prenom,$email,$adresse);




    }


    $entete = array("Nom", "Prenom", "Email");


    $separateur = ";";
    // Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete)."\r\n";

    // Affichage du contenu du tableau
    foreach ($tableau as $ligne) {
      echo implode($separateur, $ligne)."\r\n";
    }





}

?>
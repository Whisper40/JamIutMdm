<?php

require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');


$id = $_GET['id'];
$slug = $_GET['slug'];
$title = $_GET['title'];
$typeactivite = $_GET['typeactivite'];
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date = strftime('%d:%m:%y %H:%M:%S');

function replaceAccents($str) {

$search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");

$replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");

return str_replace($search, $replace, $str);
}

$newtitle = replaceAccents($title);

//FIN

if ($typeactivite == "ski"){

header('Content-Type: text/csv; charset=utf-8');
header("Content-disposition: filename=Tableau-Ski-$date.csv");

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

  $selectinfos = $db->prepare("SELECT * FROM participe WHERE user_id=:id and typeactivite=:typeactivite");
  $selectinfos->execute(array(
    "id"=>$iddelapersonne,
    "typeactivite"=>$typeactivite
  ));

  while($s1=$selectinfos->fetch(PDO::FETCH_OBJ)){

    $optionmateriel=$s1->optionmateriel;
    $optionrepas=$s1->optionrepas;
    $optioncasque=$s1->optionadditionnelles;


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

      $tableau[] = array(replaceAccents($nom),replaceAccents($prenom),replaceAccents($email),replaceAccents($poids),replaceAccents($taille),replaceAccents($pointure),replaceAccents($allergie),replaceAccents($adresse),replaceAccents($regroupement),replaceAccents($tel),replaceAccents($telurgence),replaceAccents($optionmateriel),replaceAccents($optionrepas),replaceAccents($optioncasque));


    }
  }
}


$entete = array("Nom", "Prenom", "Email", "Poids", "Taille", "Pointure", "Allergie", "Adresse", "CP", "Telephone", "Telephone Urgence", "Option Materiel", "Option Repas", "Option Casque");


$separateur = ";";
// Affichage de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete)."\r\n";

// Affichage du contenu du tableau
foreach ($tableau as $ligne) {
  echo implode($separateur, $ligne)."\r\n";
}


}else if ($typeactivite == "rugby"){




  header('Content-Type: text/csv; charset=utf-8');
  header("Content-disposition: filename=Tableau-Rugby-$date.csv");



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

    $selectinfos = $db->prepare("SELECT * FROM participe WHERE user_id=:id and typeactivite=:typeactivite");
    $selectinfos->execute(array(
      "id"=>$iddelapersonne,
      "typeactivite"=>$typeactivite
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



}else if ($typeactivite == "cinema"){





    header('Content-Type: text/csv; charset=utf-8');
    header("Content-disposition: filename=Tableau-Cinema-$date.csv");



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



      $tableau[] = array($nom,$prenom,$email);




    }


    $entete = array("Nom", "Prenom", "Email");


    $separateur = ";";
    // Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete)."\r\n";

    // Affichage du contenu du tableau
    foreach ($tableau as $ligne) {
      echo implode($separateur, $ligne)."\r\n";
    }





}else if ($typeactivite == "sportive"){




    header('Content-Type: text/csv; charset=utf-8');
    header("Content-disposition: filename=Tableau-Sportive-$date.csv");




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



        $selectinfospersonnelles = $db->prepare("SELECT * FROM formulairesportive WHERE user_id=:id");
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

          $tableau[] = array($nom,$prenom,$email,$adresse,$regroupement,$tel,$telurgence);


        }

    }


    $entete = array("Nom", "Prenom", "Email", "Adresse", "CP", "Telephone", "Telephone Urgence");


    $separateur = ";";
    // Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete)."\r\n";

    // Affichage du contenu du tableau
    foreach ($tableau as $ligne) {
      echo implode($separateur, $ligne)."\r\n";
    }






}else if ($typeactivite == "nettoyage"){





    header('Content-Type: text/csv; charset=utf-8');
    header("Content-disposition: filename=Tableau-Nettoyage-$date.csv");




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



      $tableau[] = array($nom,$prenom,$email);




    }


    $entete = array("Nom", "Prenom", "Email");


    $separateur = ";";
    // Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete)."\r\n";

    // Affichage du contenu du tableau
    foreach ($tableau as $ligne) {
      echo implode($separateur, $ligne)."\r\n";
    }





}else if ($typeactivite == "orientation"){





    header('Content-Type: text/csv; charset=utf-8');
    header("Content-disposition: filename=Tableau-Orientation-$date.csv");



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



        $selectinfospersonnelles = $db->prepare("SELECT * FROM formulaireorientation WHERE user_id=:id");
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

          $tableau[] = array($nom,$prenom,$email,$adresse,$regroupement,$tel,$telurgence);


        }

    }


    $entete = array("Nom", "Prenom", "Email", "Adresse", "CP", "Telephone", "Telephone Urgence");


    $separateur = ";";
    // Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete)."\r\n";

    // Affichage du contenu du tableau
    foreach ($tableau as $ligne) {
      echo implode($separateur, $ligne)."\r\n";
    }






}else if ($typeactivite == "soireebar"){





    header('Content-Type: text/csv; charset=utf-8');
    header("Content-disposition: filename=Tableau-Soireebar-$date.csv");



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



        $selectinfospersonnelles = $db->prepare("SELECT * FROM formulairesoireebar WHERE user_id=:id");
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

          $tableau[] = array($nom,$prenom,$email,$adresse,$regroupement,$tel,$telurgence);


        }

    }


    $entete = array("Nom", "Prenom", "Email", "Adresse", "CP", "Telephone", "Telephone Urgence");


    $separateur = ";";
    // Affichage de la ligne de titre, terminée par un retour chariot
    echo implode($separateur, $entete)."\r\n";

    // Affichage du contenu du tableau
    foreach ($tableau as $ligne) {
      echo implode($separateur, $ligne)."\r\n";
    }






}

?>

<?php

require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Modification Contenu Site";
require_once('includes/head.php');


$id = $_GET['id'];
$slug = $_GET['slug'];
$title = 'Séjour Ski Cauteret';

$tableau = array();

header("Content-Type: text/csv; charset=UTF-8");
header("Content-disposition: filename=mon-tableau.csv");
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

      echo '

      <tr>
      <td class="text-center">'.$nom.'</td>
      <td class="text-center">'.$poids.'</td>
      <td class="text-center">'.$taille.'</td>
      <td class="text-center">'.$pointure.'</td>
      <td class="text-center">'.$allergie.'</td>
      <td class="text-center">'.$adresse.'</td>
      <td class="text-center">'.$codepostal.'</td>
      <td class="text-center">'.$ville.'</td>
      <td class="text-center">'.$telurgence.'</td>
      <td class="text-center">'.$optionmateriel.'</td>
      <td class="text-center">'.$optionrepas.'</td>
      </tr>';

      $tableau[] = array($nom.','.$poids);




    }
  }
}



$entete = array("Nom", "Id");
$separateur = ";";

// Affichage de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete)."\r\n";

// Affichage du contenu du tableau
foreach ($tableau as $ligne) {
  echo implode($separateur, $ligne)."\r\n";
}

?>

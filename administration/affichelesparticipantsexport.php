<?php
header("Content-Type: text/csv; charset=UTF-8");
header("Content-disposition: filename=mon-tableau.csv");
// Création de la ligne d'en-tête
$entete = array("Nom", "Prénom", "Age");

// Création du contenu du tableau
$lignes = array();
$lignes[] = array("Jean", "Martin", "20");
$lignes[] = array("Pierre", "Dupond", "30");

$separateur = ";";

// Affichage de la ligne de titre, terminée par un retour chariot
echo implode($separateur, $entete)."\r\n";

// Affichage du contenu du tableau
foreach ($lignes as $ligne) {
  echo implode($separateur, $ligne)."\r\n";
}
?>

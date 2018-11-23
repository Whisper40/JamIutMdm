<?php
require_once('includes/connectBDD.php');

if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

  $select = $db->query("SELECT * FROM users WHERE username LIKE '%$critere%' OR id LIKE '$critere' OR email LIKE '%$critere%'");
  $s = $select->fetch(PDO::FETCH_OBJ);
  $iduser = $s->id;

$requete=$db->prepare("SELECT * FROM validationfichiers WHERE user_id LIKE ?");
$requete->execute(array($iduser));
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." documents trouvés</h3>";
  foreach($table as $ligne){
    $user_id=$ligne->user_id;
    $nomfichier=$ligne->filename;
    $datefichier=$ligne->date;
    $statusfichier=$ligne->status;
    echo 'Le fichier '.$nomfichier.' soumis le '.$datefichier.' à pour status '.$statusfichier.'<hr>';
  }
}else echo"<p class='rouge'> Pas de résultats</p>";



}else echo"<p class='rouge'> Aucun critere de recherche n'a été fournis </p>";

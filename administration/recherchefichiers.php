<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

  $select = $db->query("SELECT * FROM users WHERE username LIKE '%$critere%' OR id LIKE '$critere' OR email LIKE '%$critere%'");
  $s = $select->fetch(PDO::FETCH_OBJ);
  $iduser = $s->id;

$requete=$db->prepare("SELECT * FROM validationfichiers WHERE user_id LIKE ?");
$requete->execute(array($iduser));
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  foreach($table as $ligne){
    $user_id=$ligne->user_id;
    $nomfichier=$ligne->filename;
    $datefichier=$ligne->date;
    $statusfichier=$ligne->status;
    echo 'Le fichier '.$nomfichier.' soumis le '.$datefichier.' à pour status '.$statusfichier.'<hr>';
  }
}else echo'<center>
            <h4 class="info-title"><font color="red">Aucun résultats à votre recherche</font></h4>
           </center>';



}else echo'<center>
            <h4 class="info-title"><font color="red">Aucun critere de recherche n\'a été fournis</font></h4>
           </center>';

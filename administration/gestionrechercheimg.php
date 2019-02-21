<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');

if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

  $select = $db->query("SELECT * FROM images WHERE id LIKE '$critere' OR file_name LIKE '%$critere%' and status='1'");
  $s = $select->fetch(PDO::FETCH_OBJ);
  $idimg = $s->id;

$requete=$db->prepare("SELECT * FROM images WHERE id LIKE ?");
$requete->execute(array($idimg));
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo '

  <div class="table-responsive">
    <table class="table">
        <thead class="text-primary">
            <th class="text-center">Identifiant</th>
            <th class="text-center">Nom</th>
            <th class="text-center">Album</th>
            <th class="text-center">Actif</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>
  ';

  foreach($table as $ligne){
    $idimg=$ligne->id;
    $file_name=$ligne->file_name;
    $album=$ligne->title;
    $actif=$ligne->albumactif;

    echo '

    <tr>
      <td class="text-center">'.$idimg.'</td>
      <td class="text-center">'.$file_name.'</td>
      <td class="text-center">'.$album.'</td>
      <td class="text-center">'.$actif.'</td>
      <td class="text-center"><a href="?action=ban&amp;id='.$idimg.'"><button type="button" class="btn btn-rose btn-round btn-sm">Désactiver</button></a>
                              <a href="?action=delete&amp;id='.$idimg.'"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a>
      </td>
    </tr>

    ';
  }

  echo '
    </tbody>
  </table>
</div>
  ';
  
}else echo'<center>
            <h4 class="info-title"><font color="red">Aucun résultats à votre recherche</font></h4>
           </center>';



}else echo'<center>
            <h4 class="info-title"><font color="red">Aucun critere de recherche n&apos;a été fournis</font></h4>
           </center>';

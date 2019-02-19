<?php
require_once('includes/connectBDD.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

$requete=$db->prepare("SELECT * FROM carousel WHERE image LIKE '%$critere%' and slug='Présentation association' OR titreimage LIKE '$critere%' and slug='Présentation association' OR titre LIKE '%$critere%' and slug='Présentation association' OR slug='Présentation association'");
$requete->execute();
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo '

  <div class="table-responsive">
    <table class="table">
        <thead class="text-primary">
            <th class="text-center">Identifiant</th>
            <th class="text-center">Nom</th>
            <th class="text-center">Action</th>
        </thead>
        <tbody>

  ';

  foreach($table as $ligne){
    $idimg=$ligne->id;
    $nom=$ligne->image;


    echo '

    <tr>
      <td class="text-center">'.$idimg.'</td>
      <td class="text-center">'.$nom.'</td>
      <td class="text-center"><a href="modifdespages.php?page=association&table=pageasso&action=delete&id='.$idimg.'"><button type="button" class="btn">Supprimer</button></a></td>
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

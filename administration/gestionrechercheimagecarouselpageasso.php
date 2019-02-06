<?php
require_once('includes/connectBDD.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

$requete=$db->prepare("SELECT * FROM carousel WHERE image LIKE '%$critere%' and slug='Présentation association' OR titreimage LIKE '$critere%' and slug='Présentation association' OR titre LIKE '%$critere%' and slug='Présentation association'");
$requete->execute();
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." images trouvées</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Nom</th>
  <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>

  ';
  foreach($table as $ligne){
    $idimg=$ligne->id;
    $nom=$ligne->image;


    echo '
    <tr>
      <th scope="row">'.$idimg.'</th>
      <td>'.$nom.'</td>
      <td>

  <a href="modifdespages.php?page=association&table=pageasso&action=delete&id='.$idimg.'">
  <button type="button" class="btn">Supprimer</button>
  </a>

      </td>
    </tr>

    ';


  }

  echo '
</tbody>
</table>


  ';
}else echo"<p class='rouge'> Pas de résultats</p>";



}else echo"<p class='rouge'> Aucun critere de recherche n'a été fournis </p>";

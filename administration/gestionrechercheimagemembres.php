<?php
require_once('includes/connectBDD.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

$requete=$db->prepare("SELECT * FROM membres WHERE image LIKE '%$critere%' OR nom LIKE '%$critere%' OR fonction LIKE '%$critere%'");
$requete->execute();
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." images trouvées</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Image</th>
  <th scope="col">Nom</th>
  <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>

  ';
  foreach($table as $ligne){
    $idimg=$ligne->id;
    $image=$ligne->image;
    $nom=$ligne->nom;


    echo '
    <tr>
      <th scope="row">'.$idimg.'</th>
      <td>'.$image.'</td>
      <td>'.$nom.'</td>
      <td>

  <a href="modifdespages.php?page=membre&table=membres&action=delete&id='.$idimg.'">
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

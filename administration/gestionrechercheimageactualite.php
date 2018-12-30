<?php
require_once('includes/connectBDD.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

$requete=$db->prepare("SELECT * FROM carousel WHERE image LIKE '%$critere%' OR titreimage LIKE '$critere%' OR titre LIKE '%$critere%'");
$requete->execute();
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." images trouvées</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Catégorie</th>
  <th scope="col">Nom</th>
  <th scope="col">Titre</th>
  <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>

  ';
  foreach($table as $ligne){
    $idimg=$ligne->id;
    $categorie=$ligne->titre;
    $nom=$ligne->image;
    $titreimage=$ligne->titreimage;

    echo '
    <tr>
      <th scope="row">'.$idimg.'</th>
      <td>'.$categorie.'<td>
      <td>'.$nom.'</td>
      <td>'.$titreimage.'</td>
      <td>

  <a href="action=delete&amp;id='.$idimg.'">
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

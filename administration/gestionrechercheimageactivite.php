<?php
require_once('includes/connectBDD.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];


  $select = $db->prepare("SELECT slug FROM activitesvoyages WHERE title LIKE '%$critere%'");
  $select->execute();
  $s = $select->fetch(PDO::FETCH_OBJ);
  $nomreel = $s->slug;



$requete=$db->prepare("SELECT * FROM carousel WHERE slug = '$nomreel'");
$requete->execute();
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." images trouvées</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Activité/Voyage</th>
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
    $slug=$ligne->slug;


    $select2 = $db->prepare("SELECT title FROM activitesvoyages WHERE slug=:slug");
    $select2->execute(array(
      "slug"=>$slug
    ));
    $s2 = $select2->fetch(PDO::FETCH_OBJ);
    $nomactvivoyage = $s2->title;

    $categorie=$ligne->titre;
    $nom=$ligne->image;
    $titreimage=$ligne->titreimage;

    echo '
    <tr>
      <th scope="row">'.$idimg.'</th>
      <th scope="row">'.$nomactvivoyage.'</th>
      <td>'.$categorie.'<td>
      <td>'.$nom.'</td>
      <td>'.$titreimage.'</td>
      <td>

  <a href="modifdespages.php?page=activitesvoyages&table=activitesvoyages&action=delete&id='.$idimg.'">
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

<?php
require_once('includes/connectBDD.php');

if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

  $select = $db->query("SELECT * FROM images WHERE title LIKE '%$critere%' OR id LIKE '$critere' OR file_name LIKE '%$critere%' and status='1'");
  $s = $select->fetch(PDO::FETCH_OBJ);
  $idimg = $s->id;

$requete=$db->prepare("SELECT * FROM images WHERE id LIKE ?");
$requete->execute(array($idimg));
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." documents trouvés</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Nom</th>
  <th scope="col">Album</th>
  <th scope="col">Actif</th>
  <th scope="col">Action</th>
  </tr>
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
      <th scope="row">'.$idimg.'</th>
      <td>'.$file_name.'<td>
      <td>'.$album.'</td>
      <td>'.$actif.'</td>
      <td>
  <a href="?action=ban&amp;id='.$idimg.'">
  <button type="button" class="btn">Désactiver</button>
  </a>
  <a href="?action=delete&amp;id='.$idimg.'">
  <button type="button" class="btn">Supprimer</button>
  </a>

      </td>
    </tr>
<hr>
    ';


  }

  echo '
</tbody>
</table>


  ';
}else echo"<p class='rouge'> Pas de résultats</p>";



}else echo"<p class='rouge'> Aucun critere de recherche n'a été fournis </p>";

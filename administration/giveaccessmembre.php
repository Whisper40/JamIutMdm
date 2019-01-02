<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');


if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

$requete=$db->prepare("SELECT * FROM users WHERE pseudo LIKE '%$critere%' OR email LIKE '%$critere%' OR id LIKE '$critere' and status <> 'MEMBRE'");
$requete->execute();
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." utilisateurs trouvées</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Nom</th>
  <th scope="col">Status</th>
  <th scope="col">Action</th>
  </tr>
  </thead>
  <tbody>

  ';
  foreach($table as $ligne){
    $id=$ligne->id;
    $nom=$ligne->pseudo;
    $status=$ligne->status;

    echo '
    <tr>
      <th scope="row">'.$id.'</th>
      <td>'.$nom.'</td>
      <td>'.$status.'</td>
      <td>

  <a href="createmembreexterne.php?action=giveaccessmembre&id='.$id.'">
  <button type="button" class="btn">Donner le rôle de membre</button>
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

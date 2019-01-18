<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');

if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

  $select = $db->query("SELECT * FROM newsactus WHERE title LIKE '%$critere%'");
  $table = $select->fetchAll(PDO::FETCH_OBJ);


if(count($table)>0){
  echo "<h3>".count($table)." documents trouvés</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Pseudo</th>
  <th scope="col">Dernière connexion</th>

  </tr>
  </thead>
  <tbody>

  ';
  foreach($table as $ligne){
    $title=$ligne->title;
    $title2=$ligne->title2;
    $title3=$ligne->title3;


    echo '
    <tr>
      <th scope="row">'.$title.'</th>
      <td>'.$title2.'<td>
      <td>'.$title3.'</td>


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

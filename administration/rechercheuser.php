<?php
require_once('includes/connectBDD.php');
ini_set('display_errors', 1);

if(isset($_GET['action']=='ban')){
echo'bond';
$id=$_GET['id'];
$setunban = $db->prepare("UPDATE users SET ban='0' WHERE id=$id");
$setunban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/banuser.php"</script>
<?php
}



if(isset($_GET['critere'])){
  $critere=$_GET['critere'];

  $select = $db->query("SELECT * FROM users WHERE username LIKE '%$critere%' OR id LIKE '$critere' OR email LIKE '%$critere%'");
  $s = $select->fetch(PDO::FETCH_OBJ);
  $iduser = $s->id;

$requete=$db->prepare("SELECT * FROM users WHERE id LIKE ?");
$requete->execute(array($iduser));
$table=$requete->fetchAll(PDO::FETCH_OBJ);

if(count($table)>0){
  echo "<h3>".count($table)." documents trouvés</h3>";
  echo '
  <table class="table">
  <thead>
  <tr>
  <th scope="col">Id</th>
  <th scope="col">Pseudo</th>
  <th scope="col">Dernière connexion</th>
  <th scope="col">Nombre de Tentative</th>
  <th scope="col">Status</th>
  </tr>
  </thead>
  <tbody>

  ';
  foreach($table as $ligne){
    $iduser=$ligne->id;
    $pseudo=$ligne->username;
    $last_connect=$ligne->last_connect;
    $attempts=$ligne->numberofattempts;


    echo '
    <tr>
      <th scope="row">'.$iduser.'</th>
      <td>'.$pseudo.'<td>
      <td>'.$last_connect.'</td>
      <td>'.$attempts.'</td>
      <td>
  <a href="https://administration.jam-mdm.fr/rechercheuser.php?action=ban&amp;id='.$iduser.'">
  <button type="button" class="btn">ban</button>
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

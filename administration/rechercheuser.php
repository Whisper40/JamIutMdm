<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');

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

  <div class="table-responsive">
    <table class="table">
        <thead class="text-primary">
            <th class="text-center">Identifiant</th>
            <th class="text-center">Pseudo</th>
            <th class="text-center">Dernière connexion</th>
            <th class="text-center">Nombre de Tentative</th>
            <th class="text-center">Statuts</th>
            <th class="text-center">Débanir</th>
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
      <td class="text-center">'.$iduser.'</td>
      <td class="text-center">'.$pseudo.'</td>
      <td class="text-center">'.$last_connect.'</td>
      <td class="text-center"> ??? </td>
      <td class="text-center">'.$attempts.'</td>
      <td class="text-center"><a href="?action=ban&amp;id='.$iduser.'"><button type="button" class="btn btn-rose btn-round btn-sm">Banir</button></a></td>
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

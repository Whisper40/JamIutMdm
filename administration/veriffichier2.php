<?php
    require_once('includes/connectBDD.php');
    $nompage = "Actualité";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');
    ini_set('display_errors', 1);

    if(isset($_GET['action']=='validefichier')){
      echo"bond";

    $id=$_GET['id'];
    $setvalide = $db->prepare("UPDATE validationfichiers SET status='VALIDE' WHERE id=$id");
    $setvalide->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/veriffichier2.php"</script>
    <?php
  }else if(isset($_GET['action']=='refusfichier')){
    $id=$_GET['id'];
    $setrefus = $db->prepare("UPDATE validationfichiers SET status='REFUS' WHERE id=$id");
    $setrefus->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/veriffichier2.php"</script>
    <?php
    }

if($_GET['action']=='gestionfichier'){
  $user_id=$_GET['id'];
  $selectfichieratraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
  $selectfichieratraiter->execute();
  $countid = $selectfichieratraiter->rowCount();
  if($countid>'0'){
  ?>
<h2> Les fichiers en attente de validation : </h2>
<table class="table">
<thead>
<tr>
<th scope="col">Utilisateur</th>
<th scope="col">Nom du fichier</th>
<th scope="col">Message</th>
<th scope="col">Date d'ajout</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
<?php




 ?>
  <?php
  while($fichier = $selectfichieratraiter->fetch(PDO::FETCH_OBJ)){

    $idfichier = $fichier->id;
    $idutilisateur = $fichier->user_id;
    $filename = $fichier->filename;
    $filenamesystem = $fichier->filenamesystem;
    $message = $fichier->message;
    $datefile = $fichier->date;
  ?>

  <tr>
    <th scope="row"><?php echo $idutilisateur;?></th>
    <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
    <td><?php echo $message;?></td>
    <td><?php echo $datefile;?></td>
    <td>
<a href="?action=validefichier&amp;id=<?php echo $idfichier;?>">
<button type="button" class="btn">Valider</button>
</a>
<a href="?action=refusfichier&amp;id=<?php echo $idfichier;?>">
<button type="button" class="btn">Refuser</button>
</a>


    </td>
  </tr>

<?php
}

?>
</tbody>
</table>
<?php
}





}else{

    $selectid = $db->prepare("SELECT distinct user_id FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' ORDER BY date");
    $selectid->execute();
    $countid = $selectid->rowCount();

    if($countid>'0'){
      while($uneselectid = $selectid->fetch(PDO::FETCH_OBJ)){

        $user_id = $uneselectid->user_id;
        $selectnom = $db->prepare("SELECT username, email, status FROM users WHERE id=:user_id ORDER BY id ASC");
        $selectnom->execute(array(
            "user_id"=>$user_id
            )
        );
        $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
        if(count($table)>0){
          echo "<h3>".count($table)." documents trouvés</h3>";
          echo '
          <table class="table">
          <thead>
          <tr>
          <th scope="col">Pseudo</th>
          <th scope="col">Email</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>

          ';
          foreach($table as $ligne){
            $username = $ligne->username;
            $email = $ligne->email;
            $status = $ligne->status;

            echo '

            <tr>
              <th scope="row">'.$username.'</th>
              <td>'.$email.'<td>
              <td>'.$status.'</td>

              <td>
          <a href="?action=gestionfichier&amp;id='.$user_id.'">
          <button type="button" class="btn">Afficher</button>
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

}
}
}



}





require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Gestion des images";
    require_once('includes/head.php');


//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
.page-header .page-header-image {
  position: absolute;
  background-size: cover;
  background-position: center center;
  width: 100%;
  height: 80%;
  z-index: -1;
}

.page-header .content-center {
  position: absolute;
  top: 38%;
  left: 50%;
  z-index: 2;
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
  color: #FFFFFF;
  padding: 0 15px;
  width: 100%;
  max-width: 880px;
}
.section {
  padding: 0px 0;
  position: relative;
  background: #FFFFFF;
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
$(document).ready(function(){

var $recherche =$('input[name=valeur]');
var critere;
$recherche.keyup(function(){
  critere = $.trim($recherche.val());
  if(critere!=''){
    $.get('gestionrechercheimg.php?critere='+critere,function(retour){

$('#resultat').html(retour).fadeIn();

});

}else $('#resultat').empty().fadeOut();
});
});
</script>

<body>
  <div class="wrapper">

<?php

    require_once('includes/navbar.php');

if($_GET['action']=='unban'){

$id=$_GET['id'];
$setunban = $db->prepare("UPDATE images SET status='1' WHERE id=$id");
$setunban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}else if($_GET['action']=='ban'){

$id=$_GET['id'];
$setban = $db->prepare("UPDATE images SET status='0' WHERE id=$id");
$setban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}else if($_GET['action']=='delete'){

$id=$_GET['id'];
$selectnom = $db->query("SELECT * FROM images WHERE id='$id'");
$rname = $selectnom->fetch(PDO::FETCH_OBJ);
$valnom = $rname->file_name;
$dossier = $rname->title;

$target_dir = '../../../JamFichiers/Photos';
$original = 'Original';
$affiche = 'Affiche';
$thumb = 'Thumb';
echo 'Jamesbond';
echo "$target_dir.'/'.$original.'/'.$dossier";

if (file_exists($target_dir.'/'.$original.'/'.$dossier)){
  echo 'Jesuisrnetré';
  unlink("$target_dir/$original/$dossier/$valnom");
  unlink("$target_dir/$affiche/$dossier/$valnom");
  unlink("$target_dir/$thumb/$dossier/$valnom");
  echo 'deleted';
  $updatedelete = $db->prepare("DELETE FROM images WHERE id=$id");
  $updatedelete->execute();

}else{
  echo 'n extse pas';
  $error = 'Un problème de répertoire est présent, contacter votre administrateur !';
}
echo 'esquive';

?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
} ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Gérer les images de la galerie</h2>
                  <br>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">
                        <h3 class="card-title">Liste des images inactives</h3>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">

          <?php

          $selectbanimg = $db->prepare("SELECT * FROM images WHERE status='0'");
          $selectbanimg->execute();
          $countbanimg = $selectbanimg->rowCount();
          if($countbanimg>'0'){
          ?>

                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th class="text-center">Identifiant</th>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Catégorie</th>
                        <th class="text-center">Album Actif</th>
                        <th class="text-center">Action</th>
                      </thead>
                      <tbody>

                        <?php
                            while($sban=$selectbanimg->fetch(PDO::FETCH_OBJ)){
                              $idimg = $sban->id;
                              $file_name = $sban->file_name;
                              $title = $sban->title;
                              $albumactif = $sban->albumactif;
                        ?>

                        <tr>
                          <td class="text-center"><?php echo $idimg;?></td>
                          <td class="text-center"><?php echo $file_name;?></td>
                          <td class="text-center"><?php echo $title;?></td>
                          <td class="text-center"><?php echo $albumactif;?></td>
                          <td class="text-center"><a href="?action=unban&amp;id=<?php echo $idimg;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Activer</button></a>
                                                  <a href="?action=delete&amp;id=<?php echo $idimg;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a>
                          </td>
                        </tr>

                        <?php } ?>

                      </tbody>
                    </table>
                  </div>

                  <?php }else{?>

                   <center>
                      <h4 class="info-title"><font color="red">Aucun image n'est actuellement bannie</font></h4>
                  </center>

                  <?php } ?>

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Desactiver une ou plusieurs images</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="card-content">
                  <input type="text" class="form-control"  name="valeur" placeholder="Recherche par Nom, Identifiant ou Catégorie">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="card-content">
                  <p id='resultat'></p>
                </div>
              </div>
            </div>

 <?php


if(isset($_POST['submit'])){
$action = $_POST['optionsRadios'];
$cat = $_POST['catimage'];
if($action == 'defaut'){

  $insertinfos = $db->prepare("UPDATE images SET albumactif=:albumactif, status=:status WHERE title=:title");
  $insertinfos->execute(array(
      "title"=>$cat,
      "albumactif"=>'1',
      "status"=>'1'
      )
  );

  $success = "L'album à été définis comme album par défaut";

}else if ($action == 'ban'){

  $insertinfos = $db->prepare("UPDATE images SET albumactif=:albumactif, status=:status WHERE title=:title");
  $insertinfos->execute(array(
      "title"=>$cat,
      "albumactif"=>'0',
      "status"=>'0'
      )
  );

  $success = "L'album à été définis comme album par défaut";
}else if ($action == 'delete'){

  $dossier = $cat;

  $target_dir = '../../../JamFichiers/Photos';
  $original = 'Original';
  $affiche = 'Affiche';
  $thumb = 'Thumb';

  if (file_exists($target_dir.'/'.$original.'/'.$dossier)){

    function removeDirectory($path) {
 	      $files = glob($path . '/*');
	      foreach ($files as $file) {
		        is_dir($file) ? removeDirectory($file) : unlink($file);
	         }
	          rmdir($path);
 	          return;
          }

removeDirectory("$target_dir/$original/$dossier");
removeDirectory("$target_dir/$affiche/$dossier");
removeDirectory("$target_dir/$thumb/$dossier");


    $updatedelete = $db->prepare("DELETE FROM images WHERE title=:title");
    $updatedelete->execute(array(
        "title"=>$cat
        )
    );

  }else{
    $error = "Le répertoire n\'existe pas ! ";
  }

}else{
  $error = "Aucune action sélectionnée ";
}


}


$selectcatimages=$db->query("SELECT DISTINCT title FROM images");

  ?>
        <div class="row">
          <div class="col-sm-12">
            <div class="card-content">
              <h3 class="card-title">Gestion des albums</h3>
            </div>
          </div>
        </div>
         <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
           <div class="row">
             <div class="col-sm-3">
                <div class="card-content">
                  <div class="info info-horizontal">
                    <div class="description">
                      <center>
                        <h4 class="info-title">Selectionner un album dans la liste ci contre et l'action à réaliser sur celui-ci</h4>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-5">
                 <div class="card-content">
                   <center>
                     <h3 class="card-title">Sélectionner l'album</h3>
                   </center>
                   <br><br>
                   <div class="jquerysel">
                     <select class="selectpicker" data-style="select-with-transition" title="Fonction" data-size="7" id="grademembre" name="grademembre">
                       <?php
                         while($s = $selectcatimages->fetch(PDO::FETCH_OBJ)){
                           $catimage=$s->title;
                        ?>
                        <option value="<?php echo $catimage;?>"><?php echo $catimage; ?></option>
                       <?php } ?>
                     </select>
                   </div>
                 </div>
               </div>
               <div class="col-sm-5">
                 <div class="card-content">
                   <center>
                     <h3 class="card-title">Action</h3>
                       <div class="radio">
                           <label>
                               <input type="radio" name="optionsRadios" checked="true" value="defaut"> Définir par défaut
                           </label>
                       </div>
                       <div class="radio">
                           <label>
                               <input type="radio" name="optionsRadios" value="ban"> Désactiver
                           </label>
                       </div>
                       <div class="radio">
                           <label>
                               <input type="radio" name="optionsRadios" value="delete"> Supprimer
                           </label>
                       </div>
                    </center>
                  </div>
                </div>
              </div>
             <div class="row">
               <div class="col-sm-12">
                 <div class="card-content">
                   <center>
                     <button type="submit" name="submit" class="btn btn-primary btn-round btn-rose">Valider</button>
                   </center>
                   <br>
                 </div>
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
</body>

  <?php
  require_once('includes/javascript.php');
  ?>

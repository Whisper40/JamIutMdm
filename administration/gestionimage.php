<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";
    ini_set('display_errors', 1);

    require_once('includes/quantcast.php');

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







<body class="landing-page sidebar-collapse">
  <div class="wrapper">
<?php

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
}

    require_once('includes/navbar.php');

    $head = $db->query("SELECT * FROM photopage WHERE nompage = '$nompage'");
    $pagehead = $head->fetch(PDO::FETCH_OBJ);
?>

    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/<?php echo $pagehead->image; ?>');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title"><?php echo $pagehead->pagetitre; ?></h1>
        </div>
      </div>
    </div>

    <?php

    $selectbanimg = $db->prepare("SELECT * FROM images WHERE status='0'");
    $selectbanimg->execute();
    $countbanimg = $selectbanimg->rowCount();
    if($countbanimg>'0'){
    ?>
    <h3> Images inactives </h3>
    <table class="table">
<thead>
  <tr>
    <th scope="col">Id</th>
    <th scope="col">Nom</th>
    <th scope="col">Catégorie</th>
    <th scope="col">Album Actif</th>
    <th scope="col">Action</th>
  </tr>
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
      <th scope="row"><?php echo $idimg;?></th>
      <td><?php echo $file_name;?><td>
      <td><?php echo $title;?></td>
      <td><?php echo $albumactif;?></td>
      <td>
<a href="?action=unban&amp;id=<?php echo $idimg;?>">
  <button type="button" class="btn">Activer</button>
</a>
<a href="?action=delete&amp;id=<?php echo $idimg;?>">
  <button type="button" class="btn">Supprimer</button>
</a>

      </td>
    </tr>
<?php
    }
     ?>
   </tbody>
 </table>

 <?php
}else{
  ?>
<h3> Aucune image n'est actuellement bannie ! Inchallah </h3>
  <?php
}
 ?>
    <div class="section section-contact-us text-center">
      <div class="container">
        <h2 class="title">AUTRE</h2>
        <p class="description">AUTRE</p>
        <div class="row">
          <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">

          </div>
        </div>
      </div>
    </div>

<h3> Bannir une image :  </h3>
  <input type='text' name="valeur" placeholder="Saisir son nom, id ou email">
  <p id='resultat'></p>
<?php

 ?>


 <?php


if(isset($_POST['submit'])){
$action = $_POST['optionsRadios'];
$cat = $_POST['catimage'];
if($action = 'defaut'){

  $insertinfos = $db->prepare("UPDATE images SET albumactif=:albumactif WHERE title=:title");
  $insertinfos->execute(array(
      "title"=>$cat,
      "albumactif"=>'1'
      )
  );

  $success = "L\'album à été définis comme album par défaut";

}else if ($action = 'ban'){

  $insertinfos = $db->prepare("UPDATE images SET albumactif=:albumactif, status=:status WHERE title=:title");
  $insertinfos->execute(array(
      "title"=>$cat,
      "albumactif"=>'0',
      "status"=>'0'
      )
  );

  $success = "L\'album à été désactivé";

}else if ($action = 'delete'){

echo 'OKKKKKKKKKKKKKKKKKKKKKKKKKK';
}else{
  $error = "Un problème inconnu est survenu";
}
}







$selectcatimages=$db->query("SELECT DISTINCT title FROM images");

  ?>

         <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
             Sélectionner l'album<br>
             <select name="catimage">
               <?php
                 while($s = $selectcatimages->fetch(PDO::FETCH_OBJ)){
                   $catimage=$s->title;
                   ?>
                 <option value="<?php echo $catimage;?>"><?php echo $catimage; ?></option>
               <?php
             }
             ?>


             </select>

             <div class="row">
                                               <label class="col-sm-2 label-on-left">Action :</label>
                                               <div class="col-sm-10">
                                                   <div class="radio">
                                                       <label>
                                                           <input type="radio" name="optionsRadios" checked="true" value="defaut"> Définir par défaut
                                                       </label>
                                                   </div>
                                                   <div class="radio">
                                                       <label>
                                                           <input type="radio" name="optionsRadios"  value="ban"> Désactiver
                                                       </label>
                                                   </div>
                                                   <div class="radio">
                                                       <label>
                                                           <input type="radio" name="optionsRadios" value="delete"> Supprimer
                                                       </label>
                                                   </div>
                                               </div>
                                           </div>


             <input type="submit" name="submit" value="Valider">
         </form>



  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

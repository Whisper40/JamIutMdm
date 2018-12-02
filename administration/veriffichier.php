<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";

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
    $.get('recherchefichiers.php?critere='+critere,function(retour){

$('#resultat').html(retour).fadeIn();

});

}else $('#resultat').empty().fadeOut();
});
});
</script>


<body class="landing-page sidebar-collapse">
  <div class="wrapper">

<?php
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

    $selectfiles = $db->prepare("SELECT * FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' ORDER BY date ASC LIMIT 6");
    $selectfiles->execute();
    $countfiles = $selectfiles->rowCount();
    if($countfiles>'0'){
    ?>
    <h3> FIchiers des gens </h3>
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

    if($_GET['action']=='validefichier'){

    $id=$_GET['id'];
    $setvalide = $db->prepare("UPDATE validationfichiers SET status='VALIDE' WHERE id=$id");
    $setvalide->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/veriffichier.php"</script>
    <?php
}else if($_GET['action']=='refusfichier'){
  $id=$_GET['id'];
  $setrefus = $db->prepare("UPDATE validationfichiers SET status='REFUS' WHERE id=$id");
  $setrefus->execute();
  ?>
  <script>window.location="https://administration.jam-mdm.fr/veriffichier.php"</script>
  <?php
}

    while($sfiles=$selectfiles->fetch(PDO::FETCH_OBJ)){
      $idfichier = $sfiles->id;
      $idutilisateur = $sfiles->user_id;
      $filename = $sfiles->filename;
      $filenamesystem = $sfiles->filenamesystem;
      $message = $sfiles->message;
      $datefile = $sfiles->date;

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
}else{
  ?>
<h3> L'ensemble des fichiers transmis ont étés validés </h3>
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



<h3> Obtenir l'ensemble des documents soumis par un utilisateur :  </h3>
  <input type='text' name="valeur" placeholder="Saisir son nom, id ou email">
  <p id='resultat'></p>


  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

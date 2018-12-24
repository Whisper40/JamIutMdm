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
    $.get('rechercheuser.php?critere='+critere,function(retour){

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
echo'bond';
$id=$_GET['id'];
$setunban = $db->prepare("UPDATE users SET ban='0' WHERE id=$id");
$setunban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/banuser.php"</script>
<?php
}else if($_GET['action']=='ban'){
echo'james';
$id=$_GET['id'];
$setban = $db->prepare("UPDATE users SET ban='1' WHERE id=$id");
$setban->execute();

?>
<script>window.location="https://administration.jam-mdm.fr/banuser.php"</script>
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

    $selectban = $db->prepare("SELECT * FROM users WHERE ban='1'");
    $selectban->execute();
    $countban = $selectban->rowCount();
    if($countban>'0'){
    ?>
    <h3> Utilisateurs bannis </h3>
    <table class="table">
<thead>
  <tr>
    <th scope="col">Id</th>
    <th scope="col">Pseudo</th>
    <th scope="col">Dernière connexion</th>
    <th scope="col">Status</th>
    <th scope="col">Status</th>
  </tr>
</thead>
<tbody>
<?php



    while($sban=$selectban->fetch(PDO::FETCH_OBJ)){
      $iduser = $sban->id;
      $pseudo = $sban->username;
      $last_connect = $sban->last_connect;
      $attempts = $sban->numberofattempts;
?>

    <tr>
      <th scope="row"><?php echo $iduser;?></th>
      <td><?php echo $pseudo;?><td>
      <td><?php echo $last_connect;?></td>
      <td><?php echo $attempts;?></td>
      <td>
<a href="?action=unban&amp;id=<?php echo $iduser;?>">
  <button type="button" class="btn">Unban</button>
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
<h3> Aucun utilisateur n'est actuellement bannis ! Inchallah </h3>
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

<h3> Bannir un utilisateur :  </h3>
  <input type='text' name="valeur" placeholder="Saisir son nom, id ou email">
  <p id='resultat'></p>
<?php

 ?>

  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Banir Utilisateur";
    $nomsouscat = "";
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
    $.get('rechercheuser.php?critere='+critere,function(retour){

$('#resultat').html(retour).fadeIn();

});

}else $('#resultat').empty().fadeOut();
});
});
</script>

<body>
  <div class="wrapper">

<?php

if($_GET['action']=='unban'){
echo'bond';
$id=$_GET['id'];
$setunban = $db->prepare("UPDATE users SET ban='0' and numberofattempts='0' WHERE id=$id");
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

    $selectban = $db->prepare("SELECT * FROM users WHERE ban='1'");
    $selectban->execute();
    $countban = $selectban->rowCount();

 ?>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title text-center">Banir / Débanir un Utilisateur</h2>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Rechercher un utilisateur pour banissemet</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="card-content">
                  <input type="text" class="form-control"  name="valeur" placeholder="Recherche par Nom, Identifiant ou Email">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="card-content">
                  <p id='resultat'></p>
                </div>
              </div>
            </div>

            <?php
            if($countban>'0'){
            ?>

            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Liste des Utilisateur Banis</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th class="text-center">Identifiant</th>
                        <th class="text-center">Pseudo</th>
                        <th class="text-center">Dernière connexion</th>
                        <th class="text-center">Statuts</th>
                        <th class="text-center">Débanir</th>
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
                          <td class="text-center"><?php echo $iduser;?></td>
                          <td class="text-center"><?php echo $pseudo;?></td>
                          <td class="text-center"><?php echo $last_connect;?></td>
                          <td class="text-center"><?php echo $attempts;?></td>
                          <td class="text-center"><a href="?action=unban&amp;id=<?php echo $iduser;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Débanir</button></a></td>
                        </tr>

                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          <?php } ?>

        </div>
      </div>
    </div>
  </div>
</div>
</body>

  <?php
  require_once('includes/javascript.php');
  ?>

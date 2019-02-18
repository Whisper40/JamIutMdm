<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Modification Contenu Site";
    require_once('includes/head.php');
    ini_set('display_errors', 1);
    $user_id = $_SESSION['admin_id'];

//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function RetourIndex(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php"
}
</script>

<script>


 function TOTO() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var nom = "<?php echo $nom; ?>";
    var description = $("#description").val();
    var lienimage = $("#lienimage").val();
    var lien = $("#lien").val();
    var catlien = $("#catlien").val();

    $.post("ajax/createliensutiles.php", { user_id: user_id, nom: nom, catlien: catlien, description: description, lienimage: lienimage, lien: lien},
    function(data) {
     $('#results33').html(data);

    });

}

</script>

<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h2 class="card-title text-center">Création de liens utiles</h2>
            <form action="" method="post" id="myForm1" class="contact-form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-content">
                      Sélectionner la catégorie<br><?php

                      $selectliencat=$db->query("SELECT DISTINCT namecat FROM catliensutiles");
                      ?>

                      <select name="catlien" id="catlien">
                        <?php
                          while($sa = $selectliencat->fetch(PDO::FETCH_OBJ)){
                            $catlien=$sa->namecat;
                            $catslug=$sa->slug;
                            ?>
                          <option value="<?php echo $catslug;?>"><?php echo $catlien; ?></option>
                        <?php
                      }
                      ?>
                      </select>

                     </div>


                     <div class="form-group label-floating">
                         <label class="control-label">Nom</label>
                         <input type="text" class="form-control" value="" name="nom" id="nom">
                     </div>

                     <div class="form-group label-floating">
                         <label class="control-label">Description</label>
                         <input type="text" class="form-control" value="" name="description" id="description">
                     </div>

                     <div class="form-group label-floating">
                         <label class="control-label">Lien de l'image</label>
                         <input type="text" class="form-control" value="" name="lienimage" id="lienimage">
                     </div>

                     <div class="form-group label-floating">
                         <label class="control-label">Lien vers le partenaire</label>
                         <input type="text" class="form-control" value="" name="lien" id="lien">
                     </div>

                  </div>

                <div class="col-sm-12">
                    <div class="card-content">
                      <center>
                        <button id="submitFormDataModifliens" onclick="TOTO();" type="button" class="btn btn-primary btn-round btn-rose">Ajouter</button>
                      <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                      </center>
                     </div>
                  </div>
            </div>
          </form>
        </div>


    </div>
</div>

<div id="results33"> <!-- TRES IMPORTANT -->
</div>
<?php
require_once('includes/javascript.php');
?>

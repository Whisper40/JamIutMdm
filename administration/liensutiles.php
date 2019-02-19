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
  window.location="https://administration.jam-mdm.fr/liensutiles.php"
}
</script>


<?php
if(isset($_GET['modiflien'])){


?>


  <?php
  $id = $_GET['modiflien'];

  $selectinfosactuel = $db->prepare("SELECT * from lienutiles where id=:id");
  $selectinfosactuel->execute(array(
      "id"=>$id
      )
  );
  $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);

  $nom = $r2->name;
  $lienimage = $r2->lienimage;
  $lien = $r2->lien;
  $description = $r2->description;

?>

<script>


function SubmitFormDataModifLiens() {
  var user_id = "<?php echo $_SESSION['admin_id']; ?>";
  var id = "<?php echo $id; ?>";
  var nom = $("#nom").val();
  var lienutiles = $("#lienutiles").val();
  var lien = $("#lien").val();
  var description = $("#description").val();
  $.post("ajax/modifypagelien.php", { user_id: user_id, id: id, nom: nom, liensutiles: liensutiles, lien: lien, description: description},
  function(data) {
   $('#results6').html(data);

  });

}

</script>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <h2 class="card-title text-center">Modification d'un lien utile</h2>
        <br><br>
          <form action="" method="post" id="myForm1" class="contact-form">
            <div class="row">
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Nom</label>
                      <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom" id="nom">
                    </div>
                    <div class="form-group label-floating">
                      <label class="control-label">Lien</label>
                      <input type="text" name="lien" value="<?php echo $lien; ?>" id="lien" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                      <label class="control-label">Lien image</label>
                      <input type="text" name="lienimage" value="<?php echo $lienimage; ?>" id="lienimage" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="9" type="text" name="description" value="Description du Status" id="description" class="form-control"><?php echo $description; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <center>
                      <button id="submitFormDataModifLiens" onclick="SubmitFormDataModifLiens();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                      <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                    </center>
                    <br><br>
                  </div>
                </div>
              </div>
            </form>
          <div id="results6"></div>
          </div>
        </div>
      </div>
    </div>

<?php }else{



 ?>




























<script>


 function TOTO() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var nom = $("#nom").val();
    var description = $("#description").val();
    var lienimage = $("#lienimage").val();
    var lien = $("#lien").val();
    var catlien = $("#catlien").val();

    $.post("ajax/createliensutiles.php", { user_id: user_id, nom: nom, description: description, lienimage: lienimage, lien: lien, catlien: catlien},
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

                      $selectliencat=$db->query("SELECT namecat FROM catliensutiles");
                      ?>

                      <select name="catlien" id="catlien">
                        <?php
                          while($sa = $selectliencat->fetch(PDO::FETCH_OBJ)){
                            $catlien=$sa->namecat;

                            ?>
                          <option value="<?php echo $catlien;?>"><?php echo $catlien; ?></option>
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




<?php

if(isset($_GET['deletelien'])){

  $id = $_GET['deletelien'];


  $updatedelete = $db->prepare("DELETE FROM lienutiles WHERE id=:id");
  $updatedelete->execute(array(
    "id"=>$id

  ));

  $succes = "Le lien utile à bien été supprimé";
?>
  <script>
    window.location="https://administration.jam-mdm.fr/liensutiles.php"
  </script>
<?php

}

    $selectnom = $db->prepare("SELECT * FROM lienutiles ORDER BY id ASC");
    $selectnom->execute();


    $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
    if(count($table)>0){

      echo '
      <div class="table-responsive">
        <table class="table">
          <thead class="text-primary">
            <th class="text-center">Type</th>
            <th class="text-left">Nom</th>
            <th class="text-left">Description</th>
            <th class="text-left">Modifier</th>
          </thead>
          <tbody>
      ';

      foreach($table as $ligne){
        $id = $ligne->id;
        $slug = $ligne->slug;
        $nom = $ligne->name;
        $description = $ligne->description;
        $lienimage = $ligne->lienimage;
        $lien = $ligne->lien;

        echo '
        <tr>
          <td class="text-center">'.$slug.'</td>
          <td class="text-left">'.$nom.'</td>
          <td class="text-left">'.$description.'</td>
          <td class="text-center">
            <a href="?modiflien='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Modifier</button></a>
            <a href="?deletelien='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a>
          </td>
        </tr>
        ';

      }

      echo '
      </tbody>
    </table>
  </div>
      ';

    }else{
      $error = "Aucun lien utile trouvé";
    }

    ?>


















</div>

<div id="results33"> <!-- TRES IMPORTANT -->
</div>
<?php
}
require_once('includes/javascript.php');
?>

<script>


 function SubmitFormDataModifliens() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var id = "<?php echo $id; ?>";
    var title = $("#title").val();
    var description = $("#description").val();
    var title2 = $("#title2").val();
    var description2 = $("#description2").val();
    var title3 = $("#title3").val();
    var description3 = $("#description3").val();
    var formatimg = $("#formatimg").val();
    var stock = $("#stock").val();
    $.post("ajax/modifyallactivity.php", { user_id: user_id, id: id, title: title, description: description, title2: title2, description2: description2, title3: title3, description3: description3, formatimg: formatimg, stock: stock},
    function(data) {
     $('#results11').html(data);

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
                            ?>
                          <option value="<?php echo $catlien;?>"><?php echo $catlien; ?></option>
                        <?php
                      }
                      ?>
                      </select>

                     </div>


                     <div class="form-group label-floating">
                         <label class="control-label">Nom</label>
                         <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom" id="nom">
                     </div>

                     <div class="form-group label-floating">
                         <label class="control-label">Description</label>
                         <input type="text" class="form-control" value="<?php echo $description; ?>" name="description" id="description">
                     </div>

                     <div class="form-group label-floating">
                         <label class="control-label">Lien de l'image</label>
                         <input type="text" class="form-control" value="<?php echo $lienimage; ?>" name="lienimage" id="lienimage">
                     </div>

                     <div class="form-group label-floating">
                         <label class="control-label">Lien vers le partenaire</label>
                         <input type="text" class="form-control" value="<?php echo $lien; ?>" name="lien" id="lien">
                     </div>

                  </div>

                <div class="col-sm-12">
                    <div class="card-content">
                      <center>
                        <button id="submitFormDataModifliens" onclick="SubmitFormDataModifliens();" type="button" class="btn btn-primary btn-round btn-rose">Ajouter</button>
                      <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                      </center>
                     </div>
                  </div>
            </div>
          </form>
        </div>


    </div>
</div>

<div id="results20"> <!-- TRES IMPORTANT -->
</div>

<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";




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







<body class="landing-page sidebar-collapse">
  <div class="wrapper">
<?php
if(isset($_GET['page'])){
if($_GET['page']=='index'){
  $table = $_GET['table'];
?>
  <script>


   function SubmitFormDataIndex() {
     var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var img1 = $("#img1").val();
      var logo1 = $("#logo1").val();
      var titre1 = $("#titre1").val();
      var description1 = $("#description1").val();
      var bouton1 = $("#bouton1").val();
      var lienbt1 = $("#lienbt1").val();
      var bouton2 = $("#bouton2").val();
      var lienbt2 = $("#lienbt2").val();
      var logo2 = $("#logo2").val();
      var titre2 = $("#titre2").val();
      var description2 = $("#description2").val();
      var fb = $("#fb").val();
      $.post("ajax/modifypageindex.php", { user_id:user_id, img1: img1, logo1: logo1, titre1: titre1, description1: description1, bouton1: bouton1, lienbt1: lienbt1, bouton2: bouton2, lienbt2: lienbt2, logo2: logo2, titre2: titre2, description2: description2, fb: fb},
      function(data) {
       $('#results1').html(data);

      });

  }

  </script>
  <?php
  $selectinfosactuel = $db->prepare("SELECT * from pageindex");
  $selectinfosactuel->execute();
  $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
  $img1 = $r2->img1;
  $logo1 = $r2->logo1;
  $titre1 = $r2->titre1;
  $description1 = $r2->description1;
  $bouton1 = $r2->bouton1;
  $lienbt1 = $r2->lienbt1;
  $bouton2 = $r2->bouton2;
  $lienbt2 = $r2->lienbt2;
  $logo2 = $r2->logo2;
  $titre2 = $r2->titre2;
  $description2 = $r2->description2;
  $fb = $r2->fb;
?>
  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification de l'index du site</h2>
                  <form action="" method="post" id="myForm1" class="contact-form">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Image du fond</label>
                                <input type="text" class="form-control" value="<?php echo $img1; ?>" name="img1" id="img1">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Logo Central</label>
                                <input type="text" name="logo1" value="<?php echo $logo1; ?>"id="logo1" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Titre Principal</label>
                                <input type="text" name="titre1" value="<?php echo $titre1; ?>" id="titre1" class="form-control">
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Description</label>
                                  <input type="text" name="description1" value="<?php echo $description1; ?>"id="description1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Bouton Gauche</label>
                                  <input type="text" name="bouton1" value="<?php echo $bouton1; ?>" id="bouton1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Lien bouton gauche</label>
                                  <input type="text" name="lienbt1" value="<?php echo $lienbt1; ?>" id="lienbt1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Bouton Droite</label>
                                  <input type="text" name="bouton2" value="<?php echo $bouton2; ?>" id="bouton2" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Lien bouton droite</label>
                                  <input type="text" name="lienbt2" value="<?php echo $lienbt2; ?>" id="lienbt2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Logo</label>
                                  <input type="text" name="logo2" value="<?php echo $logo2; ?>" id="logo2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre Secondaire</label>
                                  <input type="text" name="titre2" value="<?php echo $titre2; ?>" id="titre2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description Secondaire</label>
                                  <input type="text" name="description2" value="<?php echo $description2; ?>" id="description2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Lien Facebook</label>
                                  <input type="text" name="fb" value="<?php echo $fb; ?>" id="fb" class="form-control">
                              </div>
                           </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="card-content">

                            <center>
                            <button id="submitFormDataIndex" onclick="SubmitFormDataIndex();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                            <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                            </center>
                           </div>
                        </div>
                  </div>
                </form>
              </div>
          </div>
      </div>

   <div id="results1"> <!-- TRES IMPORTANT -->



  </div>
</div>






















<?php
}else if ($_GET['page']=='devenirmembre'){
  $table = $_GET['table'];


  ?>
    <script>


     function SubmitFormDataDevenirMembre() {
       var user_id = "<?php echo $_SESSION['admin_id']; ?>";
        var introduction = $("#introduction").val();
        var etape1 = $("#etape1").val();
        var etape2 = $("#etape2").val();
        var etape3 = $("#etape3").val();

        $.post("ajax/modifypagedevenirmembre.php", { user_id:user_id, introduction: introduction, etape1: etape1, etape2: etape2, etape3: etape3},
        function(data) {
         $('#results2').html(data);

        });

    }

    </script>
    <?php
    $selectinfosactuel = $db->prepare("SELECT * from pagedevenirmembre");
    $selectinfosactuel->execute();
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
    $introduction = $r2->introduction;
    $etape1 = $r2->etape1;
    $etape2 = $r2->etape2;
    $etape3 = $r2->etape3;

  ?>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification de la page devenir membre</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Introduction</label>
                                  <input type="text" class="form-control" value="<?php echo $introduction; ?>" name="introduction" id="introduction">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Etape 1</label>
                                  <input type="text" name="etape1" value="<?php echo $etape1; ?>"id="etape1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Etape 2</label>
                                  <input type="text" name="etape2" value="<?php echo $etape2; ?>" id="etape2" class="form-control">
                              </div>
                             </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="card-content">
                                <div class="form-group label-floating">
                                    <label class="control-label">Etape 3</label>
                                    <input type="text" name="etape3" value="<?php echo $etape3; ?>"id="etape3" class="form-control">
                                </div>

                             </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataDevenirMembre" onclick="SubmitFormDataDevenirMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                              <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results2"> <!-- TRES IMPORTANT -->



    </div>
  </div>


<?php











}else if ($_GET['page']=='association'){
  $table = $_GET['table'];


  ?>
    <script>


     function SubmitFormDataPageAsso() {
        var user_id = "<?php echo $_SESSION['admin_id']; ?>";
        var titre1 = $("#titre1").val();
        var description1 = $("#description1").val();
        var description2 = $("#description2").val();


        $.post("ajax/modifypageassociation.php", { user_id:user_id, titre1: titre1, description1: description1, description2: description2},
        function(data) {
         $('#results3').html(data);

        });

    }

    </script>
    <?php
    $selectinfosactuel = $db->prepare("SELECT * from pageasso");
    $selectinfosactuel->execute();
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
    $titre1 = $r2->titre1;
    $description1 = $r2->description1;
    $description2 = $r2->description2;

  ?>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification de la page association</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Titre 1</label>
                                  <input type="text" class="form-control" value="<?php echo $titre1; ?>" name="titre1" id="titre1">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Description 1</label>
                                  <input type="text" name="description1" value="<?php echo $description1; ?>"id="description1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Description 2</label>
                                  <input type="text" name="description2" value="<?php echo $description2; ?>" id="description2" class="form-control">
                              </div>
                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataPageAsso" onclick="SubmitFormDataPageAsso();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                              <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results3"> <!-- TRES IMPORTANT -->



    </div>
  </div>


<?php










}else if ($_GET['page']=='membre'){

  if(isset($_GET['modifmembre'])){


?>
<script>
function RetourIndex2(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=membre&table=membres"
}
</script>
    <script>


     function SubmitFormDataModifMembre() {
        var user_id = "<?php echo $_SESSION['admin_id']; ?>";
        var nom = $("#nom").val();
        var image = $("#image").val();
        var description = $("#description").val();
        var grademembre = $('#grademembre').val();
        var importancegrade = $('#importancegrade').val();
        var fonction = $("#fonction").val();


        $.post("ajax/modifypagemodifmembre.php", { user_id:user_id, nom: nom, image: image, description: description, grademembre: grademembre, importancegrade: importancegrade},
        function(data) {
         $('#results4').html(data);

        });

    }

    </script>
    <?php
    $user_id = $_GET['modifmembre'];

    $selectinfosactuel = $db->prepare("SELECT * from membres where id=:user_id");
    $selectinfosactuel->execute(array(
        "user_id"=>$user_id
        )
    );
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
    $nom = $r2->nom;
    $image = $r2->image;
    $categorie = $r2->categorie;
    $importance = $r2->importance;
    $fonction = $r2->fonction;
    $description = $r2->description;

?>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification des informations</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Nom</label>
                                  <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom" id="nom">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Image</label>
                                  <input type="text" name="image" value="<?php echo $image; ?>"id="image" class="form-control">
                              </div>

                              <div class="jquerysel"><!-- on s'en fout -->
<label>Grade : </label><select id="grademembre">
  <?php
if ($categorie == 'pres'){
  ?>
  <option selected value="pres">Président</option>
<?php
}else{
  ?>
    <option value="pres">Président</option>
<?php }

if ($categorie == 'tres'){
  ?>
    <option selected value="tres">Trésorier</option>
    <?php
  }else{ ?>
    <option value="tres">Trésorier</option>
  <?php }
  if ($categorie == 'secr'){
    ?>
    <option selected value="secr">Secrétaire</option>
  <?php }else{ ?>
    <option value="secr">Secrétaire</option>
  <?php }
  if ($categorie == 'com'){
    ?>
    <option selected value="com">Communication</option>
  <?php }else{ ?>
    <option value="com">Communication</option>
  <?php } ?>


</select>
</div>

<div class="jquerysel"><!-- on s'en fout -->
<label>Spécification grade : </label><select id="importancegrade">
  <?php
  if ($importance == '1'){
    ?>
<option selected value="1">Responsable</option>
<?php }else{
  ?>
  <option value="1">Responsable</option>
  <?php
}
  if ($importance == '2'){
    ?>
<option selected value="2">Vice</option>
<?php }else{
  ?>
  <option value="2">Vice</option>
  <?php
}
  if ($importance == '3'){
    ?>
    <option selected value="3">Honneur</option>
  <?php }else{ ?>
<option value="3">Honneur</option>
<?php } ?>



</select>
</div>

<div class="form-group label-floating">
    <label class="control-label">Fonction</label>
    <input type="text" name="fonction" value="<?php echo $fonction; ?>" id="fonction" class="form-control">
</div>


                              <div class="form-group label-floating">
                                  <label class="control-label">Description</label>
                                  <input type="text" name="description" value="<?php echo $description; ?>" id="description" class="form-control">
                              </div>
                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataModifMembre" onclick="SubmitFormDataModifMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                              <button onclick="RetourIndex2();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results4"> <!-- TRES IMPORTANT -->



    </div>
  </div>
  <?php




}else{









      $selectnom = $db->prepare("SELECT id, image, nom, categorie, importance, fonction, description FROM membres");
      $selectnom->execute();


      $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
      if(count($table)>0){

        echo "<h3>".count($table)." Personnes trouvées</h3>";
        echo '
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Nom</th>
        <th scope="col">Image</th>
        <th scope="col">Fonction</th>
        <th scope="col">Action</th>


        </tr>
        </thead>
        <tbody>

        ';
        foreach($table as $ligne){
          $id = $ligne->id;
          $nom = $ligne->nom;
          $image = $ligne->image;
          $fonction = $ligne->fonction;


          echo '

          <tr>
            <th scope="row">'.$nom.'</th>
            <td>'.$image.'<td>
            <td>'.$fonction.'</td>

            <td>

            <a href="?page=membre&amp;table=membres&amp;modifmembre='.$id.'">
            <button type="button" class="btn">Modifier</button>
            </a>

            </td>
          </tr>

          ';
        }

        echo '
      </tbody>
      </table>


        ';
      }else{
        $error = "Aucune personne trouvée";
      }


//Création membres

?>
<script>


 function SubmitFormDataCreationMembre() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var nom = $("#nom").val();
    var image = $("#image").val();
    var description = $("#description").val();
    var grademembre = $('#grademembre').val();
    var importancegrade = $('#importancegrade').val();
    var fonction = $("#fonction").val();


    $.post("ajax/creationmembre.php", { user_id:user_id, nom: nom, image: image, description: description, grademembre: grademembre, importancegrade: importancegrade},
    function(data) {
     $('#results5').html(data);

    });

}

</script>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Création d'un membre</h2>
                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Nom/Prénom</label>
                              <input type="text" class="form-control" value="Nom Prenom" name="nom" id="nom">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Image</label>
                              <input type="text" name="image" value="monimage.jpg"id="image" class="form-control">
                          </div>

                          <div class="jquerysel"><!-- on s'en fout -->
<label>Grade : </label><select id="grademembre">
<option value="pres">Président</option>
<option value="tres">Trésorier</option>
<option value="secr">Secrétaire</option>
<option value="com">Communication</option>
</select>
</div>

<div class="jquerysel"><!-- on s'en fout -->
<label>Spécification grade : </label><select id="importancegrade">
<option value="1">Responsable</option>
<option value="2">Vice</option>
<option value="3">Honneur</option>
</select>
</div>

<div class="form-group label-floating">
<label class="control-label">Fonction</label>
<input type="text" name="fonction" value="Vice Trésorier" id="fonction" class="form-control">
</div>


                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <input type="text" name="description" value="Ma description" id="description" class="form-control">
                          </div>
                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="SubmitFormDataCreationMembre" onclick="SubmitFormDataCreationMembre();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results5"> <!-- TRES IMPORTANT -->



</div>
</div>
<?php
//FIn Création












































}

















































}else if ($_GET['page']=='status'){

  if(isset($_GET['modifstatus'])){


?>
<script>
function RetourIndex2(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=membre&table=membres"
}
</script>
    <script>


     function SubmitFormDataModifStatus() {
        var user_id = "<?php echo $_SESSION['admin_id']; ?>";
        var article = $("#article").val();
        var titre = $("#titre").val();
        var soustitre = $("#soustitre").val();
        var description = $("#description").val();
        $.post("ajax/modifypagestatus.php", { user_id:user_id, article: article, titre: titre, soustitre: soustitre, description: description},
        function(data) {
         $('#results6').html(data);

        });

    }

    </script>
    <?php
    $id = $_GET['modifstatus'];

    $selectinfosactuel = $db->prepare("SELECT * from status where id=:id");
    $selectinfosactuel->execute(array(
        "id"=>$id
        )
    );
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
    $article = $r2->article;
    $titre = $r2->titre;
    $soustitre = $r2->soustitre;
    $description = $r2->description;

?>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification des informations</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Article</label>
                                  <input type="text" class="form-control" value="<?php echo $article; ?>" name="article" id="article">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre</label>
                                  <input type="text" name="titre" value="<?php echo $titre; ?>"id="titre" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Sous Titre</label>
                                  <input type="text" name="soustitre" value="<?php echo $soustitre; ?>" id="soustitre" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description</label>
                                  <input type="text" name="description" value="<?php echo $description; ?>" id="description" class="form-control">
                              </div>
                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataModifStatus" onclick="SubmitFormDataModifStatus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                              <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results6"> <!-- TRES IMPORTANT -->
    </div>
  </div>
  <?php




}else{

      $selectnom = $db->prepare("SELECT * FROM status");
      $selectnom->execute();


      $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
      if(count($table)>0){

        echo "<h3>".count($table)." Personnes trouvées</h3>";
        echo '
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Article</th>
        <th scope="col">Titre/Sous titre</th>
        <th scope="col">Description</th>
        <th scope="col">Action</th>


        </tr>
        </thead>
        <tbody>

        ';
        foreach($table as $ligne){
          $id = $ligne->id;
          $article = $ligne->article;
          $titre = $ligne->titre;
          $soustitre = $ligne->soustitre;
          $description = $ligne->description;


          echo '

          <tr>
            <th scope="row">'.$article.'</th>
            <td>'.$titre.'<td>
            <td>'.$soustitre.'</td>
            <td>
            <a href="?page=status&amp;table=status&amp;modifstatus='.$id.'">
            <button type="button" class="btn">Modifier</button>
            </a>
            </td>
          </tr>
          ';
        }

        echo '
      </tbody>
      </table>


        ';
      }else{
        $error = "Aucun status trouvé";
      }


//Création membres

?>
<script>


 function SubmitFormDataCreationMembre() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var nom = $("#nom").val();
    var image = $("#image").val();
    var description = $("#description").val();
    var grademembre = $('#grademembre').val();
    var importancegrade = $('#importancegrade').val();
    var fonction = $("#fonction").val();


    $.post("ajax/creationmembre.php", { user_id:user_id, nom: nom, image: image, description: description, grademembre: grademembre, importancegrade: importancegrade},
    function(data) {
     $('#results5').html(data);

    });

}

</script>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Création d'un membre</h2>
                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Nom/Prénom</label>
                              <input type="text" class="form-control" value="Nom Prenom" name="nom" id="nom">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Image</label>
                              <input type="text" name="image" value="monimage.jpg"id="image" class="form-control">
                          </div>

                          <div class="jquerysel"><!-- on s'en fout -->
<label>Grade : </label><select id="grademembre">
<option value="pres">Président</option>
<option value="tres">Trésorier</option>
<option value="secr">Secrétaire</option>
<option value="com">Communication</option>
</select>
</div>

<div class="jquerysel"><!-- on s'en fout -->
<label>Spécification grade : </label><select id="importancegrade">
<option value="1">Responsable</option>
<option value="2">Vice</option>
<option value="3">Honneur</option>
</select>
</div>

<div class="form-group label-floating">
<label class="control-label">Fonction</label>
<input type="text" name="fonction" value="Vice Trésorier" id="fonction" class="form-control">
</div>


                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <input type="text" name="description" value="Ma description" id="description" class="form-control">
                          </div>
                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="SubmitFormDataCreationMembre" onclick="SubmitFormDataCreationMembre();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results5"> <!-- TRES IMPORTANT -->



</div>
</div>
<?php
//FIn Création












































}

















































}



}else{//FIN $_GET





?>

    <a href="?page=index&amp;table=pageindex">
      <button type="button" class="btn">Page Index</button>
    </a>

    <a href="?page=devenirmembre&amp;table=pagedevenirmembre">
      <button type="button" class="btn">Page Devenir Membre</button>
    </a>

    <a href="?page=association&amp;table=pageasso">
      <button type="button" class="btn">Page Association</button>
    </a>

    <a href="?page=membre&amp;table=membres">
      <button type="button" class="btn">Page Membre</button>
    </a>

    <a href="?page=status&amp;table=status">
      <button type="button" class="btn">Page Status</button>
    </a>

    <a href="?page=lienutiles&amp;table=lienutiles">
      <button type="button" class="btn">Page Liens</button>
    </a>












<?php



}
?>


  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

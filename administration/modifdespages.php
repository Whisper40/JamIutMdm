<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";
    ini_set('display_errors', 1);

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
      var id = "<?php echo $id ?>";
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
      $.post("ajax/modifypageindex.php", { user_id:user_id, id:id, img1: img1, logo1: logo1, titre1: titre1, description1: description1, bouton1: bouton1, lienbt1: lienbt1, bouton2: bouton2, lienbt2: lienbt2, logo2: logo2, titre2: titre2, description2: description2, fb: fb},
      function(data) {
       $('#results1').html(data);

      });

  }

  </script>
  <?php
  $selectinfosactuel = $db->prepare("SELECT * from pageindex");
  $selectinfosactuel->execute();
  $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
  $id = $r2->id;
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
        var id = "<?php echo $id; ?>";
        var introduction = $("#introduction").val();
        var etape1 = $("#etape1").val();
        var etape2 = $("#etape2").val();
        var etape3 = $("#etape3").val();

        $.post("ajax/modifypagedevenirmembre.php", { user_id:user_id, id:id, introduction: introduction, etape1: etape1, etape2: etape2, etape3: etape3},
        function(data) {
         $('#results2').html(data);

        });

    }

    </script>
    <?php
    $selectinfosactuel = $db->prepare("SELECT * from pagedevenirmembre");
    $selectinfosactuel->execute();
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
    $id = $r2->id;
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
        var id = "<?php echo $id; ?>";
        var titre1 = $("#titre1").val();
        var description1 = $("#description1").val();
        var description2 = $("#description2").val();
        var pagetitre = $("#pagetitre").val();
        var image = $("#image").val();


        $.post("ajax/modifypageassociation.php", { user_id:user_id, id:id, titre1: titre1, description1: description1, description2: description2, pagetitre:pagetitre, image:image},
        function(data) {
         $('#results3').html(data);

        });

    }

    </script>
    <?php
    $selectinfosactuel = $db->prepare("SELECT * from pageasso");
    $selectinfosactuel->execute();
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
    $id = $r2->id;
    $titre1 = $r2->titre1;
    $description1 = $r2->description1;
    $description2 = $r2->description2;

    $selectinfosactuel2 = $db->prepare("SELECT * from photopage where nompage=:nompage");
    $selectinfosactuel2->execute(array(
      "nompage"=>'Présentation association'
    ));
    $r3 = $selectinfosactuel2->fetch(PDO::FETCH_OBJ);
    $pagetitre = $r3->pagetitre;
    $image = $r3->image;

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
                                  <label class="control-label">Titre de la page</label>
                                  <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Nom de l'image</label>
                                  <input type="text" class="form-control" value="<?php echo $image; ?>" name="image" id="image">
                              </div>



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
        var id = "<?php echo $id; ?>";
        var nom = $("#nom").val();
        var image = $("#image").val();
        var description = $("#description").val();
        var grademembre = $('#grademembre').val();
        var importancegrade = $('#importancegrade').val();
        var fonction = $("#fonction").val();


        $.post("ajax/modifypagemodifmembre.php", { user_id:user_id, id:id, nom: nom, image: image, description: description, grademembre: grademembre, importancegrade: importancegrade},
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
    $id = $r2->id;
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

//modif page membre
?>

<script>


 function SubmitFormDataMembre() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var pagetitre = $('#pagetitre').val();
    var image = $('#image').val();
    var titre = $("#titre").val();


    $.post("ajax/modifypagemembre.php", { user_id:user_id, pagetitre: pagetitre, image: image, titre: titre},
    function(data) {
     $('#results10').html(data);

    });

}

</script>


<?php


$selectinfosactuel4 = $db->prepare("SELECT * from photopage where nompage=:nompage");
$selectinfosactuel4->execute(array(
  "nompage"=>'Présentation des membres'
));
$r4 = $selectinfosactuel4->fetch(PDO::FETCH_OBJ);
$pagetitre = $r4->pagetitre;
$image = $r4->image;
$titre = $r4->titre;


 ?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Modification page présentation membres</h2>
                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre de la page</label>
                              <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Image</label>
                              <input type="text" name="image" value="<?php echo $image; ?>"id="image" class="form-control">
                          </div>


                          <div class="form-group label-floating">
                              <label class="control-label">Titre</label>
                              <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
                          </div>
                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="SubmitFormDataMembre" onclick="SubmitFormDataMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
























        </div>
    </div>

 <div id="results10"> <!-- TRES IMPORTANT -->
</div>
<?php










//Fin modif membres







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

<?php






if(isset($_POST['submitphotomembre'])){

      $target_dir = "../../../JamFichiers/Img/Membres";

      $original = 'Original';
      if (file_exists($target_dir/$original)) {
        $target_dirnew = "$target_dir/$original";
      }else{
        mkdir("$target_dir/$original", 0700);
        $target_dirnew = "$target_dir/$original/";
      }

      //Ajout thumb
      $thumb = 'Thumb';
      if (file_exists($target_dir/$thumb)) {
        $target_dirnewthumb = "$target_dir/$thumb/";
      }else{
        mkdir("$target_dir/$thumb", 0700);
        $target_dirnewthumb = "$target_dir/$thumb/";
      }
      //FIN


$total = count($_FILES['fileToUpload']['name']);

for( $i=0 ; $i < $total ; $i++ ) {
$target_file = $target_dirnew . basename($_FILES["fileToUpload"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    $error = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " existe déja !";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $error = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " est trop grand ! (max=3Mo)";
    $uploadOk = 0;

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    $error = 'Désolé, les formats autorisés sont JPG, JPEG et PNG';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $succes = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé";


        $status = '1';
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');


        $img_tmp = $target_dirnew.$target_filefile;
        $fin = $target_dirnewthumb.$target_filefile;


          //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
            $longueur = 80;
            $largeur = 80;
            //TAILLE DE L'IMAGE ACTUELLE
            $taille = getimagesize($img_tmp);
            //SI LE FICHIER EXISTE
            if ($taille) {
                //SI JPG
                if ($taille['mime']=='image/jpeg' ) {
                          //OUVERTURE DE L'IMAGE ORIGINALE
                            $img_big = imagecreatefromjpeg($img_tmp);
                            $img_new = imagecreate($longueur, $largeur);
                          //CREATION DE LA MINIATURE
                            $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                            //COPIE DE L'IMAGE REDIMENSIONNEE
                            imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                            imagejpeg($img_petite,$fin);
                }
              //SI PNG
            else if ($taille['mime']=='image/png' ) {
                            //OUVERTURE DE L'IMAGE ORIGINALE
                            $img_big = imagecreatefrompng($img_tmp); // On ouvre l'image d'origine
                            $img_new = imagecreate($longueur, $largeur);
                            //CREATION DE LA MINIATURE
                            $img_petite = imagecreatetruecolor($longueur, $largeur) OR $img_petite = imagecreate($longueur, $largeur);
                            //COPIE DE L'IMAGE REDIMENSIONNEE
                            imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                            imagepng($img_petite,$fin);
                        }

                }







    }else {
        $error = 'Désolé, une erreur est survenue.';
    } } }

          } ?>






            <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">

              <h3> Ajouter des photos de membres </h3>

                <div class="form-group form-file-upload">
                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                    <div class="input-group">
                        <input type="text" readonly="" class="form-control" placeholder="Insérer vos pièces jointes">
                        <span class="input-group-btn input-group-s">
                            <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                <i class="material-icons">layers</i>
                            </button>
                        </span>
                    </div>
                </div>

                <input type="submit" name="submitphotomembre" value="Envoyer les images !">
            </form>
            <?php

            if(!empty($error)){


            // CODE HTML ICI
               echo '
              <button>'.$error.'</button>'; }


            if(!empty($succes)){


            // CODE HTML ICI
               echo '
              <button>'.$succes.'</button>'; }?>
</div>
<?php
//FIn Création


//Modif d'images filemanager
?>
<h3> Modification et suppression des images </h3>

<a href="https://administration.jam-mdm.fr/filemanager.php?id=administrationjam&password=J@MAdministration" target="_blank" class="w3-button w3-black">Accèder à l'interface de gestion</a>


<?php

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
        var id = "<?php echo $id; ?>";
        var article = $("#article").val();
        var titre = $("#titre").val();
        var soustitre = $("#soustitre").val();
        var description = $("#description").val();
        $.post("ajax/modifypagestatus.php", { user_id:user_id, id:id, article: article, titre: titre, soustitre: soustitre, description: description},
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
<script>
function RetourIndex3(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=status&table=status"
}
</script>

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
                              <button onclick="RetourIndex3();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
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

      $selectnom = $db->prepare("SELECT * FROM status ORDER BY article ASC");
      $selectnom->execute();


      $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
      if(count($table)>0){

        echo "<h3>".count($table)." status trouvés</h3>";
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


function SubmitFormDataCreateStatus() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var article = $("#article").val();
   var titre = $("#titre").val();
   var soustitre = $("#soustitre").val();
   var description = $("#description").val();
   $.post("ajax/createpagestatus.php", { user_id:user_id, article: article, titre: titre, soustitre: soustitre, description: description},
   function(data) {
    $('#results7').html(data);

   });

}

</script>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Création d'un status</h2>
                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Article</label>
                              <input type="text" class="form-control" value="Numéro de l'article" name="article" id="article">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Titre</label>
                              <input type="text" name="titre" value="Titre du status" id="titre" class="form-control">
                          </div>



                        <div class="form-group label-floating">
                        <label class="control-label">Sous Titre</label>
                        <input type="text" name="soustitre" value="Sous titre" id="soustitre" class="form-control">
                        </div>


                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <input type="text" name="description" value="La description" id="description" class="form-control">
                          </div>
                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="SubmitFormDataCreateStatus" onclick="SubmitFormDataCreateStatus();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results7"> <!-- TRES IMPORTANT -->



</div>
</div>
<?php
//FIn Création
}

}else if ($_GET['page']=='actualite'){

  if(isset($_GET['modifactus'])){


?>
<script>
function RetourIndex2(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=membre&table=membres"
}
</script>
    <script>


     function SubmitFormDataModifStatus() {
        var user_id = "<?php echo $_SESSION['admin_id']; ?>";
        var id = "<?php echo $id; ?>";
        var title = $("#title").val();
        var description = $("#description").val();
        var title2 = $("#title2").val();
        var description2 = $("#description2").val();
        var titre3 = $("#titre3").val();
        var description3 = $("#description3").val();
        var formatimg = $("#formatimg").val();
        $.post("ajax/modifypagestatus.php", { user_id:user_id, id:id, title: title, description: description, title2: title2, description2: description2, titre3: titre3, description3: description3, formatimg: formatimg},
        function(data) {
         $('#results11').html(data);

        });

    }

    </script>
    <?php
    $id = $_GET['modifactus'];

    $selectinfosactuel = $db->prepare("SELECT * from newsactus where id=:id");
    $selectinfosactuel->execute(array(
        "id"=>$id
        )
    );
    $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);

    $title = $r2->title;
    $description = $r2->description;
    $title2 = $r2->title2;
    $description2 = $r2->description2;
    $title3 = $r2->title3;
    $description3 = $r2->description3;
    $formatimg = $r2->formatimg;
?>
<script>
function RetourIndex4(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=actualite&table=newsactus"
}
</script>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification de l'actualitée</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Titre</label>
                                  <input type="text" class="form-control" value="<?php echo $title; ?>" name="title" id="title">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description</label>
                                  <input type="text" name="description" value="<?php echo $description; ?>"id="description" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre 2</label>
                                  <input type="text" name="titre2" value="<?php echo $titre2; ?>" id="titre2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description 2</label>
                                  <input type="text" name="description2" value="<?php echo $description2; ?>" id="description2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre 3</label>
                                  <input type="text" name="titre3" value="<?php echo $titre3; ?>" id="titre3" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description 3</label>
                                  <input type="text" name="description3" value="<?php echo $description3; ?>" id="description3" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Format Img</label>
                                  <input type="text" name="formatimg" value="<?php echo $formatimg; ?>" id="formatimg" class="form-control">
                              </div>

                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataModifStatus" onclick="SubmitFormDataModifStatus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                              <button onclick="RetourIndex4();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results11"> <!-- TRES IMPORTANT -->
    </div>
  </div>
  <?php




}else{

  //Page newsactus

?>
  <script>


   function SubmitFormDataModifActus() {
      var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var image = $("#image").val();
      var titre = $("#titre").val();
      var pagetitre = $("#pagetitre").val();
      var description = $("#description").val();
      $.post("ajax/modifypageactus.php", { user_id:user_id, image: image, titre: titre, pagetitre: pagetitre, description: description},
      function(data) {
       $('#results10').html(data);

      });

  }

  </script>
  <?php


  $selectinfosactuel9 = $db->prepare("SELECT * from photopage where nompage=:nompage");
  $selectinfosactuel9->execute(array(
      "nompage"=>'Actualité'
      )
  );
  $r9 = $selectinfosactuel9->fetch(PDO::FETCH_OBJ);

  $image = $r9->image;
  $pagetitre = $r9->pagetitre;
  $titre = $r9->titre;
  $description = $r9->description;

?>


  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification des informations de la page actualitée</h2>
                  <form action="" method="post" id="myForm1" class="contact-form">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">

                            <div class="form-group label-floating">
                                <label class="control-label">Titre de la page</label>
                                <input type="text" name="pagetitre" value="<?php echo $pagetitre; ?>" id="pagetitre" class="form-control">
                            </div>

                            <div class="form-group label-floating">
                                <label class="control-label">Image</label>
                                <input type="text" class="form-control" value="<?php echo $image; ?>" name="image" id="image">
                            </div>

                            <div class="form-group label-floating">
                                <label class="control-label">Titre</label>
                                <input type="text" name="titre" value="<?php echo $titre; ?>"id="titre" class="form-control">
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
                            <button id="SubmitFormDataModifActus" onclick="SubmitFormDataModifActus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                            <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                            </center>
                           </div>
                        </div>
                  </div>
                </form>
              </div>
          </div>
      </div>

   <div id="results10"> <!-- TRES IMPORTANT -->
  </div>
</div>
<?php














  //Fin page news actus
  function raccourcirChaine($chaine, $tailleMax)
  {
  // Variable locale
  $positionDernierEspace = 0;
  if( strlen($chaine) >= $tailleMax )
  {
  $chaine = substr($chaine,0,$tailleMax);
  $positionDernierEspace = strrpos($chaine,' ');
  $chaine = substr($chaine,0,$positionDernierEspace).'...';
  }
  return $chaine;
  }

      $selectnomactus = $db->prepare("SELECT * FROM newsactus ORDER BY id DESC");
      $selectnomactus->execute();


      $tableactus = $selectnomactus->fetchAll(PDO::FETCH_OBJ);
      if(count($tableactus)>0){

        echo "<h3>".count($tableactus)." actus trouvés</h3>";
        echo '
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Titre</th>
        <th scope="col">Description</th>
        <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>

        ';
        foreach($tableactus as $ligneactus){
          $id = $ligneactus->id;
          $title = $ligneactus->title;
          $description = $ligneactus->description;
          $status = $ligneactus->status;



$result = raccourcirChaine($description, 80);

          echo '

          <tr>
            <th scope="row">'.$title.'</th>
            <td>'.$result.'</td>
            <td>'.$status.'</td>
            <td>
            <a href="?page=actualite&amp;table=newsactus&amp;modifactus='.$id.'">
            <button type="button" class="btn">Modifier</button>
            </a>
            <a href="?page=actualite&amp;table=newsactus&amp;banactus='.$id.'">
            <button type="button" class="btn">Désactiver</button>
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
        $error = "Aucune actualitée trouvée";
      }


//Création membres

?>
<script>


function SubmitFormDataCreateStatus() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var article = $("#article").val();
   var titre = $("#titre").val();
   var soustitre = $("#soustitre").val();
   var description = $("#description").val();
   $.post("ajax/createpagestatus.php", { user_id:user_id, article: article, titre: titre, soustitre: soustitre, description: description},
   function(data) {
    $('#results7').html(data);

   });

}

</script>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Création d'un status</h2>
                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Article</label>
                              <input type="text" class="form-control" value="Numéro de l'article" name="article" id="article">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Titre</label>
                              <input type="text" name="titre" value="Titre du status" id="titre" class="form-control">
                          </div>



                        <div class="form-group label-floating">
                        <label class="control-label">Sous Titre</label>
                        <input type="text" name="soustitre" value="Sous titre" id="soustitre" class="form-control">
                        </div>


                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <input type="text" name="description" value="La description" id="description" class="form-control">
                          </div>
                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="SubmitFormDataCreateStatus" onclick="SubmitFormDataCreateStatus();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results7"> <!-- TRES IMPORTANT -->



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

    <a href="?page=actualite&amp;table=newsactus">
      <button type="button" class="btn">Page Actualitée</button>
    </a>

<?php

}
?>


  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

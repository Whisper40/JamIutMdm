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
  var lienimage = $("#lienimage").val();
  var lien = $("#lien").val();
  var description = $("#description").val();
  $.post("ajax/modifypagelien.php", { user_id: user_id, id: id, nom: nom, lienimage: lienimage, lien: lien, description: description},
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



  $selectinfosactuel2 = $db->prepare("SELECT * from photopage where nompage=:nompage");
  $selectinfosactuel2->execute(array(
    "nompage"=>'Liens Utiles'
  ));
  $r3 = $selectinfosactuel2->fetch(PDO::FETCH_OBJ);
  $pagetitre = $r3->pagetitre;
  $titre = $r3->titre;
  $image = $r3->image;
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



 function SubmitFormDataPageLiensUtiles2() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var id = "<?php echo $id; ?>";
    var titre = $("#titre").val();
    var pagetitre = $("#pagetitre").val();

    $.post("ajax/modifylienutiles.php", { user_id: user_id, id: id, titre: titre, pagetitre: pagetitre},
    function(data) {
     $('#results3').html(data);
    });
}


</script>

<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['envoieimagelienutiles'])){
      $target_dir = "../../../JamFichiers/Img/ImagesDuSite";

      $original = 'Original';
      if (file_exists($target_dir/$original)) {
        $target_dirnew = "$target_dir/$original/";
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
    $error = 'Désolé, le fichier existe déja.';
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $error = 'Désolé, le fichier est trop grand.';
    $uploadOk = 0;

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $error = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error = 'Désolé, une erreur est survenue.';
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $succes = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $status = '1';


        $update2 = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update2->execute(array(
            "nompage"=>'Liens Utiles',
            "image"=>$target_filefile
            )
        );
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page liens utiles',
                            "page"=>'lienutiles.php',
                            "date"=>$date
                            )
                        );

        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');

        $img_tmp = $target_dirnew.$target_filefile;
        $fin = $target_dirnewthumb.$target_filefile;


          //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
            $longueur = 300;
            $largeur = 220;
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













<div class="row">
  <div class="col-sm-6">
    <div class="card-content">
      <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
        <h3 class="card-title text-center">Image d'Arrière plan</h3>
        <br>
        <center>
          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail">
              <img src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $image; ?>" alt="...">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail"></div>
            <br><br>
            <div>
              <span class="btn btn-rose btn-round btn-file">
                <span class="fileinput-new">Selection image</span>
                <span class="fileinput-exists">Changer</span>
                <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple" />
              </span>
              <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
              <button type="submit" name="envoieimagelienutiles" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
            </div>
          </div>
        </center>
      </form>
    </div>
  </div>
<div class="col-sm-6">
  <div class="card-content">
    <form action="" method="post" id="myForm1" class="contact-form">
      <h3 class="card-title text-center">Titres de la page</h3>
      <br><br>
      <div class="form-group label-floating">
        <label class="control-label">Titre de la page</label>
        <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
      </div>
      <div class="form-group label-floating">
        <label class="control-label">Titre</label>
        <input type="text" class="form-control" value="<?php echo $titre; ?>" name="titre" id="titre">
      </div>
      <br>
      <center>
        <button id="submitFormDataPagelientutiles2" onclick="SubmitFormDataPageLiensUtiles2();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
      </center>
    </form>
  </div>
</div>
</div>













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

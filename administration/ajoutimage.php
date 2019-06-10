<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Ajout Image";
    $nomsouscat = "";
    require_once('includes/head.php');

//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";

function slugify($text){
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
    return $text;
}
?>



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

<?php
$messagenotif = "";

if(isset($_POST['catphotosubmit'])){
  $nomcategorieimage2 = $_POST['nomcategorieimage'];

  $nomcategorieimage=slugify($nomcategorieimage2);
  $nomicon = $_POST['nomicon'];

  if(!empty($nomcategorieimage2)){
    if(!empty($nomicon)){

  $checkcatimages = $db->prepare("SELECT title FROM images WHERE title = '$nomcategorieimage'");
  $checkcatimages->execute();
  $countcheckimages = $checkcatimages->rowCount();

  if (is_null($countcheckimages)){
    $countcheckimages = '0';
  }
//A REFAIRE
  if($countcheckimages == '0'){
      $target_dir = "../../../JamFichiers/Photos";
      $original = 'Original';
      if (file_exists($target_dir/$original/$nomcategorieimage)){
      }else{
        mkdir("$target_dir/$original/$nomcategorieimage", 0700);
      }



      date_default_timezone_set('Europe/Paris');
      setlocale(LC_TIME, 'fr_FR.utf8','fra');
      $date = strftime('%Y-%m-%d %H:%M:%S');
      $status = '1';

      $insertinfos = $db->prepare("INSERT INTO images (title, icon, uploaded_on, status) VALUES(:title, :icon, :date, :status)");
      $insertinfos->execute(array(
          "title"=>$nomcategorieimage,
          "icon"=>$nomicon,
          "date"=>$date,
          "status"=>$status
          )
      );

      $insertinfosvideo = $db->prepare("INSERT INTO videos (title, uploaded_on, status) VALUES(:title, :uploaded_on, :status)");
      $insertinfosvideo->execute(array(
          "title"=>$nomcategorieimage,
          "uploaded_on"=>$date,
          "status"=>$status
          )
      );

      $actif = $db->prepare("UPDATE images SET albumactif=:albumactif WHERE title=:nomcategorieimage");
      $actif->execute(array(
        "albumactif"=>'1',
        "nomcategorieimage"=>$nomcategorieimage
      ));

      $inactif = $db->prepare("UPDATE images SET albumactif=:albumactif WHERE title <> :nomcategorieimage");
      $inactif->execute(array(
        "albumactif"=>'0',
        "nomcategorieimage"=>$nomcategorieimage

      ));

      $messagenotif = 'Parfait, la catégorie à bien été crée';
      $type = "success";

 }else{
      $messagenotif = 'Désolé, la catégorie existe déja';
      $type = "warning";
    }
  }else{
      $messagenotif = 'Le champs est vide...';
      $type = "warning";
    }
  }else{
      $messagenotif = 'Le champs est vide...';
      $type = "warning";
    }

  }
?>


<?php


if(isset($_POST['videosubmit'])){
  $lienvideo = $_POST['lienvideo'];
  $catvideo = $_POST['catvideo'];
  if(!empty($lienvideo)&&!empty($catvideo)){

      $target_dir = "../../../JamFichiers/Photos";

      $original = 'Original';
      if (file_exists($target_dir/$original/$catvideo)){
        $target_dirnew = "$target_dir/$original/$catvideo/";
      }else{
        mkdir("$target_dir/$original/$catvideo", 0700);
        $target_dirnew = "$target_dir/$original/$catvideo/";
      }


$target_file = $target_dirnew . basename($_FILES["fileToUploadVideo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}

// Check file size < 2mo
if ($_FILES["fileToUploadVideo"]["size"] > 5000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "rar") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et GIF.';
    $type = "warning";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = "Désolé, votre fichier n\'a pas été uploadé";
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $target_filefile = rand(100, 10000).basename($_FILES["fileToUploadVideo"]["name"]);

  $target_file3 = $target_dirnew.$target_filefile;

    if (move_uploaded_file($_FILES["fileToUploadVideo"]["tmp_name"], $target_file3)) {

        $messagenotif = "Le fichier ". basename( $_FILES["fileToUploadVideo"]["name"]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');

        $insertinfos = $db->prepare("INSERT INTO videos (file_nameimage, file_namevideo, title, uploaded_on, status) VALUES(:file_nameimage, :file_namevideo, :title, :date, :status)");
        $insertinfos->execute(array(

            "file_nameimage"=>$target_filefile,
            "file_namevideo"=>$lienvideo,
            "title"=>$catvideo,
            "date"=>$date,
            "status"=>$status
            )
        );

  require('includes/miseajourdusite.php');
    }else {
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    }
  }}else{
    $messagenotif = 'Désolé, les champs sont vides';
    $type = "warning";
  }
}

 ?>
<script>

    Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

  // The configuration we've talked about above
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 100,
  maxFiles: 300,
  addRemoveLinks: true,
  maxFilesize: 5,
  acceptedFiles: ".jpeg,.jpg,.png",

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("button[name=submitimages]").addEventListener("click", function(e) {
      // Make sure that the form isn't actually being sent.
      e.preventDefault();
      e.stopPropagation();
      myDropzone.processQueue();
    });

    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
    // of the sending event because uploadMultiple is set to true.
    this.on("sendingmultiple", function() {
      // Gets triggered when the form is actually being sent.
      // Hide the success button or the complete form.
    });
    this.on("successmultiple", function(files, response) {
      // Gets triggered when the files have successfully been sent.
      // Redirect user or notify of success.
    });
    this.on("errormultiple", function(files, response) {
      // Gets triggered when there was an error sending the files.
      // Maybe show form again, and notify user of error
    });
  }

}



</script>


</script>
 <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
   <div class="wrapper">

    <?php
    require_once('includes/navbar.php');
    ?>

        <div class="content">
         <div class="container-fluid">
           <div class="card">
             <div class="card-content">
               <h2 class="card-title text-center">Ajouter des images et des vidéos à la galerie</h2>
               <br>
               <div class="row">
                 <div class="col-sm-12">
                   <div class="card-content">
                     <h3 class="card-title">Création de catégories</h3>
                   </div>
                 </div>
               </div>
               <div class="row">
                 <div class="col-md-12">
                   <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                     <div class="card-content">
                       <h3 class="card-title text-center">Catégorie d'images</h3>
                       <br>
                       <div class="form-group label-floating">
                           <label class="control-label">Nom de la catégorie</label>
                           <input type="text" class="form-control" name="nomcategorieimage">
                       </div>
                       <div class="form-group label-floating">
                           <label class="control-label">Nom de l'icon</label>
                           <input type="text" class="form-control" name="nomicon">
                       </div>

                       <center>
                         <button type="submit" name="catphotosubmit" class="btn btn-primary btn-round btn-rose">Créer une catégorie d'image</button>
                       </center>
                     </div>
                  </form>
                </div>
             </div>

             <div class="row">
               <div class="col-sm-12">
                 <div class="card-content">
                   <h3 class="card-title">Liste des icons pour les categorie d'image</h3>
                   <br><br>
                   <div class="iframe-container hidden-sm hidden-xs">
                       <iframe src="https://administration.jam-mdm.fr/icons.php"></iframe>
                   </div>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-sm-12">
                 <div class="card-content">
                   <h3 class="card-title">Ajout d'image et de vidéo</h3>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12">
                 <form action="ajax/addimage.php" id="myAwesomeDropzone" class="dropzone">
                   <div class="card-content">
                   <div class="jquerysel">
                     <select class="selectpicker" data-style="select-with-transition" title="Sélectionner de la catégorie" data-size="4" name="catimage">
                        <option disabled>Sélectionner de la catégorie</option>

                        <?php
                        $selectcatimages=$db->query("SELECT DISTINCT title FROM images");
                        while($s = $selectcatimages->fetch(PDO::FETCH_OBJ)){
                        $catimage=$s->title;
                        ?>
                        <option value="<?php echo $catimage;?>"><?php echo $catimage; ?></option>
                        <?php } ?>

                     </select>
                   </div>
                   <div class="dropzone-previews"></div>
                   <center>
                     <button type="submit" name="submitimages" class="btn btn-primary btn-round btn-rose">Ajouter les images</button>
                   </center>
                 </div>
                </form>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                  <div class="card-content">
                    <h3 class="card-title text-center">Ajouter des vidéos</h3>
                    <br>
                    <div class="jquerysel">
                      <select class="selectpicker" data-style="select-with-transition" title="Sélectionner de la catégorie" data-size="4" name="catvideo">
                         <option disabled>Sélectionner de la catégorie</option>
                         <?php
                         $selectcatvideos=$db->query("SELECT DISTINCT title FROM videos");
                         while($s = $selectcatvideos->fetch(PDO::FETCH_OBJ)){
                         $catvideo=$s->title;
                         ?>
                         <option value="<?php echo $catvideo;?>"><?php echo $catvideo; ?></option>
                         <?php } ?>

                      </select>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Lien vidéo</label>
                        <input type="text" class="form-control" name="lienvideo">
                    </div>
                    <div class="form-group form-file-upload">
                        <input type="file" id="fileToUploadVideo" name="fileToUploadVideo" multiple="multiple">
                        <div class="input-group">
                            <input type="text" readonly="" class="form-control" placeholder="Insérer la miniature de la vidéo">
                            <span class="input-group-btn input-group-s">
                                <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                    <i class="material-icons">layers</i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <center>
                      <button type="submit" name="videosubmit" class="btn btn-primary btn-round btn-rose">Ajouter la vidéo</button>
                    </center>
                  </div>
               </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</body>

  <?php
  require_once('includes/javascript.php');
  ?>

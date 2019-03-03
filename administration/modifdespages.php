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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
function RetourIndex(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php"
}
</script>


<script>
function insertAtCaret(areaId, text) {
var txtarea = document.getElementById(areaId);
if (!txtarea) {
return;
}
var scrollPos = txtarea.scrollTop;
var strPos = 0;
var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
"ff" : (document.selection ? "ie" : false));
if (br == "ie") {
txtarea.focus();
var range = document.selection.createRange();
range.moveStart('character', -txtarea.value.length);
strPos = range.text.length;
} else if (br == "ff") {
strPos = txtarea.selectionStart;
}
var front = (txtarea.value).substring(0, strPos);
var back = (txtarea.value).substring(strPos, txtarea.value.length);
txtarea.value = front + text + back;
strPos = strPos + text.length;
if (br == "ie") {
txtarea.focus();
var ieRange = document.selection.createRange();
ieRange.moveStart('character', -txtarea.value.length);
ieRange.moveStart('character', strPos);
ieRange.moveEnd('character', 0);
ieRange.select();
} else if (br == "ff") {
txtarea.selectionStart = strPos;
txtarea.selectionEnd = strPos;
txtarea.focus();
}
txtarea.scrollTop = scrollPos;
}
 </script>

    <?php
    if(isset($_GET['page'])){
      if($_GET['page']=='index'){
        $nomsouscat = "Index Site";
      }else if ($_GET['page']=='devenirmembre'){
        $nomsouscat = "Devenir Membre";
      }else if ($_GET['page']=='association'){
        $nomsouscat = "Présentation Association";
      }else if ($_GET['page']=='membre'){
        $nomsouscat = "Présentation Membre";
      }else if ($_GET['page']=='status'){
        $nomsouscat = "Les Status";
      }else if ($_GET['page']=='actualite'){
        $nomsouscat = "Actualités";
      }else if ($_GET['page']=='activitesvoyages'){
        $nomsouscat = "Activités / Voyage";
      }else if ($_GET['page']=='galerie'){
        $nomsouscat = "Galerie";
      }else if ($_GET['page']=='nouscontacter'){
        $nomsouscat = "Nous contacter";
      }else if ($_GET['page']=='faireundon'){
        $nomsouscat = "Faire un don";
      }else if ($_GET['page']=='lienutiles'){
        $nomsouscat = "Lien Utiles";
      }

      $messagenotif = "";


    if($_GET['page']=='index'){
      $table = $_GET['table'];

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
<script>
 function SubmitFormDataIndex() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var id = "<?php echo $id; ?>";
    var titre1 = $("#titre1").val();
    var description1 = $("#description1").val();
    var bouton1 = $("#bouton1").val();
    var lienbt1 = $("#lienbt1").val();
    var bouton2 = $("#bouton2").val();
    var lienbt2 = $("#lienbt2").val();
    var titre2 = $("#titre2").val();
    var description2 = $("#description2").val();
    var fb = $("#fb").val();
    $.post("ajax/modifypageindex.php", { user_id: user_id, id:id, titre1: titre1, description1: description1, bouton1: bouton1, lienbt1: lienbt1, bouton2: bouton2, lienbt2: lienbt2, titre2: titre2, description2: description2, fb: fb},
    function(data) {
     $('#results1').html(data);
    });
}
</script>

<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['envoieimagefond'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE pageindex SET img1=:img1");
        $update->execute(array(
            "img1"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification de l\'index',
                            "page"=>'index.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>



          <!-- Ajoutd'images au site web (assets)-->
          <?php
          if(isset($_POST['envoieimagecentrale'])){
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
              $messagenotif = 'Désolé, le fichier existe déja.';
              $uploadOk = 0;
          }
          // Check file size < 2mo
          if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
              $messagenotif = 'Désolé, le fichier est trop grand.';
              $type = "warning";
              $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
              $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
              $type = "warning";
              $uploadOk = 0;
          }
          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
              $messagenotif = 'Désolé, une erreur est survenue.';
              $type = "warning";
          // if everything is ok, try to upload file
          } else {
            date_default_timezone_set('Europe/Paris');
            setlocale(LC_TIME, 'fr_FR.utf8','fra');
            $date = strftime('%d:%m:%y %H:%M:%S');
            $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
            $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
            $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
                  $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
                  $type = "success";
                  $status = '1';
                  $update = $db->prepare("UPDATE pageindex SET logo1=:logo1");
                  $update->execute(array(
                      "logo1"=>$target_filefile
                      )
                  );
                  date_default_timezone_set('Europe/Paris');
                  setlocale(LC_TIME, 'fr_FR.utf8','fra');
                  $date = strftime('%d/%m/%Y %H:%M:%S');
                  $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                  $insertlogs->execute(array(
                                      "user_id"=>$user_id,
                                      "type"=>'Modification',
                                      "action"=>'Modification de l\'index',
                                      "page"=>'index.php',
                                      "date"=>$date
                                      )
                                  );
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
                  $messagenotif = 'Désolé, une erreur est survenue.';
                  $type = "warning";
              } } }
              require('includes/miseajourdusite.php');
                    } ?>



                    <!-- Ajoutd'images au site web (assets)-->
                    <?php
                    if(isset($_POST['envoieimagelogo2'])){
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
                        $messagenotif = 'Désolé, le fichier existe déja.';
                        $type = "warning";
                        $uploadOk = 0;
                    }
                    // Check file size < 2mo
                    if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
                        $messagenotif = 'Désolé, le fichier est trop grand.';
                        $type = "warning";
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
                        $type = "warning";
                        $uploadOk = 0;
                    }
                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        $messagenotif = 'Désolé, une erreur est survenue.';
                        $type = "warning";
                    // if everything is ok, try to upload file
                    } else {
                      date_default_timezone_set('Europe/Paris');
                      setlocale(LC_TIME, 'fr_FR.utf8','fra');
                      $date = strftime('%d:%m:%y %H:%M:%S');
                      $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
                      $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
                      $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
                            $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
                            $type = "success";
                            $status = '1';
                            $update = $db->prepare("UPDATE pageindex SET logo2=:logo2");
                            $update->execute(array(
                                "logo2"=>$target_filefile
                                )
                            );
                            date_default_timezone_set('Europe/Paris');
                            setlocale(LC_TIME, 'fr_FR.utf8','fra');
                            $date = strftime('%d/%m/%Y %H:%M:%S');
                            $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                            $insertlogs->execute(array(
                                                "user_id"=>$user_id,
                                                "type"=>'Modification',
                                                "action"=>'Modification de l\'index',
                                                "page"=>'index.php',
                                                "date"=>$date
                                                )
                                            );
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
                                    require('includes/miseajourdusite.php');
                                    ?>
                                    <script>
                                    window.location.replace("https://administration.jam-mdm.fr/modifdespages.php?page=index&table=pageindex&messagenotif=succes");
                                    </script>
                                    <?php
                        }else {
                            $messagenotif = 'Désolé, une erreur est survenue.';
                            $type = "warning";
                        } } }
                        require('includes/miseajourdusite.php');
                              } ?>


<body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
  <div class="wrapper">

   <?php
   require_once('includes/navbar.php');
   ?>

  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification de l'index du site</h2>
                  <div class="row">
                    <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">Images de la page</h3>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="card-content">
                        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                          <h3 class="card-title text-center">Arrière plan</h3>
                          <br>
                          <center>
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                              <div class="fileinput-new thumbnail">
                                <img src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $img1; ?>" alt="...">
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
                                <button type="submit" name="envoieimagefond" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
                              </div>
                            </div>
                          </center>
                        </form>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card-content">
                        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                          <h3 class="card-title text-center">Logo centrale</h3>
                          <br>
                          <center>
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                              <div class="fileinput-new thumbnail">
                                <img src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $logo1; ?>" alt="...">
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
                                <button type="submit" name="envoieimagecentrale" class="btn btn-primary btn-round btn-rose">Modifier le logo</button>
                              </div>
                            </div>
                          </center>
                        </form>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card-content">
                        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                          <h3 class="card-title text-center">Image Introduction</h3>
                          <br>
                          <center>
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                              <div class="fileinput-new thumbnail">
                                <img src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $logo2; ?>" alt="...">
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
                                <button type="submit" name="envoieimagelogo2" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
                              </div>
                            </div>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="card-content">
                            <h3 class="card-title">Corp de page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                            <label class="control-label">Description</label>
                            <textarea rows="12" name="description1" id="description1" class="form-control"><?php echo $description1; ?></textarea>
                          </div>



                          <center>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<br />');return false;">Saut de ligne </button>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<u>Texte souligné</u>');return false;">Souligner</button>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<strong>Texte en gras</strong>');return false;">Gras</button>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<i>Texte en Italic</i>');return false;">Italic</button>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                            <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>
                          </center>


                        </div>
                      </div>
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Titre Principal</label>
                                  <input type="text" name="titre1" value="<?php echo $titre1; ?>" id="titre1" class="form-control">
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
                           </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="card-content">
                            <h3 class="card-title">Pied de page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Description Secondaire</label>
                                <textarea rows="5" name="description2" id="description2" class="form-control"><?php echo $description2; ?></textarea>
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Titre Secondaire</label>
                                  <input type="text" name="titre2" value="<?php echo $titre2; ?>" id="titre2" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Lien Facebook</label>
                                  <input type="text" name="fb" value="<?php echo $fb; ?>" id="fb" class="form-control">
                              </div>
                           </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="card-content">
                            <center>
                            <button id="submitFormDataIndex" onclick="SubmitFormDataIndex();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
  <script>
   function SubmitFormDataDevenirMembre() {
      var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var id = "<?php echo $id; ?>";
      var introduction = $("#introduction").val();
      var etape1 = $("#etape1").val();
      var etape2 = $("#etape2").val();
      var etape3 = $("#etape3").val();
      $.post("ajax/modifypagedevenirmembre.php", { user_id: user_id, id:id, introduction: introduction, etape1: etape1, etape2: etape2, etape3: etape3},
      function(data) {
       $('#results2').html(data);
      });
  }
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
                    <h2 class="card-title text-center">Modification de la page devenir membre</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-content">
                                    <h3 class="card-title">Intruduction</h3>
                                    <br>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Introduction</label>
                                        <textarea rows="4" type="text" class="form-control" name="introduction" id="introduction"><?php echo $introduction; ?></textarea>
                                    </div>
                                    <h3 class="card-title">Les Etapes</h3>
                                    <br>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Etape 1</label>
                                        <textarea rows="4" type="text" name="etape1" id="etape1" class="form-control"><?php echo $etape1; ?></textarea>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Etape 2</label>
                                        <textarea rows="4" type="text" name="etape2" id="etape2" class="form-control"><?php echo $etape2; ?></textarea>
                                    </div>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Etape 3</label>
                                        <textarea rows="4" type="text" name="etape3" id="etape3" class="form-control"><?php echo $etape3; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-content">
                                    <center>
                                        <button id="submitFormDataDevenirMembre" onclick="SubmitFormDataDevenirMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="results2"></div>
    </div>

<?php
}else if ($_GET['page']=='association'){
  $table = $_GET['table'];
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

  <script>
   function SubmitFormDataPageAsso() {
      var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var id = "<?php echo $id; ?>";
      var description1 = $("#description1").val();
      var description2 = $("#description2").val();
      $.post("ajax/modifypageassociation.php", { user_id: user_id, id: id, description1: description1, description2: description2},
      function(data) {
       $('#results3').html(data);
      });
  }
  </script>

  <script>
   function SubmitFormDataPageAsso2() {
      var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var id = "<?php echo $id; ?>";
      var titre1 = $("#titre1").val();
      var pagetitre = $("#pagetitre").val();
      $.post("ajax/modifypageassociation2.php", { user_id: user_id, id: id, titre1: titre1, pagetitre: pagetitre},
      function(data) {
       $('#results3').html(data);
      });
  }
  </script>

            <!-- Ajoutd'images au site web (assets)-->
            <?php
            if(isset($_POST['envoieimageprezasso'])){
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
                $messagenotif = 'Désolé, le fichier existe déja.';
                $type = "warning";
                $uploadOk = 0;
            }
            // Check file size < 2mo
            if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
                $messagenotif = 'Désolé, le fichier est trop grand.';
                $type = "warning";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
                $type = "warning";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $messagenotif = 'Désolé, une erreur est survenue.';
                $type = "warning";
            // if everything is ok, try to upload file
            } else {
              date_default_timezone_set('Europe/Paris');
              setlocale(LC_TIME, 'fr_FR.utf8','fra');
              $date = strftime('%d:%m:%y %H:%M:%S');
              $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
              $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
              $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
                    $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
                    $type = "success";
                    $status = '1';
                    $update2 = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
                    $update2->execute(array(
                        "nompage"=>'Présentation association',
                        "image"=>$target_filefile
                        )
                    );
                    date_default_timezone_set('Europe/Paris');
                    setlocale(LC_TIME, 'fr_FR.utf8','fra');
                    $date = strftime('%d/%m/%Y %H:%M:%S');
                    $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                    $insertlogs->execute(array(
                                        "user_id"=>$user_id,
                                        "type"=>'Modification',
                                        "action"=>'Modification page association',
                                        "page"=>'association.php',
                                        "date"=>$date
                                        )
                                    );
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
                    $messagenotif = 'Désolé, une erreur est survenue.';
                    $type = "warning";
                } } }
                require('includes/miseajourdusite.php');
                      } ?>

                      <!-- Ajoutd'images au site web (assets)-->
                      <?php
                      if(isset($_POST['envoieimageprezassocarousel'])){
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
                          $messagenotif = 'Désolé, le fichier existe déja.';
                          $type = "warning";
                          $uploadOk = 0;
                      }
                      // Check file size < 2mo
                      if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
                          $messagenotif = 'Désolé, le fichier est trop grand.';
                          $type = "warning";
                          $uploadOk = 0;
                      }
                      // Allow certain file formats
                      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                          $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
                          $type = "warning";
                          $uploadOk = 0;
                      }
                      // Check if $uploadOk is set to 0 by an error
                      if ($uploadOk == 0) {
                          $messagenotif = 'Désolé, une erreur est survenue.';
                          $type = "warning";
                      // if everything is ok, try to upload file
                      } else {
                        date_default_timezone_set('Europe/Paris');
                        setlocale(LC_TIME, 'fr_FR.utf8','fra');
                        $date = strftime('%d:%m:%y %H:%M:%S');
                        $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
                        $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
                        $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
                          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
                              $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
                              $type = "success";
                              $status = '1';
                              $update2 = $db->prepare("INSERT INTO carousel (slug, image, titreimage) VALUES(:pagetitre, :image, :titreimage)");
                              $update2->execute(array(
                                  "pagetitre"=>"Présentation association",
                                  "image"=>$target_filefile,
                                  "titreimage"=>"Association"
                                  )
                              );
                              date_default_timezone_set('Europe/Paris');
                              setlocale(LC_TIME, 'fr_FR.utf8','fra');
                              $date = strftime('%d/%m/%Y %H:%M:%S');
                              $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                              $insertlogs->execute(array(
                                                  "user_id"=>$user_id,
                                                  "type"=>'Modification',
                                                  "action"=>'Modification page association',
                                                  "page"=>'association.php',
                                                  "date"=>$date
                                                  )
                                              );
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
                              $messagenotif = 'Désolé, une erreur est survenue.';
                              $type = "warning";
                          } } }
                          require('includes/miseajourdusite.php');
                                } ?>

                              <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
                                <div class="wrapper">

                                 <?php
                                 require_once('includes/navbar.php');
                                 ?>

                                <div class="content">
                                  <div class="container-fluid">
                                    <div class="card">
                                      <div class="card-content">
                                        <h2 class="card-title text-center">Modification page présentation association</h2>
                                          <div class="row">
                                            <div class="col-sm-12">
                                              <div class="card-content">
                                                <h3 class="card-title">En-tête de page</h3>
                                              </div>
                                            </div>
                                          </div>
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
                                                        <button type="submit" name="envoieimageprezasso" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                                                  <input type="text" class="form-control" value="<?php echo $titre1; ?>" name="titre1" id="titre1">
                                                </div>
                                                <br>
                                                <center>
                                                  <button id="submitFormDataPageAsso2" onclick="SubmitFormDataPageAsso2();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                                </center>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        <div id="results10"></div>
                                        <div class="row">
                                          <div class="col-sm-12">
                                            <div class="card-content">
                                              <h3 class="card-title">Corps de page</h3>
                                            </div>
                                          </div>
                                        </div>
                                        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <div class="card-content">
                                              <div class="form-group label-floating">
                                                <label class="control-label">Description</label>
                                                <textarea rows="12" type="text" name="description1" id="description1" class="form-control"><?php echo $description1; ?></textarea>
                                              </div>
                                            </div>
                                            <center>

                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<br />');return false;">Saut de ligne </button>
                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<u>Texte souligné</u>');return false;">Souligner</button>
                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<strong>Texte en gras</strong>');return false;">Gras</button>
                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<i>Texte en Italic</i>');return false;">Italic</button>
                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                                                <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description1', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>

                                            </center>
                                          </div>
                                        <div class="col-sm-6">
                                          <div class="card-content">
                                            <div class="form-group label-floating">
                                              <label class="control-label">Description</label>
                                              <textarea rows="12" type="text" name="description2" id="description2" class="form-control"><?php echo $description2; ?></textarea>
                                            </div>
                                          </div>
                                          <center>
                                            <center>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<br />');return false;">Saut de ligne </button>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<u>Texte souligné</u>');return false;">Souligner</button>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<strong>Texte en gras</strong>');return false;">Gras</button>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<i>Texte en Italic</i>');return false;">Italic</button>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                                              <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>
                                            </center>
                                          </center>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <div class="card-content">
                                            <center>
                                              <button id="submitFormDataPageAsso" onclick="SubmitFormDataPageAsso();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                            </center>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <div class="card-content">
                                          <h3 class="card-title">Ajouter des photos au Carousel</h3>
                                        </div>
                                      </div>
                                    </div>
                                    <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                      <div class="row">
                                        <div class="col-sm-9">
                                          <div class="card-content">
                                            <div class="form-group form-file-upload">
                                              <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                              <div class="input-group">
                                                <input type="text" readonly="" class="form-control" placeholder="Sélectionner les images à importer">
                                                <span class="input-group-btn input-group-s">
                                                  <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                    <i class="material-icons">layers</i>
                                                  </button>
                                                </span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                          <div class="card-content">
                                            <center>
                                              <button type="submit" name="envoieimageprezassocarousel" class="btn btn-primary btn-round btn-rose">Envoyer les images</button>
                                            </center>
                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                    <div id="results3"></div>

    <script>
    $(document).ready(function(){
    var $recherche =$('input[name=valeur]');
    var critere;
    $recherche.keyup(function(){
    critere = $.trim($recherche.val());
    if(critere!=''){
      $.get('gestionrechercheimagecarouselpageasso.php?critere='+critere,function(retour){
    $('#resultat').html(retour).fadeIn();
    });
    }else $('#resultat').empty().fadeOut();
    });
    });
    </script>


    <?php
    if(isset($_GET['action'])){
    if($_GET['action']=='delete'){
    $id=$_GET['id'];
    $selectnom = $db->query("SELECT * FROM carousel WHERE id='$id'");
    $rname = $selectnom->fetch(PDO::FETCH_OBJ);
    $valnom = $rname->image;
    $target_dir = '../../../JamFichiers/Img/ImagesDuSite/Original';
    $target_dirthumb = '../../../JamFichiers/Img/ImagesDuSite/Thumb';
    if (file_exists($target_dir)){
    unlink("$target_dir/$valnom");
    $updatedelete = $db->prepare("DELETE FROM carousel WHERE image=:image");
    $updatedelete->execute(array(
      "image"=>$valnom
    ));
    unlink("$target_dirthumb/$valnom");
    $messagenotif = "Le fichier.$valnom. à bien été supprimé";
    $type = "success";
    }else{
    $messagenotif = 'Un problème de répertoire est présent, contacter votre administrateur !';
    $type = "warning";
    }
    ?>
    <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=association&table=pageasso"</script>
    <?php
    }
    }
    ?>

                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="card-content">
                                        <h3 class="card-title">Supprimer des photos du Carousel</h3>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                      <div class="card-content">
                                        <input type="text" class="form-control" name="valeur" placeholder="Saisir nom ou la catégorie de la photo à supprimer">
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="card-content">
                                        <p id='resultat'></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
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
<script>
 function SubmitFormDataModifMembre() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var id = "<?php echo $id; ?>";
    var nom = $("#nom").val();
    var description = $("#description").val();
    var grademembre = $('#grademembre').val();
    var importancegrade = $('#importancegrade').val();
    var fonction = $("#fonction").val();
    $.post("ajax/modifypagemodifmembre.php", { user_id: user_id, id: id, nom: nom, description: description, grademembre: grademembre, importancegrade: importancegrade, fonction: fonction},
    function(data) {
     $('#results4').html(data);
    });
}
</script>

<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifphotomembre'])){
      $target_dir = "../../../JamFichiers/Img/Membres";
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $idmembre = $_GET['modifmembre'];
        $update = $db->prepare("UPDATE membres SET image=:image WHERE id=:id");
        $update->execute(array(
            "id"=>$id,
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page membre',
                            "page"=>'membre.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>

<body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
  <div class="wrapper">

   <?php
   require_once('includes/navbar.php');
   ?>

  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-content">
          <h2 class="card-title text-center">Modification des informations d'un membre</h2>
          <br><br>
          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-5">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Prénom et Nom</label>
                      <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom" id="nom">
                    </div>
                    <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="6" type="text" name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card-content">
                    <br>
                    <div class="jquerysel">
                      <select class="selectpicker" data-style="select-with-transition" title="Fonction" data-size="7" id="grademembre" name="grademembre">
                        <?php if ($categorie == 'pres'){ ?>
                        <option selected value="pres">Président</option>
                        <?php  }else{ ?>
                        <option value="pres">Président</option>
                        <?php } if ($categorie == 'tres'){ ?>
                        <option selected value="tres">Trésorier</option>
                        <?php }else{ ?>
                        <option value="tres">Trésorier</option>
                        <?php } if ($categorie == 'secr'){ ?>
                        <option selected value="secr">Secrétaire</option>
                        <?php }else{ ?>
                        <option value="secr">Secrétaire</option>
                        <?php } if ($categorie == 'com'){ ?>
                        <option selected value="com">Communication</option>
                        <?php }else{ ?>
                        <option value="com">Communication</option>
                        <?php } ?>
                      </select>
                    </div>
                    <br>
                    <div class="jquerysel">
                      <select class="selectpicker" data-style="select-with-transition" title="Grade" data-size="7" id="importancegrade" name="importancegrade">
                        <?php if ($importance == '1'){ ?>
                        <option selected value="1">Responsable</option>
                        <?php }else{ ?>
                        <option value="1">Responsable</option>
                        <?php } if ($importance == '2'){ ?>
                        <option selected value="2">Vice</option>
                        <?php }else{ ?>
                        <option value="2">Vice</option>
                        <?php } if ($importance == '3'){ ?>
                        <option selected value="3">Honneur</option>
                        <?php }else{ ?>
                        <option value="3">Honneur</option>
                        <?php } ?>
                      </select>
                    </div>
                    <br>
                    <div class="form-group label-floating">
                      <label class="control-label">Nom complet de la Fonction</label>
                      <input type="text" name="fonction" value="<?php echo $fonction; ?>" id="fonction" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="card-content">
                    <br><br>
                    <center>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-circle">
                        <img src="https://jam-mdm.fr/JamFichiers/Img/Membres/Original/<?php echo $image; ?>" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                      <div>
                        <span class="btn btn-round btn-rose btn-file">
                          <span class="fileinput-new">Selection Image</span>
                          <span class="fileinput-exists">Changer</span>
                          <input  type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple" />
                        </span>
                        <br>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                      </div>
                    </div>
                  </center>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <center>
                      <button id="submitFormDataModifMembre" onclick="SubmitFormDataModifMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                      <button onclick="RetourIndex2()();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                    </center>
                    <br>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div id="results4"></div>
      </div>
    </div>
  </div>

  <?php
}else if(isset($_GET['deletemembre'])){
  $user_id = $_GET['deletemembre'];
  $selectinfosactuel = $db->prepare("SELECT * from membres where id=:user_id");
  $selectinfosactuel->execute(array(
      "user_id"=>$user_id
      )
  );
  $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
  $valnom = $r2->image;
  $target_dir = '../../../JamFichiers/Img/Membres/Original';
  $target_dirthumb = '../../../JamFichiers/Img/Membres/Thumb';
  if (file_exists($target_dir)){
  unlink("$target_dir/$valnom");
  unlink("$target_dirthumb/$valnom");
  $updatedelete = $db->prepare("DELETE FROM membres WHERE id=:user_id");
  $updatedelete->execute(array(
    "user_id"=>$user_id
  ));
  $messagenotif = "Le fichier.$valnom. à bien été supprimé";
  $type = "success";
  require('includes/miseajourdusite.php');
?>
  <script>
    window.location="https://administration.jam-mdm.fr/modifdespages.php?page=membre&table=membres"
  </script>
<?php
  }else{
  $messagenotif = 'Un problème de répertoire est présent, contacter votre administrateur !';
  $type = "warning";
  }
}else{
//modif page membre
?>




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

 <script>
  function SubmitFormDataMembre() {
     var user_id = "<?php echo $_SESSION['admin_id']; ?>";
     var pagetitre = $('#pagetitre').val();
     var titre = $("#titre").val();
     $.post("ajax/modifypagemembre.php", { user_id: user_id, pagetitre: pagetitre, titre: titre},
     function(data) {
      $('#results10').html(data);
     });
 }
 </script>



 <!-- Ajoutd'images au site web (assets)-->
 <?php
 if(isset($_POST['envoieimagemembre'])){
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
     $messagenotif = 'Désolé, le fichier existe déja.';
     $type = "warning";
     $uploadOk = 0;
 }
 // Check file size < 2mo
 if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
     $messagenotif = 'Désolé, le fichier est trop grand.';
     $type = "warning";
     $uploadOk = 0;
 }
 // Allow certain file formats
 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
     $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
     $type = "warning";
     $uploadOk = 0;
 }
 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
     $messagenotif = 'Désolé, une erreur est survenue.';
     $type = "warning";
 // if everything is ok, try to upload file
 } else {
   date_default_timezone_set('Europe/Paris');
   setlocale(LC_TIME, 'fr_FR.utf8','fra');
   $date = strftime('%d:%m:%y %H:%M:%S');
   $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
   $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
   $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
         $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
         $type = "success";
         $status = '1';
         $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
         $update->execute(array(
             "nompage"=>'Présentation des membres',
             "image"=>$target_filefile
             )
         );
         date_default_timezone_set('Europe/Paris');
         setlocale(LC_TIME, 'fr_FR.utf8','fra');
         $date = strftime('%d/%m/%Y %H:%M:%S');
         $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
         $insertlogs->execute(array(
                             "user_id"=>$user_id,
                             "type"=>'Modification',
                             "action"=>'Modification page membre',
                             "page"=>'membre.php',
                             "date"=>$date
                             )
                         );
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
         $messagenotif = 'Désolé, une erreur est survenue.';
         $type = "warning";
     } } }
     require('includes/miseajourdusite.php');
           } ?>

<body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
 <div class="wrapper">

  <?php
  require_once('includes/navbar.php');
  ?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-content">
        <h2 class="card-title text-center">Modification page présentation membres</h2>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">En-tête de page</h3>
              </div>
            </div>
          </div>
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
                        <button type="submit" name="envoieimagemembre" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                  <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
                </div>
                <br>
                <center>
                  <button id="submitFormDataMembre" onclick="SubmitFormDataMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                </center>
              </form>
            </div>
          </div>
        </div>
        <div id="results10"></div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card-content">
              <h3 class="card-title">Liste des Membres du Bureau</h3>
            </div>
          </div>
        </div>








<?php
      $selectnom = $db->prepare("SELECT id, image, nom, categorie, importance, fonction, description FROM membres ORDER BY categorie DESC, importance");
      $selectnom->execute();
      $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
      if(count($table)>0){
      echo '
     <div class="table-responsive">
       <table class="table">
         <thead class="text-primary">
           <th class="text-center">Nom</th>
           <th class="text-center">Image</th>
           <th class="text-center">Fonction</th>
           <th class="text-center">Action</th>
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
            <td class="text-center">'.$nom.'</td>
            <td class="text-center">'.$image.'</td>
            <td class="text-center">'.$fonction.'</td>
            <td class="text-center">
              <a href="?page=membre&amp;table=membres&amp;modifmembre='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Modifier</button></a>
              <a href="?page=membre&amp;table=membres&amp;deletemembre='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a>
            </td>
          </tr>
          ';
        }
        echo'
        </tbody>
      </table>
    </div>
    ';
      }else{ ?>

        <center>
            <h4 class="info-title"><font color="red">Aucune personne trouvée</font></h4>
        </center>

      <?php } ?>

<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <h3 class="card-title">Création d'un membre</h3>
    </div>
  </div>
</div>


<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['submitnewmembre'])){
      $target_dir = "../../../JamFichiers/Img/Membres";
      $nom = $_POST['nom'];
      $description = $_POST['description'];
      $grademembre = $_POST['grademembre'];
      $importancegrade = $_POST['importancegrade'];
      $fonction = $_POST['fonction'];
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $insert = $db->prepare("INSERT INTO membres (nom, image, description, categorie, importance, fonction) VALUES (:nom, :image, :description, :grademembre, :importancegrade, :fonction)");
        $insert->execute(array(
            "nom"=>$nom,
            "image"=>$target_filefile,
            "description"=>$description,
            "grademembre"=>$grademembre,
            "importancegrade"=>$importancegrade,
            "fonction"=>$fonction
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Ajout',
                            "action"=>'Ajout de membres',
                            "page"=>'membre.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>

              <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-5">
                      <div class="card-content">
                        <div class="form-group label-floating">
                          <label class="control-label">Prénom et Nom</label>
                          <input type="text" class="form-control" name="nom" id="nom">
                        </div>
                        <div class="form-group label-floating">
                          <label class="control-label">Description</label>
                          <textarea rows="6" type="text" name="description" value="Description du Membre" id="description" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card-content">
                        <br>
                        <div class="jquerysel">
                          <select class="selectpicker" data-style="select-with-transition" title="Fonction" data-size="7" id="grademembre" name="grademembre">
                            <option value="pres">Présidence</option>
                            <option value="tres">Secrétaire</option>
                            <option value="secr">Trésorier</option>
                            <option value="com">Communication</option>
                          </select>
                        </div>
                        <br>
                        <div class="jquerysel">
                          <select class="selectpicker" data-style="select-with-transition" title="Grade" data-size="7" id="importancegrade" name="importancegrade">
                            <option value="1">Responsable</option>
                            <option value="2">Vice</option>
                            <option value="3">Honneur</option>
                          </select>
                        </div>
                        <br>
                        <div class="form-group label-floating">
                          <label class="control-label">Nom complet de la Fonction</label>
                          <input type="text" name="fonction" id="fonction" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="card-content">
                        <br><br>
                        <center>
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail img-circle">
                            <img src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/placeholder.jpg" alt="...">
                          </div>
                          <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                          <div>
                            <span class="btn btn-round btn-rose btn-file">
                              <span class="fileinput-new">Selection Image</span>
                              <span class="fileinput-exists">Changer</span>
                              <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple" />
                            </span>
                            <br>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                          </div>
                        </div>
                      </center>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">
                        <center>
                          <button type="submit" name="submitnewmembre" class="btn btn-primary btn-round btn-rose">Créer un membre</button>
                        </center>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
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
    $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " existe déja !";
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " est trop grand ! (max=3Mo)";
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, JPEG et PNG';
    $type = "warning";
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
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé";
        $type = "success";
        $status = '1';
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          }
}
}else if ($_GET['page']=='status'){
  if(isset($_GET['modifstatus'])){
?>
<script>
function RetourIndex2(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=membre&table=membres"
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
<script>
 function SubmitFormDataModifStatus() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var id = "<?php echo $id; ?>";
    var article = $("#article").val();
    var titre = $("#titre").val();
    var soustitre = $("#soustitre").val();
    var description = $("#description").val();
    $.post("ajax/modifypagestatus.php", { user_id: user_id, id: id, article: article, titre: titre, soustitre: soustitre, description: description},
    function(data) {
     $('#results6').html(data);
    });
}
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
          <h2 class="card-title text-center">Modification d'un statuts</h2>
          <br><br>
            <form action="" method="post" id="myForm1" class="contact-form">
              <div class="row">
                  <div class="col-sm-6">
                    <div class="card-content">
                      <div class="form-group label-floating">
                        <label class="control-label">Numéro de l'Article</label>
                        <input type="text" class="form-control" value="<?php echo $article; ?>" name="article" id="article">
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Titre</label>
                        <input type="text" name="titrestatus" value="<?php echo $titre; ?>" id="titre" class="form-control">
                      </div>
                      <div class="form-group label-floating">
                        <label class="control-label">Sous Titre (Optionel)</label>
                        <input type="text" name="soustitre" value="<?php echo $soustitre; ?>" id="soustitre" class="form-control">
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
                        <button id="submitFormDataModifStatus" onclick="SubmitFormDataModifStatus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                        <button onclick="RetourIndex3();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
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
$selectinfosactuel40 = $db->prepare("SELECT * from photopage where nompage=:nompage");
$selectinfosactuel40->execute(array(
  "nompage"=>'Statuts'
));
$r40 = $selectinfosactuel40->fetch(PDO::FETCH_OBJ);
$pagetitre = $r40->pagetitre;
$image = $r40->image;
$titre = $r40->titre;
 ?>
 <script>
 function SubmitFormDataStatusPage() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var pagetitre = $("#pagetitre").val();
    var titre = $("#titre").val();
    $.post("ajax/modifypagestatusinfos.php", { user_id: user_id, pagetitre: pagetitre, titre: titre},
    function(data) {
     $('#results23').html(data);
    });
 }
 </script>
 <!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifphotopagestatus'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Statuts',
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page status',
                            "page"=>'statuts.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          }
          if(isset($_GET['deletestatus'])){
            $id = $_GET['deletestatus'];
            $updatedelete = $db->prepare("DELETE FROM status WHERE id=:id");
            $updatedelete->execute(array(
              "id"=>$id
            ));
            $messagenotif = "Le status à bien été supprimé";
            $type = "success";
          ?>
            <script>
              window.location="https://administration.jam-mdm.fr/modifdespages.php?page=status&table=status"
            </script>
          <?php
}
          ?>

        <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
          <div class="wrapper">

           <?php
           require_once('includes/navbar.php');
           ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Modification page statuts</h2>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">En-tête de page</h3>
                        </div>
                      </div>
                    </div>
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
                                  <button type="submit" name="modifphotopagestatus" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                            <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
                          </div>
                          <br>
                          <center>
                            <button id="submitFormDataStatusPage" onclick="SubmitFormDataStatusPage();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="results23"></div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">
                        <h3 class="card-title">Liste des statuts</h3>
                      </div>
                    </div>
                  </div>

  <?php
      $selectnom = $db->prepare("SELECT * FROM status ORDER BY article ASC");
      $selectnom->execute();
      $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
      if(count($table)>0){
        echo '
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th class="text-center">Article</th>
              <th class="text-left">Titre</th>
              <th class="text-left">Sous titre</th>
              <th class="text-center">Action</th>
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
            <td class="text-center">'.$article.'</td>
            <td class="text-left">'.$titre.'</td>
            <td class="text-left">'.$soustitre.'</td>
            <td class="text-center">
              <a href="?page=status&amp;table=status&amp;modifstatus='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Modifier</button></a>
              <a href="?page=status&amp;table=status&amp;deletestatus='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a>
            </td>
          </tr>
          ';
        }
        echo '
        </tbody>
      </table>
    </div>
        ';

      }else{ ?>

        <center>
            <h4 class="info-title"><font color="red">Aucun status trouvé</font></h4>
        </center>

      <?php } ?>

    <div class="row">
      <div class="col-sm-12">
        <div class="card-content">
          <h3 class="card-title">Création d'un statuts</h3>
        </div>
      </div>
    </div>

<script>
function SubmitFormDataCreateStatus() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var article = $("#article").val();
   var titrestatus = $("#titrestatus").val();
   var soustitre = $("#soustitre").val();
   var description = $("#description").val();
   $.post("ajax/createpagestatus.php", { user_id: user_id, article: article, titrestatus: titrestatus, soustitre: soustitre, description: description},
   function(data) {
    $('#results7').html(data);
   });
}
</script>

          <form action="" method="post" id="myForm1" class="contact-form">
            <div class="row">
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Numéro de l'Article</label>
                      <input type="text" class="form-control" name="article" id="article">
                    </div>
                    <div class="form-group label-floating">
                      <label class="control-label">Titre</label>
                      <input type="text" name="titrestatus" id="titrestatus" class="form-control">
                    </div>
                    <div class="form-group label-floating">
                      <label class="control-label">Sous Titre (Optionel)</label>
                      <input type="text" name="soustitre" id="soustitre" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="9" type="text" name="description" value="Description du Status" id="description" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <center>
                      <button id="submitFormDataCreateStatus" onclick="SubmitFormDataCreateStatus();" class="btn btn-primary btn-round btn-rose">Créer un statuts</button>
                    </center>
                  </div>
                </div>
              </div>
            </form>
          <div id="results7"></div>
          </div>
        </div>
      </div>
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
<script>
 function SubmitFormDataModifActualite() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var id = "<?php echo $id; ?>";
    var title = $("#title").val();
    var description = $("#description").val();
    var title2 = $("#title2").val();
    var description2 = $("#description2").val();
    var title3 = $("#title3").val();
    var description3 = $("#description3").val();
    var formatimg = $("#formatimg").val();
    $.post("ajax/modifyallactualite.php", { user_id: user_id, id: id, title: title, description: description, title2: title2, description2: description2, title3: title3, description3: description3, formatimg: formatimg},
    function(data) {
     $('#results11').html(data);
    });
}
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
        <h2 class="card-title text-center">Modification d'une actualités</h2>
          <form action="" method="post" id="myForm1" class="contact-form">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Présentation Principal</h3>
                  <div class="form-group label-floating">
                      <label class="control-label">Titre</label>
                      <input type="text" class="form-control" value="<?php echo $title; ?>" name="title" id="title">
                  </div>
                  <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="5" name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                  </div>
                  <center>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<br />');return false;">Saut de ligne </button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<u>Texte souligné</u>');return false;">Souligner</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<strong>Texte en gras</strong>');return false;">Gras</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<i>Texte en Italic</i>');return false;">Italic</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>
                  </center>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Présentation Secondaire</h3>
                  <div class="form-group label-floating">
                      <label class="control-label">Titre 2</label>
                      <input type="text" name="title2" value="<?php echo $title2; ?>" id="title2" class="form-control">
                  </div>
                  <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="5" name="description2" id="description2" class="form-control"><?php echo $description2; ?></textarea>
                  </div>
                  <center>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<br />');return false;">Saut de ligne </button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<u>Texte souligné</u>');return false;">Souligner</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<strong>Texte en gras</strong>');return false;">Gras</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<i>Texte en Italic</i>');return false;">Italic</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description2', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>
                  </center>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Présentation Tertiaire</h3>
                  <div class="form-group label-floating">
                      <label class="control-label">Titre 3</label>
                      <input type="text" name="title3" value="<?php echo $title3; ?>" id="title3" class="form-control">
                  </div>
                  <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="5" name="description3" id="description3" class="form-control"><?php echo $description3; ?></textarea>
                  </div>
                  <center>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<br />');return false;">Saut de ligne </button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<u>Texte souligné</u>');return false;">Souligner</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<strong>Texte en gras</strong>');return false;">Gras</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<i>Texte en Italic</i>');return false;">Italic</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                    <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>
                  </center>
                  <br>
                  <center>
                      <button id="submitFormDataModifActualite" onclick="SubmitFormDataModifActualite();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                      <button onclick="RetourIndex4();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                  </center>
                </div>
              </div>
            </div>
          </form>
          <div id="results11"></div>


<!-- AJOUT KEVIN POUR MODIF PAUL -->


<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['submitphotoactualite'])){
  $category = $_POST['catactualite'];
  $souscategory = $_POST['souscatactualite'];
  $titreimage = $_POST['titreimage'];
  if(!isset($titreimage)){
    $uploadOk = 0;
  }
  $selectinfosactuel12 = $db->prepare("SELECT slug from newsactus where id=:id");
  $selectinfosactuel12->execute(array(
      "id"=>$category
      )
  );
  $r12 = $selectinfosactuel12->fetch(PDO::FETCH_OBJ);
  $slug = $r12->slug;
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $insert = $db->prepare("INSERT INTO carousel (slug, titre, image, titreimage) VALUES (:slug, :souscatactualite, :target_filefile, :titreimage)");
        $insert->execute(array(
            "slug"=>$slug,
            "souscatactualite"=>$souscategory,
            "target_filefile"=>$target_filefile,
            "titreimage"=>$titreimage
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Ajout',
                            "action"=>'Ajout d\'images aux actualités',
                            "page"=>'actualitees.php',
                            "date"=>$date
                            )
                        );
        $status = '1';
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>








<!-- TEST -->

<h1>Selectionner la catégorie à laquelle ajouter les photos</h1>


<?php
$selectcatimages=$db->query("SELECT * FROM newsactus");
 ?>

        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            Sélectionner la catégorie d'actualité
            <select name="catactualite" class="catactualite">
              <option value="0">Selectionner la catégorie</option>
              <?php
                while($s = $selectcatimages->fetch(PDO::FETCH_OBJ)){
                  $title = $s->title;
                  $id = $s->id;
                  echo '<option value="'.$id.'">'.$title.'</option>';
            }
            ?>
          </select></br>
            Sous Catégorie :
            <select name="souscatactualite" class="souscatactualite">
<option>Sélectionner la sous catégorie</option>
</select>

            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons users_circle-08"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Indiquez un nom commun à ces images"  name="titreimage">
            </div>

            <div class="form-group form-file-upload">
                <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                <div class="input-group">
                    <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                    <span class="input-group-btn input-group-s">
                        <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                            <i class="material-icons">layers</i>
                        </button>
                    </span>
                </div>
            </div>

            <input type="submit" name="submitphotoactualite" value="Envoyer les images !">
        </form>



        <!-- TEST -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function()
        {
        $(".catactualite").change(function()
        {
        var id=$(this).val();
        var post_id = 'id='+ id;
        $.ajax
        ({
        type: "POST",
        url: "rechercheactuspourcarrousel.php",
        data: post_id,
        cache: false,
        success: function(cities)
        {
        $(".souscatactualite").html(cities);
        }
        });
        });
        });
        </script>

        <script>
        $(document).ready(function(){
        var $recherche =$('input[name=valeur]');
        var critere;
        $recherche.keyup(function(){
          critere = $.trim($recherche.val());
          if(critere!=''){
            $.get('gestionrechercheimageactualite.php?critere='+critere,function(retour){
        $('#resultat').html(retour).fadeIn();
        });
        }else $('#resultat').empty().fadeOut();
        });
        });
        </script>


        <?php
        if(isset($_GET['action'])){
        if($_GET['action']=='delete'){
        $id=$_GET['id'];
        $selectnom = $db->query("SELECT * FROM carousel WHERE id='$id'");
        $rname = $selectnom->fetch(PDO::FETCH_OBJ);
        $valnom = $rname->image;
        $target_dir = '../../../JamFichiers/Img/ImagesDuSite/Original';

        if (file_exists($target_dir)){
          unlink("$target_dir/$valnom");
          $updatedelete = $db->prepare("DELETE FROM carousel WHERE image=:image and id=:id");
          $updatedelete->execute(array(
            "image"=>$valnom,
            "id"=>$id
          ));
          $messagenotif = "Le fichier.$valnom. à bien été supprimé";
          $type = "success";
          require('includes/miseajourdusite.php');

          ?>
          <script>window.location="http://google.fr"</script>
          <?php
        }else{

          $messagenotif = 'Un problème de répertoire est présent, contacter votre administrateur !';
          $type = "warning";
        }
        ?>
        <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=actualite&table=newsactus"</script>
        <?php
        }
        }
        ?>


            <div class="section section-contact-us text-center">
              <div class="container">
                <h2 class="title">Suppression des photos liées au Caroussel ! </h2>
                <p class="description">AUTRE</p>
                <div class="row">
                  <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">

                  </div>
                </div>
              </div>
            </div>

        <h3> Supprimer :  </h3>
          <input type='text' name="valeur" placeholder="Saisir son nom ou la catégorie à laquelle elle appartient">
          <p id='resultat'></p>
<!-- FIN AJOUT KEVIN -->























        </div>
      </div>
    </div>
  </div>


  <?php
}else if(isset($_GET['banactus'])){
  $id = $_GET['banactus'];
  $banactu = $db->prepare("UPDATE newsactus SET status=:status where id=:id");
  $banactu->execute(array(
      "status"=>'INACTIVE',
      "id"=>$id
      )
  );
  ?>
    <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=actualite&table=newsactus"</script>
<?php
}else if(isset($_GET['unbanactus'])){
  $id = $_GET['unbanactus'];
  $banactu = $db->prepare("UPDATE newsactus SET status=:status where id=:id");
  $banactu->execute(array(
      "status"=>'ACTIVE',
      "id"=>$id
      )
  );
  ?>
    <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=actualite&table=newsactus"</script>
<?php
}
  else{
  //Page newsactus
?>

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

<script>
 function SubmitFormDataModifActus() {
    var user_id = "<?php echo $_SESSION['admin_id']; ?>";
    var titre = $("#titre").val();
    var pagetitre = $("#pagetitre").val();
    var description = $("#description").val();
    $.post("ajax/modifypageactus.php", { user_id: user_id, titre: titre, pagetitre: pagetitre, description: description},
    function(data) {
     $('#results10').html(data);
    });
}
</script>

<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifphotopageactu'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>"Actualité",
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page actualitée',
                            "page"=>'actualitees.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>

          <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
            <div class="wrapper">

             <?php
             require_once('includes/navbar.php');
             ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Modification page actualités</h2>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">En-tête de page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card-content">
                          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <h3 class="card-title text-center">Image d'Arrière plan</h3>
                            <br><br><br>
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
                                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                  </span>
                                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                                  <button type="submit" name="modifphotopageactu" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                          <div class="form-group label-floating">
                            <label class="control-label">Titre de la page</label>
                            <input type="text" name="pagetitre" value="<?php echo $pagetitre; ?>" id="pagetitre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                            <label class="control-label">Titre</label>
                            <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <textarea rows="5" name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                          </div>
                          <br>
                          <center>
                            <button id="submitFormDataModifActus" onclick="SubmitFormDataModifActus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="results10"></div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">
                        <h3 class="card-title">Liste des actualités</h3>
                      </div>
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
        echo '
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th class="text-center">Titre</th>
              <th class="text-center">Description</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
        ';
        foreach($tableactus as $ligneactus){
          $id = $ligneactus->id;
          $title = $ligneactus->title;
          $description = $ligneactus->description;
          $status = $ligneactus->status;
          if($status == 'ACTIVE'){
            $act = 'ban';
            $message = 'Désactiver';
          }else{
            $act = 'unban';
            $message = 'Activer';
          }
$result = raccourcirChaine($description, 80);
          echo '
              <tr>
                <td class="text-center">'.$title.'</td>
                <td class="text-center">'.$result.'</td>
                <td class="text-center">'.$status.'</td>
                <td class="text-center">
                  <a href="?page=actualite&amp;table=newsactus&amp;modifactus='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Modifier</button></a>
                  <a href="?page=actualite&amp;table=newsactus&amp;'.$act.'actus='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">'.$message.'</button></a>
                  ';
                  ?>
                  <button onclick="demo.showSwal('warningdeleteactu','<?php echo $user_id; ?>','<?php echo $id; ?>')" type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button>

                </td>
              </tr>
          <?php
        }
        echo '
            </tbody>
          </table>
        </div>
        ';

      }else{ ?>

        <center>
            <h4 class="info-title"><font color="red">Aucune actualitée trouvée</font></h4>
        </center>

      <?php }

//Création membres
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


<?php
//Création actualite
if(isset($_POST['submitactualite'])){
  $title = $_POST['title'];
  $description = $_POST['description'];
  $slug = slugify($title);
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
$target_file3 = $target_dirnew."".$slug.".".$imageFileType;
// Check if file already exists
if (file_exists($target_file3)) {
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_filefile3 = $slug.".".$imageFileType;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
$target_file3 = $target_dirnew."".$slug.".".$imageFileType;
        $insert = $db->prepare("INSERT INTO newsactus (title, slug, description, surname, date, formatimg, status) VALUES(:title, :slug, :description, :surname, :date, :formatimg, :status)");
        $insert->execute(array(
                            "title"=>$title,
                            "slug"=>$slug,
                            "description"=>$description,
                            "surname"=>'Actualité',
                            "date"=>$date,
                            "formatimg"=>$imageFileType,
                            "status"=>'ACTIVE'
                            )
                        );
                        date_default_timezone_set('Europe/Paris');
                        setlocale(LC_TIME, 'fr_FR.utf8','fra');
                        $date = strftime('%d/%m/%Y %H:%M:%S');
                        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                        $insertlogs->execute(array(
                                            "user_id"=>$user_id,
                                            "type"=>'Ajout',
                                            "action"=>'Ajout d\'une actualité',
                                            "page"=>'actualitees.php',
                                            "date"=>$date
                                            )
                                        );
        $status = '1';
        $img_tmp = $target_file3;
        $fin = $target_dirnewthumb.$target_filefile3;
          //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
            $longueur = 539;
            $largeur = 539;
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    $selectidactu = $db->prepare("SELECT id FROM newsactus WHERE title = :title");
    $selectidactu->execute(array(
        "title"=>$title
        )
    );
  $sactu = $selectidactu->fetch(PDO::FETCH_OBJ);
  $idactu = $sactu->id;
?>
    <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=actualite&table=newsactus&modifactus=<?php echo $idactu;?>"</script>
<?php
require('includes/miseajourdusite.php');
          } ?>


          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Création d'actualitée</h3>
              </div>
            </div>
          </div>
          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-6">
                <div class="card-content">
                  <div class="form-group label-floating">
                      <label class="control-label">Titre de l'actualité</label>
                      <input type="text" class="form-control" name="title" id="title">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card-content">
                  <div class="form-group form-file-upload">
                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                    <div class="input-group">
                      <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                      <span class="input-group-btn input-group-s">
                        <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                          <i class="material-icons">layers</i>
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <div class="form-group label-floating">
                    <label class="control-label">Description</label>
                    <textarea rows="8" type="text" name="description" value="Titre du status" id="description4" class="form-control"></textarea>
                  </div>
                  <center>

                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<br />');return false;">Saut de ligne </button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<u>Texte souligné</u>');return false;">Souligner</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<strong>Texte en gras</strong>');return false;">Gras</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<i>Texte en Italic</i>');return false;">Italic</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description4', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>

                    <br><br>
                    <button type="submit" name="submitactualite" class="btn btn-primary btn-round btn-rose">Créer une actualité</button>
                  </center>
                </div>
              </div>
            </div>
          </form>
          <div id="results11"></div>




</div>






<?php
//FIn Création
}
}else if ($_GET['page']=='activitesvoyages'){
  if(isset($_GET['modifactivitesvoyages'])){
  ?>
  <script>
  function RetourIndex2(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages"
  }
  </script>

    <?php
    $id = $_GET['modifactivitesvoyages'];
    $selectinfosactuel = $db->prepare("SELECT * from activitesvoyages where id=:id");
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
    $stock = $r2->stock;
  ?>
  <script>
  function RetourIndex4(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages"
  }
  </script>
  <script>
   function SubmitFormDataModifActivite() {
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

     <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
       <div class="wrapper">

        <?php
        require_once('includes/navbar.php');
        ?>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification de l'activite</h2>
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
                                  <input type="text" name="description" value="<?php echo $description; ?>" id="description" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre 2</label>
                                  <input type="text" name="title2" value="<?php echo $title2; ?>" id="title2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description 2</label>
                                  <input type="text" name="description2" value="<?php echo $description2; ?>" id="description2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre 3</label>
                                  <input type="text" name="title3" value="<?php echo $title3; ?>" id="title3" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description 3</label>
                                  <input type="text" name="description3" value="<?php echo $description3; ?>" id="description3" class="form-control">
                              </div>


                              <div class="form-group label-floating">
                                  <label class="control-label">Stock</label>
                                  <input type="number" name="stock" value="<?php echo $stock; ?>" id="stock" class="form-control">
                              </div>

                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="submitFormDataModifActivite" onclick="SubmitFormDataModifActivite();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
}else if(isset($_GET['banactivitesvoyages'])){
  $id = $_GET['banactivitesvoyages'];
  $banacti = $db->prepare("UPDATE activitesvoyages SET status=:status where id=:id");
  $banacti->execute(array(
      "status"=>'INACTIVE',
      "id"=>$id
      )
  );
  ?>
    <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages"</script>
<?php
}else if(isset($_GET['unbanactivitesvoyages'])){
  $id = $_GET['unbanactivitesvoyages'];
  $banacti = $db->prepare("UPDATE activitesvoyages SET status=:status where id=:id");
  $banacti->execute(array(
      "status"=>'ACTIVE',
      "id"=>$id
      )
  );
  ?>
    <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages"</script>
<?php
}else{
  //Page newsactus
  ?>

  <?php
  $selectinfosactuel9 = $db->prepare("SELECT * from photopage where nompage=:nompage");
  $selectinfosactuel9->execute(array(
      "nompage"=>'Activité / Voyage'
      )
  );
  $r9 = $selectinfosactuel9->fetch(PDO::FETCH_OBJ);
  $image = $r9->image;
  $pagetitre = $r9->pagetitre;
  $titre = $r9->titre;
  $description = $r9->description;
  ?>
  <script>
   function SubmitFormDataModifActivitesVoyages() {
      var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var titre = $("#titre").val();
      var pagetitre = $("#pagetitre").val();
      var description = $("#description").val();
      $.post("ajax/modifypageactivitesvoyages.php", { user_id: user_id, titre: titre, pagetitre: pagetitre, description: description},
      function(data) {
       $('#results18').html(data);
      });
  }
  </script>

  <!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifphotopageactivoyages'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Activité / Voyage',
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Activités/Voyages',
                            "page"=>'activitees.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>

             <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
               <div class="wrapper">

                <?php
                require_once('includes/navbar.php');
                ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Modification page Activités / Voyage</h2>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">En-tête de page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card-content">
                          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <h3 class="card-title text-center">Image d'Arrière plan</h3>
                            <br><br><br>
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
                                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                  </span>
                                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                                  <button type="submit" name="modifphotopageactivoyages" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                          <div class="form-group label-floating">
                            <label class="control-label">Titre de la page</label>
                            <input type="text" name="pagetitre" value="<?php echo $pagetitre; ?>" id="pagetitre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                            <label class="control-label">Titre</label>
                            <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <textarea rows="5" name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                          </div>
                          <br>
                          <center>
                            <button id="submitFormDataModifActivitesVoyages" onclick="SubmitFormDataModifActivitesVoyages();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="results18"></div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">
                        <h3 class="card-title">Liste des Activités / Voyages</h3>
                      </div>
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
      $selectnomactivitesvoyages = $db->prepare("SELECT * FROM activitesvoyages ORDER BY id DESC");
      $selectnomactivitesvoyages->execute();
      $tableactivitesvoyages = $selectnomactivitesvoyages->fetchAll(PDO::FETCH_OBJ);
      if(count($tableactivitesvoyages)>0){
        echo '
        <div class="table-responsive">
          <table class="table">
            <thead class="text-primary">
              <th class="text-center">Titre</th>
              <th class="text-center">Description</th>
              <th class="text-center">Place Restantes</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
        ';
        foreach($tableactivitesvoyages as $ligneactivitesvoyages){
          $id = $ligneactivitesvoyages->id;
          $title = $ligneactivitesvoyages->title;
          $description = $ligneactivitesvoyages->description;
          $status = $ligneactivitesvoyages->status;
          $stock = $ligneactivitesvoyages->stock;
          $result = raccourcirChaine($description, 80);
          if($status == 'ACTIVE'){
            $act = 'ban';
            $message = 'Désactiver';
          }else{
            $act = 'unban';
            $message = 'Activer';
          }
          echo '
          <tr>
            <td>'.$title.'</td>
            <td>'.$result.'</td>
            <td class="text-center">'.$stock.'</td>
            <td class="text-center">'.$status.'</td>
            <td class="text-center">
              <a href="?page=activitesvoyages&amp;table=activitesvoyages&amp;modifactivitesvoyages='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Modifier</button></a>
              <a href="?page=activitesvoyages&amp;table=activitesvoyages&amp;'.$act.'activitesvoyages='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">'.$message.'</button></a>
            ';
            ?>
              <button onclick="demo.showSwal('warningdeleteacti','<?php echo $user_id; ?>','<?php echo $id; ?>')" type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button>
            </td>
          </tr>
          <?php
        }
        echo '
        </tbody>
      </table>
    </div>
        ';

      }else{ ?>

        <center>
            <h4 class="info-title"><font color="red">Aucune activitée trouvée</font></h4>
        </center>

      <?php }

  //Création membres
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
  if(isset($_POST['submitactivite'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $datesejour = $_POST['datesejour'];
    $price = $_POST['price'];
    $slug = slugify($title);
    if($price>'0'){
      $payant = '1';
    }else{
      $payant = '0';
    }
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
      $messagenotif = 'Désolé, le fichier existe déja.';
      $type = "warning";
      $uploadOk = 0;
  }
  // Check file size < 2mo
  if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
      $messagenotif = 'Désolé, le fichier est trop grand.';
      $type = "warning";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
      $type = "warning";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $messagenotif = 'Désolé, une erreur est survenue.';
      $type = "warning";
  // if everything is ok, try to upload file
  } else {
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d:%m:%y %H:%M:%S');
    $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
    $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
    $target_filefile3 = $slug.".".$imageFileType;
    $target_file3 = $target_dirnew."".$slug.".".$imageFileType;
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
          $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
          $type = "success";
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');
          $insert = $db->prepare("INSERT INTO activitesvoyages (title, slug, description, surname, date, formatimg, status, stock, datesejour, price, payant) VALUES(:title, :slug, :description, :surname, :date, :formatimg, :status, :stock, :datesejour, :price, :payant)");
          $insert->execute(array(
                              "title"=>$title,
                              "slug"=>$slug,
                              "description"=>$description,
                              "surname"=>'Activités / Voyages',
                              "date"=>$date,
                              "formatimg"=>$imageFileType,
                              "status"=>'ACTIVE',
                              "stock"=>$stock,
                              "datesejour"=>$datesejour,
                              "price"=>$price,
                              "payant"=>$payant
                              )
                          );
          $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
          $insertlogs->execute(array(
                              "user_id"=>$user_id,
                              "type"=>'Ajout',
                              "action"=>'Ajout d\'une actualité',
                              "page"=>'actualitees.php',
                              "date"=>$date
                              )
                          );
          $status = '1';
          $img_tmp = $target_file3;
          $fin = $target_dirnewthumb.$target_filefile3;
            //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
              $longueur = 539;
              $largeur = 539;
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
          $messagenotif = 'Désolé, une erreur est survenue.';
          $type = "warning";
      } } }
      $selectidacti = $db->prepare("SELECT id FROM activitesvoyages WHERE title=:title");
      $selectidacti->execute(array(
          "title"=>$title
          )
      );
      $sacti = $selectidacti->fetch(PDO::FETCH_OBJ);
      $idacti = $sacti->id;
      ?>
          <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages&modifactivitesvoyages=<?php echo $idacti;?>"</script>
      <?php
      require('includes/miseajourdusite.php');
            } ?>

            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Création d'activités / Voyage</h3>
                </div>
              </div>
            </div>
            <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group label-floating">
                        <label class="control-label">Titre de l'actualité</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group form-file-upload">
                      <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                      <div class="input-group">
                        <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                        <span class="input-group-btn input-group-s">
                          <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                            <i class="material-icons">layers</i>
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Description</label>
                      <textarea rows="8" type="text" name="description" value="Description" id="description3" class="form-control"></textarea>
                    </div>
                    <center>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<br />');return false;">Saut de ligne </button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<u>Texte souligné</u>');return false;">Souligner</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<ul>\n\n<li>Element 1</li>\n<li>Element 2</li>\n\n</ul>');return false;">Liste</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<strong>Texte en gras</strong>');return false;">Gras</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<i>Texte en Italic</i>');return false;">Italic</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<sub>Texte en Indice</sub>');return false;">Indice</button>
                      <button class="btn btn-rose btn-round btn-sm" onclick="insertAtCaret('description3', '<mark>Texte Surligné</mark>\n\n\n\n<style>\nmark { \nbackground-color: red; <-- couleur surlignage -->\ncolor: black; <-- couleur du texte -->\n}\n</style>');return false;">Surligner</button>
                    </center>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Stock</label>
                      <input type="number" name="stock" id="stock" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Date (XX/XX/2018 - XX/XX/2019)</label>
                      <input type="text" name="datesejour" id="datesejour" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <label class="control-label">Price</label>
                      <input type="number" name="price" id="price" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <center>
                      <button type="submit" name="submitactivite" class="btn btn-primary btn-round btn-rose">Créer une activité</button>
                    </center>
                  </div>
                </div>
              </div>
            </form>
            <div id="results11"></div>

  <!-- Ajoutd'images au site web (assets)-->
  <?php
  if(isset($_POST['submitphotoaactivitesvoyagescarousel'])){
  $category = $_POST['catactivitevoyage'];
  $souscategory = $_POST['souscatactivitevoyage'];
  $titreimage = $_POST['titreimage'];
  if(!isset($titreimage)){
    $uploadOk = 0;
  }
  $selectinfosactuel12 = $db->prepare("SELECT slug from activitesvoyages where id=:id");
  $selectinfosactuel12->execute(array(
      "id"=>$category
      )
  );
  $r12 = $selectinfosactuel12->fetch(PDO::FETCH_OBJ);
  $slug = $r12->slug;
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
  }
  // Check file size < 2mo
  if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
  // if everything is ok, try to upload file
  } else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $insert = $db->prepare("INSERT INTO carousel (slug, titre, image, titreimage) VALUES (:slug, :souscatactivitevoyage, :target_filefile, :titreimage)");
        $insert->execute(array(
            "slug"=>$slug,
            "souscatactivitevoyage"=>$souscategory,
            "target_filefile"=>$target_filefile,
            "titreimage"=>$titreimage
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Ajout',
                            "action"=>'Ajout d\'images aux activités',
                            "page"=>'activitees.php',
                            "date"=>$date
                            )
                        );
        $status = '1';
        $img_tmp = $target_dirnew.$target_filefile;
        $fin = $target_dirnewthumb.$target_filefile;
          //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
            $longueur = 732;
            $largeur = 541;
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>




  <h1>Selectionner la catégorie à laquelle ajouter les photos</h1>


  <?php
  $selectcatactivitesvoyages=$db->query("SELECT * FROM activitesvoyages");
  ?>

        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            Sélectionner la catégorie d'activité
            <select name="catactivitevoyage" class="catactivitevoyage">
              <option value="0">Selectionner la catégorie</option>
              <?php
                while($s = $selectcatactivitesvoyages->fetch(PDO::FETCH_OBJ)){
                  $title = $s->title;
                  $id = $s->id;
                echo '<option value="'.$id.'">'.$title.'</option>';
            }
            ?>


          </select><br>
          Sous Catégorie :
          <select name="souscatactivitevoyage" class="souscatactivitevoyage">
<option>Sélectionner la sous catégorie</option>
</select>

            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons users_circle-08"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Indiquez un nom commun à ces images"  name="titreimage">
            </div>

            <div class="form-group form-file-upload">
                <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                <div class="input-group">
                    <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                    <span class="input-group-btn input-group-s">
                        <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                            <i class="material-icons">layers</i>
                        </button>
                    </span>
                </div>
            </div>

            <input type="submit" name="submitphotoaactivitesvoyagescarousel" value="Envoyer les images !">
        </form>

  </div>

  <!-- TEST -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function()
  {
  $(".catactivitevoyage").change(function()
  {
  var id=$(this).val();
  var post_id = 'id='+ id;
  $.ajax
  ({
  type: "POST",
  url: "rechercheactivitevoyagepourcarrousel.php",
  data: post_id,
  cache: false,
  success: function(cities)
  {
  $(".souscatactivitevoyage").html(cities);
  }
  });
  });
  });
  </script>


  <script>
  $(document).ready(function(){
  var $recherche =$('input[name=valeur]');
  var critere;
  $recherche.keyup(function(){
  critere = $.trim($recherche.val());
  if(critere!=''){
    $.get('gestionrechercheimageactivite.php?critere='+critere,function(retour){
  $('#resultat').html(retour).fadeIn();
  });
  }else $('#resultat').empty().fadeOut();
  });
  });
  </script>


  <?php
  if(isset($_GET['action'])){
  if($_GET['action']=='delete'){
  $id=$_GET['id'];
  $selectnom = $db->query("SELECT * FROM carousel WHERE id='$id'");
  $rname = $selectnom->fetch(PDO::FETCH_OBJ);
  $valnom = $rname->image;
  $target_dir = '../../../JamFichiers/Img/ImagesDuSite/Original';
  $target_dirthumb = '../../../JamFichiers/Img/ImagesDuSite/Thumb';
  if (file_exists($target_dir)){
  unlink("$target_dir/$valnom");
  $updatedelete = $db->prepare("DELETE FROM carousel WHERE image=:image");
  $updatedelete->execute(array(
    "image"=>$valnom
  ));
  unlink("$target_dirthumb/$valnom");
  $messagenotif = "Le fichier.$valnom. à bien été supprimé";
  $type = "success";
  require('includes/miseajourdusite.php');
  }else{
  $messagenotif = 'Un problème de répertoire est présent, contacter votre administrateur !';
  $type = "warning";
  }
  ?>
  <script>window.location="https://administration.jam-mdm.fr/modifdespages.php?page=activitesvoyages&table=activitesvoyages"</script>
  <?php
  }
  }
  ?>


    <div class="section section-contact-us text-center">
      <div class="container">
        <h2 class="title">Suppression des photos liés au Caroussel !</h2>
        <p class="description">AUTRE</p>
        <div class="row">
          <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">

          </div>
        </div>
      </div>
    </div>

  <h3> Supprimer :  </h3>
  <input type='text' name="valeur" placeholder="Saisir son nom ou la catégorie à laquelle elle appartient">
  <p id='resultat'></p>



  <?php
  //FIn Création
  }
}else if ($_GET['page']=='galerie'){
?>
<script>
function RetourIndex(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php"
}
</script>
  <?php
//Modif page galerie
?>


<?php
$selectinfosactuel43 = $db->prepare("SELECT * from photopage where nompage=:nompage");
$selectinfosactuel43->execute(array(
  "nompage"=>'Galerie'
));
$r43 = $selectinfosactuel43->fetch(PDO::FETCH_OBJ);
$pagetitre = $r43->pagetitre;
$image = $r43->image;
$titre = $r43->titre;
?>
<script>
function SubmitFormDataGallerie() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var pagetitre = $("#pagetitre").val();
   var titre = $("#titre").val();
   $.post("ajax/modifypagegallerie.php", { user_id: user_id, pagetitre: pagetitre, titre: titre},
   function(data) {
    $('#results22').html(data);
   });
}
</script>


<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifphotogalerie'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Galerie',
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Activités/Voyages',
                            "page"=>'activitees.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>

          <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
            <div class="wrapper">

             <?php
             require_once('includes/navbar.php');
             ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Modification page Galerie</h2>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">En-tête de page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card-content">
                          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <h3 class="card-title text-center">Image d'Arrière plan</h3>
                            <br><br><br>
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
                                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                  </span>
                                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                                  <button type="submit" name="modifphotogalerie" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                          <div class="form-group label-floating">
                            <label class="control-label">Titre de la page</label>
                            <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                          </div>
                          <div class="form-group label-floating">
                            <label class="control-label">Titre</label>
                            <input type="text" name="titre" value="<?php echo $titre;?>" id="titre" class="form-control">
                          </div>
                          <br>
                          <center>
                            <button id="submitFormDataGallerie" onclick="SubmitFormDataGallerie();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="results22"></div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-content">
                        <h3 class="card-title">Gérer les images</h3>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="card-content">
                        <center>
                          <h3 class="card-title text-center">Ajouter des images concernant la galerie</h3>
                          <a href="https://administration.jam-mdm.fr/ajoutimage.php" target="_blank" class="w3-button w3-black"><button type="button" class="btn btn-primary btn-round btn-rose">Ajouter des images</button></a>
                        </center>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="card-content">
                        <center>
                          <h3 class="card-title text-center">Gérer les images concernant la galerie</h3>
                          <a href="https://administration.jam-mdm.fr/gestionimage.php" target="_blank" class="w3-button w3-black"><button type="button" class="btn btn-primary btn-round btn-rose">Gérer les images</button></a>
                        </center>
                      </div>
                    </div>
                    <br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>


<?php
//Fin modif galerie
}else if ($_GET['page']=='nouscontacter'){
?>
<script>
function RetourIndex(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php"
}
</script>
  <?php
//Modif page galerie
?>


<?php
$selectinfosactuel44 = $db->prepare("SELECT * from photopage where nompage=:nompage");
$selectinfosactuel44->execute(array(
  "nompage"=>'Nous Contacter'
));
$r44 = $selectinfosactuel44->fetch(PDO::FETCH_OBJ);
$pagetitre = $r44->pagetitre;
$image = $r44->image;
$titre = $r44->titre;
$description = $r44->description;
?>
<script>
function SubmitFormDataContactUs() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var pagetitre = $("#pagetitre").val();
   var titre = $("#titre").val();
   var description = $("#description").val();
   $.post("ajax/modifypagecontactus.php", { user_id: user_id, pagetitre: pagetitre, titre: titre, description: description},
   function(data) {
    $('#results22').html(data);
   });
}
</script>


<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifphotocontacteznous'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Nous Contacter',
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Nous Contacter',
                            "page"=>'contact.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
  require('includes/miseajourdusite.php');
 } ?>

    <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
      <div class="wrapper">

       <?php
       require_once('includes/navbar.php');
       ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Modification page nous-contacter</h2>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">En-tête de page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card-content">
                          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <h3 class="card-title text-center">Image d'Arrière plan</h3>
                            <br><br><br>
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
                                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                  </span>
                                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                                  <button type="submit" name="modifphotocontacteznous" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                          <div class="form-group label-floating">
                            <label class="control-label">Titre de la page</label>
                            <input type="text" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                            <label class="control-label">Titre</label>
                            <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <textarea rows="5" name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                          </div>
                          <br>
                          <center>
                            <button id="submitFormDataContactUs" onclick="SubmitFormDataContactUs();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="results22"></div>
                </div>
              </div>
            </div>
          </div>

<?php
//Fin modif contactez nous
}else if ($_GET['page']=='faireundon'){
//Modif page faire un don
?>


<?php
$selectinfosactuel45 = $db->prepare("SELECT * from photopage where nompage=:nompage");
$selectinfosactuel45->execute(array(
  "nompage"=>'Faire un don'
));
$r45 = $selectinfosactuel45->fetch(PDO::FETCH_OBJ);
$pagetitre = $r45->pagetitre;
$image = $r45->image;
$titre = $r45->titre;
$description = $r45->description;
?>

<script>
function SubmitFormDataFaireUnDon() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var pagetitre = $("#pagetitre").val();
   var titre = $("#titre").val();
   var description = $("#description").val();
   $.post("ajax/modifypagefaireundon.php", { user_id: user_id, pagetitre: pagetitre, titre: titre, description: description},
   function(data) {
    $('#results23').html(data);
   });
}
</script>

<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifpagedon'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Faire un don',
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Faire Un Don',
                            "page"=>'don.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          } ?>

          <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
            <div class="wrapper">

             <?php
             require_once('includes/navbar.php');
             ?>

          <div class="content">
            <div class="container-fluid">
              <div class="card">
                <div class="card-content">
                  <h2 class="card-title text-center">Modification page faire un don</h2>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-content">
                          <h3 class="card-title">Première page</h3>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="card-content">
                          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <h3 class="card-title text-center">Image d'Arrière plan</h3>
                            <br><br><br>
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
                                    <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                  </span>
                                  <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                                  <button type="submit" name="modifpagedon" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                          <div class="form-group label-floating">
                            <label class="control-label">Titre de la page</label>
                            <input type="text"value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                            <label class="control-label">Titre</label>
                            <input type="text" name="titre" value="<?php echo $titre;?>" id="titre" class="form-control">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <textarea rows="5" name="description" id="description" class="form-control"><?php echo $description; ?></textarea>
                          </div>
                          <br>
                          <center>
                            <button id="submitFormDataFaireUnDon" onclick="SubmitFormDataFaireUnDon();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div id="results23"></div>

<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['modifpagedonpaiement'])){
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
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, une erreur est survenue.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');
  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Faire un don paiement',
            "image"=>$target_filefile
            )
        );
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%Y %H:%M:%S');
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Faire Un Don',
                            "page"=>'don.php',
                            "date"=>$date
                            )
                        );
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
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }
    require('includes/miseajourdusite.php');
          }
          //Modif page faire un don paiement
          $selectinfosactuel462 = $db->prepare("SELECT * from photopage where nompage=:nompage");
          $selectinfosactuel462->execute(array(
            "nompage"=>'Faire un don paiement'
          ));
          $r462 = $selectinfosactuel462->fetch(PDO::FETCH_OBJ);
          $pagetitre2 = $r462->pagetitre;
          $image2 = $r462->image;
          $titre2 = $r462->titre;
          $description2 = $r462->description;
          ?>


          <script>
          function SubmitFormDataFaireUnDonPaiement() {
             var user_id = "<?php echo $_SESSION['admin_id']; ?>";
             var pagetitre2 = $("#pagetitre2").val();
             var titre2 = $("#titre2").val();
             var description2 = $("#description2").val();
             $.post("ajax/modifypagefaireundonpaiement.php", { user_id: user_id, pagetitre2: pagetitre2, titre2: titre2, description2: description2},
             function(data) {
              $('#results44').html(data);
             });
          }
          </script>


          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Seconde page</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card-content">
                <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                  <h3 class="card-title text-center">Image d'Arrière plan</h3>
                  <br><br><br>
                  <center>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail">
                        <img src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $image2; ?>" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <br><br>
                      <div>
                        <span class="btn btn-rose btn-round btn-file">
                          <span class="fileinput-new">Selection image</span>
                          <span class="fileinput-exists">Changer</span>
                          <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                        </span>
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Annulé</a>
                        <button type="submit" name="modifpagedonpaiement" class="btn btn-primary btn-round btn-rose">Modifier l'image</button>
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
                <div class="form-group label-floating">
                  <label class="control-label">Titre de la page</label>
                  <input type="text" class="form-control" value="<?php echo $pagetitre2; ?>" name="pagetitre2" id="pagetitre2">
                </div>
                <div class="form-group label-floating">
                  <label class="control-label">Titre</label>
                  <input type="text" name="titre" value="<?php echo $titre2; ?>" id="titre2" class="form-control">
                </div>
                <div class="form-group label-floating">
                    <label class="control-label">Description</label>
                    <textarea rows="5" name="description" id="description2" class="form-control"><?php echo $description2; ?></textarea>
                </div>
                <br>
                <center>
                  <button id="submitFormDataFaireUnDonPaiement" onclick="SubmitFormDataFaireUnDonPaiement();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                </center>
              </form>
            </div>
          </div>
        </div>
        <div id="results44"></div>
      </div>
    </div>
  </div>

<?php }else if ($_GET['page']=='lienutiles'){
?>




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

  <body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
    <div class="wrapper">

     <?php
     require_once('includes/navbar.php');
     ?>

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
      var titre = $("#titre").val();
      var pagetitre = $("#pagetitre").val();
      $.post("ajax/modifylienutiles.php", { user_id: user_id, titre: titre, pagetitre: pagetitre},
      function(data) {
       $('#results83').html(data);
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
      $messagenotif = 'Désolé, le fichier existe déja.';
      $type = "warning";
      $uploadOk = 0;
  }
  // Check file size < 2mo
  if ($_FILES["fileToUpload"]["size"][$i] > 3000000) {
      $messagenotif = 'Désolé, le fichier est trop grand.';
      $type = "warning";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      $messagenotif = 'Désolé, les formats autorisés sont JPG, PNG et JPEG.';
      $type = "warning";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $messagenotif = 'Désolé, une erreur est survenue.';
      $type = "warning";
  // if everything is ok, try to upload file
  } else {
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d:%m:%y %H:%M:%S');
    $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
    $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
    $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
          $messagenotif = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";
          $type = "success";
          $status = '1';
          $update2 = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
          $update2->execute(array(
              "nompage"=>'Liens Utiles',
              "image"=>$target_filefile
              )
          );
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%d/%m/%Y %H:%M:%S');
          $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
          $insertlogs->execute(array(
                              "user_id"=>$user_id,
                              "type"=>'Modification',
                              "action"=>'Modification page liens utiles',
                              "page"=>'lienutiles.php',
                              "date"=>$date
                              )
                          );
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
          $messagenotif = 'Désolé, une erreur est survenue.';
          $type = "warning";
      } } }
      require('includes/miseajourdusite.php');
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
  <div id="results83"> <!-- TRES IMPORTANT -->
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
    $messagenotif = "Le lien utile à bien été supprimé";
    $type = "success";
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

      }else{ ?>

        <center>
            <h4 class="info-title"><font color="red">Aucun lien utile trouvé</font></h4>
        </center>

      <?php } ?>

  </div>

  <div id="results33"> <!-- TRES IMPORTANT -->
  </div>

  <?php
  }
}
 } ?>

  </div>
</div>

  <?php
  require_once('includes/javascript.php');
  ?>

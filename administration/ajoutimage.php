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
  $nomcategorieimage = $_POST['nomcategorieimage'];
  $nomicon = $_POST['nomicon'];

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

      //Ajout thumb
      $thumb = 'Thumb';
      if (file_exists($target_dir/$thumb/$nomcategorieimage)) {
      }else{
        mkdir("$target_dir/$thumb/$nomcategorieimage", 0700);
      }

      $affiche = 'Affiche';
      if (file_exists($target_dir/$affiche/$nomcategorieimage)) {
      }else{
        mkdir("$target_dir/$affiche/$nomcategorieimage", 0700);
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

 }else{
      $messagenotif = 'Désolé, la catégorie existe déja';
      $type = "warning";
    }}
?>


<?php

if(isset($_POST['catvideosubmit'])){
$liencatvideo = $_POST['liencatvideo'];
$catvideo = $_POST['nomcategorievideo'];

$checkcatvideo=$db->prepare("SELECT * FROM videos WHERE title = '$catvideo'");
$checkcatvideo->execute();
$countcheckcatvideo = $checkcatvideo->rowCount();

if (is_null($countcheckcatvideo)){
$countcheckcatvideo = '0';

}

if($countcheckcatvideo == '0'){



  $target_dir = "../../../JamFichiers/Photos";

  $original = 'Original';
  if (file_exists($target_dir/$original/$catvideo)){
    $target_dirnew = "$target_dir/$original/$catvideo/";
  }else{
    mkdir("$target_dir/$original/$catvideo", 0700);
    $target_dirnew = "$target_dir/$original/$catvideo/";
  }

  //Ajout thumb
  $thumb = 'Thumb';
  if (file_exists($target_dir/$thumb/$catvideo)) {
    $target_dirnewthumb = "$target_dir/$thumb/$catvideo/";
  }else{
    mkdir("$target_dir/$thumb/$catvideo", 0700);
    $target_dirnewthumb = "$target_dir/$thumb/$catvideo/";
  }

  $affiche = 'Affiche';
  if (file_exists($target_dir/$affiche/$catvideo)) {
    $target_dirnewaffiche = "$target_dir/$affiche/$catvideo/";
  }else{
    mkdir("$target_dir/$affiche/$catvideo", 0700);
    $target_dirnewaffiche = "$target_dir/$affiche/$catvideo/";
  }


  //FIN



$target_file = $target_dirnew . basename($_FILES["fileToUploadCatVideo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
$messagenotif = 'Désolé, le fichier existe déja.';
$type = "warning";
$uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUploadCatVideo"]["size"] > 2000000) {
$messagenotif = 'Désolé, le fichier est trop grand.';
$type = "warning";
$uploadOk = 0;

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "rar") {
$messagenotif = 'Désolé, les formats autorisé sont JPG, PNG et GIF.';
$type = "warning";
$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
$messagenotif = 'Désolé, votre fichier n\'a pas été uploadé';
$type = "warning";
// if everything is ok, try to upload file
} else {
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');
$date = strftime('%d:%m:%y %H:%M:%S');

$target_filefile = basename($_FILES["fileToUploadCatVideo"]["name"]);
$target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUploadCatVideo"]["name"]);
$target_file3 = $target_dirnew."".basename($_FILES["fileToUploadCatVideo"]["name"]);

if (move_uploaded_file($_FILES["fileToUploadCatVideo"]["tmp_name"], $target_file3)) {

    $messagenotif = 'Le fichier '. basename( $_FILES["fileToUploadCatVideo"]["name"]). ' à bien été uploadé';
    $type = "warning";

    $status = '1';
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%Y-%m-%d %H:%M:%S');

    $insertinfos = $db->prepare("INSERT INTO videos (file_nameimage, file_namevideo, title, uploaded_on, status) VALUES(:file_nameimage, :file_namevideo, :title, :date, :status)");
    $insertinfos->execute(array(

        "file_nameimage"=>$target_filefile,
        "file_namevideo"=>$liencatvideo,
        "title"=>$catvideo,
        "date"=>$date,
        "status"=>$status
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
                    // GIF
          else if ($taille['mime']=='image/gif' ) {
                        //OUVERTURE DE L'IMAGE ORIGINALE
                        $img_big = imagecreatefromgif($img_tmp);
                        $img_new = imagecreate($longueur, $largeur);
                        //CREATION DE LA MINIATURE
                        $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                        //COPIE DE L'IMAGE REDIMENSIONNEE
                        imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                        imagegif($img_petite,$fin);


                  }
                  require('includes/miseajourdusite.php');
            }


            //Affiche Grande
            // Destination
            $img_tmp = $target_dirnew.$target_filefile;
            $finaffiche = $target_dirnewaffiche.$target_filefile;

            //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
              $longueur = 1024;
              $largeur = 700;
              //TAILLE DE L'IMAGE ACTUELLE
              $tailleaffiche = getimagesize($img_tmp);
              //SI LE FICHIER EXISTE
              if ($tailleaffiche) {
                  //SI JPG
                  if ($tailleaffiche['mime']=='image/jpeg' ) {
                            //OUVERTURE DE L'IMAGE ORIGINALE
                              $img_big = imagecreatefromjpeg($img_tmp);
                              $img_new = imagecreate($longueur, $largeur);
                            //CREATION DE LA MINIATURE
                              $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                              //COPIE DE L'IMAGE REDIMENSIONNEE
                              imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                              imagejpeg($img_petite,$finaffiche);
                  }
                //SI PNG
              else if ($tailleaffiche['mime']=='image/png' ) {
                              //OUVERTURE DE L'IMAGE ORIGINALE
                              $img_big = imagecreatefrompng($img_tmp); // On ouvre l'image d'origine
                              $img_new = imagecreate($longueur, $largeur);
                              //CREATION DE LA MINIATURE
                              $img_petite = imagecreatetruecolor($longueur, $largeur) OR $img_petite = imagecreate($longueur, $largeur);
                              //COPIE DE L'IMAGE REDIMENSIONNEE
                              imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                              imagepng($img_petite,$finaffiche);
                          }
                          // GIF
                else if ($tailleaffiche['mime']=='image/gif' ) {
                              //OUVERTURE DE L'IMAGE ORIGINALE
                              $img_big = imagecreatefromgif($img_tmp);
                              $img_new = imagecreate($longueur, $largeur);
                              //CREATION DE LA MINIATURE
                              $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                              //COPIE DE L'IMAGE REDIMENSIONNEE
                              imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                              imagegif($img_petite,$finaffiche);


                        }
                        require('includes/miseajourdusite.php');
                  }

}else {
   $messagenotif = 'Désolé, une erreur est survenue durant l\'upload';
   $type = "warning";
} } }else{
  $messagenotif = 'Désolé, la catégorie existe déja';
  $type = "warning";

}}


if(isset($_POST['videosubmit'])){
  $lienvideo = $_POST['lienvideo'];
  $catvideo = $_POST['catvideo'];


      $target_dir = "../../../JamFichiers/Photos";

      $original = 'Original';
      if (file_exists($target_dir/$original/$catvideo)){
        $target_dirnew = "$target_dir/$original/$catvideo/";
      }else{
        mkdir("$target_dir/$original/$catvideo", 0700);
        $target_dirnew = "$target_dir/$original/$catvideo/";
      }


      //Ajout thumb
      $thumb = 'Thumb';
      if (file_exists($target_dir/$thumb/$catvideo)) {
        $target_dirnewthumb = "$target_dir/$thumb/$catvideo/";
      }else{
        mkdir("$target_dir/$thumb/$catvideo", 0700);
        $target_dirnewthumb = "$target_dir/$thumb/$catvideo/";
      }


      $affiche = 'Affiche';
      if (file_exists($target_dir/$affiche/$catvideo)) {
        $target_dirnewaffiche = "$target_dir/$affiche/$catvideo/";
      }else{
        mkdir("$target_dir/$affiche/$catvideo", 0700);
        $target_dirnewaffiche = "$target_dir/$affiche/$catvideo/";
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
if ($_FILES["fileToUploadVideo"]["size"] > 2000000) {
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
    $messagenotif = 'Désolé, votre fichier n\'a pas été uploadé';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $target_filefile = basename($_FILES["fileToUploadVideo"]["name"]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUploadVideo"]["name"]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUploadVideo"]["name"]);

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
                        // GIF
              else if ($taille['mime']=='image/gif' ) {
                            //OUVERTURE DE L'IMAGE ORIGINALE
                            $img_big = imagecreatefromgif($img_tmp);
                            $img_new = imagecreate($longueur, $largeur);
                            //CREATION DE LA MINIATURE
                            $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                            //COPIE DE L'IMAGE REDIMENSIONNEE
                            imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                            imagegif($img_petite,$fin);
                      }
                      require('includes/miseajourdusite.php');
                }

                //Affiche Grande
                // Destination
                $img_tmp = $target_dirnew.$target_filefile;
                $finaffiche = $target_dirnewaffiche.$target_filefile;

                //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
                  $longueur = 1024;
                  $largeur = 700;
                  //TAILLE DE L'IMAGE ACTUELLE
                  $tailleaffiche = getimagesize($img_tmp);
                  //SI LE FICHIER EXISTE
                  if ($tailleaffiche) {
                      //SI JPG
                      if ($tailleaffiche['mime']=='image/jpeg' ) {
                                //OUVERTURE DE L'IMAGE ORIGINALE
                                  $img_big = imagecreatefromjpeg($img_tmp);
                                  $img_new = imagecreate($longueur, $largeur);
                                //CREATION DE LA MINIATURE
                                  $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                                  //COPIE DE L'IMAGE REDIMENSIONNEE
                                  imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                                  imagejpeg($img_petite,$finaffiche);
                      }
                    //SI PNG
                  else if ($tailleaffiche['mime']=='image/png' ) {
                                  //OUVERTURE DE L'IMAGE ORIGINALE
                                  $img_big = imagecreatefrompng($img_tmp); // On ouvre l'image d'origine
                                  $img_new = imagecreate($longueur, $largeur);
                                  //CREATION DE LA MINIATURE
                                  $img_petite = imagecreatetruecolor($longueur, $largeur) OR $img_petite = imagecreate($longueur, $largeur);
                                  //COPIE DE L'IMAGE REDIMENSIONNEE
                                  imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                                  imagepng($img_petite,$finaffiche);
                              }
                              // GIF
                    else if ($tailleaffiche['mime']=='image/gif' ) {
                                  //OUVERTURE DE L'IMAGE ORIGINALE
                                  $img_big = imagecreatefromgif($img_tmp);
                                  $img_new = imagecreate($longueur, $largeur);
                                  //CREATION DE LA MINIATURE
                                  $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                                  //COPIE DE L'IMAGE REDIMENSIONNEE
                                  imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                                  imagegif($img_petite,$finaffiche);
                            }
                            require('includes/miseajourdusite.php');
                      }

    }else {
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } }

if(isset($_POST['submit'])){
  $catimage = $_POST['catimage'];


  $selecticon = $db->prepare("SELECT icon FROM images WHERE title=:catimage");
  $selecticon->execute(array(
      "catimage"=>$catimage
      )
  );
  $ricon = $selecticon->fetch(PDO::FETCH_OBJ);
  $nomicon = $ricon->icon;


      $target_dir = "../../../JamFichiers/Photos";

      $original = 'Original';
      if (file_exists($target_dir/$original/$catimage)) {
        $target_dirnew = "$target_dir/$original/$catimage/";
      }else{
        mkdir("$target_dir/$original/$catimage", 0700);
        $target_dirnew = "$target_dir/$original/$catimage/";
      }

      //Ajout thumb
      $thumb = 'Thumb';
      if (file_exists($target_dir/$thumb/$catimage)) {
        $target_dirnewthumb = "$target_dir/$thumb/$catimage/";
      }else{
        mkdir("$target_dir/$thumb/$catimage", 0700);
        $target_dirnewthumb = "$target_dir/$thumb/$catimage/";
      }

      $affiche = 'Affiche';
      if (file_exists($target_dir/$affiche/$catimage)) {
        $target_dirnewaffiche = "$target_dir/$affiche/$catimage/";
      }else{
        mkdir("$target_dir/$affiche/$catimage", 0700);
        $target_dirnewaffiche = "$target_dir/$affiche/$catimage/";
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
if ($_FILES["fileToUpload"]["size"][$i] > 2000000) {
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
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');

        $insertinfos = $db->prepare("INSERT INTO images (title, albumactif, icon, file_name, uploaded_on, status) VALUES(:title, :albumactif, :icon, :file_name, :date, :status)");
        $insertinfos->execute(array(

            "title"=>$catimage,
            "albumactif"=>'1',
            "icon"=>$nomicon,
            "file_name"=>$target_filefile,
            "date"=>$date,
            "status"=>$status
            )
        );
        $db->query("UPDATE images SET albumactif='1' WHERE title='$catimage'");
        $db->query("UPDATE images SET albumactif='0' WHERE title <> '$catimage'");
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
                        // GIF
              else if ($taille['mime']=='image/gif' ) {
                            //OUVERTURE DE L'IMAGE ORIGINALE
                            $img_big = imagecreatefromgif($img_tmp);
                            $img_new = imagecreate($longueur, $largeur);
                            //CREATION DE LA MINIATURE
                            $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                            //COPIE DE L'IMAGE REDIMENSIONNEE
                            imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                            imagegif($img_petite,$fin);
                      }
                      require('includes/miseajourdusite.php');
                }

                //Affiche Grande
                // Destination
                $img_tmp = $target_dirnew.$target_filefile;
                $finaffiche = $target_dirnewaffiche.$target_filefile;

                //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
                  $longueur = 1024;
                  $largeur = 700;
                  //TAILLE DE L'IMAGE ACTUELLE
                  $tailleaffiche = getimagesize($img_tmp);
                  //SI LE FICHIER EXISTE
                  if ($tailleaffiche) {
                      //SI JPG
                      if ($tailleaffiche['mime']=='image/jpeg' ) {
                                //OUVERTURE DE L'IMAGE ORIGINALE
                                  $img_big = imagecreatefromjpeg($img_tmp);
                                  $img_new = imagecreate($longueur, $largeur);
                                //CREATION DE LA MINIATURE
                                  $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                                  //COPIE DE L'IMAGE REDIMENSIONNEE
                                  imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                                  imagejpeg($img_petite,$finaffiche);
                      }
                    //SI PNG
                  else if ($tailleaffiche['mime']=='image/png' ) {
                                  //OUVERTURE DE L'IMAGE ORIGINALE
                                  $img_big = imagecreatefrompng($img_tmp); // On ouvre l'image d'origine
                                  $img_new = imagecreate($longueur, $largeur);
                                  //CREATION DE LA MINIATURE
                                  $img_petite = imagecreatetruecolor($longueur, $largeur) OR $img_petite = imagecreate($longueur, $largeur);
                                  //COPIE DE L'IMAGE REDIMENSIONNEE
                                  imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                                  imagepng($img_petite,$finaffiche);
                              }
                              // GIF
                    else if ($tailleaffiche['mime']=='image/gif' ) {
                                  //OUVERTURE DE L'IMAGE ORIGINALE
                                  $img_big = imagecreatefromgif($img_tmp);
                                  $img_new = imagecreate($longueur, $largeur);
                                  //CREATION DE LA MINIATURE
                                  $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);
                                  //COPIE DE L'IMAGE REDIMENSIONNEE
                                  imagecopyresampled($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$tailleaffiche[0],$tailleaffiche[1]);
                                  imagegif($img_petite,$finaffiche);
                            }
                            require('includes/miseajourdusite.php');
                      }

    }else {
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } } }
 ?>
<script>

Dropzone.options.myawesomedropzone = { // The camelized version of the ID of the form element

  // The configuration we've talked about above
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 100,
  maxFiles: 100,

  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
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
                 <div class="col-sm-6">
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
                <div class="col-sm-6">
                  <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                    <div class="card-content">
                      <h3 class="card-title text-center">Catégorie de vidéos</h3>
                      <br>
                      <div class="form-group label-floating">
                          <label class="control-label">Nom de la catégorie</label>
                          <input type="text" class="form-control" name="nomcategorievideo">
                      </div>
                      <div class="form-group label-floating">
                          <label class="control-label">Lien vidéo</label>
                          <input type="text" class="form-control" name="liencatvideo">
                      </div>
                      <div class="form-group form-file-upload">
                          <input type="file" id="fileToUploadCatVideo" name="fileToUploadCatVideo" multiple="multiple">
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
                        <buttontype="submit" name="catvideosubmit" class="btn btn-primary btn-round btn-rose">Créer une catégorie de vidéo</button>
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
               <div class="col-md-6">
       <!-- Dropzone -->
      
               <!-- Card header -->

               <!-- Card body -->






             <form action="ajax/addimage.php"
       class="dropzone"
       id="myawesomedropzone"></form>





           </div>

















              <div class="col-sm-6">
                <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                  <div class="card-content">
                    <h3 class="card-title text-center">Ajouter des vidéos</h3>
                    <br>
                    <div class="jquerysel">
                      <select class="selectpicker" data-style="select-with-transition" title="Sélectionner de la catégorie" data-size="4" name="catimage">
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

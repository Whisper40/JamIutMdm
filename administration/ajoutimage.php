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
    echo 'isnull';
  }
//A REFAIRE
  if($countcheckimages == '0'){
    echo 'james';


      $target_dir = "../../../JamFichiers/Photos";

      $original = 'Original';
      if (file_exists($target_dir/$original/$nomcategorieimage)){
        $target_dirnew = "$target_dir/$original/$nomcategorieimage/";
      }else{
        mkdir("$target_dir/$original/$nomcategorieimage", 0700);
        $target_dirnew = "$target_dir/$original/$nomcategorieimage/";
      }

      //Ajout thumb
      $thumb = 'Thumb';
      if (file_exists($target_dir/$thumb/$nomcategorieimage)) {
        $target_dirnewthumb = "$target_dir/$thumb/$nomcategorieimage/";
      }else{
        mkdir("$target_dir/$thumb/$nomcategorieimage", 0700);
        $target_dirnewthumb = "$target_dir/$thumb/$nomcategorieimage/";
      }

      $affiche = 'Affiche';
      if (file_exists($target_dir/$affiche/$nomcategorieimage)) {
        $target_dirnewaffiche = "$target_dir/$affiche/$nomcategorieimage/";
      }else{
        mkdir("$target_dir/$affiche/$nomcategorieimage", 0700);
        $target_dirnewaffiche = "$target_dir/$affiche/$nomcategorieimage/";
      }


      //FIN



$target_file = $target_dirnew . basename($_FILES["fileToUploadCatImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    $messagenotif = 'Désolé, le fichier existe déja.';
    $type = "warning";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUploadCatImage"]["size"] > 2000000) {
    $messagenotif = 'Désolé, le fichier est trop grand.';
    $type = "warning";
    $uploadOk = 0;

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "rar") {

    $messagenotif = 'Désolé, Seuls les formats JPG, PNG, GIF sont autorisés';
    $type = "warning";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $messagenotif = 'Désolé, votre fichier n\'a pas été uploadé.';
    $type = "warning";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $target_filefile = basename($_FILES["fileToUploadCatImage"]["name"]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUploadCatImage"]["name"]);
  $target_file3 = $target_dirnew."".basename($_FILES["fileToUploadCatImage"]["name"]);

    if (move_uploaded_file($_FILES["fileToUploadCatImage"]["tmp_name"], $target_file3)) {

        $messagenotif = "Le fichier ". basename( $_FILES["fileToUploadCatImage"]["name"]). " à bien été uploadé.";
        $type = "success";
        $status = '1';
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');

        $insertinfos = $db->prepare("INSERT INTO images (title, albumactif, icon, file_name, uploaded_on, status) VALUES(:title, :albumactif, :icon, :file_name, :date, :status)");
        $insertinfos->execute(array(

            "title"=>$nomcategorieimage,
            "albumactif"=>'1',
            "icon"=>$nomicon,
            "file_name"=>$target_filefile,
            "date"=>$date,
            "status"=>$status
            )
        );
        $db->query("UPDATE images SET albumactif='1' WHERE title='$nomcategorieimage'");
        $db->query("UPDATE images SET albumactif='0' WHERE title <> '$nomcategorieimage'");
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
                      }

    }else {
        $messagenotif = 'Désolé, une erreur est survenue';
        $type = "warning";
    } } }else{

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
                      }

    }else {
        $messagenotif = 'Désolé, une erreur est survenue.';
        $type = "warning";
    } } } }
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
                       <div class="form-group form-file-upload">
                           <input type="file" id="fileToUploadCatImage" name="fileToUploadCatImage" multiple="multiple">
                           <div class="input-group">
                               <input type="text" readonly="" class="form-control" placeholder="Insérer la miniature de l'image">
                               <span class="input-group-btn input-group-s">
                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                       <i class="material-icons">layers</i>
                                   </button>
                               </span>
                           </div>
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
                       <iframe src="https://jam-mdm.fr/icons.php"></iframe>
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
               <div class="col-sm-6">
                 <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                   <div class="card-content">
                     <h3 class="card-title text-center">Ajouter des images</h3>
                     <br><br><br><br>
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
                     <div class="form-group form-file-upload">
                         <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                         <div class="input-group">
                             <input type="text" readonly="" class="form-control" placeholder="Insérer les photos à ajouter">
                             <span class="input-group-btn input-group-s">
                                 <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                     <i class="material-icons">layers</i>
                                 </button>
                             </span>
                         </div>
                     </div>
                     <center>
                       <button type="submit" name="submit" class="btn btn-primary btn-round btn-rose">Ajouter les images</button>
                     </center>
                   </div>
                </form>
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

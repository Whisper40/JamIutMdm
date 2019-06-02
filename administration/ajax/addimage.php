<?php
require_once('../includes/connectBDD.php');
//allowed file types
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
$nomcategorieimage = $_POST['catimage'];

$selecticon = $db->prepare("SELECT icon FROM images WHERE title=:catimage");
  $selecticon->execute(array(
      "catimage"=>$nomcategorieimage
      )
  );
  $ricon = $selecticon->fetch(PDO::FETCH_OBJ);
  $nomicon = $ricon->icon;

$user_id = $_SESSION['admin_id'];
if(isset($user_id)&&!empty($user_id)){
   echo '0';

  $total = count($_FILES['file']['name']);

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

 echo '1';
  for( $i=0 ; $i < $total ; $i++ ) {
    $target_file = $target_dirnew . basename($_FILES["file"]["name"][$i]);
	$imagenouvelle = rand(0, 1000) . $_FILES['file']['name'][$i];
 echo '2';
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d:%m:%y %H:%M:%S');
    $target_filefile = basename($_FILES["file"]["name"][$i]);
      $target_file2 = $target_dirnew."".$date.basename($_FILES["file"]["name"][$i]);
      $target_file3 = $target_dirnew."".basename($_FILES["file"]["name"][$i]);
      echo $target_file3;
 echo '3';
if (move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_file3)) {
   echo '4';
      $status = '1';
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
        echo '5';
       $db->query("UPDATE images SET albumactif='1' WHERE title='$nomcategorieimage'");
       $db->query("UPDATE images SET albumactif='0' WHERE title <> '$nomcategorieimage'");



 echo '5';



    //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE
          $img_tmp = $target_dirnew.$target_filefile;
          $fin = $target_dirnewthumb.$target_filefile;
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

 echo '3';
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


echo 'success for all';


  }else{
    die();
  }
}



	die();
}else{
	die();
}
?>

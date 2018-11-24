<?php
    require_once('includes/connectBDD.php');
    $nompage = "Nous Contacter";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');
ini_set('display_errors', 1);
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


<body class="landing-page sidebar-collapse">
  <div class="wrapper">

    <h1>Les formulaires HTML</h1>


    <?php
  $selectcatimages=$db->query("SELECT DISTINCT title FROM images");

     ?>

            <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                Sélectionner la catégorie de l'image<br>
                <select name="catimage">
                  <?php
                    while($s = $selectcatimages->fetch(PDO::FETCH_OBJ)){
                      $catimage=$s->title;
                      ?>
                    <option value="<?php echo $catimage;?>"><?php echo $catimage; ?></option>
                  <?php
                }
                ?>


                </select>

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

                <input type="submit" name="submit" value="Envoyer le formulaire !">
            </form>

  </div>

  <?php
  if(isset($_POST['submit'])){
    $catimage = $_POST['catimage'];

        $target_dir = "../../../JamFichiers/Photos";


        if (file_exists($target_dir/$catimage)) {
          $target_dirnew = "$target_dir/$catimage/";
        }else{
          mkdir("$target_dir/$catimage", 0700);
          $target_dirnew = "$target_dir/$catimage/";
        }

        //Ajout thumb
        $thumb = 'Thumb';
        if (file_exists($target_dir/$thumb/$catimage)) {
          $target_dirnewthumb = "$target_dir/$thumb/$catimage/";
        }else{
          mkdir("$target_dir/$thumb/$catimage", 0700);
          $target_dirnewthumb = "$target_dir/$thumb/$catimage/";
        }


        //FIN


  $total = count($_FILES['fileToUpload']['name']);

  for( $i=0 ; $i < $total ; $i++ ) {
  $target_file = $target_dirnew . basename($_FILES["fileToUpload"]["name"][$i]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size < 2mo
  if ($_FILES["fileToUpload"]["size"][$i] > 2000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;

  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "rar") {
      echo "Sorry, only JPG, JPEG, PNG & GIF, ZIP and RAR files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d:%m:%y %H:%M:%S');

    $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
    $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
    $target_file3 = $target_dirnew."".basename($_FILES["fileToUpload"]["name"][$i]);

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"][$i]). " has been uploaded.";
          $status = '1';
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%Y-%m-%d %H:%M:%S');

          $insertinfos = $db->prepare("INSERT INTO images (title, icon, file_name, uploaded_on, status) VALUES(:title, :icon, :file_name, :date, :status)");
          $insertinfos->execute(array(

              "title"=>$catimage,
              "icon"=>'design_image',
              "file_name"=>$target_filefile,
              "date"=>$date,
              "status"=>$status
              )
          );

          $img_tmp = $target_dirnew.$target_filefile;
          $fin = $target_dirnewthumb.$target_filefile;
          echo $img_tmp;

            //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE

              $longueur = '50';

              $largeur = '50';


              //TAILLE DE L'IMAGE ACTUELLE

              $taille = getimagesize($img_tmp);
echo 'taille';

                        //SI LE FICHIER EXISTE

              if ($taille) {



                  //SI JPG

                  if ($taille['mime']=='image/jpeg' ) {
                    echo 'mime';

                      //OUVERTURE DE L'IMAGE ORIGINALE

                      $img_big = imagecreatefromjpeg($img_tmp);

                      $img_new = imagecreate($longueur, $largeur);



                    //CREATION DE LA MINIATURE

                      $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);



                      //COPIE DE L'IMAGE REDIMENSIONNEE

                      imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
echo 'toto';
                      imagejpeg($img_petite,$fin);
echo'lili';

                  }}







      }else {
          echo "Sorry, there was an error uploading your file.";
      } } }

            } ?>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

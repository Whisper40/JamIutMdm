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
  window.location="https://administration.jam-mdm.fr/modifdespages.php"
}
</script>


<body>
    <div class="wrapper">

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
        $nomsouscat = "	Actualités";
      }else if ($_GET['page']=='activitesvoyages'){
        $nomsouscat = "Activités / Voyage";
      }else if ($_GET['page']=='galerie'){
        $nomsouscat = "Galerie";
      }else if ($_GET['page']=='nouscontacter'){
        $nomsouscat = "	Nous contacter";
      }else if ($_GET['page']=='faireundon'){
        $nomsouscat = "Faire un don";
      }else if ($_GET['page']=='faireundonpaiement'){
        $nomsouscat = "Faire un don2";
      }

      require_once('includes/navbar.php');

    if($_GET['page']=='index'){
      $table = $_GET['table'];
    ?>



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
    var logo2 = $("#logo2").val();
    var titre2 = $("#titre2").val();
    var description2 = $("#description2").val();
    var fb = $("#fb").val();
    $.post("ajax/modifypageindex.php", { user_id: user_id, id:id, titre1: titre1, description1: description1, bouton1: bouton1, lienbt1: lienbt1, bouton2: bouton2, lienbt2: lienbt2, logo2: logo2, titre2: titre2, description2: description2, fb: fb},
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


        $update = $db->prepare("UPDATE pageindex SET img1=:img1");
        $update->execute(array(
            "img1"=>$target_filefile
            )
        );
        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification de l\'index',
                            "page"=>'index.php',
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


                  $update = $db->prepare("UPDATE pageindex SET logo1=:logo1");
                  $update->execute(array(
                      "logo1"=>$target_filefile
                      )
                  );
                  $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                  $insertlogs->execute(array(
                                      "user_id"=>$user_id,
                                      "type"=>'Modification',
                                      "action"=>'Modification de l\'index',
                                      "page"=>'index.php',
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


  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification de l'index du site</h2>


                  <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">

                                     <div class="form-group form-file-upload">
                                         <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                         <div class="input-group">
                                             <input type="text" readonly="" class="form-control" placeholder="<?php echo $img1; ?>">
                                             <span class="input-group-btn input-group-s">
                                                 <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                     <i class="material-icons">layers</i>
                                                 </button>
                                             </span>
                                         </div>
                                     </div>
                                  </div>

                                  <div class="col-sm-12">
                                      <div class="card-content">
                                          <input type="submit" name="envoieimagefond" value="Modifier l'image du fond">
                                       </div>
                                    </div>
                            </div>
                          </form>



                          <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">

                                             <div class="form-group form-file-upload">
                                                 <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                                 <div class="input-group">
                                                     <input type="text" readonly="" class="form-control" placeholder="<?php echo $logo1; ?>">
                                                     <span class="input-group-btn input-group-s">
                                                         <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                             <i class="material-icons">layers</i>
                                                         </button>
                                                     </span>
                                                 </div>
                                             </div>
                                          </div>

                                          <div class="col-sm-12">
                                              <div class="card-content">
                                                  <input type="submit" name="envoieimagecentrale" value="Modifier l'image centrale">
                                               </div>
                                            </div>
                                    </div>
                                  </form>




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
                                <label class="control-label">Titre Principal</label>
                                <input type="text" name="titre1" value="<?php echo $titre1; ?>" id="titre1" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Description</label>
                                <textarea rows="12" name="description1" id="description1" class="form-control"><?php echo $description1; ?></textarea>
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Logo</label>
                                  <input type="text" name="logo2" value="<?php echo $logo2; ?>" id="logo2" class="form-control">
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
                              <button id="submitFormDataDevenirMembre" onclick="SubmitFormDataDevenirMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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

  <script>


   function SubmitFormDataPageAsso() {
      var user_id = "<?php echo $_SESSION['admin_id']; ?>";
      var id = "<?php echo $id; ?>";
      var titre1 = $("#titre1").val();
      var description1 = $("#description1").val();
      var description2 = $("#description2").val();
      var pagetitre = $("#pagetitre").val();



      $.post("ajax/modifypageassociation.php", { user_id: user_id, id: id, titre1: titre1, description1: description1, description2: description2, pagetitre: pagetitre},
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
                        "nompage"=>'Présentation association',
                        "image"=>$target_filefile
                        )
                    );
                    $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                    $insertlogs->execute(array(
                                        "user_id"=>$user_id,
                                        "type"=>'Modification',
                                        "action"=>'Modification page association',
                                        "page"=>'association.php',
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


    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification de la page association</h2>

                    <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="envoieimageprezasso" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>

                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Titre de la page</label>
                                  <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                              </div>





                              <div class="form-group label-floating">
                                  <label class="control-label">Titre 1</label>
                                  <input type="text" class="form-control" value="<?php echo $titre1; ?>" name="titre1" id="titre1">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Description 1</label>
                                  <input type="text" name="description1" value="<?php echo $description1; ?>" id="description1" class="form-control">
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
                              <button id="submitFormDataPageAsso" onclick="SubmitFormDataPageAsso();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
        $idmembre = $_GET['modifmembre'];
        $update = $db->prepare("UPDATE membres SET image=:image WHERE id=:id");
        $update->execute(array(
            "id"=>$id,
            "image"=>$image
            )
        );


        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page membre',
                            "page"=>'membre.php',
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



    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification des informations</h2>

                    <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifphotomembre" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>




                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Nom</label>
                                  <input type="text" class="form-control" value="<?php echo $nom; ?>" name="nom" id="nom">
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
                              <button id="submitFormDataModifMembre" onclick="SubmitFormDataModifMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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

         $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
         $update->execute(array(
             "nompage"=>'Présentation des membres',
             "image"=>$target_filefile
             )
         );



         $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
         $insertlogs->execute(array(
                             "user_id"=>$user_id,
                             "type"=>'Modification',
                             "action"=>'Modification page membre',
                             "page"=>'membre.php',
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



<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Modification page présentation membres</h2>

                <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                          <div class="row">
                              <div class="col-sm-6">

                                   <div class="form-group form-file-upload">
                                       <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                       <div class="input-group">
                                           <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                           <span class="input-group-btn input-group-s">
                                               <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                   <i class="material-icons">layers</i>
                                               </button>
                                           </span>
                                       </div>
                                   </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="card-content">
                                        <input type="submit" name="envoieimagemembre" value="Modifier l'image">
                                     </div>
                                  </div>
                          </div>
                        </form>


                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre de la page</label>
                              <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
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
                          <button id="submitFormDataMembre" onclick="SubmitFormDataMembre();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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


    $.post("ajax/creationmembre.php", { user_id: user_id, nom: nom, image: image, description: description, grademembre: grademembre, importancegrade: importancegrade, fonction: fonction},
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
                              <input type="text" name="image" value="monimage.jpg" id="image" class="form-control">
                          </div>

                          <div class="jquerysel"><!-- on s'en fout -->
<label>Grade : </label><select id="grademembre" name="grademembre">
<option value="pres">Président</option>
<option value="tres">Trésorier</option>
<option value="secr">Secrétaire</option>
<option value="com">Communication</option>
</select>
</div>

<div class="jquerysel"><!-- on s'en fout -->
<label>Spécification grade : </label><select id="importancegrade" name="importancegrade">
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
                          <button id="submitFormDataCreationMembre" onclick="SubmitFormDataCreationMembre();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
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
                                  <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
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
                              <button id="submitFormDataModifStatus" onclick="SubmitFormDataModifStatus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
?>

<?php
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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Statuts',
            "image"=>$target_filefile
            )
        );

        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page status',
                            "page"=>'statuts.php',
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

  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification de la page Status</h2>

                  <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">

                                     <div class="form-group form-file-upload">
                                         <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                         <div class="input-group">
                                             <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                             <span class="input-group-btn input-group-s">
                                                 <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                     <i class="material-icons">layers</i>
                                                 </button>
                                             </span>
                                         </div>
                                     </div>
                                  </div>

                                  <div class="col-sm-12">
                                      <div class="card-content">
                                          <input type="submit" name="modifphotopagestatus" value="Modifier l'image">
                                       </div>
                                    </div>
                            </div>
                          </form>


                  <form action="" method="post" id="myForm1" class="contact-form">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Titre de la page</label>
                                <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                            </div>

                          <div class="form-group label-floating">
                          <label class="control-label">Titre</label>
                          <input type="text" name="titre" value="<?php echo $titre;?>" id="titre" class="form-control">
                          </div>



                           </div>
                        </div>

                      <div class="col-sm-12">
                          <div class="card-content">

                            <center>
                            <button id="submitFormDataStatusPage" onclick="SubmitFormDataStatusPage();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                            <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                            </center>
                           </div>
                        </div>
                  </div>
                </form>
              </div>
          </div>
      </div>

   <div id="results23"> <!-- TRES IMPORTANT -->
  </div>
  </div>
  <?php




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
   var titrestatus = $("#titrestatus").val();
   var soustitre = $("#soustitre").val();
   var description = $("#description").val();
   $.post("ajax/createpagestatus.php", { user_id: user_id, article: article, titrestatus: titrestatus, soustitre: soustitre, description: description},
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
                              <input type="text" name="titrestatus" value="Titre du status" id="titrestatus" class="form-control">
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
                          <button id="submitFormDataCreateStatus" onclick="SubmitFormDataCreateStatus();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
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
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Modification de l'actualité</h2>
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
                                  <label class="control-label">Format Img</label>
                                  <input type="text" name="formatimg" value="<?php echo $formatimg; ?>" id="formatimg" class="form-control">
                              </div>

                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="submitFormDataModifActualite" onclick="SubmitFormDataModifActualite();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>"Actualité",
            "image"=>$target_filefile
            )
        );


        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page actualitée',
                            "page"=>'actualitees.php',
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








  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification des informations de la page actualitée</h2>

                  <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifphotopageactu" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>

                  <form action="" method="post" id="myForm1" class="contact-form">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">

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
                                <input type="text" name="description" value="<?php echo $description; ?>" id="description" class="form-control">
                            </div>
                           </div>
                        </div>

                      <div class="col-sm-12">
                          <div class="card-content">

                            <center>
                            <button id="submitFormDataModifActus" onclick="SubmitFormDataModifActus();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
        <th scope="col">Action</th>
        </tr>
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
            <th scope="row">'.$title.'</th>
            <td>'.$result.'</td>
            <td>'.$status.'</td>
            <td>
            <a href="?page=actualite&amp;table=newsactus&amp;modifactus='.$id.'">
            <button type="button" class="btn">Modifier</button>
            </a>
            <a href="?page=actualite&amp;table=newsactus&amp;'.$act.'actus='.$id.'">
            <button type="button" class="btn">'.$message.'</button>
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


<script>


function SubmitFormDataCreateUneActu() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var title = $("#title").val();
   var description = $("#description").val();
   var formatimg = $("#formatimg").val();

   $.post("ajax/createuneactu.php", { user_id: user_id, title: title, description: description, formatimg: formatimg},
   function(data) {
    $('#results11').html(data);

   });

}

</script>
<?php
//Création actualite
if(isset($_POST['submitactualite'])){


  $title = $_POST['title'];
  $description = $_POST['description'];
  $formatimg = $_POST['formatimg'];



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
  $target_filefile3 = $slug.".".$formatimg;
  $target_file3 = $target_dirnew."".$slug.".".$formatimg;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
        $succes = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";


        $insert = $db->prepare("INSERT INTO newsactus (title, slug, description, surname, date, formatimg, status) VALUES(:title, :slug, :description, :surname, :date, :formatimg, :status)");
        $insert->execute(array(
                            "title"=>$title,
                            "slug"=>$slug,
                            "description"=>$description,
                            "surname"=>'Actualité',
                            "date"=>$date,
                            "formatimg"=>$formatimg,
                            "status"=>'ACTIVE'
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
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');

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
        $error = 'Désolé, une erreur est survenue.';
    } } }

          } ?>



<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Création d'actualitée</h2>
      <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre</label>
                              <input type="text" class="form-control" value="Titre de l'actualité" name="title" id="title">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <input type="text" name="description" value="Titre du status" id="description" class="form-control">
                          </div>



                        <div class="form-group label-floating">
                        <label class="control-label">Sous Titre</label>
                        <input type="text" name="formatimg" value="jpg" id="formatimg" class="form-control">
                        </div>

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
                      </div>

                      <div class="col-sm-12">
                          <div class="card-content">
                              <input type="submit" name="submitactualite" value="Créer une actualité !">
                           </div>
                        </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results11"> <!-- TRES IMPORTANT -->
</div>




<script>
function SubmitFormDataDeleteActu() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var title = $("#title").val();


   $.post("ajax/deleteuneactu.php", { user_id:user_id, title: title},
   function(data) {
    $('#results20').html(data);

   });

}
</script>

<div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h2 class="card-title text-center">Suppression d'actualité</h2>
            <form action="" method="post" id="myForm1" class="contact-form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-content">
                      Sélectionner l'actualité à supprimer<br><?php

                      $selectactuasupprimer=$db->query("SELECT DISTINCT title FROM newsactus");
                      ?>

                      <select name="catactu">
                        <?php
                          while($sa = $selectactuasupprimer->fetch(PDO::FETCH_OBJ)){
                            $catactu=$sa->title;
                            ?>
                          <option value="<?php echo $catactu;?>"><?php echo $catactu; ?></option>
                        <?php
                      }
                      ?>
                      </select>
                     </div>
                  </div>

                <div class="col-sm-12">
                    <div class="card-content">
                      <center>
                      <button id="submitFormDataDeleteActu" onclick="SubmitFormDataDeleteActu();" type="button" class="btn btn-primary btn-round btn-rose">Supprimer</button>
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



<!-- Ajoutd'images au site web (assets)-->
<?php
if(isset($_POST['submitphotoactualite'])){
  $category = $_POST['catimage'];
  $titreimage = $_POST['titreimage'];
  if(!isset($titreimage)){
    $uploadOk = 0;
  }


  $selectinfosactuel12 = $db->prepare("SELECT slug from newsactus where title=:title");
  $selectinfosactuel12->execute(array(
      "title"=>$category
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


        $insert = $db->prepare("INSERT INTO carousel (slug, titre, image, titreimage) VALUES (:slug, :category, :target_filefile, :titreimage)");
        $insert->execute(array(
            "slug"=>$slug,
            "category"=>$category,
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


<!-- TEST -->


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
url: "rechercheactus.php",
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





<!-- TEST -->

<h1>Selectionner la catégorie à laquelle ajouter les photos</h1>


<?php
$selectcatimages=$db->query("SELECT * FROM newsactus");

 ?>

        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            Sélectionner la catégorie d'actualité<br>
            <select name="catactualite">
              <?php
                while($s = $selectcatimages->fetch(PDO::FETCH_OBJ)){
                  $title =$s->title;
                  $id = $s->id;
                  echo '<option value="'.$id.'">'.$id.'</option>';
            }
            ?>
            </select>
            <label>City :</label>
            <select name="souscatactualite">
<option>Select City</option>
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

</div>




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

echo 'Jamesbond';


if (file_exists($target_dir)){
  unlink("$target_dir/$valnom");
  $updatedelete = $db->prepare("DELETE FROM carousel WHERE image=:image");
  $updatedelete->execute(array(
    "image"=>$valnom

  ));
  $succes = "Le fichier.$valnom. à bien été supprimé";

}else{
  echo 'n extse pas';
  $error = 'Un problème de répertoire est présent, contacter votre administrateur !';
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
      var title3 = $("#titre3").val();
      var description3 = $("#description3").val();
      var formatimg = $("#formatimg").val();
      var stock = $("#stock").val();
      $.post("ajax/modifyallactivity.php", { user_id: user_id, id: id, title: title, description: description, title2: title2, description2: description2, title3: title3, description3: description3, formatimg: formatimg, stock: stock},
      function(data) {
       $('#results11').html(data);

      });

  }

  </script>
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
                                  <label class="control-label">Format Img</label>
                                  <input type="text" name="formatimg" value="<?php echo $formatimg; ?>" id="formatimg" class="form-control">
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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Activité / Voyage',
            "image"=>$target_filefile
            )
        );

        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Activités/Voyages',
                            "page"=>'activitees.php',
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





  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification des informations de la page Activités/Voyages</h2>


                  <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifphotopageactivoyages" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>



                  <form action="" method="post" id="myForm1" class="contact-form">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">

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
                                <input type="text" name="description" value="<?php echo $description; ?>" id="description" class="form-control">
                            </div>
                           </div>
                        </div>

                      <div class="col-sm-12">
                          <div class="card-content">

                            <center>
                            <button id="submitFormDataModifActivitesVoyages" onclick="SubmitFormDataModifActivitesVoyages();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                            <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                            </center>
                           </div>
                        </div>
                  </div>
                </form>
              </div>
          </div>
      </div>

   <div id="results18"> <!-- TRES IMPORTANT -->
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

        echo "<h3>".count($tableactivitesvoyages)." activités trouvés</h3>";
        echo '
        <table class="table">
        <thead>
        <tr>
        <th scope="col">Titre</th>
        <th scope="col">Description</th>
        <th scope="col">Place Restantes</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
        </tr>
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
            <th scope="row">'.$title.'</th>
            <td>'.$result.'</td>
            <td>'.$stock.'</td>
            <td>'.$status.'</td>
            <td>
            <a href="?page=activitesvoyages&amp;table=activitesvoyages&amp;modifactivitesvoyages='.$id.'">
            <button type="button" class="btn">Modifier</button>
            </a>
            <a href="?page=activitesvoyages&amp;table=activitesvoyages&amp;'.$act.'activitesvoyages='.$id.'">
            <button type="button" class="btn">'.$message.'</button>
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
        $error = "Aucune activitée trouvée";
      }


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
    $formatimg = $_POST['formatimg'];
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
    $target_filefile3 = $slug.".".$formatimg;
    $target_file3 = $target_dirnew."".$slug.".".$formatimg;

      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file3)) {
          $succes = "Le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à bien été uploadé.";


          $insert = $db->prepare("INSERT INTO activitesvoyages (title, slug, description, surname, date, formatimg, status, stock, datesejour, price, payant) VALUES(:title, :slug, :description, :surname, :date, :formatimg, :status, :stock, :datesejour, :price, :payant)");
          $insert->execute(array(
                              "title"=>$title,
                              "slug"=>$slug,
                              "description"=>$description,
                              "surname"=>'Activités / Voyages',
                              "date"=>$date,
                              "formatimg"=>$formatimg,
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
          date_default_timezone_set('Europe/Paris');
          setlocale(LC_TIME, 'fr_FR.utf8','fra');
          $date = strftime('%Y-%m-%d %H:%M:%S');

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
          $error = 'Désolé, une erreur est survenue.';
      } } }

            } ?>

  <div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Création d'activité/voyages</h2>
            <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre</label>
                              <input type="text" class="form-control" value="Titre de l'activité" name="title" id="title">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Description</label>
                              <input type="text" name="description" value="Sa description" id="description" class="form-control">
                          </div>



                        <div class="form-group label-floating">
                        <label class="control-label">Format Image</label>
                        <input type="text" name="formatimg" value="jpg" id="formatimg" class="form-control">
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

                        <div class="form-group label-floating">
                        <label class="control-label">Stock</label>
                        <input type="number" name="stock" value="1" id="stock" class="form-control">
                        </div>

                        <div class="form-group label-floating">
                        <label class="control-label">Date (XX/XX/2018 - XX/XX/2019)</label>
                        <input type="text" name="datesejour" value="29/08/2019" id="datesejour" class="form-control">
                        </div>

                        <div class="form-group label-floating">
                        <label class="control-label">Price</label>
                        <input type="number" name="price" value="1" id="price" class="form-control">
                        </div>



                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">
                            <input type="submit" name="submitactivite" value="Crée l'activité!">
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

  <div id="results11"> <!-- TRES IMPORTANT -->
  </div>




  <script>
  function SubmitFormDataDeleteActivitevoyages() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var title = $("#title").val();

//AFAIRE
   $.post("ajax/deleteuneactivitevoyage.php", { user_id: user_id, title: title},
   function(data) {
    $('#results20').html(data);

   });

  }
  </script>

  <div class="container-fluid">
    <div class="card">
        <div class="card-content">
            <h2 class="card-title text-center">Suppression d'activité/voyages</h2>
            <form action="" method="post" id="myForm1" class="contact-form">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card-content">
                      Sélectionner l'activitée à supprimer<br><?php

                      $selectactivitevoyagesupprimer=$db->query("SELECT DISTINCT title FROM activitesvoyages");
                      ?>

                      <select name="catactu">
                        <?php
                          while($sa = $selectactivitevoyagesupprimer->fetch(PDO::FETCH_OBJ)){
                            $catactivitevoyage=$sa->title;
                            ?>
                          <option value="<?php echo $catactivitevoyage;?>"><?php echo $catactivitevoyage; ?></option>
                        <?php
                      }
                      ?>
                      </select>
                     </div>
                  </div>

                <div class="col-sm-12">
                    <div class="card-content">
                      <center>
                      <button id="submitFormDataDeleteActivitevoyages" onclick="SubmitFormDataDeleteActivitevoyages();" type="button" class="btn btn-primary btn-round btn-rose">Supprimer</button>
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



  <!-- Ajoutd'images au site web (assets)-->
  <?php
  if(isset($_POST['submitphotoaactivitesvoyagescarousel'])){
  $category = $_POST['catactivitevoyage'];
  $titreimage = $_POST['titreimage'];
  if(!isset($titreimage)){
    $uploadOk = 0;
  }


  $selectinfosactuel12 = $db->prepare("SELECT slug from activitesvoyages where title=:title");
  $selectinfosactuel12->execute(array(
      "title"=>$category
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


        $insert = $db->prepare("INSERT INTO carousel (slug, titre, image, titreimage) VALUES (:slug, :category, :target_filefile, :titreimage)");
        $insert->execute(array(
            "slug"=>$slug,
            "category"=>$category,
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
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%Y-%m-%d %H:%M:%S');

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
        $error = 'Désolé, une erreur est survenue.';
    } } }

          } ?>




  <h1>Selectionner la catégorie à laquelle ajouter les photos</h1>


  <?php
  $selectcatactivitesvoyages=$db->query("SELECT DISTINCT title FROM activitesvoyages");

  ?>

        <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            Sélectionner la catégorie d'activité<br>
            <select name="catactivitevoyage">
              <?php
                while($s = $selectcatactivitesvoyages->fetch(PDO::FETCH_OBJ)){
                  $catactivitesvoyages=$s->title;
                  ?>
                <option value="<?php echo $catactivitesvoyages;?>"><?php echo $catactivitesvoyages; ?></option>
              <?php
            }
            ?>


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

  echo 'Jamesbond';


  if (file_exists($target_dir)){
  unlink("$target_dir/$valnom");
  $updatedelete = $db->prepare("DELETE FROM carousel WHERE image=:image");
  $updatedelete->execute(array(
    "image"=>$valnom

  ));
  unlink("$target_dirthumb/$valnom");
  $succes = "Le fichier.$valnom. à bien été supprimé";

  }else{
  echo 'n extse pas';
  $error = 'Un problème de répertoire est présent, contacter votre administrateur !';
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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Galerie',
            "image"=>$target_filefile
            )
        );

        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Activités/Voyages',
                            "page"=>'activitees.php',
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



<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Modification de la page Galerie</h2>







<form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifphotogalerie" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>



                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre de la page</label>
                              <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                          </div>

                        <div class="form-group label-floating">
                        <label class="control-label">Titre</label>
                        <input type="text" name="titre" value="<?php echo $titre;?>" id="titre" class="form-control">
                        </div>



                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="submitFormDataGallerie" onclick="SubmitFormDataGallerie();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results22"> <!-- TRES IMPORTANT -->
</div>
</div>


<h3> Pour ajouter des images concernant la galerie, c'est ici : </h3>
<a href="https://administration.jam-mdm.fr/ajoutimage.php" target="_blank" class="w3-button w3-black">Ajouter des images</a>


<h3> Pour gérer les images concernant la galerie, c'est ici : </h3>
<a href="https://administration.jam-mdm.fr/gestionimage.php" target="_blank" class="w3-button w3-black">Gérer les images</a>


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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Nous Contacter',
            "image"=>$target_filefile
            )
        );

        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Nous Contacter',
                            "page"=>'contact.php',
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







<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Modification de la page Contactez-nous</h2>





<form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifphotocontacteznous" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>



                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre de la page</label>
                              <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                          </div>
                          <div class="form-group label-floating">
                              <label class="control-label">Images</label>
                              <input type="text" name="image" value="<?php echo $image; ?>" id="image" class="form-control">
                          </div>



                        <div class="form-group label-floating">
                        <label class="control-label">Titre</label>
                        <input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" class="form-control">
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
                          <button id="submitFormDataContactUs" onclick="SubmitFormDataContactUs();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results22"> <!-- TRES IMPORTANT -->
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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Faire un don',
            "image"=>$target_filefile
            )
        );

        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Faire Un Don',
                            "page"=>'don.php',
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







<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Modification de la page Faire Un Don</h2>

                <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifpagedon" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>


                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre de la page</label>
                              <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                          </div>
                        <div class="form-group label-floating">
                        <label class="control-label">Titre</label>
                        <input type="text" name="titre" value="<?php echo $titre;?>" id="titre" class="form-control">
                        </div>

                        <div class="form-group label-floating">
                        <label class="control-label">Description</label>
                        <input type="text" name="description" value="<?php echo $description;?>" id="description" class="form-control">
                        </div>

                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="submitFormDataFaireUnDon" onclick="SubmitFormDataFaireUnDon();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results23"> <!-- TRES IMPORTANT -->
</div>
</div>




<?php

//Fin modif don

}else if ($_GET['page']=='faireundonpaiement'){

//Modif page faire un don paiement

?>

<?php
$selectinfosactuel46 = $db->prepare("SELECT * from photopage where nompage=:nompage");
$selectinfosactuel46->execute(array(
  "nompage"=>'Faire un don paiement'
));
$r46 = $selectinfosactuel46->fetch(PDO::FETCH_OBJ);
$pagetitre = $r46->pagetitre;
$image = $r46->image;
$titre = $r46->titre;
$description = $r46->description;

?>
<script>


function SubmitFormDataFaireUnDonPaiement() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var pagetitre = $("#pagetitre").val();
   var titre = $("#titre").val();
   var description = $("#description").val();

   $.post("ajax/modifypagefaireundonpaiement.php", { user_id: user_id, pagetitre: pagetitre, titre: titre, description: description},
   function(data) {
    $('#results23').html(data);

   });

}

</script>


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
        $update = $db->prepare("UPDATE photopage SET image=:image WHERE nompage=:nompage");
        $update->execute(array(
            "nompage"=>'Faire un don paiement',
            "image"=>$target_filefile
            )
        );


        $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
        $insertlogs->execute(array(
                            "user_id"=>$user_id,
                            "type"=>'Modification',
                            "action"=>'Modification page Faire Un Don',
                            "page"=>'don.php',
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






<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <h2 class="card-title text-center">Modification de la page Faire Un Don Paiement</h2>

                <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-sm-6">

                                       <div class="form-group form-file-upload">
                                           <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                           <div class="input-group">
                                               <input type="text" readonly="" class="form-control" placeholder="<?php echo $image; ?>">
                                               <span class="input-group-btn input-group-s">
                                                   <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                       <i class="material-icons">layers</i>
                                                   </button>
                                               </span>
                                           </div>
                                       </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="card-content">
                                            <input type="submit" name="modifpagedonpaiement" value="Modifier l'image">
                                         </div>
                                      </div>
                              </div>
                            </form>


                <form action="" method="post" id="myForm1" class="contact-form">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-content">
                          <div class="form-group label-floating">
                              <label class="control-label">Titre de la page</label>
                              <input type="text" class="form-control" value="<?php echo $pagetitre; ?>" name="pagetitre" id="pagetitre">
                          </div>

                        <div class="form-group label-floating">
                        <label class="control-label">Titre</label>
                        <input type="text" name="titre" value="<?php echo $titre;?>" id="titre" class="form-control">
                        </div>

                        <div class="form-group label-floating">
                        <label class="control-label">Description</label>
                        <input type="text" name="description" value="<?php echo $description;?>" id="description" class="form-control">
                        </div>

                         </div>
                      </div>

                    <div class="col-sm-12">
                        <div class="card-content">

                          <center>
                          <button id="submitFormDataFaireUnDonPaiement" onclick="SubmitFormDataFaireUnDonPaiement();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                          <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                          </center>
                         </div>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

 <div id="results23"> <!-- TRES IMPORTANT -->
</div>
</div>




<?php
//Fin modif paiement don
} } ?>

  </div>
</div>

  <?php
  require_once('includes/javascript.php');
  ?>

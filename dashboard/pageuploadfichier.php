

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />

  <meta name="Description" content="Association JAM ( Jeunesse Associative Montoise ) - Mont de Marsan">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr"> <!-- Mail Admin -->


  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Jam - Upload Documents</title>


    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
</head>


<?php

require_once('includes/head.php');

require_once('includes/checkconnection.php');

// START - Récupération de l'ip de connexion de l'utilisateur, même à travers de proxy !
function get_ip() {
// IP si internet partagé
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
  return $_SERVER['HTTP_CLIENT_IP'];
}
// IP derrière un proxy
elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  return $_SERVER['HTTP_X_FORWARDED_FOR'];
}
// Sinon : IP normale
else {
  return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
}
}
$ip = get_ip();
// Fin - Récupération IP

?>

<?php

// Ajouter le code à l'endroit souhaité dans l'index.php !


// Dire à Kévin ou le code est implanté pour ajouter les règles de changement des accès juste en dessous !
$secret = "LESECRET";
$sitekey = "LESITEKEY";


//
?>
<script src='https://www.google.com/recaptcha/api.js'></script>


<!-- CODE HTML A FAIRE -->
                              <div class="col-md-12">
                                                  <div class="card">
                                                      <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                                          <div class="card-header card-header-text" data-background-color="rose">
                                                              <h4 class="card-title">Nous contacter</h4>
                                                          </div>
                                                          <div class="card-content">


                                          <div class="row">
                                              <label class="col-sm-2 label-on-left">Message : </label>
                                              <div class="col-sm-10">
                                                  <div class="form-group label-floating is-empty">
                                                      <textarea name="message" class="form-control" rows="6">
                                                  </textarea>
                                              <span class="help-block">Merci de décrire précisément votre message</span></div>
                                              </div>
                                          </div>

                                           <div class="row">
                                              <label class="col-sm-2 label-on-left"> </label>
                                              <div class="col-sm-10">
                                                  <div class="form-group label-floating is-empty">


                                                      <div class="form-group form-file-upload">
                <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                <div class="input-group">
                  <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                  <span class="input-group-btn input-group-s">
                    <button type="button" class="btn btn-just-icon btn-round btn-info">
                      <i class="material-icons">layers</i>
                    </button>
                  </span>
                </div>
              </div>
                                            </div>
                                              </div>
                                          </div>

                                          <center>
                                          <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
                                        </center>
                                      </div>
                                      <center>
                                        <input type="submit" name="submit" value="Envoyer un message" class="btn btn-primary btn-round" />

</center>


                                                      </form>
                                                  </div>

                                              </div>

<?php
if(isset($_POST['submit'])){
    $message = $_POST['message'];
    $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
    if($responseData->success){
      $user_id = $_SESSION['user_id'];
      $target_dir = "../../../JamFichiers/Uploads";

      if (file_exists($target_dir/$user_id)) {
        $target_dirnew = "$target_dir/$user_id/";
      }else{
        mkdir("$target_dir/$user_id", 0700);
        $target_dirnew = "$target_dir/$user_id/";
      }

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
  $date = strftime('%d:%m:%Y %H:%M:%S');
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file2)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"][$i]). " has been uploaded.";
        $status = "EN ATTENTE DE VALIDATION";
        $insertinfos = $db->prepare("INSERT INTO validationfichiers (user_id, filename, ip, date, status) VALUES(:user_id, :filename, :ip, :date, :status)");
        $insertinfos->execute(array(

            "user_id"=>$_SESSION['user_id'],
            "filename"=>$target_file,
            "ip"=>$ip,
            "date"=>$date,
            "status"=>$status
            )
        );



    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



}}else{
      ?>
      <div class="content">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">



      <div class="alert alert-danger">
              <div class="container">
          <div class="alert-icon">
            <i class="material-icons">info_outline</i>
          </div>


                <b>Erreur Captcha:</b> BipBoup BoupBip ! Robot détecté !
              </div>
          </div>
        </div></div></div></div>
      <?php
    }

}

   ?>





  <?php
  require_once('includes/footdashboard.php');
     ?>
  </body>
  <?php
      require_once('includes/javascriptdashboard.php');
  ?>

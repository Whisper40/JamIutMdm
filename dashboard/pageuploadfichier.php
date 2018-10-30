

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
                <input type="file" id="fichier" name="fichier" multiple="">
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
    if(!empty($_FILES)){

        echo '1';
        $file_name = $_FILES['fichier']['name'];
        $file_extension = strrchr($file_name, ".");

        $file_tmp_name = $_FILES['fichier']['tmp_name'];
        $file_dest = 'uploads/'.$file_name;

        $extensions_autorisees = array('.pdf', '.PDF');
        if(in_array($file_extension,$extensions_autorisees)){
          if(move_uploaded_file($file_tmp_name, $file_dest)){
            echo 'Fichier envoyé';
          }else{
            echo 'Une erreur est survenue';
          }
        }else{
          echo 'Format Incorrect';
        }

        // On met le filename dans la BDD !

      }else{
        echo '0';
      }
    }else{
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

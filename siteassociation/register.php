<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />

  <meta name="Description" content="Association JAM ( Jeunesse Associative Montoise ) - Mont de Marsan">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr">

  <meta name="robots" content="index, follow">
  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Jam - Inscription</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css?v=1.1.0" rel="stylesheet"/>
</head>


<?php
    require_once('includes/head.php');
    $secret = "LESECRET";
$sitekey = "LESITELEY";


?>
  <script src='https://www.google.com/recaptcha/api.js'></script>
<body class="login-page">
<?php
    require_once('includes/header.php');
?>
    <div class="page-header header-filter" style="background-image: url('https://images-assets.nasa.gov/image/PIA04921/PIA04921~large.jpg'); background-size: cover; background-position: top center;">
    <br>
<?php
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){
        $username = strtoupper(htmlspecialchars($_POST['nom']));
        $prenom = strtoupper(htmlspecialchars($_POST['prenom']));
        $ine = strtoupper(htmlspecialchars($_POST['ine']));
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $repeatpassword = htmlspecialchars($_POST['repeatpassword']);
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        if(isset($username)&&isset($email)&&isset($password)&&isset($repeatpassword)){
          $selectetudiant = $db->prepare("SELECT * FROM etud WHERE nom=:nom and prenom=:prenom and numero=:ine");
          $selectetudiant->execute(array(
              "nom" => $username,
              "prenom" => $prenom,
              "ine" => $ine
              )
          );
          if($selectetudiant->rowCount()==1){

            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){

            if($password==$repeatpassword){
                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $register= $db->prepare("INSERT INTO users (username, email, password, last_connect) VALUES(:username, :email, :param_password, :date)");
                $register->execute(array(

                    "username"=>$username,
                    "email"=>$email,
                    "param_password"=>$param_password,
                    "date"=>$date
                    )
                );
                //add secure htmlspecialchars strip_tags

                ?>
        <div class="container">
            <div class="row">
                <div class="alert alert-success">
                    <div class="alert-icon">
                        <i class="material-icons">check</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <center>
                        <b>Succès :</b> Merci pour votre inscription, vous pouvez désormais vous <a href="connect.php">connecter</a>
                    </center>

                </div>
            </div>
        </div>
<?php
            }else{
?>
        <div class="container">
            <div class="row">
                <div class="alert alert-warning">
                    <div class="alert-icon">
                        <i class="material-icons">warning</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <center>
                        <b>Attention :</b> Votre inscription n'a pas pu aboutir. Merci de verifier la saisie des champs
                    </center>
                </div>
            </div>
        </div>
<?php
            }







          }else{
          ?>
          <div class="container">
              <div class="row">
                  <div class="alert alert-warning">
                      <div class="alert-icon">
                          <i class="material-icons">warning</i>
                      </div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true"><i class="material-icons">clear</i></span>
                      </button>
                      <center>
                          <b>Attention :</b> Votre mot de passe n'est pas sécurisé ! <br/> Il doit contenir au minimum une minuscule, une majuscule, un chiffre et un symbole( ! @ ).
                      </center>
                  </div>
              </div>
          </div>
          <?php
              }











        }else{
?>
        <div class="container">
            <div class="row">
                <div class="alert alert-warning">
                    <div class="alert-icon">
                        <i class="material-icons">warning</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <center>
                        <b>Attention :</b> Votre inscription n'a pas pu aboutir. Vous n'êtes pas membre de l'IUT MDM.
                    </center>
                </div>
            </div>
        </div>
<?php
            }

        }else{
?>
        <div class="container">
            <div class="row">
                <div class="alert alert-warning">
                    <div class="alert-icon">
                        <i class="material-icons">warning</i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="material-icons">clear</i></span>
                    </button>
                    <center>
                        <b>Attention Alert :</b> Votre inscription n'a pas pu aboutir. Merci de verifier la saisie de tous les champs
                    </center>
                </div>
            </div>
        </div>
<?php
        }
    }
?>

        <div class="container">
           <div class="row">
              <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                 <div class="card card-signup">
                    <form class="form" method="POST" action="">
                       <div class="header header-primary text-center">
                          <h4 class="card-title">Inscrivez-vous</h4>
                       </div>
                       <p class="description text-center">Merci de completer les champs ci-dessous.</p>
                       <div class="card-content">
                          <div class="input-group">
                             <span class="input-group-addon">
                             <i class="material-icons">face</i>
                             </span>
                             <input type="text" name="nom" class="form-control" placeholder="Nom"/>
                          </div>
                          <div class="input-group">
                             <span class="input-group-addon">
                             <i class="material-icons">face</i>
                             </span>
                             <input type="text" name="prenom" class="form-control" placeholder="Prénom"/>
                          </div>

                          <div class="input-group">
                             <span class="input-group-addon">
                             <i class="material-icons">touch_app</i>
                             </span>
                             <input type="text" name="ine" class="form-control" placeholder="Code UPPA"/>
                          </div>

                          <div class="input-group">
                             <span class="input-group-addon">
                             <i class="material-icons">email</i>
                             </span>
                             <input type="email" name="email" class="form-control" placeholder="Email"/>
                          </div>
                          <div class="input-group">
                             <span class="input-group-addon">
                             <i class="material-icons">lock_outline</i>
                             </span>

                             <input type="password" name="password" placeholder="Mot de passe" class="form-control"/>
                          </div>
                          <div class="input-group">
                             <span class="input-group-addon">
                             <i class="material-icons">lock_outline</i>
                             </span>
                             <input type="password" name="repeatpassword" placeholder="Confirmer mot de passe" class="form-control"/>
                          </div>

                          <!-- A garder 17/10/2018 -->
                          <div class="footer text-center">
                          <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
                          </div>
                          <!-- Fin -->

                          <div class="checkbox">
                             <label>
                             <input type="checkbox" id="myCheck"  onclick="CheckMyBox()">
                             J'accepte les <a href="conditions_generales_de_vente.php">conditions d'utilisations</a>.
                             </label>
                          </div>
                          <div class="footer text-center">


          <a href="https://jam-mdm.fr/connect.php" class="btn btn-primary btn-round">
            <i class="material-icons">account_box</i> Déja un compte ?
          </a>


                                  </div>
                          <div class="footer text-center" id="text" style="display:none">

                            <div class="footer text-center">


                           <button type="submit" class="btn btn-primary btn-round" name="submit">
                  <i class="material-icons">toggle_on</i> S'inscrire
       </button>
                         </div>


                          </div>
                          <script>
                          function CheckMyBox() {
                            var checkBox = document.getElementById("myCheck");
                            var text = document.getElementById("text");
                            if (checkBox.checked == true){
                                text.style.display = "block";
                            } else {
                               text.style.display = "none";
                            }
                        }
                        </script>
                    </form>
                    </div>
                 </div>
              </div>
           </div>
        </div>
    </div>
<?php

}else{
    header('Location:my_account.php');
}

require_once('includes/javascriptwithoutdashboard.php');
?>

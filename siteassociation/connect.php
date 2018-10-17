<!DOCTYPE html>
<html lang="fr">

<?php
   require_once('includes/head.php');
   ?>

<head>
  <meta charset="utf-8" />

  <meta name="Description" content="Association JAM ( Jeunesse Associative Montoise ) - Mont de Marsan">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr">


  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Jam - Connexion</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
</head>

<?php

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


                      //CODE
                    if(strpos($_SERVER["HTTP_USER_AGENT"], 'Firefox') !== false)
                        $user_agent_name = 'Mozilla Firefox';
                    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Opera') !== false)
                        $user_agent_name = 'Opera';
                    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Netscape') !== false)
                        $user_agent_name = 'Netscape';
                    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Konqueror') !== false)
                        $user_agent_name = 'Konqueror';
                    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') !== false)
                        $user_agent_name = 'Internet Explorer / Avant Browser';
                    elseif(strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome') !== false)
                        $user_agent_name = 'Google Chrome';
                    else
                        $user_agent_name = '(navigateur inconnu)';
?>

<body class="login-page sidebar-collapse">

<?php
require_once('includes/header.php');
?>

<div class="page-header clear-filter">
  <div class="page-header-image" style="background-image:url(./assets/img/IUTmdm.jpg)"></div>
  <div class="content">
    <div class="container">
      <div class="col-md-4 ml-auto mr-auto">
        <div class="card card-login card-plain">
          <form class="form" action="" method="POST">
            <div class="card-header text-center">
              <div class="logo-container">
                <img src="./assets/img/now-logo.png" alt="">
              </div>
            </div>

<?php
                  // START - Process de connexion :

                if(!isset($_SESSION['user_id'])){
                    if(isset($_POST['submit'])){
                        $email = htmlspecialchars($_POST['email']);
                        $password = htmlspecialchars($_POST['password']);
                            if($email&&$password){
                                $select = $db->prepare("SELECT * FROM users WHERE email=:email");
                                $select->execute(array(
                                    "email" => $email
                                    )
                                );
                                if($select->rowCount()==1){
                                    $data = $select->fetch();
                                    if(password_verify($password, $data['password'])){
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['user_name'] = $data['username'];
                                        $_SESSION['user_email'] = $data['email'];

                    // FIN - Process de connexion :


                    // START - Historique de connexion au site :

                                $ip = get_ip();
                                date_default_timezone_set('Europe/Paris');
                                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                                $date = strftime('%d/%m/%Y %H:%M:%S');

                                $insertinfos = $db->prepare("INSERT INTO histconnexion (user_id, ip, navigateur, date) VALUES(:user_id, :ip, :navigateur, :date)");
                                $insertinfos->execute(array(

                                    "user_id"=>$_SESSION['user_id'],
                                    "ip"=>$ip,
                                    "navigateur"=>$user_agent_name,
                                    "date"=>$date
                                    )
                                );

                    // STOP - Historique de connexion au site :

                    // START - Update last_connexion :

                        date_default_timezone_set('Europe/Paris');
                        setlocale(LC_TIME, 'fr_FR.utf8','fra');
                        $date = strftime('%Y/%m/%d %H:%M:%S');
                        $user_id = $_SESSION['user_id'];
                        $update = $db->prepare("UPDATE users SET last_connect=:date WHERE id=:id");
                        $update->execute(array(
                            "date"=>$date,
                            "id"=>$user_id
                            )
                        );

                   // STOP - Update last_connexion :
                        header('Location: https://dashboard.jam-mdm.fr/');
                    }else{
?>
        <div class="container">
           <div class="row">
              <div class="alert alert-danger">
                 <div class="alert-icon">
                   <i class="now-ui-icons ui-1_bell-53"></i>
                 </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                 </button>
                 <center>
                    <b>Erreur :</b> Identifiant ou Mot de passe incorrect !
                 </center>
              </div>
           </div>
        </div>
<?php           }
               }
                else{
?>
        <div class="container">
           <div class="row">
              <div class="alert alert-danger">
                 <div class="alert-icon">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                 </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                 </button>
                 <center>
                    <b>Erreur :</b> Aucun compte n'est lié a cette email !
                 </center>
              </div>
           </div>
        </div>
<?php
                }
            }
            else{
                ?>
        <div class="container">
           <div class="row">
              <div class="alert alert-warning">
                 <div class="alert-icon">
                   <i class="now-ui-icons ui-1_bell-53"></i>
                 </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                 </button>
                 <center>
                    <b>Attention:</b> Merci de remplir tous les champs !
                 </center>
              </div>
           </div>
        </div>
<?php
            }
        }
?>
            <div class="card-body">
              <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="now-ui-icons ui-1_email-85"></i>
                  </span>
                </div>
                <input  type="email" name="email" class="form-control" placeholder="Email"/>
              </div>
              <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="now-ui-icons ui-1_lock-circle-open"></i>
                  </span>
                </div>
                <input type="password" name="password" placeholder="Mot de passe" class="form-control"/>
              </div>
            </div>
            <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" name="submit">
              Connexion
            </button>
              <div class="pull-left">
                <h6>
                  <a href="https://jam-mdm.fr/register.php" class="link">Inscrivez vous</a>
                </h6>
              </div>
              <div class="pull-right">
                <h6>
                  <a href="https://jam-mdm.fr/recuperation.php" class="link">Mot de passe oublié</a>
                </h6>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
    }else{
        header('Location:dashboard.php');
    }

require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

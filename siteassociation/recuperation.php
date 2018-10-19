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

	<title>JAM - Recupération du mot de passe</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <!-- Les CSS utilisés -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
     <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<?php
$secret = "LESECRET";
$sitekey = "LESITEKEY";
require_once('includes/head.php');

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $db->prepare('SELECT id,username FROM users WHERE email = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $username = $mailexist->fetch();
            $username = $username['username'];

            $_SESSION['recup_mail'] = $recup_mail;

            $recup_code = "";
            for($i=0; $i < 8; $i++) {
               $recup_code .= mt_rand(0,9);
            }
            $mail_recup_exist = $db->prepare('SELECT id FROM recuperation WHERE email = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            if($mail_recup_exist == 1) {
               $recup_insert = $db->prepare('UPDATE recuperation SET code = ? WHERE email = ?');
               $recup_insert->execute(array($recup_code,$recup_mail));
            } else {
              date_default_timezone_set('Europe/Paris');
              setlocale(LC_TIME, 'fr_FR.utf8','fra');
              $date = strftime('%d/%m/%Y %H:%M:%S');
               $recup_insert = $db->prepare('INSERT INTO recuperation(email,code,date) VALUES (?, ?, ?)');
               $recup_insert->execute(array($recup_mail,$recup_code,$date));
            }
         $header="MIME-Version: 1.0\r\n";
         $header.='From:"JAM - Association MDM"<noreply@jam-mdm.fr>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '
         <html>
         <head>
           <title>Récupération du mot de passe - Jam-mdm.fr</title>
           <meta charset="utf-8" />
         </head>
         <body>
           <font color="#303030";>
             <div align="center">
               <table width="600px">
                 <tr>
                   <td>
                   <center>
                   <img src="logojam" alt="8" border="0">
                   </center>

                     <div align="center">Bonjour <b>'.$username.'</b>,</div>
                     <u>Une tentative de restauration de mot de passe viens d\' avoir lieu sur votre compte.
                     <br/>Si cette tentative viens de vous, alors pas d\'inquiétude, c\'est la procédure normal.</u>
                     <br/><br/>Voici votre code de récupération: <b>'.$recup_code.'</b>

                     <br/><br/>Toutefois si cette tentative n\'est pas intentionnel, merci de nous contacter à postmaster@jam-mdm.fr !

                     <br/>Merci et à bientôt sur <a href="https://jam-mdm.fr">Jam-mdm.fr</a> !

                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                     <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre dans le cas ou aucune intrusion n\'a eut lieu.
                     </font>
                   </td>
                 </tr>
               </table>
             </div>
           </font>
         </body>
         </html>
         ';
         mail($recup_mail, "Récupération du mot de passe -Jam-mdm.fr", $message, $header);

            header("Location:https://jam-mdm.fr/recuperation.php?section=code");
         } else {
            $error = "Cette adresse mail n'est pas enregistrée";
         }
      } else {
         $error = "Adresse mail invalide";
      }
   } else {
      $error = "Veuillez entrer votre adresse mail";
   }
}
if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])) {
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $db->prepare('SELECT id FROM recuperation WHERE email = ? AND code = ?');
      $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
      $verif_req = $verif_req->rowCount();
      $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
      if($responseData->success){
      if($verif_req == 1) {
         $up_req = $db->prepare('UPDATE recuperation SET confirme = 1 WHERE email = ?');
         $up_req->execute(array($_SESSION['recup_mail']));

         header('Location:https://jam-mdm.fr/recuperation.php?section=changemdp');
      }}else {
         $error = "Code invalide ou captcha non coché";
      }
   } else {
      $error = "Veuillez entrer votre code de confirmation";
   }
}
if(isset($_POST['change_submit'])) {
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
      $verif_confirme = $db->prepare('SELECT confirme FROM recuperation WHERE email = ?');
      $verif_confirme->execute(array($_SESSION['recup_mail']));
      $verif_confirme = $verif_confirme->fetch();
      $verif_confirme = $verif_confirme['confirme'];
      if($verif_confirme == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {

               $mdp = password_hash($mdp, PASSWORD_DEFAULT);
               $ins_mdp = $db->prepare('UPDATE users SET password = ? WHERE email = ?');
               $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
              $del_req = $db->prepare('DELETE FROM recuperation WHERE email = ?');
              $del_req->execute(array($_SESSION['recup_mail']));
               header('Location:https://jam-mdm.fr/connect.php');
            } else {
               $error = "Vos mots de passes ne correspondent pas";
            }
         } else {
            $error = "Veuillez remplir tous les champs";
         }
      } else {
         $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }
   } else {
      $error = "Veuillez remplir tous les champs";
   }
}

?>



<body class="login-page">
<?php
require_once('includes/header.php');
?>
    <div class="page-header header-filter" style="background-image: url('unfond'); background-size: cover; background-position: top center;">
        <br>
        <br>
        <div class="container">
            <div class="row">
               <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                  <div class="card card-signup">

<?php if($_GET['section'] == 'code') { ?>



<div class="alert alert-success">



              <div class="col-md-6 col-md-offset-3">
                  <div class="alert-icon">
                    <i class="material-icons">check</i>
                  </div>
                  <u><b>Yuhuuu!</b></u>
              </div>
              <br/>  <br/>
               Un code vous à été envoyé par mail à l'adresse email :
                <div class="col-md-6 col-md-offset-3">
               <?= $_SESSION['recup_mail'] ?>
               </div><br/><br/>
               <div class="col-md-6 col-md-offset-3">
          <u>  Vérifier vos spams ! </u>
          </div>

             </div>


<br/>


<form method="post" class="form">
    <div class="header header-primary text-center">
        <h4 class="card-title">Restauration du mot de passe</h4>
    </div>
    <div class="card-content">
        <div class="input-group">
              <span class="input-group-addon">
                 <i class="material-icons">email</i>
              </span>
              <input type="text" placeholder="Code de vérification" class="form-control" name="verif_code"/><br/>
        </div>
    </div>
     <div class="footer text-center">
 <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>

           <input type="submit" value="Valider" class="btn btn-primary btn-simple btn-wd btn-lg" name="verif_submit"/>
     </div>
</form>

<?php } elseif($_GET['section'] == "changemdp") { ?>



<form method="post" class="form">
    <div class="header header-primary text-center">
        <h4 class="card-title">Nouveau mot de passe</h4>
    </div>
    <div class="card-content">
        <div class="input-group">
              <span class="input-group-addon">
                 <i class="material-icons">email</i>
              </span>
              <input type="password" placeholder="Nouveau mot de passe" class="form-control" name="change_mdp"/><br/>
        </div>
        <div class="input-group">
              <span class="input-group-addon">
                 <i class="material-icons">email</i>
              </span>
              <input type="password" placeholder="Nouveau mot de passe" class="form-control" name="change_mdpc"/><br/>
        </div>
    </div>
     <div class="footer text-center">
           <input type="submit" value="Valider" class="btn btn-primary btn-simple btn-wd btn-lg" name="change_submit"/>
     </div>
</form>



<?php } else { ?>
    <form method="post" class="form">
        <div class="header header-primary text-center">
            <h4 class="card-title">Restauration du mot de passe</h4>
        </div>
        <div class="card-content">
            <div class="input-group">
                  <span class="input-group-addon">
                     <i class="material-icons">email</i>
                  </span>
                  <input type="email" placeholder="Votre adresse mail" class="form-control" name="recup_mail"/><br/>
            </div>
        </div>
         <div class="footer text-center">
               <input type="submit" value="Valider" class="btn btn-primary btn-simple btn-wd btn-lg" name="recup_submit"/>
         </div>
    </form>
<?php } ?>
<?php if(isset($error)) { echo '<span style="color:red">'.$error.'</span>'; } else { echo ""; }

?>
</div>
</div>
</div>
</div>
<?php
require_once('includes/javascript.php');
?>

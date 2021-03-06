<?php
    require_once('includes/connectBDD.php');
    $nompage = "Inscription";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');


//Code de génératon du captcha fournie par GOOGLE
$secret = "6LdcenUUAAAAAEjI0C8juo6_Y55YSGNTgRVeL0gf";
$sitekey = "6LdcenUUAAAAAD-ZMHJCP-AABqWuPhyMnZE42NKs";
?>
<script src='https://www.google.com/recaptcha/api.js'></script>

  <body class="login-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>

<style>
.page-header>.content {
  margin-top: 8%;
  text-align: center;
  margin-bottom: 20px;
}
</style>

<div class="page-header clear-filter">
  <div class="page-header-image" style="background-image:url(JamFichiers/Img/ImagesDuSite/Original/IUTmdm.jpg)"></div>
  <div class="content">
    <div class="container">
      <div class="col-md-4 ml-auto mr-auto">
        <div class="card card-login card-plain">
          <form class="form" action="" method="POST">
            <div class="card-header text-center">
              <div class="typography-line">
                <h2>
                  Inscrivez-vous
                </h2>
              </div>
            </div>
<?php
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){
      //Conversion des minuscules en majuscule et vérification des caractères spéciaux
        $username = strtoupper(htmlspecialchars($_POST['nom']));
        $prenom = strtoupper(htmlspecialchars($_POST['prenom']));
        $ine = strtoupper(htmlspecialchars($_POST['ine']));
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $repeatpassword = htmlspecialchars($_POST['repeatpassword']);
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        $checkmail = $db->prepare("SELECT * FROM users WHERE email=:email");
        $checkmail->execute(array(
            "email" => $email
            )
        );
        if($checkmail->rowCount()==0){


        if(isset($username)&&isset($email)&&isset($password)&&isset($repeatpassword)){
          $selectetudiant = $db->prepare("SELECT * FROM etud WHERE nom=:nom and prenom=:prenom and numero=:ine");
          $selectetudiant->execute(array(
              "nom" => $username,
              "prenom" => $prenom,
              "ine" => $ine
              )
          );
          if($selectetudiant->rowCount()==1){
            //Le mot de passe est vérifié afin qu'il contienne une minuscule, majuscule, nombre et symbole

      if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{5,}$#', $password)){
        $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
         if($responseData->success){
            if($password==$repeatpassword){
                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');
                $datesystem = strftime('%Y-%m-%d');
                $subscribe = $datesystem;

                $register= $db->prepare("INSERT INTO users (username, prenom, email, password, last_connect, datesystem, subscribe) VALUES(:username, :prenom, :email, :param_password, :date, :datesystem, :subscribe)");
                $register->execute(array(
                    "username"=>$username,
                    "prenom"=>$prenom,
                    "email"=>$email,
                    "param_password"=>$param_password,
                    "date"=>$date,
                    "datesystem"=>$datesystem,
                    "subscribe"=>$subscribe
                    )
                );

                $deletecode= $db->prepare("DELETE FROM etud WHERE numero=:ine");
                $deletecode->execute(array(
                    "ine"=>$ine
                    )
                );


                ?>
        <div class="container">
            <div class="row">
                <div class="alert alert-success">
                    <div class="alert-icon">
                      <i class="now-ui-icons ui-1_bell-53"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
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
                      <i class="now-ui-icons ui-1_bell-53"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
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
                                <i class="now-ui-icons ui-1_bell-53"></i>
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                              </button>
                              <center>
                                  <b>Attention :</b> Votre inscription n'a pas pu aboutir. Merci de cocher la captcha.
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
                        <i class="now-ui-icons ui-1_bell-53"></i>
                      </div>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
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
                      <i class="now-ui-icons ui-1_bell-53"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
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
                      <i class="now-ui-icons ui-1_bell-53"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                    </button>
                    <center>
                        <b>Attention Alert :</b> Votre inscription n'a pas pu aboutir. Merci de verifier la saisie de tous les champs
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
                      <i class="now-ui-icons ui-1_bell-53"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                    </button>
                    <center>
                        <b>Attention Alert :</b> Votre inscription n'a pas pu aboutir. Le mail est déja utilisé...
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
                  <i class="now-ui-icons users_single-02"></i>
                </span>
              </div>
              <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $_POST['nom'];?>"/>
            </div>
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons users_single-02"></i>
                </span>
              </div>
              <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $_POST['prenom'];?>"/>
            </div>
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons travel_info"></i>
                </span>
              </div>
              <input type="text" name="ine" class="form-control" placeholder="Code UPPA" data-toggle="tooltip" data-placement="right" title="Ce code se trouve sur votre carte étudiante IZLY" data-container="body" data-animation="true" value="<?php echo $_POST['ine'];?>"/>
            </div>
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons ui-1_email-85"></i>
                </span>
              </div>
              <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $_POST['email'];?>"/>
            </div>
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons ui-1_lock-circle-open"></i>
                </span>
              </div>
              <input type="password" name="password" placeholder="Mot de passe" class="form-control" data-toggle="tooltip" data-placement="right" title="Votre mot de passe doit au minimum contenir une lettre majuscule, une minuscule, un chiffre et un caractères" data-container="body" data-animation="true"/>
            </div>
            <div class="input-group no-border input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons ui-1_lock-circle-open"></i>
                </span>
              </div>
              <input type="password" name="repeatpassword" placeholder="Confirmer mot de passe" class="form-control"/>
            </div>
            <div class="footer text-center">
            <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
            </div>
          </div>
          <div class="card-footer text-center">
          <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" name="submit">
            S'inscrire
          </button>
            <div class="pull-center">
              <h6>
                <a href="connect.php" class="link">J'ai déja un compte</a>
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
    header('Location:my_account.php');
}

require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

<?php
    require_once('includes/connectBDD.php');
    $nompage = "Inscription Admin";
    require_once('includes/head.php');



//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src='https://www.google.com/recaptcha/api.js'></script>

  <body class="login-page sidebar-collapse">


<style>
.page-header>.content {
  margin-top: 8%;
  text-align: center;
  margin-bottom: 20px;
}
</style>

<div class="page-header clear-filter">
  <div class="page-header-image" style="background-image:url(assets/img/IUTmdm.JPG)"></div>
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
if(!isset($_SESSION['user_idadmin'])){
    if(isset($_POST['submit'])){
      //Conversion des minuscules en majuscule et vérification des caractères spéciaux
        $username = strtoupper(htmlspecialchars($_POST['nom']));
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $repeatpassword = htmlspecialchars($_POST['repeatpassword']);
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        if(isset($username)&&isset($email)&&isset($password)&&isset($repeatpassword)){

            //Le mot de passe est vérifié afin qu'il contienne une minuscule, majuscule, nombre et symbole

      if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){
        $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
         if($responseData->success){
            if($password==$repeatpassword){
                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $register= $db->prepare("INSERT INTO admin (username, email, password, last_connect) VALUES(:username, :email, :param_password, :date)");
                $register->execute(array(
                  //On insert la date à laquelle s'est connecté l'utilisateur afin d'avoir un suivi d'activitée du site.

                    "username"=>$username,
                    "email"=>$email,
                    "param_password"=>$param_password,
                    "date"=>$date
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
                        <b>Succès :</b> Merci pour votre inscription, vous pouvez désormais vous <a href="connectadmin.php">connecter</a>
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
                        <b>Attention Alert :</b> Votre inscription n'a pas pu aboutir. Merci de verifier la saisie de tous les champs
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
                <a href="connectadmin.php" class="link">J'ai déja un compte</a>
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
    header('Location: https://administration.jam-mdm.fr/');
}

require_once('includes/footer.php');

require_once('includes/javascript.php');
?>
<?php
    require_once('includes/connectBDD.php');

    $nompage = "Admin Connexion";
    require_once('includes/head.php');





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
                    // Fin - Récupération IP

                   // START - Récupération du navigateur utilisé :
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
                    // FIN - Récupération du navigateur utilisé :
?>

<body class="login-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>

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
                  Connexion
                </h2>
              </div>
            </div>

<?php
                  // START - Process de connexion :

                if(!isset($_SESSION['user_idadmin'])){
                    if(isset($_POST['submit'])){
                      // On demande l'utilisateur avec cet email qui n'est pas bannis et qui n'a pas de tentative de connexion frauduleuses
                        $email = htmlspecialchars($_POST['email']);
                        $password = htmlspecialchars($_POST['password']);
                        if($email&&$password){
                                $select = $db->prepare("SELECT * FROM admin WHERE email=:email");
                                $select->execute(array(
                                    "email" => $email
                                    )
                                );
                                if($select->rowCount()==1){

                                  $attempts = 5;
                                  $selectban = $db->prepare("SELECT * FROM users WHERE email=:email and numberofattempts<:attempts");
                                  $selectban->execute(array(
                                      "email" => $email,
                                      "attempts" => $attempts
                                      )
                                  );
                                  if($selectban->rowCount()==1){ // On selectionne les personnes non bannis, sinon on affiche quelles sont bannis


                                    $data = $select->fetch();
                                    if(password_verify($password, $data['password'])){
                                      //Si le mot de passe correspond à l'email utilisé par la personne alors on définis les variables de sessions

                                        $_SESSION['user_idadmin'] = $data['id'];
                                        $_SESSION['user_nameadmin'] = $data['username'];
                                        $_SESSION['user_emailadmin'] = $data['email'];

                    // FIN - Process de connexion

                    // START - Historique de connexion au site :

                                $ip = get_ip();
                                date_default_timezone_set('Europe/Paris');
                                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                                $date = strftime('%d/%m/%Y %H:%M:%S');
                                // On ajoute dans la BDD l'ensemble des informations de l'utilisateur qui se connecte, son IP, son navigateur ainsi que la date de connexion de la personne.
                                $insertinfos = $db->prepare("INSERT INTO histconnexionadmin (user_id, ip, navigateur, date) VALUES(:user_id, :ip, :navigateur, :date)");
                                $insertinfos->execute(array(

                                    "user_id"=>$_SESSION['user_idadmin'],
                                    "ip"=>$ip,
                                    "navigateur"=>$user_agent_name,
                                    "date"=>$date
                                    )
                                );

                    // STOP - Historique de connexion au site

                    // START - Update last_connexion :

                        date_default_timezone_set('Europe/Paris');
                        setlocale(LC_TIME, 'fr_FR.utf8','fra');
                        $date = strftime('%Y/%m/%d %H:%M:%S');
                        $user_id = $_SESSION['user_idadmin'];
                        //On réinitialise le nombre de tentatives avec echec.
                        $attempts = 0;
                        $db->query("UPDATE admin SET numberofattempts='$attempts' WHERE id='$user_id'");
                        $update = $db->prepare("UPDATE admin SET last_connect=:date WHERE id=:id");
                        $update->execute(array(
                            "date"=>$date,
                            "id"=>$user_id
                            )
                        );

                   // STOP - Update last_connexion
                   // Redirection en javascript car le header location pose problème dans ce cas :(
                   ?>

                      <script>window.location="https://administration.jam-mdm.fr/";</script><?php

                    }else{
?>
        <div class="container">
           <div class="row">
             <div class="col-sm-18 ml-auto mr-auto">
              <div class="alert alert-danger">
                 <div class="alert-icon">
                   <i class="now-ui-icons ui-1_bell-53"></i>
                 </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                 </button>
                    <b>Erreur :</b> Identifiant ou mot de passe incorrect !
              </div>
            </div>
           </div>
        </div>
<?php
// Ajout de tentative avec erreurs de mdp.
$email = htmlspecialchars($_POST['email']);
$numberofattempts = $db->query("SELECT numberofattempts from admin WHERE email='$email'");
$rattempts = $numberofattempts->fetch(PDO::FETCH_OBJ);
$recupnumberofattempts = $rattempts->numberofattempts;
$newattempts = $recupnumberofattempts + '1';
$db->query("UPDATE admin SET numberofattempts='$newattempts' WHERE email='$email'");

}}else{
  ?>
          <div class="container">
             <div class="row">
               <div class="col-sm-12 ml-auto mr-auto">
                <div class="alert alert-danger">
                   <div class="alert-icon">
                      <i class="now-ui-icons ui-1_bell-53"></i>
                   </div>
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                   </button>
                      <b>Erreur :</b> Votre compte est bannis ou désactivé !
                </div>
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
             <div class="col-sm-12 ml-auto mr-auto">
              <div class="alert alert-danger">
                 <div class="alert-icon">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                 </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                 </button>
                    <b>Erreur :</b> Aucun compte n'est lié a cet email !
              </div>
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
             <div class="col-sm-14 ml-auto mr-auto">
              <div class="alert alert-warning">
                 <div class="alert-icon">
                   <i class="now-ui-icons ui-1_bell-53"></i>
                 </div>
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                 </button>
                    <b>Attention:</b> Merci de remplir tous les champs !
              </div>
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
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $_POST['email'];?>"/>
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
                  <a href="register.php" class="link">Inscrivez vous</a>
                </h6>
              </div>
              <div class="pull-right">
                <h6>
                  <a href="recuperation.php" class="link">Mot de passe oublié</a>
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
        header('Location:https://dashboard.jam-mdm.fr/');
    }

require_once('includes/footer.php');

require_once('includes/javascript.php');
?>
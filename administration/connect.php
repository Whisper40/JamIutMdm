<?php
    require_once('includes/connectBDD.php');
    //require_once('includes/refusebypassconnection.php');
    $nompage = "Connexion administration";
    ini_set('display_errors', 1);
    require_once('includes/head.php');

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
<body>
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
  	<div class="container">
  		<div class="navbar-translate">
  			<a class="navbar-brand" href="index.php" rel="tooltip">
  				Logo
  			</a>
  			<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
  				<span class="navbar-toggler-bar top-bar"></span>
  				<span class="navbar-toggler-bar middle-bar"></span>
  				<span class="navbar-toggler-bar bottom-bar"></span>
  			</button>
  		</div>
  		<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
  			<ul class="navbar-nav">
  				<?php
  				$cat = $db->query("SELECT DISTINCT name FROM sitecat");
  				while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
  					$nom = $unecat->name
  					?>
  				<li class="nav-item dropdown">
  					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
  						<p><?php echo $nom ?></p>
  					</a>
  					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
  						<?php
  						$souscat = $db->query("SELECT * FROM sitecat WHERE name = '$nom'");
  						while($unesouscat = $souscat->fetch(PDO::FETCH_OBJ)){
  						  ?>
  						<a class="dropdown-item" href="<?php echo $unesouscat->page;?>">
  						  <?php echo $unesouscat->surname ?>
  						</a>
  						<?php
  								}
  								?>
  					</li>
  						<?php
  						  }
  						if(!isset($_SESSION['user_id'])){
  						?>
  						<li class="nav-item">
  	            <a class="nav-link" href="register.php">
  	              <i class="now-ui-icons files_single-copy-04"></i>
  	              <p>Inscription</p>
  	            </a>
  	          </li>
  						<li class="nav-item">
  	            <a class="nav-link" href="connect.php">
  	              <i class="now-ui-icons users_single-02"></i>
  	              <p>Se connecter</p>
  	            </a>
  	          </li>
  						<?php }else{ ?>
  						<li class="nav-item">
  							<a class="nav-link" href="https://dashboard.jam-mdm.fr/">
  								<i class="now-ui-icons users_circle-08"></i>
  								<p>Mon Compte</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a class="nav-link" href="disconnect.php">
  								<i class="now-ui-icons arrows-1_share-66"></i>
  								<p>Deconnexion</p>
  							</a>
  						</li>
  						<?php } ?>
  					</div>

  			</ul>
  		</div>
  	</div>
  </nav>

    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/IUTmdm.jpg">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

                          <?php
                                            // START - Process de connexion :

                                          if(!isset($_SESSION['admin_id'])){
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
                                                            $ban = '0';
                                                            $attempts = 5;
                                                            $selectban = $db->prepare("SELECT * FROM admin WHERE email=:email and ban=:ban and numberofattempts<:attempts");
                                                            $selectban->execute(array(
                                                                "email" => $email,
                                                                "ban" => $ban,
                                                                "attempts" => $attempts
                                                                )
                                                            );
                                                            if($selectban->rowCount()==1){ // On selectionne les personnes non bannis, sinon on affiche quelles sont bannis


                                                              $data = $select->fetch();
                                                              if(password_verify($password, $data['password'])){
                                                                //Si le mot de passe correspond à l'email utilisé par la personne alors on définis les variables de sessions

                                                                  $_SESSION['admin_id'] = $data['id'];
                                                                  $_SESSION['admin_name'] = $data['username'];
                                                                  $_SESSION['admin_email'] = $data['email'];

                                              // FIN - Process de connexion

                                              // START - Historique de connexion au site :

                                                          $ip = get_ip();
                                                          date_default_timezone_set('Europe/Paris');
                                                          setlocale(LC_TIME, 'fr_FR.utf8','fra');
                                                          $date = strftime('%d/%m/%Y %H:%M:%S');
                                                          // On ajoute dans la BDD l'ensemble des informations de l'utilisateur qui se connecte, son IP, son navigateur ainsi que la date de connexion de la personne.
                                                          $insertinfos = $db->prepare("INSERT INTO histconnexionadmin (admin_id, ip, navigateur, date) VALUES(:admin_id, :ip, :navigateur, :date)");
                                                          $insertinfos->execute(array(

                                                              "admin_id"=>$_SESSION['admin_id'],
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
                                                  $datesystem = strftime('%Y-%m-%d');
                                                  $admin_id = $_SESSION['admin_id'];
                                                  //On réinitialise le nombre de tentatives avec echec.
                                                  $attempts = 0;
                                                  $db->query("UPDATE admin SET numberofattempts='$attempts' WHERE id='$admin_id'");
                                                  $update = $db->prepare("UPDATE admin SET last_connect=:date WHERE id=:id");
                                                  $update->execute(array(
                                                      "date"=>$date,
                                                      "id"=>$admin_id
                                                      )
                                                  );

                                             // STOP - Update last_connexion
                                             // Redirection en javascript car le header location pose problème dans ce cas :(
                                             ?>

                                                <script>window.location="https://administration.jam-mdm.fr/";</script><?php

                                              }else{
                          ?>


                          <div class="col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="alert alert-warning">
                                        <button type="button" aria-hidden="true" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                          <b>Erreur :</b> Identifiant ou mot de passe incorrect !
                                        </span>
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

                            <div class="col-md-6">
                              <div class="card">
                                  <div class="card-content">
                                      <div class="alert alert-warning">
                                          <button type="button" aria-hidden="true" class="close">
                                              <i class="material-icons">close</i>
                                          </button>
                                          <span>
                                            <b>Erreur :</b> Votre compte est bannis ou désactivé !
                                          </span>
                                      </div>
                                  </div>
                              </div>
                          </div>

                            <?php
                          } }else{
                            ?>

                          <div class="col-md-6">
                            <div class="card">
                                <div class="card-content">
                                  <div class="alert alert-danger">
                                        <button type="button" aria-hidden="true" class="close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <span>
                                          <b>Erreur :</b> Aucun compte n'est lié a cet email !
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                          <?php
                            }  }else{
                            ?>

                            <div class="col-md-6">
                              <div class="card">
                                  <div class="card-content">
                                      <div class="alert alert-warning">
                                          <button type="button" aria-hidden="true" class="close">
                                              <i class="material-icons">close</i>
                                          </button>
                                          <span>
                                            <b>Attention:</b> Merci de remplir tous les champs !
                                          </span>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <?php
                        }  }
                          ?>

                            <form class="form" action="" method="POST">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="rose">
                                        <h4 class="card-title">Connectez-vous</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email</label>
                                                <input type="email" name="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Mot de passe</label>
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" name="submit" class="btn btn-rose btn-round">Connexion</button>
                                    </div>
                                </div>
                            </form>

                            <?php
                                }else{
                                    header('Location:http://127.0.0.1/administration/index.php');
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
              <div class="container">
                <center>
                <div id="copyright">
                  &copy;
                  <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                  </script>, Jam - Jeunesse Associative Montoise - Créée par Paul Boussard et Kévin Perez
                </div>
              </center>
              </div>
            </footer>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/js/material.min.js" type="text/javascript"></script>
<script src="assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="assets/js/jquery.validate.min.js"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="assets/js/moment.min.js"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Plugin for the Wizard -->
<script src="assets/js/jquery.bootstrap-wizard.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>
<!-- DateTimePicker Plugin -->
<script src="assets/js/bootstrap-datetimepicker.js"></script>
<!-- Vector Map plugin -->
<script src="assets/js/jquery-jvectormap.js"></script>
<!-- Sliders Plugin -->
<script src="assets/js/nouislider.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Select Plugin -->
<script src="assets/js/jquery.select-bootstrap.js"></script>
<!--  DataTables.net Plugin    -->
<script src="assets/js/jquery.datatables.js"></script>
<!-- Sweet Alert 2 plugin -->
<script src="assets/js/sweetalert2.js"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="assets/js/jasny-bootstrap.min.js"></script>
<!--  Full Calendar Plugin    -->
<script src="assets/js/fullcalendar.min.js"></script>
<!-- TagsInput Plugin -->
<script src="assets/js/jquery.tagsinput.js"></script>
<!-- Material Dashboard javascript methods -->
<script src="assets/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</html>

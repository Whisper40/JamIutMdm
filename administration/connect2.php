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
  <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                  <span class="sr-only">Portail Administateur du Site JAM</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand">Portail Administateur du Site JAM</a>
          </div>
          <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                  <li class="">
                      <a href="https://jam-mdm.fr/">
                          <i class="material-icons">swap_horiz</i> Retour JAM
                      </a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
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
                    Connexion
                  </h2>
                </div>
              </div>
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

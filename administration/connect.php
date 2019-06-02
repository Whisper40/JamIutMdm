<?php
    require_once('includes/connectBDD.php');
    //require_once('includes/refusebypassconnection.php');
    $nompage = "Connexion administration";

    require_once('connect/includes/head.php');

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
  <script>



 function SubmitConnection() {

    var email = $("#email").val();
    var password = $("#password").val();

    $.post("ajax/formconnection.php", { email:email, password: password},
    function(data) {
     $('#resultsconnection').html(data);
    });
}

	</script>
<body class="login-page sidebar-collapse">
<div class="page-header clear-filter">
  <div class="page-header-image" style="background-image:url('https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/IUTmdm.jpg')"></div>
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

if(!isset($_SESSION['admin_id'])){

?>

            <div class="card-body">
              <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="now-ui-icons ui-1_email-85"></i>
                  </span>
                </div>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="Email"/>
              </div>
              <div class="input-group no-border input-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="now-ui-icons ui-1_lock-circle-open"></i>
                  </span>
                </div>
                <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control"/>
              </div>
            </div>
            <div class="card-footer text-center">
            <a id="submitconnection" onclick="SubmitConnection();" type="button" class="btn btn-primary btn-round btn-lg btn-block">Connexion</a>
              <div class="pull-center">
                <h6>
                  <a href="https://jam-mdm.fr" class="link">Retour JAM</a>
                </h6>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<div id="resultsconnection"></div>
  <?php
      }else{
          header('Location:https://administration.jam-mdm.fr/index.php');
      }


require_once('connect/includes/footer.php');

require_once('connect/includes/javascript.php');
?>

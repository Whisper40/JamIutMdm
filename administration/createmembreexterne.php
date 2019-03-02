<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    require_once('includes/head.php');
    $nompage = "Création Membre";
    $nomsouscat = "";
    ini_set('display_errors', 1);
    $user_id = $_SESSION['admin_id'];
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d/%m/%Y %H:%M:%S');

//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";

$valeurcode = mt_rand(1000, 999999);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
function SubmitFormDataCreerUnMembre() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var nom = $("#nom").val();
   var prenom = $("#prenom").val();
   var code = "<?php echo $valeurcode; ?>";
   var raison = $("#raison").val();
   var email = $("#email").val();

   $.post("ajax/createmembreexterne.php", { user_id: user_id, nom: nom, prenom: prenom, email:email, code: code, raison: raison},
   function(data) {
    $('#results23').html(data);
   });
}
</script>

<body>
    <div class="wrapper">

      <?php
      require_once('includes/navbar.php');
      ?>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Créer un membre externe</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Nom</label>
                                  <input type="text" class="form-control" name="nom" id="nom">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Prénom</label>
                                  <input type="text" name="prenom" id="prenom" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Code</label>
                                  <input type="text" value="<?php echo $valeurcode; ?>" disabled="" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Email</label>
                                  <input type="email" name="email" id="email" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Raison</label>
                                  <input type="text" name="raison" id="raison" class="form-control">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="card-content">
                              <br><br><br><br>
                              <center>
                                <h3 class="card-title">Création d'un membre</h3>
                              </center>
                              <div class="info info-horizontal">
                                <div class="description">
                                  <center>
                                     <h4 class="info-title">Ce formulaire vous permet de créée un code unique pour une personne externe aux étudiant de l'université de Mont de Marsan. Ce code lui sera envoyé par mail et lui permettra de remplir le formulaired'inscription</h4>
                                  </center>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-content">
                              <center>
                                <button id="submitFormDataCreerUnMembre" onclick="SubmitFormDataCreerUnMembre();" type="button" class="btn btn-primary btn-round btn-rose">Créer un membre</button>
                              </center>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div id="results23"></div>
                  </div>
                </div>
              </div>

  </div>
</body>

<?php
require_once('includes/javascript.php');
?>

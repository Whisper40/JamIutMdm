<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";
    ini_set('display_errors', 1);
    $user_id = $_SESSION['admin_id'];


//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>




<script>


function SubmitFormDataCreerUnMembre() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var nom = $("#nom").val();
   var prenom = $("#prenom").val();
   var code = $("#code").val();
   var raison = $("#raison").val();

   $.post("ajax/createmembreexterne.php", { user_id:user_id, nom: nom, prenom: prenom, code: code, raison: raison},
   function(data) raison
    $('#results23').html(data);

   });

}

</script>

<body class="landing-page sidebar-collapse">
  <div class="wrapper">




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
                                  <input type="text" class="form-control" value="Dupont" name="nom" id="nom">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Prénom</label>
                                  <input type="text" name="prenom" value="" id="Pierre" class="form-control">
                              </div>

                            <div class="form-group label-floating">
                            <label class="control-label">Code</label>
                            <input type="number" min="1" name="code" value="07824" id="code" class="form-control">
                            </div>

                            <div class="form-group label-floating">
                            <label class="control-label">Raison</label>
                            <input type="text" name="raison" value="<?php echo $raison;?>" id="raison" class="form-control">
                            </div>

                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataCreerUnMembre" onclick="SubmitFormDataCreerUnMembre();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results23"> <!-- TRES IMPORTANT -->
    </div>
    </div>


















  </div>
</body>
<?php
require_once('includes/footer.php');
require_once('includes/javascript.php');
?>

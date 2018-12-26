<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";




//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function RetourIndex(){
  window.location="https://administration.jam-mdm.fr/modifdespages.php"
}
</script>







<body class="landing-page sidebar-collapse">
  <div class="wrapper">
<?php
if(isset($_GET['page'])){
if($_GET['page']=='index'){
  $table = $_GET['table'];
?>
  <script>


   function SubmitFormDataIndex() {
     var user_id = "<?php echo $_SESSION['user_id']; ?>";
      var img1 = $("#img1").val();
      var logo1 = $("#logo1").val();
      var titre1 = $("#titre1").val();
      var description1 = $("#description1").val();
      var bouton1 = $("#bouton1").val();
      var lienbt1 = $("#lienbt1").val();
      var bouton2 = $("#bouton2").val();
      var lienbt2 = $("#lienbt2").val();
      var logo2 = $("#logo2").val();
      var titre2 = $("#titre2").val();
      var description2 = $("#description2").val();
      var fb = $("#fb").val();
      $.post("ajax/modifypageindex.php", { user_id:user_id, img1: img1, logo1: logo1, titre1: titre1, description1: description1, bouton1: bouton1, lienbt1: lienbt1, bouton2: bouton2, lienbt2: lienbt2, logo2: logo2, titre2: titre2, description2: description2, fb: fb},
      function(data) {
       $('#results1').html(data);

      });

  }

  </script>
  <?php
  $selectinfosactuel = $db->prepare("SELECT * from pageindex");
  $selectinfosactuel->execute();
  $r2 = $selectinfosactuel->fetch(PDO::FETCH_OBJ);
  $img1 = $r2->img1;
  $logo1 = $r2->logo1;
  $titre1 = $r2->titre1;
  $description1 = $r2->description1;
  $bouton1 = $r2->bouton1;
  $lienbt1 = $r2->lienbt1;
  $bouton2 = $r2->bouton2;
  $lienbt2 = $r2->lienbt2;
  $logo2 = $r2->logo2;
  $titre2 = $r2->titre2;
  $description2 = $r2->description2;
  $fb = $r2->fb;
?>
  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center">Modification de l'index du site</h2>
                  <form action="" method="post" id="myForm1" class="contact-form">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Image du fond</label>
                                <input type="text" class="form-control" value="<?php echo $img1; ?>" name="img1" id="img1">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Logo Central</label>
                                <input type="text" name="logo1" value="<?php echo $logo1; ?>"id="logo1" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Titre Principal</label>
                                <input type="text" name="titre1" value="<?php echo $titre1; ?>" id="titre1" class="form-control">
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Description</label>
                                  <input type="text" name="description1" value="<?php echo $description1; ?>"id="description1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Bouton Gauche</label>
                                  <input type="text" name="bouton1" value="<?php echo $bouton1; ?>" id="bouton1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Lien bouton gauche</label>
                                  <input type="text" name="lienbt1" value="<?php echo $lienbt1; ?>" id="lienbt1" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Bouton Droite</label>
                                  <input type="text" name="bouton2" value="<?php echo $bouton2; ?>" id="bouton2" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Lien bouton droite</label>
                                  <input type="text" name="lienbt2" value="<?php echo $lienbt2; ?>" id="lienbt2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Logo</label>
                                  <input type="text" name="logo2" value="<?php echo $logo2; ?>" id="logo2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Titre Secondaire</label>
                                  <input type="text" name="titre2" value="<?php echo $titre2; ?>" id="titre2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Description Secondaire</label>
                                  <input type="text" name="description2" value="<?php echo $description2; ?>" id="description2" class="form-control">
                              </div>

                              <div class="form-group label-floating">
                                  <label class="control-label">Lien Facebook</label>
                                  <input type="text" name="fb" value="<?php echo $fb; ?>" id="fb" class="form-control">
                              </div>
                           </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="card-content">

                            <center>
                            <button id="submitFormDataIndex" onclick="SubmitFormDataIndex();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                            <button onclick="RetourIndex();" type="button" class="btn btn-primary btn-round btn-rose">Retour</button>
                            </center>
                           </div>
                        </div>
                  </div>
                </form>
              </div>
          </div>
      </div>

   <div id="results1"> <!-- TRES IMPORTANT -->



  </div>
</div>






















<?php
}




}
  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

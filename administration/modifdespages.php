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







<body class="landing-page sidebar-collapse">
  <div class="wrapper">
<?php
if(isset($_GET['page'])){
if($_GET['page']=='index'){
  $table = $_GET['table'];
?>
  <script>


   function SubmitFormDataSki() {
     var user_id = "<?php echo $_SESSION['user_id']; ?>";
      var poids = $("#poids").val();
      var taille = $("#taille").val();
      var allergie = $("#allergie").val();
      var adresse = $("#adresse").val();
      var codepostal = $("#codepostal").val();
      var ville = $("#ville").val();
      var telurgence = $("#telurgence").val();
      $.post("ajax/modifyformulaireski.php", { user_id:user_id, poids: poids, taille: taille, allergie: allergie, adresse: adresse, codepostal: codepostal, ville: ville, telurgence: telurgence},
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
                                <label class="control-label">Poids (Kg)</label>
                                <input type="number" class="form-control" value="<?php echo $poids; ?>" name="poids" id="poids">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Taille (cm)</label>
                                <input type="number" name="taille" value="<?php echo $taille; ?>"id="taille" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Téléphone d'urgence</label>
                                <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                            </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Adresse</label>
                                  <input type="text" name="adresse" value="<?php echo $adresse; ?>"id="adresse" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Code Postal</label>
                                  <input type="number" name="codepostal" value="<?php echo $codepostal; ?>" id="codepostal" class="form-control">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Ville</label>
                                  <input type="text" name="ville" value="<?php echo $ville; ?>" id="ville" class="form-control">
                              </div>
                           </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Allèrgies</label>
                                <input type="text" name="allergie" value="<?php echo $allergie; ?>"id="allergie" class="form-control">
                            </div>
                            <center>
                            <button id="submitFormDataSki" onclick="SubmitFormDataSki();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
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
}else if($_GET['action']=='ban'){

$id=$_GET['id'];
$setban = $db->prepare("UPDATE images SET status='0' WHERE id=$id");
$setban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}else if($_GET['action']=='delete'){

$id=$_GET['id'];
$selectnom = $db->query("SELECT * FROM images WHERE id='$id'");
$rname = $selectnom->fetch(PDO::FETCH_OBJ);
$valnom = $rname->file_name;
$dossier = $rname->title;

echo 'esquive';

?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}




}//FIN $_GET

    require_once('includes/navbar.php');



?>

    <a href="?page=index&amp;table=pageindex">
      <button type="button" class="btn">Page Index</button>
    </a>

    <a href="?page=devenirmembre&amp;table=pagedevenirmembre">
      <button type="button" class="btn">Page Devenir Membre</button>
    </a>

    <a href="?page=association&amp;table=pageasso">
      <button type="button" class="btn">Page Association</button>
    </a>

    <a href="?page=membre&amp;table=membres">
      <button type="button" class="btn">Page Membre</button>
    </a>

    <a href="?page=status&amp;table=status">
      <button type="button" class="btn">Page Status</button>
    </a>

    <a href="?page=lienutiles&amp;table=lienutiles">
      <button type="button" class="btn">Page Liens</button>
    </a>



















  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

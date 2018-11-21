<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Formulaire activitée";
    require_once('includes/head.php');
if(isset($_GET['type'])){
  $type=$_GET['type'];

//Fonction de vérification des données entrées
function slugify($text){
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        $text = preg_replace('~[^-\w]+~', '', $text);

        $text = trim($text, '-');

        $text = preg_replace('~-+~', '-', $text);

        $text = strtolower($text);

        if (empty($text)) {
          return 'n-a';
        }

        return $text;
    }
?>

<body>
    <div class="wrapper">

<?php
    require_once('includes/navbar.php');
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
          <?php
$user_id = $_SESSION['user_id'];
if ($type == 'ski'){

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
          $selectformulaireremplis = $db->query("SELECT * from formulaireski WHERE user_id='$user_id'");
          $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
          $poids = $r2->poids;
          $taille = $r2->taille;
          $allergie = $r2->allergie;
          $adresse = $r2->adresse;
          $codepostal = $r2->codepostal;
          $ville = $r2->ville;
          $telurgence = $r2->telurgence;

           ?>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title">Modifier mes informations</h4>
                        <form action="" method="post" id="myForm1" class="contact-form">
                            <div class="form-group label-floating">
                                <label class="control-label">Poids (Kg)</label>

                                <input type="number" class="form-control" value="<?php echo $poids; ?>"name="poids" id="poids">

                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Taille (cm)</label>
                                <input type="number" name="taille" value="<?php echo $taille; ?>"id="taille" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Allèrgies</label>
                                <input type="text" name="allergie" value="<?php echo $allergie; ?>"id="allergie" class="form-control">
                            </div>
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
                            <div class="form-group label-floating">
                                <label class="control-label">Téléphone d'urgence</label>
                                <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                            </div>
                            <center>
                            <button id="submitFormDataSki" onclick="SubmitFormDataSki();" type="button" class="btn btn-fill btn-rose">Modifier</button>
                            </center>
                        </form>
                    </div>
                  </div>


                </div>


            <div id="results1"> <!-- TRES IMPORTANT -->



        </div>
        <?php
}else if ($type == 'rugby'){
  ?>
            <script>

             function SubmitFormDataRugby() {
               var user_id = "<?php echo $_SESSION['user_id']; ?>";
                var adresse = $("#adresse").val();
                var codepostal = $("#codepostal").val();
                var ville = $("#ville").val();
                var telurgence = $("#telurgence").val();
                $.post("ajax/modifyformulairerugby.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, telurgence: telurgence},
                function(data) {
                 $('#results2').html(data);

                });

            }
            </script>

            <?php
            $selectformulaireremplis = $db->query("SELECT * from formulairerugby WHERE user_id='$user_id'");
            $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
            $adresse = $r2->adresse;
            $codepostal = $r2->codepostal;
            $ville = $r2->ville;
            $telurgence = $r2->telurgence;

             ?>


              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header card-header-icon" data-background-color="rose">
                          <i class="material-icons">mail_outline</i>
                      </div>

                      <div class="card-content">
                          <h4 class="card-title">Modifier mes informations</h4>
                          <form action="" method="post" id="myForm2" class="contact-form">


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
                              <div class="form-group label-floating">
                                  <label class="control-label">Téléphone d'urgence</label>
                                  <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                              </div>
                              <center>
                              <button id="submitFormDataRugby" onclick="SubmitFormDataRugby();" type="button" class="btn btn-fill btn-rose">Modifier</button>
                              </center>
                          </form>
                      </div>
                    </div>


                  </div>


              <div id="results2"> <!-- TRES IMPORTANT -->



          </div>


<?php
//FIN RUGBY
//DEBIT CINEMA
}else if ($type == 'cinema'){
  $user_id = $_SESSION['user_id'];


  ?>




              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header card-header-icon" data-background-color="rose">
                          <i class="material-icons">mail_outline</i>
                      </div>

                      <div class="card-content">
                          <h4 class="card-title">Aucune informations supplémentaires n'est nécessaire pour cette sortie
                          </h4>
                          <h3> Si dessous apparaitront des notes concernant cette activité. </h3>
<?php

$selectformulaireremplis = $db->query("SELECT * from communicationactivite WHERE slug LIKE '%$type%'");
$r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
$infoscomplementaires = $r2->infoscomplementaires;
$infoscomplementaires2 = $r2->infoscomplementaires2;
$infoscomplementaires3 = $r2->infoscomplementaires3;

if(!empty($infoscomplementaires)){
  //CODE HTML
  echo $infoscomplementaires;
}
?>
<br/>
<?php
if(!empty($infoscomplementaires2)){
  //CODE HTML
  echo $infoscomplementaires2;
}
?>
<br/>
<?php
if(!empty($infoscomplementaires3)){
  //CODE HTML
  echo $infoscomplementaires3;
}
?>
                </div>
                    </div>
                  </div>

<?php
//FIN CINEMA
}else if ($type == 'nettoyage'){
  $user_id = $_SESSION['user_id'];


  ?>




              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header card-header-icon" data-background-color="rose">
                          <i class="material-icons">mail_outline</i>
                      </div>

                      <div class="card-content">
                          <h4 class="card-title">Aucune informations supplémentaires n'est nécessaire pour cette sortie
                          </h4>
                          <h3> Si dessous apparaitront des notes concernant cette activité. </h3>
<?php

$selectformulaireremplis = $db->query("SELECT * from communicationactivite WHERE slug LIKE '%$type%'");
$r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
$infoscomplementaires = $r2->infoscomplementaires;
$infoscomplementaires2 = $r2->infoscomplementaires2;
$infoscomplementaires3 = $r2->infoscomplementaires3;

if(!empty($infoscomplementaires)){
  //CODE HTML
  echo $infoscomplementaires;
}
?>
<br/>
<?php
if(!empty($infoscomplementaires2)){
  //CODE HTML
  echo $infoscomplementaires2;
}
?>
<br/>
<?php
if(!empty($infoscomplementaires3)){
  //CODE HTML
  echo $infoscomplementaires3;
}
?>
                </div>
                    </div>
                  </div>

<?php
//FIN NETTOYAGE
}else if ($type == 'sportive'){
  ?>
            <script>

             function SubmitFormDataSportive() {
               var user_id = "<?php echo $_SESSION['user_id']; ?>";
                var adresse = $("#adresse").val();
                var codepostal = $("#codepostal").val();
                var ville = $("#ville").val();
                var telurgence = $("#telurgence").val();
                $.post("ajax/modifyformulairesportive.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, telurgence: telurgence},
                function(data) {
                 $('#results3').html(data);

                });

            }
            </script>

            <?php
            $selectformulaireremplis = $db->query("SELECT * from formulairesportive WHERE user_id='$user_id'");
            $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
            $adresse = $r2->adresse;
            $codepostal = $r2->codepostal;
            $ville = $r2->ville;
            $telurgence = $r2->telurgence;

             ?>


              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header card-header-icon" data-background-color="rose">
                          <i class="material-icons">mail_outline</i>
                      </div>

                      <div class="card-content">
                          <h4 class="card-title">Modifier mes informations</h4>
                          <form action="" method="post" id="myForm3" class="contact-form">


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
                              <div class="form-group label-floating">
                                  <label class="control-label">Téléphone d'urgence</label>
                                  <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                              </div>
                              <center>
                              <button id="submitFormDataSportive" onclick="SubmitFormDataSportive();" type="button" class="btn btn-fill btn-rose">Modifier</button>
                              </center>
                          </form>
                      </div>
                    </div>


                  </div>


              <div id="results3"> <!-- TRES IMPORTANT -->



          </div>


<?php
//FIN SPORTIVE

}else if ($type == 'orientation'){
  ?>
            <script>

             function SubmitFormDataOrientation() {
               var user_id = "<?php echo $_SESSION['user_id']; ?>";
                var adresse = $("#adresse").val();
                var codepostal = $("#codepostal").val();
                var ville = $("#ville").val();
                var telurgence = $("#telurgence").val();
                $.post("ajax/modifyformulaireorientation.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, telurgence: telurgence},
                function(data) {
                 $('#results4').html(data);

                });

            }
            </script>

            <?php
            $selectformulaireremplis = $db->query("SELECT * from formulaireorientation WHERE user_id='$user_id'");
            $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
            $adresse = $r2->adresse;
            $codepostal = $r2->codepostal;
            $ville = $r2->ville;
            $telurgence = $r2->telurgence;

             ?>


              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header card-header-icon" data-background-color="rose">
                          <i class="material-icons">mail_outline</i>
                      </div>

                      <div class="card-content">
                          <h4 class="card-title">Modifier mes informations</h4>
                          <form action="" method="post" id="myForm3" class="contact-form">


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
                              <div class="form-group label-floating">
                                  <label class="control-label">Téléphone d'urgence</label>
                                  <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                              </div>
                              <center>
                              <button id="submitFormDataOrientation" onclick="SubmitFormDataOrientation();" type="button" class="btn btn-fill btn-rose">Modifier</button>
                              </center>
                          </form>
                      </div>
                    </div>


                  </div>


              <div id="results4"> <!-- TRES IMPORTANT -->



          </div>


<?php
//FIN ORIENTATION

}
         ?>
        </div>
    </div>
</div>
</div>

</body>
<?php

    require_once('includes/javascriptdashboard.php');
  }else{
      header("Location:https://jam-mdm.fr/");
  }
?>

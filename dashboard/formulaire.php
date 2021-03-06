<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Formulaire activitée";
    require_once('includes/head.php');

if(isset($_GET['type'])){
  $type=$_GET['type'];
  $cattitre = $_GET['type'];
  $selecttitre = $db->prepare("SELECT title from activitesvoyages WHERE typeactivite=:typeactivite");
  $selecttitre->execute(array(
      "typeactivite"=>$type
      )
  );
  $recup = $selecttitre->fetch(PDO::FETCH_OBJ);
  $titledelapage = $recup->title;
  $nompage = $titledelapage;

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
  $participeski = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $participeski->execute(array(
    "user_id"=>$user_id,
    "typeactivite"=>$type
  ));
  $countparticipeski = $participeski->rowCount();
  if($countparticipeski>0){

           ?>

          <script>

           function SubmitFormDataSki() {
             var user_id = "<?php echo $_SESSION['user_id']; ?>";
              var poids = $("#poids").val();
              var taille = $("#taille").val();
              var pointure = $("#pointure").val();
              var allergie = $("#allergie").val();
              var adresse = $("#adresse").val();
              var codepostal = $("#codepostal").val();
              var ville = $("#ville").val();
              var tel = $("#tel").val();
              var telurgence = $("#telurgence").val();
              $.post("ajax/modifyformulaireski.php", { user_id:user_id, poids: poids, taille: taille, pointure: pointure, allergie: allergie, adresse: adresse, codepostal: codepostal, ville: ville, tel: tel, telurgence: telurgence},
              function(data) {
               $('#results1').html(data);

              });

          }




          </script>

          <?php
          $selectformulaireremplis = $db->prepare("SELECT * from formulaireski WHERE user_id=:user_id");
          $selectformulaireremplis->execute(array(
              "user_id"=>$user_id
              )
          );
          $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
          $poids = $r2->poids;
          $taille = $r2->taille;
          $pointure = $r2->pointure;
          $allergie = $r2->allergie;
          $adresse = $r2->adresse;
          $codepostal = $r2->codepostal;
          $ville = $r2->ville;
          $tel = $r2->tel;
          $telurgence = $r2->telurgence;

           ?>

           <div class="content">
               <div class="container-fluid">
                   <div class="card">
                       <div class="card-content">
                           <h2 class="card-title text-center"><?php echo $titledelapage; ?></h2>
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
                                         <input type="number" name="taille" value="<?php echo $taille; ?>" id="taille" class="form-control">
                                     </div>
                                     <div class="form-group label-floating">
                                         <label class="control-label">Pointure</label>
                                         <input type="number" name="pointure" value="<?php echo $pointure; ?>" id="pointure" class="form-control">
                                     </div>
                                     <div class="form-group label-floating">
                                         <label class="control-label">Votre numéro de Téléphone</label>
                                         <input type="number" name="tel" value="<?php echo $tel; ?>" id="tel" class="form-control">
                                     </div>
                                   </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="card-content">
                                       <div class="form-group label-floating">
                                           <label class="control-label">Adresse</label>
                                           <input type="text" name="adresse" value="<?php echo $adresse; ?>" id="adresse" class="form-control">
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
                                           <label class="control-label">Numéro de Téléphone d'urgence (à contacter en cas de problèmes)</label>
                                           <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
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
            <div id="results1"></div>
          </div>

        <?php
}else{
  ?>
    <script>window.location="https://dashboard.jam-mdm.fr/";</script>
    <?php
}}else if ($type == 'rugby'){

  $participerugby = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $participerugby->execute(array(
    "user_id"=>$user_id,
    "typeactivite"=>$type
  ));
  $countparticiperugby = $participerugby->rowCount();
  if($countparticiperugby>0){
  ?>
            <script>

             function SubmitFormDataRugby() {
               var user_id = "<?php echo $_SESSION['user_id']; ?>";
                var adresse = $("#adresse").val();
                var codepostal = $("#codepostal").val();
                var ville = $("#ville").val();
                var tel = $("#tel").val();
                var telurgence = $("#telurgence").val();
                $.post("ajax/modifyformulairerugby.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, tel:tel, telurgence: telurgence},
                function(data) {
                 $('#results2').html(data);

                });

            }
            </script>

            <?php
            $selectformulaireremplis = $db->prepare("SELECT * from formulairerugby WHERE user_id=:user_id");
            $selectformulaireremplis->execute(array(
                "user_id"=>$user_id
                )
            );

            $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
            $adresse = $r2->adresse;
            $codepostal = $r2->codepostal;
            $ville = $r2->ville;
            $tel = $r2->tel;
            $telurgence = $r2->telurgence;

             ?>

             <div class="content">
                 <div class="container-fluid">
                     <div class="card">
                         <div class="card-content">
                             <h2 class="card-title text-center"><?php echo $titledelapage;?></h2>
                             <div class="row">
                               <div class="col-sm-6">
                                   <div class="card-content">
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
                                           <label class="control-label">Téléphone</label>
                                           <input type="number" name="tel" value="<?php echo $tel; ?>" id="tel" class="form-control">
                                       </div>
                                       <div class="form-group label-floating">
                                           <label class="control-label">Téléphone d'urgence</label>
                                           <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                                       </div>
                                         <center>
                                           <button id="submitFormDataRugby" onclick="SubmitFormDataRugby();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                         </center>
                                     </form>
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="card-content">
                                       <br><br>
                                       <center>
                                       <h3 class="card-title">Annuler sa Participation</h3>
                                       </center>
                                        <div class="card-content">
                                            <div class="info info-horizontal">
                                                <div class="description">
                                                    <center>
                                                    <h4 class="info-title">Pour annuler votre participation à cette activitée pour laquelle vous avez déja payer, merci de prendre contact avec un membre de l'association</h4>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div id="results2"></div>
               </div>



<?php
//FIN RUGBY
//DEBIT CINEMA
}else{
  ?>
  <script>window.location="https://dashboard.jam-mdm.fr/";</script>
  <?php

}}else if ($type == 'cinema'){
  $user_id = $_SESSION['user_id'];
  $participecinema = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $participecinema->execute(array(
    "user_id"=>$user_id,
    "typeactivite"=>$type
  ));
  $countparticipecinema = $participecinema->rowCount();
  if($countparticipecinema>0){


  ?>

  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center"><?php echo $titledelapage; ?></h2>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="card-content">
                        <br><br>
                        <center>
                        <h3 class="card-title">Information Complémentaire</h3>
                        </center>
                        <br>

                          <?php
                          $selectformulaireremplis = $db->prepare("SELECT * from communicationactivite WHERE slug LIKE :type");
                          $selectformulaireremplis->execute(array(
                              "type"=>'%'.$type.'%'
                              )
                          );

                          $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
                          $infoscomplementaires = $r2->infoscomplementaires;
                          ?>

                            <p align="justify"><?php echo $infoscomplementaires ?></p>
                        </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="card-content">
                            <br><br>
                            <center>
                            <h3 class="card-title">Annuler sa Participation</h3>
                            </center>
                             <div class="card-content">
                                 <div class="info info-horizontal">
                                     <div class="description">
                                         <center>
                                         <h4 class="info-title">Pour annuler votre participation à cette activitée pour laquelle vous avez déja payer, merci de prendre contact avec un membre de l'association</h4>
                                         </center>
                                     </div>
                                 </div>
                             </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php
//FIN CINEMA
}else{
  ?>
    <script>window.location="https://dashboard.jam-mdm.fr/";</script>
<?php
}}else if ($type == 'nettoyage'){
  $user_id = $_SESSION['user_id'];
  $participenettoyage = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $participenettoyage->execute(array(
      "user_id"=>$user_id,
      "typeactivite"=>$type
      )
  );

  $countparticipenettoyage = $participenettoyage->rowCount();
  if($countparticipenettoyage>0){


  ?>


  <div class="content">
      <div class="container-fluid">
          <div class="card">
              <div class="card-content">
                  <h2 class="card-title text-center"><?php echo $titledelapage; ?></h2>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="card-content">
                        <br><br>
                        <center>
                        <h3 class="card-title">Information Complémentaire</h3>
                        </center>
                        <br>

                          <?php
                          $selectformulaireremplis = $db->prepare("SELECT * from communicationactivite WHERE slug LIKE :type");
                          $selectformulaireremplis->execute(array(
                              "type"=>'%'.$type.'%'
                              )
                          );

                          $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
                          $infoscomplementaires = $r2->infoscomplementaires;
                          ?>

                            <p align="justify"><?php echo $infoscomplementaires ?></p>
                        </div>
                      </div>

                      <div class="col-sm-6">
                          <div class="card-content">
                            <br><br>
                            <center>
                            <h3 class="card-title">Annuler sa Participation</h3>
                            </center>
                             <div class="card-content">
                                 <div class="info info-horizontal">
                                     <div class="description">
                                         <center>
                                         <h4 class="info-title">En cliquant sur ce bouton je renonce à participer à l'activitée</h4>
                                         <form action="" method="post">
                                         <input type="submit" class="btn btn-primary btn-round btn-rose" id="jeneparticipeplusnettoyage" name="jeneparticipeplusnettoyage" value="J'annule ma participation">
                                       </form>
                                         </center>
                                     </div>
                                 </div>
                             </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


<?php
                  if(!empty($_POST['jeneparticipeplusnettoyage'])){
                    $activity_name = 'nettoyage';
                    $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
                    $selectrealname->execute(array(
                        "typeactivite"=>$type
                        )
                    );


                    $r = $selectrealname->fetch(PDO::FETCH_OBJ);
                    $realname = $r->title;
                    $stock = $r->stock;
                    $newstock = $stock + '1';

                    $deleteparticipe2 = $db->prepare("DELETE FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
                    $deleteparticipe2->execute(array(
                        "user_id"=>$user_id,
                        "typeactivite"=>$typeactivite
                        )
                    );

                    $delcat2 = $db->prepare("DELETE FROM catparticipe WHERE user_id=:user_id AND name LIKE :realname");
                    $delcat2->execute(array(
                        "user_id"=>$user_id,
                        "realname"=>'%'.$realname.'%'
                        )
                    );

                    $updateacti2 = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
                    $updateacti2->execute(array(
                        "newstock"=>$newstock,
                        "typeactivite"=>$typeactivite
                        )
                    );

                  ?>
                  <script>
                      window.location = 'https://dashboard.jam-mdm.fr/activitees.php';
                  </script>
                  <?php
                  }
                  ?>


<?php
//FIN NETTOYAGE
}else{
  ?>
    <script>window.location="https://dashboard.jam-mdm.fr/";</script>
<?php
}}else if ($type == 'sportive'){

  $participesportive = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $participesportive->execute(array(
    "user_id"=>$user_id,
    "typeactivite"=>$type
  ));
  $countparticipesportive = $participesportive->rowCount();
  if($countparticipesportive>0){

  ?>
            <script>

             function SubmitFormDataSportive() {
               var user_id = "<?php echo $_SESSION['user_id']; ?>";
                var adresse = $("#adresse").val();
                var codepostal = $("#codepostal").val();
                var ville = $("#ville").val();
                var tel = $("#tel").val();
                var telurgence = $("#telurgence").val();
                $.post("ajax/modifyformulairesportive.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, tel:tel, telurgence: telurgence},
                function(data) {
                 $('#results3').html(data);

                });

            }
            </script>

            <?php

            $selectformulaireremplis = $db->prepare("SELECT * from formulairesportive WHERE user_id=:user_id");
            $selectformulaireremplis->execute(array(
                "user_id"=>$user_id
                )
            );

            $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
            $adresse = $r2->adresse;
            $codepostal = $r2->codepostal;
            $ville = $r2->ville;
            $tel = $r2->tel;
            $telurgence = $r2->telurgence;

             ?>

             <div class="content">
                 <div class="container-fluid">
                     <div class="card">
                         <div class="card-content">
                             <h2 class="card-title text-center"><?php echo $titledelapage; ?></h2>
                             <div class="row">
                               <div class="col-sm-6">
                                   <div class="card-content">
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
                                             <label class="control-label">Téléphone</label>
                                             <input type="number" name="tel" value="<?php echo $tel; ?>" id="tel" class="form-control">
                                         </div>
                                         <div class="form-group label-floating">
                                             <label class="control-label">Téléphone d'urgence</label>
                                             <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                                         </div>
                                         <center>
                                           <button id="submitFormDataSportive" onclick="SubmitFormDataSportive();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                         </center>
                                     </form>
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="card-content">
                                       <br><br><br>
                                       <center>
                                       <h3 class="card-title">Annuler sa Participation</h3>
                                       </center>
                                        <div class="card-content">
                                            <div class="info info-horizontal">
                                                <div class="description">
                                                    <center>
                                                    <h4 class="info-title">En cliquant sur ce bouton je renonce à participer à l'activitée</h4>
                                                    <form action="" method="post">
                                                    <input type="submit" class="btn btn-primary btn-round btn-rose" id="jeneparticipeplus" name="jeneparticipeplus" value="J'annule ma participation">
                                                   </form>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
               </div>




<?php

if(!empty($_POST['jeneparticipeplus'])){
  $activity_name = 'sportive';

  $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
  $selectrealname->execute(array(
      "typeactivite"=>$type
      )
  );


  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = $r->title;
  $stock = $r->stock;
  $newstock = $stock + '1';

  $deleteparticipe = $db->prepare("DELETE FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $deleteparticipe->execute(array(
      "user_id"=>$user_id,
      "typeactivite"=>$type
      )
  );

  $deletecatparticipe= $db->prepare("DELETE FROM catparticipe WHERE user_id=:user_id AND name LIKE :realname");
  $deletecatparticipe->execute(array(
      "user_id"=>$user_id,
      "realname"=>'%'.$realname.'%'
      )
  );

  $deleteformspor = $db->prepare("DELETE FROM formulairesportive WHERE user_id=:user_id");
  $deleteformspor->execute(array(
      "user_id"=>$user_id
      )
  );


  $updateacti = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
  $updateacti->execute(array(
      "newstock"=>$newstock,
      "typeactivite"=>$type
      )
  );


?>
<script>
    window.location = 'https://dashboard.jam-mdm.fr/activitees.php';
</script>
<?php
}
 ?>


              <div id="results3"></div>


<?php
//FIN SPORTIVE

}else{
  ?>

    <script>window.location="https://dashboard.jam-mdm.fr/";</script>
    <?php
}}else if ($type == 'orientation'){


  $participeorientation = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
  $participeorientation->execute(array(
    "user_id"=>$user_id,
    "typeactivite"=>$type
  ));
  $countparticipeorientation = $participeorientation->rowCount();
  if($countparticipeorientation>0){
  ?>
            <script>

             function SubmitFormDataOrientation() {
               var user_id = "<?php echo $_SESSION['user_id']; ?>";
                var adresse = $("#adresse").val();
                var codepostal = $("#codepostal").val();
                var ville = $("#ville").val();
                var tel = $("#tel").val();
                var telurgence = $("#telurgence").val();
                $.post("ajax/modifyformulaireorientation.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, tel:tel, telurgence: telurgence},
                function(data) {
                 $('#results4').html(data);

                });

            }
            </script>

            <?php
            $selectformulaireremplis = $db->prepare("SELECT * from formulaireorientation WHERE user_id=:user_id");
            $selectformulaireremplis->execute(array(
                "user_id"=>$user_id
                )
            );

            $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
            $adresse = $r2->adresse;
            $codepostal = $r2->codepostal;
            $ville = $r2->ville;
            $tel= $r2->tel;
            $telurgence = $r2->telurgence;

             ?>


             <div class="content">
                 <div class="container-fluid">
                     <div class="card">
                         <div class="card-content">
                             <h2 class="card-title text-center"><?php echo $titledelapage; ?></h2>
                             <div class="row">
                               <div class="col-sm-6">
                                   <div class="card-content">
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
                                             <label class="control-label">Téléphone</label>
                                             <input type="number" name="tel" value="<?php echo $tel; ?>" id="tel" class="form-control">
                                         </div>
                                         <div class="form-group label-floating">
                                             <label class="control-label">Téléphone d'urgence</label>
                                             <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                                         </div>
                                         <center>
                                           <button id="submitFormDataOrientation" onclick="SubmitFormDataOrientation();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                         </center>
                                     </form>
                                     </div>
                                 </div>
                                 <div class="col-sm-6">
                                     <div class="card-content">
                                       <br><br><br>
                                       <center>
                                       <h3 class="card-title">Annuler sa Participation</h3>
                                       </center>
                                        <div class="card-content">
                                            <div class="info info-horizontal">
                                                <div class="description">
                                                    <center>
                                                    <h4 class="info-title">En cliquant sur ce bouton je renonce à participer à l'activitée</h4>
                                                    <form action="" method="post">
                                                    <input type="submit" class="btn btn-primary btn-round btn-rose" id="jeneparticipeplusorientation" name="jeneparticipeplusorientation" value="J'annule ma participation">
                                                    </form>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

<?php


                  if(!empty($_POST['jeneparticipeplusorientation'])){
                    $activity_name = 'orientation';

                    $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
                    $selectrealname->execute(array(
                        "typeactivite"=>$type
                        )
                    );
                    $r = $selectrealname->fetch(PDO::FETCH_OBJ);
                    $realname = addslashes($r->title);
                    $stock = $r->stock;
                    $newstock = $stock + '1';

                    $deleteparticipe = $db->prepare("DELETE FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
                    $deleteparticipe->execute(array(
                        "user_id"=>$user_id,
                        "typeactivite"=>$type
                        )
                    );

                    $deletecatparticipe= $db->prepare("DELETE FROM catparticipe WHERE user_id=:user_id AND name LIKE :realname");
                    $deletecatparticipe->execute(array(
                        "user_id"=>$user_id,
                        "realname"=>'%'.$realname.'%'
                        )
                    );

                    $deleteformor = $db->prepare("DELETE FROM formulaireorientation WHERE user_id=:user_id");
                    $deleteformor->execute(array(
                        "user_id"=>$user_id
                        )
                    );


                    $updateacti = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
                    $updateacti->execute(array(
                        "newstock"=>$newstock,
                        "typeactivite"=>$type
                        )
                    );


                  ?>
                  <script>
                      window.location = 'https://dashboard.jam-mdm.fr/activitees.php';
                  </script>
                  <?php
                  }
                  ?>

              <div id="results4"></div>


<?php
//FIN ORIENTATION

}else{
?>
    <script>window.location="https://dashboard.jam-mdm.fr/";</script>

<?php
}
         ?>
        </div>
    </div>
</div>
</div>

</body>
<?php

} else if($type == "soireebar"){


    $participesoireebar = $db->prepare("SELECT * FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
    $participesoireebar->execute(array(
      "user_id"=>$user_id,
      "typeactivite"=>$type
    ));
    $countparticipesoireebar = $participesoireebar->rowCount();
    if($countparticipesoireebar>0){
    ?>
              <script>

               function SubmitFormDataSoireeBar() {
                 var user_id = "<?php echo $_SESSION['user_id']; ?>";
                  var adresse = $("#adresse").val();
                  var codepostal = $("#codepostal").val();
                  var ville = $("#ville").val();
                  var tel = $("#tel").val();
                  var telurgence = $("#telurgence").val();
                  $.post("ajax/modifyformulairesoireebar.php", { user_id:user_id, adresse: adresse, codepostal: codepostal, ville: ville, tel:tel, telurgence: telurgence},
                  function(data) {
                   $('#resultssoireebar').html(data);

                  });

              }
              </script>

              <?php
              $selectformulaireremplis = $db->prepare("SELECT * from formulairesoireebar WHERE user_id=:user_id");
              $selectformulaireremplis->execute(array(
                  "user_id"=>$user_id
                  )
              );

              $r2 = $selectformulaireremplis->fetch(PDO::FETCH_OBJ);
              $adresse = $r2->adresse;
              $codepostal = $r2->codepostal;
              $ville = $r2->ville;
              $tel= $r2->tel;
              $telurgence = $r2->telurgence;

               ?>


               <div class="content">
                   <div class="container-fluid">
                       <div class="card">
                           <div class="card-content">
                               <h2 class="card-title text-center"><?php echo $titledelapage; ?></h2>
                               <div class="row">
                                 <div class="col-sm-6">
                                     <div class="card-content">
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
                                               <label class="control-label">Téléphone</label>
                                               <input type="number" name="tel" value="<?php echo $tel; ?>" id="tel" class="form-control">
                                           </div>
                                           <div class="form-group label-floating">
                                               <label class="control-label">Téléphone d'urgence</label>
                                               <input type="number" name="telurgence" value="<?php echo $telurgence; ?>" id="telurgence" class="form-control">
                                           </div>
                                           <center>
                                             <button id="submitFormDatasoireebar" onclick="SubmitFormDataSoireeBar();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
                                           </center>
                                       </form>
                                       </div>
                                   </div>
                                   <div class="col-sm-6">
                                       <div class="card-content">
                                         <br><br><br>
                                         <center>
                                         <h3 class="card-title">Annuler sa Participation</h3>
                                         </center>
                                          <div class="card-content">
                                              <div class="info info-horizontal">
                                                  <div class="description">
                                                      <center>
                                                      <h4 class="info-title">En cliquant sur ce bouton je renonce à participer à l'activitée</h4>
                                                      <form action="" method="post">
                                                      <input type="submit" class="btn btn-primary btn-round btn-rose" id="jeneparticipeplussoireebar" name="jeneparticipeplussoireebar" value="J'annule ma participation">
                                                      </form>
                                                      </center>
                                                  </div>
                                              </div>
                                          </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

  <?php


                    if(!empty($_POST['jeneparticipeplussoireebar'])){
                      $activity_name = 'soireebar';

                      $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
                      $selectrealname->execute(array(
                          "typeactivite"=>$type
                          )
                      );
                      $r = $selectrealname->fetch(PDO::FETCH_OBJ);
                      $realname = addslashes($r->title);
                      $stock = $r->stock;
                      $newstock = $stock + '1';

                      $deleteparticipe = $db->prepare("DELETE FROM participe WHERE user_id=:user_id AND typeactivite=:typeactivite");
                      $deleteparticipe->execute(array(
                          "user_id"=>$user_id,
                          "typeactivite"=>$type
                          )
                      );

                      $deletecatparticipe= $db->prepare("DELETE FROM catparticipe WHERE user_id=:user_id AND name LIKE :realname");
                      $deletecatparticipe->execute(array(
                          "user_id"=>$user_id,
                          "realname"=>'%'.$realname.'%'
                          )
                      );

                      $deleteformor = $db->prepare("DELETE FROM formulairesoireebar WHERE user_id=:user_id");
                      $deleteformor->execute(array(
                          "user_id"=>$user_id
                          )
                      );


                      $updateacti = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
                      $updateacti->execute(array(
                          "newstock"=>$newstock,
                          "typeactivite"=>$type
                          )
                      );


                    ?>
                    <script>
                        window.location = 'https://dashboard.jam-mdm.fr/activitees.php';
                    </script>
                    <?php
                    }
                    ?>

                <div id="resultssoireebar"></div>


  <?php
  //FIN ORIENTATION

  }else{
  ?>
      <script>window.location="https://dashboard.jam-mdm.fr/";</script>

  <?php
  }
           ?>
          </div>
      </div>
  </div>
  </div>

  </body>
  <?php

    }
















  else{
?>
  <script>window.location="https://dashboard.jam-mdm.fr/";</script>
<?php
  }}else{
      header("Location:https://jam-mdm.fr/");
  }
  require_once('includes/javascriptdashboard.php');
?>

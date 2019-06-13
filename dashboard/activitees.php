<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
require_once('includes/checkmemberjam.php');
$nompage = "Activitees";
require_once('includes/head.php');
?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<body>
    <div class="wrapper">

      <?php
          require_once('includes/navbar.php');

      if(isset($_GET['activityname'])){
            $activity_slug=$_GET['activityname'];
            $select = $db->prepare("SELECT * FROM activitesvoyages WHERE slug=:activity_slug AND status=:status");
            $select->execute(array(
                "activity_slug"=>$activity_slug,
                "status"=>'ACTIVE'
                )
            );

            while($s=$select->fetch(PDO::FETCH_OBJ)){

              $lenght=100;
              $typeactivite = $s->typeactivite;
              $_SESSION['typeactivite']=$typeactivite;
              $description = $s->description;
              $new_description=substr($description,0,$lenght)."...";
              $description_finale=wordwrap($new_description,50,'<br />', false);
              ?>

              <div class="content">
                  <div class="container-fluid">
                      <div class="card">
                          <div class="card-content">
                              <h2 class="card-title text-center"><?php echo $s->title; ?></h2>
                              <div class="row">
                                  <div class="col-sm-4">
                                      <div class="card-content">
                                          <div class="info info-horizontal">
                                              <div class="icon icon-rose">
                                                  <i class="material-icons">description</i>
                                              </div>
                                              <div class="description">
                                                  <h4 class="info-title">Description</h4>
                                                  <p class="description">
                                                      <?php echo $description_finale; ?>
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="card-content">
                                          <div class="info info-horizontal">
                                              <div class="icon icon-primary">
                                                  <i class="material-icons">euro_symbol</i>
                                              </div>
                                              <div class="description">
                                                  <h4 class="info-title">Prix</h4>
                                                  <p class="description">
                                                      Le prix de base pour cette activitées est de <?php echo $s->price; ?> €
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-4">
                                      <div class="card-content">
                                          <div class="info info-horizontal">
                                              <div class="icon icon-info">
                                                  <i class="material-icons">link</i>
                                              </div>
                                              <div class="description">
                                                  <h4 class="info-title">Plus d'information</h4>
                                                  <p class="description">
                                                      Pour plus d'information sur cette activité, vous pouvez <a href="https://jam-mdm.fr/activitees.php?showmethisactivity=<?php echo $activity_slug ?>" target="_blank">cliquer ici</a>.
                                                  </p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <?php
                  $prixactivite = $s->price;
                  $stock = $s->stock;
                  ?>

                  <?php
                }if ($typeactivite == "ski"){
                    // Si l'activité est du ski alors on affiche ce type de formulaire
                  ?>

                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="card">
                                  <div class="card-content">
                                      <center>
                                          <h3 class="card-title">Choisir une formule</h3>
                                      </center>
                                      <form name="repas" method="POST">
                                          <div class="card-content">
                                              <div class="row">
                                                  <div class="col-md-6">
                                                      <div class="info info-horizontal">
                                                          <div class="description">
                                                              <center>
                                                                  <h4 class="info-title">Le matériel</h4>
                                                              </center>
                                                              <p class="description">

                                            <?php
                                              $select0 = $db->prepare("SELECT * FROM activityradio WHERE slug LIKE :activity_slug and type=:materiel");
                                              $select0->execute(array(
                                                  "activity_slug"=>'%ski%',
                                                  "materiel"=>'materiel'
                                                  )
                                              );

                                              while($s0=$select0->fetch(PDO::FETCH_OBJ)){
                                                $type = $s0->type;
                                                $price = $s0->price;
                                                $packname = $s0->packname;
                                                ?>

                                                                  <div class="radio">
                                                                      <label>
                                                                          <input type="radio" name="optionmateriel" value="<?php echo $packname; ?>"> <?php echo $packname; ?> (<?php echo $price; ?>€)
                                                                      </label>
                                                                  </div>

                                                <?php } ?>

                                                              </p>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="info info-horizontal">
                                                          <div class="description">
                                                              <center>
                                                                  <h4 class="info-title">Le repas</h4>
                                                              </center>
                                                              <p class="description">

                                                  <?php
                                                    $select1 = $db->prepare("SELECT * FROM activityradio WHERE slug LIKE :activity_slug and type=:repas");

                                                    $select1->execute(array(
                                                        "activity_slug"=>'%ski%',
                                                        "repas"=>'repas'
                                                        )
                                                    );

                                                    while($s1=$select1->fetch(PDO::FETCH_OBJ)){
                                                      $type1 = $s1->type;
                                                      $price1 = $s1->price;
                                                      $packname1 = $s1->packname;
                                                      ?>

                                                                  <div class="radio">
                                                                      <label>
                                                                          <input type="radio" name="option<?php echo $type1;?>" value="<?php echo $packname1; ?>"> <?php echo $packname1; ?> (<?php echo $price1; ?>€)
                                                                      </label>
                                                                  </div>

                                                      <?php } ?>

                                                              </p>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                      <div class="info info-horizontal">
                                                          <div class="description">
                                                              <center>
                                                                  <h4 class="info-title">Options Additionnelles</h4>
                                                              </center>
                                                              <p class="description">

                                                  <?php
                                                    $select3 = $db->prepare("SELECT * FROM activityradio WHERE slug LIKE :activity_slug and type=:additionnelles");

                                                    $select3->execute(array(
                                                        "activity_slug"=>'%ski%',
                                                        "additionnelles"=>'additionnelles'
                                                        )
                                                    );

                                                    while($s3=$select3->fetch(PDO::FETCH_OBJ)){
                                                      $type3 = $s3->type;
                                                      $price3 = $s3->price;
                                                      $packname3 = $s3->packname;
                                                      ?>

                                                                  <div class="radio">
                                                                      <label>
                                                                          <input type="radio" name="option<?php echo $type3;?>" value="<?php echo $packname3; ?>"> <?php echo $packname3; ?> (<?php echo $price3; ?>€)
                                                                      </label>
                                                                  </div>

                                                      <?php } ?>

                                                              </p>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="footer text-center">
                                              <button type="submit" class="btn btn-primary btn-round btn-rose"> Valider mes choix</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>

                          <?php
                          $optionmaterielform = $_POST['optionmateriel'];
                          $optionrepasform = $_POST['optionrepas'];
                          $optionadditionnellesform = $_POST['optionadditionnelles'];

                          $selectpricemateriel = $db->prepare("SELECT price FROM activityradio WHERE packname=:optionmaterielform");
                          $selectpricemateriel->execute(array(
                              "optionmaterielform"=>$optionmaterielform
                              )
                          );
                          $r = $selectpricemateriel->fetch(PDO::FETCH_OBJ);
                          $prixmateriel = $r->price;

                          $selectpricerepas= $db->prepare("SELECT price FROM activityradio WHERE packname=:optionrepasform");
                          $selectpricerepas->execute(array(
                              "optionrepasform"=>$optionrepasform
                              )
                          );
                          $r2 = $selectpricerepas->fetch(PDO::FETCH_OBJ);
                          $prixrepas = $r2->price;


                          $selectpriceadditionnelles= $db->prepare("SELECT price FROM activityradio WHERE packname=:optionadditionnellesform");
                          $selectpriceadditionnelles->execute(array(
                              "optionadditionnellesform"=>$optionadditionnellesform
                              )
                          );
                          $r3 = $selectpriceadditionnelles->fetch(PDO::FETCH_OBJ);
                          $prixadditionnelles = $r3->price;

                          if(isset($prixmateriel) && isset($prixrepas) && isset($prixadditionnelles)){
                              //27/11/2018
                          $activity_name = $_GET['activityname'];

                            $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
                            $check->execute(array(
                                "typeactivite"=>$typeactivite,
                                "user_id"=>$user_id
                                )
                            );
                            $countcheck = $check->rowCount();

                          ?>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-content">
                                        <center>
                                            <h3 class="card-title">Validation et Paiement</h3>
                                        </center>
                                            <div class="card-content">
                                                <div class="info info-horizontal">
                                                    <div class="description">
                                                        <center>
                                                            <?php
                                                            if($countcheck>0){
                                                            ?>
                                                            <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                                            <?php
                                                            }else{

                                                            $total = $prixactivite + $prixmateriel + $prixrepas + $prixadditionnelles;
                                                            ?>
                                                            <h4 class="info-title">Prix Total : <?php echo $total;?>€</h4>
                                                            <?php
                                                            if($stock>0){
                                                             ?>
                                                            <div align="center" id="paypal-button"></div>
                                                            <?php
                                                            }else{
                                                            ?>
                                                            <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                                            <?php } } ?>
                                                      </center>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <?php }  ?>
                          </div>
                      </div>

                                            <?php
                                            //Si ce n'est pas du ski alors on passe à :
                                          }else if ($typeactivite == "rugby"){
                                            ?>

                                              <div class="container-fluid">
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="card">
                                                              <div class="card-content">
                                                                <center>
                                                                  <h3 class="card-title">Choisir une formule</h3>
                                                                </center>
                                                                        <form name="accompagnement" method="POST">
                                                                          <div class="card-content">
                                                                            <div class="row">
                                                                            <div class="col-md-6">
                                                                            <div class="info info-horizontal">
                                                                                <div class="description">
                                                                                  <center>
                                                                                    <h4 class="info-title">Le match</h4>
                                                                                  </center>
                                                                                    <p class="description">

                                                  <?php
                                                    $select4 = $db->prepare("SELECT * FROM activityradio WHERE slug LIKE :activity_slug and type=:accompagnement");
                                                    $select4->execute(array(
                                                        "activity_slug"=>'%rugby%',
                                                        "accompagnement"=>'accompagnement'
                                                        )
                                                    );

                                                    while($s4=$select4->fetch(PDO::FETCH_OBJ)){
                                                      $type4 = $s4->type;
                                                      $price4 = $s4->price;
                                                      $packname4 = $s4->packname;

                                                      ?>
                                                      <div class="radio">
                                                        <label>
                                                          <input type="radio" name="option<?php echo $type4;?>" value="<?php echo $packname4; ?>"> <?php echo $packname4; ?> (<?php echo $price4; ?>€)
                                                        </label>
                                                      </div>
                                                      <?php } ?>
                                                          </p>
                                                      </div>
                                                  </div>

                                              </div>
                                              <div class="col-md-6">
                                                <br><br><br><br>
                                                <div class="text-center">
                                                   <button type="submit" class="btn btn-primary btn-round btn-rose"> Valider mes choix</button>
                                              </div>
                                              </div>
                                            </div>
                                      </div>
                                      <br><br>

                                      </form>
                                  </div>
                              </div>
                          </div>


                    <?php
                    $optionaccompagnementform = $_POST['optionaccompagnement'];
                    $selectpriceaccompagnement = $db->prepare("SELECT price FROM activityradio WHERE packname=:optionaccompagnementform");
                    $selectpriceaccompagnement->execute(array(
                        "optionaccompagnementform"=>$optionaccompagnementform
                        )
                    );
                    $r = $selectpriceaccompagnement->fetch(PDO::FETCH_OBJ);
                    $prixaccompagnement = $r->price;


                    if(isset($prixaccompagnement)){
                        $activity_name = $_GET['activityname'];

                            $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
                            $check->execute(array(
                                "typeactivite"=>$typeactivite,
                                "user_id"=>$user_id
                                )
                            );

                            $countcheck = $check->rowCount();

                     ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-content">
                              <center>
                                <h3 class="card-title">Validation et Paiement</h3>
                              </center>
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <div class="description">
                                            <center>
                                            <?php
                                            if($countcheck>0){
                                            ?>
                                            <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                            <?php
                                            }else{

                                            $total = $prixactivite + $prixaccompagnement;
                                            ?>
                                              <h4 class="info-title">Prix Total : <?php echo $total;?>€</h4>
                                                <?php
                                              if($stock>0){
                                                 ?>
                                                <div align="center" id="paypal-button"></div>
                                                <?php
                                              }else{
                                                ?>
                                                <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                              <?php } } ?>
                                              </center>
                                          </div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                  <?php }  ?>
                </div>
            </div>

            <?php


          }else if ($typeactivite == "cinema"){


            $activity_name = $_GET['activityname'];

            $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
            $check->execute(array(
              "typeactivite"=>$typeactivite,
              "user_id"=>$user_id
            ));
            $countcheck = $check->rowCount();

?>
            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                      <div class="card">
                          <div class="card-content">
                            <center>
                              <h3 class="card-title">Validation et Paiement</h3>
                            </center>
                            <form name="accompagnement" method="POST">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <div class="description">
                                          <center>
                                          <?php
                                          if($countcheck>0){
                                          ?>
                                          <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                          <?php
                                          }else{

                                          $total = $prixactivite;
                                          ?>
                                            <h4 class="info-title">Prix Total : <?php echo $total;?>€</h4>
                                              <?php
                                            if($stock>0){
                                               ?>
                                              <div align="center" id="paypal-button"></div>
                                              <?php
                                            }else{
                                              ?>
                                              <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                            <?php } } ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

<?php
//DEBUT NETTOYAGE



            //Fin Cinema
          }else if ($typeactivite == "sportive"){
              $activity_name = $activity_slug;
              $participe = $db->prepare("SELECT * FROM participe where user_id=:user_id and typeactivite=:typeactivite");

              $participe->execute(array(
                  "user_id"=>$user_id,
                  "typeactivite"=>$typeactivite
                  )
              );

              $countparticipe = $participe->rowCount();

            ?>
            <?php

             ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-content">
                              <center>
                                <h3 class="card-title">Choisir une formule</h3>
                              </center>
                                      <form name="organisation" method="POST">
                                        <div class="card-content">
                                          <div class="row">
                                          <div class="col-md-6">
                                          <div class="info info-horizontal">
                                              <div class="description">
                                                <center>
                                                  <h4 class="info-title">L'organisation</h4>
                                                </center>
                                                  <p class="description">

                                                    <?php
                                                      $select4 = $db->prepare("SELECT * FROM activityradio WHERE slug LIKE :activity_slug and type=:organisation");
                                                      $select4->execute(array(
                                                          "activity_slug"=>'%sportive%',
                                                          "organisation"=>'organisation'
                                                          )
                                                      );

                                                      while($s4=$select4->fetch(PDO::FETCH_OBJ)){
                                                        $type4 = $s4->type;
                                                        $packname4 = $s4->packname;
                                                        ?>
                                                        <div class="radio">
                                                          <label>
                                                            <input type="radio" name="optionorganisation" value="<?php echo $packname4; ?>"> <?php echo $packname4; ?>
                                                          </label>
                                                        </div>
                                                      <?php  }  ?>
                                                        </p>
                                                    </div>
                                                </div>

                                          </div>
                                          <div class="col-md-6">
                                            <br><br><br><br><br>
                                            <div class="text-center">
                                               <button type="submit" class="btn btn-primary btn-round btn-rose"> Valider mes choix</button>
                                          </div>
                                          </div>
                                        </div>
                                  </div>
                                  </form>
                                </div>
                                </div>
                                </div>
                                <?php

                                 ?>


                                <?php

                                if(!empty($_POST['jeparticipe'])){
                                  $optionorganisation = $_SESSION['optionorganisation'];

                $activity_name = $activity_slug;
                      $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
                      $selectrealname->execute(array(
                          "typeactivite"=>$typeactivite
                          )
                      );

                      $r = $selectrealname->fetch(PDO::FETCH_OBJ);
                      $realname = $r->title;
                      $stock = $r->stock;
                      $newstock = $stock - '1';
                      $pageformulaire = 'formulaire.php?type=sportive';
                      $icon = 'map';
                      $date = strftime('%d/%m/%Y %H:%M:%S');

                      $insertinfos = $db->prepare("INSERT INTO participe (user_id, activity_name, typeactivite, date, optionorganisation) VALUES(:user_id , :activity_name , :typeactivite, :date, :optionorganisation)");
                                      $insertinfos->execute(array(
                                          "user_id"=>$user_id,
                                          "activity_name"=>$activity_name,
                                          "typeactivite"=>$typeactivite,
                                          "date"=>$date,
                                          "optionorganisation"=>$optionorganisation
                                          )
                                      );
                      $insertcatparticipe = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
                      $insertcatparticipe->execute(array(
                          "user_id"=>$user_id,
                          "realname"=>$realname,
                          "pageformulaire"=>$pageformulaire,
                          "icon"=>$icon
                          )
                      );

                      $insertformulairesportive = $db->prepare("INSERT INTO formulairesportive (user_id) VALUES(:user_id)");
                      $insertformulairesportive->execute(array(
                          "user_id"=>$user_id
                          )
                      );

                      $insertactivitesvoyages = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
                      $insertactivitesvoyages->execute(array(
                          "newstock"=>$newstock,
                          "typeactivite"=>$typeactivite
                          )
                      );

                      ?>
                      <script>
                          window.location = 'https://dashboard.jam-mdm.fr/formulaire.php?type=sportive';
                      </script>
                      <?php
                      unset($_SESSION['optionorganisation']);
                    }





                    if(isset($_POST['optionorganisation'])){
                      $_SESSION['optionorganisation'] = $_POST['optionorganisation'];
                        $activity_name = $_GET['activityname'];

                $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
                $check->execute(array(
                    "typeactivite"=>$typeactivite,
                    "user_id"=>$user_id
                    )
                );




                $countcheck = $check->rowCount();

                     ?>
                    <div class="col-md-6">
                    <div class="card">
                    <div class="card-content">
                    <center>
                    <h3 class="card-title">Participation</h3>
                    </center>
                    <div class="card-content">
                      <div class="info info-horizontal">
                          <div class="description">
                              <center>
                                <?php
                                if($countcheck>0){
                                ?>
                                <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                <?php
                                }else{
                                ?>
                                <h4 class="info-title">En cliquant sur ce bouton j'accepte de participer à l'activitée</h4>
                                <form action="" method="post">
                                  <?php
                                    $selectstock = $db->prepare("SELECT stock from activitesvoyages WHERE typeactivite=:typeactivite");
                                    $selectstock->execute(array(
                                        "typeactivite"=>$typeactivite
                                        )
                                    );

                                    $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
                                    $stock = $rstock->stock;
                                    if($stock>0){
                                    ?>
                                    <button type="submit" class="btn btn-primary btn-round" id="jeparticipe" name="jeparticipe" value="Je Participe">Je Participe</button>
                                    <?php
                                    }else{
                                    ?>
                                    <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                    <?php
                                    } }
                                  ?>
                                </form>
                                    <br><br>
                              </center>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }  ?>
</div>
</div>
<?php
            //DEBUT NETTOYAGE
          }else if ($typeactivite == "nettoyage"){

              $activity_name = $activity_slug;
              $participe = $db->prepare("SELECT * FROM participe where user_id=:user_id and typeactivite=:typeactivite");

              $participe->execute(array(
                  "user_id"=>$user_id,
                  "typeactivite"=>$typeactivite
                  )
              );

              $countparticipe = $participe->rowCount();

              if(!empty($_POST['jeparticipenettoyage'])){

                $activity_name = $activity_slug;
                $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
                $selectrealname->execute(array(
                    "typeactivite"=>$typeactivite
                    )
                );
                $r = $selectrealname->fetch(PDO::FETCH_OBJ);
                $realname = $r->title;
                $stock = $r->stock;
                $newstock = $stock - '1';
                $pageformulaire = 'formulaire.php?type=nettoyage';
                $icon = 'map';


                $date = strftime('%d/%m/%Y %H:%M:%S');
                $insertparticipation = $db->prepare("INSERT INTO participe (user_id, activity_name, typeactivite, date) VALUES(:user_id , :activity_name , :typeactivite, :date)");
                $insertparticipation->execute(array(
                    "user_id"=>$user_id,
                    "activity_name"=>$activity_name,
                    "typeactivite"=>$typeactivite,
                    "date"=>$date
                    )
                );


                $updateactivite = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
                $updateactivite->execute(array(
                    "newstock"=>$newstock,
                    "typeactivite"=>$typeactivite
                    )
                );


                $updatecatactivite = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
                $updatecatactivite->execute(array(
                    "user_id"=>$user_id,
                    "realname"=>$realname,
                    "pageformulaire"=>$pageformulaire,
                    "icon"=>$icon
                    )
                );

                ?>
                <script>
                    window.location = 'https://dashboard.jam-mdm.fr/formulaire.php?type=nettoyage';
                </script>
                <?php
              }

              $activity_name = $_GET['activityname'];

                            $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
                            $check->execute(array(
                                "typeactivite"=>$typeactivite,
                                "user_id"=>$user_id
                                )
                            );
                            $countcheck = $check->rowCount();
            ?>

            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                      <div class="card">
                          <div class="card-content">
                            <center>
                              <h3 class="card-title">Participation</h3>
                            </center>
                            <form action="" method="post">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <div class="description">
                                          <center>
                                            <?php
                                            if($countcheck>0){
                                            ?>
                                            <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                            <?php
                                            }else{
                                            ?>
                                            <h4 class="info-title">En cliquant sur ce bouton j'accepte de participer à l'activitée</h4>
                                            <?php
                                              $activity_name = $activity_slug;
                                              $selectstock = $db->prepare("SELECT stock from activitesvoyages WHERE typeactivite=:typeactivite");
                                              $selectstock->execute(array(
                                                  "typeactivite"=>$typeactivite

                                                  )
                                              );
                                              $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
                                              $stock = $rstock->stock;
                                              if($stock>0){
                                              ?>
                                              <button type="submit" class="btn btn-primary btn-round" id="jeparticipenettoyage" name="jeparticipenettoyage" value="Je Participe">Je Participe</button>
                                              <?php
                                              }else{
                                              ?>
                                              <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                              <?php
                                              } }
                                              ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

            <?php
          //FIN NETTOYAGE
          //DEBUT JOURNEE COURSE ORIENTATION
        }else if ($typeactivite == "orientation"){

          $activity_name = $activity_slug;
          $participe = $db->prepare("SELECT * FROM participe where user_id=:user_id and typeactivite=:typeactivite");
          $participe->execute(array(
              "user_id"=>$user_id,
              "typeactivite"=>$typeactivite
              )
          );

          $countparticipe = $participe->rowCount();

          if(!empty($_POST['jeparticipeorientation'])){
            $activity_name = $activity_slug;
            $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
            $selectrealname->execute(array(
                "typeactivite"=>$typeactivite
                )
            );
            $r = $selectrealname->fetch(PDO::FETCH_OBJ);
            $realname = $r->title;
            $stock = $r->stock;
            $newstock = $stock - '1';
            $pageformulaire = 'formulaire.php?type=orientation';
            $icon = 'map';
            $date = strftime('%d/%m/%Y %H:%M:%S');
            $insertparticipe = $db->prepare("INSERT INTO participe (user_id, activity_name, typeactivite, date) VALUES(:user_id , :activity_name , :typeactivite, :date)");
            $insertparticipe->execute(array(
                "user_id"=>$user_id,
                "activity_name"=>$activity_name,
                "typeactivite"=>$typeactivite,
                "date"=>$date
                )
            );

            $insertcatparticipe = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
            $insertcatparticipe->execute(array(
                "user_id"=>$user_id,
                "realname"=>$realname,
                "pageformulaire"=>$pageformulaire,
                "icon"=>$icon
                )
            );

            $insertformulaireorientation = $db->prepare("INSERT INTO formulaireorientation (user_id) VALUES(:user_id)");
            $insertformulaireorientation->execute(array(
                "user_id"=>$user_id
                )
            );

            $updateformulaire = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
            $updateformulaire->execute(array(
                "newstock"=>$newstock,
                "typeactivite"=>$typeactivite
                )
            );

            ?>
            <script>
                window.location = 'https://dashboard.jam-mdm.fr/formulaire.php?type=orientation';
            </script>
            <?php
          }

          $activity_name = $_GET['activityname'];

                            $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
                            $check->execute(array(
                                "typeactivite"=>$typeactivite,
                                "user_id"=>$user_id
                                )
                            );
                            $countcheck = $check->rowCount();
          ?>

          <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="card">
                        <div class="card-content">
                          <center>
                            <h3 class="card-title">Participation</h3>
                          </center>
                          <form action="" method="post">
                              <div class="card-content">
                                  <div class="info info-horizontal">
                                      <div class="description">
                                        <center>
                                          <?php
                                          if($countcheck>0){
                                          ?>
                                          <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                          <?php
                                          }else{
                                          ?>
                                          <h4 class="info-title">En cliquant sur ce bouton j'accepte de participer à l'activitée</h4>
                                        <?php
                                          $activity_name = $activity_slug;
                                          $selectstock = $db->prepare("SELECT stock from activitesvoyages WHERE typeactivite=:typeactivite");
                                          $selectstock->execute(array(
                                              "typeactivite"=>$typeactivite
                                              )
                                          );
                                          $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
                                          $stock = $rstock->stock;
                                          if($stock>0){
                                          ?>
                                          <button type="submit" class="btn btn-primary btn-round" id="jeparticipeorientation" name="jeparticipeorientation" value="Je Participe">Je Participe</button>
                                          <?php
                                          }else{
                                          ?>
                                          <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                          <?php
                                          } }
                                          ?>
                                          </center>
                                      </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <?php
        }else if ($typeactivite == "soireebar"){

            $activity_name = $activity_slug;
            $participe = $db->prepare("SELECT * FROM participe where user_id=:user_id and typeactivite=:typeactivite");
            $participe->execute(array(
                "user_id"=>$user_id,
                "typeactivite"=>$typeactivite
                )
            );

            $countparticipe = $participe->rowCount();

            if(!empty($_POST['jeparticipesoireebar'])){
              $activity_name = $activity_slug;
              $selectrealname = $db->prepare("SELECT title,stock from activitesvoyages WHERE typeactivite=:typeactivite");
              $selectrealname->execute(array(
                  "typeactivite"=>$typeactivite
                  )
              );
              $r = $selectrealname->fetch(PDO::FETCH_OBJ);
              $realname = $r->title;
              $stock = $r->stock;
              $newstock = $stock - '1';
              $pageformulaire = 'formulaire.php?type=soireebar';
              $icon = 'local_drink';
              $date = strftime('%d/%m/%Y %H:%M:%S');
              $insertparticipe = $db->prepare("INSERT INTO participe (user_id, activity_name, typeactivite, date) VALUES(:user_id , :activity_name , :typeactivite, :date)");
              $insertparticipe->execute(array(
                  "user_id"=>$user_id,
                  "activity_name"=>$activity_name,
                  "typeactivite"=>$typeactivite,
                  "date"=>$date
                  )
              );

              $insertcatparticipe = $db->prepare("INSERT INTO catparticipe (user_id, name, page, icon) VALUES(:user_id, :realname, :pageformulaire, :icon)");
              $insertcatparticipe->execute(array(
                  "user_id"=>$user_id,
                  "realname"=>$realname,
                  "pageformulaire"=>$pageformulaire,
                  "icon"=>$icon
                  )
              );

              $insertformulaireorientation = $db->prepare("INSERT INTO formulairesoireebar (user_id) VALUES(:user_id)");
              $insertformulaireorientation->execute(array(
                  "user_id"=>$user_id
                  )
              );

              $updateformulaire = $db->prepare("UPDATE activitesvoyages SET stock=:newstock WHERE typeactivite=:typeactivite");
              $updateformulaire->execute(array(
                  "newstock"=>$newstock,
                  "typeactivite"=>$typeactivite
                  )
              );

              ?>
              <script>
                  window.location = 'https://dashboard.jam-mdm.fr/formulaire.php?type=orientation';
              </script>
              <?php
            }

            $activity_name = $_GET['activityname'];

                              $check = $db->prepare("SELECT user_id FROM participe WHERE typeactivite=:typeactivite and user_id=:user_id");
                              $check->execute(array(
                                  "typeactivite"=>$typeactivite,
                                  "user_id"=>$user_id
                                  )
                              );
                              $countcheck = $check->rowCount();
            ?>

            <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                      <div class="card">
                          <div class="card-content">
                            <center>
                              <h3 class="card-title">Participation</h3>
                            </center>
                            <form action="" method="post">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <div class="description">
                                          <center>
                                            <?php
                                            if($countcheck>0){
                                            ?>
                                            <h4 class="info-title"><font color="red">Tu participe déja à cette activitée</font></h4>
                                            <?php
                                            }else{
                                            ?>
                                            <h4 class="info-title">En cliquant sur ce bouton j'accepte de participer à l'activitée</h4>
                                          <?php
                                            $activity_name = $activity_slug;
                                            $selectstock = $db->prepare("SELECT stock from activitesvoyages WHERE typeactivite=:typeactivite");
                                            $selectstock->execute(array(
                                                "typeactivite"=>$typeactivite
                                                )
                                            );
                                            $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
                                            $stock = $rstock->stock;
                                            if($stock>0){
                                            ?>
                                            <button type="submit" class="btn btn-primary btn-round" id="jeparticipesoireebar" name="jeparticipesoireebar" value="Je Participe">Je Participe</button>
                                            <?php
                                            }else{
                                            ?>
                                            <h4 class="info-title"><font color="red">Aucune place disponible</font></h4>
                                            <?php
                                            } }
                                            ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <?php
            }
          ?>
        </div>
          <script>
              paypal.Button.render({
          <?php

          if ($typeactivite == "ski"){

                    $total = $prixactivite + $prixmateriel + $prixrepas;
                    $_SESSION['activity_name'] = $activity_slug;
                    $_SESSION['optionmateriel'] = $optionmaterielform;
                    $_SESSION['optionrepas'] = $optionrepasform;
                    $_SESSION['optionadditionnelles'] = $optionadditionnellesform;
          }else if ($typeactivite == "rugby"){

            $total = $prixactivite + $prixaccompagnement;
            $_SESSION['activity_name'] = $activity_slug;
            $_SESSION['optionaccompagnement'] = $optionaccompagnementform;

          }else if ($typeactivite == "cinema"){
              $_SESSION['activity_name'] = $activity_slug;
              $total = $prixactivite;
          }


          ?>
                  env: 'sandbox',

                  client: {
                      sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                      production: 'AXaV8dsJkxtDm__NKyNdyXBxp9wa8TSS8YZvNOyk3OEpi9rO82H3lc2wKhQrEbJS7NxfnLJ9Igq-rsIC'
                  },


                  style: {
                      layout: 'vertical',  // horizontal | vertical
                      size:   'medium',    // medium | large | responsive
                      shape:  'pill',      // pill | rect
                      color:  'blue'       // gold | blue | silver | black
                  },

                  commit: true,

                  payment: function(data, actions) {

                      return actions.payment.create({
                          payment: {
                              transactions: [
                                  {
                                      amount: { total: <?= $total ?>, currency: 'EUR' }
                                  }
                              ]
                          },
                      });
                  },

                  onAuthorize: function(data, actions) {

                      return actions.payment.get().then(function(data) {

                          console.log(data);

                          var shipping = data.payer.payer_info.shipping_address;

                          var name = shipping.recipient_name;
                          var street = shipping.line1;
                          var country_code = shipping.country_code;
                          var city = shipping.city;
                          var date = '<?= date("d/m/Y") ?>';
                          var transaction_id = data.id;
                          var price = data.transactions[0].amount.total;
                          var currency_code = 'EUR';

                          $.post(
                              "process.php",
                              {
                                  name : name,
                                  street: street,
                                  city: city,
                                  country_code : country_code,
                                  date: date,
                                  transaction_id: transaction_id,
                                  price: price,
                                  currency_code: currency_code,
                              }
                          );
                          return actions.payment.execute().then(function() {
                              $(location).attr("href", '<?= "https://dashboard.jam-mdm.fr"; ?>');
                          });
                      });
                  },

              }, '#paypal-button');
          </script>

          <br/><br/><br/><br/>

          <?php

      }else{

      ?>

      <div class="content">
          <div class="container-fluid">
              <div class="card">
                  <div class="card-content">
                      <h2 class="card-title text-center">Listes des activitées proposé par l'Association</h2>
                  </div>
              </div>
              <div class="row">

                      <?php
                      $user_id = $_SESSION['user_id'];
                      $sql = "SELECT * FROM activitesvoyages WHERE status='ACTIVE' ORDER BY date ASC";
                      $req = $db->query($sql);
                      $req->setFetchMode(PDO::FETCH_ASSOC);
                      foreach($req as $row){


                      ?>

                        <div class="col-md-4">
                            <div class="card card-product">
                                <div class="card-image" data-header-animation="false">
                                        <img class="img" src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $row['slug']; ?>.<?php echo $row['formatimg']; ?>">
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <?php echo $row['title']; ?>
                                    </h3>
                                    <div class="card-description">
                                      <h4><p><?php echo $row['datesejour']; ?><br>
                                      Prix : <b><?php echo $row['price']; ?>€</b></p></h4>
                                        <?php $price = $row['price']; ?>
                                    </div>
                                    <center>
                                      <a href="activitees.php?activityname=<?php echo $row['slug'];?>">
                                    <button class="btn btn-rose btn-round btn-sm">Je participe</button></a>
                                    </center>
                                </div>
                            </div>
                        </div>

                      <?php  } ?>


                    </div>
                </div>
            </div>
        </div>

<?php
}

    require_once('includes/javascriptdashboard.php');
?>
</body>

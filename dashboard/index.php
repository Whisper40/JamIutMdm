<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Tableau de bord";
    require_once('includes/head.php');
?>

<body>
    <div class="wrapper">

<?php
    require_once('includes/navbar.php');
?>

<!-- DEBUT DU CADRE -->
<!-- Cette partie délimitée par début et fin peut etre enlevée , cela concerne tout ce qui se trouve à l'interieur de la page ( cubes + actus ) -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="material-icons">euro_symbole</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Date d'inscription</p>
                                <h4 class="card-title">

                                                <?php
                                                    $selectsubscribe = $db->prepare("SELECT subscribe FROM users WHERE id = :user_id");
                                                    $selectsubscribe->execute(array(
                                                        "user_id"=>$user_id
                                                        )
                                                    );

                                                  $s2 = $selectsubscribe->fetch(PDO::FETCH_OBJ);
                                                  $subscribe = $s2->subscribe;
                                                  echo $subscribe;
                                                        ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="orange">
                                <i class="material-icons">dns</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Nombre de participation</p>
                                <h4 class="card-title">

                                              <?php
                                                  $user_id = $_SESSION['user_id'];

                                                  $selectcountacti = $db->prepare("SELECT countactivite FROM users WHERE id = :user_id");
                                                  $selectcountacti->execute(array(
                                                      "user_id"=>$user_id
                                                      )
                                                  );

                                                $s = $selectcountacti->fetch(PDO::FETCH_OBJ);
                                                $countacti = $s->countactivite;
                                                echo $countacti;
                                                      ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="red">
                                <i class="material-icons">assignment_late</i>
                            </div>
                            <div class="card-content">
                                <p class="category"> Date de fin d'adhésion</p>
                                <h4 class="card-title">

                                  <?php
                                      $selectdatefin = $db->prepare("SELECT datefin FROM annuelle");
                                      $selectdatefin->execute();

                                    $s2 = $selectdatefin->fetch(PDO::FETCH_OBJ);
                                    $datefin = $s2->datefin;
                                    echo $datefin;
                                          ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>


<?php
    require_once('includes/javascriptdashboard.php');
?>
</body>

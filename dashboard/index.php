<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />

  <meta name="Description" content="Association JAM ( Jeunesse Associative Montoise ) - Mont de Marsan">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr"> <!-- Mail Admin -->


  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Jam - Dashboard</title>


    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
</head>


<?php

require_once('includes/head.php');

require_once('includes/checkconnection.php');

?>

<body>
    <div class="wrapper">

      <?php
      $nompage = "Tableau de bord";
      require_once('includes/header.php');
      ?>

<!-- DEBUT DU CADRE -->
<!-- Cette partie délimitée par début et fin peut etre enlevée , cela concerne tout ce qui se trouve à l'interieur de la page ( cubes + actus ) -->
            <div class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="orange">
                                                <i class="material-icons">dns</i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Nombre de services</p>
                                                                                    <h3 class="card-title">

            <?php
                        $req = $db->query("SELECT  COUNT(*) as id FROM products_transactions WHERE user_id = '$user_id'");

                        $donnees = $req->fetch();
                        $req->closeCursor();
                        echo $donnees['id'];?>


                                                                                    </h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                   <i class="material-icons text-danger">shopping_cart</i>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="green">
                                                <i class="material-icons">euro_symbole</i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Solde</p>
                                                <h3 class="card-title">

            <?php
            $user_id = $_SESSION['user_id'];
            $select = $db->query("SELECT * FROM users WHERE id = '$user_id'");

            while($s = $select->fetch(PDO::FETCH_OBJ)){
                ?>
                <?php echo $s->solde.€; ?>




                <?php
            }

            ?>

                                                </h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">add</i>Dernier ajout le :



            <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT DISTINCT date FROM transactions WHERE date= (SELECT MAX(date) FROM transactions where user_id='$user_id') AND user_id = '$user_id'";
            $req = $db->query($sql);
            $req->setFetchMode(PDO::FETCH_ASSOC);

            foreach($req as $row)
            {
                echo $row['date'];
            }

            ?>

                                                                                   </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header" data-background-color="red">
                                                <i class="material-icons">assignment_late</i>
                                            </div>
                                            <div class="card-content">
                                                <p class="category">Factures</p>
                                            <h3 class="card-title">

                        <?php
                        $req = $db->query("SELECT  COUNT(*) as id FROM transactions WHERE user_id = '$user_id'");

                        $donnees = $req->fetch();
                        $req->closeCursor();
                        echo $donnees['id'];?>


                                                                                    </h3>
                                            </div>
                                            <div class="card-footer">
                                                <div class="stats">
                                                    <i class="material-icons">date_range</i> Dernière facture :




            <?php
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT DISTINCT transaction_id FROM transactions WHERE date= (SELECT MAX(date) FROM transactions where user_id='$user_id') AND user_id = '$user_id'";
            $req = $db->query($sql);
            $req->setFetchMode(PDO::FETCH_ASSOC);

            foreach($req as $row)
            {
                echo $row['transaction_id'];

            }

            ?>


                                                                                 </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>






                            <?php
                                $user_id = $_SESSION['user_id'];
                                $select = $db->query("SELECT * FROM products_transactions WHERE user_id = '$user_id'");

                                while($s = $select->fetch(PDO::FETCH_OBJ)){

                                    ?>
                                    <div class="media-footer">
                                 <a href="my_seedbox.php" class="btn btn-primary btn-wd pull-right">Commande
                                    <?php echo $s->product; ?>
                                    <?php echo $s->status; ?>


                                      </a>
                                    </div>



                                    <?php
                                }

                            ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header card-header-icon" data-background-color="blue">
                                                <i class="material-icons">new_releases</i>
                                            </div>
                                            <div class="card-content">
                                                <h4 class="card-title">Actualités</h4>
                                                                                        <div class="row">
                                                        <blockquote>
                                                            <p>


                                       <?php
                                        $user_id = $_SESSION['user_id'];
                                        $select = $db->query("SELECT DISTINCT * FROM actus WHERE date= (SELECT MAX(date) FROM actus)");

                                        while($s = $select->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                            <?php echo $s->description; ?>
                                             <?php
                                        }

                                        ?>
                                          </p>
                                           <small>
                                           Publié par <?php
                                           $select = $db->query("SELECT * FROM actus WHERE date= (SELECT MAX(date) FROM actus)");

                                           while($s = $select->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                        <?php echo $s->auteur; ?>

                                          -    <?php echo $s->date; ?>    </small>
                                          </blockquote>
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





            <!-- FIN DU CADRE -->







<?php
require_once('includes/footdashboard.php');

   ?>
</body>
<?php


    require_once('includes/javascriptdashboard.php');
?>

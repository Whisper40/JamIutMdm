<?php

require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Les activitées en cours";
require_once('includes/head.php');

?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>


<body>
    <div class="wrapper">

      <?php
          require_once('includes/navbar.php');
      ?>
      <div class="content">
          <div class="container-fluid">
            <h3>Manage Listings</h3>
                    <br>
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
                                    <a href="#pablo">
                                        <img class="img" src="assets/img/bg1.jpg">
                                    </a>
                                </div>
                                <div class="card-content">
                                    <h3 class="card-title">
                                        <a href="#pablo"><?php echo $row['title']; ?></a>
                                    </h3>
                                    <div class="card-description">
                                      <h5><p><?php echo $row['datesejour']; ?></p>
                                      <p>Prix : <b><?php echo $row['price']; ?>€</b></p></h5>
                                        <?php $price = $row['price']; ?>
                                    </div>
                                    <center>
                                    <button class="btn btn-primary btn-round btn-sm">Je participe</button>
                                    <button class="btn btn-primary btn-round btn-sm">Voir l'activitée</button>
                                    </center>
                                </div>
                            </div>
                        </div>

                      <?php  } ?>


                    </div>
                </div>
            </div>
        </div>
</body>

<?php

    require_once('includes/javascriptdashboard.php');
?>

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
                                <div class="card-image" data-header-animation="true">
                                    <a href="#pablo">
                                        <img class="img" src="assets/img/bg1.jpg">
                                    </a>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">
                                        <a href="#pablo"><?php echo $row['title']; ?></a>
                                    </h4>
                                    <div class="card-description">
                                      <?php echo $row['datesejour']; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="pull-left">
                                        <h4><?php echo $row['price']; ?>€
                                     <?php $price = $row['price']; ?></h4>
                                    </div>
                                    <div class="pull-right">
                                      <button class="btn btn-primary btn-round btn-xs">round</button>
                                    </div>
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

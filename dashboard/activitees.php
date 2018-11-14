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
                                    <div class="card-actions">
                                        <button type="button" class="btn btn-danger btn-simple fix-broken-card">
                                            <i class="material-icons">build</i> Fix Header!
                                        </button>
                                        <button type="button" class="btn btn-default btn-simple" rel="tooltip" data-placement="bottom" title="View">
                                            <i class="material-icons">art_track</i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-simple" rel="tooltip" data-placement="bottom" title="Edit">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-simple" rel="tooltip" data-placement="bottom" title="Remove">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </div>
                                    <h4 class="card-title">
                                        <a href="#pablo"><?php echo $row['title']; ?></a>
                                    </h4>
                                    <div class="card-description">
                                      <?php echo $row['datesejour']; ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                        <h4><?php echo $row['price']; ?>€                                                       </td>
                                     <?php $price = $row['price']; ?></h4>
                                        <a href="activiteesencours.php?activityname=<?php echo $row['slug'];?>"<i class="material-icons" title="Commander l'activité">add_shopping_cart</i></a>
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

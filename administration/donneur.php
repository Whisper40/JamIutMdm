<?php
//TEST KEVIN
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Dons";
$nomsouscat = "";
require_once('includes/head.php');

$user_id = $_SESSION['admin_id'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<body>
  <div class="wrapper">

<?php

    require_once('includes/navbar.php');

?>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title text-center">Récapitulatif des Dons</h2>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Liste de l'ensemble des dons à l'associations</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Valeur du Don</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Date</th>
                      </thead>
                      <tbody>

        <?php
        $selectlogs = $db->prepare("SELECT * FROM donation ORDER BY id DESC");
        $selectlogs->execute();
        while($s2=$selectlogs->fetch(PDO::FETCH_OBJ)){

          $nom=$s2->nomprenom;
          $adresse=$s2->adresse;
          $email=$s2->email;
          $price=$s2->price;
          $message=$s2->message;
          $date=$s2->date;
          echo '
                      <tr>
                        <td>'.$nom.'</td>
                        <td>'.$adresse.'</td>
                        <td class="text-center">'.$email.'</td>
                        <td class="text-center">'.$price.'</td>
                        <td class="text-center">'.$message.'</td>
                        <td class="text-center">'.$date.'</td>
                      </tr>';
        }

    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

<?php
require_once('includes/javascript.php');
?>

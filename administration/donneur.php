<?php
//TEST KEVIN
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');

$nompage = "Dons";
require_once('includes/head.php');

$user_id = $_SESSION['admin_id'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php

      echo '
    <div class="table-responsive">
      <table class="table">
        <thead class="text-primary">
          <th class="text-center">Nom</th>
          <th class="text-center">Adresse</th>
          <th class="text-center">Email</th>
          <th class="text-center">Prix</th>
          <th class="text-center">Message</th>
          <th class="text-center">Date</th>
        </thead>
        <tbody>
          ';

        $selectlogs = $db->prepare("SELECT * FROM donation ORDER BY id DESC");
        $selectlogs->execute();
        while($s2=$selectlogs->fetch(PDO::FETCH_OBJ)){

          $nom=$s3->nomprenom;
          $adresse=$s2->adresse;
          $email=$s2->email;
          $price=$s2->price;
          $message=$s2->message;
          echo '
          <tr>
          <td class="text-center">'.$nom.'</td>
          <td class="text-center">'.$adresse.'</td>
          <td class="text-center">'.$email.'</td>
          <td class="text-center">'.$price.'</td>
          <td class="text-center">'.$message.'</td>
          </tr>';
        }

    echo '
  </tbody>
  </table>
  </div>
    ';

require_once('includes/javascript.php');
?>

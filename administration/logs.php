<?php
//TEST KEVIN
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
require_once('includes/checksupreme.php');
$nompage = "Logs";
require_once('includes/head.php');
ini_set('display_errors', 1);
$user_id = $_SESSION['admin_id'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php

      echo '
    <div class="table-responsive">
      <table class="table">
        <thead class="text-primary">
          <th class="text-center">Identifiant</th>
          <th class="text-center">Nom</th>
          <th class="text-center">Type</th>
          <th class="text-center">Action</th>
          <th class="text-center">Page</th>
          <th class="text-center">Date</th>
        </thead>
        <tbody>
          ';

        $selectlogs = $db->prepare("SELECT * FROM logs ORDER BY id DESC");
        $selectlogs->execute();
        while($s2=$selectlogs->fetch(PDO::FETCH_OBJ)){
          $id=$s2->id;
          $user_id=$s2->user_id;

          $selectusername = $db->prepare("SELECT username FROM admin WHERE id=:user_id");
          $selectusername->execute(array(
            "user_id"=>$user_id
          ));
          $s3=$selectusername->fetch(PDO::FETCH_OBJ);

          $nom=$s3->username;
          $type=$s2->type;
          $action=$s2->action;
          $page=$s2->page;
          $date=$s2->date;
          echo '
          <tr>
          <td class="text-center">'.$id.'</td>
          <td class="text-center">'.$nom.'</td>
          <td class="text-center">'.$type.'</td>
          <td class="text-center">'.$action.'</td>
          <td class="text-center">'.$page.'</td>
          <td class="text-center">'.$date.'</td>
          </tr>';
        }

    echo '
  </tbody>
  </table>
  </div>
    ';

require_once('includes/javascript.php');
?>

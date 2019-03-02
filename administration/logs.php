<?php
//TEST KEVIN
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
require_once('includes/checksupreme.php');
$nompage = "Logs";
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
            <h2 class="card-title text-center">Logs du site</h2>
            <br>
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

        <?php
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

          ?>
                </tbody>
              </table>
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

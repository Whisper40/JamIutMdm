
<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Modification Contenu Site";
require_once('includes/head.php');
ini_set('display_errors', 1);
$user_id = $_SESSION['admin_id'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>


<?php

  $selectid = $db->prepare("SELECT * FROM activitesvoyages");
  $selectid->execute();
  $countid = $selectid->rowCount();

  ?>
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-content">
          <h2 class="card-title text-center">Demande d'Adhésion</h2>
          <br>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Liste des personnes ayant transmis des documents</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">

          <?php
            if($countid>'0'){
              while($uneselectid = $selectid->fetch(PDO::FETCH_OBJ)){

                $user_id = $uneselectid->user_id;
                $selectnom = $db->prepare("SELECT username, email, status FROM users WHERE id=:user_id ORDER BY id ASC");
                $selectnom->execute(array(
                    "user_id"=>$user_id
                    )
                );
                $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
                if(count($table)>0){
                  echo '

                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th class="text-center">Pseudo</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Statuts</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                      ';

                      foreach($table as $ligne){
                        $username = $ligne->username;
                        $email = $ligne->email;
                        $status = $ligne->status;
                        echo '

                      <tr>
                        <td class="text-center">'.$username.'</td>
                        <td class="text-center">'.$email.'</td>
                        <td class="text-center">'.$status.'</td>
                        <td class="text-center"><a href="?action=gestionfichier&amp;id='.$user_id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Afficher</button></a></td>
                      </tr>';
                    }

                    echo '
                  </tbody>
                  </table>
                  </div>
                    ';
                  }   }   }
                    ?>

              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once('includes/javascript.php');
?>

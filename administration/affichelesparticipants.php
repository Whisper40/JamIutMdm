
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
          <h2 class="card-title text-center">Toutes les activités/voyages</h2>
          <br>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Toutes les activités/voyages</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">

          <?php
            if($countid>'0'){

                $table = $selectid->fetchAll(PDO::FETCH_OBJ);
                if(count($table)>0){
                  echo '

                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th class="text-center">Titre</th>
                      <th class="text-center">Date du Séjour</th>
                      <th class="text-center">Prix</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Voir</th>
                    </thead>
                    <tbody>
                      ';

                      foreach($table as $ligne){
                        $id = $ligne->id;
                        $title = $ligne->title;
                        $price = $ligne->price;
                        $status = $ligne->status;
                        $datesejour = $ligne->datesejour;
                        echo '

                      <tr>
                        <td class="text-center">'.$title.'</td>
                        <td class="text-center">'.$datesejour.'</td>
                        <td class="text-center">'.$price.'</td>
                        <td class="text-center">'.$status.'</td>
                        <td class="text-center"><a href="?action=afficheactivite&amp;id='.$id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Afficher</button></a></td>
                      </tr>';
                    }

                    echo '
                  </tbody>
                  </table>
                  </div>
                    ';
                  }      }
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

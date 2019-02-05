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
if(isset($_GET['action'])){
  if($_GET['action'] == 'afficheactivite'){
    $id = $_GET['id'];
    $slug = $_GET['slug'];
    function strpos_arr($haystack, $needle) {
        if(!is_array($needle)) $needle = array($needle);
        foreach($needle as $what) {
            if(($pos = strpos($haystack, $what))!==false) return $pos;
        }
        return false;
    }
    //SPECIAL
    $arraycinema = array("cinema", "cinéma", "cinèma");
    //FIN
    $selecttitle = $db->prepare("SELECT title FROM activitesvoyages WHERE slug=:slug");
    $selecttitle->execute(array(
      "slug"=>$slug
    ));
    $srien = $selecttitle->fetch(PDO::FETCH_OBJ);
    $title = $srien->title;
    if (stripos($title, 'ski') != FALSE){
      echo '
    <div class="table-responsive">
      <table class="table">
        <thead class="text-primary">
          <th class="text-center">Nom</th>
          <th class="text-center">Prénom</th>
          <th class="text-center">Poids</th>
          <th class="text-center">Taille</th>
          <th class="text-center">Pointure</th>
          <th class="text-center">Allergies</th>
          <th class="text-center">Adresse</th>
          <th class="text-center">Code Postal</th>
          <th class="text-center">Ville</th>
          <th class="text-center">Numéro</th>
          <th class="text-center">Urgence</th>
          <th class="text-center">Option Matériel</th>
          <th class="text-center">Option Repas</th>
        </thead>
        <tbody>
          ';
    $selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
    $selectid->execute(array(
      "name"=>$title
    ));
    while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
      $iddelapersonne=$s0->user_id;
      $selectnom = $db->prepare("SELECT username, prenom FROM users WHERE id=:id");
      $selectnom->execute(array(
        "id"=>$iddelapersonne
      ));
      $snom=$selectnom->fetch(PDO::FETCH_OBJ);
      $nom=$snom->username;
      $prenom=$snom->prenom;
      $selectinfos = $db->prepare("SELECT * FROM participe WHERE user_id=:id and activity_name=:name");
      $selectinfos->execute(array(
        "id"=>$iddelapersonne,
        "name"=>$slug
      ));
      while($s1=$selectinfos->fetch(PDO::FETCH_OBJ)){
        $optionmateriel=$s1->optionmateriel;
        $optionrepas=$s1->optionrepas;
        $selectinfospersonnelles = $db->prepare("SELECT * FROM formulaireski WHERE user_id=:id");
        $selectinfospersonnelles->execute(array(
          "id"=>$iddelapersonne
        ));
        while($s2=$selectinfospersonnelles->fetch(PDO::FETCH_OBJ)){
          $poids=$s2->poids;
          $taille=$s2->taille;
          $pointure=$s2->pointure;
          $allergie=$s2->allergie;
          $adresse=$s2->adresse;
          $codepostal=$s2->codepostal;
          $ville=$s2->ville;
          $tel=$s2->tel;
          $telurgence=$s2->telurgence;
          echo '
          <tr>
          <td class="text-center">'.$nom.'</td>
          <td class="text-center">'.$prenom.'</td>
          <td class="text-center">'.$poids.'</td>
          <td class="text-center">'.$taille.'</td>
          <td class="text-center">'.$pointure.'</td>
          <td class="text-center">'.$allergie.'</td>
          <td class="text-center">'.$adresse.'</td>
          <td class="text-center">'.$codepostal.'</td>
          <td class="text-center">'.$ville.'</td>
          <td class="text-center">'.$tel.'</td>
          <td class="text-center">'.$telurgence.'</td>
          <td class="text-center">'.$optionmateriel.'</td>
          <td class="text-center">'.$optionrepas.'</td>
          </tr>';
        }
      }
    }
    echo '
  </tbody>
  </table>
  </div>
    ';
echo '
    <a href="https://administration.jam-mdm.fr/affichelesparticipantsexport.php?id='.$id.'&amp;slug='.$slug.'&amp;title='.$title.'"> Télécharger le fichier Excel </a>
    ';
  }else if (stripos($title, 'rugby') != FALSE){
    echo '
    <div class="table-responsive">
    <table class="table">
      <thead class="text-primary">
        <th class="text-center">Nom</th>
        <th class="text-center">Prénom</th>
        <th class="text-center">Adresse</th>
        <th class="text-center">Code Postal</th>
        <th class="text-center">Ville</th>
        <th class="text-center">Numéro</th>
        <th class="text-center">Urgence</th>
        <th class="text-center">Option Accompagnement</th>
      </thead>
      <tbody>
        ';
    $selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
    $selectid->execute(array(
    "name"=>$title
    ));
    while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
    $iddelapersonne=$s0->user_id;
    $selectnom = $db->prepare("SELECT username, prenom FROM users WHERE id=:id");
    $selectnom->execute(array(
      "id"=>$iddelapersonne
    ));
    $snom=$selectnom->fetch(PDO::FETCH_OBJ);
    $nom=$snom->username;
    $prenom=$snom->prenom;
    $selectinfos = $db->prepare("SELECT * FROM participe WHERE user_id=:id and activity_name=:name");
    $selectinfos->execute(array(
      "id"=>$iddelapersonne,
      "name"=>$slug
    ));
    while($s1=$selectinfos->fetch(PDO::FETCH_OBJ)){
      $optionaccompagnement=$s1->optionaccompagnement;
      $selectinfospersonnelles = $db->prepare("SELECT * FROM formulairerugby WHERE user_id=:id");
      $selectinfospersonnelles->execute(array(
        "id"=>$iddelapersonne
      ));
      while($s2=$selectinfospersonnelles->fetch(PDO::FETCH_OBJ)){
        $adresse=$s2->adresse;
        $codepostal=$s2->codepostal;
        $ville=$s2->ville;
        $tel=$s2->tel;
        $telurgence=$s2->telurgence;
        echo '
        <tr>
        <td class="text-center">'.$nom.'</td>
        <td class="text-center">'.$prenom.'</td>
        <td class="text-center">'.$adresse.'</td>
        <td class="text-center">'.$codepostal.'</td>
        <td class="text-center">'.$ville.'</td>
        <td class="text-center">'.$tel.'</td>
        <td class="text-center">'.$telurgence.'</td>
        <td class="text-center">'.$optionaccompagnement.'</td>
        </tr>';
      }
    }
    }
    echo '
    </tbody>
    </table>
    </div>
    ';
    echo '
    <a href="https://administration.jam-mdm.fr/affichelesparticipantsexport.php?id='.$id.'&amp;slug='.$slug.'&amp;title='.$title.'"> Télécharger le fichier Excel </a>
    ';
  }else if (stripos($title, 'cinema') != FALSE){
        echo '
        <div class="table-responsive">
        <table class="table">
          <thead class="text-primary">
            <th class="text-center">Nom</th>
            <th class="text-center">Prénom</th>
          </thead>
          <tbody>
            ';
        $selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
        $selectid->execute(array(
        "name"=>$title
        ));
        while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
        $iddelapersonne=$s0->user_id;
        $selectnom = $db->prepare("SELECT username, prenom FROM users WHERE id=:id");
        $selectnom->execute(array(
          "id"=>$iddelapersonne
        ));
        $snom=$selectnom->fetch(PDO::FETCH_OBJ);
        $nom=$snom->username;
        $prenom=$snom->prenom;
            echo '
            <tr>
            <td class="text-center">'.$nom.'</td>
            <td class="text-center">'.$prenom.'</td>
            </tr>';
        }
        echo '
        </tbody>
        </table>
        </div>
        ';
        echo '
        <a href="https://administration.jam-mdm.fr/affichelesparticipantsexport.php?id='.$id.'&amp;slug='.$slug.'&amp;title='.$title.'"> Télécharger le fichier Excel </a>
        ';
  }else if (stripos($title, 'sportive') != FALSE){









    echo '
            <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                <th class="text-center">Nom</th>
                <th class="text-center">Prénom</th>
                <th class="text-center">Adresse</th>
                <th class="text-center">Code Postal</th>
                <th class="text-center">Ville</th>
                <th class="text-center">Télephone</th>
                <th class="text-center">Urgence</th>
              </thead>
              <tbody>
                ';
                $selectid = $db->prepare("SELECT user_id FROM catparticipe WHERE name=:name");
                $selectid->execute(array(
                "name"=>$title
                ));
                while($s0=$selectid->fetch(PDO::FETCH_OBJ)){
                $iddelapersonne=$s0->user_id;
                $selectnom = $db->prepare("SELECT username, prenom FROM users WHERE id=:id");
                $selectnom->execute(array(
                  "id"=>$iddelapersonne
                ));
                $snom=$selectnom->fetch(PDO::FETCH_OBJ);
                $nom=$snom->username;
                $prenom=$snom->prenom;
                  $selectinfospersonnelles = $db->prepare("SELECT * FROM formulairesportive WHERE user_id=:id");
                  $selectinfospersonnelles->execute(array(
                    "id"=>$iddelapersonne
                  ));
                  while($s2=$selectinfospersonnelles->fetch(PDO::FETCH_OBJ)){
                    $adresse=$s2->adresse;
                    $codepostal=$s2->codepostal;
                    $ville=$s2->ville;
                    $tel=$s2->tel;
                    $telurgence=$s2->telurgence;
                    echo '
                    <tr>
                    <td class="text-center">'.$nom.'</td>
                    <td class="text-center">'.$prenom.'</td>
                    <td class="text-center">'.$adresse.'</td>
                    <td class="text-center">'.$codepostal.'</td>
                    <td class="text-center">'.$ville.'</td>
                    <td class="text-center">'.$tel.'</td>
                    <td class="text-center">'.$telurgence.'</td>
                    </tr>';
            }
          }
            echo '
            </tbody>
            </table>
            </div>
            ';
            echo '
            <a href="https://administration.jam-mdm.fr/affichelesparticipantsexport.php?id='.$id.'&amp;slug='.$slug.'&amp;title='.$title.'"> Télécharger le fichier Excel </a>
            ';














  }else{
    echo 'AUCUNE CAT';
  }
}
}else{
 ?>



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
                        $slug = $ligne->slug;
                        $price = $ligne->price;
                        $status = $ligne->status;
                        $datesejour = $ligne->datesejour;
                        echo '
                      <tr>
                        <td class="text-center">'.$title.'</td>
                        <td class="text-center">'.$datesejour.'</td>
                        <td class="text-center">'.$price.'</td>
                        <td class="text-center">'.$status.'</td>
                        <td class="text-center"><a href="?action=afficheactivite&amp;id='.$id.'&amp;slug='.$slug.'&amp;title='.$title.'"><button type="button" class="btn btn-rose btn-round btn-sm">Afficher</button></a></td>
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
}
require_once('includes/javascript.php');
?>

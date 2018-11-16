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
<br/><br/><br/>
<?php

if(isset($_GET['activityname'])){
  $activity_slug=$_GET['activityname'];
  $select = $db->prepare("SELECT * FROM activitesvoyages WHERE slug='$activity_slug' AND status='ACTIVE'");
  $select->execute();

  while($s=$select->fetch(PDO::FETCH_OBJ)){

    $lenght=100;
    $description = $s->description;
    $new_description=substr($description,0,$lenght)."...";
    $description_finale=wordwrap($new_description,50,'<br />', false);
    ?>


    <br/>

    <h5><?php echo $description_finale; ?></h5>
    <h4><?php echo $s->price; ?> €</h4>
    <?php
$prixactivite = $s->price;
$stock = $s->stock;
     ?>
        <br/><br/>
    <?php
  }
    if (stripos($activity_slug, 'ski') != FALSE){
    // Si l'activité est du ski alors on affiche ce type de formulaire
?>
    <form name="repas" method="POST">
      <h3> Le matériel : </h3>
  <?php
    $select0 = $db->prepare("SELECT * FROM activityradio WHERE slug='$activity_slug' and type='materiel'");
    $select0->execute();

    while($s0=$select0->fetch(PDO::FETCH_OBJ)){
      $type = $s0->type;
      $price = $s0->price;
      $packname = $s0->packname;
      ?>
      <div class="radio">
        <label>
          <input type="radio" name="optionmateriel" value="<?php echo $packname; ?>"> <?php echo $packname; ?> (<?php echo $price; ?>€)
        </label>
      </div>
      <?php
    }

?>
<h3> Le repas </h3>
  <?php
    $select1 = $db->prepare("SELECT * FROM activityradio WHERE slug='$activity_slug' and type='repas'");
    $select1->execute();

    while($s1=$select1->fetch(PDO::FETCH_OBJ)){
      $type1 = $s1->type;
      $price1 = $s1->price;
      $packname1 = $s1->packname;
      ?>
      <div class="radio">
        <label>
          <input type="radio" name="option<?php echo $type1;?>" value="<?php echo $packname1; ?>"> <?php echo $packname1; ?> (<?php echo $price1; ?>€)
        </label>
      </div>
      <?php
    }
    ?>
        <button type="submit" class="btn btn-info"> Valider mes choix</button>
      </form>
<?php
$optionmaterielform = $_POST['optionmateriel'];
$optionrepasform = $_POST['optionrepas'];
$selectpricemateriel = $db->query("SELECT price FROM activityradio WHERE packname='$optionmaterielform'");
$r = $selectpricemateriel->fetch(PDO::FETCH_OBJ);
$prixmateriel = $r->price;

$selectpricerepas= $db->query("SELECT price FROM activityradio WHERE packname='$optionrepasform'");
$r2 = $selectpricerepas->fetch(PDO::FETCH_OBJ);
$prixrepas = $r2->price;

if(isset($prixmateriel) && isset($prixrepas)){
$total = $prixactivite + $prixmateriel + $prixrepas;
?><h2> Total = <?php echo $total;?>€
  <?php
if($stock>0){
   ?>
  <div align="center" id="paypal-button"></div>
  <?php
}else{
  ?>
  <button type="button">Aucune place disponible</button>
<?php

}
}


//Si ce n'est pas du ski alors on passe à :
}else if (stripos($activity_slug, 'rugby') != FALSE){
?>
  <form name="accompagnement" method="POST">

<h3> Le match : </h3>
<?php
  $select4 = $db->prepare("SELECT * FROM activityradio WHERE slug='$activity_slug' and type='accompagnement'");
  $select4->execute();

  while($s4=$select4->fetch(PDO::FETCH_OBJ)){
    $type4 = $s4->type;
    $price4 = $s4->price;
    $packname4 = $s4->packname;
    ?>
    <div class="radio">
      <label>
        <input type="radio" name="option<?php echo $type4;?>" value="<?php echo $packname4; ?>"> <?php echo $packname4; ?> (<?php echo $price4; ?>€)
      </label>
    </div>
    <?php
  }
  ?>
      <button type="submit" class="btn btn-info"> Valider mes choix</button>
    </form>
<?php
$optionaccompagnementform = $_POST['optionaccompagnement'];
$selectpriceaccompagnement = $db->query("SELECT price FROM activityradio WHERE packname='$optionaccompagnementform'");
$r = $selectpriceaccompagnement->fetch(PDO::FETCH_OBJ);
$prixaccompagnement = $r->price;


if(isset($prixaccompagnement)){
$total = $prixactivite + $prixaccompagnement;
?><h2> Total = <?php echo $total;?>€
  <?php
if($stock>0){
   ?>
  <div align="center" id="paypal-button"></div>
  <?php
}else{
  ?>
  <button type="button">Aucune place disponible</button>
<?php

}
}

//Fin rugby
//Debut cinema
}else if (stripos($activity_slug, 'cinema') != FALSE){
?>

<?php

$total = $prixactivite;
?><h2> Total = <?php echo $total;?>€
  <?php
if($stock>0){
   ?>
  <div align="center" id="paypal-button"></div>
  <?php
}else{
  ?>
  <button type="button">Aucune place disponible</button>
<?php

}


//Fin Cinema
}else if (stripos($activity_slug, 'sportive') != FALSE){

$activity_name = $activity_slug;
$participe = $db->prepare("SELECT * FROM participe where user_id='$user_id' and activity_name='$activity_name'");
$participe->execute();
$countparticipe = $participe->rowCount();
if ($countparticipe == '1'){
 ?><form action="" method="post">
 <input type="submit" id="jeneparticipeplus" name="jeneparticipeplus" value="J'annule ma participation">
</form><?php
}else{
  ?>

<form name="organisation" method="POST">
<h2> Cette activité est gratuite </h2>
<?php
  $select4 = $db->prepare("SELECT * FROM activityradio WHERE slug='$activity_slug' and type='organisation'");
  $select4->execute();

  while($s4=$select4->fetch(PDO::FETCH_OBJ)){
    $type4 = $s4->type;
    $packname4 = $s4->packname;
    ?>
    <div class="radio">
      <label>
        <input type="radio" name="option<?php echo $type4;?>" value="<?php echo $packname4; ?>"> <?php echo $packname4; ?>
      </label>
    </div>
    <?php
  }
  ?>
      <button type="submit" class="btn btn-info"> Valider mes choix</button>
    </form>

<?php
}
 ?>
<?php
if(!empty($_POST['jeparticipe'])){
  $optionorganisation = $_POST['optionorganisation'];
  $activity_name = $activity_slug;
  $selectrealname = $db->query("SELECT title,stock from activitesvoyages WHERE slug='$activity_name'");
  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = $r->title;
  $stock = $r->stock;
  $newstock = $stock - '1';
  $pageformulaire = 'formulaire.php?type=sportive';
  $icon = 'dns';
  $date = strftime('%d/%m/%Y %H:%M:%S');
  $db->query("INSERT INTO participe (user_id, activity_name, date, optionorganisation) VALUES('$user_id' ,'$activity_name' ,'$date', '$optionorganisation')");
  $db->query("INSERT INTO catparticipe (user_id, name, page, icon) VALUES('$user_id', '$realname', '$pageformulaire', '$icon')");
  $db->query("INSERT INTO formulairesportive (user_id) VALUES('$user_id')");
  $db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");

  ?>
  <script>
      window.location = 'http://127.0.0.1/dashboard/formulaire.php?type=sportive';
  </script>
  <?php
}
if(!empty($_POST['jeneparticipeplus'])){
  $activity_name = $activity_slug;
  $selectrealname = $db->query("SELECT title,stock from activitesvoyages WHERE slug='$activity_name'");
  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = $r->title;
  $stock = $r->stock;
  $newstock = $stock + '1';
  $db->query("DELETE FROM participe WHERE user_id='$user_id' AND activity_name='$activity_name'");
  $db->query("DELETE FROM catparticipe WHERE user_id='$user_id' AND name='$realname'");
  $db->query("DELETE FROM formulairesportive WHERE user_id='$user_id'");
  $db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");

?>
<script>
    window.location = 'https://dashboard.jam-mdm.fr/activiteesencours.php';
</script>
<?php
}
?>
<?php
$optionorganisation = $_POST['optionorganisation'];

if(isset($optionorganisation)){

 ?>
 <form action="" method="post">

<?php
if ($countparticipe == '0'){
  $selectstock = $db->query("SELECT stock from activitesvoyages WHERE slug='$activity_name'");
  $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
  $stock = $rstock->stock;
  if($stock>0){
  ?>
    <input type="submit" id="jeparticipe" name="jeparticipe" value="Je Participe">
<?php
}else{
  ?>
  <button type="button">Aucune place disponible</button>
<?php
}
}
}
?>
<form>
  <?php
  //FIN SPORTIVE
  //DEBUT NETTOYAGE
}else if (stripos($activity_slug, 'nettoyage') != FALSE){

$activity_name = $activity_slug;
$participe = $db->prepare("SELECT * FROM participe where user_id='$user_id' and activity_name='$activity_name'");
$participe->execute();
$countparticipe = $participe->rowCount();
if ($countparticipe == '1'){
 ?><form action="" method="post">
 <input type="submit" id="jeneparticipeplusnettoyage" name="jeneparticipeplusnettoyage" value="J'annule ma participation">
</form><?php
}
 ?>
<?php
if(!empty($_POST['jeparticipenettoyage'])){

  $activity_name = $activity_slug;
  $selectrealname = $db->query("SELECT title,stock from activitesvoyages WHERE slug='$activity_name'");
  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = $r->title;
  $stock = $r->stock;
  $newstock = $stock - '1';
  $pageformulaire = 'formulaire.php?type=nettoyage';
  $icon = 'dns';


  $date = strftime('%d/%m/%Y %H:%M:%S');
  $db->query("INSERT INTO participe (user_id, activity_name, date) VALUES('$user_id' ,'$activity_name' ,'$date')");
  $db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");
  $db->query("INSERT INTO catparticipe (user_id, name, page, icon) VALUES('$user_id', '$realname', '$pageformulaire', '$icon')");


  ?>
  <script>
      window.location = 'https://dashboard.jam-mdm.fr/';
  </script>
  <?php
}
if(!empty($_POST['jeneparticipeplusnettoyage'])){
  $activity_name = $activity_slug;
  $selectrealname = $db->query("SELECT title,stock from activitesvoyages WHERE slug='$activity_name'");
  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = $r->title;
  $stock = $r->stock;
  $newstock = $stock + '1';
  $db->query("DELETE FROM participe WHERE user_id='$user_id' AND activity_name='$activity_name'");
  $db->query("DELETE FROM catparticipe WHERE user_id='$user_id' AND name='$realname'");
  $db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");

?>
<script>
    window.location = 'https://dashboard.jam-mdm.fr/activiteesencours.php';
</script>
<?php
}
?>

 <form action="" method="post">

<?php
if ($countparticipe == '0'){
  $selectstock = $db->query("SELECT stock from activitesvoyages WHERE slug='$activity_name'");
  $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
  $stock = $rstock->stock;
  if($stock>0){
  ?>
    <input type="submit" id="jeparticipenettoyage" name="jeparticipenettoyage" value="Je Participe">
<?php
}else{
  ?>
  <button type="button">Aucune place disponible</button>
<?php
}
}

?>
<form>
  <?php
//FIN NETTOYAGE
//DEBUT JOURNEE COURSE ORIENTATION
}else if (stripos($activity_slug, 'orientation') != FALSE){

$activity_name = $activity_slug;
$participe = $db->prepare("SELECT * FROM participe where user_id='$user_id' and activity_name='$activity_name'");
$participe->execute();
$countparticipe = $participe->rowCount();
if ($countparticipe == '1'){
 ?><form action="" method="post">
 <input type="submit" id="jeneparticipeplusorientation" name="jeneparticipeplusorientation" value="J'annule ma participation">
</form><?php
}

if(!empty($_POST['jeparticipeorientation'])){
  $activity_name = $activity_slug;
  $selectrealname = $db->query("SELECT title,stock from activitesvoyages WHERE slug='$activity_name'");
  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = addslashes($r->title); //Corrige le bug d'importation de guillemet dans la BDD
  $stock = $r->stock;
  $newstock = $stock - '1';
  $pageformulaire = 'formulaire.php?type=orientation';
  $icon = 'dns';
  $date = strftime('%d/%m/%Y %H:%M:%S');
  $db->query("INSERT INTO participe (user_id, activity_name, date) VALUES('$user_id' ,'$activity_name' ,'$date')");
echo '1';
  $db->query("INSERT INTO catparticipe (user_id, name, page, icon) VALUES('$user_id', '$realname', '$pageformulaire', '$icon')");
echo '2';
  $db->query("INSERT INTO formulaireorientation (user_id) VALUES('$user_id')");
  $db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");

  ?>
  <script>
      window.location = 'http://127.0.0.1/dashboard/formulaire.php?type=orientation';
  </script>
  <?php
}
if(!empty($_POST['jeneparticipeplusorientation'])){
  $activity_name = $activity_slug;
  $selectrealname = $db->query("SELECT title,stock from activitesvoyages WHERE slug='$activity_name'");
  $r = $selectrealname->fetch(PDO::FETCH_OBJ);
  $realname = addslashes($r->title);
  $stock = $r->stock;
  $newstock = $stock + '1';
  $db->query("DELETE FROM participe WHERE user_id='$user_id' AND activity_name='$activity_name'");
  $db->query("DELETE FROM catparticipe WHERE user_id='$user_id' AND name='$realname'");
  $db->query("DELETE FROM formulaireorientation WHERE user_id='$user_id'");
  $db->query("UPDATE activitesvoyages SET stock='$newstock' WHERE slug='$activity_name'");

?>
<script>
    window.location = 'https://dashboard.jam-mdm.fr/activiteesencours.php';
</script>
<?php
}
?>
<?php


 ?>
 <form action="" method="post">

<?php
if ($countparticipe == '0'){
  $activity_name = $activity_slug;
  $selectstock = $db->query("SELECT stock from activitesvoyages WHERE slug='$activity_name'");
  $rstock = $selectstock->fetch(PDO::FETCH_OBJ);
  $stock = $rstock->stock;
  if($stock>0){
  ?>
    <input type="submit" id="jeparticipeorientation" name="jeparticipeorientation" value="Je Participe">
<?php
}else{
  ?>
  <button type="button">Aucune place disponible</button>
<?php
}
}

?>
<form>
  <?php
  //FIN COURSE ORIENTATION

}
?>
<script>
    paypal.Button.render({
<?php

if (stripos($activity_slug, 'ski') !== FALSE){

          $total = $prixactivite + $prixmateriel + $prixrepas;
          $_SESSION['activity_name'] = $activity_slug;
          $_SESSION['optionmateriel'] = $optionmaterielform;
          $_SESSION['optionrepas'] = $optionrepasform;
}else if (stripos($activity_slug, 'rugby') !== FALSE){

  $total = $prixactivite + $prixaccompagnement;
  $_SESSION['activity_name'] = $activity_slug;
  $_SESSION['optionaccompagnement'] = $optionaccompagnementform;

}else if (stripos($activity_slug, 'cinema') !== FALSE){
    $_SESSION['activity_name'] = $activity_slug;
    $total = $prixactivite;
}


?>
        env: 'sandbox',

        client: {
            sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            production: 'AXaV8dsJkxtDm__NKyNdyXBxp9wa8TSS8YZvNOyk3OEpi9rO82H3lc2wKhQrEbJS7NxfnLJ9Igq-rsIC'
        },


        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'pill',      // pill | rect
            color:  'blue'       // gold | blue | silver | black
        },

        commit: true,

        payment: function(data, actions) {

            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: <?= $total ?>, currency: 'EUR' }
                        }
                    ]
                },
            });
        },

        onAuthorize: function(data, actions) {

            return actions.payment.get().then(function(data) {

                console.log(data);

                var shipping = data.payer.payer_info.shipping_address;

                var name = shipping.recipient_name;
                var street = shipping.line1;
                var country_code = shipping.country_code;
                var city = shipping.city;
                var date = '<?= date("d/m/Y") ?>';
                var transaction_id = data.id;
                var price = data.transactions[0].amount.total;
                var currency_code = 'EUR';

                $.post(
                    "process.php",
                    {
                        name : name,
                        street: street,
                        city: city,
                        country_code : country_code,
                        date: date,
                        transaction_id: transaction_id,
                        price: price,
                        currency_code: currency_code,
                    }
                );
                return actions.payment.execute().then(function() {
                    $(location).attr("href", '<?= "http://127.0.0.1"."/dashboard"; ?>');
                });
            });
        },

    }, '#paypal-button');
</script>

<br/><br/><br/><br/>

<?php

// Si la page n'a aucun paramètre alors on affiche celle-ci , ou alors on renvoie vers la page d'accueil..

}else{

?>



  <div class="tab-pane">
      <div class="card">
          <div class="card-header">
              <h4 class="card-title">Activités/Voyages</h4>
          </div>
          <div class="card-content table-responsive">
                                                          <table class="table table-hover">
                  <thead>
                      <tr>

                          <td>Nom</td>
                          <td>Date prévue</td>

                          <td>Places Restantes</td>
                          <td> Tarif </td>
                          <td> Commander </td>

                      </tr>
                  </thead>
                  <tbody>
                                                                          <tr>



  <?php
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM activitesvoyages WHERE status='ACTIVE' ORDER BY date ASC";
  $req = $db->query($sql);
  $req->setFetchMode(PDO::FETCH_ASSOC);

  foreach($req as $row)
  {


  ?>



  <td>
                              <?php echo $row['title']; ?>                                                      </td>

  <td>
                              <?php echo $row['datesejour']; ?>                                                      </td>


                             <td>
                                <?php echo $row['stock']; ?>                                                       </td>

                                <td>
                                   <?php echo $row['price']; ?>€                                                       </td>
                                <?php $price = $row['price']; ?>
                                <td>
                                   <a href="activiteesencours.php?activityname=<?php echo $row['slug'];?>"<i class="material-icons" title="Commander l'activité">add_shopping_cart</i></a></td>                                               </td>
                      </tr>
                      <?php
  }
  ?>
                      </tr>
                                                                      </tbody>
              </table>
          </div>
      </div>
  </div>
  <?php

}



    require_once('includes/javascriptdashboard.php');
?>
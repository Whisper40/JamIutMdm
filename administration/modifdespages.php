<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";




//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>







<body class="landing-page sidebar-collapse">
  <div class="wrapper">
<?php

if($_GET['action']=='unban'){

$id=$_GET['id'];
$setunban = $db->prepare("UPDATE images SET status='1' WHERE id=$id");
$setunban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}else if($_GET['action']=='ban'){

$id=$_GET['id'];
$setban = $db->prepare("UPDATE images SET status='0' WHERE id=$id");
$setban->execute();
?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}else if($_GET['action']=='delete'){

$id=$_GET['id'];
$selectnom = $db->query("SELECT * FROM images WHERE id='$id'");
$rname = $selectnom->fetch(PDO::FETCH_OBJ);
$valnom = $rname->file_name;
$dossier = $rname->title;

echo 'esquive';

?>
<script>window.location="https://administration.jam-mdm.fr/gestionimage.php"</script>
<?php
}

    require_once('includes/navbar.php');



?>

    <a href="?page=index&amp;table=pageindex">
      <button type="button" class="btn">Page Index</button>
    </a>

    <a href="?page=devenirmembre&amp;table=pagedevenirmembre">
      <button type="button" class="btn">Page Membre</button>
    </a>

    <a href="?page=association&amp;table=pageasso">
      <button type="button" class="btn">Page Association</button>
    </a>

    <a href="?page=membre&amp;table=membres">
      <button type="button" class="btn">Page Membre</button>
    </a>

    <a href="?page=status&amp;table=status">
      <button type="button" class="btn">Page Status</button>
    </a>

    <a href="?page=lienutiles&amp;table=lienutiles">
      <button type="button" class="btn">Page Liens</button>
    </a>



















  </div>

  <?php
  require_once('includes/footer.php');
  require_once('includes/javascript.php');
  ?>

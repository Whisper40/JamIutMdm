<?php
    require_once('includes/connectBDD.php');
    $nompage = "Actualité";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');

if(isset($_GET['gestionfichier'])){
  $user_id=$_GET['id'];


}else{

    $selectid = $db->prepare("SELECT distinct user_id FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' ORDER BY date");
    $selectid->execute();
    $countid = $selectid->rowCount();
    echo $countid;



}





require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

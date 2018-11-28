<?php
$user_id = $_SESSION['user_id'];
$selectstatus = $db->query("SELECT status FROM users WHERE id='$user_id'");
$s = $selectstatus->fetch(PDO::FETCH_OBJ);
$status = $s->status;
if($status != "MEMBRE"){
  header('Location: https://dashboard.jam-mdm.fr/devenirmembre.php');
}
 ?>

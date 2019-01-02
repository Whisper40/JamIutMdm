<?php
$user_id = $_SESSION['user_id'];
$selectstatus = $db->prepare("SELECT status FROM users WHERE id=:user_id");
$selectstatus->execute(array(
  "user_id"=>$user_id
));
$s = $selectstatus->fetch(PDO::FETCH_OBJ);
$status = $s->status;
if($status == "MEMBRE"){
  header('Location: https://dashboard.jam-mdm.fr/');
}

?>

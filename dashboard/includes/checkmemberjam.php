<?php
$user_id = $_SESSION['user_id'];
$selectstatus = $db->query("SELECT status FROM users WHERE id='$user_id'");
$s = $selectstatus->fetch(PDO::FETCH_OBJ);
$status = $s->status;
if($status != "MEMBRE"){
  $access = 0;
}else{
  $access = 1;
}




 ?>

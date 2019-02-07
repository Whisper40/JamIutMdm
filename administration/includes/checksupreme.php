<?php

$selectgradeadmin = $db->prepare("SELECT grade from admin where id=:id");
$selectgradeadmin->execute(array(
    "id"=>$_SESSION['admin_id']
    )
);
$r9 = $selectgradeadmin->fetch(PDO::FETCH_OBJ);

$grade = $r9->grade;

if($grade == 'NORMAL'){
  header('Location: https://administration.jam-mdm.fr/');
}
 ?>

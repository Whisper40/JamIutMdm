<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');


if($_POST['id']){
	$id=$_POST['id'];
	if($id==0){
		echo "<option>Select Sous Catégorie</option>";
		}else{

      $s5=$db->query("SELECT * FROM newsactus where id='$id'");
      $row = $s5->fetch(PDO::FETCH_OBJ);
      $title = $row->title;
      $title2 = $row->title2;
      $title3 = $row->title3;
				echo '<option value="'.$title.'">'.$title.'</option>';
        echo '<option value="'.$title2.'">'.$title2.'</option>';
        echo '<option value="'.$title3.'">'.$title3.'</option>';
				}
			}
		}

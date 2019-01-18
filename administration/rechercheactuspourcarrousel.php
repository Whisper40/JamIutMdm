<?php
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');


if($_POST['id']){
	$id=$_POST['id'];
	if($id==0){
		echo "<option>Séléctionner la sous catégorie</option>";
		}else{

      $s5=$db->query("SELECT * FROM newsactus where id='$id'");
      $row = $s5->fetch(PDO::FETCH_OBJ);
      $title = $row->title;
      $title2 = $row->title2;
      $title3 = $row->title3;
				echo '<option value="'.$title.'">'.$title.'</option>';
        if(!empty($title2)){
        echo '<option value="'.$title2.'">'.$title2.'</option>';
        }
        if(!empty($title3)){
        echo '<option value="'.$title3.'">'.$title3.'</option>';
      }
				}
			}

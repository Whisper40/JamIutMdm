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

?>
				<div class="jquerysel">
					<select class="selectpicker" data-style="select-with-transition" title="Sous Catégorie" data-size="7" name="souscatactualite">
					<?php	echo '<option value="'.$title.'">'.$title.'</option>';?>
					</select>
				</div>
				<?php
        if(!empty($title2)){


				?>
								<div class="jquerysel">
									<select class="selectpicker" data-style="select-with-transition" title="Sous Catégorie" data-size="7" name="souscatactualite">
									<?php	echo '<option value="'.$title.'">'.$title.'</option>';
									echo '<option value="'.$title2.'">'.$title2.'</option>';
									?>
									</select>
								</div>
								<?php
        }
        if(!empty($title3)){
        
				?>
								<div class="jquerysel">
									<select class="selectpicker" data-style="select-with-transition" title="Sous Catégorie" data-size="7" name="souscatactualite">
									<?php	echo '<option value="'.$title.'">'.$title.'</option>';
									echo '<option value="'.$title2.'">'.$title2.'</option>';
									echo '<option value="'.$title3.'">'.$title3.'</option>';
									?>
									</select>
								</div>
								<?php
      }
				}
			}

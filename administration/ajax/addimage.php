<?php
require_once('../includes/connectBDD.php');
//allowed file types
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

function slugify($text){
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
    return $text;
}
$nomcategorieimage = $_POST['catimage'];
if(isset($nomcategorieimage)){


$selecticon = $db->prepare("SELECT icon FROM images WHERE title=:catimage");
  $selecticon->execute(array(
      "catimage"=>$nomcategorieimage
      )
  );
  $ricon = $selecticon->fetch(PDO::FETCH_OBJ);
  $nomicon = $ricon->icon;

$user_id = $_SESSION['admin_id'];

if(isset($user_id)&&!empty($user_id)){
	$arr_file_types = ['image/png', 'image/jpg', 'image/jpeg'];


  $total = count($_FILES['file']['name']);
  for( $i=0 ; $i < $total ; $i++ ) {

	if (!(in_array($_FILES['file']['type'][$i], $arr_file_types))) {
	    echo "false";
	    return;
	}
	if ($_FILES['file']['size'][$i] < 5*MB){

	if (!file_exists('../../../../../var/JamFichiers/Photos/')) {
    echo "Problème de répertoire";
    die();
	}
	$imagenouvelle = rand(100, 10000) . $_FILES['file']['name'][$i];
	if(move_uploaded_file($_FILES['file']['tmp_name'][$i], '../../../../../var/JamFichiers/Photos/Original/'.$nomcategorieimage.'/'.$imagenouvelle)){

           date_default_timezone_set('Europe/Paris');
           setlocale(LC_TIME, 'fr_FR.utf8','fra');
           $date = strftime('%d:%m:%y %H:%M:%S');

           $status = '1';
           $insertinfos = $db->prepare("INSERT INTO images (title, albumactif, icon, file_name, uploaded_on, status) VALUES(:title, :albumactif, :icon, :file_name, :date, :status)");
           $insertinfos->execute(array(
               "title"=>$nomcategorieimage,
               "albumactif"=>'1',
               "icon"=>$nomicon,
               "file_name"=>$imagenouvelle,
               "date"=>$date,
               "status"=>$status
               )
           );

           $update=$db->prepare("UPDATE images SET albumactif=:albumactif WHERE title=:nomcategorieimage");
           $update->execute(array(
             "albumactif"=>"1",
             "nomcategorieimage"=>$nomcategorieimage
           ));

          $update2=$db->prepare("UPDATE images SET albumactif=:albumactif WHERE title <> :nomcategorieimage");
          $update2->execute(array(
              "albumactif"=>"0",
              "nomcategorieimage"=>$nomcategorieimage
            ));
  }

	echo "success";

}}
  require('../includes/miseajourdusite.php');


}else{
	die();
}
}
?>

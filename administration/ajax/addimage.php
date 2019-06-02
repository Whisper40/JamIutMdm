<?php
require_once('../includes/connectBDD.php');
//allowed file types
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
$test = $_POST['catimage'];

$user_id = $_SESSION['admin_id'];
if(isset($user_id)&&!empty($user_id)){
   echo '0';
	$arr_file_types = ['image/png', 'image/jpg', 'image/jpeg'];




	if (!file_exists('../../../../JamFichiers/Img/ImagesDuSite/Original/')) {
	    mkdir('Original', 0777);
	}

 echo '2';
	$imagenouvelle = rand(100, 10000) . $_FILES['file']['name'][0];
	move_uploaded_file($_FILES['file']['tmp_name'][0], '../../../../JamFichiers/Img/ImagesDuSite/Original/' . $imagenouvelle);


	echo "success";
	die();
}else{
	die();
}
?>

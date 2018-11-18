<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Téléchargement Fichier";
    require_once('includes/head.php');




?>

<?php
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php
$user_id = $_SESSION['user_id'];
$selectstatus = $db->query("SELECT status FROM users WHERE id='$user_id'");
$s = $selectstatus->fetch(PDO::FETCH_OBJ);
$status = $s->status;

?>
<h1> Le status actuel de votre compte est <?php echo $status ?></h1>
<h3> Voici l'état actuel de la validation des documents transmis </h3>
<div class="tab-pane">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Mes documents</h4>
        </div>
        <div class="card-content table-responsive">
                                                        <table class="table table-hover">
                <thead>
                    <tr>
                        <td>Numéro du Document</td>
                        <td>Nom</td>
                        <td>Date de création</td>
                        <td>Status</td>

                    </tr>
                </thead>
                <tbody>
                                                                        <tr>



<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM validationfichiers WHERE user_id='$user_id' ORDER BY date ASC";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
?><td>Document n°<?php
echo $row['id'];
?></td>



<td>
                            <?php echo $row['filename']; ?>                                                      </td>

<td>
                            <?php echo $row['date']; ?>                                                      </td>
                        <td>
                           <?php echo $row['status']; ?>                                                       </td>
                    </tr>
                    <?php
}
?>
                    </tr>
                                                                    </tbody>
            </table>
        </div>
    </div>
</div>





<!-- CODE HTML A FAIRE -->
                              <div class="col-md-12">
                                                  <div class="card">
                                                      <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                                          <div class="card-header card-header-text" data-background-color="rose">
                                                              <h4 class="card-title">Nous contacter</h4>
                                                          </div>
                                                          <div class="card-content">


                                          <div class="row">
                                              <label class="col-sm-2 label-on-left">Message : </label>
                                              <div class="col-sm-10">
                                                  <div class="form-group label-floating is-empty">
                                                      <textarea name="message" class="form-control" rows="6">
                                                  </textarea>
                                              <span class="help-block">Merci de décrire précisément votre message</span></div>
                                              </div>
                                          </div>

                                           <div class="row">
                                              <label class="col-sm-2 label-on-left"> </label>
                                              <div class="col-sm-10">
                                                  <div class="form-group label-floating is-empty">


                                                      <div class="form-group form-file-upload">
                <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                <div class="input-group">
                  <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                  <span class="input-group-btn input-group-s">
                    <button type="button" class="btn btn-just-icon btn-round btn-info">
                      <i class="material-icons">layers</i>
                    </button>
                  </span>
                </div>
              </div>
                                            </div>
                                              </div>
                                          </div>

                                          <center>
                                          <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
                                        </center>
                                      </div>
                                      <center>
                                        <input type="submit" name="submit" value="Envoyer un message" class="btn btn-primary btn-round" />

</center>


                                                      </form>
                                                  </div>

                                              </div>

<?php
if(isset($_POST['submit'])){
  if(isset($_POST['message'])){
    $message = $_POST['message'];
  }else{
    $message = "Aucun message";
  }
    $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
    if($responseData->success){
      $user_id = $_SESSION['user_id'];
      $target_dir = "../../../JamFichiers/Uploads";

      if (file_exists($target_dir/$user_id)) {
        $target_dirnew = "$target_dir/$user_id/";
      }else{
        mkdir("$target_dir/$user_id", 0700);
        $target_dirnew = "$target_dir/$user_id/";
      }

$total = count($_FILES['fileToUpload']['name']);
for( $i=0 ; $i < $total ; $i++ ) {
$target_file = $target_dirnew . basename($_FILES["fileToUpload"]["name"][$i]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size < 2mo
if ($_FILES["fileToUpload"]["size"][$i] > 2000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "rar") {
    echo "Sorry, only JPG, JPEG, PNG & GIF, ZIP and RAR files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
  $date = strftime('%d:%m:%y %H:%M:%S');

  $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
  $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file2)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"][$i]). " has been uploaded.";
        $status = "EN ATTENTE DE VALIDATION";
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d/%m/%y %H:%M:%S');
        $insertinfos = $db->prepare("INSERT INTO validationfichiers (user_id, filename, message, ip, date, status) VALUES(:user_id, :filename, :message, :ip, :date, :status)");
        $insertinfos->execute(array(

            "user_id"=>$_SESSION['user_id'],
            "filename"=>$target_filefile,
            "message"=>$message,
            "ip"=>$ip,
            "date"=>$date,
            "status"=>$status
            )
        );



    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



}}else{
      ?>
      <div class="content">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-md-6 col-md-offset-3">



      <div class="alert alert-danger">
              <div class="container">
          <div class="alert-icon">
            <i class="material-icons">info_outline</i>
          </div>


                <b>Erreur Captcha:</b> BipBoup BoupBip ! Robot détecté !
              </div>
          </div>
        </div></div></div></div>
      <?php
    }

}

   ?>


  </body>
  <?php
      require_once('includes/javascriptdashboard.php');
  ?>

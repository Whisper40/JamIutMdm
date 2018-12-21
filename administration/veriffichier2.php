<?php
    require_once('includes/connectBDD.php');
    $nompage = "Actualité";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');
    ini_set('display_errors', 1);
    $secret = "LESECRET";
    $sitekey = "LESITEKEY";
    ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
    <?php
    if(isset($_GET['action'])){
    if($_GET['action']=='validefichier'){
      echo"bond";

    $id=$_GET['id'];
    $setvalide = $db->prepare("UPDATE validationfichiers SET status='VALIDE' WHERE id=$id");
    $setvalide->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/veriffichier2.php"</script>
    <?php
    }else if($_GET['action']=='refusfichier'){
    $id=$_GET['id'];
    $setrefus = $db->prepare("UPDATE validationfichiers SET status='REFUS' WHERE id=$id");
    $setrefus->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/veriffichier2.php"</script>
    <?php
    }


if($_GET['action']=='gestionfichier'){
  $user_id=$_GET['id'];
  $selectfichieratraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
  $selectfichieratraiter->execute();
  $countid = $selectfichieratraiter->rowCount();
  if($countid>'0'){
  ?>
<h2> Les fichiers en attente de validation : </h2>
<table class="table">
<thead>
<tr>
<th scope="col">Utilisateur</th>
<th scope="col">Nom du fichier</th>
<th scope="col">Message</th>
<th scope="col">Date d'ajout</th>
<th scope="col">Action</th>
</tr>
</thead>
<tbody>
<?php




 ?>
  <?php
  while($fichier = $selectfichieratraiter->fetch(PDO::FETCH_OBJ)){

    $idfichier = $fichier->id;
    $idutilisateur = $fichier->user_id;

    $selectnom = $db->prepare("SELECT username FROM users WHERE id='$idutilisateur' ORDER BY id ASC");
    $selectnom->execute();

    $s = $selectnom->fetch(PDO::FETCH_OBJ);
    $nom = $s->username;

    $filename = $fichier->filename;
    $filenamesystem = $fichier->filenamesystem;
    $message = $fichier->message;
    $datefile = $fichier->date;
  ?>

  <tr>
    <th scope="row"><?php echo $nom;?></th>
    <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
    <td><?php echo $message;?></td>
    <td><?php echo $datefile;?></td>
    <td>
<a href="?action=validefichier&amp;id=<?php echo $idfichier;?>">
<button type="button" class="btn">Valider</button>
</a>
<a href="?action=refusfichier&amp;id=<?php echo $idfichier;?>">
<button type="button" class="btn">Refuser</button>
</a>


    </td>
  </tr>

<?php
}

?>
</tbody>
</table>
<?php
}




$selectfichierdejatraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status <> 'EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
$selectfichierdejatraiter->execute();
$countid2 = $selectfichierdejatraiter->rowCount();
if($countid2>'0'){
?>
<h2> Les fichiers déja traités : </h2>
<table class="table">
<thead>
<tr>
<th scope="col">Utilisateur</th>
<th scope="col">Nom du fichier</th>
<th scope="col">Message</th>
<th scope="col">Date d'ajout</th>
<th scope="col">Status</th>

</tr>
</thead>
<tbody>
<?php




?>
<?php
while($fichier2 = $selectfichierdejatraiter->fetch(PDO::FETCH_OBJ)){

  $idfichier = $fichier2->id;
  $idutilisateur = $fichier2->user_id;

  $selectnom = $db->prepare("SELECT username, email FROM users WHERE id='$idutilisateur' ORDER BY id ASC");
  $selectnom->execute();

  $s = $selectnom->fetch(PDO::FETCH_OBJ);
  $nom = $s->username;
  $owner_mail = $s->email;


  $filename = $fichier2->filename;
  $filenamesystem = $fichier2->filenamesystem;
  $message = $fichier2->message;
  $datefile = $fichier2->date;
  $status = $fichier2->status;
?>

<tr>
  <th scope="row"><?php echo $nom;?></th>
  <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
  <td><?php echo $message;?></td>
  <td><?php echo $datefile;?></td>
  <td><?php echo $status;?></td>
</tr>

<?php
}

?>
</tbody>
</table>
<?php
}
?>
<div class="col-md-12">
                                                 <div class="card">
                                                     <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">

                                                         <div class="card-header card-header-text" data-background-color="rose">
                                                             <h4 class="card-title">Contacter la personne</h4>
                                                         </div>
                                                         <div class="card-content">




                                         <div class="row">
                                             <label class="col-sm-2 label-on-left">Message : </label>
                                             <div class="col-sm-10">
                                                 <div class="form-group label-floating is-empty">


                                                     <textarea name="message" class="form-control" rows="6">

                                                 </textarea>
                                             <span class="help-block">Ce champs doit être remplie avec la valeur de votre ID (L'ID est le numéro en haut à gauche de votre dashboard #XX)</span></div>
                                             </div>
                                         </div>




                                          <div class="row">
                                             <label class="col-sm-2 label-on-left"> </label>
                                             <div class="col-sm-10">
                                                 <div class="form-group label-floating is-empty">


                                                     <div class="form-group form-file-upload">
               <input type="file" id="attachment" name="attachment" multiple="">
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
 //owner = le mail de la personne
   $priority = '3';

   $email = 'contact@jam-mdm.fr';
   $message = $_POST['message'];
   $subject = '[JAM]'.'[Problème de document]';
 if($subject&&$email&&$message){
   $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
   if($responseData->success){
     if(!isset($_FILES['attachment'])){
       mail($owner_mail,$subject,$message);
     }else{
         $filename = $_FILES['attachment']['name'];
         $file = $_FILES['attachment']['tmp_name'];
       $content = file_get_contents( $file);
       $content = chunk_split(base64_encode($content));
       $uid = md5(uniqid(time()));
       $name = basename($file);
       // header
       $headers = "From: <".$email.">\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= 'X-Priotity:'.$priority."\r\n";
       $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
       // message & attachment
       $nmessage = "--".$uid."\r\n";
       $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
       $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
       $nmessage .= $message."\r\n\r\n";
       $nmessage .= "--".$uid."\r\n";
       $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
       $nmessage .= "Content-Transfer-Encoding: base64\r\n";
       $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
       $nmessage .= $content."\r\n\r\n";
       $nmessage .= "--".$uid."--";
         mail($owner_mail,$subject,$nmessage, $headers);
     }
     ?>

     <div class="content">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-md-6 col-md-offset-3">



     <div class="alert alert-success">
             <div class="container">
         <div class="alert-icon">
           <i class="material-icons">info_outline</i>
         </div>


               <b>Succès :</b> Le mail à été envoyé à son destinataire !
             </div>
         </div>
       </div></div></div></div>
       <?php
   }else{
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


               <b>Erreur Captcha:</b> BipBoup BoupBip BIPPPP ! Robot détecté !
             </div>
         </div>
       </div></div></div></div>
     <?php
   }
 }else{
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


               <b>Erreur Champs:</b> Les champs sont incorrects ou manquants !
             </div>
         </div>
       </div></div></div></div>
     <?php
 }
}
  ?>




 </body>
 <?php


}






}else{

    $selectid = $db->prepare("SELECT distinct user_id FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' ORDER BY date");
    $selectid->execute();
    $countid = $selectid->rowCount();

    if($countid>'0'){
      while($uneselectid = $selectid->fetch(PDO::FETCH_OBJ)){

        $user_id = $uneselectid->user_id;
        $selectnom = $db->prepare("SELECT username, email, status FROM users WHERE id=:user_id ORDER BY id ASC");
        $selectnom->execute(array(
            "user_id"=>$user_id
            )
        );
        $table = $selectnom->fetchAll(PDO::FETCH_OBJ);
        if(count($table)>0){
          echo "<h3>".count($table)." documents trouvés</h3>";
          echo '
          <table class="table">
          <thead>
          <tr>
          <th scope="col">Pseudo</th>
          <th scope="col">Email</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>

          ';
          foreach($table as $ligne){
            $username = $ligne->username;
            $email = $ligne->email;
            $status = $ligne->status;

            echo '

            <tr>
              <th scope="row">'.$username.'</th>
              <td>'.$email.'<td>
              <td>'.$status.'</td>

              <td>
          <a href="?action=gestionfichier&amp;id='.$user_id.'">
          <button type="button" class="btn">Afficher</button>
          </a>
              </td>
            </tr>
        <hr>
            ';
          }

          echo '
        </tbody>
        </table>


          ';

}
}
}



}





require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Demande Adhésion";
    require_once('includes/head.php');
    ini_set('display_errors', 1);


    //Code de génératon du captcha fournie par GOOGLE
    $secret = "LESECRET";
    $sitekey = "LESITEKEY";
    ?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<body onload="demo.showNotification('top','right','Salut')">
  <div class="wrapper">

    <?php
    require_once('includes/navbar.php');


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
    ?>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title text-center">Demande d'Adhésion</h2>
            <br>

    <?php

if($_GET['action']=='gestionfichier'){
  $user_id=$_GET['id'];
  $selectfichieratraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
  $selectfichieratraiter->execute();
  $countid = $selectfichieratraiter->rowCount();
  if($countid>'0'){
  ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Documents en attente de validation</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th class="text-center">Pseudo</th>
                      <th class="text-center">Nom du fichier</th>
                      <th class="text-center">Message</th>
                      <th class="text-center">Date d'ajout</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody>

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
                        <td class="text-center"><?php echo $nom;?></td>
                        <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
                        <td><?php echo $message;?></td>
                        <td class="text-center"><?php echo $datefile;?></td>
                        <td class="text-center"><a href="?action=validefichier&amp;id=<?php echo $idfichier;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Valider</button></a>
                                                <a href="?action=refusfichier&amp;id=<?php echo $idfichier;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Refuser</button></a>
                        </td>
                      </tr>

                      <?php  } ?>

                  </tbody>
                  </table>
                  </div>
              </div>
            </div>
          </div>

        <?php } ?>

<?php

$selectfichierdejatraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status <> 'EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
$selectfichierdejatraiter->execute();
$countid2 = $selectfichierdejatraiter->rowCount();
if($countid2>'0'){
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <h3 class="card-title">Liste des documents déja traités</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <div class="table-responsive">
        <table class="table">
          <thead class="text-primary">
            <th class="text-center">Pseudo</th>
            <th class="text-center">Nom du fichier</th>
            <th class="text-center">Message</th>
            <th class="text-center">Date d'ajout</th>
            <th class="text-center">Status</th>
          </thead>
          <tbody>

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
              <td class="text-center"><?php echo $nom;?></td>
              <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
              <td><?php echo $message;?></td>
              <td class="text-center"><?php echo $datefile;?></td>
              <td class="text-center"><?php echo $status;?></td>
            </tr>

          <?php  } ?>
        </tbody>
        </table>
        </div>
    </div>
  </div>
</div>

<?php } ?>


<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <h3 class="card-title">Contacter la personne par Email</h3>
    </div>
  </div>
</div>
<form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
<div class="row">
  <div class="col-sm-6">
    <div class="card-content">
      <div class="form-group label-floating">
          <textarea name="message" class="form-control" rows="8" placeholder="Votre message"></textarea>
          <span class="help-block">Merci de décrire précisément votre message</span>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card-content">
      <br>
      <div class="form-group form-file-upload">
          <input type="file" id="attachment" name="attachment[]" multiple="">
          <div class="input-group">
              <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
              <span class="input-group-btn input-group-s">
                  <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                      <i class="material-icons">layers</i>
                  </button>
              </span>
          </div>
      </div>
      <center>
        <div class="form-group label-floating">
            <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
        </div>
      </center>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <center>
        <button type="submit" name="submit" value="Envoyer un message" class="btn btn-rose btn-round" onclick="demo.showNotification('top','right','Salut')">Envoyer le message</button>
      </center>
    </div>
  </div>
</div>
</form>

    </div>
  </div>
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

 <?php


}






}else{

    $selectid = $db->prepare("SELECT distinct user_id FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' ORDER BY date");
    $selectid->execute();
    $countid = $selectid->rowCount();

    ?>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title text-center">Demande d'Adhésion</h2>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Liste des personnes ayant transmis des documents</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">

            <?php
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
                    echo '

                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th class="text-center">Pseudo</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Statuts</th>
                        <th class="text-center">Action</th>
                      </thead>
                      <tbody>
                        ';

                        foreach($table as $ligne){
                          $username = $ligne->username;
                          $email = $ligne->email;
                          $status = $ligne->status;
                          echo '

                        <tr>
                          <td class="text-center">'.$username.'</td>
                          <td class="text-center">'.$email.'</td>
                          <td class="text-center">'.$status.'</td>
                          <td class="text-center"><a href="?action=gestionfichier&amp;id='.$user_id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Afficher</button></a></td>
                        </tr>';
                      }

                      echo '
                    </tbody>
                    </table>
                    </div>
                      ';
                    }   }   }
                      ?>

                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>

</div>
</body>

<?php
require_once('includes/javascript.php');
?>

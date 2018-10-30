<?php

// Ajouter le code à l'endroit souhaité dans l'index.php !


// Dire à Kévin ou le code est implanté pour ajouter les règles de changement des accès juste en dessous !
$secret = "LESECRET";
$sitekey = "LESITEKEY";


//
?>
<script src='https://www.google.com/recaptcha/api.js'></script>




                              <div class="col-md-12">
                                                  <div class="card">
                                                      <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">

                                                          <div class="card-header card-header-text" data-background-color="rose">
                                                              <h4 class="card-title">Nous contacter</h4>
                                                          </div>
                                                          <div class="card-content">
                                          <div class="row">
                                              <label class="col-sm-2 label-on-left">Nom / Prénom : </label>
                                              <div class="col-sm-10">
                                                  <div class="form-group label-floating is-empty">
                                                      <label class="control-label"></label>
                                                      <input type="text" name="nom" class="form-control" value>
                                                      <span class="help-block">Merci de renseigner ce champs</span>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <label class="col-sm-2 label-on-left">Email : </label>
                                              <div class="col-sm-10">
                                                  <div class="form-group label-floating is-empty">
                                                      <label class="control-label"></label>
                                                      <input type="email" name="email" class="form-control" value>
                                                      <span class="help-block">Ce champs servira d'email de réponse</span>
                                                  </div>
                                              </div>
                                          </div>


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
  $owner_mail = "contact@jam-mdm.fr";
  $nom = $_POST['nom'];
  $email = $_POST['email'];

    $message = $_POST['message'];
    $subject = '['.$nom.']'.'[Contact]';
  if($subject&&$email&&$message&&$nom){
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
        $headers .= 'X-Priotity:'.2."\r\n";
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

   ?>
<?php


    require_once('includes/javascript.php');
?>

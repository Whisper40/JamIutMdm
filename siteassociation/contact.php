<?php
    require_once('includes/connectBDD.php');
    $nompage = "Nous Contacter";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');

//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>

<style>
.page-header .page-header-image {
  position: absolute;
  background-size: cover;
  background-position: center center;
  width: 100%;
  height: 80%;
  z-index: -1;
}

.page-header .content-center {
  position: absolute;
  top: 38%;
  left: 50%;
  z-index: 2;
  -ms-transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
  color: #FFFFFF;
  padding: 0 15px;
  width: 100%;
  max-width: 880px;
}
.section {
  padding: 0px 0;
  position: relative;
  background: #FFFFFF;
}
</style>
<script src='https://www.google.com/recaptcha/api.js'></script>

<body class="landing-page sidebar-collapse">


<?php
    require_once('includes/navbar.php');

    $head = $db->query("SELECT * FROM photopage WHERE nompage = '$nompage'");
    $pagehead = $head->fetch(PDO::FETCH_OBJ);
?>
<div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./JamFichiers/Img/ImagesDuSite/Original/<?php echo $pagehead->image; ?>');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title"><?php echo $pagehead->pagetitre; ?></h1>
        </div>
      </div>
    </div>

    <div class="section section-contact-us text-center">
      <div class="container">
        <h2 class="title"><?php echo $pagehead->titre; ?></h2>
        <p class="description"><?php echo $pagehead->description; ?></p>
        <div class="row">
          <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">


                <?php
                if(isset($_POST['submit'])){
                  $owner_mail = "contact@jam-mdm.fr";
                  $priority = $_POST['optionsRadios2'];
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

                      <div class="container">
                         <div class="row">
                           <div class="col-sm-14 ml-auto mr-auto">
                             <div class="alert alert-success">
                               <div class="alert-icon">
                                 <i class="now-ui-icons ui-1_bell-53"></i>
                               </div>
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                               </button>
                               <b>Succès :</b> Votre message a bien été envoyé !
                            </div>
                          </div>
                         </div>
                      </div>

                        <?php
                    }else{
                      ?>

                      <div class="container">
                         <div class="row">
                           <div class="col-sm-14 ml-auto mr-auto">
                             <div class="alert alert-warning">
                               <div class="alert-icon">
                                 <i class="now-ui-icons ui-1_bell-53"></i>
                               </div>
                               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                               </button>
                               <b>Attention :</b> Votre inscription n'a pas pu aboutir. Merci de cocher la captcha.
                            </div>
                          </div>
                         </div>
                      </div>

                      <?php
                    }
                  }else{
                    ?>

                    <div class="container">
                       <div class="row">
                         <div class="col-sm-14 ml-auto mr-auto">
                          <div class="alert alert-warning">
                             <div class="alert-icon">
                               <i class="now-ui-icons ui-1_bell-53"></i>
                             </div>
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                             </button>
                                <b>Attention:</b> Merci de remplir tous les<br>champs !
                          </div>
                        </div>
                       </div>
                    </div>

                      <?php
                  } }
                   ?>

            <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons users_circle-08"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Nom et Prénom"  name="nom">
            </div>
            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons ui-1_email-85"></i>
                </span>
              </div>
              <input type="email" class="form-control" placeholder="Email" name="email">
            </div>
            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons arrows-1_share-66"></i>
                </span>
              </div>
              <input type="file" class="form-control" id="attachment" name="attachment" multiple="">
            </div>
            <div class="textarea-container">
              <textarea class="form-control" name="message" rows="10" cols="80" placeholder="Votre message :"></textarea>
            </div>
            <p class="category">Prioritée</p>
            <center><table>
              <tr>
                <td>
            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="optionsRadios2" value="1">
                  <span class="form-check-sign"></span>
                  Urgent
                </label>
              </div>
            </div></td>
            <td>
            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="optionsRadios2" checked="true" value="3">
                  <span class="form-check-sign"></span>
                  Modéré
                </label>
              </div>
            </div></td>
            <td>
            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="optionsRadios2" value="5">
                  <span class="form-check-sign"></span>
                  Faible
                </label>
              </div>
            </div></td></tr></table></center>
            <center>
            <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
          </center><br>
            <div class="send-button">
              <button type="submit" class="btn btn-primary btn-round btn-block btn-lg" name="submit" >Envoyer Message</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

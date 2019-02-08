<?php
ini_set('display_errors', 1);
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
require_once('includes/checkdejamembre.php');
$nompage = "Devenir Membre";
require_once('includes/head.php');

$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php
$user_id = $_SESSION['user_id'];
$selectstatus = $db->prepare("SELECT status FROM users WHERE id='$user_id'");
$selectstatus->execute();
$s = $selectstatus->fetch(PDO::FETCH_OBJ);
$status = $s->status;

$messagenotif = "";

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
          $messagenotif = "<b>Erreur : </b>le fichier existe déja !";
          $type = "warning";
          $uploadOk = 0;
      }
      // Check file size < 2mo
      if ($_FILES["fileToUpload"]["size"][$i] > 2000000) {
          $messagenotif = "<b>Erreur : </b>la Taille de votre est supérieur à 2 Mo !";
          $type = "warning";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "zip" && $imageFileType != "rar") {

          $messagenotif = "<b>Erreur : </b>désolé, seuls les formats JPG, PDF, GIF, ZIP et RAR sont autorisés !";
          $type = "warning";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $messagenotif = "<b>Erreur : </b>désolé votre fichier n'a pas été transmis !";
          $type = "warning";
      // if everything is ok, try to upload file
      } else {
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = strftime('%d:%m:%y %H:%M:%S');
        $target_filefile = basename($_FILES["fileToUpload"]["name"][$i]);
        $target_file2 = $target_dirnew."".$date.basename($_FILES["fileToUpload"]["name"][$i]);
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file2)) {

              $messagenotif = "<b>Succès : </b>le fichier ". basename( $_FILES["fileToUpload"]["name"][$i]). " à été transmis.";
              $type = "success";
              $status = "EN ATTENTE DE VALIDATION";
              date_default_timezone_set('Europe/Paris');
              setlocale(LC_TIME, 'fr_FR.utf8','fra');
              $date = strftime('%d/%m/%y %H:%M:%S');
              $insertinfos = $db->prepare("INSERT INTO validationfichiers (user_id, filename,filenamesystem, message, ip, date, status) VALUES(:user_id, :filename, :filenamesystem, :message, :ip, :date, :status)");
              $insertinfos->execute(array(
                  "user_id"=>$_SESSION['user_id'],
                  "filename"=>$target_filefile,
                  "filenamesystem"=>$target_file2,
                  "message"=>$message,
                  "ip"=>$ip,
                  "date"=>$date,
                  "status"=>$status
                  )
              );
          }else {
               $messagenotif = "<b>Erreur : </b>fichiers non uploadés !";
               $type = "warning";
          } } }
          }else{
            $messagenotif = "<b>Erreur : </b>captcha non valide !";
            $type = "warning";
          }  }

          $page = $db->prepare("SELECT * FROM pagedevenirmembre");
          $page->execute();
          $lapage = $page->fetch(PDO::FETCH_OBJ);
          ?>

<body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
    <div class="wrapper">

      <?php
          require_once('includes/navbar.php');
          $selectaccesautorise = $db->prepare("SELECT * FROM transactions WHERE user_id='$user_id' AND raison='Cotisation Annuelle'");
          $selectaccesautorise->execute();
          $countaccesautorise = $selectaccesautorise->rowCount();
          if($countaccesautorise == 0){
          $selectnumbervalidation = $db->prepare("SELECT * FROM users WHERE id='$user_id' and status <> 'EN ATTENTE DE PAIEMENT' and status <> 'MEMBRE'");
          $selectnumbervalidation->execute();
          $countvalidation = $selectnumbervalidation->rowCount();
          if($countvalidation == 1){
              ?>

              <div class="content">
                  <div class="container-fluid">
                      <div class="card">
                          <div class="card-content">
                              <h2 class="card-title text-center">Devenir Membre de l'association</h2>
                              <div class="row">
                              <div class="col-md-6">
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <center>
                                              <div class="description">
                                                  <h4 class="info-title">Introduction</h4>
                                                  <p class="description">
                                                    <?php echo $lapage->introduction; ?>
                                                  </p>
                                              </div>
                                          </center>
                                      </div>
                                      <div class="info info-horizontal">
                                          <center>
                                              <div class="description">
                                                  <h4 class="info-title">Etape 1</h4>
                                                  <p class="description">
                                                    <?php echo $lapage->etape1; ?>
                                                  </p>
                                                  <div class="content">
                                                      <div class="container-fluid">
                                                          <div class="row">
                                                              <a href="./download.php?dl=thisfilecontainsyourdocumentsforjam" class="btn btn-rose btn-round">
                                                                  <i class="material-icons">vertical_align_bottom</i>
                                                                  Télécharger les documents
                                                              </a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </center>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <center>
                                              <div class="description">
                                                  <h4 class="info-title">Etape 2</h4>
                                                  <p class="description">
                                                      <?php echo $lapage->etape2; ?>
                                                  </p>
                                                  <div class="content">
                                                      <div class="container-fluid">
                                                          <div class="row">
                                                                  <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                                                      <div class="form-group label-floating">
                                                                          <textarea name="message" class="form-control" rows="4" placeholder="Vous avez un message ? (optionel)"></textarea>
                                                                          <span class="help-block">Merci de décrire précisément votre message</span>
                                                                      </div>
                                                                      <div class="form-group form-file-upload">
                                                                          <input type="file" id="fileToUpload" name="fileToUpload[]" multiple="multiple">
                                                                          <div class="input-group">
                                                                              <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                                                                              <span class="input-group-btn input-group-s">
                                                                                  <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                                                                                      <i class="material-icons">layers</i>
                                                                                  </button>
                                                                              </span>
                                                                          </div>
                                                                      </div>
                                                                      <div class="form-group label-floating">
                                                                          <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
                                                                      </div>
                                                                      <button type="submit" name="submit" value="Envoyer un fichier" class="btn btn-rose btn-round">Envoyer le fichier</button>
                                                                  </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </center>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-3">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <center>
                                          <br>
                                            <div class="description">
                                                <h4 class="info-title">Etape 3</h4>
                                                <p class="description">
                                                  <?php echo $lapage->etape3; ?>
                                                </p>


                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-content">
                                      <div class="table-responsive">
                                          <table class="table">
                                              <thead class="text-primary">
                                                  <th>Nom</th>
                                                  <th>Date d'envoie</th>
                                                  <th>Status</th>
                                              </thead>

                                              <?php
                                              $user_id = $_SESSION['user_id'];
                                              $sql = "SELECT * FROM validationfichiers WHERE user_id='$user_id' ORDER BY id ASC";
                                              $req = $db->prepare($sql);
                                              $req->execute();
                                              $req->setFetchMode(PDO::FETCH_ASSOC);
                                              foreach($req as $row){
                                              ?>

                                              <tbody>
                                                  <tr>
                                                      <td><?php echo $row['filename']; ?></td>
                                                      <td><?php echo $row['date']; ?></td>
                                                      <td><?php echo $row['status']; ?></td>
                                                  </tr>

                                                  <?php } ?>

                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <?php
        }else{
          ?>

          <div class="content">
              <div class="container-fluid">
                  <div class="card">
                      <div class="card-content">
                          <h2 class="card-title text-center">Devenir Membre de l'association</h2>
                          <div class="row">
                            <div class="col-sm-12">
                              <br>
                                 <div class="card-content">
                                     <div class="info info-horizontal">
                                         <div class="description">
                                             <center>
                                             <h4 class="info-title">Pour devenir membre de l'association, il ne reste plus q'une étape : payer ta cotisation annuel</h4>
                                             </center>
                                         </div>
                                     </div>
<?php
                                  $selectprice = $db->prepare("SELECT price FROM cotisation");
                                  $selectprice->execute();
                                  $r2 = $selectprice->fetch(PDO::FETCH_OBJ);
                                  $price = $r2->price;

                                    ?>

                                          <div class="info info-horizontal">
                                              <div class="description">
                                                <center>
                                                  <h4 class="info-title">Prix Total : <?php echo $price; ?> €</h4>
                                                    <div align="center" id="paypal-button"></div>
                                                  </center>
                                              </div>
                                          </div>

                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

<script>
    paypal.Button.render({
<?php
  $total = $price;
?>
env: 'sandbox',
client: {
    sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
    production: 'AXaV8dsJkxtDm__NKyNdyXBxp9wa8TSS8YZvNOyk3OEpi9rO82H3lc2wKhQrEbJS7NxfnLJ9Igq-rsIC'
},
        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'pill',      // pill | rect
            color:  'blue'       // gold | blue | silver | black
        },
        commit: true,
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: <?= $total ?>, currency: 'EUR' }
                        }
                    ]
                },
            });
        },
        onAuthorize: function(data, actions) {
            return actions.payment.get().then(function(data) {
                console.log(data);
                var shipping = data.payer.payer_info.shipping_address;
                var name = shipping.recipient_name;
                var street = shipping.line1;
                var country_code = shipping.country_code;
                var city = shipping.city;
                var date = '<?= date("Y/m/d") ?>';
                var transaction_id = data.id;
                var price = data.transactions[0].amount.total;
                var currency_code = 'EUR';
                $.post(
                    "processcotisation.php",
                    {
                        name : name,
                        street: street,
                        city: city,
                        country_code : country_code,
                        date: date,
                        transaction_id: transaction_id,
                        price: price,
                        currency_code: currency_code,
                    }
                );
                return actions.payment.execute().then(function() {
                    $(location).attr("href", '<?= "https://dashboard.jam-mdm.fr"."/successcotisation.php"; ?>');
                });
            });
        },
    }, '#paypal-button');
</script>




          <?php
        }
         ?>



          <!-- RAJOUT KEVIN -->

          <!-- FIN RAJOUT KEVIN -->


      </div>
  </body>

<?php
}else{
  ?>
<script>window.location="https://dashboard.jam-mdm.fr/";</script>
  <?php
}
    require_once('includes/javascriptdashboard.php');
?>

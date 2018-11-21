<?php
    require_once('includes/connectBDD.php');
    $nompage = "Nous Contacter";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');

//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

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
  <div class="wrapper">

<?php
    require_once('includes/navbar.php');

    $head = $db->query("SELECT * FROM photopage WHERE nompage = '$nompage'");
    $pagehead = $head->fetch(PDO::FETCH_OBJ);
?>

    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/<?php echo $pagehead->image; ?>');">
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
            <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
              <h3> Si vous souhaitez faire une donation anonyme merci de ne pas compléter vos informations personelles.</h3>
            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons users_circle-08"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Nom et Prénom" name="nom">
            </div>

            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons users_circle-08"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Adresse postale" name="adressepostale">
            </div>

            <div class="input-group input-lg">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="now-ui-icons ui-1_email-85"></i>
                </span>
              </div>
              <input type="email" class="form-control" placeholder="Email" name="email">
            </div>

            <div class="textarea-container">
              <textarea class="form-control" name="message" rows="10" cols="80" placeholder="Votre message :"></textarea>
            </div>
            <p class="category">Donation</p>
            <center><table>
              <tr>
                <td>
            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="optionsRadios" checked="true" value="5">
                  <span class="form-check-sign"></span>
                  5€
                </label>
              </div>
            </div></td>
            <td>
            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="optionsRadios" checked="true" value="10">
                  <span class="form-check-sign"></span>
                  10€
                </label>
              </div>
            </div></td>
            <td>
            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" onclick="javascript:yesnoCheck();" id="noCheck" name="optionsRadios" value="20">
                  <span class="form-check-sign"></span>
                  20€
                </label>
              </div>
            </div></td>
            <td>

            <div class="col-sm-8 col-lg-3 mb-4">
              <div class="form-check form-check-radio">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" onclick="javascript:yesnoCheck();" id="yesCheck" name="optionsRadios" value="20">
                  <span class="form-check-sign"></span>
                  Autre
                </label>
              </div>
            </div></td>

     <script>
// Le code s'adapte en fonction de l'endroit ou le clique à été fait.
//Si le click est fait sur autre alors on affiche "indiquer le montant"
     function yesnoCheck() {
         if (document.getElementById('yesCheck').checked) {
             document.getElementById('ifYes').style.display = 'block';
         }
         else document.getElementById('ifYes').style.display = 'none';

     }
    </script>
    <div id="ifYes" style="display:none">
            Merci d'indiquer le montant : <input type='number' id='yes' name='valueautre'><br>



    </div>

</div>



          </tr></table></center>
            <center>

          </center><br>
            <div class="send-button">
              <button type="submit" class="btn btn-primary btn-round btn-block btn-lg" name="submit">Confirmer et choisir votre moyen de paiement</button>
            </div>
          </form>


          <?php
// Code Paypal
$valueautre = $_POST['valueautre'];
if(!empty($valueautre)){
  $prixfinal = $_POST['valueautre'];
}else{
  $prixfinal = $_POST['optionsRadios'];
}
           ?>

          <div align="center" id="paypal-button"></div>


          <script>
              paypal.Button.render({
          <?php

          if(!empty($valueautre)){
            $total = $_POST['valueautre'];
          }else{
            $total = $_POST['optionsRadios'];
          }
          $_SESSION['nomdonneur'] = $_POST['nom'];
          $_SESSION['adressedonneur'] = $_POST['adressepostale'];
          $_SESSION['emaildonneur'] = $_POST['email'];

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
                              "processdon.php",
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
                              $(location).attr("href", '<?= "https://jam-mdm.fr"."/successdon.php"; ?>');
                          });
                      });
                  },

              }, '#paypal-button');
          </script>





<!-- FIN PAYPAL -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

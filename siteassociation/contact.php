<?php
    require_once('includes/connectBDD.php');
    $nompage = "Nous Contacter";
    require_once('includes/head.php');


//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src='https://www.google.com/recaptcha/api.js'></script>


<body class="landing-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>

  <div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/bg1.jpg');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title">Nous contacter</h1>
          <div class="text-center">
          </div>
        </div>
      </div>
    </div>
    <div class="section section-contact-us text-center">
      <div class="container">
        <h2 class="title">Vous avez une question ?</h2>
        <p class="description">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
        <div class="row">
          <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
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
                  <i class="now-ui-icons ui-1_email-85"></i>
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

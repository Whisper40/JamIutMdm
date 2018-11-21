<?php

require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Devenir Membre";
require_once('includes/head.php');


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


<body>
    <div class="wrapper">

      <?php
          require_once('includes/navbar.php');

              ?>

              <div class="content">
                  <div class="container-fluid">
                      <div class="card">
                          <div class="card-content">
                              <h2 class="card-title text-center">Devenir Membre de l'association</h2>
                              <div class="row">
                                <div class="card-content">
                                      <div class="description">
                                          <center>
                                            <h4 class="info-title">En cliquant sur ce bouton j'accepte de participer à l'activitée</h4>
                                          </center>
                                      </div>
                                  </div>
                              <div class="col-md-6">
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <div class="description">
                                              <h4 class="info-title">Etape 1</h4>
                                              <p class="description">
                                                  We've created the marketing campaign of the website. It was a very interesting collaboration.
                                              </p>
                                              <div class="content">
                                                  <div class="container-fluid">
                                                      <div class="row">
                                                          <center>
                                                              <a href="./download.php?dl=thisfilecontainsyourdocumentsforjam" class="btn btn-rose btn-round">
                                                                  <i class="material-icons">vertical_align_bottom</i> Télécharger les documents
                                                              </a>
                                                          </center>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <div class="description">
                                              <h4 class="info-title">Etape 2</h4>
                                              <p class="description">
                                                  We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                              </p>
                                              <div class="content">
                                                  <div class="container-fluid">
                                                      <div class="row">
                                                          <center>



                                              <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
                                                  <div class="form-group label-floating">
                                                      <label class="col-sm-2 label-on-left">Message</label>
                                                      <textarea name="message" class="form-control" rows="1"></textarea>
                                                      <span class="help-block">Merci de décrire précisément votre message</span>
                                                  </div>
                                                  <div class="form-group label-floating">
                                                         <label class="col-sm-2 label-on-left"> </label>
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
                                                  <div class="form-group label-floating">
                                                      <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
                                                  </div>
                                                  <button type="submit" name="submit" value="Envoyer un message" class="btn btn-fill btn-rose">Envoyer le fichier</button>
                                              </form>
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
          </div>
      </div>
  </div>

</body>
<?php
    require_once('includes/javascriptdashboard.php');
?>

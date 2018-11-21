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
                              <div class="col-md-6">
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <center>
                                              <div class="description">
                                                  <h4 class="info-title">Introduction</h4>
                                                  <p class="description">
                                                  Tu souhaite devenir mebre de l'association.
                                                  </p>
                                              </div>
                                          </center>
                                      </div>
                                      <div class="info info-horizontal">
                                          <center>
                                              <div class="description">
                                                  <h4 class="info-title">Etape 1</h4>
                                                  <p class="description">
                                                  We've created the marketing campaign of the website. It was a very interesting collaboration.
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
                                                      We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                                  </p>
                                                  <div class="content">
                                                      <div class="container-fluid">
                                                          <div class="row">
                                                              <center>
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
                                                                      <button type="submit" name="submit" value="Envoyer un message" class="btn btn-rose btn-round">Envoyer le fichier</button>
                                                                  </form>
                                                              </center>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </center>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-3">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                        <center>
                                            <div class="description">
                                                <h4 class="info-title">Etape 3</h4>
                                                <p class="description">
                                                Tes Documents suivant sont en attente de validation !
                                                </p>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-content">
                                    <div class="info info-horizontal">
                                      <div class="table-responsive">
                                          <table class="table">
                                              <thead class="text-primary">
                                                  <th>Name</th>
                                                  <th>Country</th>
                                                  <th>City</th>
                                                  <th>Salary</th>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>Dakota Rice</td>
                                                      <td>Niger</td>
                                                      <td>Oud-Turnhout</td>
                                                      <td class="text-primary">$36,738</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Minerva Hooper</td>
                                                      <td>Curaçao</td>
                                                      <td>Sinaai-Waas</td>
                                                      <td class="text-primary">$23,789</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Sage Rodriguez</td>
                                                      <td>Netherlands</td>
                                                      <td>Baileux</td>
                                                      <td class="text-primary">$56,142</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Philip Chaney</td>
                                                      <td>Korea, South</td>
                                                      <td>Overland Park</td>
                                                      <td class="text-primary">$38,735</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Doris Greene</td>
                                                      <td>Malawi</td>
                                                      <td>Feldkirchen in Kärnten</td>
                                                      <td class="text-primary">$63,542</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Mason Porter</td>
                                                      <td>Chile</td>
                                                      <td>Gloucester</td>
                                                      <td class="text-primary">$78,615</td>
                                                  </tr>
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
          </div>
      </div>
  </body>

<?php
    require_once('includes/javascriptdashboard.php');
?>

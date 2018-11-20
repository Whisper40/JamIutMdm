<?php

require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
$nompage = "Devenir Membre";
require_once('includes/head.php');

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
                              <div class="col-md-5">
                                  <div class="card-content">
                                      <div class="info info-horizontal">
                                          <div class="icon icon-rose">
                                              <i class="material-icons">timeline</i>
                                          </div>
                                          <div class="description">
                                              <h4 class="info-title">Marketing</h4>
                                              <p class="description">
                                                  We've created the marketing campaign of the website. It was a very interesting collaboration.
                                              </p>
                                          </div>
                                      </div>
                                      <div class="info info-horizontal">
                                          <div class="icon icon-primary">
                                              <i class="material-icons">code</i>
                                          </div>
                                          <div class="description">
                                              <h4 class="info-title">Fully Coded in HTML5</h4>
                                              <p class="description">
                                                  We've developed the website with HTML5 and CSS3. The client has access to the code using GitHub.
                                              </p>
                                          </div>
                                      </div>
                                      <div class="info info-horizontal">
                                          <div class="icon icon-info">
                                              <i class="material-icons">group</i>
                                          </div>
                                          <div class="description">
                                              <h4 class="info-title">Built Audience</h4>
                                              <p class="description">
                                                  There is also a Fully Customizable CMS Admin Dashboard for this product.
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-5">
                                <div class="content">
                                      <div class="container-fluid">
                                          <div class="row">
                                          <h3 class="title text-center">Mes documents</h3>
                                          <center><a href="./download.php?dl=thisfilecontainsyourdocumentsforjam" class="btn btn-rose btn-round">
                                                                                          <i class="material-icons">vertical_align_bottom</i> Télécharger les documents
                                                                                      </a></center>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                  <form class="form" method="" action="">
                                      <div class="card-content">
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">face</i>
                                              </span>
                                              <input type="text" class="form-control" placeholder="First Name...">
                                          </div>
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">email</i>
                                              </span>
                                              <input type="text" class="form-control" placeholder="Email...">
                                          </div>
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                  <i class="material-icons">lock_outline</i>
                                              </span>
                                              <input type="password" placeholder="Password..." class="form-control" />
                                          </div>
                                          <!-- If you want to add a checkbox to this form, uncomment this code -->
                                          <div class="checkbox">
                                              <label>
                                                  <input type="checkbox" name="optionsCheckboxes" checked> I agree to the
                                                  <a href="#something">terms and conditions</a>.
                                              </label>
                                          </div>
                                      </div>
                                      <div class="footer text-center">
                                          <a href="#pablo" class="btn btn-primary btn-round">Get Started</a>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

  </div>

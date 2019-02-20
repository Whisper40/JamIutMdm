<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Tableau de bord";
    require_once('includes/head.php');
?>

<body>
    <div class="wrapper">

      <div class="sidebar" data-active-color="blue" data-background-color="black" data-image="https://www.nasa.gov/sites/default/files/styles/full_width_feature/public/thumbnails/image/worldfires-08232018.jpg">
          <div class="logo">
              <a href="https://jam-mdm.fr/" class="simple-text">
                  JAM             </a>
          </div>
          <div class="logo logo-mini">
              <a href="https://jam-mdm.fr/" class="simple-text">
                  JAM
              </a>
          </div>
          <div class="sidebar-wrapper">
              <div class="user">
                  <div class="info">
                      <a>



      <?php

      $user_id = $_SESSION['user_id'];
      $sql = "SELECT * FROM users WHERE id = '$user_id'";
      $req = $db->query($sql);
      $req->setFetchMode(PDO::FETCH_ASSOC);

      foreach($req as $row)
      { ?>
      #<?php echo $row['id'];?><br/>
      Pseudo : <?php echo $row['username'];
      }

      ?>


      </a>
      </div>
      </div>
      <ul class="nav">
      <?php
      $cat = $db->query("SELECT * FROM dashboardcat");
      while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
        ?>
        <li
        <?php
        if($unecat->name == $nompage){

        ?>
        class="active">
        <?php }else{ ?>
        >
        <?php }



        $selectpaiementcotisation = $db->prepare("SELECT * FROM transactions WHERE user_id='$user_id' AND raison='Cotisation Annuelle'");
        $selectpaiementcotisation->execute();
        $countvalidation = $selectpaiementcotisation->rowCount();


        $selectstatusmembre = $db->prepare("SELECT * FROM users WHERE id=:user_id and status=:status");
        $selectstatusmembre->execute(array(
          "user_id"=>$user_id,
          "status"=>'MEMBRE'
        ));
        $countstatusmembre = $selectstatusmembre->rowCount();

        $namepage = $unecat->name;

        if($namepage == 'Devenir Membre'){
      if($countstatusmembre == '1'){
          if($countvalidation == '1'){


          }}else{
            ?>

            <a href="<?php echo $unecat->page;?>">
                <i class="material-icons"><?php echo $unecat->icon;?></i>
                <p><?php echo $unecat->name;?></p>
            </a>
            </li>

          <?php
        }}else{
          ?>

          <a href="<?php echo $unecat->page;?>">
              <i class="material-icons"><?php echo $unecat->icon;?></i>
              <p><?php echo $unecat->name;?></p>
          </a>
      </li>
      <?php
        }}





          $catparticipe = $db->query("SELECT * FROM catparticipe WHERE user_id=$user_id");
          while($uneparticipation = $catparticipe->fetch(PDO::FETCH_OBJ)){
            $nom = $uneparticipation->name;
            ?>
            <li
            <?php
            if($nom == $nompage){
            ?>
            class="active">
            <?php }else{ ?>
            >
            <?php } ?>
                <a href="<?php echo $uneparticipation->page;?>">
                    <i class="material-icons"><?php echo $uneparticipation->icon;?></i>
                    <p><?php echo $uneparticipation->name;?></p>
                </a>
            </li>
              <?php
                }
              ?>



                  <li>
                      <a href="https://jam-mdm.fr/">
                          <i class="material-icons">keyboard_return</i>
                          <p>Retour JAM</p>
                      </a>
                  </li>
                  <li>
                      <a href="disconnect.php">
                          <i class="material-icons">power_settings_new</i>
                          <p>Déconnexion</p>
                      </a>
                  </li>
              </ul>
          </div>
      </div>

      <div class="main-panel">
          <nav class="navbar navbar-transparent navbar-absolute">
              <div class="container-fluid">
                  <div class="navbar-minimize">
                      <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                          <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                          <i class="material-icons visible-on-sidebar-mini">view_list</i>
                      </button>
                  </div>
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="https://dashboard.jam-mdm.fr"> Dashboard </a>                    </div>
                  <div class="collapse navbar-collapse">
                      <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                      <i class="material-icons">notifications</i>
                                                                      <p class="hidden-lg hidden-md">
                                      Notifications
                                      <b class="caret"></b>
                                  </p>
                              </a>
                              <ul class="dropdown-menu" id="menu_notifications">
                                  <li>
                                              <a>Aucune notification</a>
                                          </li>                               </ul>
                          </li>
                          <li class="separator hidden-lg hidden-md"></li>
                      </ul>
                  </div>
              </div>
          </nav>


<!-- DEBUT DU CADRE -->
<!-- Cette partie délimitée par début et fin peut etre enlevée , cela concerne tout ce qui se trouve à l'interieur de la page ( cubes + actus ) -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="green">
                                <i class="material-icons">euro_symbole</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Date d'inscription</p>
                                <h4 class="card-title">

                                                <?php
                                                    $selectsubscribe = $db->prepare("SELECT subscribe FROM users WHERE id = :user_id");
                                                    $selectsubscribe->execute(array(
                                                        "user_id"=>$user_id
                                                        )
                                                    );

                                                  $s2 = $selectsubscribe->fetch(PDO::FETCH_OBJ);
                                                  $subscribe = $s2->subscribe;
                                                  echo $subscribe;
                                                        ?>

                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="orange">
                                <i class="material-icons">dns</i>
                            </div>
                            <div class="card-content">
                                <p class="category">Nombre de participation</p>
                                <h4 class="card-title">

                                              <?php
                                                  $user_id = $_SESSION['user_id'];

                                                  $selectcountacti = $db->prepare("SELECT countactivite FROM users WHERE id = :user_id");
                                                  $selectcountacti->execute(array(
                                                      "user_id"=>$user_id
                                                      )
                                                  );

                                                $s = $selectcountacti->fetch(PDO::FETCH_OBJ);
                                                $countacti = $s->countactivite;
                                                echo $countacti;
                                                      ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header" data-background-color="red">
                                <i class="material-icons">assignment_late</i>
                            </div>
                            <div class="card-content">
                                <p class="category"> Date de fin d'adhésion</p>
                                <h4 class="card-title">2019-07-01</h4>
                            </div>
                        </div>
                    </div>
                </div>

                                <?php
                                $user_id = $_SESSION['user_id'];

                                $select = $db->prepare("SELECT * FROM products_transactions WHERE user_id = :user_id");
                                $select->execute(array(
                                    "user_id"=>$user_id
                                    )
                                );

                                while($s = $select->fetch(PDO::FETCH_OBJ)){
                                ?>

                <div class="media-footer">
                    <a href="my_seedbox.php" class="btn btn-primary btn-wd pull-right">Commande
                        <?php echo $s->product; ?>
                        <?php echo $s->status; ?>
                    </a>
                </div>

                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="blue">
                                <i class="material-icons">new_releases</i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Actualités</h4>
                                <div class="row">
                                    <blockquote>
                                        <p>

                                        <?php
                                        $user_id = $_SESSION['user_id'];
                                        $select = $db->prepare("SELECT DISTINCT * FROM actus WHERE date= (SELECT MAX(date) FROM actus)");
                                        $select->execute();

                                        while($s = $select->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                            <?php echo $s->description; ?>
                                             <?php
                                        }
                                        ?>

                                        </p>
                                        <small>
                                            Publié par

                                            <?php
                                           $select = $db->prepare("SELECT * FROM actus WHERE date= (SELECT MAX(date) FROM actus)");
                                           $select->execute();

                                           while($s = $select->fetch(PDO::FETCH_OBJ)){
                                            ?>
                                            <?php echo $s->auteur; ?>

                                          -    <?php echo $s->date; ?>
                                        </small>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?php } ?>



</body>

<?php
    require_once('includes/javascriptdashboard.php');
?>

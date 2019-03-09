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
			<ul class="nav">
<?php
$cat = $db->query("SELECT DISTINCT name, page, icon, hastag, ordre FROM admincat ORDER BY ordre");
while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
  $nom = $unecat->name;
  $souscat = $db->query("SELECT nomsouscat, slug FROM admincat WHERE name='$nom'");
  $nbsouscat = $souscat->rowCount();
  ?>
  <li

  <?php
  if($unecat->name == $nompage){
  ?>

  class="active">

  <?php }else{ ?>
  >
  <?php }
  if($nbsouscat > 1){ ?>
      <a data-toggle="collapse" href="#<?php echo $unecat->hastag ?>" <?php if($unecat->name == $nompage){ ?> aria-expanded="true" <?php } ?>>
                            <i class="material-icons"><?php echo $unecat->icon;?></i>
                            <p><?php echo $unecat->name;?>
                              <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse <?php if($unecat->name == $nompage){ ?>in<?php } ?>" id="<?php echo $unecat->hastag ?>">
                            <ul class="nav">
                              <?php
                              while($unesouscat = $souscat->fetch(PDO::FETCH_OBJ)){
                                ?>
                                <li
                                <?php
                                if($unesouscat->nomsouscat == $nomsouscat){
                                ?>

                                class="active">

                                <?php }else{ ?>
                                >
                              <?php } ?>
                                    <a href="<?php echo $unecat->page ?><?php echo $unesouscat->slug;?>"><?php echo $unesouscat->nomsouscat ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                        </div>
                    </li>

		<?php }else{ ?>

      <a href="<?php echo $unecat->page;?>">
          <i class="material-icons"><?php echo $unecat->icon;?></i>
          <p><?php echo $unecat->name;?></p>
      </a>
      </li>

    <?php } } ?>

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
							<button class="btn btn-round btn-white btn-fill btn-just-icon">
									<i class="material-icons visible-on-sidebar-regular">apps</i>
							</button>
					</div>
					<div class="navbar-header">
            <div class="navbar-brand text-center">
              <h3 class="title">Dashboard Administrateur - Association JAM</h3>
              </div>
					</div>
			</div>
	</nav>

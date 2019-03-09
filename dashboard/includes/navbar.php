<div class="sidebar" data-active-color="blue" data-background-color="black" data-image="https://www.nasa.gov/sites/default/files/styles/full_width_feature/public/thumbnails/image/worldfires-08232018.jpg">
  <div class="logo">
    <a href="https://jam-mdm.fr/" class="simple-text">JAM</a>
  </div>
  <div class="logo logo-mini">
    <a href="https://jam-mdm.fr/" class="simple-text">JAM</a>
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
    $cat = $db->query("SELECT * FROM dashboardcat ORDER BY ordre");
    while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
    ?><li <?php if($unecat->name == $nompage){ ?>class="active"> <?php }else{ ?>><?php }

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

    <?php }}else{ ?>

        <a href="<?php echo $unecat->page;?>">
          <i class="material-icons"><?php echo $unecat->icon;?></i>
          <p><?php echo $unecat->name;?></p>
        </a>
      </li>

    <?php }}

    $catparticipe = $db->query("SELECT * FROM catparticipe WHERE user_id=$user_id");
    while($uneparticipation = $catparticipe->fetch(PDO::FETCH_OBJ)){
      $nom = $uneparticipation->name;
      ?><li <?php if($nom == $nompage){ ?>class="active"> <?php }else{ ?>><?php } ?>
          <a href="<?php echo $uneparticipation->page;?>">
            <i class="material-icons"><?php echo $uneparticipation->icon;?></i>
            <p><?php echo $uneparticipation->name;?></p>
          </a>
        </li>
        <?php } ?>

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
          <font color="black">Dashboard Membre - Association JAM</font>
        </div>
			</div>
		</div>
	</nav>

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
$cat = $db->query("SELECT * FROM admincat");
while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
  ?>
  <li
  <?php
  if($unecat->name == $nompage){

  ?>
  class="active">
  <?php }else{ ?>
  >
<?php } ?>

      <a href="<?php echo $unecat->page;?>">
          <i class="material-icons"><?php echo $unecat->icon;?></i>
          <p><?php echo $unecat->name;?></p>
      </a>
      </li>

		<?php } ?>
    <li class="">
                        <a data-toggle="collapse" href="#componentsExamples" aria-expanded="true">
                            <i class="material-icons">apps</i>
                            <p>Components
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse in" id="componentsExamples">
                            <ul class="nav">
                                <li>
                                    <a href="?page=index&amp;table=pageindex">Buttons</a>
                                </li>
                            </ul>
                        </div>
                    </li>

            <li>
                <a href="https://jam-mdm.fr/">
                    <i class="material-icons">dns</i>
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
							<a class="navbar-brand" href="#"> Charts </a>
					</div>
					<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav navbar-right">
									<li>
											<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
													<i class="material-icons">dashboard</i>
													<p class="hidden-lg hidden-md">Dashboard</p>
											</a>
									</li>
									<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="material-icons">notifications</i>
													<span class="notification">5</span>
													<p class="hidden-lg hidden-md">
															Notifications
															<b class="caret"></b>
													</p>
											</a>
											<ul class="dropdown-menu">
													<li>
															<a href="#">Mike John responded to your email</a>
													</li>

											</ul>
									</li>
									<li>
											<a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
													<i class="material-icons">person</i>
													<p class="hidden-lg hidden-md">Profile</p>
											</a>
									</li>
									<li class="separator hidden-lg hidden-md"></li>
							</ul>
							<form class="navbar-form navbar-right" role="search">
									<div class="form-group form-search is-empty">
											<input type="text" class="form-control" placeholder="Search">
											<span class="material-input"></span>
									</div>
									<button type="submit" class="btn btn-white btn-round btn-just-icon">
											<i class="material-icons">search</i>
											<div class="ripple-container"></div>
									</button>
							</form>
					</div>
			</div>
	</nav>

<nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
	<div class="container">
		<div class="navbar-translate">
			<a class="navbar-brand" href="index.php" rel="tooltip">
				JAM
			</a>
			<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-bar top-bar"></span>
				<span class="navbar-toggler-bar middle-bar"></span>
				<span class="navbar-toggler-bar bottom-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
			<ul class="navbar-nav">
				<?php
				$cat = $db->query("SELECT DISTINCT name FROM sitecat");
				while($unecat = $cat->fetch(PDO::FETCH_OBJ)){
					$nom = $unecat->name
					?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
						<p><?php echo $nom ?></p>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
						<?php
						$souscat = $db->query("SELECT * FROM sitecat WHERE name = '$nom'");
						while($unesouscat = $souscat->fetch(PDO::FETCH_OBJ)){
						  ?>
						<a class="dropdown-item" href="<?php echo $unesouscat->page;?>">
						  <?php echo $unesouscat->surname ?>
						</a>
						<?php
								}
								?>
					</li>
						<?php
						  }
						if(!isset($_SESSION['user_id'])){
						?>
						<li class="nav-item">
	            <a class="nav-link" href="register.php">
	              <i class="now-ui-icons files_single-copy-04"></i>
	              <p>Inscription</p>
	            </a>
	          </li>
						<li class="nav-item">
	            <a class="nav-link" href="connect.php">
	              <i class="now-ui-icons users_single-02"></i>
	              <p>Se connecter</p>
	            </a>
	          </li>
						<?php }else{ ?>
						<li class="nav-item">
							<a class="nav-link" href="https://dashboard.jam-mdm.fr/">
								<i class="now-ui-icons users_circle-08"></i>
								<p>Mon Compte</p>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="disconnect.php">
								<i class="now-ui-icons arrows-1_share-66"></i>
								<p>Deconnexion</p>
							</a>
						</li>
						<?php } ?>
					</div>

			</ul>
		</div>
	</div>
</nav>

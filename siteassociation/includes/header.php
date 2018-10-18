<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
		<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
					</button>
					<a href="index.php" class="btn btn-rose btn-round">
							<i class="material-icons">polymer</i> SDEDIKOOL
						</a>

				</div>

				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">

						<li>
						<a href="index.php">
							<i class="material-icons">home_outline</i> Accueil
						</a>
					</li>

					<?php
													$sql = "SELECT DISTINCT name FROM category";
													$req = $db->query($sql);
													$req->setFetchMode(PDO::FETCH_ASSOC);

													foreach($req as $row)
													{
														?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="material-icons">video_label</i> <?php
												echo $row['name'];
												$name = echo $row['name'];
										?>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">







								<?php
								$select8 = $db->query("SELECT surname,slug FROM category WHERE name=$name");
								while($s8 = $select8->fetch(PDO::FETCH_OBJ)){
									?>
									<?php
									$test8 = $s8->name;
							?>
							<li>
								<a href="boutique.php?category=<?php echo $s8->slug;?>">
									<?php echo $test8 ?>
								</a>
							</li>
							<?php
								}
							?>
							</ul>
						</li>
					<?php } ?>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="material-icons">security</i> VPN
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<?php
								$select6 = $db->query("SELECT * FROM category WHERE name LIKE 'VPN%'");
								while($s6 = $select6->fetch(PDO::FETCH_OBJ)){
									?>
									<?php
									$test6 = substr($s6->name, 3);
							?>
							<li>
								<a href="boutiquestorevpn.php?category=<?php echo $s6->slug;?>">
									<?php echo $test6 ?>
								</a>
							</li>
							<?php
								}
							?>
							</ul>
						</li>
						<?php if(!isset($_SESSION['user_id'])){?>
					<li>
					<a href="register.php">
						<i class="material-icons">person_add</i> Inscription
					</a>
				</li>

				<li>
				<a href="connect.php">
					<i class="material-icons">account_circle</i> Se connecter
				</a>
				</li>
				<?php }else{ ?>
				<li>
					<a href="https://dashboard.sdedikool.me/">
						<i class="material-icons">supervisor_account</i> Mon Compte
					</a>
				</li>
				<li>
					<a href="disconnect.php">
						<i class="material-icons">power_off</i> Deconnexion
					</a>
				</li>
				<?php } ?>



				<li class="button-container">
					<a href="panier.php" class="btn btn-rose btn-round">
						<i class="material-icons">shopping_cart</i> Panier
					</a>
				</li>
					</ul>
				</div>
		</div>
	</nav>

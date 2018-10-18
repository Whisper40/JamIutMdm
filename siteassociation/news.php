<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8" />

  <meta name="Description" content="Association JAM ( Jeunesse Associative Montoise ) - Mont de Marsan">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr"> <!-- Mail Admin -->


  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>JAM - Actualitée et Informations</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<!-- Les CSS utilisés -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet" />

	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />
	</head>

<?php
	require_once('includes/head.php');

	if(isset($_GET['show'])){

		$product = htmlentities($_GET['show']);

		$select = $db->prepare("SELECT * FROM products WHERE slug='$product'");
		$select->execute();

		$s = $select->fetch(PDO::FETCH_OBJ);
		$containsProduct = false;
		if(isset($_SESSION['panier'])){
			for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
	     		if($_SESSION['panier']['slugProduit'][$i] == $s->slug){
	     			$containsProduct = true;
	     			break;
	     		}
	   		}
	   	}

		$description = $s->description;

		$description_finale=wordwrap($description,100,'<br />', false);

		?>

		<body class="product-page">

<?php
		require_once('includes/header.php');
 ?>

 <div class="page-header clear-filter" data-parallax="true" style="background-image: url('http://www.success-man.fr/wp-content/uploads/2014/01/dressing-homme.jpg');">
 </div>

		<div class="section section-gray">
				<div class="container">
							<div class="main main-raised main-product">
									<div class="row">
											<div class="col-md-6 col-sm-6">

												 <div class="tab-content">
															<div class="tab-pane active" id="product-page2">
																	 <img src="assets/img/<?php echo $s->slug; ?>.jpg"/>
															</div>
													</div>
											</div>
											<div class="col-md-6 col-sm-6">
							<h2 class="title"><?php echo $s->title; ?></h2>
							<h3 class="main-price"><?php echo $s->price; ?> €</h3>
							<div id="acordeon">
															<div class="panel-group" id="accordion">
														<div class="panel panel-border panel-default">
															<div class="panel-heading" role="tab" id="headingOne">
																			<h4 class="panel-title">
																			Description
																			<i class="material-icons">keyboard_arrow_down</i>
																			</h4>
															</div>
															<div id="collapseOne" class="panel-collapse collapse in">
																<div class="panel-body">
																	<p><?php echo $description_finale; ?></p>
																	<h5>Stock : <?php echo $s->stock; ?></h5>
																</div>
															</div>
														</div>
													</div>
													</div>
													</div>
													<div class="row text-right">
															<?php if(!$containsProduct){ if ($s->stock>0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->slug; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">
															<button class="btn btn-rose btn-round">Ajouter au panier &nbsp;<i class="material-icons">shopping_cart</i></button>
															</a><?php }else{echo'<h5 style="color:red;">Stock épuisé !</h5>';} } else{ ?><p style="color:green;">Produit déjà ajouté</p><?php } ?>
													</div>
											</div>
									</div>
							</div>
							</div>

		<?php

	}else{

	if(isset($_GET['category'])){

		$category_slug=$_GET['category'];
		$select = $db->query("SELECT name FROM category WHERE slug='$category_slug'");
		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->name);
		$select = $db->prepare("SELECT * FROM products WHERE category='$category'");
		$select->execute(); ?>

		<body class="ecommerce-page">

<?php
		require_once('includes/header.php');
?>



			<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('assets/img/imageserveur6.jpg');">
		<div class="container">
    		<div class="row">
        		<div class="col-md-8 col-md-offset-2">
                    <h1 class="title">50% SEEDBOX & 50% PLEX</h1>
                    <h4>Pour commencer vous devez choisir une offre parmit nos seedbox hebergées en France et celles hebergées en Allemagne.</h4>
                </div>
            </div>
        </div>
	</div>

	<div class="main main-raised">
		<div class="container">
            <div class="pricing-2">
    			<div class="row">
    				<div class="col-md-6 col-md-offset-3 text-center">
    					<ul class="nav nav-pills nav-pills-rose" role="tablist">
    						<li class="active">
    							<a href="https://sdedikool.me/boutique.php?category=seedbox-france"> France </a>
    						</li>
    						<li class="active">
    							<a href="https://sdedikool.me/boutique.php?category=seedbox-allemagne"> Allemagne </a>
    						</li>
    					</ul>
    				</div>
                </div>
                 <hr />
                <div class="row">


<?php
		while($s=$select->fetch(PDO::FETCH_OBJ)){


			$lenght=75;

			$description = $s->description;

			$new_description=substr($description,0,$lenght)."...";

			$description_finale=wordwrap($new_description,50,'<br />', false);


	$containsProduct = false;
			if(isset($_SESSION['panier'])){
				for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
	     			if($_SESSION['panier']['slugProduit'][$i] == $s->slug){
	     				$containsProduct = true;
	     				break;
	     			}
	   			}
	   		}
			?>






			<?php

		}
	?>




<!--     *********    TESTIMONIALS 2     *********      -->
		<div class="container">
			<div class="row">
				<div id="carousel-testimonial" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner " role="listbox">
<?php

		$category_slug=$_GET['category'];
		$select = $db->query("SELECT name FROM category WHERE slug='$category_slug'");
		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->name);
		$select = $db->prepare("SELECT * FROM products WHERE category='$category' AND price ='1'");
		$select->execute();


		while($s=$select->fetch(PDO::FETCH_OBJ)){




			$description = $s->description;
			$price = $s->price;
			$slug = $s->slug;
			$title = $s->title;

			$containsProduct = false;
					if(isset($_SESSION['panier'])){
						for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
			     			if($_SESSION['panier']['slugProduit'][$i] == $s->slug){
			     				$containsProduct = true;
			     				break;
			     			}
			   			}
			   		}

?>





						<div class="item active">
							<div class="card-content">
								<div class="col-md-6 col-md-offset-3">
									<div class="card card-pricing card-raised">
										<div class="card-content content-rose">
								<h6 class="category text-info"><?php echo $title; ?></h6>
						<h1 class="card-title"><small>€</small><?php echo $price; ?><small>/mois</small></h1>

								<ul>
								<li><b><?php echo $description; ?></b> Go HDD</li>
								<li><b>1 Gbit/s</b> UP/DOWN</li>
								<li><b>Torrents Illimités</b></li>
								<li><b>Sans Engagement</b> </li>
								<li><b>PLEX / Emby </b> </li>
							</ul>

								<div class="card-content">
									<a <?php if(!$containsProduct){ if ($s->stock>0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->slug; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>"><i class="material-icons" title="Ajouter au panier">add_shopping_cart</i></a><?php }else{echo'<a class="btn btn-rose btn-round">
							<i class="material-icons">remove_shopping_cart</i> Rupture de stock !
						</a>';} }else{echo'<a class="btn btn-rose btn-round">
							<i class="material-icons">remove_shopping_cart</i> Produit déja ajouté!
						</a>';} ?>
							</a>
									</div>
								</div>
							</div>
						</div>		</div>	</div>
					<?php

				}



		$category_slug=$_GET['category'];
		$select2 = $db->query("SELECT name FROM category WHERE slug='$category_slug'");
		$results2 = $select2->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results2->name);
		$select2 = $db->prepare("SELECT * FROM products WHERE category='$category' AND price <> '1'");
		$select2->execute();

		while($s2=$select2->fetch(PDO::FETCH_OBJ)){


			$lenght=75;

			$description2 = $s2->description;
			$price2 = $s2->price;
			$slug2 = $s2->slug;
			$title2 = $s2->title;


			$containsProduct = false;
					if(isset($_SESSION['panier'])){
						for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
			     			if($_SESSION['panier']['slugProduit'][$i] == $s2->slug){
			     				$containsProduct = true;
			     				break;
			     			}
			   			}
			   		}



?>
						<div class="item">
							<center>
							<div class="card-content">
								<div class="col-md-6 col-md-offset-3">
									<div class="card card-pricing card-raised">
										<div class="card-content content-rose">
								<h6 class="category text-info"><?php echo $title2;?></h6>
						<h1 class="card-title"><small>€</small><?php echo $price2; ?><small>/mois</small></h1>

								<ul>
								<li><b><?php echo $description2; ?></b> Go HDD</li>
								<li><b>1 Gbit/s</b> UP/DOWN</li>
								<li><b>Torrents Illimités</b></li>
								<li><b>Sans Engagement</b> </li>
								<li><b>PLEX / Emby </b> </li>
							</ul>

								<div class="card-content">
									<a <?php if(!$containsProduct){ if ($s2->stock>0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $slug2; ?>&amp;q=1&amp;p=<?php echo $price2; ?>"><i class="material-icons" title="Ajouter au panier">add_shopping_cart</i></a><?php }else{echo'<a class="btn btn-rose btn-round">
							<i class="material-icons">remove_shopping_cart</i> Rupture de stock !
						</a>';} }else{echo'<a class="btn btn-rose btn-round">
							<i class="material-icons">remove_shopping_cart</i> Produit déja ajouté!
						</a>';} ?>
							</a>
									</div>
								</div>
							</div>
						</div>		</div>	</div></center>


						<?php } ?>

					</div>

					<a class="left carousel-control" href="#carousel-testimonial" role="button" data-slide="prev">
						<i class="material-icons" aria-hidden="true">chevron_left</i>
					</a>
					<a class="right carousel-control" href="#carousel-testimonial" role="button" data-slide="next">
						<i class="material-icons" aria-hidden="true">chevron_right</i>
					</a>
				</div>
			</div>
		</div>


	<!--     *********    END TESTIMONIALS 2      *********      -->







































<div class="col-md-12">
					<div class="card card-pricing card-raised">
						<div class="card-content content-rose">
							<h6 class="category text-info">SKBOX PLATINIUM + Personnalisée</h6>
							<h3> Besoin de plus d'espace ? Cliquer sur le bouton ci-dessous !</h3>

							<a href="https://discord.gg/NzwGGwA" class="btn btn-success btn-raised btn-round">
								Nous Contacter sur Discord
							</a>
						</div>
					</div>
				</div>
</div>

</div>
</div><!-- section -->
<hr />

           <div class="features-2">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<h2 class="title">Les services inclus dans toutes les SKBOX</h2>
					<h5 class="description">Une seedbox est de nos jours très polyvalente. </br> C'est pourquoi  nous l'avons adapter aux besoins de nos colocataires.</h5>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
		           	<div class="info info-horizontal">
						<div class="icon icon-info">
							<i class="material-icons">phone_android</i>
						</div>
						<div class="description">
							<h4 class="info-title">Transdroid</h4>
							<p>Transdroid est l'application par excellence pour le controle de ruTorrent. <br> Elle vous permet l'ajout de torrent directement depuis votre smartphone Android </p>
							<a href="https://play.google.com/store/apps/details?id=org.transdroid.lite&hl=fr">Télécharger ici</a>
						</div>
		        	</div>

		        </div>

				<div class="col-md-4">
					<div class="info info-horizontal">
						<div class="icon icon-danger">
							<i class="material-icons">live_tv</i>
						</div>
						<div class="description">
							<h4 class="info-title">Streaming Plex / Emby</h4>
							<p>Plex / Emby est un lecteur vidéo directement intégré à votre SKBOX vous permettant de lire vos films, séries et musiques directement depuis votre seedbox et ceci en quelques secondes, sans même devoir les télécharger.</p>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="info info-horizontal">
						<div class="icon icon-success">
							<i class="material-icons">file_download</i>
						</div>
						<div class="description">
							<h4 class="info-title">CouchPotato</h4>
							<p>CouchPotato vous permet de télecharger automatiquement vos films et séries dans la meilleure qualité disponible dès leur sortie en torrent.</p>

						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="info info-horizontal">
						<div class="icon icon-success">
							<i class="material-icons"></i>
						</div>
						<div class="description">
							<h4 class="info-title">  </h4>
							<p>
							</p>

						</div>
					</div>
				</div>

<div class="col-md-4">
					<div class="info info-horizontal">
						<div class="icon icon-info">
							<i class="material-icons">cloud_upload</i>
						</div>
						<div class="description">
							<h4 class="info-title">Syncthing - Cloud</h4>
							<p>Syncthing vous permet de stocker vos données en sécuritée dans le Cloud.
							<br>Vous pouvez donc stocker directement vos photos sur votre SKBOX.
							</p>

						</div>
					</div>
				</div>

			<div class="col-md-4">
					<div class="info info-horizontal">
						<div class="icon icon-danger">
							<i class="material-icons">folder_shared</i>
						</div>
						<div class="description">
							<h4 class="info-title">Gestionnaire de Fichiers</h4>
							<p>Votre SKBOX dispose d'un gestionnaire de fichier directement intégré a ruTorrent vous permettant de partager des liens avec vos amis mais aussi de créer des fichiers .ZIP et plus encore..
							<br> Vous possédez aussi un accès FTP et SFTP inclus.</p>

						</div>
					</div>
				</div>
            <div class="col-md-4">
					<div class="info info-horizontal">
						<div class="icon icon-success">
							<i class="material-icons">supervisor_account</i>
						</div>
						<div class="description">
							<h4 class="info-title">Support Extrêment Réactif !</h4>
							<p>Notre support est motivé et à même de vous répondre de manière claire et précise en très peu de temps.
							<br> Nous apportons une réelle importance sur la relation support-colocataire et c'est pourquoi nous nous efforcons de vous permettre de nous contacter par différents moyens.</p>

						</div>
					</div>
				</div>



			</div>

	    </div>

    </div>





	<?php

}else{
	?>
	<br/><h1>Catégories :</h1>
	<?php
$select = $db->query("SELECT * FROM category WHERE name LIKE 'Seedbox%'");

while($s = $select->fetch(PDO::FETCH_OBJ)){

	?>

	<a href="?category=<?php echo $s->slug;?>"><h3><?php echo $s->name ?></h3></a>

	<?php

}
}
}
	require_once('tawk.php');
	require_once('includes/footer.php');

	require_once('includes/javascriptwithoutdashboard.php');
?>

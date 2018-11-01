<?php
require_once('includes/head.php');
require_once('includes/header.php');


	if(isset($_GET['show'])){

		$product = htmlentities($_GET['show']);

		$select = $db->prepare("SELECT * FROM activitesvoyages WHERE slug='$product'");
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

		<br/><div style="text-align:center;">
		<img src="assets/img/<?php echo $s->slug; ?>.jpg"/>
		<h1><?php echo $s->title; ?></h1>
		<h5><?php echo $description_finale; ?></h5>
		<h5>Stock : <?php echo $s->stock; ?></h5>
		<?php if(!$containsProduct){ if ($s->stock>0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->slug; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Ajouter au panier</a><?php }else{echo'<h5 style="color:red;">Stock épuisé !</h5>';} } else{ ?><p style="color:green;">Produit déjà ajouté</p><?php }
   		?>
		</div><br/>

		<?php

	}else{

	if(isset($_GET['category'])){

		$category_slug=$_GET['category'];
		$select = $db->query("SELECT surname FROM sitecat WHERE slug='$category_slug'");
		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->surname);
		$select = $db->prepare("SELECT * FROM activitesvoyages WHERE surname='$category'");
		$select->execute();

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
			<br/>
			<a href="?show=<?php echo $s->slug; ?>"><img src="assets/img/<?php echo $s->slug; ?>.jpg"/></a>
			<a href="?show=<?php echo $s->slug; ?>"><h2><?php echo $s->title;?></h2></a>
			<h5><?php echo $description_finale; ?></h5>
			<h4><?php echo $s->final_price; ?> €</h4>
			<h5>Places restantes : <?php echo $s->stock; ?></h5>
			<!-- Fonction contains à gercler une fois finis-->
			<?php if(!$containsProduct){ if ($s->stock>0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->slug; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Voir l'activité</a><?php }else{echo'<h5 style="color:red;">Stock épuisé !</h5>';} } else{ ?><p style="color:green;">Produit déjà ajouté</p><?php }
   		?>

			<br/><br/>

			<?php

		}
	?>

	<br/><br/><br/><br/>

	<?php

// Si la page n'a aucun paramètre alors on affiche celle-ci , ou alors on renvoie vers la page d'accueil..

}else{
	header('Location: https://jam-mdm.fr/');

}


}
	require_once('includes/footer.php');

?>

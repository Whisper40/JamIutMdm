<?php
require_once('includes/head.php');
require_once('includes/header.php');


	if(isset($_GET['showmethisactivity'])){
		$product = htmlentities($_GET['showmethisactivity']);
		$select = $db->prepare("SELECT * FROM activitesvoyages WHERE slug='$product'");
		$select->execute();
		$s = $select->fetch(PDO::FETCH_OBJ);

		$description = $s->description;
		$description2 = $s->description2;
		$description3 = $s->description3;
		$description_finale=wordwrap($description,100,'<br />', false); // False sert a dire si on découpe le mot ou non
		$description_finale2=wordwrap($description2,100,'<br />', false); // Le 100 sert au retour a la ligne
		$description_finale3=wordwrap($description3,100,'<br />', false);
		?>

		<br/><div style="text-align:center;">
		<img src="assets/img/<?php echo $s->slug; ?>.<?php echo $s->formatimg; ?>"/>
		<h1><?php echo $s->title; ?></h1>
		<h5><?php echo $description_finale; ?></h5>

		<h1><?php echo $s->title2; ?></h1>
		<h5><?php echo $description_finale2; ?></h5>

		<h1><?php echo $s->title3; ?></h1>
		<h5><?php echo $description_finale3; ?></h5>


		<h5>Places restantes : <?php echo $s->stock; ?></h5>
		<?php if ($s->stock>0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->slug; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Je Participe !</a><?php }else{echo'<h5 style="color:red;">Aucune place n\'est disponible !</h5>';}
   		?>
		</div><br/>

		<?php

	}else{

	if(isset($_GET['category'])){
		$category_slug=$_GET['category'];
		$select = $db->query("SELECT surname FROM sitecat WHERE slug='$category_slug'");
		$results = $select->fetch(PDO::FETCH_OBJ);
		$category = addslashes($results->surname);
		$select = $db->prepare("SELECT * FROM activitesvoyages WHERE surname='$category' AND status='ACTIVE'");
		$select->execute();

		while($s=$select->fetch(PDO::FETCH_OBJ)){

			$lenght=75;
			$description = $s->description;
			$new_description=substr($description,0,$lenght)."...";
			$description_finale=wordwrap($new_description,50,'<br />', false);



			?>
			<br/>
			<a href="?showmethisactivity=<?php echo $s->slug; ?>"><img src="assets/img/<?php echo $s->slug; ?>.<?php echo $s->formatimg; ?>"/></a>
			<a href="?showmethisactivity=<?php echo $s->slug; ?>"><h2><?php echo $s->title;?></h2></a>
			<h5><?php echo $description_finale; ?></h5>
			<h4><?php echo $s->final_price; ?> €</h4>
			<h5>Places restantes : <?php echo $s->stock; ?></h5>
			<!-- Fonction contains à gercler une fois finis-->
			<?php if ($s->stock>0){ ?><a href="?showmethisactivity=<?php echo $s->slug; ?>&amp;p=<?php echo $s->price; ?>">Voir l'activité</a><?php }else{echo'<h5 style="color:red;">Aucune place n\'est disponible !</h5>';}
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

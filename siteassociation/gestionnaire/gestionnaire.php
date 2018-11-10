<?php
	error_reporting(0);
	session_start();
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Rt & Co - Costumes sur mesure</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/material-kit.css?v=1.1.0" rel="stylesheet"/>

</head>

	<body class="ecommerce-page">
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('https://www.gqmagazine.fr/uploads/images/thumbs/201509/0d/james_bond_doit_il_porter_le_costume_trois_pi__ces___3458.jpeg_north_1200x_white.jpg');">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="brand">
							<h1 class="title">Page Gestionnaire</h1>

						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="main main-raised">


				 <div class="section">
						 <div class="container">
				 <div class="row">
					 <div class="col-md-12">
						 <div class="card card-refine card-plain">
							 <div class="card-content">


													 <div class="row">
				 	                    <div class="col-md-13">

						<br>
								<table class="container" style="width: 675px">
																			<tbody>
								<tr>

									<td><center>
										<a href="?action=modifyorder" class="btn btn-rose btn-round">
											Voir les commandes en cours
										</a></center>
									</td>


									<td><center>
										<a href="?action=modifyseedbox" class="btn btn-rose btn-round">
											Gerer les seedbox
										</a></center>
									</td>


									<td><center>
										<a href="disconnect.php" class="btn btn-rose btn-round">
											Déconnexion
										</a></center>
									</td>

								</tr>
								</tbody>
								</table>
								</div>


				 	                    </div>
					 	                </div>


							 </div>
						 </div>
					 </div>
					 <div class="col-md-12">

<?php
	function slugify($text){
		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

		$text = preg_replace('~[^-\w]+~', '', $text);

		$text = trim($text, '-');

		$text = preg_replace('~-+~', '-', $text);

		$text = strtolower($text);

		if (empty($text)) {
		  return 'n-a';
		}

  		return $text;
	}

	try{

		$db = new PDO('mysql:host=127.0.0.1;dbname=boutique', 'root','Kevinperez40390');
		$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
		$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
		$db->exec('SET NAMES utf8');
	}

	catch(Exception $e){

		die('Une erreur est survenue');

	}

	if(isset($_SESSION['username'])){

		if(isset($_GET['action'])){
				if($_GET['action']=='modifyorder'){
								?>
                <center><h2>Commandes en cours</h2></center>
				<?php
								$select = $db->prepare("SELECT * FROM products_transactions");
								$select->execute();

?>

<div class="section">
<table class="container" style="width: 1200px">
		<thead>
				<tr>

				<th>Numéro Commande</th>
						<th>Produit</th>
						<th>Quantité</th>
						<th>Statut</th>
						<th></th>
						<th></th>
						<th></th>


		 </tr>
							</thead>
							<tbody>

								<?php

								while($s=$select->fetch(PDO::FETCH_OBJ)){
									?>
		                                <tr>
                        <td><?php echo $s->transaction_id;?></td>
								        <td><?php echo $s->product;?></td>
								        <td><?php echo $s->quantity;?></td>
								        <td><?php echo $s->status;?></td>
		                                    <td><div class="col-sm-10">
                        <a href="?action=delete_order&amp;id=<?php echo $s->id; ?>">
                            <button type="button" class="btn btn-primary btn-block">Supprimer</button></a>
	        			</div></td>
                                            <td><div class="col-sm-10">
                        <a href="?action=activate_order&amp;id=<?php echo $s->id; ?>">
                            <button type="button" class="btn btn-primary btn-block">Activer</button></a>
	        			</div></td>
                                            <td><div class="col-sm-10">
                        <a href="?action=desactivate_order&amp;id=<?php echo $s->id; ?>">
                            <button type="button" class="btn btn-primary btn-block">Désactiver</button></a>
	        			</div></td>
                                        </tr>

					<?php

				}
				?>

			</tbody>
						</table>

						</div>

						<?php

			}else if($_GET['action']=='delete_order'){

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM products_transactions WHERE id=$id");
				$delete->execute();

				header('Location: gestionnaire.php?action=modifyorder');



}
//NOUVEAU 05/06/2018

	else if($_GET['action']=='activate_order'){
				$id=$_GET['id'];
				$update = $db->query("UPDATE products_transactions SET status='Validée' WHERE id='$id'");
				$update->execute();
				header('Location: gestionnaire.php?action=modifyorder');

}

//NOUVEAU 05/06/2018
else if($_GET['action']=='desactivate_order'){
				$id=$_GET['id'];
				$update = $db->query("UPDATE products_transactions SET status='Non Validée' WHERE id='$id'");
				$update->execute();
				header('Location: gestionnaire.php?action=modifyorder');

			}else{

				die('Une erreur s\'est produite.');

			}

		}else{

		}

	}else{

		header('Location: ../index.php');
	}
?>
</div>
</div>
</div>
</div>



<footer class="footer">
			 <div class="container">
					 <div class="copyright pull-center">
							 Copyright &copy; <script>document.write(new Date().getFullYear())</script> Réseau et Télécommunication - Mont de Marsan - 2018
					 </div>
			 </div>
	 </footer>

</body>

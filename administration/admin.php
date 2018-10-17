<?php
	error_reporting(0);
	session_start();

	try{

	$db = new PDO('mysql:host=127.0.0.1;dbname=siteassociation', 'admin','ENTRERVOTREMDP');
	$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
	$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
	$db->exec('SET NAMES utf8');
}

catch(Exception $e){

	die('Veuillez vérifier la connexion à la base de données');

}
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

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/material-kit.css?v=1.1.0" rel="stylesheet"/>

</head>

	<body class="ecommerce-page">
		<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url('https://images-assets.nasa.gov/image/PIA04921/PIA04921~large.jpg');">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="brand">
							<h1 class="title">Page Administrateur</h1>

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
																<table class="container" style="width: 1025px">
																											<tbody>
												<tr>
													<td>
														<a href="?action=add" class="btn btn-rose btn-round">
															Ajouter un produit
														</a>
								</td>
								<td>
									<a href="?action=modifyanddelete" class="btn btn-rose btn-round">
										Mod/sup un produit
									</a>
								</td>
								<td>
									<a href="?action=modifyanddeleteseedbox" class="btn btn-rose btn-round">
										Mod/sup une seedbox
									</a>
								</td>

								<td>
									<a href="?action=modifyanddeletevpn" class="btn btn-rose btn-round">
										Mod/sup un VPN
									</a>
								</td>

								<td>
									<a href="?action=add_category" class="btn btn-rose btn-round">
										Ajouter une catégorie
									</a>
								</td>
								<td>
									<a href="?action=modifyanddelete_category" class="btn btn-rose btn-round">
										Mod/sup une catégorie
									</a>
								</td>
								<td>
									<a href="?action=modifyandadd_user" class="btn btn-rose btn-round">
										Ajouter utilisateur
									</a>
								</td>
								</tr>
							</tbody>
						</table>
						<br>
								<table class="container" style="width: 600px">
																			<tbody>
								<tr>
									<td><center>
										<a href="?action=modifyanddelete_user" class="btn btn-rose btn-round">
											Supprimer utilisateurs
										</a></center>
									</td>

									<td><center>
										<a href="?action=modifyanddelete_quotas" class="btn btn-rose btn-round">
											Check Quotas
										</a></center>
									</td>

									<td><center>
										<a href="?action=options" class="btn btn-rose btn-round">
											Modifier les Options
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

			if($_GET['action']=='add'){

				if(isset($_POST['submit'])){

					$stock = $_POST['stock'];
					$title= addslashes($_POST['title']);
					$slug = slugify($title);
					$description= addslashes($_POST['description']);
					$price=$_POST['price'];

					$img = $_FILES['img']['name'];

					$img_tmp = $_FILES['img']['tmp_name'];

					if(!empty($img_tmp)){

						$image = explode('.',$img);

						$image_ext = end($image);

						if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){

							echo'Veuillez rentrer une image ayant pour extension : png, jpg ou jpeg';

						}else{

							$image_size = getimagesize($img_tmp);

							if($image_size['mime']=='image/jpeg'){

								$image_src = imagecreatefromjpeg($img_tmp);

							}else if($image_size['mime']=='image/png'){

								$image_src = imagecreatefrompng($img_tmp);

							}else{

								$image_src = false;
								echo'Veuillez rentrer une image valide';

							}

							if($image_src!==false){

								$image_width=300;

								if($image_size[0]==$image_width){

									$image_finale = $image_src;

								}else{

									$new_width[0]=$image_width;

									$new_height[1] = 300;

									$image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);

									imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);

								}

								imagejpeg($image_finale,'../assets/img/'.$slug.'.jpg');

							}

						}

					}else{

						echo'Veuillez rentrer une image';

					}

					if($title&&$description&&$price&&$stock){

						$category=$_POST['category'];


						$weight=$_POST['weight'];

						$select = $db->query("SELECT price FROM weights WHERE name='$weight'");

						$s = $select->fetch(PDO::FETCH_OBJ);

						$shipping = $s->price;

						$old_price = $price;

						$Final_price = $old_price + $shipping;

						$select=$db->query("SELECT tva FROM products");

						$s1=$select->fetch(PDO::FETCH_OBJ);

						if($s1){

							$tva = $s1->tva;

						}else{
							$tva = 20;
						}

						$final_price_1 = $Final_price+$Final_price*$tva/100;

						$insert = $db->query("INSERT INTO products (title,slug,description,price,category,weight,shipping,tva,final_price,stock) VALUES('$title','$slug','$description','$price','$category','$weight','$shipping','$tva','$final_price_1','$stock')");

						header('Location: admin.php?action=modifyanddelete');

					}else{

						echo'<div class="alert alert-warning">
						 <div class="alert-icon">
							<i class="material-icons">warning</i>
						</div>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="material-icons">clear</i></span>
						</button><center>
										 <b>Attention Alert :</b> Merci de remplir tout les champs</center>
						</div>';

					}

				}

			?> 						<center><h2>Ajouter un produit</h2></center>
							<div class="section">

								<table class="container" style="width: 800px">
																			<tbody>
			<form action="" method="post" enctype="multipart/form-data">
				<tr>
					<td>
<div class="form-group label-floating">
	<label style="font-size: 15px;" class="control-label">Titre du produit</label>
	<input type="text" class="form-control" name="title" size="10">
</div>
</td>
</tr>
<tr>
	<td>
							<div class="form-group label-floating">
	<label style="font-size: 15px;" class="control-label">Description du produit</label>
	<textarea rows="5" class="form-control" name="description"></textarea>
</div>
</td>
</tr>
<tr>
	<td>
		<div class="form-group label-floating">
	<label style="font-size: 15px;" class="control-label">Prix</label>
	<input type="text" class="form-control" name="price">
</div>
</td>
</tr>
<tr>
	<td>
		<table class="container" style="width: 750px">
			<tbody>
				<tr>
					<td>
		<span class="btn btn-raised btn-rose btn-round btn-default btn-file">
			<span class="fileinput-new">Choisir Photo</span>

			<input type="file" name="img" /></span>
			</td>
			<td>
			<select title="Single Select" class="btn btn-primary btn-block btn-round" name="category" style="width: 200px" value="Selection de la categorie">

				<?php $select=$db->query("SELECT * FROM category");

					while($s = $select->fetch(PDO::FETCH_OBJ)){

						?>

						<option><?php echo $s->name; ?></option>

						<?php

					}

				 ?>

				</select>
			</td>
			<td>

				<select class="btn btn-primary btn-block btn-round" name="weight" value="Selection du poids">
				<?php

					$select=$db->query("SELECT * FROM weights");

					while($s = $select->fetch(PDO::FETCH_OBJ)){

						?>

						<option><?php echo $s->name; ?></option>

						<?php

					}

				 ?>
				</select>
			</td>
	</tbody>
</table>
<tr>
	<td>

				<div class="form-group label-floating">
					<label style="font-size: 15px;" class="control-label">Stock</label>
				<input type="text" name="stock" class="form-control">
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<button type="submit" name="submit" class="btn btn-primary btn-block">
					Envoyer
				</button>
			</td>
		</tr>
				</form>
		</tbody>
	</table>
</div>

			<?php

			}else if($_GET['action']=='modifyanddelete'){

				$select = $db->prepare("SELECT * FROM products");
				$select->execute();
?>

<center><h2>Supprimer un produit</h2></center>
									<div class="section">
										<table class="container" style="width: 1550px">
																<thead>
																		<tr>

																		<th>Nom du produit</th>
																		<th></th>
																				<th></th>

																 </tr>
																					</thead>
																					<tbody>
<?php
				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>
							                                <tr>
							                                    <td><?php echo $s->title; ?></td>
							                                    <td><div class="col-sm-4">
																	<a href="?action=modify&amp;id=<?php echo $s->id; ?>">
						        			<button type="button" class="btn btn-primary btn-block">Modifier</button>
													</a>
													</div></td>
					                                            <td><div class="col-sm-4">
																<a href="?action=delete&amp;id=<?php echo $s->id; ?>">
						        			<button type="button" class="btn btn-primary btn-block">Supprimer</button>
													</a>
													</div></td>
							                                </tr>
						<?php

				}
				?>

			</tbody>
	</table>

	</div>

				<?php

			}else if($_GET['action']=='modify'){

				$id=$_GET['id'];

				$select = $db->prepare("SELECT * FROM products WHERE id=$id");
				$select->execute();

				$data = $select->fetch(PDO::FETCH_OBJ);

				?>

				<center><h2>Modifier un produit</h3></center>
					<div class="section">
						<table class="container" style="width: 800px">
							<form action="" method="post">
								<tr>
									<td>
	<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Titre du produit</label>
		<input value="<?php echo $data->title; ?>" type="text" name="title" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

	<div class="form-group label-floating">
<label style="font-size: 15px;" class="control-label">Description du produit</label>
<textarea rows="5" class="form-control" name="description"><?php echo $data->description; ?></textarea>
</div>
</tr>
</td>
<tr>
<td>
								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Prix</label>
		<input value="<?php echo $data->price; ?>" type="text" name="price" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Stock</label>
		<input type="text" value="<?php echo $data->stock; ?>" name="stock" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>
	<button type="submit" name="submit" class="btn btn-primary btn-block">
		Modifier
	</button>
	</tr>
	</td>
</div>
    </form>
  </table></div>

				<?php

				if(isset($_POST['submit'])){

					$stock = $_POST['stock'];
					$title=$_POST['title'];
					$description=$_POST['description'];
					$price=$_POST['price'];

					$update = $db->prepare("UPDATE products SET title='$title',description='$description',price='$price',stock='$stock' WHERE id=$id");
					$update->execute();

					header('Location: admin.php?action=modifyanddelete');

				}

			}else if($_GET['action']=='delete'){

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM products WHERE id=$id");
				$delete->execute();
				header('Location: admin.php?action=modifyanddelete');






















}else if($_GET['action']=='modifyanddeleteseedbox'){

				$select = $db->prepare("SELECT * FROM seedbox ORDER BY date DESC");
				$select->execute();
?>

<center><h2>Supprimer une commande</h2></center>
									<div class="section">
										<table class="container" style="width: 1550px">
																<thead>
																		<tr>

																		<th>Nom du produit</th>
																		<th>User_id</th>
																		<th>Date</th>

																 </tr>
																					</thead>
																					<tbody>
<?php
				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>
							                                <tr>
							                                    <td><?php echo $s->product; ?></td>
																<td><?php echo $s->user_id; ?></td>
																<td><?php echo $s->date; ?></td>
							                                    <td><div class="col-sm-4">
																	<a href="?action=modifyseedbox&amp;id=<?php echo $s->id; ?>">
						        			<button type="button" class="btn btn-primary btn-block">Modifier</button>
													</a>
													</div></td>
					                                            <td><div class="col-sm-4">
																<a href="?action=deleteseedbox&amp;id=<?php echo $s->id; ?>">
						        			<button type="button" class="btn btn-primary btn-block">Supprimer</button>
													</a>
													</div></td>
							                                </tr>
						<?php

				}
				?>

			</tbody>
	</table>

	</div>

				<?php

			}else if($_GET['action']=='modifyseedbox'){

				$id=$_GET['id'];

				$select = $db->prepare("SELECT * FROM seedbox WHERE id=$id");
				$select->execute();

				$data = $select->fetch(PDO::FETCH_OBJ);

				?>

				<center><h2>Modifier une commande</h3></center>
					<div class="section">
						<table class="container" style="width: 800px">
							<form action="" method="post">
								<tr>
									<td>
	<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Date de commande</label>
		<input value="<?php echo $data->date; ?>" type="text" name="date" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

	<div class="form-group label-floating">
<label style="font-size: 15px;" class="control-label">Identifiant</label>
<input value="<?php echo $data->identifiant; ?>" type="text" name="identifiant" class="form-control">
</div>
</tr>
</td>
<tr>
<td>
								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Password</label>
		<input value="<?php echo $data->password; ?>" type="text" name="password" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Serveur</label>
		<input type="text" value="<?php echo $data->serveur; ?>" name="serveur" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>
	<button type="submit" name="submit" class="btn btn-primary btn-block">
		Modifier
	</button>
	</tr>
	</td>
</div>
    </form>
  </table></div>

				<?php

				if(isset($_POST['submit'])){

					$date = $_POST['date'];
					$identifiant = $_POST['identifiant'];
					$password = $_POST['password'];
					$serveur =$_POST['serveur'];

					$update = $db->prepare("UPDATE seedbox SET date='$date',identifiant='$identifiant',password='$password',serveur='$serveur' WHERE id=$id");
					$update->execute();

					//Envoie mail modif Commande
					$selectuser_id = $db->query("SELECT * FROM seedbox where id=$id");
					$r10 = $selectuser_id->fetch(PDO::FETCH_OBJ);
					$user_id = $r10->user_id;
					$select39 = $db->query("SELECT * FROM users WHERE id='$user_id'");
		 		 $r9 = $select39->fetch(PDO::FETCH_OBJ);
		 		 $solde = $r9->solde;
		 		 $emailclient = $r9->email;
		 		 $usernameclient = $r9->username;


				 $owner_mail = $emailclient;
				 $nom = $usernameclient;
		         $header="MIME-Version: 1.0\r\n";
		         $header.='From:"SdediKool - Seedbox & VPN"<admin@Jam-mdm.fr>'."\n";
		         $header.='Content-Type:text/html; charset="utf-8"'."\n";
		         $header.='Content-Transfer-Encoding: 8bit';
		         $message = '
		        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>  <title></title>  <!--[if !mso]><!-- -->  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style><!--[if !mso]><!--><style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style><!--<![endif]--><!--[if mso]><xml>  <o:OfficeDocumentSettings>    <o:AllowPNG/>    <o:PixelsPerInch>96</o:PixelsPerInch>  </o:OfficeDocumentSettings></xml><![endif]--><!--[if lte mso 11]><style type="text/css">  .outlook-group-fix {    width:100% !important;  }</style><![endif]--><!--[if !mso]><!-->    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style>  <!--<![endif]--><style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-100 { width:100%!important; }.mj-column-per-33 { width:33.333333%!important; }  }</style></head><body style="background: #ffffff;">    <div class="mj-container" style="background-color:#ffffff;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:600px;">      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0"><tbody><tr><td style="width:600px;"><img alt="" title="" height="auto" src="https://topolio.s3-eu-west-1.amazonaws.com/uploads/5b744c37c09ba/1534361163.jpg" style="border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;" width="600"></td></tr></tbody></table></td></tr><tr><td style="word-wrap:break-word;font-size:0px;padding:4px 19px 4px 19px;" align="center"><div style="cursor:auto;color:#1BA7B5;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;"><h1 style="font-family: &apos;Cabin&apos;, sans-serif; line-height: 100%;"><span style="font-size:20px;"><u>SdediKool -&#xA0;Seedbox &amp; VPN</u></span></h1></div></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]-->      <!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:600px;">      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;"><p><span style="font-size:14px;">Bonjour '.$usernameclient.'</span></p><p><span style="font-size: 14px;">Nous venons de recevoir votre commande concernant l&apos;ajout de nouveaux services.</span></p><p><span style="font-size: 14px;">Votre solde &#xE0; &#xE9;t&#xE9; cr&#xE9;dit&#xE9; du montant command&#xE9; et sera d&#xE9;bit&#xE9; dans la journ&#xE9;e.</span></p><p><span style="font-size: 14px;">Votre solde est actuellement de '.$solde.' &#x20AC;</span></p><p></p><p><span style="font-size: 14px;">Vous recevrez un nouveau mail vous indiquant l&apos;activation de vos services.</span></p><p><span style="font-size: 14px;">Une fois ce mail re&#xE7;u, vos acc&#xE8;s seront disponibles dans votre dashboard rubrique &quot;service&quot;.</span></p><p></p><p><span style="font-size: 14px;">Une question sur une facture ? </span></p><p><span style="font-size: 14px;">Nous vous prions de regarder votre espace banque avant de nous contacter.</span></p><p></p><p><span style="font-size: 14px;">Merci et &#xE0; bientot sur Jam-mdm.fr !</span></p><p></p><p><span style="font-size:12px;">Ceci est un email automatique, merci de ne pas y r&#xE9;pondre dans le cas ou aucune erreur n&apos;a eut lieu.</span></p><p></p><p></p></div></td></tr><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"><p style="font-size:1px;margin:0px auto;border-top:1px solid #000;width:100%;"></p><!--[if mso | IE]><table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0px auto;border-top:1px solid #000;width:100%;" width="600"><tr><td style="height:0;line-height:0;"> </td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]-->      <!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:198px;">      <![endif]--><div class="mj-column-per-33 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px 10px 25px;padding-top:10px;padding-left:25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0"><tbody><tr><td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#009bdd"><a href="https://Jam-mdm.fr/" style="text-decoration:none;background:#009bdd;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:16px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Boutique</a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>      </td><td style="vertical-align:top;width:198px;">      <![endif]--><div class="mj-column-per-33 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px 10px 25px;padding-top:10px;padding-left:25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0"><tbody><tr><td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#009bdd"><a href="https://Jam-mdm.fr/dashboard.php" style="text-decoration:none;background:#009bdd;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:16px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Dashboard</a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>      </td><td style="vertical-align:top;width:198px;">      <![endif]--><div class="mj-column-per-33 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px 10px 25px;padding-top:10px;padding-left:25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0"><tbody><tr><td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#009bdd"><a href="https://Jam-mdm.fr/my_bank.php" style="text-decoration:none;background:#009bdd;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:16px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Banque</a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]-->      <!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:600px;">      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="center"><div><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="undefined"><tr><td>      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="float:none;display:inline-table;" align="center" border="0"><tbody><tr><td style="padding:4px;vertical-align:middle;"><table role="presentation" cellpadding="0" cellspacing="0" style="background:none;border-radius:3px;width:35px;" border="0"><tbody><tr><td style="vertical-align:middle;width:35px;height:35px;"><a href="https://www.twitter.com/PROFILE"><img alt="twitter" height="35" src="https://s3-eu-west-1.amazonaws.com/ecomail-assets/editor/social-icos/rounded/twitter.png" style="display:block;border-radius:3px;" width="35"></a></td></tr></tbody></table></td><td style="padding:4px 4px 4px 0;vertical-align:middle;"><a href="https://www.twitter.com/PROFILE" style="text-decoration:none;text-align:left;display:block;color:#333333;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;border-radius:3px;"></a></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]--></div></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]--></div></body></html>
		         ';
		         mail($owner_mail, "Livraison - Jam-mdm.fr", $message, $header);





?>

<div class="container">
								<div class="row">
					<div class="alert alert-success">
					 <div class="alert-icon">
						<i class="material-icons">error_outline</i>
					</div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="material-icons">clear</i></span>
					</button><center>
	                 <b>Succès:</b> Commande modifiée !</center>
	        </div>
					</div>
					</div>

					<?php



				}

			}else if($_GET['action']=='deleteseedbox'){

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM seedbox WHERE id=$id");
				$delete->execute();


			}


























else if($_GET['action']=='modifyanddeletevpn'){

				$select = $db->prepare("SELECT * FROM VPN ORDER BY date DESC");
				$select->execute();
?>

<center><h2>Supprimer une commande</h2></center>
									<div class="section">
										<table class="container" style="width: 1550px">
																<thead>
																		<tr>

																		<th>Nom du produit</th>
																		<th>User_id</th>
																		<th>Date</th>
																		<th>Identifiant</th>

																 </tr>
																					</thead>
																					<tbody>
<?php
				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>
							                                <tr>
							                                    <td><?php echo $s->product; ?></td>
																<td><?php echo $s->user_id; ?></td>
																<td><?php echo $s->date; ?></td>
																<td><?php echo $s->identifiant; ?></td>
							                                    <td><div class="col-sm-4">
																	<a href="?action=modifyvpn&amp;id=<?php echo $s->id; ?>">
						        			<button type="button" class="btn btn-primary btn-block">Modifier</button>
													</a>
													</div></td>
					                                            <td><div class="col-sm-4">
																<a href="?action=deletevpn&amp;id=<?php echo $s->id; ?>">
						        			<button type="button" class="btn btn-primary btn-block">Supprimer</button>
													</a>
													</div></td>
							                                </tr>
						<?php

				}
				?>

			</tbody>
	</table>

	</div>

				<?php

			}else if($_GET['action']=='modifyvpn'){

				$id=$_GET['id'];

				$select = $db->prepare("SELECT * FROM VPN WHERE id=$id");
				$select->execute();

				$data = $select->fetch(PDO::FETCH_OBJ);

				?>

				<center><h2>Modifier une commande</h3></center>
					<div class="section">
						<table class="container" style="width: 800px">
							<form action="" method="post">
								<tr>
									<td>
	<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Date de commande</label>
		<input value="<?php echo $data->date; ?>" type="text" name="date" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

	<div class="form-group label-floating">
<label style="font-size: 15px;" class="control-label">Identifiant</label>
<input value="<?php echo $data->identifiant; ?>" type="text" name="identifiant" class="form-control">
</div>
</tr>
</td>
<tr>
<td>
								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Password</label>
		<input value="<?php echo $data->password; ?>" type="text" name="password" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Serveur</label>
		<input type="text" value="<?php echo $data->serveur; ?>" name="serveur" class="form-control">
	</div>
</tr>
</td>


<tr>
<td>

								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Source du fichier VPN (assets/img/<?php echo $data->user_id; ?>.zip)</label>
		<input type="text" value="<?php echo $data->fichier; ?>" name="fichier" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>
	<button type="submit" name="submit" class="btn btn-primary btn-block">
		Modifier
	</button>
	</tr>
	</td>
</div>
    </form>
  </table></div>

				<?php

				if(isset($_POST['submit'])){

					$date = $_POST['date'];
					$identifiant = $_POST['identifiant'];
					$password = $_POST['password'];
					$serveur = $_POST['serveur'];
					$fichier = $_POST['fichier'];

					$update = $db->prepare("UPDATE vpn SET date='$date',identifiant='$identifiant',password='$password',serveur='$serveur', fichier='$fichier' WHERE id=$id");
					$update->execute();

?>

<div class="container">
								<div class="row">
					<div class="alert alert-success">
					 <div class="alert-icon">
						<i class="material-icons">error_outline</i>
					</div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="material-icons">clear</i></span>
					</button><center>
	                 <b>Succès:</b> Commande modifiée !</center>
	        </div>
					</div>
					</div>

					<?php



				}

			}else if($_GET['action']=='deletevpn'){

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM vpn WHERE id=$id");
				$delete->execute();


			}







































			else if($_GET['action']=='add_category'){

				if(isset($_POST['submit'])){

					$name = addslashes($_POST['name']);
					$slug = slugify($name);

					if($name){

						$insert = $db->prepare("INSERT INTO category (name,slug) VALUES('$name','$slug')");
						$insert->execute();


					}else{

						echo'<div class="alert alert-warning">
						 <div class="alert-icon">
							<i class="material-icons">warning</i>
						</div>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="material-icons">clear</i></span>
						</button><center>
										 <b>Attention Alert :</b> Merci de remplir tout les champs</center>
						</div>';

					}

				}

				?>


				<center><h2>Ajouter une catégorie</h2></center>
					<div class="section">
				<table class="container" style="width: 800px">
					<form action="" method="post">
						<tr>
							<td>
	<div class="form-group label-floating">
		<label class="control-label" style="font-size: 15px;" >Titre de la catégorie</label>
		<input type="text" name="name" class="form-control">
	</div>
</tr>
</td>
<tr>
	<td>
		<button type="submit" name="submit" class="btn btn-primary btn-block">Ajouter</button>
	</tr>
	</td>
</div>
						</form>
					</table></div>
				<?php


			}else if($_GET['action']=='modifyanddelete_category'){

				$select = $db->prepare("SELECT * FROM category");
				$select->execute();

?>

<center><h2>Supprimer / Modifier une catégorie</h2></center>
        <div class="section">
		      <table class="container" style="width: 1450px">
                      <thead>
                          <tr>

		                      <th>Nom de la catégorie</th>


		                   </tr>
		                            </thead>
		                            <tbody>

<?php

				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>
					<tr>
							<td><?php echo $s->name; ?></td>
							<td><div class="col-sm-5">
<a href="?action=modify_category&amp;id=<?php echo $s->id; ?>">
<button type="button" class="btn btn-primary btn-block">Modifier</button></a>
</div></td>
									<td><div class="col-sm-5">
<a href="?action=delete_category&amp;id=<?php echo $s->id; ?>">
<button type="button" class="btn btn-primary btn-block">Supprimer</button></a>
</div></td>
					</tr>
					<?php

				} ?>

			</tbody>
	</table>

	</div>

	<?php

			}else if($_GET['action']=='modify_category'){

				$id=$_GET['id'];

				$select = $db->prepare("SELECT * FROM category WHERE id=$id");
				$select->execute();

				$data = $select->fetch(PDO::FETCH_OBJ);

				?>
				<center><h2>Modifier une catégorie</h2></center>
				<div class="section">
				<table class="container" style="width: 800px">
				<form action="" method="post">
					<tr>
						<td>
							<div class="form-group label-floating">
								<label style="font-size: 15px;" class="control-label">Titre de la catégorie</label>
								<input type="text" class="form-control" value="<?php echo $data->name; ?>" name="name">
							</div>
						</div>
						</tr>
						</td>
						<tr>
						<td>
	        			<button type="submit" class="btn btn-primary btn-block" name="submit">Modifier</button>
							</tr>
							</td>
							</div>
							    </form>
							  </table></div>


				<?php

				if(isset($_POST['submit'])){

					$name=$_POST['name'];

					$select = $db->query("SELECT name FROM category WHERE id='$id'");

					$result = $select->fetch(PDO::FETCH_OBJ);

					$update = $db->prepare("UPDATE category SET name='$name' WHERE id=$id");
					$update->execute();

					$id = $_GET['id'];

					$update = $db->query("UPDATE products SET category='$name' WHERE category='$result->name'");

					header('Location: admin.php?action=modifyanddelete_category');
				}

			}else if($_GET['action']=='delete_category'){

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM category WHERE id=$id");
				$delete->execute();

				header('Location: admin.php?action=modifyanddelete_category');



				}else if($_GET['action']=='modifyanddelete_user'){

				$select = $db->prepare("SELECT * FROM users");
				$select->execute();

?>
<center><h2>Supprimer un utilisateur</h2></center>
        <div class="section">
		      <table class="container" style="width: 1500px">
                      <thead>
                          <tr>

		                      <th>Nom</th>


		                   </tr>
		                            </thead>
		                            <tbody>
<?php


				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>

					<tr>
							<td><?php echo $s->username; ?></td>

									<td><div class="col-sm-4">
					<a href="?action=delete_user&amp;id=<?php echo $s->id; ?>">
					<button type="button" class="btn btn-primary btn-block">Supprimer</button></a>
					</div></td>
					</tr>

					<?php

				}
				?>

			</tbody>
	</table>

	</div>

	<?php



			}else if($_GET['action']=='delete_user'){

				$id=$_GET['id'];
				$delete = $db->prepare("DELETE FROM users WHERE id=$id");
				$delete->execute();

				header('Location: admin.php?action=modifyanddelete_user');















}else if($_GET['action']=='modifyanddelete_quotas'){

				$select = $db->prepare("SELECT * FROM users where solde < '0'");
				$select->execute();

?>
<center><h2>Supprimer un utilisateur</h2></center>
        <div class="section">
		      <table class="container" style="width: 1500px">
                      <thead>
                          <tr>

		                      <th>Nom</th>
		                      <th>Solde</th>
		                      <th>Id</th>


		                   </tr>
		                            </thead>
		                            <tbody>
<?php


				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>

					<tr>
							<td><?php echo $s->username; ?></td>
							<td><?php echo $s->solde; ?></td>
							<td><?php echo $s->id; ?></td>

									<td><div class="col-sm-4">
					<a href="?action=delete_quotas&amp;id=<?php echo $s->id; ?>">
					<button type="button" class="btn btn-primary btn-block">Supprimer</button></a>
					</div></td>
					</tr>

					<?php

				}
				?>

			</tbody>
	</table>

	</div>

	<?php



			}else if($_GET['action']=='delete_quotas'){

				$id=$_GET['id'];
				?>
				<div class="alert alert-warning">
							 <div class="alert-icon">
								<i class="material-icons">warning</i>
							</div>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true"><i class="material-icons">clear</i></span>
							</button><center>
											 <b>Attention Alerte :</b> Penser à supprimer le dossier openvpn de cet utilisateur ainsi que supprimer sa seedbox ! Son user_id était :  <?php echo $id ?> </center>
							</div>

<?php

				$deletestreaming = $db->prepare("DELETE FROM streaming WHERE user_id=$id");
				$deletestreaming->execute();

				$deleteserveur = $db->prepare("DELETE FROM serveur WHERE user_id=$id");
				$deleteserveur->execute();

				$deleteseedbox = $db->prepare("DELETE FROM seedbox WHERE user_id=$id");
				$deleteseedbox->execute();

				$deletevpn = $db->prepare("DELETE FROM vpn WHERE user_id=$id");
				$deletevpn->execute();

				$deletetransactions= $db->prepare("DELETE FROM transactions WHERE user_id=$id");
				$deletetransactions->execute();

				$deleteproducts_transactions = $db->prepare("DELETE FROM products_transactions WHERE user_id=$id");
				$deleteproducts_transactions->execute();

				$deleteuser = $db->prepare("DELETE FROM users WHERE id=$id");
				$deleteuser->execute();






























			}else if($_GET['action']=='modifyandadd_user'){


			if(!isset($_SESSION['user_id'])){

				if(isset($_POST['submit'])){

					$username = $_POST['username'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					$repeatpassword = $_POST['repeatpassword'];

					if($username&&$email&&$password&&$repeatpassword){
						if($password==$repeatpassword){
							$db->query("INSERT INTO users VALUES(NULL, '$username', '$email', '$password')");
							echo '<div class="alert alert-success">
							<div class="alert-icon">
								<i class="material-icons">check</i>
							</div>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true"><i class="material-icons">clear</i></span>
							</button><center>
										<b>Succès Alerte :</b> Compte crée avec succès !</center>
							</div>';
						}else{

							echo '<div class="alert alert-warning">
							 <div class="alert-icon">
								<i class="material-icons">warning</i>
							</div>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true"><i class="material-icons">clear</i></span>
							</button><center>
											 <b>Attention Alerte :</b> Merci de saisir le même mot-de-passe.</center>
							</div>';
						}
					}else{
						echo '<div class="alert alert-warning">
						 <div class="alert-icon">
							<i class="material-icons">warning</i>
						</div>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true"><i class="material-icons">clear</i></span>
						</button><center>
										 <b>Attention Alert :</b> Votre inscription n\'a pas pu aboutir. Merci de verifier la saisie de tout les champs</center>
						</div>';
					}

				}

				?>

				<center><h2>Ajouter un utilisateur</h3></center>
					<div class="section">
						<table class="container" style="width: 800px">
						<form action="" method="POST">
							<tr>
								<td>
	<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Pseudo</label>
		<input type="text" name="username" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>
								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">E-mail</label>
		<input type="email" name="email" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>
								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Mot de passe</label>
		<input type="password" name="password" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>

								<div class="form-group label-floating">
		<label style="font-size: 15px;" class="control-label">Répéter mot de passe</label>
		<input type="password" name="repeatpassword" class="form-control">
	</div>
</tr>
</td>
<tr>
<td>
		<button type="submit" name="submit" class="btn btn-primary btn-block">Envoyer</button>
	</tr>
	</td>
						</form>
					</table>
					</div>

			<?php

			}else{
				header('Location: admin.php?action=modifyandadd_user');
			}


		}else if($_GET['action']=='options'){

				?>

				<center><h2>Options</h2></center>

				<?php

				$select = $db->query("SELECT * FROM weights");

	?>

	<div class="section">
<table class="container" style="width: 1200px">
<form action="" method="post">
		<thead>
				<tr>

				<th style="width: 300px">Poids</th>
						<th></th>


		 </tr>
							</thead>
							<tbody>

						<?php

				while($s=$select->fetch(PDO::FETCH_OBJ)){

					?>

                                        <tr>
                                            <td>
																							<div class="form-group label-floating">
																						<label style="font-size: 15px;" class="control-label">Valeur</label>
																						<input style="width: 200px" type="text" name="weight" value="<?php echo $s->name;?>" class="form-control">
																					</div>
                                            </td>
		                                    <td><div class="col-sm-3">
                        <a href="?action=modify_weight&amp;name=<?php echo $s->name; ?>">
                            <button type="button" class="btn btn-primary btn-block">Modifier</button></a>
	        			</div></td>
                                        </tr>

          					<?php

				}
				?>

			</tbody>
					</form>
						</table>
					</div>


						<?php

				$select=$db->query("SELECT tva FROM products");

				$s = $select->fetch(PDO::FETCH_OBJ);

				if(!$s){
					$show_tva = 20;
				}else{
					$show_tva = $s->tva;
				}

				if(isset($_POST['submit2'])){

					$tva=$_POST['tva'];

					if($tva){

						$update = $db->query("UPDATE products SET tva=$tva");
						header("Refresh:0");

					}

				}

				?>
				<center><h2>TVA</h3></center>
					<div class="section">
                 <table class="container" style="width: 1200px">
                     <form action="" method="post">
                      <thead>
                          <tr>

		                      <th style="width: 300px">TVA</th>
                              <th></th>


		                   </tr>
		                            </thead>
		                            <tbody>
		                                <tr>
                                            <td>
																							<div class="form-group label-floating">
																						<label style="font-size: 15px;" class="control-label">Valeur</label>
																						<input style="width: 200px" type="text" name="tva" value="<?= $show_tva; ?>" class="form-control">
																					</div>
		                                    <td><div class="col-sm-3">
	        			<button type="submit" name="submit2" class="btn btn-primary btn-block">Modifier</button>
	        			</div></td>
                                        </tr>

                            </tbody>
                            </form>
                            </table>

                </div>









				<?php


			}else if($_GET['action']=='modify_weight'){

				$old_weight = $_GET['name'];
				$select = $db->query("SELECT * FROM weights WHERE name=$old_weight");
				$s = $select->fetch(PDO::FETCH_OBJ);

				if(isset($_POST['submit'])){

					$weight=$_POST['weight'];
					$price=$_POST['price'];

					if($weight&&$price){

						$update = $db->query("UPDATE weights SET name='$weight', price='$price' WHERE name=$old_weight");
						header("Location: admin.php?action=options");

					}

				}

				?>

				<center><h2>Options de poids (plus de)</h2><center>
					<div class="section">
				<table class="container" style="width: 800px">
				<form action="" method="post">
					<tr>
			      <td>
							<div class="form-group label-floating">
							<label class="control-label" style="font-size: 15px;" >Poids (plus de)</label>
							<input type="text" name="weight" value="<?php echo $_GET['name']; ?>" class="form-control">
							</div>
							</tr>
							</td>
							<tr>
							<td>
								<div class="form-group label-floating">
								<label class="control-label" style="font-size: 15px;" >Correspond à (en €)</label>
								<input type="text" name="price" value="<?php echo $s->price; ?>" class="form-control">
								</div>
								</tr>
								</td>
								<tr>
								<td>
									<button type="submit" name="submit" class="btn btn-primary btn-block">Modifier</button>
									</tr>
									</td>
									</div>
									    </form>
									  </table></div>

				<?php


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

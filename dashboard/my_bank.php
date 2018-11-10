
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />

    <meta name="Description" content="Louez votre seedbox chez SdediKool, la qualitée et le support client sont notre priorités.">
    <meta name="Keywords" content="seedbox,sdedikool,sdedikool.fr,sdedikool.me,seedbox pas cher,seedbox fibren seedbox 1gbit,seedbox seed">
    <meta name="Identifier-Url" content="https://sdedikool.me/">
    <meta name="Reply-To" content="support@sdedikool.me">

    <meta name="robots" content="index, follow">
    <meta name="Rating" content="general">
    <meta name="Distribution" content="global">
    <meta name="Category" content="internet">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>SdediKool - Banque</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
</head>
<?php

require_once('includes/head2.php');
require_once('includes/checkconnection.php');
require_once('stripe-php-6.15.0/init.php');
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<body>


     <div class="wrapper">
        <div class="sidebar" data-active-color="blue" data-background-color="black" data-image="https://www.nasa.gov/sites/default/files/styles/full_width_feature/public/thumbnails/image/worldfires-08232018.jpg">
            <div class="logo">
                <a href="https://sdedikool.me/" class="simple-text">
                    SdediKool             </a>
            </div>
            <div class="logo logo-mini">
                <a href="https://sdedikool.me/" class="simple-text">
                    SK
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="info">
                        <a>
                            <?php
$user_id = $_SESSION['user_id'];
$select = $db->query("SELECT * FROM users WHERE id = '$user_id'");

while($s = $select->fetch(PDO::FETCH_OBJ)){
    ?>
   #<?php echo $s->id; ?> <br/>
    Pseudo : <?php echo $s->username; ?>


    <?php
}

?>



                                               </a>
                    </div>
                </div>
                <ul class="nav">
                    <li>
                        <a href="https://dashboard.sdedikool.me/">
                            <i class="material-icons">home</i>
                            <p>Tableau de bord</p>
                        </a>
                    </li>
                    <li >
                        <a href="my_seedbox.php">
                            <i class="material-icons">dns</i>
                            <p>Mes seedbox</p>
                        </a>
                    </li>
                    <li>
                        <a href="my_vpn.php">
                            <i class="material-icons">dns</i>
                            <p>Mes VPN</p>
                        </a>
                    </li>
                                        <li class="active">
                        <a href="my_bank.php">
                            <i class="material-icons">account_balance</i>
                            <p>Banque</p>
                        </a>
                    </li>
                    <li >
                        <a href="my_space.php">
                            <i class="material-icons">home</i>
                            <p>Mon compte</p>
                        </a>
                    </li>
                    <li>
                        <a href="my_stream.php">
                            <i class="material-icons">play_arrow</i>
                            <p>Streaming</p>
                        </a>
                    </li>
                    <li >
                        <a href="my_help.php">
                            <i class="material-icons">help</i>
                            <p>Assistance</p>
                        </a>
                    </li>
                    <li >
                        <a href="settings.php">
                            <i class="material-icons">settings</i>
                            <p>Paramètres</p>
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
                        <a class="navbar-brand" href="https://dashboard.sdedikool.me/"> Tableau de bord </a>                  </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="material-icons">notifications</i>
                                                                        <p class="hidden-lg hidden-md">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu" id="menu_notifications">
                                    <li>
                                                <a>Aucune notification</a>
                                            </li>                               </ul>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>
<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <h3 class="title text-center">Banque</h3>
                            <br />
                            <div class="nav-center">
                                <ul class="nav nav-pills nav-pills-info nav-pills-icons" role="tablist">
                                    <li class="active" style="min-width: 162.5px;">
                                        <a href="#balance-1" role="tab" data-toggle="tab" onclick='window.history.pushState("", "", "/my_bank.php?balance");'>
                                            <i class="material-icons">euro_symbol</i> Mon solde                                     </a>
                                    </li>
                                    <li style="min-width: 162.5px;">
                                        <a href="#invoices-1" role="tab" data-toggle="tab" onclick='window.history.pushState("", "", "/my_bank.php?invoices");'>
                                            <i class="material-icons">assignment</i> Mes factures                                       </a>
                                    </li>

                                </ul>
                            </div>

                                <div class="tab-content">
                                <div class="tab-pane active" id="balance-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Mon solde</h4>

                                        </div>
                                        <div class="card-content table-responsive">
                                                <div class="card-content"><center>

                                                    <h3 class="card-title">Solde actuel
                                                    <font color='red'>
                                                        <?php
                                                        $user_id = $_SESSION['user_id'];
                                                        $sql = "SELECT solde FROM users WHERE id = '$user_id'";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
    echo $row['solde'];
}


?>


<script>
                       function myFunction() {


                            <b>Succès :</b> Mail modifé avec succès !</center>


}
</script>


                                                    </font> €                                              </h3>

                                                                    <h4 class="card-title">Ajouter de l'argent via PayPal</h4>
                                                                    <div class="form-group">



                            <h4 class="card-title">Montant</h4>
<form method="POST">


			   <div class="radio">
				<label>
					<input type="radio" name="optionsRadios" value="5"> 5 €
				</label>
				</div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="10">
                                    10 €
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="20">
                                    20 €
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="30">
                                    30 €
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="40">
                                    40 €
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" value="50">
                                    50 €
                                </label>
                            </div>
                       <button type="submit" class="btn btn-info"> Confirmer et choisir votre moyen de paiement</button>






</form>

<?php


 $prixfinal = $_POST['optionsRadios'];

 ?>
  
<div align="center" id="paypal-button"></div>





                                <form action="" method="POST">
                                <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="pk_live_tdf8LJXfUxGpcMcH0lQePbuK"
                                    data-amount="<?= $prixfinal*100; ?>"
                                    data-name="SdediKool Seedbox & VPN"
                                    data-description="Paiement"
                                    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                    data-locale="auto"
                                    data-zip-code="true"
                                    data-currency="eur">
                                </script>
                                <script>
        // Hide default stripe button, be careful there if you
        // have more than 1 button of that class
        document.getElementsByClassName("stripe-button-el")[0].style.display = 'none';
    </script>
    <?php if(!empty($_POST['optionsRadios'])){
        ?>
    <td  colspan="3" class="text-center">

       <button align="center" type="submit" class="btn btn-rose btn-round" style="background-color : rgb(0,155,221)" name="stripe">
                  <i class="material-icons">credit_card</i> Stripe Paiement Carte Bancaire
       </button>
    </td>
<?php } ?>
  </form>
                            <?php



if(isset($_POST['stripeToken'])){


    // Clé secrète (à changer pour celle de ton compte)
    // Tu l'obtiendras ici : https://dashboard.stripe.com/account/apikeys
    \Stripe\Stripe::setApiKey("sk_live_IYaQtCtBgNdNsgnsCmWIizrt");



    $currency_code = 'EUR';

    $user_id = $_SESSION['user_id'];
    $prixfinal = $_POST['prixfinal'];
    $token = $_POST['stripeToken'];


    $charge = \Stripe\Charge::create([
        'amount' => $prixfinal*100,
        'currency' => $currency_code,
        'description' => 'Ajout solde',
        'source' => $token,
    ]);


    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%Y/%m/%d %H:%M:%S');
    $dateseedbox = date('d');
    $stripe = 'Inconnu/paiement par Stripe';
    $user_id = $_SESSION['user_id'];
    $raison = 'Ajout solde';
    $identifiant = 'Bientot Disponible';
    $password = 'Bientot Disponible';
    $taille = '10';
    $status = 'INACTIF';
    $serveur = 'Bientot Disponible';
    $fichier = 'Bientot Disponible';






$db->query("INSERT INTO transactions (name, street, city, country, date, transaction_id, amount, currency_code, user_id, raison) VALUES('$stripe', '$stripe', '$stripe', '$stripe', '$date', '$token', '$prixfinal', '$currency_code', '$user_id' ,'$raison')");


$select23 = $db->query("SELECT solde FROM users WHERE id='$user_id'");
$r = $select23->fetch(PDO::FETCH_OBJ);
$solde = $r->solde;
$solde = $solde+$prixfinal;
$update23 = $db->query("UPDATE users SET solde='$solde' WHERE id='$user_id'");





$select33 = $db->query("SELECT * FROM users WHERE id='$user_id'");
$r4 = $select33->fetch(PDO::FETCH_OBJ);
$solde = $r4->solde;
$emailclient = $r4->email;
$usernameclient = $r4->username;





  $owner_mail = $emailclient;

  $nom = $usernameclient;










         $header="MIME-Version: 1.0\r\n";
         $header.='From:"SdediKool - Seedbox & VPN"<admin@sdedikool.me>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '
         <!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>  <title></title>  <!--[if !mso]><!-- -->  <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><style type="text/css">  #outlook a { padding: 0; }  .ReadMsgBody { width: 100%; }  .ExternalClass { width: 100%; }  .ExternalClass * { line-height:100%; }  body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }  table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }  p { display: block; margin: 13px 0; }</style><!--[if !mso]><!--><style type="text/css">  @media only screen and (max-width:480px) {    @-ms-viewport { width:320px; }    @viewport { width:320px; }  }</style><!--<![endif]--><!--[if mso]><xml>  <o:OfficeDocumentSettings>    <o:AllowPNG/>    <o:PixelsPerInch>96</o:PixelsPerInch>  </o:OfficeDocumentSettings></xml><![endif]--><!--[if lte mso 11]><style type="text/css">  .outlook-group-fix {    width:100% !important;  }</style><![endif]--><!--[if !mso]><!-->    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css">    <style type="text/css">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);    </style>  <!--<![endif]--><style type="text/css">  @media only screen and (min-width:480px) {    .mj-column-per-100 { width:100%!important; }.mj-column-per-33 { width:33.333333%!important; }  }</style></head><body style="background: #ffffff;">    <div class="mj-container" style="background-color:#ffffff;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:600px;">      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;" align="center" border="0"><tbody><tr><td style="width:600px;"><img alt="" title="" height="auto" src="https://topolio.s3-eu-west-1.amazonaws.com/uploads/5b744c37c09ba/1534361163.jpg" style="border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;" width="600"></td></tr></tbody></table></td></tr><tr><td style="word-wrap:break-word;font-size:0px;padding:4px 19px 4px 19px;" align="center"><div style="cursor:auto;color:#1BA7B5;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;"><h1 style="font-family: &apos;Cabin&apos;, sans-serif; line-height: 100%;"><span style="font-size:20px;">SdediKool -&#xA0;Seedbox &amp; VPN</span></h1></div></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]-->      <!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:600px;">      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;" align="center"><div style="cursor:auto;color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:11px;line-height:22px;text-align:center;"><p><span style="font-size:14px;">Bonjour '.$nom.'</span></p><p><span style="font-size: 14px;">Nous venons de recevoir votre commande concernant l&apos;ajout de solde.</span></p><p><span style="font-size: 14px;">Votre solde &#xE0; &#xE9;t&#xE9; cr&#xE9;dit&#xE9; du montant command&#xE9; et &#xE0; pour valeur &#xE0; ce jour '.$solde.'&#x20AC;.</span></p><p></p><p></p><p><span style="font-size: 14px;">Une question sur une facture ? </span></p><p><span style="font-size: 14px;">Nous vous prions de regarder votre espace banque avant de nous contacter.</span></p><p></p><p></p><p><span style="font-size: 14px;">Merci et &#xE0; bientot sur Sdedikool.me !</span></p><p></p><p><span style="font-size:12px;">Ceci est un email automatique, merci de ne pas y r&#xE9;pondre dans le cas ou aucune erreur n&apos;a eut lieu.</span></p><p></p><p></p></div></td></tr><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;"><p style="font-size:1px;margin:0px auto;border-top:1px solid #000;width:100%;"></p><!--[if mso | IE]><table role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="font-size:1px;margin:0px auto;border-top:1px solid #000;width:100%;" width="600"><tr><td style="height:0;line-height:0;"> </td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]-->      <!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:198px;">      <![endif]--><div class="mj-column-per-33 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px 10px 25px;padding-top:10px;padding-left:25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0"><tbody><tr><td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#009bdd"><a href="https://sdedikool.me/" style="text-decoration:none;background:#009bdd;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:16px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Boutique</a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>      </td><td style="vertical-align:top;width:198px;">      <![endif]--><div class="mj-column-per-33 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px 10px 25px;padding-top:10px;padding-left:25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0"><tbody><tr><td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#009bdd"><a href="https://sdedikool.me/dashboard.php" style="text-decoration:none;background:#009bdd;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:16px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Dashboard</a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>      </td><td style="vertical-align:top;width:198px;">      <![endif]--><div class="mj-column-per-33 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px 10px 25px;padding-top:10px;padding-left:25px;" align="center"><table role="presentation" cellpadding="0" cellspacing="0" style="border-collapse:separate;" align="center" border="0"><tbody><tr><td style="border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;" align="center" valign="middle" bgcolor="#009bdd"><a href="https://sdedikool.me/my_bank.php" style="text-decoration:none;background:#009bdd;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:16px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;" target="_blank">Banque</a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]-->      <!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="width:600px;">        <tr>          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" border="0"><tbody><tr><td><div style="margin:0px auto;max-width:600px;"><table role="presentation" cellpadding="0" cellspacing="0" style="font-size:0px;width:100%;" align="center" border="0"><tbody><tr><td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:9px 0px 9px 0px;"><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0">        <tr>          <td style="vertical-align:top;width:600px;">      <![endif]--><div class="mj-column-per-100 outlook-group-fix" style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;"><table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0"><tbody><tr><td style="word-wrap:break-word;font-size:0px;padding:10px 25px;" align="center"><div><!--[if mso | IE]>      <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="undefined"><tr><td>      <![endif]--><table role="presentation" cellpadding="0" cellspacing="0" style="float:none;display:inline-table;" align="center" border="0"><tbody><tr><td style="padding:4px;vertical-align:middle;"><table role="presentation" cellpadding="0" cellspacing="0" style="background:none;border-radius:3px;width:35px;" border="0"><tbody><tr><td style="vertical-align:middle;width:35px;height:35px;"><a href="https://www.twitter.com/PROFILE"><img alt="twitter" height="35" src="https://s3-eu-west-1.amazonaws.com/ecomail-assets/editor/social-icos/rounded/twitter.png" style="display:block;border-radius:3px;" width="35"></a></td></tr></tbody></table></td><td style="padding:4px 4px 4px 0;vertical-align:middle;"><a href="https://www.twitter.com/PROFILE" style="text-decoration:none;text-align:left;display:block;color:#333333;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;border-radius:3px;"></a></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]--></div></td></tr></tbody></table></div><!--[if mso | IE]>      </td></tr></table>      <![endif]--></td></tr></tbody></table></div></td></tr></tbody></table><!--[if mso | IE]>      </td></tr></table>      <![endif]--></div></body></html>
         ';
         mail($owner_mail, "Commande - SdediKool.me", $message, $header);







echo "<script type='text/javascript'>document.location.replace('dashboard.php');</script>";


}
?>



















                    </div>
                </div>

<center>




                                        </div>
                                    </div>

</center>
                                </div>






                                <div class="tab-pane" id="invoices-1">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Mes factures</h4>
                                        </div>
                                        <div class="card-content table-responsive">
                                                                                        <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <td>Numéro de facture</td>
                                                        <td>Référence</td>
                                                        <td>Date de création</td>
                                                        <td>Type de facture</td>
                                                        <td>Montant</td>
                                                        <td>Contact</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                                                                        <tr>



<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM transactions WHERE user_id='$user_id' ORDER BY date DESC";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
    ?><td>Facture n°<?php
    echo $row['id'];
    ?></td>



 <td>
                                                            <?php echo $row['transaction_id']; ?>                                                      </td>

     <td>
                                                            <?php echo $row['date']; ?>                                                      </td>
                                                        <td>
                                                           <?php echo $row['raison']; ?>                                                       </td>
                                                        <td>
                                                            <?php
                                                            if ($row['amount'] > 0){
                                                                ?>

                                                                <font color='green'>

                                                                <?php echo $row['amount'];  ?> €
                                                                </font>
<?php

                                                            }else{
                                                                ?>
                                                             <font color='red'>

                                                                <?php echo $row['amount'];  ?> €
                                                                </font>
                                                                <?php

                                                        }
?>





                                                                                                                  </td>
                                                        <td>
                                                            <a href="https://dashboard.sdedikool.me/my_help.php">
                                                                <button type="button" class="btn btn-success btn-xs" style="margin-top:0px;margin-bottom:0px;">
                                                                    <i class="material-icons">forward</i> Support Client                                                               </button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
}
?>









                                                    </tr>
                                                                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

    </div></div></div></div></div>





<script>
    paypal.Button.render({
<?php

          $total = $_POST['optionsRadios'];
?>
        env: 'production',

        client: {
            sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            production: 'AXaV8dsJkxtDm__NKyNdyXBxp9wa8TSS8YZvNOyk3OEpi9rO82H3lc2wKhQrEbJS7NxfnLJ9Igq-rsIC'
        },


        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'pill',      // pill | rect
            color:  'blue'       // gold | blue | silver | black
        },

        commit: true,

        payment: function(data, actions) {

            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: <?= $total ?>, currency: 'EUR' }
                        }
                    ]
                },
            });
        },

        onAuthorize: function(data, actions) {

            return actions.payment.get().then(function(data) {

                console.log(data);

                var shipping = data.payer.payer_info.shipping_address;

                var name = shipping.recipient_name;
                var street = shipping.line1;
                var country_code = shipping.country_code;
                var city = shipping.city;
                var date = '<?= date("Y/m/d") ?>';
                var transaction_id = data.id;
                var price = data.transactions[0].amount.total;
                var currency_code = 'EUR';

                $.post(
                    "processsolde.php",
                    {
                        name : name,
                        street: street,
                        city: city,
                        country_code : country_code,
                        date: date,
                        transaction_id: transaction_id,
                        price: price,
                        currency_code: currency_code,
                    }
                );
                return actions.payment.execute().then(function() {
                    $(location).attr("href", '<?= "https://sdedikool.me"."/success.php"; ?>');
                });
            });
        },

    }, '#paypal-button');
</script>

<?php
  require_once('footclient.php');
   require_once('tawk.php');


    require_once('includes/javascript.php');
?>

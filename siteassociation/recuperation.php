<?php
    require_once('includes/connectBDD.php');
    $nompage = "Récupération mot de passe";
    require_once('includes/head.php');
    require_once('includes/quantcast.php');


//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<?php

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
   if(!empty($_POST['recup_mail'])) {
      $recup_mail = htmlspecialchars($_POST['recup_mail']);
      if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {
         $mailexist = $db->prepare('SELECT id,prenom FROM users WHERE email = ?');
         $mailexist->execute(array($recup_mail));
         $mailexist_count = $mailexist->rowCount();
         if($mailexist_count == 1) {
            $username = $mailexist->fetch();
            $username = $username['prenom'];

            $_SESSION['recup_mail'] = $recup_mail;

            $recup_code = "";
            for($i=0; $i < 8; $i++) {
               $recup_code .= mt_rand(0,9);
            }
            $mail_recup_exist = $db->prepare('SELECT id FROM recuperation WHERE email = ?');
            $mail_recup_exist->execute(array($recup_mail));
            $mail_recup_exist = $mail_recup_exist->rowCount();
            if($mail_recup_exist == 1) {
               $recup_insert = $db->prepare('UPDATE recuperation SET code = ? WHERE email = ?');
               $recup_insert->execute(array($recup_code,$recup_mail));
            } else {
              date_default_timezone_set('Europe/Paris');
              setlocale(LC_TIME, 'fr_FR.utf8','fra');
              $date = strftime('%d/%m/%Y %H:%M:%S');
               $recup_insert = $db->prepare('INSERT INTO recuperation(email,code,date) VALUES (?, ?, ?)');
               $recup_insert->execute(array($recup_mail,$recup_code,$date));
            }
         $header="MIME-Version: 1.0\r\n";
         $header.='From:"JAM - Association MDM"<noreply@jam-mdm.fr>'."\n";
         $header.='Content-Type:text/html; charset="utf-8"'."\n";
         $header.='Content-Transfer-Encoding: 8bit';
         $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

         <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
         <head>
         <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
         <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
         <meta content="width=device-width" name="viewport"/>
         <!--[if !mso]><!-->
         <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
         <!--<![endif]-->
         <title></title>
         <!--[if !mso]><!-->
         <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css"/>
         <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
         <!--<![endif]-->
         <style type="text/css">
         		body {
         			margin: 0;
         			padding: 0;
         		}

         		table,
         		td,
         		tr {
         			vertical-align: top;
         			border-collapse: collapse;
         		}

         		* {
         			line-height: inherit;
         		}

         		a[x-apple-data-detectors=true] {
         			color: inherit !important;
         			text-decoration: none !important;
         		}

         		.ie-browser table {
         			table-layout: fixed;
         		}

         		[owa] .img-container div,
         		[owa] .img-container button {
         			display: block !important;
         		}

         		[owa] .fullwidth button {
         			width: 100% !important;
         		}

         		[owa] .block-grid .col {
         			display: table-cell;
         			float: none !important;
         			vertical-align: top;
         		}

         		.ie-browser .block-grid,
         		.ie-browser .num12,
         		[owa] .num12,
         		[owa] .block-grid {
         			width: 700px !important;
         		}

         		.ie-browser .mixed-two-up .num4,
         		[owa] .mixed-two-up .num4 {
         			width: 232px !important;
         		}

         		.ie-browser .mixed-two-up .num8,
         		[owa] .mixed-two-up .num8 {
         			width: 464px !important;
         		}

         		.ie-browser .block-grid.two-up .col,
         		[owa] .block-grid.two-up .col {
         			width: 348px !important;
         		}

         		.ie-browser .block-grid.three-up .col,
         		[owa] .block-grid.three-up .col {
         			width: 348px !important;
         		}

         		.ie-browser .block-grid.four-up .col [owa] .block-grid.four-up .col {
         			width: 174px !important;
         		}

         		.ie-browser .block-grid.five-up .col [owa] .block-grid.five-up .col {
         			width: 140px !important;
         		}

         		.ie-browser .block-grid.six-up .col,
         		[owa] .block-grid.six-up .col {
         			width: 116px !important;
         		}

         		.ie-browser .block-grid.seven-up .col,
         		[owa] .block-grid.seven-up .col {
         			width: 100px !important;
         		}

         		.ie-browser .block-grid.eight-up .col,
         		[owa] .block-grid.eight-up .col {
         			width: 87px !important;
         		}

         		.ie-browser .block-grid.nine-up .col,
         		[owa] .block-grid.nine-up .col {
         			width: 77px !important;
         		}

         		.ie-browser .block-grid.ten-up .col,
         		[owa] .block-grid.ten-up .col {
         			width: 60px !important;
         		}

         		.ie-browser .block-grid.eleven-up .col,
         		[owa] .block-grid.eleven-up .col {
         			width: 54px !important;
         		}

         		.ie-browser .block-grid.twelve-up .col,
         		[owa] .block-grid.twelve-up .col {
         			width: 50px !important;
         		}
         	</style>
         <style id="media-query" type="text/css">
         		@media only screen and (min-width: 720px) {
         			.block-grid {
         				width: 700px !important;
         			}

         			.block-grid .col {
         				vertical-align: top;
         			}

         			.block-grid .col.num12 {
         				width: 700px !important;
         			}

         			.block-grid.mixed-two-up .col.num3 {
         				width: 174px !important;
         			}

         			.block-grid.mixed-two-up .col.num4 {
         				width: 232px !important;
         			}

         			.block-grid.mixed-two-up .col.num8 {
         				width: 464px !important;
         			}

         			.block-grid.mixed-two-up .col.num9 {
         				width: 522px !important;
         			}

         			.block-grid.two-up .col {
         				width: 350px !important;
         			}

         			.block-grid.three-up .col {
         				width: 233px !important;
         			}

         			.block-grid.four-up .col {
         				width: 175px !important;
         			}

         			.block-grid.five-up .col {
         				width: 140px !important;
         			}

         			.block-grid.six-up .col {
         				width: 116px !important;
         			}

         			.block-grid.seven-up .col {
         				width: 100px !important;
         			}

         			.block-grid.eight-up .col {
         				width: 87px !important;
         			}

         			.block-grid.nine-up .col {
         				width: 77px !important;
         			}

         			.block-grid.ten-up .col {
         				width: 70px !important;
         			}

         			.block-grid.eleven-up .col {
         				width: 63px !important;
         			}

         			.block-grid.twelve-up .col {
         				width: 58px !important;
         			}
         		}

         		@media (max-width: 720px) {

         			.block-grid,
         			.col {
         				min-width: 320px !important;
         				max-width: 100% !important;
         				display: block !important;
         			}

         			.block-grid {
         				width: 100% !important;
         			}

         			.col {
         				width: 100% !important;
         			}

         			.col>div {
         				margin: 0 auto;
         			}

         			img.fullwidth,
         			img.fullwidthOnMobile {
         				max-width: 100% !important;
         			}

         			.no-stack .col {
         				min-width: 0 !important;
         				display: table-cell !important;
         			}

         			.no-stack.two-up .col {
         				width: 50% !important;
         			}

         			.no-stack .col.num4 {
         				width: 33% !important;
         			}

         			.no-stack .col.num8 {
         				width: 66% !important;
         			}

         			.no-stack .col.num4 {
         				width: 33% !important;
         			}

         			.no-stack .col.num3 {
         				width: 25% !important;
         			}

         			.no-stack .col.num6 {
         				width: 50% !important;
         			}

         			.no-stack .col.num9 {
         				width: 75% !important;
         			}

         			.mobile_hide {
         				min-height: 0px;
         				max-height: 0px;
         				max-width: 0px;
         				display: none;
         				overflow: hidden;
         				font-size: 0px;
         			}
         		}
         	</style>
         </head>
         <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
         <style id="media-query-bodytag" type="text/css">
         @media (max-width: 720px) {
           .block-grid {
             min-width: 320px!important;
             max-width: 100%!important;
             width: 100%!important;
             display: block!important;
           }
           .col {
             min-width: 320px!important;
             max-width: 100%!important;
             width: 100%!important;
             display: block!important;
           }
           .col > div {
             margin: 0 auto;
           }
           img.fullwidth {
             max-width: 100%!important;
             height: auto!important;
           }
           img.fullwidthOnMobile {
             max-width: 100%!important;
             height: auto!important;
           }
           .no-stack .col {
             min-width: 0!important;
             display: table-cell!important;
           }
           .no-stack.two-up .col {
             width: 50%!important;
           }
           .no-stack.mixed-two-up .col.num4 {
             width: 33%!important;
           }
           .no-stack.mixed-two-up .col.num8 {
             width: 66%!important;
           }
           .no-stack.three-up .col.num4 {
             width: 33%!important
           }
           .no-stack.four-up .col.num3 {
             width: 25%!important
           }
         }
         </style>
         <!--[if IE]><div class="ie-browser"><![endif]-->
         <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" valign="top" width="100%">
         <tbody>
         <tr style="vertical-align: top;" valign="top">
         <td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#FFFFFF"><![endif]-->
         <div style="background-color:#35bfb1;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#35bfb1;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:10px; padding-bottom:10px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:10px; padding-bottom:10px; padding-right: 10px; padding-left: 10px;">
         <!--<![endif]-->
         <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: Arial, sans-serif"><![endif]-->
         <div style="color:#555555;font-family:Arial, \'Helvetica Neue\', Helvetica, sans-serif;line-height:120%;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;">
         <div style="font-size: 12px; line-height: 14px; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; color: #555555;">
         <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;"><span style="color: #ffffff; font-size: 14px; line-height: 16px;"><strong><span style="font-size: 34px; line-height: 40px;">JAM - Jeunesse Associative </span></strong></span></p>
         <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;"><span style="color: #ffffff; font-size: 14px; line-height: 16px;"><strong><span style="font-size: 34px; line-height: 40px;">Montoise</span></strong></span></p>
         </div>
         </div>
         <!--[if mso]></td></tr></table><![endif]-->
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <div style="background-image:url(\'https://d1oco4z2z1fhwp.cloudfront.net/templates/default/286/bg_wave_1.png\');background-position:top center;background-repeat:repeat;background-color:#F4F4F4;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url(\'https://d1oco4z2z1fhwp.cloudfront.net/templates/default/286/bg_wave_1.png\');background-position:top center;background-repeat:repeat;background-color:#F4F4F4;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
         <!--<![endif]-->
         <table border="0" cellpadding="0" cellspacing="0" class="divider" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
         <tbody>
         <tr style="vertical-align: top;" valign="top">
         <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
         <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="70" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 70px;" valign="top" width="100%">
         <tbody>
         <tr style="vertical-align: top;" valign="top">
         <td height="70" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
         </tr>
         </tbody>
         </table>
         </td>
         </tr>
         </tbody>
         </table>
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <div style="background-color:#F4F4F4;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#F4F4F4;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
         <!--<![endif]-->
         <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 10px; padding-bottom: 0px; font-family: Arial, sans-serif"><![endif]-->
         <div style="color:#555555;font-family:Arial, \'Helvetica Neue\', Helvetica, sans-serif;line-height:120%;padding-top:10px;padding-right:30px;padding-bottom:0px;padding-left:30px;">
         <div style="font-size: 12px; line-height: 14px; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; color: #555555;">
         <p style="font-size: 14px; line-height: 16px; margin: 0;"><strong><span style="font-size: 46px; line-height: 55px;"><span style="font-size: 38px; line-height: 45px;">Bonjours Boussard !</span><br/></span></strong></p>
         </div>
         </div>
         <!--[if mso]></td></tr></table><![endif]-->
         <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 15px; padding-bottom: 5px; font-family: Arial, sans-serif"><![endif]-->
         <div style="color:#555555;font-family:Arial, \'Helvetica Neue\', Helvetica, sans-serif;line-height:150%;padding-top:15px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
         <div style="font-size: 12px; line-height: 18px; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; color: #555555;">
         <p style="font-size: 12px; line-height: 21px; text-align: justify; margin: 0;"><span style="font-size: 14px;">Bonjours Boussard !</span><br/><span style="font-size: 14px; line-height: 21px;">Nous avons reçu une demande de réinitialisation de votre mot de passe au site de la JAM. Vous trouverez ci dessous le code nécessaire à cette réinitialisation.</span></p>
         <p style="font-size: 12px; line-height: 21px; text-align: justify; margin: 0;"><span style="font-size: 14px;"> </span></p>
         <p style="font-size: 12px; line-height: 21px; text-align: justify; margin: 0;"><span style="font-size: 14px;">Code de réinitialisation : 855328</span></p>
         <p style="font-size: 12px; line-height: 21px; text-align: justify; margin: 0;"><br/><span style="font-size: 14px;">Vous n’avez pas demandé ce changement ?</span><br/><span style="font-size: 14px; line-height: 21px;">Si vous n’avez pas demandé de nouveau mot de passe, dites-le nous.</span></p>
         </div>
         </div>
         <!--[if mso]></td></tr></table><![endif]-->
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <div style="background-color:#F4F4F4;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#F4F4F4;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:25px; padding-bottom:60px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:25px; padding-bottom:60px; padding-right: 0px; padding-left: 0px;">
         <!--<![endif]-->
         <div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
         <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:54pt; width:238.5pt; v-text-anchor:middle;" arcsize="13%" stroke="false" fillcolor="#35bfb1"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:26px"><![endif]-->
         <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#35bfb1;border-radius:9px;-webkit-border-radius:9px;-moz-border-radius:9px;width:auto; width:auto;;border-top:1px solid #35bfb1;border-right:1px solid #35bfb1;border-bottom:1px solid #35bfb1;border-left:1px solid #35bfb1;padding-top:10px;padding-bottom:10px;font-family:\'Open Sans\', Helvetica, Arial, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:45px;padding-right:45px;font-size:26px;display:inline-block;">
         <span style="font-size: 16px; line-height: 32px;"><span style="font-size: 26px; line-height: 52px;"><strong>ALLER SUR LE SITE</strong></span></span>
         </span></div>
         <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
         </div>
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <div style="background-color:#F4F4F4;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#F4F4F4;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
         <!--<![endif]-->
         <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 15px; padding-bottom: 5px; font-family: Arial, sans-serif"><![endif]-->
         <div style="color:#555555;font-family:\'Open Sans\', Helvetica, Arial, sans-serif;line-height:150%;padding-top:15px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
         <div style="font-size: 12px; line-height: 18px; color: #555555; font-family: \'Open Sans\', Helvetica, Arial, sans-serif;">
         <p style="font-size: 12px; line-height: 18px; text-align: center; margin: 0;">Ceci est un email automatique, merci de ne pas y répondre. Si vous ne souhaitez plus faire partie de l\'association merci de nous contacter ou si vous rencontrer un probleme merci de nous contacter au plus vite.</p>
         <p style="font-size: 12px; line-height: 18px; margin: 0;"> </p>
         </div>
         </div>
         <!--[if mso]></td></tr></table><![endif]-->
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <div style="background-image:url(\'https://d1oco4z2z1fhwp.cloudfront.net/templates/default/286/bg_wave_2.png\');background-position:top center;background-repeat:repeat;background-color:#F4F4F4;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-image:url(\'https://d1oco4z2z1fhwp.cloudfront.net/templates/default/286/bg_wave_2.png\');background-position:top center;background-repeat:repeat;background-color:#F4F4F4;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:0px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
         <!--<![endif]-->
         <table border="0" cellpadding="0" cellspacing="0" class="divider" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
         <tbody>
         <tr style="vertical-align: top;" valign="top">
         <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
         <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="70" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 70px;" valign="top" width="100%">
         <tbody>
         <tr style="vertical-align: top;" valign="top">
         <td height="70" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
         </tr>
         </tbody>
         </table>
         </td>
         </tr>
         </tbody>
         </table>
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <div style="background-color:#FFFFFF;">
         <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 700px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;;">
         <div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
         <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#FFFFFF;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:700px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
         <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:#FFFFFF;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:35px;"><![endif]-->
         <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
         <div style="width:100% !important;">
         <!--[if (!mso)&(!IE)]><!-->
         <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:35px; padding-right: 0px; padding-left: 0px;">
         <!--<![endif]-->
         <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
         <div style="color:#838383;font-family:\'Open Sans\', Helvetica, Arial, sans-serif;line-height:150%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
         <div style="font-size: 12px; line-height: 18px; color: #838383; font-family: \'Open Sans\', Helvetica, Arial, sans-serif;">
         <p style="font-size: 12px; line-height: 21px; text-align: center; margin: 0;"><span style="font-size: 14px;">© 2019, Jam - Jeunesse Associative Montoise - Créée par Paul Boussard et Kévin Perez</span></p>
         </div>
         </div>
         <!--[if mso]></td></tr></table><![endif]-->
         <!--[if (!mso)&(!IE)]><!-->
         </div>
         <!--<![endif]-->
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
         </div>
         </div>
         </div>
         <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
         </td>
         </tr>
         </tbody>
         </table>
         <!--[if (IE)]></div><![endif]-->
         </body>
         </html>
         ';
         mail($recup_mail, "Récupération du mot de passe -Jam-mdm.fr", $message, $header);

            header("Location:https://jam-mdm.fr/recuperation.php?section=code");
         } else {
            $error = "Cette adresse mail n'est pas enregistrée";
         }
      } else {
         $error = "Adresse mail invalide";
      }
   } else {
      $error = "Veuillez entrer votre adresse mail";
   }
}
if(isset($_POST['verif_submit'],$_POST['verif_code'])) {
   if(!empty($_POST['verif_code'])){
      $verif_code = htmlspecialchars($_POST['verif_code']);
      $verif_req = $db->prepare('SELECT id FROM recuperation WHERE email = ? AND code = ?');
      $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
      $verif_req = $verif_req->rowCount();
      $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
      if($responseData->success){
      if($verif_req == 1) {
         $up_req = $db->prepare('UPDATE recuperation SET confirme = 1 WHERE email = ?');
         $up_req->execute(array($_SESSION['recup_mail']));

         header('Location:https://jam-mdm.fr/recuperation.php?section=changemdp');
      }else{
        $error = "Code invalide";
        }
      }else{
         $error = "Captcha ou code invalide";
      }
   } else {
      $error = "Veuillez entrer votre code de confirmation";
   }
}
if(isset($_POST['change_submit'])) {
   if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {
      $verif_confirme = $db->prepare('SELECT confirme FROM recuperation WHERE email = ?');
      $verif_confirme->execute(array($_SESSION['recup_mail']));
      $verif_confirme = $verif_confirme->fetch();
      $verif_confirme = $verif_confirme['confirme'];
      if($verif_confirme == 1) {
         $mdp = htmlspecialchars($_POST['change_mdp']);
         $mdpc = htmlspecialchars($_POST['change_mdpc']);
         if(!empty($mdp) AND !empty($mdpc)) {
            if($mdp == $mdpc) {
              if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $mdp)){

               $mdp = password_hash($mdp, PASSWORD_DEFAULT);
               $ins_mdp = $db->prepare('UPDATE users SET password = ? WHERE email = ?');
               $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));
              $del_req = $db->prepare('DELETE FROM recuperation WHERE email = ?');
              $del_req->execute(array($_SESSION['recup_mail']));

               header('Location:https://jam-mdm.fr/connect.php');
             } else {
               $error = " Votre mot de passe doit contenir une majuscule, une minuscule, un chiffre et un symbole";
             }
            } else {
               $error = "Vos mots de passes ne correspondent pas";
            }
         } else {
            $error = "Veuillez remplir tous les champs";
         }
      } else {
         $error = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
      }
   } else {
      $error = "Veuillez remplir tous les champs";
   }
}

?>



  <body class="login-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>

<!-- Ajout d'un CSS interne dans le but de le prioriser et ainsi appllquer ces propriétées en premier
Le but étant du final d'afficher cette page avec un margin-top spécial afin de ne pas avoir de bug de footer encastré ou de bug de notif qui se mélangent
Autre solution : Créer d'autres classes, mais cela utilise beaucoup + de lignes de code ou faire un autre css mais cela est toalement ilogique et apportera un chargement encore plus long !
-->
<style>
.page-header>.content {
  margin-top: 13%;
  text-align: center;
  margin-bottom: 20px;
}
</style>
<div class="page-header clear-filter">
  <div class="page-header-image" style="background-image:url(JamFichiers/Img/ImagesDuSite/Original/IUTmdm.jpg)"></div>
  <div class="content">
    <div class="container">
      <div class="col-md-4 ml-auto mr-auto">
        <div class="card card-login card-plain">
          <form class="form" action="" method="POST">
            <div class="card-header text-center">
              <div class="header header-primary text-center">
                <div class="typography-line">
                  <h2>
                    Restauration du mot de passe
                  </h2>
                </div>
              </div>
              </div>

                    <?php if(isset($error)) { echo '
                      <div class="container">
                        <div class="row">
                          <div class="col-sm-12 ml-auto mr-auto">
                            <div class="alert alert-warning">
                              <div class="alert-icon">
                                <i class="now-ui-icons ui-1_bell-53"></i>
                              </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
                                </button>
                                '.$error.'
                            </div>
                         </div>
                       </div>
                    </div>'; }

                    ?>

<?php if($_GET['section'] == 'code') { ?>



  <div class="container">
     <div class="row">
<div class="col-md-14"> <!-- Ajout afin d'avoir une belle barre de notif bien centrée
La barre s'affiche parfaitement sur mobile, sur pc lèger décalage de l'email
-->
        <div class="alert alert-success">
           <div class="alert-icon">
             <i class="now-ui-icons ui-1_bell-53"></i>
           </div>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true"><i class="now-ui-icons ui-1_simple-remove"></i></span>
           </button>
<div align="center">
              Un code vous a été envoyé à : <?= $_SESSION['recup_mail']?>
              <!-- L'ajout d'un text supplémentaire ne le centre plus !!! -->
</div>
        </div>
     </div>
  </div>
</div>
<form method="post" class="form">
  <div class="card-body">
    <div class="input-group no-border input-lg">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="now-ui-icons travel_info"></i>
        </span>
      </div>
      <input type="text" placeholder="Code de vérification" class="form-control" name="verif_code"/>
    </div>
    <div class="footer text-center">
    <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
    </div>
  </div>
  <div class="card-footer text-center">
  <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" name="verif_submit">
    Valider
  </button>
    <div class="pull-left">
      <h6>
        <a href="register.php" class="link">Inscrivez vous</a>
      </h6>
    </div>
    <div class="pull-right">
      <h6>
        <a href="connect.php" class="link">Connexion</a>
      </h6>
    </div>
  </div>
  </form>

<?php } elseif($_GET['section'] == "changemdp") { ?>



  <form method="post" class="form">
    <div class="card-body">
      <div class="input-group no-border input-lg">
        <div class="input-group-prepend">
          <span class="input-group-text">
              <i class="now-ui-icons ui-1_lock-circle-open"></i>
          </span>
        </div>
        <input type="password" placeholder="Nouveau mot de passe" class="form-control" name="change_mdp" data-toggle="tooltip" data-placement="right" title="Votre mot de passe doit au minimum contenir une lettre majuscule, une minuscule, un chiffre et un caractères" data-container="body" data-animation="true"/>
      </div>
      <div class="input-group no-border input-lg">
        <div class="input-group-prepend">
          <span class="input-group-text">
              <i class="now-ui-icons ui-1_lock-circle-open"></i>
          </span>
        </div>
        <input type="password" placeholder="Nouveau mot de passe" class="form-control" name="change_mdpc"/>
      </div>
    </div>
    <div class="card-footer text-center">
    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" name="change_submit">
      Valider
    </button>
      <div class="pull-left">
        <h6>
          <a href="register.php" class="link">Inscrivez vous</a>
        </h6>
      </div>
      <div class="pull-right">
        <h6>
          <a href="connect.php" class="link">Connexion</a>
        </h6>
      </div>
    </div>
    </form>



<?php } else { ?>
    <form method="post" class="form">
      <div class="card-body">
        <div class="input-group no-border input-lg">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="now-ui-icons ui-1_email-85"></i>
            </span>
          </div>
          <input type="email" placeholder="Votre adresse mail" class="form-control" name="recup_mail"/>
        </div>
      </div>
      <div class="card-footer text-center">
      <button type="submit" class="btn btn-primary btn-round btn-lg btn-block" name="recup_submit">
        Valider
      </button>
        <div class="pull-left">
          <h6>
            <a href="register.php" class="link">Inscrivez vous</a>
          </h6>
        </div>
        <div class="pull-right">
          <h6>
            <a href="connect.php" class="link">Connexion</a>
          </h6>
        </div>
      </div>
      </form>

<?php } ?>

      </div>
    </div>
  </div>
</div>


<?php
require_once('includes/footer.php');

require_once('includes/javascript.php');
?>

<?php
require_once('../includes/connectBDD.php');
        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $grade = $_POST['grade'];
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        if(!empty($email)&&!empty($nom)&&!empty($password)&&!empty($grade)){

                 if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{10,}$#', $password)){

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%Y/%m/%d %H:%M:%S');

                $datesystem = strftime('%Y-%m-%d');



                $insertlogs = $db->prepare("INSERT INTO admin (username, email, password, grade, subscribe) VALUES(:nom, :email, :password, :grade, :subscribe)");
                $insertlogs->execute(array(
                                    "nom"=>$nom,
                                    "email"=>$email,
                                    "password"=>$param_password,
                                    "grade"=>$grade,
                                    "subscribe"=>$datesystem
                                    )
                                );
                                //owner = le mail de la personne
                                  $priority = '1';
                                  $owner_mail = 'contact@jam-mdm.fr';
                                  $message = '
                                  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
                                  <p style="font-size: 14px; line-height: 16px; text-align: center; margin: 0;"><span style="color: #ffffff; font-size: 14px; line-height: 16px;"><strong><span style="font-size: 34px; line-height: 40px;"><span style="font-size: 42px; line-height: 50px;">JAM - Jeunesse Associative</span> </span></strong></span></p>
                                  <p style="font-size: 14px; line-height: 50px; text-align: center; margin: 0;"><span style="color: #ffffff; font-size: 42px;"><strong><span style="line-height: 50px; font-size: 42px;">Montoise</span></strong></span></p>
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
                                  <p style="font-size: 14px; line-height: 16px; margin: 0;"><strong><span style="font-size: 46px; line-height: 55px;"><span style="font-size: 42px; line-height: 50px;">Bonjours <span style="color: #35bfb1; line-height: 50px; font-size: 42px;">'.$nom.'</span> !</span><br/></span></strong></p>
                                  </div>
                                  </div>
                                  <!--[if mso]></td></tr></table><![endif]-->
                                  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 15px; padding-bottom: 5px; font-family: Arial, sans-serif"><![endif]-->
                                  <div style="color:#555555;font-family:Arial, \'Helvetica Neue\', Helvetica, sans-serif;line-height:150%;padding-top:15px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
                                  <div style="line-height: 18px; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; color: #555555;">
                                  <p style="font-size: 12px; line-height: 24px; text-align: justify; margin: 0;"><span style="font-size: 16px;">La Jeunesse Associative Montoise vous invite à rejoindre son équipe d\'administrateur de site web. Vous trouverez ci-dessous vos identifiants de connexion :</span></p>
                                  <p style="font-size: 12px; line-height: 18px; text-align: justify; margin: 0;"> </p>
                                  <p style="line-height: 24px; text-align: justify; font-size: 12px; margin: 0;"><span style="background-color: transparent; font-size: 16px;">Identifiant : '.$email.'</span></p>
                                  <p style="line-height: 24px; text-align: justify; font-size: 12px; margin: 0;"><span style="font-size: 16px; background-color: transparent;">Mot de Passe : '.$param_password.'</span></p>
                                  <p style="line-height: 18px; text-align: justify; font-size: 12px; margin: 0;"> </p>
                                  <p style="font-size: 12px; line-height: 24px; text-align: justify; margin: 0;"><span style="font-size: 16px;">Vous n’avez pas demandé à devenir administrateur ? Alors,</span><span style="font-size: 16px; line-height: 24px;"> <span style="color: #35bfb1; line-height: 24px; font-size: 16px;"><a href="https://jam-mdm.fr/contact.php" rel="noopener" style="text-decoration: underline; color: #35bfb1;" target="_blank">dites-le nous</a></span>.</span></p>
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
                                  <!--[if (mso)|(IE)]><td align="center" width="700" style="background-color:transparent;width:700px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:25px; padding-bottom:30px;"><![endif]-->
                                  <div class="col num12" style="min-width: 320px; max-width: 700px; display: table-cell; vertical-align: top;;">
                                  <div style="width:100% !important;">
                                  <!--[if (!mso)&(!IE)]><!-->
                                  <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:25px; padding-bottom:30px; padding-right: 0px; padding-left: 0px;">
                                  <!--<![endif]-->
                                  <div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                                  <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://administration.jam-mdm.fr/connect.php" style="height:54pt; width:212.25pt; v-text-anchor:middle;" arcsize="13%" stroke="false" fillcolor="#35bfb1"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:26px"><![endif]--><a href="https://administration.jam-mdm.fr/connect.php" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #35bfb1; border-radius: 9px; -webkit-border-radius: 9px; -moz-border-radius: 9px; width: auto; width: auto; border-top: 1px solid #35bfb1; border-right: 1px solid #35bfb1; border-bottom: 1px solid #35bfb1; border-left: 1px solid #35bfb1; padding-top: 10px; padding-bottom: 10px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:45px;padding-right:45px;font-size:26px;display:inline-block;">
                                  <span style="font-size: 16px; line-height: 32px;"><span style="font-size: 26px; line-height: 52px;"><strong>SE CONNECTER</strong></span></span>
                                  </span></a>
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
                                  <p style="font-size: 12px; line-height: 18px; text-align: center; margin: 0;">Ceci est un email automatique, merci de ne pas y répondre. Si vous ne souhaitez plus faire partie de l\'association ou si vous rencontrer un problème merci de nous <a href="https://jam-mdm.fr/contact.php" rel="noopener" style="text-decoration: underline; color: #0068A5;" target="_blank">contacter</a> au plus vite.</p>
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
                                  <p style="font-size: 12px; line-height: 21px; text-align: center; margin: 0;"><span style="font-size: 14px;">© 2019,  Jam - Jeunesse Associative Montoise - Créée par Paul Boussard et Kévin Perez</span></p>
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
                                  $subject = '[JAM]'.'[Administrateur]';
                                if($subject&&$email&&$message){
                                      $uid = md5(uniqid(time()));
                                      // header
                                      $headers = "From: <".$owner_mail.">\r\n";
                                      $headers .= "MIME-Version: 1.0\r\n";
                                      $headers .= 'X-Priotity:'.$priority."\r\n";
                                      $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
                                      // message & attachment
                                      $nmessage = "--".$uid."\r\n";
                                      $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
                                      $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
                                      $nmessage .= $message."\r\n\r\n";
                                      $nmessage .= "--".$uid."\r\n";

                                      $nmessage .= "--".$uid."--";
                                        mail($email,$subject,$nmessage, $headers);
                                        ?>
                                            <script>
                                            demo.showSwal('success-message');
                                            demo.showNotification('top','right','<b>Succès</b> - Modifications effectués !');
                                            </script>
                                            <?php
                                  }else{
                                    ?>

                                        <script>
                                        demo.showSwal('danger-message');
                                        demo.showNotification('top','right','<b>Erreur</b> - Modifications non effectués en raison de champs vides !');
                                        </script>
                                <?php
                                  }







    }else{
        ?>


  <script>
            demo.showSwal('danger-message');
            demo.showNotification('top','right','Désolé, modification non effectuée en raison de mot de passe non fiable !','warning');
            </script>


<?php
    }


  }else {

    ?>


<script>
        demo.showSwal('danger-message');
        demo.showNotification('top','right','Désolé, modification non effectuée en raison de champs vides !','warning');
        </script>


<?php
  }

        ?>

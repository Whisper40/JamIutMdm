<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Demande Adhésion";
    $nomsouscat = "";

    require_once('includes/head.php');



    //Code de génératon du captcha fournie par GOOGLE
    $secret = "6LdcenUUAAAAAEjI0C8juo6_Y55YSGNTgRVeL0gf";
    $sitekey = "6LdcenUUAAAAAD-ZMHJCP-AABqWuPhyMnZE42NKs";
    ?>

<script src='https://www.google.com/recaptcha/api.js'></script>

<?php
$messagenotif = "";

if(isset($_POST['submit'])){
 //owner = le mail de la personne
   $priority = '3';

   $email = 'contact@jam-mdm.fr';
   $message = $_POST['message'];
   $subject = '[JAM] [Problème de document]';
   $id = $_GET['id'];
   $selectinfosuser = $db->prepare("SELECT * from users WHERE id=:id");
   $selectinfosuser->execute(array(
     "id"=>$id
   ));
   $r2 = $selectinfosuser->fetch(PDO::FETCH_OBJ);
   $owner_mail = $r2->email;
   $nom = $r2->prenom;

 if($subject&&$email&&$message){
   $responseData = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']));
   if($responseData->success){

     $message2 = '
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
     <p style="font-size: 14px; line-height: 16px; margin: 0;"><strong><span style="font-size: 46px; line-height: 55px;"><span style="font-size: 42px; line-height: 50px;">Bonjour <span style="color: #35bfb1; line-height: 50px; font-size: 42px;">'.$nom.'</span> !</span><br/></span></strong></p>
     </div>
     </div>
     <!--[if mso]></td></tr></table><![endif]-->
     <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 15px; padding-bottom: 5px; font-family: Arial, sans-serif"><![endif]-->
     <div style="color:#555555;font-family:Arial, \'Helvetica Neue\', Helvetica, sans-serif;line-height:150%;padding-top:15px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
     <div style="line-height: 18px; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; color: #555555;">

     <p style="font-size: 12px; line-height: 18px; text-align: justify; margin: 0;">'.$message.'</p>
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
     <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://jam-mdm.fr/register.php" style="height:54pt; width:190.5pt; v-text-anchor:middle;" arcsize="13%" stroke="false" fillcolor="#35bfb1"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:26px"><![endif]--><a href="https://dashboard.jam-mdm.fr/devenirmembre.php" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #35bfb1; border-radius: 9px; -webkit-border-radius: 9px; -moz-border-radius: 9px; width: auto; width: auto; border-top: 1px solid #35bfb1; border-right: 1px solid #35bfb1; border-bottom: 1px solid #35bfb1; border-left: 1px solid #35bfb1; padding-top: 10px; padding-bottom: 10px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:45px;padding-right:45px;font-size:26px;display:inline-block;">
     <span style="font-size: 16px; line-height: 32px;"><span style="font-size: 26px; line-height: 52px;"><strong>Consulter mes fichiers</strong></span></span>
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
     <p style="font-size: 12px; line-height: 18px; text-align: center; margin: 0;">Vous pouvez répondre directement à ce mail. Si vous ne souhaitez plus faire partie de l\'association ou si vous rencontrer un problème merci de nous <a href="https://jam-mdm.fr/contact.php" rel="noopener" style="text-decoration: underline; color: #0068A5;" target="_blank">contacter</a> au plus vite.</p>
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

     if(!isset($_FILES['attachment']['name'][0])){ //Probleme ici , la variable reste a 1 meme si pas de photo.................




           // header
           $headers = "From: <".$email.">\r\n";
           $headers .= "MIME-Version: 1.0\r\n";
           $headers .= 'X-Priotity:'.$priority."\r\n";
           $headers .= "Content-Type: text/html; charset=utf-8\r\n";



             mail($owner_mail,$subject,$message2, $headers);






     }else{
         $filename = $_FILES['attachment']['name'];
         $file = $_FILES['attachment']['tmp_name'];
       $content = file_get_contents( $file);
       $content = chunk_split(base64_encode($content));
       $uid = md5(uniqid(time()));
       $name = basename($file);
       // header
       $headers = "From: <".$email.">\r\n";
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= 'X-Priotity:'.$priority."\r\n";
       $headers .= "Content-Type: multipart/mixed; charset=utf-8; boundary=\"".$uid."\"\r\n\r\n";
       // message & attachment
       $nmessage = "--".$uid."\r\n";
       $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
       $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
       $nmessage .= $message."\r\n\r\n";
       $nmessage .= "--".$uid."\r\n";
       $nmessage .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
       $nmessage .= "Content-Transfer-Encoding: base64\r\n";
       $nmessage .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
       $nmessage .= $content."\r\n\r\n";
       $nmessage .= "--".$uid."--";
         mail($owner_mail,$subject,$nmessage, $headers);
     }
     $messagenotif = "<b>Succès : </b>le mail à été envoyé à son destinataire !";
     $type = "success";
   }else{
      $messagenotif = "<b>Erreur : </b>captcha non valide !";
      $type = "warning";
   } }else{
     $messagenotif = "<b>Erreur : </b>les champs sont incorrects ou manquants !";
     $type = "warning";
   } }
  ?>

<body <?php if ($messagenotif != "") { ?> onload="demo.showNotification('top','right','<?php echo $messagenotif ?>','<?php echo $type ?>')" <?php } ?> >
  <div class="wrapper">

    <?php
    require_once('includes/navbar.php');


    if(isset($_GET['action'])){
    if($_GET['action']=='validefichier'){


    $id=$_GET['id'];
    $idutilisateur = $_GET['user_id'];
    $setvalide = $db->prepare("UPDATE validationfichiers SET status='VALIDE' WHERE id=$id");
    $setvalide->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/demandeadhesion.php?action=gestionfichier&id=<?php echo $idutilisateur; ?>"</script>
    <?php
    }else if($_GET['action']=='refusfichier'){
    $id=$_GET['id'];
    $idutilisateur = $_GET['user_id'];
    $setrefus = $db->prepare("UPDATE validationfichiers SET status='REFUS' WHERE id=$id");
    $setrefus->execute();
    ?>
    <script>window.location="https://administration.jam-mdm.fr/demandeadhesion.php?action=gestionfichier&id=<?php echo $idutilisateur; ?>"</script>
    <?php
    }
    ?>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title text-center">Demande d'Adhésion</h2>
            <br>

    <?php

if($_GET['action']=='gestionfichier'){
  $user_id=$_GET['id'];
  $selectfichieratraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status='EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
  $selectfichieratraiter->execute();
  $countid = $selectfichieratraiter->rowCount();
  if($countid>'0'){
  ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Documents en attente de validation</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th class="text-center">Pseudo</th>
                      <th class="text-center">Nom du fichier</th>
                      <th class="text-center">Message</th>
                      <th class="text-center">Date d'ajout</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody>

                      <?php
                      while($fichier = $selectfichieratraiter->fetch(PDO::FETCH_OBJ)){

                        $idfichier = $fichier->id;
                        $idutilisateur = $fichier->user_id;

                        $selectnom = $db->prepare("SELECT username FROM users WHERE id='$idutilisateur' ORDER BY id ASC");
                        $selectnom->execute();

                        $s = $selectnom->fetch(PDO::FETCH_OBJ);
                        $nom = $s->username;

                        $filename = $fichier->filename;
                        $filenamesystem = $fichier->filenamesystem;
                        $message = $fichier->message;
                        $datefile = $fichier->date;
                      ?>


                      <tr>
                        <td class="text-center"><?php echo $nom;?></td>
                        <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
                        <td><?php echo $message;?></td>
                        <td class="text-center"><?php echo $datefile;?></td>
                        <td class="text-center"><a href="?action=validefichier&amp;id=<?php echo $idfichier;?>&amp;user_id=<?php echo $idutilisateur;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Valider</button></a>
                                                <a href="?action=refusfichier&amp;id=<?php echo $idfichier;?>&amp;user_id=<?php echo $idutilisateur;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Refuser</button></a>
                        </td>
                      </tr>

                      <?php  } ?>

                  </tbody>
                  </table>
                  </div>
              </div>
            </div>
          </div>

          <?php } ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Documents en attente de validation</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="card-content">
                <center>
                  <h4 class="card-title">En cliquant sur ce bouton je confirme que le dossier est complé et j'autorise le paiement</h4>
                </center>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card-content">
                <center>
                  <button onclick="demo.showSwal('givepaiementaccess','<?php echo $user_id; ?>','<?php echo $_GET['id']; ?>')" type="button" class="btn btn-primary btn-round btn-rose">Confirmer le dossier et autoriser le paiement</button>
                </center>
              </div>
            </div>
          </div>
          <div id="results28"></div>
          <div id="results29"></div>

<?php

$selectfichierdejatraiter = $db->prepare("SELECT * FROM validationfichiers WHERE status <> 'EN ATTENTE DE VALIDATION' and user_id='$user_id' ORDER BY id ASC");
$selectfichierdejatraiter->execute();
$countid2 = $selectfichierdejatraiter->rowCount();
if($countid2>'0'){
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <h3 class="card-title">Liste des documents déja traités</h3>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <div class="table-responsive">
        <table class="table">
          <thead class="text-primary">
            <th class="text-center">Pseudo</th>
            <th class="text-center">Nom du fichier</th>
            <th class="text-center">Message</th>
            <th class="text-center">Date d'ajout</th>
            <th class="text-center">Status</th>
          </thead>
          <tbody>

            <?php
            while($fichier2 = $selectfichierdejatraiter->fetch(PDO::FETCH_OBJ)){

              $idfichier = $fichier2->id;
              $idutilisateur = $fichier2->user_id;

              $selectnom = $db->prepare("SELECT username, email FROM users WHERE id='$idutilisateur' ORDER BY id ASC");
              $selectnom->execute();

              $s = $selectnom->fetch(PDO::FETCH_OBJ);
              $nom = $s->username;
              $owner_mail = $s->email;


              $filename = $fichier2->filename;
              $filenamesystem = $fichier2->filenamesystem;
              $message = $fichier2->message;
              $datefile = $fichier2->date;
              $status = $fichier2->status;
            ?>

            <tr>
              <td class="text-center"><?php echo $nom;?></td>
              <td><a href="./download.php?nom=<?php echo $filenamesystem;?>&amp;id=<?php echo $idutilisateur;?>"><?php echo $filename;?></a></td>
              <td><?php echo $message;?></td>
              <td class="text-center"><?php echo $datefile;?></td>
              <td class="text-center"><?php echo $status;?></td>
            </tr>

          <?php  } ?>
        </tbody>
        </table>
        </div>
    </div>
  </div>
</div>

<?php } ?>


<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <h3 class="card-title">Contacter la personne par Email</h3>
    </div>
  </div>
</div>
<form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
<div class="row">
  <div class="col-sm-6">
    <div class="card-content">
      <div class="form-group label-floating">
          <textarea name="message" class="form-control" rows="8" placeholder="Votre message"></textarea>
          <span class="help-block">Merci de décrire précisément votre message</span>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card-content">
      <br>
      <div class="form-group form-file-upload">
          <input type="file" id="attachment" name="attachment" multiple="">
          <div class="input-group">
              <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
              <span class="input-group-btn input-group-s">
                  <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                      <i class="material-icons">layers</i>
                  </button>
              </span>
          </div>
      </div>
      <center>
        <div class="form-group label-floating">
            <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
        </div>
      </center>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="card-content">
      <center>
        <button type="submit" name="submit" value="Envoyer un message" class="btn btn-rose btn-round">Envoyer le message</button>
      </center>
    </div>
  </div>
</div>
</form>

    </div>





  </div>


</div>
</div>

 <?php


}else if($_GET['action']=='gestionpaiement'){
  $user_id=$_GET['id'];
  ?>

              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <h3 class="card-title">Paiement en attente de validation</h3>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="card-content">
                    <center>
                      <h4 class="card-title">En cliquant sur ce bouton je confirme que le paiement est été effectué en éspèce au près d'un membre de l'association</h4>
                    </center>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card-content">
                    <center>
                      <button onclick="demo.showSwal('confirmpaiementaccess','<?php echo $user_id; ?>','<?php echo $_GET['id']; ?>')" type="button" class="btn btn-primary btn-round btn-rose">Confirmer le paiement manuel</button>
                    </center>
                  </div>
                </div>
              </div>
              <div id="results29"></div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <h3 class="card-title">Contacter la personne par Email</h3>
                  </div>
                </div>
              </div>
              <form  method="POST" class="form-horizontal"  enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-6">
                  <div class="card-content">
                    <div class="form-group label-floating">
                      <textarea name="message" class="form-control" rows="8" placeholder="Votre message"></textarea>
                      <span class="help-block">Merci de décrire précisément votre message</span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card-content">
                    <br>
                    <div class="form-group form-file-upload">
                      <input type="file" id="attachment" name="attachment[]" multiple="">
                      <div class="input-group">
                        <input type="text" readonly="" class="form-control" placeholder="Insérer votre pièce jointe">
                        <span class="input-group-btn input-group-s">
                          <button type="button" class="btn btn-just-icon btn-rose btn-round btn-info">
                            <i class="material-icons">layers</i>
                          </button>
                        </span>
                      </div>
                    </div>
                    <center>
                      <div class="form-group label-floating">
                        <div class="g-recaptcha" data-sitekey="<?= $sitekey; ?>"></div>
                      </div>
                    </center>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="card-content">
                    <center>
                      <button type="submit" name="submit" value="Envoyer un message" class="btn btn-rose btn-round">Envoyer le message</button>
                    </center>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

 <?php
    } }else{

      $selectuserid = $db->prepare("SELECT distinct id FROM users WHERE status='EN ATTENTE DE VALIDATION' ORDER BY id");
      $selectuserid->execute();
      $countuserid = $selectuserid->rowCount();

    ?>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-content">
            <h2 class="card-title text-center">Demande d'Adhésion</h2>
            <br>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Liste des personnes ayant transmis des documents/non membres</h3>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">

            <?php



              if($countuserid>'0'){
                $table = $selectuserid->fetchAll(PDO::FETCH_OBJ);


                    echo '
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th class="text-center">Pseudo</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Statuts</th>
                        <th class="text-center">Action</th>
                      </thead>
                      <tbody>
                        ';

                        foreach($table as $ligne){
                          $user_id = $ligne->id;

                          $selectnom = $db->prepare("SELECT username, email, status FROM users WHERE id=:user_id ORDER BY id ASC");
                          $selectnom->execute(array(
                            "user_id"=>$user_id
                          ));
                          $table2 = $selectnom->fetch(PDO::FETCH_OBJ);

                          $username = $table2->username;
                          $email = $table2->email;
                          $status = $table2->status;

                          echo '
                        <tr>
                          <td class="text-center">'.$username.'</td>
                          <td class="text-center">'.$email.'</td>
                          <td class="text-center">'.$status.'</td>
                          <td class="text-center"><a href="?action=gestionfichier&amp;id='.$user_id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Afficher</button></a></td>
                        </tr>
                        ';
                      }

                      echo '
                      </tbody>
                    </table>
                  </div>
                      ';
}

                      ?>

              </div>
            </div>
          </div>

  <?php
  $selectid2 = $db->prepare("SELECT id FROM users WHERE status='EN ATTENTE DE PAIEMENT' ORDER BY id ASC");
  $selectid2->execute();
  $countid2 = $selectid2->rowCount();
  ?>

          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">
                <h3 class="card-title">Liste des personnes en attente de paiement</h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="card-content">

          <?php
            if($countid2>'0'){
                $table2 = $selectid2->fetchAll(PDO::FETCH_OBJ);

                  echo '
                  <div class="table-responsive">
                    <table class="table">
                      <thead class="text-primary">
                        <th class="text-center">Pseudo</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Statuts</th>
                        <th class="text-center">Action</th>
                      </thead>
                      <tbody>
                      ';

                      foreach($table2 as $ligne2){
                        $user_id = $ligne2->id;

                        $selectnom2 = $db->prepare("SELECT username, email, status FROM users WHERE id=:user_id ORDER BY id ASC");
                        $selectnom2->execute(array(
                          "user_id"=>$user_id
                        ));
                        $table3 = $selectnom2->fetch(PDO::FETCH_OBJ);

                        $username = $table3->username;
                        $email = $table3->email;
                        $status = $table3->status;

                        echo '
                        <tr>
                          <td class="text-center">'.$username.'</td>
                          <td class="text-center">'.$email.'</td>
                          <td class="text-center">'.$status.'</td>
                          <td class="text-center"><a href="?action=gestionpaiement&amp;id='.$user_id.'"><button type="button" class="btn btn-rose btn-round btn-sm">Afficher</button></a></td>
                        </tr>
                        ';

                    }

                    echo '
                      </tbody>
                    </table>
                  </div>
                    ';

                    }
                    ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php } ?>

  </div>
</body>

<?php
require_once('includes/javascript.php');
?>

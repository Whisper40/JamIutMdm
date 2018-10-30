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

  <title>Jam - Documents</title>


    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
</head>


<?php

require_once('includes/head.php');

require_once('includes/checkconnection.php');

?>

<body>
    <div class="wrapper">

      <?php
      $nompage = "Telechargement de Fichier";
      require_once('includes/header.php');
      ?>

            <div class="content">
                  <div class="container-fluid">
                      <div class="row">
                      <h3 class="title text-center">Mes documents</h3>
                      <center><a href="./download.php?dl=thisfilecontainsyourdocumentsforjam" class="btn btn-rose btn-round">
                                                                      <i class="material-icons">vertical_align_bottom</i> Télécharger les documents
                                                                  </a></center>
                                                                </div>
                                                              </div>
                                                            </div>

<?php
require_once('includes/footdashboard.php');
   ?>
</body>
<?php
    require_once('includes/javascriptdashboard.php');
?>

<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Telechargement de Fichier";
    require_once('includes/head.php');

?>

<body>
    <div class="wrapper">

<?php
  require_once('includes/navbar.php');
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


</body>
<?php
    require_once('includes/javascriptdashboard.php');
?>

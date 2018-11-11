<?php
    require_once('includes/connectBDD.php');
    $nompage = "Statuts";
    require_once('includes/head.php');
?>

<body class="landing-page sidebar-collapse">

<?php
    require_once('includes/navbar.php');
?>


  <div class="wrapper">
    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url('./assets/img/bg1.jpg');">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title">Présentation de l'Association</h1>
        </div>
      </div>
    </div>

    <?php
    $asso = $db->query("SELECT * FROM ########");
    while($association = $asso->fetch(PDO::FETCH_OBJ)){
      ?>

    <div class="section section-about-us">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto text-center">
            <h2 class="title">Qui sommes nous ?</h2>
            <h5 class="description"><?php echo $association->description1 ?></h5>
          </div>
        </div>
      </div>
    </div>
      <?php
          }
          ?>
  </div>

  <?php
  require_once('includes/footer.php');

  require_once('includes/javascript.php');
  ?>

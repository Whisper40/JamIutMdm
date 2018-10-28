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

  <title>Jam - Dashboard</title>


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
        <div class="sidebar" data-active-color="blue" data-background-color="black" data-image="https://www.nasa.gov/sites/default/files/styles/full_width_feature/public/thumbnails/image/worldfires-08232018.jpg">
            <div class="logo">
                <a href="https://jam-mdm.fr/" class="simple-text">
                    JAM          </a>
            </div>
            <div class="logo logo-mini">
                <a href="https://jam-mdm.fr" class="simple-text">
                    JAM
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="info">
                        <a>



<?php

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{ ?>
   #<?php echo $row['id'];?><br/>
   Pseudo : <?php echo $row['username'];
}

?>



                                               </a>
                    </div>
                </div>
                <ul class="nav">
                    <li class="active">
                        <a href="https://dashboard.jam-mdm.fr/">
                            <i class="material-icons">home</i>
                            <p>TAB 1</p>
                        </a>
                    </li>
                    <li >
                        <a href="TAB 1.php">
                            <i class="material-icons">dns</i>
                          <p>TAB 1</p>
                        </a>
                    </li>
                    <li>
                        <a href="TAB 1.php">
                            <i class="material-icons">dns</i>
                            <p>TAB 1</p>
                        </a>
                    </li>
                                        <li >
                        <a href="TAB 1.php">
                            <i class="material-icons">account_balance</i>
                            <p>TAB 1</p>
                        </a>
                    </li>
                    <li >
                        <a href="TAB 1.php">
                            <i class="material-icons">home</i>
                            <p>TAB 1</p>
                        </a>
                    </li>
                    <li>
                        <a href="TAB 1.php">
                            <i class="material-icons">play_arrow</i>
                            <p>TAB 1</p>
                        </a>
                    </li>

                    <li class="active" >
                        <a href="autre.php">
                            <i class="material-icons">store</i>
                            <p>Autre</p>
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
                        <a class="navbar-brand" href="https://dashboard.jam-mdm.fr/"> Dashboard </a>                    </div>
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

<?php
}

?>


<?php
require_once('includes/footdashboard.php');

   ?>
</body>
<?php


    require_once('includes/javascriptdashboard.php');
?>

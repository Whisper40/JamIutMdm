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

  <title>Jam - index</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
</head>

<?php
//Connexion à la BDD et vérification du démarrage de la session de l'utilisateur
require_once('includes/head.php');
require_once('includes/checkconnection.php');
//error_reporting(0); // Disable all errors.

//Fonction de vérification des données entrées
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
?>

<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="blue" data-background-color="black" data-image="https://www.nasa.gov/sites/default/files/styles/full_width_feature/public/thumbnails/image/worldfires-08232018.jpg">
            <div class="logo">
                <a href="https://jam-mdm.fr/" class="simple-text">
                    JAM            </a>
            </div>
            <div class="logo logo-mini">
                <a href="https://jam-mdm.fr/" class="simple-text">
                    JAM
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
                        <a href="https://dashboard.jam-mdm.fr/">
                            <i class="material-icons">home</i>
                            <p>Tableau de bord</p>
                        </a>
                    </li>
                    <li>
                        <a href="page.php">
                            <i class="material-icons">dns</i>
                            <p>Page1</p>
                        </a>
                    </li>
                    <li>
                        <a href="page2.php">
                            <i class="material-icons">dns</i>
                            <p>Pge2</p>
                        </a>
                    </li>
                                        <li >
                        <a href="page3.php">
                            <i class="material-icons">account_balance</i>
                            <p>Page3</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="my_space">
                            <i class="material-icons">home</i>
                            <p>Page4</p>
                        </a>
                    </li>
                    <li>
                        <a href="page5.php">
                            <i class="material-icons">play_arrow</i>
                            <p>Page5</p>
                        </a>
                    </li>
                    <li >
                        <a href="page6.php">
                            <i class="material-icons">help</i>
                            <p>Page6</p>
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
                        <a class="navbar-brand" href="https://dashboard.jam-mdm.fr/"> Tableau de bord </a>                  </div>
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
                            <h3 class="title text-center">Espace Abonné</h3>
                            <br />
                            <div class="card">
                                <div class="card-content table-responsive">
                                    <style type="text/css">
                                        .text_align_right { text-align: right; }
                                        .text_align_left  { text-align: left; }
                                        .td1              { width: 50%; }
                                        .first-half       { text-align: right; float: left; width: 50%; }
                                        .second-half      { float: right; width: 50%; }
                                    </style>
                                                                        <table class="table table-hover">
                                        <tbody>

                                                                <div class="alert alert-info ">
                                                                    <div class="container-fluid "><center>
                                                                        <b>Votre username :

<!-- HTML A REFAIRE TOTALEMENT -->

<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
    echo $row['username'];
}

?>               </b>                                                       </div>

                                                                </div>


                                                                 <div class="alert alert-info">
                                                                    <div class="container-fluid"><center>
                                                                        <b>Votre Email :



<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
    echo $row['email'];
}

?>               </b>                                                       </div>

                                                                </div>
                                                                <h2 class="card-title" style="margin-left: 10px">Modifier mes informations</h2>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <!-- 2 fonctions ajax afin de ne pas reload la page + avoir une notif en javascript ! -->
<script>
   function SubmitFormData() {
    var email = $("#email").val();
    var password = $("#password").val();
    var repeatpassword = $("#repeatpassword").val();

    $.post("modifypasswordpanel.php", { email: email, password: password, repeatpassword: repeatpassword},
    function(data) {
     $('#results').html(data);
     $('#myForm')[0].reset();
    });
}
 function SubmitFormDataEmail() {
    var email2 = $("#email2").val();
    var newemail = $("#newemail").val();
    var repeatnewemail = $("#repeatnewemail").val();

    $.post("modifyemailpanel.php", { email2: email2, newemail: newemail, repeatnewemail: repeatnewemail},
    function(data) {
     $('#results2').html(data);
     $('#myForm2')[0].reset();
    });
}
</script>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">security</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Modifier mon mot de passe</h4>
                                    <form action="" method="post" id="myForm" class="contact-form">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email </label>
                                            <input type="email" name="email" id="email" class="form-control">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mot de passe</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Répeter le mot de passe</label>
                                            <input type="password" name="repeatpassword" id="repeatpassword" class="form-control">
                                        </div>
                                        <center>
                                       <input type="button" id="submitFormData" onclick="SubmitFormData();"  value="Modifier" class="btn btn-primary btn-round"/>
                                        </center>
                                        </form>
                                </div>


                                </div>
                            </div>
<div id="results"> <!-- TRES IMPORTANT -->
</div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header card-header-icon" data-background-color="rose">
                                    <i class="material-icons">mail_outline</i>
                                </div>
                                <div class="card-content">
                                    <h4 class="card-title">Modifier mon email</h4>
                                    <form action="" method="post" id="myForm2" class="contact-form">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email actuel</label>
                                            <input type="email" name="email2" id="email2" class="form-control">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Nouvel email</label>
                                            <input type="email" name="newemail" id="newemail" class="form-control">
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Répéter Nouvel email</label>
                                            <input type="email" name="repeatnewemail" id="repeatnewemail" class="form-control">
                                        </div>
                                        <center>
                                       <input type="button" id="submitFormDataEmail" onclick="SubmitFormDataEmail();"  value="Modifier" class="btn btn-primary btn-round"/>
                                        </center>
                                        </form>
                                </div>

                        </div>
        </div>

        <div id="results2"> <!-- TRES IMPORTANT -->
</div>


</div></div></div></div></center></div></div></center></div></div></tbody></table></div></div>
















                                                                        <center><a href="https://dashboard.jam-mdm.fr"><button class="btn btn-info"><i class="material-icons">play_arrow</i> Retour Dashboard</button></a></center>
                                </div>
                            </div>
                        </div>
                    </div>







<?php
require_once('includes/footdashboard.php');
 ?>


</body>

<?php

// Récupération du javascript pour le dashboard y compris les notifs "demo.."
   require_once('includes/javascriptdashboard.php');
   ?>

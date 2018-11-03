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

      <?php
      $nompage = "Mon Profile";
      require_once('includes/header.php');
      ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <form method="get" action="/" class="form-horizontal">
                      <div class="card-header card-header-text" data-background-color="rose">
                          <h4 class="card-title">Mes Informations</h4>
                      </div>
                      <div class="card-content">
                          <div class="row">
                              <label class="col-sm-2 label-on-left">Votre Nom :</label>
                              <div class="col-sm-10">
                                  <div class="form-group label-floating is-empty">
                                      <label class="control-label"></label>
                                      <input type="text" class="form-control" value="
<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
echo $row['username'];
}

?>">

                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-2 label-on-left">Votre e-mail :</label>
                              <div class="col-sm-10">
                                  <div class="form-group label-floating is-empty">
                                      <label class="control-label"></label>
                                      <input type="text" class="form-control" value="
<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$req = $db->query($sql);
$req->setFetchMode(PDO::FETCH_ASSOC);

foreach($req as $row)
{
    echo $row['email'];
    $emailid = $row['email'];
}
?> ">

                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>

          <script>
             function SubmitFormData() {
              var email = "<?php echo $emailid; ?>";
              var password = $("#password").val();
              var repeatpassword = $("#repeatpassword").val();

              $.post("modifypasswordpanel.php", { email: email, password: password, repeatpassword: repeatpassword},
              function(data) {
               $('#results').html(data);
               $('#myForm')[0].reset();
              });
          }
           function SubmitFormDataEmail() {
              var email2 = "<?php echo $emailid; ?>";
              var newemail = $("#newemail").val();
              var repeatnewemail = $("#repeatnewemail").val();

              $.post("modifyemailpanel.php", { email2: email2, newemail: newemail, repeatnewemail: repeatnewemail},
              function(data) {
               $('#results2').html(data);
               $('#myForm2')[0].reset();
              });
          }
          </script>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">mail_outline</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Modifier mon e-mail</h4>
                        <form action="" method="post" id="myForm2" class="contact-form">
                            <div class="form-group label-floating">
                                <label class="control-label">Nouvel e-mail</label>
                                <input type="email" class="form-control" name="newemail" id="newemail">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Répéter nouvel e-mail</label>
                                <input type="email" name="repeatnewemail" id="repeatnewemail" class="form-control">
                            </div>
                            <center>
                            <button id="submitFormDataEmail" onclick="SubmitFormDataEmail();" type="button" class="btn btn-fill btn-rose">Modifier</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <div id="results2"> <!-- TRES IMPORTANT -->
    </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">lock</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Modifier mon mot de passe</h4>
                        <form action="" method="post" id="myForm" class="contact-form">
                            <div class="form-group label-floating">
                                <label class="control-label">Nouveau mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Répéter nouveau mot de passe</label>
                                <input type="password" name="repeatpassword" id="repeatpassword" class="form-control">
                            </div>
                            <center>
                            <button id="submitFormData" onclick="SubmitFormData();" type="button" class="btn btn-fill btn-rose">Modifier</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
            <div id="results"> <!-- TRES IMPORTANT -->
            </div>
        </div>
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

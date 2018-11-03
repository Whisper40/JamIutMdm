<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Mon Profil"
    require_once('includes/head.php');


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
    require_once('includes/navbar.php');
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

</body>
<?php
    require_once('includes/javascriptdashboard.php');
?>

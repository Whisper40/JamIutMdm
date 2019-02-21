<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    require_once('includes/checksupreme.php');
    require_once('includes/head.php');
    $nompage = "Création d'admin";
    ini_set('display_errors', 1);
    $user_id = $_SESSION['admin_id'];
    date_default_timezone_set('Europe/Paris');
    setlocale(LC_TIME, 'fr_FR.utf8','fra');
    $date = strftime('%d/%m/%Y %H:%M:%S');

//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
function SubmitFormDataCreerUnAdmin() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var nom = $("#nom").val();
   var password = $("#password").val();
   var email = $("#email").val();
   var grade = $("#grade").val();

   $.post("ajax/createadminajax.php", { user_id: user_id, nom: nom, password: password, email: email, grade: grade},
   function(data) {
    $('#results23').html(data);
   });
}
</script>


<body>
  <div class="wrapper">

    <?php
    require_once('includes/navbar.php');
    ?>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Création et gestion des administrateurs</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card-content">
                            <h3 class="card-title">Création d'un compte admin</h3>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card-content">
                            <div class="form-group label-floating">
                                <label class="control-label">Nom</label>
                                <input type="text" class="form-control" name="nom" id="nom">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">Mot de Passe</label>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card-content">
                            <br>
                            <div class="info info-horizontal">
                              <div class="description">
                                <center>
                                  <h4 class="info-title">Choisir un grade à cet admin pour lui accorder des droits</h4>
                                </center>
                              </div>
                            </div>
                            <div class="jquerysel">
                              <select class="selectpicker" data-style="select-with-transition" title="Fonction" data-size="7" name="grade" id="grade">
                                <option disabled>Sélectionner du grade</option>
                                <option value="NORMAL">Normal</option>
                                <option value="SUPREME">Suprême</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card-content">
                            <center>
                              <button id="submitFormDataCreerUnAdmin" onclick="SubmitFormDataCreerUnAdmin();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                            </center>
                           </div>
                        </div>
                      </div>
                    </form>
                    <div id="results23"></div>
                  </div>
                </div>
              </div>

<?php
if(isset($_GET['action'])){
  if($_GET['action'] == 'gradenormal'){
    $id = $_GET['id'];

    $updateadmin= $db->prepare("UPDATE admin SET grade=:grade where id=:id");
    $updateadmin->execute(array(
      "grade"=>'NORMAL',
      "id"=>$id
    )
    );


  }else if ($_GET['action'] == 'gradesupreme'){

    $id = $_GET['id'];
    $updateadmin= $db->prepare("UPDATE admin SET grade=:grade where id=:id");
    $updateadmin->execute(array(
      "grade"=>'SUPREME',
      "id"=>$id
    )
    );


  }else{

    $id = $_GET['id'];
    $deleteadmin= $db->prepare("DELETE FROM admin where id=:id");
    $deleteadmin->execute(array(
      "id"=>$id
    )
    );


  }
}


    $selectadmin= $db->prepare("SELECT * FROM admin ORDER BY id ASC");
    $selectadmin->execute();
    $countid = $selectadmin->rowCount();
    if($countid>'0'){
    ?>

            <div class="row">
              <div class="col-sm-12">
                <div class="card-content">
                  <h3 class="card-title">Liste des administrateurs</h3>
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
                        <th class="text-center">Email</th>
                        <th class="text-center">Date d'inscription</th>
                        <th class="text-center">Grade</th>
                        <th class="text-center">Action</th>

                      </thead>
                      <tbody>

                        <?php
                        while($admin = $selectadmin->fetch(PDO::FETCH_OBJ)){
                          $id=$admin->id;
                          $username = $admin->username;
                          $email = $admin->email;
                          $subscribe = $admin->subscribe;
                          $grade = $admin->grade;
                        ?>


                        <tr>
                          <td class="text-center"><?php echo $username;?></td>
                          <td class="text-center"><?php echo $email;?></td>
                          <td class="text-center"><?php echo $subscribe;?></td>
                          <td class="text-center"><?php echo $grade;?></td>
                          <td class="text-center">

                            <?php
                            if($grade == 'NORMAL'){
                              ?>
                              <a href="?action=gradesupreme&amp;id=<?php echo $id;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Donner le grade suprême</button></a>
                              <?php
                            }else{
                              ?>
                              <a href="?action=gradenormal&amp;id=<?php echo $id;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Donner le grade normal</button></a>
                              <?php
                            }
                            ?>
                            <a href="?action=deleteadmin&amp;id=<?php echo $id;?>"><button type="button" class="btn btn-rose btn-round btn-sm">Supprimer</button></a>
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

























    </div>



  </div>
</body>
<?php
require_once('includes/javascript.php');
?>

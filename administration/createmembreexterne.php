<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Nous Contacter";
    ini_set('display_errors', 1);
    $user_id = $_SESSION['admin_id'];


//Code de génératon du captcha fournie par GOOGLE
$secret = "LESECRET";
$sitekey = "LESITEKEY";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
$(document).ready(function(){

var $recherche =$('input[name=valeur]');
var critere;
$recherche.keyup(function(){
  critere = $.trim($recherche.val());
  if(critere!=''){
    $.get('giveaccessmembre.php?critere='+critere,function(retour){

$('#resultat').html(retour).fadeIn();

});

}else $('#resultat').empty().fadeOut();
});
});







function SubmitFormDataCreerUnMembre() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var nom = $("#nom").val();
   var prenom = $("#prenom").val();
   var code = $("#code").val();
   var raison = $("#raison").val();

   $.post("ajax/createmembreexterne.php", { user_id:user_id, nom: nom, prenom: prenom, code: code, raison: raison},
   function(data) {
    $('#results23').html(data);
   });
}
</script>

<body class="landing-page sidebar-collapse">
  <div class="wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <h2 class="card-title text-center">Créer un membre externe</h2>
                    <form action="" method="post" id="myForm1" class="contact-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-content">
                              <div class="form-group label-floating">
                                  <label class="control-label">Nom</label>
                                  <input type="text" class="form-control" value="Dupont" name="nom" id="nom">
                              </div>
                              <div class="form-group label-floating">
                                  <label class="control-label">Prénom</label>
                                  <input type="text" name="prenom" value="Pierre" id="prenom" class="form-control">
                              </div>

                            <div class="form-group label-floating">
                            <label class="control-label">Code</label>
                            <input type="number" min="1000" name="code" value="<?php echo mt_rand(1000, 999999); ?>" id="code" class="form-control">
                            </div>

                            <div class="form-group label-floating">
                            <label class="control-label">Raison</label>
                            <input type="text" name="raison" value="Ancien étudiant de Mdm" id="raison" class="form-control">
                            </div>

                             </div>
                          </div>

                        <div class="col-sm-12">
                            <div class="card-content">

                              <center>
                              <button id="SubmitFormDataCreerUnMembre" onclick="SubmitFormDataCreerUnMembre();" type="button" class="btn btn-primary btn-round btn-rose">Créer</button>
                              </center>
                             </div>
                          </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>

     <div id="results23"> <!-- TRES IMPORTANT -->
    </div>
    </div>


    <?php
    if(isset($_GET['action'])){
    if($_GET['action']=='giveaccessmembre'){

    $id=$_GET['id'];
    $setmembre = $db->prepare("UPDATE users SET status=:status WHERE id=$id");
    $setmembre->execute(array(
      "status"=>'MEMBRE'
    ));


    $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
    $insertlogs->execute(array(
                        "user_id"=>$user_id,
                        "type"=>'Gestion',
                        "action"=>'Passage à l'\état d'\un membre manuellement',
                        "page"=>'createmembreexterne.php',
                        "date"=>$date
                        )
                    );


    ?>
    <script>window.location="https://administration.jam-mdm.fr/createmembreexterne.php"</script>
    <?php
  }}
?>

<h3> Donner le grade de membre :  </h3>
  <input type='text' name="valeur" placeholder="Saisir son nom, id ou email">
  <p id='resultat'></p>











  </div>
</body>
<?php
require_once('includes/javascript.php');
?>

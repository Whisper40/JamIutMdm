<?php
//TEST KEVIN
require_once('includes/connectBDD.php');
require_once('includes/checkconnection.php');
require_once('includes/checksupreme.php')

$nompage = "Dons";
require_once('includes/head.php');

$user_id = $_SESSION['admin_id'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>


<script>


function SubmitFormDataModifDateFin() {
   var user_id = "<?php echo $_SESSION['admin_id']; ?>";
   var datefin = $("#datefin").val();

   $.post("ajax/modifydatefinadhesion.php", { user_id: user_id, datefin: datefin},
   function(data) {
    $('#result93').html(data);

   });

}
</script>
<?php
    $selectdatefin = $db->prepare("SELECT datefin FROM annuelle");
    $selectdatefin->execute();

  $s2 = $selectdatefin->fetch(PDO::FETCH_OBJ);
  $datefin = $s2->datefin;

        ?>
<div class="col-sm-6">
  <div class="card-content">
    <form action="" method="post" id="myForm1" class="contact-form">
      <h3 class="card-title text-center">Modification de la de fin d'adhésion</h3>
      <br><br>

      <div class="form-group label-floating">
        <label class="control-label">Date de fin</label>
        <input type="text" name="datefin" value="<?php echo $datefin; ?>" id="datefin" class="form-control">
      </div>
      <br>
      <center>
        <button id="submitFormDataModifDateFin" onclick="SubmitFormDataModifDateFin();" type="button" class="btn btn-primary btn-round btn-rose">Modifier</button>
      </center>
    </form>
  </div>
</div>
</div>
<div id="results93"></div>


A FAIRE

<h1> N'appuyer qu'en connaissance de cause ! </h1>
<h1> A n'effectuer qu'au début de chaque année si nécessaire ! </h1>
<button onclick="demo.showSwal('warningdeleteacti','<?php echo $user_id; ?>','<?php echo $id; ?>')" type="button" class="btn btn-rose btn-round btn-sm">Vider toutes les tables</button>




<?php



require_once('includes/javascript.php');
?>

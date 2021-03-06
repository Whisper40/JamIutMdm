<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>

  <meta name="Description" content="Association JAM MDM (Jeunesse Associative Montoise), Mont de Marsan, IUT MDM, UPPA, association étudiante pour les étudiants de l'iut de Mont de Marsan developpé dans le cadre d'un projet pédagogique. Les activités de l'association comprennent des sorties, déjours ski, activités gratuite concernant différent thèmes. ">
  <meta name="Keywords" content="jam, association mont de marsan, iut mont de marsan, iut mdm, uppa">
  <meta name="Identifier-Url" content="https://jam-mdm.fr">
  <meta name="Reply-To" content="postmaster@jam-mdm.fr"> <!-- Mail Admin -->


  <meta name="Rating" content="general">
  <meta name="Distribution" content="global">
  <meta name="Category" content="internet">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Administration Jam - <?php echo $nompage ?></title>


    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/material-kit.css" rel="stylesheet"/>
    <link href="assets/css/material-dashboard.css" rel="stylesheet"/>
</head>
<script>

function StartNotif(message,type){


  var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  customClass: 'swal-wide',
  timer: 6000
});

Toast.fire({
  type: type,
  title: '<h4 class="info-title">'+message+'</h4>'
})
}

</script>

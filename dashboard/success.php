<?php
    require_once('includes/connectBDD.php');
    require_once('includes/checkconnection.php');
    $nompage = "Page de succès";
    require_once('includes/head.php');
?>

<body>
    <div class="wrapper">

    <?php
    require_once('includes/navbar.php');
     ?>

        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-content">
                        <h2 class="card-title text-center">Félicitations tu es désormais membre de la JAM !</h2>
                        <br><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-content">
                                <br><br>
                                    <center>
                                        <h4 class="card-title">
                                            Tes documents ont été validés ! Ta cotisation a été payé !<br><br>
                                            Tu es à présent membre et tu peux par conséquent t'inscrire et participer à toute les soirées, activités et voyages organisés par l'association.<br><br>
                                            Que la réussite soit en toi !<br/>N'hésite pas à proposer des activités aux membres de l'équipe JAM.
                                        </h4>
                                    </center>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-content">
                                    <br><br>

                                    <?php
                                    $ind = $db->query("SELECT * FROM pageindex");
                                    $index = $ind->fetch(PDO::FETCH_OBJ);
                                    ?>


                                    <div class="card-image" data-header-animation="false">
                                        <img class="img" src="https://jam-mdm.fr/JamFichiers/Img/ImagesDuSite/Original/<?php echo $index->logo2 ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
require_once('includes/javascriptdashboard.php');
?>
</body>

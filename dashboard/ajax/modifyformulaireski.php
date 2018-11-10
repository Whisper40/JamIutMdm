<?php
require_once('../includes/connectBDD.php');




        $user_id = $_POST['user_id'];
        $poids = $_POST['poids'];
        $taille = $_POST['taille'];
        $allergie = $_POST['allergie'];
        $adresse = $_POST['adresse'];
        $codepostal = $_POST['codepostal'];
        $ville = $_POST['ville'];
        $telurgence = $_POST['telurgence'];



        if(!empty($user_id)&&!empty($poids)&&!empty($taille)&&!empty($allergie)&&!empty($adresse)&&!empty($codepostal)&&!empty($ville)&&!empty($telurgence)){
                $update = $db->prepare("UPDATE formulaireski SET poids='$poids', taille='$taille', allergie='$allergie', adresse='$adresse', codepostal='$codepostal', ville='$ville', telurgence='$telurgence' WHERE user_id='$user_id'");
                $update->execute();
                ?>
            <script>

            demo.showSwal('success-message');
            demo.showNotification('top','right','<b>Succès</b> - Modification effectuées !');
            </script>
            <?php



            }else{
                ?>


                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modification non effectuées en raison de champs vides !');
                    </script>


            <?php
            }

        ?>

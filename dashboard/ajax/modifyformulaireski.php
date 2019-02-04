<?php
require_once('../includes/connectBDD.php');




        $user_id = $_POST['user_id'];
        $poids = $_POST['poids'];
        $taille = $_POST['taille'];
        $pointure = $_POST['pointure'];
        $allergie = $_POST['allergie'];
        $adresse = $_POST['adresse'];
        $codepostal = $_POST['codepostal'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];
        $telurgence = $_POST['telurgence'];




        if(!empty($user_id)&&!empty($poids)&&!empty($taille)&&!empty($pointure)&&!empty($allergie)&&!empty($adresse)&&!empty($codepostal)&&!empty($ville)&&!empty($tel)&&!empty($telurgence)){
                $update = $db->prepare("UPDATE formulaireski SET poids='$poids', taille='$taille', pointure='$pointure', allergie='$allergie', adresse='$adresse', codepostal='$codepostal', ville='$ville', tel='$tel', telurgence='$telurgence' WHERE user_id='$user_id'");
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

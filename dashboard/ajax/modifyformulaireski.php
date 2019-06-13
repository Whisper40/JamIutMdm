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




        if(!empty($user_id)&&!empty($poids)&&!empty($taille)&&!empty($pointure)&&!empty($adresse)&&!empty($codepostal)&&!empty($ville)&&!empty($tel)&&!empty($telurgence)){
                $update = $db->prepare("UPDATE formulaireski SET poids='$poids', taille='$taille', pointure='$pointure', allergie='$allergie', adresse='$adresse', codepostal='$codepostal', ville='$ville', tel='$tel', telurgence='$telurgence' WHERE user_id='$user_id'");
                $update->execute();
                ?>
            <script>

            demo.showSwal('success-message');
            demo.showNotification('top','right','Modifications effectuées avec succès !','success');
            </script>
            <?php



            }else{
                ?>


                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','Désolé, modification non effectué en raison de champs vides !','warning');
                    </script>


            <?php
            }

        ?>

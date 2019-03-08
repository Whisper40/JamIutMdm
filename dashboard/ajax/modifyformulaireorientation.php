<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $adresse = $_POST['adresse'];
        $codepostal = $_POST['codepostal'];
        $ville = $_POST['ville'];
        $tel = $_POST['tel'];
        $telurgence = $_POST['telurgence'];



        if(!empty($user_id)&&!empty($adresse)&&!empty($codepostal)&&!empty($ville)&&!empty($tel)&&!empty($telurgence)){
                $update = $db->prepare("UPDATE formulaireorientation SET adresse='$adresse', codepostal='$codepostal', ville='$ville', tel='$tel', telurgence='$telurgence' WHERE user_id='$user_id'");
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
                    demo.showNotification('top','right','Désolé, suppression non effectué en raison de champs vides !','warning');
                    </script>


            <?php
            }

        ?>

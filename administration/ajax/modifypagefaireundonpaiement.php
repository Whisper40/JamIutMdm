<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $pagetitre = $_POST['pagetitre'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];


        if(!empty($user_id)&&!empty($pagetitre)&&!empty($titre)&&!empty($description)){

                $update = $db->prepare("UPDATE photopage SET pagetitre=:pagetitre WHERE id=:id");
                $update->execute(array(
                    "id"=>'10',
                    "pagetitre"=>$pagetitre                   

                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification page Faire Un Don',
                                    "page"=>'don.php',
                                    "date"=>$date
                                    )
                                );

                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - Modifications effectuées !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modifications non effectuées en raison de champs vides !');
                    </script>
            <?php
            }

    ?>

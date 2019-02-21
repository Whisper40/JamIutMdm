<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];

        $titre = $_POST['titre'];
        $pagetitre = $_POST['pagetitre'];


        if(!empty($user_id)&&!empty($titre)&&!empty($pagetitre)){




                $update2 = $db->prepare("UPDATE photopage SET pagetitre=:pagetitre, titre=:titre WHERE nompage=:nompage");
                $update2->execute(array(
                    "nompage"=>'Liens Utiles',
                    "titre"=>$titre,
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
                                    "action"=>'Modification lien utiles',
                                    "page"=>'lienutiles.php',
                                    "date"=>$date
                                    )
                                );s

                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - Modifications effectués !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> - Modifications non effectués en raison de champs vides !');
                    </script>
            <?php
            }

    ?>

<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $pagetitre = $_POST['pagetitre'];
        $image = $_POST['image'];
        $titre = $_POST['titre'];

        if(!empty($user_id)&&!empty($pagetitre)&&!empty($image)&&!empty($titre)){

                $update = $db->prepare("UPDATE photopage SET pagetitre=:pagetitre, image=:image, titre=:titre WHERE nompage=:nompage");
                $update->execute(array(
                    "nompage"=>'Présentation des membres',
                    "pagetitre"=>$pagetitre,
                    "image"=>$image,
                    "titre"=>$titre
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification page membre',
                                    "page"=>'membre.php',
                                    "date"=>$date
                                    )
                                );

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

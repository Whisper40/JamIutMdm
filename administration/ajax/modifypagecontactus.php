<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $pagetitre = $_POST['pagetitre'];
        $titre = $_POST['titre'];
        $description = $_POST['description'];


        if(!empty($user_id)&&!empty($pagetitre)&&!empty($titre)&&!empty($description)){

                $update = $db->prepare("UPDATE photopage SET pagetitre=:pagetitre, titre=:titre, description=:description WHERE nompage=:nompage");
                $update->execute(array(
                    "nompage"=>'Nous Contacter',
                    "pagetitre"=>$pagetitre,
                    "titre"=>$titre,
                    "description"=>$description
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification page Nous Contacter',
                                    "page"=>'contact.php',
                                    "date"=>$date
                                    )
                                );

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

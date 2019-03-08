<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $titre = $_POST['titre'];
        $pagetitre = $_POST['pagetitre'];
        $description = $_POST['description'];

        if(!empty($user_id)&&!empty($pagetitre)&&!empty($titre)&&!empty($description)){

                $update = $db->prepare("UPDATE photopage SET titre=:titre, pagetitre=:pagetitre, description=:description WHERE nompage=:nompage");
                $update->execute(array(
                    "nompage"=>"Actualité",
                    "titre"=>$titre,
                    "pagetitre"=>$pagetitre,
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
                                    "action"=>'Modification page actualitée',
                                    "page"=>'actualitees.php',
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

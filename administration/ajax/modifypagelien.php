<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $lienimage = $_POST['lienimage'];
        $lien = $_POST['lien'];

        if(!empty($user_id)&&!empty($id)&&!empty($nom)&&!empty($lienutiles)&&!empty($lien)&&!empty($description)){

                $update = $db->prepare("UPDATE lienutiles SET name=:nom, description=:description, liensutiles=:lienutiles, lien:lien WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "nom"=>$nom,
                    "lienutiles"=>$lienutiles,
                    "lien"=>$lien,
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
                                    "action"=>'Modification liens utiles',
                                    "page"=>'liensutiles.php',
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

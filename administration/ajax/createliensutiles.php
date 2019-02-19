<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $lienimage = $_POST['lienimage'];
        $lien = $_POST['lien'];
        $catslug = $_POST['catlien'];


        if(!empty($user_id)&&!empty($nom)&&!empty($description)&&!empty($lienimage)&&!empty($lien)&&!empty($catslug)){

          $insert = $db->prepare("INSERT INTO lienutiles (slug, name) VALUES (:catslug, :nom)");
          $insert->execute(array(
            "catslug"=>$catslug,
            "nom"=>$nom
          )
          );



                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Ajout',
                                    "action"=>'Ajout de membres',
                                    "page"=>'membre.php',
                                    "date"=>$date
                                    )
                                );

                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','<b>Succès</b> - Création effectuée !');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','<b>Erreur</b> -Création non effectuée en raison de champs vides !');
                    </script>
            <?php
            }

    ?>

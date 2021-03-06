<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $lienimage = $_POST['lienimage'];
        $lien = $_POST['lien'];
        $catslug = $_POST['catlien'];


        if(!empty($user_id)&&!empty($nom)&&!empty($description)&&!empty($lienimage)&&!empty($lien)&&!empty($catslug)){

          $insert = $db->prepare("INSERT INTO lienutiles (slug, name, description, lienimage, lien) VALUES (:catslug, :nom, :description, :lienimage, :lien)");
          $insert->execute(array(
            "catslug"=>$catslug,
            "nom"=>$nom,
            "description"=>$description,
            "lienimage"=>$lienimage,
            "lien"=>$lien
          )
          );



                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Ajout',
                                    "action"=>'Ajout de Lien Utiles',
                                    "page"=>'liensutiles.php',
                                    "date"=>$date
                                    )
                                );

                ?>

                    <script>
                    demo.showSwal('success-message');
                    demo.showNotification('top','right','Création effectuée avec succès !','success');
                    </script>

            <?php
            }else{
                ?>

                    <script>
                    demo.showSwal('danger-message');
                    demo.showNotification('top','right','Désolé, création non effectuée en raison de champs vides !','warning');
                    </script>
            <?php
            }

    ?>

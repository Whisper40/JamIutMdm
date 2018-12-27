<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $nom = $_POST['nom'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        $grademembre = $_POST['grademembre'];
        $importancegrade = $_POST['importancegrade'];
        $fonction = $_POST['fonction'];

        if(!empty($user_id)&&!empty($nom)&&!empty($image)&&!empty($description)&&!empty($grademembre)&&!empty($importancegrade)&&!empty($fonction)){


                $insert = $db->prepare("INSERT INTO membres (nom, image, description, categorie, importance, fonction) VALUES (:nom, :image, :description, :grademembre, :importancegrade, :fonction)");
                $insert->execute(array(
                    "nom"=>$nom,
                    "image"=>$image,
                    "description"=>$description,
                    "grademembre"=>$grademembre,
                    "importancegrade"=>$importancegrade,
                    "fonction"=>$fonction
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

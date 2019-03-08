<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];

        $titre1 = $_POST['titre1'];
        $description1 = $_POST['description1'];
        $bouton1 = $_POST['bouton1'];
        $lienbt1 = $_POST['lienbt1'];
        $bouton2 = $_POST['bouton2'];

        $titre2 = $_POST['titre2'];
        $description2 = $_POST['description2'];
        $fb = $_POST['fb'];
        ?>



    <?php


        if(!empty($user_id)&&!empty($id)&&!empty($titre1)&&!empty($description1)&&!empty($bouton1)&&!empty($lienbt1)&&!empty($bouton2)&&!empty($titre2)&&!empty($description2)&&!empty($fb)){


                $update = $db->prepare("UPDATE pageindex SET titre1=:titre1, description1=:description1, bouton1=:bouton1, lienbt1=:lienbt1, bouton2=:bouton2, titre2=:titre2, description2=:description2, fb=:fb WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "titre1"=>$titre1,
                    "description1"=>$description1,
                    "bouton1"=>$bouton1,
                    "lienbt1"=>$lienbt1,
                    "bouton2"=>$bouton2,
                    "titre2"=>$titre2,
                    "description2"=>$description2,
                    "fb"=>$fb
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification de l\'index',
                                    "page"=>'index.php',
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

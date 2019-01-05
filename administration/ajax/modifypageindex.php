<?php
require_once('../includes/connectBDD.php');

        $user_id = $_POST['user_id'];
        $id = $_POST['id'];
        $img1 = $_POST['img1'];
        $logo1 = $_POST['logo1'];
        $titre1 = $_POST['titre1'];
        $description1 = $_POST['description1'];
        $bouton1 = $_POST['bouton1'];
        $lienbt1 = $_POST['lienbt1'];
        $bouton2 = $_POST['bouton2'];
        $logo2 = $_POST['logo2'];
        $titre2 = $_POST['titre2'];
        $description2 = $_POST['description2'];
        $fb = $_POST['fb'];
        ?>



    <?php


        if(!empty($user_id)&&!empty($id)&&!empty($img1)&&!empty($logo1)&&!empty($titre1)&&!empty($description1)&&!empty($bouton1)&&!empty($lienbt1)&&!empty($bouton2)&&!empty($logo2)&&!empty($titre2)&&!empty($description2)&&!empty($fb)){


                $update = $db->prepare("UPDATE pageindex SET img1=:img1, logo1=:logo1, titre1=:titre1, description1=:description1, bouton1=:bouton1, lienbt1=:lienbt1, bouton2=:bouton2, logo2=:logo2, titre2=:titre2, description2=:description2, fb=:fb WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "img1"=>$img1,
                    "logo1"=>$logo1,
                    "titre1"=>$titre1,
                    "description1"=>$description1,
                    "bouton1"=>$bouton1,
                    "lienbt1"=>$lienbt1,
                    "bouton2"=>$bouton2,
                    "logo2"=>$logo2,
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
                    demo.showNotification('top','right','<b>Succès</b> - Modifications effectuées !');
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

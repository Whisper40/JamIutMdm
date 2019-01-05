<?php
require_once('../includes/connectBDD.php');

        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $title2 = $_POST['title2'];
        $description2 = $_POST['description2'];
        $title3 = $_POST['title3'];
        $description3 = $_POST['description3'];
        $formatimg = $_POST['formatimg'];
        $stock = $_POST['stock'];


        if(!empty($id)&&!empty($user_id)&&!empty($title)&&!empty($description)&&!empty($formatimg)&&!empty($stock)){

                $update = $db->prepare("UPDATE photopage SET title=:title, description=:description, title2=:title2, description2=:description2, title3=:title3, description3=:description3, formatimg=:formatimg, stock=:stock WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "title"=>$title,
                    "description"=>$description,
                    "title2"=>$title2,
                    "description2"=>$description2,
                    "title3"=>$title3,
                    "description3"=>$description3,
                    "formatimg"=>$formatimg,
                    "stock"=>$stock
                    )
                );

                date_default_timezone_set('Europe/Paris');
                setlocale(LC_TIME, 'fr_FR.utf8','fra');
                $date = strftime('%d/%m/%Y %H:%M:%S');

                $insertlogs = $db->prepare("INSERT INTO logs (user_id, type, action, page, date) VALUES(:user_id, :type, :action, :page, :date)");
                $insertlogs->execute(array(
                                    "user_id"=>$user_id,
                                    "type"=>'Modification',
                                    "action"=>'Modification d une actualitée',
                                    "page"=>'actualitees.php',
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

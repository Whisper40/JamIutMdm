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



        if(!empty($id)&&!empty($user_id)&&!empty($title)&&!empty($description)&&!empty($formatimg)){

          $selectancien = $db->prepare("SELECT * FROM newsactus WHERE id=:id");
          $selectancien->execute(array(
              "id"=>$id
              )
          );
            $r2 = $selectancien->fetch(PDO::FETCH_OBJ);
            $titleancien = $r2->title;
            $title2ancien = $r2->title2;
            $title3ancien = $r3->title3;

            $update = $db->prepare("UPDATE carousel SET titre=:title WHERE titre=:titreancien");
            $update->execute(array(
                "titreancien"=>$titleancien,
                "title"=>$title
                )
            );
            $update = $db->prepare("UPDATE carousel SET titre=:title2 WHERE titre=:titreancien2");
            $update->execute(array(
                "titreancien2"=>$titleancien2,
                "title2"=>$title2
                )
            );
            $update = $db->prepare("UPDATE carousel SET titre=:title3 WHERE titre=:titreancien3");
            $update->execute(array(
                "titreancien3"=>$titleancien3,
                "title3"=>$title3
                )
            );



                $update = $db->prepare("UPDATE newsactus SET title=:title, description=:description, title2=:title2, description2=:description2, title3=:title3, description3=:description3, formatimg=:formatimg WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "title"=>$title,
                    "description"=>$description,
                    "title2"=>$title2,
                    "description2"=>$description2,
                    "title3"=>$title3,
                    "description3"=>$description3,
                    "formatimg"=>$formatimg
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

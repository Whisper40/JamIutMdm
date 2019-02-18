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

        $stock = $_POST['stock'];



        if(!empty($id)&&!empty($user_id)&&!empty($title)&&!empty($description)&&!empty($stock)){

          $selectancien = $db->prepare("SELECT * FROM activitesvoyages WHERE id=:id");
          $selectancien->execute(array(
              "id"=>$id
              )
          );
            $r2 = $selectancien->fetch(PDO::FETCH_OBJ);
            $slug = $r2->slug;
            $titleancien = $r2->title;
            $title2ancien = $r2->title2;
            $title3ancien = $r2->title3;

            $update1 = $db->prepare("UPDATE carousel SET titre=:title WHERE titre=:titreancien and slug=:slug");
            $update1->execute(array(
                "titreancien"=>$titleancien,
                "title"=>$title,
                "slug"=>$slug
                )
            );
            $update2 = $db->prepare("UPDATE carousel SET titre=:title2 WHERE titre=:titreancien2 and slug=:slug");
            $update2->execute(array(
                "titreancien2"=>$title2ancien,
                "title2"=>$title2,
                "slug"=>$slug
                )
            );
            $update3 = $db->prepare("UPDATE carousel SET titre=:title3 WHERE titre=:titreancien3 and slug=:slug");
            $update3->execute(array(
                "titreancien3"=>$title3ancien,
                "title3"=>$title3,
                "slug"=>$slug
                )
            );


                $update = $db->prepare("UPDATE activitesvoyages SET title=:title, description=:description, title2=:title2, description2=:description2, title3=:title3, description3=:description3, stock=:stock WHERE id=:id");
                $update->execute(array(
                    "id"=>$id,
                    "title"=>$title,
                    "description"=>$description,
                    "title2"=>$title2,
                    "description2"=>$description2,
                    "title3"=>$title3,
                    "description3"=>$description3,
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
                                    "action"=>'Modification d une activite',
                                    "page"=>'activitees.php',
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
